/* -------------------------------------------------
 * SATORI Studio — Global Settings Controls
 * -------------------------------------------------*/
(function( $ ) {
        $( function() {
                var $panel = $( '.satori-global-settings' );

                if ( ! $panel.length ) {
                        return;
                }

                var labels = {
                        default: 'Default',
                        transparent: 'Transparent'
                };

                if ( window.SatoriGlobalSettingsL10n ) {
                        labels.default = window.SatoriGlobalSettingsL10n.defaultLabel || labels.default;
                        labels.transparent = window.SatoriGlobalSettingsL10n.transparentLabel || labels.transparent;
                }

                var isTransparentValue = function( value ) {
                        return 'transparent' === String( value ).toLowerCase();
                };

                var updatePreview = function( key, value ) {
                        if ( ! key ) {
                                return;
                        }

                        var isTransparent = isTransparentValue( value );
                        var $chip = $panel.find( '.satori-global-settings__chip[data-color-key="' + key + '"]' );

                        if ( ! $chip.length ) {
                                return;
                        }

                        var $swatch = $chip.find( '.satori-global-settings__chip-swatch' );
                        var $value = $chip.find( '.satori-global-settings__chip-value' );

                        $swatch.toggleClass( 'is-transparent', isTransparent );
                        $swatch.css( 'background-color', isTransparent ? 'transparent' : value );

                        if ( isTransparent ) {
                                if ( ! $value.length ) {
                                        $value = $( '<span class="satori-global-settings__chip-value" />' ).appendTo( $chip );
                                }

                                $value.text( labels.transparent );
                                return;
                        }

                        if ( ! value ) {
                                $value.text( '' );
                                return;
                        }

                        if ( ! $value.length ) {
                                $value = $( '<span class="satori-global-settings__chip-value" />' ).appendTo( $chip );
                        }

                        $value.text( value );
                };

                var initColorControls = function() {
                        if ( 'function' !== typeof $.fn.wpColorPicker ) {
                                return;
                        }

                        $panel.find( '.satori-global-settings__color-control' ).each( function() {
                                var $control = $( this );
                                var key = $control.data( 'colorKey' ) || '';
                                var defaultValue = $control.data( 'defaultValue' ) || '';
                                var supportsTransparent = !! $control.data( 'supportsTransparent' );
                                var $valueInput = $control.find( '.satori-global-settings__color-value' );
                                var $field = $control.find( '.satori-global-settings__color-field' );
                                var $defaultButton = $control.find( '.satori-global-settings__color-default' );
                                var $transparentToggle = $control.find( '.satori-global-settings__transparent-toggle' );
                                var storedValue = $valueInput.val();
                                var transparent = supportsTransparent && isTransparentValue( storedValue );
                                var lastColor = transparent ? ( $valueInput.data( 'lastColor' ) || defaultValue ) : ( storedValue || $valueInput.data( 'lastColor' ) || $field.val() || defaultValue );

                                var syncValue = function( nextValue ) {
                                        $valueInput.val( nextValue );
                                        updatePreview( key, nextValue );
                                };

                                var setPickerColor = function( color ) {
                                        if ( 'function' === typeof $field.wpColorPicker ) {
                                                try {
                                                        $field.wpColorPicker( 'color', color );
                                                        return;
                                                } catch ( error ) {
                                                        // Fallback below when WP overrides are unavailable.
                                                }
                                        }

                                        $field.val( color ).trigger( 'change' );
                                };

                                var disablePicker = function( disabled ) {
                                        $control.toggleClass( 'is-transparent', disabled );
                                        $field.prop( 'disabled', disabled );

                                        var $result = $control.find( '.wp-color-result' );

                                        if ( $result.length ) {
                                                $result.prop( 'aria-disabled', disabled );
                                        }
                                };

                                var setTransparentState = function( enable ) {
                                        if ( ! supportsTransparent ) {
                                                return;
                                        }

                                        if ( enable ) {
                                                var candidate = $field.val() || lastColor || defaultValue;

                                                if ( ! isTransparentValue( candidate ) ) {
                                                        lastColor = candidate;
                                                }

                                                disablePicker( true );
                                                syncValue( 'transparent' );

                                                if ( $transparentToggle.length ) {
                                                        $transparentToggle.prop( 'checked', true );
                                                }

                                                return;
                                        }

                                        disablePicker( false );

                                        if ( $transparentToggle.length ) {
                                                $transparentToggle.prop( 'checked', false );
                                        }

                                        var restoreColor = lastColor || defaultValue;

                                        setPickerColor( restoreColor );
                                        syncValue( restoreColor );
                                };

                                if ( transparent ) {
                                        disablePicker( true );
                                        $field.val( defaultValue );
                                        syncValue( 'transparent' );
                                } else {
                                        $field.val( lastColor );
                                        syncValue( storedValue );
                                }

                                $field.wpColorPicker( {
                                        defaultColor: defaultValue,
                                        change: function( event, ui ) {
                                                var colorString = ui.color ? ui.color.toString() : '';
                                                lastColor = colorString || defaultValue;

                                                if ( supportsTransparent ) {
                                                        disablePicker( false );

                                                        if ( $transparentToggle.length ) {
                                                                $transparentToggle.prop( 'checked', false );
                                                        }
                                                }

                                                syncValue( colorString );
                                        },
                                        clear: function() {
                                                lastColor = defaultValue;

                                                if ( supportsTransparent ) {
                                                        disablePicker( false );

                                                        if ( $transparentToggle.length ) {
                                                                $transparentToggle.prop( 'checked', false );
                                                        }
                                                }

                                                syncValue( defaultValue );
                                        },
                                } );

                                if ( $defaultButton.length ) {
                                        $defaultButton.text( labels.default ).on( 'click', function( event ) {
                                                event.preventDefault();

                                                lastColor = defaultValue;
                                                disablePicker( false );

                                                if ( $transparentToggle.length ) {
                                                        $transparentToggle.prop( 'checked', false );
                                                }

                                                setPickerColor( defaultValue );
                                                syncValue( defaultValue );
                                        } );
                                }

                                if ( supportsTransparent && $transparentToggle.length ) {
                                        $transparentToggle.on( 'change', function() {
                                                if ( $( this ).is( ':checked' ) ) {
                                                        setTransparentState( true );
                                                        return;
                                                }

                                                setTransparentState( false );
                                        } );
                                }

                                $field.on( 'input', function() {
                                        if ( supportsTransparent && $control.hasClass( 'is-transparent' ) ) {
                                                return;
                                        }

                                        var value = $( this ).val();
                                        lastColor = value || defaultValue;
                                        syncValue( value );
                                } );
                        } );
                };

                var parseNumericValue = function( value, fallbackUnit ) {
                        var stringValue = String( value || '' ).trim();
                        var match = stringValue.match( /^(-?\d+(?:\.\d+)?)([a-z%]*)$/i );

                        if ( match ) {
                                return {
                                        number: parseFloat( match[1] ),
                                        unit: match[2] || fallbackUnit || ''
                                };
                        }

                        return {
                                number: 0,
                                unit: fallbackUnit || ''
                        };
                };

                var formatNumericValue = function( number, unit ) {
                        var cleanNumber = isNaN( number ) ? 0 : number;
                        return cleanNumber + ( unit || '' );
                };

                var initSpacingSteppers = function() {
                        $panel.on( 'click', '.satori-stepper__button', function( event ) {
                                event.preventDefault();

                                var $button = $( this );
                                var direction = $button.data( 'direction' );
                                var $input = $button.siblings( '.satori-spacing-field' );

                                if ( ! $input.length ) {
                                        return;
                                }

                                var step = parseFloat( $input.data( 'step' ) ) || 1;
                                var defaultValue = $input.data( 'defaultValue' ) || '';
                                var baseUnit = $input.data( 'unit' ) || parseNumericValue( defaultValue ).unit;
                                var parsed = parseNumericValue( $input.val(), baseUnit );
                                var delta = 'increment' === direction ? step : -step;
                                var nextNumber = parseFloat( ( parsed.number + delta ).toFixed( 4 ) );
                                var nextValue = formatNumericValue( nextNumber, parsed.unit );

                                $input.val( nextValue ).trigger( 'input' );
                        } );
                };

                initColorControls();
                initSpacingSteppers();
        } );
})( jQuery );
