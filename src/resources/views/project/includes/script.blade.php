<script src="https://kit.fontawesome.com/b6a944420c.js" crossorigin="anonymous"></script>
<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/tabs.js') }}"></script>
<script src="{{ asset('assets/js/img-previewer.js') }}"></script>
<script src="{{ asset('assets/js/slick.js') }}"></script>
<script src="{{ asset('assets/js/iziToast.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
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
// const galleryViewer = new ImgPreviewer('#gallery-container', {
//     // aspect ratio of image
//     fillRatio: 0.9,
//     // attribute that holds the image
//     dataUrlKey: 'src',
//     // additional styles
//     style: {
//         modalOpacity: 0.6,
//         headerOpacity: 0,
//         zIndex: 99
//     },
//     // zoom options
//     imageZoom: {
//         min: 0.1,
//         max: 5,
//         step: 0.1
//     },
//     // detect whether the parent element of the image is hidden by the css style
//     bubblingLevel: 0,

// });
// const floorViewer = new ImgPreviewer('#floor-container',{
//   // aspect ratio of image
//     fillRatio: 0.9,
//     // attribute that holds the image
//     dataUrlKey: 'src',
//     // additional styles
//     style: {
//         modalOpacity: 0.6,
//         headerOpacity: 0,
//         zIndex: 99
//     },
//     // zoom options
//     imageZoom: {
//         min: 0.1,
//         max: 5,
//         step: 0.1
//     },
//     // detect whether the parent element of the image is hidden by the css style
//     bubblingLevel: 0,

// });
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

jQuery.validator.addMethod("namePattern", function(value, element) {
    return /^[a-zA-Z\s]*$/.test(value);
}, "Your name contains invalid characters");

var validators = $("#contact-form").validate({
    rules: {
        // compound rule
        name: {
            required: true,
            namePattern: true
        },
        email: {
            required: true,
            email: true
        },
        phone: {
            required: true,
            digits: true,
        },
    },
    messages: {
        name: {
            required: "Please specify your full name",
        },
        email: {
            required: "Please specify your email",
            email: "Your email address must be in the format of name@domain.com"
        },
        phone: {
            required: "Please specify your phone",
            digits: "Your phone number must be in the format of digits only",
        },
    },
    submitHandler: function(form) {
        // form.submit();
        var submitBtn = document.getElementById('submitBtn')
        submitBtn.innerHTML = `
                <span class="d-flex align-items-center">
                    <span class="spinner-border flex-shrink-0" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </span>
                    <span class="flex-grow-1 ms-2">
                        Loading...
                    </span>
                </span>
                `
        submitBtn.disabled = true;
        $.ajax({
            type: "POST",
            url: "mail.php",
            data: new FormData(form),
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            dataType: "json",
            success: function(response) {
                successToast("Message Sent Successfully.")
                grecaptcha.reset();
                form.reset();
                submitBtn.innerHTML = `
                        Submit
                        `
                submitBtn.disabled = false;
                myModal.hide();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                if (xhr?.responseJSON?.form_error?.name) {
                    validators.showErrors({
                        "name": xhr?.responseJSON?.form_error?.name
                    });
                }
                if (xhr?.responseJSON?.form_error?.email) {
                    validators.showErrors({
                        "email": xhr?.responseJSON?.form_error?.email
                    });
                }
                if (xhr?.responseJSON?.form_error?.phone) {
                    validators.showErrors({
                        "phone": xhr?.responseJSON?.form_error?.phone
                    });
                }
                if (xhr?.responseJSON?.error) {
                    errorToast(xhr?.responseJSON?.error)
                }
                submitBtn.innerHTML = `
                        Submit
                        `
                submitBtn.disabled = false;
            }
        });
        return false;
    }
});
var validators2 = $("#banner-form").validate({
    rules: {
        // compound rule
        name: {
            required: true,
            namePattern: true
        },
        email: {
            required: true,
            email: true
        },
        phone: {
            required: true,
            digits: true,
        },
    },
    messages: {
        name: {
            required: "Please specify your full name",
        },
        email: {
            required: "Please specify your email",
            email: "Your email address must be in the format of name@domain.com"
        },
        phone: {
            required: "Please specify your phone",
            digits: "Your phone number must be in the format of digits only",
        },
    },
    submitHandler: function(form) {
        // form.submit();
        var submitBtn = document.getElementById('submitBtn2')
        submitBtn.innerHTML = `
                <span class="d-flex align-items-center">
                    <span class="spinner-border flex-shrink-0" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </span>
                    <span class="flex-grow-1 ms-2">
                        Loading...
                    </span>
                </span>
                `
        submitBtn.disabled = true;
        $.ajax({
            type: "POST",
            url: "mail.php",
            data: new FormData(form),
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            dataType: "json",
            success: function(response) {
                successToast("Message Sent Successfully.")
                form.reset();
                submitBtn.innerHTML = `
                        Submit
                        `
                submitBtn.disabled = false;
            },
            error: function(xhr, ajaxOptions, thrownError) {
                if (xhr?.responseJSON?.form_error?.name) {
                    validators2.showErrors({
                        "name": xhr?.responseJSON?.form_error?.name
                    });
                }
                if (xhr?.responseJSON?.form_error?.email) {
                    validators2.showErrors({
                        "email": xhr?.responseJSON?.form_error?.email
                    });
                }
                if (xhr?.responseJSON?.form_error?.phone) {
                    validators2.showErrors({
                        "phone": xhr?.responseJSON?.form_error?.phone
                    });
                }
                if (xhr?.responseJSON?.error) {
                    errorToast(xhr?.responseJSON?.error)
                }
                submitBtn.innerHTML = `
                        Submit
                        `
                submitBtn.disabled = false;
            }
        });
        return false;
    }
});
</script>
