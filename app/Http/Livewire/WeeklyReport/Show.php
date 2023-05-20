<?php

namespace App\Http\Livewire\WeeklyReport;

use Livewire\Component;
use App\Models\WeeklyReport;
use Illuminate\Support\Facades\Auth;

class Show extends Component
{
    public $start_date;
    public $end_date;
    public $editable = null; // add this line
    public $editedValues = []; // add this line
    protected function rules()
    {
        $rules = [];
        foreach ($this->editedValues as $id => $values) {
            $rules["editedValues.{$id}.exam"] = ['numeric', 'between:0,100'];
            $rules["editedValues.{$id}.commitment"] = ['numeric', 'between:0,100'];
            $rules["editedValues.{$id}.ethics"] = ['numeric', 'between:0,100'];
            $rules["editedValues.{$id}.units"] = ['numeric', 'between:0,100'];
        }
        return $rules;
    }
    public function render()
    {
        $WeeklyReports = Auth::user()->group->students()
            ->whereHas('monthlyReports', function ($query) {
                $query->where('start_date', '=', $this->start_date);
            })
            ->with(['monthlyReports' => function ($query) {
                $query->where('start_date', '=', $this->start_date);
            }, 'monthlyReports.weeklyReports' => function ($query) {
                $query->where('end_date', '=', $this->end_date);
            }])
            ->get()
            ->flatMap(function ($student) {
                return $student->monthlyReports->flatMap(function ($monthlyReport) use ($student) {
                    return $monthlyReport->weeklyReports->map(function ($weeklyReport) use ($student) {
                        $weeklyReport['student_name'] = $student->name;
                        return $weeklyReport;
                    });
                });
            });


        // dd($WeeklyReports);
        return view('livewire.weekly-report.show', [
            'WeeklyReports' => $WeeklyReports,
        ]);
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
            $weeklyReport = WeeklyReport::find($id);
            // dd($values);
            $weeklyReport->update($values);
        }
        // dd($this->editedValues);
        $this->resetEditable();
    }
}
