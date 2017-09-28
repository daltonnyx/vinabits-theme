<?php

global $post;

$value = get_post_meta( $post->ID, '_vnb_' . $this->name, true );

$brands = $value;
echo '<div class="brands">';
if(!empty($value)) {
  foreach ($brands as $id => $brand) {
    $image = wp_get_attachment_url($brand['image']);
    echo '<div class="brand" style="padding: 3px;margin:3px;border:1px solid #ccc;display:inline-block;">';
    echo '<img src="'.$image.'" style="float:left;" />';
    echo '<input type="hidden" value="'.$brand['image'].'" name="'.$this->name.'['.$id.'][image]" />';
    echo '<div class="field-list" style="float:left;">';
    echo '<input type="text" class="widefat" value="'.$brand['link'].'" name="'.$this->name.'['.$id.'][link]" placeholder="Link" />';
    echo '<input type="text" class="widefat" value="'.$brand['title'].'" name="'.$this->name.'['.$id.'][title]" placeholder="Title" />';
    echo '<a href="#" class="button brand_remove" style="background:red;color:white;">Xoá</a>';
    echo '</div>';
    echo '</div>';
  }
}
echo '</div>';

?>

<a class="button brand-add">Add</a>
