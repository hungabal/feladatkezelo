<?php

namespace app\Services;

use App\Models\TasksModel;
use DateTime;
use Illuminate\Support\Facades\DB;

class TaskService
{
    public function __construct()
    {

    }

    public function create(array $validated)
    {
        $data = [
            "error" => 0,
            "text" => ""
        ];

        $task = TasksModel::create([
            "ta_description" => $validated["taskDescription"],
            "ta_usid" => $validated["taskUserName"],
            "ta_estimatedtime" => $validated["taskCalcTime"],
            "ta_usedtime" => null,
            "ta_completedat" => null
        ]);

        if ($task == null) {
            $data = [
                "error" => 1,
                "text" => "Hiba a felvétel során!"
            ];
        }

        return json_encode($data);
    }

    public function edit(array $validated)
    {
        $data = [
            "error" => 0,
            "text" => ""
        ];

        $task = TasksModel::where("ta_id", "=", $validated["taskId"])
            ->update([
                "ta_description" => $validated["editTaskDescription"],
                "ta_usid" => $validated["editTaskUserName"],
                "ta_estimatedtime" => $validated["editTaskCalcTime"]
            ]);

        if ($task == 0) {
            $data = [
                "error" => 1,
                "text" => "Hiba a frissítés során!"
            ];
        }

        return json_encode($data);
    }

    public function delete(array $validated)
    {
        $data = [
            "error" => 0,
            "text" => ""
        ];

        $task = TasksModel::where("ta_id", "=", $validated["taskId"])->delete();

        if ($task == 0) {
            $data = [
                "error" => 1,
                "text" => "Nem sikerült a törlés!"
            ];
        }

        return json_encode($data);
    }

    public function status(array $validated)
    {
        $data = [
            "error" => 0,
            "text" => ""
        ];

        if ($validated["selectedStatus"] == "Kesz") {
            $task = TasksModel::where("ta_id", "=", $validated["taskId"])->first();
            $time1 = date("H:i:s");
            $time2 = date_format(date_create($task->ta_createdat), "H:i:s");
            $start_datetime = new DateTime($time1);
            $diff = $start_datetime->diff(new DateTime($time2));

            $updated_task = TasksModel::where("ta_id", "=", $validated["taskId"])
                ->update([
                    "ta_usedtime" => $diff->h . ":" . $diff->i . ":" . $diff->s,
                    "ta_completedat" => date("Y-m-d H:i:s"),
                ]);

            if ($updated_task == 0) {
                $data = [
                    "error" => 1,
                    "text" => "Hiba a frissítés során!"
                ];
            }
        } else {
            $data = [
                "error" => 1,
                "text" => "Nincs ilyen státusz!"
            ];
        }

        return json_encode($data);
    }

    public function list()
    {
        $tasks = TasksModel::join("users", "ta_usid", "=", "us_id")->get();

        return json_encode($tasks);
    }
}
