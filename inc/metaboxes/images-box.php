<?php global $post;

$value = get_post_meta( $post->ID, '_vnb_' . $this->name, true );
$images = explode(",", $value);
?>
<input class="value_holder" type="hidden" name="<?php echo $this->name ?>" id="<?php echo $this->name ?>" 
         value="<?php echo $value; ?>" />
<div class="images" style="display:flex;flex-flow: row-wrap;">
    <?php foreach ($images as $id) {
      $img = wp_get_attachment_url($id);
      echo '<div id="'.$id.'" style="position:relative;margin-right:3px;" class="image">';
      echo '<img style="height: 80px;" src="'.$img.'" />';  
      echo '<a href="#" style="color:red;position:absolute;top:5px;right:5px;z-index=9">x</a>';
      echo '</div>';
    } ?>
</div>
<a class="wpmedia button" href="#">Upload</a>
