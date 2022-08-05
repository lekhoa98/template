<?php
$titlepage = single_term_title("",false);
$thisPageName = 'blog';
include(APP_PATH.'libs/head.php');
?>
<link rel="stylesheet" href="<?php echo APP_ASSETS ?>css/page/blog.min.css">
</head>
<body id="blog" class="taxonomy_blogcat">
  <!-- HEADER -->
  <?php include(APP_PATH.'libs/header.php'); ?>
  <div id="container">
    <div class="clearfix">
      <div id="mainContent">
        <?php
        $current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); // get current category
        ?>
        <h2><?php echo $current_term->name; ?></h2>
        <ul>
          <?php
          $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
          query_posts($query_string . '&orderby=post_date&order=desc&posts_per_page=10&paged=' . $paged);
          if(have_posts()) : while(have_posts()) : the_post();
          ?>
            <li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
          <?php endwhile; endif; ?>
        </ul>
      </div>
    </div>
  </div>
  <!-- FOOTER -->
  <?php include(APP_PATH.'libs/footer.php'); ?>
</body>
</html>