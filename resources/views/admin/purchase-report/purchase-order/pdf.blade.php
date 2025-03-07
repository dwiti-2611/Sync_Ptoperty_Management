@extends('layouts.pdf')
@push('include-css')
    <link rel="stylesheet" href="{{ asset('asset/css/main-report.css') }}">
    <style>
        body{
            font-size: 11px !important;
        }
    </style>
@endpush
@section('title')
    {{ config('settings.company_name') }} -> {{ $extra['module_name'] }}
@endsection
@section('content')
    <div class="mid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                <br>
                <h3 class="text-center company-name">{{ config('settings.company_name') }}</h3>
                <h6 class="text-center">{{ config('settings.address_1') }}</h6>
                <br>
                <h4 class="text-center">{{ $extra['voucher_type'] }}</h4>
                <hr>
            </div>
        </div>
    </div>
    <div class="mid">
        @foreach ($branches as $branch)
            <table class="table  table-bordered table-sm">
                <thead>
                    <tr>
                        <th colspan="8" class="text-center">
                            <h4>{{ App\Branch::find($branch)->name }}</h4>
                        </th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th scope="col">Purchase Id</th>
                        <th scope="col">Requisition Id</th>
                        <th scope="col">Vendor name</th>
                        <th scope="col">Media Name</th>
                        <th scope="col">Issuing Date</th>
                        <th scope="col">Date of Delevery</th>
                        <th scope="col" class="text-center">Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $index = 1; ?>
                    @foreach ($infos as $info)
                        @if ($info->branch_id == $branch)
                            <tr>
                                <td>{{ $index }}</td>
                                <td>{{ $info->purchase_id }}</td>
                                <td>{{ $info->requisition_id }}</td>
                                <td>{{ $info->vendor->name }}</td>
                                <td>{{ $info->media_name }}</td>
                                <td>{{ Helper::dateFormat($info->issuing_date) }}</td>
                                <td>{{ Helper::dateFormat($info->date_of_delevery) }}</td>
                                <td>
                                    <table class="table table-striped table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th class="width-250">Items</th>
                                                <th class="text-right width-70">Qnt</th>
                                                <th class="text-right width-70">Rate</th>
                                                <th class="text-right width-100">Total ( {{ Helper::getCurrencyCode() }} )
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($info->formatedItem as $item)
                                                <tr>
                                                    <td>{{ $item->income_expense_head_name }}</td>
                                                    <td class="text-right">{{ $item->qntity }}</td>
                                                    <td class="text-right">{{ Helper::convertMoneyFormat($item->rate) }}
                                                    </td>
                                                    <td class="text-right">{{ Helper::convertMoneyFormat($item->amount) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <th class="text-right" colspan="3">Total Amount =</th>
                                                <th class="text-right">
                                                    {{ Helper::convertMoneyFormat($info->totalAmount) }}</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <?php $index++; ?>
                        @endif
                    @endforeach
                </tbody>
            </table>
        @endforeach
    </div>
@stop
