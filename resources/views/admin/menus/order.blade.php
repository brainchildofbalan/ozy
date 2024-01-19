@extends('admin.layout')
@section('title', 'Category')
@section('content')
    <div class="flex-grow-1 container-p-x container-p-y">
        {{-- <div class="card mb-3 flex-row justify-content-between align-items-center p-3">
            <h5 class="card-header p-0">Uploaded sub category details</h5>
            <a href="{{ route('menus.create') }}" class="btn btn-primary">Create new category</a>
        </div> --}}

        <div class="card border-0">
            <ul class="list-group" id="sortable">

                @foreach ($categories as $category)
                    <li data-id="{{ $category->id }}" class="list-group-item">{{ $category->title }}</li>
                @endforeach

        </div>
    </div>









    </div>
    <script>
        var main_token = '{{ csrf_token() }}';
    </script>
@endsection
