<?php include_once VIEWS_DIR . "/partials/header/index.php"; ?>
<style>
    ::-webkit-scrollbar {
        height: 10px !important;
    }

    .btn:hover {
        background-color: #17252a !important;
    }

    .btn-status:hover {
        cursor: pointer;
    }
</style>
<main style="background-color: #f5f5f5; min-height: 100vh;">
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
                            <a href="#" class="text-decoration-none text-black opacity-75">Địa chỉ</a>
                        </li>
                    </ul>

                    <div class="fs-5 d-flex align-items-center gap-2">
                        <img src="https://down-vn.img.susercontent.com/file/f0049e9df4e536bc3e7f140d071e9078" style="width: 1.5rem; height: 1.5rem" />
                        <a href="/purchase" class="text-decoration-none text-black fs-5 m-0" style="color:rgb(209, 0, 36) !important;">Đơn mua</a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-9 p-5 bg-white h-100 rounded-3">
                <div class="p-3 d-flex align-items-center justify-content-between fw-semibold overflow-x-scroll mb-3" style="background-color: white;">
                    <p data-status="3" class="btn-status px-5 text-center text-nowrap text-decoration-none text-dark p-2 rounded border" style="border-color:rgb(209, 0, 36) !important;">Tất cả</p>
                    <p data-status="0" class="btn-status px-5 text-center text-nowrap text-decoration-none text-dark p-2 rounded">Chờ xác nhận</p>
                    <p data-status="1" class="btn-status px-5 text-center text-nowrap text-decoration-none text-dark p-2 rounded">Vận chuyển</p>
                    <p data-status="2" class="btn-status px-5 text-center text-nowrap text-decoration-none text-dark p-2 rounded">Hủy</p>
                </div>
                <div id="content" style=" min-height: 50vh;"></div>
            </div>
        </div>
    </div>
</main>

<script>
    $(() => {
        $.ajax({
                url: '/purchase',
                type: 'POST',
                data: {
                    status: 3
                },
                beforeSend: function() {
                    const div = `<div class="loading d-flex justify-content-center align-items-center w-100">
                                    <img src="/imgs/loading/loading-gif.gif" alt="" style="width: 100px;">
                                </div>`
                    $("#content").html(div);
                },
                success: function() {
                    $("#content").children('.loading').remove();
                }
            })
            .then(data => {
                data = JSON.parse(data)
                renderOrder(data);
            })

        $('.btn-status').each(function() {
            $(this).click(function() {
                const status = $(this)[0].dataset.status;

                $.ajax({
                        url: '/purchase',
                        type: 'POST',
                        data: {
                            status
                        },
                        beforeSend: function() {
                            const div = `<div class="loading d-flex justify-content-center align-items-center w-100">
                                            <img src="/images/loading/loading-gif.gif" alt="" style="width: 100px;">
                                        </div>`
                            $("#content").html(div);
                        },
                        success: function() {
                            $("#content").children('.loading').remove();
                        }
                    })
                    .then(data => {
                        data = JSON.parse(data)
                        renderOrder(data);
                    })

                $('.btn-status').each(function() {
                    if ($(this).hasClass('border')) {
                        $(this).removeClass('border').removeProp('style');
                    }
                })

                $(this).addClass('border').prop('style', 'border-color: rgb(209, 0, 36) !important');
            })
        })
    })

    const convertNumberToPrice = (number) => {
        return Number(number).toLocaleString('vi', {
            style: 'currency',
            currency: 'VND'
        });
    }

    const renderOrder = (orders = []) => {
        if (!orders.length) {
            html = `<div class="shadow text-center p-4 mb-5 d-flex align-items-center justify-content-center" style="background-color: white; min-height: 60vh">
                            Chưa có đơn hàng
                        </div>`
            $('#content').html(html);
            return;
        }

        const ordersMsg = [
            '</i>Chờ xác nhận',
            '<i class="fa-solid fa-truck me-1"></i>Đơn hàng của bạn đang được giao',
            'ĐÃ HỦY',
        ];

        let finalHtml = "";

        orders.forEach(order => {
            let html = `
             <div class="order shadow text-center p-4 mb-5" style="background-color: white;" data-order_id="${order.id}">
                <p class="text-end text-uppercase" style="font-size: 0.8rem;">
                    ${ordersMsg[order?.status]}
                </p>`;

            order?.products?.forEach(item => {
                html += `
                        <div class="py-3 d-flex align-items-center border bg-white">
                            <div class="col-3">
                                <a href="/product/${item.id}" class="pan col-3 text-center me-3 me-md-0 img-fluid" data-big="${item.thumbnail}">
                                    <img src="${item.thumbnail}" alt="" data-action="zoom" style="width: 100px;">
                                </a>
                            </div>
                            <div class="col-9 text-center px-2">
                                <div class="text-start">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <p class="text-truncate mb-0 fw-semibold me-5">
                                            ${item.name}
                                        </p>
                                    </div>
                                    <p class="mt-2">
                                        <span class="text-decoration-line-through text-black-50 me-2"> ${convertNumberToPrice(item.price)}</span>
                                        <span class="text-danger fw-bold sale">${convertNumberToPrice(Number(item.price) - Number(item.price) * (Number(item.sale) / 100))}</span>
                                    </p>
                                </div>
                                <div class="text-start">
                                    <i class="fa-solid fa-xmark"></i>
                                        ${item.quantity}
                                </div>
                            </div>
                        </div>`
            })

            html += `<div class="mt-3 d-block d-md-flex justify-content-between align-items-center flex-wrap">
                    <div class="d-flex gap-3 align-items-center">
                        <p class="mb-0">Thành tiền:</p>
                        <span class="text-danger fw-semibold fs-4">${convertNumberToPrice(order.total)}</span>
                    </div>
                        <div class="text-end mt-3 mt-md-0">
                              ${                             
                                Number(order?.status) === 0 
                                ? (`<button class="cancelBtn btn text-white" style="min-width: 200px; background-color:rgb(209, 0, 36);">
                                        Hủy
                                    </button>`)
                                : (`<button class="buyAgainBtn btn text-white" style="min-width: 200px; background-color:rgb(209, 0, 36);">
                                        Mua lại
                                    </button>`)
                            }
                        </div>
                    </div>
                </div>`

            finalHtml += html;
        })

        $('#content').html(finalHtml);
    }

    const postAjax = (url, isAlert, data, order) => {
        $.ajax({
            url,
            type: 'POST',
            data,
            success: function(res) {
                res = JSON.parse(res);

                if (isAlert) {
                    Swal.fire({
                        title: `${res["error"] ? 'Lỗi' : 'Thành công'}`,
                        text: res["message"],
                        icon: `${res["error"] ? 'error' : 'success'}`,
                        confirmButtonText: 'Ok',
                        customClass: {
                            confirmButton: `${res["error"] ? 'bg-danger' : 'bg-success'}`,
                        },
                    }).then(() => {
                        if (!res["error"]) {
                            order.remove();
                            if (!$('.order').length) {
                                window.location.reload();
                            }
                        }
                    })
                } else {
                    if (!res["error"]) {
                        window.location.href = '/cart';
                    }
                }
            },
            error: function(error) {
                console.log(error);
            }
        })
    }

    $(document).on('click', '.cancelBtn', function() {
        Swal.fire({
            title: 'Hủy đơn hàng?',
            text: "Bạn chắc chắn muốn hủy đơn hàng này?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xác nhận',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                const order = $(this).closest('.order');
                const orderId = order[0].dataset.order_id;

                const data = {
                    id: orderId,
                    status: 2
                }

                postAjax('/checkout/cancel', true, data, order)
            }
        })
    })

    $(document).on('click', '.buyAgainBtn', function() {
        const order = $(this).closest('.order');
        const orderId = order[0].dataset.order_id;

        const data = {
            id: orderId
        }

        postAjax('/checkout/buy_again', false, data)

    })
</script>

<?php include_once VIEWS_DIR . "/partials/footer/index.php"; ?>