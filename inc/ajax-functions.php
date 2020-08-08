<?php
// Handle AJAX request (start)
   $path = preg_replace('/wp-content.*$/','',__DIR__);
   include($path.'wp-load.php');  
	if(isset($_POST['id']) ){
	  $id= $_POST['id'];
	  $url=   wp_get_attachment_url($id);
	  echo ($url);
	}
// Handle AJAX request (end)


// Handle AJAX request (start)
if(isset($_POST['post_title'])){
	$post_title = $_POST['post_title'];
	if($_POST['fps_post_excerpt']){
	$post_excerpt = $_POST['fps_post_excerpt'];
	}else{
	$post_excerpt = '';		
	}
	if($_POST['fps_post_content']){
	$post_content = $_POST['fps_post_content'];		
	}else{
	$post_content = '';	
	}

	if($_POST['my_taxonomies']){
	$post_cat = $_POST['my_taxonomies'];
	}else{
	$post_cat = '';			
	}
	if(isset($_POST['tags_input'])){
	$post_tags = $_POST['tags_input'];
	}else{
	$post_tags = '';		
	}
	if($_POST['fps_image_id']){
	$featured_attach_id = $_POST['fps_image_id'];		
	}else{
	$featured_attach_id = '';		
	}

$post_id = wp_insert_post(array(
    'post_title' => $post_title,
    'post_type' => 'post',
    'post_status' => 'draft', 
    'post_content' => $post_content,
    'post_excerpt' => $post_excerpt,
));

set_post_thumbnail( $post_id, $featured_attach_id );

// update_post_meta( $post_id, '_stock', $single['qty'] );	
$post_cat_txnomy = 'category';
$post_tag_txnomy = 'post_tag';
wp_set_post_terms( $post_id, $post_cat, $post_cat_txnomy );

$post_tags_arr =(explode(",",$post_tags));
wp_set_post_terms( $post_id, $post_tags_arr, $post_tag_txnomy );	
}
// Handle AJAX request (end)
