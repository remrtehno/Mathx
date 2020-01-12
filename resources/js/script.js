

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
});



$( document ).ready(function() {



    $('#sidebarToggle').click( (e) => {
        if(localStorage.getItem('open-sidebar') === 'true') {

            localStorage.setItem('open-sidebar', false);
        } else {

            localStorage.setItem('open-sidebar', false);
        }
    });



    if(localStorage.getItem('open-sidebar') === 'true') {
        $('#accordionSidebar').addClass('toggled');
    } else {
        $('#accordionSidebar').removeClass('toggled');
    }


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

});