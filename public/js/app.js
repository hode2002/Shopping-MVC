$(() => {
    $(document).ready(function () {
        // Validate form
        $.validator.setDefaults({
            submitHandler: function () {
                alert('submitted!');
            },
        });

        $('#signupForm').validate({
            rules: {
                email: { required: true, email: true },
                username: { required: true, minlength: 2 },
                password: { required: true, minlength: 5 },
                confirm_password: {
                    required: true,
                    minlength: 5,
                    equalTo: '#password',
                },
            },
            messages: {
                email: {
                    required: 'Bạn chưa nhập mật khẩu email',
                    email: 'Email không đúng định dạng'
                },
                username: {
                    required: 'Bạn chưa nhập vào tên đăng nhập',
                    minlength: 'Tên dăng nhập phải có ít nhất 2 ký tự '
                },
                password: {
                    required: 'Bạn chưa nhập mật khẩu',
                    minlength: 'Mật khẩu phải có ít nhất 5 ký tự '
                },
                confirm_password: {
                    required: 'Bạn chưa nhập mật khẩu',
                    minlength: 'Mật khẩu phải có ít nhất 5 ký tự ',
                    equalTo: 'Mật khẩu không trùng với mật khẩu đã nhập '
                },
            },
            errorElement: 'div',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback ms-3 my-1');
                error.insertAfter(element);
            }

        });

        $('#loginForm').validate({
            rules: {
                email: { required: true, email: true },
                password: { required: true },
            },
            messages: {
                email: {
                    required: 'Bạn chưa email',
                    email: 'Email không đúng định dạng'
                },
                password: {
                    required: 'Bạn chưa nhập mật khẩu'
                },
            },
            errorElement: 'div',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback ms-2 my-1');
                error.insertAfter(element);
            }

        });
        // End validate form


        // History list
        $('header input.search').click((event) => {
            event.stopPropagation();
            $('header .history').show();
        })

        $(document).click((event) => {
            if (!$(event.target).closest('header .history').length) {
                $('header .history').hide();
            }
        });
        // End history list

        $(".image-slider").slick({
            slidesToShow: 6,
            slidesToScroll: 4,
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
                        nextArrow: ""
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 6,
                        infinite: true,
                        prevArrow: "",
                        nextArrow: ""
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 6,
                        infinite: true,
                        prevArrow: "",
                        nextArrow: ""
                    }
                }
            ],
            prevArrow:
                "<button type='button' class='slick-prev slick-arrows pull-left'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
            nextArrow:
                "<button type='button' class='slick-next slick-arrows pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
        });

        $('.carousel-inner').slick({
            autoplay: true,
            autoplaySpeed: 3000,
            slidesToShow: 1,
            arrows: true,
            prevArrow:
                "<button type='button' class='slick-prev slick-arrows pull-left'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
            nextArrow:
                "<button type='button' class='slick-next slick-arrows pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
        });

        $('.banner-right-top').slick({
            autoplay: true,
            autoplaySpeed: 5000,
            slidesToShow: 1,
            prevArrow: "",
            nextArrow: "",
        });

        $('.banner-right-bottom').slick({
            autoplay: true,
            autoplaySpeed: 7000,
            slidesToShow: 1,
            prevArrow: "",
            nextArrow: "",
        });

        $('.products_slide').slick({
            slidesToShow: 5,
            slidesToScroll: 3,
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
        }

        const updateCountdown = () => {
            const currentTime = new Date().getTime();
            const timeRemaining = endTime - currentTime;

            if (timeRemaining <= 0) {
                clearInterval(countdownInterval);
                $(".countdown-timer").html("Flash Sale đã kết thúc!");
            } else {
                const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

                const formattedTime = pad(hours) + ":" + pad(minutes) + ":" + pad(seconds);
                $('.countdown-timer').html(formattedTime);
            }
        }

        const pad = (number) => {
            return (number < 10) ? "0" + number : number;
        }

        startCountdown();
        // End countdown timer

    });
})