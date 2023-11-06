<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="180x180" href="/imgs/favicon/apple-touch-icon.png" />
    <link rel="icon" type="img/png" sizes="32x32" href="/imgs/favicon/favicon-32x32.png" />
    <link rel="icon" type="imgs/png" sizes="16x16" href="/imgs/favicon/favicon-16x16.png" />
    <link rel="manifest" href="/imgs/favicon/site.webmanifest" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <!-- Thư viện boxicons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <!-- /Thư viện boxicons -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

    <link rel="stylesheet" type="text/css" href="/css/style.css" />

    <title>Shopping Online</title>
</head>

<body>
    <!-- HEADER -->
    <header class="position-sticky top-0 start-0 end-0 z-3" style="border-bottom: 3px solid rgb(209, 0, 36); min-width: 400px">
        <!-- TOP HEADER -->
        <div class="py-3 d-none d-md-block" style="background-color: rgb(30, 31, 41)">
            <div class="container py-1">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <ul class="d-flex m-0" style="list-style-type: none">
                        <li class="me-3 fw-semibold" style="font-size: 14px">
                            <a href="#" class="text-decoration-none text-white">
                                <i class="fa-solid fa-phone text-white bg-transparent" style="color: rgb(209, 0, 36) !important"></i>
                                +012-34-56-78
                            </a>
                        </li>
                        <li class="me-3 fw-semibold" style="font-size: 14px">
                            <a href="/contact" class="text-decoration-none text-white">
                                <i class="fa-solid fa-envelope text-white bg-transparent" style="color: rgb(209, 0, 36) !important"></i>
                                email@email.com
                            </a>
                        </li>
                        <li class="me-3 fw-semibold" style="font-size: 14px">
                            <a href="#" class="text-decoration-none text-white">
                                <i class="fa-solid fa-location-dot text-white bg-transparent" style="color: rgb(209, 0, 36) !important"></i>
                                30/4 ĐH Cần Thơ
                            </a>
                        </li>
                    </ul>

                    <ul class="d-flex m-0 align-items-center" style="list-style-type: none">
                        <li class="me-3 fw-semibold" style="font-size: 14px">
                            <a href="#" class="text-decoration-none text-white">
                                Trở thành Người bán
                            </a>
                        </li>
                        <li class="ms-5 me-3 fw-semibold" style="font-size: 14px">
                            <a href="/pages/login/login.html" class="text-decoration-none text-white">
                                Đăng nhập
                            </a>
                        </li>
                        <li class="ms-5 me-3 fw-semibold" style="font-size: 14px">
                            <a href="/pages/register/register.html" class="text-decoration-none text-white">
                                Đăng ký
                            </a>
                        </li>
                        <li class="ms-5 me-3 fw-semibold">
                            <a href="/pages/account/profile.html" class="text-decoration-none text-white d-flex align-items-center gap-2">
                                <img src="/imgs/logos/3772487.jpg" class="rounded-circle" alt="" style="width: 1.375rem; height: 1.375rem" />
                                <p class="m-0">HVD</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /TOP HEADER -->

        <!-- MAIN HEADER -->
        <div class="py-3" style="background-color: rgb(21, 22, 29)">
            <div class="container">
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-3 mb-3 m-md-0">
                        <div class="text-center">
                            <a href="/">
                                <img class="img-fluid w-75" src="/imgs/logos/shopping-online.png" alt="" />
                            </a>
                        </div>
                    </div>
                    <!-- /LOGO -->

                    <!-- SEARCH BAR -->
                    <div class="col-md-6">
                        <div class="h-100 w-100 d-flex flex-column justify-content-center position-relative">
                            <form id="search-form" class="d-flex w-100">
                                <input class="search input py-2 px-4 w-100 rounded-start-5 border-0" placeholder="Tìm kiếm" />
                                <div class="btn text-white fw-bold py-2 px-4 rounded-start-0 rounded-end-5 border-0" style="background-color: rgb(209, 0, 36)">
                                    Search
                                </div>
                            </form>

                            <!-- HISTORY -->
                            <div class="history position-absolute top-100 rounded-2 z-2" style="
                    background-color: rgb(21, 22, 29);
                    width: 85%;
                    display: none;
                  ">
                                <ul class="history-list p-0" style="list-style-type: none">
                                    <li class="d-flex align-items-center justify-content-around">
                                        <a href="#" class="py-1 ps-2 d-block text-decoration-none text-white text-truncate" style="width: 90%">
                                            Bàn phím giả cơ
                                        </a>
                                        <span class="close-btn text-white p-1">
                                            <i class="fa-solid fa-xmark"></i>
                                        </span>
                                    </li>
                                    <li class="d-flex justify-content-around">
                                        <a href="#" class="py-1 ps-2 d-block text-decoration-none text-white" style="width: 90%">
                                            Đồng hồ
                                        </a>
                                        <span class="close-btn text-white p-1">
                                            <i class="fa-solid fa-xmark"></i>
                                        </span>
                                    </li>
                                    <li class="d-flex justify-content-around">
                                        <a href="#" class="py-1 ps-2 d-block text-decoration-none text-white" style="width: 90%">
                                            iphone 15 promax 512gb
                                        </a>
                                        <span class="close-btn text-white p-1">
                                            <i class="fa-solid fa-xmark"></i>
                                        </span>
                                    </li>
                                    <li class="d-flex justify-content-around">
                                        <a href="#" class="py-1 ps-2 d-block text-decoration-none text-white" style="width: 90%">
                                            laptop
                                        </a>
                                        <span class="close-btn text-white p-1">
                                            <i class="fa-solid fa-xmark"></i>
                                        </span>
                                    </li>
                                    <li class="d-flex justify-content-around">
                                        <a href="#" class="py-1 ps-2 d-block text-decoration-none text-white" style="width: 90%">
                                            Giày thể thao nam
                                        </a>
                                        <span class="close-btn text-white p-1">
                                            <i class="fa-solid fa-xmark"></i>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                            <!-- /HISTORY -->
                        </div>
                    </div>
                    <!-- /SEARCH BAR -->

                    <!-- ACCOUNT -->
                    <div class="col-md-3 mt-4 mt-md-0">
                        <!-- Cart -->
                        <div class="cart h-100 d-flex justify-content-around align-items-center">
                            <a href="/cart" class="text-white position-relative" style="color: white !important;">
                                <i class="fa fa-shopping-cart text-center fs-2"></i>
                                <span class="position-absolute rounded-circle text-center" style="
                      width: 25px;
                      height: 25px;
                      top: -10px;
                      right: -10px;
                      background-color: rgb(209, 0, 36);
                    ">
                                    3
                                </span>

                                <!-- Cart List -->
                                <div class="cart-list d-none position-absolute bg-white border rounded-3" style="
                      inset: 50px auto auto -450px;
                      width: 500px;
                      z-index: 100;
                    ">
                                    <div class="overflow-x-hidden overflow-y-scroll rounded" style="max-height: 50vh">
                                        <div class="product card flex-row border-0">
                                            <img src="/imgs/products/96a5c0f3ecefb25751ed5d7668cedee8_tn.jpg" class="w-25" alt="..." />
                                            <div class="card-body container">
                                                <div class="row">
                                                    <p class="card-text col-8 text-truncate">
                                                        Bàn phím giả cơ gaming kèm chuột có dây chế độ led
                                                        7 màu tiện lợi dành cho máy tính,game thủ,văn
                                                        phòng.
                                                    </p>
                                                    <div class="d-flex align-items-center gap-1">
                                                        <p class="fs-5 fw-bold" style="color: rgb(209, 0, 36)">
                                                            ₫125.000
                                                        </p>
                                                        <p style="color: rgb(209, 0, 36)">x 2</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="product card flex-row border-0">
                                            <img src="/imgs/products/96a5c0f3ecefb25751ed5d7668cedee8_tn.jpg" class="w-25" alt="..." />
                                            <div class="card-body container">
                                                <div class="row">
                                                    <p class="card-text col-8 text-truncate">
                                                        Bàn phím giả cơ gaming kèm chuột có dây chế độ led
                                                        7 màu tiện lợi dành cho máy tính,game thủ,văn
                                                        phòng.
                                                    </p>
                                                    <div class="d-flex align-items-center gap-1">
                                                        <p class="fs-5 fw-bold" style="color: rgb(209, 0, 36)">
                                                            ₫125.000
                                                        </p>
                                                        <p style="color: rgb(209, 0, 36)">x 2</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="product card flex-row border-0">
                                            <img src="/imgs/products/96a5c0f3ecefb25751ed5d7668cedee8_tn.jpg" class="w-25" alt="..." />
                                            <div class="card-body container">
                                                <div class="row">
                                                    <p class="card-text col-8 text-truncate">
                                                        Bàn phím giả cơ gaming kèm chuột có dây chế độ led
                                                        7 màu tiện lợi dành cho máy tính,game thủ,văn
                                                        phòng.
                                                    </p>
                                                    <div class="d-flex align-items-center gap-1">
                                                        <p class="fs-5 fw-bold" style="color: rgb(209, 0, 36)">
                                                            ₫125.000
                                                        </p>
                                                        <p style="color: rgb(209, 0, 36)">x 2</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="product card flex-row border-0">
                                            <img src="/imgs/products/96a5c0f3ecefb25751ed5d7668cedee8_tn.jpg" class="w-25" alt="..." />
                                            <div class="card-body container">
                                                <div class="row">
                                                    <p class="card-text col-8 text-truncate">
                                                        Bàn phím giả cơ gaming kèm chuột có dây chế độ led
                                                        7 màu tiện lợi dành cho máy tính,game thủ,văn
                                                        phòng.
                                                    </p>
                                                    <div class="d-flex align-items-center gap-1">
                                                        <p class="fs-5 fw-bold" style="color: rgb(209, 0, 36)">
                                                            ₫125.000
                                                        </p>
                                                        <p style="color: rgb(209, 0, 36)">x 2</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="product card flex-row border-0">
                                            <img src="/imgs/products/96a5c0f3ecefb25751ed5d7668cedee8_tn.jpg" class="w-25" alt="..." />
                                            <div class="card-body container">
                                                <div class="row">
                                                    <p class="card-text col-8 text-truncate">
                                                        Bàn phím giả cơ gaming kèm chuột có dây chế độ led
                                                        7 màu tiện lợi dành cho máy tính,game thủ,văn
                                                        phòng.
                                                    </p>
                                                    <div class="d-flex align-items-center gap-1">
                                                        <p class="fs-5 fw-bold" style="color: rgb(209, 0, 36)">
                                                            ₫125.000
                                                        </p>
                                                        <p style="color: rgb(209, 0, 36)">x 2</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pt-4 pb-3 text-end">
                                        <button class="btn text-white py-2 px-3 me-3" style="background-color: rgb(209, 0, 36)">
                                            Xem giỏ hàng
                                        </button>
                                    </div>
                                </div>
                                <!-- /Cart List -->
                            </a>

                            <div class="dropdown d-block d-md-none">
                                <button class="btn dropdown-toggle text-white fs-4" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-bars"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item text-white py-2" href="#">Tài khoản</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-white py-2" href="#">Đăng xuất</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /Cart -->
                    </div>
                    <!-- /ACCOUNT -->
                </div>
            </div>
        </div>
        <!-- /MAIN HEADER -->
    </header>
    <!-- /HEADER -->