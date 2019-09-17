// Click Handler
function ckeditor_fa_click(el) {
    var _el = jQuery(el);
    // remove Active Class
    jQuery('#ckeditor-fa-icons-select a').removeClass('active');
    // Set Vale
    jQuery('.fontawesomeClass input').val(_el.attr('class'));
    // Set Active Class
    _el.addClass('active');
}
// SearchTimer
var _searchTimer;
/**
 * Search Handling
 */
function searchFontawesomeIcon(el) {
    var _el = jQuery(el),
        _val = _el.val();

    clearTimeout(_searchTimer);
    _searchTimer = setTimeout(function () {
        if (!_val || _val.length == 0) {
            jQuery('.fa-hover').removeClass('off');
            jQuery('.fontawesome-icon-body > section').show();
            return true;
        }
        jQuery('.fontawesome-icon-body .fa-hover > a').each(function (i, element) {
            var _temp = jQuery(element);
            if (element.className.indexOf(_val) >= 0) {
                _temp.parent().removeClass('off');
            } else {
                _temp.parent().addClass('off');
            }
        });

        jQuery('.fontawesome-icon-body > section').each(function (i, section) {
            section = jQuery(section);
            if (section.find('.fa-hover').length == section.find('.fa-hover.off').length) {
                section.hide();
            } else {
                section.show();
            }
        });
    }, 400);
}

function loadCSS(href) {

    var cssLink = $("<link>");
    jQuery("#ckeditor-fa-icons-select").append(cssLink); //IE hack: append before setting href

    cssLink.attr({
        rel:  "stylesheet",
        type: "text/css",
        href: href
    });

}

(function ($) {

    CKEDITOR.dialog.add('ckeditorFaDialog', function (editor) {
        function ckeditorFaGetIcons() {
            $.ajaxSetup({async: false});
            var icons = $.get(CKEDITOR.plugins.getPath('ckeditor_fa5') + 'dialogs/index.html?v=9.5.2');
            $.ajaxSetup({async: true});
            if (icons.status == 200) {
                return icons.responseText;
            } else {
                return 'Icons not allowed';
            }
        }

        var icons = ckeditorFaGetIcons();
        var ckeditorFaIcons = icons;

        return {
            title: 'FontAwesome Icons',
            minWidth: 400,
            minHeight: 200,
            contents: [
                {
                    id: 'font-awesome',
                    label: 'Add icon',
                    elements: [
                        {
                            type: 'text',
                            id: 'faicon',
                            className: 'fontawesomeClass',
                            style: 'display:none',
                            validate: CKEDITOR.dialog.validate.notEmpty("Select fontAwesome icon")
                        },
                        {
                            type: 'html',
                            html: '<div id="ckeditor-fa-icons">' + ckeditorFaIcons + '</div>'
                        }
                    ]
                },
            ],
            onLoad: function () {
                editor.config.contentsCss.map(function(src, i){
                    loadCSS(src);
                })
                // Toogle Options
                $('a.page-header[href="#fa-options"]').on('click', function () {
                    $("#fa-options").toggleClass('in');
                    $(this).toggleClass('in');
                });
                // Load Front-Wight
                $('input[name="fa-type[]"]').on('click', function (e) {
                    $('.fontawesome-icon-body').removeClass('in');
                    var val = $('input[name="fa-type[]"]:checked').val();
                    var idHolder = {
                        fas: '#fontawesome-icon-body-solid',
                        far: '#fontawesome-icon-body-regular',
                        fab: '#fontawesome-icon-body-brand',
                    };
                    $(idHolder[val]).addClass('in');
                })
                $('#cke-fa-type-far').prop('checked', true).trigger('click');
                // Size Select Handler
                var faSize = $('input[name="fa-size[]"]');
                faSize.on('change', function (e) {
                    var prop = $(e.delegateTarget).prop('checked');

                    faSize.prop('checked', false);

                    $(e.delegateTarget).prop('checked', prop);
                });
                // Rotate Handler
                var faRotate = $('input[name="fa-rotate[]"]');
                faRotate.on('change', function (e) {
                    var prop = $(e.delegateTarget).prop('checked');

                    faRotate.prop('checked', false);

                    $(e.delegateTarget).prop('checked', prop);
                });
                // Pull Handler
                var faPull = $('input[name="fa-pull[]"]');
                faPull.on('change', function (e) {
                    var prop = $(e.delegateTarget).prop('checked');

                    faPull.prop('checked', false);

                    $(e.delegateTarget).prop('checked', prop);
                });
            },
            onOk: function () {
                var icons = document.getElementById('ckeditor-fa-icons-select');
                var activeIcon = icons.getElementsByClassName('active');
                for (var i = 0; i < activeIcon.length; i++) {
                    activeIcon[i].className = activeIcon[i].className.replace('active', '').trim();
                }
                var dialog = this;
                var icon = editor.document.createElement('i');
                var _checkClasses = [
                    $('input[name="fa-type[]"]:checked').val(),
                    'fa-' + dialog.getValueOf('font-awesome', 'faicon')
                ];

                $('input[name="fa-size[]"]:checked,' +
                    'input[name="fa-rotate[]"]:checked,' +
                    'input[name="fa-pull[]"]:checked,' +
                    'input[name="fa-border"]:checked,' +
                    'input[name="fa-spin"]:checked,' +
                    'input[name="fa-fw"]:checked').each(function (index, el) {
                    _checkClasses.push($(el).val());
                });

                icon.setAttribute('class', _checkClasses.join(' '));
                icon.setText(' ');

                editor.insertElement(icon);
            }
        };
    });
})(jQuery);