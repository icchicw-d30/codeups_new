<?php get_header(); ?>



<div class="p-sub-visual <?php get_template_part('template_parts/_page-identification'); ?> js-sub-visual">
  <div class="p-sub-visual__image">
    <!-- <img src="" alt="ビジュアルイメージ"> -->
  </div>
  <p class="p-sub-visual__body">制作実績</p><!-- /.p-sub-visual__body -->
</div>

<section class="l-sub-products-archive p-sub-products-archive">
  
  <!-- パンくず -->
  <div class="p-breadcrumb <?php get_template_part('template_parts/_page-identification'); ?>">
    <div class="p-breadcrumb__inner l-inner">
      <?php bcn_display(); //BreadcrumbNavXTのパンくずを表示するための記述 ?>
    </div>
  </div>
  
  <div class="p-sub-products-archive__inner l-inner">

    <!-- カスタムタクソノミー一覧 -->
    <div class="p-products-archive-terms">
      <!-- <div class="p-products-archive-terms__inner l-inner"> -->
      <?php
        $cat = get_queried_object(''); //クエリのオブジェクト情報取得
        // $cat_slug = $cat->slug;
        $cat_name = $cat->name;
        // var_dump($cat);
      ?>
        <ul class="p-products-archive-terms__items">
          <li class="p-products-archive-terms__item">
            <a href="<?php echo esc_url( home_url('/products') ); ?>" class="p-products-archive-terms__all <?php if( $cat_name === 'products' ) { echo 'p-products-archive-terms__all--current'; } ?>">ALL</a>
          </li>
          <?php
            $terms = get_terms('products_category'); //カスタムタクソノミー情報を取得
            foreach( $terms as $term ) :
          ?>
          <li class="p-products-archive-terms__item">
            <!-- <?php var_dump($term); ?> -->
            <a href="<?php echo get_term_link($term->slug, 'products_category'); ?>" class="<?php if( $term_name === 'products' ) { echo 'p-products-archive-terms__category--current'; } ?>"><?php echo $term->name; ?></a>
          </li>
          <?php endforeach; ?>
        </ul>
      <!-- </div> -->
    </div>

    <!-- 記事ループ -->
    <div class="p-sub-products-archive__items">
      <?php
        if( have_posts() ) :
        while( have_posts() ) : the_post();
      ?>
      <div class="p-sub-products-archive__item p-products-archive-item">
        <a href="<?php the_permalink(); ?>" class="p-products-archive__link">
          <!-- アイキャッチ画像 -->
          <?php 
            $thumbs_id = get_post_thumbnail_id($post->ID);
            $thumbs_url = wp_get_attachment_image_src($thumbs_id, 'large');
          ?>
          <div class="p-products-archive-item__img">
            <?php if( has_post_thumbnail() ) : //アイキャッチが設定されている場合 ?>
            <img src="<?php echo $thumbs_url[0]; ?>" alt="<?php the_title(); ?>">
            <?php else : //アイキャッチが設定されていない場合 ?>
            <?php endif; ?>
          </div>
          <!-- 制作実績ターム -->
          <?php
            $terms = get_the_terms($post->ID, 'products_category'); //投稿のカスタムタクソノミー情報を取得
            if( !empty($terms) ) : //カスタムタクソノミーがある場合
            foreach( $terms as $term ) :
          ?>
          <!-- <?php var_dump($term); ?> -->
          <span class="p-products-archive-item__tag c-term"><?php echo $term->name; ?></span>
          <?php endforeach;?>
          <?php else : //カスタムタクソノミーがない場合 ?>
            <span class="p-products-archive-item__tag c-term">未分類</span>
          <?php endif; ?>
          <!-- 制作実績タイトル -->
          <p class="p-products-archive-item__title"><?php the_title(); ?></p>
        </a>
      </div>
      <?php endwhile; endif; ?>
      <?php wp_reset_postdata(); ?>
    </div>

    <!-- ページネーション WP pagenavi -->
    <div class="p-sub-products-archive__pageNavi">
      <?php wp_pagenavi(); ?>
    </div>
    
  </div>
</section>




<!-- <?php var_dump($wp_rewrite); ?> -->



<!-- お問い合わせセクション -->
<?php get_template_part('template_parts/_p-contact'); ?>

<?php get_footer(); ?>