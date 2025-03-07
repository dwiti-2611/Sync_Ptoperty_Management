@extends('layouts.app')


{{-- Important Variable --}}

<?php

$moduleName = __('root.purchase_order.purchase_order_manage');
$createItemName = __('root.common.create') . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = ' ' . __('root.common.all');

$breadcrumbMainIcon = 'fas fa-shopping-cart';
$breadcrumbCurrentIcon = 'archive';

$ModelName = 'App\PurchaseOrder';
$ParentRouteName = 'purchase_order';

$all = config('role_manage.PurchaseOrder.All');
$create = config('role_manage.PurchaseOrder.Create');
$delete = config('role_manage.PurchaseOrder.Delete');
$edit = config('role_manage.PurchaseOrder.Edit');
$pdf = config('role_manage.PurchaseOrder.Pdf');
$permanently_delete = config('role_manage.PurchaseOrder.PermanentlyDelete');
$restore = config('role_manage.PurchaseOrder.Restore');
$show = config('role_manage.PurchaseOrder.Show');
$trash_show = config('role_manage.PurchaseOrder.TrashShow');

?>


@section('title')
    {{ $moduleName }} -> {{ $breadcrumbCurrentName }}
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
                <a @if ($create == 0) class="dis-none" @endif class="btn btn-sm btn-info waves-effect"
                    href="{{ route($ParentRouteName . '.create') }}">{{ __('root.common.create') }}</a>
            </div>
            <ol class="breadcrumb breadcrumb-col-cyan @if ($is_rtl) pull-left  @else pull-right @endif">
                <li><a href="{{ route('dashboard') }}"><i class="material-icons">home</i> {{ __('root.common.home') }}</a>
                </li>
                <li><a href="{{ route($ParentRouteName) }}"><i class="{{ $breadcrumbMainIcon }}"></i>
                        &nbsp;{{ $breadcrumbMainName }}</a></li>
                <li class="active"><i
                        class="material-icons">{{ $breadcrumbCurrentIcon }}</i>&nbsp;{{ $breadcrumbCurrentName }}
                </li>
            </ol>
            <!-- Hover Rows -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <a class="btn btn-xs btn-info waves-effect"
                                href="{{ route($ParentRouteName) }}">{{ __('root.common.all') }}
                                ({{ $total_purchase_orders }})</a>
                            <a @if ($trash_show == 0) class="dis-none" @endif
                                class="btn btn-xs btn-danger waves-effect text-black"
                                href="{{ route($ParentRouteName . '.trashed') }}">{{ __('root.common.trash') }}
                                ({{ $total_trashed_purchase_orders }})
                            </a>
                            <ul class="header-dropdown m-r--5">
                                <form class="search" action="{{ route($ParentRouteName . '.active.search') }}"
                                    method="get">
                                    {{ csrf_field() }}
                                    <input autofocus type="search" name="search" class="form-control input-sm "
                                        placeholder="{{ __('root.common.search') }}" />
                                </form>
                            </ul>
                        </div>
                        <form class="actionForm" action="{{ route($ParentRouteName . '.active.action') }}" method="get">
                            <div class="pagination-and-action-area body">
                                <div>
                                    <div class="select-and-apply-area">
                                        <div class="form-group width-300">
                                            <div class="form-line">
                                                <select class="form-control" name="apply_comand_top" id="">
                                                    <option value="0">{{ __('root.common.select_action') }}</option>
                                                    @if ($delete)
                                                        <option value="3">{{ __('root.common.move_to_trash') }}
                                                        </option>
                                                    @endif
                                                    @if ($permanently_delete)
                                                        <option value="2">{{ __('root.common.permanently_delete') }}
                                                        </option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input class="btn btn-sm btn-info waves-effect" type="submit"
                                                value="{{ __('root.common.apply') }}" name="ApplyTop">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="custom-paginate">
                                        {{ $items->links() }}
                                    </div>
                                </div>
                            </div>
                            <div class="body table-responsive">
                                {{ csrf_field() }}
                                @if (count($items) > 0)
                                    <table class="table table-hover table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th class="checkbox_custom_style text-center width-100">
                                                    <input name="selectTop" type="checkbox" id="md_checkbox_p"
                                                        class="chk-col-cyan" />
                                                    <label for="md_checkbox_p"></label>
                                                </th>
                                                <th data-toggle="tooltip" data-placement="top"
                                                    title="{{ __('root.purchase_order.project_name') }}">Name
                                                </th>
                                                <th data-toggle="tooltip" data-placement="top"
                                                    title="{{ __('root.purchase_order.requisition_id') }}">R ID
                                                </th>
                                                <th data-toggle="tooltip" data-placement="top"
                                                    title="{{ __('root.purchase_order.purchase_id') }}">P ID</th>
                                                <th class="text-right" data-toggle="tooltip" data-placement="top"
                                                    title="{{ Helper::getCurrencyCode() }}">Amount</th>
                                                <th data-toggle="tooltip" data-placement="top"
                                                    title="{{ __('root.purchase_order.vendor_name') }}">V Name
                                                </th>
                                                <th data-toggle="tooltip" data-placement="top"
                                                    title="{{ __('root.purchase_order.media_name') }}">M Name
                                                </th>
                                                <th data-toggle="tooltip" data-placement="top"
                                                    title="{{ __('root.purchase_order.issuing_date') }}">I Date
                                                </th>
                                                <th data-toggle="tooltip" data-placement="top"
                                                    title="{{ __('root.purchase_order.date_of_delevery') }}">DOD
                                                </th>
                                                <th data-toggle="tooltip" data-placement="top"
                                                    title="{{ __('root.purchase_order.contract_person_1') }}">CP
                                                    1</th>
                                                <th data-toggle="tooltip" data-placement="top"
                                                    title="{{ __('root.purchase_order.contract_person_2') }}">CP
                                                    2</th>
                                                <th class="width-160 text-center">{{ __('root.purchase_order.options') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($items as $item)
                                                <tr>
                                                    <th class="text-center">
                                                        <input name="items[id][]" value="{{ $item->id }}"
                                                            type="checkbox" id="md_checkbox_{{ $i }}"
                                                            class="chk-col-cyan selects " />
                                                        <label for="md_checkbox_{{ $i }}"></label>
                                                    </th>
                                                    <td>{{ $item->branch->name }}</td>
                                                    <td>{{ $item->requisition_id }}</td>
                                                    <td>{{ $item->purchase_id }}</td>
                                                    <td class="text-right">
                                                        {{ Helper::convertMoneyFormat($item->totalAmount) }}</td>
                                                    <td>{{ $item->vendor->name }}</td>
                                                    <td>{{ $item->media_name }}</td>
                                                    <td>{{ Helper::dateFormat($item->issuing_date) }}</td>
                                                    <td>{{ Helper::dateFormat($item->date_of_delevery) }}</td>
                                                    <td>{{ $item->contract_person_1 }}</td>
                                                    <td>{{ $item->contract_person_2 }}</td>
                                                    <td class="tdTrashAction text-center">
                                                        <a @if ($edit == 0) class="dis-none" @endif
                                                            class="btn btn-xs btn-info waves-effect m-b-3"
                                                            href="{{ route($ParentRouteName . '.edit', ['id' => $item->id]) }}"
                                                            data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                                class="material-icons">mode_edit</i></a>
                                                        <a @if ($show == 0) class="dis-none" @endif
                                                            target="_blank" data-target="#largeModal"
                                                            class="btn btn-xs btn-success waves-effect ajaxCall m-b-3"
                                                            href="{{ route($ParentRouteName . '.show', ['id' => $item->id]) }}"
                                                            data-toggle="tooltip" data-placement="top" title="Preview"><i
                                                                class="material-icons">pageview</i></a>
                                                        <a @if ($delete == 0) class="dis-none" @endif
                                                            class="btn btn-xs btn-danger waves-effect m-b-3"
                                                            href="{{ route($ParentRouteName . '.destroy', ['id' => $item->id]) }}"
                                                            data-toggle="tooltip" data-placement="top" title="Trash"> <i
                                                                class="material-icons">delete</i></a>
                                                        <a @if ($show == 0) class="dis-none" @endif
                                                            target="_blank" data-target="#largeModal"
                                                            class="btn btn-xs btn-success waves-effect ajaxCall m-b-3"
                                                            href="{{ route($ParentRouteName . '.show', ['id' => $item->id, 'pdf' => true]) }}"
                                                            data-toggle="tooltip" data-placement="top" title="Print or pdf"><i
                                                                class="material-icons">picture_as_pdf</i></a>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            @endforeach
                                            <thead>
                                                <tr>
                                                    <th class="checkbox_custom_style text-center">
                                                        <input name="selectBottom" type="checkbox"
                                                            id="md_checkbox_footer" class="chk-col-cyan" />
                                                        <label for="md_checkbox_footer"></label>
                                                    </th>
                                                    <th data-toggle="tooltip" data-placement="top"
                                                        title="{{ __('root.purchase_order.project_name') }}">Name
                                                    </th>
                                                    <th data-toggle="tooltip" data-placement="top"
                                                        title="{{ __('root.purchase_order.requisition_id') }}">R ID
                                                    </th>
                                                    <th data-toggle="tooltip" data-placement="top"
                                                        title="{{ __('root.purchase_order.purchase_id') }}">P ID</th>
                                                    <th class="text-right" data-toggle="tooltip" data-placement="top"
                                                        title="{{ Helper::getCurrencyCode() }}">Amount</th>
                                                    <th data-toggle="tooltip" data-placement="top"
                                                        title="{{ __('root.purchase_order.vendor_name') }}">V Name
                                                    </th>
                                                    <th data-toggle="tooltip" data-placement="top"
                                                        title="{{ __('root.purchase_order.media_name') }}">M Name
                                                    </th>
                                                    <th data-toggle="tooltip" data-placement="top"
                                                        title="{{ __('root.purchase_order.issuing_date') }}">I Date
                                                    </th>
                                                    <th data-toggle="tooltip" data-placement="top"
                                                        title="{{ __('root.purchase_order.date_of_delevery') }}">DOD
                                                    </th>
                                                    <th data-toggle="tooltip" data-placement="top"
                                                        title="{{ __('root.purchase_order.contract_person_1') }}">CP
                                                        1</th>
                                                    <th data-toggle="tooltip" data-placement="top"
                                                        title="{{ __('root.purchase_order.contract_person_2') }}">CP
                                                        2</th>
                                                    <th class="width-160 text-center">{{ __('root.purchase_order.options') }}</th>
                                                </tr>
                                            </thead>
                                        </tbody>
                                    </table>
                                @else
                                    <div class="body table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-danger text-center">
                                                        {{ __('root.common.no_data_found') }}</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                @endif
                            </div>
                            <div class="pagination-and-action-area body">
                                <div>
                                    <div class="select-and-apply-area">
                                        <div class="form-group width-300">
                                            <div class="form-line">
                                                <select class="form-control" name="apply_comand_bottom" id="">
                                                    <option value="0">{{ __('root.common.select_action') }}</option>
                                                    @if ($delete)
                                                        <option value="3">{{ __('root.common.move_to_trash') }}
                                                        </option>
                                                    @endif
                                                    @if ($permanently_delete)
                                                        <option value="2">{{ __('root.common.permanently_delete') }}
                                                        </option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input class="btn btn-sm btn-info waves-effect" type="submit"
                                                value="{{ __('root.common.apply') }}" name="ApplyTop">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="custom-paginate">
                                        {{ $items->links() }}
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- #END# Hover Rows -->
        </div>
    </section>
@stop

@push('include-css')
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
