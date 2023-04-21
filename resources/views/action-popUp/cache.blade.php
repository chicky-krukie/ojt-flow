<div class="modal fade" id="cache" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header align-middle">
                <h5 class="modal-title" id="myModalLabel">Counter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if (Cache::get('csv_import_progress'))
                    <div class="d-flex justify-content-center">
                        <div class="col-10">
                            <div class="row">
                                <div class="col-6">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <i class="fa fa-bars"></i>
                                            <span class="ms-2">Rows processed:</span>
                                        </div>
                                        <div>
                                            <span
                                                class="fw-bold">{{ Cache::get('csv_import_progress')['processed'] }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <i class="fa fa-clock-o"></i>
                                            <span class="ms-2">Total time:</span>
                                        </div>
                                        <div>
                                            <span class="fw-bold">{{ Cache::get('totalTime') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
{{-- <span class="badge badge-primary rounded-pill">14</span> --}}
