@extends('layouts.pdf')
@push('include-css')
    <link rel="stylesheet" href="{{ asset('asset/css/main-report.css') }}">
    <style>
        body {
            font-size: 14px !important;
        }
    </style>
@endpush
@section('title')
    {{ $extra['module_name'] }}
@endsection
@section('content')
    <div class="mid">
        <table class="table table-striped table-bordered table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Seller Name</th>
                    <th scope="col">Selles Date</th>
                    <th scope="col">Project Name</th>
                    <th scope="col">Product No</th>
                    <th class="text-right" scope="col">Apartment Value</th>
                    <th class="text-right" scope="col">Car Parking Charge</th>
                    <th class="text-right" scope="col">Uitility Charge</th>
                    <th class="text-right" scope="col">Additional Work Charge</th>
                    <th class="text-right" scope="col">Other Charge</th>
                    <th class="text-right" scope="col">Discount</th>
                    <th class="text-right" scope="col">Refund Additional Work Charge </th>
                    <th class="text-right" scope="col">Total</th>
                    <th class="text-right" scope="col">Total Collection</th>
                    <th class="text-right" scope="col">Total Due</th>
                    <th class="text-right" scope="col">Collection ( % )</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $sl = 1;
                    $total_flat_price = 0;
                    $total_car_parking_charge = 0;
                    $total_utility_charge = 0;
                    $total_additional_work_charge = 0;
                    $total_other_charge = 0;
                    $total_discount_or_deduction = 0;
                    $total_refund_additional_work_charge = 0;
                    $total_net_sells_price = 0;
                    $total_collection1 = 0;
                    $total_due = 0;
                @endphp

                @foreach ($infos['items'] as $key => $item)
                    @php
                        $net_sell_price = $item->net_sells_price;
                        $total_collection = $infos['total_collection'][$key];
                        $due = $net_sell_price - $total_collection;
                        
                        if ($total_collection == 0) {
                            $collection_percentage = 0;
                        } else {
                            $collection_percentage = ($total_collection / $net_sell_price) * 100;
                        }
                        $total_flat_price += $item->total_flat_price;
                        $total_car_parking_charge += $item->car_parking_charge;
                        $total_utility_charge += $item->utility_charge;
                        $total_additional_work_charge += $item->additional_work_charge;
                        $total_other_charge += $item->other_charge;
                        $total_discount_or_deduction += $item->discount_or_deduction;
                        $total_refund_additional_work_charge += $item->refund_additional_work_charge;
                        $total_net_sells_price += $item->net_sells_price;
                        $total_collection1 += $infos['total_collection'][$key];
                        $total_due += $due;
                    @endphp
                    <tr>
                        <td>{{ $sl }}</td>
                        <td> {{ $item->customer_name }} </td>
                        <td> {{ $item->employee_name }} </td>
                        <td> {{ Helper::dateFormat($item->sells_date) }} </td>
                        <td> {{ $item->branch_name }} </td>
                        <td> {{ $item->product_unique_id }} </td>
                        <td class="text-right"> {{ Helper::convertMoneyFormat($item->total_flat_price) }} </td>
                        <td class="text-right"> {{ Helper::convertMoneyFormat($item->car_parking_charge) }} </td>
                        <td class="text-right"> {{ Helper::convertMoneyFormat($item->utility_charge) }} </td>
                        <td class="text-right"> {{ Helper::convertMoneyFormat($item->additional_work_charge) }} </td>
                        <td class="text-right"> {{ Helper::convertMoneyFormat($item->other_charge) }} </td>
                        <td class="text-right"> {{ Helper::convertMoneyFormat($item->discount_or_deduction) }} </td>
                        <td class="text-right"> {{ Helper::convertMoneyFormat($item->refund_additional_work_charge) }}
                        </td>
                        <td class="text-right"> {{ Helper::convertMoneyFormat($item->net_sells_price) }} </td>
                        <td class="text-right"> {{ Helper::convertMoneyFormat($infos['total_collection'][$key]) }} </td>
                        <td class="text-right"> {{ Helper::convertMoneyFormat($due) }} </td>
                        <td class="text-right"> {{ Helper::convertMoneyFormat($collection_percentage) }} % </td>
                    </tr>
                    @php
                        $sl++;
                    @endphp
                @endforeach
                <tr class="font-w-b">
                    <td class="text-right" colspan="6">Total</td>
                    <td class="text-right"> {{ Helper::convertMoneyFormat($total_flat_price) }} </td>
                    <td class="text-right"> {{ Helper::convertMoneyFormat($total_car_parking_charge) }} </td>
                    <td class="text-right"> {{ Helper::convertMoneyFormat($total_utility_charge) }} </td>
                    <td class="text-right"> {{ Helper::convertMoneyFormat($total_additional_work_charge) }} </td>
                    <td class="text-right"> {{ Helper::convertMoneyFormat($total_other_charge) }} </td>
                    <td class="text-right"> {{ Helper::convertMoneyFormat($total_discount_or_deduction) }} </td>
                    <td class="text-right"> {{ Helper::convertMoneyFormat($total_refund_additional_work_charge) }} </td>
                    <td class="text-right"> {{ Helper::convertMoneyFormat($total_net_sells_price) }} </td>
                    <td class="text-right"> {{ Helper::convertMoneyFormat($total_collection1) }} </td>
                    <td class="text-right"> {{ Helper::convertMoneyFormat($total_due) }} </td>
                    <td class="text-right"> </td>
                </tr>
            </tbody>
        </table>
    </div>
@stop
