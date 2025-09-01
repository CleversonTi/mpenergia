
@if(!empty($home['operacoes']) )

@php
   $bgOp = $helpers->getImage($home['background-operacoes']['url']);
@endphp

<section id="index-operacoes" 
    class="index-operacoes {{ $bgOp ? 'isBanner' : 'noBanner' }}"
    @if($bgOp) style="background-image:url('{{ $bgOp }}')" @endif>


    <div class="container">
        <header class="operacoes-header">

            <h2 class="section-title services">
                <span>Por que grandes operações</span>
                <strong>confiam na MP Energia:</strong> 
            </h2>
           
        </header>

        <ul class="operacoes-grid">
            <li></li>
            @foreach($home['operacoes'] as $op)
                <li class="operacao-card">
                    <div class="operacao-icon">

                        {!! $helpers->gerarImg($op['icone'], true, 'img-fluid', true, false, 'lazy', 'async', 'image') !!}
                       
                    </div>
                    <p class="operacao-desc">{{ $op['descricao'] ?? '' }}</p>
                </li>
            @endforeach
        </ul>
    </div>
</section>
@endif
