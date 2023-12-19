// Form validation
document.getElementById('update_order_status').addEventListener('submit', function (e) {
    e.preventDefault();
    let valid = true;

    // Reset error messages
    document.querySelectorAll('.error-msg').forEach(function (error) {
        error.textContent = '';
    });
    document.getElementById('statusError').textContent = '';

    const status = document.getElementById('order_status').value;
    if (!status) {
        document.getElementById('statusError').textContent = '*Please Select Order Status';
        valid = false;
    }
    if (valid) {
        this.submit();
    }

});
