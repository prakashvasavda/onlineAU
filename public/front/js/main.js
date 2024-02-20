(function ($)
  { "use strict"

  /*sticky And Scroll UP*/
  $(window).on('scroll', function () {
      var scroll = $(window).scrollTop();
      if (scroll < 400) {
        $(".header-sticky").removeClass("sticky-bar");
        $('#back-top').fadeOut(500);
      } else {
        $(".header-sticky").addClass("sticky-bar");
        $('#back-top').fadeIn(500);
      }
    });

  /*Scroll Up*/
  $('#back-top a').on("click", function () {
    $('body,html').animate({
      scrollTop: 0
    }, 800);
    return false;
  });

  /*Slider*/
  $('.candidate-slider').slick({
      dots: false,
      infinite: true,
      autoplay: true,
      speed: 600,
      arrows: true,
      prevArrow: '<button type="button" class="slick-prev"><i class="fa-solid fa-chevron-left"></i></button>',
      nextArrow: '<button type="button" class="slick-next"><i class="fa-solid fa-chevron-right"></i></button>',
      slidesToShow: 4,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
          }
        },
        {
          breakpoint: 576,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        },
      ]
    });

  /*WOW active*/
  new WOW().init();

  /*bootstrap-tooltip-start*/
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })
  /*bootstrap-tooltip-end*/

  /*nice-select*/
  $('select').niceSelect();

  /*stellarnav - mobile menu*/
  $('.stellarnav').stellarNav({
    position: 'right',
    breakpoint: 991,
    closeBtn: true
  });

  $('input[name="daterange[]"]').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });
  
  $('input[name="datetimes"]').daterangepicker({
    timePicker: true,
    startDate: moment().startOf('hour'),
    endDate: moment().startOf('hour').add(32, 'hour'),
    locale: {
      format: 'M/DD hh:mm A'
    }
  });

  var checkboxes = $("input[type='checkbox']#special-needs"),
  actions = $("#special-needs-section");
  checkboxes.click(function() {
     actions.attr("hidden", !checkboxes.is(":checked"));
  });

  var i = 1;
  var key = 0;
  var length;
  $("#add").click(function () {    
      i++;
      key++
      var newInput = '<div class="row mt-4" id="row' + i + '"><label class="fst-italic ' + i + '">List your previous childcare work experience with contactable references.</label><div class="icon-option all-in-one"><a href="javaScript:;" id="' + i + '" class="btn btn-danger delete-btn"><i class="fa-solid fa-trash-can"></i></a></div><div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><div class="form-input"><label for="daterange">Date range <span class="text-danger">*</span></label><input type="text" id="daterange' + key + '" name="daterange[]" value="" class="form-field" placeholder=""></div></div><div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><div class="form-input"><label for="heading">Heading <span class="text-danger">*</span></label><input type="text" id="heading_' + key + '" name="heading[]" class="form-field heading" placeholder=""></div></div><div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><div class="form-input"><label for="description">Description <span class="text-danger">*</span></label><input type="text" id="description' + key + '" name="description[]" class="form-field" placeholder=""></div></div><div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><div class="form-input"><label for="reference_name">Reference Name <span class="text-danger">*</span></label><input type="text" id="reference' + key + '" name="reference[]" class="form-field" placeholder=""></div></div><div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><div class="form-input"><label for="tel_number">Tel Number <span class="text-danger">*</span></label><input type="text" id="tel_number' + key + '" name="tel_number[]" class="form-field" placeholder=""></div></div></div>';
      $('#dynamic_field').append(newInput);
      $('#dynamic_field').find('input[name="daterange[]"]').daterangepicker();
  });
  $(document).on('click', '.delete-btn', function () {      
      var button_id = $(this).attr("id");
      $('#row' + button_id + '').remove();
  });

})(jQuery);

(function ($) {
  $.fn.searchBox = function (ev) {

      var $searchEl = $('.search-elem');
      var $placeHolder = $('.placeholder');
      var $sField = $('#search-field');

      if (ev === "open") {
          $searchEl.addClass('search-open')
      };

      if (ev === 'close') {
          $searchEl.removeClass('search-open'),
              $placeHolder.removeClass('move-up'),
              $sField.val('');
      };

      var moveText = function () {
          $placeHolder.addClass('move-up');
      }

      $sField.focus(moveText);
      $placeHolder.on('click', moveText);

      $('.submit').prop('disabled', true);
      $('#search-field').keyup(function () {
          if ($(this).val() != '') {
              $('.submit').prop('disabled', false);
          }
      });
  }
}(jQuery));

$('.search-btn').on('click', function (e) {
    $(this).searchBox('open');
    e.preventDefault();
});

$('.close').on('click', function () {
    $(this).searchBox('close');
});

function initAutocomplete() {
    var inputs = document.querySelectorAll('.address-input');

    inputs.forEach(function(input) {
        var autocomplete = new google.maps.places.Autocomplete(input);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            console.log(place); // This will contain information about the selected place.
        });
    });
}

google.maps.event.addDomListener(window, 'load', initAutocomplete);

/* add dynamic row to candidate calender*/
function addCalendarRow(rowId){
  $('#'+rowId+'-row').after(`
    <tr>
      <td><input type="checkbox"></td>
      <td class="text-capitalize">`+rowId+`</td>
      <td><input type="text" onfocus="(this.type='time')" onblur="(this.type='text')" name="`+rowId+`[start_time][]" value="" placeholder="Add Time"></td>
      <td>to</td>
      <td><input type="text" onfocus="(this.type='time')" onblur="(this.type='text')" name="`+rowId+`[end_time][]" value="" placeholder="Add Time"></td>
      <td onclick="removeCalendarRow(event)">
        <a href="javaScript:;" class="btn add-btn icon">
          <i class="fa-solid fa-trash"></i>
        </a>
      </td>
    </tr>
  `);
}

/* remove calender row */
function removeCalendarRow(event){
  event.target.closest('tr').remove();
}