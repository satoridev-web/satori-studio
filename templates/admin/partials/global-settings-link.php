<?php
/* -------------------------------------------------
 * SATORI Studio — Global Settings nav link partial
 * -------------------------------------------------*/

if ( ! defined( 'ABSPATH' ) ) {
        exit;
}
?>
<li class="satori-studio-global-settings-link">
        <a href="<?php echo esc_url( admin_url( 'admin.php?page=' . \Satori_Studio\Admin\Global_Settings::MENU_SLUG ) ); ?>">
                <?php esc_html_e( 'Global Settings', 'satori-studio' ); ?>
        </a>
</li>
