jQuery(document).ready(function ($) {

  $("#searchInput").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    $("#searchTableContent tr").filter(function () {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });


  $('#getContinent').on('change', function (e) {
    var continentVal = $(this).val();
    $("#overlay").fadeIn(300);
    $.ajax({
      type: 'POST',
      // eslint-disable-next-line no-undef
      url: ajax_obj.ajaxurl, // WordPress ajax URL
      data: {
        action: 'get_continent_based_country', 
        // eslint-disable-next-line no-undef
        nonce: ajax_obj.nonces.action_1,
        // Action hook for your WordPress function
        continentVal
      },
      success(response) {
        $("#overlay").fadeOut(300);
        $("#getCountry").html(response.data.html)
        $("#searchTableContent").html(response.data.continentHtml)
      },
      error(xhr, status, error) {
        // Handle error
        console.log(error);
      }
    });

  });

  $('#getCountry').on('change', function (e) {
    var continentVal = $("#getContinent").val();
    var countryVal = $(this).val();
    $("#overlay").fadeIn(300);
    $.ajax({
      type: 'POST',
      // eslint-disable-next-line no-undef
      url: ajax_obj.ajaxurl, // WordPress ajax URL
      data: {
        action: 'get_data_based_country_continent',
        // eslint-disable-next-line no-undef
        nonce: ajax_obj.nonces.action_2, // Action hook for your WordPress function
        countryVal,
        continentVal
      },
      success(response) {
        $("#searchTableContent").html(response.data.html);
        $("#overlay").fadeOut(300);
      },
      error(xhr, status, error) {
        // Handle error
        console.log(error);
      }
    });

  });

  $(".repeat_cng").on("click", function () {

    $(".post_input_content").toggleClass("active");
    $(".select_content").toggleClass("active");
  });


  $('#postcode_search_button').on('click', function (e) {
    var postcode_search_field = $("#postcode_search_field").val();
    $("#overlay").fadeIn(300);
    $.ajax({
      type: 'POST',
      // eslint-disable-next-line no-undef
      url: ajax_obj.ajaxurl, // WordPress ajax URL
      data: {
        action: 'get_data_based_post_code',
        // eslint-disable-next-line no-undef
        nonce: ajax_obj.nonces.action_3, // Action hook for your WordPress function
        postcode_search_field,
      },
      success(response) {
        
        $("#searchTableContent").html(response.data.html);
        $("#overlay").fadeOut(300);
      },
      error(xhr, status, error) {
        // Handle error
        console.log(error);
      }
    });

  });

 
  

});