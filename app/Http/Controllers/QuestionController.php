<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Auth;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        if(Gate::denies('dashboard-view')) {
            abort(403);
        }

        $question = new Question;
        $question->account_id = Auth::user()->account_id;
        $question->content_id = $request->content_id;
        $question->question = $request->question;
        $question->save();
        return response()->json(['data'=>'Questão adicionada com sucesso!','id' => $question->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Gate::denies('dashboard-view')) {
            abort(403);
        }

        $question = Question::find($id);
        $question->account_id = Auth::user()->account_id;
        $question->question = $request->question;
        $question->save();
        return response()->json(['data'=>'Pergunta alterada com sucesso!','id' => $question->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Question::find($id)
            ->delete();
        return response()->json(['data'=>'Questão excluida com sucesso!']);
    }
}
