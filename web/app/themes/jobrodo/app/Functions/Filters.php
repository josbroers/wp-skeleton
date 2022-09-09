<?php

namespace Jobrodo\Theme\Functions;

class Filters {

	/**
	 * Displays the class names for the body element.
	 * @link https://developer.wordpress.org/reference/functions/body_class/
	 *
	 * @return $this
	 */
	public function body_class(): static {
		add_filter( 'body_class', function ( array $classes ): array {
			// Add page slug if it doesn't exist
			if ( is_single() || ( is_page() && ! is_front_page() ) ) {
				if ( ! in_array( basename( get_permalink() ), $classes, true ) ) {
					$classes[] = basename( get_permalink() );
				}
			}

			return $classes;
		} );

		return $this;
	}

	/**
	 * Filters the string in the “more” link displayed after a trimmed excerpt.
	 * @link https://developer.wordpress.org/reference/hooks/excerpt_more/
	 *
	 * @return $this
	 */
	public function excerpt_more(): static {
		add_filter( 'excerpt_more', function (): string {
			return wp_sprintf(
				' &hellip; <a href="%s">%s</a>', get_permalink(),
				__( 'Continued', 'jobrodo-theme' )
			);
		} );

		return $this;
	}

	/**
	 * Filters list of allowed mime types and file extensions.
	 * @link https://developer.wordpress.org/reference/hooks/upload_mimes/
	 *
	 * @param string $mime_type
	 *
	 * @return $this
	 */
	public function upload_mimes( string $mime_type ): static {
		add_filter( 'upload_mimes', function ( $mime_types ) use ( $mime_type ): array {
			$mime_types['svg'] = $mime_type;

			return $mime_types;
		} );

		return $this;
	}

	/**
	 * Attempt to determine the real file type of a file.
	 * @link https://developer.wordpress.org/reference/functions/wp_check_filetype_and_ext/
	 *
	 * @param string $type
	 * @param string $ext
	 *
	 * @return $this
	 */
	public function check_filetype_and_ext( string $type, string $ext ): static {
		add_filter( 'wp_check_filetype_and_ext', function ( $types, $file, $filename ) use ( $type, $ext ): array {
			if ( str_contains( $filename, ".{$ext}" ) ) {
				$types['ext']  = $ext;
				$types['type'] = $type;
			}

			return $types;
		}, 10, 3 );

		return $this;
	}

	/**
	 * Filter settings for post type: post.
	 *
	 * @return $this
	 */
	public function post_args_settings(): static {
		add_filter( 'register_post_type_args', function ( $args, $post_type ): array {
			if ( $post_type === 'post' ) {
				$args['public']              = false;
				$args['show_ui']             = false;
				$args['show_in_menu']        = false;
				$args['show_in_admin_bar']   = false;
				$args['show_in_nav_menus']   = false;
				$args['can_export']          = false;
				$args['has_archive']         = false;
				$args['exclude_from_search'] = true;
				$args['publicly_queryable']  = false;
				$args['show_in_rest']        = false;
			}

			return $args;
		}, 10, 2 );

		return $this;
	}

	/**
	 * Filter settings for taxonomy: category and post_tag.
	 *
	 * @return $this
	 */
	public function tax_args_settings(): static {
		add_filter( 'register_post_type_args', function ( $args, $taxonomy ): array {
			if ( in_array( $taxonomy, [ 'category', 'post_tag' ], true ) ) {
				$args['rewrite']           = false;
				$args['public']            = false;
				$args['show_in_rest']      = false;
				$args['show_ui']           = false;
				$args['show_admin_column'] = false;
			}

			return $args;
		}, 10, 2 );

		return $this;
	}


}