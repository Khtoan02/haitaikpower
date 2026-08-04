<?php
/**
 * The Header for Twenty Twenty-Five Standalone Haitaik Theme.
 * Displays all of the <head> section and header navigation module.
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <?php if ( is_singular( 'product' ) || is_singular( 'post' ) || is_home() || is_page( array( 'products', 'product', 'faq', 'frequently-asked-questions' ) ) ) : ?>
    <style>
    /* White Header Styles for light background pages */
    #site-header,
    .site-header,
    .e_container-21,
    .e_container-21.fIxBox,
    #c_grid-116273709439191 {
        background-color: #ffffff !important;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05) !important;
    }
    .p_navBox1 .p_navItem1 a span,
    .p_navBox1 .p_navItem1 a,
    .top_f h2 a,
    .e_navigationF-24 a span,
    .e_navigationF-24 a,
    .e_container-21 a,
    .e_container-21 span {
        color: #222429 !important;
    }
    .p_navBox1 .p_navItem1 a:hover span,
    .top_f h2 a:hover {
        color: #e40011 !important;
    }
    .e_image-16 img:first-child {
        display: none !important;
    }
    .e_image-16 img:last-child {
        display: inline-block !important;
        max-height: 48px !important;
        width: auto !important;
    }
    </style>
    <?php endif; ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Header Module -->
<header id="site-header" class="site-header">
<div id="c_grid-116273709439191">    <div class="p_gridbox signal s_tmpl">
            <div id="content_box-116273709439191-0" class="d_gridCell_0 p_gridCell ND_empty"><div id="c_navigation_126-17153218284760" class="response-animated">
<form class="e_form-28 s_form_layout1 boxForm" needjs="true">
    <div class="cbox-28-0 p_formItem"><div class="e_input-29 s_form1 form-group" needjs="true">
    <div class="">
        <div class="input-group">
            <input type="text" class="form-control s_form-control s_input p_input" name="e_input-29" placeholder="Please enter search keywords">
            <div class="invalid-feedback"></div>
        </div>
    </div>
</div><a class="e_formBtn-30 s_button1 btn btn-primary" href="javascript:;" needjs="true">
    <span>Confirm</span> 
</a>
<div class="closeFrom"><svg t="1642239469515" class="closeicon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="2511" width="20" height="20"><path d="M512 456.310154L94.247385 38.557538a39.542154 39.542154 0 0 0-55.689847 0 39.266462 39.266462 0 0 0 0 55.689847L456.310154 512 38.557538 929.752615a39.542154 39.542154 0 0 0 0 55.689847 39.266462 39.266462 0 0 0 55.689847 0L512 567.689846l417.752615 417.752616c15.163077 15.163077 40.290462 15.36 55.689847 0a39.266462 39.266462 0 0 0 0-55.689847L567.689846 512 985.442462 94.247385a39.542154 39.542154 0 0 0 0-55.689847 39.266462 39.266462 0 0 0-55.689847 0L512 456.310154z" p-id="2512"></path></svg></div></div>
    <input name="jumpPage" type="hidden" value="/">
</form><div class="e_container-31 s_layout">
    <div class="cbox-31-0 p_item"><div class="e_container-32 s_layout">
    <div class="cbox-32-0 p_item"><div class="e_html-33 s_list">

<div class="top_f">
  <div class="gtranslate_wrapper" style="display:inline-block; vertical-align:middle; margin-right:15px;">
    <?php if ( function_exists( 'do_shortcode' ) ) { echo do_shortcode( '[gtranslate]' ); } ?>
  </div>
  <h2> <a href="#"> <svg t="1718091038363" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4104" width="200" height="200"><path d="M469.333333 106.666667c200.298667 0 362.666667 162.368 362.666667 362.666666 0 86.08-29.994667 165.162667-80.085333 227.349334a20.949333 20.949333 0 0 1 10.901333 5.802666l135.765333 135.765334a21.333333 21.333333 0 0 1 0 30.165333l-30.165333 30.165333a21.333333 21.333333 0 0 1-30.165333 0l-135.765334-135.765333a21.226667 21.226667 0 0 1-5.845333-10.901333A360.96 360.96 0 0 1 469.333333 832c-200.298667 0-362.666667-162.368-362.666666-362.666667S269.034667 106.666667 469.333333 106.666667z m0 85.333333C316.16 192 192 316.16 192 469.333333s124.16 277.333333 277.333333 277.333334 277.333333-124.16 277.333334-277.333334S622.506667 192 469.333333 192z" fill="#222429" p-id="4105"></path></svg>搜索 </a> </h2>  
</div>
  
</div></div>
</div></div>
</div><div class="e_container-21 s_layout fIxBox havestatic">
    <div class="cbox-21-0 p_item"><div class="e_image-16 s_img">
            <a href="/" target="_self">
        <img src="https://omo-oss-image.thefastimg.com/portal-saas/pg2024041817493912440/cms/image/4532afee-a75c-4051-8bd8-f347e4929d73.png" alt="Chuanglian power supply" title="Chuanglian power supply" la="la">
              
        <img src="https://omo-oss-image.thefastimg.com/portal-saas/pg2024041817493912440/cms/image/4ee68ec9-3343-45a5-ae29-ba57da8e707e.png" alt="chuanglian" title="chuanglian" la="la">
            </a>
</div>

</div>
    <div class="cbox-21-1 p_item"><div class="e_navigationF-24" needjs="true">

    <ul class="p_navBox1">
        <li class="p_navItem1">
            <p class="p_navCon js_editor_click">
                <a href="/" target="">
                    <span>首页</span>
                </a>
            </p>
        </li>
        <li class="p_navItem1">
            <p class="p_navCon js_editor_click">
                <a href="/about-us/" target="">
                    <span>关于我们</span>
                </a>
            </p>
        </li>
        <li class="p_navItem1">
            <p class="p_navCon js_editor_click">
                <a href="/led-display-power/" target="">
                    <span>产品中心</span>
                </a>
            </p>
        </li>
        <li class="p_navItem1">
            <p class="p_navCon js_editor_click">
                <a href="/faq/" target="">
                    <span>常见问题</span>
                </a>
            </p>
        </li>
        <li class="p_navItem1">
            <p class="p_navCon js_editor_click">
                <a href="/news/" target="">
                    <span>新闻资讯</span>
                </a>
            </p>
        </li>
        <li class="p_navItem1">
            <p class="p_navCon js_editor_click">
                <a href="/contact-us/" target="">
                    <span>联系我们</span>
                </a>
            </p>
        </li>
    </ul>
</div></div>
</div></div>
</div></div>
</div></div>
</header>
