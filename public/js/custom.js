

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

    $('.stories').owlCarousel({
        loop: false,
        margin: 35,
        autoplay: true,
        autoplayTimeout: 3000,
        responsiveClass: true,
        nav: true,
        responsive: {
            0: {
                items: 1,
                nav: true

            },
            600: {
                items: 1,
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



})

$(window).on('load', function () {

    $('.testmonials').owlCarousel({
        loop: true,
        margin: 80,
        autoplay: true,
        autoplayTimeout: 3000,
        responsiveClass: true,
        nav: true,
        responsive: {
            0: {
                items: 1,
                nav: true

            },
            600: {
                items: 1,
                nav: true

            },
            768: {
                items: 1,
                nav: true

            },
            1000: {
                items: 1,
                nav: true

            }
        }
    })



})


$(document).ready(function () {

    $('.cart-box .image').on('click', function () {
        $(this).toggleClass('toggle-animation');
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


/*
 $('#location-modal').modal({
 // backdrop: 'static',
 // keyboard: false
 })*/
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




$(".change-color-switch").bootstrapSwitch();

$(document).ready(function () {


    $('.change-color-switch').on('switchChange.bootstrapSwitch', function (e, data) {
        var state = $(this).bootstrapSwitch('state');//returns true or false

        if (state)
        {
            // $(".book-state").show();
            $(".book-state").addClass("intros");
        } else
        {
            $(".book-state").removeClass("intros");
            //  $(".book-state").hide();
        }
    });
});


$(document).on('change', ':file', function () {
    var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
});

/*$('#vis').change(function(){
 if($(this).is(":checked")) {
 $('.pay-wrap').addClass('pay-active');
 } else {
 $('.pay-wrap').removeClass('pay-active');
 }
 });*/

$('.panel-collapse').on('show.bs.collapse', function () {
    $(this).siblings('.panel-heading').addClass('active');
});

$('.panel-collapse').on('hide.bs.collapse', function () {
    $(this).siblings('.panel-heading').removeClass('active');
});

/*  $(window).scroll(function(){
 if ($(this).scrollTop() > 160) {
 $('.pay-last-btn').addClass('newClass');
 } else {
 $('.pay-last-btn').removeClass('newClass');
 }
 });
 */





$(document).ready(function () {
    $('.collapse').on('show.bs.collapse', function () {
        $('.collapse.show').each(function () {
            $(this).collapse('hide');
        });
    });
});



$('.selectpicker').selectpicker();



if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {
    $('.selectpicker').selectpicker('mobile');
} else {
    $('.selectpicker').selectpicker({});
}

$(document).ready(function () {
    $("body").tooltip({selector: '[data-toggle=tooltip]'});
});


$(document).ready(function () {

    function wcqib_refresh_quantity_increments() {
        jQuery(
                'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)'
                ).each(function (a, b) {
            var c = jQuery(b);
            c.addClass('buttons_added'),
                    c
                    .children()
                    .first()
                    .before('<input type="button" value="-" class="minus" />'),
                    c
                    .children()
                    .last()
                    .after('<input type="button" value="+" class="plus" />');
        });
    }
    String.prototype.getDecimals ||
            (String.prototype.getDecimals = function () {
                var a = this,
                        b = ('' + a).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
                return b
                        ? Math.max(0, (b[1] ? b[1].length : 0) - (b[2] ? +b[2] : 0))
                        : 0;
            }),
            jQuery(document).ready(function () {
        wcqib_refresh_quantity_increments();
    }),
            jQuery(document).on('updated_wc_div', function () {
        wcqib_refresh_quantity_increments();
    }),
            jQuery(document).on('click', '.plus, .minus', function () {
        var a = jQuery(this)
                .closest('.quantity')
                .find('.qty'),
                b = parseFloat(a.val()),
                c = parseFloat(a.attr('max')),
                d = parseFloat(a.attr('min')),
                e = a.attr('step');
        (b && '' !== b && 'NaN' !== b) || (b = 0),
                ('' !== c && 'NaN' !== c) || (c = ''),
                ('' !== d && 'NaN' !== d) || (d = 0),
                ('any' !== e &&
                        '' !== e &&
                        void 0 !== e &&
                        'NaN' !== parseFloat(e)) ||
                (e = 1),
                jQuery(this).is('.plus')
                ? c && b >= c
                ? a.val(c)
                : a.val((b + parseFloat(e)).toFixed(e.getDecimals()))
                : d && b <= d
                ? a.val(d)
                : b > 0 && a.val((b - parseFloat(e)).toFixed(e.getDecimals())),
                a.trigger('change');
    });

});

$(document).ready(function () {
    $('a[href^="#"]').click(function () {
        var the_id = $(this).attr("href");
        if (the_id === '#') {
            return;
        }
        $('html, body').animate({
            scrollTop: $(the_id).offset().top
        }, 'slow');
        return false;
    });
    $('input.typeahead').typeahead({
        hint: true,
        highlight: true,
        source: function (query, process) {
            var $this = this; //get a reference to the typeahead object
            return $.get(path, {query: query}, function (data) {
                var options = [];
                $this['map'] = {}; //replace any existing map attr with an empty object
                $.each(data, function (i, val) {
                    options.push(val.name);
                    $this.map[val.name] = val.id; //keep reference from name -> id
                });
                return process(options);
            });
        },
        afterSelect: function(item) {
            console.log(item);
            var str3 = 'india';
            var str3 = item.replace(" ", "-");
            if (str3 != '') {
                window.location.href = "/visa/" + str3.toLowerCase();
                console.log(this.map[item], item); //access it here
            }
        }
    });
});


