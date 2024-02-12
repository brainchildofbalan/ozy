@extends('front-end.layout')
@section('title', 'Create new product')
@section('content')



    <div class="bread-crumbs">
        <div class="container">
            <div class="scoll-wrapper-list">
                <ul>
                    <li>
                        <a href="/">Home</a>
                    </li>
                    <li>
                        <a href="/services">Services</a>
                    </li>
                    <li>
                        <a
                            href="/services/{{ Str::slug(explode(',', $services->category_id)[1]) }}">{{ explode(',', $services->category_id)[1] }}</a>
                    </li>



                    <li>
                        <span>{{ $services->name }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <section class="service-details-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="service-details-inner">
                        <div class="services-main-heading">

                            <h3 class="service-content-title font-second">
                                {{ $services->name }}
                            </h3>


                            <a href="javascript:void(0)" class="enq-button enq-btn">
                                Enquire now</a>
                        </div>


                        <div class="service-image-wrapper-detail">
                            <img src="{{ Storage::url($services->image) }}" alt="{{ $services->name }}">
                        </div>

                        <div class="service-content-wrapper">

                            <div class="service-description">
                                {!! $services->description !!}
                            </div>
                        </div>


                        <div class="service-action-wrappoer"></div>



                    </div>
                </div>
                <div class="col-lg-4"></div>
            </div>

        </div>
    </section>



    <div class="enq-wrapper">
        <div class="enq-inner">
            <form class="checkout-main" id="serviceFrom">


                <div class="enq-heading">
                    <h3>Service Enquiry</h3>
                </div>
                <div class="enq-form">
                    <div class="enq-form-group">
                        <input type="text" name="phone" id="numberField" class="enq-form-controls"
                            placeholder="Mobile number eg(+971-XX-1234567)">
                        <span class="error" id="errorNumber"></span>
                    </div>

                    <div class="enq-form-group">
                        <input type="text" name="firstName" id="nameField" class="enq-form-controls"
                            placeholder="First name">
                        <span class="error" id="nameError"></span>
                    </div>



                    <div class="enq-form-group">
                        <input type="text" name="email" id="emailField" class="enq-form-controls"
                            placeholder="Email address">
                        <span class="error" id="mailError"></span>
                    </div>


                    <div class="enq-form-group">
                        <input type="text" name="servcies" id="serviceField" class="enq-form-controls"
                            placeholder="Service" value="{{ $services->name }}">
                        <span class="error" id="serviceError"></span>
                    </div>


                    <div class="enq-form-group">
                        <textarea type="text" name="address" id="addressField" class="enq-form-controls" rows="4"
                            placeholder="Address"></textarea>
                        <span class="error" id="addressError"></span>

                    </div>

                    <div class="enq-form-group">
                        <button type="submit" id="" class="checkout-form-btn"
                            onclick="validateFormService()">Submit enquiry</button>
                    </div>

                </div>

                </from>
        </div>
    </div>
    <div class="enq-wrapper-overlay"></div>
    <script>
        var main_token = '{{ csrf_token() }}';
    </script>



@endsection
