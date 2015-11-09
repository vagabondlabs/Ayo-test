<?php
//Setting the list column sizes
add_action('admin_head', 'modify_width_columns');
function modify_width_columns() {
    echo '<style type="text/css">
        .column-title { text-align: left; width:300px !important; overflow:hidden }
        .column-author { text-align: left; width:100px !important; overflow:hidden }
        .column-pin_featured { text-align: left; width:45px !important; overflow:hidden }
        .column-thumbnail { text-align: left; width:79px !important; overflow:hidden }
        .column-tags { text-align: left; width:79px !important; overflow:hidden }
        .column-product_cat { text-align: left; width:45px !important; overflow:hidden };
    </style>';
} 
/*Thumbnail Poze posts/pages*/

if (!function_exists('AddThumbColumn') && function_exists('add_theme_support'))
	{
if ($ayo_options['show_picture_column'] == true) {
	// for post and page

	add_theme_support('post-thumbnails', array(
		'post',
		'page'
	));
	function AddThumbColumn($cols)
		{
		$cols['thumbnail'] = __('Picture');
		return $cols;
		}

	function AddThumbValue($column_name, $post_id)
		{
		$width = (int)60;
		$height = (int)60;
		if ('thumbnail' == $column_name)
			{

			// thumbnail of WP 2.9

			$thumbnail_id = get_post_meta($post_id, '_thumbnail_id', true);

			// image from gallery

			$attachments = get_children(array(
				'post_parent' => $post_id,
				'post_type' => 'attachment',
				'post_mime_type' => 'image'
			));
			if ($thumbnail_id) $thumb = wp_get_attachment_image($thumbnail_id, array(
				$width,
				$height
			) , true);
			elseif ($attachments)
				{
				foreach($attachments as $attachment_id => $attachment)
					{
					$thumb = wp_get_attachment_image($attachment_id, array(
						$width,
						$height
					) , true);
					}
				}

			if (isset($thumb) && $thumb)
				{
				echo $thumb;
				}
			  else
				{
				echo __('None');
				}
			}
		}

	// for posts
	add_filter('manage_posts_columns', 'AddThumbColumn');
	add_action('manage_posts_custom_column', 'AddThumbValue', 6, 2);

	// for pages
	add_filter('manage_pages_columns', 'AddThumbColumn');
	add_action('manage_pages_custom_column', 'AddThumbValue', 10, 2);
}};

// Add Filter Hook
add_filter( 'post_mime_types', 'modify_post_mime_types' );
