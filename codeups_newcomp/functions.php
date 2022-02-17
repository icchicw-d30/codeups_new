<?php
/**
 * Functions
 */

/**
 * WordPress標準機能
 *
 * @codex https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/add_theme_support
 */
function my_setup() {
	add_theme_support( 'post-thumbnails' ); /* アイキャッチ */
	add_theme_support( 'automatic-feed-links' ); /* RSSフィード */
	add_theme_support( 'title-tag' ); /* タイトルタグ自動生成 */
	add_theme_support(
		'html5',
		array( /* HTML5のタグで出力 */
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);
}
add_action( 'after_setup_theme', 'my_setup' );



/**
 * CSSとJavaScriptの読み込み
 *
 * @codex https://wpdocs.osdn.jp/%E3%83%8A%E3%83%93%E3%82%B2%E3%83%BC%E3%82%B7%E3%83%A7%E3%83%B3%E3%83%A1%E3%83%8B%E3%83%A5%E3%83%BC
 */
function my_script_init()
{

	wp_enqueue_style( 'myswipercss', 'https://unpkg.com/swiper@7/swiper-bundle.min.css', array(), '7.0.5', 'all' );
	wp_enqueue_script( 'swiper', 'https://unpkg.com/swiper/swiper-bundle.min.js', array( 'jquery' ), '7.0.5', true );
	// キャッシュ対策
	// $theme_ver = date('YmdHi');
	$theme_ver = wp_get_theme()->get('Version');
	wp_enqueue_style( 'mystyle', get_template_directory_uri() . '/assets/css/style.css', array(), $theme_ver, false );
	// wp_enqueue_style( 'mystyle', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0.1', 'all' );
	wp_enqueue_script( 'myjs', get_template_directory_uri() . '/assets/js/script.js', array( 'jquery' ), '1.0.1', true );
}
add_action('wp_enqueue_scripts', 'my_script_init');


/**
 * 
 * 
 * 管理画面にのみ任意のファイルを適用
 *
 * @codex 
 */
function enqueue_admin_style_script() {
	// css
	wp_enqueue_style( 'my_admin_css', get_template_directory_uri() . '/assets/css/my-admin-style.css' );
	// wp_enqueue_style( 'my_admin_css', get_template_directory_uri() . '/assets/css/style.css' );
	// js
	wp_enqueue_script( 'admin-script', get_template_directory_uri() . '/assets/js/myadmin.js', array('jquery'), '1.0.1', true );
}
add_action('admin_enqueue_scripts', 'enqueue_admin_style_script');


/**
 * メニューの登録
 *
 * @codex https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/register_nav_menus
 */
// function my_menu_init() {
// 	register_nav_menus(
// 		array(
// 			'global'  => 'ヘッダーメニュー',
// 			'utility' => 'ユーティリティメニュー',
// 			'drawer'  => 'ドロワーメニュー',
// 		)
// 	);
// }
// add_action( 'init', 'my_menu_init' );
/**
 * メニューの登録
 *
 * 参考：https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/register_nav_menus
 */


/**
 * ウィジェットの登録
 *
 * @codex http://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/register_sidebar
 */
// function my_widget_init() {
// 	register_sidebar(
// 		array(
// 			'name'          => 'サイドバー',
// 			'id'            => 'sidebar',
// 			'before_widget' => '<div id="%1$s" class="p-widget %2$s">',
// 			'after_widget'  => '</div>',
// 			'before_title'  => '<div class="p-widget__title">',
// 			'after_title'   => '</div>',
// 		)
// 	);
// }
// add_action( 'widgets_init', 'my_widget_init' );


/*
function custom_menu_page(){
	add_menu_page('共通設定画面', '', 'manage_options', 'custom_menu_page', 'add_custom_menu_page', '', 4);
}
function add_custom_menu_page(){
	?>
	<div class="wrap">
		<h2>共通設定画面</h2>
	</div>
	<?php
}
add_action('admin_menu', 'custom_menu_page');
*/
/* 管理画面にメニューを追加 */
// function add_my_menu() {
// 	add_menu_page( 'page_title', 'menu_title', 'administrator', __FILE__, 'function_name', '', 8);
// }
// add_action('admin_menu', 'add_my_menu');

/* 管理画面にセパレータ追加 */
function add_admin_menu_separator3()
{
	add_menu_page( '', '', 'read', 'wp-menu-separator3', '', '', '21' );
	add_submenu_page( 'edit.php?post_type=page', 'wp-menu-separator3', '', 'read', '11', '' );
}
add_action( 'admin_menu', 'add_admin_menu_separator3' );

// function add_admin_menu_separator4()
// {
// 	add_menu_page( '', '', 'read', 'wp-menu-separator4', '', '', '21' );
// 	add_submenu_page( 'edit.php?post_type=page', 'wp-menu-separator4', '', 'read', '11', '' );
// }
// add_action( 'admin_menu', 'add_admin_menu_separator4' );


/**
 * 
 * 
 * 管理画面のメニュー順番並び替え
 *
 * @codex https://wp-doctor.jp/blog/2020/05/14/%E3%83%AF%E3%83%BC%E3%83%89%E3%83%97%E3%83%AC%E3%82%B9%E3%81%AE%E7%AE%A1%E7%90%86%E7%94%BB%E9%9D%A2%E3%81%AE%E3%83%A1%E3%83%8B%E3%83%A5%E3%83%BC%E3%81%AE%E9%A0%86%E7%95%AA%E3%82%92%E5%85%A5%E3%82%8C/
 * 
 */
function my_custom_menu_order($menu_order) {
	if (!$menu_order) return true;
	return array(
		'index.php', //ダッシュボード
		'separator1', //セパレータ１
		'edit.php', //投稿
		'edit.php?post_type=products', //カスタムポスト
		'edit.php?post_type=news', //カスタムポスト
		'mv_slider', //MVスライダー
		'top_products', //トップ制作実績
		'edit.php?post_type=page', //固定ページ
		'flamingo', //flamingo
		'separator2', //セパレータ2
		'wpcf7', //Contact Form 7
		'themes.php', //外観
		'plugins.php', //プラグイン
		'users.php', //ユーザー
		'separator4', //セパレータ4
		'tools.php', //ツール
		'options-general.php', //設定
		'wp-menu-separator3', //セパレータ3
		'cptui_main_menu', // CPT UI
		// 'wp-menu-separator4', //セパレータ4
		'edit.php?post_type=smart-custom-fields', //SCF
		'edit.php?post_type=acf-field-group', //ACF
		'separator-last', //最後のセパレータ
		'edit-comments.php', //コメント
		'upload.php', //メディア (一番下に移動しました)
	);
}
add_filter('custom_menu_order', 'my_custom_menu_order'); 
add_filter('menu_order', 'my_custom_menu_order');



/**
 * 
 * 
 * 管理画面のメニュー表示削除
 *
 * @codex https://wp-doctor.jp/blog/2020/05/14/%E3%83%AF%E3%83%BC%E3%83%89%E3%83%97%E3%83%AC%E3%82%B9%E3%81%AE%E7%AE%A1%E7%90%86%E7%94%BB%E9%9D%A2%E3%81%AE%E3%83%A1%E3%83%8B%E3%83%A5%E3%83%BC%E3%81%AE%E9%A0%86%E7%95%AA%E3%82%92%E5%85%A5%E3%82%8C/
 * 
 */
function my_remove_menu_pages() {
	// remove_menu_page('edit.php'); // 投稿
	remove_menu_page('upload.php'); // メディア
	remove_menu_page('link-manager.php'); // リンク
	remove_menu_page('edit-comments.php'); // コメント
	// remove_menu_page('edit.php?post_type=page'); // 固定ページ
	remove_menu_page('plugins.php'); // プラグイン
	remove_menu_page('themes.php'); // 外観
	remove_menu_page('users.php'); // ユーザー
	remove_menu_page('tools.php'); // ツール
	remove_menu_page('options-general.php'); // 設定
	remove_menu_page('cptui_main_menu'); // CPT UI
	remove_menu_page('edit.php?post_type=smart-custom-fields'); // SCF
	remove_menu_page('edit.php?post_type=acf-field-group'); // ACF
}
if(  !current_user_can( 'administrator' ) ) { // 管理者以外
	add_action( 'admin_init', 'my_remove_menu_pages' );
	//管理者	administrator	WordPressの全ての機能が使える
	//編集者	editor	コンテンツに関する全ての機能が使える
	//投稿者	author	記事の投稿や編集、公開など最低限の機能が使える
	//寄稿者	contributor	記事の下書きや編集など一部の機能が使える
	//購読者	subscriber	閲覧のみ、編集機能は一切使えない
}


/**
 * head内にページタイトル出力
 *
 * 参考：https://www.webdesignleaves.com/pr/wp/wp_func_title_tag.html
 * 
 */
function setup_my_theme() {
	add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'setup_my_theme');

/**
 * ページタイトルセパレータの変更
 *
 * 参考：https://www.webdesignleaves.com/pr/wp/wp_func_title_tag.html
 * 
 */
function change_title_separator( $sep ){
  $sep = ' | ';
  return $sep;
}
add_filter( 'document_title_separator', 'change_title_separator' );


/**
 * アーカイブタイトル書き換え
 *
 * @param string $title 書き換え前のタイトル.
 * @return string $title 書き換え後のタイトル.
 */
function my_archive_title( $title ) {

	if ( is_home() ) { /* ホームの場合 */
		$title = 'ブログ';
	} elseif ( is_category() ) { /* カテゴリーアーカイブの場合 */
		$title = '' . single_cat_title( '', false ) . '';
	} elseif ( is_tag() ) { /* タグアーカイブの場合 */
		$title = '' . single_tag_title( '', false ) . '';
	} elseif ( is_post_type_archive() ) { /* 投稿タイプのアーカイブの場合 */
		$title = '' . post_type_archive_title( '', false ) . '';
	} elseif ( is_tax() ) { /* タームアーカイブの場合 */
		$title = '' . single_term_title( '', false );
	} elseif ( is_search() ) { /* 検索結果アーカイブの場合 */
		$title = '「' . esc_html( get_query_var( 's' ) ) . '」の検索結果';
	} elseif ( is_author() ) { /* 作者アーカイブの場合 */
		$title = '' . get_the_author() . '';
	} elseif ( is_date() ) { /* 日付アーカイブの場合 */
		$title = '';
		if ( get_query_var( 'year' ) ) {
			$title .= get_query_var( 'year' ) . '年';
		}
		if ( get_query_var( 'monthnum' ) ) {
			$title .= get_query_var( 'monthnum' ) . '月';
		}
		if ( get_query_var( 'day' ) ) {
			$title .= get_query_var( 'day' ) . '日';
		}
	}
	return $title;
};
add_filter( 'get_the_archive_title', 'my_archive_title' );


/**
 * 抜粋文の文字数の変更
 *
 * @param int $length 変更前の文字数.
 * @return int $length 変更後の文字数.
 */
function my_excerpt_length( $length ) {
	return 49;
}
add_filter( 'excerpt_length', 'my_excerpt_length', 999 );


/**
 * 抜粋文の省略記法の変更
 *
 * @param string $more 変更前の省略記法.
 * @return string $more 変更後の省略記法.
 */
function my_excerpt_more( $more ) {
	return '...';

}
add_filter( 'excerpt_more', 'my_excerpt_more' );

/*
 * is_mobile() スマホとタブレットを判別
 * 
 * if( is_mobile() ) { // スマホ } else { // タブレット or PC }
 * 
 */
function is_mobile() {
	$useragents = array(
			'iPhone',          // iPhone
			'iPod',            // iPod touch
			'^(?=.*Android)(?=.*Mobile)', // 1.5+ Android
			'dream',           // Pre 1.5 Android
			'CUPCAKE',         // 1.5+ Android
			'blackberry9500',  // Storm
			'blackberry9530',  // Storm
			'blackberry9520',  // Storm v2
			'blackberry9550',  // Storm v2
			'blackberry9800',  // Torch
			'webOS',           // Palm Pre Experimental
			'incognito',       // Other iPhone browser
			'webmate'          // Other iPhone browser
	);
	$pattern = '/'.implode('|', $useragents).'/i';
	return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}




/* 投稿アーカイブページの作成 */
// function post_has_archive( $args, $post_type ) {
// 	if ( 'post' == $post_type ) {
// 		// $args['rewrite'] = true;
// 		$args['has_archive'] = 'blogs'; //任意のスラッグ名
// 	}
// 	return $args;
// }
// add_filter( 'register_post_type_args', 'post_has_archive', 10, 2 );


// 投稿のアーカイブページを作成する
add_filter('register_post_type_args', function($args, $post_type) {
	if ('post' == $post_type) {
			global $wp_rewrite;
			$archive_slug = 'blogs'; //URLスラッグ
			$args['label'] = 'ブログ記事'; //管理画面左ナビに「投稿」の代わりに表示される
			$args['has_archive'] = $archive_slug;
			$archive_slug = $wp_rewrite->root.$archive_slug;
			$feeds = '(' . trim( implode('|', $wp_rewrite->feeds) ) . ')';

			// // 以下リライトルールの変更 // //
			// $custom_post_type01 = 'products'; // カスタム投稿タイプ名
			// $custom_post_taxonomy01 = 'products_category'; // タクソノミー名
			// //カスタム投稿のアーカイブページ1ページ目
			// add_rewrite_rule("{$custom_post_type01}/([0-9]+)/?$", "index.php?post_type={$custom_post_type01}&p=$matches[1]", 'top');
			// //カスタム投稿のアーカイブページ2ページ目以降
			// add_rewrite_rule("{$custom_post_type01}/page/([0-9]{1,})/?$", "index.php?post_type={$custom_post_type01}&paged=$matches[1]", 'top');
			
			// //カスタム投稿のタクソノミーページ2ページ目以降
			// add_rewrite_rule("products/(.+?)/page/?([0-9]{1,})/?$", "index.php?{$custom_post_taxonomy01}".'=$matches[1]&paged=$matches[2]', 'top');
			// // add_rewrite_rule("{$custom_post_taxonomy01}/(.+?)/page/?([0-9]{1,})/?$", "index.php?{$custom_post_taxonomy01}".'=$matches[1]&paged=$matches[2]', 'top');
			// //カスタム投稿のタクソノミーページ1ページ目
			// add_rewrite_rule("products/(.+?)/?$", "index.php?post_type={$custom_post_type01}".'&p=$matches[1]', 'top');
			// // add_rewrite_rule("{$custom_post_taxonomy01}/(.+?)/?$", "index.php?post_type={$custom_post_type01}".'&p=$matches[1]', 'top');
			
			//アーカイブページ1ページ目
			add_rewrite_rule("{$archive_slug}/?$", "index.php?post_type={$post_type}", 'top');
			//アーカイブページ2ページ目以降
			add_rewrite_rule("{$archive_slug}/page/([0-9]{1,})/?$", "index.php?post_type={$post_type}&paged=$matches[1]", 'top');
			//カテゴリーページ1ページ目
			// add_rewrite_rule("category/(.+?)/?$", 'index.php?category_name=$matches[1]', 'top');
			//カテゴリーページ2ページ目以降
			add_rewrite_rule("blogs/(.+?)/page/?([0-9]{1,})/?$", 'index.php?category_name=$matches[1]&paged=$matches[2]', 'top');
			// add_rewrite_rule("(.+?)/page/?([0-9]{1,})/?$", 'index.php?category_name=$matches[1]&paged=$matches[2]', 'top');
			// add_rewrite_rule("category/(.+?)/page/?([0-9]{1,})/?$", 'index.php?category_name=$matches[1]&paged=$matches[2]', 'top');

			add_rewrite_rule("{$archive_slug}/feed/{$feeds}/?$", "index.php?post_type={$post_type}".'&feed=$matches[1]', 'top');
			add_rewrite_rule("{$archive_slug}/{$feeds}/?$", "index.php?post_type={$post_type}".'&feed=$matches[1]', 'top');
			add_rewrite_rule("{$archive_slug}/{$wp_rewrite->pagination_base}/([0-9]{1,})/?$", "index.php?post_type={$post_type}".'&paged=$matches[1]', 'top');
	}
	return $args;
}, 10, 2);

/** 
 * 
 * 
 * パーマリンク 一部テキスト削除と置き換え
 * 
 *
 */
/* カテゴリーURLから/category/を削除（サブカテゴリーは404エラーになるので注意） */
add_filter('user_trailingslashit', 'remcat_function');
function remcat_function($link) {
	return str_replace("/category/", "/blogs/", $link);
	// return str_replace("/category/", "/", $link);
}

/* カテゴリーURLから/products_category/を削除（サブカテゴリーは404エラーになるので注意） */
// add_filter('user_trailingslashit', 'remcat_function2');
// function remcat_function2($link) {
// 	return str_replace("/products_category/", "/products/", $link);
// }


/**
* 
* カスタム投稿タイプのパーマリンク変更（数字ベース）
* 
* 参考：https://www.clarenet.co.jp/column/coding/%E3%82%AB%E3%82%B9%E3%82%BF%E3%83%A0%E6%8A%95%E7%A8%BF%E3%82%BF%E3%82%A4%E3%83%97%E3%81%AE%E3%83%91%E3%83%BC%E3%83%9E%E3%83%AA%E3%83%B3%E3%82%AF%E3%82%92%E6%95%B0%E5%AD%97%E3%83%99%E3%83%BC%E3%82%B9/
* https://www.web-myoko.net/blog/wordpress/how-to-change-permalink-type-custom-post-type/
*/
function my_post_type_link( $link, $post ){
	$custom_post_name01 = 'products'; // カスタム投稿タイプ名
	if ( $custom_post_name01 === $post->post_type ) { // カスタム投稿タイプ名
		return home_url( '/' . $custom_post_name01 . '/' . $post->ID );
	} else {
		return $link;
	}
	$custom_post_name02 = 'news'; // カスタム投稿タイプ名
	if ( $custom_post_name02 === $post->post_type ) { // カスタム投稿タイプ名
		return home_url( '/' . $custom_post_name02 . '/' . $post->ID );
	} else {
		return $link;
	}
}
add_filter( 'post_type_link', 'my_post_type_link', 1, 2 );

function my_rewrite_rules_array01( $rules ) {
	$custom_post_name01 = 'products'; // カスタム投稿タイプ名
	$new_rules = array( 
		$custom_post_name01 . '/([0-9]+)/?$' => 'index.php?post_type=' . $custom_post_name01 . '&p=$matches[1]',
	);
	return $new_rules + $rules;
}
add_filter( 'rewrite_rules_array', 'my_rewrite_rules_array01' );

function my_rewrite_rules_array02( $rules ) {
	$custom_post_name02 = 'news'; // カスタム投稿タイプ名
	$new_rules = array( 
		$custom_post_name02 . '/([0-9]+)/?$' => 'index.php?post_type=' . $custom_post_name02 . '&p=$matches[1]',
	);
	return $new_rules + $rules;
}
add_filter( 'rewrite_rules_array', 'my_rewrite_rules_array02' );



// function myUrlRewrite($myrules){
// 	// $myCategoryRule = array();
// 	// $myCategoryRule['(.+?)/page/?([0-9]{1,})/?$'] = 'index.php?category_name=$matches[1]&paged=$matches[2]';
// 	$myRule = array();
// 	$myRule['products_category/([^/]+)/?$'] = 'index.php?products_category=$matches[1]';
// 	// $myRule2 = array();
// 	// $myRule2['products/([^/]+)/page/?([0-9]{1,})/?$'] = 'index.php?products_category=$matches[1]&paged=$matches[2]';

// 	return array_merge( $myRule, $myrules );
// }
// add_action('rewrite_rules_array', 'myUrlRewrite' );


/* デフォルト投稿ページのパンくずリストの階層の途中に新しい階層を追加 */
function bcn_add($bcnObj) {
	// デフォルト投稿の詳細ページかどうか
	if (is_singular('post')) {
		// 新規のtrailオブジェクトを末尾に追加する
		$bcnObj->add(new bcn_breadcrumb('ブログ記事一覧', null, array('post-clumn-archive'), home_url('/blogs'), null, true));
		$trail_tmp = clone $bcnObj->trail[1]; // [1]階層になったトップを変数に格納
		$bcnObj->trail[1] = clone $bcnObj->trail[2]; // 追加したブログ記事一覧を[1]階層に代入
		$bcnObj->trail[2] = $trail_tmp; // トップを一番上の[2]階層に代入
	}
	return $bcnObj;
}
add_action('bcn_after_fill', 'bcn_add');

/* デフォルト投稿アーカイブページのパンくずリストの階層に新しい階層を追加 */
function bcn_add02($bcnObj02) {
	// デフォルト投稿のアーカイブページかどうか
	if ( is_post_type_archive('post') ) {
		// 新規のtrailオブジェクトを末尾に追加する
		$bcnObj02->add(new bcn_breadcrumb('ブログ記事一覧', null, array('archive', 'post-clumn-archive', 'current-item') ) );
		$trail_tmp = clone $bcnObj02->trail[0]; // [0]階層になったトップを変数に格納
		$bcnObj02->trail[0] = clone $bcnObj02->trail[1]; // 追加したブログ記事一覧を[0]階層に代入
		$bcnObj02->trail[1] = $trail_tmp; // トップを一番上の[1]階層に代入
	}
	return $bcnObj02;
}
add_action('bcn_after_fill', 'bcn_add02');

/* デフォルト投稿カテゴリーページのパンくずリストの階層に新しい階層を追加 */
function bcn_add03($bcnObj03) {
	// デフォルト投稿のカテゴリーページかどうか
	if ( is_category() ) {
		// 新規のtrailオブジェクトを末尾に追加する
		$bcnObj03->add(new bcn_breadcrumb('ブログ記事一覧', null, array('post-clumn-archive'), home_url('/blogs'), null, true ) );
		$trail_tmp = clone $bcnObj03->trail[1]; // [1]階層になったトップを変数に格納
		$bcnObj03->trail[1] = clone $bcnObj03->trail[2]; // 追加したブログ記事一覧を[1]階層に代入
		$bcnObj03->trail[2] = $trail_tmp; // トップを一番上の[2]階層に代入
	}
	return $bcnObj03;
}
add_action('bcn_after_fill', 'bcn_add03');



/* トップページのブログ記事表示件数を定義 */
// function top_page_posts( $topPagePostsQuery ) {
// 	// トップページかつメインクエリの場合
// 	if( $topPagePostsQuery->is_home() && is_mobile() && $topPagePostsQuery->is_main_query() ) {
// 		$topPagePostsQuery->set( 'post_type', 'post' );
// 		$topPagePostsQuery->set( 'posts_per_page', '6' );
// 	}
// 	if( $topPagePostsQuery->is_home() && !is_mobile() && $topPagePostsQuery->is_main_query() ) {
// 		$topPagePostsQuery->set( 'post_type', 'post' );
// 		$topPagePostsQuery->set( 'posts_per_page', '3' );
// 	}
// }
// add_action('pre_get_posts', 'top_page_posts');







/**
 * カスタム投稿の投稿数設定
 *
 * @codex https://meshikui.com/2019/02/25/1537/
 * https://irec.jp/wordpress/custom-list-functions/
 * 
 */
	// add_filter( 'parse_query', 'custom_per_page' );
	// function custom_per_page( $query ) {
	// 	if ( is_admin() || is_singular() || !is_main_query() ) { // 管理画面とsingleとメインループじゃない部分は除く
	// 		return false;
	// 	}
	// 	if ( get_query_var( 'post_type' ) == 'products' ) { // カスタム投稿「products」
	// 			$query->set( 'posts_per_page', '6' );
	// 	}
	// }




/**
 * 各投稿ページ表示件数制御
 *
 * @codex https://meshikui.com/2019/02/25/1537/
 * https://irec.jp/wordpress/custom-list-functions/
 * 
 */
function change_posts_per_page($query) {
	if ( !is_admin() && $query->is_main_query()) {	// 管理画面,メインクエリに干渉しないために必須
	  if ( is_post_type_archive('products') ) { 	//productsアーカイブページを指定
	    $query->set( 'posts_per_page', '6' ); 	//表示件数を指定
		}
	  else if ( is_tax('products_category') ) { //カスタムタクソノミー「products_category」を指定
	    $query->set( 'posts_per_page', '6' ); 	//表示件数を指定
		}
	  else if ( is_post_type_archive('news') ) { //newsアーカイブページを指定
	    $query->set( 'posts_per_page', '10' ); 	//表示件数を指定
		}
	  else if ( is_category() ) { //デフォルトカテゴリーページを指定(newsアーカイブを除く)
	    // $query->set( 'posts_per_page', '9' ); 	//表示件数を指定
		}
		else if ( is_front_page('post') ) { //フロントページを指定(newsアーカイブを除く)
	    // $query->set( 'posts_per_page', '4' ); 	//表示件数を指定
		}
	}
  return $query;
}
add_action( 'pre_get_posts', 'change_posts_per_page' );





//TOP - メインビジュアルスライダー設定
/**
 * @param string $page_title ページのtitle属性値 (必須)
 * @param string $menu_title 管理画面のメニューに表示するタイトル (必須)
 * @param string $capability メニューを操作できる権限 (必須)
 * @param string $menu_slug オプションページのスラッグ (必須)
 * @param string|null $icon_url メニューに表示するアイコンの URL
 * @param int $position メニューの位置
 */
SCF::add_options_page( 'MVスライダー', 'MVスライダー', 'edit_posts', 'mv_slider' , 'dashicons-admin-generic' , 11);
/**
 * カスタムフィールドを定義
 * 
 * @param array  $settings  MW_WP_Form_Setting オブジェクトの配列
 * @param string $type      投稿タイプ or ロール
 * @param int    $id        投稿ID or ユーザーID
 * @param string $meta_type post | user
 * @return array
 * 
 */
function my_add_meta_box($settings, $type, $id, $meta_type)
{
  if ('mv_slider' == $type) {
    $setting = SCF::add_setting('id-mv_slider', 'MVスライダー設定');
    $items = array(
			array(
				'type'        => 'image', //*タイプ
				'name'        => 'mv_slider_img_sp', //*名前
				'label'       => '【SP】スライダー画像', //ラベル
				'size'        => 'medium' // プレビューサイズ
			),
      array(
        'type'        => 'image', //*タイプ
        'name'        => 'mv_slider_img_pc', //*名前
        'label'       => '【PC】スライダー画像', //ラベル
        'size'        => 'medium' // プレビューサイズ
      ),
      array(
        'type'        => 'textarea',                      // タイプ
        'name'        => 'mv_slider_title',                   // 名前
        'label'       => 'スライダータイトル設定',        // ラベル
        'rows'        => 1,                               // 行数
      ),
      array(
        'type'        => 'textarea',                      // タイプ
        'name'        => 'mv_slider_subtitle',                   // 名前
        'label'       => 'スライダーサブタイトル設定',        // ラベル
        'rows'        => 3,                               // 行数
      ),
			array(
				'type'        => 'text', //*タイプ
				'name'        => 'mv_slider_alt', //*名前
				'label'       => '画像alt設定', //ラベル
			),
      // array(
      //   'type'        => 'text', //*タイプ
      //   'name'        => 'mv_slider_link', //*名前
      //   'label'       => 'リンク設定', //ラベル
      // ),
    );
    $setting->add_group('mv_slider_group', true, $items);
    $settings[] = $setting;
  }
  return $settings;
}
add_filter('smart-cf-register-fields', 'my_add_meta_box', 10, 4);


//TOP - 制作実績表示設定
/**
 * @param string $page_title ページのtitle属性値 (必須)
 * @param string $menu_title 管理画面のメニューに表示するタイトル (必須)
 * @param string $capability メニューを操作できる権限 (必須)
 * @param string $menu_slug オプションページのスラッグ (必須)
 * @param string|null $icon_url メニューに表示するアイコンの URL
 * @param int $position メニューの位置
 */
SCF::add_options_page( 'トップ制作実績', 'トップ制作実績', 'edit_posts', 'top_products' , 'dashicons-admin-generic' , 11);
/**
 * カスタムフィールドを定義
 * 
 * @param array  $settings  MW_WP_Form_Setting オブジェクトの配列
 * @param string $type      投稿タイプ or ロール
 * @param int    $id        投稿ID or ユーザーID
 * @param string $meta_type post | user
 * @return array
 * 
 */
function my_add_meta_products($settings, $type, $id, $meta_type)
{
  if ('top_products' == $type) {
    $setting = SCF::add_setting('id-mv_slider', 'トップ制作実績設定');
    $items = array(
			array(
				'type'        => 'relation', //*タイプ
				'name'        => 'top_products_relation', //*名前
				'label'       => '関連する制作実績', //ラベル
				'post-type'   => array( 'products'), //投稿タイプ
				'limit'       => 1, // 選択できる個数
				'instruction' => '制作実績を1つ選んでください', //説明文
			),
      array(
        'type'        => 'textarea',                      // タイプ
        'name'        => 'top_products_subtitle',                   // 名前
        'label'       => '制作実績サブタイトル設定',        // ラベル
        'rows'        => 3,                               // 行数
      ),
    );
    $setting->add_group('top_products_group', true, $items);
    $settings[] = $setting;
  }
  return $settings;
}
add_filter('smart-cf-register-fields', 'my_add_meta_products', 10, 4);

/* the_excerpt()からpタグ削除 */
// remove_filter('the_excerpt', 'wpautop');



/**
 * 繰り返しフィールド管理画面に閉じるボタンを追加
 * ボタンクリック時のテキスト変更
 * ボタンクリックで画像縮小
 * ID指定で、そのページの管理画面にのみ適用可能
 *
 * 参考：https://www.e-f.co.jp/blog/29498/
 */
//-----------------------------------------------
// smart custom fieldを使いやすく
//-----------------------------------------------

function my_admin_style()
{
  echo "<style>
  /*-------
	共通
	-------*/
  .smart-cf-meta-box-table {
		position: relative;
  }
  
  /*--------
	個別縮小ボタン
	--------*/
  .smart-cf-meta-box-table .smf-close {
    content: 'close';
    padding: 2px 10px;
    cursor: pointer;
    background: #ccc; /* ボタン背景色 */
    position: absolute;
    top: 0;
    right: 100px; /* 一括ボタンを右からずらす*/
  }
  .smart-cf-meta-box-table .close-done {
    background: coral; /* ボタンクリック後の背景色 */
  }
  /*---------
	一括縮小を個別解除ボタン
  ----------*/
  .smart-cf-meta-box-table .smf-this-open {
    content: 'close';
    padding: 2px 10px;
    cursor: pointer;
    background: #ccc; /* 一括ボタン背景色 */
    color: #000; /* 一括ボタンテキスト色 */
    position: absolute;
    top: 0;
    right: 200px; /* 一括ボタンを右からずらす*/
		display: none;
  }
	.smart-cf-meta-box-table .smf-this-open.open-done {
		background: #acf;
	}
	.smart-cf-meta-box-table .smf-this-open.display {
		display: block;
	}
  .smart-cf-meta-box-table .all-close-done {
    background: #CCF; /* 一括ボタンクリック後の背景色 */
    color: #000; /* 一括ボタンテキスト色 */
  }
  /*---------
	一括縮小ボタン
  ----------*/
  .smart-cf-meta-box-table .smf-all-close {
    content: 'close';
    padding: 2px 10px;
    cursor: pointer;
    background: #888; /* 一括ボタン背景色 */
    color: #FFF; /* 一括ボタンテキスト色 */
    position: absolute;
    top: 0;
    right: 0;
  }
  .smart-cf-meta-box-table .all-close-done {
    background: #CCF; /* 一括ボタンクリック後の背景色 */
    color: #000; /* 一括ボタンテキスト色 */
  }
  /*---------
  個別縮小中を通知
  ----------*/
	.smart-cf-meta-box-table .smf-close_info {
		content: 'close';
		padding: 2px 4px;
  	background: #FF5192; /* 「個別縮小中」通知領域の背景色 */
		border-radius: 5px;
  	color: #FFF; /* 「個別縮小中」通知領域のテキスト色 */
		position: absolute;
		top: 25px;
		right: 100px; /* 「個別縮小中」通知領域を右からずらす*/
	}
  /*---------
  一括縮小の個別解除中を通知
  ----------*/
	.smart-cf-meta-box-table .smf-open_info {
		content: 'close';
		padding: 2px 4px;
  	background: #2271b1; /* 「個別縮小中」通知領域の背景色 */
		border-radius: 5px;
  	color: #FFF; /* 「個別縮小中」通知領域のテキスト色 */
		position: absolute;
		top: 25px;
		right: 200px; /* 「個別縮小中」通知領域を右からずらす*/
	}
  /*-------------------------------
  縮小時のアップロード画像表示サイズ変更
  --------------------------------*/
	.smart-cf-upload-image .img_resize,
	.smart-cf-upload-image .img_all-resize {
		// width: 50%;
		// height: 50%;
		max-width: 335px;
		width: 100%;
		max-height: 233px;
		height: 100%;
	}

	.toplevel_page_mv_slider .smart-cf-upload-image .img_resize,
	.toplevel_page_mv_slider .smart-cf-upload-image .img_all-resize {
		width: 75%;
		height: 75%;
	}



	/*---------------------------------
  通常SCFでのアップロード画像表示サイズ変更
  ----------------------------------*/
	/* 企業概要ページ */
	#smart-cf-custom-field-285 .smart-cf-field-type-image .smart-cf-upload-image img {
		width: 75%;
	}
	
	/* 事業内容ページ */
	#smart-cf-custom-field-316 .smart-cf-field-type-image .smart-cf-upload-image img {
		width: 75%;
	}

  /*---------------------------------------------
    ボタンクリック後の繰り返しフィールドアイテムの高さ設定
  ----------------------------------------------*/
  /* 全ページ共通 */
  .smart-cf-meta-box-table.shrink,
  .smart-cf-meta-box-table.shrink-all {
    height: 90px; /* ボタンクリック後の繰り返しフィールドアイテムの高さ */
    overflow: hidden;
  }
  /* 制作実績ページのボタンクリック後の繰り返しフィールドアイテムの高さ設定 */
  #smart-cf-custom-field-121 .smart-cf-meta-box-table.shrink,
  #smart-cf-custom-field-121 .smart-cf-meta-box-table.shrink-all {
    max-height: calc(350 / 16 * 1rem); /* ボタンクリック後の繰り返しフィールドアイテムの高さ */
		height: 100%;
    overflow: hidden;
  }
  /* 制作実績ページの制作実績の説明ボタンクリック後の繰り返しフィールドアイテムの高さ設定 */
  #smart-cf-custom-field-138 .smart-cf-meta-box-table.shrink,
  #smart-cf-custom-field-138 .smart-cf-meta-box-table.shrink-all {
    // max-height: calc(350 / 16 * 1rem); /* ボタンクリック後の繰り返しフィールドアイテムの高さ */
		height: 80px;
    overflow: hidden;
  }
  /* 事業内容ページのボタンクリック後の繰り返しフィールドアイテムの高さ設定 */
  #smart-cf-custom-field-316 .smart-cf-meta-box-table.shrink,
  #smart-cf-custom-field-316 .smart-cf-meta-box-table.shrink-all {
    height: 250px; /* ボタンクリック後の繰り返しフィールドアイテムの高さ */
    overflow: hidden;
  }
  /* 企業概要ページのボタンクリック後の繰り返しフィールドアイテムの高さ設定 */
  #smart-cf-custom-field-285 .smart-cf-meta-box-table.shrink,
  #smart-cf-custom-field-285 .smart-cf-meta-box-table.shrink-all {
    height: 70px; /* ボタンクリック後の繰り返しフィールドアイテムの高さ */
    overflow: hidden;
  }
  /* 【SCFオプション】トップのMVスライダーのボタンクリック後の繰り返しフィールドアイテムの高さ設定 */
  .toplevel_page_mv_slider .smart-cf-meta-box-table.shrink,
  .toplevel_page_mv_slider .smart-cf-meta-box-table.shrink-all {
    height: 230px; /* ボタンクリック後の繰り返しフィールドアイテムの高さ */
    overflow: hidden;
  }


	.smart-cf-meta-box-table.shrink-all.shrink-invalid {
		height: initial;
		overflow: initial;
	}

	/*---------------------------------------------
		繰り返しフィールド個数制限（＋ボタン消去）
	----------------------------------------------*/
	// /* 事業内容ページ 繰り返し3つ目の＋ボタン消去 ※nth-childの値は場合により変動します！ */
	// #smart-cf-custom-field-316 .smart-cf-meta-box .smart-cf-meta-box-repeat-tables .smart-cf-meta-box-table:nth-child(5) .dashicons-plus-alt.smart-cf-repeat-btn {
	// 	display: none;
	// }

  /*---------------------------------------------
    横並びにするためのスタイル調整
  ----------------------------------------------*/
	#smart-cf-custom-field-328 .smart-cf-upload-image {
		width: 80%;
		height: 80%;
	}
	#smart-cf-custom-field-328 .smart-cf-repeat-btn:nth-of-type(3) {
		width: calc(100% - 60px);
		text-align: left;
	}
	#smart-cf-custom-field-328 .smart-cf-meta-box-table table {
		width: 50%;
		display: inline-flex;
	}
	#smart-cf-custom-field-328 .smart-cf-meta-box-table table tbody {
		display: table;
		width: 100%;
	}
	#smart-cf-custom-field-328 .smart-cf-meta-box-table table th,
	#smart-cf-custom-field-328 .smart-cf-meta-box-table table td {
		display: table;
	}
	#smart-cf-custom-field-328 .smart-cf-meta-box-table table th {
		width: 100%;
	}
	#smart-cf-custom-field-328 .smart-cf-meta-box-table table td {
		display: inline-block;
		width: 100%;
	}
  </style>" . PHP_EOL;
}
add_action('admin_print_styles', 'my_admin_style');

function my_admin_footer_script()
{
  echo "<script>
  jQuery(function($){
    // 個別ボタン
    $('.smart-cf-meta-box-repeat-tables .smart-cf-meta-box-table').each(function() {
      $(this).append('<div class=\"smf-close\">縮小する</div><div class=\"\"></div>');
    });
    // <div class=\"\"></div> は個別縮小中通知用の空div
  
    $(document).on('click','.smart-cf-meta-box-table .smf-close',function() {
      $(this).toggleClass('close-done');
      $(this).parents('.smart-cf-meta-box-table').toggleClass('shrink');
      $(this).next().toggleClass('smf-close_info'); // 個別縮小中通知用のクラス付与
      $(this).parents('.smart-cf-meta-box-table').find('.smart-cf-upload-image').toggleClass('.smart-cf-upload-image__img_resize'); // クリックした個別ボタンの親要素内の.smart-cf-upload-imageにクラス付与
      $(this).parents('.smart-cf-meta-box-table').find('img').toggleClass('img_resize'); // クリックした個別ボタンの親要素内のimgにクラス付与
      if( $(this).hasClass('close-done') ) { // close-doneクラスが付与されている場合
        $(this).text('展開する'); // 個別ボタンテキスト変更
        $('.smf-close_info').text('個別縮小中'); // 個別縮小中通知用テキスト表示
      } else { // close-doneクラスが付与されていない場合
        $(this).text('縮小する'); // 個別ボタンテキスト変更
        $(this).next().text(''); // 個別縮小中通知用のテキスト非表示
      };
    });


    // 一括縮小ボタン
    $('.smart-cf-meta-box-repeat-tables .smart-cf-meta-box-table').each(function() {
      $(this).append('<div class=\"smf-all-close\">全て縮小</div>');
    });
		// 一括縮小ボタンの動作
    $(document).on('click','.smart-cf-meta-box-table .smf-all-close',function() {
			$('.smf-this-open').toggleClass('display'); // .smf-this-openにdisplayクラス付与で縮小解除ボタンを表示
			
			$('.smart-cf-meta-box-table .smf-all-close').toggleClass('all-close-done');
      $('.smart-cf-meta-box-table .smf-all-close').parents('.smart-cf-meta-box-table').toggleClass('shrink-all');
      $('.smart-cf-upload-image').toggleClass('.smart-cf-upload-image__img_all-resize'); // 全ての.smart-cf-upload-imageにimg_all-resizeクラス付与
      $('.smart-cf-upload-image img').toggleClass('img_all-resize'); // アップロード画像imgタグにimg_all-resizeクラス付与
      if( $('.smart-cf-meta-box-table .smf-all-close').hasClass('all-close-done') ) { // all-close-doneクラスが付与されている場合
        $('.smart-cf-meta-box-table .smf-all-close').text('全て展開'); // テキスト変更      
      } else { // all-close-doneクラスが付与されていない場合
        $('.smart-cf-meta-box-table .smf-all-close').text('全て縮小'); // テキスト変更
      };
			
			if( $('.open-done').length ) {
				$('.smart-cf-meta-box-table .smf-all-close').parents('.smart-cf-meta-box-table').removeClass('shrink-all');
				$('.smart-cf-upload-image').removeClass('.smart-cf-upload-image__img_all-resize');
				$('.smart-cf-upload-image img').removeClass('img_all-resize');
			}
			$('.smf-this-open').next().removeClass('smf-open_info'); //通知解除
			$('.smf-this-open').removeClass('open-done'); // .smf-this-openと並列のopen-doneクラス除去
    });


		// 一括縮小の個別解除ボタン
    $('.smart-cf-meta-box-repeat-tables .smart-cf-meta-box-table').each(function() {
			$(this).append('<div class=\"smf-this-open\">縮小解除</div><div class=\"\"></div>');
    });
		// <div class=\"\"></div> は一括縮小の個別解除中通知用の空div

		$(document).on('click','.smart-cf-meta-box-table .smf-this-open',function() {
      $(this).toggleClass('open-done');
      // $(this).parents('.smart-cf-meta-box-table').toggleClass('shrink');
      $(this).next().toggleClass('smf-open_info'); // 個別縮小中通知用のクラス付与
      $(this).parents('.smart-cf-meta-box-table').find('.smart-cf-upload-image').toggleClass('.smart-cf-upload-image__img_all-resize'); // クリックした個別ボタンの親要素内の.smart-cf-upload-imageにクラス付与
      $(this).parents('.smart-cf-meta-box-table').find('img').toggleClass('img_all-resize'); // クリックした個別ボタンの親要素内のimgにクラス付与
      $(this).parents('.smart-cf-meta-box-table').toggleClass('shrink-all'); // 親要素からshrink-allクラス除去
      if( $(this).hasClass('open-done') ) { // open-doneクラスが付与されている場合
        $(this).text('解除取消'); // 個別ボタンテキスト変更
        $('.smf-open_info').text('個別解除中'); // 一括縮小の個別解除中通知用テキスト表示
      } else { // close-doneクラスが付与されていない場合
        $(this).text('縮小解除'); // 個別ボタンテキスト変更
        $(this).next().text(''); // 一括縮小の個別解除中通知用のテキスト非表示
      };

    });



		// /* 事業内容 管理画面SCF繰り返しフィールドの上に要素を追加 */
		// $('#smart-cf-custom-field-316 .smart-cf-meta-box .smart-cf-meta-box-repeat-tables').prepend('<p class=\"c-scf-316\">事業内容コンテンツ 3つまで作成可能です。</p>');

  });
  </script>";
}
add_action('admin_print_footer_scripts', 'my_admin_footer_script');



?>