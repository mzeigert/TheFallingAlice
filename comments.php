<?php if (false): ?>
<div class="comment-title tap-title"><h3>Kommentare</h3><span
		class="badge"><?php $comments = $wp_query->comments_by_type['comment']; if(!empty ($comments)): echo count( $comments ); else: echo "0"; endif; ?></span> <span class="arrow"></span>
</div>
<div class="comment-content">
	<div>
		<?php comment_form(); ?>
	</div>

	<div id="comments">
		<?php if ( have_comments() ) : ?>
			<ul class="commentlist">
				<?php wp_list_comments( array( 'type' => 'comment' ) ); ?>
			</ul>
			<div class="navigation">
				<?php paginate_comments_links(); ?>
			</div>
		<?php else : ?>
			<?php if ( comments_open() ) :
			else :
			endif;
		endif; ?>
	</div>

</div>
<?php endif; ?>