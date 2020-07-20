/**
 Coconut script to handle the theme configuration
 **/
var Coconut = function() {

    var panel = $('.theme-panel');

    $('.theme-option ul .tooltips').click(function () {
        if ($(this).hasClass('current')) {
            var value = $(this).data('style');
            var data = {key: 'mainColor', value: value};
            updateConfiguration(data);
        }
    });

    $('.theme-panel .layout-style-option').change(function () {
        var value = $(this).val();
        if (value === 'md') {
            var file = 'components-md';
            var filePlugin = "plugins-md";

            file = (App.isRTL() ? file + '-rtl' : file);
            filePlugin = (App.isRTL() ? filePlugin + '-rtl' : filePlugin);

            $('#style_components').attr("href", App.getGlobalCssPath() + file + ".min.css");
            $('#style_plugins').attr("href", App.getGlobalCssPath() + filePlugin + ".min.css");

            if (typeof Cookies !== "undefined") {
                Cookies.set('layout-style-option', value);
            }
        }
        else {
            var filePluginNoMd = "plugins";
            $('#style_plugins').attr("href", App.getGlobalCssPath() + filePluginNoMd + ".min.css");
        }

        var data = {key: 'themeStyle', value: value};
        updateConfiguration(data);
    });

    $('.layout-option', panel).change(function () {
        var value = $(this).val();
        var data = {key: 'layoutStyle', value: value};
        updateConfiguration(data);
    });

    $('.page-header-option', panel).change(function () {
        var value = $(this).val();
        var data = {key: 'headerStyle', value: value};
        updateConfiguration(data);
    });

    $('.page-header-top-dropdown-style-option', panel).change(function () {
        var value = $(this).val();
        var data = {key: 'topMenuDropdownStyle', value: value};
        updateConfiguration(data);
    });

    $('.sidebar-option', panel).change(function () {
        var value = $(this).val();
        var data = {key: 'sidebarMode', value: value};
        updateConfiguration(data);
    });

    $('.sidebar-menu-option', panel).change(function () {
        var value = $(this).val();
        var data = {key: 'sidebarMenu', value: value};
        updateConfiguration(data);
    });

    $('.sidebar-style-option', panel).change(function () {
        var value = $(this).val();
        var data = {key: 'sidebarStyle', value: value};
        updateConfiguration(data);
    });

    $('.sidebar-pos-option', panel).change(function () {
        var value = $(this).val();
        var data = {key: 'sidebarPosition', value: value};
        updateConfiguration(data);
    });

    $('.page-footer-option', panel).change(function () {
        var value = $(this).val();
        var data = {key: 'footerStyle', value: value};
        updateConfiguration(data);
    });


    function changeData($input_key) {
        var value = $(this).val();
        var data = {key: $input_key, value: value};
        updateConfiguration(data);
    }

    function updateConfiguration(data) {
        $.ajax({
            url: LayoutSettingUrl,
            method: "POST",
            data: data,
            dataType: "json",
            success: function (data) {
                console.log(data);
            }
        });
    }
};

jQuery(document).ready(function() {
    Coconut();
});