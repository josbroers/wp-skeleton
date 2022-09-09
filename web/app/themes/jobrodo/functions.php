<?php

use Jobrodo\Theme\Functions\Actions;
use Jobrodo\Theme\Functions\Enqueue;
use Jobrodo\Theme\Functions\Filters;
use Jobrodo\Theme\Functions\Nav;
use Jobrodo\Theme\Functions\Theme;
use Jobrodo\Theme\Functions\Acf;
use Jobrodo\Theme\Lib\Assets;


// Theme
( new Theme() )->add_support( 'title-tag' )
               ->add_support( 'post-thumbnails' )
               ->add_support( 'html5', [
	               'caption',
	               'comment-form',
	               'comment-list',
	               'gallery',
	               'search-form',
	               'script',
	               'style',
               ] )
               ->remove_support( 'widgets-block-editor' )
               ->load_text_domain( 'jobrodo-theme', get_template_directory() . '/languages' )
               ->add_editor_style( ( new Assets() )->asset_path( '/styles/app.css' ) );


// Navigation
( new Nav() )->register_menus( [
	'primary_navigation' => __( 'Primary navigation', 'jobrodo-theme' ),
] );


// Enqueue
( new Enqueue() )->add_style( 'app_css', ( new Assets() )->asset_path( '/styles/app.css' ) )
                 ->add_script( 'app_js', ( new Assets() )->asset_path( '/scripts/app.js' ) );


// Filters
( new Filters() )->body_class()
                 ->excerpt_more()
                 ->upload_mimes( 'image/svg+xml' )
                 ->check_filetype_and_ext( 'image/svg+xml', 'svg' )
                 ->post_args_settings()
                 ->tax_args_settings();

// Actions
( new Actions() )->disable_all_feeds()
                 ->unregister_sidebar( 'sidebar-1' )
                 ->unregister_sidebar( 'header-1' )
                 ->unregister_sidebar( 'footer-4' )
                 ->unregister_tax_for_obj( 'category' )
                 ->unregister_tax_for_obj( 'post_tag' )
                 ->redirect_post_to_admin()
                 ->remove_menu_page( 'edit-comments.php' )
                 ->remove_menu_page( 'edit.php' )
                 ->remove_post_type_support( 'page', 'editor' );


// ACF
( new Acf() )->require_acf()
             ->disable_edit_for_non_dev()
             ->add_options_page();