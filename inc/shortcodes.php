<?php
/*
 * Plugin Name: WooCommerce Cart Count Shortcode
 * Plugin URI: https://github.com/prontotools/woocommerce-cart-count-shortcode
 * Description: Display a link to your shopping cart with the item count anywhere on your site with a customizable shortcode.
 * Version: 1.0.2
 * Author: Pronto Tools
 * Author URI: http://www.prontotools.io
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */
function woocommerce_cart_count_shortcode( $atts ) {
    $defaults = array(
        "icon"               => "cart",
        "empty_cart_text"    => "",
        "items_in_cart_text" => "",
        "show_items"         => "",
        "show_total"         => "",
        "total_text"         => "",
        "custom_css"         => ""
    );

    $atts = shortcode_atts( $defaults, $atts );

    $icon_html = "";
    if ( $atts["icon"] ) {
        if ( "cart" == $atts["icon"] ) {
            $icon_html = '<i class="fa fa-shopping-cart"></i> ';
        } elseif ( $atts["icon"] == "basket" ) {
            $icon_html = '<i class="fa fa-shopping-basket"></i> ';
        } else {
            $icon_html = '<i class="fa fa-' . $atts["icon"] . '"></i> ';
        }
    }

    $cart_count = "";
    if ( class_exists( "WooCommerce" ) ) {
        global $woocommerce;

        $cart_count = $woocommerce->cart->get_cart_contents_count();
        $cart_total = $woocommerce->cart->get_cart_total();

        $cart_count_html = "";
        if ( "true" == $atts["show_items"] ) {
            $cart_count_html = ' <span class="items">' . $cart_count . "</span>";
        }

        $cart_total_html = "";
        if ( "true" == $atts["show_total"] ) {
            if ( $atts["total_text"] ) {
                $cart_total_html = " " . $atts["total_text"] . " " . $cart_total;
            }
            else {
                $cart_total_html = " Total: " . $cart_total;
            }
        }

        $cart_text_html = "";
        $link_to_page = "";
        if ( $cart_count > 0 ) {
            if ( "" != $atts["items_in_cart_text"] ) {
                $cart_text_html = $atts["items_in_cart_text"];
            }
            $link_to_page = ' href="' . $woocommerce->cart->get_cart_url() . '"';
        } else {
            if ( "" != $atts["empty_cart_text"] ) {
                $cart_text_html = $atts["empty_cart_text"];
            }
            $link_to_page = ' href="' . wc_get_page_permalink( 'shop' ) . '"';
        }
    }

    $custom_css = "";
    if ( $atts["custom_css"] ) {
        $custom_css = ' class="' . $atts["custom_css"] . '"';
    }

    $html  = "<a" . $link_to_page . $custom_css . ">";
    $html .= $icon_html . $cart_text_html . $cart_count_html . $cart_total_html;
    $html .= "</a>";

    return $html;
}

add_shortcode( "cart_button", "woocommerce_cart_count_shortcode" );


function searchform_shortcode($atts) {
    ob_start();
?>
<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
    <label>
        <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
        <input type="search" class="search-field"
            placeholder="<?php echo esc_attr_x( 'Nhập từ khoá tìm kiếm', 'vinabits' ) ?>"
            value="<?php echo get_search_query() ?>" name="s"
            title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
    </label>
    <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
    </form>
<?php
    return ob_get_clean();
}

add_shortcode('vinabits_searchform','searchform_shortcode');


function hot_products_shortcode($atts) {
    ob_start();
?>
<div class="hot-product">
    <header>
        <h2 class="home-title"><?php echo is_array($atts) && array_key_exists("title", $atts) ? $atts['title'] : 'Sản phẩm bán chạy'; ?></h2>
    </header>
    <?php get_hot_product(); ?>
    <script type="text/javascript" defer>
    jQuery(document).ready(function($) {
        $(".hot-products").owlCarousel({
            margin: 8,
            loop: true,
            dots: false,
            autoplay: true,
            responsive: {
                0 : {
                    items: 2,
                },
                768: {
                    items: 3,
                },
                1170: {
                    items: 5,
                }
            }
        });
    });
    </script>
</div>

<?php
    return ob_get_clean();
}

add_shortcode('vinabits_hotproducts', 'hot_products_shortcode');
