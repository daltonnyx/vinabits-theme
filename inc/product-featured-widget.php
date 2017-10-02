<?php
/**
 * Product Cat Widget Class
 */
class product_featured_widget extends WP_Widget {


    /** constructor -- name this the same as the class above */
    function __construct() {
        parent::__construct('product_featured_widget', 'Product Featured Widget');
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
        $featureds = new WP_Query(array(
            'post_type' => 'product',
            'posts_per_page' => 5,
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_visibility',
                    'field' => 'name',
                    'terms' => 'featured',
                    'operator' => 'IN'
                )
            )
        ));
        if($featureds->have_posts()) :
            echo '<div class="featured-products"><ul>';
            while( $featureds->have_posts() ) : $featureds->the_post();
        ?>
            <li class="featured-item">
                <div class="thumb-container">
                    <?php the_post_thumbnail('product-super-small', array('alt' => get_the_title())); ?>
                </div>
                <div class="info-container">
                    <h5 class="product-title"><?php echo get_the_title(); ?></h5>
                    <p><span class="no-price"><?php echo __('Gọi để báo giá','vinabits'); ?></span></p>
                </div>
            </li>
        <?php endwhile; 
        echo '</ul></div>'; 
        endif; 
        wp_reset_query();
        ?>
        
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


} // end class product_featured_widget
add_action('widgets_init', create_function('', 'return register_widget("product_featured_widget");'));
?>
