<?php
/*
Template Name: お問い合わせページ
*/
?>


<?php get_header(); ?>

<div class="contents">

  <!-- サブビジュアル -->
  <div class="p-sub-visual <?php get_template_part('template_parts/_page-identification'); ?> js-sub-visual">
    <div class="p-sub-visual__image">
      <!-- <img src="" alt="ビジュアルイメージ"> -->
    </div>
    <p class="p-sub-visual__body"><?php the_title(); ?></p><!-- /.p-sub-visual__body -->
  </div>


  <section class="l-sub-contact p-sub-contact">

    <!-- パンくず -->
    <div class="p-breadcrumb <?php get_template_part('template_parts/_page-identification'); ?>">
      <div class="p-breadcrumb__inner l-inner">
        <?php bcn_display(); //BreadcrumbNavXTのパンくずを表示するための記述 ?>
      </div>
    </div>

    <div class="p-sub-contact__inner l-inner">
      <!-- フォーム -->
      <div class="p-sub-contact__form p-contact-form">

      <?php echo do_shortcode('[contact-form-7 id="326" title="コンタクトフォーム"]'); // Contact Form 7 呼び出し ?>

        <!-- <form action="">
          <div class="p-contact-form__items">
            <p class="p-contact-form__error">※必要事項を入力してください</p>
            <div class="p-contact-form__item p-contact-form-item">
              <dt class="p-contact-form-item__label">
                <label for="contact-company">※会社名</label>
              </dt>
              <dd class="p-contact-form-item__body">
                <input type="text" id="contact-company" placeholder="テキストがはいります">
              </dd>
            </div>
            <div class="p-contact-form__item p-contact-form-item">
              <dt class="p-contact-form-item__label">
                <label for="contact-name">※お名前</label>
              </dt>
              <dd class="p-contact-form-item__body">
                <input type="text" id="contact-name" placeholder="テキストがはいります">
              </dd>
            </div>
            <div class="p-contact-form__item p-contact-form-item">
              <dt class="p-contact-form-item__label">
                <label for="contact-kana">※ふりがな</label>
              </dt>
              <dd class="p-contact-form-item__body">
                <input type="text" id="contact-kana" placeholder="テキストがはいります">
              </dd>
            </div>
            <div class="p-contact-form__item p-contact-form-item">
              <dt class="p-contact-form-item__label">
                <label for="contact-email">※メールアドレス</label>
              </dt>
              <dd class="p-contact-form-item__body">
                <input type="email" id="contact-email" placeholder="テキストがはいります">
              </dd>
            </div>
            <div class="p-contact-form__item p-contact-form-item">
              <dt class="p-contact-form-item__label --detail">
                <label for="contact-detail">※お問い合わせ内容</label>
              </dt>
              <dd class="p-contact-form-item__body">
                <textarea name="" id="contact-detail" placeholder="テキストがはいります"></textarea>
              </dd>
            </div>
          </div>
          <div class="p-contact-form-item__btn">
            <input type="submit" value="送信" class="c-contact-btn">
          </div>

        </form> -->
      </div>

    </div>

  </section>


</div>

<?php get_footer(); ?>