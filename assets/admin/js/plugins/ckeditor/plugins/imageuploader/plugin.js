// Copyright (c) 2015, Fujana Solutions - Moritz Maleck. All rights reserved.
// For licensing, see LICENSE.md

CKEDITOR.plugins.add( 'imageuploader', {
    init: function( editor ) {
        editor.config.filebrowserBrowseUrl = 'http://www.quanweblocal.com/coffee_love_ceramics/assets/admin/js/plugins/ckeditor/plugins/imageuploader/imgbrowser.php';
    }
});
