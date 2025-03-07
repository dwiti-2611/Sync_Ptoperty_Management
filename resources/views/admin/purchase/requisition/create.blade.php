@extends('layouts.app')

<?php

$moduleName = __('root.purchase_requisition.purchase_requisition_manage');
$createItemName = __('root.common.create') . ' ' . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = __('root.common.create');

$breadcrumbMainIcon = 'fas fa-shopping-cart';
$breadcrumbCurrentIcon = 'archive';

$ModelName = 'App\PurchaseRequisition';
$ParentRouteName = 'purchase_requisition';

?>

@section('title')
    {{ $moduleName }}->{{ $createItemName }}
@stop

@section('top-bar')
    @include('includes.top-bar')
@stop
@section('left-sidebar')
    @include('includes.left-sidebar')
@stop
@section('content')
    <section @if ($is_rtl) dir="rtl" @endif class="content">
        <div class="container-fluid">
            <div class="block-header @if ($is_rtl) pull-right @else pull-left @endif">
                <a class="btn btn-sm btn-info waves-effect" href="{{ url()->previous() }}">{{ __('root.common.back') }}</a>
            </div>
            <ol class="breadcrumb breadcrumb-col-cyan @if ($is_rtl) pull-left  @else pull-right @endif">
                <li><a href="{{ route($ParentRouteName) }}"><i class="material-icons">home</i>
                        {{ __('root.common.home') }}</a></li>
                <li><a href="{{ route($ParentRouteName) }}"><i class="{{ $breadcrumbMainIcon }}"></i>
                        &nbsp;{{ $breadcrumbMainName }}</a>
                </li>
                <li class="active"><i class="material-icons">{{ $breadcrumbCurrentIcon }}</i>&nbsp;
                    {{ $breadcrumbCurrentName }}
                </li>
            </ol> <!-- Inline Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                {{ $createItemName }}
                                <small>Put {{ $moduleName }} Information</small>
                            </h2>
                            <div class="body">
                                <form class="form" id="form_validation" method="post"
                                    action="{{ route($ParentRouteName . '.store') }}">
                                    {{ csrf_field() }}
                                    <div class="row clearfix">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 field_area">
                                            <div class="form-group form-float">
                                                <label class="form-label">Project Name <span
                                                        class="text-danger">*</span></label>
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control show-tick"
                                                        name="branch_id">
                                                        <option value="0">Select Project Name</option>
                                                        @foreach ($branches as $branch)
                                                            <option @if ($branch->id == old('branch_id')) selected @endif
                                                                value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 field_area">
                                            <div class="form-group form-float">
                                                <label class="form-label">Employee Name <span
                                                        class="text-danger">*</span></label>
                                                <div class="form-line">
                                                    <select data-live-search="true" class="form-control show-tick"
                                                        name="employee_id">
                                                        <option value="0">Select Employee Name</option>
                                                        @foreach ($employees as $employee)
                                                            <option @if ($employee->id == old('employee_id')) selected @endif
                                                                value="{{ $employee->id }}">{{ $employee->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 field_area">
                                            <div class="form-group form-float">
                                                <label class="form-label">Requisition Date <span
                                                        class="text-danger">*</span></label>
                                                <div class="form-line" id="bs_datepicker_container">
                                                    <input autocomplete="off" value="{{ old('requisition_date') }}"
                                                        name="requisition_date" type="text" class="form-control"
                                                        placeholder=" Requisition Date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 field_area">
                                            <div class="form-group form-float">
                                                <label class="form-label">Order Date <span
                                                        class="text-danger">*</span></label>
                                                <div class="form-line" id="bs_datepicker_container">
                                                    <input autocomplete="off" value="{{ old('required_date') }}"
                                                        name="required_date" type="text" class="form-control"
                                                        placeholder=" Required Date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 field_area">
                                            <div class="form-group form-float">
                                                <label class="form-label">Contract Person<span
                                                        class="text-danger"></span></label>
                                                <div class="form-line">
                                                    <input placeholder="Contract Person" autocomplete="off"
                                                        value="{{ old('contract_person') }}" name="contract_person"
                                                        type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <textarea class="form-control" name="comment" id="">{{ old('comment') }}</textarea>
                                                    <label class="form-label">Remark</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <textarea class="form-control" name="purpose" id="">{{ old('purpose') }}</textarea>
                                                    <label class="form-label">Purpose</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="card">
                                                <div class="header">
                                                    <h4>Requisition Items</h4>
                                                </div>
                                                <div id="items" class="body">
                                                    <br>
                                                    <div class="row dr">
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <select data-live-search="true"
                                                                        class="form-control show-tick income_expense_head_id"
                                                                        name="income_expense_head_id[]" id="">
                                                                        <option value="0"> Select Item Name *</option>
                                                                        @foreach ($income_expense_heads as $HeadOfAccount)
                                                                            <option
                                                                                @if ($HeadOfAccount->id == old('income_expense_head_id')) selected @endif
                                                                                value="{{ $HeadOfAccount->id }}">
                                                                                {{ $HeadOfAccount->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="description[]" type="text"
                                                                        class="form-control amount">
                                                                    <label class="form-label">Description </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="qntity[]" type="number"
                                                                        class="form-control amount">
                                                                    <label class="form-label">Qntity </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="rate[]" type="number"
                                                                        class="form-control amount">
                                                                    <label class="form-label">Rate </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input readonly name="amount[]" type="number"
                                                                        class="form-control amount">
                                                                    <label class="form-label">Amount </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-3 field_area">
                                                            <div class="form-group form-float">
                                                                <i
                                                                    class="pointer-cursor  material-icons text-success plus">add_circle_outline</i>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row dr">
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <select data-live-search="true"
                                                                        class="form-control show-tick income_expense_head_id"
                                                                        name="income_expense_head_id[]" id="">
                                                                        <option value="0"> Select Item Name *</option>
                                                                        @foreach ($income_expense_heads as $HeadOfAccount)
                                                                            <option
                                                                                @if ($HeadOfAccount->id == old('income_expense_head_id')) selected @endif
                                                                                value="{{ $HeadOfAccount->id }}">
                                                                                {{ $HeadOfAccount->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="description[]" type="text"
                                                                        class="form-control amount">
                                                                    <label class="form-label">Description </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="qntity[]" type="number"
                                                                        class="form-control amount">
                                                                    <label class="form-label">Qntity </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="rate[]" type="number"
                                                                        class="form-control amount">
                                                                    <label class="form-label">Rate </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input readonly name="amount[]" type="number"
                                                                        class="form-control amount">
                                                                    <label class="form-label">Amount </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-3 field_area">
                                                            <div class="form-group form-float">
                                                                <i
                                                                    class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                                <i
                                                                    class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row dr">
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <select data-live-search="true"
                                                                        class="form-control show-tick income_expense_head_id"
                                                                        name="income_expense_head_id[]" id="">
                                                                        <option value="0">Select Item Name</option>
                                                                        @foreach ($income_expense_heads as $HeadOfAccount)
                                                                            <option
                                                                                @if ($HeadOfAccount->id == old('income_expense_head_id')) selected @endif
                                                                                value="{{ $HeadOfAccount->id }}">
                                                                                {{ $HeadOfAccount->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="description[]" type="text"
                                                                        class="form-control amount">
                                                                    <label class="form-label">Description </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="qntity[]" type="number"
                                                                        class="form-control amount">
                                                                    <label class="form-label">Qntity </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="rate[]" type="number"
                                                                        class="form-control amount">
                                                                    <label class="form-label">Rate </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input readonly name="amount[]" type="number"
                                                                        class="form-control amount">
                                                                    <label class="form-label">Amount </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-3 field_area">
                                                            <div class="form-group form-float">
                                                                <i
                                                                    class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                                <i
                                                                    class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row dr">
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <select data-live-search="true"
                                                                        class="form-control show-tick income_expense_head_id"
                                                                        name="income_expense_head_id[]" id="">
                                                                        <option value="0"> Select Item Name *</option>
                                                                        @foreach ($income_expense_heads as $HeadOfAccount)
                                                                            <option
                                                                                @if ($HeadOfAccount->id == old('income_expense_head_id')) selected @endif
                                                                                value="{{ $HeadOfAccount->id }}">
                                                                                {{ $HeadOfAccount->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="description[]" type="text"
                                                                        class="form-control amount">
                                                                    <label class="form-label">Description </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="qntity[]" type="number"
                                                                        class="form-control amount">
                                                                    <label class="form-label">Qntity </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="rate[]" type="number"
                                                                        class="form-control amount">
                                                                    <label class="form-label">Rate </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input readonly name="amount[]" type="number"
                                                                        class="form-control amount">
                                                                    <label class="form-label">Amount </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-3 field_area">
                                                            <div class="form-group form-float">
                                                                <i
                                                                    class="pointer-cursor material-icons text-success plus">add_circle_outline</i>
                                                                <i
                                                                    class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row dr">
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <select data-live-search="true"
                                                                        class="form-control show-tick income_expense_head_id"
                                                                        name="income_expense_head_id[]" id="">
                                                                        <option value="0"> Select Item Name *</option>
                                                                        @foreach ($income_expense_heads as $HeadOfAccount)
                                                                            <option
                                                                                @if ($HeadOfAccount->id == old('income_expense_head_id')) selected @endif
                                                                                value="{{ $HeadOfAccount->id }}">
                                                                                {{ $HeadOfAccount->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="description[]" type="text"
                                                                        class="form-control amount">
                                                                    <label class="form-label">Description </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="qntity[]" type="number"
                                                                        class="form-control amount">
                                                                    <label class="form-label">Qntity </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input name="rate[]" type="number"
                                                                        class="form-control amount">
                                                                    <label class="form-label">Rate </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6 field_area">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input readonly name="amount[]" type="number"
                                                                        class="form-control amount">
                                                                    <label class="form-label">Amount </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-3 field_area">
                                                            <div class="form-group form-float">
                                                                <i
                                                                    class="pointer-cursor material-icons text-danger minus">remove_circle_outline</i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-1 field_area border-1">
                                                    </div>
                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">
                                                    </div>
                                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-7 field_area">
                                                        <h3 class="text-right">Total Amount</h3>
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 field_area">
                                                        <h3 id="totaRequisitionlAmount">0</h3>
                                                    </div>
                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 field_area">
                                                        <input id="total_requisition_amount" type="hidden"
                                                            name="total_requisition_amount">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-line">
                                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">
                                                    {{ __('root.common.save') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Inline Layout | With Floating Label -->
            </div>
        </div>
    </section>
@stop

@push('include-css')
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('asset/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="{{ asset('asset/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}"
        rel="stylesheet" />
    <!-- Bootstrap DatePicker Css -->
    <link href="{{ asset('asset/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
@endpush

@push('include-js')
    <!-- Moment Plugin Js -->
    <script src="{{ asset('asset/plugins/momentjs/moment.js') }}"></script>
    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="{{ asset('asset/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}">
    </script>
    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="{{ asset('asset/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <!-- Autosize Plugin Js -->
    <script src="{{ asset('asset/plugins/autosize/autosize.js') }}"></script>
    <script src="{{ asset('asset/js/pages/forms/basic-form-elements.js') }}"></script>
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
        // Validation and calculation on Cr Voucher
        var UiController = (function() {
            var DOMString = {
                submit_form: 'form.form',
                field_area: '.field_area',
                project_id: 'select[name=branch_id]',
                employee_id: 'select[name=employee_id]',
                requisition_date: 'input[name=requisition_date]',
                required_date: 'input[name=required_date]',
                head_of_account_id: '.income_expense_head_id',
                amount: '.amount',
                drCloset: '.dr',
                dr: 'dr',
                plus: 'plus',
                minus: 'minus',
                totaRequisitionlAmount: 'totaRequisitionlAmount',
                total_requisition_amount: 'total_requisition_amount',
            };

            return {
                getDOMString: function() {
                    return DOMString;
                },
                getFields: function() {
                    return {
                        get_form: document.querySelector(DOMString.submit_form),
                        get_project_id: document.querySelector(DOMString.project_id),
                        get_employee_id: document.querySelector(DOMString.employee_id),
                        get_requisition_date: document.querySelector(DOMString.requisition_date),
                        get_required_date: document.querySelector(DOMString.required_date),
                        get_head_of_account_id: document.querySelectorAll(DOMString.head_of_account_id),
                        get_amount: document.querySelectorAll(DOMString.amount),
                        get_dr: document.getElementsByClassName(DOMString.dr),
                        get_plus: document.getElementsByClassName(DOMString.plus),
                        get_minus: document.getElementsByClassName(DOMString.minus),
                        get_totaRequisitionlAmount: document.getElementById(DOMString.totaRequisitionlAmount),
                        get_total_requisition_amount: document.getElementById(DOMString
                            .total_requisition_amount),
                    }
                },
                getValues: function() {
                    var Fields = this.getFields();
                    return {
                        project_id: Fields.get_project_id.value == "" ? 0 : parseFloat(Fields.get_project_id
                            .value),
                        employee_id: Fields.get_employee_id.value == "" ? 0 : parseFloat(Fields.get_employee_id
                            .value),

                        requisition_date: Fields.get_requisition_date.value == "" ? 0 : Fields
                            .get_requisition_date.value,
                        required_date: Fields.get_required_date.value == "" ? 0 : Fields.get_required_date
                            .value,
                    }
                },

                hide: function(Field) {
                    var DomString = this.getDOMString();
                    var Area = Field.closest(DomString.field_area);
                    if (Area) {
                        Field.value = null;
                        Area.style.display = 'none';
                    }
                },
                show: function(Field) {
                    var DomString = this.getDOMString();
                    var Area = Field.closest(DomString.field_area);
                    if (Area) {
                        Area.style.display = 'block';
                    }
                },
                hideHeadAmountArea: function(Field) {
                    Field.querySelector('select').value = 0;
                    if (Field) {
                        Field.style.display = 'none';
                    }
                },
                showHeadAmountArea: function(Field) {
                    var DomString = this.getDOMString();
                    Field.querySelector('select').value = 0;
                    Field.querySelector(DomString.amount).value = "";
                    if (Field) {
                        Field.style.display = 'block';
                    }
                },
            }
        })();

        var MainController = (function(UICnt) {
            var DOMString = UICnt.getDOMString();
            var Fields = UICnt.getFields();
            var setUpEventListner = function() {
                Fields.get_form.addEventListener('submit', validation);
                Array.prototype.forEach.call(Fields.get_plus, function(plus, index) {
                    plus.addEventListener('click', function() {
                        addItem(index);
                    }, false);
                });
                Array.prototype.forEach.call(Fields.get_minus, function(minus, index) {
                    minus.addEventListener('click', function() {
                        removeItem(index);
                    }, false);
                });
                Array.prototype.forEach.call(Fields.get_dr, function(dr, index) {
                    var qntity = dr.children[2].querySelector('input');
                    var rate = dr.children[3].querySelector('input');
                    var amount = dr.children[4].querySelector('input');
                    qntity.addEventListener('keyup', function() {
                        calculationAmount(qntity, rate, amount);
                    }, false);
                    rate.addEventListener('keyup', function() {
                        calculationAmount(qntity, rate, amount);
                    }, false);
                });
            };

            var calculationAmount = function(qntity, rate, amount) {
                var qntAmount = (qntity.value == "") ? 0 : parseFloat(qntity.value);
                var rateAmount = (rate.value == "") ? 0 : parseFloat(rate.value);
                var totalAmount = qntAmount * rateAmount;
                amount.value = totalAmount == "" ? 0 : totalAmount;
                amount.style.fontWeight = 'bold';
                amount.style.fontSize = '18px';
                amount.nextElementSibling.style.display = 'none';
                sumRateQntAmount();
            }
            var sumRateQntAmount = function() {
                var totalQnt = 0;
                var totalRate = 0;
                var totalAmount = 0;
                Array.prototype.forEach.call(Fields.get_dr, function(dr, index) {
                    var qntity = dr.children[2].querySelector('input');
                    var rate = dr.children[3].querySelector('input');
                    var amount = dr.children[4].querySelector('input');
                    totalQnt += qntity.value == "" ? 0 : parseFloat(qntity.value);
                    totalRate += rate.value == "" ? 0 : parseFloat(rate.value);
                    totalAmount += amount.value == "" ? 0 : parseFloat(amount.value);
                });
                Fields.get_totaRequisitionlAmount.innerText = totalAmount;
                Fields.get_total_requisition_amount.value = totalAmount;
            }
            var validation = function(e) {
                var Values, Fields;
                Values = UICnt.getValues();
                Fields = UICnt.getFields();
                if (Fields.get_head_of_account_id[0].querySelector('select').value == 0) {
                    toastr["error"]('Select Item Name');
                    e.preventDefault();
                }
                if (Fields.get_amount[3].value == '' || Fields.get_amount[3].value == 0) {
                    toastr["error"]('Put Amount');
                    e.preventDefault();
                }
                if (Values.date == 0) {
                    toastr["error"]('Set Date');
                    e.preventDefault();
                }
                if (Fields.get_dr[1].style.display == 'block') {
                    if (Fields.get_head_of_account_id[2].querySelector('select').value == 0) {
                        toastr["error"]('Select Item Name');
                        e.preventDefault();
                    }
                    if (Fields.get_amount[7].value == '' || Fields.get_amount[7].value == 0) {
                        toastr["error"]('Put Amount ');
                        e.preventDefault();
                    }
                }
                if (Fields.get_dr[2].style.display == 'block') {
                    if (Fields.get_head_of_account_id[4].querySelector('select').value == 0) {
                        toastr["error"]('Select Item Name');
                        e.preventDefault();
                    }
                    if (Fields.get_amount[11].value == '' || Fields.get_amount[11].value == 0) {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }
                if (Fields.get_dr[3].style.display == 'block') {
                    if (Fields.get_head_of_account_id[6].querySelector('select').value == 0) {
                        toastr["error"]('Select Item Name');
                        e.preventDefault();
                    }
                    if (Fields.get_amount[15].value == '' || Fields.get_amount[15].value == 0) {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }
                if (Fields.get_dr[4].style.display == 'block') {
                    if (Fields.get_head_of_account_id[8].querySelector('select').value == 0) {
                        toastr["error"]('Select Head Of Account');
                        e.preventDefault();
                    }
                    if (Fields.get_amount[19].value == '' || Fields.get_amount[19].value == 0) {
                        toastr["error"]('Put Amount');
                        e.preventDefault();
                    }
                }

                var head_of_account_Ids = [];
                var get_head_of_account_id_one = Fields.get_head_of_account_id[0].querySelector('select')
                    .value == "" ? 0 : parseFloat(Fields.get_head_of_account_id[0].querySelector('select')
                        .value);
                var get_head_of_account_id_two = Fields.get_head_of_account_id[2].querySelector('select')
                    .value == "" ? 0 : parseFloat(Fields.get_head_of_account_id[2].querySelector('select')
                        .value);
                var get_head_of_account_id_three = Fields.get_head_of_account_id[4].querySelector('select')
                    .value == "" ? 0 : parseFloat(Fields.get_head_of_account_id[4].querySelector('select')
                        .value);
                var get_head_of_account_id_four = Fields.get_head_of_account_id[6].querySelector('select')
                    .value == "" ? 0 : parseFloat(Fields.get_head_of_account_id[6].querySelector('select')
                        .value);
                var get_head_of_account_id_five = Fields.get_head_of_account_id[8].querySelector('select')
                    .value ==
                    "" ? 0 : parseFloat(Fields.get_head_of_account_id[8].querySelector('select').value);

                if (get_head_of_account_id_one > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_one);
                }
                if (get_head_of_account_id_two > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_two);
                }
                if (get_head_of_account_id_three > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_three);
                }
                if (get_head_of_account_id_four > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_four);
                }
                if (get_head_of_account_id_five > 0) {
                    head_of_account_Ids.push(get_head_of_account_id_five);
                }

                function checkUniqueOrNot(head_of_account_Ids) {
                    var counts = [];
                    for (var i = 0; i <= head_of_account_Ids.length; i++) {
                        if (counts[head_of_account_Ids[i]] === undefined) {
                            counts[head_of_account_Ids[i]] = 1;
                        } else {
                            return true;
                        }
                    }
                    return false;
                }
                if (checkUniqueOrNot(head_of_account_Ids)) {
                    toastr["error"]('Requisition item should unique');
                    e.preventDefault();
                }
                if (Values.requisition_date == 0) {
                    toastr["error"]('Requisition Date is Required');
                    e.preventDefault();
                }
                if (Values.required_date == 0) {
                    toastr["error"]('Required Date is Required');
                    e.preventDefault();
                }
                if (Values.employee_id == 0) {
                    toastr["error"]('Select  Employee Name');
                    e.preventDefault();
                }
                if (Values.project_id == 0) {
                    toastr["error"]('Select  Project Name');
                    e.preventDefault();
                }
            };
            var bankcashChange = function() {
                var Values, Fields;
                Values = UICnt.getValues();
                Fields = UICnt.getFields();
                if (Values.bankcash_id <= 1) {
                    UICnt.hide(Fields.get_cheque_number);
                } else {
                    UICnt.show(Fields.get_cheque_number);
                }
            };
            var addItem = function(index) {
                var Fields;
                Fields = UICnt.getFields();
                UICnt.showHeadAmountArea(Fields.get_dr[index + 1]);
            };
            var removeItem = function(index) {
                var Fields;
                Fields = UICnt.getFields();
                UICnt.hideHeadAmountArea(Fields.get_dr[index + 1]);
                var row = Fields.get_dr[index + 1];
                row.children[2].querySelector('input').value = 0;
                row.children[3].querySelector('input').value = 0;
                row.children[4].querySelector('input').value = 0;
                sumRateQntAmount();
            };
            return {
                init: function() {
                    console.log("App Is running");
                    setUpEventListner();
                    // Default hide fields
                    var Fields = UICnt.getFields();
                    UICnt.hideHeadAmountArea(Fields.get_dr[1]);
                    UICnt.hideHeadAmountArea(Fields.get_dr[2]);
                    UICnt.hideHeadAmountArea(Fields.get_dr[3]);
                    UICnt.hideHeadAmountArea(Fields.get_dr[4]);
                }
            }
        })(UiController);
        MainController.init();
    </script>
@endpush
