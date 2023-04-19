<tr class="col-1 product_row">
    <td class="text-center align-middle"><input type="checkbox" name="checkbox" id="checkbox" class="select-row"></td>

    {{-- Get art_crop and normal image link --}}
    <td>
        @if ($item['product']['art_crop'] !== null && $item['product']['normal'] !== null)
            <img src="{{ $item['product']['art_crop'] }}" alt="{{ $item['product']['name'] }}"
                class="thumbnail align-middle" onmouseenter="this.src='{{ $item['product']['normal'] }}'"
                onmouseleave="this.src='{{ $item['product']['art_crop'] }}'">
        @endif
    </td>

    <td class="align-middle">{{ $item['product']['name'] }}</td>

    <td class="align-middle">{{ $item['product']['color_identity'] }}</td>

    <td class="align-middle">{{ $item['product']['type_line'] }}</td>

    <td class="align-middle">{{ $item['product']['frame_effects'] }}</td>

    <td class="align-middle">{{ $item['printing'] }}</td>

    <td class="align-middle">{{ $item['product']['rarity'] }}</td>

    {{-- Increment/Decrement --}}
    <td class="text-center align-middle">
        <div class="btn-group" role="group" aria-label="Quantity">
            <form method="post" action="{{ route('quantity.down', $item['id']) }}">
                @method('PUT')
                @csrf
                <button type="submit" class="btn btn-secondary btn-sm"><i class="fa fa-minus"></i></button>
            </form>
            <span class="mx-2">{{ $item['quantity'] }}</span>
            <form method="post" action="{{ route('quantity.up', $item['id']) }}">
                @method('PUT')
                @csrf
                <button type="submit" class="btn btn-secondary btn-sm"><i class="fa fa-plus"></i></button>
            </form>
        </div>
    </td>


    {{-- Price (Edit) --}}
    <td class="col-1 align-middle">
        <form method="post" action="{{ route('price_each.edit', $item['id']) }}">
            @method('PUT')
            @csrf
            <div class="input-group">
                <input name="price_each" value="{{ $item['price_each'] }}" type="text" class="form-control tcg_mid">
                <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="Save Price"><i class="fa fa-save"></i></button>
            </div>
        </form>
    </td>

    <td class="align-middle">
        <strong>
            ${{ floatval($item['quantity']) * floatval(preg_replace('/[^-0-9\.]/', '', $item['price_each'])) }}
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
