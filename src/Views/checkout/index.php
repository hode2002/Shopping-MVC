<?php include_once VIEWS_DIR . "/partials/header/index.php" ?>

<main style="background-color: #f5f5f5;" class="p-2 py-5 rounded">
    <div class="container">
        <div style="background-color: #ffffff">
            <div class="row">
                <div class="col-lg-8 p-4">
                    <div class="text-center mb-3">
                        <h4>Thanh toán hóa đơn</h4>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div>
                                <p>Thông tin đơn hàng</p>
                            </div>
                            <form id="checkout_form" method="post" action="/checkout">
                                <div class="mb-3">
                                    <input type="email" style="box-shadow: none;" value="<?= htmlspecialchars($user['email']) ?>" disabled autocomplete="off" class="form-control" id="email" placeholder="Email" />
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="name" style="box-shadow: none;" value="<?= htmlspecialchars($user['name']) ?>" autocomplete="off" class="form-control" id="name" placeholder="Họ tên" />
                                </div>
                                <div class="mb-3">
                                    <input type="tel" name="phone" style="box-shadow: none;" value="<?= htmlspecialchars($user['phone']) ?>" autocomplete="off" class="form-control" id="phone" placeholder="Số điện thoại" />
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="address" style="box-shadow: none;" value="<?= htmlspecialchars($user['address']) ?>" autocomplete="off" class="form-control" id="address" placeholder="Tỉnh thành" />
                                </div>
                                <div class="mb-3">
                                    <textarea style="box-shadow: none;" class="form-control" id="note" rows="3" placeholder="Ghi chú"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <p>Đơn vị vận chuyển:</p>
                                <div class="rounded">
                                    <div class="d-flex gap-4">
                                        <div class="d-flex align-items-center gap-1">
                                            <input type="radio" checked id="GHN" class="delivery" name="delivery" value="GHN" style="width: 18px; height: 18px" />
                                            <label for="GHN" class="ms-1">Giao hàng nhanh</label>
                                        </div>
                                        <div class="d-flex align-items-center gap-1">
                                            <input type="radio" id="GHTK" class="delivery" name="delivery" value="GHTK" style="width: 18px; height: 18px" />
                                            <label for="GHTK" class="ms-1">Giao hàng tiết kiệm</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <p>Phí vận chuyển: <span class="charge-amount fw-semibold"><?= format_money(37000) ?></span></p>
                            </div>

                            <div class="mb-4">
                                <p>Nhận hàng vào <span class="estimate-date fw-semibold">...</span> </p>
                            </div>

                            <div class="d-flex align-items-center p-2 rounded" style="border: 1px solid #15161d">
                                <input type="radio" id="payment-cod" />
                                <span><label for="payment-cod">Thanh toán khi nhận hàng</label></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 p-0" style="background-color: #fafafa">
                    <div class="border-bottom p-3" style="width: 100%">
                        <h4>Đơn hàng</h4>
                    </div>
                    <div id="show-order" class="mx-4"></div>
                    <div class="mx-4 button text-center d-flex justify-content-between align-items-center" id="gui">
                        <a href="/cart" class="text-decoration-none">Quay về giỏ hàng</a>
                        <input form="checkout_form" id="checkout" class="btn text-white" type="submit" style="background-color: rgb(209, 0, 36);" value="Thanh toán" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    $.validator.setDefaults({
        submitHandler: function() {
            const formData = new FormData();

            const userInfo = {
                "email": $('#email').val(),
                "name": $('#name').val(),
                "address": $('#address').val(),
                "phone": $('#phone').val(),
                "note": $('#note').val(),
            };

            const checkout_products = JSON.parse(window.localStorage.getItem('checkout_products'));

            formData.append('checkout_products', JSON.stringify(checkout_products.map((item) => ({
                id: item.id,
                quantity: item.quantity,
                price: item.price,
            }))));

            formData.append("userInfo", JSON.stringify(userInfo));

            formData.append("delivery", JSON.stringify({
                id: $('input[name="delivery"]:checked').val(),
                estimateDate: $('.estimate-date').text(),
            }));

            fetch('/checkout', {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(res => {
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
                            window.localStorage.removeItem('checkout_products');
                            window.location.href = '/purchase';
                        }
                    })
                })
        }
    })

    $(() => {
        if (!window.localStorage.getItem('delivery')) {
            fetch('/delivery', {
                    method: 'GET',
                })
                .then(res => res.json())
                .then(data => {
                    window.localStorage.setItem('delivery', JSON.stringify(data))
                })
        }

        const estimateDate = `${new Date().getDate() + 3} Th${new Date().getMonth() + 1} - ${new Date().getDate() + 7} Th${new Date().getMonth() + 1}`
        $('.estimate-date').text(estimateDate)

        const convertPriceToNumber = (price) => {
            const result = price.replace(/\D/g, '');
            return Number(result);
        }

        const convertNumberToPrice = (number) => {
            return Number(number).toLocaleString('vi', {
                style: 'currency',
                currency: 'VND'
            });
        }
        if (!window.localStorage.getItem('checkout_products')) {
            $('#show-order').html(` <div class="d-flex flex-column justify-content-center align-items-center h-100">
                                        <img src="/imgs/cart/empty-cart.png" alt="" class="img-fluid" style="width: 300px;">
                                        <p class="mt-3 fw-semibold">Chưa chọn sản phẩm</p>
                                    </div>`);

            $('#checkout').attr('disabled', true);
            return;
        }

        const checkout_products = JSON.parse(window.localStorage.getItem('checkout_products'));

        $('#show-order').html('<div class="overflow-y-scroll"><div id="order-list" style="max-height: 380px;"></div></div>');

        let html = '';
        let totalPrice = 0;
        checkout_products.forEach((item) => {
            totalPrice += item.price * item.quantity;
            html += `
                <div class="d-flex align-items-center justify-content-between p-1 pb-3 my-3 border-bottom">
                    <img src="${item.img}" alt="" style="width: 70px; text-align: center; border: 1px solid #d1ecf1; border-radius: 10px;" 
                    class="me-2" />
                    <div style="width: 45%; text-align: left" class="m-0 text-truncate">
                        <p class="mb-0">${item.name}</p>
                        <p class="mb-0"><span>${convertNumberToPrice(item.price)}</span> x <span class="quantity">${item.quantity}</span></p>
                    </div>
                    <span class="fw-semibold" style="width: 30%; text-align: center; align-items: end">${convertNumberToPrice(item.price * item.quantity)}</span>
                </div>
            `;
        })

        $('#show-order').append(`<div class="my-3 text-end me-3">Tổng tiền: <span class="total-price fs-4 fw-bold ms-2" style="color: rgb(209, 0, 36);">${convertNumberToPrice(totalPrice + convertPriceToNumber($('.charge-amount').text()))}</span></div>`);

        $('#order-list').html(html);

        $('.delivery').each(function() {
            $(this).on('click', function() {
                const deliveryStore = JSON.parse(window.localStorage.getItem('delivery'));

                const deliveryId = $(this).attr('id');
                const choose = deliveryStore.find((item) => item.id === $(this).attr('id'));
                const charge_amount = choose.charge_amount

                $('.charge-amount').text(convertNumberToPrice(charge_amount));
                const estimateDate = `${deliveryId === 'GHN' ? new Date().getDate() + 3 : new Date().getDate() + 5} Th${new Date().getMonth() + 1} - ${deliveryId === 'GHN' ? new Date().getDate() + 7 : new Date().getDate() + 9} Th${new Date().getMonth() + 1}`
                $('.estimate-date').text(estimateDate)

                $('.total-price').html(convertNumberToPrice(totalPrice + Number(charge_amount)))
            })
        })

        $('#checkout_form').validate({
            rules: {
                name: {
                    required: true,
                },
                phone: {
                    required: true,
                    minlength: 10,
                    maxlength: 10
                },
                address: {
                    required: true,
                },
            },
            messages: {
                name: 'Nhập họ tên',
                phone: {
                    required: 'Nhập số điện thoại',
                    minlength: 'Số điện thoại phải có 10 số',
                    maxlength: 'Số điện thoại tối đa 10 số',
                },
                address: {
                    required: 'Nhập địa chỉ',
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