<?php
/**
 * Class ICFP file.
 * 
 * @package ICFP
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}


if ( ! class_exists( 'ICFP', false ) ) :

    /**
     * ICFP Class
     */
	class ICFP {
		/**
         * Member Variable
         *
         * @var object instance
         */
        private static $instance;

        /**
         * Returns the *Singleton* instance of this class.
         *
         * @return Singleton The *Singleton* instance.
         */
        public static function get_instance() {
            if ( null === self::$instance ) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        /**
         * Class Constructor
         * 
         * @since  0.0.1
         * @return void
         */
		public function __construct() {

			// Check whether Caldera form is active or not
			register_activation_hook( __FILE__, array( $this, 'icfp_integration_activate' ) );
	    	
	    	//Register Processor Hook
	   		add_filter( 'caldera_forms_get_form_processors',  array( $this, 'icfp_register_processor' ) );
	   		
		}
		/**
		 * Check Caldera Forms is active or not
		 *
		 * @since 1.0
		 */
		public function icfp_integration_activate( $network_wide ) {
			 if( ! function_exists( 'caldera_forms_load' ) ) {
			    wp_die( 'The "Caldera Forms" Plugin must be activated before activating the "Caldera Forms - Paystack Integration" Plugin.' );
			}
		}

		/**
		  * Add Our Custom Processor
		  *
		  * @uses "caldera_forms_get_form_processors" filter
		  *
		  * @since 0.0.1
		  *
		  * @param array $processors
		  * @return array Processors
		  *
		  */

		public function icfp_register_processor( $processors ) {
		  	$processors['cf_paystack_integration'] = array(
				'name'              =>  __( 'Paystack Integration', 'integrate-caldera-forms-paystack' ),
				'description'       =>  __( 'Send Caldera Forms submission data to Paystack using Paystack REST API.', 'integrate-caldera-forms-salesforce' ),
				'pre_processor'		=>  array( $this, 'cf_paystack_integration_processor' ),
				'template' 			=>  __DIR__ . '/config.php'
			);
			return $processors;
		}


		/**
	 	 * At process, get the post ID and the data and send to Paystack
		 *
		 * @param array $config Processor config
		 * @param array $form Form config
		 * @param string $process_id Unique process ID for this submission
		 *
		 * @return void|array
		 */

		public function cf_paystack_integration_processor( $config, $form, $process_id ) {

			if( !isset( $config['lcfp_paystack_environment'] ) || empty($config['lcfp_paystack_environment'] ) ) {
			    return;
			}

            if( !isset( $config['lcfp_paystack_currency'] ) || empty($config['lcfp_paystack_currency'] ) ) {
			    return;
			}


			if( !isset( $config['lcfp_test_key'] ) || empty( $config['lcfp_test_key'] ) ){
			    return;
		  	}

		  	if( !isset( $config['lcfp_live_key'] ) || empty( $config['lcfp_live_key'] ) ){
			    return;
		  	}

		  	if( !isset( $config['lcfp_payment_name'] ) || empty( $config['lcfp_payment_name'] ) ){
			    return;
		  	}
            
            if( !isset( $config['lcfp_payment_description'] ) || empty( $config['lcfp_payment_description'] ) ){
			    return;
		  	}
            
            if( !isset( $config['lcfp_payment_amount'] ) || empty( $config['lcfp_payment_amount'] ) ){
			    return;
		  	}

            if( !isset( $config['lcfp_payment_email'] ) || empty( $config['lcfp_payment_email'] ) ){
			    return;
		  	}

            $paystack_url = 'https://api.paystack.co/transaction/initialize';
			$paystack_environment = Caldera_Forms::do_magic_tags( $config['lcfp_paystack_environment'] );

			$paystack_test_key = Caldera_Forms::do_magic_tags( $config['lcfp_test_key'] );
			$paystack_live_key = Caldera_Forms::do_magic_tags( $config['lcfp_live_key'] );

			$paystack_payment_currency = Caldera_Forms::do_magic_tags( $config['lcfp_paystack_currency'] );

			$paystack_payment_name = Caldera_Forms::do_magic_tags( $config['lcfp_payment_name'] );
			$paystack_payment_description = Caldera_Forms::do_magic_tags( $config['lcfp_payment_description'] );

		  	$paystack_payment_email = Caldera_Forms::do_magic_tags( $config['lcfp_payment_email'] );
		  	$paystack_payment_amount = Caldera_Forms::do_magic_tags( $config['lcfp_payment_amount'] );

		  	/* sending form submission data to Paystack using Paystack REST API*/

		  	if( $paystack_environment == "1" ) { 
		  		$key = $paystack_live_key;
		  	} else {
                $key = $paystack_test_key;
		  	}
            $amount = $paystack_payment_amount*100;
		  	
              //header
                  $headers = array(
                    'Content-Type'  => 'application/json',
                    'Authorization' => 'Bearer '.$key,
                );
                
                //body
                $body = array(
                    'email'        => $paystack_payment_email,
                    'amount'       => $amount,
                    'currency'     => $paystack_payment_currency
                );

                $args = array(
                    'body'      => json_encode($body),
                    'headers'   => $headers,
                    'timeout'   => 60
                );

                // POST the data to Paystack
                $request = wp_remote_post($paystack_url, $args);
                if (!is_wp_error($request)) {
                    	// Find out what the response code is
                  $paystack_response = json_decode(wp_remote_retrieve_body($request));
            
                    if ($paystack_response->status) {
                        
                        $url = $paystack_response->data->authorization_url;
                       
                        $response = array(
                            'redirect_url' => esc_url($url),
                            );
                            
                         _e(json_encode($response));
                            wp_die();
              }
                exit;
             }
		}

	}

	/**
     * Calling class using 'get_instance()' method
     */
    ICFP::get_instance();

endif;

