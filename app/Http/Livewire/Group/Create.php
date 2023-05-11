<?php

namespace App\Http\Livewire\Group;

use App\Models\Teacher;
use Livewire\Component;

class Create extends Component
{
    public $teachers;
    public function render()
    {
        //trahcers that are not assignd a group
        $this->teachers = Teacher::doesntHave('group')->get();
//        $this->teachers =
        return view('livewire.group.create',['teachers' => $this->teachers]);
    }

}
