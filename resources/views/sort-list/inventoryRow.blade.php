<tr class="col-1 product_row">
    <td class="text-center align-middle"><input type="checkbox" name="checkbox" id="checkbox" class="select-row"></td>

    {{-- Get art_crop and normal image link --}}
    @php
        $image = json_decode($item->image_uris, true);
        $artCropUri = $image['art_crop'];
        $normalUri = $image['normal'];
    @endphp
    <td class="align-middle">
        <img src="{{ $artCropUri }}" alt="{{ $item->name }}" class="thumbnail"
            onmouseenter="this.src='{{ $normalUri }}'" onmouseleave="this.src='{{ $artCropUri }}'">
    </td>

    <td class="align-middle">{{ $item->name }}</td>

    {{-- Check if the color_identity is blank --}}
    @if ($item->color_identity == '[]')
        <td class="align-middle">land</td>
    @else
        <td class="align-middle">{{ is_valid_json($item->color_identity) }}</td>
    @endif

    <td class="align-middle">{{ $item->type_line }}</td>

    {{-- Check if the frame_effects is blank --}}
    @if ($item->frame_effects == '')
        <td class="align-middle">normal</td>
    @else
        <td class="align-middle">{{ is_valid_json($item->frame_effects) }}</td>
    @endif

    <td class="align-middle">{{ $csv_outputs[$index]->printing }}</td>
    <td class="align-middle">{{ $item->rarity }}</td>

    {{-- Increment/Decrement --}}
    <td class="text-center align-middle">
        <div class="btn-group" role="group" aria-label="Quantity">
            <form method="post" action="{{ route('quantity.down', $csv_outputs[$index]->id) }}">
                @method('PUT')
                @csrf
                <button type="submit" class="btn btn-secondary btn-sm"><i class="fa fa-minus"></i></button>
            </form>
            <span class="mx-2">{{ $csv_outputs[$index]->quantity }}</span>
            <form method="post" action="{{ route('quantity.up', $csv_outputs[$index]->id) }}">
                @method('PUT')
                @csrf
                <button type="submit" class="btn btn-secondary btn-sm"><i class="fa fa-plus"></i></button>
            </form>
        </div>
    </td>


    {{-- Price (Edit) --}}
    <td class="col-1 align-middle">
        <form method="post" action="{{ route('price_each.edit', $csv_outputs[$index]->id) }}">
            @method('PUT')
            @csrf
            <div class="input-group">
                <input name="price_each" value="{{ $csv_outputs[$index]->price_each }}" type="text"
                    class="form-control tcg_mid">
                <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="Save Price"><i class="fa fa-save"></i></button>
            </div>
        </form>
    </td>

    <td class="align-middle">
        <strong>
            ${{ floatval($csv_outputs[$index]->quantity) * floatval(preg_replace('/[^-0-9\.]/', '', $csv_outputs[$index]->price_each)) }}
        </strong>
    </td>

    {{-- Action Column --}}
    <td class="align-middle">
        <div class="btn-group" role="group">
            <a class="btn btn-secondary" href="#view{{ $item->id }}" data-bs-toggle="modal"
                data-bs-toggle="tooltip" data-bs-placement="top" title="View {{ $item->name }}"><i
                    class="fa fa-eye"></i></a>
            @include('action-popUp.view')


            <button class="btn btn-success" data-bs-target="#edit{{ $item->uid }}" data-bs-toggle="modal"
                data-bs-placement="top" title="Sold {{ $item->name }}"
                @if ($csv_outputs[$index]->quantity === 0) disabled @endif><i class="fa fa-shopping-cart"></i></button>


            <button class="btn btn-danger" data-bs-target="#delete{{ $item->uid }}" data-bs-toggle="modal"
                data-bs-placement="top" title="Delete {{ $item->name }}"><i class="fa fa-trash"></i></button>
            @include('action-popUp.action')
        </div>
    </td>
</tr>
