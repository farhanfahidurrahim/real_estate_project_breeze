<section class="feature-section sec-pad bg-color-1">
    <div class="auto-container">
        <div class="sec-title centred">
            <h5>Features</h5>
            <h2>Featured Property</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing sed do eiusmod tempor incididunt <br />labore
                dolore magna aliqua enim.</p>
        </div>
        <div class="row clearfix">

            @foreach ($properties as $item)
                <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                    <div class="feature-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img
                                        src="{{ !empty($item->property_thumbnail) ? $item->property_thumbnail : url('upload/images/property/' . $item->property_thumbnail) }}"
                                        alt="">
                                        {{-- src="{{ !empty($item->property_thumbnail) ? url('upload/images/property/' . $item->property_thumbnail) : url('upload/images/no_image.jpg') }}"
                                        alt=""> --}}
                                </figure>
                                <div class="batch"><i class="icon-11"></i></div>
                                <span class="category">Featured</span>
                            </div>
                            <div class="lower-content">
                                <div class="author-info clearfix">
                                    <div class="author pull-left">
                                        @if ($item->agent_id == NULL)
                                        <figure class="author-thumb"><img src="{{ url('upload/images/admin.png') }}" alt=""></figure>
                                            <h6>Admin</h6>
                                        @else
                                        <figure class="author-thumb"><img src="{{ !empty($item->agentName->photo) ? url('upload/images/agent/'.$item->photo) : url('upload/images/no_image.jpg') }}" alt=""></figure>
                                            <h6>{{ $item->agentName->name }}</h6>
                                        @endif
                                    </div>
                                    <div class="buy-btn pull-right"><a href="property-details.html">For
                                            {{ $item->property_status }}</a>
                                    </div>
                                </div>
                                <div class="title-text">
                                    <h4><a href="{{ route('property.details', ['id' => $item->id, 'slug' => $item->property_slug]) }}">{{ $item->property_name }}</a></h4>
                                    {{-- or, <h4><a href="{{ url('property/details/'.$item->id.'/'.$item->property_slug) }}">{{ $item->property_name }}</a></h4> --}}
                                </div>
                                <div class="price-box clearfix">
                                    <div class="price-info pull-left">
                                        <h6>Start From</h6>
                                        <h4>${{ $item->lowest_price }}</h4>
                                    </div>
                                    <ul class="other-option pull-right clearfix">
                                        <li><a href="property-details.html"><i class="icon-12"></i></a></li>
                                        <li><a href="property-details.html"><i class="icon-13"></i></a></li>
                                    </ul>
                                </div>
                                <p>{{ $item->short_description }}</p>
                                <ul class="more-details clearfix">
                                    <li><i class="icon-14"></i>{{ $item->bedrooms }} Beds</li>
                                    <li><i class="icon-15"></i>{{ $item->bathrooms }} Baths</li>
                                    <li><i class="icon-16"></i>{{ $item->property_size }} Sq Ft</li>
                                </ul>
                                <div class="btn-box"><a href="property-details.html" class="theme-btn btn-two">See
                                        Details</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="more-btn centred"><a href="property-list.html" class="theme-btn btn-one">View All
                Listing</a></div>
    </div>
</section>
