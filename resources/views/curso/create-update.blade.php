@extends('layouts.app')

@section('content')
    <main>
        <create_update id="{{Request::segment(2)}}">
            <div class="container-fluid">
                Carregando...
            </div>
        </create_update>
    </main>
@endsection

@section('scripts')
    <script src="/js/cursos.js"></script>
@endsection