<?php include_once VIEWS_DIR . "/partials/header/index.php" ?>

<style>
  button#btn_edit_address:hover {
    background-color: rgb(30, 31, 41) !important;
  }
</style>

<main style="background-color: #f5f5f5;">
  <div class="container">
    <div class="row h-100 py-5">
      <div class="col-md-3 col-12 p-3 mb-5 mb-md-0">
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
              <a href="/account/password" class="text-decoration-none text-black opacity-75">Đổi mật khẩu</a>
            </li>
            <li class="mb-2 fs-5">
              <a href="#" class="text-decoration-none" style="color:rgb(209, 0, 36) !important;">Địa chỉ</a>
            </li>
          </ul>

          <div class="fs-5 d-flex align-items-center gap-2">
            <img src="https://down-vn.img.susercontent.com/file/f0049e9df4e536bc3e7f140d071e9078" style="width: 1.5rem; height: 1.5rem" />
            <a href="/purchase" class="text-decoration-none text-black fs-5 m-0">Đơn mua</a>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-9 p-5 bg-white h-100 rounded-3">
        <div class="border-bottom pb-3">
          <p class="m-0 fs-3">Hồ Sơ Của Tôi</p>
          <p class="m-0 fs-5">
            Quản lý thông tin hồ sơ để bảo mật tài khoản
          </p>
        </div>
        <div class="row pt-5 flex-column-reverse flex-md-row">
          <!-- EDIT ADDRESS -->
          <div class="col px-5 border-md-end">
            <div class="mb-5">
              <label for="address" class="form-label w-100 fw-semibold">
                Địa chỉ
              </label>
              <input type="text" autocomplete="off" name="address" value="<?= htmlspecialchars($user['address']) ?>" id="address" class="form-control shadow-sm border-0 fw-lighter fs-7 p-3" />
            </div>
            <!-- <label for="address" class="form-label w-100 fw-semibold mb-5">Địa chỉ</label>
              <div class="mb-5 row">
                <select class="col-1 form-select form-select-sm mb-3 form-control shadow-sm border-0 fw-lighter fs-7 p-3" id="city">
                  <option value="" selected>Chọn tỉnh thành</option>
                </select>

                <select class=" col-1 form-select form-select-sm mb-3 form-control shadow-sm border-0 fw-lighter fs-7 p-3" id="district">
                  <option value="" selected>Chọn quận huyện</option>
                </select>

                <select class=" col-1 form-select form-select-sm form-control shadow-sm border-0 fw-lighter fs-7 p-3" id="ward">
                  <option value="" selected>Chọn phường xã</option>
                </select>
              </div> -->
            <div class=" col text-center">
              <button type="button" id="btn_edit_address" class="btn btn-outline-dark btn-lg mt-4 w-100 bg-white">
                Lưu
              </button>
            </div>
          </div>
          <!-- /EDIT ADDRESS -->
        </div>
      </div>
    </div>
  </div>
</main>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
  $(() => {
    const cities = $('#city')[0];
    const districts = $("#district")[0];
    const wards = $("#ward")[0];

    const promise = axios({
      url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
      method: "GET",
      responseType: "application/json",
    })
    promise.then((result) => {
      renderCity(result.data);
      return result.data;
    })

    const renderCity = (data) => {
      for (const city of data) {
        cities.options[cities.options.length] = new Option(city.Name, city.Id);
      }
      cities.onchange = function() {
        district.length = 1;
        ward.length = 1;
        if (this.value != "") {
          const result = data.filter(n => n.Id === this.value);

          for (const k of result[0].Districts) {
            district.options[district.options.length] = new Option(k.Name, k.Id);
          }
        }
      };
      district.onchange = function() {
        ward.length = 1;
        const dataCity = data.filter((n) => n.Id === cities.value);
        if (this.value != "") {
          const dataWards = dataCity[0].Districts.filter(n => n.Id === this.value)[0].Wards;

          for (const w of dataWards) {
            wards.options[wards.options.length] = new Option(w.Name, w.Id);
          }
        }
      };
    }

    $('#btn_edit_address').on('click', function(e) {
      axios({
          url: "/profile/address",
          method: "POST",
          data: {
            'city': $('#city').val(),
            'district': $("#district").val(),
            'ward': $("#ward").val(),
          },
          responseType: "application/json",
        })
        .then((response) => {
          result = response.data;

          Swal.fire({
            title: `${result["error"] ? 'Lỗi' : 'Thành công'}`,
            text: `${result["message"]}`,
            icon: `${result["error"] ? 'error' : 'success'}`,
            confirmButtonText: 'Ok',
            customClass: {
              confirmButton: `${result["error"] ? 'bg-danger' : 'bg-success'}`,
            },
          })
        });
    })

  })
</script> -->

<script>
  $(() => {
    $('#btn_edit_address').on('click', function() {
      $.ajax({
        url: '/profile/address',
        type: 'POST',
        data: {
          address: $('#address').val()
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
          console.log(error);
        }
      })
    })
  })
</script>

<?php include_once VIEWS_DIR . "/partials/footer/index.php" ?>