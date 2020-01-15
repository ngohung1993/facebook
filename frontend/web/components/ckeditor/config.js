/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function (config) {
    config.skin = 'moonocolor';
    config.width = 'auto';
    config.filebrowserBrowseUrl = '/uploads/filemanager/dialog.php?type=2&editor=ckeditor&fldr=';
    config.filebrowserUploadUrl = '/uploads/filemanager/dialog.php?type=2&editor=ckeditor&fldr=';
    config.filebrowserImageBrowseUrl = '/uploads/filemanager/dialog.php?type=1&editor=ckeditor&fldr=';

    // Toolbar configuration generated automatically by the editor based on config.toolbarGroups.
    config.toolbar = [
        {
            name: 'document',
            groups: ['mode', 'document', 'doctools'],
            items: ['Source', '-', 'Preview', '-', 'Templates']
        },
        {
            name: 'clipboard',
            groups: ['clipboard', 'undo'],
            items: ['Cut', 'Copy', 'Paste', '-', 'Undo', 'Redo']
        },
        {name: 'editing', groups: ['find', 'selection', 'spellchecker'], items: ['Find']},
        {
            name: 'basicstyles',
            groups: ['basicstyles', 'cleanup'],
            items: ['Bold', 'Italic', 'Underline', 'Strike', '-', 'CopyFormatting', 'RemoveFormat', 'CreateDiv']
        },
        {name: 'insert', items: ['Link', 'Unlink', '-', 'Image', 'Flash', 'Table', 'Iframe']},
        {
            name: 'paragraph',
            groups: ['list', 'indent', 'align', 'bidi'],
            items: ['Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl']
        },
        {name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize']},
        {name: 'colors', items: ['TextColor', 'BGColor']},
        {name: 'tools', items: ['Maximize']}
    ];
};
