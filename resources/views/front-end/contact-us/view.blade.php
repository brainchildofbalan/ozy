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
                        <span>contact us</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>


    <section class="contact-wrapper">
        <div class="container">
            <div class="contact-inner">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="contact-content-wrapper">
                            <h2 class="font-second">Contact Our team.</h2>
                            <p>We're here to help and answer any question you might have. We look forward to hearing from
                                you</p>
                            <ul>
                                <li>
                                    <a href="tel:+965 6045 9575">
                                        <span class="icon">
                                            <img src="{{ asset('/assets/front-end/images/contact-us/call.svg') }}" />
                                        </span>
                                        <span class="text">
                                            +965 6045 9575
                                        </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="mailto:info@ozyarabia.com">
                                        <span class="icon">
                                            <img src="{{ asset('/assets/front-end/images/contact-us/email.svg') }}" />
                                        </span>
                                        <span class="text">
                                            info@ozyarabia.com
                                        </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="/">
                                        <span class="icon">
                                            <img src="{{ asset('/assets/front-end/images/contact-us/location.svg') }}" />
                                        </span>
                                        <span class="text">
                                            <span>Fahad Marzoq AIRashidi GENERAL TRAD. & CONT.CO.</span>, Kuwait - Abraq
                                            Khaitan - Street
                                            22 - Block 9 - Abdulaziz Ahamad Al-Qadah - Off. 13 - Mezzanine
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="social-contact">
                            <h3>Find our social media</h3>
                            <ul class="footer-social-media-links">
                                <li>
                                    <a href="https://www.facebook.com/ozyarabia.me" target="_blank">
                                        <img src="{{ asset('/assets/front-end/images/footer/facebook.svg') }}"
                                            alt=""></a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/ozyarabia.me/" target="_blank">
                                        <img src="{{ asset('/assets/front-end/images/footer/instagram.svg') }}"
                                            alt=""></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-wrapper">
                            <div class="form-inner">
                                <p>You can also use this <a href="mailto:ozyarabia.com">link</a> to email us</p>
                                <form action="" id="ContactFrom">
                                    <div class="form-group">
                                        <label for="name">Name * </label>
                                        <input id="nameField" name="name" type="text" class="form-input">
                                        <span class="error" id="nameError"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="number">Mobile number * </label>
                                        <input id="numberField" name="number" type="text" class="form-input">
                                        <span class="error" id="errorNumber"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email address * </label>
                                        <input id="emailField" name="email" type="email" class="form-input">
                                        <span class="error" id="mailError"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="message">Your message</label>
                                        <textarea id="messageField" name="message" type="text" class="form-input" rows="4"></textarea>
                                        <span class="error" id="messageError"></span>
                                    </div>
                                    <span class="nb-text">
                                        Fields marked with an asterisk (*) are required.
                                    </span>
                                    <div class="form-group">
                                        <button type="submit" class="submit-button" onclick="validateFormContact()">
                                            Submit enquiry
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="map-wrapper">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d869.887588617064!2d47.9736389!3d29.295527799999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMjnCsDE3JzQzLjkiTiA0N8KwNTgnMjUuMSJF!5e0!3m2!1sen!2sin!4v1708096316341!5m2!1sen!2sin"
            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>





@endsection
