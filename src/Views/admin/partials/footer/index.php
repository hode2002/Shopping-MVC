<script>
    $(() => {
        const postAjax = (url, data = []) => {
            $.ajax({
                url,
                type: 'POST',
                data,
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
                    }).then(function() {
                        if (!res['error']) {
                            window.location.reload();
                        }
                    })
                },
            })
        }

        $('.btn-shop-approve').on('click', function() {
            const shop = $(this).closest('.shop')
            const status = shop[0].dataset.shop_status;

            Swal.fire({
                title: 'Xét duyệt mở cửa hàng',
                icon: 'warning',
                showConfirmButton: status == 0 ? true : false,
                showCancelButton: true,
                showDenyButton: status == 0 ? false : true,
                confirmButtonText: "Duyệt",
                denyButtonText: 'Dừng hoạt động',
                cancelButtonText: 'Quay lại',
                confirmButtonColor: '#3085d6',
                denyButtonColor: '#d33',

            }).then((result) => {
                const shopId = shop[0].dataset.shop_id

                const data = {
                    shopId,
                    status: 1
                }

                if (result.isConfirmed) {
                    postAjax('/admin/shops/approve', data);
                } else if (result.isDenied) {
                    data.status = 0;
                    postAjax('/admin/shops/approve', data);
                }
            })
        })

        $('.btn-product-approve').on('click', function() {
            Swal.fire({
                title: 'Duyệt sản phẩm',
                icon: 'warning',
                showConfirmButton: true,
                showCancelButton: true,
                showDenyButton: true,
                confirmButtonText: "Duyệt",
                denyButtonText: 'Vi phạm',
                cancelButtonText: 'Quay lại',
                confirmButtonColor: '#3085d6',
                denyButtonColor: '#d33',

            }).then((result) => {
                const product = $(this).closest('.product')
                const shopId = product[0].dataset.shop_id
                const productId = product[0].dataset.product_id

                const data = {
                    shopId,
                    productId,
                    status: 1
                }

                if (result.isConfirmed) {
                    postAjax('/admin/products/approve', data);
                } else if (result.isDenied) {
                    data.status = 2
                    postAjax('/admin/products/approve', data);
                }
            })
        })
    })
</script>

<!-- Required Js -->
<script src="/js/admin/vendor-all.min.js"></script>
<script src="/js/admin/plugins/bootstrap.min.js"></script>
<script src="/js/admin/pcoded.min.js"></script>

</body>

</html>