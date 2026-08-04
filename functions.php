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
 */
function twentytwentyfive_enqueue_cloned_assets() {
	$is_product_page = is_page( array( 22, 23, 24, 25, 26 ) );
	$is_about_page   = is_page( array( 18, 19, 20, 21 ) );
	$is_faq_page     = is_page( 27 );
	$is_contact_page = is_page( 29 );
	$is_single_product = is_singular( 'product' );

	if ( is_front_page() || $is_product_page || $is_about_page || $is_faq_page || $is_contact_page || $is_single_product || is_404() ) {
		// Global Stylesheets
		wp_enqueue_style(
			'haitaik-bootstrap-global',
			home_url( '/npublic/libs/css/ceccbootstrap-global.css' ),
			array(),
			null
		);
		wp_enqueue_style(
			'haitaik-site',
			home_url( '/css/site.css' ),
			array(),
			null
		);

		// Page-Specific Stylesheets
		if ( is_front_page() ) {
			wp_enqueue_style(
				'haitaik-home-specific',
				home_url( '/css/Home_7b9a32a9a2a77e5f5e09085c43c3ae42.min.css' ),
				array(),
				null
			);
		} elseif ( $is_product_page ) {
			wp_enqueue_style(
				'haitaik-product-specific',
				home_url( '/css/pro_list1.css' ),
				array(),
				null
			);
		} elseif ( $is_about_page ) {
			wp_enqueue_style(
				'haitaik-about-specific',
				home_url( '/css/about.css' ),
				array(),
				null
			);
		} elseif ( $is_faq_page ) {
			wp_enqueue_style(
				'haitaik-faq-specific',
				home_url( '/css/faq.css' ),
				array(),
				null
			);
		} elseif ( $is_contact_page ) {
			wp_enqueue_style(
				'haitaik-contact-specific',
				home_url( '/css/contactus.css' ),
				array(),
				null
			);
		} elseif ( $is_single_product ) {
			wp_enqueue_style(
				'haitaik-single-product-specific',
				home_url( '/css/singleproduct.css' ),
				array(),
				null
			);
		}


		// Scripts
		wp_enqueue_script(
			'haitaik-core-js',
			home_url( '/npublic/libs/core/ceccjquery-libs.js' ),
			array(),
			null,
			true
		);
		wp_enqueue_script(
			'haitaik-common-js',
			home_url( '/npublic/commonjs/common.min.js' ),
			array(),
			null,
			true
		);
		wp_enqueue_script(
			'haitaik-c0ac6a6647ce41aca3955968ca1f9a50',
			home_url( '/upload/js/c0ac6a6647ce41aca3955968ca1f9a50.js' ),
			array(),
			null,
			true
		);
		wp_enqueue_script(
			'haitaik-3b40c5321d4a424a8951ae1ecddfaac5',
			home_url( '/upload/js/3b40c5321d4a424a8951ae1ecddfaac5.js' ),
			array(),
			null,
			true
		);
		wp_enqueue_script(
			'haitaik-d1fd3c1642ba450fb712d2542fad9bca',
			home_url( '/upload/js/d1fd3c1642ba450fb712d2542fad9bca.js' ),
			array(),
			null,
			true
		);
	}
}
add_action( 'wp_enqueue_scripts', 'twentytwentyfive_enqueue_cloned_assets', 20 );

