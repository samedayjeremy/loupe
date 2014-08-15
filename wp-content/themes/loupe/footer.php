		</div><!-- #main -->

		<footer id="colophon" class="site-footer dark row" role="contentinfo">

			<img src='<?php echo get_template_directory_uri(); ?>/images/logo-footer.png' />

			<div class='footer-copy'>
				<?php
					$post = get_page_by_title("Home");
					setup_postdata($post);
					the_content();
				?>
			</div>
			<div class="site-info">
				&copy; 2014 Bring A Loupe.  All Rights Reserved.
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.infinitescroll.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/behaviors/manual-trigger.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/loupe.js"></script>

	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-53711040-1', 'auto');
  ga('send', 'pageview');

	</script>

</body>
</html>