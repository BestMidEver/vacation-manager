<?php

namespace App\Http\Controllers\PageControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrowseRequestsController extends Controller
{
    public function page($tab = 'all', $search = '')
    {
    	$leaves = DB::table('leaves')
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
        ->orderBy('leaves.created_at', 'desc');

        if ($tab !== 'all') {
        	$leaves = $leaves
        	->where('leaves.mode', '=', $tab === 'pending' ? 0 : ($tab === 'accepted' ? 1 : 2));
        }

        if (request()->filled('search')) {
            $leaves = $leaves
            ->where(function ($query) {
                $query->where('users.email', '=', request()->search)
                      ->orwhere('users.name', 'like', '%' . request()->search . '%');
            });
            
        }

        return view('pages.browse_requests')
        ->with('data', $leaves->paginate('20'))
        ->with('search', $search);
    }
}
