<?php

add_filter('swpe_gallery_images_attr', 'mixstore_gallery_attr');

function mixstore_gallery_attr() {
	return 'rel="lightbox"';
}