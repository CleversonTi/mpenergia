{{-- resources/views/components/cidade-estado.blade.php --}}
@php
    $ce = $value;

    if (is_string($ce)) {
        $trim = ltrim($ce);
        if (strlen($trim) && in_array($trim[0], ['{','['])) {
            $ce = json_decode($ce, true);
        }
    }
@endphp

@if (is_array($ce))
    @php
        $estado = $ce['estado'] ?? $ce['nome'] ?? $ce['sigla'] ?? null;
        $cidade = $ce['cidade'] ?? $ce['nome_cidade'] ?? null;
    @endphp
    @if ($cidade || $estado)
        {{ $cidade }}{{ $cidade && $estado ? '/' : '' }}{{ $estado }}
    @endif
@else
   <span>{{ $ce }}</span>
@endif
