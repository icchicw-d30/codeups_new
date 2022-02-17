<?php get_header(); ?>

<!-- ブログ記事一覧ページ -->

<div class="p-sub-visual js-sub-visual">
  <div class="p-sub-visual__image">
    <!-- <img src="" alt="ビジュアルイメージ"> -->
  </div>
  <p class="p-sub-visual__body">ブログ</p><!-- /.p-sub-visual__body -->
</div>


<!-- パンくず -->
<!-- <div class="p-breadcrumb">
  <div class="p-breadcrumb__inner l-inner">
    <ul class="p-breadcrumb__items">
      <li class="p-breadcrumb__item p-breadcrumb-item">
        <a href="<?php home_url(); ?>" class="p-breadcrumb-item__link">ホーム</a>
      </li>
      <li class="p-breadcrumb__item p-breadcrumb-item">
        <a href="" class="p-breadcrumb-item__link">ブログ記事一覧</a>
      </li>
    </ul>
  </div>
</div> -->

  <div class="p-breadcrumb">
    <div class="p-breadcrumb__inner l-inner">
      <?php bcn_display(); //BreadcrumbNavXTのパンくずを表示するための記述 ?>
    </div>
  </div>

<!-- カテゴリー一覧 -->
<div class="p-blog-categories">
  <div class="p-blog-categories__inner">

    <ul class="p-blog-categories__items">
      <li class="p-blog-categories__item">
        <a href="<?php echo esc_url( home_url('/blogs') ); ?>" class="p-blog-categories__all <?php if( !is_category() && is_archive() ) { echo 'p-blog-categories__all--current'; } ?>">ALL</a>
      </li>
      <?php
      $categories = get_categories();
      foreach ($categories as $category) :
      ?>
        <?php
        $cat = get_queried_object(); //クエリのオブジェクト情報取得
        $cat_slug = $cat->slug;
        $cat_name = $cat->name;
        ?>
        <li class="p-blog-categories__item <?php if( $cat_slug === $category->slug ) { echo 'p-blog-categories__item--current';} ?>">
          <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>"><?php echo $category->name; ?></a>
        </li><!-- /.p-blog-categories__item -->
      <?php endforeach; ?>
    </ul><!-- /.p-blog-categories__items -->
  </div><!-- /.p-blog-categories__inner -->
</div><!-- /.p-blog-list__categories -->


<section class="l-blog-list p-blog-list">
  <div class="p-blog-list__inner">
    <?php
    if( have_posts() ) :
    ?>
    <ul class="p-blog-list__items">
      <?php
      while( have_posts() ) :
        the_post($args);
      ?>
        <li class="p-blog-list__item p-blog-item">
          <a href="<?php the_permalink(); ?>" class="p-blog-item__link">
          <!-- NEWアイコンの表示設定 -->
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
            <!-- NEWアイコン -->
            <?php if ( in_array($post->ID, $latest_post_ids) ) : ?>
            <div class="p-blog-item__new">
              <p class="c-new-icon">new</p>
            </div>
            <?php endif; ?>
            <div class="p-blog-item__image">
              <?php if ( has_post_thumbnail() ) : ?>
              <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="ブログイメージ画像">
              <?php else : ?>
              <img src="<?php echo get_template_directory_uri() ?>/assets/img/common/noimage.jpg" alt="noimage">
              <?php endif; ?>
            </div>
            <div class="p-blog-item__box">
              <p class="p-blog-item__title"><?php the_title(); ?></p><!-- /.p-blog-item__title -->
              <div class="p-blog-item__body"><?php the_excerpt(); ?></div><!-- /.p-blog-item__body -->
              <div class="p-blog-item__footer">
                <p class="p-blog-item__tag">
                  <?php
                  $category = get_the_category();
                  if ( $category[0] ) {
                    echo $category[0]->cat_name;
                  }
                  ?>
                </p><!-- /.p-blog-item__tag -->
                <time class="p-blog-item__date" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y-m-d'); ?></time>
              </div><!-- /.p-blog-item__footer -->
            </div><!-- /.p-blog-item__box -->
          </a>
        </li><!-- /.p-blog-list__item -->
      <?php
      endwhile;
      wp_reset_postdata();
      ?>
    </ul><!-- /.p-blog-list__items -->
    <?php endif; ?>

    <div class="p-blog-list__pageNavi">

      <!-- ページネーション WP pagenavi -->
      <div class="p-blog-list__pageNavi">
        <?php wp_pagenavi(); ?>
      </div>

    </div>

  </div>
</section>


<!-- <?php var_dump($wp_rewrite); ?> -->

<!-- お問い合わせセクション -->
<?php get_template_part('template_parts/_p-contact'); ?>

<?php get_footer(); ?>
