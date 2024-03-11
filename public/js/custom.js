var count = -1;
var slides = jQuery.makeArray($('#slides article')), //base 0
    totalSlides = slides.length - 1;
var startPos = { "top": '100%', "z-index": "0" },
    endPos = { 'top': '0px', "z-index": "2" },
    prevPos = { 'top': '-100%', "z-index": "0" },
    transit = { "transition": "top 800ms ease 0s", "transition-delay": "0s" },
    nonetrans = { "transition": "none" },
    timer = null;


// function advance() {
//     if (count == totalSlides) {
//         $(slides[count]).animate(startPos, 0).css(transit);
//         count = 0;
//         $(slides[count]).css(prevPos).css(nonetrans);
//         $(slides[count]).animate(endPos, 0).css(transit);
//     } else {

//         $(slides[count]).animate(startPos, 0).css(transit);
//         count++;
//         $(slides[count]).css(prevPos).css(nonetrans);
//         $(slides[count]).animate(endPos, 0).css(transit);

//     }
// }

// function rewind() {

//     if (count === 0) {
//         $(slides[count]).animate(prevPos, 0).css(transit);
//         count = totalSlides;
//         $(slides[count]).css(startPos).css(nonetrans);
//         $(slides[count]).animate(endPos, 0).css(transit);
//     } else {
//         $(slides[count]).prev().css(startPos).css(nonetrans);
//         $(slides[count]).animate(prevPos, 0).css(transit);
//         count = count - 1;
//         $(slides[count]).animate(endPos, 0).css(transit);

//     }


// }

// // Slideshow automatic slide function
// function playSlides() {
//     clickDots();
//     upDown();

//     function loop() {
//         advance();
//         selectDots();
//         timer = setTimeout(loop, 5000);
//         unbindBtn();
//     }
//     loop();
// }




// $(document).ready(function() {
//     playSlides();


// });

const tabs = document.querySelectorAll('[data-tab-target]')
const tabContents = document.querySelectorAll('[data-tab-content]')

tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        const target = document.querySelector(tab.dataset.tabTarget)
        tabContents.forEach(tabContent => {
            tabContent.classList.remove('active')
        })
        tabs.forEach(tab => {
            tab.classList.remove('active')
        })
        tab.classList.add('active')
        target.classList.add('active')
    })
})



// $( document ).ajaxComplete(function() {
//     $('.your-class').slick({
//         infinite: true,
//         slidesToShow: 4,
//         slidesToScroll: 1,
//         responsive: [{
//                 breakpoint: 1024,
//                 settings: {
//                     slidesToShow: 3,
//                     slidesToScroll: 3,
//                     infinite: true,
//                     dots: true
//                 }
//             },
//             {
//                 breakpoint: 600,
//                 settings: {
//                     slidesToShow: 2,
//                     slidesToScroll: 2
//                 }
//             },
//             {
//                 breakpoint: 480,
//                 settings: {
//                     slidesToShow: 1,
//                     slidesToScroll: 1
//                 }
//             }
//             // You can unslick at a given breakpoint now by adding:
//             // settings: "unslick"
//             // instead of a settings object
//         ]
//     });
// });

$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
    $('.your-class').slick('setPosition');
})

$('.js-toggle-cart, .cart__overlay').on('click', function() {
    $('.cart').toggleClass('is-hidden');
});
$(".qtyminus").on("click", function() {
    var now = $(".qty").val();
    if ($.isNumeric(now)) {
        if (parseInt(now) - 1 > 0) { now--; }
        $(".qty").val(now);
    }
})
$(".qtyplus").on("click", function() {
    var now = $(".qty").val();
    if ($.isNumeric(now)) {
        $(".qty").val(parseInt(now) + 1);
    }
});

$(".qtyminus1").on("click", function() {
    var now = $(".qty1").val();
    if ($.isNumeric(now)) {
        if (parseInt(now) - 1 > 0) { now--; }
        $(".qty1").val(now);
    }
})
$(".qtyplus1").on("click", function() {
    var now = $(".qty1").val();
    if ($.isNumeric(now)) {
        $(".qty1").val(parseInt(now) + 1);
    }
});
$(document).ready(function() {
    $('.menu-toggle').click(function() {
        $('nav').toggleClass('active');
    })
});
$(document).ready(function() {
    $('.accordion a').click(function() {
        $(this).toggleClass('active');
        $(this).next('.content').slideToggle(400);
    });
});
//Dots functions
function selectDots() {
    n = count + 1;
    $('#dots li:nth-child(' + n + ')').addClass('selected');
    $('#dots li:nth-child(' + n + ')').siblings().removeClass('selected');
}

function clickDots() {

    $('#dots li').bind('click', function() {

        var index = $(this).index();
        if (count > index) {

            $(slides[count]).animate(prevPos, 0).css(transit);
            count = index;
            $(slides[count]).css(startPos).css(nonetrans);
            $(slides[count]).animate(endPos, 0).css(transit);

        } else if (count < index) {
            $(slides[count]).animate(startPos, 0).css(transit);
            count = index;
            $(slides[count]).css(prevPos).css(nonetrans);
            $(slides[count]).animate(endPos, 0).css(transit);

        } else {
            return false;
        }
        selectDots();
        clearTimeout(timer);
        timer = setTimeout(playSlides, 7500);
        unbindBtn();
    });

}
document.addEventListener("DOMContentLoaded", function() {
    window.addEventListener('scroll', function() {
        if (window.scrollY > 80) {
            document.getElementById('navbar_top').classList.add('fixed-top');
            // add padding top to show content behind navbar
            navbar_height = document.querySelector('.navbar');
            document.body.style.paddingTop = navbar_height + 'px';
        } else {
            document.getElementById('navbar_top').classList.remove('fixed-top');
            // remove padding top from body
            document.body.style.paddingTop = '0';
        }
    });
});

//next and prev buttons

function upDown() {
    $('.next').bind('click', function() {
        advance();
        selectDots();
        clearTimeout(timer);
        timer = setTimeout(playSlides, 7500);
        unbindBtn();
    });

    $('.prev').bind('click', function() {
        if (count == -1) {
            count = 0;
        } else {
            rewind();
        }

        selectDots();
        clearTimeout(timer);
        timer = setTimeout(playSlides, 7500);
        unbindBtn();
    });
}


function unbindBtn() {
    $('.next,.prev,#dots li').unbind('click');
    setTimeout(upDown, 800);
    setTimeout(clickDots, 800);
}


// Slideshow automatic slide function
function playSlides() {
    clickDots();
    upDown();

    function loop() {
        advance();
        selectDots();
        timer = setTimeout(loop, 5000);
        unbindBtn();
    }
    loop();
}



// Add to cart
$('.btn').on('click', function() {
    $('.modal').toggleClass('is-open');
});

$('.dropdown').on('click', function() {
    $(this).toggleClass('is-open');
});

$('.radio, .checkbox').on('click', function() {
    $(this).toggleClass('is-selected');
});

$('input, select').on('focus', function() {
    $(this).parent('.input').addClass('is-active');
});

$('input, select').on('blur', function() {
    var hasVal = !!$(this).val()

    $(this).parent('.input').removeClass('is-active');

    $(this).parent('.input').toggleClass('has-value', hasVal);

    var reg = new RegExp($(this).data('mask'));
    var val = $(this).val();
    var test = reg.test(val);
    var luhn = null;
    var hasLuhn = $(this)[0].hasAttribute('data-luhn');

    if (hasLuhn) {
        luhn = luhnChk(val.replace(/\-/gmi, ''));
        console.log(luhn);
    }

    if (hasLuhn && !luhn) {
        $(this).parent('.input').addClass('has-errors');
    } else if (val && !test) {
        $(this).parent('.input').addClass('has-errors');
    } else {
        $(this).parent('.input').removeClass('has-errors');
    }
});

$('input').on('input', function() {
    var reg = new RegExp($(this).data('mask'));
    var test = reg.test($(this).val());

    if (test) {
        $(this).parent('.input').addClass('is-valid');
    } else {
        $(this).parent('.input').removeClass('is-valid');
    }

    $(this).parent('.input').removeClass('has-errors');
});

$('#ccnumber').on('input', function() {
    var val = $(this).val()

    val = val.replace(/\D/gmi, '');

    str = val.match(/.{1,4}/g);

    $(this).val(str ? str.join(' ') : '');
});

$('.control__input').on('change', function() {
    var $this = $(this);
    $(this).parent('.control').toggleClass('is-selected', this.checked);
    $('.control__input').each(function(index) {
        if ($(this).attr('id') !== $this.attr('id') && $(this).attr('name') === $this.attr('name')) {
            $(this).parent('.control').removeClass('is-selected');
        }
    });
});


$('#to-shipping-method').on('click', function(e) {
    e.preventDefault();
    goTo(2);
});

$('#to-payment-method').on('click', function(e) {
    e.preventDefault();
    goTo(3);
});

$('.js-goto').on('click', function(e) {
    e.preventDefault();
    var $this = $(this);
    $this.addClass('is-loading');

    // setTimeout(function() {
    $this.removeClass('is-loading');

    // setTimeout(function() {
    goTo($this.data('page'));
    // }, 250);
    // }, 1500);
});

function goTo(page) {
    $('.page').removeClass('is-active')
    $('.page--' + page).addClass('is-active')
}

$('.js-add-giftcard').on('click', function(e) {
    e.preventDefault();
    var val = $('#giftcard').val();

    if (val) {
        addGiftcard(val);
        $('#giftcard').val('');
        $('#giftcard').blur();
    }
});

function addGiftcard(code) {
    $('.cards').after('<div class="giftcard"><div class="f"><div class="f70"><b>' + code + '</b><div class="microcopy">Balance left: $0.00</div></div><div class="f30">$50.00</div></div></div>');

    $('.giftcard').first().hide().fadeIn();
}

$('.collapser__label').on('click', function(e) {
    e.preventDefault();
    $(this).parent('.collapser').toggleClass('is-open');
    var isopen = $('.collapser').hasClass('is-open');

    if ($(this).parent('.collapser').find('.collapser__content input')) {
        $(this).parent('.collapser').find('.collapser__content input').first().focus();
    }
});









$(function() {
    var filterList = {
        init: function() {
            // MixItUp plugin
            // http://mixitup.io
            $('#portfoliolist').mixItUp({
                selectors: {
                    target: '.portfolio',
                    filter: '.filter'
                },
                load: {
                    filter: '.heading1, .heading2, .heading3, .heading4'
                }
            });
        }
    };
    // Run the show!
    filterList.init();
});


$(document).ready(function() {
    $(".fancybox").fancybox();

});





// -------------------------------------------------------------
// Back To Top
// -------------------------------------------------------------

(function() {
    $(window).scroll(function() {
        if ($(this).scrollTop() > 400) {
            $('.scroll-up').fadeIn();
        } else {
            $('.scroll-up').fadeOut();
        }
    });
}());



// -------------------------------------------------------------
// Back To Top
// -------------------------------------------------------------




// -------------------------------------------------------------
// Fancy Gallery Start
// -------------------------------------------------------------

$(document).ready(function() { $('.fb').fancybox(); });
// -------------------------------------------------------------
// Fancy Gallery End
// -------------------------------------------------------------


// -------------------------------------------------------------
// ScrollBar Start
// -------------------------------------------------------------

jQuery(document).ready(function() {
    jQuery('.scrollbar-inner').scrollbar();
});
// -------------------------------------------------------------
// ScrollBar End
// -------------------------------------------------------------

// -------------------------------------------------------------
// Loader Start
// -------------------------------------------------------------

window.onload = function() { $('.loader').fadeOut(); }


// -------------------------------------------------------------
// Loader End
// -------------------------------------------------------------
