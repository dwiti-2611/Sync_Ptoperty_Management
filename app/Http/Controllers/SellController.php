<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Customer;
use App\Employee;
use App\Sell;
use App\Product;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class SellController extends Controller
{

    //    Important properties
    public $parentModel = Sell::class;
    public $parentRoute = 'sell';
    public $parentView = "admin.sell";

    /**
     * This function return get totals
     *
     * @author      Md. Al-Mahmud <mamun120520@gmail.com>
     * @version     1.0
     * @see         
     * @since       11/12/2022
     * Time         13:18:45
     * @param       
     * @return      
     */
    public function get_count()
    {
        # code...   
        $data = [];
        if (Cache::get('total_sells') && Cache::get('total_sells') != null) {
            $data['total_sells'] = Cache::get('total_sells');
        } else {
            $data['total_sells'] = $this->parentModel::count();
            Cache::put('total_sells', $data['total_sells']);
        }
        if (Cache::get('total_trashed_sells') && Cache::get('total_trashed_sells') != null) {
            $data['total_trashed_sells'] = Cache::get('total_trashed_sells');
        } else {
            $data['total_trashed_sells'] = $this->parentModel::onlyTrashed()->count();
            Cache::put('total_trashed_sells', $data['total_trashed_sells']);
        }
        return $data;
    }
    #end

    /**
     * This function forget count
     *
     * @author      Md. Al-Mahmud <mamun120520@gmail.com>
     * @version     1.0
     * @see         
     * @since       11/12/2022
     * Time         14:23:01
     * @param       
     * @return      
     */
    public function forget_count()
    {
        # code...  
        Cache::forget('total_sells');
        Cache::forget('total_trashed_sells');
    }
    #end

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->parentModel::with('customer', 'branch', 'employee')->orderBy('created_at', 'desc')->paginate(60);
        return view($this->parentView . '.index', $this->get_count())->with('items', $items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['customers'] = Customer::orderBy('created_at', 'desc')->get();
        $data['branches'] = Branch::orderBy('created_at', 'desc')->get();
        $data['employees'] = Employee::orderBy('created_at', 'desc')->get();
        return view($this->parentView . '.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'numeric|not_in:0',
            'branch_id' => 'numeric|not_in:0',
            'product_id' => 'required|not_in:0|string|unique:sells',
            'employee_id' => 'numeric|not_in:0',
            'sells_date' => 'required',
        ]);
        $this->parentModel::create([
            'customer_id' => $request->customer_id,
            'branch_id' => $request->branch_id,
            'product_id' => $request->product_id,
            'employee_id' => $request->employee_id,
            'sells_date' => $request->sells_date,
            'created_by' => auth()->user()->email,
        ]);
        $this->forget_count();
        Session::flash('success', "Successfully  Create");
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $item = $this->parentModel::find($request->id);
        if (empty($item)) {
            Session::flash('error', "Item not found");
            return redirect()->back();
        }
        return view($this->parentView . '.show')->with('items', $item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $items = $this->parentModel::find($id);
        if (empty($items)) {
            Session::flash('error', "Item not found");
            return redirect()->back();
        }
        return view($this->parentView . '.edit')->with('item', $items);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_id' => 'numeric|not_in:0|',
            'branch_id' => 'numeric|not_in:0|',
            'product_id' => 'sometimes|not_in:0|string|unique:sells,product_id,' . $id,
            'employee_id' => 'numeric|not_in:0|',
            'sells_date' => 'required',
        ]);
        $items = $this->parentModel::find($id);
        $items->customer_id = $request->customer_id;
        $items->branch_id = $request->branch_id;
        $items->product_id = $request->product_id;
        $items->employee_id = $request->employee_id;
        $items->sells_date = $request->sells_date;
        $items->updated_by = auth()->user()->email;
        $items->save();
        Session::flash('success', "Update Successfully");
        return redirect()->route($this->parentRoute);
    }

    public function pdf(Request $request)
    {
        $item = $this->parentModel::find($request->id);
        if (empty($item)) {
            Session::flash('error', "Item not found");
            return redirect()->back();
        }
        $now = new \DateTime();
        $date = $now->format(Config('settings.date_format') . ' h:i:s');
        $extra = array(
            'current_date_time' => $date,
            'module_name' => 'Sells Manage'
        );
        $pdf = PDF::loadView($this->parentView . '.pdf', ['items' => $item,  'extra' => $extra])->setPaper('a4', 'landscape');
        //return $pdf->stream('invoice.pdf');
        return $pdf->download($extra['current_date_time'] . '_' . $extra['module_name'] . '.pdf');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $items = $this->parentModel::with('schedule_receivables', 'actual_receives')->where('id', $id)->first();
        if ($items != null && $items->schedule_receivables->count() > 0) {
            Session::flash('error', "You can not delete it.Because it has some items");
            return redirect()->back();
        }
        if ($items != null && $items->actual_receives->count() > 0) {
            Session::flash('error', "You can not delete it.Because it has some items");
            return redirect()->back();
        }
        $items->deleted_by = auth()->user()->email;
        $items->delete();
        $this->forget_count();
        Session::flash('success', "Successfully Trashed");
        return redirect()->back();
    }
    public function trashed()
    {
        $items = $this->parentModel::with('customer', 'branch', 'employee')->onlyTrashed()->paginate(60);
        return view($this->parentView . '.trashed', $this->get_count())->with("items", $items);
    }
    public function restore($id)
    {
        $items = $this->parentModel::onlyTrashed()->where('id', $id)->first();
        $items->restore();
        $this->forget_count();
        Session::flash('success', 'Successfully Restore');
        return redirect()->back();
    }

    public function kill($id)
    {
        $items = $this->parentModel::with('schedule_receivables', 'actual_receives')->withTrashed()->where('id', $id)->first();
        if ($items != null && $items->schedule_receivables->count() > 0) {
            Session::flash('error', "You can not delete it. Because it has some items");
            return redirect()->back();
        }
        if ($items != null && $items->actual_receives->count() > 0) {
            Session::flash('error', "You can not delete it. Because it has some items");
            return redirect()->back();
        }
        $items->forceDelete();
        $this->forget_count();
        Session::flash('success', 'Permanently Delete');
        return redirect()->back();
    }

    public function activeSearch(Request $request)
    {
        $request->validate([
            'search' => 'min:1'
        ]);
        $search = $request["search"];
        $items = $this->parentModel::where('product_id', 'like', '%' . $search . '%')
            ->orWhereHas('branch', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orWhereHas('customer', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orWhereHas('employee', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->where('sells_date', 'like', '%' . $search . '%')
            ->paginate(60);
        return view($this->parentView . '.index', $this->get_count())
            ->with('items', $items);
    }

    public function trashedSearch(Request $request)
    {
        $request->validate([
            'search' => 'min:1'
        ]);
        $search = $request["search"];
        $items = $this->parentModel::where('product_id', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->orWhereHas('branch', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->onlyTrashed()
            ->orWhereHas('customer', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->onlyTrashed()
            ->orWhereHas('employee', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->onlyTrashed()
            ->where('sells_date', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->paginate(60);
        return view($this->parentView . '.trashed', $this->get_count())
            ->with('items', $items);
    }


    //    Fixed Method for all
    public function activeAction(Request $request)
    {
        $request->validate([
            'items' => 'required'
        ]);
        if ($request->apply_comand_top == 3 || $request->apply_comand_bottom == 3) {
            foreach ($request->items["id"] as $id) {
                $this->destroy($id);
            }
            return redirect()->back();
        } elseif ($request->apply_comand_top == 2 || $request->apply_comand_bottom == 2) {
            foreach ($request->items["id"] as $id) {
                $this->kill($id);
            }
            return redirect()->back();
        } else {
            Session::flash('error', "Something is wrong.Try again");
            return redirect()->back();
        }
    }

    public function trashedAction(Request $request)
    {
        $request->validate([
            'items' => 'required'
        ]);
        if ($request->apply_comand_top == 1 || $request->apply_comand_bottom == 1) {
            foreach ($request->items["id"] as $id) {
                $this->restore($id);
            }
        } elseif ($request->apply_comand_top == 2 || $request->apply_comand_bottom == 2) {
            foreach ($request->items["id"] as $id) {
                $this->kill($id);
            }
            return redirect()->back();
        } else {
            Session::flash('error', "Something is wrong.Try again");
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function change_branch_get_unsold_product(Request $request)
    {
        $created_products =  array();
        foreach (Product::all() as $key => $value) {
            $created_products[$value->product_unique_id] = $value->product_unique_id;
        }
        $sold_products = array();
        foreach (Sell::withTrashed()->orderBy('id', 'asc')->get() as $key => $value) {
            $sold_products[$value->product_id] = $value->product_id;
        }
        $unsold_products = array_diff($created_products, $sold_products);
        $searching_products = array();
        foreach ($unsold_products as $key => $value) {
            $key_array = explode('-', $key);
            $branch_id = $key_array[0];
            if ($branch_id == $request->id) {
                $searching_products[$key] = $key;
            }
        }
        echo json_encode($searching_products);
    }
}
