<?php global $post; ?>

  <?php wp_editor(
    htmlspecialchars_decode(get_post_meta( $post->ID, '_vnb_' . $this->name, true )),
    'vnb_'.$this->name,
    $settings = array(
        'quicktags' => array('buttons' => 'em,strong,link',),
        'textarea_name' => $this->name) ); ?>
