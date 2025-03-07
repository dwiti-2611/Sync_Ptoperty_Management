@extends('layouts.app')

<?php

$moduleName = __('root.vendor.vendor_manage')
$createItemName = "Show" . $moduleName;

$breadcrumbMainName = $moduleName;
$breadcrumbCurrentName = " All";

$breadcrumbMainIcon = "fas fa-project-diagram";
$breadcrumbCurrentIcon = "archive";

$ModelName = 'App\Branch';
$ParentRouteName = 'branch';

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
                                {{ $items->name }}
                                <small>Details {{ $items->name }} Information</small>
                            </h2>
                            <div class="body">
                                <form class="form" id="form_validation" method="post"
                                    action="{{ route($ParentRouteName . '.store') }}">
                                    {{ csrf_field() }}
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <table class="table  table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="text-center">S.L</th>
                                                        <th scope="col" class="text-center">Module Name</th>
                                                        <th scope="col" class="text-center">Module Show</th>
                                                        <th scope="col" class="text-center">Show</th>
                                                        <th scope="col" class="text-center">Create</th>
                                                        <th scope="col" class="text-center">Edit</th>
                                                        <th scope="col" class="text-center">Delete</th>
                                                        <th scope="col" class="text-center">PDF</th>
                                                        <th scope="col" class="text-center">Trash Show</th>
                                                        <th scope="col" class="text-center">Restore</th>
                                                        <th scope="col" class="text-center">Permanently Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($items->content)
                                                        @foreach ($items->content as $itemKey => $item)
                                                            <tr>
                                                                <th scope="row" class="text-center">{{ $itemKey + 1 }}
                                                                </th>

                                                                @foreach ($item as $key => $value)
                                                                    <td class="text-center">
                                                                        @if ($key == 0)
                                                                            {{ $value }}
                                                                        @elseif ($value == 'on')
                                                                            <i class="fas fa-check text-success"></i>
                                                                        @else
                                                                            <i class="fas fa-times text-danger"></i>
                                                                        @endif
                                                                    </td>
                                                                @endforeach

                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <th class="text-danger">No Item Available</th>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
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
@endpush
