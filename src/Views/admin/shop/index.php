<?php include_once VIEWS_DIR . "/admin/partials/header/index.php" ?>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="row">

            <div class="col-12">
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
                                        <th>Tên Cửa hàng</th>
                                        <th>Tên chủ</th>
                                        <th>Email</th>
                                        <th>Ngày đăng ký</th>
                                        <th>Trạng thái</th>
                                        <th class="text-right">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($allShops as $index => $shop) : ?>
                                        <tr class="shop" data-shop_id="<?= htmlspecialchars($shop['id']) ?>" data-shop_status="<?= htmlspecialchars($shop['status']) ?>">
                                            <td class="align-middle"><span><?= htmlspecialchars($index + 1) ?></span></td>
                                            <td>
                                                <div class="d-inline-block align-middle">
                                                    <img src="<?= htmlspecialchars($shop['logo']) ?>" alt="shop logo" class="img-radius wid-40 align-top m-r-15">
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <h6><?= htmlspecialchars($shop['name']) ?></h6>
                                            </td>
                                            <td class="align-middle">
                                                <h6><?= htmlspecialchars($shop['U_NAME'] ?? 'Chưa cập nhật') ?></h6>
                                            </td>
                                            <td class="align-middle">
                                                <h6 class="shop-email"><?= htmlspecialchars($shop['email']) ?></h6>
                                            </td>
                                            <td class="align-middle">
                                                <h6><?= htmlspecialchars($shop['created_at']) ?></h6>
                                            </td>
                                            <td class="align-middle">
                                                <?= htmlspecialchars($shop['status'] == 0 ? 'Chờ xét duyệt' : 'Đang hoạt động') ?>
                                            </td>
                                            <td class="text-right align-middle">
                                                <div class="d-flex justify-content-end">
                                                    <i class="btn-shop-approve icon feather icon-more-horizontal font-weight-bold  p-2" style="cursor: pointer; font-size: 24px"></i>
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