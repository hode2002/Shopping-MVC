<?php include_once VIEWS_DIR . "/partials/header/index.php" ?>
<style>
  .btn_edit_profile:hover {
    background-color: #000 !important;
    color: #fff !important;
  }
</style>

<main style="background-color: #f5f5f5">
  <div class="container">
    <div class="row h-100 py-5">
      <div class="col-12 col-md-3 p-3 mb-5 mb-md-0">
        <div class="preview-img py-3 d-flex align-items-center gap-3">
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
              <a href="#" class="text-decoration-none text-black">Hồ sơ</a>
            </li>
            <li class="mb-2 fs-5">
              <a href="/account/password" class="text-decoration-none text-black opacity-75">Đổi mật
                khẩu</a>
            </li>
            <li class="mb-2 fs-5">
              <a href="/profile/address" class="text-decoration-none text-black opacity-75">Địa chỉ</a>
            </li>
          </ul>

          <div class="fs-5 d-flex align-items-center gap-2">
            <img src="https://down-vn.img.susercontent.com/file/f0049e9df4e536bc3e7f140d071e9078" style="width: 1.5rem; height: 1.5rem" />
            <a href="#" class="text-decoration-none text-black fs-5 m-0">Đơn mua</a>
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
          <div class="col-12 col-md-8 px-5 border-md-end">
            <form id="user_edit_form" action="" method="post" class="mt-5">
              <div class="mb-5">
                <label for="email" class="form-label w-100 fw-semibold">Email</label>
                <input type="email" name="email" class="form-control shadow-sm border-0 fw-lighter fs-7 p-3" value="<?= htmlspecialchars($user['email']) ?>" disabled />
              </div>

              <div class="mb-5">
                <label for="name" class="form-label w-100 fw-semibold">
                  Tên
                </label>
                <input type="text" autocomplete="off" name="name" value="<?= htmlspecialchars($user['name']) ?>" id="name" class="form-control shadow-sm border-0 fw-lighter fs-7 p-3" />
              </div>

              <div class="mb-5">
                <label for="phone" class="form-label w-100 fw-semibold">
                  Số điện thoại
                </label>
                <input type="text" autocomplete="off" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" id="phone" class="form-control shadow-sm border-0 fw-lighter fs-7 p-3" />
              </div>

              <div class="mb-5">
                <label for="gender" class="form-label mb-2 w-100 fw-semibold">Giới tính</label>
                <div class="d-flex gap-4">
                  <div class="d-flex align-items-center gap-1">
                    <input type="radio" id="male" name="gender" <?php echo htmlspecialchars($user['gender']) === '1' ? 'checked' : ''  ?> value="male" style="width: 18px; height: 18px" />
                    <label for="male" class="ms-1">Nam</label>
                  </div>
                  <div class="d-flex align-items-center gap-1">
                    <input type="radio" id="female" name="gender" <?php echo htmlspecialchars($user['gender']) === '0' ? 'checked' : ''  ?> value="female" style="width: 18px; height: 18px" />
                    <label for="female" class="ms-1">Nữ</label>
                  </div>
                </div>
              </div>

              <div class="mb-4">
                <label for="dob" class="form-label w-100 fw-semibold">
                  Ngày sinh
                </label>
                <input type="text" autocomplete="off" value="<?= htmlspecialchars($user['dob']) ?>" name="dob" id="dob" class="form-control shadow-sm border-0 fw-lighter fs-7 p-3" />
              </div>

              <input type="hidden" name="user_id" value="<?= $user['id'] ?>">

              <div class="col text-center">
                <button type="button" id="btn_edit_profile" class="btn btn_edit_profile btn-outline-dark btn-lg mt-4 w-100 bg-white" aria-disabled="false">
                  Lưu
                </button>
              </div>
            </form>
          </div>
          <!-- /EDIT PROFILE -->

          <!-- EDIT AVATAR -->
          <div class="col-12 col-md-4 d-flex flex-column align-items-center">
            <label class="preview-img" for="avatar">
              <img src="<?= $user['avatar'] ?>" class="rounded-circle" alt="avatar" style="width: 6.5rem; height: 6.5rem" />
            </label>

            <form action="#" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label id="label_avatar" for="avatar" class="btn btn-outline-dark border mt-4">
                  Chọn ảnh
                </label>
                <button type="button" class="btn text-white btn-outline-dark d-none mt-4" id="btn_upload_avatar" style="background-color: #212529;">
                  Cập nhật
                </button>
                <input hidden type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
              </div>
            </form>

            <div class="text-center mt-4 opacity-75">
              <div style="font-size: 14px;">Dụng lượng file tối đa 10 MB</div>
              <div style="font-size: 14px;">Định dạng:.JPEG, .JPG, .PNG, .GIF</div>
            </div>
          </div>
          <!-- /EDIT AVATAR -->
        </div>
      </div>
    </div>
  </div>
</main>

<script>
  $(() => {
    $('#btn_edit_profile').on('click', function(e) {
      e.preventDefault();

      $.ajax({
        type: "POST",
        url: "/profile",
        data: {
          "id": $('input[name="user_id"]').val(),
          "name": $('input[name="name"]').val(),
          "phone": $('input[name="phone"]').val(),
          "gender": $("input[name='gender']:checked").val(),
          "dob": $('input[name="dob"]').val(),
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
          })
        },
        error: function(error) {
          console.error("Error:", error);
        }
      })
    })

    $('#btn_upload_avatar').on('click', function() {
      $(this).addClass('d-none');
      $('#label_avatar').removeClass('d-none');

      const formData = new FormData();
      const avatar = $('#avatar')[0].files[0];

      formData.append('avatar', avatar);

      fetch('/profile/avatar', {
          method: 'POST',
          body: formData,
        })
        .then(res => res.json())
        .then(res => {
          swal(res);
        })
        .catch(error => {
          console.error("Error:", error);
        });
    })

    const isValidFile = (file) => {
      const allowSize = 10 * 1024 * 1024;

      const swal = (msg) => {
        return Swal.fire({
          title: 'Lỗi',
          text: msg,
          icon: 'error',
          confirmButtonText: 'Ok',
          customClass: {
            confirmButton: 'bg-danger',
          },
        })
      }

      const size = file.size;
      const type = file.type;

      if (size > allowSize) {
        swal('Kích thước ảnh tối đa 10 MB');
        return false;
      }

      if (!type.includes('image')) {
        swal('Hình ảnh không đúng định dạng');
        return false;
      }

      return true;
    }

    const previewImg = (input, previewTag) => {
      input.on('change', function() {
        if ($(this).val()) {
          const file = $(this)[0]?.files[0];

          if (!isValidFile(file)) {
            $(this).val('');
            return;
          }

          const img = URL.createObjectURL(file);

          previewTag.removeClass('d-none').find('img').prop('src', img);
          $(this).closest('.form-control').removeClass('is-invalid').addClass('is-valid');
          return;
        }
      })
    }

    $('#avatar').on('change', function() {
      if ($(this).val() && isValidFile($(this)[0]?.files[0])) {
        $('#btn_upload_avatar').removeClass('d-none');
        $('#label_avatar').addClass('d-none');
      }
    })

    previewImg($('#avatar'), $('.preview-img'));
  })
</script>


<?php include_once VIEWS_DIR . "/partials/footer/index.php" ?>