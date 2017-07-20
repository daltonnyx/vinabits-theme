<?php

/**
 * Class VinabitsExtra
 * @author daltonnyx
 */
class VinabitsExtraType
{
    public $type_args = [];
    public $type_name = '';
    function __construct() {
    
    }

    public function vinabits_register_type() {
        
        register_post_type($this->type_name, $this->type_args);
    }

    const DEFAULT_TYPE_ARGS =  [
        'labels'             =>  [],
        'description'        => 'Description.',
	'public'             => true,
	'publicly_queryable' => true,
	'show_ui'            => true,
	'show_in_menu'       => true,
	'query_var'          => true,
	'rewrite'            => array( 'slug' => 'promo' ),
	'capability_type'    => 'post',
	'has_archive'        => true,
        'hierarchical'       => false,
        'taxonomies'         => [],
	'menu_position'      => null,
	'supports'           => array(  )
    ];

    static function RegisterType($name, $singular , $label, $options = [], $supports = ['title', 'editor', 'thumbnail' ], $has_archive = true) {
        $labels  = [
        'name'               =>  $label,
		'singular_name'      =>  $singular,
		'menu_name'          =>  $label,
		'name_admin_bar'     =>  $singular,
		'add_new'            =>  "Add $singular",
		'add_new_item'       =>  "Add New $singular",
		'new_item'           =>  "New $singular",
		'edit_item'          =>  "Edit $singular",
		'view_item'          =>  "View $singular",
		'all_items'          =>  "All $label",
		'search_items'       =>  "Search $label",
		'parent_item_colon'  =>  "Parent $label:",
		'not_found'          =>  "No $label found.",
		'not_found_in_trash' =>  "No $label found in Trash.",
        ];
        $vinaExtra = new VinabitsExtraType();
        $vinaExtra->type_name = $name;
        $options['labels'] = $labels;
        $options['supports'] = $supports;
	$options['rewrite'] = array( 'slug' => $name );
        $options['has_archive'] = $has_archive;
        $options = array_merge(VinabitsExtraType::DEFAULT_TYPE_ARGS, $options);
        $vinaExtra->type_args = $options;
        add_action('init', array($vinaExtra, 'vinabits_register_type'));
    }
    
}
