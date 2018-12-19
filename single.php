<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<div <?php post_class(); ?>>

		<div class="post-header">
			<?php
			$post_image_id = get_post_thumbnail_id( get_the_ID() );
			if ( $post_image_id ) {
				$thumbnail = wp_get_attachment_image_src( $post_image_id, 'full', false );
				if ( $thumbnail ) {
					(string) $thumbnail = $thumbnail[0];
				}
			}
			?>
			<?php
			$authors   = get_post_custom_values( "Autor" );
			foreach($authors as $author) {
				$nameList  = explode( " ", $author );
				$surName   = array_pop( $nameList );
				$firstName = "";
				foreach ( $nameList as $name ) :
					$firstName = $firstName . " " . $name;
				endforeach;
				$authorTitle = $surName . ',' . $firstName;
				$authorId    = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE post_title = '" . $authorTitle . "'" );
				$authorUrl   = get_permalink( $authorId );
			}
			?>
			<h1 class="post-title entry-title" style="background-image: url(<?php echo $thumbnail; ?>)!important"><span class="entry-title"><?php the_title(); ?></span>
				<br>
				<small><?php foreach ( get_the_category() as $category ): if ( $category->cat_name != 'Bücher' ): echo $category->cat_name; endif; endforeach; ?>
					<br>erstellt von: <span class="author vcard"><span class="screen-reader-text">Author </span><a class="url fn" href="<?php echo esc_url( get_permalink( get_page_by_title( 'About Me' ) ) ); ?>"><?php the_author(); ?></a></span> &#124; <time class="updated"><?php the_date(); ?></time></small>
					
			</h1>
			<div class="post-excerpt">
				<h2 class="entry-summary">
					<?php $myExcerpt = get_the_excerpt();
  					$tags = array("<p>", "</p>");
  					$myExcerpt = str_replace($tags, "", $myExcerpt);
  					echo $myExcerpt;?>
				</h2>
			</div>
		</div>
		<div class="post-detail">
			<div class="post-custom">
				<div class="post-thumbnail"><?php the_post_thumbnail( medium ) ?></div>
				<ul class="post-custom-list book-values">
					<li class="post-custom-item">
						<span class="post-custom-key">Autor: </span><span
							class="post-custom-value"><?php if ( $authorId ): ?>
								<a href="<?php echo $authorUrl ?>"><?php echo implode(", ", get_post_custom_values( "Autor" )); ?></a><?php else: ?><?php echo implode(", ", get_post_custom_values( "Autor" )); ?><?php endif; ?></span>
					</li>
					<li class="post-custom-item">
						<span class="post-custom-key">Verlag: </span><span
							class="post-custom-value"><?php echo get_post_custom_values( "Verlag" )[0] ?></span>
					</li>
					<li class="post-custom-item">
						<span class="post-custom-key">Website: </span><span
							class="post-custom-value"><a href="<?php
							echo get_post_custom_values( "Website" )[0] ?>"
						                                 target="_blank"><?php echo get_post_custom_values( "Website" )[0] ?></a></span>
					</li>
					<li class="post-custom-item">
						<span class="post-custom-key">Preis: </span><span
							class="post-custom-value"><?php echo get_post_custom_values( "Preis" )[0] ?></span>
					</li>
					<li class="post-custom-item">
						<span class="post-custom-key">Seiten: </span><span
							class="post-custom-value"><?php echo get_post_custom_values( "Seiten" )[0] ?></span>
					</li>
					<li class="post-custom-item">
						<span class="post-custom-key">Bewertung: </span><span class="post-custom-value"><?
							?><?php
							$rating = floatval( get_post_custom_values( "Bewertung Buch" )[0] );
							if ( $rating > 0 ) {
								$i = 0;
								while ( $i < $rating ) {
									$i ++;
									if ( $i > $rating ) {
										echo '+1/2';
									} else {
										echo json_decode( '"\u2605"' );
									}
								}
							} else {
								echo get_post_custom_values( "Bewertung Buch" )[0];
							}
							?></span>
					</li>
				</ul>
				<ul class="post-custom-list film-values">
					<li class="post-custom-item">
						<span class="post-custom-key">Regie: </span><span
							class="post-custom-value"><?php echo get_post_custom_values( "Regie" )[0] ?></span>
					</li>
					<li class="post-custom-item">
						<span class="post-custom-key">Erscheinungsjahr: </span><span
							class="post-custom-value"><?php echo get_post_custom_values( "Erscheinungsjahr" )[0] ?></span>
					</li>
					<li class="post-custom-item">
						<span class="post-custom-key">Länge: </span><span
							class="post-custom-value"><?php echo get_post_custom_values( "Länge" )[0] ?></span>
					</li>
					<li class="post-custom-item">
						<span class="post-custom-key">Besetzung: </span><span
							class="post-custom-value"><?php echo get_post_custom_values( "Besetzung" )[0] ?></span>
					</li>
					<li class="post-custom-item">
						<span class="post-custom-key">Bewertung: </span><span
							class="post-custom-value"><?php
							$rating = floatval( get_post_custom_values( "Bewertung Film" )[0] );
							if ( $rating > 0 ) {
								$i = 0;
								while ( $i < $rating ) {
									$i ++;
									if ( $i > $rating ) {
										echo '+1/2';
									} else {
										echo json_decode( '"\u2605"' );
									}
								}
							} else {
								echo get_post_custom_values( "Bewertung Film" )[0];
							}
							?></span>
					</li>
				</ul>
				<ul class="post-custom-list author-values">
					<li class="post-custom-item">
						<span class="post-custom-key">Geburtstag: </span><span class="post-custom-value"><?php echo get_post_custom_values( "Geburtstag" )[0] ?></span>
					</li>
					<li class="post-custom-item">
						<span class="post-custom-key">Nationalität: </span><span class="post-custom-value"><?php echo get_post_custom_values( "Nationalität" )[0] ?></span>
					</li>
				</ul>
			</div>
		</div>
		<article class="post-content entry-content">
			<?php the_content(); ?>
			<br>
			<div class="score-wrapper"><span class="score"><?php echo get_post_custom_values( "Bewertung Buch" )[0] ?></span>/<span class="best-score">5</span></div>
		</article>
		<div class="post-related">
			<?php
			$args         = array(
				'orderby'      => 'date',
				'order'        => 'ASC',
				'meta_key'     => 'Reihe',
				'meta_value'   => get_post_custom_values( 'Reihe' )[0],
				'post__not_in' => array( get_the_ID() )
			);
			$custom_query = new WP_Query( $args );
			?>
			<?php if ( $custom_query->have_posts() && get_post_custom_values( "Reihe" )[0] ): ?>
				<div class="post-related-series">
					<div class="post-related-title tap-title"><h3>Zugehörig
							zu <?php echo get_post_custom_values( "Reihe" )[0] ?></h3><span class="arrow"></span></div>
					<ul>
						<?php while ( $custom_query->have_posts() ): $custom_query->the_post(); ?>
							<li>
								<a href="<?php the_permalink() ?>"><b><?php the_title(); ?></b>
									- <?php echo get_post_custom_values( "Autor" )[0] ?></a>
							</li>
						<?php endwhile; ?>
					</ul>
				</div>
			<?php endif;
			wp_reset_postdata(); ?>

			<?php
			$args         = array(
				'orderby'      => 'date',
				'order'        => 'ASC',
				'meta_key'     => 'Autor',
				'meta_value'   => get_post_custom_values( 'Autor' )[0],
				'post__not_in' => array( get_the_ID() )
			);
			$custom_query = new WP_Query( $args );
			?>
			<?php if ( $custom_query->have_posts() && get_post_custom_values( "Autor" )[0] ): ?>
				<div class="post-related-author">
					<div class="post-related-title tap-title"><h3>Zugehörig
							zu <?php echo get_post_custom_values( "Autor" )[0] ?></h3><span class="arrow"></span></div>
					<ul>
						<?php while ( $custom_query->have_posts() ): $custom_query->the_post(); ?>
							<li>
								<a href="<?php the_permalink() ?>"><b><?php the_title(); ?></b></a>
							</li>
						<?php endwhile; ?>
					</ul>
				</div>
			<?php endif;
			wp_reset_postdata(); ?>

			<?php
			$args         = array(
				'orderby'        => 'date',
				'order'          => 'ASC',
				'meta_key'       => 'Verlag',
				'meta_value'     => get_post_custom_values( 'Verlag' )[0],
				'post__not_in'   => array( get_the_ID() ),
				'posts_per_page' => 5
			);
			$custom_query = new WP_Query( $args );
			?>
			<?php if ( $custom_query->have_posts() && get_post_custom_values( "Verlag" )[0] ): ?>
				<div class="post-related-publisher">
					<div class="post-related-title tap-title"><h3>Zugehörig
							zu <?php echo get_post_custom_values( "Verlag" )[0] ?></h3><span class="arrow"></span></div>
					<ul>
						<?php while ( $custom_query->have_posts() ): $custom_query->the_post(); ?>
							<li>
								<a href="<?php the_permalink() ?>"><b><?php the_title(); ?></b>
									- <?php echo get_post_custom_values( "Autor" )[0] ?></a>
							</li>
						<?php endwhile;
						wp_reset_postdata(); ?>
					</ul>
				</div>
			<?php endif; ?>
			<?php if ( get_the_tags() ): ?>
				<div class="post-tags">
					<div class="post-tags-header tap-title">
						<h3>Tags</h3><span class="arrow"></span>
					</div>
					<div class="post-tags-content">
						<?php the_tags( "" ) ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<div class="post-comments">
			<?php comments_template('/comments.php',true) ?>
		</div>
	</div>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
