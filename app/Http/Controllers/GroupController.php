<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Student;
use http\Env\Request;
use Illuminate\Http\RedirectResponse;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $groups = Group::paginate(12);
        return view('groups.index', [
            'groups' => $groups,
        ]);
    }

    /**
     * Edit the form for creating a new resource.
     */
    public function create()
    {
        return view('groups.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGroupRequest $request)
    {

//        dd($request->all());
        $group = Group::create($request->validated());
        return back()->with('status', __('Group created!'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        return view('groups.show', [
            'group' => $group,
        ]);
    }

    /**
     * Edit the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGroupRequest $request, Group $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        //
    }

    //attach student to group

    /**
     * @param Group $group
     * @param Request $request
     * @return RedirectResponse|void
     */
    public function add_students(Group $group,)
    {
        //ceack if the array of students and if each sudent dosnt have group_id tehn link then to the Group
//        dd(request()->all());

        if (is_array(request()->students)) {
            foreach (request()->students as $student_id) {
                $student = Student::find($student_id);
                if ($student->group_id == null) {
//                    $group->students()->attach($student_id);
                    $student->group()->associate($group);
                    $student->save();
                }
            }
            return back()->with('status', __('Students added to group!'));
        }
    }

    //add student to group
    public function add(Group $group)
    {
        $students = Student::where('group_id', null)->get();
        return view('groups.add', [
            'group' => $group,
            'students' => $students,
        ]);
    }
}
