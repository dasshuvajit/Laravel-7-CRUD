<?php

namespace App\Http\Controllers;

use Session;
use App\Student;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = Student::all();
        return view('student.index')->with('students', $student);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());

        $this->validate($request, [
            'name' => "required",
            'email' => "required",
        ]);

        Student::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        Session::flash('success', 'Student Created Successfully!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student, $id)
    {
        $student = Student::find($id);
        return view('student.edit')->with('student', $student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student, $id)
    {
//        dd($request->all());

        $this->validate($request, [
            'name' => "required",
            'email' => "required",
        ]);

        $student = Student::find($id);
        $student->name = $request->name;
        $student->email = $request->email;
        $student->save();

        Session::flash('success', 'Student Updated Successfully!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
//    public function destroy(Student $student, $id)
//    {
//        $student = Student::find($id);
//        $student->delete();
//
//        Session::flash('success', 'Student Deleted Successfully!');
//        return redirect()->back();
//    }

    public function destroy(Request $request)
    {
        $student = Student::find($request->id);
        $student->delete();

        Session::flash('success', 'Student Deleted Successfully!');
        return redirect()->back();
    }
}
