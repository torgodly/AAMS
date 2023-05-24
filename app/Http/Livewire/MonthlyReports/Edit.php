<?php

namespace App\Http\Livewire\MonthlyReports;

use App\Models\MonthlyReport;
use App\Models\WeeklyReport;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Edit extends Component
{
    public $start_date;
    public $editable = null; // add this line
    public $editedValues = []; // add this line
    protected function rules()
    {
        $rules = [];
        foreach ($this->editedValues as $id => $values) {
            $rules["editedValues.{$id}.fiqh"] = ['numeric', 'between:0,100'];
            $rules["editedValues.{$id}.khata"] = ['numeric', 'between:0,100'];
            $rules["editedValues.{$id}.ahkam"] = ['numeric', 'between:0,100'];
        }
        return $rules;
    }

    public function render()
    {
        $MonthlyReports = Auth::user()->group->students()
            ->whereHas('monthlyReports', function ($query) {
                $query->where('start_date', '=', $this->start_date);
            })
            ->with(['monthlyReports' => function ($query) {
                $query->where('start_date', '=', $this->start_date);
            }])
            ->get()
            ->flatMap(function ($student) {
                return $student->monthlyReports->map(function ($monthlyReport) use ($student) {
                    $monthlyReport['student_name'] = $student->name;
                    return $monthlyReport;
                });
            });

//        dd($MonthlyReports);

        return view('livewire.monthly-reports.edit', compact('MonthlyReports'));
    }




    public function makeEditable($id)
    {
        $this->editable = $id;
    }

    public function resetEditable()
    {
        $this->editable = null;
        $this->editedValues = [];
    }

    public function saveChanges()
    {
        $this->validate();
        foreach ($this->editedValues as $id => $values) {
            // dd($values);
            $weeklyReport = MonthlyReport::find($id);
            // dd($values);
            $weeklyReport->update($values);
        }
        // dd($this->editedValues);
        $this->resetEditable();
    }
}
