@extends('admin.layout')
@section('title', 'Category')
@section('content')
    <div class="flex-grow-1 container-p-x container-p-y">
        <div class="card border-0">
            <div class="card-body">
                <h2>Order Details</h2>
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
                <p>Description : <strong> {{ $orders->description }} </strong></p>
                <p>Notes : <strong> {{ $orders->notes }} </strong></p>
                <p>Other : <strong> {{ $orders->other }} </strong></p>
                <p>Orderd at : <strong> {{ $orders->created_at }} </strong></p>


                @php
                    $arrayOfObjects = json_decode($orders->products);
                @endphp
                <div style="display: flex; flex-wrap: wrap; position: relative;">
                    @if ($arrayOfObjects !== null)
                        @foreach ($arrayOfObjects as $object)
                            <span style="position: relative;">
                                <img src="{{ Storage::url($object->images) }}"
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
                </div>
            </div>
        </div>
    </div>
@endsection
