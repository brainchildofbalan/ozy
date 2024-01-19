@extends('admin.layout')
@section('title', 'Create new product')
@section('content')
    <div class="flex-grow-1 container-p-x container-p-y">

        {{-- @if ($errors->any())
            <?php var_dump($errors->all()); ?>
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        <form method="post" action="{{ route('orders.update', $category->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="w-100">
                <!-- HTML5 Inputs -->
                <div class="card mb-3 flex-row justify-content-between align-items-center p-3">
                    <h5 class="card-header p-0">Edit orders</h5>
                    <a href="{{ route('orders.index') }}" class="btn btn-primary">View all product</a>
                </div>


                <div class="card mb-0">
                    <div class="card-body">
                        {{-- firstName --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">firstName</label>
                            <div class="col-md-10">
                                <input class="form-control @error('firstName') is-invalid @enderror" type="text"
                                    placeholder="Enter firstName" firstName="firstName"
                                    value="{{ old('firstName', $category->firstName) }}">
                                @error('firstName')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>


                        {{-- lastName --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">lastName</label>
                            <div class="col-md-10">
                                <input class="form-control @error('lastName') is-invalid @enderror" type="text"
                                    placeholder="Enter lastName" lastName="lastName"
                                    value="{{ old('lastName', $category->lastName) }}">
                                @error('lastName')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>



                        {{-- email --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">email</label>
                            <div class="col-md-10">
                                <input class="form-control @error('email') is-invalid @enderror" type="text"
                                    placeholder="Enter email" email="email" value="{{ old('email', $category->email) }}">
                                @error('email')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>



                        {{-- phone --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">phone</label>
                            <div class="col-md-10">
                                <input class="form-control @error('phone') is-invalid @enderror" type="text"
                                    placeholder="Enter phone" phone="phone" value="{{ old('phone', $category->phone) }}">
                                @error('phone')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>


                        {{-- countryCode --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">countryCode</label>
                            <div class="col-md-10">
                                <input class="form-control @error('countryCode') is-invalid @enderror" type="text"
                                    placeholder="Enter countryCode" countryCode="countryCode"
                                    value="{{ old('countryCode', $category->countryCode) }}">
                                @error('countryCode')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>



                        {{-- zone --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">zone</label>
                            <div class="col-md-10">
                                <input class="form-control @error('zone') is-invalid @enderror" type="text"
                                    placeholder="Enter zone" zone="zone" value="{{ old('zone', $category->zone) }}">
                                @error('zone')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>


                        {{-- city --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">city</label>
                            <div class="col-md-10">
                                <input class="form-control @error('city') is-invalid @enderror" type="text"
                                    placeholder="Enter city" city="city" value="{{ old('city', $category->city) }}">
                                @error('city')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>



                        {{-- address --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">address</label>
                            <div class="col-md-10">
                                <input class="form-control @error('address') is-invalid @enderror" type="text"
                                    placeholder="Enter address" address="address"
                                    value="{{ old('address', $category->address) }}">
                                @error('address')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>



                        {{-- status --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">status</label>
                            <div class="col-md-10">
                                <input class="form-control @error('status') is-invalid @enderror" type="text"
                                    placeholder="Enter status" status="status"
                                    value="{{ old('status', $category->status) }}">
                                @error('status')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

























                        <div class="mb-0 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary ms-auto">Edit basics of order</button>
                        </div>
                    </div>

                </div>


            </div>


        </form>
    </div>
@endsection
