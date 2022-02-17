<?php get_header(); ?>

<!-- ブログ記事一覧ページ -->

<!-- サブビジュアル -->
<div class="p-sub-visual <?php get_template_part('template_parts/_page-identification'); ?> js-sub-visual">
  <div class="p-sub-visual__image">
    <!-- <img src="" alt="ビジュアルイメージ"> -->
  </div>
  <p class="p-sub-visual__body">お知らせ</p><!-- /.p-sub-visual__body -->
</div>

  <!-- パンくず -->
  <div class="p-breadcrumb p-breadcrumb<?php get_template_part('template_parts/_page-identification'); ?>">
    <div class="p-breadcrumb__inner l-inner">
      <?php bcn_display(); //BreadcrumbNavXTのパンくずを表示するための記述 ?>
    </div>
  </div>


  <!-- お知らせ記事リスト -->
  <section class="l-sub-news p-sub-news">
    <div class="p-sub-news__inner l-inner">
      <div class="p-sub-news__items">
        <?php 
          if( have_posts() ) :
          while( have_posts() ) : the_post();
        ?>
        <div class="p-sub-news__item p-news-item">
          <div class="p-news-item__head">
            <time class="p-news-item__date c-time" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>
            <?php 
            $terms = get_terms('news_category');
            foreach( $terms as $term ) :
            ?>
            <div class="p-news-item__tag c-tag">
              <?php echo $term->name; ?>
            </div>
            <?php endforeach; ?>
          </div>
          <a href="<?php the_permalink(); ?>" class="p-news-item__link">
            <p class="p-news-item__title c-news-title"><span><?php the_title(); ?></span></p>
          </a>
        </div>
        <?php endwhile; endif; wp_reset_postdata(); ?>
      </div>

      <!-- ページネーション WP pagenavi -->
      <div class="p-sub-products-archive__pageNavi">
        <?php wp_pagenavi(); ?>
      </div>

    </div>
  </section>





<!-- お問い合わせセクション -->
<?php get_template_part('template_parts/_p-contact'); ?>

<?php get_footer(); ?>
