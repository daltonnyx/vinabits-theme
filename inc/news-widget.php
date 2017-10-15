<?php
/**
 * new WordPress Widget format
 * Wordpress 2.8 and above
 * @see http://codex.wordpress.org/Widgets_API#Developing_Widgets
 */
class News_Template_Widget extends WP_Widget {

    /**
     * Constructor
     *
     * @return void
     **/
  function News_Template_Widget() {
    $widget_ops = array( 'classname' => 'news-template', 'description' => 'Various ways to display post' );
    $this->WP_Widget( '', 'News', $widget_ops );
  }

    /**
     * Outputs the HTML for this widget.
     *
     * @param array $args An array of standard parameters for widgets in this theme
     * @param array $instance An array of settings for this widget instance
     * @return void Echoes it's output
     **/
  function widget( $args, $instance ) {
    extract( $args, EXTR_SKIP );
    extract($instance);
    echo $before_widget;
    if(!empty($title)) {
    ?>
      <header class="widget-header">
      <?php
      echo $before_title;
      echo $title; // Can set this with a widget option, or omit altogether
      echo $after_title;
    ?>
      <p class="widget-description"><?php echo $description; ?></p>
      </header>
    <?php
    }
    //
    // Widget display logic goes here
    //
    if($post_type == '') {
      $post_type = 'post';
    }
    $query_args = array(
      'posts_per_page' => $post_num,
      'post_type' => $post_type
    );
    if($category != 'all' && $post_type == 'post') {
      $query_args['category_name'] = $category;
    }
    else if($category != 'all') {
        $query_args['tax_query'] = array(
            array(
                'taxonomy' => $taxonomy,
                'field' => 'slug',
                'terms' => $category
            )
        );
    }
    $news = new WP_Query($query_args);
    if(!empty($templ))
      include(get_template_directory().'/components/post-widget/news-'.$templ.'.php');
    else
      include(get_template_directory().'/components/post-widget/news-default.php');
    wp_reset_query();
    echo $after_widget;
  }

    /**
     * Deals with the settings when they are saved by the admin. Here is
     * where any validation should be dealt with.
     *
     * @param array $new_instance An array of new settings as submitted by the admin
     * @param array $old_instance An array of the previous settings
     * @return array The validated and (if necessary) amended settings
     **/
  function update( $new_instance, $old_instance ) {
    // update logic goes here

    $updated_instance = $new_instance;
    return $updated_instance;
  }

    /**
     * Displays the form for this widget on the Widgets page of the WP Admin area.
     *
     * @param array $instance An array of the current settings for this widget
     * @return void Echoes it's output
     **/
  function form( $instance ) {
    $instance = wp_parse_args( (array) $instance, array(
      'title' => 'News',
      'category' => 'all',
      'has_thumbnail' => false,
      'has_excerpt' => false,
      'post_num' => 4,
      'has_readmore' => false) );

    // display field names here using:
    // $this->get_field_id('option_name') - the CSS ID
    // $this->get_field_name('option_name') - the HTML name
    // $instance['option_name'] - the option value
    $title = $instance['title'];
    $category = $instance['category'] ? $instance['category'] : 'all';
    $taxonomy = $instance['taxonomy'];
    $templ = $instance['templ'];
    $has_thumbnail = $instance['has_thumbnail'];
    $has_excerpt = $instance['has_excerpt'];
    $has_readmore = $instance['has_readmore'];
    $post_num = $instance['post_num'];
    $post_type = $instance['post_type'];
    $description = $instance['description'];
    ?>
    <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'text_domain' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
    </p>

    <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php esc_attr_e( 'Description:', 'text_domain' ); ?></label>
		<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>"><?php echo esc_attr( $description ); ?></textarea>
    </p>

    <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><?php esc_attr_e( 'Category:', 'text_domain' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>" type="text" name="<?php echo esc_attr( $this->get_field_name( 'category' ) ); ?>" value="<?php echo esc_attr( $category ); ?>"/>
       
		</p>
    <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'taxonomy' ) ); ?>"><?php esc_attr_e( 'Taxonomy:', 'text_domain' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'taxonomy' ) ); ?>" type="text" name="<?php echo esc_attr( $this->get_field_name( 'taxonomy' ) ); ?>" value="<?php echo esc_attr( $taxonomy ); ?>"/>
       
	</p>


    <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ); ?>"><?php esc_attr_e( 'Post Type:', 'text_domain' ); ?></label>
		<input id="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_type' ) ); ?>" type="text" value="<?php echo esc_attr( $post_type ); ?>">
		</p>

    <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'post_num' ) ); ?>"><?php esc_attr_e( 'Number of posts:', 'text_domain' ); ?></label>
		<input id="<?php echo esc_attr( $this->get_field_id( 'post_num' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_num' ) ); ?>" type="number" value="<?php echo esc_attr( $post_num ); ?>">
		</p>

    <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'templ' ) ); ?>"><?php esc_attr_e( 'Template:', 'text_domain' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'templ' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'templ' ) ); ?>" type="text" value="<?php echo esc_attr($templ); ?>" />

		</p>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'has_thumbnail' ) ); ?>">
  		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'has_thumbnail' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'has_thumbnail' ) ); ?>" type="checkbox" <?php echo $has_thumbnail ? "checked" : ""; ?> value="true">
      <?php esc_attr_e( 'Has thumbnail', 'text_domain' ); ?></label>
    </p>

    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'has_excerpt' ) ); ?>">
  		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'has_excerpt' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'has_excerpt' ) ); ?>" type="checkbox" <?php echo $has_excerpt ? "checked" : ""; ?> value="true">
      <?php esc_attr_e( 'Has Excerpt', 'text_domain' ); ?></label>
    </p>

    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'has_readmore' ) ); ?>">
  		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'has_readmore' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'has_readmore' ) ); ?>" type="checkbox" <?php echo $has_readmore ? "checked" : ""; ?> value="true">
      <?php esc_attr_e( 'Has Readmore', 'text_domain' ); ?></label>
    </p>
    <?php

  }
}

add_action( 'widgets_init', create_function( '', "register_widget('News_Template_Widget');" ) );
