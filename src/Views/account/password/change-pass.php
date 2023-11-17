<?php include_once VIEWS_DIR . "/partials/header/index.php" ?>

<style>
  button.btn.edit:hover {
    background-color: rgb(30, 31, 41) !important;
  }
</style>

<main style="background-color: #f5f5f5">
  <div class="container">
    <div class="row h-100 py-5">
      <div class="col-12 col-md-3 p-3 mb-5 mb-md-0">
        <div class="py-3 d-flex align-items-center gap-3">
          <img src="<?= htmlspecialchars($user['avatar']) ?>" alt="avatar" class="rounded-circle" style="width: 50px; height: 50px" />
          <p class="m-0 fw-bold"><?= htmlspecialchars($user['email']) ?></p>
        </div>

        <div class="mt-4">
          <div class="d-flex gap-2 align-items-center mb-2">
            <img src="https://down-vn.img.susercontent.com/file/ba61750a46794d8847c3f463c5e71cc4" style="width: 1.5rem; height: 1.5rem" />
            <a href="#" class="text-decoration-none text-black fs-5 m-0">Tài khoản của tôi</a>
          </div>
          <ul style="list-style-type: none">
            <li class="mb-2 fs-5">
              <a href="/profile" class="text-decoration-none text-black opacity-75">Hồ sơ</a>
            </li>
            <li class="mb-2 fs-5">
              <a href="#" class="text-decoration-none" style="color:rgb(209, 0, 36) !important;">Đổi mật khẩu</a>
            </li>
            <li class="mb-2 fs-5">
              <a href="/profile/address" class="text-decoration-none text-black opacity-75">Địa chỉ</a>
            </li>
          </ul>

          <div class="fs-5 d-flex align-items-center gap-2">
            <img src="https://down-vn.img.susercontent.com/file/f0049e9df4e536bc3e7f140d071e9078" style="width: 1.5rem; height: 1.5rem" />
            <a href="/purchase" class="text-decoration-none text-black fs-5 m-0">Đơn mua</a>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-8 p-4 bg-white h-100 rounded-3">
        <div class="border-bottom pb-3">
          <p class="m-0 fs-3">Hồ Sơ Của Tôi</p>
          <p class="m-0 fs-5">
            Quản lý thông tin hồ sơ để bảo mật tài khoản
          </p>
        </div>
        <div class="row pt-5 flex-column-reverse flex-md-row">
          <!-- EDIT PROFILE -->
          <div class="col-12 col-md-12 px-5 border-md-end">
            <form id="user_change_pass_form" action="/account/passowrd" method="post" class="mt-5">
              <div class="mb-5">
                <label for="old_password" class="form-label  w-100  fw-semibold">Mật khẩu cũ</label>
                <input type="password" name="old_password" id="old_password" class="form-control shadow-sm border-0 fw-lighter fs-7 p-3" />
              </div>
              <div class="mb-5">
                <label for="new_password" class="form-label w-100 fw-semibold">Mật khẩu mới</label>
                <input type="password" name="new_password" id="new_password" class="form-control shadow-sm border-0 fw-lighter fs-7 p-3" />
              </div>
              <div class="mb-5">
                <label for="confirm_new_pass" class="form-label w-100 fw-semibold">Nhập lại mật khẩu mới</label>
                <input type="password" name="confirm_new_pass" id="confirm_new_pass" class="form-control shadow-sm border-0 fw-lighter fs-7 p-3" />
              </div>

              <div class="col text-center">
                <button type="submit" class="btn edit btn-outline-dark btn-lg mt-4 w-100 bg-white">
                  Lưu
                </button>
              </div>
            </form>
          </div>
          <!-- /EDIT PROFILE -->
        </div>
      </div>
    </div>
  </div>
</main>

<script>
  $.validator.setDefaults({
    submitHandler: function() {
      $.ajax({
        url: '/account/password',
        type: 'POST',
        data: {
          "old_password": $('#user_change_pass_form input[name="old_password"]').val(),
          "new_password": $('#user_change_pass_form input[name="new_password"]').val(),
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
            if (!res['error']) {
              window.location.href = '/profile'
            }
          })
        },
        error: function(error) {
          console.log(error);
        }
      });
    }
  })

  $().ready(function() {
    $('#user_change_pass_form').validate({
      rules: {
        old_password: {

          required: true,
          minlength: 5,
        },
        new_password: {
          required: true,
          minlength: 5,
        },
        confirm_new_pass: {
          required: true,
          minlength: 5,
          equalTo: '#new_password',
        },
      },
      messages: {
        old_password: {
          required: 'Nhập mật khẩu cũ',
          minlength: 'Mật khẩu phải có ít nhất 5 ký tự ',

        },
        new_password: {
          required: 'Nhập mật khẩu mới',
          minlength: 'Mật khẩu phải có ít nhất 5 ký tự ',

        },
        confirm_new_pass: {
          required: 'Xác nhận mật khẩu mới',
          minlength: 'Mật khẩu phải có ít nhất 5 ký tự ',
          equalTo: 'Mật khẩu không trùng khớp với mật khẩu đã nhập',
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
<?php include_once VIEWS_DIR . "/partials/header/index.php" ?>