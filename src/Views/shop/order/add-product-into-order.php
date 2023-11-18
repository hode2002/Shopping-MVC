<?php
if (isset($_GET["madon"])) {
  $madon = $_GET["madon"];
} else {
  $madon = "";
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (isset($_POST["add_product"]) && $_POST["add_product"]) {
    $id_sp = $_POST["id_sp"];
    $sl_sp = $_POST["sl_sp"];
    if ($id_sp == 'r') {
?>
      <script>
        Swal.fire({
          icon: "error",
          title: "Thất bại",
          text: "Chưa chọn sản phẩm!",
        }).then(function() {
          window.location.href = 'index.php?page=order&act=add-product&madon=<?php echo $madon ?>';
        })
      </script>
      <?php
    } else {
      $tmp = 0;
      $conn->beginTransaction();
      $sql_select = "SELECT so_luong_ton FROM san_pham WHERE ma_san_pham = '$id_sp'";
      $stmt_select = $conn->prepare($sql_select);
      $stmt_select->execute();
      $current_quantity = $stmt_select->fetchColumn();
      if (($current_quantity - $sl_sp) < 0) {
        $tmp = 1;
        $conn->rollBack();
      ?>
        <script>
          Swal.fire({
            icon: "error",
            title: "Không thể thêm sản phẩm",
            text: "Số lượng tồn kho không đủ",
          }).then(function() {
            window.location.href = 'index.php?page=order&act=add-product&madon=<?php echo $madon ?>';
          });
        </script>
        <?php
        exit;
      } else {
        // Cập nhật số lượng tồn kho
        $sql_update = "UPDATE san_pham SET so_luong_ton = so_luong_ton - '$sl_sp'  WHERE ma_san_pham = '$id_sp'";
        $stmt_update = $conn->prepare($sql_update);
        $new_quantity = $current_quantity + $sl_sp;
        $stmt_update->execute();
        $conn->commit();
      }

      if ($tmp == 0) {
        $sql = "SELECT insertProductToOrder('$madon','$id_sp','$sl_sp')";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        if ($stmt->fetch()[0] == 1 && $tmp == 0) {

        ?>
          <script>
            Swal.fire({
              icon: "success",
              title: "Thêm Đơn Hàng",
              text: "Thành công!",
            }).then(function() {
              window.location.href = 'index.php?page=order&act=list'
            });;
          </script>
<?php
        }
      }
    }
  }
}

?>

<main style="min-height: 100vh;">
  <div class="container pt-4">
    <form action="" method="post">
      <div class="row">
        <div class="col-12 px-4">
          <h1>Thêm sản phẩm cho đơn hàng</h1>
          <hr class="mt-1" />
        </div>
        <div class="col-12">
          <?php
          $sqli = "CALL getProducts()";
          $stmti = $conn->prepare($sqli);
          $stmti->execute();
          ?>
          <div class="row mx-4">
            <div class="col-sm-12">
              <div class="form-outline">
                <label class="form-label" for="form1">Mã sản phẩm</label>
                <select class="form-control order-form-input" aria-label="Default select example" for="form1" name="id_sp">
                  <option selected value="r">Chưa có sản phẩm được chọn</option>
                  <?php
                  while ($rowi = $stmti->fetch(PDO::FETCH_ASSOC)) {
                    if ($rowi['so_luong_ton'] != 0) {
                  ?>

                      <option value="<?php echo $rowi['ma_san_pham'] ?>"><?php echo $rowi['ten'] ?></option>
                  <?php }
                  } ?>

                </select>
              </div>
            </div>
          </div>

          <div class=" row mt-3 mx-4">
            <div class="col-12">
              <div class="form-outline datepicker" data-mdb-toggle-button="false">
                <label for="datepicker1" class="form-label">Số lượng</label>
                <input type="number" class="form-control order-form-input" id="datepicker1" data-mdb-toggle="datepicker" name="sl_sp" />
              </div>
            </div>
          </div>
          <div class="text-center">
            <input type="submit" class="btn btn-primary mx-auto mt-3" value="Thêm" name="add_product">

          </div>
        </div>
    </form>
  </div>
</main>