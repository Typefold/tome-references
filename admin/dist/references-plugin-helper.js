var ReferencesPluginHelper;

ReferencesPluginHelper = {
  init: function(ed, url) {
    this.registerReferencesButton(ed, url);
    return ed.addCommand('reference', (function(_this) {
      return function() {
        var selectedNode, selectedText, self;
        window.activeEditor = ed;
        console.log(window.activeEditor);
        selectedText = ed.selection.getContent();
        selectedNode = $(ed.selection.getNode());
        self = _this;
        if (selectedText === "") {
          return new ReferencesPopUp({
            message: "You have to select atleast one word.",
            singleChoice: true,
            confirmText: "ok"
          });
        }
        if (selectedNode.hasClass('tome-reference') || selectedNode.parent().hasClass('tome-reference')) {
          return new ReferencesPopUp({
            message: "Do you want to edit or remove this reference.",
            onConfirm: _this.editReferenceAction,
            onDismis: _this.removeReferenceAction,
            confirmText: "edit",
            dismisText: "remove"
          });
        }
        return modalWindow.open();
      };
    })(this));
  },
  addReferenceToEditor: function(referenceID, biblioID) {
    var return_text, selection;
    selection = window.activeEditor.selection.getContent({
      format: 'code'
    });
    return_text = '[tome_reference id="' + referenceID + '" biblio-id="' + biblioID + '"]' + selection + '[/tome_reference]';
    return window.activeEditor.selection.setContent(return_text);
  },
  editReferenceAction: function() {
    var referenceID, referencePlaceholder;
    referencePlaceholder = $(window.activeEditor.selection.getNode());
    referenceID = referencePlaceholder.attr('data-ref-id');
    window.referenceEdit = true;
    modalWindow.open();
    ModalWindow.goToSection('reference-form');
    tomeReferences.setEditorMethod('update');
    tomeReferences.setCurrentReference(referenceID);
    return tomeReferences.getReferenceText(referenceID);
  },
  removeReferenceAction: function() {
    var elm;
    elm = window.activeEditor.selection.getNode();
    return tinyMCE.execCommand('mceRemoveNode', false, elm);
  },
  registerReferencesButton: function(ed, url) {
    return ed.addButton('reference', {
      title: 'Reference',
      cmd: 'reference',
      image: url + '/reference.png',
      onPostRender: function() {
        var _this;
        _this = this;
        return ed.on('NodeChange', function() {
          var is_active;
          is_active = jQuery(ed.selection.getNode()).hasClass('tome-reference');
          return _this.active(is_active);
        });
      }
    });
  }
};

tinymce.create('tinymce.plugins.TomeReferencesPlugin', ReferencesPluginHelper);

tinymce.PluginManager.add('tomeReferencesPlugin', tinymce.plugins.TomeReferencesPlugin);
