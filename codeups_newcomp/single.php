<?php get_header(); ?>

<section class="l-blog-detail p-blog-detail">

  <div class="p-breadcrumb">
    <div class="p-breadcrumb__inner l-inner">
      <?php bcn_display(); //BreadcrumbNavXTのパンくずを表示するための記述 ?>
    </div>
  </div>
  
  <div class="p-blog-detail__inner l-inner">
    <!-- ブログタイトル -->
    <p class="p-blog-detail__title"><?php the_title(); ?></p><!-- /.p-blog-detail__title -->

    <!-- ブログ投稿日とカテゴリ -->
    <div class="p-blog-detail__head">
      <!-- ブログ投稿日 -->
      <time class="p-blog-detail__date" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y/m/d'); ?></time><!-- /.p-blog-detail__date -->
      <!-- ブログカテゴリータグ -->
      <?php
      $categories = get_the_category(); // カテゴリー情報取得
      if ($categories) :
        // カテゴリーリンク
        $category_link = get_category_link( $categories[0]->term_id );
        foreach ($categories as $category) :
      ?>
      <a class="p-blog-detail__tag c-tag c-tag--btn" href="<?php echo $category_link; ?>">
        <?php echo $category->name; // カテゴリー名 ?>
      </a>
      <?php endforeach; endif; ?>
    </div>

    <!-- ブログ記事サムネイル -->
    <?php if( has_post_thumbnail() ) : //アイキャッチが設定されている場合 ?>
    <div class="p-blog-detail__thumbnail">
      <?php the_post_thumbnail(); ?>
    </div>
    <?php else : //アイキャッチが設定されていない場合 ?>
    <?php endif; ?>
    <!-- ブログ記事本文 -->
    <div class="p-blog-detail__content">
      <?php the_content(); ?>
    </div><!-- /.p-blog-detail__content -->

    <!-- 記事のページナビ -->
    <div class="p-blog-detail__nav p-article-nav">
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
                </div><!-- /.p-blog-item__image -->
                <div class="p-blog-item__box">
                  <p class="p-blog-item__title"><?php the_title(); ?></p>
                  <?php if( is_mobile() ) : ?>
                  <p class="p-blog-item__body"><?php echo get_the_excerpt(); ?></p>
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
