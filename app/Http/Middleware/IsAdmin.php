<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
   public function handle(Request $request, Closure $next)
{
    if(auth()->check()) 
    {
        $user = auth()->user();

        // Only allow super admin for delete route
        if ($request->route()->getName() == 'admin.list_job_enquiry_delete') 
        {
            if ($user->is_admin == 1) 
            {
                return $next($request);
            } 
            else 
            {
                return redirect()->back()->with('error', 'You do not have delete permission.');
            }
        }

        // Other admin access
        if (in_array($user->is_admin, [1,3,4,5])) 
        {
            return $next($request);
        }

        return redirect('home')->with('error', "You don't have admin access.");
    } 
    else 
    {
        return redirect()->route('login');
    }
}
}
