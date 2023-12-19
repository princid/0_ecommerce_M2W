
document.getElementById('editDetailsForm').addEventListener('submit', function (e) {
    e.preventDefault();
    let valid = true;

    // Reset error messages
    document.querySelectorAll('.error-editDetailsForm').forEach(function (error) {
        error.textContent = '';
    });


    // Validate First Name
    const firstname = document.getElementById('firstname').value;
    if (!firstname) {
        document.getElementById('firstnameError').textContent = '*First Name is required';
        valid = false;
    }

    // Validate Last Name
    const lastname = document.getElementById('lastname').value;
    if (!lastname) {
        document.getElementById('lastnameError').textContent = '*Last Name is required';
        valid = false;
    }

    // Validate Mobile Number
    const mobile_number = document.getElementById('floatingInputNumber').value;
    if (!mobile_number || mobile_number.length !== 10) {
        document.getElementById('mobileNumberError').textContent = '*Enter a valid 10-digit mobile number';
        valid = false;
    }

    // Validate Gender
    const gender = document.querySelector('input[name="gender"]:checked');
    if (!gender) {
        document.getElementById('genderError').textContent = '*Please select a gender';
        valid = false;
    }


    // Validate Date of Birth
    const dob = document.getElementById('dob').value;
    if (!dob) {
        document.getElementById('dobError').textContent = '*Date of Birth is required';
        valid = false;
    }
    if (valid) {
        this.submit();
    }
});

