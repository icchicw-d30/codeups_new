<?php
/*
Template Name: 事業内容ページ
*/
?>


<?php get_header(); ?>

<div class="contents">

  <!-- サブビジュアル -->
  <div class="p-sub-visual <?php get_template_part('template_parts/_page-identification'); ?> js-sub-visual">
    <div class="p-sub-visual__image">
      <!-- <img src="" alt="ビジュアルイメージ"> -->
    </div>
    <h2 class="p-sub-visual__body"><?php the_title(); ?></h2><!-- /.p-sub-visual__body -->
  </div>


  <section class="l-sub-business p-sub-business">

  <!-- パンくず -->
  <div class="p-breadcrumb <?php get_template_part('template_parts/_page-identification'); ?>">
    <div class="p-breadcrumb__inner l-inner">
      <?php bcn_display(); //BreadcrumbNavXTのパンくずを表示するための記述 ?>
    </div>
  </div>

  <div class="p-sub-business__inner l-inner">

  <!-- 事業内容コンテンツ  -->
  <!-- トップコンテンツ -->
  <div class="p-sub-business__topContents p-business-topContents">
    <?php
    $business_top_title = SCF::get('business_top_title');
    $business_top_text = SCF::get('business_top_text');
    ?>
    <p class="p-business-topContents__title"><?php echo $business_top_title; ?></p>
    <p class="p-business-topContents__text"><?php echo nl2br( $business_top_text ); ?></p>
  </div>
  <!-- コンテンツ（SCF繰り返し） -->
  <div class="p-sub-business__items">
    <?php
    $business_contents_group = SCF::get('business_contents_group');
    $n = 1;
    foreach($business_contents_group as $field) :
      //画像URLを取得
      $imgUrl = wp_get_attachment_image_src( $field['business_contents_img'], 'large' );
    ?>
    <div class="p-sub-business__item p-business-item" id="business-content<?php echo $n; ?>">
      <div class="p-business-item__img">
        <img src="<?php echo $imgUrl[0]; ?>" alt="事業内容のイメージ">
      </div>
      <div class="p-business-item__contents">
        <p class="p-business-item__title"><?php echo $field['business_contents_title']; ?></p>
        <p class="p-business-item__text"><?php echo nl2br( $field['business_contents_text'] ); ?></p>
      </div>
    </div>
    <?php $n++; ?>
    <?php endforeach; ?>
  </div>


  </section>

  <!-- お問い合わせセクション -->
  <?php get_template_part('template_parts/_p-contact'); ?>

</div>

<?php get_footer(); ?>