@if ($condition === 'default')
    @include('filter-inventory.filteredTable')
@elseif ($condition === 'all')
    @include('filter-inventory.filteredTable')
@else
    @include('filter-inventory.filteredTable')
@endif
