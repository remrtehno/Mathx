

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}


$(function () {
    $("#date-picker").datepicker();
    $("#date-picker-2").datepicker();

    $('#sidebarToggle, #sidebarToggleTop').click( (e) => {

        if(localStorage.getItem('open-sidebar') === 'true') {

            localStorage.setItem('open-sidebar', false);
        } else {

            localStorage.setItem('open-sidebar', true);
        }
    });

    if(localStorage.getItem('open-sidebar') === 'true') {
        $('#accordionSidebar').addClass('toggled');
    } else {
        $('#accordionSidebar').removeClass('toggled');
    }
});





$( document ).ready(function() {

    //timer for tests
    function startTimer(duration, display) {
        var timer = duration, minutes, seconds;
        setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;

            if (--timer < 0) {
                timer = duration;
            }
        }, 1000);
    }

    //60 * 5
    let getSeconds = document.querySelector('#time');
    if(getSeconds) {
        if (getSeconds) getSeconds = Number(getSeconds.getAttribute('data-time'));
        let display = document.querySelector('#time');
        startTimer(getSeconds, display);
    }
    //end tests timer





    if(window.MathJax) {
        MathJax.Hub.Config({
            extensions: ["tex2jax.js"],
            jax: ["input/TeX", "output/HTML-CSS"],
            tex2jax: {
                inlineMath: [
                    ["$", "$"],
                    ["\\(", "\\)"]
                ]
            }
        });
    }


    $('.go-back').click(function () {
        window.history.back();
    });








    //=======
    // $('li.nav-toggle > button').click(function(e){
    //     //Set cookie
    //     if($.cookie('minibar')==null||$.cookie('minibar')==0) $.cookie('minibar',1);
    //     else {
    //         $.cookie('minibar',0);
    //     }
    //     e.preventDefault();
    //     changeSidebarState();
    // });
    // //Load sidebar state
    // $(function(){
    //     if($.cookie('minibar')==1) {
    //         changeSidebarStateNoAnimate();
    //     }
    // });
    // function changeSidebarState(){
    //     $('.hidden-minibar').toggleClass("hide");
    //     $('.site-holder').toggleClass("mini-sidebar");
    //
    //     if($('body').css('direction')!='ltr')
    //         if($('.toggle-right').hasClass('fa-angle-double-right')){ $('.toggle-right').removeClass('fa-angle-double-right').addClass('fa-angle-double-left'); }
    //         else { $('.toggle-right').removeClass('fa-angle-double-left').addClass('fa-angle-double-right'); }
    //     else{
    //         if($('.toggle-left').hasClass('fa-angle-double-left')){ $('.toggle-left').removeClass('fa-angle-double-left').addClass('fa-angle-double-right'); }
    //         else { $('.toggle-left').removeClass('fa-angle-double-right').addClass('fa-angle-double-left'); }
    //     }
    //
    //     if($('.site-holder').hasClass('mini-sidebar'))
    //     {
    //         $('.sidebar-holder').tooltip({
    //             selector: "a",
    //             container: "body",
    //             placement: "right"
    //         });
    //         $('li.submenu ul').tooltip('destroy');
    //     }
    //     else
    //     {
    //         $('.sidebar-holder').tooltip('destroy');
    //     }
    // }
    // function changeSidebarStateNoAnimate(){
    //     $('.toggle-left').removeClass('fa-angle-double-left').addClass('fa-angle-double-right');
    //     if($('.site-holder').hasClass('mini-sidebar'))
    //     {
    //         $('.sidebar-holder').tooltip({
    //             selector: "a",
    //             container: "body",
    //             placement: "right"
    //         });
    //         $('li.submenu ul').tooltip('destroy');
    //     }
    //     else
    //     {
    //         $('.sidebar-holder').tooltip('destroy');
    //     }
    // }
    // //
    // if($('.site-holder').hasClass('mini-sidebar'))
    // {
    //     $('.sidebar-holder').tooltip({
    //         selector: "a",
    //         container: "body",
    //         placement: "right"
    //     });
    //     $('li.submenu').tooltip('destroy');
    // }
    // else
    // {
    //     $('.sidebar-holder').tooltip('destroy');
    // }
    // $('.show-info').click(function(){
    //     $('.page-information').toggleClass('hidden');
    // });
    //
    // $('.site-holder.mini-sidebar .content').click(function () {
    //     $('.site-holder.mini-sidebar li.submenu ul').hide();
    //     $('.site-holder.mini-sidebar li.submenu').removeClass('active');
    //
    // });

});
