<!-- Sold Modal -->
<div class="modal fade" id="edit{{$item->uid}}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Sold</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route ('csv.update', $item->uid) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <strong>Name:</strong>
                        <input type="text" name="name" class="form-control" placeholder="Name">
                    </div>
                    <div class="mb-3">
                        <strong>Quantity</strong>
                        <input type="number" name="quantity" value="{{ $csv_outputs[$index]->quantity }}" class="form-control" placeholder="quantity" value="1" min="1" max="10">
                    </div>
        
                    <div class="mb-3">
                        {{-- <strong>Sold Price (Peso):</strong>
                        <input type="text" name="sold" value="₱{{ floatval($settings['multiplier_default']) * floatval(preg_replace('/[^-0-9\.]/', '', $csv_outputs[$index]->total )) }}" class="form-control" > --}}
                    </div>

                    <div class="mb-3">
                        <strong>Ship price:</strong>
                        <input type="text" name="ship_price" value="0" class="form-control" placeholder="">
                    </div>

                    <div class="mb-3">
                        <strong>Ship cost:</strong>
                        <input type="text" name="ship_cost" value="0" class="form-control" placeholder="">
                    </div>

                    <div class="mb-3">
            
            
                       {{-- <input type="text" name="payment_status" value="{{$settings['payment_status'][2]['status']}}" class="hidden d-none">
                    </div> --}}

                    <div class="mb-3">
                        <strong>Payment Method</strong>
                        <select name="payment_methods" class="form-control" >
                            <option value="" disabled selected hidden>Enter your mode of payment</option>
                            {{-- @foreach($settings['payment_methods'] as $setting)
                                <option value="{{$setting['method']}}">{{$setting['method']}}</option>
                            @endforeach --}}
                          
                        </select><br>
                    </div>

                    <div class="mb-3">
                        {{-- <strong>Multiplier:</strong>
                        <input type="text" name="multiplier" value="{{$settings['multiplier_default']}}" class="form-control" placeholder=""> --}}
                    </div>

                    <div class="mb-3">
                        {{-- <strong>Multiplied Price:</strong>
                        <input type="text" name="multiplied_price" value="₱{{ floatval($settings['multiplier_default']) * floatval(preg_replace('/[^-0-9\.]/', '', $csv_outputs[$index]->price_each)) }}" class="form-control" placeholder=""> --}}
                    </div>

                    <div class="mb-3">
                        {{-- <strong>Estimated Card Cost:</strong>
                        ₱{{ floatval($settings['multiplier_cost']) * floatval(preg_replace('/[^-0-9\.]/', '', $csv_outputs[$index]->price_each)) }} --}}
                    </div>


                    <div class="mb-3">
                        <strong>Note:</strong>
                        <input type="text" name="note" value="" class="form-control" placeholder="Enter the note">
                    </div>
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i>Sold</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="delete{{$item->uid}}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Delete Row</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route ('csv.delete', ['id' => $csv_outputs[$index]->id,'uid' => $item->uid]) }}" method="post" enctype="multipart/form-data">

                @csrf
                <div class="modal-body">

                    <h4 class="text-center">Are you sure you want to delete this row?</h4>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>