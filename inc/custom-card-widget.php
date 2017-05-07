<?php 
/**
 * Adds Custom_Card_Widget widget.
 */
class Custom_Card_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
        add_action('admin_enqueue_scripts', array($this, 'load_script'));
		parent::__construct(
			'foo_widget', // Base ID
			esc_html__( 'Card Content', 'vinabits' ), // Name
			array( 'description' => esc_html__( 'A Custom display with card layout', 'vinabits' ), ) // Args
		);
    }

    function load_script() {
        wp_enqueue_script('media-upload');
        wp_enqueue_media();
    }

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
        //echo $args['before_widget'];
        extract($instance);
        ?>
        <div class="card-layout">
            <a href="<?php echo $link; ?>" title="<?php echo $title; ?>">
                <div class="card-image">
                    <img src="<?php echo $image; ?>" class="img-responsive" alt="<?php echo $title; ?>" />
                </div>
                <div class="card-content">
                <?php
                if ( ! empty( $instance['title'] ) ) {
                    echo $args['before_title'] . apply_filters( 'widget_title', $title ) . $args['after_title'];
                }
                ?>
                <p><?php echo $desc; ?></p>
                </div>
            </a>
        </div>
        <?php
		//echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'vinabits' );
        $image = ! empty( $instance['image'] ) ? $instance['image'] : '';
        $desc  = ! empty( $instance['desc'] )  ? $instance['desc']  : '';
        $link  = ! empty( $instance['link'] )  ? $instance['link']  : '';
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'vinabits' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
        <p>
          <label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e( 'Image:' ); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" type="text" value="<?php echo esc_url( $image ); ?>" />
          <button class="upload_image_button button button-primary">Upload Image</button>
       </p>

        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'desc' ) ); ?>"><?php esc_attr_e( 'Description:', 'vinabits' ); ?></label> 
        <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'desc' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'desc' ) ); ?>"><?php echo esc_attr( $desc ); ?></textarea>
		</p>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>"><?php esc_attr_e( 'Link:', 'vinabits' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link' ) ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>">
		</p>
        <script type="text/javascript" defer>
            jQuery(document).ready(function ($) {
             
               $(document).on("click", ".upload_image_button", function (e) {
                  e.preventDefault();
                  var $button = $(this);

                  if(file_frame == undefined) { 
             
                  // Create the media frame.
                  var file_frame = wp.media.frames.file_frame = wp.media({
                     title: 'Select or upload image',
                     library: { // remove these to show all
                        type: 'image' // specific mime
                     },
                     button: {
                        text: 'Select'
                     },
                     multiple: false  // Set to true to allow multiple files to be selected
                  });
             
                  // When an image is selected, run a callback.
                  file_frame.on('select', function () {
                     // We set multiple to false so only get one image from the uploader
             
                     var attachment = file_frame.state().get('selection').first().toJSON();
             
                     $button.siblings('input').val(attachment.url);
             
                  }); 
                }
             
                  // Finally, open the modal
                  file_frame.open();
               });
            });
        </script>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['image'] = ( ! empty( $new_instance['image'] ) ) ? $new_instance['image'] : '';
        $instance['desc'] = ( ! empty( $new_instance['desc'] ) ) ? strip_tags($new_instance['desc']) : '';
        $instance['link'] = ( ! empty( $new_instance['link'] ) ) ? strip_tags($new_instance['link']) : '';

		return $instance;
	}

} // class Custom_Card_Widget

function register_card_widget() {
    register_widget('Custom_Card_Widget');
}

add_action('widgets_init', 'register_card_widget');
