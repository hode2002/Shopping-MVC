<?php include_once VIEWS_DIR . "/partials/header/index.php" ?>

<main style="background-color: #f5f5f5" class="p-5 rounded">
    <div class="container rounded">
        <div style="background-color: #ffffff">
            <div class="row fw-semibold fs-4 border-bottom p-2 text-center m-0" style="width: 100%">
                <h1 style="width: 100%">Sản Phẩm</h1>
            </div>
            <div class="filter-sort__title p-3 fs-4 pb-1" style="color: #4a4a4a">
                Sắp xếp theo
            </div>
            <div class="filter-sort__list-filter d-flex p-3">
                <a class="btn-filter button__sort d-flex align-items-center text-decoration-none" style="
                border: 1px solid #e5e7eb;
                padding: 5px 10px;
                margin: 0 10px 10px 0;
                white-space: nowrap;
                cursor: pointer;
                color: #444;
                border-radius: 10px;
                background-color: #f3f4f6;
              ">
                    <div class="icon px-1">
                        <i class="bx bxs-discount"></i>
                    </div>
                    Giá Cao - Thấp
                </a><a class="btn-filter button__sort d-flex align-items-center text-decoration-none" style="
                border: 1px solid #e5e7eb;
                padding: 5px 10px;
                margin: 0 10px 10px 0;
                white-space: nowrap;
                cursor: pointer;
                color: #444;
                border-radius: 10px;
                background-color: #f3f4f6;
              ">
                    <div class="icon">
                        <svg height="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"></svg>
                    </div>
                    Giá Thấp - Cao
                </a><a class="btn-filter button__sort d-flex align-items-center text-decoration-none" style="
                border: 1px solid #e5e7eb;
                padding: 5px 10px;
                margin: 0 10px 10px 0;
                white-space: nowrap;
                cursor: pointer;
                color: #444;
                border-radius: 10px;
                background-color: #f3f4f6;
              ">
                    <div class="icon">
                        <svg height="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"></svg>
                    </div>
                    Khuyến Mãi Hot
                </a><a class="btn-filter button__sort active d-flex align-items-center text-decoration-none" style="
                border: 1px solid #e5e7eb;
                padding: 5px 10px;
                margin: 0 10px 10px 0;
                white-space: nowrap;
                cursor: pointer;
                color: #444;
                border-radius: 10px;
                background-color: #f3f4f6;
              ">
                    <div class="icon">
                        <svg height="15" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"></svg>
                    </div>
                    Xem nhiều
                </a>
            </div>

            <div class="row p-3">
                <!-- <?php foreach ($products as $product) : ?> -->
                <a href="/product/<?= htmlspecialchars($product['id']) ?>" class="text-decoration-none text-dark product d-flex justify-content-center col-6 col-md-4 col-lg-2 py-2" data-product_id="<?= htmlspecialchars($product['id']) ?>">
                    <div class="card" style="width: 11rem">
                        <div class="logo-cart">
                            <div class="discount-card pe-1 ps-1">
                                <span><?= htmlspecialchars($product['sale']) ?>%</span>
                                <span>Giảm</span>
                            </div>
                        </div>
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
                <!-- <?php endforeach ?> -->
            </div>

            <a href="#" class="btn col-4 offset-4 btn-primary py-1 border-1 my-5 text-decoration-none text-black fs-6 border-0 text-white" style="background-color: rgb(30, 31, 41)">
                Xem thêm
            </a>
        </div>
    </div>
</main>

<?php include_once VIEWS_DIR . "/partials/footer/index.php" ?>