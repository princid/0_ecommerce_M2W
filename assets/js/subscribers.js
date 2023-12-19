// Form submission with Ajax
$(document).ready(function () {
    $('#subscribers_form').submit(function (e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "../controller/subscriber_handle.php",
            data: formData,
            success: function (response) {
                if (response === 'success') {
                    // success message
                    $('#subscriberError').hide();
                    $('#successMessage').html('Subscriber added successfully.').show();

                    // Reset the form
                    $('#subscribers_form').reset();
                } else {
                    // ERROR MESSAGE
                    $('#successMessage').hide();
                    $('#subscriberError').html(response).show();
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr, status, error);
                $('#successMessage').hide();
                $('#subscriberError').html('An error occurred. Please try again later.').show();
            }
        });
    });
});