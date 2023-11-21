<?php include_once VIEWS_DIR . "/partials/header/index.php"; ?>
<style>
    ::-webkit-scrollbar {
        height: 10px !important;
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
                    <p data-status="4" class="btn-status px-5 text-center text-nowrap text-decoration-none text-dark p-2 rounded border" style="border-color:rgb(209, 0, 36) !important;">Tất cả</p>
                    <p data-status="0" class="btn-status px-5 text-center text-nowrap text-decoration-none text-dark p-2 rounded">Chờ xác nhận</p>
                    <p data-status="1" class="btn-status px-5 text-center text-nowrap text-decoration-none text-dark p-2 rounded">Vận chuyển</p>
                    <p data-status="3" class="btn-status px-5 text-center text-nowrap text-decoration-none text-dark p-2 rounded">Hoàn thành</p>
                    <p data-status="2" class="btn-status px-5 text-center text-nowrap text-decoration-none text-dark p-2 rounded">Đã Hủy</p>
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
                    status: 4
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
            '<i class="fa-solid fa-truck-fast me-1"></i>Đơn hàng của bạn đang được giao',
            'ĐÃ HỦY',
            '<i class="fa-solid fa-truck me-1"></i> Đơn hàng đã được giao thành công',
        ];

        let finalHtml = "";

        orders.forEach(order => {
            let html = `<div class="order shadow text-center p-4 mb-5" style="background-color: white;" data-order_id="${order.id}">`;

            order?.products?.forEach(item => {
                html += `
                        <div class="d-flex justify-content-between mt-3 mb-1 align-items-center">
                            <a href="#" class="text-start text-decoration-none text-dark">
                                <svg width="17" height="16" viewBox="0 0 17 16" class="_0RxYUS"><title>Shop Icon</title><path d="M1.95 6.6c.156.804.7 1.867 1.357 1.867.654 0 1.43 0 1.43-.933h.932s0 .933 1.155.933c1.176 0 1.15-.933 1.15-.933h.984s-.027.933 1.148.933c1.157 0 1.15-.933 1.15-.933h.94s0 .933 1.43.933c1.368 0 1.356-1.867 1.356-1.867H1.95zm11.49-4.666H3.493L2.248 5.667h12.437L13.44 1.934zM2.853 14.066h11.22l-.01-4.782c-.148.02-.295.042-.465.042-.7 0-1.436-.324-1.866-.86-.376.53-.88.86-1.622.86-.667 0-1.255-.417-1.64-.86-.39.443-.976.86-1.643.86-.74 0-1.246-.33-1.623-.86-.43.536-1.195.86-1.895.86-.152 0-.297-.02-.436-.05l-.018 4.79zM14.996 12.2v.933L14.984 15H1.94l-.002-1.867V8.84C1.355 8.306 1.003 7.456 1 6.6L2.87 1h11.193l1.866 5.6c0 .943-.225 1.876-.934 2.39v3.21z" stroke-width=".3" stroke="#333" fill="#333" fill-rule="evenodd"></path></svg>
                                <span>${item.shop_name}</span>
                            </a>
                            <p class="text-end text-uppercase mb-0" style="font-size: 0.8rem;">
                                ${ordersMsg[order?.status]}
                            </p>
                        </div>
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
                                        <span class="text-decoration-line-through text-black-50 me-2"> ${convertNumberToPrice(item.origin_price)}</span>
                                        <span class="text-danger fw-bold sale">${convertNumberToPrice(item.price)}</span>
                                    </p>
                                </div>
                                <div class="text-start">
                                    <p>
                                        <i class="fa-solid fa-xmark"></i>
                                        ${item.quantity}
                                    </p>
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
                                : (
                                    Number(order?.status) === 1
                                    ? (`<button class="confirmBtn btn text-white" style="min-width: 200px; background-color:rgb(209, 0, 36);">
                                            Đã nhận được hàng 
                                        </button>`)
                                    : (`<button class="buyAgainBtn btn text-white" style="min-width: 200px; background-color:rgb(209, 0, 36);">
                                            Mua lại
                                        </button>`)
                                )
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

    $(document).on('click', '.confirmBtn', function() {
        const order = $(this).closest('.order');
        const orderId = order[0].dataset.order_id;

        const data = {
            id: orderId
        }

        postAjax('/checkout/confirm', true, data, order)
    })
</script>

<?php include_once VIEWS_DIR . "/partials/footer/index.php"; ?>