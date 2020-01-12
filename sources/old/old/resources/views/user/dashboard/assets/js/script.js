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
    
});