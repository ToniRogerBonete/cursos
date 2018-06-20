<?php

namespace App\Http\Controllers;

use App\Discipline;
use App\Http\Requests\DisciplineRequest;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Gate;

class DisciplineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $disciplines = Discipline::with('contents')
            ->where('course_id',$request->curso_id)
            ->orderBy('ordem','ASC')
            ->get();
        return response()->json($disciplines);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DisciplineRequest $request)
    {
        if(Gate::denies('dashboard-view')) {
            abort(403);
        }

        $discipline = new Discipline;
        $discipline->account_id = Auth::user()->account_id;
        $discipline->course_id = $request->curso_id;
        $discipline->name = $request->name;
        $discipline->price = $request->price;
        $discipline->minimun_time = $request->minimun_time;
        $discipline->save();
        return response()->json(['data'=>'Disciplina salva com sucesso!','id' => $discipline->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Discipline  $discipline
     * @return \Illuminate\Http\Response
     */
    public function show(Discipline $discipline)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Discipline  $discipline
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $discipline = Discipline::find($id);
        return response()->json($discipline);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Discipline  $discipline
     * @return \Illuminate\Http\Response
     */
    public function update(DisciplineRequest $request, $id)
    {
        if(Gate::denies('dashboard-view')) {
            abort(403);
        }

        $discipline = Discipline::find($id);
        $discipline->account_id = Auth::user()->account_id;
        $discipline->course_id = $request->curso_id;
        $discipline->name = $request->name;
        $discipline->price = $request->price;
        $discipline->minimun_time = $request->minimun_time;
        $discipline->save();
        return response()->json(['data'=>'Disciplina salva com sucesso!','id' => $discipline->id]);
    }

    public function ordem(Request $request) {
        if(Gate::denies('dashboard-view')) {
            abort(403);
        }
        foreach ($request->disciplinas as $key => $value) {
            $discipline = Discipline::updateOrCreate(
                ["id" => $value['id'], "account_id" => Auth::user()->account_id],
                ["ordem" => $key]
            );
        }
        return response()->json(['data'=>'Disciplina ordenada com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Discipline  $discipline
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discipline $discipline)
    {
        //
    }
}
