<?php
$thisPageName = 'blog';
include(APP_PATH.'libs/head.php');
?>
<link rel="stylesheet" href="<?php echo APP_ASSETS ?>css/page/blog.min.css">
</head>
<body id="blog" class="archive">
  <!-- HEADER -->
  <?php include(APP_PATH.'libs/header.php'); ?>
  <div id="container">
    <!-- /container start -->
    <div class="clearfix">
      <div id="mainContent">
        <!-- /mainContent start -->
        <!-- get categories -->
        <h2>Categories</h2>
        <ul>
          <?php
          $args = array(
            'post_type'                => 'blog',
            'orderby'                  => 'id',
            'order'                    => 'desc',
            'hide_empty'               => 0,
            'taxonomy'                 => 'blogcat',
            'pad_counts'               => false
          );

          $categories = get_categories( $args );
          $i = 0;
          foreach ($categories as $cat) {
            $i++;
            $className = "";
            if($i%4 == 0) $className = "class='noMR'";;
            ?>
            <li <?php echo $className; ?>><a href="<?php echo get_term_link($cat->slug,'blogcat');?>"><?php  echo $cat->name; ?>(<?php echo $cat->count; ?>)</a><?php echo category_description(); ?></li>
          <?php } ?>
        </ul>
        <!-- get categories 2 level -->
        <ul class="ul_blog01">
          <?php
          $args = array(
            'post_type'               => 'blog',
            'parent'                  => 0,
            'hide_empty'              => 0,
            'taxonomy'                => 'blogcat',
            'pad_counts'              => false
          );
          $categories = get_categories( $args );
          foreach ($categories as $cat) {
          ?>
            <li><a href="<?php echo get_term_link($cat->slug,'blogcat');?>"><?php echo $cat->name;?></a> (<?php echo $cat->count; ?>)
            <ul>
              <?php
              $argsSub = array(
                'post_type'             => 'blog',
                'child_of'              => $cat->term_id,
                'hide_empty'            => 0,
                'taxonomy'              => 'blogcat',
                'pad_counts'            => false
              );
              $categorySub = get_categories($argsSub);
              foreach ($categorySub as $catsub) {
              ?>
                <li><a href="<?php echo get_term_link($catsub->slug,'blogcat');?>"><?php echo $catsub->name;?></a> (<?php echo $catsub->count; ?>)</li>
              <?php } ?>
              </ul>
            </li>
          <?php }?>
        </ul>
        <!-- get posts from each category -->
        <h2>Posts from each category</h2>
        <ul>
          <?php
          $args = array(
            'post_type'                => 'blog',
            'orderby'                  => 'id',
            'order'                    => 'ASC',
            'hide_empty'               => 0,
            'taxonomy'                 => 'blogcat',
            'pad_counts'               => false
          );
          $categories = get_categories( $args );
          $i = 0;
          foreach ($categories as $cat) {
            $i++;
            $className = "";
            if($i%4 == 0) $className = "class='noMR'";
            ?>
            <li <?php echo $className; ?>>
            <p><a href="<?php echo get_term_link($cat->slug,'blogcat');?>"><?php  echo $cat->name; ?></a></p>
            <ul>
              <?php
              $wp_query = new WP_Query();
              $param = array(
                'post_type'=>'blog',
                'order' => 'DESC',
                'posts_per_page' => '-1',
                'tax_query' => array(
                  array(
                    'taxonomy' => 'blogcat',
                    'field' => 'slug',
                    'terms' => $cat->slug
                    )
                  )
                );
                $wp_query->query($param);
                if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
                ?>
                <li><a href="<?php the_permalink(); ?>"><?php the_time('Y/m/d');?> <?php the_title();?></a></li>
              <?php endwhile;endif;?>
            </ul>
          </li>
          <?php } ?>
        </ul>
        <!-- post and custom fields -->
        <h2>Posts and custom fields</h2>
        <ul>
        <?php
        $wp_query = new WP_Query();

        if (is_month()) {
          $year = get_the_time('Y');
          $month = get_the_time('m');

          $param = array(
            'post_type'                => 'blog',
            'order'                    => 'DESC',
            'post_status'              => 'publish',
            'posts_per_page'           => '10',
            'monthnum'                 => $month,
            'year'                     => $year,
            'paged'                    => $paged
          );
        } else {
          $param=array(
            'post_type'                => 'blog',
            'order'                    => 'DESC',
            'post_status'              => 'publish',
            'posts_per_page'           => '10',
            'paged'                    => $paged
          );
        }
        $wp_query->query($param);
        if($wp_query->have_posts()):while($wp_query->have_posts()) : $wp_query->the_post();
        //$image = wp_get_attachment_image_src(get_field('image'),'blogThumb'); // get image cutom field
        $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'blogThumb'); // get image thumbnail
        ?>
          <li>
            <p><a href="<?php the_permalink(); ?>"><img src="<?php echo $image[0]?>" width="<?php echo $image[1]?>" height="<?php echo $image[2]?>" alt="<?php echo the_title(); ?>"/></a></p>
            <p><?php the_title();?></p>
            <!-- get repeater custom field -->
            <?php
            if(get_field('galleries')):
            while(has_sub_field('galleries')):
              $image = wp_get_attachment_image_src(get_sub_field('image'),'caseGaThumb');
              $imageBig = wp_get_attachment_image_src(get_sub_field('image'),'caseGaBig');
              ?>
              <a href="<?php echo $imageBig[0] ?>"><img src="<?php echo $image[0]?>" width="<?php echo $image[1]?>" height="<?php echo $image[2]?>" alt="<?php echo get_sub_field('title'); ?>"/></a>
            <?php endwhile;endif;?>
          </li>
          <?php endwhile;endif;?>
        </ul>
        <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
        <!-- get archives -->
        <h2>Archives</h2>
        <ul><?php wp_get_archives('type=monthly&post_type=blog&show_post_count=true'); ?></ul>
        <!-- get post object -->
        <?php $post_object = get_field('blog'); ?>
        <?php echo $post_object->post_title ?>
        <?php echo get_field('avatar',$post_object->ID); ?>
        <!-- get posts list follow id of post object -->
        <?php
        $param = array(
          'post_type'                  =>'blog',
          'order'                      => 'DESC',
          'posts_per_page'             => '5',
          'paged'                      => $paged,
          'meta_query'                 => array(
            array(
              'key'                    => 'blog',
              'value'                  => $idprofile,
              'compare'                => 'IN'
            )
          )
        );
        ?>
        <!-- get category name from post id -->
        <?php
        $terms = get_the_terms($post->ID, 'blogcat');
        foreach($terms as $term) { $termname = $term->name; }
        echo $termname;
        ?>
        <!-- show new icon -->
        <?php
        $days=20;
        $today=date('U'); $entry=get_the_time('U');
        $diff1=date('U',($today - $entry))/86400;
        if ($days > $diff1) {
          echo '<img src="/common/img/icon/ico_new.png" alt="" width="42" height="41" class="iconNew" />';
        }
        ?>
        <!-- show new icon -->
        <?php
        $args = array(
          'numberposts'                => -1,
          'post_type'                  => 'event',
          'meta_query'                 => array(
            array(
              'key'                    => 'fieldname',
              'value'                  => 'value',
              'compare'                => '='
            )
          )
        );
        ?>
        <!-- get image with Timthumb -->
        <?php $thumb=wp_get_attachment_image_src(get_field('image'),'full');  ?>
        <?php if($thumb[0]){ ?><p><img src="<?php echo thumbCrop($thumb[0], 504, 243, 1);?>" width="504" height="243" alt=""/></p> <?php } ?>
        <?php echo term_description( $term_id, $taxonomy ) ?>
        <!-- /maincontent end -->
      </div>
    </div>
    <!-- /container end -->
  </div>
  <!-- FOOTER -->
  <?php include(APP_PATH.'libs/footer.php'); ?>
</body>
</html>