<?php
  require_once('wp-bootstrap-navwalker.php');

  function nyt_theme_setup() {
    add_theme_support('post-thumbnails');
    register_nav_menus(array(
      'primary' => __('Primary Menu')
    ));
  }

  add_action('after_setup_theme', 'nyt_theme_setup');

  // Except length controll
  function set_excerpt_length() {
    return 40;
  }

  add_filter('excerpt_length', 'set_excerpt_length');

  // Widgits Locations
  function nyt_init_widgets($id) {
    register_sidebar(array(
      'name'  => 'Sidebar',
      'id'    => 'sidebar',
      'before_widget' => '<div class="sidebar-module">',
      'after_widget'  => '</div>',
      'before_title'  => '<h4>',
      'after_title'   => '</h4>'
    ));
  }

  add_action('widgets_init', 'nyt_init_widgets');

  // Customizer file
  require get_template_directory().'/inc/customizer.php';

  // Most viewed post
  function wpb_set_post_views($postID) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
  }
  //To keep the count accurate, lets get rid of prefetching
  remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

  // tracking something in the header
  function wpb_track_post_views ($post_id) {
    if ( !is_single() ) return;
    if ( empty ( $post_id) ) {
        global $post;
        $post_id = $post->ID;    
    }
    wpb_set_post_views($post_id);
  }
  add_action( 'wp_head', 'wpb_track_post_views');

  /* Display Posts with same tag */
/* ======================== */

if ( ! function_exists( 'display_related_products' ) ) {
      function display_related_products($post_tag) {
          ?>
          <div class="blog-post">
  
              <!-- simple WP_Query -->
              <?php
                  $args = array(
                      'tag' => $post_tag, // Here is where is being filtered by the tag you want
                      'orderby' => 'id',
                      'order' => 'ASC'
                  );
  
                  $related_products = new WP_Query( $args );
              ?>
  
              <?php while ( $related_products -> have_posts() ) : $related_products -> the_post(); ?>
                  <?php if($post_tag == 'breaking'): ?>
                  <h6>
                    breaking news |
                    <a href="<?php the_permalink(); ?>"
                      <p class="first-blog-post-title"><?php the_title(); ?></p>
                    </a>
                  </h6>
                  <div class="row">
                    <div class="col-sm-8">
                    <?php if(has_post_thumbnail): ?>
                        <div class="post_thumb">
                            <?php the_post_thumbnail(); ?>
                        </div>
                    <?php endif; ?>
                    </div>
                    <div class="col-sm-4">
                      <?php the_excerpt(); ?>
                      by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                        <?php the_author(); ?>
                      </a><?php the_date('g:i a'); ?> </p><p class="blog-post-meta"> 
                      <p><?php echo get_comments_number(); ?> Comments</p>
                      </div>
                    </div>
                  <hr />
                <?php else:?>
                  <div class="blog-post">
                    <a href="<?php the_permalink(); ?>"
                        <p class="first-blog-post-title"><?php the_title(); ?></p>
                    </a>
                    by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                        <?php the_author(); ?>
                    </a><?php the_date('g:i a'); ?> </p><p class="blog-post-meta"> 
                    <?php if(has_post_thumbnail): ?>
                        <div class="post_thumb">
                            <?php the_post_thumbnail(); ?>
                        </div>
                    <?php endif; ?>
                    <?php the_excerpt(); ?>
                    <p><?php echo get_comments_number(); ?> Comments</p>
                    <hr />
                </div><!-- /.blog-post -->

                <?php endif;?>

              <?php endwhile; wp_reset_query(); ?>

          </div>
          <?php
      }
  }


  /* Display Posts for a cat */
/* ======================== */

if ( ! function_exists( 'display_post_for_category' ) ) {
  function display_post_for_category($post_cat, $colmn) {
      ?>
      <div class="blog-post">

        <!-- simple WP_Query -->
        <?php
            $args = array(
                'category' => $post_cat, // Here is where is being filtered by the tag you want
                'orderby' => 'id',
                'order' => 'ASC'
            );

            $related_products = new WP_Query( $args );
        ?>
        <?php $count = 1; ?>
        <?php while ( $related_products -> have_posts() ) : $related_products -> the_post(); ?>
            <?php if ($count == $colmn || $ount == $colmn): ?>
            <div class="blog-post">
              <a href="<?php the_permalink(); ?>"
                  <p class="first-blog-post-title"><?php the_title(); ?></p>
              </a>
              by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                  <?php the_author(); ?>
              </a><?php the_date('g:i a'); ?> </p><p class="blog-post-meta"> 
              
              <?php the_excerpt(); ?>
          </div><!-- /.blog-post -->
          <?php endif; ?>
          <?php $count ++ ?>
        <?php endwhile; wp_reset_query(); ?>

      </div>
      <?php
  }
}