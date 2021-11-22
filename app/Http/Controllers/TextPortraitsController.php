<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TextPortraitsController extends Controller
{
    public function index()
    {
        return view('text-portraits.index');
    }

    public function store()
    {
        // dd(request()->all());
        dd(request()->file('image'));

        // $attributes = request()->validate([
        //     'name' => 'required|regex:/^[\pL\s\.\-]+$/u',
        //     'contact_number' => 'required|numeric',
        //     'email' => 'required|email|unique:students,email',
        //     'address' => 'required',
        //     'parent_ids' => 'json',
        //     'basic-math' => 'nullable|numeric',
        //     'adv-math' => 'nullable|numeric',
        //     'adv-pp-math' => 'nullable|numeric',
        // ]);

        // $student = Student::create($attributes);

        // $parents = json_decode($attributes['parent_ids'], true);

        // foreach ($parents as $parent) {
        //     GuardianStudent::create([
        //         'student_id' => $student['id'],
        //         'parent_id' => $parent,
        //     ]);
        // }

        // if (isset($attributes['basic-math'])) {
        //     CourseStudent::create([
        //         'student_id' => $student['id'],
        //         'course_id' => $attributes['basic-math'],
        //     ]);
        // }
        // if (isset($attributes['adv-math'])) {
        //     CourseStudent::create([
        //         'student_id' => $student['id'],
        //         'course_id' => $attributes['adv-math'],
        //     ]);
        // }
        // if (isset($attributes['adv-pp-math'])) {
        //     CourseStudent::create([
        //         'student_id' => $student['id'],
        //         'course_id' => $attributes['adv-pp-math'],
        //     ]);
        // }

        // return redirect()->route('home')->with('success', 'Student created!');
    }
}
