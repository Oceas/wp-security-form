<?php
/**
 * Plugin Name: Thrifty Order Form
 * Description: Simple Ajax Order Form
 * Version:     1.0
 * Author:      ThriftyDeveloper
 * Author URI:  http://connectedchurch.app
 * License:     GPL2
 * Textdomain:  ThriftyDeveloper
 *
 * @package     ConnectedChurch/ThriftyDeveloper
 * @since       1.0
 */

namespace ThriftyDeveloper;

/**
 * Order Form.
 *
 * @author Scott Anderson
 * @since  1.0
 */
class Order {

	/**
	 * Construct
	 *
	 * @since  0.1.0
	 * @author Scott Anderson
	 */
	public function __construct() {
		$this->hooks();
	}

	/**
	 * Register form Hooks.
	 *
	 * @author Scott Anderson
	 * @since  1.0
	 */
	private function hooks() : void {
		add_shortcode( 'td-order-form', [ $this, 'order_form' ] );
		add_action( 'init', [ $this, 'enqueue_my_styles' ] );
		add_action( 'wp_ajax_order_form', [ $this, 'process_order_form' ] );
		add_action( 'wp_ajax_nopriv_order_form', [ $this, 'process_order_form' ] );
	}

	/**
	 * Register Form Styles and Scripts
	 *
	 * @author Scott Anderson
	 * @since  1.0
	 */
	function enqueue_my_styles() {

		wp_enqueue_style( 'tdr-skeleton-css', plugins_url( '/utils/css/skeleton.css', __FILE__ ) );
		wp_enqueue_script( 'tdr-sermons-js', plugins_url( '/utils/js/form.js', __FILE__ ), array( 'jquery' ) );

	}

	/**
	 * Process Order
	 *
	 * @since  1.0
	 * @author Scott Anderson
	 */
	public function process_order_form() {
		return wp_send_json_success( $_POST );
	}

	/**
	 * Order Form
	 *
	 * @author Scott Anderson
	 * @since  1.0
	 */
	public function order_form() { ?>
		<div class='thrifty-developer'>
			<h1>Order Form</h1>
			<p>Please allow 2-3 buisness days for orders to ship.</p>
			<form id="order-form">
				<div class="row">
					<div class="six columns">
						<label for="name">Name</label>
						<input class="u-full-width" type="text" placeholder="John Doe" id="name" name="name">
					</div>
					<div class="six columns">
						<label for="account">Account Number</label>
						<input class="u-full-width" type="number" placeholder="12345678" id="account" name="account" minlength="8" maxlength="8">
					</div>
				</div>
				<div class="row">
					<div class="six columns">
						<label for="email">Email</label>
						<input class="u-full-width" type="email" placeholder="test@mailbox.com" id="email" name="email">
					</div>
					<div class="six columns">
						<label for="phone">Phone</label>
						<input class="u-full-width" type="text" placeholder="321-123-1234" id="phone" name="phone" minlength="12" maxlength="12">
					</div>
				</div>
				<div class="row">
					<label for="address">Address</label>
					<input class="u-full-width" type="text" placeholder="123 Main St. Orlando" id="address" name="address">
				</div>
				<div class="row">
					<div class="four columns">
						<label for="city">City</label>
						<input class="u-full-width" type="text" placeholder="Orlando" id="city" name="city">
					</div>
					<div class="four columns">
						<label for="state">State</label>
						<input class="u-full-width" type="text" placeholder="FL" id="state" name="state">
					</div>
					<div class="four columns">
						<label for="zip">Zip</label>
						<input class="u-full-width" type="text" placeholder="32807" id="zip" name="zip">
					</div>
				</div>
				<hr/>
				<div class="row">
					<div class="six columns">
						<label for="product">Product</label>
						<input class="u-full-width" type="text" placeholder="20' Ladder" id="product" name="product">
					</div>
					<div class="six columns">
						<label for="quantity">Quantity</label>
						<input class="u-full-width" type="number" placeholder="23" id="quantity" name="quantity">
					</div>
				</div>
				<hr/>
				<div class="row">
					<div class="four columns">
						<label for="cc-number">CC Number</label>
						<input class="u-full-width" type="number" placeholder="1234567890123456" id="cc-number" name="cc-number" minlength="16" maxlength="16">
					</div>
					<div class="four columns">
						<label for="cvv">CC CVV</label>
						<input class="u-full-width" type="number" placeholder="23" id="cvv" name="cvv" minlength="3" maxlength="3">
					</div>
					<div class="four columns">
						<label for="expiration">CC Expiration</label>
						<input class="u-full-width" type="date" placeholder="10/31/2026" id="expiration" name="expiration">
					</div>
				</div>
				<hr/>
				<div class="row">
					<label for="expiration">Notes</label>
					<textarea class="u-full-width" placeholder="" id="notes"name="notes"></textarea>
				</div>
				<input class="button-primary" type="submit" id="place-order" value="Submit">
			</form>
		</div>
	<?php
	}

}

new Order();
