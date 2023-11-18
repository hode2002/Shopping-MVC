<!DOCTYPE html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="CT467 - Project" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="apple-touch-icon" sizes="180x180" href="/imgs/favicon/apple-touch-icon.png" />
    <link rel="icon" type="img/png" sizes="32x32" href="/imgs/favicon/favicon-32x32.png" />
    <link rel="icon" type="imgs/png" sizes="16x16" href="/imgs/favicon/favicon-16x16.png" />
    <link rel="manifest" href="/imgs/favicon/site.webmanifest" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css" />
    <link rel="stylesheet" href="/css/style.css" />
    <link rel="stylesheet" href="/css/shop/style.css" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js" integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>

    <script>
        $(() => {
            $('.search-trigger').on('click', function(event) {
                event.preventDefault();
                event.stopPropagation();
                $('.search-trigger').parent('.header-left').addClass('open');
            });

            $('.search-close').on('click', function(event) {
                event.preventDefault();
                event.stopPropagation();
                $('.search-trigger').parent('.header-left').removeClass('open');
            });

            $('.equal-height').matchHeight({
                property: 'max-height'
            });

            // Counter Number
            $('.count').each(function() {
                $(this).prop('Counter', 0).animate({
                    Counter: $(this).text()
                }, {
                    duration: 3000,
                    easing: 'swing',
                    step: function(now) {
                        $(this).text(Math.ceil(now));
                    }
                });
            });

            // Menu Trigger
            $('#menuToggle').on('click', function(event) {
                var windowWidth = $(window).width();
                if (windowWidth < 1010) {
                    $('body').removeClass('open');
                    if (windowWidth < 760) {
                        $('#left-panel').slideToggle();
                    } else {
                        $('#left-panel').toggleClass('open-menu');
                    }
                } else {
                    $('body').toggleClass('open');
                    $('#left-panel').removeClass('open-menu');
                }

            });

            $(".menu-item-has-children.dropdown").each(function() {
                $(this).on('click', function() {
                    var $temp_text = $(this).children('.dropdown-toggle').html();
                    $(this).children('.sub-menu').prepend('<li class="subtitle">' + $temp_text + '</li>');
                });
            });

            // Load Resize 
            $(window).on("load resize", function(event) {
                var windowWidth = $(window).width();
                if (windowWidth < 1010) {
                    $('body').addClass('small-device');
                } else {
                    $('body').removeClass('small-device');
                }

            });
        })
    </script>

    <style>
        .logout-btn:hover {
            cursor: pointer;
        }

        .nav-link {
            padding: 5px 10px !important;
        }

        .nav-link:hover {
            background-color: #eee !important;
        }
    </style>

    <title>Kênh Người Bán</title>
</head>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="/shop"><i class="menu-icon fa fa-laptop"></i>Dashboard
                        </a>
                    </li>
                    <li class="menu-title">Chức năng</li>
                    <!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="menu-icon fa-brands fa-product-hunt"></i>Sản phẩm</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li>
                                <i class="fa fa-list"></i><a href="/shop/products">Danh sách</a>
                            </li>
                            <li>
                                <i class="fa fa-plus"></i><a href="/shop/products/add">Thêm</a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="menu-icon fa fa-table"></i>Đơn hàng</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li>
                                <i class="fa fa-list"></i><a href="/shop/orders">Danh sách</a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="menu-icon fa-solid fa-truck"></i>
                            Vận chuyển
                        </a>
                        <ul class="sub-menu children dropdown-menu">
                            <li>
                                <i class="fa fa-list"></i>
                                <a href="/shop/transports">Danh sách</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->

    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left " style="width: 19%;">
                <div class="navbar-header d-flex justify-content-between" style="width: 100%;">
                    <a class="navbar-brand " href="./" style="display: inline; color: #09c496;    font-weight: bold;">MANAGE</a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="user-area dropdown float-right">
                        <?php if (isset($_SESSION['email'])) { ?>
                            <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <p class="mx-3 align-middle mb-0 font-weight-bold">
                                    Hello, <?= $_SESSION['email'] ?>
                                </p>
                                <img class="user-avatar rounded-circle" src="https://png.pngtree.com/png-vector/20190118/ourmid/pngtree-user-vector-icon-png-image_328702.jpg" alt="User Avatar" />
                            </a>

                        <?php
                        }
                        ?>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa-user"></i>Tài khoản của tôi</a>

                            <a class="nav-link" href="#"><i class="fa fa-cog"></i>Cài đặt</a>


                            <form id="logout_form" action="/logout" method="post" class="d-flex flex-column">
                                <button class="logout-btn dropdown-item nav-link" type="submit">
                                    <i class=" fa fa-power-off"></i>Đăng xuất
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>