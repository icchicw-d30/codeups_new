<?php
session_start();
if ( isset($_POST['windowSize']) ){
  $_SESSION['windowSize'] = $_POST['windowSize'];
}
?>

<?php get_header(); ?>

<div class="contents">

  <!-- メインビジュアル -->
  <div class="l-main-visual p-main-visual js-main-visual">
    <div class="js-main-visual-slider swiper">
      <?php
      $mv_slider = SCF::get_option_meta('mv_slider');
      $mv_slider_group = $mv_slider['mv_slider_group'];
      if (!empty($mv_slider_group)) :
      ?>
      <div class="p-main-visual__items swiper-wrapper">
        <?php foreach ($mv_slider_group as $item) :
          //画像
          $mv_img_pc_id = $item['mv_slider_img_pc'];
          $mv_img_pc_src = wp_get_attachment_url($mv_img_pc_id);
          $mv_img_sp_id = $item['mv_slider_img_sp'];
          $mv_img_sp_src = wp_get_attachment_url($mv_img_sp_id);
          //alt
          // $alt_pc = get_post_meta($mv_img_pc_id, '_wp_attachment_image_alt', true);
          $alt_pc = $item['mv_slider_alt'];
          //タイトル
          $mv_slider_title = $item['mv_slider_title'];
          //サブタイトル
          $mv_slider_subtitle = $item['mv_slider_subtitle'];
          //ボタンリンク
          $mv_slider_link = $item['mv_slider_link'];
        ?>
        <div class="p-main-visual__item swiper-slide">
          <div class="p-main-visual__image">
            <picture>
              <source srcset="<?php echo $mv_img_pc_src;?>" media="(min-width: 768px)" /><!-- 幅768px以上なら表示 -->
              <img src="<?php echo $mv_img_sp_src;?>" alt="<?php if($alt_pc){echo $alt_pc;} else {echo 'メインビジュアル';}?>" />
              <!-- <img src="<?php echo get_template_directory_uri() ?>/assets/img/common/mv01.jpg" alt="メインビジュアル1"> -->
            </picture>
          </div>
          <div class="p-main-visual__block">
            <h2 class="c-main-visual-title"><?php echo nl2br($mv_slider_title);?></h2>
            <h3 class="c-main-visual-subtitle"><?php echo nl2br($mv_slider_subtitle);?></h3>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>
  </div>


  <!-- お知らせ -->
  <section class="l-top-info p-top-info">
    <div class="p-top-info__inner l-inner">
      <?php
      $args = array(
        'post_type' => 'news', // 投稿を指定
        'posts_per_page' => 1, // 表示する件数
      );
      $news_query = new WP_Query($args);
      if ($news_query->have_posts()) :
      ?>
        <div class="p-top-info__wrapper">
          <ul class="p-top-info__items">
            <?php while ($news_query->have_posts()) : $news_query->the_post(); ?>
            <li class="p-top-info__item p-info-item">
              <div class="p-info-item__head">
                <time class="p-info-item__date" datetime="<?php the_time('c'); ?>"><?php the_time('Y.n.j'); ?></time>
                  <!-- カテゴリー -->
                  <p class="p-info-item__tag c-tag">
                    <?php
                    $terms = get_terms('news_category');
                    foreach ($terms as $term) {
                      echo $term->name;
                    }
                    ?>
                  </p>
              </div>
              <!-- タイトル -->
              <a href="<?php the_permalink(); ?>" class="p-info-item__link">
                <p class="p-info-item__title">
                  <span><?php the_title(); ?></span>
                </p>
              </a>
            </li>
            <?php endwhile; ?>
          </ul>
        <?php
        wp_reset_query();
        endif;
        ?>
        <div class="p-top-info__btn">
          <a class="c-news-btn" href="<?php echo get_post_type_archive_link('news'); ?>">すべて見る</a><!-- /.c-btn -->
        </div>
      </div>
    </div>
  </section>


  <!-- 事業内容 -->
  <?php
  $page_ID = get_page_by_path('business'); //固定ページオブジェクト取得
  $page_ID = $page_ID->ID; //ID取得
  ?>
  <section class="l-top-content p-top-content">
    
    <div class="c-section-line-toRight"><!-- 左上から右下への背景線 --></div>
    <div class="p-top-content__inner">
      <div class="p-section-title-box">
        <h2 class="c-section-title c-section-title--content"><?php echo get_the_title($page_ID); ?></h2>
        <p class="c-section-subtitle p-top-content__subtitle">content</p>
      </div>
      <ul class="p-top-content__items">
        <li class="p-top-content__item p-content-item">
          <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'business' )->ID ) ); ?>" class="p-content-item__link">
            <?php
            $business_top_img = SCF::get('business_top_img', $page_ID);
            $businessTopImgUrl = wp_get_attachment_image_src($business_top_img, 'large');
            ?>
            <div class="p-content-item__image">
              <img src="<?php echo $businessTopImgUrl[0]; ?>" alt="事業内容イメージ">
              <!-- <img src="<?php echo get_template_directory_uri() ?>/assets/img/content/content00.jpg" alt="事業内容イメージ"> -->
            </div>
            <p class="p-content-item__body">経営理念ページへ</p>
          </a>
        </li>
        <?php
          $business_contents_group = SCF::get('business_contents_group', $page_ID);
          $i = 1;
          foreach( $business_contents_group as $bcg_item ) :
            $imgUrl = wp_get_attachment_image_src( $bcg_item['business_contents_img'], 'large');
        ?>
        <li class="p-top-content__item p-content-item">
          <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'business' )->ID ) ); ?>#business-content<?php echo $i; ?>" class="p-content-item__link">
            <div class="p-content-item__image">
              <img src="<?php echo $imgUrl[0]; ?>" alt="事業内容イメージ">
              <!-- <img src="<?php echo get_template_directory_uri() ?>/assets/img/content/content01.jpg" alt="事業内容イメージ"> -->
            </div>
            <p class="p-content-item__body">理念<?php echo $i; ?>へ</p>
          </a>
        </li>
        <?php $i++; ?>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>
  <?php unset($page_ID); //変数リセット ?>


  <!-- 制作実績 -->
  <?php
    $object = get_post_type_object('products'); //投稿タイプのオブジェクト情報取得
  ?>
  <section class="l-top-works p-top-works">
    <div class="c-section-line-toLeft"></div>
    <div class="p-top-works__inner l-inner">
      <!-- 制作実績タイトル -->
      <div class="p-section-title-box">
        <h2 class="c-section-title"><?php echo $object->label; ?></h2>
        <h3 class="p-top-works__subtitle c-section-subtitle c-section-subtitle--reverse">works</h3>
      </div>
      <!-- 制作実績スライダー -->
      <div class="p-top-works__content p-top-contentBox">
        <div class="swiper js-top-works-slider">
          <?php
          $top_products = SCF::get_option_meta('top_products');
          $top_products_group = $top_products['top_products_group'];
          if (!empty($top_products_group)) :
          ?>
          <div class="swiper-wrapper p-top-contentBox__items">
            <!-- SCFオプションページ -->
            <?php
            //SCFで設定した制作実績を1つづつ取り出す
            foreach ($top_products_group as $item) :
            //選択した関連する投稿「products」
            $top_products_relation = $item['top_products_relation'];
            //選択した関連する投稿「products」の投稿ID
            $products_id = $top_products_relation[0];
            //サブタイトル
            $top_products_subtitle = $item['top_products_subtitle'];
            ?>
            <!-- 制作実績スライダーアイテム -->
            <div class="swiper-slide p-top-contentBox__item">
              <div class="p-top-works__image p-top-contentBox__image">
                <?php
                // 選択した関連する投稿のアイキャッチ画像URLを取得
                $thumbUrl = get_the_post_thumbnail_url($products_id, 'full');
                //それぞれの投稿IDに紐づいた画像グループを取得
                $galleryImgGroup = SCF::get('galleryImgGroup', $products_id);
                //画像グループ内の画像を取得して1つづつ取り出す
                foreach( $galleryImgGroup as $field ) :
                  $ImgUrl = wp_get_attachment_image_src( $field['gallery_img'], 'large' ); //画像URL
                  $ImgAlt = $field['gallery_imgAlt']; //alt
                ?>
                <!-- アイキャッチが設定されていない場合は画像グループ内の画像1枚目 -->
                <img src="<?php if($thumbUrl){ echo esc_url($thumbUrl); } else {echo esc_url($ImgUrl[0]);} ?>" alt="<?php if($ImgAlt){echo $ImgAlt;} else {echo '制作実績イメージ';} ?>">
                <?php break; endforeach; //break;で1回だけ回す ?>
              </div>
              <div class="p-top-works__box p-top-contentBox__box">
                <p class="p-top-works__title p-top-contentBox__title"><?php echo get_the_title($products_id); //投稿IDに紐づいたタイトル ?></p>
                <p class="p-top-works__body p-top-contentBox__body"><?php echo nl2br($top_products_subtitle); //SCFで設定したサブタイトル ?></p>
                <div class="p-top-works__btn p-top-contentBox__btn">
                  <!-- <a class="c-btn" href="<?php echo get_post_type_archive_link('products'); ?>">詳しく見る</a> -->
                  <a class="c-btn" href="<?php echo get_permalink($products_id); //投稿のURL ?>">詳しく見る</a>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
          <div class="swiper-pagination p-top-contentBox__pagination"></div>
          <?php endif; ?>
        </div>
      </div>

    </div>
  </section>
  <?php unset($object); //変数リセット ?>


  <!-- 企業概要 -->
  <?php
  $page_ID = get_page_by_path('profile'); //固定ページオブジェクト取得
  $page_ID = $page_ID->ID; //ID取得
  ?>
  <section class="l-top-overview p-top-overview">
    <div class="p-top-overview__inner l-inner">
      <div class="p-section-title-box">
        <h2 class="c-section-title"><?php echo get_the_title($page_ID); ?></h2>
        <h3 class="p-top-overview__subtitle c-section-subtitle">overview</h3>
      </div>

      <div class="p-top-overview__content p-top-contentBox p-top-contentBox--reverse">
        <?php
        $profile_top_img = SCF::get('profile_top_img', $page_ID);
        $profileTopImgUrl = wp_get_attachment_image_src($profile_top_img, 'large');
        $profile_top_title = SCF::get('profile_top_title', $page_ID);
        $profile_top_body = SCF::get('profile_top_body', $page_ID);
        ?>
        <div class="p-top-overview__image p-top-contentBox__image">
          <img src="<?php echo $profileTopImgUrl[0]; ?>" alt="企業概要イメージ">
          <!-- <img src="<?php echo get_template_directory_uri() ?>/assets/img/overview/overview.jpg" alt="企業概要イメージ"> -->
        </div>
        <div class="p-top-overview__box p-top-contentBox__box p-top-contentBox__box--reverse">
          <p class="p-top-overview__title p-top-contentBox__title"><?php echo $profile_top_title; ?></p>
          <p class="p-top-overview__body p-top-contentBox__body"><?php echo $profile_top_body; ?></p>
          <div class="p-top-overview__btn p-top-contentBox__btn">
            <a class="c-btn" href="<?php echo esc_url( get_permalink( get_page_by_path( 'business' )->ID ) ); ?>">詳しく見る</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php unset($page_ID); ?>

  <!-- ブログ -->
  <?php
    $object = get_post_type_object('post'); //投稿タイプのオブジェクト情報取得
    // var_dump($object);
    $user = get_users();
  ?>
  <section class="l-top-blog p-top-blog">
    <div class="p-top-blog__inner l-inner">
      <div class="p-section-title-box">
        <h2 class="c-section-title --blog">ブログ</h2>
        <h3 class="p-top-blog__subtitle c-section-subtitle c-section-subtitle--reverse">blog</h3>
      </div>

      <ul class="p-top-blog__items">
        <!-- function.php pre_get_posts関数にて表示件数を定義 -->
        <!-- query_postsは非推奨 -->
        <?php
        /* PCとスマホの表示数切り替え */
        if ( is_mobile() ) {
          $num = 3; // SP時の表示数
        } else {
          $num = 3; // PC時の表示数
        }
        $args = array(
          'post_type' => 'post',
          'posts_per_page' => $num, // 表示件数 $num件
        );
        $p_query = new WP_Query($args);
        ?>
        <?php if ($p_query->have_posts()) : ?>
          <?php while ($p_query->have_posts()) : $p_query->the_post(); ?>
            <li class="p-top-blog__item p-blog-item">
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
                <div class="p-blog-item__image">
                  <?php if ( has_post_thumbnail() ) : ?>
                  <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="ブログイメージ画像">
                  <?php else : ?>
                  <img src="<?php echo get_template_directory_uri() ?>/assets/img/common/noimage.jpg" alt="noimage">
                  <?php endif; ?>
                </div><!-- /.p-blog-item__image -->
                <div class="p-blog-item__box">
                  <div class="p-blog-item__head">
                    <!-- ブログタイトル -->
                    <p class="p-blog-item__title"><?php the_title(); ?></p>
                    <!-- ブログ本文抜粋 -->
                    <p class="p-blog-item__body"><?php echo get_the_excerpt(); ?></p>
                  </div>
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
        <?php wp_reset_query(); endif; ?>
      </ul>
      <!-- page-bloglist.php へリンク -->
      <div class="p-top-blog__btn">
        <a class="c-btn" href="<?php echo esc_url(home_url('/blogs/')); ?>">詳しく見る</a>
      </div>

    </div>
  </section>
  <?php unset($object); ?>




  <!-- お問い合わせセクション -->
  <?php get_template_part('template_parts/_p-contact'); ?>

  <!-- <?php var_dump($wp_rewrite); ?> -->

</div>

<?php get_footer(); ?>
