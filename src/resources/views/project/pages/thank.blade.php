<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2, user-scalable=yes">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Thank You</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css')}}">

    <style>
        body{
            display: grid;
            place-items: center;
            min-height: 100vh;
            background-image: linear-gradient(45deg,rgba(245,70,66,.75),rgba(8,83,156,.75));
        }
    </style>

    @if($data->ProjectThank)
        {!!$data->ProjectThank->meta_header!!}
    @endif
</head>

<body>
    <div>
        <header>
            <nav>
                <div class="logo-holder">
                    <a href="">
                        <img src="{{ $data->header_logo_link }}" class="main-logo top-logo" alt="">
                    </a>
                </div>
            </nav>
        </header>
        @if($data->ProjectBanner)
        <section class="pt-5">
            <div class="container">
                <div class="about-holder" id="about-section">
                    <div class="row align-items-center">
                        <div class="col-lg-5 col-md-6 col-sm-12 slider-holder">
                            <div class="slider-img">
                                <img src="{{ $data->ProjectBanner->banner_image_link }}" class="w-100" alt="Project Image">
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6 col-sm-12 content-holder">
                            <h2 class="text-center text-white">
                                <span>Thank You!!</span>
                            </h2>
                            <h5 class="text-center text-white">
                                We have recieved your enquiry. Our team will contact you soon.
                            </h5>
                            <div class="row justify-content-center align-item-center gap-5 mt-5">
                                <a type="button" href="{{route('project_view_main.get', $data->slug)}}" class=" col-auto btn btn-primary formbuttonstyler" aria-label="Download Brouchure">Go Back</a>
                                <a type="button" href="https://snnrajcorp.com" class=" col-auto btn btn-primary formbuttonstyler" aria-label="Download Brouchure">Visit SNN RAJ CORP</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif
    </div>

</body>
</html>
