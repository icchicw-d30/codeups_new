<?php get_header(); ?>

<div class="contents">

  <section class="l-news-detail p-news-detail">

    <!-- パンくず -->
    <div class="p-breadcrumb p-breadcrumb<?php get_template_part('template_parts/_page-identification'); ?>">
      <div class="p-breadcrumb__inner l-inner">
        <?php bcn_display(); //BreadcrumbNavXTのパンくずを表示するための記述 
        ?>
      </div>
    </div>

    <div class="p-news-detail__inner l-inner">
      <!-- お知らせタイトル -->
      <p class="p-news-detail__title"><?php the_title(); ?></p><!-- /.p-news-detail__title -->

      <!-- お知らせ投稿日とカテゴリ -->
      <div class="p-news-detail__head">
        <!-- お知らせ投稿日 -->
        <time class="p-news-detail__date" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y/m/d'); ?></time><!-- /.p-news-detail__date -->
        <!-- お知らせカテゴリータグ -->
        <?php
        $terms = get_the_terms($post->ID, 'news_category');
        foreach ($terms as $term) :
        ?>
          <a class="p-news-detail__tag c-tag c-tag--btn" href="<?php echo esc_url( get_term_link($term, 'news_category') ); ?>">
            <?php echo $term->name; ?>
          </a>
        <?php endforeach; ?>
      </div>

      <!-- お知らせ記事サムネイル -->
      <?php if (has_post_thumbnail()) : //アイキャッチが設定されている場合 
      ?>
        <div class="p-news-detail__thumbnail">
          <?php the_post_thumbnail(); ?>
        </div>
      <?php else : //アイキャッチが設定されていない場合 
      ?>
      <?php endif; ?>
      <!-- お知らせ記事本文 -->
      <div class="p-news-detail__content">
        <?php the_content(); ?>
      </div><!-- /.p-news-detail__content -->

      <!-- 記事のページナビ -->
      <div class="p-news-detail__nav p-article-nav">
        <?php if (get_previous_post()) : ?>
          <span class="p-article-nav__previous"><?php previous_post_link('%link', 'PREV'); ?></span>
        <?php else : ?>
          <span class="p-article-nav__previous -null">PREV</span>
        <?php endif; ?>

        <span class="p-article-nav__list">
          <a href="<?php echo get_post_type_archive_link('news'); ?>">一覧</a>
        </span>

        <?php if (get_next_post()) : ?>
          <span class="p-article-nav__next"><?php next_post_link('%link', 'NEXT'); ?></span>
        <?php else : ?>
          <span class="p-article-nav__next -null">NEXT</span>
        <?php endif; ?>
      </div>
    </div>

  </section>



  <!-- お問い合わせセクション -->
  <?php get_template_part('template_parts/_p-contact'); ?>


</div>

<?php get_footer(); ?>