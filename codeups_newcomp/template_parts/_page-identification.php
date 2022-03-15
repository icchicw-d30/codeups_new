<?php
  //アーカイブページ
  if( is_archive() ) { // デフォルト投稿「ブログ」アーカイブページ
    // echo '--blogs';
  }
  if( is_post_type_archive('news') ){ // 「お知らせ」アーカイブページ
    echo '--news';
  }
  if( is_singular('news') ){ // 「お知らせ」カスタム投稿シングルページ
    echo '--news';
  }
  if( is_tax('news_category') ){ // 「お知らせ」タクソノミーページ
    echo '--news';
  }

  if( is_post_type_archive('products') ){ // 「制作実績」アーカイブページ
    echo '--products';
  }
  if( is_tax('products_category') ){ // 「制作実績」タクソノミーページ
    echo '--products';
  }
  if( is_singular('products') ){ // 「制作実績」カスタム投稿シングルページ
    echo '--products';
  }

  if( is_page('business') ){ // 「事業内容」固定ページ
    echo '--business';
  }

  if( is_page('profile') ){ // 「企業概要」固定ページ 
    echo '--profile';
  }
  
  if( is_page('contact') ){ // 「お問い合わせ」固定ページ
    echo '--contact';
  }
?>