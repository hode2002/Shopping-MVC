<?php include_once VIEWS_DIR . "/shop/partials/header/index.php" ?>

<style>
  ::-webkit-scrollbar {
    height: 10px;
  }
</style>

<div class="content" style="min-height: 100vh; max-width: 100vw;">
  <div class="animated fadeIn">
    <?php if (!empty($orders)) : ?>
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
              <strong class="card-title">Danh sách đơn hàng</strong>
            </div>
            <div style="overflow-x: scroll;">
              <div class="table-stats order-table ov-h" style="min-width: 1000px;">
                <table class="table">
                  <thead>
                    <tr>
                      <th>STT</th>
                      <th>Tên khách hàng</th>
                      <th>Mã đơn hàng</th>
                      <th>Địa chỉ</th>
                      <th>Ngày đặt</th>
                      <th>Trạng thái</th>
                      <th>Thành tiền</th>
                      <th>Thao tác</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($orders as $index => $order) : ?>
                      <tr>
                        <td><?= htmlspecialchars($index + 1) ?></td>
                        <td>
                          <span class="name"><?= htmlspecialchars($order['ORDER_NAME']) ?></span>
                        </td>
                        <td><span><?= htmlspecialchars($order['ORDER_ID']) ?></span></td>
                        <td><span><?= htmlspecialchars($order['ORDER_ADDRESS']) ?></span></td>
                        <td><span><?= htmlspecialchars($order['ORDER_DATE']) ?></span></td>
                        <td><span><?= htmlspecialchars($order['ORDER_STATUS'] == 0 ? 'Chờ xác nhận' : ($order['ORDER_STATUS'] == 1 ? 'Đang giao' : ($order['ORDER_STATUS'] == 2 ? 'Hủy' : 'Đã nhận hàng'))) ?></span></td>
                        <td><span style="font-weight: 800;"><?= htmlspecialchars(format_money($order['TOTAL_PRICE'])) ?></span></td>
                        <td>
                          <a href="/shop/orders/<?= htmlspecialchars($order['ORDER_ID']) ?>">
                            <i class="fa-regular fa-eye font-weight-bold" style="font-size: 24px"></i>
                          </a>
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
    <?php else : ?>
      <div class="row">
        <div class="col">
          <div class="text-center mt-3">
            <p>Không có đơn hàng</p>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>

<div class="clearfix"></div>

<?php include_once VIEWS_DIR . "/shop/partials/footer/index.php" ?>