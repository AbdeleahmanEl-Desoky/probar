@props(['pagination'])

@php
    // Set default values to avoid errors if pagination is not passed correctly
    $pagination = $pagination ?? [];
    $currentPage = $pagination['current_page'] ?? 1;
    $lastPage = $pagination['last_page'] ?? 1;
@endphp

@if ($lastPage > 1)
    <div class="box-footer clearfix">
        <ul class="pagination pagination-sm no-margin pull-right">
            {{-- Previous Page Link --}}
            <li class="{{ $currentPage == 1 ? 'disabled' : '' }}">
                <a href="{{ $currentPage > 1 ? request()->fullUrlWithQuery(['page' => $currentPage - 1]) : '#' }}">
                    «
                </a>
            </li>

            {{-- Pagination Elements --}}
            @for ($i = 1; $i <= $lastPage; $i++)
                <li class="{{ $i == $currentPage ? 'active' : '' }}">
                    <a href="{{ request()->fullUrlWithQuery(['page' => $i]) }}">{{ $i }}</a>
                </li>
            @endfor

            {{-- Next Page Link --}}
            <li class="{{ $currentPage == $lastPage ? 'disabled' : '' }}">
                <a href="{{ $currentPage < $lastPage ? request()->fullUrlWithQuery(['page' => $currentPage + 1]) : '#' }}">
                    »
                </a>
            </li>
        </ul>
    </div>
@endif
