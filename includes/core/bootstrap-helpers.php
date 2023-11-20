<?php
if( ! defined('ABSPATH') ) exit;

/**
 * HTML <iframe> responsive via Bootstrap 4 framework
 ***********************************************************************************************************************/
if ( ! function_exists( 'wp_custom_theme_embed_handler_html' ) ) {
  function wp_custom_theme_embed_handler_html($cached_html, $url, $attr, $post_ID){
	
	  if ( ! has_blocks() ) {
	    $classes = array();
	
	    $classes_all = array(
        'ratio ratio-16x9',
	    );
	
	    if (false !== strpos($url, 'vimeo.com')) {
	      $classes[] = 'vimeo';
	    }
	
	    if (false !== strpos($url, 'youtube.com')) {
	      $classes[] = 'youtube';
	    }
	
	    $classes = array_merge($classes, $classes_all);
	
	    $cached_html = '<div class="' . esc_attr( implode(' ', $classes ) ) . '">' . $cached_html . '</div>';
	  }


    return $cached_html;
  }
}
add_filter('embed_oembed_html', 'wp_custom_theme_embed_handler_html', 100, 4);



/**
 * Custom gallery format (using Bootstrap v5 grid)
 ***********************************************************************************************************************/
add_filter('post_gallery', 'wp_custom_gallery_grid', 10, 3);
function wp_custom_gallery_grid($output, $attrs, $instance) {

  $attrs = array_merge(array('columns' => 3), $attrs);
  // echo '<pre>' . print_r($attrs, true) . '</pre>'; // Check what is inside the array.

  $columns = $attrs['columns'];
  $images = explode(',', $attrs['ids']);

  // Other columns options in WordPress gallery (5,7,8,9)
  // are not suitable for default Bootstrap 12 columns grid
  // so they take the default value `col-sm-4`.
  switch($columns) {
    case 1:
      $col_class = 'col-sm-12';
      break;
    case 2:
      $col_class = 'col-sm-6';
      break;
    case 4:
      $col_class = 'col-sm-3';
      break;
    case 6:
      $col_class = 'col-sm-2';
      break;

    default:
      $col_class = 'col-sm-4';
      break;
  }

  // Gallery thumnbnail size (set via WordPress gallery panel).
  // Defaults to `thumbnail` size.
  $galleryThumbSize = ($attrs['size']) ? $attrs['size'] : 'thumbnail';

  // Starting `gallery` block and first gallery `row`.
  $galleryID = ($instance < 10) ? 'gallery-0' . $instance : 'gallery-' . $instance;
  $gallery = '
  <div class="gallery" id="' . $galleryID . '">
    <div class="row align-items-center">';

  $i = 0; // Counter for the loop.
      foreach ($images as $imageID) {

        if ($i%$columns == 0 && $i > 0) { // Closing previous `row` and startin the next one.
          $gallery .= '</div><div class="row">';
        }

        // Thumbnail `src` and `alt` attributes.
        $galleryThumbSrc = wp_get_attachment_image_src($imageID, $galleryThumbSize);
        $galleryThumbAlt = get_post_meta($imageID, '_wp_attachment_image_alt', true);
        $galleryThumbCap = get_post($imageID)->post_excerpt;

        // Determine where to the gallery thumbnail is linking (set via WordPress gallery panel).
        switch($attrs['link']) {
          case 'file':
            $galleryThumbLinkImg   = wp_get_attachment_image_src($imageID, 'large'); // Take the `full` or `large` image url.
            $galleryThumbLinkAttrs = array( // More attributes can be added, only `href` is required.
                'href'         => $galleryThumbLinkImg[0], // Link to original image file.
                'data-gallery' => 'gallery', // Set some data-attribute if it is needed.
                'target'       => '_blank',  // Set target to open in new tab/window.
              // 'title'        => '',
              // 'class'        => '',
              // 'id'           => ''
            );
            break;
          case 'none':
            $galleryThumbLinkAttrs = false;
            break;
          default: // By default there is no `link` and the thumb is linking to attachment page.
            $galleryThumbLinkAttrs = array( // More attributes can be added, only `href` is required.
                'href'  => get_attachment_link($imageID), // Link to image file attachment page.
              // 'title' => '',
              // 'class' => '',
              // 'id'    => ''
            );
            break;
        }

        $gallery .= '
        <figure class="'.$col_class.'">' .
            custom_gallery_item($galleryThumbSrc[0], $galleryThumbAlt, $galleryThumbLinkAttrs) .
            '<figcaption class="wp-caption-text gallery-caption" id="' . $galleryID .'">' . $galleryThumbCap . ' </figcaption>
        </figure>';

      }

  // Closing last gallery `row` and whole `gallery` block.
  $gallery .= '
    </div>
  </div>';
  return $gallery;
}

// Helper function: DRY while generating gallery items.
function custom_gallery_item($itemImgSrc, $itemImgAlt = '', $itemLinkAttrs = false) {
  $galleryItem = '<img src="' . $itemImgSrc . '" alt="' . $itemImgAlt . '" class="img-fluid" />';

  if ($itemLinkAttrs) {
    $linkAttrs = '';
    foreach ($itemLinkAttrs as $attrName => $attrVal) {
      $linkAttrs .= ' ' . $attrName . '="' . $attrVal . '"';
    }
    $galleryItem = '<a' . $linkAttrs . '>' . $galleryItem . '</a>';
  }

  return $galleryItem;
}