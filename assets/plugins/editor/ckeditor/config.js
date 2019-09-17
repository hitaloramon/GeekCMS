/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.defaultLanguage = 'pt-br';
	config.extraPlugins = 'ckeditor_fa5';

	config.filebrowserBrowseUrl = localStorage.getItem('SITEURL') + '/libs/filemanager/dialog.php?type=2&editor=ckeditor&fldr=uploads';
	config.filebrowserImageBrowseUrl = localStorage.getItem('SITEURL') + '/libs/filemanager/dialog.php?type=2&editor=ckeditor&fldr=uploads';
	config.filebrowserFlashBrowseUrl = localStorage.getItem('SITEURL') + '/libs/filemanager/dialog.php?type=2&editor=ckeditor&fldr=uploads';
	config.filebrowserUploadUrl = localStorage.getItem('SITEURL') + '/libs/filemanager/dialog.php?type=2&editor=ckeditor&fldr=uploads';
	config.filebrowserImageUploadUrl = localStorage.getItem('SITEURL') + '/libs/filemanager/dialog.php?type=2&editor=ckeditor&fldr=uploads';
	config.filebrowserFlashUploadUrl = localStorage.getItem('SITEURL') + '/libs/filemanager/dialog.php?type=2&editor=ckeditor&fldr=uploads';
};
