@if ($paginator->hasPages())
<nav class="govuk-pagination" role="navigation" aria-label="Pagination">
    <ul class="govuk-pagination__list">

        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="govuk-pagination__item govuk-pagination__item--prev">
                <a class="govuk-pagination__link" href="#" aria-disabled="true">Previous</a>
            </li>
        @else
            <li class="govuk-pagination__item govuk-pagination__item--prev">
                <a class="govuk-pagination__link" href="{{ $paginator->previousPageUrl() }}" rel="prev">Previous</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="govuk-pagination__item">
                    <span class="govuk-pagination__link" aria-disabled="true">{{ $element }}</span>
                </li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="govuk-pagination__item govuk-pagination__item--current">
                            <span class="govuk-pagination__link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="govuk-pagination__item">
                            <a class="govuk-pagination__link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="govuk-pagination__item govuk-pagination__item--next">
                <a class="govuk-pagination__link" href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a>
            </li>
        @else
            <li class="govuk-pagination__item govuk-pagination__item--next">
                <a class="govuk-pagination__link" href="#" aria-disabled="true">Next</a>
            </li>
        @endif

    </ul>
</nav>
@endif
