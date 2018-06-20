<?php

namespace App\Http\Controllers;

use App\Response;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Gate;

class ResponseController extends Controller
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

        $response = new Response;
        $response->account_id = Auth::user()->account_id;
        $response->question_id = $request->question_id;
        $response->response = $request->response;
        $response->save();
        return response()->json(['data'=>'Resposta adicionada com sucesso!','id' => $response->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function show(Response $response)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function edit(Response $response)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Gate::denies('dashboard-view')) {
            abort(403);
        }

        if(!$request->correct) {
            $response = Response::find($id);
            $response->account_id = Auth::user()->account_id;
            $response->response = $request->response;
            $response->save();
        } else {

            Response::where('question_id', $request->question_id)
                ->update(['correct' => '']);

            $response = Response::find($id);
            $response->account_id = Auth::user()->account_id;
            $response->correct = $request->correct;
            $response->save();
        }
        return response()->json(['data'=>'Resposta adicionada com sucesso!','id' => $response->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Response::find($id)
            ->delete();
        return response()->json(['data'=>'Resposta excluida com sucesso!']);
    }
}
