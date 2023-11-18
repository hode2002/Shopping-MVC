<?php
$sql = "CALL getAllOrders ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET["delete"])) {
  $id = $_GET["delete"];

  $sql = "DELETE FROM don_hang WHERE ma_don_hang = '$id'";
  $stmt = $conn->prepare($sql);
  $stmt->execute();

  $sql = "DELETE FROM chi_tiet_don_hang WHERE ma_don_hang = '$id'";
  $stmt = $conn->prepare($sql);
  $stmt->execute();

  $sql = "DELETE FROM van_chuyen WHERE ma_don_hang = '$id'";
  $stmt = $conn->prepare($sql);
  $stmt->execute();


?>
  <script>
    window.location.href = '/index.php?page=order&act=list';
  </script>
  <?php
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (isset($_POST["update-status"]) && $_POST["update-status"]) {
    if (isset($_POST["status"])) {
      $madonhang = $_POST["madonhang"];
      $status = $_POST["status"];
      $total = $_POST["tongtien"];
      $tmpo = 0;
      if ((int)$status === 3) {
        $sql = "SELECT ct.ma_san_pham, ct.so_luong
                FROM don_hang d JOIN chi_tiet_don_hang ct ON ct.ma_don_hang = d.ma_don_hang
                WHERE ct.ma_don_hang = '$madonhang' AND d.trang_thai <> 3";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as $item) {
          $sql = "UPDATE san_pham
                  SET so_luong_ton = so_luong_ton + ? 
                  WHERE ma_san_pham = ?";
          $stmt = $conn->prepare($sql);
          $stmt->execute([(int)$item['so_luong'], (int)$item['ma_san_pham']]);
        }
      }
      if (($status == 1 || $status == 2) && $total == 0) {
  ?>
        <script>
          Swal.fire({
            icon: "error",
            title: "Không có sản phẩm trong đơn",
            text: "Vui lòng thêm sản phẩm vào đơn",
          }).then(function() {
            window.location.href = 'index.php?page=order&act=detail&madon=<?php echo $madonhang ?>&status=0';
          });
        </script>
      <?php
        exit;
      }
      $sql = "UPDATE don_hang SET trang_thai = '$status' WHERE ma_don_hang = '$madonhang'";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      ?>
      <script>
        Swal.fire({
          icon: "success",
          title: "Thành công",
          text: "Cập nhật thành công",
        }).then(function() {
          window.location.href = 'index.php?page=order&act=list';
        });
      </script>
<?php
      exit;
    }
  }
}

if (isset($_POST["search"]) && $_POST["search"]) {
  $keyword = $_POST["keyword"];
  $sql = "SELECT * FROM don_hang WHERE ma_don_hang LIKE ? OR  ma_khach_hang LIKE ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute(["%$keyword%", "%$keyword%"]);
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if (empty($result)) {
    $result = 'Not Found';
  }
}

?>
<div class="content" style="height: 100vh;">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header d-flex align-items-center justify-content-between">
            <strong class="card-title">Danh sách đơn hàng</strong>
            <?php
            if ($result === 'Not Found') {
              echo '<a href="/index.php?page=order&act=list"><i class="fa-solid fa-rotate-right p-2"></i></a>';
            }
            ?>
          </div>
          <?php
          if (empty($result)) {
          ?>
            <div class="d-flex justify-content-center align-items-center" style="height: 70vh;">
              <i class="fa-solid fa-clipboard" style="font-size: 50px;"></i>
            </div>
            <?php
          } else {
            if ($result === 'Not Found') {
            ?>
              <div class="d-flex justify-content-center align-items-center flex-column" style="height: 70vh;">
                <img alt="" src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/assets/a60759ad1dabe909c46a817ecbf71878.png" class="shopee-search-empty-result-section__icon">
                <div class="">Không tìm thấy kết quả nào</div>
                <div class="">Hãy thử sử dụng các từ khóa chung chung hơn</div>
              </div>
            <?php
            } else {
            ?>
              <div class="d-flex align-items-center justify-content-between" style="padding: .75rem 1.25rem;">
                <form action="" method="post" class="d-flex align-items-center" style="gap: 8px;">
                  <input type="text" class="p-2 px-3" placeholder="Từ khóa tìm kiếm" name="keyword" autocomplete="off" autocomplete="off" id="keyword" style="border: 1px solid #ccc">
                  <input type="submit" name="search" class="btn text-white py-2" value="Tìm kiếm" style="background-color: #28a745;">
                </form>
                <a href="/index.php?page=order&act=list"><i class="fa-solid fa-rotate-right p-2"></i></a>
              </div>

              <div class="table-stats order-table ov-h">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Mã đơn hàng</th>
                      <th>Ngày đặt</th>
                      <th>Mã khách hàng</th>
                      <th>Tổng tiền</th>
                      <th>Trạng thái</th>
                      <th>Thao tác</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($result as $row) {
                    ?>
                      <tr class="item">
                        <td>#<?php echo $row['ma_don_hang'] ?></td>
                        <td>
                          <span><?php echo $row['ngay_dat'] ?></span>
                        </td>
                        <td><span>#<?php echo $row['ma_khach_hang'] ?></span></td>
                        <td><span class="count"><?php echo $row['tong_tien'] ?></span></td>
                        <td class="select-form">
                          <form class="d-flex" style="gap: 8px;" action="" method="post" class="mb-0">
                            <select class="select" style="min-width:120px; border: 1px solid #ccc; height: 39px; outline: none;" name="status" class="me-2 p-0 form-select form-select-sm" aria-label=".form-select-sm example">
                              <?php
                              $tmp1 = 0;
                              for ($i = 0; $i <= 3; $i++) {
                                if ($i == $row['trang_thai']) {
                              ?>
                                  <option value="<?php echo $row['trang_thai'] ?>" selected="selected"><span class="count">
                                      <?php if ($i == 0) {
                                        echo 'Chờ xác nhận';
                                      } elseif ($i == 1) {
                                        echo 'Đang giao';
                                      } elseif ($i == 2) {
                                        $tmp1 = 1;
                                        echo 'Đã giao';
                                      } else {
                                        echo 'Hủy';
                                      }  ?>
                                    </span>
                                  </option>
                                <?php } else {
                                ?>
                                  <option value="<?php echo $i ?>">
                                    <span class="count">
                                      <?php
                                      if ($i == 0) {
                                        echo 'Chờ xác nhận';
                                      } elseif ($i == 1) {
                                        echo 'Đang giao';
                                      } elseif ($i == 2) {
                                        echo 'Đã giao';
                                      } else {
                                        echo 'Hủy';
                                      } ?>
                                    </span>
                                  </option>
                              <?php
                                }
                              } ?>
                            </select>
                            <div>
                              <input type="hidden" name="madonhang" value="<?php echo $row['ma_don_hang'] ?>">
                              <input type="hidden" name="tongtien" value="<?php echo $row['tong_tien'] ?>">
                              <?php if ($tmp1 == 0) { ?>
                                <input class="btn text-white" style="background-color: #28a745;" type="submit" name="update-status" value="Cập nhật">
                              <?php } else {
                              } ?>
                            </div>
                          </form>
                        </td>
                        <td>
                          <a href="index.php?page=order&act=detail&madon=<?php echo $row['ma_don_hang'] ?>&status=<?= $row['trang_thai'] ?>" class="mx-2">
                            <i class="fa-regular fa-eye font-weight-bold" style="font-size: 24px"></i>
                          </a>
                          <?php if ($tmp1 == 0) { ?>
                            <a href="/index.php?page=order&act=list&delete=<?php echo $row['ma_don_hang'] ?>">
                              <i class="fa fa-trash font-weight-bold" style="font-size: 24px"></i>
                            </a>
                          <?php } else {
                          } ?>
                        </td>
                      </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
          <?php
            }
          }
          ?>
        </div>
        <?php
        if (isset($result) && $result !== 'Not Found') {
          echo '<div class="text-center">
                <div class="btn btn-success"><a href="index.php?page=order&act=add" class="text-white">Thêm đơn hàng</a></div>
              </div>';
        }
        ?>
      </div>
    </div>
  </div>
</div>

<div class="clearfix"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
  $(document).ready(function() {
    $('.item').each(function() {
      const selectTag = $(this).find('.select-form').find('.select');
      const status = selectTag.find(":selected").val();

      if (status != 0 && status != 3) {
        selectTag.find("option[value='3']").remove();
      }

      if (status == 2) {
        selectTag.find("option[value='0']").remove();
        selectTag.find("option[value='1']").remove();
        selectTag.find("option[value='3']").remove();
      }

      selectTag.on('change', function() {
        const status = $(this).find(":selected").val();

        $(this).find("option[selected]").removeAttr("selected");
        $(this).find(`option[value='${status}']`).attr('selected', true);

        if (status == 0) {
          $(this).find("option[value='3']").remove();

          $(this).append(`<option value="3">
                          Hủy                                   
                        </option>`)
        } else if (status == 1 || status == 2) {
          $(this).find("option[value='3']").remove();
        }
      })
    })
  });
</script>