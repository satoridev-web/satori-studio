<?php
use Satori_Studio\Admin\Global_Settings;

$current_tab     = isset( $_GET['tab'] ) ? sanitize_key( wp_unslash( $_GET['tab'] ) ) : '';
$global_settings = null;

if ( class_exists( Global_Settings::class ) ) {
        $global_settings = Global_Settings::instance();

        if (
                ! $global_settings
                && function_exists( 'satori_studio_environment' )
                && function_exists( 'satori_studio_design_system' )
        ) {
                $environment   = satori_studio_environment();
                $design_system = satori_studio_design_system();

                if ( $environment && $design_system ) {
                        $global_settings = new Global_Settings( $environment, $design_system );
                        $global_settings->register_settings();
                }
        }
}
?>
<div class="wrap <?php FLBuilderAdminSettings::render_page_class(); ?>">

        <h1 class="fl-settings-heading">
                <?php FLBuilderAdminSettings::render_page_heading(); ?>
        </h1>

        <?php FLBuilderAdminSettings::render_update_message(); ?>

        <div class="fl-settings-nav">
                <ul>
                        <?php FLBuilderAdminSettings::render_nav_items(); ?>
                        <?php do_action( 'fl_builder_admin_settings_nav_after' ); ?>
                </ul>
        </div>

        <div class="fl-settings-content">
                <?php
                FLBuilderAdminSettings::render_forms();

                if ( $global_settings ) {
                        $global_settings->render_settings_page();
                }
                ?>
        </div>
</div>
<?php if ( $current_tab ) : ?>
<script>
( function() {
        var tabSlug = <?php echo wp_json_encode( $current_tab ); ?>;

        if ( ! tabSlug ) {
                return;
        }

        var target = document.getElementById( 'fl-' + tabSlug + '-form' );

        if ( ! target ) {
                return;
        }

        var url = new URL( window.location.href );

        if ( url.searchParams.has( 'tab' ) ) {
                url.searchParams.delete( 'tab' );
        }

        url.hash = tabSlug;
        window.history.replaceState( {}, '', url.toString() );
} )();
</script>
<?php endif; ?>
