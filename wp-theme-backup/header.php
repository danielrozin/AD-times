<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<div id="page" class="wp-site-blocks">
<header id="customHeader" class="header-white wp-block-template-part">
    <div class=" alignwide header-blog has-base-2-background-color has-background is-layout-flow wp-block-group-is-layout-flow" style="padding-top:20px;padding-bottom:20px">
        <div class=" alignwide header-blog-sub is-content-justification-center is-layout-flex wp-container-core-group-layout-2 wp-block-group-is-layout-flex">

        <?php  $template_path = get_post_meta(get_the_ID(), '_wp_page_template', true); 
        $header_layout = get_field( "header_layout" );
					if( $template_path=="templates/home.php" ||  $header_layout=="Header 1"){
					$navID="HomeHeader"; }
					else{
					$navID="innerHeader";
					}
           	?>
            <!-- Navigation menu -->
            <nav id="<?php echo $navID; ?>" class="has-background has-base-2-background-color is-responsive items-justified-center wp-block-navigation is-horizontal is-content-justification-center is-layout-flex wp-container-core-navigation-layout-1 wp-block-navigation-is-layout-flex" aria-label="Navigation" data-wp-interactive="" data-wp-context="{&quot;core&quot;:{&quot;navigation&quot;:{&quot;overlayOpenedBy&quot;:[],&quot;type&quot;:&quot;overlay&quot;,&quot;roleAttribute&quot;:&quot;&quot;,&quot;ariaLabel&quot;:&quot;Menu&quot;}}}">
<button aria-haspopup="true" aria-label="Open menu" class="wp-block-navigation__responsive-container-open " data-wp-on--click="actions.core.navigation.openMenuOnClick" data-wp-on--keydown="actions.core.navigation.handleMenuKeydown"><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><rect x="4" y="7.5" width="16" height="1.5"></rect><rect x="4" y="15" width="16" height="1.5"></rect></svg></button>
                <div class="wp-block-navigation__responsive-container" style="" id="modal-2" data-wp-class--has-modal-open="selectors.core.navigation.isMenuOpen" data-wp-class--is-menu-open="selectors.core.navigation.isMenuOpen" data-wp-effect="effects.core.navigation.initMenu" data-wp-on--keydown="actions.core.navigation.handleMenuKeydown" data-wp-on--focusout="actions.core.navigation.handleMenuFocusout" tabindex="-1">
                    <div class="wp-block-navigation__responsive-close" tabindex="-1">
                        <div class="wp-block-navigation__responsive-dialog" data-wp-bind--aria-modal="selectors.core.navigation.ariaModal" data-wp-bind--aria-label="selectors.core.navigation.ariaLabel" data-wp-bind--role="selectors.core.navigation.roleAttribute" data-wp-effect="effects.core.navigation.focusFirstElement">

					<?php if ( get_theme_mod( 'custom_logo' ) ): ?>
					<?php $custom_logo_id = get_theme_mod( 'custom_logo' );
					$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
					$logo_url ="";
					if(!empty($image)){ $logo_url = $image[0]; }
					?>
					<?php endif; ?>
					<?php  if(!empty($image) && $template_path!="templates/home.php" && (!empty($image) &&  $header_layout!="Header 1")){ ?>
					<div class="logo-small" id="logosmall">
					<a href="<?php echo site_url(); ?>"><img  src="<?php echo $logo_url; ?>" alt="" class="logosmall-icon"></a></div>
					<?php } ?>

 
                            <div class="wp-block-navigation__responsive-container-content" id="modal-2-content">
	<button aria-label="Close menu" class="wp-block-navigation__responsive-container-close" data-wp-on--click="actions.core.navigation.closeMenuOnClick"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" focusable="false"><path d="M13 11.8l6.1-6.3-1-1-6.1 6.2-6.1-6.2-1 1 6.1 6.3-6.5 6.7 1 1 6.5-6.6 6.5 6.6 1-1z"></path></svg></button>
                                <!-- WordPress Navigation Menu -->
                                <?php
                                $resnav = array(
                                    'theme_location' => 'primary-menu',
                                    'menu' => 'Navigation',
                                    'container' => '',
                                    'container_class' => '',
                                    'container_id' => '',
                                    'menu_class' => 'custom-navigation-menu', // Add a custom class to the menu container
                                    'menu_id' => '',
                                    'echo' => true,
                                    'fallback_cb' => 'wp_page_menu',
                                    'before' => '',
                                    'after' => '',
                                    'link_before' => '',
                                    'link_after' => '',
                                    'items_wrap' => '<ul id="%1$s" class="wp-block-navigation__container has-background has-base-2-background-color is-responsive items-justified-center wp-block-navigation">%3$s</ul>',
                                );

                                wp_nav_menu($resnav);
                                ?>

                                <!-- Search Form -->
                                <form role="search" method="get" action="/" class="wp-block-search__button-only wp-block-search__button-behavior-expand wp-block-search__searchfield-hidden wp-block-search__icon-button aligncenter search-box wp-block-search" data-wp-interactive="" data-wp-context="{ &quot;core&quot;: { &quot;search&quot;: { &quot;isSearchInputVisible&quot;: false, &quot;inputId&quot;: &quot;wp-block-search__input-1&quot;, &quot;ariaLabelExpanded&quot;: &quot;Submit Search&quot;, &quot;ariaLabelCollapsed&quot;: &quot;Expand search field&quot; } } }" data-wp-class--wp-block-search__searchfield-hidden="!context.core.search.isSearchInputVisible" data-wp-on--keydown="actions.core.search.handleSearchKeydown" data-wp-on--focusout="actions.core.search.handleSearchFocusout">
                                    <label class="wp-block-search__label screen-reader-text" for="wp-block-search__input-1">Search</label>
                                    <div class="wp-block-search__inside-wrapper ">
                                        <input aria-hidden="true" class="wp-block-search__input has-small-font-size" data-wp-bind--aria-hidden="!context.core.search.isSearchInputVisible" data-wp-bind--tabindex="selectors.core.search.tabindex" id="wp-block-search__input-1" placeholder="" tabindex="-1" value="" type="search" name="s" required="">
                                        <button aria-controls="wp-block-search__input-1" aria-expanded="false" aria-label="Expand search field" class="wp-block-search__button has-text-color has-contrast-color has-background has-base-2-background-color has-small-font-size has-icon wp-element-button" data-wp-bind--aria-controls="selectors.core.search.ariaControls" data-wp-bind--aria-expanded="context.core.search.isSearchInputVisible" data-wp-bind--aria-label="selectors.core.search.ariaLabel" data-wp-bind--type="selectors.core.search.type" data-wp-on--click="actions.core.search.openSearchInput" type="button">
                                            <svg class="search-icon" viewBox="0 0 24 24" width="24" height="24">
                                                <path d="M13 5c-3.3 0-6 2.7-6 6 0 1.4.5 2.7 1.3 3.7l-3.8 3.8 1.1 1.1 3.8-3.8c1 .8 2.3 1.3 3.7 1.3 3.3 0 6-2.7 6-6S16.3 5 13 5zm0 10.5c-2.5 0-4.5-2-4.5-4.5s2-4.5 4.5-4.5 4.5 2 4.5 4.5-2 4.5-4.5 4.5z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </form>
                            </div>

                                <!-- right-aligned social media icons -->
						         <div class="social-icons">
							    <span class="follow-label">Follow us:</span>
						<?php if ( get_theme_mod( 'facebook_url' ) ): ?>
						    <a class="social-icon"  href="<?php echo get_theme_mod( 'facebook_url' ); ?>" target="_blank" title="Facebook">
						        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/fb.svg" alt="fb">
						    </a>
						<?php endif; ?>
						<?php if ( get_theme_mod( 'instagram_url' ) ): ?>
						    <a class="social-icon"  href="<?php echo get_theme_mod( 'instagram_url' ); ?>" target="_blank" title="Facebook">
						        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/insta.svg" alt="insta">
						    </a>
						<?php endif; ?>
						<?php if ( get_theme_mod( 'twitter_url' ) ): ?>
						    <a class="social-icon"  href="<?php echo get_theme_mod( 'twitter_url' ); ?>" target="_blank" title="Facebook">
						        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/x.svg" alt="x">
						    </a>
						<?php endif; ?>
						<?php if ( get_theme_mod( 'tiktok_url' ) ): ?>
						    <a class="social-icon"  href="<?php echo get_theme_mod( 'tiktok_url' ); ?>" target="_blank" title="Facebook">
						        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/tt.svg" alt="tiktok">
						    </a>
						<?php endif; ?>
							</div>

                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
</header>
	<?php  if(!empty($image) && $template_path=="templates/home.php" || (!empty($image) &&  $header_layout=="Header 1")){ ?>
<figure class="big-adtime-logo wp-block-image size-full adtimeblockImage">
   <a href="<?php echo site_url(); ?>"> <img width="418" height="123" src="<?php echo $logo_url; ?>" alt="logo" class="wp-image-41"></a>
</figure>
<?php } ?>
<?php if($template_path=="templates/home.php"){ ?>
<div class="home-page-label">

	<div class="subnav">
   <?php
	$resnav = array(
	'theme_location' => 'sub-primary-menu',
	'menu' => 'Navigation',
	'container' => '',
	'container_class' => '',
	'container_id' => '',
	'menu_class' => 'sub-custom-navigation-menu', // Add a custom class to the menu container
	'menu_id' => '',
	'echo' => true,
	'fallback_cb' => 'wp_page_menu',
	'before' => '',
	'after' => '',
	'link_before' => '',
	'link_after' => '',
	'items_wrap' => '<ul id="%1$s" class="custom-sub-navigation">%3$s</ul>',
	);

	wp_nav_menu($resnav);
	?>
</div>
</div>
<?php } ?>