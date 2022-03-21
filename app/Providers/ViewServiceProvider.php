<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(){
        
        
        //  View::composer('web.partials.cartModal', function ($view) {
        //     $view->with('cartCount', Cart::getContent()->count())
        //          ->with('isCartEmpty', Cart::isEmpty())
        //          ->with('subTotal',Cart::getSubTotal())
        //          ->with('cartContent', Cart::getContent());
        // });
        View::composer('health.health_profile', function ($view) {
            $host = request()->getHttpHost();
            $subview = ($host=="superfinserv.co.in")?'web':'pos';
            $view->with('subview', $subview);
           
        });
        
        
        //View::share('layout',$layout);  
        //View::with('layout',$layout);
         View::composer('*', function ($view) {
               $host = request()->getHttpHost();
               $layout = ($host=="superfinserv.co.in")?'web.layout.app' : 'pos.layouts.app';
               $uType = ($host=="superfinserv.co.in")?'customer' : 'posp';
               $view->with('layout',$layout)
                    ->with('uType',$uType);
         });
    }
}