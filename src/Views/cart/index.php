<?php include_once VIEWS_DIR . "/partials/header/index.php" ?>

<style>
    .tbl-product-width {
        width: 40.27949%;
        min-width: 40.27949%;
    }

    .tbl-price-width {
        width: 15.88022%;
    }

    .tbl-quantity-width {
        width: 15.4265%;
    }

    .tbl-money-width {
        width: 10.43557%;
    }

    button.btn.edit:hover {
        background-color: rgb(30, 31, 41) !important;
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
    }

    .delete-many {
        cursor: pointer;
    }

    #check-all,
    .check-all {
        cursor: pointer;
    }
</style>

<main id="cart" style="background-color: #f5f5f5;">
    <div class="bg-white py-4">
        <div class="container">
            <p class="fs-2 m-0">
                <i class="fa-solid fa-bag-shopping me-3"></i>
                Giỏ Hàng
            </p>
        </div>
    </div>

    <div class="container">
        <div class="row h-100 py-5 overflow-x-scroll">
            <div class="py-4 bg-white mb-4" style="min-width: 1000px;">
                <div class="d-flex align-items-center fw-bold" style="padding: 0;">
                    <div class="d-inline-block ms-3" style="width: calc(40.27949% + 60px);">Sản Phẩm</div>
                    <div class="d-inline-block tbl-price-width text-center">Đơn Giá</div>
                    <div class="d-inline-block tbl-quantity-width text-center">Số Lượng</div>
                    <div class="d-inline-block tbl-price-width text-center">Số Tiền</div>
                    <div class="d-inline-block text-center" style="width: 12.70417%;">Thao Tác</div>
                </div>
            </div>
            <div class="cart-list" style="padding: 0; min-width: 1000px;">
                <?php foreach ($cartList as $item) : ?>
                    <div class="product cart-item p-2 d-flex align-items-center mt-3 bg-white shadow-sm" data-product_id="<?= htmlspecialchars($item['product_id']) ?>">
                        <div class="px-3">
                            <input class="select" type="checkbox" style="width: 20px; height: 20px;">
                        </div>

                        <div class="tbl-product-width">
                            <div class="d-flex align-items-center">
                                <img src=" <?= htmlspecialchars($item['thumbnail']) ?>" alt="" style="width: 80px; height: 80px;">
                                <p class="text-truncate mx-4 mb-0 product-name">
                                    <?= htmlspecialchars($item['name']) ?>
                                </p>
                            </div>
                        </div>

                        <div class="tbl-price-width text-center">
                            <p class="m-0 unit-price" style="color: rgb(209, 0, 36);">
                                <?= htmlspecialchars(format_money((int)$item['price'] - (int)$item['price'] * (int)$item['sale'] / 100)) ?>
                            </p>
                        </div>

                        <div class="d-flex justify-content-center tbl-quantity-width">
                            <div class="d-flex col-md-12 number-input">
                                <span class="input-group-btn">
                                    <button type="button" class="btn-minus btn btn-dark btn-number rounded-end-0" style="border: 1px solid #17252a;" data-type="minus" data-field="quantity">
                                        <span class="fa fa-minus"></span>
                                    </button>
                                </span>
                                <input type="number" value="<?= htmlspecialchars($item['quantity']) ?>" min="0" max="100" name="quantity" class="quantity fw-bold form-control input-number text-center col rounded-0 border-end-0 border-start-0" style="box-shadow: none; border-color: #17252a;">
                                <span class="input-group-btn">
                                    <button type="button" class="btn-plus btn btn-dark btn-number rounded-start-0" style="border: 1px solid #17252a;" data-type="plus" data-field="quantity">
                                        <span class="fa fa-plus"></span>
                                    </button>
                                </span>
                            </div>
                        </div>

                        <div class="tbl-price-width text-center">
                            <p class="m-0 fw-bold total-price" style="color: rgb(209, 0, 36);"><?= htmlspecialchars(format_money(((int)$item['price'] - (int)$item['price'] * (int)$item['sale'] / 100) * (int)$item['quantity'])) ?></p>
                        </div>

                        <div class="text-center" style="width: 12.70417%;">
                            <a href="#" class="cart-btn-close text-decoration-none text-center">Xóa</a>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <!-- THANH TOÁN -->
        <div id="cart-payment" class="row my-4 bg-white p-3 fs-5 position-sticky bottom-0 z-2 shadow align-items-center" style="min-height: 100px;">
            <div class="d-flex flex-row flex-md-column flex-lg-row justify-content-between align-items-center h-100">

                <div class="d-flex flex-wrap justify-content-start mb-0 mb-md-3 mb-lg-0">
                    <div class="d-flex align-items-center me-3">
                        <input id="check-all" type="checkbox" style="width: 20px; height: 20px;">
                    </div>
                    <label for="check-all" class="check-all text-decoration-none ms-2 me-5 mb-0 d-none d-md-block" style="color: rgb(209, 0, 36);">
                        Chọn tất cả
                    </label>
                    <!-- <p class=" delete-many text-decoration-none mb-0 d-none d-md-block" style="color: rgb(209, 0, 36);">Xóa</p> -->
                </div>

                <div class="d-flex">
                    <div class="d-flex align-items-center me-4">
                        <p class="mb-0 mx-2">Tổng <span class="d-none d-md-inline-block">thanh toán</span>:</p>
                        <p id="total" class="mb-0 ms-3 fs-3 fw-semibold" style="color: rgb(209, 0, 36);">
                            0 ₫
                        </p>
                    </div>
                    <button class="buy btn text-white" disabled style="background-color: rgb(209, 0, 36); width: 200px;">
                        MUA HÀNG
                    </button>
                </div>

            </div>
        </div>
        <!-- THANH TOÁN -->

        <!-- CÓ THỂ BẠN CŨNG THÍCH -->
        <div class="mt-5 fs-4">CÓ THỂ BẠN CŨNG THÍCH</div>

        <div class="row pb-5 pt-2 mb-5">
            <?php foreach ($recommends as $product) : ?>
                <a href="/product/<?= htmlspecialchars($product['id']) ?>" class="text-decoration-none text-dark product d-flex justify-content-center col-6 col-md-4 col-lg-2 py-2" data-product_id="<?= htmlspecialchars($product['id']) ?>">
                    <div class="card" style="width: 11rem">
                        <img src="<?= htmlspecialchars($product['thumbnail']) ?>" class="card-img-top p-2" alt="product" />
                        <div class="card-body p-2">
                            <h5 class="name card-title text-truncate" style="font-size: 11px">
                                <?= htmlspecialchars($product['name']) ?>
                            </h5>
                            <p class="origin-price card-text text-start m-0 text-dark opacity-75 text-center text-decoration-line-through">
                                <?= format_money(htmlspecialchars($product['price'])) ?>
                            </p>
                            <p class="price card-text text-start m-0 text-center fw-bold" style="color: rgb(209, 0, 36)">
                                <?= format_money(htmlspecialchars((int)$product['price'] - (int)$product['price'] * (int)$product['sale'] / 100)) ?>
                            </p>
                            <div class="add_to_cart text-center top-100 start-0 end-0 position-absolute d-none w-100 rounded-bottom-1 add-cart-product" style="
                    background-color: rgb(209, 0, 36);
                    border: 1px solid rgb(209, 0, 36);
                  ">
                                <div class="add-to-cart btn text-white border-0">Thêm vào giỏ</div>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach ?>
        </div>
        <!-- CÓ THỂ BẠN CŨNG THÍCH -->

    </div>
</main>

<script>
    $().ready(function() {
        const checkWidth = () => {
            const windowsize = $(window).width();
            if (windowsize < 1200) {
                $('.row.h-100.py-5').addClass('overflow-x-scroll');
            } else {
                $('.row.h-100.py-5.overflow-x-scroll').removeClass('overflow-x-scroll');
            }
        }
        checkWidth();
        $(window).resize(checkWidth);

        const convertPriceToNumber = (price) => {
            const result = price.replace(/\D/g, '');
            return Number(result);
        }

        const convertNumberToPrice = (number) => {
            return number.toLocaleString('vi', {
                style: 'currency',
                currency: 'VND'
            });
        }

        const swalDelete = (product) => {
            return Swal.fire({
                title: 'Xác nhận xóa?',
                text: "Bạn chắc chắn muốn xóa sản phẩm này?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xác nhận',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    const productId = product[0].dataset.product_id;

                    $.ajax({
                        url: '/cart/delete/' + productId,
                        type: 'POST',
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
                                .then(function() {
                                    $('header .cart-list .product.card').each(function() {
                                        const itemId = $(this)[0].dataset.product_id;
                                        if (itemId === productId) {
                                            $(this).remove();
                                            if (!$('header .cart-list .product.card').length) {
                                                window.location.reload();
                                            }
                                        }
                                    })

                                    product.remove();
                                })
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    })
                }
            })
        }

        $('.cart-btn-close').each(function() {
            $(this).on('click', () => {
                const product = $(this).closest('.product');
                swalDelete(product);
            })
        })

        $('.btn-minus').each(function() {
            $(this).on('click', function() {
                const product = $(this).closest('.product');
                const productId = product[0].dataset.product_id;
                const input = $(this).closest('.number-input').find('input[name="quantity"]');
                const formData = new FormData();

                input[0].stepDown();

                $('header .cart-list .product.card').each(function() {
                    const itemId = $(this)[0].dataset.product_id;
                    if (itemId === productId) {
                        $(this).find('.quantity').html(Number(input.val()));
                    }
                })

                if (Number(input.val()) === 0) {
                    input.val(1);
                    swalDelete(product);
                }

                priceChange(product, false);

                product.find('.total').html(Number(input.val()) * Number(product.find('.sale').text()));

                formData.append('quantity', input.val());

                fetch('/cart/update/' + productId, {
                    method: 'POST',
                    body: formData
                }).then()
            })
        })

        $('.btn-plus').each(function() {
            $(this).on('click', function() {
                const product = $(this).closest('.product');
                const productId = product[0].dataset.product_id;
                const input = $(this).closest('.number-input').find('input[name="quantity"]');
                const formData = new FormData();

                input[0].stepUp();
                priceChange(product);

                product.find('.total').html(Number(input.val()) * Number(product.find('.sale').text()));

                $('header .cart-list .product.card').each(function() {
                    const itemId = $(this)[0].dataset.product_id;
                    if (itemId === productId) {
                        $(this).find('.quantity').html(Number(input.val()));
                    }
                })

                formData.append('quantity', input.val());

                fetch('/cart/update/' + productId, {
                    method: 'POST',
                    body: formData
                }).then()
            })
        })

        const priceChange = (element, increase = true) => {

            let quantity = Number(element.find('.quantity').val());
            const unitPrice = convertPriceToNumber(element.find('.unit-price').text());

            const cartItemTotalPrice = quantity * unitPrice;

            element.find('.quantity').attr('value', quantity);
            element.find('.total-price').html(convertNumberToPrice(cartItemTotalPrice))

            let paymentTotalPrice = 0;
            $('.cart-item').each(function() {
                if ($(this).find('input.select').is(':checked')) {
                    paymentTotalPrice += Number($(this).find('.quantity').val()) * convertPriceToNumber($(this).find('.unit-price').text());
                }
            })
            $('#cart-payment #total').html(convertNumberToPrice(paymentTotalPrice));
        }

        $('.cart-item').each(function() {
            const inputCheckbox = $(this).find('input.select');

            inputCheckbox.on('change', function() {
                const currTotalPaymentPrice = convertPriceToNumber($('#cart-payment #total').text());
                const unitPrice = convertPriceToNumber($(this).parents('.cart-item').find('.unit-price').text());
                const quantity = $(this).parents('.cart-item').find('.quantity').val();

                if ($(this).is(':checked')) {
                    $('#cart-payment #total').html(convertNumberToPrice(currTotalPaymentPrice + unitPrice * quantity));
                } else {
                    $('#check-all').prop('checked', false);
                    $('#cart-payment #total').html(convertNumberToPrice(currTotalPaymentPrice - unitPrice * quantity));
                }

                let count = 0;
                $('.cart-item').each(function() {
                    if ($(this).find('input.select').is(':checked')) {
                        count++;
                    }
                })

                if (count > 0) {
                    $('.buy').attr('disabled', false);
                } else {
                    $('.buy').attr('disabled', true);
                }

                if (count === Number($('.cart-item').length)) {
                    $('#check-all').prop('checked', true);
                }
            })

        })

        $('.buy').on('click', function() {
            const productsChecked = [];

            $('.cart-item').each(function() {
                if ($(this).find('input.select').is(':checked')) {
                    const product = {
                        id: $(this)[0].dataset.product_id,
                        name: $.trim($(this).find('.product-name').text()),
                        img: $(this).find('img').prop('src'),
                        quantity: Number($(this).find('.quantity').val()),
                        price: convertPriceToNumber($(this).find('.unit-price').text()),
                    }
                    productsChecked.push(product)
                }
            })

            window.localStorage.setItem('checkout_products', JSON.stringify(productsChecked))

            window.location.href = '/checkout';
        })

        $('#check-all').on('change', function() {
            if ($('#check-all').is(':checked')) {
                let paymentTotalPrice = 0;

                $('.cart-item').each(function() {
                    $(this).find('input.select').prop('checked', true);

                    if ($(this).find('input.select').is(':checked')) {
                        const quantity = Number($(this).closest('.cart-item').find('.quantity').val());
                        const unitPrice = convertPriceToNumber($(this).find('.unit-price').text());
                        paymentTotalPrice += quantity * unitPrice;
                    }
                })

                $('#cart-payment #total').html(convertNumberToPrice(paymentTotalPrice));

                $('.buy').attr('disabled', false);
                return
            }

            if ($('#check-all').not(':checked')) {
                $('.cart-item').each(function() {
                    $(this).find('input.select').prop('checked', false);
                })

                $('#cart-payment #total').html(convertNumberToPrice(0));
                $('.buy').attr('disabled', true);
                return
            }
        })
    })
</script>

<?php include_once VIEWS_DIR . "/partials/footer/index.php" ?>