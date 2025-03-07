<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Product;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    //    Important properties
    public $parentModel = Product::class;
    public $parentRoute = 'product';
    public $parentView = "admin.product";

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
        if (Cache::get('total_products') && Cache::get('total_products') != null) {
            $data['total_products'] = Cache::get('total_products');
        } else {
            $data['total_products'] = $this->parentModel::count();
            Cache::put('total_products', $data['total_products']);
        }
        if (Cache::get('total_trashed_products') && Cache::get('total_trashed_products') != null) {
            $data['total_trashed_products'] = Cache::get('total_trashed_products');
        } else {
            $data['total_trashed_products'] = $this->parentModel::onlyTrashed()->count();
            Cache::put('total_trashed_products', $data['total_trashed_products']);
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
        Cache::forget('total_trashed_products');
        Cache::forget('total_products');
    }
    #end



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->parentModel::with('branch')->orderBy('created_at', 'desc')->paginate(60);
        return view($this->parentView . '.index', $this->get_count())->with('items', $items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['branches'] = Branch::orderBy('created_at', 'desc')->get();
        $data['flatTypes'] = [
            'A' => 'A',
            'B' => 'B',
            'C' => 'C',
            'D' => 'D',
            'E' => 'E',
            'G' => 'F',
            'H' => 'I',
            'J' => 'J',
            'K' => 'K',
        ];
        $data['floor_numbers'] = [
            '1st' => '1st',
            '2nd' => '2nd',
            '3rd' => '3rd',
            '4th' => '4th',
            '5th' => '5th',
            '6th' => '6th',
            '7th' => '7th',
            '8th' => '8th',
            '9th' => '9th',
            '10th' => '10th',
            '12th' => '12th',
            '13th' => '13th',
            '14th' => '14th',
            '15th' => '15th',
            '16th' => '16th',
            '17th' => '17th',
            '18th' => '18th',
            '19th' => '19th',
            '20th' => '20th',
        ];
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
        $request["product_unique_id"] = $request->branch_id . '-' . $request->flat_type . '-' . $request->floor_number;
        $request->validate([
            'branch_id' => 'required',
            'flat_type' => 'required',
            'floor_number' => 'required',
            'flat_size' => 'required',
            'unite_price' => 'required',
            'total_flat_price' => 'required',
            'net_sells_price' => 'required',
            'product_unique_id' => 'required|unique:products',
        ], [
            'product_unique_id.unique' => "Your product alreay exist. You should change project name, flat type or floor number."
        ]);
        if (!$request->total_flat_price == $request->flat_size * $request->unite_price) {
            Session::flash('error', "Total Flat Price Not equal to (Flat Size  X Unite Price)");
            return redirect()->back();
        }
        $netSallsPrice = $request->total_flat_price;
        if (!empty($request->car_parking_charge)) {
            $netSallsPrice += $request->car_parking_charge;
        }
        if (!empty($request->utility_charge)) {
            $netSallsPrice += $request->utility_charge;
        }
        if (!empty($request->additional_work_charge)) {
            $netSallsPrice += $request->additional_work_charge;
        }
        if (!empty($request->other_charge)) {
            $netSallsPrice += $request->other_charge;
        }
        if (!empty($request->discount_or_deduction)) {
            $netSallsPrice -= $request->discount_or_deduction;
        }
        if (!empty($request->refund_additional_work_charge)) {
            $netSallsPrice -= $request->refund_additional_work_charge;
        }
        if ($request->net_sells_price != $netSallsPrice) {
            Session::flash('error', "Net Sells Price Not Match");
            return redirect()->back();
        }
        $product_new_img = '';
        if ($request->hasFile('product_img')) {
            $product_img = $request->product_img;
            $temporaryName = time() . $product_img->getClientOriginalName();
            $product_img->move("upload/product/", $temporaryName);
            $product_new_img = 'upload/product/' . $temporaryName;
        }

        try {
            $this->parentModel::create([
                'product_unique_id' => $request->product_unique_id,
                'branch_id' => $request->branch_id,
                'flat_type' => $request->flat_type,
                'floor_number' => $request->floor_number,
                'flat_size' => $request->flat_size,
                'unite_price' => $request->unite_price,
                'total_flat_price' => $request->total_flat_price,
                'car_parking_charge' => $request->car_parking_charge,
                'utility_charge' => $request->utility_charge,
                'additional_work_charge' => $request->additional_work_charge,
                'other_charge' => $request->other_charge,
                'discount_or_deduction' => $request->discount_or_deduction,
                'refund_additional_work_charge' => $request->refund_additional_work_charge,
                'net_sells_price' => $request->net_sells_price,
                'product_img' => $product_new_img,
                'description' => $request->description,
                'create_by' => auth()->user()->email,
            ]);
            Session::flash('success', "Successfully  Create");
            return redirect()->back();
        } catch (\Exception $e) {
            if ($e->getCode() == 23000) {
                Session::flash('error', 'Your product alreay exist. You should change project name, flat type or floor number.');
            } else {
                Session::flash('error', $e->getMessage());
            }
            return redirect()->back()->withInput($request->all());
        }
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
        $data['item'] = $this->parentModel::find($id);
        $data['branches'] = Branch::orderBy('created_at', 'desc')->get();
        $data['flatTypes'] = [
            'A' => 'A',
            'B' => 'B',
            'C' => 'C',
            'D' => 'D',
            'E' => 'E',
            'G' => 'F',
            'H' => 'I',
            'J' => 'J',
            'K' => 'K',
        ];
        $data['floor_numbers'] = [
            '1st' => '1st',
            '2nd' => '2nd',
            '3rd' => '3rd',
            '4th' => '4th',
            '5th' => '5th',
            '6th' => '6th',
            '7th' => '7th',
            '8th' => '8th',
            '9th' => '9th',
            '10th' => '10th',
            '12th' => '12th',
            '13th' => '13th',
            '14th' => '14th',
            '15th' => '15th',
            '16th' => '16th',
            '17th' => '17th',
            '18th' => '18th',
            '19th' => '19th',
            '20th' => '20th',
        ];
        if (empty($data['item'])) {
            Session::flash('error', "Item not found");
            return redirect()->back();
        }
        return view($this->parentView . '.edit', $data);
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
            'flat_size' => 'required',
            'unite_price' => 'required',
            'total_flat_price' => 'required',
            'net_sells_price' => 'required'
        ]);
        if (!$request->total_flat_price == $request->flat_size * $request->unite_price) {
            Session::flash('error', "Total Flat Price Not equal to (Flat Size  X Unite Price)");
            return redirect()->back();
        }
        $netSallsPrice = $request->total_flat_price;
        if (!empty($request->car_parking_charge)) {
            $netSallsPrice += $request->car_parking_charge;
        }
        if (!empty($request->utility_charge)) {
            $netSallsPrice += $request->utility_charge;
        }
        if (!empty($request->additional_work_charge)) {
            $netSallsPrice += $request->additional_work_charge;
        }
        if (!empty($request->other_charge)) {
            $netSallsPrice += $request->other_charge;
        }
        if (!empty($request->discount_or_deduction)) {
            $netSallsPrice -= $request->discount_or_deduction;
        }
        if (!empty($request->refund_additional_work_charge)) {
            $netSallsPrice -= $request->refund_additional_work_charge;
        }
        if ($request->net_sells_price != $netSallsPrice) {
            Session::flash('error', "Net Sells Price Not Match");
            return redirect()->back();
        }
        $items = $this->parentModel::find($id);
        $product_new_img = '';
        if ($request->hasFile('product_img')) {
            if (!empty($items->product_img)) {
                unlink($items->product_img); // Delete previous image file
            }
            $product_img = $request->product_img;
            $temporaryName = time() . $product_img->getClientOriginalName();
            $product_img->move("upload/product/", $temporaryName);
            $product_new_img = 'upload/product/' . $temporaryName;
        }
        $items->flat_size = $request->flat_size;
        $items->unite_price = $request->unite_price;
        $items->total_flat_price = $request->total_flat_price;
        $items->car_parking_charge = $request->car_parking_charge;
        $items->utility_charge = $request->utility_charge;
        $items->additional_work_charge = $request->additional_work_charge;
        $items->other_charge = $request->other_charge;
        $items->discount_or_deduction = $request->discount_or_deduction;
        $items->refund_additional_work_charge = $request->refund_additional_work_charge;
        $items->net_sells_price = $request->net_sells_price;
        $items->description = $request->description;
        $items->updated_by = auth()->user()->email;

        try {
            $items->save();
            Session::flash('success', "Update Successfully");
            return redirect()->route($this->parentRoute);
        } catch (\Exception $e) {
            dd($e);
            Session::flash('error', $e->getMessage());
            return redirect()->route($this->parentRoute);
        }
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
            'module_name' => 'Product Manage'
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
        $items = $this->parentModel::with('sell')->find($id);
        if ($items->sell != null && $items->sell->count() > 0) {
            Session::flash('error', "You can not delete it. Because it has some item");
            return redirect()->back();
        }
        $items->deleted_by = auth()->user()->email;
        $items->save();
        $items->delete();
        // forget count
        $this->forget_count();
        Session::flash('success', "Successfully Trashed");
        return redirect()->back();
    }

    public function trashed()
    {
        $items = $this->parentModel::with('branch')->onlyTrashed()->paginate(60);
        return view($this->parentView . '.trashed', $this->get_count())->with("items", $items);
    }
    public function restore($id)
    {
        $items = $this->parentModel::onlyTrashed()->where('id', $id)->first();
        $items->restore();
        // forget count
        $this->forget_count();
        Session::flash('success', 'Successfully Restore');
        return redirect()->back();
    }

    public function kill($id)
    {
        $item = $this->parentModel::withTrashed()->with('sell')->where('id', $id)->first();
        if ($item->sell != null && $item->sell->count() > 0) {
            Session::flash('error', "You can not delete it. Because it already Sold");
            return redirect()->back();
        }
        $item->forceDelete();
        Session::flash('success', 'Permanently Delete');
        // forget count
        $this->forget_count();
        return redirect()->back();
    }

    public function activeSearch(Request $request)
    {
        $request->validate([
            'search' => 'min:1'
        ]);
        $search = $request["search"];
        $items = $this->parentModel::where('flat_type', 'like', '%' . $search . '%')
            ->orWhereHas('branch', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orWhere('product_unique_id', 'like', '%' . $search . '%')
            ->orWhere('floor_number', 'like', '%' . $search . '%')
            ->orWhere('flat_size', 'like', '%' . $search . '%')
            ->orWhere('unite_price', 'like', '%' . $search . '%')
            ->orWhere('total_flat_price', 'like', '%' . $search . '%')
            ->orWhere('car_parking_charge', 'like', '%' . $search . '%')
            ->orWhere('utility_charge', 'like', '%' . $search . '%')
            ->orWhere('additional_work_charge', 'like', '%' . $search . '%')
            ->orWhere('other_charge', 'like', '%' . $search . '%')
            ->orWhere('discount_or_deduction', 'like', '%' . $search . '%')
            ->orWhere('refund_additional_work_charge', 'like', '%' . $search . '%')
            ->orWhere('net_sells_price', 'like', '%' . $search . '%')
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
        $items = $this->parentModel::where('flat_type', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->orWhereHas('branch', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->onlyTrashed()
            ->orWhere('product_unique_id', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->orWhere('floor_number', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->orWhere('flat_size', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->orWhere('unite_price', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->orWhere('total_flat_price', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->orWhere('car_parking_charge', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->orWhere('utility_charge', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->orWhere('additional_work_charge', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->orWhere('other_charge', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->orWhere('discount_or_deduction', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->orWhere('refund_additional_work_charge', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->orWhere('net_sells_price', 'like', '%' . $search . '%')
            ->onlyTrashed()
            ->orWhere('description', 'like', '%' . $search . '%')
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
}
