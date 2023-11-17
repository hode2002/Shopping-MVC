<?php include_once VIEWS_DIR . "/partials/header/index.php" ?>

<style>
  .btn-login:hover {
    background-color: #000 !important;
    color: #fff !important;
  }
</style>

<main style="
        background-image: url('https://img.freepik.com/free-photo/shopping-cart-filled-with-coins-copy-space-background_23-2148305919.jpg?w=740&t=st=1695479122~exp=1695479722~hmac=2aaeac494c52cdea59a00a57143321a83b5e21938d9835963050a81f1d040c32');
        background-size: contain;
        background-position: top center;
      ">
  <div class="container login__form active">
    <div class="row vh-100 w-100 align-self-center">
      <div class="col-12 col-lg-6 col-xl-6 px-5">
        <div class="row vh-100">
          <div class="col align-self-center p-5 w-100 text-white rounded-3" style="background-color: rgb(30, 31, 41)">
            <h3 class="fw-bolder">ĐĂNG NHẬP</h3>
            <p class="fw-lighter fs-6">
              Chưa có tài khoản,
              <a href="/register" class="text-decoration-none fw-semibold" style="color: rgb(209, 0, 36)">Đăng Ký</a>
            </p>

            <form id="login_form" action="/login" method="post" class="mt-5">
              <div class="mb-4">
                <label for="email" class="form-label ms-4 w-100 fw-semibold">Email:</label>
                <input value="admin@gmail.com" type="email" name="email" class="form-control text-indent shadow-sm bg-grey-light border-0 rounded-pill fw-lighter fs-7 p-3" placeholder="Nhập vào Email" />
              </div>
              <div class="mb-3">
                <label for="password" class="form-label ms-4 w-100 fw-semibold">
                  Mật khẩu:
                </label>
                <input value="11111" type="password" name="password" placeholder="Nhập vào mật khẩu" class="form-control text-indent auth__password shadow-sm bg-grey-light border-0 rounded-pill fw-lighter fs-7 p-3" />
              </div>

              <div class="text-end fw-bold">
                <a href="/forget-pass" class="text-white text-decoration-none" style="color: rgb(209, 0, 36) !important;">Quên mật khẩu ?</a>
              </div>

              <div class="col text-center">
                <button type="submit" class="btn-login btn btn-outline-dark btn-lg rounded-pill mt-4 w-100 bg-white">
                  Đăng Nhập
                </button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<script>
  $.validator.setDefaults({
    submitHandler: function() {
      $.ajax({
        url: '/login',
        type: 'POST',
        data: {
          "email": $('#login_form input[name="email"]').val(),
          "password": $('#login_form input[name="password"]').val(),
        },
        success: function(res) {
          res = JSON.parse(res);

          Swal.fire({
            title: `${res["error"] ? 'Lỗi' : 'Thành công'}`,
            text: `${res["message"]}`,
            icon: `${res["error"] ? 'error' : 'success'}`,
            confirmButtonText: 'Ok',
            customClass: {
              confirmButton: `${res["error"] ? 'bg-danger' : 'bg-success'}`,
            },
          }).then(function() {
            if (!res["error"]) window.location.href = '/';
          })
        },
        error: function(error) {
          console.log(error);
        }
      });
    }
  })

  $().ready(function() {
    $('#login_form').validate({
      rules: {
        email: {
          required: true,
          email: true,
        },
        password: {
          required: true,
          minlength: 5,
        },
      },
      messages: {
        email: 'Email không hợp lệ',
        password: {
          required: 'Vui lòng nhập mật khẩu',
          minlength: 'Mật khẩu phải có ít nhất 5 ký tự',
        },
      },
      errorElement: 'span',
      errorPlacement: (error, element) => {
        error.addClass('invalid-feedback');
        error.insertAfter(element);
      },
      highlight: (element, errorClass, validClass) => {
        $(element).addClass('is-invalid').removeClass('is-valid');
      },
      unhighlight: (element, errorClass, validClass) => {
        $(element).addClass('is-valid').removeClass('is-invalid');
      },
    })
  });
</script>

<?php include_once VIEWS_DIR . "/partials/footer/index.php" ?>