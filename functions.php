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
	$csv_file = get_template_directory() . '/inc/haitaik-com-2026-08-04-2.csv';
	if ( ! file_exists( $csv_file ) ) {
		return 0;
	}

	$handle = fopen( $csv_file, 'r' );
	if ( ! $handle ) {
		return 0;
	}

	$header = fgetcsv( $handle );
	if ( ! $header ) {
		fclose( $handle );
		return 0;
	}

	// Remove UTF-8 BOM if present
	$header[0] = preg_replace( '/\x{EF}\x{BB}\x{BF}/', '', $header[0] );
	$header = array_map( 'trim', $header );

	$imported_count = 0;
	$imported_titles = array();

	while ( ( $row = fgetcsv( $handle ) ) !== false ) {
		if ( count( $row ) < count( $header ) ) {
			continue;
		}

		$item = array_combine( array_slice( $header, 0, count( $row ) ), $row );

		// Extract Title
		$title = ! empty( $item['item_page_title'] ) ? $item['item_page_title'] : ( ! empty( $item['title_1'] ) ? $item['title_1'] : $item['title'] );
		$title = trim( $title );

		if ( empty( $title ) || $title === '/' || in_array( $title, $imported_titles, true ) ) {
			continue;
		}

		// Check if post already exists in DB
		$existing = get_page_by_title( $title, OBJECT, 'post' );
		if ( $existing ) {
			$imported_titles[] = $title;
			continue;
		}

		// Extract Content
		$content = ! empty( $item['data_2'] ) ? $item['data_2'] : ( ! empty( $item['project_description'] ) ? $item['project_description'] : $item['data'] );
		$content = trim( $content );

		// Format text into HTML paragraphs if raw text
		if ( ! empty( $content ) && false === strpos( $content, '<p>' ) ) {
			$paragraphs = array_filter( array_map( 'trim', explode( "\n", $content ) ) );
			$content = '<p>' . implode( '</p><p>', $paragraphs ) . '</p>';
		}

		// Extract Image URL
		$image_url = ! empty( $item['image'] ) ? $item['image'] : ( ! empty( $item['image_1'] ) ? $item['image_1'] : '' );
		if ( ! empty( $image_url ) && false === strpos( $content, $image_url ) ) {
			$content = '<p style="text-align:center;"><img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( $title ) . '" style="max-width:100%; height:auto; border-radius:6px; margin-bottom:20px;" /></p>' . $content;
		}

		// Parse Date
		$post_date = current_time( 'mysql' );
		if ( ! empty( $item['data_1'] ) ) {
			$timestamp = strtotime( $item['data_1'] );
			if ( $timestamp ) {
				$post_date = date( 'Y-m-d H:i:s', $timestamp );
			}
		}

		// Insert post
		$post_data = array(
			'post_title'   => $title,
			'post_content' => $content,
			'post_status'  => 'publish',
			'post_type'    => 'post',
			'post_date'    => $post_date,
		);

		$post_id = wp_insert_post( $post_data );

		if ( $post_id && ! is_wp_error( $post_id ) ) {
			$imported_count++;
			$imported_titles[] = $title;
		}
	}

	fclose( $handle );
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





