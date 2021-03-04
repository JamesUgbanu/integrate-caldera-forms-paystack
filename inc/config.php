<div class="caldera-config-group">
	<label><?php esc_html_e( 'Environment', 'integrate-caldera-forms-paystack' ); ?> </label>
	<div class="caldera-config-field">
		<select class="block-input field-config" name="{{_name}}[icfp_paystack_environment]" id="icfp_paystack_environment">
			<option value="1" {{#is context value="1"}}selected="selected"{{/is}}><?php esc_html_e( 'Live Secret Key', 'integrate-caldera-forms-paystack' ); ?></option>
            <option value="0" {{#is context value="0"}}selected="selected"{{/is}}><?php  esc_html_e( 'Test Secret Key', 'integrate-caldera-forms-paystack' ); ?></option>
		</select>
	</div>
</div>

<div class="caldera-config-group">
    <label><?php esc_html_e( 'Paystack Test Secret Key', 'integrate-caldera-forms-paystack' ); ?> </label>
    <div class="caldera-config-field">
        <input type="text" class="block-input field-config" id="icfp_test_key" name="{{_name}}[icfp_test_key]" value="{{icfp_test_key}}">
        <div class="description">
            <?php echo __( 'Get your API keys from <a href="https://dashboard.paystack.com/#/settings/developer">Click Here</a>', 'integrate-caldera-forms-paystack' ); ?>
            </div>
    </div>
</div>

<div class="caldera-config-group">
    <label><?php esc_html_e( 'Paystack Live Secret Key', 'integrate-caldera-forms-paystack' ); ?> </label>
    <div class="caldera-config-field">
        <input type="text" class="block-input field-config" id="icfp_live_key" name="{{_name}}[icfp_live_key]" value="{{icfp_live_key}}">
        <div class="description">
            <?php echo __( 'Get your API keys from <a href="https://dashboard.paystack.com/#/settings/developer">Click Here</a>', 'integrate-caldera-forms-paystack' ); ?>
            </div>
    </div>
</div>

<div class="caldera-config-group">
	<label><?php esc_html_e( 'Currency', 'integrate-caldera-forms-paystack' ); ?> </label>
	<div class="caldera-config-field">
		<select class="block-input field-config" name="{{_name}}[icfp_paystack_currency]" id="icfp_paystack_currency">
			<option value="NGN" {{#is context value="NGN"}}selected="selected"{{/is}}><?php esc_html_e( 'Nigerian Naira', 'integrate-caldera-forms-paystack' ); ?></option>
            <option value="GHC" {{#is context value="GHC"}}selected="selected"{{/is}}><?php  esc_html_e( 'Ghana Cedis', 'integrate-caldera-forms-paystack' ); ?></option>
		</select>
	</div>
</div>

<div class="caldera-config-group">
    <label><?php esc_html_e( 'Payment Name', 'integrate-caldera-forms-paystack' ); ?> </label>
    <div class="caldera-config-field">
        <input type="text" class="block-input field-config magic-tag-enabled caldera-field-bind required" id="icfp_payment_name" name="{{_name}}[icfp_payment_name]" value="{{icfp_payment_name}}" required="required">
    </div>
</div>

<!-- <div class="caldera-config-group">
    <label><?php esc_html_e( 'Payment description', 'integrate-caldera-forms-paystack' ); ?> </label>
    <div class="caldera-config-field">
        <input type="text" class="block-input field-config magic-tag-enabled caldera-field-bind required" id="icfp_payment_description" name="{{_name}}[icfp_payment_description]" value="{{icfp_payment_description}}">
    </div>
</div> -->

<div class="caldera-config-group">
    <label><?php esc_html_e( 'Amount', 'integrate-caldera-forms-salesforce' ); ?> </label>
    <div class="caldera-config-field">
        <input type="number" class="block-input field-config magic-tag-enabled caldera-field-bind required" id="icfp_payment_amount" name="{{_name}}[icfp_payment_amount]" value="{{icfp_payment_amount}}" required="required">
    </div>
</div>

<div class="caldera-config-group">
    <label><?php esc_html_e( 'Email', 'integrate-caldera-forms-salesforce' ); ?> </label>
    <div class="caldera-config-field">
        <input type="email" class="block-input field-config magic-tag-enabled caldera-field-bind required" id="icfp_payment_email" name="{{_name}}[icfp_payment_email]" value="{{icfp_payment_email}}" required="required">
    </div>
</div>

<div class="caldera-config-group">
    <div>For additional feature, contact us <a href="https://crystalwebpro.com/" target="_blank">here</a></div>
</div>
