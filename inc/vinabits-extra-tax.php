<?php

/**
 * Class VinabitsExtra
 * @author daltonnyx
 */
class VinabitsExtraTax
{

    function __construct() {

    }

    public $tax_args;
    public $tax_name;
    public $tax_for;

    function vinabits_register_tax() {
        register_taxonomy($this->tax_name, $this->tax_for, $this->tax_args);
    }

    function filter_by_taxonomy($post_type, $which) {
        if($post_type !== $this->tax_for)
            return;
        $terms = get_terms($this->tax_name);
        
        echo "<select name='$this->tax_name' id='$this->tax_name' class='postform'>";
        echo '<option value="">' . sprintf( esc_html__( 'Show All %s', 'text_domain' ), $this->tax_args['labels']['name'] ) . '</option>';
        foreach ( $terms as $term ) {
			printf(
				'<option value="%1$s" %2$s>%3$s (%4$s)</option>',
				$term->slug,
				( ( isset( $_GET[$this->tax_name] ) && ( $_GET[$this->tax_name] == $term->slug ) ) ? ' selected="selected"' : '' ),
				$term->name,
				$term->count
			);
		}
		echo '</select>';

    }

    static function RegisterTaxonomy($name, $for, $singular, $labels, $args = [], $hierarchical = true) {
        $label = [
            'name'              =>  "$labels",
            'singular_name'     =>  "$singular",
            'search_items'      =>  "Search $labels",
            'all_items'         =>  "All $labels",
            'parent_item'       =>  "Parent $singular",
            'parent_item_colon' =>  "Parent $singular:",
            'edit_item'         =>  "Edit $singular",
            'update_item'       =>  "Update $singular",
            'add_new_item'      =>  "Add New $singular",
            'new_item_name'     =>  "New $singular",
            'menu_name'         =>  "$labels",
        ];
        $DEFAULT_TAX_ARGS = array(
      		'hierarchical'      => true,
      		'labels'            => [],
      		'show_ui'           => true,
      		'show_admin_column' => true,
      		'query_var'         => true,
      		'rewrite'           => array( 'slug' => 'genre' ),
      	);
        $args['labels'] = $label;
        $args['hierarchical'] = $hierarchical;
        $args['rewrite'] = array('slug' => $name);
        $args = array_merge($DEFAULT_TAX_ARGS, $args);
        $vinaExtra = new VinabitsExtraTax();
        $vinaExtra->tax_args = $args;
        $vinaExtra->tax_name = $name;
        $vinaExtra->tax_for = $for;
        add_action('init', array($vinaExtra, 'vinabits_register_tax'));
        add_action( 'restrict_manage_posts', array($vinaExtra, 'filter_by_taxonomy') , 10, 2);
    }

}
