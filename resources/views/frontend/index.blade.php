@extends('frontend.dashboard')
@section('main')

    <!-- banner-section -->
    @include('frontend.home.banner')
    <!-- banner-section end -->

    <!-- category-section -->
    @include('frontend.home.category')
    <!-- category-section end -->

    <!-- feature-section -->
    @include('frontend.home.feature')
    <!-- feature-section end -->

    <!-- video-section -->
    <section class="video-section centred" style="background-image: url(assets/images/background/video-1.jpg);">
        <div class="auto-container">
            <div class="video-inner">
                <div class="video-btn">
                    <a href="https://www.youtube.com/watch?v=nfP5N9Yc72A&amp;t=28s" class="lightbox-image"
                        data-caption=""><i class="icon-17"></i></a>
                </div>
            </div>
        </div>
    </section>
    <!-- video-section end -->

    <!-- deals-section -->
    @include('frontend.home.deals')
    <!-- deals-section end -->

    <!-- testimonial-section end -->
    @include('frontend.home.testimonial')
    <!-- testimonial-section end -->

    <!-- chooseus-section -->
    @include('frontend.home.choose_us')
    <!-- chooseus-section end -->

    <!-- place-section -->
    @include('frontend.home.place')
    <!-- place-section end -->

    <!-- team-section -->
    @include('frontend.home.team')
    <!-- team-section end -->

    <!-- cta-section -->
    <section class="cta-section bg-color-2">
        <div class="pattern-layer" style="background-image: url(assets/images/shape/shape-2.png);"></div>
        <div class="auto-container">
            <div class="inner-box clearfix">
                <div class="text pull-left">
                    <h2>Looking to Buy a New Property or <br />Sell an Existing One?</h2>
                </div>
                <div class="btn-box pull-right">
                    <a href="property-details.html" class="theme-btn btn-three">Rent Properties</a>
                    <a href="index.html" class="theme-btn btn-one">Buy Properties</a>
                </div>
            </div>
        </div>
    </section>
    <!-- cta-section end -->

    <!-- news-section -->
    @include('frontend.home.news')
    <!-- news-section end -->

    <!-- download-section -->
    @include('frontend.home.download')
    <!-- download-section end -->
@endsection
