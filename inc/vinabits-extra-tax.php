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
    }

}
