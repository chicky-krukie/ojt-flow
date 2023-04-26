<div class="modal fade" id="upload" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header align-middle">
                <h5 class="modal-title" id="myModalLabel">Upload CSV File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="">
                    <form action="{{ route('importProductFromCsv') }}" class="row justify-content-center"
                        accept-charset="utf-8" enctype="multipart/form-data" method="POST">
                        @csrf
                        <input type="file" name="file" id="importFile" class="form-control col-8 w-75 mr-2">
                        <button type="submit" id="submit" class="btn btn-success col-2 w-auto disable">Import CSV</button>
                        <button id="loading" class="btn btn-success col-2 w-auto" hidden type="button" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading...
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <span class="badge badge-primary rounded-pill">14</span> --}}
<script>
    $(document).on('click', '.disable', function(event) {
        if ($(this).hasClass('disabled')) {
            event.preventDefault();
            return false;
        }
        $(this).hide();
        $('#loading').removeAttr('hidden');
    });
</script>
