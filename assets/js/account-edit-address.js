// document.getElementById('edit_address').addEventListener('submit', function (e) {
//     e.preventDefault();
//     console.log('Form submission attempted');
//     let valid = true;
  
//     // Reset error messages
//     document.querySelectorAll('.error_edit_address').forEach(function (error) {
//       error.textContent = '';
//     });
  
//     // Validate Pin Code
//     const pinCode = document.getElementById('floatingPinCode2').value;
//     if (!pinCode) {
//       document.getElementById('pin_code_error2').textContent = '*Pin Code is required';
//       valid = false;
//     }
  
//     // Validate Address
//     const address = document.getElementById('floatingAddress2').value;
//     if (!address) {
//       document.getElementById('address_error2').textContent = '*Address is required';
//       valid = false;
//     }
  
//     // Validate Landmark
//     const landmark = document.getElementById('floatingLandmark2').value;
//     if (!landmark) {
//       document.getElementById('landmark_error2').textContent = '*Landmark is required';
//       valid = false;
//     }
  
//     // Validate Contact Number
//     const contact = document.getElementById('floatingContact2').value;
//     if (!contact) {
//       document.getElementById('contact_error2').textContent = '*Contact Number is required';
//       valid = false;
//     }
  
//     // Validate City/District
//     const city = document.getElementById('floatingCity2').value;
//     if (!city) {
//       document.getElementById('city_error2').textContent = '*City/District is required';
//       valid = false;
//     }
  
//     // Validate State
//     const state = document.getElementById('floatingState2').value;
//     if (!state) {
//       document.getElementById('state_error2').textContent = '*State is required';
//       valid = false;
//     }

      
//     if (valid) {
//       this.submit();
//     }
//   });
  