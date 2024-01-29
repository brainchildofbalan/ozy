@extends('admin.layout')
@section('title', 'Category')
@section('content')
    <div class="flex-grow-1 container-p-x container-p-y">
        <div class="card border-0 mb-3">
            <div class="card-body">
                <h4>Change order status




                </h4>
                <div class="w-100 d-flex">

                    <form method="post" action="{{ route('orders.status', ['id' => $orders->id, 'status' => 'Placed']) }}"
                        class="d-inline" onsubmit="return confirm('Are you sure you want change the status?')">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-primary me-2">Order Placed</button>
                    </form>
                    <form method="post" action="{{ route('orders.status', ['id' => $orders->id, 'status' => 'Shipped']) }}"
                        class="d-inline" onsubmit="return confirm('Are you sure you want change the status?')">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-secondary me-2">Order Shipped</button>
                    </form>
                    <form method="post"
                        action="{{ route('orders.status', ['id' => $orders->id, 'status' => 'Delivered']) }}"
                        class="d-inline" onsubmit="return confirm('Are you sure you want change the status?')">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-info me-5">Order Delivered</button>
                    </form>
                    <form method="post"
                        action="{{ route('orders.status', ['id' => $orders->id, 'status' => 'Canceled']) }}"
                        class="d-inline" onsubmit="return confirm('Are you sure you want change the status?')">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-danger me-2">Order Canceled</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card border-0">
            <div class="card-body">
                <h2 class="flex align-items-center">Order Details
                    @if ($orders->status !== 'ordered')
                        <span
                            class="badge 
                        @if ($orders->status === 'Canceled') bg-danger @endif
                        @if ($orders->status === 'Delivered') bg-info @endif
                        @if ($orders->status === 'Shipped') bg-secondary @endif
                        @if ($orders->status === 'Placed') bg-primary @endif
                         text-h6"
                            style="font-size: 13px; vertical-align: middle">
                            {{ $orders->status }}
                        </span>
                    @endif
                </h2>
                <p>First Name : <strong> {{ $orders->firstName }} </strong></p>
                <p>Last Name : <strong> {{ $orders->lastName }} </strong></p>
                <p>Phone : <strong> {{ $orders->phone }} </strong></p>
                <p>Email : <strong> {{ $orders->email }} </strong></p>
                <p>Address : <strong> {{ $orders->address }} </strong></p>
                <p>City : <strong> {{ $orders->city }} </strong></p>
                <p>Country : <strong> {{ $orders->countryCode }} </strong></p>
                <p>PIN Code : <strong> {{ $orders->postalCode }} </strong></p>
                <p>State : <strong> {{ $orders->zone }} </strong></p>
                <p>Status : <strong> {{ $orders->status }} </strong></p>
                {{-- <p>Description : <strong> {{ $orders->description }} </strong></p> --}}
                {{-- <p>Notes : <strong> {{ $orders->notes }} </strong></p> --}}
                {{-- <p>Other : <strong> {{ $orders->other }} </strong></p> --}}
                <p>Orderd at : <strong> {{ $orders->created_at }} </strong></p>


                @php
                    $arrayOfObjects = json_decode($orders->products);
                @endphp
                <div style="display: flex; flex-wrap: wrap; position: relative;">
                    @if ($arrayOfObjects !== null)
                        @foreach ($arrayOfObjects as $object)
                            <span style="position: relative;">
                                <img src="{{ Storage::url(explode(', ', $object->images)[0]) }}"
                                    style="width: 100px; height: 100px; object-fit: cover; margin: 5px; border: 1px solid #dedede; padding: 10px;">
                                <span
                                    style="position: absolute; left: 8px; top: 8px; background-color: #fff; width: 10px; height: 10px; font-size: 10px; display: flex; justify-content: center; align-items: center; color: #000">{{ $object->qty }}</span>
                            </span>
                        @endforeach

                    @endif
                </div>

                <div class="mt-3">
                    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back to orders</a>
                    <a href="{{ route('orders.edit', $orders->id) }}" class="btn btn-primary">Edit</a>

                    <form method="post" action="{{ route('orders.destroy', $orders->id) }}" class="d-inline"
                        onsubmit="return confirm('Are you sure you want to delete this category?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>

                    <a href="{{ route('orders.generateOrder', $orders->id) }}" class="btn btn-secondary">Generate
                        invoice</a>

                </div>
            </div>
        </div>
    </div>
@endsection
