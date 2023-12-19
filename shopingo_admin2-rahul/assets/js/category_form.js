// Form validation
// document.getElementById('insert_products-form').addEventListener('submit', function (e) {
//     e.preventDefault();
//     let valid = true;

//     // Reset error messages
//     document.querySelectorAll('.error-msg').forEach(function (error) {
//         error.textContent = '';
//     });
//     document.getElementById('categoryError').textContent = '';

//     const category = document.getElementById('category').value;
//     if (!category.trim()) {
//         document.getElementById('categoryError').textContent = '*Please Enter Category';
//         valid = false;
//     }

//     if (valid) {
//         this.submit();
//     }

// });

// Form submission with Ajax
$(document).ready(function() {
    $('#insert_products-form').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: "POST",  
            url: "../controller/category_handler.php",
            data: formData,
            success: function(response) {
                if (response === 'success') {
                    $('#insert_products-form')[0].reset();
                    $('#errorMessage').hide();
                    $('#successMessage').html('Category inserted successfully').show();
                } else {
                    $('#errorMessage').html(response).show();
                    $('#successMessage').hide();
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr, status, error);
                $('#errorMessage').html('An error occurred. Please try again later.').show();
                $('#successMessage').hide();
            }
        });
    });
});




