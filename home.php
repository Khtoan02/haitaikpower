<?php
/**
 * News / Blog Posts List Template for Twenty Twenty-Five Standalone Theme.
 */
get_header();

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );
$news_query = new WP_Query( array(
	'post_type'      => 'post',
	'post_status'    => 'publish',
	'posts_per_page' => 12,
	'paged'          => $paged,
) );
?>
<!-- Header Fix for News Page -->
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
.e_container-21 a {
    color: #222429 !important;
}
.e_image-16 img:first-child {
    display: none !important;
}
.e_image-16 img:last-child {
    display: inline-block !important;
}
</style>

<main id="site-main" class="site-main" style="max-width: 1200px; margin: 130px auto 60px auto; padding: 0 20px; min-height: 500px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
    <div style="margin-bottom: 30px; border-bottom: 2px solid #e40011; padding-bottom: 12px;">
        <h1 style="font-size: 28px; font-weight: 700; color: #1e293b; margin: 0;">新闻资讯</h1>
        <p style="color: #64748b; font-size: 14px; margin-top: 6px;">创联电源最新新闻、企业动态与技术文章</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 24px;">
        <?php
        if ( $news_query->have_posts() ) :
            while ( $news_query->have_posts() ) : $news_query->the_post();
                $img_url = '';
                if ( has_post_thumbnail() ) {
                    $img_url = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
                } else {
                    preg_match( '/<img.+?src=["\']([^"\']+)["\']/i', get_the_content(), $matches );
                    if ( ! empty( $matches[1] ) ) {
                        $img_url = $matches[1];
                    }
                }
                ?>
                <article style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.04); display: flex; flex-direction: column;">
                    <?php if ( ! empty( $img_url ) ) : ?>
                        <div style="height: 190px; overflow: hidden; background: #f8fafc;">
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php the_title_attribute(); ?>" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'" />
                            </a>
                        </div>
                    <?php endif; ?>
                    <div style="padding: 20px; flex: 1; display: flex; flex-direction: column;">
                        <span style="font-size: 13px; color: #94a3b8; display: block; margin-bottom: 8px;"><?php echo get_the_date(); ?></span>
                        <h2 style="font-size: 17px; font-weight: 600; line-height: 1.4; margin: 0 0 12px 0;">
                            <a href="<?php the_permalink(); ?>" style="color: #1e293b; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#e40011'" onmouseout="this.style.color='#1e293b'"><?php the_title(); ?></a>
                        </h2>
                        <div style="color: #64748b; font-size: 14px; line-height: 1.6; margin-bottom: 15px; flex: 1;">
                            <?php 
                            $excerpt = get_the_excerpt();
                            if ( empty( $excerpt ) ) {
                                $excerpt = wp_strip_all_tags( get_the_content() );
                            }
                            echo esc_html( wp_trim_words( $excerpt, 25, '...' ) );
                            ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" style="color: #e40011; font-weight: 600; font-size: 14px; text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
                            阅读更多 &rarr;
                        </a>
                    </div>
                </article>
                <?php
            endwhile;
            wp_reset_postdata();
        else :
            ?>
            <p style="grid-column: 1 / -1; text-align: center; color: #888; padding: 40px 0;">暂无新闻资讯。</p>
        <?php endif; ?>
    </div>

    <?php if ( $news_query->max_num_pages > 1 ) : ?>
        <div style="margin-top: 40px; text-align: center;">
            <?php
            echo paginate_links( array(
                'total'   => $news_query->max_num_pages,
                'current' => $paged,
            ) );
            ?>
        </div>
    <?php endif; ?>
</main>
<?php
get_footer();
