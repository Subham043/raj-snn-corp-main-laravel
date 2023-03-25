@if($data->ProjectAbout)
<section>
    <div class="container">
        <div class="about-holder" id="about-section">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-6 col-sm-12 slider-holder">
                    <div class="slider-img">
                        <img src="{{ $data->ProjectAbout->left_image_link }}" class="w-100" alt="">
                    </div>
                </div>
                <div class="col-lg-7 col-md-6 col-sm-12 content-holder">
                    <div class="logo-secondary text-center">
                        <img src="{{ $data->ProjectAbout->about_logo_link }}" alt="">
                    </div>
                    <!-- <h2 class="main-title text-center">
                        Raj <span>Viviente</span>
                    </h2> -->
                    <h6 class="text-center">
                        <span>RERA NUMBER:</span> {{ $data->ProjectAbout->rera }}
                    </h6>
                    {!! $data->ProjectAbout->description !!}
                </div>
            </div>
        </div>
    </div>
</section>
@endif
