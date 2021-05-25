<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vaccination1 = \App\Models\Vaccination::find(1);
        $vaccination2 = \App\Models\Vaccination::find(2);
        $vaccination3 = \App\Models\Vaccination::find(3);
        $vaccination4 = \App\Models\Vaccination::find(4);

        $user1 = new \App\Models\User;
        $user1->username = 'PascalW97';
        $user1->password = bcrypt('test');
        $user1->email = 'test@gmail.com';
        $user1->firstName = 'Pascal';
        $user1->lastName = 'Wancura';
        $user1->gender = 'male';
        $user1->birthday = new DateTime('1997-05-25');
        $user1->ssn = 3237250597;
        $user1->phone = '+436504104090';
        $user1->vaccinated = true;
        $user1->admin = true;
        $user1->vaccination()->associate($vaccination1);
        $user1->save();

        $user2 = new \App\Models\User;
        $user2->username = 'AndiW67';
        $user2->password = bcrypt('test1');
        $user2->email = 'test1@gmail.com';
        $user2->firstName = 'Andreas';
        $user2->lastName = 'Wancura';
        $user2->gender = 'male';
        $user2->birthday = new DateTime('1967-04-08');
        $user2->ssn = 3567080367;
        $user2->phone = '+436502242628';
        $user2->vaccinated = false;
        $user2->admin = false;
        $user2->vaccination()->associate($vaccination3);
        $user2->save();

        $user3 = new \App\Models\User;
        $user3->username = 'MaxMust';
        $user3->password = bcrypt('test');
        $user3->email = 'maxmuster@gmail.com';
        $user3->firstName = 'Maximilian';
        $user3->lastName = 'Mustermann';
        $user3->gender = 'male';
        $user3->birthday = new DateTime('1987-02-24');
        $user3->ssn = 2746120295;
        $user3->phone = '+436601239857';
        $user3->vaccinated = true;
        $user3->admin = false;
        $user3->vaccination()->associate($vaccination2);
        $user3->save();

        $user4 = new \App\Models\User;
        $user4->username = 'MarthaMust';
        $user4->password = bcrypt('test');
        $user4->email = 'testmart@gmail.com';
        $user4->firstName = 'Martha';
        $user4->lastName = 'Musterfrau';
        $user4->gender = 'female';
        $user4->birthday = new DateTime('1987-07-28');
        $user4->ssn = 7538280787;
        $user4->phone = '+4365032905925';
        $user4->vaccinated = false;
        $user4->admin = false;
        $user4->vaccination()->associate($vaccination3);
        $user4->save();

        $user5 = new \App\Models\User;
        $user5->username = 'TeSter';
        $user5->password = bcrypt('test');
        $user5->email = 't.stern@gmail.com';
        $user5->firstName = 'Teresa';
        $user5->lastName = 'Stern';
        $user5->gender = 'female';
        $user5->birthday = new DateTime('1999-01-21');
        $user5->ssn = 1982210199;
        $user5->phone = '+436808782142';
        $user5->vaccinated = false;
        $user5->admin = false;
        //$user5->vaccination()->associate($vaccination4);
        $user5->save();
    }
}
