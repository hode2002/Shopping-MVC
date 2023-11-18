<?php
if (isset($_GET["madon"])) {
  $code = $_GET["madon"];
} else {
  $code = "";
}
$sql = " SELECT * FROM chi_tiet_don_hang c JOIN don_hang d ON d.ma_don_hang=c.ma_don_hang JOIN san_pham s ON c.ma_san_pham = s.ma_san_pham  WHERE c.ma_don_hang = $code ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="content" style="min-height: 100vh;">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col">
        <div class="mb-2">
          <a href="index.php?page=order&act=list"><i class="fa-solid fa-arrow-left-long mx-2"></i>Quay lại trang trước</a>
        </div>

        <div class="card">
          <div class="card-header">
            <strong class="card-title">Chi tiết đơn hàng</strong>
          </div>
          <?php
          if (empty($result)) {
          ?>
            <div class="d-flex justify-content-center align-items-center" style="height: 70vh;">
              <i class="fa-solid fa-cart-shopping" style="font-size: 50px;"></i>
            </div>
          <?php
          } else {
          ?>
            <div class="table-stats order-table ov-h">

              <table class="table">
                <thead>
                  <tr>
                    <th>Mã đơn hàng</th>
                    <th>Mã khách hàng</th>
                    <th>Mã sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Số lượng</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($result as $row) {
                  ?>
                    <tr>
                      <td>#<?php echo $row['ma_don_hang'] ?></td>
                      <td>
                        <spa>#<?php echo $row['ma_khach_hang'] ?></spa>
                      </td>
                      <td><span>#<?php echo $row['ma_san_pham'] ?></span></td>
                      <td><span><?php echo $row['ten'] ?></span></td>
                      <td>
                        <div class="round-img">
                          <a href="#">
                            <img src="<?php echo $row['hinh'] ?>" alt="" />
                          </a>
                        </div>
                      </td>
                      <td><span class=""><?php echo $row['so_luong'] ?></span></td>
                    </tr>
                  <?php }
                  ?>
                </tbody>
              </table>
            </div>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
  </div>
  <?php
  if (isset($_GET['status']) && $_GET['status'] == 0) {
  ?>
    <div class="text-center">

      <div class='btn btn-success  '><a href="index.php?page=order&act=add-product&madon=<?php echo  $code ?>" class="text-white">Thêm sản phẩm</a></div>

    </div>
  <?php
  }
  ?>
  <!-- .animated -->
</div>

<div class="clearfix"></div>
</div>