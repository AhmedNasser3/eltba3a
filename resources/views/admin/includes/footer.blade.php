<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Professional Webpage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex: 1;
            padding: 20px;
        }
        footer {
            margin: 5% 0 0 0;
            background-color: #1a582f;
            color: #fff;
            padding: 40px 20px;
            position: relative;
            width: 100%;
            animation: fadeIn 2s ease-in-out;
        }
        .footer-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
        }
        .footer-section {
            flex: 1;
            min-width: 250px;
            margin: 10px;
            animation: slideIn 1s ease-in-out;
        }
        .footer-section h3 {
            border-bottom: 2px solid #fff;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .social-media a {
            margin: 0 10px;
            color: #fff;
            text-decoration: none;
            font-size: 1.5em;
            transition: color 0.3s;
        }
        .social-media a:hover {
            color: #1da1f2;
        }
        .map-container {
            width: 100%;
            height: 200px;
            margin-top: 20px;
        }
        .newsletter input[type="email"] {
            padding: 10px;
            width: calc(100% - 22px);
            margin-bottom: 10px;
            border: none;
            border-radius: 5px;
        }
        .newsletter button {
            padding: 10px 20px;
            background-color: #506186;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .newsletter button:hover {
            background-color: #506186;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideIn {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
    </style>
</head>
<body >

    <footer dir="{{ config('app.locale') === 'ar' ? 'rtl' : 'ltr' }}">
        <div class="footer-content">
            <div class="footer-section">
                <h3>{{ __("من نحن") }}</h3>
                <p>{{ __("نحن شركة رائدة في مجالنا، نلتزم بتقديم أفضل الخدمات والمنتجات لعملائنا في جميع أنحاء العالم.") }}</p>
            </div>

            <div class="footer-section">
                <h3>{{ __("اتصل بنا") }}</h3>
                <p>{{ __("البريد الإلكتروني") }}: info@yourcompany.com</p>
                <p>{{ __("الهاتف") }}: +20 01063265173</p>
                <div class="social-media">
                    <a href="#" target="_blank" aria-label="{{ __('فيسبوك') }}"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" target="_blank" aria-label="{{ __('تويتر') }}"><i class="fab fa-twitter"></i></a>
                    <a href="#" target="_blank" aria-label="{{ __('إنستغرام') }}"><i class="fab fa-instagram"></i></a>
                </div>
            </div>

            <div class="footer-section newsletter">
                <h3>{{ __("النشرة الإخبارية") }}</h3>
                <p>{{ __("اشترك في نشرتنا الإخبارية للبقاء على اطلاع بأحدث الأخبار والعروض.") }}</p>
                <input type="email" placeholder="{{ __('أدخل بريدك الإلكتروني') }}" required>
                <button type="submit">{{ __("اشترك") }}</button>
            </div>
        </div>

        <div style="text-align: center; margin-top: 20px;">
            <p>&copy; <span id="year"></span> {{ __("اسم شركتك. جميع الحقوق محفوظة.") }}</p>
        </div>
    </footer>


    <script>
        document.getElementById("year").textContent = new Date().getFullYear();
    </script>

</body>
</html>
