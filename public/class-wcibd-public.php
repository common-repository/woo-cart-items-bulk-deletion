<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://profiles.wordpress.org/stange
 * @since      1.0.0
 *
 * @package    Wcibd
 * @subpackage Wcibd/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wcibd
 * @subpackage Wcibd/public
 * @author     Yannick ZOHOU <zohoustanley@gmail.com>
 */
class Wcibd_Public {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Wcibd_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Wcibd_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/wcibd-public.css', array(), $this->version, 'all');
        wp_enqueue_style('wcibd-jquery-alert-css', plugin_dir_url(__FILE__) . 'css/jquery-confirm.min.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Wcibd_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Wcibd_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/wcibd-public.js', array('jquery'), $this->version, false);
        
        wp_localize_script($this->plugin_name, 'wcibd_ajax_object', array(
                'wcibd_ajax_url' => admin_url('admin-ajax.php'),
                'upload' => __( 'upload', 'wcibd' ),
                'Confirm_deletion' => __( 'Confirm deletion!', 'wcibd' ),
                'really_empty' => __( 'Do you really want to empty the cart?', 'wcibd' ),
                'really_delete' => __( 'Do you really want to delete the selected items from the cart ?', 'wcibd' ),
            )
        );

        wp_enqueue_script('wcibd-jquery-alert-js', plugin_dir_url(__FILE__) . 'js/jquery-confirm.min.js', array('jquery'), $this->version, false);

    }

    /**
     * Function to display the action button in the cart.
     */
    public function wcibd_action_buttons() {
        ?>
        <div class="wcibd-buttons-group">
            <div class="wcibd-buttons-left">
                <input type="checkbox" id="wcibd-chekall" />
            </div>
            <div class="wcibd-buttons-right">
                <input type="button" value="<?php _e('Delete', 'wcibd') ?>" id="wcibd-delete-selected"/>
                <input type="button" value="<?php _e('Empty cart', 'wcibd') ?>" id="wcibd-delete-all"/>
            </div>
        </div>
        <?php
        wp_nonce_field( 'wcibd_selection', 'wcibd_nonce' );
    }

    /**
     * Function to display checkbox for each item in the cart.
     * @param type $thumbnail_code Thumbnail code.
     * @param type $cart_item Cart item object.
     * @param type $cart_item_key Cart item key.
     */
    public function wcibd_add_add_single_checkbox($thumbnail_code, $cart_item, $cart_item_key) {
        ?>
        <input type="checkbox" class="wcibd-single-item" value="" data-item="<?php echo $cart_item_key; ?>">
        <?php
        return $thumbnail_code;
    }

    /**
     * Delete all items.
     */
    public function wcibd_delete_selected_items() {
        global $woocommerce;
        if (isset($_POST['data']) && wp_verify_nonce($_POST['wcibd_nonce'], 'wcibd_selection')) {
            $keys = $_POST['data'];
            if (is_array($keys) && !empty($keys)) {
                foreach ($keys as $index => $cart_item_key) {
                    $woocommerce->cart->remove_cart_item($cart_item_key);
                }
            }
        }
        return;
    }

    /**
     * Delete all items.
     */
    public function wcibd_delete_all() {
        global $woocommerce;
        $woocommerce->cart->empty_cart();
        return;
    }

}
