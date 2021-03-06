<?

////
defined( 'ABSPATH' ) or die();

if ( ! class_exists( 'ayo_AdminPostNavigation' ) ) :

class ayo_AdminPostNavigation {

	private static $prev_text = '';
	private static $next_text = '';
	private static $post_statuses     = array( 'draft', 'future', 'pending', 'private', 'publish', 'pins_featured' ); // Filterable later
	private static $post_statuses_sql = '';

	/**
	 * Returns version of the plugin.
	 *
	 * @since 1.7
	 */
	public static function version() {
		return '1.9.2';
	}

	/**
	 * Class constructor: initializes class variables and adds actions and filters.
	 */
	public static function init() {
		add_action( 'load-post.php', array( __CLASS__, 'register_post_page_hooks' ) );
	}

	/**
	 * Filters/actions to hook on the admin post.php page.
	 *
	 * @since 1.7
	 */
	public static function register_post_page_hooks() {

		// Load textdomain.
	//	load_plugin_textdomain( 'admin-post-navigation', false, basename( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR . 'lang' );

		// Set translatable strings.
		global $ayo_options;
		 if ($ayo_options['menu_post_nav'] == true) {
		self::$prev_text = apply_filters( 'ayo_admin_post_navigation_prev_text', __( '&larr; ', 'admin-post-navigation' ) );
		self::$next_text = apply_filters( 'ayo_admin_post_navigation_next_text', __( ' &rarr;', 'admin-post-navigation' ) );

		// Register hooks.
		add_action( 'admin_enqueue_scripts',      array( __CLASS__, 'add_css' ) );
		add_action( 'admin_print_footer_scripts', array( __CLASS__, 'add_js' ) );
		add_action( 'do_meta_boxes',              array( __CLASS__, 'do_meta_box' ), 10, 3 );
	}
}
	/**
	 * Register meta box.
	 *
	 * By default, the navigation is present for all post types. Filter
	 * 'ayo_admin_post_navigation_post_types' to limit its use.
	 *
	 * @param string  $post_type The post type.
	 * @param string  $type      The mode for the meta box (normal, advanced, or side).
	 * @param WP_Post $post      The post.
	 */
	public static function do_meta_box( $post_type, $type, $post ) {
		$post_types = apply_filters( 'ayo_admin_post_navigation_post_types', get_post_types() );
		if ( ! in_array( $post_type, $post_types ) ) {
			return;
		}

		$post_statuses = (array) apply_filters( 'ayo_admin_post_navigation_post_statuses', self::$post_statuses, $post_type, $post );
		if ( $post_statuses ) {
			foreach( $post_statuses as $i => $v ) { $GLOBALS['wpdb']->escape_by_ref( $v ); $post_statuses[ $i ] = $v; }
			self::$post_statuses_sql = "'" . implode( "', '", $post_statuses ) . "'";
		}

		if ( in_array( $post->post_status, $post_statuses ) ) {
			add_meta_box(
				'adminpostnav',
				sprintf( __( '%s Navigation', 'admin-post-navigation' ), ucfirst( $post_type ) ),
				array( __CLASS__, 'add_meta_box' ),
				$post_type,
				'side',
				'core'
			);
		}
	}

	/**
	 * Adds the content for the post navigation meta_box.
	 *
	 * @param object $object
	 * @param array  $box
	 */
	public static function add_meta_box( $object, $box ) {
		$display = '';

		$context = self::_get_post_type_label( $object->post_type );

		$prev = self::previous_post();
		if ( $prev ) {
			$post_title = strip_tags( get_the_title( $prev->ID ) );
			$display .= '<a href="' . get_edit_post_link( $prev->ID ) . '" id="admin-post-nav-prev" title="' .
				esc_attr( sprintf( __( 'Previous %1$s: %2$s', 'admin-post-navigation' ), $context, $post_title ) ) .
				'" class="admin-post-nav-prev add-new-h2">' . self::$prev_text . '</a>';
		}

		$next = self::next_post();
		if ( $next ) {
			if ( ! empty( $display ) ) {
				$display .= ' ';
			}
			$post_title = strip_tags( get_the_title( $next->ID ) );
			$display .= '<a href="' . get_edit_post_link( $next->ID ) .
				'" id="admin-post-nav-next" title="' .
				esc_attr( sprintf( __( 'Next %1$s: %2$s', 'admin-post-navigation' ), $context, $post_title ) ).
				'" class="admin-post-nav-next add-new-h2">' . self::$next_text . '</a>';
		}

		$display = '<span id="admin-post-nav">' . $display . '</span>';
		$display = apply_filters( 'admin_post_nav', $display );
		echo apply_filters( 'ayo_admin_post_navigation_display', $display );
	}

	/**
	 * Gets label for post type.
	 *
	 * @since 1.7
	 *
	 * @param string  $post_type The post_type.
	 * @return string The label for the post_type.
	 */
	public static function _get_post_type_label( $post_type ) {
		$label = $post_type;
		$post_type_object = get_post_type_object( $label );
		if ( is_object( $post_type_object ) ) {
			$label = $post_type_object->labels->singular_name;
		}

		return strtolower( $label );
	}

	/**
	 * Outputs CSS within style tags.
	 */
	public static function add_css() {
	/// css code aici
	}

	/**
	 * Outputs the JavaScript used by the plugin.
	 *
	 */
	public static function add_js() {
		$tag = version_compare( $GLOBALS['wp_version'], '4.3', '>=' ) ? 'h1' : 'h2';

		echo <<<JS
		<script type="text/javascript">
		jQuery(document).ready(function($) {
			$('#admin-post-nav').appendTo($('#wpbody-content .wrap:first {$tag}:first'));
			$('#adminpostnav, label[for="adminpostnav-hide"]').hide();
		});
		</script>

JS;
	}

	/**
	 * Returns the previous or next post relative to the current post.
	 *
	 * @param string $type   Optional. Either '<' or '>', indicating previous or next post, respectively. Default '<'.
	 * @param int    $offset Optional. Offset. Primarily for internal, self-referencial use. Default 0.
	 * @param int    $limit  Optional. Number of posts to get in the query. Not just the next post because a few might
	 *                       need to be traversed to find a post the user has the capability to edit. Default 15.
	 * @return WP_Post|false
	 */
	public static function query( $type = '<', $offset = 0, $limit = 15 ) {
		global $post_ID, $wpdb;

		if ( $type != '<' ) {
			$type = '>';
		}
		$offset = (int) $offset;
		$limit  = (int) $limit;

		$post = get_post( $post_ID );

		if ( ! $post || ! self::$post_statuses_sql ) {
			return false;
		}

		$post_type = esc_sql( get_post_type( $post_ID ) );

		$sql = "SELECT ID, post_title FROM $wpdb->posts WHERE post_type = '$post_type' AND post_status IN (" . self::$post_statuses_sql . ') ';

		// Determina ordinea
		if ( function_exists( 'is_post_type_hierarchical' ) && is_post_type_hierarchical( $post_type ) ) {
			$orderby = 'post_title';
		} else {
			$orderby = 'ID';
		}
		$default_orderby = $orderby;
		// Restrict orderby
		$orderby = esc_sql( apply_filters( 'ayo_admin_post_navigation_orderby', $orderby, $post_type ) );
		if ( ! in_array( $orderby, array( 'comment_count', 'ID', 'menu_order', 'post_author', 'post_content', 'post_content_filtered', 'post_date', 'post_excerpt', 'post_date_gmt', 'post_mime_type', 'post_modified', 'post_modified_gmt', 'post_name', 'post_parent', 'post_status', 'post_title', 'post_type' ) ) ) {
			$orderby = $default_orderby;
		}

		$sql .= "AND {$orderby} {$type} '{$post->$orderby}' ";

		$sort = $type == '<' ? 'DESC' : 'ASC';
		$sql .= "ORDER BY {$orderby} {$sort} LIMIT {$offset}, {$limit}";

		// primul post editbil
		$posts = $wpdb->get_results( $sql );
		$result = false;
		if ( $posts ) {
			foreach ( $posts as $post ) {
				if ( current_user_can( 'edit_post', $post->ID ) ) {
					$result = $post;
					break;
				}
			}
			if ( ! $result ) { // The fetch did not yield a post editable by user, so query again.
				$offset += $limit;
				// Double the limit each time (if haven't found a post yet, chances are we may not, so try to get through posts quicker).
				$limit += $limit;
				return self::query( $type, $offset, $limit );
			}
		}
		return $result;
	}

	/**
	 * Returns the next post relative to the current post.
	 *

	 *
	 * @return object The next post object.
	 */
	public static function next_post() {
		return self::query( '>' );
	}

	/**
	 	 * @return object The previous post object.
	 */
	public static function previous_post() {
		return self::query( '<' );
	}

} // end ayo_AdminPostNavigation

ayo_AdminPostNavigation::init();

endif; // end if !class_exists()
