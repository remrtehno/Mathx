

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


    //make all inputs values uppercase for tasks

    $('.task input').val(function () {
        return this.value.toUpperCase();
    })



});