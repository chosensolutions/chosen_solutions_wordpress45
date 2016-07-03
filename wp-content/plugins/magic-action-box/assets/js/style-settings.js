jQuery(document).ready(function(){

    var mabDesign = {

        previewBox : jQuery('#actionbox-preview'),

        addBaseStyleClassName : function(style){
            var className = 'mabstyle-' + style;
            this.previewBox.children('.magic-action-box').addClass(className);
        }
    };


    /** Action box preview **/
    jQuery('#actionbox-preview-dropdown').change(function(e){
        var option = jQuery(this);
        var value = option.val();

        var spinner = '<div class="mab-spinner-box"><img src="' + MabAjax.spinner2x + '" alt="spinner"></div>';
        mabDesign.previewBox.html(spinner);

        // the first option in the dropdown has value of 0 and it is currently selected.
        if(value < 1) return;

        var data = {
            action : 'get-action-box',
            id : value
        };

        jQuery.get(ajaxurl, data, function(data){
            if(data.html){
                mabDesign.previewBox.html(data.html);

                // add base style class
                //var className = 'mabstyle-' + jQuery('#base-style').val();
                //previewBox.children('.magic-action-box').addClass(className);
                mabDesign.addBaseStyleClassName(jQuery('#base-style').val(), mabDesign.previewBox);
            }
        });

    }).change();

    /** Load base style stylesheet file **/
    jQuery('#base-style').change(function(e){

        // stop if MabAjax object does not exists. Something wrong with calling wp_localize_script function
        // check ProsulumMabAdmin::addInterface and ProsulumMabAdmin::loadAssetsForStyleSettingsPage()
        if(typeof MabAjax == 'undefined'){
            return;
        }

        var value = jQuery(this).val();
        var stylesheet = document.getElementById('mab-base-design-preview');
        var href = MabAjax.baseStylesUrl + value + '/style.css';
        var html = '<link rel="stylesheet" id="mab-base-design-preview"  href="' + href + '" type="text/css" media="all" />';

        if(value){
            if(stylesheet){
                stylesheet.href=href;
            } else {
                jQuery('head').append(html);
            }

            mabDesign.addBaseStyleClassName(value);
        } else {
            // remove the stylesheet because base design is set to "None"
            if(stylesheet){
                stylesheet.parentNode.removeChild(stylesheet);
            }
        }
    }).change();
});