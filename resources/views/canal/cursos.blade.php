@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-7">
            <div class="col-lg-12 mb-3">
                <div class="card rounded-0 border-0">
                    <img class="card-img-top p-0" src="{{ asset('/storage/imagem/banner.jpg') }}" alt="Card image cap">
                </div>
            </div>
            @foreach($courses as $course)

                <div class="col-lg-4 mb-4">
                    <div class="card card-hover rounded-0 border-0">
                        <img class="card-img-top p-2" src="{{ asset('/storage/imagem/capa_curso_' . $course->image_presentation) }}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{$course->name}}</h5>
                            <a href="{{ url('/curso/' . str_slug($course->name)) }}" class="btn btn-primary btn-sm rounded-0 float-right">VER MAIS</a>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    </div>
@endsection
