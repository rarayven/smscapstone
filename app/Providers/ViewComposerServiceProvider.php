<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Budget;
use App\Councilor;
use App\Application;
use Auth;
use App\Allocatebudget;
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
    		else {
    			$application = Application::join('users','student_details.user_id','users.id')
    			->join('user_councilor','users.id','user_councilor.user_id')
    			->where('users.type','Student')
    			->where('user_councilor.councilor_id', function($query){
    				$query->from('user_councilor')
    				->join('users','user_councilor.user_id','users.id')
    				->join('councilors','user_councilor.councilor_id','councilors.id')
    				->select('councilors.id')
    				->where('user_councilor.user_id',Auth::id())
    				->first();
    			})
    			->where('student_details.application_status','Accepted')
    			->where('student_status','Continuing')
    			->count();
    			$allocation = Allocatebudget::join('allocations','user_allocation.allocation_id','allocations.id')
    			->whereIn('allocation_id', function($query) use($budget) {
    				$query->from('allocations')
    				->where('budget_id', $budget->id)
    				->select('id')
    				->get();
    			})
    			->select('allocations.amount')
    			->get();
    			$budget->slot_count -= $application;
    			foreach ($allocation as $allocations) {
    				$budget->amount -= $allocations->amount;
    			}
    		}
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
