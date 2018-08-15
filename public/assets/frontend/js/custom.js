

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
	})

  /*--=========================
 available seats call
  ==========================--*/
  $('.first-ride .fas').click(function() {
      $(this).toggleClass('active-class');
  })


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
    }
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
    icons:{
      time:'fas fa-clock',
    }
  });
  
  $('#datetimepicker5').datetimepicker({
    icons:{
      time:'fas fa-clock',
    }

  });

   $('#datetimepicker6').datetimepicker({
    icons:{
      time:'fas fa-clock',
    }
   });


   // daily datepicker
  $('#dailypicker01').datetimepicker({
      inline: true,
      format: 'DD',
      viewMode: 'days'
  });


  // weekly datepicker
  var dateText = '05/26/2018',
    display = $('#week-start');
  display.text(dateText);
  $('#dailypicker02').weekpicker({
    currentText: dateText,
    onSelect: function(dateText, startDateText, startDate, endDate, inst) {
      display.text(startDateText);
    }
  });

//monthly datepicker

  $('#dailypicker03').datetimepicker({
      inline: true,
      format: 'MM',
      viewMode: 'months'
  });


// yearly datepicker
  $('#dailypicker04').datetimepicker({
      inline: true,
      format: 'MM/YYYY',
      viewMode: 'years'
  });
 



/*--=============
image upload js call
======================--*/
  // vars
  var result = document.querySelector('.result'),
      img_result = document.querySelector('.img-result'),
      img_w = document.querySelector('.img-w'),
      img_h = document.querySelector('.img-h'),
      options = document.querySelector('.options'),
      save = document.querySelector('.save'),
      cropped = document.querySelector('.cropped'),
      dwn = document.querySelector('.download'),
      upload = document.querySelector('#file-input'),
      cropper = '';


  // on change show image with crop options
    upload.addEventListener('change', function (e) {
      aspectRatio: 16 / 9;
      if (e.target.files.length) {
        // start file reader
        var reader = new FileReader();
        reader.onload = function (e) {
          if (e.target.result) {
            // create new image
            var img = document.createElement('img');
            img.id = 'image';
            img.src = e.target.result;
            // clean result before
            result.innerHTML = '';
            // append new image
            result.appendChild(img);
            // show save btn and options
            save.classList.remove('hide-x');
            options.classList.remove('hide-x');
            // init cropper
            cropper = new Cropper(img);

          }
        };
        reader.readAsDataURL(e.target.files[0]);
    }
  });

  // save on click
  save.addEventListener('click', function (e) {
    e.preventDefault();
    // get result to data uri
    var imgSrc = cropper.getCroppedCanvas({
      width: img_w.value // input value
    }).toDataURL();
    // remove hide class of img
    cropped.classList.remove('hide-x');
    img_result.classList.remove('hide-x');
    // show image cropped
    cropped.src = imgSrc;
    dwn.download = 'imagename.png';
    dwn.setAttribute('href', imgSrc);
  });
