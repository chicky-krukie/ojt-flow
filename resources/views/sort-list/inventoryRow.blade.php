<tr class="">
    <td><input type="checkbox" name="checkbox" id="checkbox"></td>

    {{-- Get art_crop and normal image link --}}
    @php
        $image = json_decode($item->image_uris, true);
        $normalUri = $image['normal'];
        $artCropUri = $image['art_crop'];
    @endphp
    <td>
        <img src="{{ $artCropUri }}" alt="{{ $item->name }}" class="thumbnail"
            onmouseenter="this.src='{{ $normalUri }}'" onmouseleave="this.src='{{ $artCropUri }}'">
    </td>

    <td>{{ $item->name }}</td>

    {{-- Check if the color_identity is blank --}}
    @if ($item->color_identity == '[]')
        <td>land</td>
    @else
        <td>{{ is_valid_json($item->color_identity) }}</td>
    @endif

    <td>{{ $item->type_line }}</td>

    {{-- Check if the frame_effects is blank --}}
    @if ($item->frame_effects == '')
        <td>normal</td>
    @else
        <td>{{ is_valid_json($item->frame_effects) }}</td>
    @endif

    <td>{{ $csv_outputs[$index]->printing }}</td>
    <td>{{ $item->rarity }}</td>

    {{-- Increment/Decrement --}}
    <td>
        <div class="row">
            <form method="post" action="{{ route('quantity.down', $csv_outputs[$index]->id) }}">
                @method('PUT')
                @csrf
                <input class="" name="submitbutton" value="-" type="submit">
            </form>
            {{ $csv_outputs[$index]->quantity }}
            <form method="post" action="{{ route('quantity.up', $csv_outputs[$index]->id) }}">
                @method('PUT')
                @csrf
                <input class="" name="submitbutton" value="+" type="submit">
            </form>
        </div>
    </td>

    <td>{{ $csv_outputs[$index]->price_each }}</td>

    <td>
        ${{ floatval($csv_outputs[$index]->quantity) * floatval(preg_replace('/[^-0-9\.]/', '', $csv_outputs[$index]->price_each)) }}
    </td>

    {{-- Action Column --}}
    <td>
        <a href="#view{{ $item->id }}" data-bs-toggle="modal"
            class="btn btn-primary mb-1 form-control"><i class="fa fa-info"></i>
            View</a>
            @include('action-popUp.view')
        <br>
        <a href="#edit{{ $item->id }}" data-bs-toggle="modal" class="btn btn-success mb-1 form-control"><i
                class='fa fa-shopping-cart'></i>
            Sold</a>
        <br>
        <a href="#delete{{ $item->id }}" data-bs-toggle="modal" class="btn btn-danger form-control"><i
                class='fa fa-trash'></i>
            Delete</a>
        @include('action-popUp.action')
    </td>
</tr>
