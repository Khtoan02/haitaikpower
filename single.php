<?php
/**
 * Single News / Blog Post Detail Template for Twenty Twenty-Five Standalone Theme.
 */
get_header();
?>
<!-- Header Fix for Single News Article Page -->
<style>
#site-header,
.site-header,
.e_container-21,
.e_container-21.fIxBox,
#c_grid-116273709439191 {
    background-color: #ffffff !important;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05) !important;
}
.p_navBox1 .p_navItem1 a span,
.top_f h2 a,
.e_navigationF-24 a span,
/* Article typography styles for h2, h3, content */
.entry-content h2 {
    font-size: 20px !important;
    font-weight: 700 !important;
    color: #1e293b !important;
    margin: 30px 0 15px 0 !important;
    padding-left: 10px !important;
    border-left: 4px solid #e40011 !important;
}
.entry-content h3 {
    font-size: 17px !important;
    font-weight: 600 !important;
    color: #334155 !important;
    margin: 20px 0 10px 0 !important;
}
.entry-content p {
    font-size: 15px !important;
    line-height: 1.8 !important;
    color: #475569 !important;
    margin-bottom: 16px !important;
}
.entry-content ul {
    margin: 15px 0 20px 25px !important;
    color: #475569 !important;
}
.entry-content li {
    font-size: 15px !important;
    line-height: 1.8 !important;
    margin-bottom: 8px !important;
}
.entry-content img {
    max-width: 100% !important;
    height: auto !important;
    border-radius: 8px !important;
    margin: 20px 0 !important;
}
</style>

<main id="site-main" class="site-main" style="max-width: 900px; margin: 130px auto 60px auto; padding: 0 20px; min-height: 500px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            ?>
            <article style="background: #ffffff; padding: 40px; border-radius: 8px; border: 1px solid #e2e8f0; box-shadow: 0 2px 12px rgba(0,0,0,0.03);">
                <div style="margin-bottom: 25px; border-bottom: 1px solid #e2e8f0; padding-bottom: 20px;">
                    <a href="/news/" style="color: #e40011; text-decoration: none; font-size: 14px; font-weight: 500;">&larr; 返回新闻列表 (Back to News)</a>
                    <h1 style="font-size: 28px; font-weight: 700; color: #1e293b; margin: 15px 0 10px 0; line-height: 1.35;"><?php the_title(); ?></h1>
                    <span style="font-size: 13px; color: #94a3b8;"><?php echo get_the_date(); ?></span>
                </div>
                <?php if ( has_post_thumbnail() ) : ?>
                    <div style="margin-bottom: 25px; max-height: 450px; overflow: hidden; border-radius: 6px;">
                        <?php the_post_thumbnail( 'full', array( 'style' => 'width:100%; height:auto; display:block;' ) ); ?>
                    </div>
                <?php endif; ?>
                <div class="entry-content" style="color: #334155; font-size: 16px; line-height: 1.8;">
                    <?php the_content(); ?>
                </div>
            </article>
            <?php
        endwhile;
    endif;
    ?>
</main>
<?php
get_footer();
