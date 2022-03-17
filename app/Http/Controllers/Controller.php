<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
//     public function authcheck()
// {

//          $id = Auth::id();
//     $prtest = User::where('id', '=',$id)->first();
//     //$prtest->count();
//     $role = $prtest->role;
//     if ($role == 0) {
//         return redirect('/');
//     }
// }
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
