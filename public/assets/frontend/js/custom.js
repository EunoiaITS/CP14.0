

(function($) {
	"use strict";


  /*--==================
  Radio button callback
  ======================--*/
  //$('.check-input').on('click', function() {
  //   $('.green-color').addClass('add-green-color');
  //   $('.red-color').removeClass('add-radio-color');
  //});
  //
  // $('.check-input-2').on('click', function() {
  //   $('.red-color').addClass('add-radio-color');
  //    $('.green-color').removeClass('add-green-color');
  //});

	/*--========================
	slidebar call js
	========================--*/
	$('#toggle-class').on('click', function(e) {
		e.preventDefault();
		$('body').toggleClass('nav-open');
	});

	$('#toggle-remove').on('click', function(e) {
		e.preventDefault();
		$('body').removeClass('nav-open');
    return $(".navi-trigger").removeClass("cross");
	});

  // menu icon toggole

  $(".get-humber-icon").click(function() {
    return $(".navi-trigger").toggleClass("cross");
  });


	 /*=======================================================
    // Vertical Center Welcome
    ======================================================*/
    "use strict";

    /*--========================
    slidebar call js
    ========================--*/
    $('#toggle-class').on('click', function(e) {
        e.preventDefault();
        $('body').toggleClass('nav-open');
    });

    $('#toggle-remove').on('click', function(e) {
        e.preventDefault();
        $('body').removeClass('nav-open');
        return $(".navi-trigger").removeClass("cross");
    });

    // menu icon toggle

    $(".get-humber-icon").click(function() {
        return $(".navi-trigger").toggleClass("cross");
    });


    /*=======================================================
   // Vertical Center Welcome
   ======================================================*/
    setInterval(function () {
        var widnowHeight = $(window).height();
        var introHeight = $(".get-landing-text, .not-found").height();
        var paddingTop = widnowHeight - introHeight;
        $(".get-landing-text, .not-found").css({
            'padding-top': Math.round(paddingTop / 2) + 'px',
            'padding-bottom': Math.round(paddingTop / 2) + 'px'
        });
    }, 10);

    /*--=================
    bootstrap select
    =================--*/
    $('.get-select-picker').selectpicker({});

    /*--==================
    click notification bar
    ======================--*/
    $(".notification-badge").click(function() {
        $(".get-notification-popupbar").toggleClass("add-popupbar");
    });

    $(".edit-badge-area").click(function() {
        $(".get-edit-profile").toggleClass("add-profile");
    });


    /*--=========================
    ridemate ratings call
    ==========================--*/
    $('.click-performance .fas').click(function() {
        $(this).toggleClass('active-color');
    });

    /*--=========================
   available seats call
    ==========================--*/
    $('.first-ride .fas').click(function() {
        $(this).toggleClass('active-class');
    });

    // clander js call

    $("#my-calendar").zabuto_calendar({
        language: "en",
        today:true
    });

    /*===================
    image add class
    ===================*/
    $(".image-hover").click(function(){
        $(".image-upload-hide").addClass("hide-image");
    });

})(window.jQuery);



/*=======================================
Datepicker init
=========================================*/

$('.datepicker-f').datetimepicker({
    format: "YYYY-MM-DD",
    icons: {
        up: 'fa fa-angle-up',
        down: 'fa fa-angle-down',
        previous: 'fa fa-angle-left',
        next: 'fa fa-angle-right',
    },
    minDate: moment()
});
$('#datetimepicker12').datepicker({
    todayHighlight: true,
    inline: true,
    sideBySide: true,
});
/*=======================================
Timepicker init
=========================================*/

$('.timepicker-hh').datetimepicker({
    format: "HH",
    icons: {
        up: 'fa fa-angle-up',
        down: 'fa fa-angle-down',
        previous: 'fa fa-angle-left',
        next: 'fa fa-angle-right',
    }
  });

$('.timepicker-mm').datetimepicker({
    format: "mm",
    icons: {
        up: 'fa fa-angle-up',
        down: 'fa fa-angle-down',
        previous: 'fa fa-angle-left',
        next: 'fa fa-angle-right',
    }
});

$('#datetimepicker4').datetimepicker({
    format: "YYYY-MM-DD HH:mm",
    icons:{
        time:'fas fa-clock',
    }
});

$('#datetimepicker5').datetimepicker({
    format: "YYYY-MM-DD HH:mm",
    icons:{
        time:'fas fa-clock',
    }

});

$('#datetimepicker6').datetimepicker({
    format: "YYYY-MM-DD HH:mm",
    icons:{
        time:'fas fa-clock',
    }
});