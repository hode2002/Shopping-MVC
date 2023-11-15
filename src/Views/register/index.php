<?php include_once VIEWS_DIR . "/partials/header/index.php" ?>

<style>
  .btn-register:hover {
    background-color: #000 !important;
    color: #fff !important;
  }
</style>

<main style="
        background-image: url('/imgs/logos/bg_register_page.avif');
        background-size: contain;
        background-position: center;
      ">
  <div class="container">
    <div class="row justify-content-end">
      <div class="col-12 col-lg-6 col-xl-6 px-5">
        <div class="row vh-100">
          <div class="col align-self-center p-5 w-100 border-1 text-white rounded-3" style="background-color: rgb(30, 31, 41)">
            <h3 class="fw-bolder">ĐĂNG KÝ</h3>
            <p class="fw-lighter fs-6">
              Đã có tài khoản,
              <a href="/login" class="text-decoration-none fw-semibold" style="color: rgb(209, 0, 36)">
                Đăng Nhập
              </a>
            </p>
            <form id="register_form" method="post" action="/register" class="mt-5">
              <div class="mb-3">
                <label class="form-label ms-3" for="email">Email: </label>
                <input value="admin@gmail.com" type="email" autocomplete="off" class="form-control text-indent shadow-sm bg-grey-light border-0 rounded-pill fs-7 p-3" id="email" name="email" placeholder="Nhập vào email" />
              </div>
              <div class="mb-3">
                <label class="form-label ms-3">Mật khẩu</label>
                <input value="11111" type="password" id="password" placeholder="Nhập vào mật khẩu" name="password" class="form-control text-indent auth__password shadow-sm bg-grey-light border-0 rounded-pill fs-7 p-3" />
              </div>
              <div class="mb-3">
                <label for="confirm_password" class="form-label ms-3">Nhập lại mật khẩu:
                </label>
                <input value="11111" type="password" id="confirm_password" name="confirm_password" placeholder="Nhập lại mật khẩu" class="form-control text-indent auth__password shadow-sm bg-grey-light border-0 rounded-pill fs-7 p-3" />
              </div>
              <div class="col text-center">
                <button type="submit" class="btn-register btn btn-outline-dark btn-lg rounded-pill mt-4 w-100 bg-white">
                  Đăng Ký
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
        url: '/register',
        type: 'POST',
        data: {
          "email": $('#register_form input[name="email"]').val(),
          "password": $('#register_form input[name="password"]').val(),
        },
        success: function(res) {
          res = JSON.parse(res);

          Swal.fire({
            title: `${res["error"] ? 'Lỗi' : 'Thành công'}`,
            text: res["message"],
            icon: `${res["error"] ? 'error' : 'success'}`,
            confirmButtonText: 'Ok',
            customClass: {
              confirmButton: `${res["error"] ? 'bg-danger' : 'bg-success'}`,
            },
          }).then(function() {
            if (!res["error"]) window.location.href = '/login';
          })
        },
        error: function(error) {
          console.log(error);
        }
      });
    }
  })

  $(() => {
    $('#register_form').validate({
      rules: {
        email: {
          required: true,
          email: true,
        },
        password: {
          required: true,
          minlength: 5,
        },
        confirm_password: {
          required: true,
          minlength: 5,
          equalTo: '#password',
        },
      },
      messages: {
        email: {
          required: 'Vui lòng nhập email',
          email: 'Email không hợp lệ'
        },
        password: {
          required: 'Vui lòng nhập mật khẩu',
          minlength: 'Mật khẩu phải có ít nhất 5 ký tự',
        },
        confirm_password: {
          required: 'Vui lòng xác nhận mật khẩu',
          minlength: 'Mật khẩu phải có ít nhất 5 ký tự',
          equalTo: 'Mật khẩu không trùng khớp',
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
  })
</script>

<?php include_once VIEWS_DIR . "/partials/footer/index.php" ?>