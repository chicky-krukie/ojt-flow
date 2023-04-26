<tr class="product_row">
    <td class="text-center align-middle width-50"><input type="checkbox" name="checkbox" id="checkbox" class="select-row">
    </td>

    {{-- Get art_crop and normal image link --}}
    <td class="td-height">
        @php
            //dd($item['product']['name']);
        @endphp
        @if ($item['product']['art_crop'] !== null && $item['product']['normal'] !== null)
            <img src="{{ $item['product']['art_crop'] }}" alt="{{ $item['product']['name'] }}"
                class="thumbnail align-middle text-center" onmouseenter="this.src='{{ $item['product']['normal'] }}'"
                onmouseleave="this.src='{{ $item['product']['art_crop'] }}'">
        @endif
    </td>

    <td class="align-middle text-center">{{ $item['product']['name'] }}</td>

    <td class="align-middle text-center">{{ $item['product']['color_identity'] }}</td>

    <td class="align-middle text-center">{{ $item['product']['type_line'] }}</td>

    <td class="align-middle text-center">{{ $item['product']['frame_effects'] }}</td>

    <td class="align-middle text-center">{{ $item['printing'] }}</td>

    <td class="align-middle text-center">{{ $item['product']['rarity'] }}</td>

    {{-- Increment/Decrement --}}
    <td class="text-center align-middle">
        <div class="btn-group" role="group" aria-label="Quantity">
            <form method="post" action="{{ route('quantity.down', $item['id']) }}" class="disable-form">
                @method('PUT')
                @csrf
                <button type="submit" class="btn btn-secondary btn-sm disable-quantity"><i
                        class="fa fa-minus"></i></button>
            </form>
            <span class="mx-3">{{ $item['quantity'] }}</span>
            <form method="post" action="{{ route('quantity.up', $item['id']) }}" class="disable-form">
                @method('PUT')
                @csrf
                <button type="submit" class="btn btn-secondary btn-sm disable-quantity"><i
                        class="fa fa-plus"></i></button>
            </form>
        </div>
    </td>


    {{-- Price (Edit) --}}
    <td class="col-1 align-middle width-150">
        <form method="post" action="{{ route('price_each.edit', $item['id']) }}" class="disable-form"
            id="price_edit_{{ $item['id'] }}">
            @method('PUT')
            @csrf
            <div class="input-group text-center">
                <div class="input-group-text">
                    {{-- Add Currency Symbol --}}
                    @foreach ($settings['currency_option'] as $currency)
                        @if ($settings['tcg_mid'] === $currency['id'])
                            {{ $currency['symbol'] }}
                        @endif
                    @endforeach
                </div>
                <input name="price_each" value="{{ $item['price_each'] }}" type="text"
                    class="form-control price_input" id="price_input_{{ $item['id'] }}"><span
                    hidden>{{ $item['price_each'] }}</span>
            </div>
        </form>
    </td>

    <td class="align-middle text-center width-120">
        <strong>
            ${{ number_format(floatval($item['quantity']) * floatval(preg_replace('/[^-0-9\.]/', '', $item['price_each'])), 2) }}
        </strong>
    </td>

    {{-- Action Column --}}
    <td class="align-middle">
        <div class="btn-group" role="group">
            <a class="btn btn-secondary" href="#view{{ $item['id'] }}" data-bs-toggle="modal"
                data-bs-toggle="tooltip" data-bs-placement="top" title="View {{ $item['product']['name'] }}"><i
                    class="fa fa-eye"></i></a>
            @include('action-popUp.view')


            <button class="btn btn-success" data-bs-target="#edit{{ $item['id'] }}" data-bs-toggle="modal"
                data-bs-placement="top" title="Sold {{ $item['product']['name'] }}"
                @if ($item['quantity'] === 0) disabled @endif><i class="fa fa-shopping-cart"></i></button>


            <button class="btn btn-danger" data-bs-target="#delete{{ $item['id'] }}" data-bs-toggle="modal"
                data-bs-placement="top" title="Delete {{ $item['product']['name'] }}"><i
                    class="fa fa-trash"></i></button>
            @include('action-popUp.action')
        </div>
    </td>
</tr>

<script>
    $(document).on('click', '.disable-quantity, .disable-price', function(event) {
        if ($(this).hasClass('disabled')) {
            event.preventDefault();
            return false;
        }
    });

    $('.disable-form').on('submit', function() {
        var btn = $(this).find('.disable-quantity, .disable-price');
        btn.addClass('disabled');
    });
</script>

<script>
    $(document).on('blur', '.price_input', function(event){
        if(event.target === this)
        {
          const form = $(this).closest('form').submit();
        }
    })
</script>
