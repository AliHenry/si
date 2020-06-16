<?php

namespace App\Http\Controllers;


use App\Exports\ExpenditureExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;

class DownloadController extends Controller
{
    public function download($model, $type)
    {
        if ($type && $model){
            $method = '';
            switch ($model){
                case 'menu':
                    $method = new ExpenditureExport();
                    break;
            }
            if ($method !== ''){
                return Excel::download($method, $model.'.'.$type);
            }
        }


    }
}
