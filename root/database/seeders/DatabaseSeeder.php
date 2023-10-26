<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\TasksModel;
use App\Models\UsersModel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $bazsi_model = UsersModel::create([
            "us_name" => "Gál Balázs",
            "us_email" => "bgal@freemail.hu",
        ]);

        $dns_model = UsersModel::create([
            "us_name" => "Gál Dénes",
            "us_email" => "dns@freemail.hu",
        ]);

        TasksModel::create([
            "ta_description" => "Porszívózás",
            "ta_usid" => $bazsi_model->us_id,
            "ta_estimatedtime" => "01:00:00",
            "ta_usedtime" => null
        ]);

        TasksModel::create([
            "ta_description" => "Vasalás",
            "ta_usid" => $bazsi_model->us_id,
            "ta_estimatedtime" => "00:30:00",
            "ta_usedtime" => null
        ]);

        TasksModel::create([
            "ta_description" => "Mosás",
            "ta_usid" => $dns_model->us_id,
            "ta_estimatedtime" => "01:30:00",
            "ta_usedtime" => null
        ]);

        TasksModel::create([
            "ta_description" => "Virág locsolás",
            "ta_usid" => $dns_model->us_id,
            "ta_estimatedtime" => "00:20:00",
            "ta_usedtime" => null
        ]);
    }
}
