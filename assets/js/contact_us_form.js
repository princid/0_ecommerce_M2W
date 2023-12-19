document.getElementById('contact_us_form').addEventListener('submit', function (e) {
    e.preventDefault();
    let valid = true;

    // Reset error messages
    document.querySelectorAll('.error-contact_us_form').forEach(function (error) {
        error.textContent = '';
    });

    // Validate Name
    const name = document.getElementById('name').value;
    if (!name) {
        document.getElementById('nameError').textContent = '*Name is required';
        valid = false;
    }

    // Validate Mobile
    const mobile = document.getElementById('number').value;
    if (!mobile || mobile.length < 10 || mobile.length > 10) {
        document.getElementById('numberError').textContent = '*Enter a valid mobile number';
        valid = false;
    }

    // Validate Email
    const email = document.getElementById('email').value;
    if (!email) {
        document.getElementById('emailError').textContent = '*Email is required';
        valid = false;
    }

    // Validate Password
    const message = document.getElementById('message').value;
    if (!message || message.length < 16) {
        document.getElementById('messageError').textContent = '*Message should be greater than 16 characters';
        valid = false;
    }

    if (valid) {
        this.submit();
    }
});