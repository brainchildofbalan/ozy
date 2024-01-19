@extends('front-end.layout')
@section('title', 'Create new product')
@section('content')

    <section class="checkout-wrapper">
        <div class="container">
            <div>
                <form class="checkout-main" id="checkoutFrom">

                    <div class=" checkout-left">

                        <div class="checkout-contact">
                            <div class="checkout-heading">
                                <h3>Contact</h3>
                            </div>
                            <div class="checkout-from">
                                <div class="checkout-form-group">
                                    <input type="text" name="phone" id="numberField" class="checkout-form-controls"
                                        placeholder="Mobile number eg(+971-XX-1234567)">
                                    <span class="error" id="errorNumber"></span>
                                </div>
                            </div>
                        </div>


                        <div class="checkout-contact">
                            <div class="checkout-heading">
                                <h3>Delivery</h3>
                            </div>
                            <div class="checkout-from">
                                <div class="checkout-form-group half">
                                    <input type="text" name="firstName" id="nameField" class="checkout-form-controls"
                                        placeholder="First name">
                                    <span class="error" id="nameError"></span>
                                </div>
                                <div class="checkout-form-group
                                        half">
                                    <input type="text" name="lastName" id="" class="checkout-form-controls"
                                        placeholder="Last name (Optional)">
                                </div>
                                <div class="checkout-form-group">
                                    <input type="text" name="email" id="emailField" class="checkout-form-controls"
                                        placeholder="Email">
                                    <span class="error" id="mailError"></span>
                                </div>
                                <div class="checkout-form-group">
                                    <input type="text" name="countryCode" id="countryField"
                                        class="checkout-form-controls" placeholder="Country">
                                    <span class="error" id="countryError"></span>
                                </div>

                                <div class="checkout-form-group">
                                    <textarea type="text" name="address" id="addressField" class="checkout-form-controls" rows="4"
                                        placeholder="Address"></textarea>
                                    <span class="error" id="addressError"></span>

                                </div>
                                <div class="checkout-form-group qutr">
                                    <input type="text" name="city" id="cityField" class="checkout-form-controls"
                                        placeholder="City">
                                    <span class="error" id="cityError"></span>
                                </div>
                                <div class="checkout-form-group qutr">
                                    <input type="text" name="zone" id="stateField" class="checkout-form-controls"
                                        placeholder="State">
                                    <span class="error" id="stateError"></span>
                                </div>
                                <div class="checkout-form-group qutr">
                                    <input type="text" name="postalCode" id="pinField" class="checkout-form-controls"
                                        placeholder="PIN code">
                                    <span class="error" id="pinError"></span>
                                </div>

                                <div class="checkout-form-group">
                                    <input type="text" name="time" id="availField" class="checkout-form-controls"
                                        placeholder="Available time">
                                    <span class="error" id="availError"></span>
                                </div>

                                <div class="checkout-form-group">
                                    <button type="submit" id="" class="checkout-form-btn"
                                        onclick="validateForm()">Place order</button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="checkout-right">
                        <div class="cart-main"></div>
                    </div>



                </form>
            </div>
        </div>
    </section>


    <script>
        var main_token = '{{ csrf_token() }}';
    </script>
@endsection
