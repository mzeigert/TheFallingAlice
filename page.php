<?php get_header(); ?>
    <div class="wrapper">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <h2 class="title"><?php the_title(); ?></h2>
            <div class='content'>
                <?php the_content(); ?>
                <?php wp_link_pages(array(
                    'before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'twentyfourteen') . '</span>',
                    'after' => '</div>',
                    'link_before' => '<span>',
                    'link_after' => '</span>',
                ));
                ?>
            </div>
        <?php endwhile; ?>
        <?php endif; ?>
    </div>
<?php get_footer(); ?>