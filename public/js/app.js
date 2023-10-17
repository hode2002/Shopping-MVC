$(() => {
  $(document).ready(function () {
    // Validate form
    $.validator.setDefaults({
      submitHandler: function () {
        alert("submitted!");
      },
    });

    $("#signupForm").validate({
      rules: {
        email: { required: true, email: true },
        name: { required: true, minlength: 2 },
        password: { required: true, minlength: 5 },
        confirm_password: {
          required: true,
          minlength: 5,
          equalTo: "#password",
        },
      },
      messages: {
        email: {
          required: "Bạn chưa nhập email",
          email: "Email không đúng định dạng",
        },
        name: {
          required: "Bạn chưa nhập vào họ tên",
        },
        password: {
          required: "Bạn chưa nhập mật khẩu",
          minlength: "Mật khẩu phải có ít nhất 5 ký tự ",
        },
        confirm_password: {
          required: "Bạn chưa nhập mật khẩu",
          minlength: "Mật khẩu phải có ít nhất 5 ký tự ",
          equalTo: "Mật khẩu không trùng khớp",
        },
      },
      errorElement: "div",
      errorPlacement: function (error, element) {
        error.addClass("invalid-feedback ms-3 my-1");
        error.insertAfter(element);
      },
    });

    $("#loginForm").validate({
      rules: {
        email: { required: true, email: true },
        password: { required: true },
      },
      messages: {
        email: {
          required: "Bạn chưa email",
          email: "Email không đúng định dạng",
        },
        password: {
          required: "Bạn chưa nhập mật khẩu",
        },
      },
      errorElement: "div",
      errorPlacement: function (error, element) {
        error.addClass("invalid-feedback ms-3 my-1");
        error.insertAfter(element);
      },
    });

    $("#edit-avatar-form").validate({
      rules: {
        email: { required: true, email: true },
        phone: { minlength: 10, maxlength: 10 },
      },
      messages: {
        email: {
          required: "Bạn chưa email",
          email: "Email không đúng định dạng",
        },
        phone: {
          minlength: "Số điện thoại không hợp lệ",
          maxlength: "Số điện thoại không hợp lệ",
        },
      },
      errorElement: "div",
      errorPlacement: function (error, element) {
        error.addClass("invalid-feedback my-1");
        error.insertAfter(element);
      },
    });
    // End validate form

    // History list
    $("header input.search").click((event) => {
      event.stopPropagation();
      $("header .history").show();
    });

    $(document).click((event) => {
      if (!$(event.target).closest("header .history").length) {
        $("header .history").hide();
      }
    });
    // End history list

    $(".image-slider").slick({
      slidesToShow: 6,
      slidesToScroll: 3,
      infinite: true,
      arrows: true,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 5,
            slidesToScroll: 6,
            infinite: true,
            prevArrow: "",
            nextArrow: "",
          },
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 6,
            infinite: true,
            prevArrow: "",
            nextArrow: "",
          },
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 6,
            infinite: true,
            prevArrow: "",
            nextArrow: "",
          },
        },
      ],
      prevArrow:
        "<button type='button' class='slick-prev slick-arrows pull-left'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
      nextArrow:
        "<button type='button' class='slick-next slick-arrows pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
    });

    $(".carousel-inner").slick({
      autoplay: true,
      autoplaySpeed: 3000,
      slidesToShow: 1,
      arrows: true,
      prevArrow:
        "<button type='button' class='slick-prev slick-arrows pull-left'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
      nextArrow:
        "<button type='button' class='slick-next slick-arrows pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
    });

    $(".banner-right-top").slick({
      autoplay: true,
      autoplaySpeed: 5000,
      slidesToShow: 1,
      prevArrow: "",
      nextArrow: "",
    });

    $(".banner-right-bottom").slick({
      autoplay: true,
      autoplaySpeed: 7000,
      slidesToShow: 1,
      prevArrow: "",
      nextArrow: "",
    });

    $(".products_slide").slick({
      slidesToShow: 5,
      slidesToScroll: 3,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            prevArrow: "",
            nextArrow: "",
          },
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
            infinite: true,
            prevArrow: "",
            nextArrow: "",
          },
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
            infinite: true,
            prevArrow: "",
            nextArrow: "",
          },
        },
      ],
      prevArrow:
        "<button type='button' class='slick-prev slick-arrows pull-left'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
      nextArrow:
        "<button type='button' class='slick-next slick-arrows pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
    });

    // Countdown timer
    let countdownInterval;
    const endTime = new Date().getTime() + 12 * 60 * 60 * 1000; // Thời gian kết thúc

    const startCountdown = () => {
      if (!countdownInterval) {
        countdownInterval = setInterval(updateCountdown, 1000);
      }
    };

    const updateCountdown = () => {
      const currentTime = new Date().getTime();
      const timeRemaining = endTime - currentTime;

      if (timeRemaining <= 0) {
        clearInterval(countdownInterval);
        $(".countdown-timer").html("Flash Sale đã kết thúc!");
      } else {
        const hours = Math.floor(
          (timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
        );
        const minutes = Math.floor(
          (timeRemaining % (1000 * 60 * 60)) / (1000 * 60)
        );
        const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

        const formattedTime =
          pad(hours) + ":" + pad(minutes) + ":" + pad(seconds);
        $(".countdown-timer").html(formattedTime);
      }
    };

    const pad = (number) => {
      return number < 10 ? "0" + number : number;
    };

    startCountdown();
    // End countdown timer

    // Preview avatar
    const previewAvatar = (file, imgTag) => {
      const allowSize = 1; //1MB

      if (!file) {
        return alert("Vui lòng chọn ảnh");
      }
      if (file.size / 1024 / 1024 > allowSize) {
        return alert("Dụng lượng file tối đa 1 MB");
      }
      if (file.type !== "image/jpeg" && file.type !== "image/png") {
        return alert("Định dạng:.JPEG, .PNG");
      }
      imgTag.attr("src", URL.createObjectURL(file));
    };

    $("#avatar-input").on("change", function (event) {
      const imgTag = $("img#avatar-preview");
      previewAvatar(this?.files[0], imgTag);
    });
    // Preview avatar
  });

  // THÊM VÀO GIỎ HÀNG

  // Initialize an empty cart array
  var cart = [
    {
      id: "p-1",
      name: "Tai Nghe Bluetooth Pro 2 Không Dây Cao Cấp Định Vị Đổi Tên Tự Động Kết Nối Cảm Ứng Chính Hãng PKT",
      price: "179.000đ",
      photo:
        "https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-llysbdiyaktb13_tng",
    },
    {
      id: "p-2",
      name: "Cái số 2 Tai Nghe Bluetooth Pro 2 Không Dây Cao Cấp Định Vị Đổi Tên Tự Động Kết Nối Cảm Ứng Chính Hãng PKT",
      price: "179.000đ",
      photo:
        "https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-llysbdiyaktb13_tng",
    },
  ];
  let user_cart = [];

  // Function to add an item to the cart
  function addToCart(product, price) {
    var item = {
      product: product,
      price: price,
    };

    cart.push(item);

    // Update the cart display
    updateCart();
  }

  // Function to update the cart display
  function updateCart() {
    var cartTable = $("#cart tbody");
    cartTable.empty();

    // Loop through the cart items and append them to the cart table
    for (var i = 0; i < cart.length; i++) {
      var item = cart[i];

      var row = $("<tr></tr>");
      row.append("<td>" + item.product + "</td>");
      row.append("<td>" + item.price + "</td>");
      row.append('<td><button class="remove">Remove</button></td>');

      cartTable.append(row);
    }
  }

  // Event handler for adding items to the cart
  $(".add-to-cart").click(function () {
    let id = $(this).closest(".product").attr("id");

    // console.log(id);

    // addToCart(product, price);
    cart.forEach(function (item) {
      if (item.id === id) {
        user_cart.push(item);
      }
    });
    // console.log(user_cart);
    window.localStorage.setItem("user1", JSON.stringify(user_cart));
  });

  // Event handler for removing items from the cart
  $(document).on("click", ".remove", function () {
    var index = $(this).closest("tr").index();
    cart.splice(index, 1);

    // Update the cart display
    updateCart();
  });
});
