jQuery(function($) {
  /**
   * 
   * 
   * 管理画面カスタマイズ用js
   * 
   * 
   */ 


  ///////////////////////////////////////////////////
  //
  // 事業内容 管理画面SCF繰り返しフィールドの上にテキスト要素を追加
  //
  //////////////////////////////////////////////////
  /* 事業内容 管理画面SCF繰り返しフィールドの上に要素を追加 */
  $('#smart-cf-custom-field-316 .smart-cf-meta-box .smart-cf-meta-box-repeat-tables').prepend('<p class="c-scf-attention">事業内容コンテンツ 3つまで作成可能です。</p>');
  /* 制作実績 管理画面SCF繰り返しフィールドの上に要素を追加 */
  $('#smart-cf-custom-field-121 .smart-cf-meta-box .smart-cf-meta-box-repeat-tables').prepend('<p class="c-scf-attention"><span>制作実績スライダー画像</span> <span>8つまで設定可能です。</span></p>');




  ///////////////////////////////////
  //
  // 【SCFオプションページ】 MVスライダー画面
  //
  //////////////////////////////////

  /* 左側にあるサブタイトルの位置を変更 **全ページに適用する場合は.toplevel_page_mv_sliderを外す** */
  // 左側にあるサブタイトルのthにクラス付与
  $('.toplevel_page_mv_slider .form-table').find('th').eq(0).addClass('toplevel_page_mv_slider__subtitle');
  // pタグに置き換え
  $('.toplevel_page_mv_slider .toplevel_page_mv_slider__subtitle').replaceWith(function() {
    $(this).replaceWith('<p class="toplevel_page_mv_slider__subtitle">' + $(this).text() + '</p>');
  });
  // .form-tableの前に移動
  $('.toplevel_page_mv_slider .toplevel_page_mv_slider__subtitle').insertBefore('.form-table');


  /* SP/PC画像のフレックス化 */
  // SP画像を囲んでるtableタグにクラス付与
  $('.toplevel_page_mv_slider .smart-cf-meta-box-table table:nth-of-type(1)').addClass('mv-img-wrap-sp');
  
  // PC画像を囲んでるtableタグにクラス付与
  $('.toplevel_page_mv_slider .smart-cf-meta-box-table table:nth-of-type(2)').addClass('mv-img-wrap-pc');
  
  // クラス.mv-img-wrap-spを付与したtableをwrapperで囲む
  $('.smart-cf-meta-box-table').each(function() {
    $(this).children('.mv-img-wrap-sp').wrapAll('<div class="smart-cf-field-type-image__wrapper">');
  });

  // wrapperで囲んだtableに順番にクラス'--i'を付与する
  $('.smart-cf-meta-box-table .smart-cf-field-type-image__wrapper').each(function(i) {
    $(this).attr('class', 'smart-cf-field-type-image__wrapper --' + i );
  });

  // クラス.mv-img-wrap-spを付与したtable
  $('.mv-img-wrap-sp').each(function(i) {
    // 順番にクラス'--i'を付与する
    $(this).attr('class', 'mv-img-wrap-sp --' + i );
    // この中にあるthにクラス付与
    $(this).find('th').attr('class', 'mv-img-wrap-sp__title --' + i );
  });

  // クラス.mv-img-wrap-pcを付与したtable
  $('.mv-img-wrap-pc').each(function(i) {
    // 順番にクラス'--i'を付与する
    $(this).attr('class', 'mv-img-wrap-pc --' + i );
    // この中にあるthにクラス付与
    $(this).find('th').attr('class', 'mv-img-wrap-pc__title --' + i );
  });
  
  // クラス.mv-img-wrap-pcを付与したtableを、同じクラス'--i'のクラス.mv-img-wrap-spを付与したtableの後ろに移動させる
  $('.mv-img-wrap-pc').each(function(i) {
    $(this).insertAfter('.mv-img-wrap-sp.--' + i );
  });
  
  // クラス.mv-img-wrap-pc__titleのそれぞれに
  $('.mv-img-wrap-pc__title').each(function(i) {
    // table.mv-img-wrap-pc.--i の一番上の子要素の位置に移動させる
    $('.mv-img-wrap-pc__title.--' + i).prependTo('.mv-img-wrap-pc.--' + i );
  });
  
  // クラス.mv-img-wrap-pc__titleが付いたthタグの変更
  $('.mv-img-wrap-pc__title').replaceWith(function() {
    $(this).replaceWith('<p class="mv-img-wrap-pc__title">' + $(this).text() + '</p>');
  });
  
  // クラス.mv-img-wrap-sp__titleのそれぞれに
  $('.mv-img-wrap-sp__title').each(function(i) {
    // table.mv-img-wrap-sp.--i の一番上の子要素の位置に移動させる
    $('.mv-img-wrap-sp__title.--' + i).prependTo('.mv-img-wrap-sp.--' + i );
  });
  
  // クラス.mv-img-wrap-sp__titleが付いたthタグの変更
  $('.mv-img-wrap-sp__title').replaceWith(function() {
    $(this).replaceWith('<p class="mv-img-wrap-sp__title">' + $(this).text() + '</p>');
  });





  // $('.toplevel_page_mv_slider .smart-cf-meta-box-table table:nth-of-type(1)').before('<div class="smart-cf-field-type-image__wrapper"></div>');
  // $('.toplevel_page_mv_slider .smart-cf-meta-box-table table:nth-of-type(2)').prependTo('.smart-cf-field-type-image__wrapper');
  // $('.toplevel_page_mv_slider .smart-cf-meta-box-table table:nth-of-type(1)').prependTo('.smart-cf-field-type-image__wrapper');
  // $('.toplevel_page_mv_slider .smart-cf-meta-box-table table:nth-of-type(1)').wrapAll('<div class="smart-cf-field-type-image__wrapper__wrapper">');

});