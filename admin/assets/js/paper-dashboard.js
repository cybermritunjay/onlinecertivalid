/*!

 =========================================================
 * Paper Dashboard - v1.2.0
 =========================================================

 * Product Page: http://www.creative-tim.com/product/paper-dashboard
 * Copyright 2018 Creative Tim (http://www.creative-tim.com)
 * Licensed under MIT (https://github.com/creativetimofficial/paper-dashboard/blob/master/LICENSE.md)

 =========================================================

 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

 */


var fixedTop = false;
var transparent = true;
var navbar_initialized = false;
var mobile_menu_initialized = false;

$(document).ready(function(){
    window_width = $(window).width();

    // Init navigation toggle for small screens
    if(window_width <= 991){
        pd.initRightMenu();
    }

    //  Activate the tooltips
    $('[rel="tooltip"]').tooltip();

});
var isAdvancedUpload = function() {
  var div = document.createElement('div');
  return (('draggable' in div) || ('ondragstart' in div && 'ondrop' in div)) && 'FormData' in window && 'FileReader' in window;
}();
var $form = $('.box');
if (isAdvancedUpload) {

  var droppedFiles = false;

  $form.on('drag dragstart dragend dragover dragenter dragleave drop', function(e) {
    e.preventDefault();
    e.stopPropagation();
  })
  .on('dragover dragenter', function() {
    $form.addClass('is-dragover');
  })
  .on('dragleave dragend drop', function() {
    $form.removeClass('is-dragover');
  })
  .on('drop', function(e) {
    droppedFiles = e.originalEvent.dataTransfer.files;
  });

}
$(document).on('click', '.navbar-toggle', function(){
  $toggle = $(this);
  if(pd.misc.navbar_menu_visible == 1) {
    $('html').removeClass('nav-open');
    pd.misc.navbar_menu_visible = 0;
    $('#bodyClick').remove();
    setTimeout(function(){
      $toggle.removeClass('toggled');
    }, 400);
  } else {
    setTimeout(function(){
      $toggle.addClass('toggled');
    }, 430);

    div = '<div id="bodyClick"></div>';
    $(div).appendTo("body").click(function() {
      $('html').removeClass('nav-open');
      pd.misc.navbar_menu_visible = 0;
      $('#bodyClick').remove();
      setTimeout(function(){
        $toggle.removeClass('toggled');
      }, 400);
    });

    $('html').addClass('nav-open');
    pd.misc.navbar_menu_visible = 1;
  }
});

// activate collapse right menu when the windows is resized
$(window).resize(function(){
    if($(window).width() <= 991){
        pd.initRightMenu();
    }
});
//-------drag and drop-----
var drop = $("#bulk_upload");
drop.on('dragenter', function (e) {
  $(".dashed-box").css({
    "border": "4px dashed #09f",
    "background": "rgba(0, 153, 255, .05)"
  });
  $(".cont").css({
    "color": "#09f"
  });
}).on('dragleave dragend mouseout drop', function (e) {
  $(".dashed-box").css({
    "border": "3px dashed #DADFE3",
    "background": "transparent"
  });
  $(".cont").css({
    "color": "#8E99A5"
  });

});

var data;

 
  function handleFileSelect(evt) {
    console.log("event listned");
    document.getElementById( 'data_table' ).innerHTML= " ";
    if(document.getElementById( 'certinumber').value != "" && document.getElementById( 'certi_series') != ""){
    var file = evt.target.files[0];
    console.log(file);
   $('#add_bulk').removeAttr( "disabled" )
    Papa.parse(file, {
      header: true,
      dynamicTyping: true,
      complete: function(results) {
        var series = document.getElementById( 'certi_series').value;
        var start = document.getElementById( 'certinumber').value;

        data = results;
        console.log(data);
        var  table = "<thead><tr><th scope='col'>Certificate Number</th><th scope='col'>Name</th><th scope='col'>Enrollment No.</th><th scope='col'>Position</th></tr></thead><tbody>";
        for (var i=0; i < data.data.length-1;i++) {
        var  tr = "<tr><td><input name='certino"+i+"' class='form-control' value='"+series+"-"+"0"+start+"'></td>";

        tr += "<td><input name='name"+i+"' class='form-control' value='"+data.data[i]['Name'] +"'></td><td><input name='enrollment"+i+"' class='form-control' value='"+data.data[i]['Enrollment No.']+"' ></td><td><input name='position"+i+"' class='form-control' value='"+data.data[i]['Position']+"' ></td>"
          
          tr += "</tr>";
          table += tr;
          start ++;
        }
        table+="</tbody>"
        document.getElementById( 'data_table' ).innerHTML= table;
        document.getElementById( 'enrollmodel2' ).style.display = "none";
           document.getElementById( 'enrollmodel3').style.display = "block";
      }
    });
    }else{
      document.getElementById( 'data_table' ).innerHTML= "Kindly fill Series of Certificate and Number to Start";
    }
  }
 
  
    document.getElementById("bulk_upload").addEventListener("change", handleFileSelect);
        document.getElementById("reupload_bulk").addEventListener("click",function(event){
          event.preventDefault();
          document.getElementById( 'data_table' ).innerHTML= "";
           document.getElementById( 'certi_series').value = "";
          document.getElementById( 'certinumber').value = "";
          file = "";
          document.getElementById( 'enrollmodel3' ).style.display = "none";
           document.getElementById( 'enrollmodel2').style.display = "block";
        });
        document.getElementById("bulk_proceed").addEventListener("click",function(event){
          event.preventDefault();
          document.getElementById( 'enrollmodel1' ).style.display = "none";
           document.getElementById( 'enrollmodel2').style.display = "block";
        });
        
         document.getElementById("final_bulk").addEventListener("click",function(event){
          event.preventDefault();
          $.ajax({
               type: 'POST',
               url: 'process_requests/bulkadd.php',
               data: $('#bulk_form').serialize(),   // I WANT TO ADD EXTRA DATA + SERIALIZE DATA
               success: function(data){
                console.log(data);
                  if (data=="all ok") {
                    document.getElementById("enrollmodel3").innerHTML = "<h3 class='display-3'>Congratulations You Have Sucessfully Added Bulk Partidepents</h1><button type='button' class='btn btn-dark' data-dismiss='modal'>ThankYou</button>";
                  }else{
                    alert("Data Not Submitted. Something Went Wrong");
                  }
               }
});
        });

          document.getElementById("add_single_data").addEventListener("click",function(event){
          event.preventDefault();
          $.ajax({
               type: 'POST',
               url: 'process_requests/singlecertiadd.php',
               data: $('#single_enroll_form').serialize(),   // I WANT TO ADD EXTRA DATA + SERIALIZE DATA
               success: function(data){
                console.log(data);
                  if (data=="all ok") {
                    document.getElementById("single_enroll_form").reset();
                    document.getElementById("single_enroll_form").innerHTML += "<div class='alert alert-success alert-dismissible'><a class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Success!</strong> This alert box could indicate a successful or positive action.</div>";
                  }else{
                    alert("Data Not Submitted. Something Went Wrong");
                  }
               }
});
        });
             
        

pd = {
    misc:{
        navbar_menu_visible: 0
    },
    checkScrollForTransparentNavbar: debounce(function() {
        if($(document).scrollTop() > 381 ) {
            if(transparent) {
                transparent = false;
                $('.navbar-color-on-scroll').removeClass('navbar-transparent');
                $('.navbar-title').removeClass('hidden');
            }
        } else {
            if( !transparent ) {
                transparent = true;
                $('.navbar-color-on-scroll').addClass('navbar-transparent');
                $('.navbar-title').addClass('hidden');
            }
        }
    }),
    initRightMenu: debounce(function() {
        var $sidebar_wrapper = $('.sidebar-wrapper');
        var $sidebar = $('.sidebar');

        if (!mobile_menu_initialized) {
            var $navbar = $('nav').find('.navbar-collapse').children('.navbar-nav');

            mobile_menu_content = '';

            nav_content = $navbar.html();

            nav_content = '<ul class="nav nav-mobile-menu">' + nav_content + '</ul>';

            $sidebar_nav = $sidebar_wrapper.find(' > .nav');

            // insert the navbar form before the sidebar list
            $sidebar.addClass('off-canvas-sidebar');
            $nav_content = $(nav_content);
            $nav_content.insertBefore($sidebar_nav);

            $(".sidebar-wrapper .dropdown .dropdown-menu > li > a").click(function(event) {
                event.stopPropagation();

            });

            // simulate resize so all the charts/maps will be redrawn
            window.dispatchEvent(new Event('resize'));

            mobile_menu_initialized = true;
        } else {
            if ($(window).width() > 991) {
                // reset all the additions that we made for the sidebar wrapper only if the screen is bigger than 991px
                $sidebar_wrapper.find('.nav-mobile-menu').remove();
                $sidebar.removeClass('off-canvas-sidebar');

                mobile_menu_initialized = false;
            }
        }
    }, 200)
}


// Returns a function, that, as long as it continues to be invoked, will not
// be triggered. The function will be called after it stops being called for
// N milliseconds. If `immediate` is passed, trigger the function on the
// leading edge, instead of the trailing.

function debounce(func, wait, immediate) {
	var timeout;
	return function() {
		var context = this, args = arguments;
		clearTimeout(timeout);
		timeout = setTimeout(function() {
			timeout = null;
			if (!immediate) func.apply(context, args);
		}, wait);
		if (immediate && !timeout) func.apply(context, args);
	};
};
