<?php include_once VIEWS_DIR . "/shop/partials/header/index.php"; ?>

<style>
    .card.statistics:hover {
        box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;
        cursor: pointer;
    }

    .table-stats table th,
    .table-stats table td {
        border: none;
        border-bottom: 1px solid #e8e9ef;
        color: #868e96;
        font-size: 12px;
        font-weight: normal;
        padding: .75em 1.25em;
        text-transform: uppercase;
    }

    .table-stats table th .name,
    .table-stats table td .name {
        color: #343a40;
        font-size: 14px;
        text-transform: capitalize;
    }

    .table-stats table td {
        color: #343a40;
        font-size: 14px;
        font-weight: 600;
        text-transform: capitalize;
        vertical-align: middle;
    }
</style>

<div class="content" style="min-height: 100vh;">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-lg-3 col-md-6">
                <a href="#" class="card statistics">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-1">
                                <i class="pe-7s-cash"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text">
                                        <span class=""><?= htmlspecialchars(format_money($orderTotalPrice)) ?></span>
                                    </div>
                                    <div class="stat-heading">Doanh thu</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6">
                <a href="#" class="card statistics">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-2">
                                <i class="pe-7s-cart"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text">
                                        <span class=""><?= htmlspecialchars($productCount) ?></span>
                                    </div>
                                    <div class="stat-heading">Sản phẩm</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6">
                <a href="#" class="card statistics">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-3">
                                <i class="pe-7s-star"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text">
                                        <span class=""><?= htmlspecialchars($orderDeliveryCount) ?></span>
                                    </div>
                                    <div class="stat-heading">Vận chuyển</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6">
                <a href="#" class="card statistics">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-4">
                                <i class="pe-7s-users"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text">
                                        <span class=""><?= htmlspecialchars($userCount) ?></span>
                                    </div>
                                    <div class="stat-heading">Khách hàng</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <strong class="card-title mb-0">Sản phẩm</strong>
                    </div>

                    <div class="table-stats order-table ov-h">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Đơn vị vận chuyển</th>
                                    <th>Tên khách hàng</th>
                                    <th>Mã đơn hàng</th>
                                    <th>Địa chỉ</th>
                                    <th>Ngày đặt</th>
                                    <th>Trạng thái</th>
                                    <th>Thành tiền</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody id="t_body">
                                <?php foreach ($orders as $index => $order) : ?>
                                    <tr>
                                        <td><?= htmlspecialchars($index + 1) ?></td>
                                        <td><?= htmlspecialchars($order['DELIVERY_ID']) ?></td>
                                        <td>
                                            <span class="name"><?= htmlspecialchars($order['ORDER_NAME']) ?></span>
                                        </td>
                                        <td><span><?= htmlspecialchars($order['ORDER_ID']) ?></span></td>
                                        <td><span><?= htmlspecialchars($order['ORDER_ADDRESS']) ?></span></td>
                                        <td><span><?= htmlspecialchars($order['ORDER_DATE']) ?></span></td>
                                        <td><span><?= htmlspecialchars($order['ORDER_STATUS'] == 0 ? 'Chờ xác nhận' : ($order['ORDER_STATUS'] == 1 ? 'Đang giao' : ($order['ORDER_STATUS'] == 2 ? 'Hủy' : 'Đã nhận hàng'))) ?></span></td>
                                        <td><span><?= htmlspecialchars(format_money($order['TOTAL_PRICE'])) ?></span></td>
                                        <td>
                                            <a target="_blank" href="/shop/orders/<?= htmlspecialchars($order['ORDER_ID']) ?>">
                                                <i class="fa-regular fa-eye font-weight-bold" style="font-size: 24px"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
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