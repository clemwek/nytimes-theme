<?php get_header(); ?>
  <div class="main-body">
      <div class="blog-header">
        <div class="container">
            <h1 class="blog-title">The Bootstrap Blog</h1>
            <p class="lead blog-description">An example blog template built with Bootstrap.</p>
        </div>
      </div>

    <div class="container">
        <div class="breaking-news">
        <?php echo display_related_products('breaking') ?>
        </div>

    <div class="row">
    <div class="col-sm-8 blog-main">
        <div class="row">
            <div class="col-sm-4">
            <div class="first-posts">
                <?php echo display_related_products('new') ?>
            </div>
        </div><!-- End of the 1st column -->
            <div class="col-sm-8 offset-md-3">
                <dic class="main-posts">
                    <?php if(have_posts()) : ?>
                    <?php while(have_posts()) : the_post(); ?>
                        <div class="blog-post">
                            <a href="<?php the_permalink(); ?>"
                                <h2 class="blog-post-title"><?php the_title(); ?></h2>
                            </a>
                            <p class="blog-post-meta"><?php the_date('F j, Y g:i a'); ?> by 
                            <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                                <?php the_author(); ?>
                            </a></p>
                            <?php if(has_post_thumbnail): ?>
                                <div class="post_thumb">
                                    <?php the_post_thumbnail(); ?>
                                </div>
                            <?php endif; ?>

                            <?php the_excerpt(); ?>
                        </div><!-- /.blog-post -->
                    <?php endwhile; ?>
                    <?php else : ?>
                        <p><?php __('No posts found.') ?></p>
                    <?php endif; ?>
                </dic>
            </div>
        </div>
    </div><!-- End of the 2nd column -->
    <div class="col-sm-4 offset-md-8">
        <h6>opinion</h5>
        <div class="row">
        <div class="col-sm-6">
            <?php display_post_for_category('opinion', 1); ?>
        </div><!-- End of the 3rd column -->
            <div class="col-sm-6 offset-md-6">
        <?php display_post_for_category('opinion', 2); ?>
        </div><!-- End of the last column -->
        </div>
        <div class="row">
            <div class="most-viewed">
                <h4>The most viewed</h4>
                <hr />
                <?php 
                $popularpost = new WP_Query( array( 'posts_per_page' => 4, 'meta_key' => 'wpb_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'  ) );
                while ( $popularpost->have_posts() ) : $popularpost->the_post(); ?>
                <P>
                    <a href="<?php the_permalink(); ?>">
                        <h6><?php the_title(); ?></h6>
                    </a>
                    By <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                        <?php the_author(); ?>
                    </a>
                </p>
                <?php
                endwhile;
                ?>
            </div>
        </div>
    </div>

</div><!-- /.blog-main -->

<?php get_footer(); ?>