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
  function set_excerpt_length($len=40) {
    return $len;
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

            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
            <?php $count = 1; ?>
              <?php while ( $related_products -> have_posts() ) : $related_products -> the_post(); ?>
            
                <?php if($post_tag == 'breaking'): ?>
                  <h4>
                    breaking news |
                    <a href="<?php the_permalink(); ?>"
                      <p class="first-blog-post-title"><?php the_title(); ?></p>
                    </a>
                  </h4>
                  <hr />
                <?php elseif($post_tag == 'top'): ?>
                <?php $active = ($count == 1 ? 'active' : '') ?>

                <div class="carousel-item <?php echo $active; ?>">
                    <?php if(has_post_thumbnail): ?>
                        <div class="post_thumb">
                            <?php the_post_thumbnail(); ?>
                        </div>
                    <?php endif; ?>
                    <a href="<?php the_permalink(); ?>"
                        <p class="first-blog-post-title"><?php the_title(); ?></p>
                    </a>
                    <?php the_excerpt(); ?>
                    by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                        <?php the_author(); ?>
                    </a><?php the_date('g:i a'); ?> </p><p class="blog-post-meta"> 

                </div>
                <?php else:?>
                  <div class="blog-post">
                    <a href="<?php the_permalink(); ?>"
                        <p class="first-blog-post-title"><?php the_title(); ?></p>
                    </a>
                    <div class="blog-post-meta">
                        by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                            <?php the_author(); ?>
                        </a><?php the_date('g:i a'); ?> </p><p class="blog-post-meta">
                    </div>
                    <?php if(has_post_thumbnail): ?>
                        <div class="post_thumb">
                            <?php the_post_thumbnail(); ?>
                        </div>
                    <?php endif; ?>
                    <?php the_excerpt(); ?>
                    <a href="<?php the_permalink(); ?>"><?php echo get_comments_number(); ?> Comments</a>
                </div><!-- /.blog-post -->

                <?php endif;?>
              <?php $count ++; ?>  
              <?php endwhile; wp_reset_query(); ?>

              </div>
            </div>
          </div>
          <?php
      }
  }


  /* Display Posts for a cat */
/* ======================== */

if ( ! function_exists( 'display_post_for_category' ) ) {
  function display_post_for_category($post_cat) {
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
            // Get the ID of a given category
            $category_id = get_cat_ID( '$post_cat' );
    
            // Get the URL of this category
            $category_link = get_category_link( $category_id );
        ?>
        <h6><a href="<?php echo $category_link ?>"><?php echo $post_cat ?></a></h5>
        <div class="row">
        <?php $count = 1; ?>
        <?php while ( $related_products -> have_posts() ) : $related_products -> the_post(); ?>
            <?php if ($count < 2): ?>
                <div class="col-sm-6 first-margin">
                    <div class="blog-post">
                    <a href="<?php the_permalink(); ?>"
                        <p class="first-blog-post-title"><?php the_title(); ?></p>
                    </a>
                    by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                        <?php the_author(); ?>
                    </a><?php the_date('g:i a'); ?> </p><p class="blog-post-meta"> 
                    
                    <?php the_excerpt(); ?>
                </div><!-- /.blog-post -->
            </div>
            <?php elseif ($count == 2 ): ?>
                <div class="col-sm-6 first-margin">
                    <div class="blog-post">
                    <a href="<?php the_permalink(); ?>"
                        <p class="first-blog-post-title"><?php the_title(); ?></p>
                    </a>
                    by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                        <?php the_author(); ?>
                    </a><?php the_date('g:i a'); ?> </p><p class="blog-post-meta"> 
                    
                    <?php the_excerpt(); ?>
                </div><!-- /.blog-post -->
            </div>
          <?php endif; ?>
          <?php $count ++ ?>
        <?php endwhile; wp_reset_query(); ?>
        </div>
      </div>
      <?php
  }
}


  /* Register and load the widget */
/* ======================== */
function wpb_load_widget() {
    register_widget( 'wpb_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );
 
// Creating the widget 
class wpb_widget extends WP_Widget {
    
    function __construct() {
        parent::__construct(
        
        // Base ID of your widget
        'wpb_widget', 
        
        // Widget name will appear in UI
        __('NYTimes Cat Widget', 'wpb_widget_domain'), 
        
        // Widget description
        array( 'description' => __( 'Sample widget based on WPBeginner Tutorial', 'wpb_widget_domain' ), ) 
        );
    }
    
    // Creating widget front-end
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
        echo $args['before_title'] . $title . $args['after_title'];
        
        // This is where you run the code and display the output
        echo __( 'Hello, World!', 'wpb_widget_domain' );
        echo $args['after_widget'];
    }
            
    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        } else {
            $title = __( 'New title', 'wpb_widget_domain' );
        }
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <select name="category" id="">
                <?php
                    $args = array(
                        'orderby' => 'id',
                        'hide_empty'=> 0,
                        'child_of' => 5, //Child From Boxes Category 
                    );

                    $categories = get_categories($args);
                    $out = '';
                    foreach ($categories as $cat) {
                        $out += '<option>'.$cat.'</option>';
                    }
                    echo $out;
                ?>
            </select>
        </p>
        <?php 
    }
        
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
        }
    } // Class wpb_widget ends here