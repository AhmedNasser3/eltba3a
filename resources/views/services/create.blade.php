@extends('frontend.master')
@section('Content')

{{--  option  --}}
<div class="options">
    <div class="option_container">
        <div class="option_content">
            <div class="option_data">
                <div class="option_title">
                    <h2>خيارات <span>الطباعة</span></h2>
                </div>
                <div class="option_box">
                    <div class="option_box_container">
                        <div class="option_box_content">
                            <div class="option_box_data">
                                <form action="{{ route('service.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                    <div class="option_box_1_title">
                                        <h3>حجم الورق</h3>
                                    </div>
                                    <div class="option_box_1_cn" id="sizeOptions">
                                        <label class="option_box_1_bg">
                                            <input type="radio" name="size" value="A3" hidden>
                                            <div class="option_box__1_text">
                                                <h4>A3</h4>
                                            </div>
                                        </label>
                                        <label class="option_box_1_bg">
                                            <input type="radio" name="size" value="A4" hidden>
                                            <div class="option_box__1_text">
                                                <h4>A4</h4>
                                            </div>
                                        </label>
                                    </div>

                                    <div class="option_box_1_title">
                                        <h3>لون الطباعة</h3>
                                    </div>
                                    <div class="option_box_1_cn" id="colorOptions">
                                        <label class="option_box_1_bg selected">
                                            <input type="radio" name="color" value="اسود" hidden checked>
                                            <div class="option_box__1_text">
                                                <h4>أسود</h4>
                                            </div>
                                        </label>
                                        <label class="option_box_1_bg">
                                            <input type="radio" name="color" value="ملون" hidden>
                                            <div class="option_box__1_text">
                                                <h4>ملون</h4>
                                            </div>
                                        </label>
                                    </div>

                                    <div class="option_box_1_title" style="padding: 2% 0 0 0; display: flex; justify-content: center;">
                                        <h3>معلومات حول الطلب</h3>
                                    </div>
                                    <div class="option_box_1_cn" style="display: flex; justify-content: center;">
                                        <textarea name="comment" style="height: 100px; width: 1000px;"></textarea>
                                    </div>

                                    <div class="option_box_1_title">
                                        <h3>رفع الملف</h3>
                                    </div>
                                    <div class="option_box_1_cn" style="display: flex; justify-content: center;">
                                        <input type="file" name="file" accept=".jpg,.png,.pdf,.doc,.docx">
                                    </div>
                                    <div class="option_box_1_title" style="display: flex; justify-content: center; padding-top: 20px;">
                                        <button type="submit" style="padding: 10px 20px; background-color: #0099ad; color: white; border: none; border-radius: 5px; cursor: pointer;">
                                            إرسال الطلب
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    function handleSelection(containerId) {
        let container = document.getElementById(containerId);
        let labels = container.querySelectorAll(".option_box_1_bg");
        labels.forEach(label => {
            label.addEventListener("click", function () {
                labels.forEach(l => l.classList.remove("selected"));
                this.classList.add("selected");
            });
        });
    }

    handleSelection("sizeOptions");
    handleSelection("colorOptions");
});
</script>

<style>
.option_box_1_bg.selected {
    border: 2px solid #0099ad;
    background-color: #0099ad;
}
</style>
@endsection
