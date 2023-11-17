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
        <section class="">
            <div class="row pt-2">
                <div class="col-lg-6">
                    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-bs-interval="2000">
                                <img src="<?= htmlspecialchars($product['thumbnail']) ?>" class="d-block w-100" alt="...">
                            </div>
                            <?php foreach ($product['imgs'] as $item) : ?>
                                <div class="carousel-item" data-bs-interval="2000">
                                    <img src="<?= htmlspecialchars($item['image_url']) ?>" class="d-block w-100" alt="...">
                                </div>
                            <?php endforeach ?>
                        </div>
                        <button class="slick-prev slick-arrows pull-left fa fa-angle-left" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon text-dark" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="slick-next slick-arrows pull-right fa fa-angle-right" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="ps-lg-3">
                        <h4 class="title text-dark">
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

                        <div class="mb-3">
                            <span class="h2"><?= htmlspecialchars(format_money($product['price'])) ?></span>
                        </div>

                        <p>
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
                                <input type="number" step="1" min="1" max="100" value="1" name="quantity" class="quantity-field border rounded  text-center w-25">
                            </div>
                        </div>
                        <div class="my-2 d-block">
                            <button href="#" class="button text-white rounded text-decoration-none border-0" style=" padding: 15px 65px; background-color: #D10024;">Mua Ngay</button>
                            <button href="#" class="button text-white rounded text-decoration-none border-0" style=" padding: 15px 32px; background-color: #D10024;">
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
                                <a class="nav-link d-flex align-items-center justify-content-center w-100 active bg" id="ex1-tab-1" data-mdb-toggle="pill" href="#ex1-pills-1" role="tab" aria-controls="ex1-pills-1" aria-selected="true">Mô tả sản phâm</a>
                            </li>
                            <li class="nav-item d-flex" role="presentation">
                                <a class="nav-link d-flex align-items-center justify-content-center w-100" id="ex1-tab-2" data-mdb-toggle="pill" href="#ex1-pills-2" role="tab" aria-controls="ex1-pills-2" aria-selected="false">Thông tin vận chuyển</a>
                            </li>
                            <li class="nav-item d-flex" role="presentation">
                                <a class="nav-link d-flex align-items-center justify-content-center w-100" id="ex1-tab-3" data-mdb-toggle="pill" href="#ex1-pills-3" role="tab" aria-controls="ex1-pills-3" aria-selected="false">Chính sách đổi trả</a>
                            </li>
                            <li class="nav-item d-flex" role="presentation">
                                <a class="nav-link d-flex align-items-center justify-content-center w-100" id="ex1-tab-4" data-mdb-toggle="pill" href="#ex1-pills-4" role="tab" aria-controls="ex1-pills-4" aria-selected="false">Đánh giá</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="ex1-content">
                            <div class="tab-pane fade show active" id="ex1-pills-1" role="tabpanel" aria-labelledby="ex1-tab-1">
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


                            <!-- Đánh Giá  -->
                            <div class="tab-pane fade mb-2" id="ex1-pills-4" role="tabpanel" aria-labelledby="ex1-tab-4">

                                <div class="container my-3 pt-3 bg-white">
                                    <h4>Đánh giá sản phẩm</h4>
                                    <!-- Tỉ lệ  -->
                                    <div class="row pt-4">
                                        <div class="col-md-6 ">
                                            <div>
                                                <span style="font-size: 60px;">4.5/</span><span style="font-size: 30px;">5
                                                    &nbsp;</span>

                                                <span class="text-warning">
                                                    <i class="fa-solid fa-star fa-lg"></i>
                                                    <i class="fa-solid fa-star fa-lg"></i>
                                                    <i class="fa-solid fa-star fa-lg"></i>
                                                    <i class="fa-solid fa-star fa-lg"></i>
                                                    <i class="fa-solid fa-star fa-lg"></i></span>
                                            </div>
                                            <i>
                                                Đây là thông tin người mua đánh giá shop bán sản phẩm này có đúng mô
                                                tả không.
                                            </i>
                                        </div>


                                        <div class="col-md-6 ">
                                            <div class="row">
                                                <div class="col-md-4 col-5 my-2 pt-1">
                                                    <!-- 5 -->
                                                    <div class="text-warning pt-1">
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star "></i>
                                                        <i class="fa-solid fa-star "></i>
                                                        <i class="fa-solid fa-star "></i>
                                                        <i class="fa-solid fa-star "></i>
                                                    </div>
                                                    <!-- 4 -->
                                                    <div class="text-warning pt-1">
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star "></i>
                                                        <i class="fa-solid fa-star "></i>
                                                        <i class="fa-solid fa-star "></i>
                                                        <i class="fa-regular fa-star"></i>
                                                    </div>
                                                    <!-- 3 -->
                                                    <div class="text-warning pt-1">
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star "></i>
                                                        <i class="fa-solid fa-star "></i>
                                                        <i class="fa-regular fa-star"></i>
                                                        <i class="fa-regular fa-star"></i>
                                                    </div>
                                                    <!-- 2 -->
                                                    <div class="text-warning pt-1">
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star "></i>
                                                        <i class="fa-regular fa-star"></i>
                                                        <i class="fa-regular fa-star"></i>
                                                        <i class="fa-regular fa-star"></i>
                                                    </div>
                                                    <!-- 1 -->
                                                    <div class="text-warning pt-1">
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-regular fa-star"></i>
                                                        <i class="fa-regular fa-star"></i>
                                                        <i class="fa-regular fa-star"></i>
                                                        <i class="fa-regular fa-star"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-7 my-2 pt-1">
                                                    <div class="pt-1">
                                                        <div class="progress my-1">
                                                            <div class="progress-bar " style="width: 35%" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="pt-1">
                                                        <div class="progress my-1">
                                                            <div class="progress-bar " style="width: 35%" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="pt-1">
                                                        <div class="progress my-1">
                                                            <div class="progress-bar " style="width: 35%" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="pt-1">
                                                        <div class="progress my-1">
                                                            <div class="progress-bar " style="width: 35%" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="pt-1">
                                                        <div class="progress my-1">
                                                            <div class="progress-bar " style="width: 35%" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Cm1 -->

                                        <div class="p-5 mb-2">
                                            <div class="d-flex flex-row">
                                                <img src="/imgs/products/BongDa.png" height="50" width="50" class="rounded-circle">
                                                <div class="ms-2">
                                                    <h6 class="mb-1 text-primary">Luong Hai Dang</h6>
                                                    <i class="text-warning fa fa-star fa-sm"></i>
                                                    <i class="text-warning fa-regular fa-star fa-sm"></i>
                                                    <i class="text-warning fa-regular fa-star fa-sm"></i>
                                                    <i class="text-warning fa-regular fa-star fa-sm"></i>
                                                    <i class="text-warning fa-regular fa-star fa-sm"></i>
                                                    <p class="comment-text my-3">Sản phẩm như l</p>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex flex-row gap-3 align-items-center">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fa-solid fa-thumbs-up"></i>
                                                        <span class="ms-1 fs-10">Like</span>
                                                    </div>


                                                </div>
                                                <div class="d-flex flex-row">
                                                    <span class="text-muted fw-normal fs-10">29-10-2023
                                                        PM</span>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="d-flex flex-row">
                                                <img src="/imgs/products/BongDa.png" height="50" width="50" class="rounded-circle">
                                                <div class="ms-2">
                                                    <h6 class="mb-1 text-primary">Luong Hai Dang</h6>
                                                    <i class="text-warning fa fa-star fa-sm"></i>
                                                    <i class="text-warning fa-regular fa-star fa-sm"></i>
                                                    <i class="text-warning fa-regular fa-star fa-sm"></i>
                                                    <i class="text-warning fa-regular fa-star fa-sm"></i>
                                                    <i class="text-warning fa-regular fa-star fa-sm"></i>
                                                    <p class="comment-text my-3">Sản phẩm như l</p>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex flex-row gap-3 align-items-center">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fa-solid fa-thumbs-up"></i>
                                                        <span class="ms-1 fs-10">Like</span>
                                                    </div>


                                                </div>
                                                <div class="d-flex flex-row">
                                                    <span class="text-muted fw-normal fs-10">29-10-2023
                                                        PM</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- Pills content -->
                        </div>
                    </div>
                    <div class="col-lg-12 pt-3">
                        <div class="px-0 border rounded-2 shadow-0">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Sản phẩm tương tự</h5>
                                    <div class="row p-3">
                                        <?php foreach ($recommend as $product) : ?>

                                            <div class="product d-flex justify-content-center col-6 col-md-4 col-lg-2 py-2">
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
    </section>
</main>

<script src="https://mdbootstrap.com/api/snippets/static/download/MDB5-Free_6.4.2/js/mdb.min.js"></script>

<?php include_once VIEWS_DIR . "/partials/footer/index.php" ?>