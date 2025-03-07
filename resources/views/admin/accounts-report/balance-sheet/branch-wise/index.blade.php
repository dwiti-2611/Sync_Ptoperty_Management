@extends('layouts.pdf')

@push('include-css')
    <link rel="stylesheet" href="{{ asset('asset/css/main-report.css') }}">
@endpush

@section('title')
    {{ config('settings.company_name') }} -> {{ $extra['module_name'] }}
@endsection

@section('content')
    <div class="mid">
        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
            <br>
            <h2 class="text-center">{{ config('settings.company_name') }}</h2>
            <h6 class="text-center">{{ config('settings.address_1') }}</h6>
            <br>
            <h4 class="text-center">{{ $extra['voucher_type'] }}</h4>
            <hr>
        </div>
    </div>
    <div class="mid mb-3">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <td class="text-right">Search By:</td>
                            <td class="text-right">Branch Name:</td>
                            <th>{{ $search_by['branch_name'] }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="mid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                <table class="table table-bordered table-sm table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">
                                <h5>Particulars </h5>
                            </th>
                            <th class="text-center">
                                <h5>From {{ $search_by['start_from'] }} To {{ $search_by['start_to'] }}</h5>
                            </th>
                            <th class="text-center">
                                <h5>From {{ $search_by['end_from'] }} To {{ $search_by['end_to'] }}</h5>
                            </th>
                        </tr>
                        <tr>
                            <th class="text-center" scope="col"></th>
                            <th class="text-right" scope="col"> <?php echo config('settings.is_code') == 'code' ? config('settings.currency_code') : config('settings.currency_symbol'); ?>
                            </th>
                            <th class="text-right" scope="col"> <?php echo config('settings.is_code') == 'code' ? config('settings.currency_code') : config('settings.currency_symbol'); ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="3">
                                <h4>{{ $particulars['CapitalAndLiabilities']['name'] }}</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>{{ $particulars['AuthorizedCapital']['name'] }} </b>
                                <p>1,00,000 Ordinary Share Of Tk. 100 each</p>
                            </td>
                            <td class="font-w-b text-right">
                                {{ Helper::convertMoneyFormat($particulars['AuthorizedCapital']['balance']['start_balance']) }}
                            </td>
                            <td class="font-w-b text-right">
                                {{ Helper::convertMoneyFormat($particulars['AuthorizedCapital']['balance']['end_balance']) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-w-b">
                                ISSUED, SUBSCRIBED &amp; {{ $particulars['IssuedSubscribedAndPaidUpCapital']['name'] }}
                            </td>
                            <td class="font-w-b text-right">
                                {{ Helper::convertMoneyFormat($particulars['IssuedSubscribedAndPaidUpCapital']['balance']['start_balance']) }}
                            </td>
                            <td class="font-w-b text-right">
                                {{ Helper::convertMoneyFormat($particulars['IssuedSubscribedAndPaidUpCapital']['balance']['end_balance']) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-w-b">
                                {{ $particulars['RetainEarning']['name'] }}
                            </td>
                            <td class="font-w-b text-right">
                                {{ Helper::convertMoneyFormat($particulars['RetainEarning']['balance']['start_balance']) }}
                            </td>
                            <td class="font-w-b text-right">
                                {{ Helper::convertMoneyFormat($particulars['RetainEarning']['balance']['end_balance']) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-w-b">
                                {{ $particulars['ShareMoneyDeposit']['name'] }}
                            </td>
                            <td class="font-w-b text-right">
                                {{ Helper::convertMoneyFormat($particulars['ShareMoneyDeposit']['balance']['start_balance']) }}
                            </td>
                            <td class="font-w-b text-right">
                                {{ Helper::convertMoneyFormat($particulars['ShareMoneyDeposit']['balance']['end_balance']) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-w-b">
                                {{ $particulars['NonCurrentLiabilities']['name'] }}
                            </td>
                            <td class="font-w-b text-right">
                                {{ Helper::convertMoneyFormat($particulars['NonCurrentLiabilities']['balance']['start_balance']) }}
                            </td>
                            <td class="font-w-b text-right">
                                {{ Helper::convertMoneyFormat($particulars['NonCurrentLiabilities']['balance']['end_balance']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {{ $particulars['LongTermLoan']['name'] }}
                            </td>
                            <td class="text-right">
                                {{ Helper::convertMoneyFormat($particulars['LongTermLoan']['balance']['start_balance']) }}
                            </td>
                            <td class="text-right">
                                {{ Helper::convertMoneyFormat($particulars['LongTermLoan']['balance']['end_balance']) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-w-b">
                                {{ $particulars['CurrentLiabilities']['name'] }}
                            </td>
                            <td class="font-w-b text-right">
                                {{ Helper::convertMoneyFormat($particulars['CurrentLiabilities']['balance']['start_balance']) }}
                            </td>
                            <td class="font-w-b text-right">
                                {{ Helper::convertMoneyFormat($particulars['CurrentLiabilities']['balance']['end_balance']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {{ $particulars['AccountPayable']['name'] }}
                            </td>
                            <td class=" text-right">
                                {{ Helper::convertMoneyFormat($particulars['AccountPayable']['balance']['start_balance']) }}
                            </td>
                            <td class="text-right">
                                {{ Helper::convertMoneyFormat($particulars['AccountPayable']['balance']['end_balance']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {{ $particulars['ShortTermLoan']['name'] }}
                            </td>
                            <td class=" text-right">
                                {{ Helper::convertMoneyFormat($particulars['ShortTermLoan']['balance']['start_balance']) }}
                            </td>
                            <td class=" text-right">
                                {{ Helper::convertMoneyFormat($particulars['ShortTermLoan']['balance']['end_balance']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {{ $particulars['AdvanceAgainstSales']['name'] }}
                            </td>
                            <td class="text-right">
                                {{ Helper::convertMoneyFormat($particulars['AdvanceAgainstSales']['balance']['start_balance']) }}
                            </td>
                            <td class=" text-right">
                                {{ Helper::convertMoneyFormat($particulars['AdvanceAgainstSales']['balance']['end_balance']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {{ $particulars['OtherPayable']['name'] }}
                            </td>
                            <td class="text-right">
                                {{ Helper::convertMoneyFormat($particulars['OtherPayable']['balance']['start_balance']) }}
                            </td>
                            <td class="text-right">
                                {{ Helper::convertMoneyFormat($particulars['OtherPayable']['balance']['end_balance']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {{ $particulars['AdvanceReceiveFromInvestor']['name'] }}
                            </td>
                            <td class="text-right">
                                {{ Helper::convertMoneyFormat($particulars['AdvanceReceiveFromInvestor']['balance']['start_balance']) }}
                            </td>
                            <td class="text-right">
                                {{ Helper::convertMoneyFormat($particulars['AdvanceReceiveFromInvestor']['balance']['end_balance']) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-w-b text-right font-s-20">
                                {{ $particulars['TotalCapitalAndLiabilities']['name'] }}
                            </td>
                            <td class="font-w-b text-right font-s-20">
                                {{ Helper::convertMoneyFormat($particulars['TotalCapitalAndLiabilities']['balance']['start_balance']) }}
                            </td>
                            <td class="font-w-b text-right font-s-20">
                                {{ Helper::convertMoneyFormat($particulars['TotalCapitalAndLiabilities']['balance']['end_balance']) }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <h4>{{ $particulars['Assets']['name'] }}</h4>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-w-b">
                                {{ $particulars['NonCurrentAssets']['name'] }}
                            </td>
                            <td class="font-w-b text-right">
                                {{ Helper::convertMoneyFormat($particulars['NonCurrentAssets']['balance']['start_balance']) }}
                            </td>
                            <td class="font-w-b text-right">
                                {{ Helper::convertMoneyFormat($particulars['NonCurrentAssets']['balance']['end_balance']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {{ $particulars['fixedAssetsSchedule']['name'] }}
                            </td>
                            <td class=" text-right">
                                {{ Helper::convertMoneyFormat($particulars['fixedAssetsSchedule']['balance']['start_balance']) }}
                            </td>
                            <td class="text-right">
                                {{ Helper::convertMoneyFormat($particulars['fixedAssetsSchedule']['balance']['end_balance']) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-w-b">
                                {{ $particulars['CurrentAssets']['name'] }}
                            </td>
                            <td class="font-w-b text-right">
                                {{ Helper::convertMoneyFormat($particulars['CurrentAssets']['balance']['start_balance']) }}
                            </td>
                            <td class="font-w-b text-right">
                                {{ Helper::convertMoneyFormat($particulars['CurrentAssets']['balance']['end_balance']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {{ $particulars['AdvanceDepositReceivables']['name'] }}
                            </td>
                            <td class="text-right">
                                {{ Helper::convertMoneyFormat($particulars['AdvanceDepositReceivables']['balance']['start_balance']) }}
                            </td>
                            <td class="text-right">
                                {{ Helper::convertMoneyFormat($particulars['AdvanceDepositReceivables']['balance']['end_balance']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {{ $particulars['Inventories']['name'] }}
                            </td>
                            <td class="text-right">
                                {{ Helper::convertMoneyFormat($particulars['Inventories']['balance']['start_balance']) }}
                            </td>
                            <td class="text-right">
                                {{ Helper::convertMoneyFormat($particulars['Inventories']['balance']['end_balance']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {{ $particulars['CashAndBankBalance']['name'] }}
                            </td>
                            <td class="text-right">
                                {{ Helper::convertMoneyFormat($particulars['CashAndBankBalance']['balance']['start_balance']) }}
                            </td>
                            <td class="text-right">
                                {{ Helper::convertMoneyFormat($particulars['CashAndBankBalance']['balance']['end_balance']) }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {{ $particulars['PreliminaryExpense']['name'] }}
                            </td>
                            <td class="text-right">
                                {{ Helper::convertMoneyFormat($particulars['PreliminaryExpense']['balance']['start_balance']) }}
                            </td>
                            <td class="text-right">
                                {{ Helper::convertMoneyFormat($particulars['PreliminaryExpense']['balance']['end_balance']) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-w-b text-right fon-s-20">
                                {{ $particulars['TotalAssets']['name'] }}
                            </td>
                            <td class="font-w-b text-right fon-s-20">
                                {{ Helper::convertMoneyFormat($particulars['TotalAssets']['balance']['start_balance']) }}
                            </td>
                            <td class="font-w-b text-right fon-s-20">
                                {{ Helper::convertMoneyFormat($particulars['TotalAssets']['balance']['end_balance']) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
    </div>
@stop
