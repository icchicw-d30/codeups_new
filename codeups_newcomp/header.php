<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- noindex -->
  <meta name=“robots” content=“noindex”>
  <!-- ファビコン -->
  <link rel="shortcut icon" href="<?php echo get_template_directory_uri() ?>/assets/img/common/favicon.ico" />
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@400;500;600;700;900&display=swap" rel="stylesheet">
  <!-- swiper -->
  <!-- <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/> -->
  <!-- <script defer src="https://unpkg.com/swiper/swiper-bundle.min.js"> -->
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <header class="l-header p-header js-header">
    <div class="p-header__inner l-inner">
      <div class="p-header__logo">
        <a href="<?php echo esc_url(home_url('/')); ?>">
          <img class="c-logo" src="<?php echo get_template_directory_uri() ?>/assets/img/common/codeups.svg" alt="codeupsロゴ">
        </a>
      </div>
      <div class="p-header__drawer c-hamburger js-hamburger">
        <span></span>
        <span></span>
        <span></span>
      </div>
      <div class="p-header__menu p-drawer-menu js-drawer-menu">
        <ul class="p-drawer-menu__items">
          <li class="p-drawer-menu__item">
            <a href="<?php echo esc_url( home_url('/') ); ?>">トップ</a>
          </li>
          <li class="p-drawer-menu__item">
            <a href="<?php echo esc_url( get_post_type_archive_link('news') ); ?>">お知らせ</a>
          </li>
          <li class="p-drawer-menu__item">
            <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'business' )->ID ) ); ?>">事業内容</a>
          </li>
          <li class="p-drawer-menu__item">
            <a href="<?php echo esc_url( get_post_type_archive_link('products') ); ?>">制作実績</a>
          </li>
          <li class="p-drawer-menu__item">
            <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'profile' )->ID ) ); ?>">企業概要</a>
          </li>
          <li class="p-drawer-menu__item">
            <a href="<?php echo esc_url( home_url('/blogs') ); ?>">ブログ</a>
          </li>
          <li class="p-drawer-menu__item">
            <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' )->ID ) ); ?>"><span>お問い合わせ</span></a>
          </li>
        </ul>
      </div>
    </div>
  </header>
  