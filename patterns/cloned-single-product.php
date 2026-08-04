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
            'name' => get_the_title() . ' Specification',
            'url'  => $custom_meta_file,
        );
    }
}

// Fallback spec PDF file
if ( empty( $product_downloads ) ) {
    $product_downloads[] = array(
        'name' => get_the_title() . ' Specification.pdf',
        'url'  => get_template_directory_uri() . '/assets/upload/specification.pdf',
    );
}
?>
<!-- wp:html -->
<div id="c_banner_008_P_312-17162638816070">

 <input type="hidden" name="propJson" value='{}'/></div><div id="c_static_001_P_24351-17162640648450">
<div class="e_container-1 s_layout">
    <div class="cbox-1-0 p_item"><div class="e_breadcrumb-2 s_list">
    <ul class="p_breadcrumb" style="display: flex; align-items: center; gap: 8px; font-size: 14px; color: #666; margin: 0; padding: 0; list-style: none;">
        <li class="p_breadcrumbItem">
            <a href="/" style="color: #666; text-decoration: none; display: inline-flex; align-items: center;">
                <span class="text-secondary p_icon" style="margin-right: 4px;">
                    <svg class="icon" viewBox="0 0 1029 1024" width="14" height="14" style="fill: #666;">
                        <path d="M44.799492 528.986943a42.836848 42.836848 0 0 1-31.231646-13.567846 42.725916 42.725916 0 0 1 2.133309-60.329983L491.685094 11.446142a42.68325 42.68325 0 0 1 58.538003 0.34133l465.658723 443.642972c17.066473 16.21315 17.749132 43.26351 1.45065 60.329983s-43.26351 17.749132-60.329983 1.45065L520.442102 101.301124 73.897829 517.552406c-8.27724 7.679913-18.687788 11.434537-29.098337 11.434537z"></path>
                    </svg>
                </span>
                Home
            </a>
        </li>
        <li style="color: #ccc;">/</li>
        <li class="p_breadcrumbItem">
            <a href="/led-display-power/" style="color: #666; text-decoration: none;">Products</a>
        </li>
        <li style="color: #ccc;">/</li>
        <li class="p_breadcrumbItem" style="color: #333; font-weight: 500;">
            <?php the_title(); ?>
        </li>
    </ul>
</div>
</div>
</div>
 <input type="hidden" name="propJson" value='{}'/></div><div id="c_product_detail_007_P_002-17186726622280">
<div class="e_container-1 s_layout">
    <div class="cbox-1-0 p_item"><div class="e_magnifier-59 s_list" needjs="true">
    <div class="magnifier thumb_bottom" id="magnifierWrapper">
        <div class="magnifier-container">
            <!--图片容器-->
            <div class="images-cover">
                <?php foreach ( $product_images as $index => $img_url ) : ?>
                    <div class="image-item static-item<?php echo $index === 0 ? ' active' : ''; ?>" style="<?php echo $index === 0 ? 'display: flex;' : ''; ?>">
                        <img src="<?php echo esc_url( $img_url ); ?>" lazy="<?php echo esc_url( $img_url ); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" la="la"/>
                    </div>
                <?php endforeach; ?>
            </div>
            <!--右下角的加号-->
            <div class="image-bigger">
                <div class="add-icon">+</div>
            </div>
            <!--跟随鼠标移动的盒子-->
            <div class="move-view"></div>
        </div>
        <div class="magnifier-assembly">
            <!--按钮组-->
            <div class="magnifier-btn">
                <span class="magnifier-btn-left"><svg t="1646298466594" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="5178" width="200" height="200"><path d="M352.60436487 538.8676877L614.1116972 824.41834163c14.26666975 15.57022334 38.38241101 16.58409834 53.88021469 2.38984824 15.57022334-14.26666975 16.58409834-38.38241101 2.38984823-53.88021469L432.41081189 513.08629466l237.7536893-260.56587697c14.1942501-15.57022334 13.10795545-39.68596458-2.46226787-53.88021469-15.57022334-14.1942501-39.68596458-13.10795545-53.88021469 2.46226788L352.74920415 487.08764267c-0.50693751 0.57935715-1.08629466 1.23113394-1.52081251 1.8104911-11.87682152 14.41150904-11.6595626 35.77530383 1.37597323 49.96955393z" p-id="5179"></path></svg></span>
                <span class="magnifier-btn-right"><svg t="1646298477962" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="5312" width="200" height="200"><path d="M661.16183428 486.94732961L415.99871022 219.24359155c-13.37500289-14.59708438-35.98351032-15.54759219-50.51270128-2.24048272-14.59708438 13.37500289-15.54759219 35.98351032-2.24048272 50.51270127l223.09776396 243.60157549-222.89408371 244.28050967c-13.30710947 14.59708438-12.28870823 37.20559179 2.30837613 50.51270125 14.59708438 13.30710947 37.20559179 12.28870823 50.51270128-2.30837613l244.75576356-268.11109855c0.47525392-0.54314733 1.01840124-1.15418807 1.42576173-1.6973354 11.13452018-13.51078973 10.93083994-33.53934734-1.2899749-46.84645682z" p-id="5313"></path></svg></span>
            </div>
            <!--缩略图-->
            <div class="magnifier-line js-magnifier-line">
                <ul class="clearfix animation03 thumbnail_box">
                    <?php foreach ( $product_images as $index => $img_url ) : ?>
                        <li class="static-img<?php echo $index === 0 ? ' active' : ''; ?>">
                            <div class="small-img" data-url="<?php echo esc_attr( $img_url ); ?>">
                                <img src="<?php echo esc_url( $img_url ); ?>" lazy="<?php echo esc_url( $img_url ); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" la="la"/>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <!--经过放大的图片显示容器-->
        <div class="magnifier-view"></div>
    </div>
    <script>
    (function() {
        var initGallery = function() {
            var wrapper = document.getElementById('magnifierWrapper');
            if (!wrapper) return;
            var thumbnails = wrapper.querySelectorAll('.thumbnail_box li');
            var items = wrapper.querySelectorAll('.images-cover .image-item');
            
            thumbnails.forEach(function(thumb, idx) {
                thumb.addEventListener('click', function() {
                    thumbnails.forEach(function(t) { t.classList.remove('active'); });
                    items.forEach(function(item) { 
                        item.classList.remove('active');
                        item.style.display = 'none';
                    });
                    thumb.classList.add('active');
                    if (items[idx]) {
                        items[idx].classList.add('active');
                        items[idx].style.display = 'flex';
                    }
                });
            });
        };
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initGallery);
        } else {
            initGallery();
        }
    })();
    </script>
</div></div>
    <div class="cbox-1-1 p_item"><div class="e_container-3 s_layout">
    <div class="cbox-3-0 p_item"><div class="e_container-51 s_layout">
    <div class="cbox-51-0 p_item"><h1 class="e_h1-45 s_subtitle">
    <?php the_title(); ?>
</h1><div class="e_container-41 s_layout">
    <div class="cbox-41-0 p_item"><p class="e_text-42 s_title">
    所属分类：
</p></div>
    <div class="cbox-41-1 p_item"><div class="e_loop_sub-43 s_list">
        <div class="cbox-43 p_loopItem"><p class="e_text-44 s_title">
        <a href="/led-display-power/" target="_self">
        均流备份系列
        </a>
</p></div>
</div></div>
</div></div>
    <div class="cbox-51-1 p_item" style="display: flex; gap: 10px; align-items: center;">
        <a class="e_button-46 s_button1 btn btn-primary " href="#c_form_050-1718776303318" target="_self">
            <span><svg t="1718779224235" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3021" width="200" height="200"><path d="M353.745455 996.072727H139.636364c-69.818182 0-125.672727-55.854545-125.672728-125.672727V144.290909C13.963636 74.472727 69.818182 18.618182 139.636364 18.618182h679.563636c69.818182 0 125.672727 55.854545 125.672727 125.672727v223.418182c0 23.272727-18.618182 46.545455-41.890909 46.545454s-41.890909-18.618182-41.890909-46.545454V144.290909c0-18.618182-18.618182-37.236364-37.236364-37.236364H139.636364c-18.618182 0-37.236364 18.618182-37.236364 37.236364v726.109091c0 18.618182 18.618182 37.236364 37.236364 37.236364h214.109091c23.272727 0 41.890909 18.618182 41.890909 46.545454 0 18.618182-18.618182 41.890909-41.890909 41.890909z" fill="#ffffff" p-id="3022"></path><path d="M679.563636 339.781818H200.145455c-27.927273 0-46.545455-18.618182-46.545455-46.545454s18.618182-46.545455 46.545455-46.545455h479.418181c27.927273 0 46.545455 18.618182 46.545455 46.545455s-23.272727 46.545455-46.545455 46.545454zM465.454545 553.890909H200.145455c-27.927273 0-46.545455-18.618182-46.545455-46.545454s18.618182-46.545455 46.545455-46.545455H465.454545c27.927273 0 46.545455 18.618182 46.545455 46.545455s-18.618182 46.545455-46.545455 46.545454z" fill="#ffffff" p-id="3023"></path><path d="M935.563636 572.509091c9.309091-9.309091 13.963636-27.927273 4.654546-37.236364-9.309091-9.309091-27.927273-13.963636-37.236364-4.654545L539.927273 884.363636l-13.963637 41.890909 46.545455-4.654545c4.654545 0 363.054545-349.090909 363.054545-349.090909z m41.890909-74.472727c27.927273 32.581818 23.272727 83.781818-9.30909 111.709091L605.090909 968.145455c-4.654545 4.654545-9.309091 4.654545-13.963636 4.654545l-97.745455 9.309091c-13.963636 0-27.927273-9.309091-27.927273-23.272727v-9.309091l27.927273-88.436364c0-4.654545 4.654545-9.309091 9.309091-13.963636l367.709091-358.4c27.927273-27.927273 79.127273-23.272727 107.054545 9.309091z" fill="#ffffff" p-id="3024"></path><path d="M488.727273 996.072727c-18.618182 0-37.236364-13.963636-37.236364-37.236363v-13.963637l27.927273-88.436363c0-9.309091 4.654545-13.963636 13.963636-18.618182l363.054546-358.4c37.236364-32.581818 97.745455-27.927273 130.327272 9.309091 13.963636 18.618182 23.272727 41.890909 23.272728 65.163636 0 23.272727-13.963636 46.545455-32.581819 60.509091L614.4 977.454545c-4.654545 4.654545-13.963636 9.309091-23.272727 9.309091l-102.4 9.309091c4.654545 0 4.654545 0 0 0z m428.218182-512c-13.963636 0-32.581818 4.654545-46.545455 13.963637l-363.054545 358.4c-4.654545 4.654545-4.654545 4.654545-4.654546 9.309091l-27.927273 88.436363v4.654546c0 4.654545 0 9.309091 4.654546 9.309091 4.654545 4.654545 4.654545 4.654545 9.309091 4.654545l97.745454-9.309091c4.654545 0 4.654545 0 9.309091-4.654545l367.709091-358.4c13.963636-13.963636 23.272727-27.927273 23.272727-46.545455s-4.654545-37.236364-18.618181-51.2c-13.963636-9.309091-32.581818-18.618182-51.2-18.618182zM512 940.218182l18.618182-60.509091 363.054545-353.745455c18.618182-13.963636 41.890909-13.963636 55.854546 4.654546 13.963636 13.963636 13.963636 41.890909-4.654546 51.2l-363.054545 353.745454-69.818182 4.654546z m37.236364-51.2l-9.309091 23.272727h27.927272l358.4-349.090909c4.654545-4.654545 4.654545-13.963636 0-18.618182-4.654545-4.654545-13.963636-9.309091-23.272727 0l-353.745454 344.436364z" fill="#ffffff" p-id="3025"></path></svg> 样品申请 </span> 
        </a>

        <?php if ( ! empty( $product_downloads ) ) : ?>
            <?php foreach ( $product_downloads as $file_item ) : ?>
                <a class="e_button-46 s_button1 btn btn-secondary" href="<?php echo esc_url( $file_item['url'] ); ?>" download target="_blank" style="background-color: #0094de; border-color: #0094de; color: #fff; padding: 12px 20px; border-radius: 4px; text-decoration: none; display: inline-flex; align-items: center; font-weight: 500;">
                    <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" style="fill: #fff; margin-right: 6px;">
                        <path d="M512 666.666667L256 410.666667h170.666667V170.666667h170.666666v240h170.666667L512 666.666667z M170.666667 768h682.666666v85.333333H170.666667V768z"></path>
                    </svg>
                    下载规格书
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div><hr class="e_line-26 s_line" /><div class="e_richText-39 s_summary clearfix">
    <?php the_content(); ?>
</div></div>
</div></div>
    <div class="cbox-14-0 p_item"><div class="e_container-15 s_layout">
    <div class="cbox-15-0 p_item"><div class="e_container-16 s_layout">
    <div class="cbox-16-0 p_item"><p class="e_text-47 s_title">
        产品详情
</p></div>
</div><hr class="e_line-19 s_line" /><div class="e_container-27 s_layout">
    <div class="cbox-27-0 p_item"><div class="e_richText-20 s_title clearfix">
    
</div></div>
</div></div>
</div></div>
</div>
 <input type="hidden" name="propJson" value='{}'/></div><div id="c_form_050-1718776303318">
<div class="e_container-1 s_layout">
    <div class="cbox-1-0 p_item"><div class="e_container-2 s_layout">
    <div class="cbox-2-0 p_item"><p class="e_text-14 s_title">
    样品申请
</p></div>
    <div class="cbox-2-1 p_item"><div class="e_form-15 s_form_layout1" needjs="true">
    <form name="form" action="" method="post" isvalid="true" class="form_15">
        <div class="p_formItem">
            
            <div class="e_input-16 s_input">
    <div class="p_labelItem">
        <label for="company_name">公司名称<span class="p_mustFill">*</span></label>
    </div>
    <div class="p_inputItem">
        
            <input type="text" class="form-control s_input" id="company_name" name="company_name" placeholder="" isvalid="true" reg="" data-content="请输入公司名称" maxlength="255">
        
    </div>
</div>
        
            <div class="e_input-17 s_input">
    <div class="p_labelItem">
        <label for="contact_person">联系人<span class="p_mustFill">*</span></label>
    </div>
    <div class="p_inputItem">
        
            <input type="text" class="form-control s_input" id="contact_person" name="contact_person" placeholder="" isvalid="true" reg="" data-content="请输入联系人" maxlength="255">
        
    </div>
</div>
        
            <div class="e_input-18 s_input">
    <div class="p_labelItem">
        <label for="email">电子邮箱<span class="p_mustFill">*</span></label>
    </div>
    <div class="p_inputItem">
        
            <input type="text" class="form-control s_input" id="email" name="email" placeholder="" isvalid="true" reg="" data-content="请输入电子邮箱" maxlength="255">
        
    </div>
</div>
        
            <div class="e_input-19 s_input">
    <div class="p_labelItem">
        <label for="tel">联系电话<span class="p_mustFill">*</span></label>
    </div>
    <div class="p_inputItem">
        
            <input type="text" class="form-control s_input" id="tel" name="tel" placeholder="" isvalid="true" reg="" data-content="请输入联系电话" maxlength="255">
        
    </div>
</div>
        
            <div class="e_input-20 s_input">
    <div class="p_labelItem">
        <label for="application_model">申请型号<span class="p_mustFill">*</span></label>
    </div>
    <div class="p_inputItem">
        
            <input type="text" class="form-control s_input" id="application_model" name="application_model" placeholder="" isvalid="true" reg="" data-content="请输入申请型号" maxlength="255">
        
    </div>
</div>
        
            <div class="e_textarea-21 s_input">
    <div class="p_labelItem">
        <label for="remarks">备注说明</label>
    </div>
    <div class="p_inputItem">
        <textarea class="form-control s_input" id="remarks" name="remarks" placeholder="" isvalid="true" reg="" data-content="" maxlength="500"></textarea>
    </div>
</div>
        
            <div class="e_formBtn-22 s_button">
    <div class="p_btnItem">
        <button type="submit" class="btn btn-primary s_btn">提交申请</button>
    </div>
</div>
        
        </div>
    </form>
</div></div>
</div></div>
</div></div>
<!-- /wp:html -->