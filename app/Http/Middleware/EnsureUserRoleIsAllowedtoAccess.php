<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class EnsureUserRoleIsAllowedtoAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

//         $userRole  =auth()->user()->role;
//    $currentRouteName =substr( URL::current(),22);
//    if (in_array($currentRouteName,$this->userAccessRole()[$userRole])) {
//     return $next($request);
//    }else{
//        abort(404,'not found');
// }
$userRole  =auth()->user()->role;

if ($userRole=='admin') {
 return $next($request);
}else{
    //abort(404,'not found');
    return redirect('/');
}



        exit;

    }
    // private function userAccessRole()
    // {
    //     return [
    //         'user'=>[
    //             ' ',
    //         ],
    //         'admin'=>[
    //             'cat',
    //             'subcat/',
    //         ],
    //     ];
    // }
}
