<?php $value =  get_post_meta( $post_id, '_vnb_' . $this->name, true ); ?>

<dl>
	<dt style="font-weight: bold;">Thời gian</dt>
	<dd><?php echo $value['thoi_gian']; ?></dd>
	<dt style="font-weight: bold;">Khời hành</dt>
	<dd><?php echo $value['khoi_hanh']; ?></dd>
</dl>