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

	// Always enqueue global stylesheets on all frontend page views
	wp_enqueue_style(
		'haitaik-bootstrap-global',
		$theme_uri . '/assets/npublic/libs/css/ceccbootstrap-global.css',
		array(),
		null
	);
	wp_enqueue_style(
		'haitaik-home-main',
		$theme_uri . '/assets/css/Home_7b9a32a9a2a77e5f5e09085c43c3ae42.min.css',
		array(),
		null
	);
	wp_enqueue_style(
		'haitaik-site',
		$theme_uri . '/assets/css/site.css',
		array(),
		null
	);

	// Always enqueue global scripts on all frontend page views
	wp_enqueue_script(
		'haitaik-core-js',
		$theme_uri . '/assets/npublic/libs/core/ceccjquery-libs.js',
		array(),
		null,
		true
	);
	wp_enqueue_script(
		'haitaik-common-js',
		$theme_uri . '/assets/npublic/commonjs/common.min.js',
		array(),
		null,
		true
	);
	wp_enqueue_script(
		'haitaik-c0ac6a6647ce41aca3955968ca1f9a50',
		$theme_uri . '/assets/upload/js/c0ac6a6647ce41aca3955968ca1f9a50.js',
		array(),
		null,
		true
	);
	wp_enqueue_script(
		'haitaik-3b40c5321d4a424a8951ae1ecddfaac5',
		$theme_uri . '/assets/upload/js/3b40c5321d4a424a8951ae1ecddfaac5.js',
		array(),
		null,
		true
	);
	wp_enqueue_script(
		'haitaik-d1fd3c1642ba450fb712d2542fad9bca',
		$theme_uri . '/assets/upload/js/d1fd3c1642ba450fb712d2542fad9bca.js',
		array(),
		null,
		true
	);

	// Page-Specific Stylesheets loaded conditionally
	// Page-Specific Stylesheets loaded conditionally by Slug, Template Name, or Post Type
	if ( is_front_page() || is_page( array( 'home', 17 ) ) ) {
		wp_enqueue_style(
			'haitaik-home-specific',
			$theme_uri . '/assets/css/Home_7b9a32a9a2a77e5f5e09085c43c3ae42.min.css',
			array(),
			null
		);
	} elseif ( is_page( array( 'about-us', 'about', 'company-profile', 18, 19, 20, 21 ) ) || is_page_template( 'page-about-us.php' ) ) {
		wp_enqueue_style(
			'haitaik-about-specific',
			$theme_uri . '/assets/css/about.css',
			array(),
			null
		);
	} elseif ( is_page( array( 'faq', 27 ) ) || is_page_template( 'page-faq.php' ) ) {
		wp_enqueue_style(
			'haitaik-faq-specific',
			$theme_uri . '/assets/css/faq.css',
			array(),
			null
		);
	} elseif ( is_page( array( 'contact-us', 'contact', 29 ) ) || is_page_template( 'page-contact-us.php' ) ) {
		wp_enqueue_style(
			'haitaik-contact-specific',
			$theme_uri . '/assets/css/contactus.css',
			array(),
			null
		);
	} elseif ( is_page( array( 'led-display-power', 'product-info', 'industrial-control-power', 'led-lighting-power', 'din-rail-power', 22, 23, 24, 25, 26 ) ) || is_page_template( 'page-product-list.php' ) ) {
		wp_enqueue_style(
			'haitaik-product-specific',
			$theme_uri . '/assets/css/pro_list1.css',
			array(),
			null
		);
	} elseif ( is_singular( 'product' ) ) {
		wp_enqueue_style(
			'haitaik-single-product-specific',
			$theme_uri . '/assets/css/singleproduct.css',
			array(),
			null
		);
	} elseif ( is_home() || is_page( array( 'news', 'post', 'posts' ) ) || is_page_template( 'home.php' ) || is_page_template( 'page-news.php' ) ) {
		wp_enqueue_style(
			'haitaik-news-specific',
			$theme_uri . '/assets/css/pro_list1.css',
			array(),
			null
		);
	} elseif ( is_single() ) {
		wp_enqueue_style(
			'haitaik-single-post-specific',
			$theme_uri . '/assets/css/singleproduct.css',
			array(),
			null
		);
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

	if ( is_front_page() || is_page( 17 ) ) {
		$file = get_template_directory() . '/front-page.php';
		if ( file_exists( $file ) ) return $file;
	} elseif ( is_page( array( 'about-us', 'about', 'company-profile', 18, 19, 20, 21 ) ) ) {
		$file = get_template_directory() . '/page-about-us.php';
		if ( file_exists( $file ) ) return $file;
	} elseif ( is_page( array( 'faq', 27 ) ) ) {
		$file = get_template_directory() . '/page-faq.php';
		if ( file_exists( $file ) ) return $file;
	} elseif ( is_page( array( 'contact-us', 'contact', 29 ) ) ) {
		$file = get_template_directory() . '/page-contact-us.php';
		if ( file_exists( $file ) ) return $file;
	} elseif ( is_page( array( 'led-display-power', 'product-info', 'industrial-control-power', 'led-lighting-power', 'din-rail-power', 22, 23, 24, 25, 26 ) ) ) {
		$file = get_template_directory() . '/page-product-list.php';
		if ( file_exists( $file ) ) return $file;
	} elseif ( is_home() || is_page( array( 'news', 'post', 'posts' ) ) ) {
		$file = get_template_directory() . '/home.php';
		if ( file_exists( $file ) ) return $file;
	} elseif ( is_single() && ! is_singular( 'product' ) ) {
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




