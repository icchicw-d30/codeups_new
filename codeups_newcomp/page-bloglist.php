<?php get_header(); ?>

<!-- ブログ記事一覧ページ -->

<div class="p-sub-visual">
  <p class="p-sub-visual__body">ブログ</p><!-- /.p-sub-visual__body -->
</div>


<!-- パンくず -->
<div class="p-breadcrumb">
  <div class="p-breadcrumb__inner">
    <ul class="p-breadcrumb__items">
      <li class="p-breadcrumb__item p-breadcrumb-item">
        <a href="<?php echo home_url('/'); ?>" class="p-breadcrumb-item__link">トップ</a>
      </li><!-- /.p-breadcrumb-item -->
      <li class="p-breadcrumb__item p-breadcrumb-item">
        <a href="" class="p-breadcrumb-item__link">ブログ記事一覧</a>
      </li><!-- /.p-breadcrumb-item -->
    </ul><!-- /.p-blog-detail__breadcrumb -->
  </div><!-- /.p-breadcrumb__inner -->
</div><!-- /.l-blog-detail -->


<!-- カテゴリー一覧 -->
<div class="p-blog-categories">
  <div class="p-blog-categories__inner">

    <div class="p-blog-categories__all">genre</div><!-- /.p-blog-categories__all -->
    <ul class="p-blog-categories__items">
      <?php
      $categories = get_categories();
      foreach ($categories as $category) :
      ?>
        <li class="p-blog-categories__item p-blog-category-item">
          <a href="<?php echo esc_url( get_category_link($category->term_id) ); ?>"><?php echo $category->name; ?></a>
        </li><!-- /.p-blog-categories__item -->
      <?php endforeach; ?>
    </ul><!-- /.p-blog-categories__items -->
  </div><!-- /.p-blog-categories__inner -->
</div><!-- /.p-blog-list__categories -->


<section class="l-blog-list p-blog-list">
  <div class="p-blog-list__inner">
    <ul class="p-blog-list__items">
      <?php
      global $post;
      /* 表示数の設定 */
      if( is_mobile() ) { // スマホ
        $per_pages = 9;
      } else {
        $per_pages = 9; // タブレット or PC
      }
      $args = array(
        'posts_per_page' => $per_pages,
      );
      $myposts = get_posts($args);
      foreach ($myposts as $post) :
        setup_postdata($post);
      ?>
        <li class="p-blog-list__item p-blog-item">
          <a href="<?php the_permalink(); ?>" class="p-blog-item__link">
          <?php
          $args_new = array(
            'posts_per_page' => 1,
          );
          $latest_post_ids = array(); // 空の配列を用意
          $latestPosts = get_posts($args_new);
          foreach ($latestPosts as $latestPost) {
            $latest_post_ids[] = $latestPost->ID;
          }
          ?>
          <?php if (in_array($post->ID, $latest_post_ids)) : ?>
            <div class="p-blog-item__new">
              <p class="c-new-icon">new</p>
            </div><!-- /.p-blog-item__new -->
          <?php
          endif;
          ?>
            <div class="p-blog-item__image">
              <img src="<?php the_post_thumbnail_url(); ?>" alt="ブログイメージ画像">
            </div><!-- /.p-blog-item__image -->
            <div class="p-blog-item__box">
              <p class="p-blog-item__title"><?php the_title(); ?></p><!-- /.p-blog-item__title -->
              <div class="p-blog-item__body"><?php the_excerpt(); ?></div><!-- /.p-blog-item__body -->
              <div class="p-blog-item__footer">
                <p class="p-blog-item__tag">
                  <?php
                  $categories = get_the_category();
                  if ($categories) {
                    foreach ($categories as $category) {
                      echo $category->name;
                    }
                  }
                  ?>
                </p><!-- /.p-blog-item__tag -->
                <time class="p-blog-item__date" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y-m-d'); ?></time>
              </div><!-- /.p-blog-item__footer -->
            </div><!-- /.p-blog-item__box -->
          </a>
        </li><!-- /.p-blog-list__item -->
      <?php
      endforeach;
      wp_reset_postdata();
      ?>
    </ul><!-- /.p-blog-list__items -->


    

  </div><!-- /.p-blog-list__inner -->
</section><!-- /.l-blog-list -->


<!-- お問い合わせセクション -->
<?php get_template_part('template_parts/_p-contact'); ?>


<?php
      if ( is_mobile() ) {
        $posts_per_page = 9;
      } else {
        $posts_per_page = 6;
      }
      $args = array(
        'post_type' => 'post',
        'posts_per_page' => $posts_per_page,
        'orderby' => 'date',
        'order' => 'ASC'
      );

      $the_query = new WP_Query($args);
      if ($the_query->have_posts()) :
        while ($the_query->have_posts()) : $the_query->the_post();
?>
<?php the_title(); ?><br>
<?php
wp_reset_postdata();
endwhile;
endif;
?>

<?php get_footer(); ?>