@extends("layouts.layout")

@section("title") Home @endsection
@section("description") The main page of website @endsection
@section("keywords") restaurant,food,dinner,launch,breakfast @endsection

@section("content")
    <main class="reservation-page">
        <section class="page-banner d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="banner-content">
                        <h2 class="text-white display-3 text-center" data-aos="fade-right" data-aos-delay="3000">Reservation</h2>
                        <div class="divider" data-aos="fade-up-right" data-aos-delay="3000">
                            <div class="dot mb-2"></div>
                        </div>
                        <p class="text-white mb-0 text-center" data-aos="fade-left" data-aos-delay="3000">Just a few click to make the reservation online for saving your time and money</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="reservation-form my-5 py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="text-center display-6 fw-bold" data-aos="fade-right">Reservation Form</h2>
                        <div data-aos="fade-right" class="reservation-line d-flex justify-content-center align-items-center">
                            <span></span>
                        </div>
                        @if(session('error'))
                            <h3 class="text-center text-danger">{{ session('error') }}</h3>
                        @else
                            <h3 class="text-center text-success">{{ session('success') }}</h3>
                        @endif
                        <form action="{{ route('reservationStore') }}" class="position-relative" method="POST">
                            @csrf
                            <img data-aos="fade-down-left" class="d-none d-lg-block" src="{{ asset("assets/images/reservation-showcase.png") }}" alt="">
                            <p class="text-center" data-aos="fade-up-right">We willing to help you make the reservation online to save your time and money or you can call us directly through the customer service hotline: 225-88888</p>
                            <div class="row mt-5 pt-4">
                                <div data-aos="fade-right" class="col-md-6">
                                    <div class="input-group">
                                        <div class="icon-wrapper d-flex align-items-center position-relative">
                                            <i class="fa fa-envelope py-2 px-3"></i>
                                        </div>
                                        <input class="form-control bg-transparent border-0 px-3" type="email" value="{{ old('email') }}" name="email" placeholder="Email">
                                    </div>
                                    @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <div class="input-group">
                                        <div class="icon-wrapper d-flex align-items-center position-relative">
                                            <i class="fa fa-calendar py-2 px-3"></i>
                                        </div>
                                        <input class="form-control bg-transparent border-0 px-3" type="date" name="date" placeholder="Date">
                                    </div>
                                    @error('date')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div data-aos="fade-left" class="col-md-6">
                                    <div class="input-group">
                                        <div class="icon-wrapper d-flex align-items-center position-relative">
                                            <i class="fa fa-person py-2 px-3"></i>
                                        </div>
                                        <select class="form-select bg-transparent border-0 ps-3" name="person">
                                            <option value="2" {{old('person') == 2 ? 'selected' : ''}}>2 Person</option>
                                            <option value="3" {{old('person') == 3 ? 'selected' : ''}}>3 Person</option>
                                            <option value="4" {{old('person') == 4 ? 'selected' : ''}}>4 Person</option>
                                            <option value="5" {{old('person') == 5 ? 'selected' : ''}}>5 Person</option>
                                            <option value="6" {{old('person') == 6 ? 'selected' : ''}}>6 Person</option>
                                            <option value="7" {{old('person') == 7 ? 'selected' : ''}}>7 Person</option>
                                            <option value="8" {{old('person') == 8 ? 'selected' : ''}}>8 Person</option>
                                            <option value="9" {{old('person') == 9 ? 'selected' : ''}}>9 Person</option>
                                            <option value="10" {{old('person') == 10 ? 'selected' : ''}}>10 Person</option>
                                        </select>
                                    </div>
                                    @error('person')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <div class="input-group">
                                        <div class="icon-wrapper d-flex align-items-center position-relative">
                                            <i class="fa fa-clock py-2 px-3"></i>
                                        </div>
                                        <input type="time" class="ps-3 form-select bg-transparent border-0" name="time">
                                    </div>
                                    @error('time')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-group" data-aos="fade-up-right">
                                        <textarea class="form-control bg-transparent border-0 px-3" name="description" placeholder="Description">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center" data-aos="fade-up-left">
                                <button type="submit" class="anim-layer book-a-table contact-button">Book Table</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>


        <section class="reservation-services py-5">
            <div class="container py-5">
                <div class="row">
                    <h2 data-aos="fade-right" class="position-relative text-center display-6 text-white fw-bold">Fooday Best Service</h2>
                    <div data-aos="fade-right" class="reservation-line d-flex justify-content-center align-items-center">
                        <span></span>
                    </div>
                </div>
                <div class="row">
                    <div data-aos="fade-right" class="position-relative col-sm-12 col-md-6 col-lg-3 d-flex justify-content-center align-items-center flex-column">
                        <div class="icon-box">
                            <i class="fas fa-utensils fa-2x"></i>
                            <span class="number">1</span>
                        </div>
                        <h4>Reservation</h4>
                        <p class="text-center">Lorem ipsum dolor sit amet, tong consecteturto sed eiusmod incididunt utote labore et</p>
                    </div>
                    <div data-aos="fade-down" class="position-relative col-sm-12 col-md-6 col-lg-3 d-flex justify-content-center align-items-center flex-column">
                        <div class="icon-box">
                            <i class="fas fa-wine-glass-alt fa-2x"></i>
                            <span class="number">2</span>
                        </div>
                        <h4>Private Event</h4>
                        <p class="text-center">Lorem ipsum dolor sit amet, tong consecteturto sed eiusmod incididunt utote labore et</p>
                    </div>
                    <div data-aos="fade-up" class="position-relative col-sm-12 col-md-6 col-lg-3 d-flex justify-content-center align-items-center flex-column">
                        <div class="icon-box">
                            <i class="fas fa-laptop-house fa-2x"></i>
                            <span class="number">3</span>
                        </div>
                        <h4>Online Order</h4>
                        <p class="text-center">Lorem ipsum dolor sit amet, tong consecteturto sed eiusmod incididunt utote labore et</p>
                    </div>
                    <div data-aos="fade-left" class="position-relative col-sm-12 col-md-6 col-lg-3 d-flex justify-content-center align-items-center flex-column">
                        <div class="icon-box">
                            <i class="fas fa-motorcycle fa-2x"></i>
                            <span class="number">4</span>
                        </div>
                        <h4>Fast Delivery</h4>
                        <p class="text-center">Lorem ipsum dolor sit amet, tong consecteturto sed eiusmod incididunt utote labore et</p>
                    </div>
                </div>
            </div>
        </section>


        <section class="reservation-events my-5 py-5 ">
            <div class="container mb-5">
                <div class="row">
                    <h2 class="text-center display-6 fw-bold" data-aos="fade-right">Upcoming Events</h2>
                    <div data-aos="fade-right" class="reservation-line d-flex justify-content-center align-items-center">
                        <span></span>
                    </div>
                </div>
                <div class="row">
                    <div data-aos="fade-right" class="col-lg-6 mb-5 pb-5 mb-lg-0 pb-lg-0">
                        <div class="event-card position-relative">
                            <div class="event-heading d-flex py-2">
                                <div class="event-date px-3 d-flex flex-column">
                                    <h5 class="event-day">12</h5>
                                    <h6 class="event-month">JUN</h6>
                                </div>
                                <div class="heading ps-3 d-flex align-items-center">
                                    <p class="mb-0">Hong Kong Tasty Food Cooking Event</p>
                                </div>
                            </div>
                            <div class="image">
                                <img class="img-fluid" src="{{ asset("assets/images/event-01.jpg") }}" alt="">
                            </div>
                            <div class="event-info position-absolute">
                                <ul class="d-flex justify-content-around ps-lg-0 position-relative my-3">
                                    <li class="list-unstyled">
                                        <span class="num">03</span>
                                        <span class="cap">/days</span>
                                    </li>
                                    <li class="list-unstyled">
                                        <span class="num">50</span>
                                        <span class="cap">/foods</span>
                                    </li>
                                    <li class="list-unstyled">
                                        <span class="num">290</span>
                                        <span class="cap">/guests</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div data-aos="fade-left" class="col-lg-6">
                        <div class="event-card position-relative">
                            <div class="event-heading d-flex py-2">
                                <div class="event-date px-3 d-flex flex-column">
                                    <h5 class="event-day">12</h5>
                                    <h6 class="event-month">JUN</h6>
                                </div>
                                <div class="heading ps-3 d-flex align-items-center">
                                    <p class="mb-0">Hong Kong Tasty Food Cooking Event</p>
                                </div>
                            </div>
                            <div class="image">
                                <img class="img-fluid" src="{{ asset("assets/images/event-02.jpg") }}" alt="">
                            </div>
                            <div class="event-info position-absolute">
                                <ul class="d-flex justify-content-around ps-lg-0 position-relative my-3">
                                    <li class="list-unstyled">
                                        <span class="num">03</span>
                                        <span class="cap">/days</span>
                                    </li>
                                    <li class="list-unstyled">
                                        <span class="num">50</span>
                                        <span class="cap">/foods</span>
                                    </li>
                                    <li class="list-unstyled">
                                        <span class="num">290</span>
                                        <span class="cap">/guests</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="subscribe-us pb-5 mb-5">
            <img class="d-none d-lg-block" src="{{ asset("assets/images/subscribe-us.png") }}" alt="" data-aos="fade-down-right">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-8 d-flex flex-column flex-md-row align-items-lg-center">
                        <div class="content" data-aos="fade-right">
                            <h5 class="display-6 text-black">Subcribe Us Now</h5>
                            <p>
                                Get more news and delicious dishes everyday from us
                            </p>
                        </div>
                        <div class="subscribe-form d-flex ps-0 ms-0 ps-lg-5 ms-lg-5" data-aos="fade-left">
                            <div class="input-form w-100">
                                <input class="border-0 px-3 w-100" type="email" placeholder="Email">
                            </div>
                            <div class="input-button">
                                <a class="text-decoration-none" href="#">
                                    <i class="fa fa-paper-plane"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
