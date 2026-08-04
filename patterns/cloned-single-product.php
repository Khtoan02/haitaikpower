<?php
/**
 * Title: Cloned Single Product
 * Slug: twentytwentyfive/cloned-single-product
 * Categories: twentytwentyfive_page, featured
 * Description: Dynamic single product detail layout integrated with WooCommerce database images and download files.
 */

global $product;
if ( ! is_a( $product, 'WC_Product' ) ) {
    $product = wc_get_product( get_the_ID() );
}

// 1. Fetch WooCommerce Product Images dynamically
$product_images = array();
if ( $product ) {
    $featured_img_id = $product->get_image_id();
    if ( $featured_img_id ) {
        $url = wp_get_attachment_image_url( $featured_img_id, 'full' );
        if ( $url ) {
            $product_images[] = $url;
        }
    }
    $gallery_img_ids = $product->get_gallery_image_ids();
    if ( ! empty( $gallery_img_ids ) ) {
        foreach ( $gallery_img_ids as $g_id ) {
            $url = wp_get_attachment_image_url( $g_id, 'full' );
            if ( $url && ! in_array( $url, $product_images ) ) {
                $product_images[] = $url;
            }
        }
    }
}

// Fallback gallery images if no custom WooCommerce product images are uploaded yet
if ( empty( $product_images ) ) {
    $product_images = array(
        'https://omo-oss-image.thefastimg.com/portal-saas/pg2024041817493912440/cms/image/ff0a2487-4a70-4f2c-b435-fe25ef47debd.png',
        'https://omo-oss-image.thefastimg.com/portal-saas/pg2024041817493912440/cms/image/741b2444-2297-40a9-a469-0ca0785637a2.png',
        'https://omo-oss-image.thefastimg.com/portal-saas/pg2024041817493912440/cms/image/0b5b889f-4af9-4a24-aede-544a68e9b31a.png',
        'https://omo-oss-image.thefastimg.com/portal-saas/pg2024041817493912440/cms/image/69a20c9d-023e-4da7-9cf3-61cd116fefd1.png'
    );
}

// 2. Fetch WooCommerce Product Downloadable Files dynamically
$product_downloads = array();
if ( $product ) {
    $wc_downloads = $product->get_downloads();
    if ( ! empty( $wc_downloads ) ) {
        foreach ( $wc_downloads as $file_id => $dw ) {
            $product_downloads[] = array(
                'name' => $dw->get_name(),
                'url'  => $dw->get_file(),
            );
        }
    }
    
    // Custom post meta download file
    $custom_meta_file = get_post_meta( get_the_ID(), '_spec_file', true );
    if ( $custom_meta_file ) {
        $product_downloads[] = array(
            'name' => get_the_title() . ' 规格书',
            'url'  => $custom_meta_file,
        );
    }
}

// Fallback spec PDF file
if ( empty( $product_downloads ) ) {
    $product_downloads[] = array(
        'name' => get_the_title() . ' 规格书.pdf',
        'url'  => get_template_directory_uri() . '/assets/upload/specification.pdf',
    );
}
?>
<!-- wp:html -->
<style>
/* Fix header background and overlap on Single Product page */
#site-header,
.site-header,
.e_container-21.s_layout,
.e_container-21.fIxBox,
#c_grid-116273709439191 {
    background-color: #192028 !important;
}

.site-header a,
.site-header span,
.site-header h2 a,
.p_navBox1 .p_navItem1 a span,
.e_navigationF-24 a span {
    color: #ffffff !important;
}

.site-header svg path {
    fill: #ffffff !important;
}

.single-product-page-container {
    max-width: 1200px;
    margin: 140px auto 40px auto !important;
    padding: 20px;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    color: #333;
}
.single-product-breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    color: #666;
    margin-bottom: 30px;
    list-style: none;
    padding: 0;
}
.single-product-top-grid {
    display: grid;
    grid-template-columns: minmax(320px, 450px) 1fr;
    gap: 40px;
    margin-bottom: 50px;
    align-items: start;
}
@media (max-width: 768px) {
    .single-product-top-grid {
        grid-template-columns: 1fr;
    }
}
.single-product-gallery-box {
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    background: #ffffff;
    padding: 15px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
}
.single-product-main-img-wrap {
    height: 380px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}
.single-product-main-img-wrap img {
    max-width: 100% !important;
    max-height: 360px !important;
    width: auto !important;
    height: auto !important;
    object-fit: contain !important;
    filter: none !important;
    image-rendering: -webkit-optimize-contrast;
}
.single-product-thumbs {
    display: flex;
    gap: 10px;
    margin-top: 15px;
    list-style: none;
    padding: 0;
    justify-content: center;
}
.single-product-thumbs li {
    width: 60px;
    height: 60px;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    padding: 3px;
    cursor: pointer;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
}
.single-product-thumbs li.active {
    border-color: #e40011 !important;
    box-shadow: 0 0 0 1px #e40011;
}
.single-product-thumbs li img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}
.single-product-info-box h1 {
    font-size: 26px;
    font-weight: 700;
    color: #1a202c;
    margin: 0 0 15px 0;
    line-height: 1.3;
}
.single-product-category-tag {
    font-size: 14px;
    color: #64748b;
    margin-bottom: 20px;
}
.single-product-category-tag span {
    color: #e40011;
    font-weight: 500;
}
.single-product-action-btns {
    display: flex;
    gap: 12px;
    margin-bottom: 25px;
    flex-wrap: wrap;
}
.single-product-action-btns .btn-apply {
    background-color: #e40011;
    color: #fff;
    padding: 12px 24px;
    border-radius: 4px;
    text-decoration: none;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}
.single-product-action-btns .btn-spec {
    background-color: #0094de;
    color: #fff;
    padding: 12px 24px;
    border-radius: 4px;
    text-decoration: none;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}
.single-product-summary-box {
    border-top: 1px solid #e2e8f0;
    padding-top: 20px;
    font-size: 14px;
    color: #475569;
    line-height: 1.7;
}

/* Product Details Full Width Section */
.single-product-details-section {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 30px;
    margin-bottom: 40px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.03);
}
.single-product-details-title {
    font-size: 20px;
    font-weight: 700;
    color: #1e293b;
    margin: 0 0 20px 0;
    padding-bottom: 12px;
    border-bottom: 2px solid #e40011;
    display: inline-block;
}

/* Form Section Clean Styling */
.single-product-form-section {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 35px;
    margin-bottom: 40px;
}
.single-product-form-title {
    font-size: 20px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 20px;
    padding-left: 12px;
    border-left: 4px solid #e40011;
}
.single-product-form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
}
.single-product-form-field {
    display: flex;
    flex-direction: column;
    gap: 6px;
}
.single-product-form-field.full-width {
    grid-column: 1 / -1;
}
.single-product-form-field label {
    font-size: 14px;
    font-weight: 600;
    color: #334155;
}
.single-product-form-field label span {
    color: #e40011;
}
.single-product-form-field input,
.single-product-form-field textarea {
    width: 100%;
    padding: 10px 14px;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    font-size: 14px;
    background: #ffffff;
    box-sizing: border-box;
    transition: border-color 0.2s, box-shadow 0.2s;
}
.single-product-form-field input:focus,
.single-product-form-field textarea:focus {
    border-color: #e40011;
    outline: none;
    box-shadow: 0 0 0 3px rgba(228, 0, 17, 0.1);
}
.single-product-form-submit-btn {
    background: #e40011;
    color: #ffffff;
    border: none;
    padding: 12px 30px;
    border-radius: 6px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
}
.single-product-form-submit-btn:hover {
    background: #c8000f;
}
</style>

<div class="single-product-page-container">
    <!-- Breadcrumb -->
    <ul class="single-product-breadcrumb">
        <li><a href="/" style="color: #666; text-decoration: none;">首页</a></li>
        <li>/</li>
        <li><a href="/led-display-power/" style="color: #666; text-decoration: none;">产品中心</a></li>
        <li>/</li>
        <li style="color: #1a202c; font-weight: 600;"><?php the_title(); ?></li>
    </ul>

    <!-- Top Product Header Grid -->
    <div class="single-product-top-grid">
        <!-- Gallery -->
        <div class="single-product-gallery-box">
            <div class="single-product-main-img-wrap" id="mainImgWrap">
                <?php foreach ( $product_images as $index => $img_url ) : ?>
                    <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php the_title_attribute(); ?>" style="<?php echo $index === 0 ? 'display: block;' : 'display: none;'; ?>" class="product-gallery-img" />
                <?php endforeach; ?>
            </div>
            <?php if ( count( $product_images ) > 1 ) : ?>
                <ul class="single-product-thumbs" id="thumbList">
                    <?php foreach ( $product_images as $index => $img_url ) : ?>
                        <li class="<?php echo $index === 0 ? 'active' : ''; ?>" data-index="<?php echo $index; ?>">
                            <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php the_title_attribute(); ?>" />
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>

        <!-- Details Info -->
        <div class="single-product-info-box">
            <h1><?php the_title(); ?></h1>
            <div class="single-product-category-tag">
                所属分类：<span>均流备份系列</span>
            </div>

            <div class="single-product-action-btns">
                <a class="btn-apply" href="#sampleForm">
                    <svg viewBox="0 0 1024 1024" width="16" height="16" style="fill: #fff;"><path d="M353.745455 996.072727H139.636364c-69.818182 0-125.672727-55.854545-125.672728-125.672727V144.290909C13.963636 74.472727 69.818182 18.618182 139.636364 18.618182h679.563636c69.818182 0 125.672727 55.854545 125.672727 125.672727v223.418182c0 23.272727-18.618182 46.545455-41.890909 46.545454s-41.890909-18.618182-41.890909-46.545454V144.290909c0-18.618182-18.618182-37.236364-37.236364-37.236364H139.636364c-18.618182 0-37.236364 18.618182-37.236364 37.236364v726.109091c0 18.618182 18.618182 37.236364 37.236364 37.236364h214.109091c23.272727 0 41.890909 18.618182 41.890909 46.545454 0 18.618182-18.618182 41.890909-41.890909 41.890909z"></path></svg>
                    样品申请
                </a>
                <?php if ( ! empty( $product_downloads ) ) : ?>
                    <?php foreach ( $product_downloads as $file_item ) : ?>
                        <a class="btn-spec" href="<?php echo esc_url( $file_item['url'] ); ?>" download target="_blank">
                            <svg viewBox="0 0 1024 1024" width="16" height="16" style="fill: #fff;"><path d="M512 666.666667L256 410.666667h170.666667V170.666667h170.666666v240h170.666667L512 666.666667z M170.666667 768h682.666666v85.333333H170.666667V768z"></path></svg>
                            下载规格书
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="single-product-summary-box">
                <?php if ( has_excerpt() ) : ?>
                    <?php echo wp_kses_post( get_the_excerpt() ); ?>
                <?php else : ?>
                    <p>高品质低压电路保护与工业电源解决方案，符合国际 IEC/UL 安规标准，具备过载、短路全方位保护功能。</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Product Details Section (100% Full Width) -->
    <div class="single-product-details-section">
        <h2 class="single-product-details-title">产品详情</h2>

        <?php 
        $post_content = get_the_content();
        if ( ! empty( trim( $post_content ) ) ) : 
        ?>
            <div class="product-description-body" style="font-size: 15px; line-height: 1.8; color: #444; margin-bottom: 30px;">
                <?php echo apply_filters( 'the_content', $post_content ); ?>
            </div>
        <?php endif; ?>

        <div class="product-spec-container" style="font-family: inherit; color: #333; margin-top: 10px;">
            <h3 style="font-size: 17px; font-weight: 600; color: #1e293b; margin-bottom: 15px; padding-left: 10px; border-left: 4px solid #e40011;">
                产品特点 (Product Features)
            </h3>
            <ul style="list-style: disc; margin-left: 25px; font-size: 14px; line-height: 1.8; color: #475569; margin-bottom: 25px;">
                <li>工业级高品质设计，符合国际安规与 EMC 电磁兼容标准。</li>
                <li>全范围交流输入（90~264VAC / 180~264VAC），具备强适应能力。</li>
                <li>内置完善的保护电路：短路保护、过载保护、过电压保护、过温度保护。</li>
                <li>100% 满负载高温老化测试，确保长期稳定运行与超长使用寿命。</li>
                <li>高效节能，低功耗、低温升，适用于各种苛刻工业环境。</li>
            </ul>

            <h3 style="font-size: 17px; font-weight: 600; color: #1e293b; margin-bottom: 15px; padding-left: 10px; border-left: 4px solid #e40011;">
                技术参数 (Technical Specifications)
            </h3>
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px; font-size: 14px; text-align: left; border: 1px solid #e2e8f0;">
                <tbody>
                    <tr style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                        <th style="padding: 12px 15px; font-weight: 600; color: #334155; width: 25%;">产品型号 (Model)</th>
                        <td style="padding: 12px 15px; color: #0f172a; font-weight: 600;"><?php the_title(); ?></td>
                    </tr>
                    <tr style="border-bottom: 1px solid #e2e8f0;">
                        <th style="padding: 12px 15px; font-weight: 600; color: #334155;">输入电压 (Input Voltage)</th>
                        <td style="padding: 12px 15px; color: #475569;">100~240VAC / 180~264VAC 50/60Hz</td>
                    </tr>
                    <tr style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                        <th style="padding: 12px 15px; font-weight: 600; color: #334155;">工作温度 (Working Temp.)</th>
                        <td style="padding: 12px 15px; color: #475569;">-30℃ ~ +70℃ (自然风冷 / 智能风冷)</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #e2e8f0;">
                        <th style="padding: 12px 15px; font-weight: 600; color: #334155;">防护与绝缘 (Protection Class)</th>
                        <td style="padding: 12px 15px; color: #475569;">Class I，符合 GB4943 / IEC62368 / UL60950 / IEC 60947-2 标准</td>
                    </tr>
                    <tr style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                        <th style="padding: 12px 15px; font-weight: 600; color: #334155;">主要应用 (Applications)</th>
                        <td style="padding: 12px 15px; color: #475569;">LED显示屏、工业自动化控制、通讯设备、商业建筑、电力系统保护</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #e2e8f0;">
                        <th style="padding: 12px 15px; font-weight: 600; color: #334155;">品质保障 (Warranty)</th>
                        <td style="padding: 12px 15px; color: #475569;">原装正品，符合 CE / UL / ROHS 认证，提供 36 个月原厂质保</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Sample Application Form (100% Clean Form Layout) -->
    <div class="single-product-form-section" id="sampleForm">
        <h2 class="single-product-form-title">样品申请</h2>
        <form name="sample_application_form" action="" method="post" onsubmit="alert('提交成功！我们将尽快与您联系。'); return false;">
            <div class="single-product-form-grid">
                <div class="single-product-form-field">
                    <label for="company_name">公司名称 <span>*</span></label>
                    <input type="text" id="company_name" name="company_name" required placeholder="请输入公司名称" />
                </div>
                <div class="single-product-form-field">
                    <label for="contact_person">联系人 <span>*</span></label>
                    <input type="text" id="contact_person" name="contact_person" required placeholder="请输入联系人" />
                </div>
                <div class="single-product-form-field">
                    <label for="email">电子邮箱 <span>*</span></label>
                    <input type="email" id="email" name="email" required placeholder="请输入电子邮箱" />
                </div>
                <div class="single-product-form-field">
                    <label for="tel">联系电话 <span>*</span></label>
                    <input type="tel" id="tel" name="tel" required placeholder="请输入联系电话" />
                </div>
                <div class="single-product-form-field full-width">
                    <label for="application_model">申请型号 <span>*</span></label>
                    <input type="text" id="application_model" name="application_model" required value="<?php echo esc_attr( get_the_title() ); ?>" placeholder="请输入申请型号" />
                </div>
                <div class="single-product-form-field full-width">
                    <label for="remarks">备注说明</label>
                    <textarea id="remarks" name="remarks" rows="4" placeholder="请输入备注或具体需求"></textarea>
                </div>
                <div class="single-product-form-field full-width" style="margin-top: 10px;">
                    <button type="submit" class="single-product-form-submit-btn">提交申请</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
(function() {
    var thumbList = document.getElementById('thumbList');
    var mainImgWrap = document.getElementById('mainImgWrap');
    if (thumbList && mainImgWrap) {
        var thumbs = thumbList.querySelectorAll('li');
        var imgs = mainImgWrap.querySelectorAll('img');
        thumbs.forEach(function(thumb) {
            thumb.addEventListener('click', function() {
                var idx = parseInt(this.getAttribute('data-index'), 10);
                thumbs.forEach(function(t) { t.classList.remove('active'); });
                imgs.forEach(function(img) { img.style.display = 'none'; });
                this.classList.add('active');
                if (imgs[idx]) {
                    imgs[idx].style.display = 'block';
                }
            });
        });
    }
})();
</script>
<!-- /wp:html -->