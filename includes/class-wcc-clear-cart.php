<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists('WccClearCart') ) {
    class WccClearCart{
        public static ?WccClearCart $instance = null;

        public static function getInstance(): WccClearCart {
            if ( is_null( self::$instance ) ) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        public function __construct() {
            add_action( 'woocommerce_cart_actions', array($this,'wccAddClearCartBtn'));
            add_action('wp_enqueue_scripts', array($this, 'wccRegisterAssets'));
        }
        public function wccRegisterAssets(){
            wp_enqueue_script('wcc-clear-cart-js', WCC_JS . 'wcc-clear-cart-button.js', ['jquery'], WCC_VERSION, true);
            wp_localize_script('wcc-clear-cart-js', 'wccClearItemsAjax', array('ajaxurl' => admin_url('admin-ajax.php')));
            wp_enqueue_style('wcc-clear-cart-css', WCC_CSS . 'wcc-style-btn.css', [], WCC_VERSION, 'all');
        }

        function wccAddClearCartBtn() {
            ?>
            <div class="button-container">
                <button type="button" id="<?php echo esc_attr( 'wcc-clear-cart-btn' ); ?>"><?php esc_html_e( 'Clear Cart', 'woocommerce-clear-cart' ); ?></button>
            </div>
            <?php
        }
    }
}