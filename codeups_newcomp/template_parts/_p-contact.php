<section class="l-contact p-contact">
  <div class="p-contact__inner">
    <div class="p-section-title-box">
      <div class="p-contact__title c-section-title <?php if( is_front_page() ) { echo 'c-section-title--top';} ?>">お問い合わせ</div><!-- /.c-section-title -->
      <div class="p-contact__subtitle c-section-subtitle --contact">contact</div><!-- /.c-section-subtitle -->
    </div>
    <p class="p-contact__body">
      テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。
    </p>
    <div class="p-contact__btn">
      <a class="c-btn --contact --sub-contact" href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' )->ID ) ); ?>">
        <?php if( is_mobile() ) : ?>
        お問い合わせへ
        <?php else : ?>
        詳しく見る
        <?php endif; ?>
      </a>
    </div>
  </div>
</section>
