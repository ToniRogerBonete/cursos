@extends('layouts.app')

@section('content')
    <main>
        <index :courses="{{$courses}}">
            <div class="container-fluid">
                Carregando...
            </div>
        </index>
    </main>
@endsection

@section('scripts')
    <script src="/js/cursos.js"></script>
@endsection