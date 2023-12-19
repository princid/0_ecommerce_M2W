document.getElementById('signupForm').addEventListener('submit', function (e) {
    e.preventDefault();
    let valid = true;

    // Reset error messages
    document.querySelectorAll('.error-signupForm').forEach(function (error) {
        error.textContent = '';
    });

    // Validate Name
    // const name = document.getElementById('username').value;
    // if (!name) {
    //     document.getElementById('nameError').textContent = '*Name is required';
    //     valid = false;
    // }

    // Validate Mobile
    const mobile = document.getElementById('mobile_number').value;
    if (!mobile || mobile.length < 10 || mobile.length > 10) {
        document.getElementById('mobileError').textContent = '*Enter a valid mobile number';
        valid = false;
    }

    // Validate Email
    const email = document.getElementById('useremail').value;
    if (!email) {
        document.getElementById('emailError').textContent = '*Email is required';
        valid = false;
    }

    // Validate Password
    const password = document.getElementById('password').value;
    if (!password || password.length < 6) {
        document.getElementById('passwordError').textContent = '*Password should be greater than 6';
        valid = false;
    }

    // Validate Username
    const username = document.getElementById('username').value;
    const usernameError = document.getElementById('usernameError');
    if (!username) {
        document.getElementById('usernameError').textContent = '*Username is required';
        valid = false;
    } else if (!/^[a-zA-Z0-9_]+$/.test(username)) {
        document.getElementById('usernameError').textContent = '*Username should contain only letters, numbers, and underscores';
        valid = false;
    } else if (username.length < 3 || username.length > 20) {
        document.getElementById('usernameError').textContent = '*Username should be between 3 and 20 characters';
        valid = false;
    }

    if (valid) {
        this.submit();
    }
});
