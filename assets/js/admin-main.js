/* eslint-disable no-undef */
jQuery(document).ready(function ($) {

  $('#save_store_data_form').on('submit', function (e) {
    e.preventDefault();

    var formData = $(this).serialize();
    $("#overlay").fadeIn(300);
    $.ajax({
      type: 'POST',
      // eslint-disable-next-line no-undef
      url: ajax_object.ajaxurl, // WordPress ajax URL
      data: {
        action: 'save_store_data_ajax',
        nonce: ajax_object.nonces.action_1, // Action hook for your WordPress function
        formData
      },
      success(response) {
        if (response.data.status) {
          $("#overlay").fadeOut(300);
          swal({
            title: "Successfully added",
            icon: "success",
            timer: 2000,
            confirmButtonText: "OK"
          });
          $('#save_store_data_form').trigger('reset');
        } else {
          swal({
            title: "Something went wrong",
            icon: "error",
            timer: 2000,
            confirmButtonText: "OK"
          });
        }

      },
      error(xhr, status, error) {
        // Handle error
        swal({
          title: "Something went wrong",
          icon: "error",
          timer: 2000,
          confirmButtonText: "OK"
        });
      }
    });
  });

  jQuery('#manageStoreTable').DataTable({
    select: true
  });

  $('#edit_store_data_form').on('submit', function (e) {
    e.preventDefault();
    $("#overlay").fadeIn(300);
    var formData = $(this).serialize();

    $.ajax({
      type: 'POST',
      // eslint-disable-next-line no-undef
      url: ajax_object.ajaxurl, // WordPress ajax URL
      data: {
        action: 'edit_store_data_ajax',
        nonce: ajax_object.nonces.action_2, // Action hook for your WordPress function
        formData
      },
      success(response) {
        if (response.data.status) {
          $("#overlay").fadeOut(300);
          swal({
            title: "Updated successfully",
            icon: "success",
            buttons: "Go Back",
          })
            .then(() => {
              window.location.href = response.data.url;
            });

        } else {
          swal({
            title: "Something went wrong",
            type: "error",
            timer: 2000,
            confirmButtonText: "OK"
          });
        }

      },
      error(xhr, status, error) {
        // Handle error
        swal({
          title: "Something went wrong",
          type: "error",
          timer: 2000,
          confirmButtonText: "OK"
        });

      }
    });
  });

  $(".store_delete_button").on("click", function () {
    var dataId = $(this).data('id');
    $("#overlay").fadeIn(300);
    $.ajax({
      type: 'POST',
      // eslint-disable-next-line no-undef
      url: ajax_object.ajaxurl, // WordPress ajax URL
      data: {
        action: 'delete_store_data_ajax',
        nonce: ajax_object.nonces.action_3, // Action hook for your WordPress function
        dataId
      },
      success(response) {
        if (response.data.status) {
          $("#overlay").fadeOut(300);
          $(`.table_row_id_${dataId}`).remove();
          swal({
            title: "Deleted successfully",
            icon: "success",
            buttons: "OK",
          })

        } else {
          swal({
            title: "Something went wrong",
            type: "error",
            timer: 2000,
            confirmButtonText: "OK"
          });
        }

      },
      error(xhr, status, error) {
        // Handle error
        swal({
          title: "Something went wrong",
          type: "error",
          timer: 2000,
          confirmButtonText: "OK"
        });

      }
    });
  })


  $('#continent-select').on('change', function (e) {
    var continentVal = $(this).val();
    $("#overlay").fadeIn(300);
    $.ajax({
      type: 'POST',
      // eslint-disable-next-line no-undef
      url: ajax_object.ajaxurl, // WordPress ajax URL
      data: {
        action: 'get_continent_based_country',
        nonce: ajax_object.nonces.action_4, // Action hook for your WordPress function
        continentVal
      },
      success(response) {
        console.log(response);
        $("#overlay").fadeOut(300);
        $("#country-select").html(response.data.html)
      },
      error(xhr, status, error) {
        // Handle error
        console.log(error);
      }
    });

  });


});
