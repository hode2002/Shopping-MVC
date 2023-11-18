<?php include_once VIEWS_DIR . "/shop/partials/header/index.php" ?>

<div class="content" style="height: 100vh;">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <strong class="card-title mb-0">Danh sách vận chuyển</strong>
          </div>
          <div class="table-stats order-table ov-h">
            <table class="table">
              <thead>
                <tr>
                  <th>Mã vẫn chuyển</th>
                  <th>Mã đơn hàng</th>
                  <th>Tên khách hàng</th>
                  <th>Ngày đặt</th>
                  <th>Ngày dự kiến </th>
                  <th>Địa chỉ</th>
                  <th>Tiến trình</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?= 123 ?></td>
                  <td><?= 456 ?></td>
                  <td><?= 'HVD' ?></td>
                  <td> '18/11/2023' </td>
                  <td> '21/11/2023' </td>
                  <td><?= 'CT' ?></td>
                  <td> Giao thành công </td>
                  <td>
                    <a href="/orders/detail" class="mx-2">
                      <i class="fa-regular fa-eye font-weight-bold" style="font-size: 24px"></i>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- .animated -->
</div>

<div class="clearfix"></div>

<?php include_once VIEWS_DIR . "/shop/partials/footer/index.php" ?>