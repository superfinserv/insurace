<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use App\Visitor;
use Auth;
use Carbon\Carbon;
class EnqVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,$param)
    {
        
        $ip = $request->ip();//hash('sha512', $request->ip());
        if(Visitor::where('customer_id', Auth::guard('customers')->user()->id)
                    ->whereDay('created_at', '=', date('d'))
                    ->whereMonth('created_at', '=', date('m'))
                    ->whereYear('created_at', '=', date('Y')) 
                    ->where('enQFor',$param)
                    ->where('ip_address', $ip)->count() < 1)
                   
        {
            Visitor::create([
                'customer_id'=> Auth::guard('customers')->user()->id,
                'mobile'=>Auth::guard('customers')->user()->mobile,
                'ip_address' => $ip,
                'enQFor'=>$param
            ]);
        }
        return $next($request);
    }
}
