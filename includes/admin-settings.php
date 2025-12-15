<?php
use Satori_Studio\Admin\Global_Settings;

$current_tab            = isset( $_GET['tab'] ) ? sanitize_key( wp_unslash( $_GET['tab'] ) ) : '';
$default_tab            = 'welcome';
$global_settings_tab    = class_exists( Global_Settings::class ) ? Global_Settings::TAB_SLUG : '';
$active_tab             = $current_tab ? $current_tab : $default_tab;
$is_global_settings_tab = $global_settings_tab && $active_tab === $global_settings_tab;
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
                if ( $is_global_settings_tab && class_exists( Global_Settings::class ) ) {
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

                        if ( $global_settings ) {
                                $global_settings->render_settings_page();
                        }
                } else {
                        FLBuilderAdminSettings::render_forms();
                }
                ?>
        </div>
</div>
<script>
( function() {
var currentTab = <?php echo wp_json_encode( $active_tab ); ?>;
var baseUrl    = new URL( <?php echo wp_json_encode( admin_url( 'admin.php' ) ); ?> );
var navLinks   = document.querySelectorAll( '.fl-settings-nav a' );

baseUrl.searchParams.set( 'page', 'fl-builder-settings' );

navLinks.forEach( function( link ) {
var href = link.getAttribute( 'href' );

if ( ! href ) {
return;
}

var tabSlug = '';

if ( href.indexOf( '#' ) > -1 ) {
tabSlug = href.split( '#' ).pop();
}

if ( ! tabSlug ) {
return;
}

var url            = new URL( baseUrl );
var targetForm     = document.getElementById( 'fl-' + tabSlug + '-form' );
var canHandleInline = !! targetForm;

url.searchParams.set( 'tab', tabSlug );
url.hash = tabSlug;
link.setAttribute( 'href', url.toString() );

if ( canHandleInline ) {
link.addEventListener( 'click', function( event ) {
event.preventDefault();

if ( window.location.hash !== '#' + tabSlug ) {
window.location.hash = '#' + tabSlug;
}
} );
}
} );

if ( currentTab ) {
var activeTarget = document.getElementById( 'fl-' + currentTab + '-form' );

if ( activeTarget && window.location.hash !== '#' + currentTab ) {
window.location.hash = '#' + currentTab;
}
}
} )();
</script>
