<?php defined( 'ABSPATH' ) || exit(); ?>
<?php
function fps_shortcode_function() {
	if ( is_user_logged_in() ) {
?>
<div id="fps_add_post_form_wrapper">
<div class="container mt-5 mb-5">
<form action="" method="POST" id="fps_add_post_form">
<div class="row">
<div class="col-md-8">
<div class="form-group">
<label for="title"><?php esc_html_e('Post Title','fps'); ?></label>
<input type="text" name="post_title" class="form-control" value="" id="title" spellcheck="true" autocomplete="off" required>
</div>

<div class="form-group">
<label><?php esc_html_e('Post Description','fps'); ?></label>
<?php
$post_content_id = 'fps_post_content';
$post_content_settings = array(
    'wpautop' => true,
    'media_buttons' => true,
    'editor_class' => 'form-control',
	'textarea_name' => 'fps_post_content',
    'textarea_rows' => 7,
    'tabindex' => 1
);                      
wp_editor( '', $post_content_id, $post_content_settings );
?>
</div>

<div class="form-group">
<label><?php esc_html_e('Post Excerpt','fps'); ?></label>
<?php 
$post_excerpt_id = 'fps_post_excerpt';
$post_excerpt_settings = array(
    'wpautop' => false,
    'media_buttons' => false,
    'tinymce' => false,
    'quicktags' => false,
    'editor_class' => 'form-control',
	'textarea_name' => 'fps_post_excerpt',
    'textarea_rows' => 3,
    'tabindex' => 1
);                      
wp_editor( '', $post_excerpt_id, $post_excerpt_settings );
?>
</div>

</div>
<div class="col-md-4">
<div class="gallery_fields">
<div class="fps-feature_image">					  									
  <img name="fps-preview-image" id="fps-preview-image" src="<?php echo esc_url(plugins_url('front-end-post-submission'));?>/images/Placeholder.png" style="cursor:pointer;width:200px;display:block;margin-bottom:20px;"/>
  <img id="remove_feature_img" src="<?php echo esc_url(plugins_url('front-end-post-submission'));?>/images/minus.png"/>  
 <input type="hidden" name="fps_image_id" id="fps_image_id" value="" class="regular-text" />
</div> 
</div>

<!-- End Gallery -->
<div class="categories mt-4 card">
  <div class="card-header">
 <h5 class="card-title"><?php esc_html_e('Categories','fps');?></h5>
  </div>
<div class="card-body">
<?php
$categories = get_categories( array(
    'post_type' => 'post',
) );
$terms = get_terms( array(
    'taxonomy' => 'category',
    'hide_empty' => false,
) );
foreach($terms as $category) {

   echo "<input type='checkbox' id='my_taxonomies".$category->term_id."' class='my_taxonomies' name='my_taxonomies[]' value=".$category->term_id." /> ".$category->name."<br/>";
}
?>
</div>
</div>
<div class="tags mt-4 card">
  <div class="card-header">
 <h5 class="card-title"><?php esc_html_e('Tags','fps');?></h5>
 </div>
<div class="card-body">
<textarea class="form-control" name="tags_input" placeholder="Separate Tags with commas"></textarea>
</div>
</div>
</div>
</div>
<input type="submit" name="submit" value="Submit" class="btn btn-primary fps_add_product_form_btn"/><img src="<?php echo esc_url(plugins_url("front-end-post-submission/images/ajax-loader.gif"));?>" class="fps-loader"/>
<div class="success_msg"><?php esc_html_e('Post added!','fps');?></div>
</form>
</div>
</div>
<?php
	}else{
		echo "<div class='alert alert-warning'>Please login to add new post!</div>";
	}
}
add_shortcode('fps_add_to_post', 'fps_shortcode_function');