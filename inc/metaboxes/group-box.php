<?php global $post; ?>

<?php $value =  get_post_meta( $post->ID, '_vnb_' . $this->name, true ); ?>

<table id="<?php echo $this->name ?>">
  <thead>
    <tr>
      <th>Caption</th>
      <th>Value</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php if(!empty($value)) : foreach($value as $key => $value) : ?>
      <tr>
        <td>
          <input type="text" name="product_meta[<?php echo $key; ?>][caption]" value="<?php echo $value['caption']; ?>">
        </td>
        <td>
          <input type="text" name="product_meta[<?php echo $key; ?>][value]" value="<?php echo $value['value']; ?>">
        </td>
        <td>
          <a href="#" class="button button-danger delete-meta">Delete</a>
        </td>
      </tr>
    <?php endforeach; endif; ?>
    <tr class="new-row">
      <td>
        <input type="text" value="" name="<?php echo $this->name .'_new_caption' ?>" />
      </td>
      <td>
        <input type="text" value="" name="<?php echo $this->name .'_new_value' ?>" />
      </td>
      <td><a href="#" class="button button-primary" id="<?php echo $this->name; ?>-add-new">Add</a></td>
    </tr>
  </tbody>
</table>



<script type="application/javascript" defer>
  jQuery(document).ready(function($) {
    var field_name = '<?php echo $this->name; ?>';
    $('#' + field_name + '-add-new').on('click', function(e) {
      e.preventDefault();
      var new_id = makeid();
      var new_caption = $('[name="'+field_name+'_new_caption"]').val();
      var new_value = $('[name="'+field_name+'_new_value"]').val();
      $('#' + field_name + ' .new-row').before('<tr>' + 
        '<td><input type="text" name="' + field_name + '[' + new_id + '][caption]" value="' + new_caption + '" /></td>' +
        '<td><input type="text" name="' + field_name + '[' + new_id + '][value]" value="' + new_value + '" /></td>' +
        '<td><a href="#" class="button button-danger delete-meta">Delete</a></td>' +
      '</tr>');
      $('[name="'+field_name+'_new_caption"]').val('');
      $('[name="'+field_name+'_new_value"]').val('');
    });
    $('#'+field_name).on("click", ".delete-meta", function(e) {
      e.preventDefault();
      $(e.currentTarget).closest('tr').remove();
    });
  });

  function makeid() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for (var i = 0; i < 5; i++)
      text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
  }

</script>