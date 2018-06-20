<?php

namespace App\Http\Controllers;

use App\Content;
use App\Document;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Gate;
use function PHPSTORM_META\type;

class ContentController extends Controller
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

        $content = new Content;
        $content->account_id = Auth::user()->account_id;
        $content->discipline_id = $request->discipline_id;
        $content->name = $request->name;
        $content->type = $request->type;
        $content->url = $request->url;
        $content->text = $request->text;
        if($request->type==3) {
            $content->ordem = '1000';
        }
        $content->save();
        return response()->json(['data'=>'Conteúdo salvo com sucesso!','id' => $content->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function show(Content $content)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $content = Content::with(['questions','questions.responses','documents'])
            ->find($id);
        return response()->json($content);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Gate::denies('dashboard-view')) {
            abort(403);
        }

        $content = Content::find($id);
        $content->account_id = Auth::user()->account_id;
        $content->discipline_id = $request->discipline_id;
        $content->name = $request->name;
        $content->type = $request->type;
        $content->url = $request->url;
        $content->text = $request->text;
        $content->save();

        if($request->type==4) {
            foreach($request->documentos as $key => $value) {
                Document::firstOrCreate(
                    ['document' => $value['document'], 'content_id' => $id],
                    ['account_id' => Auth::user()->account_id,'content_id' => $id,'document' => $value['document']]
                )->save();
            }
        }

        return response()->json(['data'=>'Conteúdo salvo com sucesso!','id' => $content->id]);
    }

    public function ordem(Request $request) {
        if(Gate::denies('dashboard-view')) {
            abort(403);
        }
        foreach ($request->contents as $key => $value) {
            if($value['type']!=3) {
                $content = Content::updateOrCreate(
                    ["id" => $value['id'], "discipline_id" => $value['discipline_id']],
                    ["ordem" => $key]
                );
            }
        }
        return response()->json(['data'=>'Conteúdo ordenado com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Content::find($id)
            ->delete();
        return response()->json(['data'=>'Conteúdo excluido com sucesso!']);
    }
}
