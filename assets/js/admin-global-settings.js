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
                        var normalized = String( value ).trim().toLowerCase();

                        return '' === normalized || 'transparent' === normalized;
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

                        $panel.find( '.satori-global-color' ).each( function() {
                                var $input = $( this );
                                var defaultValue = $input.data( 'default-color' ) || '';
                                var key = $input.data( 'color-key' ) || '';
                                var $control = $input.closest( '.satori-global-settings__color-control' );
                                var $transparentToggle = $control.find( '.satori-global-color__transparent-toggle' );
                                var suppressChange = false;
                                var lastColor = isTransparentValue( $input.val() ) ? defaultValue : ( $input.val() || defaultValue );

                                var setResultDisabled = function( disabled ) {
                                        var $result = $control.find( '.wp-color-result' );

                                        if ( $result.length ) {
                                                $result.attr( 'aria-disabled', disabled ? 'true' : 'false' );
                                                $result.toggleClass( 'is-disabled', disabled );
                                        }
                                };

                                var syncPreview = function( nextValue ) {
                                        updatePreview( key, nextValue );
                                };

                                var setPickerColor = function( color ) {
                                        suppressChange = true;

                                        try {
                                                $input.wpColorPicker( 'color', color );
                                        } catch ( error ) {
                                                $input.val( color ).trigger( 'change' );
                                        }

                                        suppressChange = false;
                                };

                                var applyTransparentState = function( enable ) {
                                        if ( enable ) {
                                                var candidate = $input.val() || lastColor || defaultValue;

                                                if ( ! isTransparentValue( candidate ) ) {
                                                        lastColor = candidate;
                                                }

                                                $control.addClass( 'is-transparent' );
                                                setResultDisabled( true );
                                                $input.prop( 'readonly', true ).val( '' );
                                                syncPreview( 'transparent' );

                                                if ( $transparentToggle.length ) {
                                                        $transparentToggle.prop( 'checked', true );
                                                }

                                                return;
                                        }

                                        var restoreColor = lastColor || defaultValue;

                                        lastColor = restoreColor;
                                        $control.removeClass( 'is-transparent' );
                                        setResultDisabled( false );

                                        if ( $transparentToggle.length ) {
                                                $transparentToggle.prop( 'checked', false );
                                        }

                                        $input.prop( 'readonly', false ).val( restoreColor );
                                        setPickerColor( restoreColor );
                                        syncPreview( restoreColor );
                                };

                                $input.wpColorPicker( {
                                        defaultColor: defaultValue,
                                        change: function( event, ui ) {
                                                if ( suppressChange ) {
                                                        return;
                                                }

                                                var colorString = ui.color ? ui.color.toString() : '';

                                                if ( isTransparentValue( colorString ) ) {
                                                        applyTransparentState( true );
                                                        return;
                                                }

                                                lastColor = colorString || defaultValue;
                                                $control.removeClass( 'is-transparent' );
                                                setResultDisabled( false );

                                                if ( $transparentToggle.length ) {
                                                        $transparentToggle.prop( 'checked', false );
                                                }

                                                $input.prop( 'readonly', false ).val( colorString );
                                                syncPreview( colorString );
                                        },
                                        clear: function() {
                                                if ( suppressChange ) {
                                                        return;
                                                }

                                                lastColor = defaultValue;
                                                applyTransparentState( false );
                                        },
                                } );

                                var $pickerContainer = $input.closest( '.wp-picker-container' );
                                var $clearButton = $pickerContainer.find( '.wp-picker-clear' );

                                if ( $clearButton.length ) {
                                        $clearButton.val( labels.default ).text( labels.default );
                                }

                                if ( $transparentToggle.length ) {
                                        $transparentToggle.on( 'change', function() {
                                                if ( $( this ).is( ':checked' ) ) {
                                                        applyTransparentState( true );
                                                        return;
                                                }

                                                applyTransparentState( false );
                                        } );
                                }

                                var initialValue = $input.val();

                                if ( isTransparentValue( initialValue ) ) {
                                        lastColor = defaultValue;
                                        applyTransparentState( true );
                                        setPickerColor( defaultValue );
                                        $input.val( '' );
                                } else {
                                        lastColor = initialValue || defaultValue;
                                        setPickerColor( lastColor );
                                        syncPreview( initialValue || defaultValue );
                                }
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
