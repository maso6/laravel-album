<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <!-- If there is more than one page, show the "Previous" button -->
        @if ($paginator->lastPage() > 1)
            <li class="page-item {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
                <a class="page-link" href="{{ $paginator->url($paginator->currentPage()-1) }}{{ $urlextra ?? '' }}">Previous</a>
            </li>
            <!-- Always show the first page -->
            <li class="page-item {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
                <a class="page-link" href="{{ $paginator->url(1) }}{{ $urlextra ?? '' }}">1</a>
            </li>
            <!-- Loop through the pages and show links to each page -->
            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                <?php
                    // Calculate the range of pages to show
                    $half_total_links = floor(7 / 2);
                    $from = $paginator->currentPage() - $half_total_links;
                    $to = $paginator->currentPage() + $half_total_links;
                    if ($paginator->currentPage() < $half_total_links) {
                        $to += $half_total_links - $paginator->currentPage();
                    }
                    if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
                        $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
                    }
                ?>
                <!-- Show the pagination links only if they are within the range -->
                @if ($from < $i && $i < $to)
                    <!-- Show the first and last page links always -->
                    @if ($i != $paginator->lastPage() && $i != 1) 
                        <li class="page-item {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                            <a class="page-link" href="{{ $paginator->url($i) }}{{ $urlextra ?? '' }}">{{ $i }}</a>
                        </li>
                    @endif
                @endif
            @endfor
            <!-- Always show the last page -->
            <li class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
                <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}{{ $urlextra ?? '' }}">{{  $paginator->lastPage() }}</a>
            </li>
            <!-- If there is a next page, show the "Next" button -->
            <li class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
                <a class="page-link" href="{{ $paginator->url($paginator->currentPage()+1) }}{{ $urlextra ?? '' }}">Next</a>
            </li>
        @endif
    </ul>
</nav>