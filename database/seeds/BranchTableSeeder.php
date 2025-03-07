<?php


use App\Branch;
use Illuminate\Database\Seeder;

class BranchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Branch::create([
            'name' => 'Head Office',
            'location' => 'Nikunja-2,Khilkhet Dhaka-1229 Bangladesh',
        ]);
        if (env('DEMO_MODE', false) == true) {
            Branch::create([
                'name' => 'Millennium Square',
                'location' => 'Kha-199/2, Bir Uttam Rafiqul Islam Ave, Dhaka 1213',
                'facing' => 'North',
                'building_height' => '(G + 9) 10 Storied Building',
                'land_area' => '6.07 Katha',
                'launching_date' => '05/06/2015',
                'hand_over_date' => '05/06/2018',
            ]);
            Branch::create([
                'name' => 'Lake City Garden',
                'location' => 'Namapara Khilkhet, 1229 Dhaka, Bangladesh',
                'facing' => 'South',
                'building_height' => '(G + 8) 9 Storied Building',
                'land_area' => '8 Katha',
                'launching_date' => '05/06/2018',
                'hand_over_date' => '05/06/2019',
            ]);
            Branch::create([
                'name' => 'Software Haven',
                'location' => 'Rameshorganti, Raiganj-6700, Sirajgonj, Rajshahi, Dhaka Bangladesh',
                'facing' => 'South',
                'building_height' => '(G + 18) 19 Storied Building',
                'land_area' => '10 Katha',
                'launching_date' => '05/06/2019',
                'hand_over_date' => '05/06/2029',
            ]);
        }
    }
}
