@extends('default.template')

@section('content')
<section class="formulario-enviado">
    <div class="container">
        <div class="box-in">
            <h3>Oooooooooops!</h3>
            <h1>Erro 404</h1>
            <h5>
                Não encontramos a página que você estava procurando, mas continue navegando no <a
                    href="{{route('home')}}">site</a>.
            </h5>
            <a href="{{route('home')}}" class="btn-voltar"><i class="fas fa-chevron-left"></i> VOLTAR PARA A
                PÁGINA ANTERIOR</a>
        </div>
    </div>
</section>
@endsection