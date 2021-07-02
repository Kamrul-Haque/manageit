<table class="table table-bordered table-striped">
    <thead class="thead-dark">
    <tr>
        <th>#</th>
        <th>IMAGE</th>
        <th>NAME</th>
        <th class="text-center">OPERATIONS</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($categories as $category)
        <tr>
            <td>{{$loop->index + 1}}</td>
            <td>
                <img src="{{ $category->image }}" alt="image" width="25px" height="25px" data-toggle="modal" data-target="#image{{$loop->index}}">
                @component('layouts.components.image-modal')
                    @slot('loop') {{$loop->index}} @endslot
                {{$category->image}}
                @endcomponent
            </td>
            <td> {{$category->name}} </td>
            <td>
                <div class="row justify-content-center">
                    @if($slot == 'trash')
                        <form action="{{route('admin.category.restore',$category)}}" method="post">
                            @csrf
                            <button class="btn btn-success btn-sm" title="restore">
                                <span data-feather="rotate-ccw" style="height: 15px; width: 15px; padding: 0"></span>
                            </button>
                        </form>
                    @else
                        <a href="{{route('category.show',$category)}}" class="btn btn-dark btn-sm" title="client history"><span data-feather="eye" style="height: 15px; width: 15px; padding: 0"></span></a>
                        <div class="ml-1">
                            <a href="{{route('category.edit',$category)}}" class="btn btn-primary btn-sm" title="edit"><span data-feather="edit" style="height: 15px; width: 15px; padding: 0"></span></a>
                        </div>
                    @endif
                    @auth('admin')
                        <button class="btn @if($slot == 'trash') btn-danger @else btn-warning @endif btn-sm ml-1" title="delete" data-toggle="modal" data-target="#delete{{$loop->index}}">
                            <span data-feather="trash-2" style="height: 15px; width: 15px; padding: 0"></span>
                        </button>
                        @component('layouts.components.delete-modal')
                            @if($slot == 'trash')
                                action="{{route('admin.category.force.delete', $category)}}"
                            @else
                                action="{{route('admin.category.destroy', $category)}}"
                            @endif
                            @slot('loop') {{$loop->index}} @endslot
                        @endcomponent
                    @endauth
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
