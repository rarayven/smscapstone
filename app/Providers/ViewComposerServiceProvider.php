<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Budget;
class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composeCoordinatorBudget();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    private function composeCoordinatorBudget()
    {
        view()->composer('*', function($view) {
            $budget = Budget::latest('id')->first();
            $view->withBudget($budget);
        });
    }
}
