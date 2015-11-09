<?php
global $ayo_options;
// Limit the  dashboard pin titles
function the_titlesmall($before = '', $after = '', $echo = true, $length = false) { $title = get_the_title();
	if ( $length && is_numeric($length) )
	 {
		$title = substr( $title, 0, $length );
	};

	if ( strlen($title)> 0 ) {
		$title = apply_filters('the_titlesmall', $before . $title . $after, $before, $after);
		if ( $echo ) {
			echo $title;
		}
		else
			return $title;
			//echo "...";

	};
	if ( strlen($title)> 10 ) {
		$title = apply_filters('the_titlesmall2', $before . $title . $after, $before, $after);
		if ( $echo ) {
			//echo $title;
			echo "...";
			}
		else
		//	return $title;
			echo "...";

	}
}
/////////////////////////
function prn_wp_insert_post_function($url)
{
	if(isset($_POST['prn_redirect']) AND $_POST['prn_redirect']=='yes')
	{
	//	wp_redirect(admin_url('post-new.php?post_type='.$_POST['prn_redirect_post_type']));
	$post_type = ((isset($_GET['post_type']) && $_GET['post_type'] != "") ? $_GET['post_type'] : 'post');
	$count = $this->total_featured($post_type);
	$class = $_GET['post_status'] == 'pin_featured' ? "current" : '';
	$views['pin_featured'] = "<a class=\"" . $class . "\" id=\"featured-post-filter\" href=\"edit.php?&post_status=pin_featured&post_type={$post_type}\">Pins <span class=\"count\">({$count})</span></a>";
	return $views;
	//
		die();
	}
	elseif(isset($_POST['prn_redirect']) AND $_POST['prn_redirect']=='visit')
	{
		wp_redirect(get_permalink($_POST['post_ID']));
		die();
	}
	return $url;

		die();
	}

/////////////////////////////////////////////////////////////

function ayo_pinsdash_welcome() {
//  http://www.drewgreenwell.com/projects/metrojs#fiddleAround

?>

<!---->
<script type="text/javascript">
	/* Hide default welcome message */
	jQuery(document).ready( function($)
	{
			//	$('div.welcome-panel-content').hide();
	});
</script>
<!---->
	<div class="custom-welcome-panel-content">
<!---->
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
<br><br>
  <script>
/////////////// highlight pin-uri
  $(function() {
  //  $( "#sortable" ).sortable();
//	$('#sortable').sortable().bind('sortupdate', function() {
    //Triggered when the user stopped sorting and the DOM position has changed.
});
//    $( "#sortable" ).disableSelection();
  //  $( "#sortable" ).sortable({  placeholder: "ui-state-highlight"});
//$( "#sortable" ).draggable({ cursor: "crosshair", cursorAt: { top: 56, left: 56 } });


////////////////////////////////////
$('#btn_pindel').click(function() {
  // removes all LI with class="cls" in OL
  $('ul li.ui-state-default').remove();
});


  });

  addAnother = function() {
      var ul = this.document.getElementById("sortable");
      var li = this.document.createElement("li")//.show( "fold", 1000 );
      var children = ul.children.length + 1
      li.setAttribute("id", "ui-state-default"+children);//.show( "fold", 1000 );
      li.appendChild(document.createTextNode("Pin "+ children));// + document.innerHTML(<a href="link/to/trash/script/when/we/have/js/off" title="Delete this image" class="ui-icon ui-icon-trash">Delete image</a>));
      ul.appendChild(li)
  }

  </script>
</head>
<body>

<ul id="sortable">
<?

///////////// show pinned products
$args = array(
	'post_type'      => 'product',
	'post_status'    => 'pin_featured',
	'orderby'        => 'date',
	'order'          => 'DESC',
	'meta_query' => array(
			array(
					'key' => '_is_featured',
					'value' => 'yes'
			)
	) ,
	'posts_per_page' => 30

                        );

$my_query = new WP_Query( $args );
if ( $my_query->have_posts() ) {

	while ( $my_query->have_posts() ) {
		$my_query->the_post();

echo "<li class='ui-state-default'> ";
	//// <li class="ui-state-default">Pin-4</li>
    echo "<div class='btn_pin_status'>PRODUCT</div>";
	//  echo "<div class='btn_pin_title'>" . the_titlesmall('', '...', true, '20')  . '<br /></div>';
?><div class='btn_pin_title'><? the_titlesmall('', '', true, '20') ?> <br></div><?
		echo"<div class='btn_pin_all'><div class='btn_pin_edit'><a href='/wp-admin/post.php?post=" . get_the_ID() . "&action=edit'><img src='" . plugin_dir_url( dirname( __FILE__ ) ) . 'img/edit.png'  . "'></div>";
		echo "</a><br>";
		echo"<div class='btn_pin_view'><a href=\"" . get_permalink() . "\"><img src='" . plugin_dir_url( dirname( __FILE__ ) ) . 'img/view.png'  . "'></a></div>";

		echo "</div></li>";

	}

};
wp_reset_postdata();

///////////// show pinned posts

if ( $new_status !== 'trash' ) {
			// Do something when post is deleted
			$args = array(
				'post_type'      => 'post',
				'post_status'    => 'pin_featured',
				'orderby'        => 'date',
				'order'          => 'DESC',
				'meta_query' => array(
						array(
								'key' => '_is_featured',
								'value' => 'no'
						)
				) ,
				'posts_per_page' => 30

			                        );

			$my_query = new WP_Query( $args );
 }
///////////////////////////////////
$args = array(
	'post_type'      => 'post',
	'post_status'    => 'pin_featured',
	'orderby'        => 'date',
	'order'          => 'DESC',
	'meta_query' => array(
			array(
					'key' => '_is_featured',
					'value' => 'yes'
			)
	) ,
	'posts_per_page' => 30

                        );

$my_query = new WP_Query( $args );
if ( $my_query->have_posts() ) {

	while ( $my_query->have_posts() ) {
		$my_query->the_post();

echo "<li class='ui-state-default'> ";
	//// <li class="ui-state-default">Pin-4</li>
		echo "<div class='btn_pin_status'>POST   <a href='#'>XXX</a></div>";
	//	echo "<div class='btn_pin_title'>". the_titlesmall('', '', true, '20') . '<br /></div>';
		?><div class='btn_pin_title'><?  the_titlesmall('', '', true, '20')  ?> <br /></div><?
		echo"<div class='btn_pin_all'><div class='btn_pin_edit'><a href='/wp-admin/post.php?post=" . get_the_ID() . "&action=edit'><img src='" . plugin_dir_url( dirname( __FILE__ ) ) . 'img/edit.png'  . "'></div>";
		echo "</a><br>";
		echo"<div class='btn_pin_view'><a href=\"" . get_permalink() . "\"><img src='" . plugin_dir_url( dirname( __FILE__ ) ) . 'img/view.png'  . "'></a></div>";


?>
<script>
function deletepin(){
	function setCurrent(obj){
$('li#ui-state-default li a').each(function(){
    $('.current').removeClass('current');
});
$(obj).addClass('current');
}

}
</script>

<?
	echo "</div></li>";
	}

}
wp_reset_postdata();


///////////////////////////// SHOW PINNED Pages
$args = array(
	'post_type'      => 'page',
	'post_status'    => 'pin_featured',
	'orderby'        => 'date',
	'order'          => 'DESC',
	'meta_query' => array(
			array(
					'key' => '_is_featured',
					'value' => 'yes'
			)
	) ,
	'posts_per_page' => 30

                        );

$my_query = new WP_Query( $args );
if ( $my_query->have_posts() ) {

	while ( $my_query->have_posts() ) {
		$my_query->the_post();

echo "<li class='ui-state-default'>";
	//// <li class="ui-state-default">Pin-4</li>

  	echo "<div class='btn_pin_status'>PAGE</div>";
	//	echo "<div class='btn_pin_title'>" . the_titlesmall('', '', true, '20') . '<br /></div>';
		?><div class='btn_pin_title'><?  the_titlesmall('', '', true, '20')  ?> <br /></div><?
		echo"<div class='btn_pin_all'><div class='btn_pin_edit'><a href='/wp-admin/post.php?post=" . get_the_ID() . "&action=edit'><img src='" . plugin_dir_url( dirname( __FILE__ ) ) . 'img/edit.png'  . "'></div>";
		echo "</a><br>";
		echo"<div class='btn_pin_view'><a href=\"" . get_permalink() . "\"><img src='" . plugin_dir_url( dirname( __FILE__ ) ) . 'img/view.png'  . "'></a></div>";

		echo "</div></li>";

	}

}
wp_reset_postdata();
?>

</ul>
<!--<button class="btn" onClick="addAnother()"> Adsuga </button>-->
</body>

</div>

<?php

//////////////////////////////////////////
/*
$args = array(
	'post_type'      => 'post',
	'post_status'    => 'featured',
	'orderby'        => 'date',
	'order'          => 'DESC',
	'meta_query' => array(
			array(
					'key' => '_is_featured',
					'value' => 'yes'
			)
	) ,
	'posts_per_page' => 30

                        );

$my_query = new WP_Query( $args );
if ( $my_query->have_posts() ) {

	while ( $my_query->have_posts() ) {
		$my_query->the_post();

echo "<li class='ui-state-default'> <a href=\"edit.php?&post_status=featured&post_type=post\"> <!--<a href=\"" . get_permalink() . "\">-->";
	//// <li class="ui-state-default">Pin-4</li>
		echo get_the_title() . '<br />';
		echo "</a>";
		echo "</li>";

	}

}
wp_reset_postdata();
///////////////////////////////////////////////////////*/
};

add_action( 'welcome_panel', 'ayo_pinsdash_welcome' );

//add_action( 'welcome_panel', 'widget' );
//add_action( 'welcome_panel', 'total_featured[$post_type]' );
//////////////////////////////////////////////////////////////////////////////////
//query_posts($query_string."&featured=yes"));
 if ($ayo_options['pins_filter'] == true) {
class Featured_Post
{
    var $db = NULL;
    public $post_types = array();

    function __construct() {

        add_action('init', array(&$this,
            'init'
        ));
        add_action('admin_init', array(&$this,
            'admin_init'
        ));
        add_action('wp_ajax_toggle-featured-post', array(&$this,
            'admin_ajax'
        ));
				///

				//
    }
    function init() {

        add_filter('query_vars', array(&$this,
            'query_vars'
        ));
        add_action('pre_get_posts', array(&$this,
            'pre_get_posts'
        ));
    }
    function admin_init() {
        add_filter('current_screen', array(&$this,
            'my_current_screen'
        ));

        add_action('admin_head-edit.php', array(&$this,
            'admin_head'
        ));
        add_filter('pre_get_posts', array(&$this,
            'admin_pre_get_posts'
        ) , 1);
        $this->post_types = get_post_types(array(
            '_builtin' => false,
        ) , 'names', 'or');
        $this->post_types['post'] = 'post';
        $this->post_types['page'] = 'page';
				$this->post_types['page'] = 'product';
        ksort($this->post_types);
        foreach ($this->post_types as $key => $val) {
            add_filter('manage_edit-' . $key . '_columns', array(&$this,
                'manage_posts_columns'
            ));
            add_action('manage_' . $key . '_posts_custom_column', array(&$this,
                'manage_posts_custom_column'
            ) , 10, 2);
        }
    }
    function add_views_link($views) {
        $post_type = ((isset($_GET['post_type']) && $_GET['post_type'] != "") ? $_GET['post_type'] : 'post');
        $count = $this->total_featured($post_type);
        $class = $_GET['post_status'] == 'pin_featured' ? "current" : '';
        $views['pin_featured'] = "<a class=\"" . $class . "\" id=\"featured-post-filter\" href=\"edit.php?&post_status=pin_featured&post_type={$post_type}\">Pins <span class=\"count\">({$count})</span></a>";
        return $views;
    }
    function total_featured($post_type = "post") {
        $rowQ = new WP_Query(array(
            'post_type' => $post_type,
            'meta_query' => array(
                array(
                    'key' => '_is_featured',
                    'value' => 'yes'
                )
            ) ,
            'posts_per_page' => 1
        ));
        wp_reset_postdata();
        wp_reset_query();
        $rows = $rowQ->found_posts;
        unset($rowQ);
        return $rows;
    }
    function my_current_screen($screen) {
        if (defined('DOING_AJAX') && DOING_AJAX) {
            return $screen;
        }
        $this->post_types = get_post_types(array(
            '_builtin' => false,
        ) , 'names', 'or');
        $this->post_types['post'] = 'post';
        $this->post_types['page'] = 'page';
				$this->post_types['page'] = 'product';
        ksort($this->post_types);
        foreach ($this->post_types as $key => $val) {
            add_filter('views_edit-' . $key, array(&$this,
                'add_views_link'
            ));
        }
        return $screen;
    }
    function manage_posts_columns($columns) {
        global $current_user;
        get_currentuserinfo();
        if (current_user_can('edit_posts', $user_id)) {
            $columns['pin_featured'] = __('Pins');
        }
        return $columns;
    }
    function manage_posts_custom_column($column_name, $post_id) {

        //echo "here";
        if ($column_name == 'pin_featured') {
            $is_featured = get_post_meta($post_id, '_is_featured', true);
            $class = "dashicons";
            $text = "";
            if ($is_featured == "yes") {
                $class.= " dashicons-star-filled";
                $text = "";
            } else {
                $class.= " dashicons-star-empty";
            }
            echo "<a href=\"#!featured-toggle\" class=\"featured-post-toggle {$class}\" data-post-id=\"{$post_id}\">$text</a>";
        }
    }
    function admin_head() {
        echo '<script type="text/javascript">
		jQuery(document).ready(function($){
			$(\'.featured-post-toggle\').on("click",function(e){
				e.preventDefault();
				var _el=$(this);
				var post_id=$(this).attr(\'data-post-id\');
				var data={action:\'toggle-featured-post\',post_id:post_id};
				$.ajax({url:ajaxurl,data:data,type:\'post\',
					dataType:\'json\',
					success:function(data){
					_el.removeClass(\'dashicons-star-filled\').removeClass(\'dashicons-star-empty\');
					$("#featured-post-filter span.count").text("("+data.total_featured+")");
					if(data.new_status=="yes"){
						_el.addClass(\'dashicons-star-filled\');
					}else{
						_el.addClass(\'dashicons-star-empty\');
					}
					}
				});
			});
		});
		</script>';
    }
    function admin_ajax() {
        header('Content-Type: application/json');
        $post_id = $_POST['post_id'];
        $is_featured = get_post_meta($post_id, '_is_featured', true);
        $newStatus = $is_featured == 'yes' ? 'no' : 'yes';
        delete_post_meta($post_id, '_is_featured');
        add_post_meta($post_id, '_is_featured', $newStatus);
        echo json_encode(array(
            'ID' => $post_id,
            'new_status' => $newStatus,
            'total_featured' => $this->total_featured(get_post_type($post_id))
        ));
        die();
    }
    function admin_pre_get_posts($query) {
        global $wp_query;
        if (is_admin() && $_GET['post_status'] == 'pin_featured') {
            $query->set('meta_key', '_is_featured');
            $query->set('meta_value', 'yes');
        }
        return $query;
    }
    function query_vars($public_query_vars) {
        $public_query_vars[] = 'pin_featured';
        return $public_query_vars;
    }
    function pre_get_posts($query) {
        if (!is_admin()) {
            if ($query->get('pin_featured') == 'yes') {
                $query->set('meta_key', '_is_featured');
                $query->set('meta_value', 'yes');
            }
        }
        return $query;
    }
///////////////////////
//////////////////////
}

class Featured_Post_Widget extends WP_Widget
{
    private $post_types = array();
    function __construct() {
        parent::WP_Widget(false, $name = 'Featured Post');
    }

    function form($instance) {
        $title = esc_attr($instance['title']);
        $type = esc_attr($instance['post_type']);
        $num = (int)esc_attr($instance['num']);
        $this->post_types = get_post_types(array(
            '_builtin' => false,
        ) , 'names', 'or');
        $this->post_types['post'] = 'post';
        $this->post_types['page'] = 'page';
        ksort($this->post_types);
        echo "<p>";
        echo "<label for=\"" . $this->get_field_id('title') . "\">";
        echo _e('Title:');
        echo "</label>";
        echo "<input class=\"widefat\" id=\"" . $this->get_field_id('title') . "\" name=\"" . $this->get_field_name('title') . "\" type=\"text\" value=\"" . $title . "\" />";
        echo "</p>";
        echo "<p>";
        echo "<label for=\"" . $this->get_field_id('post_type') . "\">";
        echo _e('Post Type:');
        echo "</label>";
        echo "<select name = \"" . $this->get_field_name('post_type') . "\" id=\"" . $this->get_field_id('title') . "\" >";
        foreach ($this->post_types as $key => $post_type) {
            echo '<option value="' . $key . '"' . ($key == $type ? " selected" : "") . '>' . $key . "</option>";
        }

        echo "</select>";
        echo "</p>";
        echo "<p>";
        echo "<label for=\"" . $this->get_field_id('num') . "\">";
        echo _e('Number To show:');

        echo "</label>";
        echo "<input id = \"" . $this->get_field_id('num') . "\" class = \"widefat\" name = \"" . $this->get_field_name('num') . "\" type=\"text\" value =\"" . $num . "\" / >";
        echo "</p>";
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['num'] = (int)strip_tags($new_instance['num']);
        $instance['post_type'] = strip_tags($new_instance['post_type']);
        if ($instance['num'] < 1) {
            $instance['num'] = 10;
        }
        return $instance;
    }
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        echo $before_widget;
        if ($title) {
            echo $before_title . $title . $after_title;
        }
        echo "<ul class=\"widget-list featured-post-widget featured-post\">";
        wp_reset_query();
        global $wp_query;
        $old_query = $wp_query;
        $FeaturedPost_query = new WP_Query(array(
            'post_type' => $instance['post_type'],
            'showposts' => $instance['num'],
            'pin_featured' => 'yes',
            'paged' => 1
        ));
        while ($FeaturedPost_query->have_posts()) {
            $FeaturedPost_query->the_post();
            echo "<li><a href=\"" . get_permalink() . "\">";
            echo get_the_title();
            echo "</a>";
            echo "</li>";
        }
        wp_reset_query();
        $wp_query = $old_query;
        echo "</ul>";
        echo $after_widget;
        // outputs the content of the widget
    }
}
$Featured_Post = new Featured_Post();


add_action('widgets_init', create_function('', 'return register_widget("Featured_Post_Widget");') , 100);
}
