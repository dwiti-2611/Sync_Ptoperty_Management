<?php

use App\User;
use App\Profile;
use App\RoleManage;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_id = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@eaccount.xyz',
            'role_manage_id' => 1,
            'password' => bcrypt('mamun2074'),
            'create_by' => 'System',
        ]);
        Profile::create([
            "user_ID" => $user_id->id,
            "first_name" => "Super",
            "last_name" => "Admin",
            "gender" => 1,
            "designation" => "PHP Developer",
            "phone_number" => "+8801738578683",
            "NID" => "199412478654477",
            "permanent_address" => "PS: Raygonj, District: Sirajgonj",
            "present_address" => "Dhaka,Bangladesh",
            'avatar' => 'upload/avatar/avatar.png',
            "education" => 'B.Sc in Computer Science & Engineering',
            'description' => ''
        ]);

        if (env('DEMO_MODE', false) == true) {
            $user_id_2 = User::create([
                'name' => 'Admin',
                'email' => 'admin@eaccount.xyz',
                'role_manage_id' => 2,
                'password' => bcrypt('1234'),
                'create_by' => 'System',
            ]);
            Profile::create([
                "user_ID" => $user_id_2->id,
            ]);

            $user_id_3 = User::create([
                'name' => 'Accountant',
                'email' => 'accountant@eaccount.xyz',
                'role_manage_id' => 3,
                'password' => bcrypt('1234'),
                'create_by' => 'System',
            ]);

            Profile::create([
                "user_ID" => $user_id_3->id,
            ]);
            $user_id_4 = User::create([
                'name' => 'Project Manage',
                'email' => 'projectmanager@eaccount.xyz',
                'role_manage_id' => 4,
                'password' => bcrypt('1234'),
                'create_by' => 'System',
            ]);
            Profile::create([
                "user_ID" => $user_id_4->id,
            ]);
            $user_id_5 = User::create([
                'name' => 'Product Manager',
                'email' => 'productmanager@eaccount.xyz',
                'role_manage_id' => 5,
                'password' => bcrypt('1234'),
                'create_by' => 'System',
            ]);
            Profile::create([
                "user_ID" => $user_id_5->id,
            ]);
            $$user_id_6 = User::create([
                'name' => 'Sells Manager',
                'email' => 'sellsmanager@eaccount.xyz',
                'role_manage_id' => 6,
                'password' => bcrypt('1234'),
                'create_by' => 'System',
            ]);
            Profile::create([
                "user_ID" => $user_id_6->id,
            ]);
            $user_id_7 = User::create([
                'name' => 'Purchase Manager',
                'email' => 'purchasemanager@eaccount.xyz',
                'role_manage_id' => 7,
                'password' => bcrypt('1234'),
                'create_by' => 'System',
            ]);
            Profile::create([
                "user_ID" => $user_id_7->id,
            ]);
        }
    }
}
