<a  class="main-cta carrinho" href="{{route('carrinho')}}">
    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
        <path d="M7.5 17.5C8.32843 17.5 9 16.8284 9 16C9 15.1716 8.32843 14.5 7.5 14.5C6.67157 14.5 6 15.1716 6 16C6 16.8284 6.67157 17.5 7.5 17.5Z" stroke="#10404B"/>
        <path d="M14.5 17.5C15.3284 17.5 16 16.8284 16 16C16 15.1716 15.3284 14.5 14.5 14.5C13.6716 14.5 13 15.1716 13 16C13 16.8284 13.6716 17.5 14.5 17.5Z" stroke="#10404B"/>
        <path d="M1 1H3L6.504 12H14.5" stroke="#10404B" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M5.72399 9.5L3.79999 3.5H16.307C16.3863 3.4999 16.4644 3.51865 16.535 3.5547C16.6056 3.59075 16.6666 3.64307 16.713 3.70734C16.7594 3.77162 16.7899 3.846 16.8019 3.92435C16.8138 4.00271 16.807 4.08279 16.782 4.158L15.115 9.158C15.0818 9.25752 15.0182 9.3441 14.9332 9.40548C14.8481 9.46685 14.7459 9.49992 14.641 9.5H5.72399Z" stroke="#10404B" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    <span class="txt-in">
        {{ $tituloCta ?? '+ Carrinho' }}
    </span>

    @if(!empty($carrinho))
        <span class="qtd-carrinho">
        {{count($carrinho)}}
    </span>
    @endif
</a>