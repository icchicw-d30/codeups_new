<!-- page-top -->
<div class="p-page-top js-pagetop">
  <a href="#" class="c-page-top">
    <div class="c-arrow-top"></div>
  </a>
</div>
<!-- /.page-top -->

<footer class="l-footer p-footer">
  <div class="p-footer__inner l-inner">
    <div class="p-footer__logo">
      <a href="<?php echo esc_url(home_url('/')); ?>">
        <img class="c-logo" src="<?php echo get_template_directory_uri() ?>/assets/img/common/codeups.svg" alt="フッターロゴ">
      </a>
    </div>
    <div class="p-footer__menu">
      <ul class="p-footer__items">
        <li class="p-footer__item p-footer-item">
          <a class="p-footer-item__link" href="<?php echo esc_url( home_url('/') ); ?>">トップ</a><!-- /.p-footer-item__link -->
        </li>
        <li class="p-footer__item p-footer-item p-footer-item--news">
          <a class="p-footer-item__link" href="<?php echo esc_url( get_post_type_archive_link('news') ); ?>">お知らせ</a><!-- /.p-footer-item__link -->
        </li>
        <li class="p-footer__item p-footer-item">
          <a class="p-footer-item__link" href="<?php echo esc_url( get_permalink( get_page_by_path( 'business' )->ID ) ); ?>">事業内容</a><!-- /.p-footer-item__link -->
        </li>
        <li class="p-footer__item p-footer-item p-footer-item--works">
          <a class="p-footer-item__link" href="<?php echo esc_url( get_post_type_archive_link('products') ); ?>">制作実績</a><!-- /.p-footer-item__link -->
        </li>
        <li class="p-footer__item p-footer-item">
          <a class="p-footer-item__link" href="<?php echo esc_url( get_permalink( get_page_by_path( 'profile' )->ID ) ); ?>">企業概要</a><!-- /.p-footer-item__link -->
        </li>
        <li class="p-footer__item p-footer-item p-footer-item--blog">
          <a class="p-footer-item__link" href="<?php echo esc_url( home_url('/blogs') ); ?>">
            <?php if( is_mobile() ) : ?>
            ブログ
            <?php else : ?>
            自社メディア
            <?php endif; ?>
          </a>
        </li>
        <li class="p-footer__item p-footer-item">
          <a class="p-footer-item__link" href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' )->ID ) ); ?>">お問い合わせ</a><!-- /.p-footer-item__link -->
        </li>
      </ul>
    </div>
  </div>
  <div class="p-footer__copyright">
    <p class="c-footer-copyright"> © 2021 CodeUps Inc.</p><!-- /.c-footer-copyright -->
  </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>
