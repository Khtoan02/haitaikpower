<?php
/**
 * Single News / Blog Post Detail Template for Twenty Twenty-Five Standalone Theme.
 */
get_header();
?>
<main id="site-main" class="site-main" style="max-width: 900px; margin: 40px auto; padding: 0 20px; min-height: 500px;">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            ?>
            <article style="background: #fff; padding: 30px; border-radius: 8px; border: 1px solid #eee;">
                <div style="margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 15px;">
                    <a href="/news/" style="color: #e40011; text-decoration: none; font-size: 14px;">&larr; Back to News</a>
                    <h1 style="font-size: 32px; color: #333; margin: 15px 0 10px 0; line-height: 1.3;"><?php the_title(); ?></h1>
                    <span style="font-size: 13px; color: #888;"><?php echo get_the_date(); ?></span>
                </div>
                <?php if ( has_post_thumbnail() ) : ?>
                    <div style="margin-bottom: 25px; max-height: 400px; overflow: hidden; border-radius: 6px;">
                        <?php the_post_thumbnail( 'full', array( 'style' => 'width:100%; height:auto; display:block;' ) ); ?>
                    </div>
                <?php endif; ?>
                <div class="entry-content" style="color: #444; font-size: 16px; line-height: 1.8;">
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
