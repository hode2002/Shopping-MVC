<?php include_once VIEWS_DIR . "/admin/partials/header/index.php" ?>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="row">

            <div class="col-12">
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
                                        <th>Tên</th>
                                        <th>Ngày sinh</th>
                                        <th>Giới tính</th>
                                        <th>Địa chỉ</th>
                                        <th>Số điện thoại</th>
                                        <th class="text-right">Thao tác</th>
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
                                                <h6><?= htmlspecialchars($user['email']) ?></h6>
                                            </td>
                                            <td class="align-middle">
                                                <h6><?= htmlspecialchars($user['name'] ?? 'Chưa cập nhật') ?></h6>
                                            </td>
                                            <td class="align-middle">
                                                <h6><?= htmlspecialchars($user['dob'] ?? 'Chưa cập nhật') ?></h6>
                                            </td>
                                            <td class="align-middle">
                                                <h6><?= htmlspecialchars($user['gender'] ?? 'Chưa cập nhật') ?></h6>
                                            </td>
                                            <td class="align-middle">
                                                <h6><?= htmlspecialchars($user['address'] ?? 'Chưa cập nhật') ?></h6>
                                            </td>
                                            <td><?= htmlspecialchars($user['phone'] ?? 'Chưa cập nhật') ?></td>
                                            <td class="align-middle">
                                                <div class="d-flex justify-content-end">
                                                    <i class="btn-product-approve fa-solid fa-trash font-weight-bold  p-2" style="cursor: pointer; font-size: 24px"></i>
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