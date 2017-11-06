<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <!-- Font awesome cdn -->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Custom styles for this template -->
  <link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet">
  <title>
    <?php bloginfo('name'); ?> | 
    <?php is_front_page() ? bloginfo('description') : wp_title(); ?> 
</title>
<?php wp_head(); ?>
</head>
<body>

  <div class="blog-masthead">
    <div class="container">
      <div class="row">
          <div class="top-buttons">
              <button class="btn btn-sm btn-outline-secondary"><i class="fa fa-bars" aria-hidden="true"></i>
                  SECTIONS</button>
              <button class="btn btn-sm btn-outline-secondary"><i class="fa fa-search" aria-hidden="true"></i>
              SEARCH</button>
          </div>
      </div>
      <hr >
      <div class="header-row ">
          <div class="header-title">
              <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo('name'); ?></a></h1>
              <p> <?php echo current_time('F j, Y'); ?> | 
              <a href="<?php echo esc_url( home_url( '/' ) ); ?>">paper </a> |
               video </p>
          </div>
      </div>
      <div class="nav-row">
          <?php
          $categories = get_categories();
          foreach ($categories as $category) {  
              echo '<a href="'. get_category_link($category) .'"><button>'.$category->name.'</button></a>';
          }
          ?>
      </div>
    </div>
  </div>
  