<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VaccinationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $location1 = \App\Models\Location::find(1);
        $location2 = \App\Models\Location::find(2);
        $location3 = \App\Models\Location::find(3);
        $location4 = \App\Models\Location::find(4);

        $vaccination1 = new \App\Models\Vaccination;
        $vaccination1->vaccDate = new DateTime('2021-05-20');
        $vaccination1->from = new DateTime('2021-05-20T10:00');
        $vaccination1->to = new DateTime('2021-05-20T18:00');
        $vaccination1->peopleMax = 500;
        $vaccination1->location()->associate($location2);
        $vaccination1->save();

        $vaccination2 = new \App\Models\Vaccination;
        $vaccination2->vaccDate = new DateTime('2021-05-21');
        $vaccination2->from = new DateTime('2021-05-21T08:00');
        $vaccination2->to = new DateTime('2021-05-21T18:00');
        $vaccination2->peopleMax = 2000;
        $vaccination2->location()->associate($location3);
        $vaccination2->save();

        $vaccination3 = new \App\Models\Vaccination;
        $vaccination3->vaccDate = new DateTime('2021-05-22');
        $vaccination3->from = new DateTime('2021-05-22T08:00');
        $vaccination3->to = new DateTime('2021-05-22T18:00');
        $vaccination3->peopleMax = 1500;
        $vaccination3->location()->associate($location4);
        $vaccination3->save();

        $vaccination4 = new \App\Models\Vaccination;
        $vaccination4->vaccDate = new DateTime('2021-05-22');
        $vaccination4->from = new DateTime('2021-05-22T08:00');
        $vaccination4->to = new DateTime('2021-05-22T18:00');
        $vaccination4->peopleMax = 3000;
        $vaccination4->location()->associate($location1);
        $vaccination4->save();
    }
}
