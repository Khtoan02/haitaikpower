<?php
/**
 * Title: Cloned Homepage
 * Slug: twentytwentyfive/cloned-homepage
 * Categories: twentytwentyfive_page, featured
 * Description: Unified middle content for Cloned Homepage.
 */
?>
<!-- wp:html -->
<!-- Full Bleed Auto-sliding Hero Section -->
<style>
.haitaik-hero-slider-section {
    width: 100vw;
    position: relative;
    left: 50%;
    right: 50%;
    margin-left: -50vw;
    margin-right: -50vw;
    overflow: hidden;
    background: #0f172a;
}
.haitaik-slider-container {
    position: relative;
    width: 100%;
    height: 650px;
    overflow: hidden;
}
@media (max-width: 768px) {
    .haitaik-slider-container {
        height: 450px;
    }
}
.haitaik-slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    visibility: hidden;
    transition: opacity 1.2s ease-in-out, visibility 1.2s ease-in-out;
    z-index: 1;
}
.haitaik-slide.active {
    opacity: 1;
    visibility: visible;
    z-index: 2;
}
.haitaik-slide-bg {
    width: 100%;
    height: 100%;
    overflow: hidden;
}
.haitaik-slide-bg img {
    width: 100% !important;
    height: 100% !important;
    object-fit: cover !important;
    transform: scale(1);
    transition: transform 6s ease;
}
.haitaik-slide.active .haitaik-slide-bg img {
    transform: scale(1.08);
}
.haitaik-slide-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to right, rgba(15, 23, 42, 0.75) 0%, rgba(15, 23, 42, 0.35) 60%, rgba(15, 23, 42, 0.1) 100%);
}
.haitaik-slide-content {
    position: absolute;
    top: 50%;
    left: 10%;
    transform: translateY(-50%);
    max-width: 650px;
    color: #ffffff;
    z-index: 3;
    padding: 0 20px;
}
.haitaik-slide-subtitle {
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 3px;
    color: #ffffff;
    display: inline-block;
    margin-bottom: 14px;
    background: rgba(228, 0, 17, 0.85);
    padding: 5px 14px;
    border-radius: 4px;
    text-transform: uppercase;
}
.haitaik-slide-title {
    font-size: 42px;
    font-weight: 800;
    line-height: 1.25;
    margin: 0 0 16px 0;
    color: #ffffff;
    text-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
}
@media (max-width: 768px) {
    .haitaik-slide-title {
        font-size: 26px;
    }
}
.haitaik-slide-desc {
    font-size: 16px;
    color: rgba(255, 255, 255, 0.9);
    line-height: 1.6;
    margin-bottom: 25px;
}
.haitaik-slide-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background-color: #e40011;
    color: #ffffff;
    padding: 13px 30px;
    border-radius: 4px;
    text-decoration: none;
    font-weight: 600;
    font-size: 15px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 14px rgba(228, 0, 17, 0.35);
}
.haitaik-slide-btn:hover {
    background-color: #c8000f;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(228, 0, 17, 0.5);
    color: #ffffff;
}
.haitaik-slider-arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 48px;
    height: 48px;
    background: rgba(15, 23, 42, 0.5);
    color: #ffffff;
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    font-size: 18px;
    cursor: pointer;
    z-index: 4;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}
.haitaik-slider-arrow:hover {
    background: #e40011;
    border-color: #e40011;
}
.haitaik-slider-arrow.prev { left: 25px; }
.haitaik-slider-arrow.next { right: 25px; }

.haitaik-slider-dots {
    position: absolute;
    bottom: 25px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 10px;
    z-index: 4;
}
.haitaik-slider-dots .dot {
    width: 32px;
    height: 4px;
    background: rgba(255, 255, 255, 0.4);
    border-radius: 2px;
    cursor: pointer;
    transition: all 0.3s ease;
}
.haitaik-slider-dots .dot.active {
    background: #e40011;
    width: 48px;
}
</style>

<div class="haitaik-hero-slider-section">
    <div class="haitaik-slider-container">
        <!-- Slide 1 -->
        <div class="haitaik-slide active" data-index="0">
            <div class="haitaik-slide-bg">
                <img src="https://omo-oss-image.thefastimg.com/portal-saas/pg2024041817493912440/cms/image/237797ff-4eff-48bd-90b0-8d0f1cf404e8.jpg" alt="创联电源" />
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="haitaik-slide" data-index="1">
            <div class="haitaik-slide-bg">
                <img src="https://omo-oss-image.thefastimg.com/portal-saas/pg2024041817493912440/cms/image/04a3fa2b-f59c-4234-a9ca-87d1b57c22f1.jpg_1920xaf.jpg" alt="高效低功耗电源" />
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="haitaik-slide" data-index="2">
            <div class="haitaik-slide-bg">
                <img src="https://omo-oss-image.thefastimg.com/portal-saas/pg2024041817493912440/cms/image/a74a667c-14fe-4c41-aa48-07c3c203cbb6.jpg" alt="品质保障" />
            </div>
        </div>

        <!-- Arrows -->
        <button class="haitaik-slider-arrow prev" aria-label="Previous Slide">&#10094;</button>
        <button class="haitaik-slider-arrow next" aria-label="Next Slide">&#10095;</button>

        <!-- Pagination Dots -->
        <div class="haitaik-slider-dots">
            <span class="dot active" data-index="0"></span>
            <span class="dot" data-index="1"></span>
            <span class="dot" data-index="2"></span>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var slides = document.querySelectorAll('.haitaik-slide');
    var dots = document.querySelectorAll('.haitaik-slider-dots .dot');
    var prevBtn = document.querySelector('.haitaik-slider-arrow.prev');
    var nextBtn = document.querySelector('.haitaik-slider-arrow.next');
    if (!slides.length) return;

    var currentIndex = 0;
    var timer = null;

    function goToSlide(index) {
        slides.forEach(function(s) { s.classList.remove('active'); });
        dots.forEach(function(d) { d.classList.remove('active'); });
        currentIndex = (index + slides.length) % slides.length;
        slides[currentIndex].classList.add('active');
        if (dots[currentIndex]) {
            dots[currentIndex].classList.add('active');
        }
    }

    function nextSlide() {
        goToSlide(currentIndex + 1);
    }

    function prevSlide() {
        goToSlide(currentIndex - 1);
    }

    function startAutoPlay() {
        stopAutoPlay();
        timer = setInterval(nextSlide, 4500);
    }

    function stopAutoPlay() {
        if (timer) clearInterval(timer);
    }

    if (nextBtn) nextBtn.addEventListener('click', function() { nextSlide(); startAutoPlay(); });
    if (prevBtn) prevBtn.addEventListener('click', function() { prevSlide(); startAutoPlay(); });

    dots.forEach(function(dot) {
        dot.addEventListener('click', function() {
            var idx = parseInt(this.getAttribute('data-index'), 10);
            goToSlide(idx);
            startAutoPlay();
        });
    });

    startAutoPlay();
});
</script><div id="c_static_001-1718094833424" class="response-animated">
<div class="e_container-1 s_layout response-transition">
    <div class="cbox-1-0 p_item"><div class="e_loop-2 s_list response-transition" needjs="true" ds-id="" elem-id="e_loop-2">
    <div class="">

        
            <div class="p_list">
                <div class="cbox-2 p_loopitem"><div class="e_container-3 s_layout response-transition">
    <div class="cbox-3-0 p_item"><div class="e_image-4 s_img response-transition">
                    <img src="https://omo-oss-image.thefastimg.com/portal-saas/pg2024041817493912440/cms/image/f48eb6e0-bbec-4306-a342-e6e66f658a81.jpg" alt="产品中心" title="产品中心" la="la" needthumb="false">
</div><div class="e_icon-6 s_title">
    <svg t="1718095136950" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="2983" width="200" height="200"><path d="M861.364706 289.129412l18.070588-18.070588c6.023529-12.047059 6.023529-24.094118 6.02353-36.141177-6.023529-12.047059-12.047059-24.094118-24.094118-30.117647L566.211765 36.141176c-36.141176-24.094118-84.329412-24.094118-120.470589 0L156.611765 204.8c-12.047059 0-18.070588 6.023529-18.070589 18.070588-6.023529 12.047059-12.047059 24.094118-6.023529 36.141177 6.023529 12.047059 12.047059 24.094118 24.094118 30.117647L451.764706 457.788235c18.070588 12.047059 42.164706 18.070588 60.235294 18.070589s42.164706-6.023529 60.235294-18.070589l289.129412-168.658823zM475.858824 403.576471L204.8 246.964706l277.082353-156.611765c18.070588-12.047059 42.164706-12.047059 60.235294 0L813.176471 246.964706 536.094118 403.576471c-18.070588 12.047059-42.164706 12.047059-60.235294 0zM421.647059 505.976471l-240.941177-138.541177c-12.047059 0-18.070588-6.023529-30.117647-6.023529-36.141176 0-60.235294 30.117647-60.235294 60.235294v307.2c0 42.164706 24.094118 84.329412 60.235294 102.4l240.941177 138.541176c12.047059 6.023529 18.070588 6.023529 30.117647 6.02353 36.141176 0 60.235294-24.094118 60.235294-60.235294v-307.2c0-42.164706-24.094118-78.305882-60.235294-102.4z m0 415.623529l-240.941177-138.541176c-18.070588-12.047059-30.117647-30.117647-30.117647-54.211765V421.647059l12.047059-24.094118L150.588235 421.647059l240.941177 138.541176c18.070588 12.047059 30.117647 30.117647 30.117647 54.211765v307.2zM873.411765 361.411765c-12.047059 0-18.070588 0-30.117647 6.023529l-240.941177 138.541177c-36.141176 24.094118-60.235294 60.235294-60.235294 102.4v307.2c0 36.141176 24.094118 60.235294 60.235294 60.235294 12.047059 0 18.070588 0 30.117647-6.02353l240.941177-138.541176c36.141176-24.094118 60.235294-60.235294 60.235294-102.4V421.647059c0-30.117647-24.094118-60.235294-60.235294-60.235294z m0 367.435294c0 24.094118-12.047059 42.164706-30.117647 54.211765l-240.941177 138.541176v-307.2c0-24.094118 12.047059-42.164706 30.117647-54.211765L873.411765 421.647059v307.2z" fill="#777777" p-id="2984"></path></svg>
</div><div class="e_container-5 s_layout">
    <div class="cbox-5-0 p_item"><p class="e_text-7 s_subtitle">
        产品中心
</p><p class="e_text-8 s_title">
<svg t="1718095751360" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6271" width="200" height="200"><path d="M512 624a112 112 0 1 0 0-224 112 112 0 0 0 0 224z" p-id="6272"></path></svg>    
        <a href="/led-display-power/" target="_self">
        LED显示屏电源
        </a>
</p><hr class="e_line-9 s_line"><p class="e_text-10 s_title">
  <svg t="1718095751360" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6271" width="200" height="200"><path d="M512 624a112 112 0 1 0 0-224 112 112 0 0 0 0 224z" p-id="6272"></path></svg>  
        <a href="/industrial-power/" target="_self">
        工业电源
        </a>
</p><hr class="e_line-11 s_line"><p class="e_text-12 s_title">
   <svg t="1718095751360" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6271" width="200" height="200"><path d="M512 624a112 112 0 1 0 0-224 112 112 0 0 0 0 224z" p-id="6272"></path></svg> 
        <a href="/lighting-power/" target="_self">
        LED照明电源
        </a>
</p></div>
</div></div>
</div></div>
                <div class="cbox-2 p_loopitem"><div class="e_container-3 s_layout response-transition">
    <div class="cbox-3-0 p_item"><div class="e_image-4 s_img response-transition">
                    <img src="https://omo-oss-image.thefastimg.com/portal-saas/pg2024041817493912440/cms/image/f678f9ce-f6ea-463f-ab98-6ddb0f9216db.jpg" alt="新闻资讯" title="新闻资讯" la="la" needthumb="false">
</div><div class="e_icon-6 s_title">
    <svg t="1718095197180" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4000" width="200" height="200"><path d="M885.333333 42.666667H181.333333a53.393333 53.393333 0 0 0-53.333333 53.333333v832a53.393333 53.393333 0 0 0 53.333333 53.333333h480a277.106667 277.106667 0 0 0 277.333334-277.333333V96a53.393333 53.393333 0 0 0-53.333334-53.333333zM181.333333 938.666667a10.666667 10.666667 0 0 1-10.666666-10.666667V96a10.666667 10.666667 0 0 1 10.666666-10.666667h704a10.666667 10.666667 0 0 1 10.666667 10.666667v608q0 10.786667-0.96 21.333333H736a53.393333 53.393333 0 0 0-53.333333 53.333334v159.04q-10.54 0.953333-21.333334 0.96z m544-8.873334V778.666667a10.666667 10.666667 0 0 1 10.666667-10.666667h151.126667A235.6 235.6 0 0 1 725.333333 929.793333zM597.333333 234.666667a21.333333 21.333333 0 0 1 21.333334-21.333334h128a21.333333 21.333333 0 0 1 0 42.666667H618.666667a21.333333 21.333333 0 0 1-21.333334-21.333333z m0 170.666666a21.333333 21.333333 0 0 1 21.333334-21.333333h128a21.333333 21.333333 0 0 1 0 42.666667H618.666667a21.333333 21.333333 0 0 1-21.333334-21.333334zM298.666667 618.666667a21.333333 21.333333 0 0 1 21.333333-21.333334h426.666667a21.333333 21.333333 0 0 1 0 42.666667H320a21.333333 21.333333 0 0 1-21.333333-21.333333z m341.333333 170.666666a21.333333 21.333333 0 0 1-21.333333 21.333334H320a21.333333 21.333333 0 0 1 0-42.666667h298.666667a21.333333 21.333333 0 0 1 21.333333 21.333333zM298.666667 448V234.666667a21.333333 21.333333 0 0 1 38-13.333334l132.666666 165.853334V234.666667a21.333333 21.333333 0 0 1 42.666667 0v213.333333a21.333333 21.333333 0 0 1-38 13.333333L341.333333 295.48V448a21.333333 21.333333 0 0 1-42.666666 0z" fill="#5C5C66" p-id="4001"></path></svg>
</div><div class="e_container-5 s_layout">
    <div class="cbox-5-0 p_item"><p class="e_text-7 s_subtitle">
        新闻资讯
</p><p class="e_text-8 s_title">
<svg t="1718095751360" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6271" width="200" height="200"><path d="M512 624a112 112 0 1 0 0-224 112 112 0 0 0 0 224z" p-id="6272"></path></svg>    
        <a href="/news/" target="_self">
        公司新闻
        </a>
</p><hr class="e_line-9 s_line"><p class="e_text-10 s_title" style="">
  <svg t="1718095751360" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6271" width="200" height="200"><path d="M512 624a112 112 0 1 0 0-224 112 112 0 0 0 0 224z" p-id="6272"></path></svg>  
        <a href="/news/" target="_self">
        行业新闻
        </a>
</p><hr class="e_line-11 s_line" style=""><p class="e_text-12 s_title">
   <svg t="1718095751360" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6271" width="200" height="200"><path d="M512 624a112 112 0 1 0 0-224 112 112 0 0 0 0 224z" p-id="6272"></path></svg> 
        <a href="/news/" target="_self">
        展会动态
        </a>
</p></div>
</div></div>
</div></div>
                <div class="cbox-2 p_loopitem"><div class="e_container-3 s_layout response-transition">
    <div class="cbox-3-0 p_item"><div class="e_image-4 s_img response-transition">
                    <img src="https://omo-oss-image.thefastimg.com/portal-saas/pg2024041817493912440/cms/image/aa94418b-6c0b-4669-b836-6470ce3d6ff7.jpg" alt="合作伙伴" title="合作伙伴" la="la" needthumb="false">
</div><div class="e_icon-6 s_title">
    <svg t="1718095377337" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="5250" width="200" height="200"><path d="M512 546.133333c-123.733333 0-221.866667-102.4-221.866667-221.866666S388.266667 98.133333 512 98.133333c123.733333 0 221.866667 102.4 221.866667 221.866667s-98.133333 226.133333-221.866667 226.133333z m0-384c-89.6 0-162.133333 72.533333-162.133333 162.133334s72.533333 157.866667 162.133333 157.866666c89.6 0 162.133333-72.533333 162.133333-162.133333S601.6 162.133333 512 162.133333z" fill="#0091FF" p-id="5251"></path><path d="M853.333333 887.466667c-17.066667 0-34.133333-12.8-34.133333-34.133334 0-170.666667-140.8-307.2-307.2-307.2-170.666667 0-307.2 136.533333-307.2 307.2 0 17.066667-12.8 34.133333-34.133333 34.133334s-34.133333-12.8-34.133334-34.133334c0-204.8 166.4-371.2 375.466667-371.2 204.8 0 375.466667 166.4 375.466667 371.2 0 17.066667-17.066667 34.133333-34.133334 34.133334zM768 503.466667c-17.066667 0-34.133333-12.8-34.133333-34.133334s17.066667-29.866667 34.133333-29.866666c51.2 0 93.866667-42.666667 93.866667-93.866667s-42.666667-98.133333-93.866667-98.133333c-17.066667 0-34.133333-12.8-34.133333-34.133334s17.066667-29.866667 34.133333-29.866666c89.6 0 162.133333 72.533333 162.133333 162.133333s-72.533333 157.866667-162.133333 157.866667z" fill="#0091FF" p-id="5252"></path><path d="M768 503.466667c-17.066667 0-34.133333-12.8-34.133333-34.133334s17.066667-29.866667 34.133333-29.866666c51.2 0 93.866667-42.666667 93.866667-93.866667s-42.666667-98.133333-93.866667-98.133333c-17.066667 0-34.133333-12.8-34.133333-34.133334s17.066667-29.866667 34.133333-29.866666c89.6 0 162.133333 72.533333 162.133333 162.133333s-72.533333 157.866667-162.133333 157.866667z" fill="#0091FF" p-id="5253"></path><path d="M981.333333 716.8c-17.066667 0-34.133333-12.8-34.133333-34.133333 0-98.133333-81.066667-179.2-179.2-179.2-17.066667 0-34.133333-12.8-34.133333-34.133334s17.066667-29.866667 34.133333-29.866666c136.533333 0 247.466667 110.933333 247.466667 247.466666 0 12.8-17.066667 29.866667-34.133334 29.866667z" fill="#0091FF" p-id="5254"></path><path d="M256 503.466667c-89.6 0-162.133333-72.533333-162.133333-162.133334S166.4 183.466667 256 183.466667c17.066667 0 34.133333 12.8 34.133333 34.133333s-17.066667 29.866667-34.133333 29.866667c-51.2 0-93.866667 42.666667-93.866667 93.866666s42.666667 98.133333 93.866667 98.133334c17.066667 0 34.133333 12.8 34.133333 34.133333s-17.066667 29.866667-34.133333 29.866667z" fill="#0091FF" p-id="5255"></path><path d="M256 503.466667c-89.6 0-162.133333-72.533333-162.133333-162.133334S166.4 183.466667 256 183.466667c17.066667 0 34.133333 12.8 34.133333 34.133333s-17.066667 29.866667-34.133333 29.866667c-51.2 0-93.866667 42.666667-93.866667 93.866666s42.666667 98.133333 93.866667 98.133334c17.066667 0 34.133333 12.8 34.133333 34.133333s-17.066667 29.866667-34.133333 29.866667z" fill="#0091FF" p-id="5256"></path><path d="M42.666667 716.8c-17.066667 0-34.133333-12.8-34.133334-34.133333 0-136.533333 110.933333-247.466667 247.466667-247.466667 17.066667 0 34.133333 12.8 34.133333 34.133333s-17.066667 34.133333-34.133333 34.133334c-98.133333 0-179.2 81.066667-179.2 179.2 0 17.066667-17.066667 34.133333-34.133333 34.133333z" fill="#0091FF" p-id="5257"></path></svg>
</div><div class="e_container-5 s_layout">
    <div class="cbox-5-0 p_item"><p class="e_text-7 s_subtitle">
        合作伙伴
</p><p class="e_text-8 s_title">
<svg t="1718095751360" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6271" width="200" height="200"><path d="M512 624a112 112 0 1 0 0-224 112 112 0 0 0 0 224z" p-id="6272"></path></svg>    
        <a href="/about-us/#c_static_001_P_12967-1718108864135" target="_self">
        LED显示屏电源合作伙伴
        </a>
</p><hr class="e_line-9 s_line"><p class="e_text-10 s_title">
  <svg t="1718095751360" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6271" width="200" height="200"><path d="M512 624a112 112 0 1 0 0-224 112 112 0 0 0 0 224z" p-id="6272"></path></svg>  
        <a href="/about-us/#c_static_001_P_12967-1718108864135" target="_self">
        工业电源合作伙伴
        </a>
</p><hr class="e_line-11 s_line"><p class="e_text-12 s_title">
   <svg t="1718095751360" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6271" width="200" height="200"><path d="M512 624a112 112 0 1 0 0-224 112 112 0 0 0 0 224z" p-id="6272"></path></svg> 
        <a href="/about-us/#c_static_001_P_12967-1718108864135" target="_self">
        LED照明电源合作伙伴
        </a>
</p></div>
</div></div>
</div></div>
            </div>
            <div class="p_page">
                
            <div class="page_con"></div>
        
            </div>
        
    </div>
    <input type="hidden" name="_config" value="">
    <input type="hidden" name="view" value="Home">
    <input type="hidden" name="pageParamsJson" value="">
    <input type="hidden" name="i18nJson" value="{&quot;confirm_2&quot;:&quot;确定&quot;,&quot;loadMore_2&quot;:&quot;点击加载更多&quot;,&quot;loadNow_2&quot;:&quot;加载中&quot;,&quot;noMore_2&quot;:&quot;没有更多了&quot;,&quot;clearConditions_2&quot;:&quot;清除条件&quot;,&quot;pageItem_2&quot;:&quot;条&quot;,&quot;noData_2&quot;:&quot;暂无数据&quot;,&quot;totalAcount_2&quot;:&quot;共 X 条&quot;,&quot;pageJump_2&quot;:&quot;跳转&quot;,&quot;conditions_2&quot;:&quot;条件:&quot;,&quot;pageWhole_2&quot;:&quot;共&quot;,&quot;pageUnit_2&quot;:&quot;页&quot;}">

</div></div>
</div>
 <input type="hidden" name="propJson" value="{&quot;dense_12&quot;:&quot;&quot;,&quot;href_8&quot;:{&quot;type&quot;:&quot;none&quot;,&quot;value&quot;:&quot;&quot;,&quot;target&quot;:&quot;&quot;},&quot;href_4&quot;:{&quot;type&quot;:&quot;&quot;,&quot;value&quot;:&quot;&quot;,&quot;target&quot;:&quot;&quot;},&quot;href_7&quot;:{&quot;type&quot;:&quot;none&quot;,&quot;value&quot;:&quot;&quot;,&quot;target&quot;:&quot;&quot;},&quot;href_6&quot;:{&quot;type&quot;:&quot;none&quot;,&quot;value&quot;:&quot;&quot;,&quot;target&quot;:&quot;&quot;},&quot;setting_4&quot;:{&quot;fit&quot;:&quot;contain&quot;,&quot;errorUrl&quot;:&quot;&quot;,&quot;needThumb&quot;:&quot;false&quot;,&quot;isLazy&quot;:&quot;false&quot;},&quot;dense_8&quot;:&quot;&quot;,&quot;pageConfig_2&quot;:{&quot;showJump&quot;:true,&quot;marquee&quot;:{&quot;navigation&quot;:true,&quot;marqueeTime&quot;:4,&quot;scrollType&quot;:&quot;horizontal&quot;,&quot;opp&quot;:false},&quot;filterPosition&quot;:&quot;&quot;,&quot;moColumn&quot;:1,&quot;rolling&quot;:{&quot;navigation&quot;:true,&quot;pageStyle&quot;:1,&quot;scrollType&quot;:&quot;horizontal&quot;,&quot;pagenation&quot;:true,&quot;scrollTime&quot;:4,&quot;autoScroll&quot;:true,&quot;speed&quot;:600},&quot;pageType&quot;:&quot;hidden&quot;,&quot;singleTotal&quot;:0,&quot;showButtom&quot;:false,&quot;showTotal&quot;:false,&quot;pcColumn&quot;:3,&quot;loopItem&quot;:&quot;.p_loopitem&quot;,&quot;status&quot;:true,&quot;pcRow&quot;:2,&quot;datasourceid&quot;:&quot;prop&quot;,&quot;elementid&quot;:2},&quot;dense_7&quot;:&quot;&quot;,&quot;page_2&quot;:{&quot;size&quot;:6,&quot;from&quot;:0,&quot;totalCount&quot;:100},&quot;imgList1_4&quot;:[],&quot;imgList2_4&quot;:[],&quot;space_4&quot;:0,&quot;prompt_10&quot;:&quot;&quot;,&quot;prompt_7&quot;:&quot;&quot;,&quot;prompt_8&quot;:&quot;&quot;,&quot;prompt_12&quot;:&quot;&quot;,&quot;href_12&quot;:{&quot;type&quot;:&quot;none&quot;,&quot;value&quot;:&quot;&quot;,&quot;target&quot;:&quot;&quot;},&quot;dense_10&quot;:&quot;&quot;,&quot;href_10&quot;:{&quot;type&quot;:&quot;none&quot;,&quot;value&quot;:&quot;&quot;,&quot;target&quot;:&quot;&quot;}}"></div>
<!-- /wp:html -->
