jQuery(document).ready(function ($) {
   var meta_gallery_frame;
   var load_once = false;
   if(!load_once) {
     load_once = true;
     jQuery('.wpmedia').click(function(e){

              e.preventDefault();

              var inputField = jQuery(this).prevAll(".value_holder");

              var imageDiv = jQuery(this).prev(".images");

              // If the frame already exists, re-open it.
              if ( meta_gallery_frame != undefined ) {
                      meta_gallery_frame.open();
                      return;
              }

              // Sets up the media library frame
              meta_gallery_frame = wp.media.frames.meta_gallery_frame = wp.media({
                      library: { type: 'image' },
                      multiple: false
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
                      var imageID = jQuery(inputField).val();
                      var imageHTML = '';
                      var image = meta_gallery_frame.state().get('selection').first();
                      imageID = image.attributes.id;
                      imageHTML += '<div style="position:relative;margin-right:3px;" class="image"><img style="height: 80px;" id="'+image.attributes.id+'" src="'+image.attributes.url+'"></div>';
                      jQuery(inputField).val(imageID);
                      jQuery(imageDiv).html(imageHTML);
              });

              // Finally, open the modal
              meta_gallery_frame.open();

      });
    }
});
