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
            <div class="card-header d-flex align-items-center">
              <strong class="card-title mb-0">Danh sách vận chuyển</strong>
            </div>
            <div style="overflow-x: scroll;">
              <div class="table-stats order-table ov-h" style="min-width: 1200px;">
                <table class="table">
                  <thead>
                    <tr style="white-space: nowrap">
                      <th>STT</th>
                      <th>Đơn vị vận chuyển</th>
                      <th>Mã đơn hàng</th>
                      <th>Tên khách hàng</th>
                      <th>Ngày đặt</th>
                      <th>Ngày Giao dự kiến </th>
                      <th>Địa chỉ</th>
                      <th>Ghi chú</th>
                      <th>Trạng thái</th>
                      <th>Thao tác</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($orders as $index => $order) : ?>
                      <tr style="white-space: nowrap">
                        <td><?= htmlspecialchars($index + 1) ?></td>
                        <td><?= htmlspecialchars($order['DELIVERY_NAME']) ?> (<?= htmlspecialchars($order['DELIVERY_ID']) ?>)</td>
                        <td><?= htmlspecialchars($order['ORDER_ID']) ?></td>
                        <td><?= htmlspecialchars($order['ORDER_NAME']) ?></td>
                        <td><?= htmlspecialchars($order['ORDER_DATE']) ?></td>
                        <td><?= htmlspecialchars($order['DELIVERY_DATE']) ?></td>
                        <td><?= htmlspecialchars($order['ORDER_ADDRESS']) ?></td>
                        <td><?= htmlspecialchars(empty($order['ORDER_NOTE']) ? "Không" : $order['ORDER_NOTE']) ?></td>
                        <td>Đang giao</td>
                        <td>
                          <a target="_blank" href="/shop/orders/<?= htmlspecialchars($order['ORDER_ID']) ?>" class="mx-2">
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
            <p>Không có đơn vận chuyển</p>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>
  <!-- .animated -->
</div>

<div class="clearfix"></div>

<?php include_once VIEWS_DIR . "/shop/partials/footer/index.php" ?>