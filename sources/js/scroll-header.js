// window.onscroll = function() {
//     scrollFunction();
// };

// function scrollFunction() {
//     var header = document.getElementById("scroll_header");
//     if(document.body.scrollHeight > 100 || document.documentElement.scrollHeight > 100) {
//         header.removeAttribute("hidden");
//         header.classList.add("scrolled");
//     }else{
//         header.setAttribute("hidden");
//         header.classList.remove("scrolled");
//     }
// }

// document.addEventListener('DOMContentLoaded', function() {
//     const header = document.getElementById('scroll_header');
//     let lastScrollTop = 0; // Stores the previous scroll position

//     window.addEventListener('scroll', function() {
//         let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

//         if (currentScroll > lastScrollTop && currentScroll > header.offsetHeight) {
//             // Scrolling down and past the header's height
//             header.setAttribute('hidden', '');
//         } else {
//             // Scrolling up or at the very top
//             header.removeAttribute('hidden');
//         }
//         lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // For Mobile or negative scrolling
//     });
// });

$('#scroll_header').hide();

$(function() {
    function fadeFunction() {
        $(window).scroll(function() {
        //console.log('scrolling ', $(window).scrollTop(), $(document).height());
        if ($(window).scrollTop() >= 120 && $(window).scrollTop() <= ($(document).height() - 120)) {
            // $('#scroll_header').fadeIn(1000);
            $('#scroll_header').show();
        } else {
            // $('#scroll_header').fadeOut(1000);
            $('#scroll_header').hide();
        }
        });
    }
fadeFunction();

$(window).resize(function() {
    if ($(window).width() < 768) {
        fadeFunction();
    }else{
        // SKIP
    }
});

});
