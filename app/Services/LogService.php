<?php

namespace App\Services;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Yajra\Datatables\Datatables as Datatables;
use App\Models\Log;

class LogService
{

    public function listLogs()
    {
        return Log::get();
    }

    public function datatables($logs)
    {
        $tableData = Datatables::of($logs)
            ->addColumn('user', function (Log $log){
                return $log->getUser->name;
            })
            ->rawColumns(['user'])->make(true);

        return $tableData ;
    }

    public function createLog($userId, $entity, $entityId, $description)
    {
        $log = new Log();
        $log->user_id = $userId;
        $log->entity = $entity;
        $log->entity_id = $entityId;
        $log->description = $description;
        $log->save();

        return $log;
    }
}
