<?php include_once VIEWS_DIR . "/partials/header/index.php" ?>

<ul class="collapse multi-collapse d-md-none" id="dropdown-menu" style="
        background-color: #15161d;
        text-decoration: none;
        list-style: none;
        padding-left: 0px;
      ">
  <li>
    <a class="dropdown-item text-white py-2 ps-4" href="#">Tài khoản</a>
  </li>
  <li>
    <a class="dropdown-item text-white py-2 ps-4" href="#">Đăng xuất</a>
  </li>
</ul>

<main id="home" style="background-color: #f5f5f5; min-height: 100vh">
  <!-- SLIDE BAR -->
  <div style="background-color: #ffffff" class="pb-3 mb-3">
    <div class="container">
      <div class="row mt-3 mb-3 p-0">
        <!-- LEFT -->
        <div class="col-sm-12 col-md-8 p-1">
          <div class="banner carousel container text-center p-0 h-100">
            <div class="carousel-inner h-100 d-flex overflow-hidden">
              <img alt="First slide" src="https://cf.shopee.vn/file/vn-50009109-84b6dbb942b411b06e260b2534a52ab1_xxhdpi" class="d-block img-fluid" />
              <img alt="Second slide" src="https://cf.shopee.vn/file/vn-50009109-eefba2922ef040c46d036932a0dd2e46_xxhdpi" class="d-block img-fluid" />
              <img alt="Third slide" src="https://cf.shopee.vn/file/vn-50009109-ec79ec7ff8c16835be817c9231303e2e_xxhdpi" class="d-block img-fluid" />
            </div>
          </div>
        </div>
        <!-- /LEFT -->

        <!-- RIGHT -->
        <div class="img-bar col-md-4 d-flex align-items-center d-none d-md-block">
          <div class="row h-100 p-1">
            <div class="d-flex overflow-hidden banner-right-top">
              <a href="#" class="col-6 d-block">
                <img src="https://cf.shopee.vn/file/vn-50009109-4988b1d7e837aa158abecceab54ad7aa_xhdpi" class="d-block img-fluid" />
              </a>
              <a href="#" class="col-6 d-block">
                <img src="https://cf.shopee.vn/file/vn-50009109-ac73ded4ff2a273dee3d344b2fc326d4_xhdpi" class="d-block img-fluid" />
              </a>
            </div>

            <div class="d-flex overflow-hidden banner-right-bottom align-self-end">
              <a href="#" class="col-6 d-block">
                <img src="https://cf.shopee.vn/file/vn-50009109-33c16a4397dd8fb1f63f4a75f793a8d7_xhdpi" class="d-block img-fluid" />
              </a>
              <a href="#" class="col-6 d-block">
                <img src="https://cf.shopee.vn/file/vn-50009109-0a3205a391f00a39dc4537d8c943329a_xhdpi" class="d-block img-fluid" />
              </a>
            </div>
          </div>
        </div>
        <!-- /RIGHT -->
      </div>
    </div>
  </div>
  <!-- /SLIDE BAR -->

  <!-- CATEGORY SLICK SLIDE -->
  <div class="container" style="background-color: #ffffff">
    <div class="row fw-semibold fs-2 border-bottom p-2">
      <div>DANH MỤC</div>
    </div>
    <div class="image-slider d-flex overflow-hidden">
      <?php foreach ($categories as $cate) : ?>
        <div class="image-item py-3 col-sm-4 col-md-2">
          <a href="/category?id-cate=<?= htmlspecialchars($cate['id']) ?>" class="text-decoration-none">
            <div class="justify-content-center text-center">
              <img src="<?= htmlspecialchars($cate['img']) ?>" alt="" style="object-fit: cover" width="100%" />
            </div>
            <div class="text-center fw-semibold text-dark"><?= htmlspecialchars($cate['name']) ?></div>
          </a>
        </div>
      <?php endforeach ?>

    </div>
  </div>
  <!-- /CATEGORY SLICK SLIDE -->

  <!-- FLASH SALE -->
  <div class="container mt-4" style="background-color: #ffffff">
    <div class="d-flex justify-content-between fw-semibold fs-4 border-bottom p-2 text-start position-sticky start-0 end-0 top-0">
      <div class="p-2 d-flex gap-3">
        <img src="/imgs/logos/flash_sale.png" alt="flash sale" class="align-self-center" style="height: 1.68rem" />
        <div class="countdown-timer">00:00:00</div>
      </div>
      <a href="#" class="text-decoration-none text-black fs-6 align-self-center">Xem
        tất cả
        ></a>
    </div>
    <!-- PRODUCTs -->
    <div class="products_slide row p-4">
      <?php foreach ($proSales as $product) : ?>
        <a href="/product/<?= htmlspecialchars($product['id']) ?>" class="mb-5 text-decoration-none text-dark product d-flex justify-content-center col-md-2 py-2" data-product_id="<?= htmlspecialchars($product['id']) ?>">
          <div class="card" style="width: 11rem">
            <div class="logo-cart">
              <div class="discount-card pe-1 ps-1">
                <span><?= htmlspecialchars($product['sale']) ?> %</span>
                <span>Giảm</span>
              </div>
            </div>
            <img src="<?= htmlspecialchars($product['thumbnail']) ?>" class="card-img-top p-2" alt="product" />
            <div class="card-body p-2">
              <h5 class="name card-title text-truncate" style="font-size: 11px">
                <?= htmlspecialchars($product['name']) ?>
              </h5>
              <p class="origin-price card-text text-start m-0 text-dark opacity-75 text-decoration-line-through">
                <?= format_money(htmlspecialchars($product['price'])) ?>
              </p>
              <p class="price card-text text-start m-0 fw-bold" style="color: rgb(209, 0, 36)">
                <?= format_money(htmlspecialchars((int)$product['price'] - (int)$product['price'] * (int)$product['sale'] / 100)) ?>
              </p>
            </div>
            <div class="star p-2 pt-0">
              <i class="bx bxs-star"></i><i class="bx bxs-star"></i><i class="bx bxs-star"></i><i class="bx bxs-star"></i><i class="bx bx-star"></i>
            </div>
            <div class="add_to_cart text-center top-100 start-0 end-0 position-absolute d-none w-100 rounded-bottom-1 add-cart-product" style="
                    background-color: rgb(209, 0, 36);
                    border: 1px solid rgb(209, 0, 36);
                  ">
              <div class="add-to-cart btn text-white border-0">Thêm vào giỏ</div>
            </div>
          </div>
        </a>
      <?php endforeach ?>
    </div>
    <!-- /PRODUCTs -->
  </div>
  <!-- /FLASH SALE -->

  <!-- HOT SEARCH -->
  <div class="container mt-4" style="background-color: #ffffff">
    <div class="d-flex justify-content-between fw-semibold fs-4 border-bottom p-2 text-start position-sticky start-0 end-0 top-0">
      <div class="">TÌM KIẾM HÀNG ĐẦU</div>
      <a href="#" class="text-decoration-none text-black fs-6 align-self-center">Xem
        tất cả
        ></a>
    </div>
    <!-- PRODUCTs -->
    <div class="products_slide row p-4" style="min-height: 350px;">
      <?php foreach ($products as $product) : ?>
        <a href="/product/<?= htmlspecialchars($product['id']) ?>" class="mb-5 text-decoration-none text-dark product d-flex justify-content-center col-md-2 py-2" data-product_id="<?= htmlspecialchars($product['id']) ?>">
          <div class="card" style="width: 11rem">
            <div class="logo-cart">
              <div class="discount-card pe-1 ps-1">
                <span><?= htmlspecialchars($product['sale']) ?> %</span>
                <span>Giảm</span>
              </div>
            </div>
            <img src="<?= htmlspecialchars($product['thumbnail']) ?>" class="card-img-top p-2" alt="product" />
            <div class="card-body p-2">
              <h5 class="name card-title text-truncate z-n1" style="font-size: 11px">
                <?= htmlspecialchars($product['name']) ?>
              </h5>
              <p class="origin-price card-text text-start m-0 text-dark opacity-75 text-decoration-line-through">
                <?= format_money(htmlspecialchars($product['price'])) ?>
              </p>
              <p class="price card-text text-start m-0 fw-bold" style="color: rgb(209, 0, 36)">
                <?= format_money(htmlspecialchars((int)$product['price'] - (int)$product['price'] * (int)$product['sale'] / 100)) ?>
              </p>
            </div>
            <div class="star p-2 pt-0">
              <i class="bx bxs-star"></i><i class="bx bxs-star"></i><i class="bx bxs-star"></i><i class="bx bxs-star"></i><i class="bx bx-star"></i>
            </div>
            <div class="add_to_cart text-center top-100 start-0 end-0 position-absolute d-none w-100 rounded-bottom-1 add-cart-product" style="
                    background-color: rgb(209, 0, 36);
                    border: 1px solid rgb(209, 0, 36);
                  ">
              <div class="add-to-cart btn text-white border-0">Thêm vào giỏ</div>
            </div>
          </div>
        </a>
      <?php endforeach ?>
    </div>
    <!-- /PRODUCTs -->
  </div>
  <!-- /HOT SEARCH -->

  <!-- RECOMMEND -->
  <div class="container mt-4" style="background-color: #ffffff">
    <div class="row fw-semibold fs-4 border-bottom p-2 text-center position-sticky start-0 end-0 top-0">
      <div class="">GỢI Ý HÔM NAY</div>
    </div>
    <!-- PRODUCTs -->
    <div class="row p-3">
      <?php foreach ($recommends as $product) : ?>
        <a href="/product/<?= htmlspecialchars($product['id']) ?>" class="text-decoration-none text-dark product d-flex justify-content-center col-6 col-md-4 col-lg-2 py-2" data-product_id="<?= htmlspecialchars($product['id']) ?>">
          <div class="card" style="width: 11rem">
            <img src="<?= htmlspecialchars($product['thumbnail']) ?>" class="card-img-top p-2" alt="product" />
            <div class="card-body p-2">
              <h5 class="name card-title text-truncate" style="font-size: 11px">
                <?= htmlspecialchars($product['name']) ?>
              </h5>
              <p class="origin-price card-text text-start m-0 text-dark opacity-75 text-center text-decoration-line-through">
                <?= format_money(htmlspecialchars($product['price'])) ?>
              </p>
              <p class="price card-text text-start m-0 text-center fw-bold" style="color: rgb(209, 0, 36)">
                <?= format_money(htmlspecialchars((int)$product['price'] - (int)$product['price'] * (int)$product['sale'] / 100)) ?>
              </p>
              <div class="add_to_cart text-center top-100 start-0 end-0 position-absolute d-none w-100 rounded-bottom-1 add-cart-product" style="
                    background-color: rgb(209, 0, 36);
                    border: 1px solid rgb(209, 0, 36);
                  ">
                <div class="add-to-cart btn text-white border-0">Thêm vào giỏ</div>
              </div>
            </div>
          </div>
        </a>
      <?php endforeach ?>
    </div>
    <a href="#" class="btn col-4 offset-4 btn-primary py-1 border-1 my-5 text-decoration-none text-black fs-6 border-0 text-white" style="background-color: rgb(30, 31, 41)">
      Xem thêm
    </a>
    <!-- /PRODUCTs -->
  </div>
  <!-- /RECOMMEND -->
</main>

<?php include_once VIEWS_DIR . "/partials/footer/index.php" ?>