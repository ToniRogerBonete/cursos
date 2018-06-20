<?php

namespace App\Http\Controllers;

use App\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Auth;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::denies('dashboard-view')) {
            abort(403);
        }

//        $document = new Document();
//        $document->account_id = Auth::user()->account_id;
//        $document->content_id = $request->content_id;
//        $document->document = $request->document;


        Document::firstOrCreate(
            ['document' => 'Flight 10'], ['content_id' => 3,'document' => 'dasdlasldsam.pdf']
        )->save();



//        $document->save();
        return response()->json(['data'=>'Documento adicionado com sucesso!','id' => $document->id]);
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

        foreach($request->documentos as $key => $value) {
            Document::firstOrCreate(
                ['document' => $value['file']],
                ['account_id' => Auth::user()->account_id,'content_id' => $request->content_id,'document' => $value['file']]
            )->save();
        }

        return response()->json(['data'=>'Documento adicionado com sucesso!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        //
    }
}