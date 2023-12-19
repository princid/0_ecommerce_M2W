// Login with ajax
// $(document).ready(function () {
//     $('#admin_login_form').submit(function (e) {
//         e.preventDefault();
//         var formData = $(this).serialize();
//         $.ajax({
//             type: "POST",
//             url: "../controller/admin_login_handle.php",
//             data: formData,
//             success: function (response) {
//                 if (response === 'success') {
//                     $('#admin_login_form')[0].reset();
//                     $('#errorMessage').hide();
//                     window.location.href = 'http://localhost/shopingo_admin/src/view/insert_category.php';
//                 } else {
//                     $('#successMessage').html(response).show();
//                 }
//             },
//             error: function (xhr, status, error) {
//                 console.error(xhr, status, error);
//                 $('#errorMessage').html('An error occurred. Please try again later.').show();
//             }
//         });
//     });
// });
