<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Record;
use App\Traits\HistoryTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class DashController extends Controller
{
    public function index() {
        return redirect(route('device.index'));
    }

//    public function index()
//    {
//        $records = Record::query()->get()->sortByDesc('created_at');
//        $people = Person::all();
//        $dateformat = 'D MMM YYYY';
//
//        $out = [];
//        $out['records'] = $records;
//        $out['records_today'] = [];
//        $out['temps_today'] = [];
//        $out['timestamps_today'] = [];
//        $out['temps_all'] = [];
//        $out['timestamps_all'] = [];
//        $out['total_in'] = count($records);
//        $out['first_rec_date'] = Carbon::createFromTimeString($records[0]->created_at)->isoFormat($dateformat);
//        $out['last_rec_date'] = Carbon::createFromTimeString($records[count($records) - 1]->created_at)->isoFormat($dateformat);
//        $out['total_reg'] = count($people);
//        $out['total_unreg'] = 0;
//        $out['total_normal'] = 0;
//        $out['total_normal_today'] = 0;
//        $out['total_not_normal'] = 0;
//        $out['total_not_normal_today'] = 0;
//
//        foreach ($records->sortBy('created_at') as $record) {
//            if (HistoryTrait::isTimestampToday($record->created_at)) {
//                array_push($out['records_today'], $record);
//                array_push($out['temps_today'], '"' . $record->temp . '"');
//                array_push($out['timestamps_today'], '"' . Carbon::createFromTimeString($record->created_at)->isoFormat('HH:mm') . '"');
//                if (!($record->temp < 37)) {
//                    $out['total_not_normal_today']++;
//                }else{
//                    $out['total_normal_today']++;
//                }
//            }
//
//            if (!HistoryTrait::isUserRegistered($record->rfid))
//                $out['total_unreg']++;
//
//            array_push($out['temps_all'], '"' . $record->temp . '"');
//            array_push($out['timestamps_all'], '"' . Carbon::createFromTimeString($record->created_at)->isoFormat('YYYY-MM-DD HH:mm') . '"');
//
//            if ($record->temp < 37) {
//                $out['total_normal']++;
//            } else {
//                $out['total_not_normal']++;
//            }
//        }
//
//        $out['total_in_today'] = count($out['records_today']);
//        $out['temps_today'] = implode(', ', $out['temps_today']);
//        $out['timestamps_today'] = implode(', ', $out['timestamps_today']);
//        $out['temps_all'] = implode(', ', $out['temps_all']);
//        $out['timestamps_all'] = implode(', ', $out['timestamps_all']);
//
//        return view('dash.index', $out);
//    }
}
