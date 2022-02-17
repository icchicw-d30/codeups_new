<?php
/*
Template Name: 企業概要ページ
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


  <section class="l-sub-profile p-sub-profile">

  <!-- パンくず -->
  <div class="p-breadcrumb p-breadcrumb<?php get_template_part('template_parts/_page-identification'); ?>">
    <div class="p-breadcrumb__inner l-inner">
      <?php bcn_display(); //BreadcrumbNavXTのパンくずを表示するための記述 ?>
    </div>
  </div>

  <div class="p-sub-profile__inner l-inner">

    <!-- 概要 -->
    <div class="p-sub-profile__overview">
      <dl class="p-sub-profile__overview-items">
        <?php
        $profile_overview_group = SCF::get('profile_overview_group');
        foreach( $profile_overview_group as $field ) :
          if( $field['profile_overview_head'] && $field['profile_overview_body'] ) :
        ?>
        <div class="p-sub-profile__overview-item p-profile-overview-item">
          <dt class="p-profile-overview-item__head"><?php echo $field['profile_overview_head']; ?></dt>
          <dd class="p-profile-overview-item__body"><?php echo nl2br( $field['profile_overview_body'] ); ?></dd>
        </div>
        <?php endif; endforeach; ?>
      </dl>
    </div>

    <!-- google map -->
    <div class="p-sub-profile__map">
      <!-- googlemapのURL -->
      <?php
      $mapUrl = SCF::get('map_url'); // 入力されたマップURLを取得
      //対象の文字列
      $target_text = $mapUrl;
      //区切り文字（開始）
      $delimiter_start = '<iframe src="';
      //区切り文字（終了）
      $delimiter_end = '" ';
      //開始位置
      $start_position = strpos($target_text, $delimiter_start) + strlen($delimiter_start);
      //切り出す部分の長さ
      $length = strpos($target_text, $delimiter_end) - $start_position;
      //切り出し
      $checkUrl = substr($target_text, $start_position, $length );
      
      // スマホとPCの場合を分けて記述
      $ua = $_SERVER['HTTP_USER_AGENT'];
      $browser = ((strpos($ua,'iPhone')!==false)||(strpos($ua,'iPod')!==false)||(strpos($ua,'Android')!==false));
        if ($browser == true){
        $browser = 'sp';
      }
      if($browser == 'sp') {
        //スマホの場合
        $mapScale = SCF::get('map_scale');
        //URLかチェック
        if( filter_var($checkUrl, FILTER_VALIDATE_URL) ) { //URLならば
          if( $mapScale && is_numeric($mapScale) ) { // マップ縮尺が入力されているかつ数値の場合
            $mapScale = '4f' . $mapScale; //4f**の形に直す
            $mapUrl = str_replace('4f13.1', $mapScale, $mapUrl); // 4f13.1を4f**に変更する
          }
          echo $mapUrl; // URL出力
        }
      } else { //スマホ以外
        $mapScalePC = SCF::get('map_scale_pc');
        //URLかチェック
        if( filter_var($checkUrl, FILTER_VALIDATE_URL) ) { //URLならば
          if( $mapScale && is_numeric($mapScale) ) { // マップ縮尺が入力されているかつ数値の場合
            $mapScale = '4f' . $mapScale; //4f**の形に直す
            $mapUrl = str_replace('4f13.1', $mapScale, $mapUrl); // 4f13.1を4f**に変更する
          }
          echo $mapUrl; // URL出力
        }
      }

      ?>
    </div>
  </section>

  <!-- お問い合わせセクション -->
  <?php get_template_part('template_parts/_p-contact'); ?>

</div>

<?php get_footer(); ?>