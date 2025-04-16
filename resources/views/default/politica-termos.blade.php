@extends('default.template')

@section('content')
<section class="politica-termos">
    <div class="container">
        <div class="texto">
            <h1>{{$titulo}}</h1>
            {!! $page['texto'] !!}
        </div>
    </div>
</section>
@endsection