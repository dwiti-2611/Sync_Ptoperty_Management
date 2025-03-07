<?php

namespace Database\Seeders;

use App\Employee;
use Illuminate\Database\Seeder;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::create([
            'name' => 'Al-Mahmud',
            'phone' => '01xxxx',
            'email' => 'xx@xx.com',
            'position' => 'Software Engineer',
            'department' => 'Software Department',
            'address' => 'Sirajgonj'
        ]);
        Employee::create([
            'name' => 'S.M Rakib',
            'phone' => '01xxxx',
            'email' => 'xxx@xx.com',
            'position' => 'Hr manage',
            'department' => 'Human Resource',
        ]);
        Employee::create([
            'name' => 'S.M Khokhon',
            'phone' => '01xxxx',
            'email' => 'xxx@gmail.com',
            'position' => 'Accountant',
            'department' => '',
        ]);
        Employee::create([
            'name' => 'Kamrunnar Bithi',
            'phone' => '01xxxx',
            'email' => 'xxx@gmail.com',
            'position' => 'Managing Director',
            'department' => '',
        ]);
    }
}
