@extends('layouts.app')

@section('title')
    {{ __('root.schedule.schedule_manage') }}
@stop

@section('top-bar')
    @include('includes.top-bar')
@stop
@section('left-sidebar')
    @include('includes.left-sidebar')
@stop

@php
    $curency_symble = Helper::getCurrencyCode();
@endphp
@section('content')
    <section @if ($is_rtl) dir="rtl" @endif class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h3 class="text-center">{{ __('root.schedule.receivable_schedule_manage') }} (
                    <span data-toggle="tooltip" data-placement="top" title="{{ __('root.sell.project_name') }}">
                        {{ $items['sell']->branch->name }}
                    </span> ||
                    <span data-toggle="tooltip" data-placement="top" title="{{ __('root.sell.customer_name') }}">
                        {{ $items['sell']->customer->name }} </span> ||
                    <span data-toggle="tooltip" data-placement="top" title="{{ __('root.sell.product_id') }}">
                        {{ $items['sell']->product->product_unique_id }} </span> ||
                    <span data-toggle="tooltip" data-placement="top"
                        title="{{ __('root.sell.net_sells_price') }} ( {{ $curency_symble }} )">
                        {{ Helper::convertMoneyFormat($items['sell']->product->net_sells_price) }} </span>
                    )
                </h3>
            </div>
            <div class="row block-header">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="text-left">
                        <a class="btn btn-sm btn-info waves-effect"
                            href="{{ route('sell') }}">{{ __('root.common.back') }}</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="text-center">
                        @php
                            if ($items['due_amount'] > 0) {
                                $class = 'btn-danger';
                            } else {
                                $class = 'btn-success';
                            }
                        @endphp
                        <a class="btn btn-sm {{ $class }}  waves-effect font-weight-bold"> <b class="font-s-16">
                                {{ __('root.schedule.till_due_amount') }} :
                                {{ Helper::convertMoneyFormat($items['due_amount']) }}
                                ( {{ $curency_symble }} )</b></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="text-right">
                        <a class="btn btn-sm btn-info waves-effect"
                            href="{{ route('receivable_schedule.create', $items['sells_id']) }}">{{ __('root.schedule.add_schedule') }}</a>
                    </div>
                </div>
            </div>
            <!-- Hover Rows -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <table class="table table-striped table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">#</th>
                                    <th scope="col">{{ __('root.schedule.term') }}</th>
                                    <th scope="col">{{ __('root.schedule.payable_amount') }} ( {{ $curency_symble }} )
                                    </th>
                                    <th scope="col">{{ __('root.schedule.cumulative_receivable_amount') }} (
                                        {{ $curency_symble }} )</th>
                                    <th scope="col">{{ __('root.schedule.schedule_date') }}</th>
                                    <th scope="col">{{ __('root.schedule.options') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $id = 1;
                                    $comulative_payable_amount = 0;
                                @endphp
                                @if (count($items['ScheduleReceivable']) > 0)
                                    @foreach ($items['ScheduleReceivable'] as $ScheduleReceivable)
                                        @php
                                            $payable_amount = $ScheduleReceivable->payable_amount;
                                            $comulative_payable_amount += $payable_amount;
                                        @endphp
                                        <tr>
                                            <th class="text-center" scope="row">{{ $id }}</th>
                                            <td>{{ $ScheduleReceivable->term }}</td>
                                            <td>{{ Helper::convertMoneyFormat($ScheduleReceivable->payable_amount) }}
                                            </td>
                                            <td>{{ Helper::convertMoneyFormat($comulative_payable_amount) }} </td>
                                            <td>{{ date(config('settings.date_format'), strtotime($ScheduleReceivable->schedule_date)) }}
                                            </td>
                                            <td class="tdTrashAction text-center">
                                                <a class="btn btn-xs btn-info waves-effect m-b-4"
                                                    href="{{ route('receivable_schedule.edit', [$ScheduleReceivable->id, $items['sells_id']]) }}"
                                                    data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                        class="material-icons">mode_edit</i></a>
                                                <a onclick="return confirm('Are you sure you want to delete this item?');"
                                                    class="btn btn-xs btn-danger waves-effect m-b-4"
                                                    href="{{ route('receivable_schedule.destroy', $ScheduleReceivable->id) }}"
                                                    data-toggle="tooltip" data-placement="top" title="Trash"> <i
                                                        class="material-icons">delete</i></a>
                                            </td>
                                        </tr>
                                        @php
                                            $id++;
                                        @endphp
                                    @endforeach
                                @else
                                    <tr>
                                        <th colspan="6" class="text-danger text-center" scope="col">
                                            {{ __('root.common.no_data_found') }}</th>
                                    </tr>
                                @endif
                                <tr>
                                    <th class="text-center" scope="col">#</th>
                                    <th scope="col">{{ __('root.schedule.term') }}</th>
                                    <th scope="col">{{ __('root.schedule.payable_amount') }} ( {{ $curency_symble }} )
                                    </th>
                                    <th scope="col">{{ __('root.schedule.cumulative_receivable_amount') }} (
                                        {{ $curency_symble }} )</th>
                                    <th scope="col">{{ __('root.schedule.schedule_date') }}</th>
                                    <th scope="col">{{ __('root.schedule.options') }}</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="block-header">
                <h3 class="text-center">{{ __('root.schedule.actual_received_manage') }} (
                    <span data-toggle="tooltip" data-placement="top" title="{{ __('root.sell.project_name') }}">
                        {{ $items['sell']->branch->name }}
                    </span> ||
                    <span data-toggle="tooltip" data-placement="top" title="{{ __('root.sell.customer_name') }}">
                        {{ $items['sell']->customer->name }} </span> ||
                    <span data-toggle="tooltip" data-placement="top" title="{{ __('root.sell.product_id') }}">
                        {{ $items['sell']->product->product_unique_id }} </span> ||
                    <span data-toggle="tooltip" data-placement="top"
                        title="{{ __('root.sell.net_sells_price') }} ( {{ $curency_symble }} )">
                        {{ Helper::convertMoneyFormat($items['sell']->product->net_sells_price) }} </span>
                    )
                </h3>
            </div>
            <div class="block-header pull-left">
                <a class="btn btn-sm btn-info waves-effect" href="{{ route('sell') }}">{{ __('root.common.back') }}</a>
            </div>
            <div class="block-header pull-right">
                <a class="btn btn-sm btn-info waves-effect"
                    href="{{ route('actual_payment.create', $items['sells_id']) }}">{{ __('root.schedule.add_actual') }}
                </a>
            </div>
            <!-- Hover Rows -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <table class="table table-striped table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">#</th>
                                    <th scope="col">{{ __('root.schedule.term') }}</th>
                                    <th scope="col">{{ __('root.schedule.received_amount') }} ( {{ $curency_symble }} )
                                    </th>
                                    <th scope="col">{{ __('root.schedule.adjustment') }} ( {{ $curency_symble }} )</th>
                                    <th scope="col">{{ __('root.schedule.actual_amount') }} ( {{ $curency_symble }} )
                                    </th>
                                    <th scope="col">{{ __('root.schedule.date_of_collection') }}</th>
                                    <th scope="col">{{ __('root.schedule.made_of_payment') }}</th>
                                    <th scope="col">{{ __('root.schedule.cheque_no') }}</th>
                                    <th scope="col">{{ __('root.schedule.bank_name') }}</th>
                                    <th scope="col">{{ __('root.schedule.remark') }}</th>
                                    <th scope="col">{{ __('root.schedule.options') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $id = 1;
                                    $total_received_amount = 0;
                                    $total_adjustment = 0;
                                    $total_actual_amount = 0;
                                @endphp
                                @if (count($items['ActualReceived']) > 0)
                                    @foreach ($items['ActualReceived'] as $ScheduleReceivable)
                                        @php
                                            $total_received_amount += $ScheduleReceivable->received_amount;
                                            $total_adjustment += $ScheduleReceivable->adjustment;
                                            $total_actual_amount += $ScheduleReceivable->actual_amount;
                                        @endphp
                                        <tr>
                                            <th class="text-center" scope="row">{{ $id }}</th>
                                            <td>{{ $ScheduleReceivable->term }}</td>
                                            <td>{{ Helper::convertMoneyFormat($ScheduleReceivable->received_amount) }}
                                            </td>
                                            <td>{{ Helper::convertMoneyFormat($ScheduleReceivable->adjustment) }}
                                            </td>
                                            <td>{{ Helper::convertMoneyFormat($ScheduleReceivable->actual_amount) }}
                                            </td>
                                            <td>{{ date(config('settings.date_format'), strtotime($ScheduleReceivable->date_of_collection)) }}
                                            </td>
                                            <td>{{ $ScheduleReceivable->made_of_payment }}</td>
                                            <td>{{ $ScheduleReceivable->cheque_no }}</td>
                                            <td>{{ $ScheduleReceivable->bank_name }}</td>
                                            <td>{{ $ScheduleReceivable->remark }}</td>
                                            <td class="tdTrashAction text-center">
                                                <a class="btn btn-xs btn-info waves-effect m-b-4"
                                                    href="{{ route('actual_payment.edit', [$ScheduleReceivable->id, $items['sells_id']]) }}"
                                                    data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                        class="material-icons">mode_edit</i></a>
                                                <a onclick="return confirm('Are you sure you want to delete this item?');"
                                                    class="btn btn-xs btn-danger waves-effect m-b-4"
                                                    href="{{ route('actual_payment.destroy', $ScheduleReceivable->id) }}"
                                                    data-toggle="tooltip" data-placement="top" title="Trash"> <i
                                                        class="material-icons">delete</i></a>
                                            </td>
                                        </tr>
                                        @php
                                            $id++;
                                        @endphp
                                    @endforeach
                                    <tr class="font-bold">
                                        <td class="text-right" colspan="2"></td>
                                        <td>{{ Helper::convertMoneyFormat($total_received_amount) }}</td>
                                        <td>{{ Helper::convertMoneyFormat($total_adjustment) }}</td>
                                        <td>{{ Helper::convertMoneyFormat($total_actual_amount) }}</td>
                                        <td colspan="6"></td>
                                    </tr>
                                @else
                                    <tr class="font-bold">
                                        <td class="text-center text-danger" colspan="11">
                                            {{ __('root.common.no_data_found') }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <th class="text-center" scope="col">#</th>
                                    <th scope="col">{{ __('root.schedule.term') }}</th>
                                    <th scope="col">{{ __('root.schedule.received_amount') }} ( {{ $curency_symble }}
                                        )</th>
                                    <th scope="col">{{ __('root.schedule.adjustment') }} ( {{ $curency_symble }} )
                                    </th>
                                    <th scope="col">{{ __('root.schedule.actual_amount') }} ( {{ $curency_symble }} )
                                    </th>
                                    <th scope="col">{{ __('root.schedule.date_of_collection') }}</th>
                                    <th scope="col">{{ __('root.schedule.made_of_payment') }}</th>
                                    <th scope="col">{{ __('root.schedule.cheque_no') }}</th>
                                    <th scope="col">{{ __('root.schedule.bank_name') }}</th>
                                    <th scope="col">{{ __('root.schedule.remark') }}</th>
                                    <th scope="col">{{ __('root.schedule.options') }}</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@push('include-css')
    <!-- Multi Select Css -->
    <link href="{{ asset('asset/plugins/multi-select/css/multi-select.css') }}" rel="stylesheet">
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('asset/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endpush

@push('include-js')
    <script src="{{ asset('asset/plugins/autosize/autosize.js') }}"></script>
    <!-- Moment Plugin Js -->
    <script src="{{ asset('asset/plugins/momentjs/moment.js') }}"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="{{ asset('asset/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}">
    </script>
    <script src="{{ asset('asset/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('asset/js/pages/forms/basic-form-elements.js') }}"></script>
    <!-- Autosize Plugin Js -->
    <script>
        @if (Session::has('success'))
            toastr["success"]('{{ Session::get('success') }}');
        @endif
        @if (Session::has('error'))
            toastr["error"]('{{ Session::get('error') }}');
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr["error"]('{{ $error }}');
            @endforeach
        @endif
    </script>
    {{-- All datagrid --}}
    <script src="{{ asset('asset/js/dataTable.js') }}"></script>
    <script>
        BaseController.init();
    </script>
@endpush
