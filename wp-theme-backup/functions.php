<?php
// Enqueue parent and child theme styles
function ad_times_enqueue_styles() {

    $ad_times_ver=1.9;
    $parent_style = 'parent-style'; // This is 'twentytwentyfour-style' for Twenty Twenty-Four.
    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css',$ad_times_ver);
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array($parent_style), $ad_times_ver);
    wp_enqueue_style('inner-min', get_stylesheet_directory_uri() . '/assets/css/style.min.css', array($parent_style), $ad_times_ver);
    wp_enqueue_style('inner-style', get_stylesheet_directory_uri() . '/assets/css/inner.css', array($parent_style), $ad_times_ver);
    wp_enqueue_script('custom-scripts', get_stylesheet_directory_uri() . '/assets/js/custom-scripts.js', array('jquery'), $ad_times_ver);

    // NYT-style article fonts and CSS
    if (is_singular('post')) {
        wp_enqueue_style('nyt-google-fonts', 'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap', array(), null);
        wp_enqueue_style('nyt-article-style', get_stylesheet_directory_uri() . '/assets/css/nyt-article.css', array('child-style'), $ad_times_ver);
    }

}

add_action('wp_enqueue_scripts', 'ad_times_enqueue_styles');

add_action( 'after_setup_theme', 'ad_theme_setup' );
function ad_theme_setup() {

    add_image_size( 'post-thumb', 364, 243, true ); // (cropped)
    add_image_size( 'medium-thum', 412, 198 , true );
    add_image_size( 'feature-thum', 787, 546 , true );
    add_image_size( 'list-thum', 498, 366 , true );
}

function set_custom_post_template($template) {
    global $post;

    if ($post->post_type == 'post') {
        return locate_template(array('custom-template.php'));
    }

    return $template;
}
add_filter('single_template', 'set_custom_post_template');

// menu function
add_theme_support( 'menus' );
function register_custom_menus() {
  register_nav_menus(
    array(
      'primary-menu' => __( 'Primary Menu' ),
      'sub-primary-menu' => __( 'Sub Primary Menu' ),
      'footer-menu' => __( 'Footer Menu' ),
    )
  );
}
add_action( 'init', 'register_custom_menus' );
// menu function

function example_theme_support() {
    remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'example_theme_support' );

add_action( 'widgets_init', 'my_register_sidebars' );
function my_register_sidebars() {
    /* Register the 'primary' sidebar. */
    register_sidebar(
        array(
            'id'            => 'footer',
            'name'          => __( 'Footer Sidebar' ),
            'description'   => __( 'A short description of the sidebar.' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );
    /* Repeat register_sidebar() code for additional sidebars. */
    }
function twentytwentyfour_theme_support() {

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'widgets' );

    // Custom background color.
    add_theme_support(
        'custom-background',
        array(
            'default-color' => 'f5efe0',
        )
    );

    // Set content-width.
    global $content_width;
    if ( ! isset( $content_width ) ) {
        $content_width = 580;
    }

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );

    // Set post thumbnail size.
    set_post_thumbnail_size( 1200, 9999 );


    // Add custom image size used in Cover Template.
    add_image_size( 'twentytwentyfour-fullscreen', 1980, 9999 );


    // Custom logo.
    $logo_width  = 120;
    $logo_height = 90;

    // If the retina setting is active, double the recommended width and height.
    if ( get_theme_mod( 'retina_logo', false ) ) {
        $logo_width  = floor( $logo_width * 2 );
        $logo_height = floor( $logo_height * 2 );
    }

    add_theme_support(
        'custom-logo',
        array(
            'height'      => $logo_height,
            'width'       => $logo_width,
            'flex-height' => true,
            'flex-width'  => true,
        )
    );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'script',
            'style',
            'navigation-widgets',
        )
    );

    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on Twenty Twenty, use a find and replace
     * to change 'twentytwenty' to the name of your theme in all the template files.
     */
    load_theme_textdomain( 'twentytwentyfour' ); // Change 'twentytwenty' to 'twentytwentyfour'

    // Add support for full and wide align images.
    add_theme_support( 'align-wide' );

    // Add support for responsive embeds.
    add_theme_support( 'responsive-embeds' );

    /*
     * Adds starter content to highlight the theme on fresh sites.
     * This is done conditionally to avoid loading the starter content on every
     * page load, as it is a one-off operation only needed once in the customizer.
     */
 /*   if ( is_customize_preview() ) {
        require get_template_directory() . '/inc/starter-content.php';
        add_theme_support( 'starter-content', twentytwentyfour_get_starter_content() ); // Change 'twentytwenty' to 'twentytwentyfour'
    }
*/
    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );

    /*
     * Adds `async` and `defer` support for scripts registered or enqueued
     * by the theme.
     */
/*    $loader = new TwentyTwenty_Script_Loader();
    add_filter( 'script_loader_tag', array( $loader, 'filter_script_loader_tag' ), 10, 2 );*/

}

add_action( 'after_setup_theme', 'twentytwentyfour_theme_support' );
function twentytwentyfour_customize_register( $wp_customize ) {

    // Add Social Media Section
    $wp_customize->add_section( 'social_media_section', array(
        'title'    => __( 'Social Media', 'twentytwentyfour' ),
        'priority' => 120,
    ) );

    // Add Facebook Field
    $wp_customize->add_setting( 'facebook_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'facebook_url', array(
        'label'    => __( 'Facebook URL', 'twentytwentyfour' ),
        'section'  => 'social_media_section',
        'type'     => 'url',
    ) );

      // Add Instagram Field
    $wp_customize->add_setting( 'instagram_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'instagram_url', array(
        'label'    => __( 'Instagram URL', 'twentytwentyfour' ),
        'section'  => 'social_media_section',
        'type'     => 'url',
    ) );

    // Add Twitter Field
    $wp_customize->add_setting( 'twitter_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'twitter_url', array(
        'label'    => __( 'Twitter URL', 'twentytwentyfour' ),
        'section'  => 'social_media_section',
        'type'     => 'url',
    ) );

    // Add TikTok Field
    $wp_customize->add_setting( 'tiktok_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'tiktok_url', array(
        'label'    => __( 'TikTok URL', 'twentytwentyfour' ),
        'section'  => 'social_media_section',
        'type'     => 'url',
    ) );

  
  // Add YouTube Field
    $wp_customize->add_setting( 'linkedin_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'linkedin_url', array(
        'label'    => __( 'LinkedIn  URL', 'twentytwentyfour' ),
        'section'  => 'social_media_section',
        'type'     => 'url',
    ) );
    // Add YouTube Field
    $wp_customize->add_setting( 'youtube_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'youtube_url', array(
        'label'    => __( 'YouTube URL', 'twentytwentyfour' ),
        'section'  => 'social_media_section',
        'type'     => 'url',
    ) );

}
add_action( 'customize_register', 'twentytwentyfour_customize_register' );


function feature_post_shortcode_function($atts) {
    ob_start();

 $atts = shortcode_atts(
        array(
            'post_ids' => '', // Default empty value
        ),
        $atts,
        'feature_post_shortcode'
    );

    // Extract the 'post_ids' attribute
    


        $feature_args  = array( 
        'post_type' => 'post',
        'posts_per_page'  => 3,
        'post_status' => 'publish', 

        'tax_query' => array(
        array(
        'taxonomy' => 'category',
        'field' => 'slug',
        'terms' => 'feature',
        ),

        ),
  
        );


        if(!empty($atts['post_ids'])){
             $post_ids = explode(",",  $atts['post_ids']);
             $feature_args['orderby']="post__in";
             $feature_args['post__in']=$post_ids;
            
        }
        $feature_loop = new WP_Query($feature_args); 

       // $blog_array=array();
    ?>
   <div class="modified-shortcode">
    <div class="image-container">
         <?php if(!empty($feature_loop)){ 
            $i=1;

            $feature_count = $feature_loop->found_posts;
             while ($feature_loop->have_posts()) : $feature_loop->the_post();
             
                $image_id=get_post_thumbnail_id();
                $image_url = wp_get_attachment_image_src($image_id,'img-polaroid');
                $featured_img= !empty($image_url[0])?$image_url[0]:get_stylesheet_directory_uri() . '/assets/img/dummy.jpg';
                //array_push($blog_array,  get_the_ID()); feature-thum

             ?>
            <?php if($i==1){ ?>
            <div class="main-image">
            <a href="<?php echo get_permalink(); ?>"><?php the_post_thumbnail('feature-thum');?></a>
            <a href="<?php echo get_permalink(); ?>"><h2><?php echo the_title();?></h2></a>
            </div>
           <?php } ?>
   <?php if($i==2){ ?>
        <div class="side-images">
             <?php } ?>
               <?php if($i>=2){ 
                 $image_url = wp_get_attachment_image_src($image_id,'medium-thum');
                $featured_img= !empty($image_url[0])?$image_url[0]:get_stylesheet_directory_uri() . '/assets/img/dummy.jpg'; ?>
            <div class="side-image">
                <a href="<?php echo get_permalink(); ?>"><?php the_post_thumbnail('medium-thum');?></a>
                <a href="<?php echo get_permalink(); ?>"><h3><?php echo the_title();?></h3></a>
            </div>
            <?php } ?>
     <?php if($i>2 && $i==$feature_count){ ?>
        </div>
       <?php } ?>
        <?php 
        $i++;
         endwhile;
       wp_reset_query();  ?>
    <?php } else{ 
        echo "<center><h6> NO POST FOUND.</h6></center>";
    } ?>
    </div>
    </div>
    <?php
     
    // Get the buffered content and clean the buffer
    $output = ob_get_clean();


    return $output;
}
// Prevent WordPress from adding <p> tags

add_shortcode('feature_post_shortcode', 'feature_post_shortcode_function');


function blog_list_shortcode($atts) {
ob_start();
$bloglist_args = array(
        'post_type'      => 'post',
        'posts_per_page' => 8,
        'post_status'    => 'publish',
        'ignore_sticky_posts' => 1,
        'tax_query'      => array(
            array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => 'feature',
                'operator' => 'NOT IN',
            ),
        ),
    );

    $bloglist_loop = new WP_Query($bloglist_args);
    ?>
    
        <div class="bloglist-code">
            <?php if(!empty($bloglist_loop)){ 
                $x=1;
                $bloglist_array=array();
                while ($bloglist_loop->have_posts()) : $bloglist_loop->the_post(); 
                    $imagelist_id=get_post_thumbnail_id();
                    $imagelist_url = wp_get_attachment_image_src($imagelist_id,'list-thum');
                    $featuredlist_img = !empty($imagelist_url[0])?$imagelist_url[0]:get_stylesheet_directory_uri() . '/assets/img/dummy.jpg';
                   // $excerpt =  !empty(get_the_excerpt())?"<strong>Introduction:</strong> ".get_the_excerpt():"";
                    $excerpt =  !empty(get_the_excerpt())?"".get_the_excerpt():"";
                    $author_id = get_the_author_meta('ID');
                    $author_name = get_the_author_meta('display_name');
                    array_push($bloglist_array,  get_the_ID());
                    ?>
            <div class="blog-post">
                <div class="blog-content">
                    <h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <?php
                    //hide author for now to show in first $x==1

                    if(false){ ?>
                    <div class="author-info">
                        <?php if( !empty(get_avatar_url($author_id  ) )){ ?>
                        <a href="<?php echo esc_url(get_author_posts_url($author_id)); ?>"><img src="<?php echo esc_url( get_avatar_url($author_id  ) ); ?>" alt="Author 1" class="author-photo"></a>
                    <?php } ?>
                        <p class="author-name"> <a href="<?php echo esc_url(get_author_posts_url($author_id)); ?>"><?php echo $author_name;?></a></p>
                    </div>
                <?php } ?>
                    <div class="post-excerpt">
                        <p><?php echo $excerpt; ?></p>
                    </div>
                <a href="<?php echo get_permalink(); ?>" class="read-more">Read More <img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/read-more-icon.png'; ?>"/></a>
                </div>
                <div class="blog-image">
                    <a href="<?php echo get_permalink(); ?>"><img src="<?php echo $featuredlist_img; ?>"></a>
                </div>
            </div>
                <?php 
                $x++;
                endwhile;
                wp_reset_query(); 
                } else{ 
                echo "<center><h6> NO POST FOUND.</h6></center>";
                } 
                ?>
            


        </div>
    </div>
    <!-- Add more blog posts as needed -->
    <?php

    // Get the buffered content and clean the buffer
    $output = ob_get_clean();
    wp_cache_set('bloglist_array', $bloglist_array, 'bloglist_array_group');

    return $output;
}
add_shortcode('blog_list', 'blog_list_shortcode');


add_shortcode('blog_grid', 'blog_grid_shortcode');

function blog_grid_shortcode($atts) {
ob_start();
$bloglist_array = wp_cache_get('bloglist_array', 'bloglist_array_group');
$bloggrid_args = array(
        'post_type'      => 'post',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'post__not_in'    => $bloglist_array,
        'tax_query'      => array(
            array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => 'feature',
                'operator' => 'NOT IN',
            ),
        ),
    );

    $bloggrid_loop = new WP_Query($bloggrid_args);
 ?>
 <div class="blog-grid">
      <?php if(!empty($bloggrid_loop)){ 
             while ($bloggrid_loop->have_posts()) : $bloggrid_loop->the_post();  
                $featuredgrid_id=get_post_thumbnail_id();
                $featuredgrid_url = wp_get_attachment_image_src($featuredgrid_id,'post-thumb');
                $featuredgrid_img = !empty($featuredgrid_url[0])?$featuredgrid_url[0]:get_stylesheet_directory_uri() . '/assets/img/dummy.jpg';

                ?>
        <div class="blog-grid-item">
            <div class="blog-grid-item-img">
                <a href="<?php echo get_permalink(); ?>"><img src="<?php echo $featuredgrid_img;  ?>" alt="Blog Image 2"></a>
            </div>
            <div class="blog-grid-item-title"><a href="<?php echo get_permalink(); ?>"><?php the_title();  ?></a></div>
        </div>
          <?php 
            endwhile;
             wp_reset_query(); 
            } else{ 
            echo "<center><h6> NO POST FOUND.</h6></center>";
            } 
            ?>

 </div>
    <!-- Add more blog posts as needed -->
<?php
    // Get the buffered content and clean the buffer
$output = ob_get_clean();
return $output;
}




// Custom local avatars for authors
add_filter('get_avatar_url', 'ad_times_local_avatar_url', 10, 3);
function ad_times_local_avatar_url($url, $id_or_email, $args) {
    $user_id = 0;
    if (is_numeric($id_or_email)) {
        $user_id = (int) $id_or_email;
    } elseif (is_object($id_or_email) && isset($id_or_email->user_id)) {
        $user_id = (int) $id_or_email->user_id;
    } elseif (is_string($id_or_email)) {
        $user = get_user_by('email', $id_or_email);
        if ($user) $user_id = $user->ID;
    }
    $local_avatars = [
        16 => '/wp-content/uploads/2026/03/author-sarah-mitchell.jpg',
        17 => '/wp-content/uploads/2026/03/author-james-carter.jpg',
        18 => '/wp-content/uploads/2026/03/author-rachel-bennett.jpg',
        19 => '/wp-content/uploads/2026/03/author-michael-ross.jpg',
        20 => '/wp-content/uploads/2026/03/author-emily-walker.jpg',
    ];
    if ($user_id && isset($local_avatars[$user_id])) {
        return home_url($local_avatars[$user_id]);
    }
    return $url;
}

add_filter('get_avatar', 'ad_times_local_avatar_html', 10, 6);
function ad_times_local_avatar_html($avatar, $id_or_email, $size, $default, $alt, $args = []) {
    $user_id = 0;
    if (is_numeric($id_or_email)) {
        $user_id = (int) $id_or_email;
    } elseif (is_object($id_or_email) && isset($id_or_email->user_id)) {
        $user_id = (int) $id_or_email->user_id;
    } elseif (is_string($id_or_email)) {
        $user = get_user_by('email', $id_or_email);
        if ($user) $user_id = $user->ID;
    }
    $local_avatars = [
        16 => '/wp-content/uploads/2026/03/author-sarah-mitchell.jpg',
        17 => '/wp-content/uploads/2026/03/author-james-carter.jpg',
        18 => '/wp-content/uploads/2026/03/author-rachel-bennett.jpg',
        19 => '/wp-content/uploads/2026/03/author-michael-ross.jpg',
        20 => '/wp-content/uploads/2026/03/author-emily-walker.jpg',
    ];
    if ($user_id && isset($local_avatars[$user_id])) {
        $url = home_url($local_avatars[$user_id]);
        $class = isset($args['class']) ? (is_array($args['class']) ? implode(' ', $args['class']) : $args['class']) : 'avatar';
        return '<img alt="' . esc_attr($alt) . '" src="' . esc_url($url) . '" class="' . esc_attr($class) . '" height="' . esc_attr($size) . '" width="' . esc_attr($size) . '" />';
    }
    return $avatar;
}

// TL;DR Styles
add_action('wp_head', function () {
    if (!is_singular('post')) return;
    $tldr = get_post_meta(get_the_ID(), 'tldr_summary', true);
    if (empty($tldr)) return;
    echo '<style>
    .tldr-section{background:linear-gradient(135deg,#f0f4ff 0%,#e8eeff 100%);border-right:4px solid #4a6cf7;border-radius:12px;padding:20px 24px;margin-bottom:32px;box-shadow:0 2px 8px rgba(74,108,247,.08)}
    .tldr-header{margin-bottom:10px}
    .tldr-badge{background:#4a6cf7;color:#fff;font-weight:700;font-size:13px;letter-spacing:1px;padding:4px 14px;border-radius:6px;text-transform:uppercase}
    .tldr-text{font-size:16px;line-height:1.7;color:#2d3748;margin:0}
    </style>';
});
?>
