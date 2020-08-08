<?php
add_action( 'wp_footer', 'fps_add_custom_script' );
if ( ! function_exists( 'fps_add_custom_script' ) ) {
function fps_add_custom_script() {
?>	
<script>
jQuery(document).ready( function($) {

      jQuery('#fps-preview-image').click(function(e) {

             e.preventDefault();
             var image_frame;
             if(image_frame){
                 image_frame.open();
             }
             // Define image_frame as wp.media object
             image_frame = wp.media({
                           title: 'Select Media',
                           multiple : false,
                           library : {
                                type : 'image',
                            }
                       });

                       image_frame.on('close',function() {
                          // On close, get selections and save to the hidden input
                          // plus other AJAX stuff to refresh the image preview
                          var selection =  image_frame.state().get('selection');
                          var gallery_ids = new Array();
                          var my_index = 0;
                          selection.each(function(attachment) {
                             gallery_ids[my_index] = attachment['id'];
                             my_index++;
                          });
                          var the_id = gallery_ids.join(",");
                          jQuery('input#fps_image_id').val(the_id);
                          fps_refresh_image(the_id);
                       });

                      image_frame.on('open',function() {
                        // On open, get the id from the hidden input
                        // and select the appropiate images in the media manager
                        var selection =  image_frame.state().get('selection');
                        var ids = jQuery('input#fps_image_id').val().split(',');
                        ids.forEach(function(id) {
                          var attachment = wp.media.attachment(id);
                          attachment.fetch();
                          selection.add( attachment ? [ attachment ] : [] );
                        });

                      });

                    image_frame.open();
     });
});

// Ajax request to refresh the image preview
function fps_refresh_image(the_id){
     var id = the_id;
     jQuery.ajax({
      type: 'post',
	  url: '<?php echo esc_url(plugins_url("front-end-post-submission/inc/ajax-functions.php"));?>',
      data: {id: id},
      success: function(response){
       jQuery('#fps-preview-image').attr('src', response);;
       jQuery('#remove_feature_img').show();
      }
     });
}

jQuery(function () {
	
function get_tinymce_content(id) {
    var content;
    var inputid = id;
    var editor = tinyMCE.get(inputid);
    var textArea = jQuery('textarea#' + inputid);    
    if (textArea.length>0 && textArea.is(':visible')) {
        content = textArea.val();        
    } else {
        content = editor.getContent();
    }    
    return content;
}
	
jQuery('#fps_add_post_form').submit(function(e) {
	e.preventDefault();
	var post_title = jQuery('[name=post_title]').val();
	var fps_post_excerpt =  get_tinymce_content('fps_post_excerpt');
	var fps_post_content = get_tinymce_content('fps_post_content');
	var tags_input = jQuery('[name="tags_input"]').val();
	var fps_image_id = jQuery('[name=fps_image_id]').val();
	var my_taxonomies = [];					
	jQuery(".my_taxonomies:checked").each(function(i,e) {
		my_taxonomies.push(jQuery(this).val());
	});

     jQuery.ajax({
     type: 'post',
	 beforeSend: function(){
	 jQuery(".fps-loader").css("display", "inline-block");
	 },
	 url: '<?php echo esc_url(plugins_url("front-end-post-submission/inc/ajax-functions.php"));?>',
     data: {post_title: post_title,fps_post_excerpt:fps_post_excerpt,fps_post_content:fps_post_content,tags_input:tags_input,fps_image_id:fps_image_id,my_taxonomies:my_taxonomies},
	complete: function(){
		jQuery("#fps_add_post_form")[0].reset();
		jQuery(".fps-loader").css("visibility", "hidden");
	  },	 
     success: function(response){
       jQuery(".success_msg").addClass("alert alert-success mt-2");
       jQuery(".success_msg").show();      
      }
     });

});
});
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

jQuery(function () {
	 jQuery('#remove_feature_img').click(function(e){
		var src = "<?php echo esc_url(plugins_url('front-end-post-submission'));?>/images/Placeholder.png"; 
		jQuery("#fps-preview-image").attr('src',src);
		jQuery('#remove_feature_img').hide();
	 });
});
</script>
<?php 
}
}