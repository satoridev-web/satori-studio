/* -------------------------------------------------
 * SATORI Studio — Global Settings Color Picker
 * -------------------------------------------------*/
(function( $ ) {
        $( function() {
                var $panel = $( '.satori-global-settings' );

                if ( ! $panel.length || 'function' !== typeof $.fn.wpColorPicker ) {
                        return;
                }

                var $colorFields = $panel.find( '.satori-color-field' );

                if ( ! $colorFields.length ) {
                        return;
                }

                var updatePreview = function( key, color ) {
                        if ( ! key ) {
                                return;
                        }

                        var $chip = $panel.find( '.satori-global-settings__chip[data-color-key="' + key + '"]' );

                        if ( ! $chip.length ) {
                                return;
                        }

                        var $swatch = $chip.find( '.satori-global-settings__chip-swatch' );
                        var $value = $chip.find( '.satori-global-settings__chip-value' );

                        $swatch.css( 'background-color', color );

                        if ( '' === color ) {
                                $value.text( '' );
                                return;
                        }

                        if ( ! $value.length ) {
                                $value = $( '<span class="satori-global-settings__chip-value" />' ).appendTo( $chip );
                        }

                        $value.text( color );
                };

                $colorFields.each( function() {
                        var $field = $( this );
                        var key = $field.data( 'color-key' );

                        var syncPreview = function( value ) {
                                updatePreview( key, value || $field.val() );
                        };

                        $field.wpColorPicker( {
                                change: function( event, ui ) {
                                        syncPreview( ui.color.toString() );
                                },
                                clear: function() {
                                        syncPreview( '' );
                                },
                        } );

                        $field.on( 'input', function() {
                                syncPreview( $( this ).val() );
                        } );

                        syncPreview( $field.val() );
                } );
        } );
})( jQuery );
