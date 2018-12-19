<?php get_header(); ?>
    <div class="article-container">
        <?php
        $navigationArray = array();
        if (have_posts()) : while (have_posts()) : the_post(); ?>

            <?php
            if (is_category()):
                $titleArray = explode(" ", get_the_title());
                $firstChar = substr($titleArray[0], 0, 1);
                if (is_numeric($firstChar)):
                    $firstChar = '#';
                endif;
                $isFirst = false;
                if ($firstChar != $firstCharBefore):
                    $isFirst = true;
                    array_push($navigationArray, $firstChar);
                endif;
                $firstCharBefore = $firstChar;
            endif;
            ?>
            <div class="post-container <?php if ($isFirst):?>first-post<?php endif ?>" <?php if (is_category()): ?> data-firstchar="<?php echo($firstChar) ?>"<?php endif; ?>>
                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <a href="<?php the_permalink() ?>">
                        <?php the_post_thumbnail('medium') ?>
                        <div class="article-info">
                            <?php if(intval(get_post_custom_values("Bewertung Buch")[0], 10) == 5):?>
                                <div class="article-badge"></div>
                            <?php endif;?>
                            <div class="article-popup">
                                <div class="article-title">
                                    <h3><?php the_title() ?></h3>
                                </div>
                                <?php if(is_category('Bücher') || is_home() || is_search() || is_tag() ): ?><small class="article-category">- <?php foreach(get_the_category() as $category): if($category->cat_name != 'Bücher'): echo $category->cat_name; endif; endforeach; ?> -</small><?php endif; ?>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        <?php endwhile; endif; ?>
        <div class="home-nav-container">
            <div class="next home-nav-button-container">
                <?php next_posts_link('<p class="sr-only">ältere Artikel</p>'); ?>
            </div>
            <div class="previous home-nav-button-container">
                <?php previous_posts_link('<p class="sr-only">neuere Artikel</p>') ?>
            </div>

        </div>
    </div>
    <div class="onPageNavigation">
        <ul>
            <?php foreach ($navigationArray as $character): ?>
                <li data-char="<?php echo($character) ?>"><?php echo($character); ?></li>
            <?php endforeach; ?>
        </ul>
        <div class="helper"></div>
    </div>
<?php get_footer(); ?>