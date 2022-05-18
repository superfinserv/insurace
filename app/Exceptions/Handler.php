<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\AuthenticationException;
 use Auth; 

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Throwable
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }
    
//     public function render($request, Exception $exception){
//     if ($this->isHttpException($exception)) {
//         if ($exception->getStatusCode() == 404) {
//             return response()->view('errors.' . '404', [], 404);
//         }
//         if ($exception->getStatusCode() == 500) {
//             return response()->view('errors.' . '500', [], 500);
//         }
//     }
//     return parent::render($request, $exception);
// }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        return parent::render($request, $exception);
    }
    
    protected function unauthenticated($request, AuthenticationException $exception)
        {
            // print_r($request->url());
             $subdomain = explode("//",explode('.', $request->url())[0])[1];
             
            if($request->expectsJson()){
                return response()->json(['status' =>'error','message'=>'Unauthenticated'], 401);
            }else if($subdomain=="superfinserv"){
                  return redirect('/sign-in');
            }else if ($subdomain=='admin') {
                 return redirect('/login');
            }else if ($subdomain=='pos') {
                return redirect('/login');
                //return redirect()->guest('/login/writer');
            }else if ($subdomain=='api') {
                 return response()->json(['status' =>'error','message'=>'Unauthenticated'], 401);
            }else{
                return redirect()->guest(route('login')); 
            }
            // if ($request->expectsJson()) {
            //     return response()->json(['error' => 'Unauthenticated.'], 401);
            // }else{
            //     redirect()->guest(route('login',$subdomain));
            // }
            // if ($request->is('admin') || $request->is('admin/*')) {
            //     return redirect()->guest('/login');
            // }
            // if ($request->is('pos') || $request->is('pos/*')) {
            //     return redirect()->guest('/login');
            // }
            // return redirect()->guest(route('login'));
        }
}
