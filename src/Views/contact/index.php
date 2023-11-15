<?php include_once VIEWS_DIR . "/partials/header/index.php" ?>

<style>
  /* trang liên hệ */
  .main-contact {
    font-family: Poppins, sans-serif;
    min-height: 100vh;
    width: 100%;
    padding: 30px;
    background-color: rgb(21, 22, 29);
  }

  .contact-form {
    width: 80%;
    background: #fff;
    padding: 20px 60px 20px 20px;
    box-shadow: 5px 10px rgba(0, 0, 0, 0.2);
  }

  .contact-left .details {
    margin: 14px;
    text-align: center;
  }

  .form-right {
    margin-left: 16px;
  }

  .form-right .topic-form {
    text-align: center;
  }

  .contact-left .details i {
    font-size: 30px;
    color: #d10024;
    margin-bottom: 10px;
  }

  .contact-left .details .topic {
    font-size: 18px;
    font-weight: 600;
  }

  .contact-left {
    position: relative;
    margin-top: 15px;
  }

  .contact-left::before {
    content: "";
    position: absolute;
    height: 70%;
    width: 2px;
    right: 10px;
    background: #d10024;
    top: 50%;
    transform: translateY(-50%);
  }

  .contact-left .details .text-one,
  .contact-left .details .text-two {
    font-size: 14px;
    color: #afafb6;
  }

  .topic-form {
    font-size: 23px;
    font-weight: 600;
    color: #d10024;
  }

  .form-right input,
  .form-right textarea {
    border: none;
    background: #f0f1f8;
    resize: none;
    padding-top: 18px;
    padding-bottom: 18px;
  }

  #gui {
    text-align: center;
  }

  #gui input {
    background: #d10024;
    padding: 10px 20px;
  }

  #gui input:hover {
    background: #f0f1f8;
    color: #d10024;
  }

  @media (max-width: 950px) {
    .contact-left {
      margin-right: 30px;
    }

    .contact-left::before {
      right: -40px;
    }
  }

  @media (max-width: 820px) {
    #gui input {
      margin-top: 12px;
      margin-bottom: 5px;
    }

    .contact-left .details .text-one,
    .contact-left .details .text-two {
      font-size: 10px;
    }

    .contact-left .details .topic {
      font-size: 14px;
      text-wrap: wrap;
    }

    .contact-form {
      width: 100%;
      padding: 25px;
    }

    .contact-left::before {
      display: none;
    }

    .contact-left {
      display: flex;
      justify-content: space-between;
      flex-direction: row;
      width: 100%;
    }

    .contact-form form {
      margin-top: 15px;
    }

    .topic-form {
      font-size: 30px;
      margin-bottom: 10px;
    }

    .text-topic-form {
      margin-bottom: 10px;
    }

    .contact-left .details {
      width: 33%;
    }

    .contact-left {
      margin-bottom: 15px;
      flex-wrap: wrap;
      justify-content: center;
      margin-top: 30px;
    }

    .form-right {
      width: 100%;
      margin: 0 5px;
    }
  }
</style>

<main class="main-contact d-flex justify-content-center align-items-center">
  <div class="container contact-form rounded">
    <div class="row">
      <div class="col-md-3 order-1 order-md-0 contact-left">
        <div class="address details">
          <i class="fas fa-map-marked-alt"></i>
          <div class="topic">Địa chỉ</div>
          <div class="text-one">Cần thơ</div>
          <div class="text-two">khu vực nào</div>
        </div>
        <div class="phone details">
          <i class="fas fa-phone-alt"></i>
          <div class="topic">Số điện thoại</div>
          <div class="text-one">0123456789</div>
          <div class="text-two">0135456789</div>
        </div>
        <div class="email details">
          <i class="fas fa-envelope"></i>
          <div class="topic">Email</div>
          <div class="text-one">vyb123456@gmail.com</div>
          <div class="text-two">db12345@gmail.com</div>
        </div>
      </div>
      <div class="col-md-8 form-right order-0 order-md-1">
        <div class="topic-form">Gửi yêu cầu</div>
        <p class="text-topic-form mb-1">
          Nếu bạn có thắc mắc gì khác xin liên hệ qua form dưới đây
        </p>

        <form id="contact_form" action="/contact" method="post">
          <div class="mb-3">
            <input type="text" name="name" id="name" class="form-control" placeholder="Nhập họ tên" />
          </div>
          <div class="mb-3">
            <input type="email" name="email" id="email" class="form-control" placeholder="Nhập email" />
          </div>
          <div class="mb-3">
            <input type="text" name="phone" id="phone" class="form-control" placeholder="Nhập số điện thoại" />
          </div>
          <div class="mb-3">
            <textarea class="form-control" name="content" id="content" rows="3" placeholder="Nội dung"></textarea>
          </div>

          <div class="button" id="gui">
            <input class="btn btn-primary" type="submit" value="Gửi" />
          </div>
        </form>

      </div>
    </div>
  </div>
</main>

<script>
  $.validator.setDefaults({
    submitHandler: function() {
      $.ajax({
        url: '/contact',
        type: 'POST',
        data: {
          "email": $('#contact_form input[name="email"]').val(),
          "name": $('#contact_form input[name="name"]').val(),
          "phone": $('#contact_form input[name="phone"]').val(),
          "content": $('#contact_form textarea[name="content"]').val(),
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
            if (!res["error"]) window.location.reload();
          })
        },
        error: function(error) {
          console.log(error);
        }
      });
    }
  })

  $(() => {
    $('#contact_form').validate({
      rules: {
        email: {
          required: true,
          email: true,
        },
        name: {
          required: true,
        },
        phone: {
          required: true,
          minlength: 10,
          maxlength: 10,
          number: true
        },
        content: {
          required: true,
        }
      },
      messages: {
        email: {
          required: 'Vui lòng nhập email',
          email: 'Email không hợp lệ'
        },
        name: {
          required: 'Vui lòng nhập họ tên',
        },
        phone: {
          required: 'Nhập số điện thoại',
          minlength: 'Số điện thoại phải có ít nhất 10 số',
          maxlength: 'Số điện thoại có tối đa 10 số',
          number: 'Số điện thoại phải là số',
        },
        content: {
          required: 'Nhập nội dung phản hồi',
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