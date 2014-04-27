<?php
add_image_size('mixstore_product', 298, 165 ,true);

add_filter('excerpt_length', 'mixstore_excerpt_length', 99999);

function mixstore_excerpt_length() {
	return 10;
}

add_filter('excerpt_more', 'mixstore_excerpt_more', 99999);

function mixstore_excerpt_more() {
	return '...';
}

add_filter('swpe_gallery_images_attr', 'mixstore_gallery_attr');

function mixstore_gallery_attr() {
	return 'rel="lightbox"';
}