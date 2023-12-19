document.getElementById('address_form').addEventListener('submit', function (e) {
    e.preventDefault();
    let valid = true;

    // Reset error messages
    document.querySelectorAll('.error_address_form').forEach(function (error) {
      error.textContent = '';
    });

    // Validate Pin Code
    const pinCode = document.getElementById('floatingPinCode').value;
    if (!pinCode) {
      document.getElementById('pin_code_error').textContent = '*Pin Code is required';
      valid = false;
    }

    // Validate Address
    const address = document.getElementById('address').value;
    if (!address) {
      document.getElementById('address_error').textContent = '*Address is required';
      valid = false;
    }

    // Validate Landmark
    const landmark = document.getElementById('landmark').value;
    if (!landmark) {
      document.getElementById('landmark_error').textContent = '*Landmark is required';
      valid = false;
    }

    // Validate City/District
    const cityDistrict = document.getElementById('city_district').value;
    if (!cityDistrict) {
      document.getElementById('city_error').textContent = '*City/District is required';
      valid = false;
    }

    // Validate State
    const state = document.getElementById('state').value;
    if (!state) {
      document.getElementById('state_error').textContent = '*State is required';
      valid = false;
    }

    if (valid) {
      this.submit();
    }
  });