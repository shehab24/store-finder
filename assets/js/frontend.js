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
        action: 'get_continent_based_country', // Action hook for your WordPress function
        continentVal
      },
      success(response) {
        $("#overlay").fadeOut(300);
        $("#getCountry").html(response.data.html)
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
        action: 'get_data_based_country_continent', // Action hook for your WordPress function
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

});