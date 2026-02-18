<?php
/*
Template Name: Custom Template
Template Post Type: post
*/
?>
<?php get_header(); ?>

<main id="main">
    <div class="single-post-blog nyt-post">
        <div class="single-blog-wrapper">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();

            $author_name = get_the_author();
            $post_time = get_the_date('M. j, Y');
            $categories = get_the_category();
            $category_name = !empty($categories) ? $categories[0]->name : '';
            $category_link = !empty($categories) ? get_category_link($categories[0]->term_id) : '#';
            ?>

                <!-- NYT Article Header -->
                <header class="nyt-article-header">
                    <?php if ($category_name) : ?>
                        <a href="<?php echo esc_url($category_link); ?>" class="nyt-category-link"><?php echo esc_html($category_name); ?></a>
                    <?php endif; ?>

                    <h1 class="nyt-headline">
                        <?php the_title(); ?>
                    </h1>

                    <?php
                    $introduction = get_field('introduction');
                    if ($introduction) : ?>
                        <p class="nyt-summary"><?php echo esc_html($introduction); ?></p>
                    <?php endif; ?>

                    <div class="nyt-byline">
                        <span class="nyt-byline-text">By <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="nyt-author-link"><?php echo esc_html($author_name); ?></a></span>
                        <div class="nyt-publish-info">
                            <time datetime="<?php echo get_the_date('c'); ?>"><?php echo esc_html($post_time); ?></time>
                        </div>
                    </div>
                </header>

                <!-- Share Bar -->
                <div class="nyt-share-bar">
                    <div class="nyt-share-inner">
                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener" class="nyt-share-btn" aria-label="Share on Twitter">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener" class="nyt-share-btn" aria-label="Share on Facebook">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="mailto:?subject=<?php echo rawurlencode(get_the_title()); ?>&body=<?php echo rawurlencode(get_permalink()); ?>" class="nyt-share-btn" aria-label="Share via Email">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0l-9.75 6.5-9.75-6.5"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Featured Image -->
                <?php if (has_post_thumbnail()) : ?>
                <figure class="nyt-featured-figure">
                    <?php the_post_thumbnail('full', ['class' => 'nyt-featured-image']); ?>
                </figure>
                <?php endif; ?>

                <!-- TL;DR -->
                <?php
                $tldr_summary = get_post_meta(get_the_ID(), 'tldr_summary', true);
                if ($tldr_summary) : ?>
                <div class="nyt-article-body">
                    <div class="tldr-section">
                        <div class="tldr-header">
                            <span class="tldr-badge">TL;DR</span>
                        </div>
                        <p class="tldr-text"><?php echo esc_html($tldr_summary); ?></p>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Article Content -->
                <div class="nyt-article-body single-blog-content">
                    <?php the_content(); ?>
                </div>

                <!-- Tags -->
                <?php
                $tags = get_the_tags();
                if ($tags) : ?>
                <div class="nyt-tags">
                    <span class="nyt-tags-label">Topics</span>
                    <?php foreach ($tags as $tag) : ?>
                        <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="nyt-tag"><?php echo esc_html($tag->name); ?></a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <!-- Author Bio -->
                <div class="nyt-author-bio">
                    <?php echo get_avatar(get_the_author_meta('ID'), 120, '', get_the_author(), ['class' => 'nyt-author-avatar']); ?>
                    <div class="nyt-author-bio-text">
                        <h4><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php echo esc_html($author_name); ?></a></h4>
                        <p><?php echo esc_html(get_the_author_meta('description')); ?></p>
                    </div>
                </div>

                <!-- Related Articles -->
                <div class="nyt-related">
                    <?php
                    $current_category = get_the_category();
                    $args = array(
                        'posts_per_page' => 3,
                        'post__not_in'   => array(get_the_ID()),
                        'category__in'   => $current_category[0]->cat_ID,
                    );
                    $related_posts = get_posts($args);
                    if ($related_posts) : ?>
                        <h3 class="nyt-related-heading">More in <?php echo esc_html($current_category[0]->name); ?></h3>
                        <div class="nyt-related-grid">
                        <?php
                        foreach ($related_posts as $post) :
                            setup_postdata($post);
                            ?>
                            <article class="nyt-related-card">
                                <a href="<?php echo get_permalink(); ?>">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('post-thumb'); ?>
                                    <?php endif; ?>
                                    <h4><?php the_title(); ?></h4>
                                    <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('M. j, Y'); ?></time>
                                </a>
                            </article>
                            <?php
                        endforeach;
                        wp_reset_postdata();
                        ?>
                        </div>
                    <?php endif; ?>
                </div>

            <?php
            endwhile;
        endif;
        ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
