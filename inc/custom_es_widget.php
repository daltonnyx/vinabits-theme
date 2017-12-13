<?php

class vnb_es_widget_register extends WP_Widget {
	function __construct() {
		$widget_ops = array('classname' => 'widget_text vnb-elp-widget', 'description' => __( "Custom ES Widget", 'vinabits' ), 'vnb-email-subscribers');
		parent::__construct('vnb-email-subscribers', __( "Vinabits Email Subscribers", 'vinabits' ), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );

		$es_title   = apply_filters( 'widget_title', empty( $instance['es_title'] ) ? '' : $instance['es_title'], $instance, $this->id_base );
		$es_desc    = $instance['es_desc'];
		$es_name    = $instance['es_name'];
		$es_group   = $instance['es_group'];

		echo $args['before_widget'];
		if ( ! empty( $es_title ) ) {
			echo $args['before_title'] . $es_title . $args['after_title'];
		}

		// display widget method
		$url = home_url();

		global $es_includes;
		if (!isset($es_includes) || $es_includes !== true) {
			$es_includes = true;
		}
		?>

		<div>
			<form class="es_widget_form" data-es_form_id="es_widget_form">
				<?php if( $es_desc != "" ) { ?>
					<div class="es_caption"><?php echo $es_desc; ?></div>
				<?php } ?>
				<?php if( $es_name == "YES" ) { ?>
					<div class="es_textbox">
						<input type="text" id="es_txt_name" required placeholder="Họ và tên (*)" class="es_textbox_class" name="es_txt_name" value="" maxlength="225">
					</div>
				<?php } ?>
				<div class="es_textbox">
					<input type="text" id="es_txt_email" placeholder="Email (*)" class="es_textbox_class" name="es_txt_email" onkeypress="if(event.keyCode==13) es_submit_page(event,'<?php echo $url; ?>')" value="" maxlength="225">
				</div>
				<div class="es_button">
					<input type="button" id="es_txt_button" class="btn btn-submit" name="es_txt_button" onClick="return es_submit_page(event,'<?php echo $url; ?>')" value="<?php echo __( 'Đăng ký', 'vinabits' ); ?>">
				</div>
				<div class="es_msg" id="es_widget_msg">
					<span id="es_msg"></span>
				</div>
				<?php if( $es_name != "YES" ) { ?>
					<input type="hidden" id="es_txt_name" name="es_txt_name" value="">
				<?php } ?>
				<input type="hidden" id="es_txt_group" name="es_txt_group" value="<?php echo $es_group; ?>">
			</form>
		</div>
		<?php
		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$instance               = $old_instance;
		$instance['es_title']   = ( ! empty( $new_instance['es_title'] ) ) ? strip_tags( $new_instance['es_title'] ) : '';
		$instance['es_desc']    = ( ! empty( $new_instance['es_desc'] ) ) ? strip_tags( $new_instance['es_desc'] ) : '';
		$instance['es_name']    = ( ! empty( $new_instance['es_name'] ) ) ? strip_tags( $new_instance['es_name'] ) : '';
		$instance['es_group']   = ( ! empty( $new_instance['es_group'] ) ) ? strip_tags( $new_instance['es_group'] ) : '';
		return $instance;
	}

	function form( $instance ) {
		$defaults = array(
			'es_title' => '',
			'es_desc'   => '',
			'es_name'   => '',
			'es_group'  => ''
		);
		$instance       = wp_parse_args( (array) $instance, $defaults);
		$es_title       = $instance['es_title'];
		$es_desc        = $instance['es_desc'];
		$es_name        = $instance['es_name'];
		$es_group       = $instance['es_group'];
		?>
		<p>
			<label for="<?php echo $this->get_field_id('es_title'); ?>"><?php echo __( 'Widget Title', 'vinabits' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('es_title'); ?>" name="<?php echo $this->get_field_name('es_title'); ?>" type="text" value="<?php echo $es_title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('es_desc'); ?>"><?php echo __( 'Short description about subscription form', 'vinabits' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('es_desc'); ?>" name="<?php echo $this->get_field_name('es_desc'); ?>" type="text" value="<?php echo $es_desc; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('es_name'); ?>"><?php echo __( 'Display Name Field', 'vinabits' ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('es_name'); ?>" name="<?php echo $this->get_field_name('es_name'); ?>">
				<option value="YES" <?php $this->es_selected($es_name == 'YES'); ?>><?php echo __( 'YES', 'vinabits' ); ?></option>
				<option value="NO" <?php $this->es_selected($es_name == 'NO'); ?>><?php echo __( 'NO', 'vinabits' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('es_group'); ?>"><?php echo __( 'Subscriber Group', 'vinabits' ); ?></label>
			<select class="widefat" name="<?php echo $this->get_field_name('es_group'); ?>" id="<?php echo $this->get_field_id('es_group'); ?>">
				<?php
					$groups = array();
					$groups = es_cls_dbquery::es_view_subscriber_group();
					if(count($groups) > 0) {
						$i = 1;
						foreach ($groups as $group) {
							?>
							<option value="<?php echo esc_html(stripslashes($group["es_email_group"])); ?>" <?php if(stripslashes($es_group) == $group["es_email_group"]) { echo 'selected="selected"' ; } ?>>
								<?php echo stripslashes($group["es_email_group"]); ?>
							</option>
							<?php
						}
					}
				?>
			</select>
		</p>
		<?php
	}

	function es_selected($var) {
		if ($var==1 || $var==true) {
			echo 'selected="selected"';
		}
	}
}

function register_es_widget() {
    register_widget('vnb_es_widget_register');
}

add_action('widgets_init', 'register_es_widget');
