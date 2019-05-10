<?php

namespace App\Http\Controllers\PageControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrowseUsersController extends Controller
{
    public function page($tab = 'all')
    {
    	$users = DB::table('users')
        ->select(
            'users.id as user_id',
            'users.name as user_name',
            'users.hierarchy',
            'users.created_at',
            'users.email'
        )
        ->orderBy('users.created_at', 'desc');

        switch ($tab) {
        	case 'pending-employee':
        		$hierarchy = [0];
        		break;
        	case 'employee':
        		$hierarchy = [1];
        		break;
        	case 'pending-administrator':
        		$hierarchy = [2];
        		break;
        	case 'administrator':
        		$hierarchy = [3, 4];
        		break;
        	default:
        		$hierarchy = [0];
        		break;
        }

        if ($tab !== 'all') {
        	$users = $users
        	->whereIn('users.hierarchy', $hierarchy);
        }

        return view('pages.browse_users')
        ->with('data', $users->paginate('20'));
    }
}
