        {{-- Table --}}
        <div class="container-fluid px-5">
            @if (isset($inventories) && $inventories->count() > 0)
                <div class="table-responsive-md">
                    <table class="table table-hover display" id="ojt_flow">
                        <thead>
                            <tr class="">
                                <th class="col-1">Selector</th>
                                <th class="">Thumbnail</th>
                                <th>Name</th>
                                <th>Color Identity</th>
                                <th>Type</th>
                                <th>Frame Effects</th>
                                <th>Finish</th>
                                <th>Rarity</th>
                                <th><a href="#sort" data-bs-toggle="modal">Quantity</a></th>
                                <th>TCG Mid</th>
                                <th>Total</th>
                                <th>Action</th>
                                @include('action-popUp.sortQuantity')
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventories as $index => $item)
                                {{-- Quantity Sorting --}}
                                @if ($condition == '=')
                                    @if ($csv_outputs[$index]->quantity == $value)
                                        @include('sort-list.inventoryRow')
                                    @endif
                                @elseif ($condition == '<')
                                    @if ($csv_outputs[$index]->quantity < $value)
                                        @include('sort-list.inventoryRow')
                                    @endif
                                @elseif ($condition == '<=')
                                    @if ($csv_outputs[$index]->quantity <= $value)
                                        @include('sort-list.inventoryRow')
                                    @endif
                                @elseif ($condition == '>')
                                    @if ($csv_outputs[$index]->quantity > $value)
                                        @include('sort-list.inventoryRow')
                                    @endif
                                @elseif ($condition == '>=')
                                    @if ($csv_outputs[$index]->quantity >= $value)
                                        @include('sort-list.inventoryRow')
                                    @endif
                                @else
                                    @include('sort-list.inventoryRow')
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <br>
                <h1 class="text-center">There is NO DATA</h1>
            @endif
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#ojt_flow').DataTable({
                    "lengthMenu": [50, 100, 200, 500],
                    // sort: false,
                });
            });
        </script>
