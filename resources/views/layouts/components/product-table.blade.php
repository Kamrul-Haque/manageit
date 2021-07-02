<table class="table table-bordered table-striped">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Image</th>
            <th>NAME</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Size</th>
            <th>Color</th>
            <th class="text-center">OPERATIONS</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($products as $product)
        <tr>
            <td> {{$loop->index+1}} </td>
            <td>
                <img src="{{ $product->image }}" alt="image" height="25px" width="25px" data-toggle="modal" data-target="#image{{$loop->index}}">
                @component('layouts.components.image-modal')
                    @slot('loop') {{$loop->index}} @endslot
                    {{$product->image}}
                @endcomponent
            </td>
            <td> {{$product->name}} </td>
            <td> {{$product->category->name}} </td>
            <td> {{$product->totalQuantity()}} </td>
            <td> {{$product->size}} </td>
            <td> {{$product->color}} </td>
            <td>
                <div class="row justify-content-center">
                    @if($slot == 'product')
                    <a href="{{route('products.edit', $product)}} " class="btn btn-primary btn-sm" title="edit">
                        <span data-feather="edit" style="height: 15px; width: 15px; padding: 0"></span>
                    </a>
                    @else
                    <form action="{{ route('admin.products.restore', $product) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm" title="restore"><span data-feather="rotate-ccw" style="height: 15px; width: 15px; padding: 0"></span></button>
                    </form>
                    @endif
                    @auth('admin')
                        <button class="btn @if($slot == 'product') btn-warning @else btn-danger @endif btn-sm ml-1" title="delete" data-toggle="modal" data-target="#delete{{$loop->index}}">
                            <span data-feather="trash-2" style="height: 15px; width: 15px; padding: 0"></span>
                        </button>
                    @endauth
                </div>
            </td>
        </tr>
        @component('layouts.components.delete-modal')
            @if($slot == 'product')
                action="{{ route('admin.products.destroy', $product) }}"
            @else
                action="{{ route('admin.products.force.delete', $product) }}"
            @endif
            @slot('loop') {{$loop->index}} @endslot
        @endcomponent
    @endforeach
    </tbody>
</table>
