<?php

/**
 *	WordPress Revised Meta Tag Plugin (wprmt.php)
 *
 *	Admin Settings file
 *
 *	@package WordPress
 *	@subpackage WordPress Revised Meta Tag Plugin
 */

/**
 * CAUTION: DO NOT MODIFY THIS PAGE
 */

function wprmt_options_page() {
	add_options_page('WordPress Revised Meta Tag Plugin: Options', 'Revised Meta Tag', 'manage_options', __FILE__, 'wprmt_settings' );
}

function wprmt_settings() {
	?>
	<div class="wrap">
	<?php screen_icon(); ?>
		<h2>WordPress Revised Meta Tag Plugin: Options</h2>
		<form action="options.php" method="post">
		<?php
			settings_fields('wprmt_options');
			do_settings_sections('wprmt');
			wprmt_support();
		?>
			<div class="wprmt-clear"></div>
			<input type="submit" name="Submit" id="submit" class="button button-primary" value="Save Changes" />
		</form>
	</div>
	<?php
}

add_action('admin_init', 'wprmt_admin_init');
function wprmt_admin_init() {
	register_setting('wprmt_options', 'wprmt_options', 'wprmt_validate_options');
	add_settings_section('wprmt_rdmi', 'Revise Date Meta Information', 'wprmt_rdmi_text', 'wprmt');
	add_settings_field('wprmt_rdmi_field1', 'Posts', 'wprmt_setting_rdmi1', 'wprmt', 'wprmt_rdmi');
	add_settings_field('wprmt_rdmi_field2', 'Pages', 'wprmt_setting_rdmi2', 'wprmt', 'wprmt_rdmi');
	add_settings_section('wprmt_luts', 'Last Updated Timestamp', 'wprmt_luts_text', 'wprmt');	
	add_settings_field('wprmt_luts_field1', 'Show Last Updated Timestamp', 'wprmt_setting_luts1', 'wprmt', 'wprmt_luts');
	add_settings_field('wprmt_luts_field2', 'Select position', 'wprmt_setting_luts2', 'wprmt', 'wprmt_luts');
	add_settings_field('wprmt_luts_field3', 'Select format', 'wprmt_setting_luts3', 'wprmt', 'wprmt_luts');
	add_settings_field('wprmt_luts_field4', 'Verb to display eg. "Last updated:"', 'wprmt_setting_luts4', 'wprmt', 'wprmt_luts');
}

function wprmt_rdmi_text() {
	echo "Inserts the revised date meta information in the <code>&lt;head&gt;</code> section of your posts and pages.<br/>The inserted code will look like: <code>&lt;meta name=&quot;revised&quot; content=&quot;Sunday, May 12, 2013, 8:56 pm&quot; /&gt;</code><br/><br/><b>Activate Revised date meta for:</b>";
}

function wprmt_luts_text() {
	echo "Inserts a last updated timestamp above or below your posts and pages.<br/>Eg. Last Updated: Sunday, May 12, 2013";
}

function wprmt_setting_rdmi1() {
	$options = get_option('wprmt_options');
	$check_field1 = $options['check_field1'];
	$html = '<input id="check_field1" name="wprmt_options[check_field1]" type="checkbox" value="1"' . checked( 1, $options['check_field1'], false ) . '/>';
	$html.= ' <label for="check_field1">Check to activate</label>';
	echo $html;
}

function wprmt_setting_rdmi2() {
	$options = get_option('wprmt_options');
	$check_field2 = $options['check_field2'];
	$html = '<input id="check_field2" name="wprmt_options[check_field2]" type="checkbox" value="1"' . checked( 1, $options['check_field2'], false ) . '/>';
	$html.= ' <label for="check_field2">Check to activate</label>';
	echo $html;
}

function wprmt_setting_luts1() {
	$options = get_option('wprmt_options');
	$check_field3 = $options['check_field3'];
	$html = '<input id="check_field3" name="wprmt_options[check_field3]" type="checkbox" value="1"' . checked( 1, $options['check_field3'], false ) . '/>';
	$html.= ' <label for="check_field3">Check to activate</label>';
	echo $html;
}

function wprmt_setting_luts2() {
	$options = get_option('wprmt_options');
	$select_field1 = $options['select_field1'];
	?>
    <select id="select_field1" name="wprmt_options[select_field1]">
        <option value="1" <?php selected($options['select_field1'], 1); ?>>Above the Post</option>
        <option value="2" <?php selected($options['select_field1'], 2); ?>>Below the Post</option>
    </select>
    <?php
}

function wprmt_setting_luts3() {
	$options = get_option('wprmt_options');
	$select_field2 = $options['select_field2'];
	?>
    <select id="select_field2" name="wprmt_options[select_field2]">
        <option value="1" <?php selected($options['select_field2'], 1); ?>>Sunday, May 12, 2013</option>
        <option value="2" <?php selected($options['select_field2'], 2); ?>>12th May 2013, 8:56 PM</option>
        <option value="3" <?php selected($options['select_field2'], 3); ?>>12th May 2013</option>
        <option value="4" <?php selected($options['select_field2'], 4); ?>>05/12/2013</option>
        <option value="5" <?php selected($options['select_field2'], 5); ?>>12/05/2013</option>
    </select>
    <?php
}

function wprmt_setting_luts4() {
	$options = get_option('wprmt_options');
	$text_field1 = $options['text_field1'];
	?>
    <input type="text" id="text_field1" name="wprmt_options[text_field1]" value="<?php echo $options['text_field1']; ?>" />
    <?php
}

function wprmt_validate_options($input) {
	$valid = array();
	$valid['check_field1'] = $input['check_field1'];
	$valid['check_field2'] = $input['check_field2'];
	$valid['check_field3'] = $input['check_field3'];
	$valid['select_field1'] = $input['select_field1'];
	$valid['select_field2'] = $input['select_field2'];
	$valid['text_field1'] = $input['text_field1'];
	return $valid;
}

function wprmt_support() {
?>
<style type="text/css">
.wprmt-share-buttons{
	padding:10px;
	background:#f9f9f9;
	border:1px solid #eee;
	display:inline-block;
	margin-bottom:15px;
	height:25px;
}
.wprmt-share-buttons li{
	float:left;
	min-width:65px;
	width:95px;
	margin-right:5px;
}
.wprmt-plugin-support{
	display:block;
	padding:3px 6px;
	background:#3676B7;
	color:#fff;
	text-decoration: none;
	border-radius:2px;
	-moz-border-radius:2px;
	-webkit-border-radius:2px;
}
.wprmt-plugin-support:hover{
	background:#D54E21;
	color:#fff;
}
.wprmt-clear{clear:both;}
.wprmt-clearfix:after {
	visibility:hidden;
	display:block;
	font-size:0;
	content:" ";
	clear:both;
	height:0;
}
* html .wprmt-clearfix { zoom:1; }

:first-child+html .wprmt-clearfix { zoom:1; }
</style>
<ul class="wprmt-share-buttons wprmt-clearfix">
	<li><iframe src="//www.facebook.com/plugins/like.php?href=http://w3bits.com/wordpress-revised-meta-tag-plugin/&amp;send=false&amp;layout=button_count&amp;width=120&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=arial&amp;height=21&amp;" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:120px; height:21px;" allowTransparency="true"></iframe></li>
	<li><a href="https://twitter.com/share" class="twitter-share-button" data-url="http://w3bits.com/wordpress-revised-meta-tag-plugin/" data-text="WordPress Revised Meta Tag Plugin" data-count="" data-via="w3bits_" data-related="w3bits_" data-hashtags="" data-dnt="true">Tweet</a></li>
	<li><div class="g-plusone" data-size="medium" data-href="http://w3bits.com/wordpress-revised-meta-tag-plugin/"></div></li>
	<li><a class="wprmt-plugin-support" href="http://w3bits.com/wordpress-revised-meta-tag-plugin/" target="_blank">Plugin Support</a></li>
</ul>
<?php
}

function wprmt_admin_scripts() {
        wp_register_script( 'plus1', 'https://apis.google.com/js/plusone.js', false, array() );
        wp_register_script( 'tweet', 'https://platform.twitter.com/widgets.js', false, array() );
        wp_enqueue_script( 'plus1' );
        wp_enqueue_script( 'tweet' );
}
add_action( 'admin_enqueue_scripts', 'wprmt_admin_scripts' );

?>