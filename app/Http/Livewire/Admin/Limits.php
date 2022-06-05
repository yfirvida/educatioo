<?php

namespace App\Http\Livewire\Admin;
use App\Models\Plan;
use Livewire\Component;

class Limits extends Component
{
    public $gLimit, $cLimit, $sLimit; //Basic
    public $pgLimit, $pcLimit, $psLimit; //Premium

     public function mount()
    {
        $basic = Plan::find(1);
        $this->gLimit = $basic->groups_limit;
        $this->cLimit = $basic->courses_limit;
        $this->sLimit = $basic->students_limit;

        $premium = Plan::find(2);
        $this->pgLimit = $premium->groups_limit;
        $this->pcLimit = $premium->courses_limit;
        $this->psLimit = $premium->students_limit;

    }

    public function render()
    {
       /* $basic = Plan::find(1);
        $this->gLimit = $basic->groups_limit;
        $this->cLimit = $basic->courses_limit;
        $this->sLimit = $basic->students_limit;

        $premium = Plan::find(2);
        $this->pgLimit = $premium->groups_limit;
        $this->pcLimit = $premium->courses_limit;
        $this->psLimit = $premium->students_limit;*/


        return view('livewire.admin.limits');
    }

    public function storeBasic() {
        $plan = Plan::find(1); //basic

        $plan->courses_limit = $this->cLimit;
        $plan->groups_limit = $this->gLimit;
        $plan->students_limit = $this->sLimit;
 
        $plan->save();

        session()->flash('message', 'Plan Updated Successfully.');
    }
    public function storePremium() {
        $plan = Plan::find(2); //premium

        $plan->courses_limit = $this->pcLimit;
        $plan->groups_limit = $this->pgLimit;
        $plan->students_limit = $this->psLimit;
 
        $plan->save();

        session()->flash('message', 'Plan Updated Successfully .');
        
    }
}
