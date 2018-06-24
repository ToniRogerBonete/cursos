<?php

namespace App\Http\Controllers;

use App\Course;
use App\Discipline;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseCanalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCourses($account)
    {
        $courses = Course::where('account_id', $this->getAccountId($account)->account_id)
            ->where('status',2)
            ->get();
        return view('canal.cursos')->with(compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCourse($account, $course)
    {
        $course = Course::with('disciplines','disciplines.contents')->where('name',str_replace("-"," ",$course))
            ->get();
        $canal = $this->getAccountId($account)->name;
        return view('canal.curso')->with(compact('course'))->with(compact('canal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAccountId($account)
    {
        $user = User::where('name',$account)
            ->get();
        return $user[0];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

            echo $id;

//        view('canal.curso');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
