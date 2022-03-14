// ローディング判定
jQuery(function ($) {
	jQuery(window).on("load", function() {
		jQuery("body").attr("data-loading", "true");
	});

	// ナビバートグル クリック動作
	$('.js-hamburger').on('click', function () {
		if( $(this).hasClass('open') ) {
			$(this).removeClass('open');
			$('.js-drawer-menu').fadeOut(); // ドロワーメニュー
			// $('.js-overlay').fadeOut(); // オーバーレイ
		} else {
			$(this).addClass('open');
			$('.js-drawer-menu').fadeIn(); // ドロワーメニュー
			// $('.js-overlay').fadeIn(); // オーバーレイ
		}
	});
	// SP時ドロワーメニュー
	$(window).on('resize load', function() {
		var width = $(window).width();
		if( width > 767) {
			// $('.p-header__drawer').css('display', 'none');
			$('.js-drawer-menu').css('display', 'block');
		} else {
			$('.js-drawer-menu').css('display', 'none');
			$('.js-hamburger').removeClass('open');
		}
	});

	jQuery(function() {
		// スクロール判定
		jQuery(window).on("scroll", function() {
			if (100 < jQuery(this).scrollTop()) {
				jQuery("body").attr("data-scroll", "true");
			} else {
				jQuery("body").attr("data-scroll", "false");
			}
		});

		/* ドロワー */
		jQuery(".js-drawer").on("click", function(e) {
			e.preventDefault();
			let targetClass = jQuery(this).attr("data-target");
			jQuery("." + targetClass).toggleClass("is-checked");
			return false;
		});

		/* トップへ戻るボタンクリック時のスムーススクロール */
		$('.p-page-top').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 300, 'swing');
			return false;
		});
		/* メインビューすぎたらトップへ戻るボタン表示 */
		$(window).on('load scroll', function() {
			let mvHeight = $('.js-main-visual').outerHeight();
			let pageTop = $('.js-pagetop');
			let svHeight = $('.js-sub-visual').outerHeight();
			let scrollTop = $(window).scrollTop();
			// console.log(headerHeight);
			// console.log(subImgHeight);
			// console.log( scrollTop );
			if( mvHeight ) {//メインビジュアルの高さ取得時
				if( scrollTop > mvHeight ) {
					pageTop.fadeIn();
				} else {
					pageTop.fadeOut();
				}
			}
			if( svHeight ) { //サブビジュアルの高さ取得時
				if( scrollTop > svHeight ) {
					pageTop.fadeIn();
				} else {
					pageTop.fadeOut();
				}
			}
		});

		/* スムーススクロール */
		// jQuery('a[href^="#"]').click(function() {
		// 	let header = jQuery(".js-header").height();
		// 	let speed = 300;
		// 	let id = jQuery(this).attr("href");
		// 	let target = jQuery("#" == id ? "html" : id);
		// 	let position = jQuery(target).offset().top - header;
		// 	if ("fixed" !== jQuery("#header").css("position")) {
		// 		position = jQuery(target).offset().top;
		// 	}
		// 	if (0 > position) {
		// 		position = 0;
		// 	}
		// 	jQuery("html, body").animate(
		// 		{
		// 			scrollTop: position
		// 		},
		// 		speed
		// 	);
		// 	return false;
		// });

	// リンク先が別ページの場合のスムーススクロール
	// $(window).on('load resize', function() {
		var urlHash = location.hash;
		if (urlHash) {
			$('body,html').stop().scrollTop(0);
			setTimeout(function(){
				// ヘッダー固定の場合はヘッダーの高さを数値で入れる、固定でない場合は0
				let pheader = $(".js-header").outerHeight();
				var target = $(urlHash);
				var position = target.offset().top - pheader;
				$('body,html').stop().animate({scrollTop:position}, 300);
			}, 50);
		}
	// });
	// スムーススクロール (絶対パスのリンク先が現在のページであった場合でも作動)
	// $(document).on('click', 'a[href*="#"]', function () {
	// 	let time = 250;
	// 	let pheader = $('.js-p-header').outerHeight();
	// 	let target = $(this.hash);
	// 	if (!target.length) return;
	// 	var targetY = target.offset().top - pheader;
	// 	$('html,body').animate({ scrollTop: targetY }, time, 'swing');

	// 	return false;
	// });

		/* 電話リンク */
		let ua = navigator.userAgent;
		if (ua.indexOf("iPhone") < 0 && ua.indexOf("Android") < 0) {
			jQuery('a[href^="tel:"]')
				.css("cursor", "default")
				.on("click", function(e) {
					e.preventDefault();
				});
		}
	});

	// ヘッダーがメインビジュアルを過ぎたらヘッダー背景色付与
	$(window).on('load scroll', function() {
		let header = $('header');
		let headerHeight = $('.js-header').outerHeight();
		let imgHeight = $('.js-main-visual').outerHeight() - headerHeight;
		let subImgHeight = $('.js-sub-visual').outerHeight() - headerHeight;
		let contact = $('.p-drawer-menu__item').eq(-1); //最後の要素 = お問い合わせ
		let scrollTop = $(window).scrollTop();
		// console.log(headerHeight);
		console.log(subImgHeight);
		console.log( scrollTop );
		if( scrollTop > imgHeight ) {
			header.addClass('headerColor');
			contact.addClass('contactColor');
		} else {
			header.removeClass('headerColor');
			contact.removeClass('contactColor');
		}
		if( scrollTop > subImgHeight ) {
			header.addClass('headerColor');
			contact.addClass('contactColor');
		} else {
			header.removeClass('headerColor');
			contact.removeClass('contactColor');
		}
	});


	/* ブログ投稿 記事詳細ページ タグを囲む */
	// pタグ
	var blog_p = $('<div class="p-blog-detail__p"></div>');
	$('.p-blog-detail__content p').wrap(blog_p);
	// h2タグ
	var blog_h2 = $('<div class="p-blog-detail__h2"></div>');
	$('.p-blog-detail__content h2').wrap(blog_h2);
	// h3タグ
	var blog_h3 = $('<div class="p-blog-detail__h3"></div>');
	$('.p-blog-detail__content h3').wrap(blog_h3);
	// ulにクラス追加
	$('.p-blog-detail__content ul').addClass('p-blog-detail__items');
	// olにクラス追加
	$('.p-blog-detail__content ol').addClass('p-blog-detail__order-items');
	// 投稿画面で追加した画像figureタグにクラス追加
	$('.p-blog-detail__content figure').addClass('p-blog-detail__img');

	/* お知らせ投稿 記事詳細ページ タグを囲む */
	// pタグ
	var blog_p = $('<div class="p-news-detail__p"></div>');
	$('.p-news-detail__content p').wrap(blog_p);
	// h2タグ
	var blog_h2 = $('<div class="p-news-detail__h2"></div>');
	$('.p-news-detail__content h2').wrap(blog_h2);
	// h3タグ
	var blog_h3 = $('<div class="p-news-detail__h3"></div>');
	$('.p-news-detail__content h3').wrap(blog_h3);
	// ulにクラス追加
	$('.p-news-detail__content ul').addClass('p-news-detail__items');
	// olにクラス追加
	$('.p-news-detail__content ol').addClass('p-news-detail__order-items');
	// 投稿画面で追加した画像figureタグにクラス追加
	$('.p-news-detail__content figure').addClass('p-news-detail__img');



	/* swiper設定 制作実績 */
	//メイン
	const mainSlides = document.getElementsByClassName('p-products-gallery__img');
	const thumsSlides = document.getElementsByClassName('p-products-thumbs__img');
	// *PC時のみ使用する変数*
	//サムネイル画像の幅
	const thumbsWidth = 100 / mainSlides.length; // 「100 / サムネイル数」  *** %は使えないので、％は後で付与する
	//1サムネイル画像あたりのマージン値の計算 *** pxは使えない
	const thumbsMargin = ( ( mainSlides.length - 1 ) * 8 ) / mainSlides.length; // マージン8px * (サムネイル数 - 1) で合計マージン値を出して、その値をサムネイル数で割る
	$(window).on('load resize', function() { 
		var w = $(this).width();
		if( w > 767 ) { // PC時のみ
			$('.p-products-thumbs__img').width( thumbsWidth + '%'); // 最初にサムネイル画像の幅を％で計算し、代入する
			var thumbsImgWidth = $('.p-products-thumbs__img').width(); // 上記の値を変数に入れる。このままだとマージンを考慮してないので右端の画像が途切れる
			$('.p-products-thumbs__img').width(thumbsImgWidth - thumbsMargin); // サムネイル画像の幅から1サムネイル画像あたりのマージン値を引いた値を再代入する
		}
	});
	// /* サムネイル連動(サムネイルは固定) */
	// //サムネイル
	// var thumbs = new Swiper ('.gallery-thumbs', {
	// 	spaceBetween: 24,
	// 	slidesPerView: thumsSlides.length,
	// 	watchSlidesVisibility: true,
	// 	watchSlidesProgress: true,
	// 	breakpoints: {
	// 		// when window width is >= 320px
	// 		320: {
	// 		centeredSlides: true,
	// 		},
	// 		// when window width is >= 768px
	// 		768: {
	// 			// centeredSlides: false,
	// 			spaceBetween: 8,
	// 		}
	// 	}
	// });
	// //メイン
	// var mainSlider = new Swiper ('.gallery-slider', {
	// 	loop: true,
	// 	loopedSlides: mainSlides.length, //スライドの枚数と同じ値を指定
	// 	effect:'fade',    
	// 	fadeEffect:{
	// 		crossFade:true
	// 	},
	// 	navigation: {
	// 			nextEl: '.swiper-button-next',
	// 			prevEl: '.swiper-button-prev',
	// 	},
	// 	thumbs: {
	// 		swiper: thumbs
	// 	}
	// });

	/* サムネイル連動(サムネイルも連動) */
		//メイン
		var mainSlider = new Swiper ('.gallery-slider', {
			loop: true,
			loopedSlides: mainSlides.length, //スライドの枚数と同じ値を指定
			effect:'fade',    
			fadeEffect:{
				crossFade:true
			},
			navigation: {
					nextEl: '.swiper-button-next',
					prevEl: '.swiper-button-prev',
			},
		});
	//サムネイル
	var thumbs = new Swiper ('.gallery-thumbs', {
		slidesPerView: 'auto',
		spaceBetween: 24,
		// centeredSlides: true,
		loop: true,
		loopedSlides: thumsSlides.length,
		slideToClickedSlide: true,
		controller:{
			control: mainSlider
		},
		slidesPerView: thumsSlides.length,
		breakpoints: {
			// when window width is >= 320px
			320: {
			centeredSlides: true,
			},
			// when window width is >= 768px
			768: {
				// centeredSlides: false,
				spaceBetween: 8,
			}
		}
	});
	mainSlider.on('sliderChangeTransitionEnd', () => {
		const mainModulo = mainSlider.activeIndex%mainSlides.length;
		const thumbsModulo = thumbs.activeIndex%thumsSlides.length;
		if( mainModulo !== thumbsModulo ) {
			thumbs.slideToLoop( mainModulo );
		}
	});

	//4系～
	//メインとサムネイルを紐づける
	slider.controller.control = thumbs;
	thumbs.controller.control = slider;
	// slider.on('slideChangeTransitionEnd',()=>{
  //   const mainModulo = slider.activeIndex%mainSlides.length;
  //   const thumbModulo = thumb.activeIndex%thumbSlides.length;
  //   if( mainModulo != thumbModulo){
  //     thumb.slideToLoop(mainModulo);
  //   }
  // });


	/* メインビジュアルスライダー設定 */
	const swiper = new Swiper ('.js-main-visual-slider', {
		slidesPerView: 1,
		// centeredSlides: true,
		// freeMode: true,
		speed: 0, //スライドさせない
		loop: true,
		autoplay: {
			delay: 7000,
			disableOnInteraction: true
		},
		// navigation: {
		// 		nextEl: '.swiper-button-next',
		// 		prevEl: '.swiper-button-prev',
		// },
	});

	/* トップWorksスライダー設定 */
	const swiperWorks = new Swiper ('.js-top-works-slider', {
		slidesPerView: 1,
		// centeredSlides: true,
		// freeMode: true,
		loop: true,
		autoplay: {
			delay: 5000,
			disableOnInteraction: true
		},
		pagination: {
			el: '.swiper-pagination',
			type: 'bullets',
			clickable: true,
		},
		// navigation: {
		// 		nextEl: '.swiper-button-next',
		// 		prevEl: '.swiper-button-prev',
		// },
	});



	/* パンくずリストのタイトル変更 */
	// 「お知らせ」アーカイブの「お知らせ」を変更
	$('.p-breadcrumb.p-breadcrumb--news .post-news-archive').text('お知らせ一覧');
	// 「お知らせ」記事ページの「（タイトル）」を変更
	$('.p-breadcrumb.p-breadcrumb--news .post-news').text('お知らせ詳細');
	// 「制作実績」シングルページの「（タイトル）」を変更
	$('.p-breadcrumb.p-breadcrumb--products .post-products').text('制作実績詳細');

	// $('.p-breadcrumb.p-breadcrumb--products .post-news').text('お知らせ詳細');

	/* contact form 7 のエラーメッセージを移動 */
	$('.wpcf7-response-output').prependTo('.p-contact-form__items');


	/* ブログ投稿本文のリスト内の文字をspanで囲む */
	$('.p-blog-detail__items li').wrapInner('<span></span>');
	$('.p-blog-detail__order-items li').wrapInner('<span></span>');



});