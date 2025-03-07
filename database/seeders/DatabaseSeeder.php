<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

use Database\Seeders\SellsTableseeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\BranchTableSeeder;
use Database\Seeders\vendorTableSeeder;
use Database\Seeders\ProductTableSeeder;
use Database\Seeders\BankCashTableSeeder;
use Database\Seeders\CustomerTableSeeder;
use Database\Seeders\EmployeeTableSeeder;
use Database\Seeders\SettingsTableSeeder;
use Database\Seeders\CrVoucherTableSeeder;
use Database\Seeders\DrVoucherTableSeeder;
use Database\Seeders\ContraVoucherTableSeeder;
use Database\Seeders\IncomeExpenseTableSeeder;
use Database\Seeders\PurchaseOrderTableSeeder;
use Database\Seeders\ActualReceivedTableSeeder;
use Database\Seeders\JournalVoucherTableSeeder;
use Database\Seeders\IncomeExpenseHeadTableSeeder;
use Database\Seeders\IncomeExpenseGroupsTableSeeder;
use Database\Seeders\PurchaseRequisitionTableSeeder;
use Database\Seeders\ScheduleReceivablesTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // System Setting
        $this->call(UsersTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        if (env('DEMO_MODE', false) == true) {
            //  branch table seeder
            $this->call(BranchTableSeeder::class);
            // Inventory
            $this->call(ProductTableSeeder::class);
            $this->call(CustomerTableSeeder::class);
            $this->call(vendorTableSeeder::class);
            $this->call(EmployeeTableSeeder::class);
            $this->call(SellsTableseeder::class);
            $this->call(ScheduleReceivablesTableSeeder::class);
            $this->call(ActualReceivedTableSeeder::class);
            $this->call(PurchaseRequisitionTableSeeder::class);
            $this->call(PurchaseOrderTableSeeder::class);
        }
        // Account
        $this->call(IncomeExpenseTableSeeder::class);
        if (env('DEMO_MODE', false) == true) {
            $this->call(IncomeExpenseGroupsTableSeeder::class);
            $this->call(IncomeExpenseHeadTableSeeder::class);
        }
        $this->call(BankCashTableSeeder::class);

        // $this->call(InitialIncomeExpenseHeadBalanceTableSeeder::class);
        // $this->call(InitialBankCashTableSeeder::class);
        if (env('DEMO_MODE', false) == true) {
            $this->call(DrVoucherTableSeeder::class);
            $this->call(CrVoucherTableSeeder::class);
            $this->call(JournalVoucherTableSeeder::class);
            $this->call(ContraVoucherTableSeeder::class);
        }
    }
}
