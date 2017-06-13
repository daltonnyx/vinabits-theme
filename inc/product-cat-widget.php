<?php
/**
 * Product Cat Widget Class
 */
class product_cat_widget extends WP_Widget {


    /** constructor -- name this the same as the class above */
    function product_cat_widget() {
        parent::WP_Widget(false, $name = 'Product Cat Text Widget');
    }

    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) {
        extract( $args );
        $title 		= apply_filters('widget_title', $instance['title']);
        ?>
        <?php echo $before_widget; ?>
        <?php if ( $title )
            echo $before_title . $title . $after_title; ?>

        <?php
        $parent_terms = get_terms(array(
            'parent' => 16,
            'hide_empty' => false,
            'taxonomy' => 'category',
            'order' => 'desc'
        ));
        $ul_tabs = '<ul class="mui-tabs__bar">';
        $div_tabs = "";
        $active = 'mui--is-active';
        foreach($parent_terms as $parent) {
            $ul_tabs .= '<li class="'.$active.'"><a data-mui-toggle="tab" data-mui-controls="child-cat--'.$parent->slug.'">'.$parent->name.'</a></li>';
            $posts = get_posts(array(
                'posts_per_page' => 4,
                'category' => $parent->term_id,
            ));
            $div_tabs .= '<div class="mui-tabs__pane '.$active.'" id="child-cat--'.$parent->slug.'">';
            $active = '';
            $div_tabs .= '<div class="owl-carousel pro-cat-carousel">';
            foreach($posts as $post) {
                $div_tabs .= '<div class="item">';
                $div_tabs .= '<a href="'.get_permalink($post->ID).'">';
                $div_tabs .= get_the_post_thumbnail($post, 'post-carousel');
                $div_tabs .= '<h5>'.$post->post_title.'</h5>';
                $div_tabs .='</a>';
                $div_tabs .= '</div>';
            }
            $div_tabs .= '</div>';
            $div_tabs .= '</div>';
            wp_reset_postdata();
            wp_reset_query();
        }
        $ul_tabs .= '</ul>';
        ?>
        <div class="product-tabs">
            <?php echo $ul_tabs; ?>
            <?php echo $div_tabs; ?>
        </div>
        <?php echo $after_widget; ?>
        <?php
    }

    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

    /** @see WP_Widget::form -- do not rename this */
    function form($instance) {

        $title 		= esc_attr($instance['title']);
        $message	= esc_attr($instance['message']);
        ?>
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
		<?php
    }


} // end class product_cat_widget
add_action('widgets_init', create_function('', 'return register_widget("product_cat_widget");'));
?>
