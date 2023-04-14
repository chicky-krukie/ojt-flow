<div class="modal fade" id="view{{ $item->id }}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">{{ $item->name }} Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @foreach ($item->first()->getAttributes() as $key => $value)
                    <ul class="list-group list-group-light">
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">{{ $key }}</div>
                                <div class="text-wrap">{{ is_valid_json($value) }}</div>
                            </div>
                            {{-- <span class="badge badge-primary rounded-pill">14</span> --}}
                        </li>
                    </ul>
                @endforeach
            </div>
        </div>
    </div>
</div>