<?php

namespace App\Providers;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['admin.category.index'], function($view){
            $view->with('categories', Category::paginate(2));
        });

        View::composer(['admin.category.index', 'admin.category.edit'], function($view){
            $view->with('cats', Category::all());
        });

        View::composer(['admin.attribute.index'], function($view){
            $view->with('attributes', Attribute::paginate(2));
            $view->with('values', AttributeValue::paginate(5));
        });

    }
}
