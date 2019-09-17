(function ($) {
    CKEDITOR.dtd.$removeEmpty.span = 0;
    CKEDITOR.dtd.$removeEmpty.em = 0;
    CKEDITOR.dtd.$removeEmpty.i = 0;

    CKEDITOR.plugins.add('ckeditor_fa5', {
    icons: 'ckeditor-fa',
    init: function (editor) {
      editor.addCommand('ckeditor_fa5', new CKEDITOR.dialogCommand('ckeditorFaDialog', {
        allowedContent: 'i(!fa)',
      }));
      editor.ui.addButton('ckeditor_fa5', {
        label: 'Inserir um Ícone',
        command: 'ckeditor_fa5',
        toolbar: 'insert',
        icon: this.path + 'icons/flag.svg',
      });
      CKEDITOR.dialog.add('ckeditorFaDialog', this.path + 'dialogs/ckeditor-fa.js?v=9.5.2');
      CKEDITOR.document.appendStyleSheet(this.path + 'css/ckeditor-fa.css?v=9.5.2');

      editor.addContentsCss('https://use.fontawesome.com/releases/v5.8.1/css/all.css');
    }
  });
})(jQuery);