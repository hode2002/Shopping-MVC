<?php include_once VIEWS_DIR . "/shop/partials/header/index.php" ?>

<style>
  label {
    margin-bottom: 0 !important;
  }

  input,
  textarea,
  select {
    box-shadow: none !important;
  }
</style>

<div class="content" style="min-height: 100vh;">
  <div class="animated fadeIn">
    <div class="row justify-content-center d-block d-md-flex">
      <div class="col col-md-9">
        <div class="card">
          <div class="card-header font-weight-bold" style="font-size: 24px">
            Sửa sản phẩm
          </div>
          <div class="card-body card-block">
            <form id="edit_product_form" action="shop/products" method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="row form-group">
                <div class="col col-md-3 align-self-center align-self-center">
                  <label for="id" class="form-control-label">Mã sản phẩm</label>
                </div>
                <div class="col-12 col-md-9">
                  <input value="<?= htmlspecialchars($product['id']) ?>" disabled type="text" autocomplete="off" id="id" name="id" placeholder="Mã sản phẩm" class="form-control" />
                </div>
              </div>

              <div class="row form-group">
                <div class="col col-md-3 align-self-center align-self-center">
                  <label for="name" class="form-control-label">Tên sản phẩm</label>
                </div>
                <div class="col-12 col-md-9">
                  <input value="<?= htmlspecialchars($product['name']) ?>" type="text" autocomplete="off" id="name" name="name" placeholder="Tên" class="form-control" />
                </div>
              </div>

              <div class="row form-group">
                <div class="col col-md-3 align-self-center">
                  <label for="category" class="form-control-label"> Danh mục </label>
                </div>
                <div class="col-12 col-md-9">
                  <select class="form-select form-control" id="category" name="category">
                    <option value="" selected>Chọn danh mục</option>
                    <option <?= $product['cate_id'] == 1 ? 'selected' : '' ?> value="1">Xe máy</option>
                    <option <?= $product['cate_id'] == 2 ? 'selected' : '' ?> value="2">Ba lô</option>
                    <option <?= $product['cate_id'] == 3 ? 'selected' : '' ?> value="3">Thể thao</option>
                    <option <?= $product['cate_id'] == 4 ? 'selected' : '' ?> value="4">Điện thoại</option>
                    <option <?= $product['cate_id'] == 5 ? 'selected' : '' ?> value="5">Đồng hồ</option>
                    <option <?= $product['cate_id'] == 6 ? 'selected' : '' ?> value="6">Giày dép</option>
                    <option <?= $product['cate_id'] == 7 ? 'selected' : '' ?> value="7">Dụng cụ nhà</option>
                    <option <?= $product['cate_id'] == 8 ? 'selected' : '' ?> value="8">Laptop</option>
                    <option <?= $product['cate_id'] == 9 ? 'selected' : '' ?> value="9">Phụ kiện</option>
                    <option <?= $product['cate_id'] == 10 ? 'selected' : '' ?> value="10">Sách</option>
                    <option <?= $product['cate_id'] == 11 ? 'selected' : '' ?> value="11">Thời trang nam</option>
                    <option <?= $product['cate_id'] == 12 ? 'selected' : '' ?> value="12">Thời trang nữ</option>
                  </select>
                </div>
              </div>

              <div class="row form-group">
                <div class="col col-md-3 align-self-center">
                  <label for="price" class="form-control-label"> Giá </label>
                </div>
                <div class="col-12 col-md-9">
                  <input value="<?= htmlspecialchars($product['price']) ?>" type="text" autocomplete="off" id="price" name="price" placeholder="Giá" class="form-control" />
                </div>
              </div>

              <div class="row form-group">
                <div class="col col-md-3 align-self-center">
                  <label for="sale" class="form-control-label"> Sale </label>
                </div>
                <div class="col-12 col-md-9">
                  <input type="text" autocomplete="off" id="sale" name="sale" value="<?= htmlspecialchars($product['sale']) ?>" placeholder="%" class="form-control" />
                </div>
              </div>

              <div class="row form-group">
                <div class="col col-md-3 align-self-center">
                  <label for="thumbnail" class="form-control-label"> Ảnh </label>
                </div>

                <div class="col-12 col-md-9">
                  <input hidden type="file" class="form-control-file form-control img" id="thumbnail" name="img" accept="image/*">
                  <label for="thumbnail" class="btn text-dark" style="background-color: #f0f3f5;">Chọn</label>
                  <div class="preview-img mt-3 col-12 col-md-9 px-0">
                    <img src="<?= htmlspecialchars($product['thumbnail']) ?>" alt="" style="width: 150px;">
                  </div>
                </div>
              </div>

              <div class="row form-group">
                <div class="col col-md-3 align-self-center">
                  <label for="imgs" class="form-control-label"> Hình ảnh khác </label>
                </div>

                <div class="col-12 col-md-9">
                  <input hidden type="file" multiple class="form-control-file form-control imgs" id="imgs" name="imgs[]" accept="image/*">
                  <label for="imgs" class="btn text-dark" style="background-color: #f0f3f5;">Chọn</label>
                  <div class="preview-imgs mt-3 col-12 col-md-9 px-0">
                    <img src="" alt="" style="width: 150px;">
                    <?php foreach ($product['imgs'] as $img) : ?>
                      <img src="<?= htmlspecialchars($img['image_url']) ?>" alt="" style="width: 150px;">
                    <?php endforeach ?>
                  </div>
                </div>
              </div>

              <div class="row form-group">
                <div class="col col-md-3 align-self-center">
                  <label for="quantity" class="form-control-label"> Số lượng kho </label>
                </div>
                <div class="col-12 col-md-9">
                  <input type="text" autocomplete="off" id="quantity" value="<?= htmlspecialchars($product['quantity']) ?>" name="quantity" placeholder="Số lượng" class="form-control" />
                </div>
              </div>

              <div class="row form-group">
                <div class="col col-md-3">
                  <label for="description" class="form-control-label"> Mô tả </label>
                </div>
                <div class="col-12 col-md-9">
                  <textarea name="description" id="description" rows="6" placeholder="Nội dung..." class="form-control">
                    <?= htmlspecialchars($product['description']) ?>
                  </textarea>
                </div>
              </div>

              <div class="mt-5 d-flex justify-content-center">
                <input type="submit" id="add_sp" name="add_sp" value="Lưu" class="form-control text-dark btn" style="max-width: 150px; cursor: pointer; background-color: #f0f3f5;" />
              </div>
            </form>

          </div>
          <div class="card-footer text-right">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- .animated -->
</div>

<div class="clearfix"></div>

<script>
  const isValidFile = (file) => {
    const allowSize = 10 * 1024 * 1024;

    const swal = (msg) => {
      return Swal.fire({
        title: 'Lỗi',
        text: msg,
        icon: 'error',
        confirmButtonText: 'Ok',
        customClass: {
          confirmButton: 'bg-danger',
        },
      })
    }

    const size = file.size;
    const type = file.type;

    if (size > allowSize) {
      swal('Kích thước ảnh tối đa 10 MB');
      return false;
    }

    if (!type.includes('image')) {
      swal('Hình ảnh không đúng định dạng');
      return false;
    }

    return true;
  }

  const previewImg = (input, previewTag) => {
    input.on('change', function() {
      if ($(this).val()) {
        const files = $(this)[0].files;

        if (files.length === 1) {
          const file = files[0];

          if (!isValidFile(file)) {
            $(this).val('');
            previewTag.addClass('d-none')
            return;
          }

          const img = URL.createObjectURL(file);

          previewTag.removeClass('d-none').find('img').prop('src', img);
          $('#thumbnail-error').remove();
          return;
        }

        let html = '';
        Array.from(files).forEach(file => {
          if (!isValidFile(file)) {
            $(this).val('');
            previewTag.addClass('d-none')
            return;
          }
          const img = URL.createObjectURL(file);
          html += `<img src="${img}" alt="" style="width: 100px;">`
        })
        previewTag.removeClass('d-none').html(html);
      }
    })
  }

  $.validator.setDefaults({
    ignore: [],
    submitHandler: function() {
      const formData = new FormData();
      const img = $('.img')[0].files[0];
      const imgs = $('.imgs')[0].files;

      formData.append('img', img);
      for (var i = 0; i < imgs.length; i++) {
        formData.append("imgs[]", imgs[i]);
      }

      const product = {
        "id": $('#id').val().toUpperCase(),
        "name": $('#name').val(),
        "category": Number($('#category').find(':selected').val()),
        "price": Number($('#price').val()),
        "sale": Number($('#sale').val()),
        "quantity": Number($('#quantity').val()),
        "description": $('#description').val()
      };
      formData.append("product", JSON.stringify(product));

      fetch('/shop/product/edit', {
          method: 'POST',
          body: formData,
        })
        .then(res => res.json())
        .then(res => {
          Swal.fire({
            title: `${res["error"] ? 'Lỗi' : 'Thành công'}`,
            text: res["message"],
            icon: `${res["error"] ? 'error' : 'success'}`,
            confirmButtonText: 'Ok',
            customClass: {
              confirmButton: `${res["error"] ? 'bg-danger' : 'bg-success'}`,
            },
          }).then(() => {
            if (res['error'] === 3) {
              window.location.href = '/';
            }

            if (!res['error']) {
              window.location.href = '/shop/products';
            }
          })
        })
        .catch(error => {
          console.error("Error:", error);
        });
    }
  })

  $(() => {
    $('#edit_product_form').validate({
      rules: {
        id: {
          required: true,
        },
        name: {
          required: true,
        },
        category: {
          required: true,
        },
        price: {
          required: true,
          number: true
        },
        sale: {
          required: true,
          number: true
        },
        quantity: {
          required: true,
          number: true
        },
        description: {
          required: true,
        },
      },
      messages: {
        id: 'Nhập mã sản phẩm',
        name: 'Nhập tên sản phẩm',
        category: {
          required: 'Chọn danh mục',
        },
        price: {
          required: 'Nhập giá bán',
          number: 'Vui lòng nhập số',
        },
        sale: {
          required: 'Nhập sale',
          number: 'Vui lòng nhập số'
        },
        quantity: {
          required: 'Nhập số lượng kho',
          number: 'Vui lòng nhập số'
        },
        img: 'Chọn hình ảnh',
        description: 'Nhập mô tả',
      },
      errorElement: 'span',
      errorPlacement: (error, element) => {
        error.addClass('invalid-feedback');
        if (element.prop('type') === 'file') {
          error.css('margin-left', 'calc(25% + 15px)');
          error.insertAfter(element.parent('div'));
        } else {
          error.insertAfter(element);
        }
      },
      highlight: (element, errorClass, validClass) => {
        $(element).addClass('is-invalid').removeClass('is-valid');
      },
      unhighlight: (element, errorClass, validClass) => {
        $(element).addClass('is-valid').removeClass('is-invalid');
      },
    })

    previewImg($('#edit_product_form input.img'), $('.preview-img'));
    previewImg($('#edit_product_form input.imgs'), $('.preview-imgs'));
  })
</script>

<?php include_once VIEWS_DIR . "/shop/partials/footer/index.php" ?>