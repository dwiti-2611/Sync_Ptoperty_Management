<?php

namespace App\Http\Controllers;

use App\ScheduleReceivable;
use Illuminate\Http\Request;

use App\ActualReceived;
use App\Product;
use App\Sell;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class ScheduleReceivableController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($sells_id)
    {
        $ScheduleReceivable = ScheduleReceivable::where('sells_id', $sells_id)->get();
        $ActualReceived = ActualReceived::where('sells_id', $sells_id)->get();
        $sell = Sell::with('customer', 'branch', 'product', 'employee')->findOrFail($sells_id);
        $total_payable_amount = 0;
        foreach ($ScheduleReceivable as $payable_amount) {
            $total_payable_amount += $payable_amount->payable_amount;
        }
        $total_actual_amount = 0;
        foreach ($ActualReceived as $actual_amount) {
            $total_actual_amount += $actual_amount->actual_amount;
        }
        $due_amount = $total_payable_amount - $total_actual_amount;
        $items = [
            'sell' => $sell,
            'ScheduleReceivable' => $ScheduleReceivable,
            'ActualReceived' => $ActualReceived,
            'due_amount' => $due_amount,
            'sells_id' => $sells_id,
        ];
        return view('admin.schedule-manage.index')->with('items', $items);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($sells_id)
    {
        return view('admin.schedule-manage.receivable-schedule.create', $this->get_terms())->with('sells_id', $sells_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $sells_id)
    {
        $request->validate([
            'term' => 'required|not_in:0',
            'payable_amount' => 'numeric|not_in:0',
            'schedule_date' => 'required',
        ]);
        $scheduleRecives = ScheduleReceivable::where('sells_id', $sells_id)->get();
        foreach ($scheduleRecives as $scheduleReceive) {
            $term = $scheduleReceive->term;
            if ($term == $request->term) {
                Session::flash('error', "This Term Already been taken. Try another one");
                return redirect()->back()->withInput($request->input());
            }
        }
        ScheduleReceivable::create([
            'sells_id' => $sells_id,
            'term' => $request->term,
            'payable_amount' => $request->payable_amount,
            'schedule_date' => $request->schedule_date,
            'created_by' => auth()->user()->email,
        ]);
        Session::flash('success', "Successfully  Create");
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ScheduleReceivable  $scheduleReceivable
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $sells_id)
    {
        $ScheduleItem = ScheduleReceivable::findOrFail($id);
        $infos = [
            'id' => $id,
            'sells_id' => $sells_id,
            'item' => $ScheduleItem,
        ];
        return view('admin.schedule-manage.receivable-schedule.edit', $this->get_terms())->with('infos', $infos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ScheduleReceivable  $scheduleReceivable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id, $sells_id)
    {

        $requestData = $request->validate([
            'term' => 'required|not_in:0',
            'payable_amount' => 'numeric|not_in:0',
            'schedule_date' => 'required',
        ]);

        $updateScheduleItem = ScheduleReceivable::findOrFail($id);
        if ($updateScheduleItem->term != $request->term) {
            $scheduleRecives = ScheduleReceivable::where('sells_id', $sells_id)->get();
            foreach ($scheduleRecives as $scheduleReceive) {
                $term = $scheduleReceive->term;
                if ($term == $request->term) {
                    Session::flash('error', "This Term Already been taken. Try another one");
                    return redirect()->back()->withInput($request->input());
                }
            }
        }

        $updateScheduleItem->term = $request->term;
        $updateScheduleItem->payable_amount = $request->payable_amount;
        $updateScheduleItem->schedule_date = $request->schedule_date;


        if (!$updateScheduleItem->isDirty()) {
            Session::flash('error', "Nothing Changes Happened !");
            return redirect()->back()->withInput($request->input());
        }

        $updateScheduleItem->save();

        Session::flash('success', "Successfully  Updated");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ScheduleReceivable  $scheduleReceivable
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $scheduleItems = ScheduleReceivable::findOrFail($id);

        $scheduleItems->delete();

        Session::flash('success', "Successfully  Deleted");
        return redirect()->back();
    }

    /**
     * This function return get all terms
     *
     * @author      Md. Al-Mahmud <mamun120520@gmail.com>
     * @version     1.0
     * @see         
     * @since       11/12/2022
     * Time         22:58:36
     * @param       
     * @return      
     */
    public function get_terms()
    {
        # code...   
        $data['terms'] = [
            'Booking Money' => 'Booking Money',
            'Down Payment' => 'Down Payment',
            'Additional Payment' => 'Additional Payment',
            'Utility Charge' => 'Utility Charge',
            'Other Charge' => 'Other Charge',
            '1st Installment' => '1st Installment',
            '2nd Installment' => '2nd Installment',
            '3rd Installment' => '3rd Installment',
            '4th Installment' => '4th Installment',
            '5th Installment' => '5th Installment',
            '6th Installment' => '6th Installment',
            '7th Installment' => '7th Installment',
            '8th Installment' => '8th Installment',
            '9th Installment' => '9th Installment',
            '10th Installment' => '10th Installment',
            '11th Installment' => '11th Installment',
            '12th Installment' => '12th Installment',
            '13th Installment' => '13th Installment',
            '14th Installment' => '14th Installment',
            '15th Installment' => '15th Installment',
            '16th Installment' => '16th Installment',
            '17th Installment' => '17th Installment',
            '18th Installment' => '18th Installment',
            '19th Installment' => '19th Installment',
            '20th Installment' => '20th Installment',
        ];
        return $data;
    }
    #end

}
