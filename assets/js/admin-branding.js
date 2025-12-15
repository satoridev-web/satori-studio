(function ($) {
        function initBrandingTab() {
                var $panel = $('#fl-satori-admin-branding-form');

                if (! $panel.length) {
                        return;
                }

                var $logoInput   = $('#satori_studio_admin_branding_mark_attachment_id');
                var $logoPreview = $panel.find('.satori-admin-branding__logo-preview img');
                var placeholder  = $logoPreview.data('placeholder') || '';
                var $chooseBtn   = $panel.find('.satori-admin-branding__choose');
                var $removeBtn   = $panel.find('.satori-admin-branding__remove');
                var frame        = null;

                if ($logoInput.val()) {
                        $panel.addClass('has-logo');
                        $removeBtn.prop('disabled', false);
                }

                $chooseBtn.on('click', function (event) {
                        event.preventDefault();

                        if (typeof wp === 'undefined' || !wp.media || !wp.media.editor) {
                                return;
                        }

                        if (frame) {
                                frame.open();
                                return;
                        }

                        frame = wp.media({
                                title: $chooseBtn.text(),
                                button: {
                                        text: $chooseBtn.text(),
                                },
                                library: {
                                        type: 'image',
                                },
                                multiple: false,
                        });

                        frame.on('select', function () {
                                var attachment = frame.state().get('selection').first().toJSON();

                                if (!attachment || !attachment.id) {
                                        return;
                                }

                                $logoInput.val(attachment.id);
                                $logoPreview.attr('src', attachment.url);
                                $panel.addClass('has-logo');
                                $removeBtn.prop('disabled', false);
                        });

                        frame.open();
                });

                $removeBtn.on('click', function (event) {
                        event.preventDefault();

                        $logoInput.val('');
                        $logoPreview.attr('src', placeholder);
                        $panel.removeClass('has-logo');
                        $removeBtn.prop('disabled', true);
                });

                var $accent = $panel.find('#satori_studio_admin_branding_accent');

                if ($accent.length && $.fn.wpColorPicker) {
                        $accent.wpColorPicker();
                }
        }

        $(initBrandingTab);
})(jQuery);
