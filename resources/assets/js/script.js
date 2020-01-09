


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
});