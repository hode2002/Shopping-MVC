<?php include_once VIEWS_DIR . "/admin/partials/header/index.php" ?>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="row">

            <div class="col-md-12 col-xl-6">
                <div class="card flat-card">
                    <div class="row-table">
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="fa-solid fa-store text-c-green mb-1 d-block"></i>
                                </div>
                                <div class="col-sm-8 text-md-center">
                                    <h5><?= htmlspecialchars($countShop) ?></h5>
                                    <span>Cửa hàng</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="fa-solid fa-user text-c-red mb-1 d-block"></i>
                                </div>
                                <div class="col-sm-8 text-md-center">
                                    <h5><?= htmlspecialchars($countUser) ?></h5>
                                    <span>Người dùng</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-table">
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="fa-brands fa-product-hunt text-c-blue mb-1 d-block"></i>
                                </div>
                                <div class="col-sm-8 text-md-center">
                                    <h5><?= htmlspecialchars($countProduct) ?></h5>
                                    <span>Sản phẩm</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="fa-solid fa-truck-fast text-c-blue mb-1 d-block"></i>
                                </div>
                                <div class="col-sm-8 text-md-center">
                                    <h5><?= htmlspecialchars($countProductsDelivery) ?></h5>
                                    <span>Vận chuyển</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-xl-6">
                <div class="card flat-card">
                    <div class="row-table">
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="icon feather icon-file-text text-c-blue mb-1 d-block"></i>
                                </div>
                                <div class="col-sm-8 text-md-center">
                                    <h5><?= htmlspecialchars($countPostProduct) ?></h5>
                                    <span>Đơn duyệt</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="fa-solid fa-envelope-open-text text-c-blue mb-1 d-block"></i>
                                </div>
                                <div class="col-sm-8 text-md-center">
                                    <h5><?= htmlspecialchars($countContact) ?></h5>
                                    <span>Phản hồi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-table">
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="icon feather icon-rotate-ccw text-c-red mb-1 d-block"></i>
                                </div>
                                <div class="col-sm-8 text-md-center">
                                    <h5><?= htmlspecialchars($countOrderCancel) ?></h5>
                                    <span>Đã Hủy</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="icon feather icon-shopping-cart text-c-blue mb-1 d-blockz"></i>
                                </div>
                                <div class="col-sm-8 text-md-center">
                                    <h5><?= htmlspecialchars($countOrder) ?></h5>
                                    <span>Đơn hàng</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 table">
                <div class="card table-card">
                    <div class="card-header">
                        <h5>Danh sách đăng ký mở cửa hàng</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Logo</th>
                                        <th>Email</th>
                                        <th>Tên cửa hàng</th>
                                        <th>Ngày đăng ký</th>
                                        <th class="text-right">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($allRegisterShop as $index => $shop) : ?>
                                        <tr class="shop" data-shop_id="<?= htmlspecialchars($shop['id']) ?>" data-shop_status="<?= htmlspecialchars($shop['status']) ?>">
                                            <td class="align-middle"><?= htmlspecialchars($index + 1) ?></td>
                                            <td> <img src="<?= htmlspecialchars($shop['logo']) ?>" alt="shop logo" class="img-radius wid-40 align-top m-r-15"></td>
                                            <td class="align-middle">
                                                <h6 class="shop-email"><?= htmlspecialchars($shop['email']) ?></h6>
                                            </td>
                                            <td class="align-middle">
                                                <h6><?= htmlspecialchars($shop['name']) ?></h6>
                                            </td>
                                            <td class="align-middle"><?= htmlspecialchars($shop['created_at']) ?></td>
                                            <td class="text-right align-middle">
                                                <div class="d-flex justify-content-end">
                                                    <i class="fa-regular fa-eye font-weight-bold p-2" style="cursor: pointer; font-size: 24px"></i>
                                                    <i class="btn-shop-approve icon feather icon-more-horizontal font-weight-bold  p-2" style="cursor: pointer; font-size: 24px"></i>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-md-12">
                <div class="card table-card">
                    <div class="card-header">
                        <h5>Khách hàng</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Avatar</th>
                                        <th>email</th>
                                        <th class="text-right">Số điện thoại</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($allUsers as $index => $user) : ?>
                                        <tr>
                                            <td class="align-middle"><span><?= htmlspecialchars($index + 1) ?></span></td>
                                            <td>
                                                <div class="d-inline-block align-middle">
                                                    <img src="<?= htmlspecialchars($user['avatar']) ?>" alt="user image" class="img-radius wid-40 align-top m-r-15">
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <div>
                                                    <h6><?= htmlspecialchars($user['email']) ?></h6>
                                                </div>
                                            </td>
                                            <td class="text-right"><?= htmlspecialchars($user['phone'] ?? 'Chưa cập nhật') ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-md-12">
                <div class="card table-card">
                    <div class="card-header">
                        <h5>Cửa hàng</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Logo</th>
                                        <th>Tên</th>
                                        <th class="text-right">Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($allShops as $index => $shop) : ?>
                                        <tr>
                                            <td class="align-middle"><span><?= htmlspecialchars($index + 1) ?></span></td>
                                            <td>
                                                <div class="d-inline-block align-middle">
                                                    <img src="<?= htmlspecialchars($shop['logo']) ?>" alt="shop logo" class="img-radius wid-40 align-top m-r-15">
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <div>
                                                    <h6><?= htmlspecialchars($shop['name']) ?></h6>
                                                </div>
                                            </td>
                                            <td class="text-right">Đang hoạt động</td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 table">
                <div class="card table-card">
                    <div class="card-header">
                        <h5>Danh sách Sản phẩm cần duyệt</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Hình ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Tên cửa hàng</th>
                                        <th>Giá</th>
                                        <th>Ngày đăng</th>
                                        <th class="text-right">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($allPostProducts as $index => $product) : ?>
                                        <tr class="product" data-product_id="<?= htmlspecialchars($product['id']) ?>" data-shop_id="<?= htmlspecialchars($product['SHOP_ID']) ?>">
                                            <td class="align-middle"><?= htmlspecialchars($index + 1) ?></td>

                                            <td> <img src="<?= htmlspecialchars($product['thumbnail']) ?>" alt="hình ảnh sản phẩm" class="img-radius wid-40 align-top m-r-15"></td>
                                            <td class="align-middle">
                                                <h6 class="text-truncate" style="min-width: 350px; width: 350px;"><?= htmlspecialchars($product['name']) ?></h6>
                                            </td>
                                            <td class="align-middle">
                                                <h6><?= htmlspecialchars($product['SHOP_NAME']) ?></h6>
                                            </td>
                                            <td class="align-middle">
                                                <h6><?= htmlspecialchars(format_money($product['price'] - $product['price'] * $product['sale'] / 100)) ?></h6>
                                            </td>
                                            <td class="align-middle"><?= htmlspecialchars($product['created_at']) ?></td>
                                            <td class="text-right align-middle">
                                                <div class="d-flex justify-content-end">
                                                    <i class="fa-regular fa-eye font-weight-bold p-2" style="cursor: pointer; font-size: 24px"></i>
                                                    <i class="btn-product-approve icon feather icon-more-horizontal font-weight-bold  p-2" style="cursor: pointer; font-size: 24px"></i>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include_once VIEWS_DIR . "/admin/partials/footer/index.php" ?>