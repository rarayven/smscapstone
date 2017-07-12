<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Budget;
use App\Councilor;
use Auth;
class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composeCoordinator();
        $this->composeStudent();
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
    private function composeCoordinator()
    {
        view()->composer('SMS.Coordinator.CoordinatorMain', function($view) {
            $budget = Budget::where('user_id',Auth::id())
            ->latest('id')->first();
            $councilor = Councilor::where('id', function($query){
                $query->from('user_councilor')
                ->select('councilor_id')
                ->where('user_id',Auth::id())
                ->first();
            })->first();
            if($budget==null)
                $budget = (object)['amount' => 0, 'slot_count' => 0];
            $view->withBudget($budget)->withCouncilor($councilor);
        });
    }
    private function composeStudent()
    {
        view()->composer('SMS.Student.StudentMain', function($view) {
            $councilor = Councilor::where('id', function($query){
                $query->from('user_councilor')
                ->select('councilor_id')
                ->where('user_id',Auth::id())
                ->first();
            })->first();
            $view->withCouncilor($councilor);
        });
    }
}
