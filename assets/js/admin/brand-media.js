'use strict';
jQuery(document).ready(function ($) {
   var meta_gallery_frame;
   jQuery('.brand-add').click(function(e){
      e.preventDefault();
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
        var brandTemplate = '<div class="brand" style="padding: 3px;margin:3px;border:1px solid #ccc;display:inline-block;">' +
                             '<img src="{image_src}" style="float:left;" />' +
                             '<input type="hidden" value="{image_id}" name="brand_group[{key}][image]" />' +
                             '<div class="field-list" style="float:left;">' +
                             '<input type="text" class="widefat" value="" name="brand_group[{key}][link]" placeholder="Link" />' +
                             '<input type="text" class="widefat" value="" name="brand_group[{key}][title]" placeholder="Title" />' +
                             '<a href="#" class="button brand_remove" style="background:red;color:white;">Xoá</a>' +
                             '</div>' +
                             '</div>';
        var key
        var image = meta_gallery_frame.state().get('selection').first();
        var brand = brandTemplate.replace(/\{image_src\}/g, image.attributes.url)
                                 .replace(/\{key\}/g, image.attributes.id)
                                 .replace(/\{image_id\}/g, image.attributes.id);

        jQuery('.brands').append(brand);
      });

      // Finally, open the modal
      meta_gallery_frame.open();

  });
  jQuery(".inside .brands").on("click", ".brand_remove", function(e) {
      e.preventDefault();
      var brand = jQuery(this).closest('.brand');
      brand.remove();
  } );
});
