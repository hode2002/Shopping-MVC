<?php include_once VIEWS_DIR . "/partials/header/index.php" ?>

<style>
    .btn-change_pass:hover {
        background-color: #000 !important;
        color: #fff !important;
    }
</style>

<main>
    <div class="container">
        <div class="row vh-100 w-100 align-self-center">
            <div class="col-12 col-lg-6 col-xl-6 px-5">
                <div class="row vh-100">
                    <div class="col align-self-center p-5 w-100 text-white rounded-3" style="background-color: rgb(30, 31, 41)">
                        <h3 class="fw-bolder">Quên Mật Khẩu</h3>
                        <div class="text-start fw-bold">
                            <a href="/login" class="text-white text-decoration-none" style="color: rgb(209, 0, 36) !important;">Trở lại đăng nhập</a>
                        </div>

                        <form id="forget_pass_form" action="/forget-pass" method="post" class="mt-5">
                            <div class="mb-4">
                                <label for="email" class="form-label ms-4 w-100 fw-semibold">Email:</label>
                                <input value="admin@gmail.com" type="email" name="email" class="form-control text-indent shadow-sm bg-grey-light border-0 rounded-pill fw-lighter fs-7 p-3" placeholder="Nhập vào Email" />
                            </div>

                            <div class="col text-center">
                                <button type="submit" class="btn-change_pass btn btn-outline-dark btn-lg rounded-pill mt-4 w-100 bg-white">
                                    Tìm mật khẩu
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
                url: '/forget-pass',
                type: 'POST',
                data: {
                    "email": $('#forget_pass_form input[name="email"]').val(),
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
                        if (!res["error"]) window.location.href = '/login';
                    })
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    })

    $().ready(function() {
        $('#forget_pass_form').validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
            },
            messages: {
                email: {
                    required: 'Vui lòng nhập email',
                    email: 'Email không hợp lệ'
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