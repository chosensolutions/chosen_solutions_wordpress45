jQuery(document).ready(function() {

    function MabDesignPanel(MabAjax){
        var self = this;

        self.designPanel = jQuery('#mabdp');
        self.previewBox = jQuery('#mabdppreviewbox');
        self.controlPanel = jQuery('#mabdpcontrol-panel');

        self.spinner = '<div class="mab-spinner-box"><img src="' + MabAjax.spinner2x + '" alt="spinner"></div>';

        /**
         * Initialize the action box preview
         * @param int id the action box ID
         */
         self.initPreview = function(id){

            var data = {
                action : 'get-action-box',
                id : id
            };

            self.previewBox.html(self.spinner);

            jQuery.get(MabAjax.ajaxurl, data, function(data){
                if(data.html){
                    self.previewBox.html(data.html);

                    // add base style class
                    //var className = 'mabstyle-' + jQuery('#base-style').val();
                    //previewBox.children('.magic-action-box').addClass(className);
                    //mabDesign.addBaseStyleClassName(jQuery('#base-style').val(), mabDesign.previewBox);
                }
            });
        }

        self.addBaseStyleClassNameToActionBox = function(styleId){
            var className = 'mabstyle-' + styleId;
            self.previewBox.children('.magic-action-box').addClass(className);
        }
    }

    var dp = new MabDesignPanel(MabAjax);

    dp.initPreview(jQuery('#post_ID').val());

    jQuery('#mabdp-open').click(function(e){
        e.preventDefault();
        if(dp.designPanel.parent('body').length){
            dp.designPanel.show();
        } else {
            // attach the panel as child of body
            dp.designPanel.appendTo('body').show();
        }

    });

    jQuery('#mabdp-close').click(function(e){
        e.preventDefault();
        dp.designPanel.hide();
    });

    dp.controlPanel.slideReveal({
        trigger : dp.controlPanel.children('.mabdp-handle'),
        push : false,
        position: 'right',
        top: 30
    })

    dp.controlPanel.children('.panel-groups').accordion({
        collapsible : true
    });


    jQuery('#base-style-select').change(function(e){

        // stop if MabAjax object does not exists. Something wrong with calling wp_localize_script function
        // check ProsulumMabAdmin::addInterface and ProsulumMabAdmin::loadAssetsForStyleSettingsPage()
        if(typeof MabAjax == 'undefined'){
            return;
        }

        var value = jQuery(this).val();
        var stylesheet = document.getElementById('mab-base-style-css');
        var href = MabAjax.baseStylesUrl + value + '/style.css';
        var html = '<link rel="stylesheet" id="mab-base-style-css"  href="' + href + '" type="text/css" media="all" />';

        if(value){
            if(stylesheet){
                stylesheet.href=href;
            } else {
                jQuery('head').append(html);
            }

            dp.addBaseStyleClassNameToActionBox(value);
        } else {
            // remove the stylesheet because base design is set to "None"
            if(stylesheet){
                stylesheet.parentNode.removeChild(stylesheet);
            }
        }
    }).change();

});