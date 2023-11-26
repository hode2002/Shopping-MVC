<?php include_once VIEWS_DIR . "/partials/header/index.php"; ?>

<style>
    body {
        background: #f5f5f5;
    }

    .cart-empty-img {
        background: url('/imgs/cart/empty-cart.png') center no-repeat;
        background-size: 150px;
    }

    .btn-buy-now:hover {
        background-color: rgb(30, 31, 41) !important;
        color: white !important;
    }
</style>

<main class="container d-flex flex-column justify-content-center overflow-hidden" style="min-height: 70vh;">
    <div class="cart-empty-img" style="height: 40vh;"></div>
    <div class="row text-center justify-content-center">
        <p>Giỏ hàng của bạn còn trống</p>
        <a href="/" class="btn btn-buy-now btn-hover-dark col-4 col-md-2 fw-semibold text-white" style="background-color: rgb(209, 0, 36);  border: 1px solid rgb(209, 0, 36);">
            Mua ngay
        </a>
    </div>

    <!-- CÓ THỂ BẠN CŨNG THÍCH -->
    <div class="mt-5 fs-4">CÓ THỂ BẠN CŨNG THÍCH</div>

    <div class="row pb-5 pt-2 mb-5">
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
    <!-- CÓ THỂ BẠN CŨNG THÍCH -->
</main>

<?php include_once VIEWS_DIR . "/partials/footer/index.php"; ?>