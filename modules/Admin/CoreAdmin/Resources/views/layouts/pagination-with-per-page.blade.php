@php
    $currentPage = $pagination['current_page'] ?? 1;
    $lastPage = $pagination['last_page'] ?? 1;
    $perPage = request('per_page', 10);
@endphp

<div class="row">
    <div class="col-md-6">
        <form method="get" id="per-page-form">
            @foreach(request()->except('per_page') as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach

            <label>Show</label>
            <select name="per_page" onchange="document.getElementById('per-page-form').submit()" class="form-control" style="width:auto;display:inline-block;">
                @foreach([10, 25, 50, 100] as $value)
                    <option value="{{ $value }}" {{ $perPage == $value ? 'selected' : '' }}>{{ $value }}</option>
                @endforeach
            </select>
            <label>entries</label>
        </form>
    </div>

    <div class="col-md-6 text-right">
        @if ($lastPage > 1)
            <nav>
                <ul class="pagination">
                    <li class="{{ $currentPage == 1 ? 'disabled' : '' }}">
                        <a href="{{ $currentPage > 1 ? request()->fullUrlWithQuery(['page' => $currentPage - 1, 'per_page' => $perPage]) : '#' }}">&laquo;</a>
                    </li>

                    @for ($i = 1; $i <= $lastPage; $i++)
                        <li class="{{ $i == $currentPage ? 'active' : '' }}">
                            <a href="{{ request()->fullUrlWithQuery(['page' => $i, 'per_page' => $perPage]) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    <li class="{{ $currentPage == $lastPage ? 'disabled' : '' }}">
                        <a href="{{ $currentPage < $lastPage ? request()->fullUrlWithQuery(['page' => $currentPage + 1, 'per_page' => $perPage]) : '#' }}">&raquo;</a>
                    </li>
                </ul>
            </nav>
        @endif
    </div>
</div>
