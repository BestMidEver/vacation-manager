<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class NavigateCalendar
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->year == '' || $request->month == '') {
            $time = Carbon::now();
            return redirect('/calendar/'.$time->format('Y').'/'.$time->format('n'));
        }

        if ($request->navigate == '') {
            return $next($request);
        }

        $time = new Carbon($request->year.'-'.$request->month);

        if ($request->navigate === 'previous-year') {
            $time->subYear();
        } else if ($request->navigate === 'next-year') {
            $time->addYear();
        } else if ($request->navigate === 'previous-month') {
            $time->subMonth();
        } else if ($request->navigate === 'next-month') {
            $time->addMonth();
        }

        return redirect('/calendar/'.$time->format('Y').'/'.$time->format('n'));
    }
}
