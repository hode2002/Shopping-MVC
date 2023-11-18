<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (isset($_POST["add_order"]) && $_POST["add_order"]) {
    $id_kh = $_POST["id_kh"];
    if ($id_kh == 'r') {
?>
      <script>
        Swal.fire({
          icon: "error",
          title: "Thất bại",
          text: "Thiếu mã khách hàng!",
        }).then(function() {
          window.location.href = 'index.php?page=order&act=add'
        })
      </script>
    <?php
      exit;
    }
    // $diachi_kh = $_POST["diachi_kh"];
    // $tongtien = 0;
    $sql = "SELECT createOrder('$id_kh')";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    if ($stmt->fetch()[0] == 1) {
    ?>
      <script>
        Swal.fire({
          icon: "success",
          title: "Thêm Đơn Hàng",
          text: "Thành công!",
        }).then(function() {
          window.location.href = 'index.php?page=order&act=list'
        })
      </script>
    <?php
    } else {
    ?>
      <script>
        Swal.fire({
          icon: "error",
          title: "Không thêm được Đơn Hàng",
          text: "Thành công!",
        });
      </script>
<?php
    }
  }
}

?>

<main style="min-height: 100vh;">
  <div class="container pt-4">
    <form action="" method="post">
      <div class="row">
        <div class="col-12 px-4">
          <h1>Thêm đơn hàng</h1>
          <hr class="mt-1" />
        </div>
        <?php
        $sqli = "SELECT * FROM khach_hang";
        $stmti = $conn->prepare($sqli);
        $stmti->execute();
        ?>
        <div class="col-12">
          <div class="row mx-4">
            <div class="col-sm-12">
              <div class="form-outline">
                <label class="form-label" for="form1">Mã khách hàng</label>
                <!-- <input type="text" id="form1" class="form-control order-form-input" name="id_kh" /> -->
                <select class="form-control order-form-input" aria-label="Default select example" name="id_kh" id="id_kh">
                  <?php
                  if ($stmti->rowCount() > 0) { ?>
                    <option selected value="r">Vùi lòng chọn khách hàng</option>
                  <?php } else { ?>
                    <option selected value="r">Không có khách hàng</option>
                  <?php
                  } ?>

                  <?php
                  while ($rowi = $stmti->fetch(PDO::FETCH_ASSOC)) {
                    if ($rowi['VaiTro'] != 1) {
                  ?>

                      <option value="<?php echo $rowi['ma_khach_hang'] ?>"><?php echo $rowi['ten'] ?> - <?php echo $rowi['ma_khach_hang'] ?> </option>
                  <?php }
                  } ?>
                </select>
              </div>
            </div>
          </div>
          <!--<div class="row mt-3 mx-4">
            <div class="col-12">
              <div class="form-outline">
                <label class="form-label" for="form5">Địa chỉ</label>
                <input type="text" id="form5" class="form-control order-form-input" name="diachi_kh" />
              </div>
            </div>
          </div> -->
        </div>
      </div>
      <div class="d-flex justify-content-center">
        <input type="submit" class="btn btn-primary mt-4 text-center border-0" value="Thêm" name="add_order" style="min-width: 120px; background-color: #28a745;">
      </div>
    </form>
  </div>
</main>