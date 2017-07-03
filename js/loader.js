/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
jQuery(document).ready(function($) {
	
	$('.t_media_upload').click(function(){
		var send_back = wp.media.editor.send.attachment,
			$this = $(this);
		wp.media.editor.send.attachment = function(props, attachment) {
			if (/image/i.test(attachment.mime)) {
				$this.parent().siblings('p.t_add_media').children('input').each(function() {
					var attr = $(this).attr('name');
					if (/url/.test(attr))
						$(this).val(attachment.sizes[props.size].url);
					else if (/height/.test(attr))
						$(this).val(attachment.sizes[props.size].height);
					else if (/width/.test(attr))
						$(this).val(attachment.sizes[props.size].width);
					else if (/id/.test(attr))
						$(this).val(attachment.id);
				});
				$this.parent().siblings('p.current_image').children('img').attr('src', attachment.sizes[props.size].url);
				$this.parent().siblings('p.current_image').show();
				$('#thesis_post_image .option_item, #thesis_post_thumbnail .option_item').show();
			}
			wp.media.editor.send.attachment = send_back;
		}
		wp.media.editor.open();
		return false;
	});
	$('input[name*="[image][url]"]').each(function(){
		if ($(this).val().length > 0)
			$(this).closest('.option_item').siblings('.option_item').each(function() { $(this).show(); });
	});
});

