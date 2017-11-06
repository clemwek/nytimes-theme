<?php get_header(); ?>
<div class="main-body">

    <div class="container">
        <div class="breaking-news">
            <?php echo display_related_products('breaking') ?>
        </div>
        <div class="advert">

        </div>
    <div class="row">
    <div class="col-md-8 blog-main">
        <div class="row">
            <div class="col-md-4 first-margin">
                <div class="first-posts">
                    <?php echo display_related_products('new') ?>
                </div><!-- End of the 1st column -->
            </div><!--End col-sm-4-->
            <div class="col-md-8 offset-md-3 first-margin">
                <div class="main-story">
                    <?php echo display_related_products('top') ?>
                </div><!--End main story-->
                <div class="main-posts">
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
                </div>
            </div>
        </div>
    </div><!-- End of the 2nd column -->
    <div class="col-sm-4 offset-md-8">
        <div class="side-cat">
            <?php display_post_for_category("opinion"); ?>
        </div>
        <div class="row most-viewed">
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
                    <?php the_excerpt(); ?>
                </p>
                <?php
                endwhile;
                ?>
            </div>
        </div>
    </div>
</div><!-- /.blog-main -->
<div class="video-section">
    <div class="col-md-12">
        <div class="video-header">
            <p>
                video section
                <span class="pull-right show-all-video">
                    explore all videos
                </span>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <h2>the video section</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. In ab cumque labore rem libero ut optio mollitia fugit, possimus velit consectetur dignissimos natus eligendi exercitationem officia dicta! Quisquam cumque natus non odit voluptatum fugit iusto optio ipsa ducimus illum quis harum nisi rem laboriosam accusantium asperiores molestiae at quam mollitia, minus obcaecati! Officia consequuntur amet cum fugit sed voluptatem molestiae a expedita excepturi numquam, voluptas et eum! Ducimus, omnis dolorum itaque perferendis autem officia amet repudiandae, quisquam laudantium ipsum ratione. Ipsam architecto corrupti nam illo quae nihil reprehenderit, dicta maxime praesentium veritatis aut amet assumenda dolorem facere iste quidem. Nam inventore, veritatis exercitationem beatae numquam officiis corrupti ipsum. Exercitationem enim veniam illo repellat deleniti quidem fugiat velit eveniet fugit ipsum porro tenetur, veritatis consequuntur atque eaque neque. Numquam qui atque vel enim voluptates cupiditate itaque sequi vitae quam ut repellat accusamus, ad velit laudantium, dolore labore. Quasi excepturi, voluptate nobis ut maxime suscipit saepe recusandae accusantium magnam possimus quos facere illum, incidunt optio? Id inventore quam exercitationem eveniet hic magni. Similique exercitationem incidunt dolorum quidem sunt quasi cupiditate dolorem dolor, est tenetur aperiam debitis, officia consectetur quia necessitatibus dicta modi. Molestiae ratione debitis cupiditate architecto nemo, earum ullam laudantium tenetur!</p>
        </div>
        <div class="col-md-3">
            <h2>some random staff</h2>
        </div>
    </div>
</div>

<?php get_footer(); ?>