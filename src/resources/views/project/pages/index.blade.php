<!DOCTYPE html>
<html lang="en">

@include('project.includes.meta', ['data' => $data])

<body>
    @include('project.includes.header', ['data' => $data])
    @include('project.includes.banner', ['data' => $data])
    @include('project.includes.about', ['data' => $data])
    @include('project.includes.table', ['data' => $data])
    @include('project.includes.gallery', ['data' => $data])
    @include('project.includes.specification', ['data' => $data])
    @include('project.includes.plan', ['data' => $data])
    @include('project.includes.location', ['data' => $data])
    @include('project.includes.amenities', ['data' => $data])
    <section class="mb-0">
        <div class="contact-holder" id="contact-section">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-8 col-md-6 col-sm-12 contact-col">
                        <h2>GET COST SHEET & BROCHURE</h2>
                        <p>Click Below To Download Floorplans & Cost Sheet of Raj Viviente & Register for special offers.</p>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary formbuttonstyler">Download Now</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('project.includes.creations')
    @include('project.includes.footer', ['data' => $data])


    <!-- Modal -->
    @include('project.includes.contact_modal')
</body>
<!-- Main JS -->
<script src="https://kit.fontawesome.com/b6a944420c.js" crossorigin="anonymous"></script>
<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/tabs.js') }}"></script>
<script src="{{ asset('assets/js/img-previewer.js') }}"></script>
<script src="{{ asset('assets/js/slick.js') }}"></script>
<script src="{{ asset('assets/js/iziToast.min.js') }}"></script>
<script src="{{ asset('admin/js/pages/axios.min.js') }}"></script>
<script src="{{ asset('admin/js/pages/just-validate.production.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function(){
    $(".regular").slick({
        dots: false,
        infinite: true,
        adaptiveHeight: true,
        arrows: false,
        // prevArrow: '<button type="button" data-role="none" class="slick-prev"><i class="fas fa-long-arrow-alt-left"></i></button>',
        // nextArrow: '<button type="button" data-role="none" class="slick-next"><i class="fas fa-long-arrow-alt-right"></i></button>',
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: false
                }
            },
        ]
    });
    $(".gallery-slider").slick({
        dots: true,
        infinite: true,
        adaptiveHeight: true,
        arrows: true,
        prevArrow: '<button type="button" data-role="none" class="slick-prev"><i class="fas fa-long-arrow-alt-left"></i></button>',
        nextArrow: '<button type="button" data-role="none" class="slick-next"><i class="fas fa-long-arrow-alt-right"></i></button>',
        customPaging: function(slider, i) {
            return '<button> <img src="' + $(slider.$slides[i]).attr('img-src') + '"/></button>';
        },
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: false
                }
            },
        ]
    });
    $(".tab-regular").slick({
        dots: false,
        infinite: true,
        adaptiveHeight: false,
        draggable: false,
        prevArrow: '<button type="button" data-role="none" class="slick-prev"><i class="fas fa-long-arrow-alt-left"></i></button>',
        nextArrow: '<button type="button" data-role="none" class="slick-next"><i class="fas fa-long-arrow-alt-right"></i></button>',
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: false
                }
            },
        ]
    });
    $(".creation").slick({
        dots: false,
        infinite: true,
        adaptiveHeight: true,
        // arrows: false,
        prevArrow: '<button type="button" data-role="none" class="slick-prev"><i class="fas fa-long-arrow-alt-left"></i></button>',
        nextArrow: '<button type="button" data-role="none" class="slick-next"><i class="fas fa-long-arrow-alt-right"></i></button>',
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: false
                }
            },
        ]
    });

    const myModal = new bootstrap.Modal('#exampleModal', {
        keyboard: false
    })
    setTimeout(function() {
        myModal.show();
    }, 5000);

    const errorToast = (message) => {
        iziToast.error({
            title: 'Error',
            message: message,
            position: 'bottomCenter',
            timeout: 7000
        });
    }
    const successToast = (message) => {
        iziToast.success({
            title: 'Success',
            message: message,
            position: 'bottomCenter',
            timeout: 6000
        });
    }

});

</script>

@include('project.includes.script', ['data' => $data])

</html>
