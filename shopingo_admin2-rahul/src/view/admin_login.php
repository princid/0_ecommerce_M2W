<?php  include '../../includes/header.php'; ?>

<!-- NAVBAR -->
<?php include '../../includes/nav.php' ?>


<!--page loader-->
<div class="loader-wrapper">
  <div class="d-flex justify-content-center align-items-center position-absolute top-50 start-50 translate-middle">
    <div class="spinner-border text-dark" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
  </div>
</div>
<!--end loader-->

<!--start page content-->
<div class="page-content">
  <!--start product details-->
  <section class="section-padding">
    <div class="container">
      <div class="row mt-5">
        <div class="col-12 col-lg-6 col-xl-5 col-xxl-5 mx-auto">
          <div class="card rounded-0">
            <div class="card-body p-4">
              <h4 class="mb-0 fw-bold text-center">Admin Login</h4>
              <hr>
              <!-- FOR ERROR MESSAGE -->
              <div class="alert alert-danger" id="errorMessage" style="display: none;"></div>
              <div class="alert alert-success" id="successMessage" style="display: none;"></div>

              <form action="../controller/admin_login_handle.php" method="POST" id="admin_login_form">
                <div class="row g-4">
                  <div class="col-12">
                    <label for="admin_email" class="form-label">User Email</label>
                    <input type="email" name="admin_email" class="form-control rounded-0" id="useremail">
                    <span class="error-msg" id="emailError"></span>
                  </div>
                  <div class="col-12">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                      <input type="password" name="password" class="form-control rounded-0" id="password">
                      <span class="input-group-btn">
                        <button class="btn  toggle-password" type="button">
                          <i class="fa fa-eye" id="togglePasswordIcon"></i>
                        </button>
                      </span>
                    </div>
                    <span class="error-msg" id="passwordError"></span>
                  </div>

                  <div class="col-12">
                    <button type="submit" class="btn btn-dark rounded-0 btn-ecomm w-100">Login</button>
                  </div>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- js file -->
<script src="../../assets/js/admin _login.js"></script>

<!-- To Show Password -->
<script>
  $(document).ready(function () {
  $('.toggle-password').on('click', function () {
    var passwordField = $('#password');
    var passwordIcon = $('#togglePasswordIcon');

    if (passwordField.attr('type') === 'password') {
      passwordField.attr('type', 'text');
      passwordIcon.removeClass('fa-eye').addClass('fa-eye-slash');
    } else {
      passwordField.attr('type', 'password');
      passwordIcon.removeClass('fa-eye-slash').addClass('fa-eye');
    }
  });
});
</script>

<!-- footer file -->
<?php include '../../includes/footer_file.php'; ?>