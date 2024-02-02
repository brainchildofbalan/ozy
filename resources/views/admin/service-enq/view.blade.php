@extends('admin.layout')
@section('title', 'Category')
@section('content')
    <div class="flex-grow-1 container-p-x container-p-y">
        <div class="card mb-3 flex-row justify-content-between align-items-center p-3">
            <h5 class="card-header p-0">Uploaded service enquiry</h5>
            {{-- <a href="{{ route('services-enq.create') }}" class="btn btn-primary">Create new product</a> --}}
        </div>
        <div class="card border-0">
            <div class="table-responsive text-nowrap card-body">
                <table class="table table-bordered ">
                    <thead>
                        <tr>
                            <th class="fw-bold">Name</th>
                            <th class="fw-bold">Service</th>
                            <th class="fw-bold">Created at</th>
                            <th class="fw-bold">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($orders as $order)
                            <tr>
                                <td class=" text-black">
                                    <a class=" fw-bold" href="{{ route('services-enq.show', $order->id) }}"">
                                        {{ $order->name }}
                                    </a>
                                </td>
                                <td>

                                    {{ $order->service }}

                                </td>
                                <td class="fw-medium text-black">{{ $order->created_at }}</td>
                                <td class="fw-medium">
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i
                                                class="bx bx-dots-vertical-rounded"></i>More</button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('services-enq.edit', $order->id) }}"">

                                                <span class="btn btn-danger">Edit</span></a>




                                            <form class="dropdown-item" method="post"
                                                action="{{ route('services-enq.destroy', $order->id) }}"
                                                onsubmit="return confirm('Are you sure you want to delete this category?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>









    </div>
@endsection
