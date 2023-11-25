<?php include_once VIEWS_DIR . "/admin/partials/header/index.php" ?>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="row">

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
                                        <th>Thể loại</th>
                                        <th>Giá</th>
                                        <th>Sale</th>
                                        <th>Thành tiền</th>
                                        <th>Ngày đăng</th>
                                        <th>Trạng thái</th>
                                        <th class="text-right">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($allProducts as $index => $product) : ?>
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
                                                <h6><?= htmlspecialchars($product['CATE_NAME']) ?></h6>
                                            </td>
                                            <td class="align-middle">
                                                <h6><?= htmlspecialchars(format_money($product['price'])) ?></h6>
                                            </td>
                                            <td class="align-middle">
                                                <h6><?= htmlspecialchars($product['sale']) ?>%</h6>
                                            </td>
                                            <td class="align-middle">
                                                <h6><?= htmlspecialchars(format_money($product['price'] - $product['price'] * $product['sale'] / 100)) ?></h6>
                                            </td>
                                            <td class="align-middle"><?= htmlspecialchars($product['created_at']) ?></td>
                                            <td class="align-middle">
                                                <h6><?= htmlspecialchars($product['status']) == 0 ? 'Chờ xác nhận' : ($product['status'] == 1 ? 'Đã duyệt' : 'Vi phạm') ?></h6>
                                            </td>
                                            <td class="text-right align-middle">
                                                <div class="d-flex justify-content-end">
                                                    <?= htmlspecialchars($product['status']) == 0 ? '<i class="btn-product-approve icon feather icon-more-horizontal font-weight-bold  p-2" style="cursor: pointer; font-size: 24px"></i>' : '' ?>
                                                    <i class="fa-regular fa-eye font-weight-bold p-2" style="cursor: pointer; font-size: 24px"></i>
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