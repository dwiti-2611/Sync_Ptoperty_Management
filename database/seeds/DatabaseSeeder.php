<?php

use Illuminate\Database\Seeder;

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
        $this->call(RoleManageTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(BranchTableSeeder::class);
        if (env('DEMO_MODE', false) == true) {
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
