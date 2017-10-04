var $, BiblioAdminPage, BiblioForm, BiblioFormTinyMce, ModalWindow, ReferencesPopUp, TomeReferences, biblioForm, biblioID, modalWindow, referenceEdit, referenceID, tomeReferences;

$ = jQuery;

ReferencesPopUp = (function() {
  var buttonClasses, defaults, self;

  self = ReferencesPopUp;

  defaults = {
    message: "Message of your popup",
    singleChoice: false,
    onConfirm: function() {
      return $('.tome-popup, .tome-popup-bg').remove();
    },
    confirmText: "Yes",
    dismisText: "No"
  };

  buttonClasses = ['green', 'red'];

  function ReferencesPopUp(options) {
    this.s = $.extend({}, defaults, options || {});
    this.init();
  }

  ReferencesPopUp.prototype.init = function() {
    var s;
    s = this.s;
    this.open();
    return this.bindButtonActions();
  };

  ReferencesPopUp.prototype.makeButtons = function() {
    var $buttons;
    $buttons = "";
    $buttons += '<span class="popup-choice green confirm half">' + this.s.confirmText + '</span>';
    if (this.s.singleChoice !== true) {
      $buttons += '<span class="popup-choice red close half">' + this.s.dismisText + '</span>';
    }
    return $buttons;
  };

  ReferencesPopUp.prototype.bindButtonActions = function() {
    $('.popup-choice.confirm').click((function() {
      this.s.onConfirm();
      return this.close();
    }).bind(this));
    return $('.popup-choice.close').click((function() {
      if (this.s.onDismis !== 'undefined') {
        this.s.onDismis();
      }
      return this.close();
    }).bind(this));
  };

  ReferencesPopUp.prototype.close = function() {
    return $('.tome-popup, .tome-popup-bg').remove();
  };

  ReferencesPopUp.prototype.open = function() {
    var $popup;
    $popup = '<div class="tome-popup-bg"></div> <div class="tome-popup"> <p>' + this.s.message + '</p>' + '<div class="choices-wrapper">' + this.makeButtons() + '</div>' + '</div>';
    return $('body').append($popup);
  };

  return ReferencesPopUp;

})();

TomeReferences = (function() {
  var refEditorSettings;

  function TomeReferences() {}

  refEditorSettings = {
    editorMethod: 'create'
  };

  TomeReferences.prototype.generateReferenceText = function(biblioID) {
    var params;
    params = {
      action: 'generate_reference_text',
      'biblio_id': biblioID
    };
    return $.post(ajaxurl, params, function(reference_text) {
      return tinyMCE.get('reference_text').setContent(reference_text);
    });
  };

  TomeReferences.prototype.getReferenceText = function(referenceID) {
    var params;
    params = {
      action: 'get_reference_text',
      'reference_id': referenceID
    };
    return $.get(ajaxurl, params, function(reference_text) {
      return tinyMCE.get('reference_text').setContent(reference_text);
    });
  };

  TomeReferences.prototype.createReference = function(biblioID) {
    var args;
    if (!biblioID) {
      biblioID = $('.selected-biblio-id').val();
    }
    args = {
      action: 'create_reference',
      bibliography_id: biblioID,
      reference_text: tinyMCE.get('reference_text').getContent(),
      post_parent: $('.current-post').val()
    };
    return $.post(ajaxurl, args, function(referenceID) {
      ReferencesPluginHelper.addReferenceToEditor(referenceID, biblioID);
      return modalWindow.close();
    });
  };

  TomeReferences.prototype.updateReference = function(referenceID) {
    var newReferenceText, params;
    newReferenceText = tinymce.editors['reference_text'].getContent();
    params = {
      action: 'update_reference',
      'reference_id': referenceID,
      'reference_text': newReferenceText
    };
    return $.post(ajaxurl, params, function(referenceID) {
      $('.reference-text').trigger('update-reference', [referenceID, newReferenceText]);
      return modalWindow.close();
    });
  };

  TomeReferences.prototype.getEditorMethod = function() {
    return refEditorSettings.editorMethod;
  };

  TomeReferences.prototype.setEditorMethod = function(method) {
    return refEditorSettings.editorMethod = method;
  };

  TomeReferences.prototype.setCurrentReference = function(referenceID) {
    return this.referenceID = referenceID;
  };

  TomeReferences.prototype.getCurrentReference = function() {
    return this.referenceID;
  };

  return TomeReferences;

})();

BiblioFormTinyMce = (function() {
  function BiblioFormTinyMce() {}

  BiblioFormTinyMce.prototype.init = function() {
    return this.getTinymceWrappers();
  };

  BiblioFormTinyMce.prototype.getTinymceWrappers = function() {
    var tinymceSettings, wrappers;
    wrappers = [];
    tinymceSettings = tinymce.get('reference_text').settings;
    tinymceSettings.selector = '.tinymce-wrapper';
    tinymceSettings.toolbar1 = 'bold | italic';
    delete tinymceSettings['id'];
    tinymce.init(tinymceSettings);
    return wrappers;
  };

  BiblioFormTinyMce.prototype.setValues = function() {
    return $('.tinymce-wrapper').each(function(index, element) {
      var editorID;
      editorID = $(element).attr('id');
      return tinyMCE.get(editorID).setContent($(element).val());
    });
  };

  BiblioFormTinyMce.prototype.getTinyMceHtml = function() {
    var params;
    params = {
      action: 'init_tinymce_fields',
      'tinymce_wrappers': this.getTinymceWrappers()
    };
    return $.get(ajaxurl, params);
  };

  BiblioFormTinyMce.prototype.appendTinyMce = function(editorHtml) {
    return $('#biblio_text').after(editorHtml);
  };

  return BiblioFormTinyMce;

})();

BiblioForm = (function() {
  var addEntrytoList, formValidation, initListOfEntries, removeShortcodes, saveBibliography, serializeForm, settings;

  settings = {
    biblioForm: $('.biblio-form'),
    repeaterDeleteButton: '.remove-section',
    entriesList: false,
    currentBiblio: 0
  };

  function BiblioForm() {
    $('body').on('change', 'select[name="online_reference_type"]', this.chooseOnlineReferenceField);
    this.init();
  }

  BiblioForm.prototype.init = function() {
    initListOfEntries();
    formValidation();
    return this.bindUiInteraction();
  };

  BiblioForm.prototype.getBiblioStyleSources = function() {
    var biblioStyle, params;
    biblioStyle = $('#biblio-style').val();
    $('#type-of-source').attr('disabled', 'disabled');
    params = {
      action: 'get_biblio_style_sources',
      'biblio_style': biblioStyle
    };
    return $.post(ajaxurl, params, function(response) {
      $('#type-of-source').removeAttr('disabled').html(response);
      if (biblioStyle === 'custom') {
        return $('#type-of-source').attr('class', 'hidden');
      } else {
        return $('#type-of-source').removeClass('hidden');
      }
    });
  };

  BiblioForm.prototype.loadEditBiblioForm = function(biblioID) {
    var $this;
    $this = this;
    settings.currentBiblio = biblioID;
    return this.getBiblioMeta(biblioID).then(function(entryMeta) {
      var biblioConfig, loadForm, values;
      entryMeta = $.parseJSON(entryMeta);
      biblioConfig = {
        biblio_id: biblioID,
        biblio_style: entryMeta['biblio-style'][0],
        type_of_source: entryMeta['type-of-source'][0],
        chicago_system: entryMeta['chicago-system'][0]
      };
      loadForm = $this.loadBiblioForm(biblioConfig);
      values = $this.getBiblioFormValues(biblioID);
      return $.when(loadForm, values).done(function(formHTML, biblioFormValues) {
        return $this.setBiblioFormValues(biblioFormValues[0], biblioID);
      });
    });
  };

  BiblioForm.prototype.chooseOnlineReferenceField = function(evt) {
    var selectedValue;
    selectedValue = $(evt.target).val();
    return $('input[name="dynamic_field"]').siblings('label').text(selectedValue);
  };

  BiblioForm.prototype.displayChicagoSystemOption = function() {
    return $('#chicago-system').attr('class', 'active');
  };

  formValidation = function() {
    return $('.biblio-form').validate({
      submitHandler: function(form) {
        biblioHelpers.checkEmptyRepeater();
        saveBibliography();
        return false;
      }
    });
  };

  serializeForm = function() {
    $('.tinymce-wrapper').each(function(index, element) {
      var tinymceValue, wrapperID;
      wrapperID = $(element).attr('id');
      tinymceValue = tinyMCE.get(wrapperID).getContent();
      return $(element).val(tinymceValue);
    });
    return $('.biblio-form').serialize();
  };

  saveBibliography = function() {
    var params;
    params = {
      action: 'save_bibliography',
      'form_data': serializeForm(),
      'post_id': settings.currentBiblio
    };
    return $.post(ajaxurl, params, function(response) {
      var item;
      response = $.parseJSON(response);
      if (params.post_id) {
        item = settings.entriesList.get('entry-id', response['post_id']);
        item[0].values({
          'entry-title': response['post_title'],
          'entry-id': response['post_id'],
          'author-name': 'by: ' + response['entry_author']
        });
      } else {
        addEntrytoList(response);
      }
      biblioHelpers.clearBiblioForm();
      return $('.create-biblio .back-button').click();
    });
  };

  BiblioForm.prototype.getBiblioConfig = function() {
    return {
      biblio_style: $('#biblio-style').val(),
      type_of_source: $('#type-of-source').val(),
      chicago_system: $('#chicago-system').val()
    };
  };

  BiblioForm.prototype.getBiblioFormHtml = function(biblioConfig) {
    biblioConfig['action'] = 'get_biblio_form';
    return $.get(ajaxurl, biblioConfig);
  };

  BiblioForm.prototype.getBiblioMeta = function(biblioID) {
    var params;
    params = {
      action: 'get_biblio_entry_meta',
      biblio_id: biblioID
    };
    return $.get(ajaxurl, params);
  };

  BiblioForm.prototype.getBiblioFormValues = function(biblioID) {
    var params;
    params = {
      action: 'get_biblio_form_values',
      biblio_id: biblioID
    };
    return $.get(ajaxurl, params);
  };

  BiblioForm.prototype.setBiblioFormValues = function(formValues, entryID) {
    formValues = $.parseJSON(formValues);
    $('.save-bibliography').val('Update bibliographic entry');
    this.chicagoSystemToggle(formValues['biblio-style']);
    $.each(formValues, function(fieldName, fieldValue) {
      var i, repeaterLength;
      if (typeof fieldValue === 'object') {
        repeaterLength = fieldValue['first_name'].length;
        i = 0;
        while (i < repeaterLength) {
          $.each(fieldValue, function(repeaterName, repeaterValue) {
            var repeaterField;
            repeaterField = $('input[name="' + fieldName + '[' + repeaterName + '][]"]')[i];
            return $(repeaterField).val(repeaterValue[i]);
          });
          i++;
        }
      }
      $('*[name="' + fieldName + '"]').val(fieldValue).parents('.input-wrapp').addClass('has-value');
      if (entryID !== 'undefined') {
        return $('.save-bibliography').attr('data-entry-id', entryID);
      }
    });
    BiblioFormTinyMce.prototype.setValues();
    return this.getBiblioStyleSources();
  };

  BiblioForm.prototype.deleteRepeaterField = function() {
    var $repeaterName;
    $repeaterName = $(this).parents('.fields-section').attr('data-repeater-name');
    if ($('.fields-section[data-repeater-name="' + $repeaterName + '"]').length !== 1) {
      return $(this).parents('.fields-section').remove();
    }
  };

  initListOfEntries = function() {
    var options;
    options = {
      item: 'biblio-entry-template',
      valueNames: [
        'entry-title', 'author-name', {
          name: 'entry-id',
          attr: 'data-entry'
        }
      ],
      page: 8,
      plugins: [ListPagination()]
    };
    return settings['entriesList'] = new List('biblio-entries', options);
  };

  addEntrytoList = function(entryParams) {
    return settings.entriesList.add([
      {
        'entry-title': entryParams['post_title'],
        'entry-id': entryParams['post_id'],
        'author-name': 'by: ' + entryParams['entry_author']
      }
    ], function(items) {
      settings.entriesList.sort('entry-id', {
        order: 'desc'
      });
      return $(settings.entriesList.items[0].elm).find('.edit-link').attr({
        'data-source': entryParams['type_of_source'],
        'data-style': entryParams['biblio_style']
      });
    });
  };

  removeShortcodes = function(editor, biblioID) {
    var editorContent, regex;
    regex = new RegExp("\\[tome_reference id=[\"']\\d+[\"'] biblio-id=[\"'](" + biblioID + ")[\"'].*?\\]([^\[]*)\\[\/tome_reference\\]", "g");
    editorContent = editor.getContent();
    editorContent = editorContent.replace(regex, '$2');
    return editor.setContent(editorContent);
  };

  BiblioForm.prototype.chicagoSystemToggle = function(biblioStyle) {
    if (biblioStyle === 'chicago') {
      return $('#chicago-system').attr('class', 'active');
    } else {
      return $('#chicago-system').removeClass('active');
    }
  };

  BiblioForm.prototype.deleteEntryPopUp = function() {
    var biblioID;
    biblioID = $(this).siblings('.entry-id').attr('data-entry');
    return new ReferencesPopUp({
      message: "Are you sure, you want to delete this entry?",
      buttons: {
        green: {
          text: "NO"
        },
        red: {
          text: "YES",
          callback: function() {
            settings.entriesList.remove('entry-id', biblioID);
            return BiblioForm.deleteBiblio(biblioID);
          }
        }
      }
    });
  };

  BiblioForm.deleteBiblio = function(biblioID) {
    var params;
    params = {
      action: 'delete_bibliography',
      'id': biblioID
    };
    return $.post(ajaxurl, params, function(response) {
      var activeEditor;
      activeEditor = tinyMCE.activeEditor;
      $('.biblio-entry').trigger('delete-biblio', [biblioID]);
      if (activeEditor !== null) {
        return removeShortcodes(activeEditor, biblioID);
      }
    });
  };

  BiblioForm.prototype.loadBiblioForm = function(biblioConfig) {
    $('.biblio-form').addClass('loading');
    return biblioForm.getBiblioFormHtml(biblioConfig).then(function(formHtml) {
      return biblioForm.appendFormFields(formHtml);
    });
  };

  BiblioForm.prototype.appendFormFields = function(formFields) {
    $('.biblio-form-wrapper').removeClass('active').html(formFields);
    $('.biblio-form-wrapper').find('*[name="date_accessed"],*[name="date"]').datepicker();
    return this.fieldsLoaded();
  };

  BiblioForm.prototype.fieldsLoaded = function() {
    var biblioTinyMce;
    biblioTinyMce = new BiblioFormTinyMce;
    biblioTinyMce.init();
    return $('.biblio-form').removeClass('loading');
  };

  BiblioForm.prototype.duplicateSection = function() {
    var sectionCopy;
    sectionCopy = $(this).parents('.fields-section').clone();
    sectionCopy.find('input').each(function(index, el) {
      _this.incrementNameId(el);
      return $(el).val('');
    });
    return sectionCopy.insertAfter($(this).parents('.fields-section'));
  };

  BiblioForm.prototype.incrementNameId = function(input) {
    var name;
    name = $(input).attr('name');
    name = name.replace(/\[(\d+)\]/, function(match, number) {
      return '[' + (parseInt(number, 10) + 1) + ']';
    });
    return $(input).attr('name', name);
  };

  BiblioForm.prototype.bindUiInteraction = function() {
    $('#references-modal').on('click', '.remove-section', this.deleteRepeaterField);
    $('.biblio-form').on('click', '.repeat-section', this.duplicateSection);
    return $('#biblio-entries').on('click', '.delete-entry', this.deleteEntryPopUp);
  };

  return BiblioForm;

})();

ModalWindow = (function() {
  function ModalWindow() {
    this.init();
  }

  ModalWindow.prototype.init = function() {
    $('.close-references-modal').click((function(_this) {
      return function() {
        return _this.close();
      };
    })(this));
    $('.add-biblio').click((function(_this) {
      return function() {
        return ModalWindow.goToSection('create-biblio');
      };
    })(this));
    $('.back-button').click((function(_this) {
      return function() {
        ModalWindow.goToSection('biblio-list');
        return biblioHelpers.clearBiblioForm();
      };
    })(this));
    return this.materialInputEffect();
  };

  ModalWindow.prototype.open = function() {
    return $('#references-modal').addClass("md-show");
  };

  ModalWindow.prototype.close = function() {
    var biblioID, referenceID;
    $('.md-modal').removeClass('md-show');
    ModalWindow.goToSection('biblio-list');
    biblioID = 0;
    referenceID = 0;
    window.activeEditor = "";
    return window.referenceEdit = false;
  };

  ModalWindow.goToSection = function(sectionName) {
    if ($('#biblio-entries .biblio-entry').length === 0 && sectionName === 'biblio-list') {
      sectionName = 'no-entries';
    }
    $('.modal-section.active').addClass('fadeOutUp').removeClass('active');
    return $('.' + sectionName).removeClass('hidden fadeOutUp').addClass('fadeInUp active');
  };

  ModalWindow.prototype.materialInputEffect = function() {
    var $modalWindow;
    $modalWindow = $('#references-modal');
    $modalWindow.on('focus', '.biblio-input', function() {
      return $(this).parents('.input-wrapp').addClass('focused has-value');
    });
    $modalWindow.on('focusout', '.biblio-input', function() {
      return $(this).parents('.input-wrapp').removeClass('focused');
    });
    return $modalWindow.on('blur', '.biblio-input', function() {
      if ($(this).attr('value') === "") {
        $(this).parents('.input-wrapp').removeClass('has-value');
        return $(this).parents('.input-wrapp').removeClass('focused');
      }
    });
  };

  return ModalWindow;

})();

BiblioAdminPage = (function() {
  function BiblioAdminPage() {
    var options, userList;
    this.bindUiInteraction();
    options = {
      valueNames: ['biblio-title', 'reference-text']
    };
    userList = new List('biblio-entries-list', options);
  }

  BiblioAdminPage.prototype.editReference = function() {
    var biblioID, referenceID;
    modalWindow.open();
    biblioID = $(this).parent().data('biblio-id');
    referenceID = $(this).parent().data('reference-id');
    ModalWindow.goToSection('reference-form');
    tomeReferences.getReferenceText(referenceID);
    tomeReferences.setEditorMethod('update');
    return tomeReferences.setCurrentReference(referenceID);
  };

  BiblioAdminPage.prototype.editBibliography = function() {
    var biblioID;
    modalWindow.open();
    ModalWindow.goToSection('create-biblio');
    biblioID = $(this).parents('tr').data('biblio-id');
    return biblioForm.loadEditBiblioForm(biblioID);
  };

  BiblioAdminPage.prototype.deleteBiblio = function(biblioID) {
    var params;
    params = {
      action: 'delete_bibliography',
      id: biblioID
    };
    return $.post(ajaxurl, params, function(response) {
      $('tr[data-biblio-id="' + biblioID + '"]').remove();
      return console.log(response);
    });
  };

  BiblioAdminPage.prototype.showBiblioReferences = function() {
    return $(this).parent().next().toggleClass('active');
  };

  BiblioAdminPage.prototype.openDeletePopUp = function() {
    var element;
    element = this;
    return new ReferencesPopUp({
      message: "Do you want to delete this entry? <br> This will cause deleting all associated references.",
      onConfirm: function() {
        var biblioID;
        biblioID = $(element).parents('tr').attr('data-biblio-id');
        return BiblioAdminPage.prototype.deleteBiblio(biblioID);
      }
    });
  };

  BiblioAdminPage.prototype.bindUiInteraction = function() {
    $('.reference-text').click(this.editReference);
    $('.biblio-title, .edit-biblio').click(this.editBibliography);
    $('.references-count').click(this.showBiblioReferences);
    $('.biblio-reference').on('update-reference', function(event, referenceID, referenceText) {
      if ($(this).data('reference-id') === parseInt(referenceID)) {
        return $(this).find('.reference-text').html(referenceText);
      }
    });
    $('.biblio-entry').on('delete-biblio', function(event, biblioID) {
      return $('tr[data-biblio-id="' + biblioID + '"]').remove();
    });
    return $('.remove-biblio').click(this.openDeletePopUp);
  };

  return BiblioAdminPage;

})();

biblioID = 0;

referenceID = 0;

referenceEdit = false;

tomeReferences = new TomeReferences();

biblioForm = new BiblioForm();

modalWindow = new ModalWindow();

biblioForm.getBiblioStyleSources();

jQuery(document).ready(function($) {
  var biblioAdminPage;
  if ($('.biblio-entries-table').length > 0) {
    return biblioAdminPage = new BiblioAdminPage();
  }
});

$('#generate-form').click(function() {
  var biblioConfig;
  if ($('#type-of-source').val() === "") {
    return alert('You have to select type of source');
  }
  biblioConfig = biblioForm.getBiblioConfig();
  return biblioForm.loadBiblioForm(biblioConfig);
});

$('#biblio-style').on('change', function() {
  var biblioStyle;
  biblioStyle = $(this).val();
  biblioForm.chicagoSystemToggle(biblioStyle);
  if (biblioStyle === 'custom') {
    $('#type-of-source').attr('class', 'hidden');
  } else {
    $('#type-of-source').removeClass('hidden');
  }
  return biblioForm.getBiblioStyleSources();
});

$('.add-reference').click(function() {
  if (tomeReferences.getEditorMethod() === 'create') {
    return tomeReferences.createReference(biblioID);
  } else {
    referenceID = tomeReferences.getCurrentReference();
    return tomeReferences.updateReference(referenceID);
  }
});

$('body').on('click', '.edit-link', function() {
  biblioID = $(this).siblings('.entry-id').attr('data-entry');
  ModalWindow.goToSection('create-biblio');
  return biblioForm.getBiblioMeta(biblioID).then(function(entryMeta) {
    var biblioConfig;
    entryMeta = $.parseJSON(entryMeta);
    biblioConfig = {
      biblio_id: biblioID,
      biblio_style: entryMeta['biblio-style'][0],
      type_of_source: entryMeta['type-of-source'][0],
      chicago_system: entryMeta['chicago-system'][0]
    };
    $('#biblio-style').trigger('change');
    return biblioForm.loadBiblioForm(biblioConfig).then(function() {
      return biblioForm.getBiblioFormValues(biblioID).then(function(biblioFormValues) {
        return biblioForm.setBiblioFormValues(biblioFormValues, biblioID);
      });
    });
  });
});

$('.first-biblio').click(function() {
  return ModalWindow.goToSection('create-biblio');
});

$('body').on('click', '.entry-title', function() {
  biblioID = $(this).siblings('.entry-id').data('entry');
  ModalWindow.goToSection('reference-form');
  return tomeReferences.generateReferenceText(biblioID);
});
