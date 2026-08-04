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
	$is_product_page   = is_page( array( 22, 23, 24, 25, 26 ) );
	$is_about_page     = is_page( array( 18, 19, 20, 21 ) );
	$is_faq_page       = is_page( 27 );
	$is_contact_page   = is_page( 29 );
	$is_single_product = is_singular( 'product' );

	if ( is_front_page() || is_page( 17 ) ) {
		wp_enqueue_style(
			'haitaik-home-specific',
			$theme_uri . '/assets/css/Home_7b9a32a9a2a77e5f5e09085c43c3ae42.min.css',
			array(),
			null
		);
	} elseif ( $is_product_page ) {
		wp_enqueue_style(
			'haitaik-product-specific',
			$theme_uri . '/assets/css/pro_list1.css',
			array(),
			null
		);
	} elseif ( $is_about_page ) {
		wp_enqueue_style(
			'haitaik-about-specific',
			$theme_uri . '/assets/css/about.css',
			array(),
			null
		);
	} elseif ( $is_faq_page ) {
		wp_enqueue_style(
			'haitaik-faq-specific',
			$theme_uri . '/assets/css/faq.css',
			array(),
			null
		);
	} elseif ( $is_contact_page ) {
		wp_enqueue_style(
			'haitaik-contact-specific',
			$theme_uri . '/assets/css/contactus.css',
			array(),
			null
		);
	} elseif ( $is_single_product ) {
		wp_enqueue_style(
			'haitaik-single-product-specific',
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


