@extends('layouts.homeland')

@section('content')
    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(images/hero_bg_2.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-md-10">
            <span class="d-inline-block text-white px-3 mb-3 property-offer-type rounded">Property Details of</span>
            <h1 class="mb-2">{{ $property->address }}</h1>
            <p class="mb-5"><strong class="h2 text-success font-weight-bold">{{ $property->getPriceAsCurrency() }}</strong></p>
            </div>
        </div>
        </div>
    </div>

    <div class="site-section site-section-sm">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div>
                        <div class="slide-one-item home-slider owl-carousel">
                            @foreach (json_decode($property->images) as $img)
                                    <div>
                                        <img src="{{ asset('images')}}/{{ $img }}" alt="Image" class="img-fluid">
                                    </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="bg-white property-body border-bottom border-left border-right">
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <strong class="text-success h1 mb-3">{{$property->getPriceAsCurrency()}}</strong>
                            </div>
                            <div class="col-md-6">
                                <ul class="property-specs-wrap mb-3 mb-lg-0  float-lg-right">
                                    <li>
                                    <span class="property-specs">Beds</span>
                                    <span class="property-specs-number">{{$property->bedrooms}} <sup>+</sup></span>

                                    </li>
                                    <li>
                                    <span class="property-specs">Baths</span>
                                    <span class="property-specs-number">{{$property->bathrooms}}</span>

                                    </li>
                                    <li>
                                    <span class="property-specs">SQ FT</span>
                                    <span class="property-specs-number">{{$property->sq_ft}}</span>

                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-6 col-lg-3 text-center border-bottom border-top py-3">
                                <span class="d-inline-block text-black mb-0 caption-text">Home Type</span>
                                <strong class="d-block">{{$property->list_type->name}}</strong>
                            </div>
                            <div class="col-md-6 col-lg-3 text-center border-bottom border-top py-3">
                                <span class="d-inline-block text-black mb-0 caption-text">Year Built</span>
                                <strong class="d-block">{{$property->year_built}}</strong>
                            </div>
                            <div class="col-md-6 col-lg-3 text-center border-bottom border-top py-3">
                                <span class="d-inline-block text-black mb-0 caption-text">Price/Sqft</span>
                                <strong class="d-block">{{$property->getPriceBySquareFeet()}}</strong>
                            </div>
                            <div class="col-md-6 col-lg-3 text-center border-bottom border-top py-3">
                                <span class="d-inline-block text-black mb-0 caption-text">City</span>
                                <strong class="d-block">{{$property->city->name}}</strong>
                            </div>
                            </div>
                            <h2 class="h4 text-black">More Info</h2>
                            <p>{{$property->description}}</p>

                            <div class="row no-gutters mt-5">
                            <div class="col-12">
                                <h2 class="h4 text-black mb-3">Gallery</h2>
                            </div>
                                @foreach ( json_decode($property->images) as $img)
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <a href="{{ asset('images')}}/{{ $img }}" class="image-popup gal-item">
                                        <img src="{{ asset('images')}}/{{ $img }}" alt="Image" class="img-fluid">
                                    </a>
                            </div>
                                @endforeach
                                <div class="bg-white property-body border-bottom border-left border-right mt-5">
                                    <h2 class="h4 text-black">Reviews</h2>


                                    @if(optional($property->reviews)->isNotEmpty())
                                    @foreach ($property->reviews as $review)
                                        <div class="border p-3 mb-3">
                                            <h5 class="text-primary">{{ $review->name }}</h5>
                                            <p><strong>Rating:</strong> ⭐{{ $review->rating }}/5</p>
                                            <p>{{ $review->description }}</p>
                                            <small class="text-muted">Reviewed on {{ \Carbon\Carbon::parse($review->date)->format('F j, Y') }}</small>
                                        </div>
                                    @endforeach
                                    @else
                                    <p>No reviews yet. Be the first to leave one!</p>
                                    @endif



                                    <h4 class="mt-4">Leave a Review</h4>
                                    @if(session()->has('message'))
                                        <div class="alert alert-success">{{ session('message') }}</div>
                                    @endif
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form action="{{ route('property.review.store', $property->id) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">Name:</label>
                                            <input type="text" id="name" name="name" class="form-control" required value="{{ old('name') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="email" id="email" name="email" class="form-control" required value="{{ old('email') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="rating">Rating:</label>
                                            <select id="rating" name="rating" class="form-control" required>
                                                <option value="5">⭐⭐⭐⭐⭐ (5)</option>
                                                <option value="4">⭐⭐⭐⭐ (4)</option>
                                                <option value="3">⭐⭐⭐ (3)</option>
                                                <option value="2">⭐⭐ (2)</option>
                                                <option value="1">⭐ (1)</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Review:</label>
                                            <textarea id="description" name="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Submit Review</button>
                                        </div>
                                    </form>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">

                    <div class="bg-white widget border rounded">

                        <h3 class="h4 text-black widget-title mb-3">Contact Agent</h3>
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="" class="form-contact-agent" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{old('name')}}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" id="phone" name="phone"  class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="phone">Message</label>
                            <textarea  id="message" name="message"  class="form-control" rows="5">
                                {{old('message')}}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" id="phone" class="btn btn-primary" value="Send Message">
                        </div>
                        </form>
                    </div>

                    <div class="bg-white widget border rounded">
                        <h3 class="h4 text-black widget-title mb-3 ml-0">Share</h3>
                            <div class="px-3" style="margin-left: -15px;">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=&quote=" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-facebook"></span></a>
                            <a  href="https://twitter.com/intent/tweet?text=&url=" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-twitter"></span></a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url=" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-linkedin"></span></a>
                            </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="site-section site-section-sm bg-light">
        <div class="container">

        <div class="row">
            <div class="col-12">
            <div class="site-section-title mb-5">
                <h2>Related Properties</h2>
            </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-md-6 col-lg-4 mb-4">
            <div class="property-entry h-100">
                <a href="property-details.html" class="property-thumbnail">
                <div class="offer-type-wrap">
                    <span class="offer-type bg-danger">Sale</span>
                    <span class="offer-type bg-success">Rent</span>
                </div>
                <img src="images/img_1.jpg" alt="Image" class="img-fluid">
                </a>
                <div class="p-4 property-body">
                <a href="#" class="property-favorite"><span class="icon-heart-o"></span></a>
                <h2 class="property-title"><a href="property-details.html">625 S. Berendo St</a></h2>
                <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span> 625 S. Berendo St Unit 607 Los Angeles, CA 90005</span>
                <strong class="property-price text-primary mb-3 d-block text-success">$2,265,500</strong>
                <ul class="property-specs-wrap mb-3 mb-lg-0">
                    <li>
                    <span class="property-specs">Beds</span>
                    <span class="property-specs-number">2 <sup>+</sup></span>

                    </li>
                    <li>
                    <span class="property-specs">Baths</span>
                    <span class="property-specs-number">2</span>

                    </li>
                    <li>
                    <span class="property-specs">SQ FT</span>
                    <span class="property-specs-number">7,000</span>

                    </li>
                </ul>

                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 mb-4">
            <div class="property-entry h-100">
                <a href="property-details.html" class="property-thumbnail">
                <div class="offer-type-wrap">
                    <span class="offer-type bg-danger">Sale</span>
                    <span class="offer-type bg-success">Rent</span>
                </div>
                <img src="images/img_2.jpg" alt="Image" class="img-fluid">
                </a>
                <div class="p-4 property-body">
                <a href="#" class="property-favorite active"><span class="icon-heart-o"></span></a>
                <h2 class="property-title"><a href="property-details.html">871 Crenshaw Blvd</a></h2>
                <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span> 1 New York Ave, Warners Bay, NSW 2282</span>
                <strong class="property-price text-primary mb-3 d-block text-success">$2,265,500</strong>
                <ul class="property-specs-wrap mb-3 mb-lg-0">
                    <li>
                    <span class="property-specs">Beds</span>
                    <span class="property-specs-number">2 <sup>+</sup></span>

                    </li>
                    <li>
                    <span class="property-specs">Baths</span>
                    <span class="property-specs-number">2</span>

                    </li>
                    <li>
                    <span class="property-specs">SQ FT</span>
                    <span class="property-specs-number">1,620</span>

                    </li>
                </ul>

                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 mb-4">
            <div class="property-entry h-100">
                <a href="property-details.html" class="property-thumbnail">
                <div class="offer-type-wrap">
                    <span class="offer-type bg-info">Lease</span>
                </div>
                <img src="images/img_3.jpg" alt="Image" class="img-fluid">
                </a>
                <div class="p-4 property-body">
                <a href="#" class="property-favorite"><span class="icon-heart-o"></span></a>
                <h2 class="property-title"><a href="property-details.html">853 S Lucerne Blvd</a></h2>
                <span class="property-location d-block mb-3"><span class="property-icon icon-room"></span> 853 S Lucerne Blvd Unit 101 Los Angeles, CA 90005</span>
                <strong class="property-price text-primary mb-3 d-block text-success">$2,265,500</strong>
                <ul class="property-specs-wrap mb-3 mb-lg-0">
                    <li>
                    <span class="property-specs">Beds</span>
                    <span class="property-specs-number">2 <sup>+</sup></span>

                    </li>
                    <li>
                    <span class="property-specs">Baths</span>
                    <span class="property-specs-number">2</span>

                    </li>
                    <li>
                    <span class="property-specs">SQ FT</span>
                    <span class="property-specs-number">5,500</span>

                    </li>
                </ul>

                </div>
            </div>
            </div>
        </div>
    </div>
@endsection
