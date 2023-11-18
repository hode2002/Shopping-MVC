<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (isset($_POST["edit_sp"]) && $_POST["edit_sp"]) {
    $id = $_GET["id"];
    $ten = $_POST["ten"];
    $gia = $_POST["gia"];
    $hinhanh = $_POST["hinh_anh"];
    $slt = $_POST["so_luong_ton"];
    $sql1 = "CALL updateProduct('$id','$ten', '$gia', 'goat-2', '$slt', '$hinhanh')";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->execute();
?>
    <script>
      Swal.fire({
        icon: "success",
        title: "Sửa Sản Phẩm",
        text: "Thành công!",
      }).then(function() {
        window.location.href = 'index.php?page=products&act=list'
      });;
    </script>
<?php
  }
}
if (isset($_GET["act"]) && $_GET["act"] == 'edit'  && isset($_GET["id"])) {
  $id = $_GET["id"];
  $sql = "CALL getProductById($id);";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetch();
}

?>
<div class="content" style="min-height: 100vh;">
  <div class="animated fadeIn">
    <div class="row justify-content-center">
      <div class="col-9">
        <div class="card">
          <div class="card-header font-weight-bold" style="font-size: 24px">
            Sửa sản phẩm
          </div>
          <div class="card-body card-block">
            <form action="" method="post" class="form-horizontal">
              <div class="row form-group">
                <div class="col col-md-3">
                  <label for="ten" class="form-control-label">Tên sản phẩm</label>
                </div>
                <div class="col-12 col-md-9">
                  <input required type="text" autocomplete="off" id="ten" name="ten" placeholder="Tên" class="form-control" value="<?php echo $result['ten'] ?>" />
                </div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3">
                  <label for="gia" class="form-control-label"> Giá </label>
                </div>
                <div class="col-12 col-md-9">
                  <input required type="text" autocomplete="off" id="gia" name="gia" placeholder="Giá" class="form-control" value="<?php echo $result['gia'] ?>" />
                </div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3">
                  <label for="gia" class="form-control-label"> Link Ảnh </label>
                </div>
                <div class="col-12 col-md-9">
                  <input required type="text" autocomplete="off" id="hinh_anh" name="hinh_anh" placeholder="Nhập link" class="form-control" value="<?php echo $result['hinh'] ?>" />
                </div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3">
                  <label for="mo_ta" class="form-control-label"> Mô tả </label>
                </div>
                <div class="col-12 col-md-9">
                  <textarea name="mo_ta" id="mo_ta" rows="6" placeholder="Nội dung..." class="form-control"><?php echo $result['mo_ta'] ?></textarea>
                </div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3">
                  <label for="so_luong_ton" class="form-control-label">
                    Số lượng tồn
                  </label>
                </div>
                <div class="col-12 col-md-9">
                  <input required type="text" autocomplete="off" id="so_luong_ton" name="so_luong_ton" placeholder="Số lượng tồn kho" class="form-control" value="<?php echo $result['so_luong_ton'] ?>" />
                </div>
              </div>
              <input required type="submit" id="edit_sp" name="edit_sp" value="Sửa sản phẩm" class="form-control btn-success" style="cursor: pointer;" />
            </form>
          </div>
          <div class="card-footer text-right">
            <button type="reset" class="btn btn-danger btn-sm">
              <i class="fa fa-ban"></i> Reset
            </button>
            <button type="submit" class="btn btn-primary btn-sm">
              <i class="fa fa-dot-circle-o"></i> Submit
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- .animated -->
</div>

<div class="clearfix"></div>