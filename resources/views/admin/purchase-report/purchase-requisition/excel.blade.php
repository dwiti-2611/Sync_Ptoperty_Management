@extends('layouts.pdf')
@push('include-css')
    <link rel="stylesheet" href="{{ Helper::assetV('asset/css/main-report.css') }}">
@endpush
@section('title')
{{ $extra['module_name'] }}
@endsection
@section('content')
    <div class="mid">
        @foreach ($branches as $branch)
            <table class="table  table-bordered table-sm">
                <thead>
                    <tr>
                        <th colspan="7" class="text-center">
                            <h4>{{ App\Branch::find($branch)->name }}</h4>
                        </th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th scope="col">Requisition Date</th>
                        <th scope="col">Required Date</th>
                        <th scope="col">Requisition Id</th>
                        <th scope="col">Requisitor Name</th>
                        <th scope="col">Contract Person</th>
                        <th scope="col" class="text-center">Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $index = 1; ?>
                    @foreach ($infos as $info)
                        @if ($info->branch_id == $branch)
                            <tr>
                                <td>{{ $index }}</td>
                                <td>{{ Helper::dateFormat($info->requisition_date) }}</td>
                                <td>{{ Helper::dateFormat($info->required_date) }}</td>
                                <td>{{ $info->requisition_id }}</td>
                                <td>{{ $info->employee->name }}</td>
                                <td>{{ $info->contract_person }}</td>
                                <td>
                                    <table class="table table-striped table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th class="width-250">Items</th>
                                                <th class="text-right width-70">Qnt</th>
                                                <th class="text-right width-70">Rate</th>
                                                <th class="text-right width-100">Total ( {{ Helper::getCurrencyCode() }} )</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($info->formatedItem as $item)
                                                <tr>
                                                    <td>{{ $item->income_expense_head_name }}</td>
                                                    <td class="text-right">{{ $item->qntity }}</td>
                                                    <td class="text-right">{{ Helper::convertMoneyFormat($item->rate) }}</td>
                                                    <td class="text-right">{{ Helper::convertMoneyFormat($item->amount) }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <th class="text-right" colspan="3">Total Amount =</th>
                                                <th class="text-right"> {{ Helper::convertMoneyFormat($info->amount) }}</th>
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
