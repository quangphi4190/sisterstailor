<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Carbon;
use Modules\Category\Entities\Category;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Carbon::setLocale(config('app.locale'));
        Carbon::serializeUsing(function ($carbon) {
            return $carbon->format('d/m/y H:i:s');
        });
        $othercategory = Category::whereNotIn('id',[1,2])->where('parent_id',Null)->get();
        $nameMen = Category::where('parent_id','1')->get();
        $nameWomen = Category::where('parent_id','2')->get();
        $category = Category::where('id','1')->orwhere('id','2')->get();
        View::share('othercategory',$othercategory);
        View::share('nameMen',$nameMen);
        View::share('nameWomen',$nameWomen);
        View::share('category',$category);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() === 'local') {
            $this->app->register('\Barryvdh\Debugbar\ServiceProvider');
        }
    }
}
