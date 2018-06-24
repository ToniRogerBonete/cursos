@extends('layouts.app')

@section('content')
    <div class="container bg-white pt-3 pb-3">
        <div class="row">
            <div class="col-lg-7 mb-1 mt-1">
                <div class="card rounded-0 border-0 bg-transparent">
                    <div class="card-body p-0 bg-transparent">
                        <video width="100%" style="margin-bottom: -6px !important;" controls poster="{{asset('/storage/imagem/capa_curso_' . $course[0]->image_presentation)}}" controlsList="nodownload">
                            <source src="{{asset('/storage/video/' . $course[0]->video_presentation)}}" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 mb-1 mt-1 d-flex align-items-stretch">
                <div class="card rounded-0 w-100">
                    <h5 class="card-header bg-white">
                        {{$course[0]->name}}
                    </h5>
                    <div class="card-body">
                        <p><small class="text-muted">Publicado: {{Carbon\Carbon::parse($course[0]->created_at)->format('d/m/Y')}}</small></p>
                        @if($course[0]->certificate)
                            <p class="text-muted"><i class="fas fa-certificate"></i> Emite certificado</p>
                        @endif
                        <p class="text-muted"><i class="fas fa-file-pdf"></i> Material para estudo</p>
                        <p class="text-muted"><i class="fas fa-store"></i> <a href="/"> {{$canal}}</a></p>
                    </div>
                    <div class="card-header bg-transparent">
                        @if($course[0]->type_sale==1)
                            <h4>R${{$course[0]->price}}<small> / por curso</small></h4>
                        @endif
                        @if($course[0]->type_sale==2)
                            <h4>R${{$course[0]->disciplines[0]->price}}<small> / por disciplina</small></h4>
                        @endif
                        <a href="#" class="btn btn-success btn-lg rounded-0 w-100 mt-3">ADQUIRIR</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container bg-white mt-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card rounded-0 border-0">
                    <div class="card-body">
                        <h5>Sobre o curso</h5>
                        <p class="text-justify">{{$course[0]->description}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-8 pb-2 bg-white mt-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card rounded-0 border-0">
                    <div class="card-body">
                        <h5 class="mb-3">Conteúdo do curso</h5>
                        <div id="accordion">
                            @foreach($course[0]->disciplines as $discipline)
                                <div class="card rounded-0">
                                    <h5 class="card-header p-3" style="cursor: pointer" id="heading{{$discipline->id}}" data-toggle="collapse" data-target="#collapse{{$discipline->id}}" aria-expanded="true" aria-controls="collapse{{$discipline->id}}">
                                        <i class="fas fa-angle-right"></i> {{$discipline->name}}
                                    </h5>
                                    <div id="collapse{{$discipline->id}}" class="collapse" aria-labelledby="heading{{$discipline->id}}" data-parent="#accordion">
                                        <div class="card-body p-0">
                                            <ul class="list-group list-group-flush">
                                                @foreach($discipline->contents as $content)
                                                    <li class="list-group-item list-group-item-action">
                                                        @if($content->type==1)
                                                            <i class="fas fa-play-circle"></i>
                                                        @endif
                                                        @if($content->type==2)
                                                            <i class="fas fa-font"></i>
                                                        @endif
                                                        @if($content->type==3)
                                                            <i class="fas fa-list"></i>
                                                        @endif
                                                        @if($content->type==4)
                                                            <i class="fas fa-paperclip"></i>
                                                        @endif
                                                            {{$content->name}}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
