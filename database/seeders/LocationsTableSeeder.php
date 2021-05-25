<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $location1 = new \App\Models\Location;
        $location1->zipcode = 4020;
        $location1->city = 'Linz';
        $location1->address = 'Hauptplatz 1';
        $location1->save();

        $location2 = new \App\Models\Location;
        $location2->zipcode = 1005;
        $location2->city = 'Wien';
        $location2->address = 'Petersplatz 1';
        $location2->save();

        $location3 = new \App\Models\Location;
        $location3->zipcode = 5020;
        $location3->city = 'Salzburg';
        $location3->address = 'Sterneckstraße 1';
        $location3->save();

        $location4 = new \App\Models\Location;
        $location4->zipcode = 8005;
        $location4->city = 'Graz';
        $location4->address = 'Landhausgasse 1';
        $location4->save();
    }
}
