<?php include_once VIEWS_DIR . "/shop/partials/header/index.php" ?>

<?php var_dump($products) ?>

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
                  <th class="avatar">Hình ảnh</th>
                  <th>Mã</th>
                  <th>Tên</th>
                  <th>Giá</th>
                  <th>Số lượng tồn</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody id="t_body">
                <tr>
                  <td>
                    <div class="round-img">
                      <a href="#">
                        <img src="13412341234" alt="" />
                      </a>
                    </div>
                  </td>
                  <td>13412341234</td>
                  <td>
                    <span class="name">13412341234</span>
                  </td>
                  <td><span class="price">13412341234</span></td>
                  <td><span class="count">13412341234</span></td>

                  <td>
                    <a href="index.php?page=products&act=edit&id=13412341234">
                      <i class="fa-solid fa-pen-to-square" style="font-size: 24px"></i>
                    </a>&nbsp;
                    <a href="#">
                      <i class=" fa fa-trash font-weight-bold" style="font-size: 24px"></i>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="clearfix"></div>

<?php include_once VIEWS_DIR . "/shop/partials/footer/index.php" ?>