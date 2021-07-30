@extends('layouts.template')

@section('content')
<div class="row sticky-wrapper">
    <div class="col-lg-7 col-md-7 padding-right-30">
        <div id="titlebar" class="listing-titlebar">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <img src="{{ @$project->media->last()->link }}" height="150px" title="Project image"/>
                </div>
                <div class="col-lg-8 col-md-8">
                    <div class="listing-titlebar-title">
                        <h2>{{ $project->name }}</h2>
                        @if(!empty($project->email))
                            <br>
                            <span>
                                <a href="#">
                                    <i class="fa fa-envelope-o"></i>
                                    {{ @$project->email }}
                                </a>
                            </span>
                        @endif
                        @if(!empty($project->website_url))
                            <br>
                            <span>
                                <a href="{{ @$project->website_url }}" target="_blank" class="listing-address">
                                    <i class="fa fa-globe"></i>
                                    {{ @$project->website_url }}
                                </a>
                            </span>
                        @endif
                        @if($project->location->count() > 0)
                            <br>
                            <span>
                                <a href="#" class="listing-address">
                                    <i class="fa fa-map-marker"></i>
                                    {{ @$project->location->first()->name }}
                                </a>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            
        </div>

        <div id="listing-overview" class="listing-section">
            @if($project->tags->count() > 0)
                <ul class="apartment-details">
                    @foreach($project->tags as $tag)
                        <li>{{ $tag->name }}</li>
                    @endforeach
                </ul>
            @endif

            @if($project->categories->count() > 0)
                <h3 class="listing-desc-headline">Project Categories</h3>
                <ul class="listing-features">
                    @foreach($project->categories as $category)
                        <li><a href="/listing-category/{{ $category->slug }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            @endif
            
            <div class="margin-top-35">
                <p>
                    {{ $project->introduction }}
                </p>
                <p>
                    {{ $project->description }}
                </p>
                {{-- <p>
                    <iframe loading="lazy" style="border: 1px solid #CCC; border-width: 1px; margin-bottom: 5px; max-width: 100%;" src="//www.slideshare.net/slideshow/embed_code/key/lnoOgCXrjl9I1X" width="595" height="485" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" allowfullscreen="allowfullscreen"> </iframe>
                </p>
                <p>
                    <a class="twitter-timeline" data-width="900" data-height="1000" data-dnt="true" href="<https://twitter.com/viawater>" data-tweet-limit="5">Tweets by </a>
                </p> --}}
            </div>

            <div class="clearfix"></div>
        </div>

        <!-- Slider -->
        @if($project->media->count() > 1)
            <div id="listing-gallery" class="listing-section">
                <h3 class="listing-desc-headline margin-top-70">Additional Images</h3>
                <div class="listing-slider-small mfp-gallery-container margin-bottom-0">
                    @foreach($project->media as $fi)
                        <a href="{{ $fi->link }}" data-background-image="{{ $fi->link }}" class="item mfp-gallery" title="Featured image"></a>
                    @endforeach
                </div>
            </div>
        @endif

        @if(@$project->funding->count() > 0)
            <div id="add-review" class="add-review-box">
                <h3 class="listing-desc-headline margin-bottom-10">Funding Details</h3>
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>Funded By</th>
                            <th>Date</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($project->funding as $fng)
                            <tr>
                                <td>{{ @$fng->funded_by }}</td>
                                <td>
                                    @if(!empty($fng->link))
                                        <a href="{{ @$fng->link }}" target="_blank" style="color: blue;">
                                            {{ @$fng->funding_date }}
                                        </a>    
                                    @else
                                        {{ @$fng->funding_date }}
                                    @endif
                                </td>
                                <td>$ {{ @$fng->amount }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        @endif

        @if(@$project->impact->count() > 0 && !empty(@$project->impact->first()->statement))
            <div id="add-review" class="add-review-box" style="margin-top: 10px; background-color: #fcfcfc;">
                <h3 class="listing-desc-headline margin-bottom-10">Impact Stament</h3>
                <p> 
                    {{ @$project->impact->first()->statement }}
                    @if(!empty(@$project->impact->first()->url))
                        (<a href="{{ @$project->impact->first()->url }}" style="color: #03cafc;">Source</a>
                    @endif
                    @if(!empty(@$project->impact->first()->impact_date))
                        <a href="{{ @$project->impact->first()->impact_date }}">
                            , {{ \Carbon\Carbon::createFromFormat('Y-m-d', $project->impact->first()->impact_date)->format('Y') }}
                        </a>)
                    @else
                        )
                    @endif
                </p>
            </div>
        @endif

    </div>


    <!-- Sidebar -->
    <div class="col-lg-5 col-md-5 margin-top-50 sticky">
        @if(!empty($project->latitude) && !empty($project->longitude))
            <div id="listing-location" class="listing-section">
                <div id="singleListingMap-container">
                    <div id="singleListingMap" data-latitude="{{ @$project->latitude }}" data-longitude="{{ @$project->longitude }}" data-map-icon="fa fa-map-marker"></div>
                </div>
            </div>
        @endif
       
        <div class="listing-share margin-top-40 margin-bottom-40 no-border">
            @if(@$project->founders->count() > 0)
                <div class="boxed-widget opening-hours margin-top-35" style="text-align: left;">
                    <h3>Founder(s)</h3>
                    <div class="row with-forms  margin-top-0">
                        <ol>
                            @foreach($project->founders as $founder)
                                <li>
                                    <div class="col-lg-12">
                                        <ul>
                                            <li>Name: <span>{{ @$founder->name }}</span></li>
                                        </ul>
                                    </div>
                                </li>
                                <span>&nbsp;</span>
                            @endforeach
                        </ol>
                    </div>
                </div>
            @endif

            <ul class="share-buttons margin-top-40 margin-bottom-0">
                @if(!empty($project->facebook_url))
                    <li>
                        <a class="fb-share" target="_blank" href="{{ $project->facebook_url }}"><i class="fa fa-facebook"></i> Facebook</a>
                    </li>
                @endif
                @if(!empty($project->twitter_url))
                    <li>
                        <a class="twitter-share" target="_blank" href="{{ $project->twitter_url }}"><i class="fa fa-twitter"></i> Twitter</a>
                    </li>
                @endif
                @if(!empty($project->instagram_url))
                    <li>
                        <a class="gplus-share" target="_blank" href="{{ $project->instagram_url }}"><i class="fa fa-instagram"></i> Instagram</a>
                    </li>
                @endif
            </ul>

            @if(!empty(@$project->founded) || !empty(@$project->language) || !empty(@$project->linkedin_url) || !empty(@$project->youtube_channel) || !empty(@$project->contact_page_url) || !empty(@$project->github_url) || !empty(@$project->events_page_url) || !empty(@$project->jobs_page_url) || !empty(@$project->blog_url) || !empty(@$project->host_organization_url) || !empty(@$project->host_organization_url))
                <div class="boxed-widget opening-hours margin-top-35" style="text-align: left;">
                    <h3>Links</h3>
                    <ul>
                        @if(!empty(@$project->founded))
                            <li>Founded: <span>{{ @$project->founded }}</span></li>
                        @endif
                        @if(!empty(@$project->language))
                            <li>Language: <span>{{ @$project->language }}</span></li>
                        @endif
                        @if(!empty(@$project->linkedin_url))
                            <li>LinkedIn: <span><a href="{{ @$project->linkedin_url }}" target="_blank">{{ @$project->linkedin_url }}</a></span></li>
                        @endif
                        @if(!empty(@$project->youtube_channel))
                            <li>Youtube: <span><a href="{{ @$project->youtube_channel }}" target="_blank">{{ @$project->youtube_channel }}</a></span></li>
                        @endif
                        @if(!empty(@$project->contact_page_url))
                            <li>Contact page: <span><a href="{{ @$project->contact_page_url }}" target="_blank">{{ @$project->contact_page_url }}</a></span></li>
                        @endif
                        @if(!empty(@$project->github_url))
                            <li>Github: <span><a href="{{ @$project->github_url }}" target="_blank">{{ @$project->github_url }}</a></span></li>
                        @endif
                        @if(!empty(@$project->events_page_url))
                            <li>Events page: <span><a href="{{ @$project->events_page_url }}" target="_blank">{{ @$project->events_page_url }}</a><span></li>
                        @endif
                        @if(!empty(@$project->jobs_page_url))
                            <li>Jobs page: <span><a href="{{ @$project->jobs_page_url }}" target="_blank">{{ @$project->jobs_page_url }}</a></span></li>
                        @endif
                        @if(!empty(@$project->blog_url))
                            <li>Blog: <span><a href="{{ @$project->blog_url }}" target="_blank">{{ @$project->blog_url }}</a></span></li>
                        @endif
                        @if(!empty(@$project->host_organization_url))
                            <li>Host Org: <span><a href="{{ @$project->host_organization_url }}" target="_blank">{{ @$project->host_organization }}</a></span></li>
                        @endif
                        @if(!empty(@$project->host_organization_url))
                            <li>Host Org Url: <span><a href="{{ @$project->host_organization_url }}" target="_blank">{{ @$project->host_organization_url }}</a></span></li>
                        @endif
                    </ul>
                </div>
            @endif

            <div class="margin-top-35">
                <a class="suggest-button" target="_blank" href="https://airtable.com/shrAPHxxye5l9CIpQ">Suggest a change</a>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <!-- <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false&amp;language=en"></script> -->
    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOZ3iFXxO0dN75GKYwNsToH3W6u1kcGR0&sensor=false&amp;language=ene"></script>
    <script type="text/javascript" src="{{ asset('js/infobox.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/markerclusterer.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/maps.js') }}"></script>
@endsection