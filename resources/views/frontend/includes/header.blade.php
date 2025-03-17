<div class="header">
    <div class="header_container">
        <div class="header_content">
            <div class="header_data">
                <div class="header_auth">
                    <div class="header_auth_lang">
                        <a href="">
                        <button>EN</button>
                    </a>
                </div>
                @auth
                <div class="header_auth_register">
                    <a href="{{ route('profile.show') }}">
                        <button><i class="fa-solid fa-user"></i></button>
                    </a>
                </div>
                @endauth
                @guest
                <div class="header_auth_register">
                    <a href="{{ route('login') }}">
                        <button>تسجيل دخول</button>
                    </a>
                </div>
                <div class="header_auth_login">
                    <a href="{{ route('register') }}">
                        <button>تسجيل</button>
                    </a>
                </div>
                @endguest
                </div>
                <div class="header_links">
                    <ul>
                        <a href="/"><li>رئيسية</li></a>
                        <a href="{{ route('chat.show.order') }}"><li>طلباتي</li></a>
                        <a href=""><li>خدماتنا</li></a>
                        <a href="/#contact"><li>التحدث معنا</li></a>
                        <a href="{{ route('service.create') }}"><li>طلب طباعة</li></a>
                    </ul>
                </div>
                <div class="header_logo">
                    <img src="{{ asset('images/WhatsApp Image 2025-02-18 at 3.57.36 PM.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let header = document.querySelector(".header");
        let headerHeight = header.offsetHeight;

        window.addEventListener("scroll", function () {
            if (window.scrollY > headerHeight) {
                header.classList.add("fixed");
            } else {
                header.classList.remove("fixed");
            }
        });
    });
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('a[href^="/#"]').forEach(anchor => {
            anchor.addEventListener("click", function (e) {
                e.preventDefault();
                const targetId = this.getAttribute("href").substring(2);
                const targetElement = document.getElementById(targetId);

                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 50, // تعديل التمرير حسب الهيدر
                        behavior: "smooth"
                    });
                }
            });
        });
    });

</script>
