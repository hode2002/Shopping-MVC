<?php
if (isset($_GET["page"]) && isset($_GET["act"])) {
  $page = $_GET["page"];
  $act = $_GET["act"];
} else {
  $page = '';
  $act = '';
}
if ($act == 'list') {
  include_once  './views/pages/order/order.php';
} else if ($act == 'add') {
  include_once  './views/pages/order/add-order.php';
} else if ($act == 'detail') {
  include_once  './views/pages/order/detail.php';
} else if ($act == 'add-product') {
  include_once  './views/pages/order/add-product-into-order.php';
} else {
  include_once  './views/pages/order/buyed.php';
}
