<?php

namespace App\Http\Livewire\Group;

use App\Models\Group;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Livewire\WithPagination;

class Add extends Component
{
    //model group
    public Model $group ;
    use WithPagination;
    public $sortField;
    public $sortDirection;
    public $search;
    protected $Students;
    public $group_id;
    public  $Selected = [];
    protected $Selected_Students;
    public function mount()
    {
        $this->sortField = 'created_at';
        $this->sortDirection = 'desc';
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        $this->Selected_Students = Student::query()->whereIn('id', $this->Selected)->where('group_id', null)->get();
//        dd($this->Selected_Students);
        $this->Students = Student::query()->where('group_id', null)->search('name', $this->search)

            ->OrderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.group.add', ['students' =>  $this->Students,  'Selected_Students' => $this->Selected_Students]);
    }

    public function OrderBy($field)
    {

        if ($this->sortField = $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }
}
