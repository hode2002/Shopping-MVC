<?php include_once VIEWS_DIR . "/partials/header/index.php" ?>

<style>
    .nav-pills {
        --bs-nav-pills-border-radius: var(--bs-border-radius);
        --bs-nav-pills-link-active-color: #fff;
        --bs-nav-pills-link-active-bg: #D10024;
    }

    .carousel-item {
        transition: transform 0.6s ease-in-out;
    }

    a {
        color: rgb(209, 0, 36) !important;
    }

    a.active {
        color: #fff !important;
    }
</style>

<main class="bg-light py-5">
    <div class="container bg-white">
        <section class="product" data-product_id="<?= htmlspecialchars($product['id']) ?>">
            <div class="row pt-2">
                <div class="col-md-6 py-5">
                    <div class="d-flex justify-content-center">
                        <img src="<?= htmlspecialchars($product['thumbnail']) ?>" class="main-img img d-block w-75" alt="...">
                    </div>
                    <div class="d-flex image-slider overflow-hidden mt-2">
                        <?php foreach ($product['imgs'] as $item) : ?>
                            <img src="<?= htmlspecialchars($item['image_url']) ?>" class="sub-img d-block" width="106" height="106" alt="...">
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="col-md-6 p-5">
                    <div class="ps-lg-3">
                        <h4 class="title text-dark name">
                            <?= htmlspecialchars($product['name']) ?>
                        </h4>

                        <div class="d-flex flex-row my-3">
                            <div class="text-warning mb-1 me-2">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span class="ms-1">
                                    5.0
                                </span>
                            </div>
                            <span class="text-muted">
                                <i class="fas fa-shopping-basket fa-sm mx-1"></i>
                                100K Đã Bán</span>
                        </div>

                        <div class="mb-3 d-flex gap-4">
                            <span class="h2 text-black-50 unit-price text-decoration-line-through"><?= htmlspecialchars(format_money($product['price'])) ?></span>
                            <span class="h2 price"><?= htmlspecialchars(format_money($product['price'] - $product['price'] * $product['sale'] / 100)) ?></span>
                        </div>

                        <p class="text-truncate">
                            <?= htmlspecialchars($product['description']) ?>
                        </p>

                        <div class="row">
                            <dt class="col-3">Danh mục: </dt>
                            <dd class="col-9"><?= htmlspecialchars($product['cate_name']) ?></dd>

                            <dt class="col-3">Màu sắc: </dt>
                            <dd class="col-9">Tím mộng mơ</dd>

                            <dt class="col-3">Chất liệu: </dt>
                            <dd class="col-9">Inox không gỉ</dd>

                            <dt class="col-3">Thương hiệu: </dt>
                            <dd class="col-9">Logitech</dd>
                        </div>

                        <hr />
                        <div class="row">
                            <div class="col-md-4 col-5">
                                <p><strong>Số lượng: </strong></p>
                            </div>
                            <div class="col-md-8 col-7">
                                <input type="number" step="1" min="1" max="100" value="1" name="quantity" class="quantity quantity-field border rounded text-center w-25">
                            </div>
                        </div>

                        <div class="my-2 d-flex justify-content-around bottom-0">
                            <button href="#" class="add-to-cart buy-now button text-white rounded text-decoration-none border-0" style="min-width: 200px; padding: 10px 65px; background-color: #D10024;">
                                <span hidden class="no-alert"></span>
                                Mua Ngay
                            </button>
                            <button href="#" class="add-to-cart button text-white rounded text-decoration-none border-0" style="min-width: 200px; padding: 10px 32px; background-color: #D10024;">
                                &nbsp;&nbsp;<i class="fa-solid fa-cart-plus fa-lg text-decoration-none"></i>&nbsp;&nbsp;</button>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>

    <section class="bg-light py-4 mt-5">
        <div class="container ">
            <div class="row gx-4">
                <div class="col-lg-12 mb-4">
                    <div class="border rounded-2 px-3 py-2 bg-white">

                        <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                            <li class="nav-item d-flex" role="presentation">
                                <a class="nav-link d-flex align-items-center justify-content-center w-100 active bg" id="ex1-tab-4" data-mdb-toggle="pill" href="#ex1-pills-4" role="tab" aria-controls="ex1-pills-4" aria-selected="true">Đánh giá</a>
                            </li>
                            <li class="nav-item d-flex" role="presentation">
                                <a class="nav-link d-flex align-items-center justify-content-center w-100" id="ex1-tab-1" data-mdb-toggle="pill" href="#ex1-pills-1" role="tab" aria-controls="ex1-pills-1" aria-selected="false">Mô tả sản phâm</a>
                            </li>
                            <li class="nav-item d-flex" role="presentation">
                                <a class="nav-link d-flex align-items-center justify-content-center w-100" id="ex1-tab-2" data-mdb-toggle="pill" href="#ex1-pills-2" role="tab" aria-controls="ex1-pills-2" aria-selected="false">Thông tin vận chuyển</a>
                            </li>
                            <li class="nav-item d-flex" role="presentation">
                                <a class="nav-link d-flex align-items-center justify-content-center w-100" id="ex1-tab-3" data-mdb-toggle="pill" href="#ex1-pills-3" role="tab" aria-controls="ex1-pills-3" aria-selected="false">Chính sách đổi trả</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="ex1-content">
                            <!-- Đánh Giá  -->
                            <div class="tab-pane fade mb-2 show active" id="ex1-pills-4" role="tabpanel" aria-labelledby="ex1-tab-4">

                                <div class="container my-3 pt-3 bg-white">
                                    <h4>Đánh Giá</h4>
                                    <!-- Tỉ lệ  -->

                                    <?php if (isset($_SESSION['email'])) : ?>
                                        <div class="py-5 input-group mb-3 post-comment z-1" data-user_id="<?= htmlspecialchars($user['id']) ?>" data-product_id="<?= htmlspecialchars($product['id']) ?>">
                                            <input type="text" class="px-3 py-2 form-control content" placeholder="Bình luận gì đó..." style="box-shadow: none">
                                            <button class="button btn-outline-danger btn-comment-create rounded-end-2 text-white border-0" type="button" style="min-width: 120px; background-color: #D10024;">Đăng</button>
                                        </div>
                                    <?php endif; ?>

                                    <div class="row pt-4 border comment-list">
                                        <?php foreach ($comments as $comment) : ?>
                                            <div class="p-5 mb-2 comment" data-product_id="<?= htmlspecialchars($product['id']) ?>" data-comment_id="<?= htmlspecialchars($comment['id']) ?>">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="d-flex">
                                                        <img src="<?= htmlspecialchars($comment['avatar']) ?>" height="50" width="50" class="rounded-circle">
                                                        <div class="ms-3 comment-left">
                                                            <h6 class="text-primary"><?= htmlspecialchars($comment['name'] ?? $comment['email']) ?></h6>
                                                            <p class="comment-text"><?= htmlspecialchars($comment['content']) ?></p>
                                                        </div>
                                                    </div>
                                                    <?php if (isset($_SESSION['email']) && htmlspecialchars($comment['email']) === $_SESSION['email']) : ?>
                                                        <div class="d-flex gap-2 comment-right">
                                                            <p class="mb-0 btn-comment-edit text-decoration-none me-2 text-danger" style="cursor: pointer;">Chỉnh sửa</p>
                                                            <p class="mb-0 btn-comment-post-update text-decoration-none me-2 text-danger d-none" style="cursor: pointer;">Lưu</p>
                                                            <p class="mb-0 btn-comment-delete text-decoration-none mb-0 text-danger" style="cursor: pointer;">Xóa</p>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <div class="d-flex flex-row gap-3 align-items-center">
                                                    </div>
                                                    <div class="d-flex flex-row">
                                                        <span class="text-muted fw-normal">
                                                            <?= htmlspecialchars($comment['updated_at']) ?>
                                                        </span>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                        <?php endforeach ?>
                                    </div>

                                </div>
                            </div>
                            <!-- Mô tả sản phẩm -->
                            <div class="tab-pane fade" id="ex1-pills-1" role="tabpanel" aria-labelledby="ex1-tab-1">
                                <p>
                                    <?= htmlspecialchars($product['description']) ?>
                                </p>
                                <div class="row mb-2">
                                    <div class="col-12 col-md-6">
                                        <ul class="list-unstyled mb-0">
                                            <li><i class="fas fa-check text-success me-2"></i>Bàn phím gaming có dây
                                                SIDOTECH giả cơ nhưng mang
                                                đến trải nghiệm về chất lượng không kém gì bàn phím
                                                ơ chuyên nghiệp</li>

                                        </ul>
                                    </div>
                                    <div class="col-12 col-md-6 mb-0">
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-check text-success me-2"></i>Bàn phím gaming
                                                SIDOTECH hướng đến
                                                những game thủ chuyên nghiệp
                                                hoặc những bạn cần sự 1
                                                chiếc bàn phím có tốc độ phản hồi cao để có thể làm việc
                                                sử lý nhanh nhất</li>

                                        </ul>
                                    </div>
                                </div>
                                <table class="table border mt-3 mb-2">
                                    <tr>
                                        <th class="py-2">Thông số:</th>
                                        <td class="py-2">123123</td>
                                    </tr>
                                    <tr>
                                        <th class="py-2">Processor capacity:</th>
                                        <td class="py-2">2.3GHz dual-core Intel Core i5</td>
                                    </tr>
                                    <tr>
                                        <th class="py-2">Camera quality:</th>
                                        <td class="py-2">720p FaceTime HD camera</td>
                                    </tr>
                                    <tr>
                                        <th class="py-2">Memory</th>
                                        <td class="py-2">8 GB RAM or 16 GB RAM</td>
                                    </tr>
                                    <tr>
                                        <th class="py-2">Graphics</th>
                                        <td class="py-2">Intel Iris Plus Graphics 640</td>
                                    </tr>
                                </table>
                            </div>
                            <!-- Van Chuyen -->
                            <div class="tab-pane fade mb-2" id="ex1-pills-2" role="tabpanel" aria-labelledby="ex1-tab-2">

                                <p>
                                    Với đa phần đơn hàng, Shop chúng tôi cần vài giờ làm việc để kiểm tra thông tin
                                    và đóng gói hàng. Nếu các sản phẩm đều có sẵn hàng, chúng tôi sẽ nhanh
                                    chóng bàn giao cho đối tác vận chuyển. Nếu đơn hàng có sản phẩm sắp phát
                                    hành, chúng tôi sẽ ưu tiên giao những sản phẩm có hàng trước cho Quý khách
                                    hàng.
                                </p>
                                <p>
                                    THỜI GIAN VÀ CHI PHÍ GIAO HÀNG TẠI TỪNG KHU VỰC TRONG LÃNH THỔ VIỆT NAM:
                                </p>
                                <div class="row mb-2">
                                    <div class="col-12 col-md-6">
                                        <ul class="list-unstyled mb-0">
                                            <li>
                                                <p>1. Nội thành Cần Thơ, TP.HCM và Hà Nội</p>
                                                Thời gian: 1-2 ngày
                                                Chi phí: 15.000đ/ đơn hàng (không giới hạn giá trị, áp dụng từ
                                                02.11.2021)
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="col-12 col-md-6 mb-0">
                                        <ul class="list-unstyled">
                                            <li>
                                                <p>2. Các tỉnh thành khác</p>
                                                Thời gian: 2-3 ngày
                                                Chi phí: 30.000đ/ đơn hàng (không giới hạn giá trị, áp dụng từ
                                                02.11.2021)
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Bao Hanh -->
                            <div class="tab-pane fade mb-2" id="ex1-pills-3" role="tabpanel" aria-labelledby="ex1-tab-3">
                                <table class="table table-bordered d-block text-center ">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>KỂ TỪ KHI GIAO HÀNG THÀNH CÔNG</th>
                                            <th>SẢN PHẨM LỖI </th>
                                            <th>SẢN PHẨM KHÔNG LỖI</th>
                                            <th>SẢN PHẨM LỖI DO NGƯỜI SỬ DỤNG</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Sản phẩm Điện tử, Đồ chơi điện - điện tử, điện gia dụng,... (có tem
                                                phiếu bảo hành từ nhà cung cấp)</td>
                                            <td>7 ngày đầu tiên</td>
                                            <td>Đổi mới</td>
                                            <td>Trả hàng không thu phí</td>
                                            <td>Bảo hành hoặc sửa chữa có thu phí theo quy định của nhà cung cấp.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Voucher/ E-voucher</td>
                                            <td>30 ngày đầu tiên</td>
                                            <td>Trả hàng không thu phí</td>
                                            <td>Không hỗ trợ đổi/ trả</td>
                                            <td>Không hỗ trợ đổi/ trả</td>

                                        </tr>
                                        <tr>
                                            <td>Đối với các ngành hàng còn lại</td>
                                            <td>30 ngày đầu tiên</td>
                                            <td>Đổi mới</td>
                                            <td>Trả hàng không thu phí</td>
                                            <td>Không hỗ trợ đổi/ trả</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 pt-3">
                        <div class="px-0 border rounded-2 shadow-0">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Sản phẩm tương tự</h5>
                                    <div class="row p-3">
                                        <?php foreach ($recommend as $product) : ?>

                                            <div class="product d-flex justify-content-center col-6 col-md-4 col-lg-2 pb-5 pt-2">
                                                <div class="card" style="width: 11rem">
                                                    <img src="<?= htmlspecialchars($product['thumbnail']) ?>" class="card-img-top p-2" alt="product" />
                                                    <div class="card-body p-2">
                                                        <h5 class="card-title text-truncate" style="font-size: 11px">
                                                            <?= htmlspecialchars($product['name']) ?>
                                                        </h5>
                                                        <p class="price card-text text-start m-0" style="color: rgb(209, 0, 36)">
                                                            <?= htmlspecialchars(format_money($product['price'])) ?>
                                                        </p>
                                                        <div class="add_to_cart text-center top-100 start-0 end-0 position-absolute d-none w-100 rounded-bottom-1" style="
                                                          background-color: rgb(209, 0, 36);
                                                          border: 1px solid rgb(209, 0, 36);
                                                        ">
                                                            <div class="btn text-white border-0">Thêm vào giỏ</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php endforeach ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="https://mdbootstrap.com/api/snippets/static/download/MDB5-Free_6.4.2/js/mdb.min.js"></script>

<script>
    $(() => {
        const convertPriceToNumber = (price) => {
            const result = price.replace(/\D/g, '');
            return Number(result);
        }

        $('img.sub-img').each(function() {
            $(this).on('click', function() {
                const img = $(this).prop("src");
                $('.main-img').prop("src", img);
            })
        })

        $('.buy-now').on('click', function() {
            const product = $(this).closest('.product');
            const productId = product[0]?.dataset.product_id;
            const quantity = product.find('input.quantity').val() || 1;

            const item = {
                id: productId,
                name: $.trim(product.find('.name').text()),
                img: product.find('.main-img').prop('src'),
                quantity,
                price: convertPriceToNumber(product.find('.unit-price').text()),
            }
            window.localStorage.setItem('checkout_products', JSON.stringify([item]))
        })

        const postAjax = (url, data = [], isDelete = false, comment = {}) => {
            $.ajax({
                url,
                type: 'POST',
                data,
                success: function(res) {
                    if (isDelete) {
                        comment.remove();
                        return;
                    }

                    window.location.reload();
                },
            })
        }

        $('.btn-comment-create').on('click', function() {
            const comment = $(this).closest('.post-comment');
            const productId = comment[0].dataset.product_id;
            const content = comment.find('.content').val();

            const data = {
                productId,
                content
            }

            postAjax('/products/comment', data);
        })

        $('.btn-comment-delete').on('click', function() {
            const comment = $(this).closest('.comment');
            const commentId = comment[0].dataset.comment_id;
            const productId = comment[0].dataset.product_id;

            const data = {
                productId,
                commentId
            }

            postAjax('/products/comment/delete', data, true, comment);
        })

        $('.btn-comment-edit').on('click', function() {
            const comment = $(this).closest('.comment');
            const commentId = comment[0].dataset.comment_id;
            const productId = comment[0].dataset.product_id;
            const content = comment.find('p.comment-text').text();

            const input = `<input class="form-control comment-text" value="${content}" style="box-shadow: none;" />`;
            comment.find('.comment-left').append(input);
            comment.find('p.comment-text').remove();
            $(this).addClass('d-none');
            comment.find('.btn-comment-post-update').removeClass('d-none');

            $('.btn-comment-post-update').on('click', function() {
                const data = {
                    commentId,
                    productId,
                    content: comment.find('input.comment-text').val(),
                }

                postAjax('/products/comment/update', data, false, comment);
            })
        })
    })
</script>

<?php include_once VIEWS_DIR . "/partials/footer/index.php" ?>