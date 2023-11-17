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
    <div class="cart-empty-img" style="height: 10rem;"></div>
    <div class="row text-center justify-content-center">
        <p>Giỏ hàng của bạn còn trống</p>
        <a href="/" class="btn btn-buy-now btn-hover-dark col-4 col-md-2 fw-semibold text-white" style="background-color: rgb(209, 0, 36);  border: 1px solid rgb(209, 0, 36);">
            Mua ngay
        </a>
    </div>
</main>

<?php include_once VIEWS_DIR . "/partials/footer/index.php"; ?>