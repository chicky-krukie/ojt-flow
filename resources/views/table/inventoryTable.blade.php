        {{-- Table --}}
        <div class="container-fluid px-5">
            @if (isset($inventories) && $inventories->count() > 0)
                <div class="table-responsive-md">
                    <table class="table table-hover" id="ojt_flow">
                        <thead>
                            <tr>
                                <th scope="col" class="col-1 text-center">Selector</th>
                                <th scope="col" class="text-center">Thumbnail</th>
                                <th scope="col" class="text-center">Name</th>
                                <th scope="col" class="text-center">Color Identity</th>
                                <th scope="col" class="text-center">Type</th>
                                <th scope="col" class="text-center">Frame Effects</th>
                                <th scope="col" class="text-center">Finish</th>
                                <th scope="col" class="text-center">Rarity</th>
                                <th scope="col" class="col-1 text-center"><a href="#sort" data-bs-toggle="modal" style="text-decoration: none; color:black;">Quantity</a></th>
                                <th scope="col" class="text-center">TCG Mid</th>
                                <th scope="col" class="text-center">Total</th>
                                <th scope="col" class="text-center">Action</th>
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
