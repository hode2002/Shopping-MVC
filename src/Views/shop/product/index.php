<?php include_once VIEWS_DIR . "/shop/partials/header/index.php" ?>
<style>
  .btn-add:hover {
    opacity: 0.8;
  }
</style>


<?php if (empty($products)) : ?>
  <div class="d-flex align-items-center justify-content-center" style="min-height: 100vh">
    <a href="/shop/products/add" class="btn-add mb-0 btn text-white" style="background-color: #17252a">Thêm sản phẩm</a>
  </div>
<?php else : ?>
  <div class="content" style="min-height: 100vh;">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header d-flex align-items-center">
              <strong class="card-title mb-0">Danh sách sản phẩm</strong>
            </div>
            <div class="table-stats order-table ov-h">
              <table class="table">
                <thead>
                  <tr>
                    <th>Mã</th>
                    <th class="avatar">Hình ảnh</th>
                    <th>Tên</th>
                    <th>Giá</th>
                    <th>Sale</th>
                    <th>Thành tiền</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                  </tr>
                </thead>
                <tbody id="t_body">
                  <?php foreach ($products as $product) : ?>
                    <tr>
                      <td>
                        <span><?= htmlspecialchars($product['id']) ?></span>
                      </td>
                      <td>
                        <div class="round-img">
                          <a href="#">
                            <img src="<?= htmlspecialchars($product['thumbnail']) ?>" style="width: 50px !important;" alt="" />
                          </a>
                        </div>
                      </td>
                      <td>
                        <span class="name"><?= htmlspecialchars($product['name']) ?></span>
                      </td>
                      <td><span class="price"><?= htmlspecialchars(format_money($product['price'])) ?></span></td>
                      <td><span><?= htmlspecialchars($product['sale']) ?></span>%</td>
                      <td><span><?= htmlspecialchars(format_money((int)$product['price'] - (int)$product['price'] * (int)$product['sale'] / 100)) ?></span></td>
                      <td><span><?= htmlspecialchars($product['status'] == 0 ?  'Chờ kiểm duyệt' : ($product['status'] == 1 ? 'Đã duyệt' : 'Vi phạm')) ?></span></td>
                      <td>
                        <a href="/shop/products/edit/<?= htmlspecialchars($product['id']) ?>">
                          <i class="fa-solid fa-pen-to-square" style="font-size: 24px"></i>
                        </a>&nbsp;
                        <a href="#">
                          <i class=" fa fa-trash font-weight-bold" style="font-size: 24px"></i>
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
  </div>
<?php endif; ?>

<div class="clearfix"></div>

<?php include_once VIEWS_DIR . "/shop/partials/footer/index.php" ?>