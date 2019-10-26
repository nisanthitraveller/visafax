/**
 * @module       RD Navbar
 * @description  Enables RD Navbar Plugin
 */
;
(function ($) {
    var o = $('.rd-navbar');

    if (o.length > 0) {
        // include('../js/jquery.rd-navbar.js');

        $(document).ready(function () {
            o.RDNavbar({
                stickUpClone: false,
                stickUpOffset: 170
            });
        });
    }
    initSlider();
    $('.ld-more').click(function () {
        $('.not-visible, .ld-more').toggle();
    });
    $('.input-group').on('click', '.button-plus', function (e) {
        incrementValue(e);
    });

    $('.input-group').on('click', '.button-minus', function (e) {
        decrementValue(e);
    });

    $('#create-visa').click(function () {
        createVisa();
    });
    $('#pay-button').click(function () {
        PayUValidateDesktop();
    });

    $('.price-check').change(function () {
        priceCheck();
    });

    $('.panel-collapse').on('show.bs.collapse', function () {
        $(this).siblings('.panel-heading').addClass('active');
    });

    $('.panel-collapse').on('hide.bs.collapse', function () {
        $(this).siblings('.panel-heading').removeClass('active');
    });

    /*$('.ui.dropdown').dropdown({
        on: 'hover'
    });
    $('.up-sucess-btn').popup({
        inline: true
    });*/

    $('.collapse').on('show.bs.collapse', function () {
        $('.collapse.show').each(function () {
            $(this).collapse('hide');
        });
    });
    
    priceCheck();

})(jQuery);


/**
 * @function      isIE
 * @description   checks if browser is an IE
 * @returns       {number} IE Version
 */
function isIE() {
    var myNav = navigator.userAgent.toLowerCase();
    return (myNav.indexOf('msie') != -1) ? parseInt(myNav.split('msie')[1]) : false;
}
;


/**
 * @module       Smoothscroll
 * @description  Enables smooth scrolling on the page
 */
;
(function ($) {
    if ($("html").hasClass("smoothscroll")) {
        include('js/smoothscroll.min.js');
    }
})(jQuery);


(function () {

    $("#sign-btn").on("click", function () {
        $(".card-d").toggle("fast");
    });

    $(".close").click(function () {
        $(".rd-navbar-nav-wrap").removeClass("active");
    });

    $(".close").click(function () {
        // $('#slidePanel').toggle( "slide",{direction: 'right'});
        if ($('.rd-navbar-nav-wrap').hasClass('active')) {
            $('.rd-navbar-nav-wrap').removeClass('active');
        } else {
            $('#btnDiv').addClass('rotated');
        }
    });

    $(".close").click(function () {
        $(".rd-navbar-toggle").removeClass("active");
    });



})();


$(window).on('load', function () {

    // Vimeo API nonsense
    var player = document.getElementById('player_1');
    $f(player).addEvent('ready', ready);

    function addEvent(element, eventName, callback) {
        (element.addEventListener) ? element.addEventListener(eventName, callback, false) : element.attachEvent(eventName, callback, false);
    }

    function ready(player_id) {
        var froogaloop = $f(player_id);

        froogaloop.addEvent('play', function (data) {
            $('.flexslider').flexslider("pause");
        });

        froogaloop.addEvent('pause', function (data) {
            $('.flexslider').flexslider("play");
        });
    }


    // Call fitVid before FlexSlider initializes, so the proper initial height can be retrieved.
    $(".flexslider")
            .fitVids()
            .flexslider({
                animation: "slide",
                useCSS: false,
                animationLoop: false,
                smoothHeight: true,
                start: function (slider) {
                    $('body').removeClass('loading');
                },
                before: function (slider) {
                    $f(player).api('pause');
                }
            });
});
$(document).ready(function () {
    $('.stories').owlCarousel({
        loop: false,
        margin: 35,
        responsiveClass: true,
        nav: true,
        responsive: {
            0: {
                items: 1,
                nav: true

            },
            600: {
                items: 2,
                nav: true

            },
            768: {
                items: 2,
                nav: true

            },
            1000: {
                items: 2,
                nav: true

            }
        }
    })


});


$(document).ready(function () {

    $('.cart-box .image').on('click', function () {
        $(this).toggleClass('toggle-animation');
    });



});


$(document).ready(function () {
    $('#imageGallery').lightSlider({
        gallery: true,
        item: 1,
        loop: true,
        thumbItem: 4,
        slideMargin: 0,
        enableDrag: true,
        thumbMargin: 15,
        galleryMargin: 15,
        pager: true,

        currentPagerPosition: 'left',
        onSliderLoad: function (el) {
            /* el.swipePlugin({
             selector: '#imageGallery .lslide'
             });*/
        },

        responsive: [
            {
                breakpoint: 768,
                settings: {
                    gallery: false,
                }
            }

        ]

    });
});




$.fn.filestyle = function (options) {
    var settings = $.extend(
            {
                fieldText: 'No File Selected',
                buttonText: 'Select File',
                wrapClass: 'file',
                wrapContent: '<div class="file"></div>',
                fakeContent: '<div class="fake"><button></button><input type="text" disabled="disabled" class="filename" /></div>'
            },
            options
            );

    // init
    $(this).wrap(settings.wrapContent)
            .after(settings.fakeContent)
            .on('change.file', function () {
                var val = $(this).val().split('\\');
                $(this).next().find('.filename').val(val.slice(-1)[0]);
            });

    $(this).next().find('.filename').val(settings.fieldText);
    $(this).next().find('button').text(settings.buttonText);

    return this;
};

$('[type="file"]').filestyle({
    fieldText: '', // german translation
    buttonText: 'Choose file'
});


$(document).ready(function () {


    $('.switch label').on('click', function () {
        var indicator = $(this).parent('.switch').find('span');
        if ($(this).hasClass('right')) {
            $(indicator).addClass('right');
        } else {
            $(indicator).removeClass('right');
        }
    });

});
$(document).ready(function () {

    $(".number-btn").inputCounter({
        selectors: {
            addButtonSelector: '.btn-add',
            subtractButtonSelector: '.btn-subtract',
            inputSelector: '.input-counter',
        }
    });

});

/*
 $('#location-modal').modal({
 // backdrop: 'static',
 // keyboard: false
 })*/
function initSlider() {
    console.log('Slider loaded');
    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav'
    });
    $('.slider-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: true,
        centerMode: true,
        focusOnSelect: true
    });
}
/*var placeholder = "Select a State";

 $( ".select2-single, .select2-multiple" ).select2( {
 placeholder: placeholder,
 width: null,
 containerCssClass: ':all:'
 } );

 $( ".select2-allow-clear" ).select2( {
 allowClear: true,
 placeholder: placeholder,
 width: null,
 containerCssClass: ':all:'
 } );*/


$(".change-color-switch").bootstrapSwitch();

$(document).ready(function () {


    $('.change-color-switch').on('switchChange.bootstrapSwitch', function (e, data) {
        var state = $(this).bootstrapSwitch('state');//returns true or false

        if (state)
        {
            $(".conf-dy").show();
            $(".book-state").addClass("intros");
        } else
        {
            $(".conf-dy").hide();
            $(".book-state").removeClass("intros");
        }
    });
});


$(".book-htls").bootstrapSwitch();

$(document).ready(function () {


    $('.book-htls').on('switchChange.bootstrapSwitch', function (e, data) {
        var state = $(this).bootstrapSwitch('state');//returns true or false

        if (state)
        {
            $(".conf-dy-htl").show();
            $(".book-state").addClass("intros");
        } else
        {
            $(".conf-dy-htl").hide();
            $(".book-state").removeClass("intros");
        }
    });
});




/*$(".change-color-switch").bootstrapSwitch();

 $(document).ready(function(){


 $('.change-color-switch').on('switchChange.bootstrapSwitch', function (e, data) {
 var state=$(this).bootstrapSwitch('state');//returns true or false

 if(state)
 {
 // $(".book-state").show();
 $(".book-state").addClass("intros");
 }
 else
 {
 $(".book-state").removeClass("intros");
 //  $(".book-state").hide();
 }
 });
 });
 */

$(document).on('change', ':file', function () {
    var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
});
function incrementValue(e) {
    e.preventDefault();
    var fieldName = $(e.target).attr('data-field');
    var parent = $(e.target).closest('div');
    var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);
    if (!isNaN(currentVal)) {
        parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
    } else {
        parent.find('input[name=' + fieldName + ']').val(1);
    }
}

function decrementValue(e) {
    e.preventDefault();
    var fieldName = $(e.target).attr('data-field');
    var parent = $(e.target).closest('div');
    var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

    if (!isNaN(currentVal) && currentVal > 1) {
        parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
    } else {
        parent.find('input[name=' + fieldName + ']').val(1);
    }
}

function createVisa() {
    openModal();
    var form = $('#visaForm')[0];
    var fd = new FormData(form);

    var xhr = new XMLHttpRequest();
    xhr.responseType = 'json';
    var token = $('meta[name=csrf-token]').attr('content');

    xhr.onload = function () {

        var response = xhr.response;
        console.log(response.status);
        console.log(response.redirect);
        if (response.status == false) {
            console.log('Invalid Token');
        } else {
            closeModal();
            //$('#connect-modal-signup').modal('show');
            location.href = '/dashboard?popup=2';
            console.log('redirect true');
        }
    };
    xhr.open("POST", "/createvisa");
    xhr.setRequestHeader("x-csrf-token", token);
    xhr.send(fd);

}

function PayUValidateDesktop() {
    var status = 0;
    var frm = document.PayUTransaction;
    var aName = Array();


    aName['amount'] = 'Amount';
    aName['firstname'] = 'Billing Name';
    aName['email'] = 'Billing Email';
    aName['phone'] = 'Billing Phone Number';
    aName['productinfo'] = 'Product Information';

    for (var i = 0; i < frm.elements.length; i++) {

        if (frm.elements[i].name == 'amount') {
            if (!validateNumeric(frm.elements[i].value)) {
                alert("Amount should be NUMERIC");
                frm.elements[i].focus();
                status = 1;
            }
        }

        if ((frm.elements[i].name == 'firstname'))
        {
            if (validateNumeric(frm.elements[i].value)) {
                alert("Enter your FirstName");
                frm.elements[i].focus();
                status = 1;
            }
        }

        if (frm.elements[i].name == 'email') {
            if (!validateEmail(frm.elements[i].value)) {
                alert("Invalid input for " + aName[frm.elements[i].name]);
                frm.elements[i].focus();
                status = 1;
            }
        }

        if ((frm.elements[i].name == 'phone')) {
            if (!validateNumeric(frm.elements[i].value)) {
                alert("Enter a Valid CONTACT NUMBER");
                frm.elements[i].focus();
                status = 1;
            }
        }
    }
    if (status == 0) {
        var token = $('meta[name=csrf-token]').attr('content');
        $.ajax({
            type: 'POST',
            url: "/payusubmit",
            data: $('#PayUTransaction').serialize(),
            headers: {"x-csrf-token": token},
            success: function (data) {
                $("#submitpayment").html(data);
                $('#PayUForm').submit();
            }
        });
    }
}

function validateNumeric(numValue) {
    if (!numValue.toString().match(/^[-]?\d*\.?\d*$/))
        return false;
    return true;
}

function validateEmail(email) {
    //Validating the email field
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if (!email.match(re)) {
        return (false);
    }
    return(true);
}

function priceCheck() {
    var price = 0;
    var planId = '';
    if($('.price-check').length) {
        $('.price-check:checked').each(function () {
            price += isNaN(parseInt($(this).attr('data-price'))) ? 0 : parseInt($(this).attr('data-price'));
            planId += $(this).val() + '-';
        });
        console.log(price);
        $('#amount').val(price * parseInt($('#persons').val()));
        $('#udf1').val(planId);
        $('#pay-button').text('Pay ₹' + price * parseInt($('#persons').val()) + '/- ' + '<span style="font-size: 12px">' + $('#persons').val() + ' person(s)</span>');
    }
}

/*
 * $("#multipleupload").uploadFile({
 url: "upload.php",
 multiple: true,
 dragDrop: true,
 fileName: "Choose File"
 });
 */