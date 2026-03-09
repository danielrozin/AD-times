<footer id="customFooter" class="wp-block-template-part">
	<div class="footers">
		<div class="footer1 md-half">
			<h3>Subscribe to our newsletter</h3>
			<p>and enjoy in-depth analyses, thought-provoking commentaries,<br> and a curated selection of insightful articles that delve deep into the topics that matter to you.</p>
			<div class="subscribe-wrapper">
           <!--    <input type="email" class="subscribe-input" id="footer-email" placeholder="Please enter your email address">
              <button type="submit" class="subscribe-btn">
                Subscribe
              </button> -->

              <?php echo do_shortcode('[contact-form-7 id="8afadba" title="Footer Subscribe form"]'); ?>
            </div>
		</div>
		<div class="footer2 md-half">
			<div class="footer-menu2">  
					 <?php
						$footernav = array(
						'theme_location' => 'footer-menu',
						'menu' => 'Navigation',
						'container' => '',
						'container_class' => '',
						'container_id' => '',
						'menu_class' => 'footer-navigation-menu', // Add a custom class to the menu container
						'menu_id' => '',
						'echo' => true,
						'fallback_cb' => 'wp_page_menu',
						'before' => '',
						'after' => '',
						'link_before' => '',
						'link_after' => '',
						'items_wrap' => '<ul id="%1$s" class="footer-navigation">%3$s</ul>',
						);

						wp_nav_menu($footernav);
						?>
							
						</div>
			<div class="footer-menu1">
			 <div class="social-icons-footer">
						<div class="follow-label">Follow us:</div>
						<div class="social-icons-wrapper">
						<?php if ( get_theme_mod( 'facebook_url' ) ): ?>
						    <a class="social-icon"  href="<?php echo get_theme_mod( 'facebook_url' ); ?>" target="_blank" title="Facebook">
						        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/fb_white.svg" alt="fb">
						    </a>
						<?php endif; ?>
						<?php if ( get_theme_mod( 'instagram_url' ) ): ?>
						    <a class="social-icon"  href="<?php echo get_theme_mod( 'instagram_url' ); ?>" target="_blank" title="Facebook">
						        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/insta_white.svg" alt="insta">
						    </a>
						<?php endif; ?>
						<?php if ( get_theme_mod( 'twitter_url' ) ): ?>
						    <a class="social-icon"  href="<?php echo get_theme_mod( 'twitter_url' ); ?>" target="_blank" title="Facebook">
						        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/x_white.svg" alt="x">
						    </a>
						<?php endif; ?>
						<?php if ( get_theme_mod( 'tiktok_url' ) ): ?>
						    <a class="social-icon"  href="<?php echo get_theme_mod( 'tiktok_url' ); ?>" target="_blank" title="Facebook">
						        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/tt_white.svg" alt="tiktok">
						    </a>
						<?php endif; ?>
							</div>
						</div>

			</div>
		</div>
	</div>

</footer>


</div>
<?php wp_footer(); ?>
</body>
</html>