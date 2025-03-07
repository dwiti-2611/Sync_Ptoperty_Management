<?php

namespace Database\Seeders;

use App\User;
use App\Profile;
use App\RoleManage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // first drop all user and role for db
        DB::table('role_manages')->where('id', '!=', 0)->delete();
        DB::table('users')->where('id', '!=', 0)->delete();

        // super admin
        $superadmin_roles = RoleManage::create([
            'name' => 'Super Admin',
            'content' => '{"User":["User ",1,1,1,1,1,1,1,1,1],"RoleManager":["Role Manager",1,1,1,1,1,1,1,1,1],"Settings":["Settings",1,1,1,1,1,1,1,1,1],"Language":["Language",1,1,1,1,1,1,1,1,1],"Project":["Project",1,1,1,1,1,1,1,1,1],"Product":["Product",1,1,1,1,1,1,1,1,1],"Sell":["Sell",1,1,1,1,1,1,1,1,1],"PurchaseRequisition":["Purchase Requisition",1,1,1,1,1,1,1,1,1],"PurchaseRQNConfirm":["Purchase RQN Confirm",1,1,1,1,1,1,1,1,1],"PurchaseOrder":["Purchase Order",1,1,1,1,1,1,1,1,1],"Vendor":["Vendor",1,1,1,1,1,1,1,1,1],"Employee":["Employee",1,1,1,1,1,1,1,1,1],"Customer":["Customer",1,1,1,1,1,1,1,1,1],"PurchaseReport":["PurchaseReport",1,1,1,1,1,1,1,1,1],"SellsReport":["Sells Report",1,1,1,1,1,1,1,1,1],"LedgerType":["Ledger Type",1,1,1,1,1,1,1,1,1],"LedgerGroup":["Ledger Group",1,1,1,1,1,1,1,1,1],"LedgerName":["Ledger Name",1,1,1,1,1,1,1,1,1],"BankCash":["Bank Cash",1,1,1,1,1,1,1,1,1],"InitialIncomeExpenseHeadBalance":["Initial Income Expense Head Balance",1,1,1,1,1,1,1,1,1],"InitialBankCashBalance":["Initial Bank Cash Balance",1,1,1,1,1,1,1,1,1],"DrVoucher":["Dr Voucher",1,1,1,1,1,1,1,1,1],"CrVoucher":["Cr Voucher",1,1,1,1,1,1,1,1,1],"JnlVoucher":["Jnl Voucher",1,1,1,1,1,1,1,1,1],"ContraVoucher":["Contra Voucher",1,1,1,1,1,1,1,1,1],"Ledger":["Ledger",1,1,1,1,1,1,1,1,1],"TrialBalance":["Trial Balance",1,1,1,1,1,1,1,1,1],"CostOfRevenue":["Cost Of Revenue",1,1,1,1,1,1,1,1,1],"ProfitOrLossAccount":["Profit Or Loss Account",1,1,1,1,1,1,1,1,1],"RetainedEarning":["Retained Earning",1,1,1,1,1,1,1,1,1],"FixedAssetsSchedule":["Fixed Assets Schedule",1,1,1,1,1,1,1,1,1],"StatementOfFinancialPosition":["Statement Of Financial Position",1,1,1,1,1,1,1,1,1],"CashFlow":["Cash Flow",1,1,1,1,1,1,1,1,1],"ReceiveAndPayment":["Receive And Payment",1,1,1,1,1,1,1,1,1],"Notes":["Notes",1,1,1,1,1,1,1,1,1],"GeneralBranch":["General Branch Report",1,1,1,1,1,1,1,1,1],"GeneralLedger":["General Ledger Report",1,1,1,1,1,1,1,1,1],"GeneralBankCash":["General Bank Cash Report",1,1,1,1,1,1,1,1,1],"GeneralVoucher":["General Voucher Report",1,1,1,1,1,1,1,1,1]}',
            'create_by' => 'superadmin@gmail.com',
        ]);
        $userSuperAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@eaccount.xyz',
            'role_manage_id' => $superadmin_roles->id,
            'password' => (env('DEMO_MODE', false) == true) ?  bcrypt('mamun2074') : bcrypt('1234'),
            'create_by' => 'System',
        ]);
        Profile::create([
            "user_ID" => $userSuperAdmin->id,
            "first_name" => "S.M",
            "last_name" => "Abid",
            "gender" => 1,
            "designation" => "Software Engineer",
            "phone_number" => "+8801738578683",
            "NID" => "199412478654477",
            "permanent_address" => "PS: Raygonj, District: Sirajgonj",
            "present_address" => "Dhaka,Bangladesh",
            'avatar' => 'upload/avatar/avatar.png',
            "education" => 'B.Sc. in Computer Science & Engineering',
            'description' => ''
        ]);

        if (env('DEMO_MODE', false) == true) {
            // admin role user
            $admin_user = RoleManage::create([
                'name' => 'Admin',
                'content' => '{"User":["User ",1,0,0,0,0,0,0,0,0],"RoleManager":["Role Manager",1,0,0,0,0,0,0,0,0],"Settings":["Settings",1,1,1,1,1,1,1,1,1],"Language":["Language",1,1,1,1,1,1,1,1,1],"Project":["Project",1,1,1,1,1,1,1,1,1],"Product":["Product",1,1,1,1,1,1,1,1,1],"Sell":["Sell",1,1,1,1,1,1,1,1,1],"PurchaseRequisition":["Purchase Requisition",1,1,1,1,1,1,1,1,1],"PurchaseRQNConfirm":["Purchase RQN Confirm",1,1,1,1,1,1,1,1,1],"PurchaseOrder":["Purchase Order",1,1,1,1,1,1,1,1,1],"Vendor":["Vendor",1,1,1,1,1,1,1,1,1],"Employee":["Employee",1,1,1,1,1,1,1,1,1],"Customer":["Customer",1,1,1,1,1,1,1,1,1],"PurchaseReport":["PurchaseReport",1,1,1,1,1,1,1,1,1],"SellsReport":["Sells Report",1,1,1,1,1,1,1,1,1],"LedgerType":["Ledger Type",1,1,1,1,1,1,1,1,1],"LedgerGroup":["Ledger Group",1,1,1,1,1,1,1,1,1],"LedgerName":["Ledger Name",1,1,1,1,1,1,1,1,1],"BankCash":["Bank Cash",1,1,1,1,1,1,1,1,1],"InitialIncomeExpenseHeadBalance":["Initial Income Expense Head Balance",0,0,0,0,0,0,0,0,0],"InitialBankCashBalance":["Initial Bank Cash Balance",0,0,0,0,0,0,0,0,0],"DrVoucher":["Dr Voucher",1,1,1,1,1,1,1,1,1],"CrVoucher":["Cr Voucher",1,1,1,1,1,1,1,1,1],"JnlVoucher":["Jnl Voucher",1,1,1,1,1,1,1,1,1],"ContraVoucher":["Contra Voucher",1,1,1,1,1,1,1,1,1],"Ledger":["Ledger",1,1,1,1,1,1,1,1,1],"TrialBalance":["Trial Balance",1,1,1,1,1,1,1,1,1],"CostOfRevenue":["Cost Of Revenue",1,1,1,1,1,1,1,1,1],"ProfitOrLossAccount":["Profit Or Loss Account",1,1,1,1,1,1,1,1,1],"RetainedEarning":["Retained Earning",1,1,1,1,1,1,1,1,1],"FixedAssetsSchedule":["Fixed Assets Schedule",1,1,1,1,1,1,1,1,1],"StatementOfFinancialPosition":["Statement Of Financial Position",1,1,1,1,1,1,1,1,1],"CashFlow":["Cash Flow",1,1,1,1,1,1,1,1,1],"ReceiveAndPayment":["Receive And Payment",1,1,1,1,1,1,1,1,1],"Notes":["Notes",1,1,1,1,1,1,1,1,1],"GeneralBranch":["General Branch Report",1,1,1,1,1,1,1,1,1],"GeneralLedger":["General Ledger Report",1,1,1,1,1,1,1,1,1],"GeneralBankCash":["General Bank Cash Report",1,1,1,1,1,1,1,1,1],"GeneralVoucher":["General Voucher Report",1,1,1,1,1,1,1,1,1]}',
                'create_by' => 'admin@gmail.com',
            ]);
            $userAdmin = User::create([
                'name' => 'admin',
                'email' => 'admin@eaccount.xyz',
                'role_manage_id' => $admin_user->id,
                'password' => bcrypt('1234'),
                'create_by' => 'System',
            ]);
            Profile::create([
                "user_ID" => $userAdmin->id,
                "first_name" => "Sumon",
                "last_name" => "Dada",
                "gender" => 1,
                "designation" => "Software Engineer",
                "phone_number" => "+8801738578683",
                "NID" => "199412478654477",
                "permanent_address" => "Nilkhet",
                "present_address" => "Dhaka,Bangladesh",
                'avatar' => 'upload/avatar/avatar.png',
                "education" => 'B.Sc. in Computer Science & Engineering',
                'description' => ''
            ]);

            // account manager
            $account_manager = RoleManage::create([
                'name' => 'Accountant',
                'content' => '{"User":["User ",0,0,0,0,0,0,0,0,0],"RoleManager":["Role Manager",0,0,0,0,0,0,0,0,0],"Settings":["Settings",0,0,0,0,0,0,0,0,0],"Language":["Language",0,0,0,0,0,0,0,0,0],"Project":["Project",0,0,0,0,0,0,0,0,0],"Product":["Product",0,0,0,0,0,0,0,0,0],"Sell":["Sell",0,0,0,0,0,0,0,0,0],"PurchaseRequisition":["Purchase Requisition",0,0,0,0,0,0,0,0,0],"PurchaseRQNConfirm":["Purchase RQN Confirm",0,0,0,0,0,0,0,0,0],"PurchaseOrder":["Purchase Order",0,0,0,0,0,0,0,0,0],"Vendor":["Vendor",0,0,0,0,0,0,0,0,0],"Employee":["Employee",0,0,0,0,0,0,0,0,0],"Customer":["Customer",0,0,0,0,0,0,0,0,0],"PurchaseReport":["PurchaseReport",0,0,0,0,0,0,0,0,0],"SellsReport":["Sells Report",0,0,0,0,0,0,0,0,0],"LedgerType":["Ledger Type",1,1,1,1,1,1,1,1,1],"LedgerGroup":["Ledger Group",1,1,1,1,1,1,1,1,1],"LedgerName":["Ledger Name",1,1,1,1,1,1,1,1,1],"BankCash":["Bank Cash",1,1,1,1,1,1,1,1,1],"InitialIncomeExpenseHeadBalance":["Initial Income Expense Head Balance",0,0,0,0,0,0,0,0,0],"InitialBankCashBalance":["Initial Bank Cash Balance",0,0,0,0,0,0,0,0,0],"DrVoucher":["Dr Voucher",1,1,1,1,1,1,1,1,1],"CrVoucher":["Cr Voucher",1,1,1,1,1,1,1,1,1],"JnlVoucher":["Jnl Voucher",1,1,1,1,1,1,1,1,1],"ContraVoucher":["Contra Voucher",1,1,1,1,1,1,1,1,1],"Ledger":["Ledger",1,1,1,1,1,1,1,1,1],"TrialBalance":["Trial Balance",1,1,1,1,1,1,1,1,1],"CostOfRevenue":["Cost Of Revenue",1,1,1,1,1,1,1,1,1],"ProfitOrLossAccount":["Profit Or Loss Account",1,1,1,1,1,1,1,1,1],"RetainedEarning":["Retained Earning",1,1,1,1,1,1,1,1,1],"FixedAssetsSchedule":["Fixed Assets Schedule",1,1,1,1,1,1,1,1,1],"StatementOfFinancialPosition":["Statement Of Financial Position",1,1,1,1,1,1,1,1,1],"CashFlow":["Cash Flow",1,1,1,1,1,1,1,1,1],"ReceiveAndPayment":["Receive And Payment",1,1,1,1,1,1,1,1,1],"Notes":["Notes",1,1,1,1,1,1,1,1,1],"GeneralBranch":["General Branch Report",0,0,0,0,0,0,0,0,0],"GeneralLedger":["General Ledger Report",0,0,0,0,0,0,0,0,0],"GeneralBankCash":["General Bank Cash Report",0,0,0,0,0,0,0,0,0],"GeneralVoucher":["General Voucher Report",0,0,0,0,0,0,0,0,0]}',
                'create_by' => 'system@eaccount.xyz',
            ]);
            $accountant = User::create([
                'name' => 'Accountant',
                'email' => 'accountant@eaccount.xyz',
                'role_manage_id' => $account_manager->id,
                'password' => bcrypt('1234'),
                'create_by' => 'System',
            ]);
            Profile::create([
                "user_ID" => $accountant->id,
                "first_name" => "Md",
                "last_name" => "Abdullah",
                "gender" => 1,
                "designation" => "Software Engineer",
                "phone_number" => "+8801738578683",
                "NID" => "199412478654477",
                "permanent_address" => "Uttara dhaka",
                "present_address" => "Dhaka,Bangladesh",
                'avatar' => 'upload/avatar/avatar.png',
                "education" => 'B.Sc. in Computer Science & Engineering',
                'description' => ''
            ]);

            // Project Manager
            $project_manager = RoleManage::create([
                'name' => 'Project Manager',
                'content' => '{"User":["User ",0,0,0,0,0,0,0,0,0],"RoleManager":["Role Manager",0,0,0,0,0,0,0,0,0],"Settings":["Settings",0,0,0,0,0,0,0,0,0],"Language":["Language",0,0,0,0,0,0,0,0,0],"Project":["Project",1,1,1,1,1,1,1,1,1],"Product":["Product",0,0,0,0,0,0,0,0,0],"Sell":["Sell",0,0,0,0,0,0,0,0,0],"PurchaseRequisition":["Purchase Requisition",0,0,0,0,0,0,0,0,0],"PurchaseRQNConfirm":["Purchase RQN Confirm",0,0,0,0,0,0,0,0,0],"PurchaseOrder":["Purchase Order",0,0,0,0,0,0,0,0,0],"Vendor":["Vendor",0,0,0,0,0,0,0,0,0],"Employee":["Employee",0,0,0,0,0,0,0,0,0],"Customer":["Customer",0,0,0,0,0,0,0,0,0],"PurchaseReport":["PurchaseReport",0,0,0,0,0,0,0,0,0],"SellsReport":["Sells Report",0,0,0,0,0,0,0,0,0],"LedgerType":["Ledger Type",0,0,0,0,0,0,0,0,0],"LedgerGroup":["Ledger Group",0,0,0,0,0,0,0,0,0],"LedgerName":["Ledger Name",0,0,0,0,0,0,0,0,0],"BankCash":["Bank Cash",0,0,0,0,0,0,0,0,0],"InitialIncomeExpenseHeadBalance":["Initial Income Expense Head Balance",0,0,0,0,0,0,0,0,0],"InitialBankCashBalance":["Initial Bank Cash Balance",0,0,0,0,0,0,0,0,0],"DrVoucher":["Dr Voucher",0,0,0,0,0,0,0,0,0],"CrVoucher":["Cr Voucher",0,0,0,0,0,0,0,0,0],"JnlVoucher":["Jnl Voucher",0,0,0,0,0,0,0,0,0],"ContraVoucher":["Contra Voucher",0,0,0,0,0,0,0,0,0],"Ledger":["Ledger",0,0,0,0,0,0,0,0,0],"TrialBalance":["Trial Balance",0,0,0,0,0,0,0,0,0],"CostOfRevenue":["Cost Of Revenue",0,0,0,0,0,0,0,0,0],"ProfitOrLossAccount":["Profit Or Loss Account",0,0,0,0,0,0,0,0,0],"RetainedEarning":["Retained Earning",0,0,0,0,0,0,0,0,0],"FixedAssetsSchedule":["Fixed Assets Schedule",0,0,0,0,0,0,0,0,0],"StatementOfFinancialPosition":["Statement Of Financial Position",0,0,0,0,0,0,0,0,0],"CashFlow":["Cash Flow",0,0,0,0,0,0,0,0,0],"ReceiveAndPayment":["Receive And Payment",0,0,0,0,0,0,0,0,0],"Notes":["Notes",0,0,0,0,0,0,0,0,0],"GeneralBranch":["General Branch Report",0,0,0,0,0,0,0,0,0],"GeneralLedger":["General Ledger Report",0,0,0,0,0,0,0,0,0],"GeneralBankCash":["General Bank Cash Report",0,0,0,0,0,0,0,0,0],"GeneralVoucher":["General Voucher Report",0,0,0,0,0,0,0,0,0]}',
                'create_by' => 'superadmin@gmail.com',
            ]);
            $project = User::create([
                'name' => 'Project Manager',
                'email' => 'projectmanager@eaccount.xyz',
                'role_manage_id' => $project_manager->id,
                'password' => bcrypt('1234'),
                'create_by' => 'System',
            ]);
            Profile::create([
                "user_ID" => $project->id,
                "first_name" => "Md",
                "last_name" => "Abdullah",
                "gender" => 1,
                "designation" => "Software Engineer",
                "phone_number" => "+8801738578683",
                "NID" => "199412478654477",
                "permanent_address" => "Uttara dhaka",
                "present_address" => "Dhaka,Bangladesh",
                'avatar' => 'upload/avatar/avatar.png',
                "education" => 'B.Sc. in Computer Science & Engineering',
                'description' => ''
            ]);

            $product_manager_role = RoleManage::create([
                'name' => 'Product Manager',
                'content' => '{"User":["User ",0,0,0,0,0,0,0,0,0],"RoleManager":["Role Manager",0,0,0,0,0,0,0,0,0],"Settings":["Settings",0,0,0,0,0,0,0,0,0],"Language":["Language",0,0,0,0,0,0,0,0,0],"Project":["Project",0,0,0,0,0,0,0,0,0],"Product":["Product",1,1,1,1,1,1,1,1,1],"Sell":["Sell",0,0,0,0,0,0,0,0,0],"PurchaseRequisition":["Purchase Requisition",1,1,1,1,1,1,1,1,1],"PurchaseRQNConfirm":["Purchase RQN Confirm",1,1,1,1,1,1,1,1,1],"PurchaseOrder":["Purchase Order",1,1,1,1,1,1,1,1,1],"Vendor":["Vendor",0,0,0,0,0,0,0,0,0],"Employee":["Employee",0,0,0,0,0,0,0,0,0],"Customer":["Customer",0,0,0,0,0,0,0,0,0],"LedgerType":["Ledger Type",0,0,0,0,0,0,0,0,0],"LedgerGroup":["Ledger Group",0,0,0,0,0,0,0,0,0],"LedgerName":["Ledger Name",0,0,0,0,0,0,0,0,0],"BankCash":["Bank Cash",0,0,0,0,0,0,0,0,0],"InitialIncomeExpenseHeadBalance":["Initial Income Expense Head Balance",0,0,0,0,0,0,0,0,0],"InitialBankCashBalance":["Initial Bank Cash Balance",0,0,0,0,0,0,0,0,0],"DrVoucher":["Dr Voucher",0,0,0,0,0,0,0,0,0],"CrVoucher":["Cr Voucher",0,0,0,0,0,0,0,0,0],"JnlVoucher":["Jnl Voucher",0,0,0,0,0,0,0,0,0],"ContraVoucher":["Contra Voucher",0,0,0,0,0,0,0,0,0],"Ledger":["Ledger",0,0,0,0,0,0,0,0,0],"TrialBalance":["Trial Balance",0,0,0,0,0,0,0,0,0],"CostOfRevenue":["Cost Of Revenue",0,0,0,0,0,0,0,0,0],"ProfitOrLossAccount":["Profit Or Loss Account",0,0,0,0,0,0,0,0,0],"RetainedEarning":["Retained Earning",0,0,0,0,0,0,0,0,0],"FixedAssetsSchedule":["Fixed Assets Schedule",0,0,0,0,0,0,0,0,0],"StatementOfFinancialPosition":["Statement Of Financial Position",0,0,0,0,0,0,0,0,0],"CashFlow":["Cash Flow",0,0,0,0,0,0,0,0,0],"ReceiveAndPayment":["Receive And Payment",0,0,0,0,0,0,0,0,0],"Notes":["Notes",0,0,0,0,0,0,0,0,0],"PurchaseReport":["PurchaseReport",1,1,1,1,1,1,1,1,1],"SellsReport":["Sells Report",0,0,0,0,0,0,0,0,0],"GeneralBranch":["General Branch Report",0,0,0,0,0,0,0,0,0],"GeneralLedger":["General Ledger Report",0,0,0,0,0,0,0,0,0],"GeneralBankCash":["General Bank Cash Report",0,0,0,0,0,0,0,0,0],"GeneralVoucher":["General Voucher Report",0,0,0,0,0,0,0,0,0]}',
                'create_by' => 'system@eaccount.xyz',
            ]);
            $product_manager = User::create([
                'name' => 'Product Manager',
                'email' => 'productmanager@eaccount.xyz',
                'role_manage_id' => $product_manager_role->id,
                'password' => bcrypt('1234'),
                'create_by' => 'System',
            ]);
            Profile::create([
                "user_ID" => $product_manager->id,
                "first_name" => "Md",
                "last_name" => "Abdullah",
                "gender" => 1,
                "designation" => "Software Engineer",
                "phone_number" => "+8801738578683",
                "NID" => "199412478654477",
                "permanent_address" => "Uttara dhaka",
                "present_address" => "Dhaka,Bangladesh",
                'avatar' => 'upload/avatar/avatar.png',
                "education" => 'B.Sc. in Computer Science & Engineering',
                'description' => ''
            ]);

            // sells manager
            $sells_manager_role = RoleManage::create([
                'name' => 'Sells Manager',
                'content' => '{"User":["User ",0,0,0,0,0,0,0,0,0],"RoleManager":["Role Manager",0,0,0,0,0,0,0,0,0],"Settings":["Settings",0,0,0,0,0,0,0,0,0],"Language":["Language",0,0,0,0,0,0,0,0,0],"Project":["Project",1,1,1,1,1,1,1,1,1],"Product":["Product",1,1,1,1,1,1,1,1,1],"Sell":["Sell",1,1,1,1,1,1,1,1,1],"PurchaseRequisition":["Purchase Requisition",0,0,0,0,0,0,0,0,0],"PurchaseRQNConfirm":["Purchase RQN Confirm",0,0,0,0,0,0,0,0,0],"PurchaseOrder":["Purchase Order",0,0,0,0,0,0,0,0,0],"Vendor":["Vendor",0,0,0,0,0,0,0,0,0],"Employee":["Employee",0,0,0,0,0,0,0,0,0],"Customer":["Customer",0,0,0,0,0,0,0,0,0],"PurchaseReport":["PurchaseReport",0,0,0,0,0,0,0,0,0],"SellsReport":["Sells Report",1,1,1,1,1,1,1,1,1],"LedgerType":["Ledger Type",0,0,0,0,0,0,0,0,0],"LedgerGroup":["Ledger Group",0,0,0,0,0,0,0,0,0],"LedgerName":["Ledger Name",0,0,0,0,0,0,0,0,0],"BankCash":["Bank Cash",0,0,0,0,0,0,0,0,0],"InitialIncomeExpenseHeadBalance":["Initial Income Expense Head Balance",0,0,0,0,0,0,0,0,0],"InitialBankCashBalance":["Initial Bank Cash Balance",0,0,0,0,0,0,0,0,0],"DrVoucher":["Dr Voucher",0,0,0,0,0,0,0,0,0],"CrVoucher":["Cr Voucher",0,0,0,0,0,0,0,0,0],"JnlVoucher":["Jnl Voucher",0,0,0,0,0,0,0,0,0],"ContraVoucher":["Contra Voucher",0,0,0,0,0,0,0,0,0],"Ledger":["Ledger",0,0,0,0,0,0,0,0,0],"TrialBalance":["Trial Balance",0,0,0,0,0,0,0,0,0],"CostOfRevenue":["Cost Of Revenue",0,0,0,0,0,0,0,0,0],"ProfitOrLossAccount":["Profit Or Loss Account",0,0,0,0,0,0,0,0,0],"RetainedEarning":["Retained Earning",0,0,0,0,0,0,0,0,0],"FixedAssetsSchedule":["Fixed Assets Schedule",0,0,0,0,0,0,0,0,0],"StatementOfFinancialPosition":["Statement Of Financial Position",0,0,0,0,0,0,0,0,0],"CashFlow":["Cash Flow",0,0,0,0,0,0,0,0,0],"ReceiveAndPayment":["Receive And Payment",0,0,0,0,0,0,0,0,0],"Notes":["Notes",0,0,0,0,0,0,0,0,0],"GeneralBranch":["General Branch Report",0,0,0,0,0,0,0,0,0],"GeneralLedger":["General Ledger Report",0,0,0,0,0,0,0,0,0],"GeneralBankCash":["General Bank Cash Report",0,0,0,0,0,0,0,0,0],"GeneralVoucher":["General Voucher Report",0,0,0,0,0,0,0,0,0]}',
                'create_by' => 'system@eaccount.xyz',
            ]);
            $sells_manager = User::create([
                'name' => 'Sells Manager',
                'email' => 'sellsmanager@eaccount.xyz',
                'role_manage_id' => $sells_manager_role->id,
                'password' => bcrypt('1234'),
                'create_by' => 'System',
            ]);
            Profile::create([
                "user_ID" => $sells_manager->id,
                "first_name" => "Most",
                "last_name" => "Kamrunnahar",
                "gender" => 1,
                "designation" => "Software Engineer",
                "phone_number" => "+8801738578683",
                "NID" => "199412478654477",
                "permanent_address" => "Uttara dhaka",
                "present_address" => "Dhaka,Bangladesh",
                'avatar' => 'upload/avatar/avatar.png',
                "education" => 'B.Sc. in Computer Science & Engineering',
                'description' => ''
            ]);
            // purchase manager
            $purchase_manager_role = RoleManage::create([
                'name' => 'Purchase Manager',
                'content' => '{"User":["User ",0,0,0,0,0,0,0,0,0],"RoleManager":["Role Manager",0,0,0,0,0,0,0,0,0],"Settings":["Settings",0,0,0,0,0,0,0,0,0],"Language":["Language",0,0,0,0,0,0,0,0,0],"Project":["Project",0,0,0,0,0,0,0,0,0],"Product":["Product",0,0,0,0,0,0,0,0,0],"Sell":["Sell",0,0,0,0,0,0,0,0,0],"PurchaseRequisition":["Purchase Requisition",1,1,1,1,1,1,1,1,1],"PurchaseRQNConfirm":["Purchase RQN Confirm",1,1,1,1,1,1,1,1,1],"PurchaseOrder":["Purchase Order",1,1,1,1,1,1,1,1,1],"Vendor":["Vendor",1,1,1,1,1,1,1,1,1],"Employee":["Employee",1,1,1,1,1,1,1,1,1],"Customer":["Customer",1,1,1,1,1,1,1,1,1],"PurchaseReport":["PurchaseReport",1,1,1,1,1,1,1,1,1],"SellsReport":["Sells Report",0,0,0,0,0,0,0,0,0],"LedgerType":["Ledger Type",0,0,0,0,0,0,0,0,0],"LedgerGroup":["Ledger Group",0,0,0,0,0,0,0,0,0],"LedgerName":["Ledger Name",0,0,0,0,0,0,0,0,0],"BankCash":["Bank Cash",0,0,0,0,0,0,0,0,0],"InitialIncomeExpenseHeadBalance":["Initial Income Expense Head Balance",0,0,0,0,0,0,0,0,0],"InitialBankCashBalance":["Initial Bank Cash Balance",0,0,0,0,0,0,0,0,0],"DrVoucher":["Dr Voucher",0,0,0,0,0,0,0,0,0],"CrVoucher":["Cr Voucher",0,0,0,0,0,0,0,0,0],"JnlVoucher":["Jnl Voucher",0,0,0,0,0,0,0,0,0],"ContraVoucher":["Contra Voucher",0,0,0,0,0,0,0,0,0],"Ledger":["Ledger",0,0,0,0,0,0,0,0,0],"TrialBalance":["Trial Balance",0,0,0,0,0,0,0,0,0],"CostOfRevenue":["Cost Of Revenue",0,0,0,0,0,0,0,0,0],"ProfitOrLossAccount":["Profit Or Loss Account",0,0,0,0,0,0,0,0,0],"RetainedEarning":["Retained Earning",0,0,0,0,0,0,0,0,0],"FixedAssetsSchedule":["Fixed Assets Schedule",0,0,0,0,0,0,0,0,0],"StatementOfFinancialPosition":["Statement Of Financial Position",0,0,0,0,0,0,0,0,0],"CashFlow":["Cash Flow",0,0,0,0,0,0,0,0,0],"ReceiveAndPayment":["Receive And Payment",0,0,0,0,0,0,0,0,0],"Notes":["Notes",0,0,0,0,0,0,0,0,0],"GeneralBranch":["General Branch Report",0,0,0,0,0,0,0,0,0],"GeneralLedger":["General Ledger Report",0,0,0,0,0,0,0,0,0],"GeneralBankCash":["General Bank Cash Report",0,0,0,0,0,0,0,0,0],"GeneralVoucher":["General Voucher Report",0,0,0,0,0,0,0,0,0]}',
                'create_by' => 'system@eaccount.xyz',
            ]);
            $purchase_manager = User::create([
                'name' => 'Purchase Manager',
                'email' => 'purchasemanager@eaccount.xyz',
                'role_manage_id' => $purchase_manager_role->id,
                'password' => bcrypt('1234'),
                'create_by' => 'System',
            ]);
            Profile::create([
                "user_ID" => $purchase_manager->id,
                "first_name" => "Most",
                "last_name" => "Resma",
                "gender" => 1,
                "designation" => "Graphics Designer",
                "phone_number" => "+8801738578683",
                "NID" => "199412478654477",
                "permanent_address" => "Uttara dhaka",
                "present_address" => "Dhaka,Bangladesh",
                'avatar' => 'upload/avatar/avatar.png',
                "education" => 'B.Sc. in Computer Science & Engineering',
                'description' => ''
            ]);
        }
    }
}
