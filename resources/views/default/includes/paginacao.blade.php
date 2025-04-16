@if($data['last_page'] > 1)
    @php
        $currentPage = $data['current_page'];
        $lastPage = $data['last_page'];
        $path = $data['path'];
        $busca = !empty($busca) ? '&busca=' . $busca : '';
        $categoria = '';
        $interval = empty($interval) ? 5 : $interval;
    @endphp

    <ul class="paginacao">
        @if($lastPage <= $interval)
            @for($i = 1; $i <= $lastPage; $i++)
                <li>
                    <a href="{{ $path . '?page=' . $i . $busca . $categoria }}"
                        class="{{ $currentPage == $i ? 'active' : '' }}">
                        {{ $i }}
                    </a>
                </li>
            @endfor
        @else
            @php
                $start = max(1, $currentPage - floor($interval / 2));
                $end = min($lastPage, $start + $interval - 1);
            @endphp

            @if($currentPage > 1)
                <li>
                    <a href="{{ $path . '?page=' . ($currentPage - 1) . $busca . $categoria }}">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
            @endif

            @for($i = $start; $i <= $end; $i++)
                <li>
                    <a href="{{ $path . '?page=' . $i . $busca . $categoria }}"
                        class="{{ $currentPage == $i ? 'active' : '' }}">
                        {{ $i }}
                    </a>
                </li>
            @endfor

            @if($lastPage > $currentPage)
                <li>
                    <a href="{{ $path . '?page=' . ($currentPage + 1) . $busca . $categoria }}">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            @endif
        @endif
    </ul>
@endif
