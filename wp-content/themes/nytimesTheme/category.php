<?php get_header(); ?>
<div class="main-body">
    <div class="blog-header">
      <div class="container">
          <h1 class="blog-title">The Bootstrap Blog</h1>
          <p class="lead blog-description">An example blog template built with Bootstrap.</p>
      </div>
    </div>

    <div class="container">
      <div class="row">
      <h2><?php the_category(', '); ?></h2>
        <hr />
      </div>

    <div class="row">
        <div class="col-sm-8 blog-main">
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

        </div><!-- /.blog-main -->

<?php get_footer(); ?>