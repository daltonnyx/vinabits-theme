<?php global $post;

$value = get_post_meta( $post->ID, '_vnb_' . $this->name, true );
?>
<input class="value_holder" type="hidden" name="<?php echo $this->name ?>" id="<?php echo $this->name ?>"
         value="<?php echo $value; ?>" />
<div class="images" style="display:flex;flex-flow: row-wrap;">
  <?php
      $img = wp_get_attachment_url($value);
      echo '<div id="'.$id.'" style="position:relative;margin-right:3px;" class="image">';
      echo '<img style="height: 80px;" src="'.$img.'" />';
      echo '</div>';
   ?>
</div>
<a class="wpmedia button" href="#">Upload</a>
