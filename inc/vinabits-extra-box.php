<?php


/**
 * Class VinabitsExtraBox
 * @author daltonnyx
 */
class VinabitsExtraBox
{

    private $name;
    private $post_type;
    private $caption;
    private $type;

    function __construct($params) {
        extract($params);
        $this->name = $name;
        $this->post_type = $post_type;
        $this->caption = $caption;
        $this->type = $type;
    }

    function vinabits_register_metabox() {
        add_meta_box(
            $this->name,
            $this->caption,
            array($this, 'render_box'),
            $this->post_type
        );
        
    }

    function render_box( $post ) {
        wp_nonce_field( $this->name, $this->name .  '_nonce' );
        if($this->type == 'text') {
?>
        <p>
          <label for="<?php echo $this->name ?>"><?php echo $this->caption; ?></label>
          <br />
          <input class="widefat" type="text" name="<?php echo $this->name ?>" id="<?php echo $this->name ?>" 
                 value="<?php echo get_post_meta( $post->ID, '_vnb_' . $this->name, true ); ?>" size="30" />
        </p>
<?php
        }
    }

    function save($post_id) {
        $post_type = get_post_type($post_id);
        if($post_type != $this->post_type) return;
        if ( isset( $_POST[$this->name] ) ) {
            update_post_meta( $post_id,  '_vnb_'. $this->name , sanitize_text_field( $_POST[$this->name] ) ) ;
        }
    }

    static function RegisterMetabox($name, $caption, $post_type = 'post', $type = 'text') {
        $vnb_box = new VinabitsExtraBox([
            'name' => $name,
            'post_type' => $post_type,
            'caption' => $caption,
            'type' => $type
        ]);

        add_action( 'add_meta_boxes', array($vnb_box,'vinabits_register_metabox') );
        add_action('save_post', array($vnb_box, 'save'));
    }
}
