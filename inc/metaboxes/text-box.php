<?php global $post; ?>
<p>
  <label for="<?php echo $this->name ?>"><?php echo $this->caption; ?></label>
  <br />
  <input class="widefat" type="text" name="<?php echo $this->name ?>" id="<?php echo $this->name ?>" 
         value="<?php echo get_post_meta( $post->ID, '_vnb_' . $this->name, true ); ?>" size="30" />
</p>
