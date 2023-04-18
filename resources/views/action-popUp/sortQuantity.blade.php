<div class="modal fade" id="sort" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Quantity</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('sortQuantity')}}" method="GET">
                    <label for="">Sort by price:</label>
                    <input type="text" name="value" id="sortValue">
                    <button type="submit" name="condition" value="=">=</button>
                    <button type="submit" name="condition" value="<">&lt;</button>
                    <button type="submit" name="condition" value="<="><=</button>
                    <button type="submit" name="condition" value=">">&gt;</button>
                    <button type="submit" name="condition" value=">=">>=</button>
                    <button type="submit" name="condition" value="reset">RESET</button>
                  </form>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function() {
        var buttons = $('.button');

        buttons.click(function() {
            // remove the active class and green background color from all buttons
            buttons.removeClass('active').css('background-color', '');

            // add the active class and green background color to the clicked button
            var activeBtn = $(this).addClass('active').css('background-color', 'green');
        });
    });
</script>
