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

    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="/css/style.css" />

    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js" integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript" src="/js/app.js"></script>

    <style>
        .dropdown-menu {
            z-index: 100;
        }

        .dropdown-item {
            color: white !important;
        }

        .dropdown-item:hover {
            color: rgb(209, 0, 36) !important;
        }

        .cart .cart-list .product:hover {
            color: rgb(209, 0, 36) !important;
            box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
        }

        header a:hover {
            color: rgb(209, 0, 36) !important;
        }
    </style>

    <script>
        $(() => {
            $.ajax({
                url: '/history-search',
                type: 'GET',
                success: function(res) {
                    data = JSON.parse(res);
                    let html = '';
                    data.forEach((item) => {
                        html += `
                            <li class="d-flex search-item align-items-center justify-content-around" data-id="${item.id}">
                                <a href="/search?keyword=${item.content}" class="py-1 ps-2 d-block text-decoration-none text-white text-truncate" style="width: 90%">
                                    ${item.content}
                                </a>
                                <span class="close-btn delete-btn text-white p-1">
                                    <i class="fa-solid fa-xmark"></i>
                                </span>
                            </li>
                        `;
                    })

                    $('header .history-list').html(html);
                },
            })

            $('header .btn-search').on('click', function() {
                const keyword = $('header .keyword').val();

                $.ajax({
                    url: '/history-search',
                    type: 'POST',
                    data: {
                        content: keyword,
                    }
                })

                window.location.href = `/search?keyword=${keyword}`;
            })

            $(document).on('click', '.delete-btn', function() {
                const id = $(this).closest('.search-item')[0].dataset.id;
                $.ajax({
                    url: '/history-search/delete/' + id,
                    type: 'POST',
                })
                $(this).closest('.search-item').remove();
            })

            $('.open-shop').on('click', function() {
                $.ajax({
                    url: '/shop',
                    type: 'POST',
                    success: function(res) {
                        res = JSON.parse(res);

                        Swal.fire({
                            title: `${res["error"] ? 'Lỗi' : 'Thành công'}`,
                            text: res["message"],
                            icon: `${res["error"] ? 'error' : 'success'}`,
                            confirmButtonText: 'Ok',
                            customClass: {
                                confirmButton: `${res["error"] ? 'bg-danger' : 'bg-success'}`,
                            },
                        }).then(() => {
                            if (!res['error']) {
                                window.location.href = '/shop';
                            }
                        })
                    },
                })
            })
        })
    </script>

    <title><?= $title ?? 'Shopping Online' ?></title>
</head>

<body>
    <!-- HEADER -->
    <header class="position-sticky top-0 start-0 end-0 z-3" style="border-bottom: 3px solid rgb(209, 0, 36); min-width: 400px">
        <!-- TOP HEADER -->
        <div class="py-3 d-none d-md-block" style="background-color: rgb(30, 31, 41)">
            <div class="container py-1">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <!-- LEFT -->
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
                    <!-- /LEFT -->

                    <!-- RIGHT -->
                    <ul class="d-flex m-0 align-items-center" style="list-style-type: none">
                        <?php
                        if (empty($_SESSION['email'])) {
                            echo '<li class="ms-5 me-3 fw-semibold" style="font-size: 14px">
                                   <a href="/login" class="text-decoration-none text-white">
                                       Đăng nhập
                                   </a>
                               </li>
                               <li class="ms-5 me-3 fw-semibold" style="font-size: 14px">
                                   <a href="/register" class="text-decoration-none text-white">
                                       Đăng ký
                                   </a>
                               </li>';
                        } else {
                        ?>
                            <?php
                            if ($_SESSION['role'] === "R1") {
                                echo '<li class="me-3 fw-semibold" style="font-size: 14px">
                                        <a href="#" class="open-shop text-decoration-none text-white">
                                            Trở thành người bán
                                        </a>
                                    </li>';
                            } else {
                                echo '<li class="me-3 fw-semibold" style="font-size: 14px">
                                        <a href="/shop" class="text-decoration-none text-white">
                                           Quản lí cửa hàng
                                        </a>
                                    </li>';
                            }

                            ?>
                            <li id="dropdown" class="dropdown">
                                <button class="btn dropdown-toggle d-flex align-items-center" type="button" style="box-shadow: none;" data-bs-toggle="dropdown" aria-expanded="false">
                                    <a href="/profile" class="preview-img text-decoration-none text-white d-flex align-items-center gap-2">
                                        <img src="<?= $user['avatar'] ?>" class="rounded-circle" alt="" style="width: 1.375rem; height: 1.375rem" />
                                        <p class="m-0 fw-bold text-capitalize"><?= htmlspecialchars(explode('@', $_SESSION['email'])[0]) ?></p>
                                    </a>
                                </button>
                                <ul id="dropdown-menu" class="dropdown-menu text-white">
                                    <li><a class="dropdown-item" href="/profile">Tài khoản</a></li>
                                    <li><a class="dropdown-item" href="/purchase">Đơn mua</a></li>
                                    <?= (isset($_SESSION['role']) && ((int) $_SESSION['role'] === 'R3'))
                                        ? '<li><a class="dropdown-item" href="/admin">Trang quản trị</a></li>'
                                        : '';
                                    ?>
                                    <form id="logout_form" action="/logout" method="post" class="d-flex flex-column">
                                        <button class="dropdown-item" type="submit">
                                            <i class="fas fa-sign-in-alt"></i>
                                            Đăng Xuất
                                        </button>
                                    </form>
                                </ul>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                    <!-- /RIGHT -->

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
                            <div id="search-form" class="d-flex w-100">
                                <input autocomplete="off" class="search input py-2 px-4 w-100 rounded-start-5 border-0 keyword" name="keyword" placeholder="Tìm kiếm" />
                                <div class="btn btn-search text-white fw-bold py-2 px-4 rounded-start-0 rounded-end-5 border-0 d-flex align-items-center" style="background-color: rgb(209, 0, 36)">
                                    Search
                                </div>
                            </div>

                            <!-- HISTORY -->
                            <div class="history position-absolute top-100 rounded-2 z-2" style="
                    background-color: rgb(21, 22, 29);
                    width: 85%;
                    display: none;
                  ">
                                <ul class="history-list p-0" style="list-style-type: none"></ul>
                            </div>
                            <!-- /HISTORY -->
                        </div>
                    </div>
                    <!-- /SEARCH BAR -->

                    <!-- ACCOUNT -->
                    <div class="col-md-3 mt-4 mt-md-0">
                        <!-- Cart -->
                        <div class="cart h-100 d-flex justify-content-around align-items-center">
                            <div class="text-white position-relative">
                                <a href="/cart"><i class="fa fa-shopping-cart text-center fs-2" style="color: white !important;"></i></a>
                                <span class="cart-quantity position-absolute rounded-circle text-center" style="
                                                                                                width: 25px;
                                                                                                height: 25px;
                                                                                                top: -10px;
                                                                                                right: -10px;
                                                                                                background-color: rgb(209, 0, 36);
                                                                                                ">
                                    0
                                </span>

                                <!-- Cart List -->
                                <div class="cart-list d-none position-absolute bg-white border rounded-3" style="
                                                                                                                inset: 50px auto auto -450px;
                                                                                                                width: 500px;
                                                                                                                z-index: 100;
                                                                                                                ">
                                    <div style="height: 300px;" class="empty-cart d-flex justify-content-center align-items-center">
                                        <img src="/imgs/cart/empty-cart.png" class="w-25" alt="">
                                    </div>
                                </div>
                                <!-- /Cart List -->
                            </div>

                            <div class="dropdown d-block d-md-none">
                                <button class="btn dropdown-toggle text-white fs-4" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-bars"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item text-white py-2" href="/profile">Tài khoản</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-white py-2" href="/purchase">Đơn mua</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-white py-2" href="/logout">Đăng xuất</a>
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