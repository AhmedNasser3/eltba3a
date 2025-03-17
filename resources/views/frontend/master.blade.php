<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/WhatsApp Image 2025-02-18 at 3.57.36 PM.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>الطباع</title>
</head>
<body>
    <!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>زر واتساب ثابت</title>
    <style>
        /* زر واتساب */
        .whatsapp-button {
            position: fixed;
            bottom: 20px;
            left: 20px;
            background-color: #25d366;
            color: white;
            padding: 12px 15px;
            border-radius: 50%;
            font-size: 24px;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease-in-out;
        }

        .whatsapp-button:hover {
            transform: scale(1.1);
        }

        .whatsapp-button img {
            width: 35px;
            height: 35px;
        }
    </style>
</head>
<body>

    <a href="https://wa.me/201234567890" target="_blank" class="whatsapp-button">
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="واتساب">
    </a>

</body>
</html>

    @include('frontend.includes.header')
    @yield('Content')
    @include('frontend.includes.footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script>
    $(document).ready(function(){
        $('.partners_slider').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 1000,
            arrows: true,
            prevArrow: '<button type="button" class="slick-prev">&#10094;</button>',
            nextArrow: '<button type="button" class="slick-next">&#10095;</button>',
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    });
</script>

<style>
    .partners_slider {
        direction: ltr;
    }
    .partners_boxes_img {
        text-align: center;
        padding: 10px;
    }
    .partners_boxes_img img {
        width: 100px;
        height: auto;
    }
    .slick-prev, .slick-next {
        font-size: 24px;
        background: #253b2c;
        border: none;
        color: white;
        width: 40px;
        height: 40px;
        border-radius: 10px;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
    }
    .slick-prev {
        left: -50px;
    }
    .slick-next {
        right: -50px;
    }
</style>

</body>
</html>
