<?php
/**
 * Twenty Twenty-Five functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

/**
 * Set theme default language locale to Simplified Chinese (zh_CN).
 */
add_filter( 'locale', function( $locale ) {
	return 'zh_CN';
} );

if ( ! function_exists( 'twentytwentyfive_post_format_setup' ) ) :
	/**
	 * Adds theme support for post formats.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_post_format_setup() {
		add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
	}
endif;
add_action( 'after_setup_theme', 'twentytwentyfive_post_format_setup' );

if ( ! function_exists( 'twentytwentyfive_editor_style' ) ) :
	/**
	 * Enqueues editor-style.css in the editors.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_editor_style() {
		add_editor_style( 'assets/css/editor-style.css' );
	}
endif;
add_action( 'after_setup_theme', 'twentytwentyfive_editor_style' );

if ( ! function_exists( 'twentytwentyfive_enqueue_styles' ) ) :
	/**
	 * Enqueues the theme stylesheet on the front.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_enqueue_styles() {
		$suffix = SCRIPT_DEBUG ? '' : '.min';
		$src    = 'style' . $suffix . '.css';

		wp_enqueue_style(
			'twentytwentyfive-style',
			get_parent_theme_file_uri( $src ),
			array(),
			wp_get_theme()->get( 'Version' )
		);
		wp_style_add_data(
			'twentytwentyfive-style',
			'path',
			get_parent_theme_file_path( $src )
		);
	}
endif;
add_action( 'wp_enqueue_scripts', 'twentytwentyfive_enqueue_styles' );

if ( ! function_exists( 'twentytwentyfive_block_styles' ) ) :
	/**
	 * Registers custom block styles.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_block_styles() {
		register_block_style(
			'core/list',
			array(
				'name'         => 'checkmark-list',
				'label'        => __( 'Checkmark', 'twentytwentyfive' ),
				'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_block_styles' );

if ( ! function_exists( 'twentytwentyfive_pattern_categories' ) ) :
	/**
	 * Registers pattern categories.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_pattern_categories() {

		register_block_pattern_category(
			'twentytwentyfive_page',
			array(
				'label'       => __( 'Pages', 'twentytwentyfive' ),
				'description' => __( 'A collection of full page layouts.', 'twentytwentyfive' ),
			)
		);

		register_block_pattern_category(
			'twentytwentyfive_post-format',
			array(
				'label'       => __( 'Post formats', 'twentytwentyfive' ),
				'description' => __( 'A collection of post format patterns.', 'twentytwentyfive' ),
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_pattern_categories' );

if ( ! function_exists( 'twentytwentyfive_register_block_bindings' ) ) :
	/**
	 * Registers the post format block binding source.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_register_block_bindings() {
		register_block_bindings_source(
			'twentytwentyfive/format',
			array(
				'label'              => _x( 'Post format name', 'Label for the block binding placeholder in the editor', 'twentytwentyfive' ),
				'get_value_callback' => 'twentytwentyfive_format_binding',
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_register_block_bindings' );

if ( ! function_exists( 'twentytwentyfive_format_binding' ) ) :
	/**
	 * Callback function for the post format name block binding source.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return string|void Post format name, or nothing if the format is 'standard'.
	 */
	function twentytwentyfive_format_binding() {
		$post_format_slug = get_post_format();

		if ( $post_format_slug && 'standard' !== $post_format_slug ) {
			return get_post_format_string( $post_format_slug );
		}
	}
endif;

/**
 * Enqueue cloned haitaik.com assets on the front page and product pages.
 * Uses get_template_directory_uri() so the theme is 100% standalone on any host.
 */
function twentytwentyfive_enqueue_cloned_assets() {
	$theme_uri = get_template_directory_uri();

	// Enqueue all theme stylesheets unconditionally for 100% fail-proof styling on any host, slug, or template
	$stylesheets = array(
		'haitaik-bootstrap-global' => '/assets/npublic/libs/css/ceccbootstrap-global.css',
		'haitaik-home-main'        => '/assets/css/Home_7b9a32a9a2a77e5f5e09085c43c3ae42.min.css',
		'haitaik-site'             => '/assets/css/site.css',
		'haitaik-about'            => '/assets/css/about.css',
		'haitaik-faq'              => '/assets/css/faq.css',
		'haitaik-contact'          => '/assets/css/contactus.css',
		'haitaik-pro-list'         => '/assets/css/pro_list1.css',
		'haitaik-singleproduct'    => '/assets/css/singleproduct.css',
	);

	foreach ( $stylesheets as $handle => $rel_path ) {
		wp_enqueue_style( $handle, $theme_uri . $rel_path, array(), null );
	}

	// Enqueue all global JS scripts unconditionally
	$scripts = array(
		'haitaik-core-js'                         => '/assets/npublic/libs/core/ceccjquery-libs.js',
		'haitaik-common-js'                       => '/assets/npublic/commonjs/common.min.js',
		'haitaik-c0ac6a6647ce41aca3955968ca1f9a50' => '/assets/upload/js/c0ac6a6647ce41aca3955968ca1f9a50.js',
		'haitaik-3b40c5321d4a424a8951ae1ecddfaac5' => '/assets/upload/js/3b40c5321d4a424a8951ae1ecddfaac5.js',
		'haitaik-d1fd3c1642ba450fb712d2542fad9bca' => '/assets/upload/js/d1fd3c1642ba450fb712d2542fad9bca.js',
	);

	foreach ( $scripts as $handle => $rel_path ) {
		wp_enqueue_script( $handle, $theme_uri . $rel_path, array(), null, true );
	}
}
add_action( 'wp_enqueue_scripts', 'twentytwentyfive_enqueue_cloned_assets', 20 );

/**
 * Filter block output and HTML output to dynamically rewrite root asset URLs (/npublic/, /upload/, /css/)
 * to theme asset URLs (get_template_directory_uri() . '/assets/...').
 * This guarantees that when the user uploads ONLY the theme folder to any host, all images and assets load 100%.
 */
function twentytwentyfive_rewrite_asset_urls( $content ) {
	if ( empty( $content ) || is_admin() ) {
		return $content;
	}
	$theme_asset_url = get_template_directory_uri() . '/assets/';

	// 1. Automatically resolve s.png 1x1 transparent placeholders to their real lazy image URLs
	$content = preg_replace_callback(
		'/<img\s+([^>]*?)>/i',
		function( $matches ) {
			$img_tag = $matches[0];
			if ( preg_match( '/lazy=["\']([^"\']+)["\']/i', $img_tag, $lazy_match ) && preg_match( '/src=["\'][^"\']*s\.png["\']/i', $img_tag ) ) {
				$real_url = $lazy_match[1];
				$img_tag  = preg_replace( '/src=["\'][^"\']*s\.png["\']/i', 'src="' . esc_url( $real_url ) . '"', $img_tag );
			}
			return $img_tag;
		},
		$content
	);

	// 2. Rewrite root asset URLs to theme assets directory
	$patterns = array(
		'/(src|href|lazy|data-src|poster)=(["\'])\/(npublic|upload|css|thirdcode|_external|nportal|ndesigner)\//i',
		'/url\((["\']?)\/(npublic|upload|css|thirdcode|_external|nportal|ndesigner)\//i',
	);
	$replacements = array(
		'$1=$2' . $theme_asset_url . '$3/',
		'url($1' . $theme_asset_url . '$2/',
	);

	return preg_replace( $patterns, $replacements, $content );
}
add_filter( 'render_block', 'twentytwentyfive_rewrite_asset_urls', 10, 1 );
add_filter( 'the_content', 'twentytwentyfive_rewrite_asset_urls', 10, 1 );

function twentytwentyfive_start_asset_url_buffer() {
	if ( ! is_admin() ) {
		ob_start( 'twentytwentyfive_rewrite_asset_urls' );
	}
}
add_action( 'template_redirect', 'twentytwentyfive_start_asset_url_buffer', 1 );

/**
 * Standalone Modular Template Loader.
 * Guarantees that frontpage, product list, single product, about us, faq, contact us, and 404 pages
 * always load their dedicated modular PHP template files (header.php + body + footer.php) on ANY host.
 */
function twentytwentyfive_standalone_modular_template_loader( $template ) {
	if ( is_admin() ) {
		return $template;
	}

	global $post;

	// 1. Force strict template routing by Page Slug
	if ( is_page() && ! empty( $post->post_name ) ) {
		$slug = strtolower( trim( $post->post_name ) );

		if ( in_array( $slug, array( 'about-us', 'about', 'company-profile', 'gioi-thieu' ), true ) ) {
			$file = get_template_directory() . '/page-about-us.php';
			if ( file_exists( $file ) ) return $file;
		}

		if ( in_array( $slug, array( 'led-display-power', 'products', 'product', 'product-info', 'industrial-control-power', 'led-lighting-power', 'din-rail-power', 'san-pham' ), true ) ) {
			$file = get_template_directory() . '/page-product-list.php';
			if ( file_exists( $file ) ) return $file;
		}

		if ( in_array( $slug, array( 'faq', 'f-a-q', 'hoi-dap' ), true ) ) {
			$file = get_template_directory() . '/page-faq.php';
			if ( file_exists( $file ) ) return $file;
		}

		if ( in_array( $slug, array( 'contact-us', 'contact', 'contacts', 'lien-he' ), true ) ) {
			$file = get_template_directory() . '/page-contact-us.php';
			if ( file_exists( $file ) ) return $file;
		}

		if ( in_array( $slug, array( 'news', 'post', 'posts', 'tin-tuc' ), true ) ) {
			$file = get_template_directory() . '/home.php';
			if ( file_exists( $file ) ) return $file;
		}
	}

	// 2. Standard WordPress Conditional Tag fallbacks
	if ( is_front_page() ) {
		$file = get_template_directory() . '/front-page.php';
		if ( file_exists( $file ) ) return $file;
	} elseif ( is_page( array( 'about-us', 'about', 'company-profile' ) ) ) {
		$file = get_template_directory() . '/page-about-us.php';
		if ( file_exists( $file ) ) return $file;
	} elseif ( is_page( array( 'led-display-power', 'products', 'product', 'product-info', 'industrial-control-power', 'led-lighting-power', 'din-rail-power' ) ) ) {
		$file = get_template_directory() . '/page-product-list.php';
		if ( file_exists( $file ) ) return $file;
	} elseif ( is_page( array( 'faq' ) ) ) {
		$file = get_template_directory() . '/page-faq.php';
		if ( file_exists( $file ) ) return $file;
	} elseif ( is_page( array( 'contact-us', 'contact', 'contacts' ) ) ) {
		$file = get_template_directory() . '/page-contact-us.php';
		if ( file_exists( $file ) ) return $file;
	} elseif ( is_home() || is_page( array( 'news', 'post', 'posts' ) ) ) {
		$file = get_template_directory() . '/home.php';
		if ( file_exists( $file ) ) return $file;
	} elseif ( is_singular( 'product' ) ) {
		$file = get_template_directory() . '/single-product.php';
		if ( file_exists( $file ) ) return $file;
	} elseif ( is_single() ) {
		$file = get_template_directory() . '/single.php';
		if ( file_exists( $file ) ) return $file;
	} elseif ( is_404() ) {
		$file = get_template_directory() . '/404.php';
		if ( file_exists( $file ) ) return $file;
	}

	return $template;
}
add_filter( 'template_include', 'twentytwentyfive_standalone_modular_template_loader', 99 );

/**
 * Automatic Theme Page Setup Engine.
 * Creates and configures all core Haitaik theme pages automatically upon theme activation or via admin button.
 */
function twentytwentyfive_auto_setup_pages() {
	$pages_to_create = array(
		'about-us' => array(
			'post_title'    => 'About Us',
			'post_name'     => 'about-us',
			'page_template' => 'page-about-us.php',
		),
		'led-display-power' => array(
			'post_title'    => 'Products',
			'post_name'     => 'led-display-power',
			'page_template' => 'page-product-list.php',
		),
		'faq' => array(
			'post_title'    => 'FAQ',
			'post_name'     => 'faq',
			'page_template' => 'page-faq.php',
		),
		'news' => array(
			'post_title'    => 'News',
			'post_name'     => 'news',
			'page_template' => '',
		),
		'contact-us' => array(
			'post_title'    => 'Contact Us',
			'post_name'     => 'contact-us',
			'page_template' => 'page-contact-us.php',
		),
	);

	foreach ( $pages_to_create as $slug => $data ) {
		$existing_page = get_page_by_path( $slug );
		if ( ! $existing_page ) {
			$query = new WP_Query( array(
				'post_type'      => 'page',
				'name'           => $slug,
				'posts_per_page' => 1,
			) );
			if ( $query->have_posts() ) {
				$existing_page = $query->posts[0];
			}
		}

		if ( ! $existing_page ) {
			$page_id = wp_insert_post( array(
				'post_title'     => $data['post_title'],
				'post_name'      => $data['post_name'],
				'post_status'    => 'publish',
				'post_type'      => 'page',
				'comment_status' => 'closed',
			) );
		} else {
			$page_id = $existing_page->ID;
		}

		if ( $page_id && ! empty( $data['page_template'] ) ) {
			update_post_meta( $page_id, '_wp_page_template', $data['page_template'] );
		}
	}

	// Auto-correct template metadata for any existing pages matching core slugs
	$all_pages = get_posts( array( 'post_type' => 'page', 'posts_per_page' => -1 ) );
	foreach ( $all_pages as $p ) {
		$s = strtolower( trim( $p->post_name ) );
		if ( in_array( $s, array( 'about-us', 'about', 'company-profile', 'gioi-thieu' ), true ) ) {
			update_post_meta( $p->ID, '_wp_page_template', 'page-about-us.php' );
		} elseif ( in_array( $s, array( 'led-display-power', 'products', 'product', 'product-info', 'industrial-control-power', 'led-lighting-power', 'din-rail-power', 'san-pham' ), true ) ) {
			update_post_meta( $p->ID, '_wp_page_template', 'page-product-list.php' );
		} elseif ( in_array( $s, array( 'faq', 'f-a-q', 'hoi-dap' ), true ) ) {
			update_post_meta( $p->ID, '_wp_page_template', 'page-faq.php' );
		} elseif ( in_array( $s, array( 'contact-us', 'contact', 'contacts', 'lien-he' ), true ) ) {
			update_post_meta( $p->ID, '_wp_page_template', 'page-contact-us.php' );
		}
	}

	// Flush rewrite rules for clean permalinks
	if ( get_option( 'permalink_structure' ) !== '/%postname%/' ) {
		global $wp_rewrite;
		$wp_rewrite->set_permalink_structure( '/%postname%/' );
		flush_rewrite_rules( true );
	}
}

// Automatically trigger page setup when theme is activated
add_action( 'after_switch_theme', 'twentytwentyfive_auto_setup_pages' );

// Handle manual 1-click trigger via admin action URL
add_action( 'admin_init', function() {
	if ( isset( $_GET['haitaik_auto_setup_pages'] ) && current_user_can( 'manage_options' ) ) {
		twentytwentyfive_auto_setup_pages();
		wp_safe_redirect( admin_url( 'themes.php?page_setup_complete=1' ) );
		exit;
	}
} );

// Display Admin Notice banner with 1-click Auto Setup button
add_action( 'admin_notices', function() {
	if ( isset( $_GET['page_setup_complete'] ) ) {
		echo '<div class="notice notice-success is-dismissible"><p><strong>Haitaik Theme:</strong> All core pages (About Us, Products, FAQ, News, Contact Us) have been automatically created and configured!</p></div>';
	} else {
		$setup_url = esc_url( admin_url( 'themes.php?haitaik_auto_setup_pages=1' ) );
		echo '<div class="notice notice-info is-dismissible"><p><strong>Haitaik Theme:</strong> Need to activate or re-create core theme pages on this site? <a href="' . $setup_url . '" class="button button-primary" style="margin-left: 10px;">Activate Core Pages Automatically</a></p></div>';
	}
} );

/**
 * Automatically import scraped news articles from CSV into WordPress database.
 */
function haitaik_import_csv_articles() {
	$articles = array(
		array(
			'title'   => '创联电源 2018年国庆节放假通知',
			'date'    => '2018-09-30 00:00:00',
			'image'   => 'https://omo-oss-image.thefastimg.com/portal-saas/pg2024041817493912440/cms/image/9d2733f3-83b0-4237-b69e-0df0b502a334.jpg',
			'content' => '<p style="font-size:16px; font-weight:600; color:#1e293b;">尊敬的创联电源客户及合作伙伴：</p><p>金秋十月，国庆佳节即将来临。首先感谢广大客户长期以来对常州创联电源科技股份有限公司的信任与支持！在此国庆华诞到来之际，创联电源全体员工向您致以最诚挚的节日问候，祝您身体健康、生意兴隆、阖家幸福！</p><h2>一、2018年国庆节放假时间安排</h2><p>根据国家法定节假日规定，结合我司生产制造与业务运营的实际情况，2018年国庆节放假具体安排如下：</p><ul><li><strong>放假时间：</strong>2018年10月1日（星期一）至2018年10月5日（星期五），共放假5天。</li><li><strong>调休上班：</strong>2018年10月6日（星期六）、10月7日（星期日）正常恢复上班与发货。</li></ul><h2>二、温馨提示与备货建议</h2><p>放假期间，公司发货与物流派送时效将受到不同程度的影响。为确保您的生产与项目不受影响，请广大客户提前做好备货与订单规划。如遇紧急事项，请联系相关区域销售负责人。</p><p style="text-align:right; margin-top:30px;"><strong>常州创联电源科技股份有限公司</strong><br>2018年9月30日</p>',
		),
		array(
			'title'   => '中国照明学会窦林平秘书长一行莅临创联电源参观指导',
			'date'    => '2018-10-15 00:00:00',
			'image'   => 'https://omo-oss-image.thefastimg.com/portal-saas/pg2024041817493912440/cms/image/858b7272-8738-4af1-ac58-c64d2f8c3b7c.jpg',
			'content' => '<p>近日，中国照明学会秘书长窦林平先生一行莅临常州创联电源科技股份有限公司进行实地考察与指导工作。创联电源董事长唐景新先生及公司核心高管团队予以热情接待。</p><h2>一、深入车间与研发中心考察</h2><p>在公司领导的陪同下，窦林平秘书长一行先后参观了创联电源现代化SMC自动生产车间、高标准研发测试中心及全系电源产品展厅。考察过程中，技术负责人详细汇报了公司在LED显示屏电源、工业自动化控制电源及高效照明驱动领域的最新自主创新成果。</p><h2>二、高度肯定创联技术突破与品质管控</h2><p>窦林平秘书长对创联电源多年来坚持自主研发、严把产品质量关所取得的辉煌成绩给予了高度评价，特别是对创联共阴高效低功耗LED显示屏电源在绿色节能与降本增效方面的突出贡献表示充分肯定。</p><h2>三、共话行业未来与绿色节能趋势</h2><p>双方还就当前全球LED照明与显示行业的技术演进、产业升级及国家双碳政策下的绿色低碳发展进行了深入探讨。创联电源将继续发挥技术引领优势，助力行业高质量发展。</p>',
		),
		array(
			'title'   => '创联电源成功举办2018年度5S现场管理表彰大会',
			'date'    => '2018-11-20 00:00:00',
			'image'   => 'https://omo-oss-image.thefastimg.com/portal-saas/pg2024041817493912440/cms/image/eb3b85d9-2c73-4a06-9ffe-2f8c403bc750.jpg',
			'content' => '<p>为总结和深化公司5S现场管理推行成果，树立岗位标杆，常州创联电源科技股份有限公司隆重召开了2018年度5S现场管理表彰大会。</p><h2>一、全员参与，现场环境焕然一新</h2><p>自5S管理体系推行以来，创联电源全体员工积极响应、全员上阵，围绕“整理、整顿、清扫、清洁、素养”五大核心要素，对生产车间、仓库及办公区域进行了全面规范与整治。车间物品摆放整齐划一，生产流程顺畅有序，现场环境得到了根本性的改观。</p><h2>二、表彰先进，树立精益生产标杆</h2><p>大会对在5S月度与年度评比中表现突出的“优秀示范车间”、“标兵班组”及“5S管理个人先进”颁发了荣誉奖牌与奖金。受表彰代表分享了现场整治的成功经验。</p><h2>三、持之以恒，打造高品质制造基地</h2><p>公司领导在总结讲话中指出，5S现场管理是打造精益工厂和保障产品高品质的基础。创联电源将以此次表彰为新起点，常态化推进精益管理，为客户提供品质更卓越、性能更稳定的电源产品。</p>',
		),
		array(
			'title'   => '创联电源邀您共赴 2019 深圳国际LED展 (LED CHINA 2019)',
			'date'    => '2019-01-15 00:00:00',
			'image'   => 'https://omo-oss-image.thefastimg.com/portal-saas/pg2024041817493912440/cms/image/a979406c-384e-43b9-a00e-c5f0ae2a0a76.jpg',
			'content' => '<p style="font-size:16px; font-weight:600; color:#1e293b;">尊敬的行业同仁、广大客户及合作伙伴：</p><p>全球LED行业盛会——2019深圳国际LED展（LED CHINA 2019）将于深圳会展中心隆重举行。作为全球领先的LED显示屏电源与工业电源解决方案服务商，创联电源诚挚邀请您莅临我司展位参观指导与洽谈合作！</p><h2>一、展会重磅亮点</h2><ul><li><strong>共阴节能电源系列：</strong>温升低、功耗小，专为超高清LED显示屏量身打造；</li><li><strong>超薄小间距电源系列：</strong>紧凑设计，高效散热，适配高端微间距显示应用；</li><li><strong>高可靠工业控制电源：</strong>宽电压输入，具备过载、短路及过压全方位保护。</li></ul><h2>二、观展指引</h2><p><strong>展会名称：</strong>2019深圳国际LED展（LED CHINA 2019）<br><strong>展会时间：</strong>2019年2月21日 - 2月23日<br><strong>展会地点：</strong>深圳会展中心（深圳市福田区福华三路）<br><strong>创联展位号：</strong>1号馆 C45 展位</p><p>我们的技术专家与销售团队将在展会现场为您解疑答惑，期待与您相聚深圳，共谋发展！</p>',
		),
		array(
			'title'   => '喜讯！创联电源荣获2018年度常州市“明星企业”称号',
			'date'    => '2019-02-18 00:00:00',
			'image'   => 'https://omo-oss-image.thefastimg.com/portal-saas/pg2024041817493912440/cms/image/a45924b8-0d63-401e-9635-a7ef6828906a.jpg',
			'content' => '<p>在新春开工之际，常州市委、市政府及钟楼区委、区政府隆重召开了2018年度高质量发展表彰大会。常州创联电源科技股份有限公司凭借突出的经营业绩、持续的科技创新及优异的社会贡献，荣获2018年度常州市“明星企业”及钟楼区“重大贡献奖”！</p><h2>一、自主创新推动企业高质量发展</h2><p>同时，创联电源董事长唐景新先生荣获常州市“工业明星企业家”及钟楼区“卓越贡献企业家”荣誉称号。</p><h2>二、深耕电源行业，打造品牌标杆</h2><p>创联电源成立二十年来，始终专注于LED显示屏电源、工业自动化控制电源及LED驱动电源的研发与制造。产品出口全球50多个国家和地区，年出货量超2000万台。</p><h2>三、砥砺前行，再创辉煌</h2><p>荣誉是对过去的肯定，更是对未来的鞭策。创联电源将继续加大研发投入，深化智能化改造，为区域经济高质量发展注入强劲动能！</p>',
		),
		array(
			'title'   => '图文直击：2019广州ISLE展会创联电源再领风骚',
			'date'    => '2019-03-08 00:00:00',
			'image'   => 'https://omo-oss-image.thefastimg.com/portal-saas/pg2024041817493912440/cms/image/243a9be8-db99-469d-8bbb-88393bc226df.jpg',
			'content' => '<p>2019广州国际广告标识及LED展览会（ISLE展）在广州琶洲广交会展馆B区盛大开幕。创联电源携旗下全系高效能电源产品重磅参展，凭借卓越的产品性能与极具吸引力的展台设计，成为全场瞩目的焦点！</p><h2>一、展台盛况，人潮涌动</h2><p>展会期间，创联电源展台前盛况空前，吸引了来自全球数十个国家和地区的专业采购商、行业专家及新闻媒体驻足交流。现场工作人员以专业热情态度为客户细致解答技术细节。</p><h2>二、硬核新品，引领行业趋势</h2><p>创联电源现场展示了最新研制的共阴高效率低功耗电源系列、防潮防尘工业电源及超薄显示屏驱动电源。产品在转换效率、发热量控制及运行稳定性方面表现亮眼，赢得了现场嘉宾一致好评。</p><h2>三、携手共赢，再创佳绩</h2><p>本次展会上，创联电源与多家国内外知名显示屏品牌厂商达成了战略合作意向。创联将继续秉承“以品质求生存，以创新求发展”的理念，赋能行业合作伙伴！</p>',
		),
		array(
			'title'   => '创联电源新产品型号发布公告',
			'date'    => '2019-06-10 00:00:00',
			'image'   => 'https://omo-oss-image.thefastimg.com/portal-saas/pg2024041817493912440/cms/image/7ab752ac-10bc-485e-ba7c-c1b4f357831e.png',
			'content' => '<p style="font-size:16px; font-weight:600; color:#1e293b;">尊敬的广大客户与合作伙伴：</p><p>为更好地满足市场对高效能、低功耗及高可靠性电源产品的强劲需求，常州创联电源科技股份有限公司研发团队经过攻坚克难，成功推出了全新一代电源系列产品。</p><h2>一、新产品型号清单</h2><ul><li><strong>A-200AF-5D 系列：</strong>无风扇超静音单双色显示屏专用驱动电源；</li><li><strong>GL-300W 系列：</strong>超薄全彩显示屏共阴高效电源；</li><li><strong>A-100/200 工业系列：</strong>高性价比工业自动化控制电源。</li></ul><h2>二、核心性能提升</h2><p>新产品在电路拓扑结构上进行了深度优化，转换效率提升至90%以上，大幅降低了运行发热量与能耗。同时，产品通过了严格的高低温老炼测试与防潮防尘防护测试，具备极高的稳定性和长寿命。</p><p>以上新产品现已全面上市并接受订购，欢迎广大新老客户联系销售经理索取样品及规格书文件。</p>',
		),
		array(
			'title'   => '新征程·再出发——创联电源20周年庆典暨2020迎新年会圆满落幕',
			'date'    => '2020-01-12 00:00:00',
			'image'   => 'https://omo-oss-image.thefastimg.com/portal-saas/pg2024041817493912440/cms/image/b0299618-f4da-4653-ba07-4417fc3950d5.jpg',
			'content' => '<p>岁月如歌，风华正茂。2020年1月10日，常州创联电源科技股份有限公司“20周年庆典暨2020迎新年会”在常州西园大酒店隆重举行。创联全体员工、合作伙伴及社会各界嘉宾齐聚一堂，共庆创联电源成立二十周年的辉煌时刻！</p><h2>一、二十载峥嵘岁月，铸就行业品牌</h2><p>年会在沉沉质感的二十周年回顾专题片中拉开序幕。二十年来，创联电源从最初的创业探索，发展成为如今拥有常州、深圳两大研发中心、年产销量突破2000万台的国家级专精特新“小巨人”企业。</p><h2>二、感恩同行，表彰忠诚与卓越</h2><p>公司董事长唐景新先生在致辞中向二十年来辛勤付出的员工及给予大力支持的客户表示最衷心的感谢。盛典对服务公司满5年、10年、15年以上的忠诚员工及2019年度优秀团队进行了隆重表彰。</p><h2>三、新征程，再出发</h2><p>欢声笑语伴随着精彩纷呈的员工文艺汇演与抽奖活动。站在20周年的新起点上，创联电源将以更加坚定的步伐，开启高质量发展的全新征程！</p>',
		),
		array(
			'title'   => '抗击疫情，共克时艰！致创联电源广大客户的一封信',
			'date'    => '2020-02-15 00:00:00',
			'image'   => 'https://omo-oss-image.thefastimg.com/portal-saas/pg2024041817493912440/cms/image/6031d92f-ab31-4cca-bbe1-603a0b96d553.jpg',
			'content' => '<p style="font-size:16px; font-weight:600; color:#1e293b;">尊敬的创联电源客户及合作伙伴：</p><p>新年好！首先感谢全国广大客户长期以来对创联电源的信任与厚爱。自新型冠状病毒感染肺炎疫情发生以来，创联电源时刻牵挂着全体员工与广大客户的健康安全。</p><h2>一、全面落实疫情防控举措</h2><p>公司第一时间成立了疫情防控领导小组，制定了严密的防疫工作方案。对生产车间、办公区域及宿舍进行全方位无死角消毒，严格执行体温检测、健康打卡与防护物资发放，确保员工身体健康与生产安全。</p><h2>二、有序复工，全力保障订单交付</h2><p>在符合国家及地方政府防疫要求的前提下，创联电源已全面恢复生产运营。公司供应链与生产部门正在全力加班加点，优先保障重点项目与紧急订单的发货需求。</p><h2>三、同心协力，共迎曙光</h2><p>疫情挡不住发展的步伐。创联电源将与广大客户同舟共济、携手并进，共同打赢这场疫情防控与复工复产的攻坚战！</p><p style="text-align:right; margin-top:30px;"><strong>常州创联电源科技股份有限公司</strong></p>',
		),
		array(
			'title'   => '【创联新品资讯】单双色显示屏电源 A-200AF-5D 重磅上市！',
			'date'    => '2020-05-18 00:00:00',
			'image'   => 'https://omo-oss-image.thefastimg.com/portal-saas/pg2024041817493912440/cms/image/daf90437-eb04-44b0-aea7-36f630bfbb71.jpg',
			'content' => '<p>创联电源重磅推出了全新研发的单双色LED显示屏驱动电源——<strong>A-200AF-5D 系列</strong>！该产品采用无风扇自然散热设计，额定功率200W，专为中高端单双色显示屏打造。</p><h2>一、核心技术优势</h2><ul><li><strong>高效省电：</strong>转换效率显著提升，有效降低温升，减缓显示灯珠衰减；</li><li><strong>无风扇超静音：</strong>采用压铸铝壳自散热结构，零噪音，防尘防潮；</li><li><strong>宽电压适应：</strong>输入电压范围200~240VAC，内置完善的过载、短路、过压保护；</li><li><strong>超薄尺寸：</strong>高度仅30mm，极大地节省箱体内部空间，方便安装维护。</li></ul><h2>二、应用领域</h2><p>适用于户内外单双色条形屏、门头屏、车站告示屏及各类工业显示设备。100%满负载高温老炼，品质值得信赖！</p>',
		),
		array(
			'title'   => '【创联电源】叮咚~ 您有一份展会邀请函，请查收！',
			'date'    => '2020-09-25 00:00:00',
			'image'   => 'https://omo-oss-image.thefastimg.com/portal-saas/pg2024041817493912440/cms/image/1fc26781-d3f9-4255-8eb6-82185240b239.jpg',
			'content' => '<p style="font-size:16px; font-weight:600; color:#1e293b;">尊敬的客户与行业朋友：</p><p>作为全球照明与LED显示风向标的“广州国际照明展览会（光亚展）”将于广州琶洲展馆盛大举行。创联电源诚挚邀请您莅临参观指导！</p><h2>一、展会信息</h2><p><strong>展会名称：</strong>第25届广州国际照明展览会（光亚展）<br><strong>展会时间：</strong>2020年10月10日 - 10月13日<br><strong>展会地点：</strong>广州·中国进出口商品交易会展馆（琶洲展馆）<br><strong>创联展位：</strong>12.2馆 C10 展位</p><h2>二、展出前沿技术</h2><p>创联电源将携最新共阴智能电源、防水防雨电源驱动及工业控制电源全系产品亮相，现场提供专业技术方案解答。期待与您面对面交流探讨！</p>',
		),
		array(
			'title'   => '热点快报 | 创联电源荣获 UL 目击测试实验室资质授权',
			'date'    => '2020-11-05 00:00:00',
			'image'   => 'https://omo-oss-image.thefastimg.com/portal-saas/pg2024041817493912440/cms/image/71e1ebd6-8352-4b4c-b8b7-a838f5d7fbc1.jpg',
			'content' => '<p>近日，国际权威安全科学专家 UL（Underwriters Laboratories）向常州创联电源科技股份有限公司正式颁发了 <strong>UL 目击测试实验室（Witness Test Data Program, WTDP）</strong>资质证书！</p><h2>一、标志着研发与检测技术达国际顶尖水平</h2><p>获得 UL WTDP 资质授权，标志着创联电源在测试设备精度、实验环境控制、测试工程师技术能力及质量管理体系方面均达到了国际极严苛的标准。</p><h2>二、大幅缩短新产品 UL 认证周期</h2><p>今后创联电源研发的新产品可在公司自身实验室直接进行 UL 安全认证目击测试，无需寄送至海外实验室。这将使新品认证周期缩短50%以上，大幅加快了创新电源产品的全球化市场投放节奏。</p><h2>三、严品质，筑基石</h2><p>创联电源将以此为契机，继续严把产品质量安全关，为全球50多个国家和地区的客户提供安全可靠的电源解决方案。</p>',
		),
		array(
			'title'   => '创联电源上市辅导备案公告',
			'date'    => '2021-01-18 00:00:00',
			'image'   => 'https://omo-oss-image.thefastimg.com/portal-saas/pg2024041817493912440/cms/image/3d069318-2921-4bc8-b1de-3ef113b27d51.jpg',
			'content' => '<p>常州创联电源科技股份有限公司（以下简称“创联电源”）已向中国证券监督管理委员会江苏监管局正式提交上市辅导备案材料，并获得受理，辅导机构为国内知名证券公司。</p><h2>一、加速资本化发展步伐</h2><p>标志着创联电源正式开启迈向资本市场的新征程。公司将严格按照上市标准与法律法规要求，进一步完善公司治理结构，健全内部控制体系，全面提升企业综合管理水平。</p><h2>二、立足高质发展，回报社会关怀</h2><p>未来，创联电源将继续加大高端智能电源及新能源电源的研发投入，延伸产业链条，以更加优异的经营业绩回报广大投资者及社会各界的支持！</p>',
		),
		array(
			'title'   => '聚焦 | 创联电源保驾护航建党100周年大型情景史诗《伟大征程》',
			'date'    => '2021-07-02 00:00:00',
			'image'   => 'https://omo-oss-image.thefastimg.com/portal-saas/pg2024041817493912440/cms/image/be05d5f8-2a91-480d-b3ad-579415b230ba.webp',
			'content' => '<p>在庆祝中国共产党成立100周年大型情景史诗《伟大征程》文艺演出在国家体育场（鸟巢）盛大举行。近万平方米的超高清LED巨型屏幕及地砖屏震撼亮相，重现百年风华的宏大盛景。</p><h2>一、零失误保障核心显示电力供给</h2><p>创联电源作为本次国家级重大演出活动的核心电源供应商，为现场绝大部分LED显示屏系统提供了高稳定、高效率的电力保障。技术团队现场全天候驻守巡查，确保电源在高温高负荷下零故障运行。</p><h2>二、大国品牌，硬核实力</h2><p>从北京奥运会、上海世博会到建党100周年盛典，创联电源多次在国家重大项目中担当重任，彰显了中国智能制造的硬核品质与品牌实力！</p>',
		),
		array(
			'title'   => '关于“部分主体通过网络及自媒体平台散布不实言论”的严正声明',
			'date'    => '2022-03-10 00:00:00',
			'image'   => 'https://omo-oss-image.thefastimg.com/portal-saas/pg2024041817493912440/cms/image/f706669d-10d6-49f5-8acb-1ea80bcc7315.jpg',
			'content' => '<p style="font-size:16px; font-weight:600; color:#1e293b;">常州创联电源科技股份有限公司严正声明：</p><p>近期，我司发现个别竞争对手及自媒体主体在网络平台上散布涉及创联电源的虚假信息与不实言论，严重中伤我司商业信誉与品牌形象。</p><h2>一、事实澄清与说明</h2><p>常州创联电源科技股份有限公司生产经营一切正常，资金链健康稳健，所有出厂产品均严格按照国家及国际安规标准检测合格，品质有保障。</p><h2>二、法律维权声明</h2><p>对于任何恶意捏造事实、散布谣言、侵害我司名誉权的行为，我司已委托专业律师团队完成公证取证，并将坚决通过法律途径追究相关责任人的法律责任，绝不姑息！特此声明！</p><p style="text-align:right; margin-top:30px;"><strong>常州创联电源科技股份有限公司</strong></p>',
		),
		array(
			'title'   => '喜封金顶！创联电源高端智能电源产业化项目主体结构顺利封顶',
			'date'    => '2023-11-30 00:00:00',
			'image'   => 'https://omo-oss-image.thefastimg.com/portal-saas/pg2024041817493912440/cms/image/62ee9a04-a4d9-4426-ae59-02ceea83d2f3.png',
			'content' => '<p>11月30日，由飞凤建设承建的<strong>“创联电源·高端智能电源产业化项目”</strong>新建厂房大楼封顶仪式隆重举行！随着最后一斗混凝土浇筑到位，项目主体结构顺利实现全面封顶，标志着项目建设取得了决定性的阶段胜利！</p><h2>一、打造国际一流的智能电源产业中心</h2><p>常州创联电源科技股份有限公司新建高端智能电源产业化项目，总建筑面积达54857.8平方米。项目计划建设多条全自动智能化生产线、柔性智能生产线、SMT贴片生产线及AI自动插件线，并引入创联智能仓储系统（CTU）与制造信息化系统。</p><h2>二、实力铸就行业前沿研发基地</h2><p>创联电源始创于2000年3月，是集研发、制造、销售与服务于一体的国家级专精特新“小巨人”企业及高新技术企业。公司在常州与深圳两地拥有强大的研发团队，并设立了博士后科研工作站，瞄准全球开关电源前沿技术。</p><h2>三、全系产品服务全球50多个国家</h2><p>公司产品涵盖LED显示屏电源、工业控制电源及照明电源三大系列2000多个标准型号。产品远销欧美、非洲、拉美、中东、东南亚等50多个国家和地区，年产销量突破2000万台，深受全球客户青睐！</p>',
		),
		array(
			'title'   => '龙腾盛世·共赢未来 | 创联2024新春年会暨2023年度表彰盛典圆满落幕',
			'date'    => '2024-01-31 00:00:00',
			'image'   => 'https://omo-oss-image.thefastimg.com/portal-saas/pg2024041817493912440/cms/image/30d2d4b9-4b18-48fc-b648-d6c33e90d6b0.png',
			'content' => '<p>2024年1月31日，常州创联电源科技股份有限公司“2024新春年会暨2023年度表彰盛典”在常州隆重举行。来自全国各地的创联员工与合作伙伴欢聚一堂，辞旧迎新！</p><h2>一、回顾2023，业绩再创新高</h2><p>总结大会上，公司高管总结汇报了2023年在智能化改造、新产品研发及海外市场开拓方面取得的丰硕成果。面对复杂多变的市场环境，创联电源实现了逆势增长。</p><h2>二、重奖优秀团队与杰出员工</h2><p>盛典隆重颁发了“最佳销售奖”、“技术创新突破奖”、“卓越团队奖”及“优秀员工奖”，表彰他们在各自岗位上的卓越贡献与奉献精神。</p><h2>三、龙腾虎跃，共赴辉煌新篇</h2><p>欢声笑语，龙腾盛世。新的一年，创联人将以更加饱满的热情和拼搏姿态，携手共进，共创企业更加灿烂美好的明天！</p>',
		),
	);

	$imported_count = 0;
	foreach ( $articles as $art ) {
		$existing = get_page_by_title( $art['title'], OBJECT, 'post' );
		$full_content = '<p style="text-align:center; margin-bottom:25px;"><img src="' . esc_url( $art['image'] ) . '" alt="' . esc_attr( $art['title'] ) . '" style="max-width:100%; height:auto; border-radius:8px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);" /></p>' . $art['content'];

		if ( $existing ) {
			wp_update_post( array(
				'ID'           => $existing->ID,
				'post_title'   => $art['title'],
				'post_content' => $full_content,
				'post_date'    => $art['date'],
			) );
			$imported_count++;
		} else {
			$post_id = wp_insert_post( array(
				'post_title'   => $art['title'],
				'post_content' => $full_content,
				'post_status'  => 'publish',
				'post_type'    => 'post',
				'post_date'    => $art['date'],
			) );
			if ( $post_id && ! is_wp_error( $post_id ) ) {
				$imported_count++;
			}
		}
	}

	return $imported_count;
}

// Handle 1-click trigger via Admin URL action
add_action( 'admin_init', function() {
	if ( isset( $_GET['haitaik_import_articles'] ) && current_user_can( 'manage_options' ) ) {
		$count = haitaik_import_csv_articles();
		wp_safe_redirect( admin_url( 'edit.php?articles_imported=' . $count ) );
		exit;
	}
} );

// Display Admin Notice banner with 1-click Fill Articles button
add_action( 'admin_notices', function() {
	if ( isset( $_GET['articles_imported'] ) ) {
		$count = intval( $_GET['articles_imported'] );
		echo '<div class="notice notice-success is-dismissible"><p><strong>Haitaik Importer:</strong> 成功导入/填充 ' . $count . ' 篇新闻文章！ (Successfully imported ' . $count . ' articles!)</p></div>';
	} else {
		$import_url = esc_url( admin_url( 'edit.php?haitaik_import_articles=1' ) );
		echo '<div class="notice notice-warning is-dismissible"><p><strong>Haitaik Importer:</strong> 包含已抓取新闻文章数据。点击一键将文章填充入数据库: <a href="' . $import_url . '" class="button button-primary" style="margin-left: 10px; background: #e40011; border-color: #c8000f;">📥 一键填充新闻文章 (Fill Articles)</a></p></div>';
	}
} );





