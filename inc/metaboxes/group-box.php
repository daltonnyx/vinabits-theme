<?php global $post; ?>

<?php $value =  get_post_meta( $post->ID, '_vnb_' . $this->name, true ); ?>

<?php if(empty($value)) {
	$value = array('thoi_gian' => '', 'khoi_hanh' => '');
} ?>

<p>
  <label for="thoi-gian">Thời gian</label>
  <br />
  <input class="widefat" type="text" name="<?php echo $this->name.'[thoi_gian]' ?>" id="thoi-gian" 
         value="<?php echo $value['thoi_gian'] ?>" size="30" />

 <label for="khoi-hanh">Khởi hành</label>
  <br />
  <input class="widefat" type="text" name="<?php echo $this->name.'[khoi_hanh]' ?>" id="khoi-hanh" 
         value="<?php echo $value['khoi_hanh'] ?>" size="30" />
</p>
