<?php
/**
 * News / Blog Posts List Template for Twenty Twenty-Five Standalone Theme.
 */
get_header();
?>
<main id="site-main" class="site-main" style="max-width: 1200px; margin: 40px auto; padding: 0 20px; min-height: 500px;">
    <div style="margin-bottom: 30px; border-bottom: 2px solid #e40011; padding-bottom: 10px;">
        <h1 style="font-size: 28px; color: #333; margin: 0;">News & Updates</h1>
        <p style="color: #777; font-size: 14px; margin-top: 5px;">Latest news, announcements, and technical articles from Haitaik</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 24px;">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                ?>
                <article style="background: #fff; border: 1px solid #eee; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div style="height: 180px; overflow: hidden;">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( 'medium_large', array( 'style' => 'width:100%; height:100%; object-fit:cover;' ) ); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    <div style="padding: 20px;">
                        <span style="font-size: 12px; color: #999; display: block; margin-bottom: 8px;"><?php echo get_the_date(); ?></span>
                        <h2 style="font-size: 18px; line-height: 1.4; margin: 0 0 10px 0;">
                            <a href="<?php the_permalink(); ?>" style="color: #333; text-decoration: none;"><?php the_title(); ?></a>
                        </h2>
                        <div style="color: #666; font-size: 14px; line-height: 1.6; margin-bottom: 15px;">
                            <?php the_excerpt(); ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" style="color: #e40011; font-weight: 500; font-size: 14px; text-decoration: none; display: inline-flex; align-items: center;">
                            Read More &rarr;
                        </a>
                    </div>
                </article>
                <?php
            endwhile;
        else :
            ?>
            <p style="grid-column: 1 / -1; text-align: center; color: #888; padding: 40px 0;">No news articles available at the moment.</p>
        <?php endif; ?>
    </div>
</main>
<?php
get_footer();
