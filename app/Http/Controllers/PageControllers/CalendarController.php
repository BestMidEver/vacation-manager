<?php

namespace App\Http\Controllers\PageControllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
    public function page($year = '', $month = '')
    {
		$time = new Carbon($year.'-'.$month);
		$firstDay = clone $time;
		$firstDay->startOfWeek();

    	$requests_array = array();
    	for ($i = 0; $i < 42; $i++) {
			$day_data = new \stdClass();
    		$day = clone $firstDay;
    		$day->addDays($i);
    		$day_data->month = $day->format('n');
    		$day_data->day = $day->format('j').'';
    		$day_data->requests = DB::table('leaves')
        	->join('users', 'users.id', '=', 'leaves.user_id')
        	->leftjoin('users as u2', 'u2.id', '=', 'leaves.administrator_id')
	        ->select(
	            'users.id as user_id',
	            'users.name as user_name',
	            'u2.name as administrator_name',
	            'leaves.mode',
	            'leaves.start_date',
	            'leaves.vacation_days',
	            'leaves.id as id',
	            'leaves.created_at as created_at',
	            'leaves.updated_at as updated_at'
	        )
	    	->whereRaw('DATE("'.$day->format('Y-n-j').'") >= leaves.start_date AND
	    		DATE("'.$day->format('Y-n-j').'") <= DATE_ADD(leaves.start_date, INTERVAL leaves.vacation_days - 1 DAY) ')
	        ->orderBy('leaves.created_at', 'asc')
	    	->get();
    		array_push($requests_array, $day_data);
    	}

        return view('pages.calendar')
        ->with('time', $time)
        ->with('requests_array', $requests_array);
    }
}
