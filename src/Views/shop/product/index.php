<?php include_once VIEWS_DIR . "/shop/partials/header/index.php" ?>

<style>
  ::-webkit-scrollbar {
    height: 10px;
  }

  .btn-add:hover {
    opacity: 0.8;
  }
</style>

<?php if (empty($products)) : ?>
  <div class="d-flex align-items-center justify-content-center" style="min-height: 100vh">
    <a href="/shop/products/add" class="btn-add mb-0 btn text-white" style="background-color: #17252a">Thêm sản phẩm</a>
  </div>
<?php else : ?>
  <div class="content" style="min-height: 100vh; max-width: 100vw;">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header d-flex align-items-center">
              <strong class="card-title mb-0">Danh sách sản phẩm</strong>
            </div>
            <div style="overflow-x: scroll;">
              <div class="table-stats order-table ov-h" style="min-width: 1000px;">
                <table class="table">
                  <thead>
                    <tr style="white-space: nowrap">
                      <th>Mã</th>
                      <th>Hình ảnh</th>
                      <th>Tên</th>
                      <th>Giá</th>
                      <th>Sale</th>
                      <th>Thành tiền</th>
                      <th>Số lượng</th>
                      <th>Trạng thái</th>
                      <th>Thao tác</th>
                    </tr>
                  </thead>
                  <tbody id="t_body">
                    <?php foreach ($products as $product) : ?>
                      <tr class="product" style="white-space: nowrap" data-product_id="<?= htmlspecialchars($product['id']) ?>">
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
                          <p class="mb-0 name text-truncate" style="min-width: 350px; width: 350px;"><?= htmlspecialchars($product['name']) ?></p>
                        </td>
                        <td><span class="price"><?= htmlspecialchars(format_money($product['price'])) ?></span></td>
                        <td><span><?= htmlspecialchars($product['sale']) ?></span>%</td>
                        <td><span><?= htmlspecialchars(format_money((int)$product['price'] - (int)$product['price'] * (int)$product['sale'] / 100)) ?></span></td>
                        <td><span class="quantity"><?= htmlspecialchars($product['quantity']) ?></span></td>
                        <td><span><?= htmlspecialchars($product['status'] == 0 ?  'Chờ kiểm duyệt' : ($product['status'] == 1 ? 'Đã duyệt' : 'Vi phạm')) ?></span></td>
                        <td>
                          <div class="d-flex justify-content-end">
                            <a class="mr-2" href="/shop/products/edit/<?= htmlspecialchars($product['id']) ?>">
                              <i class="fa-solid fa-pen-to-square" style="font-size: 24px"></i>
                            </a>
                            <p class="mb-0 delete-btn">
                              <i class=" fa fa-trash font-weight-bold" style="font-size: 24px; cursor: pointer;"></i>
                            </p>
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
<?php endif; ?>

<div class="clearfix"></div>

<script>
  const postAjax = (url, data) => {
    $.ajax({
      url,
      type: 'POST',
      data: data ? data : '',
      success: function(res) {
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
          if (!res["error"]) {
            window.location.reload();
          }
        })

      },
      error: function(error) {
        console.log(error);
      }
    })
  }
  $('.delete-btn').on('click', function() {
    Swal.fire({
      title: 'Xác nhận xóa?',
      text: "Bạn chắc chắn muốn xóa sản phẩm này?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Xác nhận',
      cancelButtonText: 'Hủy'
    }).then((result) => {
      if (result.isConfirmed) {
        const productId = $(this).closest('.product')[0].dataset.product_id;
        const data = {
          id: productId
        }

        postAjax('/shop/product/delete/', data);

        $(this).closest('.product').remove();
      }
    })
  })
</script>

<?php include_once VIEWS_DIR . "/shop/partials/footer/index.php" ?>