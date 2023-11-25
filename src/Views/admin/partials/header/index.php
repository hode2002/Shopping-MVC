<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <!-- Favicon icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/imgs/favicon/apple-touch-icon.png" />
    <link rel="icon" type="img/png" sizes="32x32" href="/imgs/favicon/favicon-32x32.png" />
    <link rel="icon" type="imgs/png" sizes="16x16" href="/imgs/favicon/favicon-16x16.png" />
    <link rel="manifest" href="/imgs/favicon/site.webmanifest" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <link rel="stylesheet" href="/css/admin/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <title><?= htmlspecialchars($title ?? 'Admin') ?></title>
</head>

<body class="">
    <nav class="pcoded-navbar  ">
        <div class="navbar-wrapper  ">
            <div class="navbar-content scroll-div ">

                <div class="">
                    <div class="main-menu-header">
                        <img class="img-radius" src="<?= htmlspecialchars($user['avatar']) ?>" alt="User-Profile-Image">
                        <div class="user-details">
                            <span class="font-weight-bold"><?= htmlspecialchars($user['name']) ?></span>
                        </div>
                    </div>
                </div>

                <ul class="nav pcoded-inner-navbar ">
                    <li class="nav-item pcoded-menu-caption">
                        <label>Navigation</label>
                    </li>
                    <li class="nav-item">
                        <a href="/admin" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                    </li>
                    <li class="nav-item pcoded-menu-caption">
                        <label>Sản phẩm</label>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/products" class="nav-link">
                            <span class="pcoded-micon">
                                <i class="fa-brands fa-product-hunt "></i>
                            </span>
                            <span class="pcoded-mtext">Danh sách</span>
                        </a>
                    </li>
                    <li class="nav-item pcoded-menu-caption">
                        <label>Khách hàng</label>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/users" class="nav-link">
                            <span class="pcoded-micon">
                                <i class="fa-regular fa-user "></i>
                            </span>
                            <span class="pcoded-mtext">Danh sách</span>
                        </a>
                    </li>
                    <li class="nav-item pcoded-menu-caption">
                        <label>Cửa hàng</label>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/shops" class="nav-link">
                            <span class="pcoded-micon">
                                <i class="fa-solid fa-store"></i>
                            </span>
                            <span class="pcoded-mtext">Danh sách</span>
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
    <header class="navbar pcoded-header navbar-expand-lg navbar-light header-dark">
        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
            <a href="#!" class="b-brand">
                <span class="font-weight-bolder" style="font-size: large;">Admin</span>
            </a>
            <a href="#!" class="mob-toggler">
                <i class="feather icon-more-vertical"></i>
            </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li>
                    <div class="dropdown drp-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="feather icon-settings"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-notification">
                            <ul class="pro-body">
                                <li><a href="user-profile.html" class="dropdown-item"><i class="feather icon-user"></i>
                                        Profile</a></li>
                                <li>
                                    <form id="logout_form" action="/logout" method="post" class="d-flex flex-column">
                                        <button class="dropdown-item btn" type="submit">
                                            <i class="feather icon-log-out"></i>
                                            Đăng Xuất
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

    </header>