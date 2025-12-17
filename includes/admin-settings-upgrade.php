<?php
if ( function_exists( 'satori_studio_feature_enabled' ) && ! satori_studio_feature_enabled( 'ui-legacy-upgrade-screen' ) ) {
        echo '<div class="fl-settings-form fl-upgrade-page-content">' . esc_html__( 'The upgrade screen is disabled for SATORI Studio.', 'satori-studio' ) . '</div>';
        return;
}
?>

<div id="fl-upgrade-form" class="fl-settings-form fl-upgrade-page-content">

	<h3 class="fl-settings-form-header"><?php _e( 'Get More Features', 'satori-studio' ); ?></h3>

	<p><?php _e( 'Along with access to our expert support team, the premium versions of SATORI Studio are packed with more features to save you time and make building websites easier!', 'satori-studio' ); ?></p>

	<h4><?php _e( 'Premium Features', 'satori-studio' ); ?></h4>

	<ul>
		<li><?php _e( 'Additional modules: Contact Form, Tabs, Slider, Pricing Table, Map, Blog Posts, Subscribe Form, Social Icons, and many more.', 'satori-studio' ); ?></li>
		<li><?php _e( 'Expert support from our world-class support team.', 'satori-studio' ); ?></li>
		<li><?php _e( 'Beautiful pre-made layout templates.', 'satori-studio' ); ?></li>
		<li><?php _e( 'Save, export, and reuse full-page layouts, rows, and modules.', 'satori-studio' ); ?></li>
		<li><?php _e( 'Build your own custom modules.', 'satori-studio' ); ?></li>
	</ul>

	<p><?php _e( 'Come by the SATORI Studio Homepage to learn more about what our premium features can do for you!', 'satori-studio' ); ?></p>

	<?php
	$upgrade_url = FLBuilderModel::get_upgrade_url( array(
		'utm_medium'   => 'bb-lite',
		'utm_source'   => 'upgrade-settings-page',
		'utm_campaign' => 'settings-upgrade-button',
	) );
	?>
	<input type="button" class="button button-primary" value="<?php _e( 'Learn More', 'satori-studio' ); ?>" onclick="window.open('<?php echo $upgrade_url; ?>');" style="margin-right: 10px;">

</div>
