	<div class="footer">
	<?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
               <?php if (is_active_sidebar('sidebar-footer')) : ?>
               <div class="footer-sidebar">
                   <?php dynamic_sidebar('sidebar-footer'); ?>
               </div>
               <?php endif; ?>
	</div>
	<?php wp_footer(); ?>
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js" async></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous" async></script>
        <script src="<?php echo get_stylesheet_directory_uri() ?>/js/script.js" async></script>
	</body>
</html>