document.getElementById('user_login_form').addEventListener('submit', function (e) {
    e.preventDefault();
    let valid = true;
    // Reset error messages
    document.querySelectorAll('.error-msg').forEach(function (error) {
        error.textContent = '';
    });
    // Validate UserName
    const name = document.getElementById('username').value;
    if (!name) {
        document.getElementById('emailError').textContent = '*User Email is required';
        valid = false;
    }
    // Validate Password
    const password = document.getElementById('password').value;
    if (!password) {
        document.getElementById('passwordError').textContent = '*Please Enter Password';
        valid = false;
    }
    if (valid) {
        this.submit();
    }
});
