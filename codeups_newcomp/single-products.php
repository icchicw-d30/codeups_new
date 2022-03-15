<?php get_header(); ?>



<section class="l-sub-products p-sub-products">

<!-- パンくず -->
  <div class="p-breadcrumb p-breadcrumb<?php get_template_part('template_parts/_page-identification'); ?>">
    <div class="p-breadcrumb__inner l-inner">
      <?php bcn_display(); //BreadcrumbNavXTのパンくずを表示するための記述 ?>
    </div>
  </div>

  <div class="p-sub-products__inner l-inner">
    <!-- 制作実績タイトル -->
    <p class="p-sub-products__title"><?php the_title(); ?></p>

    <!-- 制作実績の投稿日とカテゴリ -->
    <div class="p-sub-products__head">
      <!-- 制作実績の投稿日 -->
      <time class="p-sub-products__date" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y/m/d'); ?></time><!-- /.p-blog-detail__date -->
      <!-- 制作実績のカテゴリータグ -->
      <?php
        $terms = get_the_terms($post->ID, 'products_category'); //現在の記事のターム情報を取得
        $term = $terms[0];
      ?>
      <a class="p-sub-products__tag c-tag" href="<?php echo get_term_link( $term->slug, 'products_category' ); ?>">
        <?php echo $term->name; ?>
      </a>
    </div>
    <!-- 制作実績の記事サムネイル -->
    <!-- <?php if( has_post_thumbnail() ) : //アイキャッチが設定されている場合 ?>
    <div class="p-blog-detail__thumbnail">
      <?php the_post_thumbnail(); ?>
    </div>
    <?php else : //アイキャッチが設定されていない場合 ?>
    <?php endif; ?> -->

    <div class="p-sub-products__gallery p-products-gallery">                
      <div class="swiper js-gallery-slider p-products-gallery__slider">
        <!-- メイン -->
        <div class="swiper-wrapper p-products-gallery__wrapper">
          <?php 
            $galleryImgGroup = SCF::get('galleryImgGroup');
            foreach( $galleryImgGroup as $galleryFields ) :
              $galleryUrl = wp_get_attachment_image_src( $galleryFields['gallery_img'], 'large' );
              $galleryAlt = $galleryFields['gallery_imgAlt'];
          ?>
          <div class="swiper-slide p-products-gallery__img js-products-gallery-img">
            <img src="<?php echo $galleryUrl[0]; ?>" alt="<?php if( $galleryAlt ) { echo $galleryAlt; } else { echo '制作イメージ'; } ?>">
          </div>
          <?php endforeach; ?>
        </div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
      </div>
      <!-- サムネイル -->
      <div class="swiper js-gallery-thumbs p-products-thumbs">
        <div class="swiper-wrapper p-products-thumbs__wrapper">
          <?php 
            $galleryImgGroup = SCF::get('galleryImgGroup');
            foreach( $galleryImgGroup as $galleryFields ) :
              $galleryUrl = wp_get_attachment_image_src( $galleryFields['gallery_img'], 'full');
          ?>
          <div class="swiper-slide p-products-thumbs__img js-products-thumbs-img">
            <img src="<?php echo $galleryUrl[0]; ?>" alt="制作実績イメージのサムネイル">
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <div class="p-sub-products__explain-items">
      <?php 
        $productsExplainGroup = SCF::get('productsExplainGroup');
        foreach( $productsExplainGroup as $field ) :
      ?>
      <div class="p-sub-products__explain-item p-products-explain-item">
        <p class="p-products-explain-item__title">
          <?php echo $field['productsExplainTitle'] ?>
        </p>
        <p class="p-products-explain-item__text">
          <?php
            echo nl2br( $field['productsExplainText'] );
          ?>
        </p>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- 記事のページナビ -->
    <div class="p-sub-products__nav p-article-nav">
      <?php if( get_previous_post() ) : ?>
      <span class="p-article-nav__previous"><?php previous_post_link('%link', 'PREV'); ?></span>
      <?php else : ?>
      <span class="p-article-nav__previous -null">PREV</span>
      <?php endif; ?>

      <span class="p-article-nav__list">
        <a href="<?php echo esc_url( home_url('/blogs') ); ?>">一覧</a>
      </span>

      <?php if( get_next_post() ) : ?>
      <span class="p-article-nav__next"><?php next_post_link('%link', 'NEXT'); ?></span>
      <?php else : ?>
        <span class="p-article-nav__next -null">NEXT</span>
        <?php endif; ?>
      </div>
    </div>

  </div>
</section>




<!-- 関連記事 -->
<section class="l-blog-detail-relation p-blog-detail-relation">
  <div class="p-blog-detail-relation__inner l-inner">
    <div class="p-blog-detail-relation__wrapper p-blog-relation">
      <p class="p-blog-relation__head">
        <?php if( is_mobile() ) : ?>
          おすすめ記事
        <?php else : ?>
          関連記事
        <?php endif; ?>
      </p>
      <div class="p-blog-relation__body">
      <?php
        $categ = get_the_category($post->ID); //現在の投稿IDからカテゴリーを取得
        $catID = array(); //カテゴリーIDを代入する配列を定義
        foreach ($categ as $cat) {
          array_push($catID, $cat->cat_ID); //現在の投稿が持っているカテゴリーIDを配列に格納
        }
        $args = array(
          'post__not_in' => array($post->ID), //現在の投稿を関連記事から除外する
          'category__in' => $catID, //カテゴリーIDの配列を指定
          'posts_per_page' => 4, //表示件数
          'orderby' => 'rand', //ソートをランダムに指定
        );
        $the_query = new WP_Query($args);
        if ($the_query->have_posts()) :
      ?>
        <ul class="p-blog-relation__items">
        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
          <li class="p-blog-relation__item p-blog-item">
            <a href="<?php the_permalink(); ?>" class="p-blog-item__link">
              <!-- NEWアイコン -->
              <?php
              $latest_post_ids = array(); // 空の配列を用意
              $latestPosts = get_posts(array(
                'posts_per_page' => 1, // アイコン表示する最新騎記事の件数
              ));
              foreach ($latestPosts as $latestPost) {
                $latest_post_ids[] = $latestPost->ID; //配列に投稿IDを代入
              }
              ?>
              <!-- in_array関数 現在の投稿IDと配列に代入したIDが一致した場合の処理 -->
              <?php if (in_array($post->ID, $latest_post_ids)) : ?>
                <div class="p-blog-item__new">
                  <p class="c-new-icon">new</p>
                </div>
              <?php
              endif;
              ?>
              <!-- アイキャッチ画像 -->
              <div class="p-blog-item__image">
                <?php if ( has_post_thumbnail() ) : ?>
                <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="ブログイメージ画像">
                <?php else : ?>
                <img src="<?php echo get_template_directory_uri() ?>/assets/img/common/noimage.jpg" alt="noimage">
                <?php endif; ?>
              </div>
              <div class="p-blog-item__box">
                <p class="p-blog-item__title"><?php the_title(); ?></p><!-- /.p-blog-item__title -->
                <?php if( is_mobile() ) : ?>
                <p class="p-blog-item__body"><?php echo get_the_excerpt(); ?></p><!-- /.p-blog-item__body -->
                <?php endif; ?>
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
                  </p>
                  <time class="p-blog-item__date" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>
                </div>
              </div>
            </a>
          </li>
        <?php endwhile; ?>
        </ul>
        <?php wp_reset_postdata(); endif; ?>
      </div>

    </div>

  </div>
</section>


<!-- <?php var_dump($wp_rewrite); ?> -->

<!-- お問い合わせセクション -->
<?php get_template_part('template_parts/_p-contact'); ?>

<?php get_footer(); ?>
