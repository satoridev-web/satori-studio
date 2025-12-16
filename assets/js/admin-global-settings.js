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

                var updatePreview = function( key, value ) {
                        if ( ! key ) {
                                return;
                        }

                        var isTransparent = 'transparent' === String( value ).toLowerCase();
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

                        var closeAllPickers = function( current ) {
                                $panel.find( '.wp-picker-container' ).each( function() {
                                        var $container = $( this );
                                        var pickerHolder = $container.data( 'satoriPickerHolder' );
                                        var pickerWrapper = $container.data( 'satoriPickerWrapper' );

                                        if ( current && $container.is( current ) ) {
                                                return;
                                        }

                                        $container.removeClass( 'wp-picker-active' );
                                        $container.find( '.wp-color-result' ).attr( 'aria-expanded', 'false' );

                                        if ( pickerHolder && pickerHolder.length ) {
                                                pickerHolder.hide();
                                        }

                                        if ( pickerWrapper && pickerWrapper.length ) {
                                                pickerWrapper.attr( 'aria-hidden', 'true' );
                                        }
                                } );
                        };

                        $( document ).on( 'mousedown.satoriGlobalSettings', function( event ) {
                                var $targetContainer = $( event.target ).closest( '.wp-picker-container' );

                                if ( ! $targetContainer.length || ! $panel.find( $targetContainer ).length ) {
                                        closeAllPickers();
                                }
                        } );

                        $panel.find( '.satori-color-control' ).each( function() {
                                var $control = $( this );
                                var $field = $control.find( '.satori-color-field' );
                                var $valueInput = $control.find( '.satori-color-control__value' );
                                var $transparentToggle = $control.find( '.satori-color-control__transparent-checkbox' );
                                var $defaultButton = $control.find( '.satori-color-control__default' );
                                var $pickerWrapper = $control.find( '.satori-color-control__picker-holder' );
                                var defaultValue = $control.data( 'defaultValue' ) || '';
                                var key = $control.data( 'colorKey' ) || $field.data( 'colorKey' );
                                var supportsTransparent = !! $control.data( 'supportsTransparent' );
                                var storedValue = $valueInput.val();
                                var isTransparent = 'transparent' === String( storedValue ).toLowerCase();
                                var initialColor = isTransparent ? ( $field.data( 'defaultValue' ) || defaultValue ) : ( storedValue || $field.val() || defaultValue );

                                $field.val( initialColor );
                                $field.data( 'lastColor', initialColor );

                                var markTransparent = function() {
                                        if ( ! supportsTransparent ) {
                                                return;
                                        }

                                        $control.addClass( 'is-transparent' );
                                        $field.addClass( 'is-transparent' ).prop( 'readonly', true );

                                        if ( $transparentToggle.length ) {
                                                $transparentToggle.prop( 'checked', true );
                                        }
                                };

                                var clearTransparent = function() {
                                        if ( ! supportsTransparent ) {
                                                return;
                                        }

                                        $control.removeClass( 'is-transparent' );
                                        $field.removeClass( 'is-transparent' ).prop( 'readonly', false );

                                        if ( $transparentToggle.length ) {
                                                $transparentToggle.prop( 'checked', false );
                                        }
                                };

                                var setColor = function( nextColor, shouldSyncPicker ) {
                                        var color = nextColor || '';

                                        $valueInput.val( color );
                                        $field.val( color );
                                        $field.data( 'lastColor', color );

                                        if ( shouldSyncPicker && $field.hasClass( 'wp-color-picker' ) ) {
                                                $field.wpColorPicker( 'color', color );
                                        }

                                        updatePreview( key, color );
                                };

                                var setTransparentState = function( enable ) {
                                        if ( ! supportsTransparent ) {
                                                return;
                                        }

                                        if ( enable ) {
                                                var lastColor = $field.data( 'lastColor' ) || $field.val() || defaultValue;

                                                $field.data( 'lastColor', lastColor );
                                                $valueInput.val( 'transparent' );
                                                markTransparent();
                                                updatePreview( key, 'transparent' );
                                                closeAllPickers();
                                                return;
                                        }

                                        clearTransparent();
                                        var restoreColor = $field.data( 'lastColor' ) || defaultValue;

                                        if ( 'transparent' === String( restoreColor ).toLowerCase() ) {
                                                restoreColor = defaultValue;
                                        }

                                        setColor( restoreColor, true );
                                };

                                if ( supportsTransparent && isTransparent ) {
                                        markTransparent();
                                        updatePreview( key, 'transparent' );
                                } else {
                                        updatePreview( key, initialColor );
                                }

                                $field.wpColorPicker( {
                                        defaultColor: defaultValue,
                                        change: function( event, ui ) {
                                                var colorString = ui.color.toString();

                                                clearTransparent();
                                                setColor( colorString, false );
                                        },
                                        clear: function() {
                                                clearTransparent();
                                                setColor( defaultValue, false );
                                        },
                                } );

                                var $wpContainer = $field.closest( '.wp-picker-container' );
                                var $pickerHolder = $wpContainer.find( '.wp-picker-holder' );
                                var $toggle = $wpContainer.find( '.wp-color-result' );
                                var $clearButton = $wpContainer.find( '.wp-picker-clear' );
                                var $defaultPickerButton = $wpContainer.find( '.wp-picker-default' );
                                var attachPickerHolder = function() {
                                        if ( $pickerWrapper.length && $pickerHolder.parent()[0] !== $pickerWrapper[0] ) {
                                                $pickerWrapper.append( $pickerHolder );
                                        }
                                };
                                var closePicker = function() {
                                        $wpContainer.removeClass( 'wp-picker-active' );
                                        $toggle.attr( 'aria-expanded', 'false' );
                                        $pickerHolder.hide();
                                        $pickerWrapper.attr( 'aria-hidden', 'true' );
                                };
                                var openPicker = function() {
                                        if ( $control.hasClass( 'is-transparent' ) ) {
                                                return;
                                        }

                                        attachPickerHolder();
                                        closeAllPickers( $wpContainer );
                                        $wpContainer.addClass( 'wp-picker-active' );
                                        $pickerHolder.show();
                                        $pickerWrapper.attr( 'aria-hidden', 'false' );
                                        $toggle.attr( 'aria-expanded', 'true' );
                                };

                                $control.find( '.satori-color-control__input-row' ).prepend( $wpContainer );
                                $pickerWrapper.append( $pickerHolder );
                                $wpContainer.data( 'satoriPickerHolder', $pickerHolder );
                                $wpContainer.data( 'satoriPickerWrapper', $pickerWrapper );
                                $pickerHolder.hide();
                                $pickerWrapper.attr( 'aria-hidden', 'true' );

                                if ( $clearButton.length ) {
                                        $clearButton.remove();
                                }

                                if ( $defaultPickerButton.length ) {
                                        $defaultPickerButton.remove();
                                }

                                if ( $toggle.length ) {
                                        $toggle.off( 'click' ).on( 'click', function( event ) {
                                                event.preventDefault();

                                                if ( $wpContainer.hasClass( 'wp-picker-active' ) ) {
                                                        closePicker();
                                                        return;
                                                }

                                                openPicker();
                                        } );
                                }

                                if ( $defaultButton.length ) {
                                        $defaultButton.text( labels.default ).on( 'click', function( event ) {
                                                event.preventDefault();
                                                setTransparentState( false );
                                                setColor( defaultValue, true );
                                                closePicker();
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
                                        var value = $( this ).val();
                                        var isValueTransparent = 'transparent' === String( value ).toLowerCase();

                                        if ( supportsTransparent ) {
                                                if ( isValueTransparent ) {
                                                        setTransparentState( true );
                                                        return;
                                                }

                                                clearTransparent();
                                        }

                                        setColor( value, false );
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
