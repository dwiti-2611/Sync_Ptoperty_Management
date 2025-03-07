<?php

namespace App\Http\Controllers;

use App\BankCash;
use App\Branch;
use App\Exports\Ledger\BranchWiseLedger;
use App\Exports\Ledger\BankCashWise;
use App\Exports\Ledger\IncomeExpenseHeadWise;
use App\Helpers\Helper;
use App\IncomeExpenseHead;
use App\Transaction;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;

class AccountsReportController extends Controller
{
    public function ledger_index()
    {
        $crvoucher = new CrVoucherController();
        return view('admin.accounts-report.ledger.index', $crvoucher->__getBranchBankCashIncomeExpenseHead());
    }

    /**
     * This function return branch wisse ledger report
     *
     * @author      Md. Al-Mahmud <mamun120520@gmail.com>
     * @version     1.0
     * @see         
     * @since       08/19/2022
     * Time         14:46:27
     * @param       $request
     * @return      
     */
    public function ledger_branch_wise_report(Request $request)
    {
        $branch_module = '';
        $incomeExpenseHead = '';
        $now = new \DateTime();
        $date = $now->format(Config('settings.date_format') . ' h:i:s');
        $extra = array(
            'current_date_time' => $date,
            'module_name' => 'Branch Wise ledger Report',
            'voucher_type' => 'BRANCH WISE LEDGER REPORT'
        );
        $branch_query = Branch::query();
        $branch_query->with('transactions', 'transactions.IncomeExpenseHead', 'transactions.BankCash');
        if ($request->branch_id != null) {
            $branch_query->where('id', $request->branch_id);
            $branch_module = Branch::find($request->branch_id);
        }
        if ($request->income_expense_head_id != null) {
            $incomeExpenseHead = IncomeExpenseHead::find($request->income_expense_head_id);
        }
        $branch_query->with(['transactions' => function ($query) use ($request) {
            if ($request->income_expense_head_id != null) {
                $query->where('income_expense_head_id', $request->income_expense_head_id);
            }
            if ($request->from != null && $request->to != null) {
                $query->whereBetween('voucher_date', array(date("Y-m-d", strtotime($request->from)), date("Y-m-d", strtotime($request->to))));
            }
        }]);
        $search_by = array(
            'branch_name' => ($branch_module) ? $branch_module->name : '',
            'income_expense_head_name' => ($incomeExpenseHead) ? $incomeExpenseHead->name : '',
            'from' => ($request->from && $request->from != null) ? date(config('settings.date_format'), strtotime($request->from)) : '',
            'to' => ($request->to && $request->to != null) ? date(config('settings.date_format'), strtotime($request->to)) : '',
        );
        //Show Action
        if ($request->action == 'Show') {
            return view('admin.accounts-report.ledger.branch-wise.index')
                ->with('items', $branch_query->get())
                ->with('extra', $extra)
                ->with('search_by', $search_by);
        }
        // Pdf Action
        if ($request->action == 'Pdf') {
            $pdf = PDF::loadView('admin.accounts-report.ledger.branch-wise.pdf', [
                'items' => $branch_query->get(),
                'extra' => $extra,
                'search_by' => $search_by,
            ])->setPaper('a4', 'landscape');
            //return $pdf->stream(date(config('settings.date_format'), strtotime($extra['current_date_time'])) . '_' . $extra['module_name'] . '.pdf');
            return $pdf->download(date(config('settings.date_format'), strtotime($extra['current_date_time'])) . '_' . $extra['module_name'] . '.pdf');
        }
        //  Exl Action
        if ($request->action == 'Excel') {
            $BranchWise = new BranchWiseLedger([
                'items' => $branch_query->get(),
                'extra' => $extra,
            ]);
            return Excel::download($BranchWise, date(config('settings.date_format'), strtotime($extra['current_date_time'])) . '_' . $extra['module_name'] . '.xlsx');
        }
    }
    #end

    /**
     * This function return income expense head wise report
     *
     * @author      Md. Al-Mahmud <mamun120520@gmail.com>
     * @version     1.0
     * @see         
     * @since       08/19/2022
     * Time         16:52:42
     * @param       $request
     * @return      
     */
    public function ledger_income_expense_head_wise_report(Request $request)
    {

        $now = new \DateTime();
        $date = $now->format(Config('settings.date_format') . ' h:i:s');
        $extra = array(
            'current_date_time' => $date,
            'module_name' => 'Report',
            'voucher_type' => 'LEDGER WISE REPORT'
        );
        $income_expense_head_query = IncomeExpenseHead::query();
        $income_expense_head_query->with('transactions', 'transactions.Branch', 'transactions.BankCash');
        if ($request->income_expense_head_id && $request->income_expense_head_id != null) {
            $income_expense_head_query->where('id', $request->income_expense_head_id);
        }
        $income_expense_head_query->with(['transactions' => function ($query) use ($request) {
            if ($request->branch_id && $request->branch_id  != null) {
                $query->where('branch_id', $request->branch_id);
            }
            if ($request->from != null && $request->to != null) {
                $query->whereBetween('voucher_date', array(date("Y-m-d", strtotime($request->from)), date("Y-m-d", strtotime($request->to))));
            }
        }]);
        $search_by = array(
            'branch_name' => ($request->branch_id != null) ? Branch::find($request->branch_id)->name : '',
            'income_expense_head_name' => ($request->income_expense_head_id != null) ? IncomeExpenseHead::find($request->income_expense_head_id)->name : '',
            'from' => ($request->from) ? date(config('settings.date_format'), strtotime($request->from)) : '',
            'to' => ($request->to) ? date(config('settings.date_format'), strtotime($request->to)) : '',
        );
        // Show Action
        if ($request->action == 'Show') {
            return view('admin.accounts-report.ledger.income-expense-head-wise.index')
                ->with('items', $income_expense_head_query->get())
                ->with('extra', $extra)
                ->with('search_by', $search_by);
        }
        // Pdf Action
        if ($request->action == 'Pdf') {
            $pdf = PDF::loadView('admin.accounts-report.ledger.income-expense-head-wise.pdf', [
                'items' => $income_expense_head_query->get(),
                'extra' => $extra,
                'search_by' => $search_by,
            ])->setPaper('a4', 'landscape');
            //return $pdf->stream(date(config('settings.date_format'), strtotime($extra['current_date_time'])) . '_' . $extra['module_name'] . '.pdf');
            return $pdf->download($extra['current_date_time'] . '_' . $extra['module_name'] . '.pdf');
        }
        // Excel Action
        if ($request->action == 'Excel') {
            $IncomeExpenseHeadWise = new IncomeExpenseHeadWise([
                'items' => $income_expense_head_query->get(),
                'extra' => $extra,
            ]);
            return Excel::download($IncomeExpenseHeadWise, $extra['current_date_time'] . '_' . $extra['module_name'] . '.xlsx');
        }
    }
    #end

    /**
     * This function return ledger by bank cash wise
     *
     * @author      Md. Al-Mahmud <mamun120520@gmail.com>
     * @version     1.0
     * @see         
     * @since       08/19/2022
     * Time         18:37:28
     * @param       $request
     * @return      
     */
    public function ledger_bank_cash_wise_report(Request $request)
    {
        $now = new \DateTime();
        $date = $now->format(Config('settings.date_format') . ' h:i:s');
        $extra = [
            'current_date_time' => $date,
            'module_name' => 'Bank Cash Wise',
            'voucher_type' => 'BANK CASH WISE LEDGER REPORT'
        ];
        // branches from cache
        $branches = Helper::__getBranchBankCashIncomeExpenseHead()['branches'];
        $bank_cashes = Helper::__getBranchBankCashIncomeExpenseHead()['bank_cashes'];
        $search_by = [
            'branch_name' => ($request->branch_id && $request->branch_id != null) ? $branches->where('id', $request->branch_id)->first()->name : '',
            'bank_cash_name' => ($request->bank_cash_id && $request->bank_cash_id != null) ? $bank_cashes->where('id', $request->bank_cash_id)->first()->name : '',
            'from' => ($request->from) ? date(config('settings.date_format'), strtotime($request->from)) : '',
            'to' => ($request->to) ? date(config('settings.date_format'), strtotime($request->to)) : '',
        ];
        $bank_caches_balance = Helper::__bank_cash_details($request->bank_cash_id, $request->branch_id, $request->from, $request->to);
        // Show Action
        if ($request->action == 'Show') {
            return view('admin.accounts-report.ledger.bank-cash-wise.index')
                ->with('items', $bank_caches_balance)
                ->with('extra', $extra)
                ->with('search_by', $search_by);
        }
        // Pdf Action
        if ($request->action == 'Pdf') {
            $pdf = PDF::loadView('admin.accounts-report.ledger.bank-cash-wise.pdf', [
                'items' => $bank_caches_balance,
                'extra' => $extra,
                'search_by' => $search_by,
            ])->setPaper('a4', 'landscape');
            //return $pdf->stream(date(config('settings.date_format'), strtotime($extra['current_date_time'])) . '_' . $extra['module_name'] . '.pdf');
            return $pdf->download($extra['current_date_time'] . '_' . $extra['module_name'] . '.pdf');
        }
        // Excel Action
        if ($request->action == 'Excel') {
            $BankCashWise = new BankCashWise([
                'items' => $bank_caches_balance,
                'extra' => $extra,
            ]);
            return Excel::download($BankCashWise, $extra['current_date_time'] . '_' . $extra['module_name'] . '.xlsx');
        }
    }
    #end

    public function getBankCashBalance($unique_branches, $start_from, $start_to, $end_from, $end_to)
    {

        $TransactionController = new TransactionController();
        $unique_bank_cashes = $TransactionController->getUniqueBankCashes(0);
        $TransactionModel = new Transaction();
        $start_balance = 0;
        $end_balance = 0;
        $bankCashesBalanceStart = array();
        $bankCashesBalanceEnd = array();
        foreach ($unique_branches as $branch) {
            foreach ($unique_bank_cashes as $unique_bank_cash) {
                $start_balance += $startBalance = $TransactionModel->GetBankCashBalanceByBranchBankCashIdDate($branch->branch_id, $unique_bank_cash->bank_cash_id, $start_from, $start_to);
                $end_balance += $endBalance = $TransactionModel->GetBankCashBalanceByBranchBankCashIdDate($branch->branch_id, $unique_bank_cash->bank_cash_id, $end_from, $end_to);
                if (array_key_exists($unique_bank_cash->name, $bankCashesBalanceStart)) {
                    $bankCashesBalanceStart[$unique_bank_cash->name] += $startBalance;
                } else {
                    $bankCashesBalanceStart[$unique_bank_cash->name] = $startBalance;
                }
                if (array_key_exists($unique_bank_cash->name, $bankCashesBalanceEnd)) {
                    $bankCashesBalanceEnd[$unique_bank_cash->name] += $endBalance;
                } else {
                    $bankCashesBalanceEnd[$unique_bank_cash->name] = $endBalance;
                }
            }
        }
        $balance = array(
            'balance' => array(
                'start_balance' => $start_balance,
                'end_balance' => $end_balance
            ),
            'BankCashDetails' => array(
                'StartDate' => $bankCashesBalanceStart,
                'EndDate' => $bankCashesBalanceEnd,
                'TotalBalance' => array(
                    'start_balance' => $start_balance,
                    'end_balance' => $end_balance
                ),
            )
        );
        return $balance;
    }
}
