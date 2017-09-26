jQuery(document).ready(function ($) {
             
   $(document).on("click", ".upload_image_button", function (e) {
      e.preventDefault();
      var $button = $(this);
      if(file_frame == undefined) { 
 
      // Create the media frame.
      var file_frame = wp.media.frames.file_frame = wp.media({
         title: 'Select or upload image',
         library: { // remove these to show all
            type: 'image' // specific mime
         },
         button: {
            text: 'Select'
         },
         multiple: false  // Set to true to allow multiple files to be selected
      });
 
      // When an image is selected, run a callback.
      file_frame.on('select', function () {
         // We set multiple to false so only get one image from the uploader
 
         var attachment = file_frame.state().get('selection').first().toJSON();
 
         $button.siblings('input').val(attachment.url);
 
      }); 
    }
 
      // Finally, open the modal
      file_frame.open();
   });
   jQuery('.wpmedia').click(function(e){

            e.preventDefault();

            var inputField = jQuery(this).prevAll(".value_holder");

            var imgagesDiv = jQuery(this).prev(".images");

            // If the frame already exists, re-open it.
            if ( meta_gallery_frame ) {
                    meta_gallery_frame.open();
                    return;
            }

            // Sets up the media library frame
            meta_gallery_frame = wp.media.frames.meta_gallery_frame = wp.media({
                    library: { type: 'image' },
                    multiple: true
            });

            // Create Featured Gallery state. This is essentially the Gallery state, but selection behavior is altered.
            meta_gallery_frame.states.add([
                    new wp.media.controller.Library({
                            id:         'vinabits-gallery',
                            title:      'Select Images for Gallery',
                            priority:   20,
                            toolbar:    'main-gallery',
                            filterable: 'uploaded',
                            library:    wp.media.query( meta_gallery_frame.options.library ),
                            multiple:   meta_gallery_frame.options.multiple ? 'reset' : false,
                            editable:   true,
                            allowLocalEdits: true,
                            displaySettings: true,
                            displayUserSettings: true
                    }),
            ]);

            meta_gallery_frame.on('open', function() {
                    var selection = meta_gallery_frame.state().get('selection');
                    var library = meta_gallery_frame.state('gallery-edit').get('library');
                    
            });

            meta_gallery_frame.on('ready', function() {
                    jQuery( '.media-modal' ).addClass( 'no-sidebar' );
            });

            // When an image is selected, run a callback.
            //meta_gallery_frame.on('update', function() {
            meta_gallery_frame.on('select', function() {
                    var imageIDArray = jQuery(inputField).val().split(',');
                    var imageHTML = '';
                    var metadataString = '';
                    images = meta_gallery_frame.state().get('selection');
                    
                    images.each(function(attachment) {
                            imageIDArray.push(attachment.attributes.id);
                            imageHTML += '<div style="position:relative;margin-right:3px;" class="image"><img style="height: 80px;" id="'+attachment.attributes.id+'" src="'+attachment.attributes.url+'"><a style="color:red;position:absolute;top:5px;right:5px;z-index:9;" href="#">x</a></div>';
                    });
                    metadataString = imageIDArray.join(",");
                    if (metadataString) {
                            jQuery(inputField).val(metadataString);
                            jQuery(imgagesDiv).append(imageHTML);
                            setTimeout(function(){
                                    ajaxUpdateTempMetaData();
                            },0);
                    }
            });

            // Finally, open the modal
            meta_gallery_frame.open();

    });

    jQuery(".inside .images").on("click", ".image a", function(e) {
        e.preventDefault();
        var image = jQuery(this).parent(),
            id = image[0].id,
            field = image.parent().prev(),
            imgArr = field.val().split(','),
            idx = imgArr.indexOf(id);
        imgArr.splice(idx, 1);
        field.val( imgArr.join(',') );
        image.remove();
    } );
});

