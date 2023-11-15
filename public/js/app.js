$(document).ready(function () {
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

  $("#home .carousel-inner").slick({
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

  // THÊM VÀO GIỎ HÀNG
  let cart = new Array();
  $("#quantity-in-cart").text($("#cart-show").children().length);
  $(".add-cart-product").click(function (e) {
    e.preventDefault();
    let card = $(this).parent().parent();
    let imgCard = card.find("img").attr("src");
    let nameCard = card.children(".card-body").find("h5").text();
    let priceCard = card.children(".card-body").find("p").text();
    let quantityCard = 1;
    let itemCard = new Array(imgCard, nameCard, priceCard, quantityCard);
    cart.push(itemCard);
    // console.log(cart);
    showCart();
    let quantityCards = $("#cart-show").children().length;
    $("#quantity-in-cart").text(quantityCards);
  });

  let i = 0;
  function showCart() {
    let str = "";
    for (i; i < cart.length; i++) {
      str +=
        "<div class='product card flex-row border-0'>" +
        " <img src='" +
        cart[i][0] +
        "' class='w-25' alt='...' />" +
        "<div class='card-body container'>  <div class='row'> <p class='card-text col-8 text-truncate'>" +
        cart[i][1] +
        "</p><div class='d-flex align-items-center gap-1'><p class='fs-5 fw-bold' style='color: rgb(209, 0, 36)'>" +
        cart[i][2] +
        "</p><p style='color: rgb(209, 0, 36)'>x 2</p> </div></div></div></div>";
    }
    // let show = $("#cart-show");
    $(str).appendTo("#cart-show");
    // $("#cart-show").append(html(str));
  }
});