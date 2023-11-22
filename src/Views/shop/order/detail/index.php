<?php include_once VIEWS_DIR . "/shop/partials/header/index.php" ?>

<style>
  .update-btn:hover:not(:disabled) {
    opacity: 0.8;
  }

  .update-btn {
    width: 120px;
    background: #000;
    color: #fff;
  }
</style>

<div class="content" style="min-height: 100vh;">
  <div class="animated fadeIn">
    <?php if (!empty($orders)) : ?>
      <div class="row">
        <div class="col">
          <div class="mb-2">
            <a href="/shop/orders"><i class="fa-solid fa-arrow-left-long mx-2"></i>Quay lại trang trước</a>
          </div>

          <div class="card">
            <div class="card-header">
              <strong class="card-title">Chi tiết đơn hàng</strong>
            </div>
            <div class="table-stats order-table ov-h">
              <table class="table">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $totalPrice = 0;
                  foreach ($orders as $index => $order) : ?>
                    <?php $totalPrice += ($order['origin_price'] - $order['origin_price'] * $order['sale'] / 100) * $order['quantity'] ?>
                    <tr class="order" data-order_id="<?= htmlspecialchars($order['order_id']) ?>">
                      <td>
                        <span><?= htmlspecialchars($index + 1) ?></span>
                      </td>
                      <td>
                        <div class="round-img">
                          <a target="_blank" href="/shop/products/edit/<?= htmlspecialchars($order['product_id']) ?>">
                            <img src="<?= htmlspecialchars($order['thumbnail']) ?>" alt="" />
                          </a>
                        </div>
                      </td>
                      <td>
                        <a target="_blank" href="/shop/products/edit/<?= htmlspecialchars($order['product_id']) ?>" class="name"><?= htmlspecialchars($order['name']) ?></a>
                      </td>
                      <td><span class="price"><?= htmlspecialchars(format_money($order['origin_price'] - $order['origin_price'] * $order['sale'] / 100)) ?></span></td>
                      <td class="text-center">
                        <span><?= htmlspecialchars($order['quantity']) ?></span>
                      </td>
                      <td>
                        <span class="name" style="font-weight: 800;"><?= htmlspecialchars(format_money(($order['origin_price'] - $order['origin_price'] * $order['sale'] / 100) * $order['quantity'])) ?></span>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div>

          <?php if (!empty($orders)) : ?>
            <div class="d-flex justify-content-end mx-2 bg-white">
              <p class="mb-0 p-3 text-dark mx-5">
                Đơn vị vận chuyển:
                <span class="text-capitalize" style="font-weight: 800;">
                  <?= htmlspecialchars($orders[0]['delivery_name']) ?>
                  (<?= htmlspecialchars($orders[0]['delivery_id']) ?>)
                </span>
              </p>
              <p class="mb-0 p-3 text-dark">
                Phí vận chuyển:
                <span style="font-weight: 800;">
                  <?= htmlspecialchars(format_money($orders[0]['delivery_amount'])) ?>
                </span>
              </p>
            </div>

            <div class="my-4 d-flex justify-content-end mx-2 bg-white">
              <p class="mb-0 p-3 text-dark">
                Tổng tiền:
                <span class="text-capitalize" style="font-weight: 800;">
                  <?= htmlspecialchars(format_money($orders[0]['delivery_amount'] + $totalPrice)) ?>
                </span>
              </p>
            </div>

            <div class="d-flex justify-content-end mx-2 bg-white p-2">
              <p class="mb-0 mr-3 d-flex align-items-center">Trạng thái</p>
              <?php if ((int)htmlspecialchars($order['status']) === 2 || (int)htmlspecialchars($order['status']) === 3) : ?>
                <p class="mb-0 py-2 font-weight-bold d-flex align-items-center justify-content-center" style="color:#000; width: 120px;">
                  <?= (int)htmlspecialchars($order['status']) === 2 ? 'Đã hủy' : 'Đã nhận' ?>
                </p>
              <?php else : ?>
                <select class="select custom-select" style="box-shadow: none; width: auto">
                  <?php if ((int)htmlspecialchars($order['status']) === 0) : ?>
                    <option selected disabled value="">Chờ cập nhật</option>
                  <?php endif; ?>
                  <option <?= (int)htmlspecialchars($order['status']) === 1 ? 'selected' : '' ?> value="1">Đang giao</option>
                  <option <?= (int)htmlspecialchars($order['status']) === 2 ? 'selected' : '' ?> value="2">Hủy</option>
                </select>
                <button type="button" class="ml-5 update-btn btn" disabled>Cập nhật</button>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    <?php else : ?>
      <div class="row">
        <div class="col">
          <div class="text-center mt-5">
            <p>Không tìm thấy đơn hàng</p>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>

<div class="clearfix"></div>

<script>
  $(() => {
    $('.select').on('change', function() {
      $('.update-btn').attr('disabled', false);
    })

    $('.update-btn').on('click', function() {
      $.ajax({
          type: "POST",
          url: '/shop/orders/edit',
          data: {
            id: $('.order')[0].dataset.order_id,
            status: $('.select').find(':selected').val(),
          },
        })
        .then(res => {
          res = JSON.parse(res);

          Swal.fire({
            title: `${res["error"] ? 'Lỗi' : 'Thành công'}`,
            text: res["message"],
            icon: `${res["error"] ? 'error' : 'success'}`,
            confirmButtonText: 'Ok',
            customClass: {
              confirmButton: `${res["error"] ? 'bg-danger' : 'bg-success'}`,
            },
          }).then(() => {
            if (!res['error']) {
              window.location.href = '/shop/transports';
            }
          })
        })
        .catch(error => {
          console.error("Error:", error);
        });
    })
  })
</script>

<?php include_once VIEWS_DIR . "/shop/partials/footer/index.php" ?>