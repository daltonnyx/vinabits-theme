<?php
/**
 * Project Cat Widget Class
 */
class project_cat_widget extends WP_Widget {


    /** constructor -- name this the same as the class above */
    function __construct() {
        parent::__construct('project_cat_widget', 'Project Cat Text Widget');
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
            'hide_empty' => false,
            'taxonomy' => 'car_cat',
            'order' => 'asc'
        ));
        $ul_tabs = '<div class="nav nav-tabs" id="nav-tab" role="tablist">';
        $div_tabs = "";
        $active = 'active';
        $ul_tabs .= '<a class="nav-item nav-link '.$active.'" data-toggle="tab" href="#child-cat--all">Tất cả</a>';
        $div_tabs .= '<div class="tab-pane fade show '.$active.'" id="child-cat--'.$parent->slug.'" role="tabpanel">';
        $div_tabs .= '<div class="cars">';
        $posts = get_posts(array(
            'posts_per_page' => 10,
            'post_type' => 'car',
        ));
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
        $active = '';
        foreach($parent_terms as $parent) {
            $ul_tabs .= '<a class="nav-item nav-link" data-toggle="tab" href="#child-cat--'.$parent->slug.'">'.$parent->name.'</a>';
            $posts = get_posts(array(
                'posts_per_page' => 9,
                'post_type' => 'car',
                'tax_query' => array(
                  array(
                    'taxonomy' => 'car_cat',
                    'field' => 'id',
                    'terms' => $parent->term_id
                  )
                )
            ));
            $div_tabs .= '<div class="tab-pane fade '.$active.'" id="child-cat--'.$parent->slug.'"  role="tabpanel">';
            $div_tabs .= '<div class="cars">';
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
        $ul_tabs .= '</div>';
        ?>
        <div class="project-tabs">
            <nav>
                <?php echo $ul_tabs; ?>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <?php echo $div_tabs; ?>
            </div>
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


} // end class project_cat_widget
add_action('widgets_init', create_function('', 'return register_widget("project_cat_widget");'));
?>
