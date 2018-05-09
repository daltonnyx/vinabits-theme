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
    private $description;

    function __construct($params) {
        extract($params);
        $this->name = $name;
        $this->post_type = $post_type;
        $this->caption = $caption;
        $this->type = $type;
        $this->description = $description;
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
        require get_template_directory() . '/inc/metaboxes/'.$this->type.'-box.php';
    }

    function save($post_id) {
        $post_type = get_post_type($post_id);
        if( isset( $_POST[$this->name] ) && is_array($_POST[$this->name]) ) {
            update_post_meta( $post_id,  '_vnb_'. $this->name, $_POST[$this->name] );
        }
        else if ( isset( $_POST[$this->name] ) ) {
            update_post_meta( $post_id,  '_vnb_'. $this->name , esc_html( $_POST[$this->name] ) ) ;
        }
    }

    private function get_value($post_id) {
        return get_post_meta( $post_id, $this->name, true );
    }

    function add_posts_column($columns) {
        $columns[$this->name] = $this->caption;
        return $columns;
    }

    function render_custom_column($column, $post_id) {
        switch ($column) {
            case $this->name:
                include get_template_directory() . '/inc/metaboxes/'.$this->type.'-column.php';
                break;
            
            default:
                echo '';
                break;
        }
    }

    static function load_media_script() {
        wp_enqueue_media();
        wp_enqueue_script('media-upload');
        wp_enqueue_script( 'vinabitsBox-media-js', get_template_directory_uri() . '/assets/js/admin/load_mediaupload.js' );
    }

    static function RegisterMetabox($name, $caption, $post_type = 'post', $type = 'text',  $has_column = false, $description = '', callable $script_cb = null) {
        $vnb_box = new VinabitsExtraBox([
            'name' => $name,
            'post_type' => $post_type,
            'caption' => $caption,
            'type' => $type,
            'description' => $description
        ]);

        add_action( 'add_meta_boxes', array($vnb_box,'vinabits_register_metabox') );
        add_action('save_post', array($vnb_box, 'save'));
        if( $type == "images" && $script_cb == null ) {
            add_action( 'admin_enqueue_scripts', array('VinabitsExtraBox', 'load_media_script') );
        }
        else if($script_cb != null) {
             add_action( 'admin_enqueue_scripts', $script_cb );
        }

        if($has_column) {
            add_filter("manage_".$post_type."_posts_columns",array($vnb_box, 'add_posts_column'));
            add_action("manage_".$post_type."_posts_custom_column", array($vnb_box, 'render_custom_column'), 10, 2);
        }
    }
}
