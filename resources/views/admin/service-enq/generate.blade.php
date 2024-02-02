@extends('admin.layout')
@section('title', 'Create new product')
@section('content')
    <div class="flex-grow-1 container-p-x container-p-y">

        {{-- @if ($errors->any())
            
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        <form action="{{ route('services-enq.storepdf', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- <label for="name">Name:</label>
            <input class="@error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}">
            @error('name')
                <span class="invalid-feedback">
                    {{ $message }}
                </span>
            @enderror

            <label for="description">Description:</label>
            <textarea name="description">{{ old('description') }}</textarea> --}}

            <!-- Add other form fields based on your model attributes -->

            <div class="w-100">
                <!-- HTML5 Inputs -->
                <div class="card mb-3 flex-row justify-content-between align-items-center p-3">
                    <h5 class="card-header p-0">Create PDF Invoice</h5>
                </div>
            </div>
            <div class="card mb-0">
                <div class="card-body">


                    @php
                        $arrayOfObjects = json_decode($category->products);
                        $total = 0;
                        foreach ($arrayOfObjects as $item) {
                            // Convert price to integer (assuming it's in string format)
                            $price = (int) $item->price;
                            $qty = $item->qty;

                            // Calculate subtotal for each item
                            $subtotal = $price * $qty;

                            // Add subtotal to the total
                            $total += $subtotal;
                        }
                        echo "Total: $total";

                    @endphp
                    @if ($arrayOfObjects !== null)
                        @foreach ($arrayOfObjects as $object)
                            <div class="mb-3 row">
                                <label for="html5-text-input" class="col-md-2 col-form-label d-flex align-items-center">
                                    <span style="position: relative;">
                                        <img src="{{ Storage::url(explode(', ', $object->images)[0]) }}"
                                            style="width: 40px; height: 40px; object-fit: cover; margin: 5px; border: 1px solid #dedede; padding: 10px;">
                                        <span
                                            style="position: absolute; left: 8px; top: 8px; background-color: #fff; width: 10px; height: 10px; font-size: 10px; display: flex; justify-content: center; align-items: center; color: #000">{{ $object->qty }}</span>
                                    </span>
                                    <span class="ps-1">{{ $object->name }}</span>
                                    {{ $object->price }}
                                </label>
                                <div class="col-md-10 d-flex align-items-center flex-column justify-content-center">
                                    <input class="form-control @error('name' . $object->id) is-invalid @enderror"
                                        type="text" placeholder="Enter Price" name="name{{ $object->id }}"
                                        value="{{ old('name' . $object->id, $object->price || 0) }}">
                                    @error('name' . $object->id)
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                    @endif

























                    <div class="mb-0 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary ms-auto">Generate PDF Invoice</button>
                    </div>
                </div>

            </div>


    </div>


    </form>
    </div>
@endsection
