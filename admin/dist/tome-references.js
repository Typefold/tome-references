/*! tome-references - v0.1.0 - 2017-05-31
* https://github.com/auginator/Tome
* Copyright (c) 2017 Jakub Kohout; Licensed MIT */
/*! jQuery Validation Plugin - v1.15.0 - 2/24/2016
 * http://jqueryvalidation.org/
 * Copyright (c) 2016 Jörn Zaefferer; Licensed MIT */
!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):"object"==typeof module&&module.exports?module.exports=a(require("jquery")):a(jQuery)}(function(a){a.extend(a.fn,{validate:function(b){if(!this.length)return void(b&&b.debug&&window.console&&console.warn("Nothing selected, can't validate, returning nothing."));var c=a.data(this[0],"validator");return c?c:(this.attr("novalidate","novalidate"),c=new a.validator(b,this[0]),a.data(this[0],"validator",c),c.settings.onsubmit&&(this.on("click.validate",":submit",function(b){c.settings.submitHandler&&(c.submitButton=b.target),a(this).hasClass("cancel")&&(c.cancelSubmit=!0),void 0!==a(this).attr("formnovalidate")&&(c.cancelSubmit=!0)}),this.on("submit.validate",function(b){function d(){var d,e;return c.settings.submitHandler?(c.submitButton&&(d=a("<input type='hidden'/>").attr("name",c.submitButton.name).val(a(c.submitButton).val()).appendTo(c.currentForm)),e=c.settings.submitHandler.call(c,c.currentForm,b),c.submitButton&&d.remove(),void 0!==e?e:!1):!0}return c.settings.debug&&b.preventDefault(),c.cancelSubmit?(c.cancelSubmit=!1,d()):c.form()?c.pendingRequest?(c.formSubmitted=!0,!1):d():(c.focusInvalid(),!1)})),c)},valid:function(){var b,c,d;return a(this[0]).is("form")?b=this.validate().form():(d=[],b=!0,c=a(this[0].form).validate(),this.each(function(){b=c.element(this)&&b,b||(d=d.concat(c.errorList))}),c.errorList=d),b},rules:function(b,c){if(this.length){var d,e,f,g,h,i,j=this[0];if(b)switch(d=a.data(j.form,"validator").settings,e=d.rules,f=a.validator.staticRules(j),b){case"add":a.extend(f,a.validator.normalizeRule(c)),delete f.messages,e[j.name]=f,c.messages&&(d.messages[j.name]=a.extend(d.messages[j.name],c.messages));break;case"remove":return c?(i={},a.each(c.split(/\s/),function(b,c){i[c]=f[c],delete f[c],"required"===c&&a(j).removeAttr("aria-required")}),i):(delete e[j.name],f)}return g=a.validator.normalizeRules(a.extend({},a.validator.classRules(j),a.validator.attributeRules(j),a.validator.dataRules(j),a.validator.staticRules(j)),j),g.required&&(h=g.required,delete g.required,g=a.extend({required:h},g),a(j).attr("aria-required","true")),g.remote&&(h=g.remote,delete g.remote,g=a.extend(g,{remote:h})),g}}}),a.extend(a.expr[":"],{blank:function(b){return!a.trim(""+a(b).val())},filled:function(b){var c=a(b).val();return null!==c&&!!a.trim(""+c)},unchecked:function(b){return!a(b).prop("checked")}}),a.validator=function(b,c){this.settings=a.extend(!0,{},a.validator.defaults,b),this.currentForm=c,this.init()},a.validator.format=function(b,c){return 1===arguments.length?function(){var c=a.makeArray(arguments);return c.unshift(b),a.validator.format.apply(this,c)}:void 0===c?b:(arguments.length>2&&c.constructor!==Array&&(c=a.makeArray(arguments).slice(1)),c.constructor!==Array&&(c=[c]),a.each(c,function(a,c){b=b.replace(new RegExp("\\{"+a+"\\}","g"),function(){return c})}),b)},a.extend(a.validator,{defaults:{messages:{},groups:{},rules:{},errorClass:"error",pendingClass:"pending",validClass:"valid",errorElement:"label",focusCleanup:!1,focusInvalid:!0,errorContainer:a([]),errorLabelContainer:a([]),onsubmit:!0,ignore:":hidden",ignoreTitle:!1,onfocusin:function(a){this.lastActive=a,this.settings.focusCleanup&&(this.settings.unhighlight&&this.settings.unhighlight.call(this,a,this.settings.errorClass,this.settings.validClass),this.hideThese(this.errorsFor(a)))},onfocusout:function(a){this.checkable(a)||!(a.name in this.submitted)&&this.optional(a)||this.element(a)},onkeyup:function(b,c){var d=[16,17,18,20,35,36,37,38,39,40,45,144,225];9===c.which&&""===this.elementValue(b)||-1!==a.inArray(c.keyCode,d)||(b.name in this.submitted||b.name in this.invalid)&&this.element(b)},onclick:function(a){a.name in this.submitted?this.element(a):a.parentNode.name in this.submitted&&this.element(a.parentNode)},highlight:function(b,c,d){"radio"===b.type?this.findByName(b.name).addClass(c).removeClass(d):a(b).addClass(c).removeClass(d)},unhighlight:function(b,c,d){"radio"===b.type?this.findByName(b.name).removeClass(c).addClass(d):a(b).removeClass(c).addClass(d)}},setDefaults:function(b){a.extend(a.validator.defaults,b)},messages:{required:"This field is required.",remote:"Please fix this field.",email:"Please enter a valid email address.",url:"Please enter a valid URL.",date:"Please enter a valid date.",dateISO:"Please enter a valid date ( ISO ).",number:"Please enter a valid number.",digits:"Please enter only digits.",equalTo:"Please enter the same value again.",maxlength:a.validator.format("Please enter no more than {0} characters."),minlength:a.validator.format("Please enter at least {0} characters."),rangelength:a.validator.format("Please enter a value between {0} and {1} characters long."),range:a.validator.format("Please enter a value between {0} and {1}."),max:a.validator.format("Please enter a value less than or equal to {0}."),min:a.validator.format("Please enter a value greater than or equal to {0}."),step:a.validator.format("Please enter a multiple of {0}.")},autoCreateRanges:!1,prototype:{init:function(){function b(b){var c=a.data(this.form,"validator"),d="on"+b.type.replace(/^validate/,""),e=c.settings;e[d]&&!a(this).is(e.ignore)&&e[d].call(c,this,b)}this.labelContainer=a(this.settings.errorLabelContainer),this.errorContext=this.labelContainer.length&&this.labelContainer||a(this.currentForm),this.containers=a(this.settings.errorContainer).add(this.settings.errorLabelContainer),this.submitted={},this.valueCache={},this.pendingRequest=0,this.pending={},this.invalid={},this.reset();var c,d=this.groups={};a.each(this.settings.groups,function(b,c){"string"==typeof c&&(c=c.split(/\s/)),a.each(c,function(a,c){d[c]=b})}),c=this.settings.rules,a.each(c,function(b,d){c[b]=a.validator.normalizeRule(d)}),a(this.currentForm).on("focusin.validate focusout.validate keyup.validate",":text, [type='password'], [type='file'], select, textarea, [type='number'], [type='search'], [type='tel'], [type='url'], [type='email'], [type='datetime'], [type='date'], [type='month'], [type='week'], [type='time'], [type='datetime-local'], [type='range'], [type='color'], [type='radio'], [type='checkbox'], [contenteditable]",b).on("click.validate","select, option, [type='radio'], [type='checkbox']",b),this.settings.invalidHandler&&a(this.currentForm).on("invalid-form.validate",this.settings.invalidHandler),a(this.currentForm).find("[required], [data-rule-required], .required").attr("aria-required","true")},form:function(){return this.checkForm(),a.extend(this.submitted,this.errorMap),this.invalid=a.extend({},this.errorMap),this.valid()||a(this.currentForm).triggerHandler("invalid-form",[this]),this.showErrors(),this.valid()},checkForm:function(){this.prepareForm();for(var a=0,b=this.currentElements=this.elements();b[a];a++)this.check(b[a]);return this.valid()},element:function(b){var c,d,e=this.clean(b),f=this.validationTargetFor(e),g=this,h=!0;return void 0===f?delete this.invalid[e.name]:(this.prepareElement(f),this.currentElements=a(f),d=this.groups[f.name],d&&a.each(this.groups,function(a,b){b===d&&a!==f.name&&(e=g.validationTargetFor(g.clean(g.findByName(a))),e&&e.name in g.invalid&&(g.currentElements.push(e),h=h&&g.check(e)))}),c=this.check(f)!==!1,h=h&&c,c?this.invalid[f.name]=!1:this.invalid[f.name]=!0,this.numberOfInvalids()||(this.toHide=this.toHide.add(this.containers)),this.showErrors(),a(b).attr("aria-invalid",!c)),h},showErrors:function(b){if(b){var c=this;a.extend(this.errorMap,b),this.errorList=a.map(this.errorMap,function(a,b){return{message:a,element:c.findByName(b)[0]}}),this.successList=a.grep(this.successList,function(a){return!(a.name in b)})}this.settings.showErrors?this.settings.showErrors.call(this,this.errorMap,this.errorList):this.defaultShowErrors()},resetForm:function(){a.fn.resetForm&&a(this.currentForm).resetForm(),this.invalid={},this.submitted={},this.prepareForm(),this.hideErrors();var b=this.elements().removeData("previousValue").removeAttr("aria-invalid");this.resetElements(b)},resetElements:function(a){var b;if(this.settings.unhighlight)for(b=0;a[b];b++)this.settings.unhighlight.call(this,a[b],this.settings.errorClass,""),this.findByName(a[b].name).removeClass(this.settings.validClass);else a.removeClass(this.settings.errorClass).removeClass(this.settings.validClass)},numberOfInvalids:function(){return this.objectLength(this.invalid)},objectLength:function(a){var b,c=0;for(b in a)a[b]&&c++;return c},hideErrors:function(){this.hideThese(this.toHide)},hideThese:function(a){a.not(this.containers).text(""),this.addWrapper(a).hide()},valid:function(){return 0===this.size()},size:function(){return this.errorList.length},focusInvalid:function(){if(this.settings.focusInvalid)try{a(this.findLastActive()||this.errorList.length&&this.errorList[0].element||[]).filter(":visible").focus().trigger("focusin")}catch(b){}},findLastActive:function(){var b=this.lastActive;return b&&1===a.grep(this.errorList,function(a){return a.element.name===b.name}).length&&b},elements:function(){var b=this,c={};return a(this.currentForm).find("input, select, textarea, [contenteditable]").not(":submit, :reset, :image, :disabled").not(this.settings.ignore).filter(function(){var d=this.name||a(this).attr("name");return!d&&b.settings.debug&&window.console&&console.error("%o has no name assigned",this),this.hasAttribute("contenteditable")&&(this.form=a(this).closest("form")[0]),d in c||!b.objectLength(a(this).rules())?!1:(c[d]=!0,!0)})},clean:function(b){return a(b)[0]},errors:function(){var b=this.settings.errorClass.split(" ").join(".");return a(this.settings.errorElement+"."+b,this.errorContext)},resetInternals:function(){this.successList=[],this.errorList=[],this.errorMap={},this.toShow=a([]),this.toHide=a([])},reset:function(){this.resetInternals(),this.currentElements=a([])},prepareForm:function(){this.reset(),this.toHide=this.errors().add(this.containers)},prepareElement:function(a){this.reset(),this.toHide=this.errorsFor(a)},elementValue:function(b){var c,d,e=a(b),f=b.type;return"radio"===f||"checkbox"===f?this.findByName(b.name).filter(":checked").val():"number"===f&&"undefined"!=typeof b.validity?b.validity.badInput?"NaN":e.val():(c=b.hasAttribute("contenteditable")?e.text():e.val(),"file"===f?"C:\\fakepath\\"===c.substr(0,12)?c.substr(12):(d=c.lastIndexOf("/"),d>=0?c.substr(d+1):(d=c.lastIndexOf("\\"),d>=0?c.substr(d+1):c)):"string"==typeof c?c.replace(/\r/g,""):c)},check:function(b){b=this.validationTargetFor(this.clean(b));var c,d,e,f=a(b).rules(),g=a.map(f,function(a,b){return b}).length,h=!1,i=this.elementValue(b);if("function"==typeof f.normalizer){if(i=f.normalizer.call(b,i),"string"!=typeof i)throw new TypeError("The normalizer should return a string value.");delete f.normalizer}for(d in f){e={method:d,parameters:f[d]};try{if(c=a.validator.methods[d].call(this,i,b,e.parameters),"dependency-mismatch"===c&&1===g){h=!0;continue}if(h=!1,"pending"===c)return void(this.toHide=this.toHide.not(this.errorsFor(b)));if(!c)return this.formatAndAdd(b,e),!1}catch(j){throw this.settings.debug&&window.console&&console.log("Exception occurred when checking element "+b.id+", check the '"+e.method+"' method.",j),j instanceof TypeError&&(j.message+=".  Exception occurred when checking element "+b.id+", check the '"+e.method+"' method."),j}}if(!h)return this.objectLength(f)&&this.successList.push(b),!0},customDataMessage:function(b,c){return a(b).data("msg"+c.charAt(0).toUpperCase()+c.substring(1).toLowerCase())||a(b).data("msg")},customMessage:function(a,b){var c=this.settings.messages[a];return c&&(c.constructor===String?c:c[b])},findDefined:function(){for(var a=0;a<arguments.length;a++)if(void 0!==arguments[a])return arguments[a]},defaultMessage:function(b,c){var d=this.findDefined(this.customMessage(b.name,c.method),this.customDataMessage(b,c.method),!this.settings.ignoreTitle&&b.title||void 0,a.validator.messages[c.method],"<strong>Warning: No message defined for "+b.name+"</strong>"),e=/\$?\{(\d+)\}/g;return"function"==typeof d?d=d.call(this,c.parameters,b):e.test(d)&&(d=a.validator.format(d.replace(e,"{$1}"),c.parameters)),d},formatAndAdd:function(a,b){var c=this.defaultMessage(a,b);this.errorList.push({message:c,element:a,method:b.method}),this.errorMap[a.name]=c,this.submitted[a.name]=c},addWrapper:function(a){return this.settings.wrapper&&(a=a.add(a.parent(this.settings.wrapper))),a},defaultShowErrors:function(){var a,b,c;for(a=0;this.errorList[a];a++)c=this.errorList[a],this.settings.highlight&&this.settings.highlight.call(this,c.element,this.settings.errorClass,this.settings.validClass),this.showLabel(c.element,c.message);if(this.errorList.length&&(this.toShow=this.toShow.add(this.containers)),this.settings.success)for(a=0;this.successList[a];a++)this.showLabel(this.successList[a]);if(this.settings.unhighlight)for(a=0,b=this.validElements();b[a];a++)this.settings.unhighlight.call(this,b[a],this.settings.errorClass,this.settings.validClass);this.toHide=this.toHide.not(this.toShow),this.hideErrors(),this.addWrapper(this.toShow).show()},validElements:function(){return this.currentElements.not(this.invalidElements())},invalidElements:function(){return a(this.errorList).map(function(){return this.element})},showLabel:function(b,c){var d,e,f,g,h=this.errorsFor(b),i=this.idOrName(b),j=a(b).attr("aria-describedby");h.length?(h.removeClass(this.settings.validClass).addClass(this.settings.errorClass),h.html(c)):(h=a("<"+this.settings.errorElement+">").attr("id",i+"-error").addClass(this.settings.errorClass).html(c||""),d=h,this.settings.wrapper&&(d=h.hide().show().wrap("<"+this.settings.wrapper+"/>").parent()),this.labelContainer.length?this.labelContainer.append(d):this.settings.errorPlacement?this.settings.errorPlacement(d,a(b)):d.insertAfter(b),h.is("label")?h.attr("for",i):0===h.parents("label[for='"+this.escapeCssMeta(i)+"']").length&&(f=h.attr("id"),j?j.match(new RegExp("\\b"+this.escapeCssMeta(f)+"\\b"))||(j+=" "+f):j=f,a(b).attr("aria-describedby",j),e=this.groups[b.name],e&&(g=this,a.each(g.groups,function(b,c){c===e&&a("[name='"+g.escapeCssMeta(b)+"']",g.currentForm).attr("aria-describedby",h.attr("id"))})))),!c&&this.settings.success&&(h.text(""),"string"==typeof this.settings.success?h.addClass(this.settings.success):this.settings.success(h,b)),this.toShow=this.toShow.add(h)},errorsFor:function(b){var c=this.escapeCssMeta(this.idOrName(b)),d=a(b).attr("aria-describedby"),e="label[for='"+c+"'], label[for='"+c+"'] *";return d&&(e=e+", #"+this.escapeCssMeta(d).replace(/\s+/g,", #")),this.errors().filter(e)},escapeCssMeta:function(a){return a.replace(/([\\!"#$%&'()*+,./:;<=>?@\[\]^`{|}~])/g,"\\$1")},idOrName:function(a){return this.groups[a.name]||(this.checkable(a)?a.name:a.id||a.name)},validationTargetFor:function(b){return this.checkable(b)&&(b=this.findByName(b.name)),a(b).not(this.settings.ignore)[0]},checkable:function(a){return/radio|checkbox/i.test(a.type)},findByName:function(b){return a(this.currentForm).find("[name='"+this.escapeCssMeta(b)+"']")},getLength:function(b,c){switch(c.nodeName.toLowerCase()){case"select":return a("option:selected",c).length;case"input":if(this.checkable(c))return this.findByName(c.name).filter(":checked").length}return b.length},depend:function(a,b){return this.dependTypes[typeof a]?this.dependTypes[typeof a](a,b):!0},dependTypes:{"boolean":function(a){return a},string:function(b,c){return!!a(b,c.form).length},"function":function(a,b){return a(b)}},optional:function(b){var c=this.elementValue(b);return!a.validator.methods.required.call(this,c,b)&&"dependency-mismatch"},startRequest:function(b){this.pending[b.name]||(this.pendingRequest++,a(b).addClass(this.settings.pendingClass),this.pending[b.name]=!0)},stopRequest:function(b,c){this.pendingRequest--,this.pendingRequest<0&&(this.pendingRequest=0),delete this.pending[b.name],a(b).removeClass(this.settings.pendingClass),c&&0===this.pendingRequest&&this.formSubmitted&&this.form()?(a(this.currentForm).submit(),this.formSubmitted=!1):!c&&0===this.pendingRequest&&this.formSubmitted&&(a(this.currentForm).triggerHandler("invalid-form",[this]),this.formSubmitted=!1)},previousValue:function(b,c){return a.data(b,"previousValue")||a.data(b,"previousValue",{old:null,valid:!0,message:this.defaultMessage(b,{method:c})})},destroy:function(){this.resetForm(),a(this.currentForm).off(".validate").removeData("validator").find(".validate-equalTo-blur").off(".validate-equalTo").removeClass("validate-equalTo-blur")}},classRuleSettings:{required:{required:!0},email:{email:!0},url:{url:!0},date:{date:!0},dateISO:{dateISO:!0},number:{number:!0},digits:{digits:!0},creditcard:{creditcard:!0}},addClassRules:function(b,c){b.constructor===String?this.classRuleSettings[b]=c:a.extend(this.classRuleSettings,b)},classRules:function(b){var c={},d=a(b).attr("class");return d&&a.each(d.split(" "),function(){this in a.validator.classRuleSettings&&a.extend(c,a.validator.classRuleSettings[this])}),c},normalizeAttributeRule:function(a,b,c,d){/min|max|step/.test(c)&&(null===b||/number|range|text/.test(b))&&(d=Number(d),isNaN(d)&&(d=void 0)),d||0===d?a[c]=d:b===c&&"range"!==b&&(a[c]=!0)},attributeRules:function(b){var c,d,e={},f=a(b),g=b.getAttribute("type");for(c in a.validator.methods)"required"===c?(d=b.getAttribute(c),""===d&&(d=!0),d=!!d):d=f.attr(c),this.normalizeAttributeRule(e,g,c,d);return e.maxlength&&/-1|2147483647|524288/.test(e.maxlength)&&delete e.maxlength,e},dataRules:function(b){var c,d,e={},f=a(b),g=b.getAttribute("type");for(c in a.validator.methods)d=f.data("rule"+c.charAt(0).toUpperCase()+c.substring(1).toLowerCase()),this.normalizeAttributeRule(e,g,c,d);return e},staticRules:function(b){var c={},d=a.data(b.form,"validator");return d.settings.rules&&(c=a.validator.normalizeRule(d.settings.rules[b.name])||{}),c},normalizeRules:function(b,c){return a.each(b,function(d,e){if(e===!1)return void delete b[d];if(e.param||e.depends){var f=!0;switch(typeof e.depends){case"string":f=!!a(e.depends,c.form).length;break;case"function":f=e.depends.call(c,c)}f?b[d]=void 0!==e.param?e.param:!0:(a.data(c.form,"validator").resetElements(a(c)),delete b[d])}}),a.each(b,function(d,e){b[d]=a.isFunction(e)&&"normalizer"!==d?e(c):e}),a.each(["minlength","maxlength"],function(){b[this]&&(b[this]=Number(b[this]))}),a.each(["rangelength","range"],function(){var c;b[this]&&(a.isArray(b[this])?b[this]=[Number(b[this][0]),Number(b[this][1])]:"string"==typeof b[this]&&(c=b[this].replace(/[\[\]]/g,"").split(/[\s,]+/),b[this]=[Number(c[0]),Number(c[1])]))}),a.validator.autoCreateRanges&&(null!=b.min&&null!=b.max&&(b.range=[b.min,b.max],delete b.min,delete b.max),null!=b.minlength&&null!=b.maxlength&&(b.rangelength=[b.minlength,b.maxlength],delete b.minlength,delete b.maxlength)),b},normalizeRule:function(b){if("string"==typeof b){var c={};a.each(b.split(/\s/),function(){c[this]=!0}),b=c}return b},addMethod:function(b,c,d){a.validator.methods[b]=c,a.validator.messages[b]=void 0!==d?d:a.validator.messages[b],c.length<3&&a.validator.addClassRules(b,a.validator.normalizeRule(b))},methods:{required:function(b,c,d){if(!this.depend(d,c))return"dependency-mismatch";if("select"===c.nodeName.toLowerCase()){var e=a(c).val();return e&&e.length>0}return this.checkable(c)?this.getLength(b,c)>0:b.length>0},email:function(a,b){return this.optional(b)||/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/.test(a)},url:function(a,b){return this.optional(b)||/^(?:(?:(?:https?|ftp):)?\/\/)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})).?)(?::\d{2,5})?(?:[/?#]\S*)?$/i.test(a)},date:function(a,b){return this.optional(b)||!/Invalid|NaN/.test(new Date(a).toString())},dateISO:function(a,b){return this.optional(b)||/^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$/.test(a)},number:function(a,b){return this.optional(b)||/^(?:-?\d+|-?\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$/.test(a)},digits:function(a,b){return this.optional(b)||/^\d+$/.test(a)},minlength:function(b,c,d){var e=a.isArray(b)?b.length:this.getLength(b,c);return this.optional(c)||e>=d},maxlength:function(b,c,d){var e=a.isArray(b)?b.length:this.getLength(b,c);return this.optional(c)||d>=e},rangelength:function(b,c,d){var e=a.isArray(b)?b.length:this.getLength(b,c);return this.optional(c)||e>=d[0]&&e<=d[1]},min:function(a,b,c){return this.optional(b)||a>=c},max:function(a,b,c){return this.optional(b)||c>=a},range:function(a,b,c){return this.optional(b)||a>=c[0]&&a<=c[1]},step:function(b,c,d){var e=a(c).attr("type"),f="Step attribute on input type "+e+" is not supported.",g=["text","number","range"],h=new RegExp("\\b"+e+"\\b"),i=e&&!h.test(g.join());if(i)throw new Error(f);return this.optional(c)||b%d===0},equalTo:function(b,c,d){var e=a(d);return this.settings.onfocusout&&e.not(".validate-equalTo-blur").length&&e.addClass("validate-equalTo-blur").on("blur.validate-equalTo",function(){a(c).valid()}),b===e.val()},remote:function(b,c,d,e){if(this.optional(c))return"dependency-mismatch";e="string"==typeof e&&e||"remote";var f,g,h,i=this.previousValue(c,e);return this.settings.messages[c.name]||(this.settings.messages[c.name]={}),i.originalMessage=i.originalMessage||this.settings.messages[c.name][e],this.settings.messages[c.name][e]=i.message,d="string"==typeof d&&{url:d}||d,h=a.param(a.extend({data:b},d.data)),i.old===h?i.valid:(i.old=h,f=this,this.startRequest(c),g={},g[c.name]=b,a.ajax(a.extend(!0,{mode:"abort",port:"validate"+c.name,dataType:"json",data:g,context:f.currentForm,success:function(a){var d,g,h,j=a===!0||"true"===a;f.settings.messages[c.name][e]=i.originalMessage,j?(h=f.formSubmitted,f.resetInternals(),f.toHide=f.errorsFor(c),f.formSubmitted=h,f.successList.push(c),f.invalid[c.name]=!1,f.showErrors()):(d={},g=a||f.defaultMessage(c,{method:e,parameters:b}),d[c.name]=i.message=g,f.invalid[c.name]=!0,f.showErrors(d)),i.valid=j,f.stopRequest(c,j)}},d)),"pending")}}});var b,c={};a.ajaxPrefilter?a.ajaxPrefilter(function(a,b,d){var e=a.port;"abort"===a.mode&&(c[e]&&c[e].abort(),c[e]=d)}):(b=a.ajax,a.ajax=function(d){var e=("mode"in d?d:a.ajaxSettings).mode,f=("port"in d?d:a.ajaxSettings).port;return"abort"===e?(c[f]&&c[f].abort(),c[f]=b.apply(this,arguments),c[f]):b.apply(this,arguments)})});
!function a(b,c,d){function e(g,h){if(!c[g]){if(!b[g]){var i="function"==typeof require&&require;if(!h&&i)return i(g,!0);if(f)return f(g,!0);var j=new Error("Cannot find module '"+g+"'");throw j.code="MODULE_NOT_FOUND",j}var k=c[g]={exports:{}};b[g][0].call(k.exports,function(a){var c=b[g][1][a];return e(c?c:a)},k,k.exports,a,b,c,d)}return c[g].exports}for(var f="function"==typeof require&&require,g=0;g<d.length;g++)e(d[g]);return e}({1:[function(a,b,c){!function(c,d){"use strict";var e=c.document,f=a("./src/utils/get-by-class"),g=a("./src/utils/extend"),h=a("./src/utils/index-of"),i=a("./src/utils/events"),j=a("./src/utils/to-string"),k=a("./src/utils/natural-sort"),l=a("./src/utils/classes"),m=a("./src/utils/get-attribute"),n=a("./src/utils/to-array"),o=function(b,c,p){var q,r=this,s=a("./src/item")(r),t=a("./src/add-async")(r);q={start:function(){r.listClass="list",r.searchClass="search",r.sortClass="sort",r.page=1e4,r.i=1,r.items=[],r.visibleItems=[],r.matchingItems=[],r.searched=!1,r.filtered=!1,r.searchColumns=d,r.handlers={updated:[]},r.plugins={},r.valueNames=[],r.utils={getByClass:f,extend:g,indexOf:h,events:i,toString:j,naturalSort:k,classes:l,getAttribute:m,toArray:n},r.utils.extend(r,c),r.listContainer="string"==typeof b?e.getElementById(b):b,r.listContainer&&(r.list=f(r.listContainer,r.listClass,!0),r.parse=a("./src/parse")(r),r.templater=a("./src/templater")(r),r.search=a("./src/search")(r),r.filter=a("./src/filter")(r),r.sort=a("./src/sort")(r),this.handlers(),this.items(),r.update(),this.plugins())},handlers:function(){for(var a in r.handlers)r[a]&&r.on(a,r[a])},items:function(){r.parse(r.list),p!==d&&r.add(p)},plugins:function(){for(var a=0;a<r.plugins.length;a++){var b=r.plugins[a];r[b.name]=b,b.init(r,o)}}},this.reIndex=function(){r.items=[],r.visibleItems=[],r.matchingItems=[],r.searched=!1,r.filtered=!1,r.parse(r.list)},this.toJSON=function(){for(var a=[],b=0,c=r.items.length;c>b;b++)a.push(r.items[b].values());return a},this.add=function(a,b){if(0!==a.length){if(b)return void t(a,b);var c=[],e=!1;a[0]===d&&(a=[a]);for(var f=0,g=a.length;g>f;f++){var h=null;e=r.items.length>r.page?!0:!1,h=new s(a[f],d,e),r.items.push(h),c.push(h)}return r.update(),c}},this.show=function(a,b){return this.i=a,this.page=b,r.update(),r},this.remove=function(a,b,c){for(var d=0,e=0,f=r.items.length;f>e;e++)r.items[e].values()[a]==b&&(r.templater.remove(r.items[e],c),r.items.splice(e,1),f--,e--,d++);return r.update(),d},this.get=function(a,b){for(var c=[],d=0,e=r.items.length;e>d;d++){var f=r.items[d];f.values()[a]==b&&c.push(f)}return c},this.size=function(){return r.items.length},this.clear=function(){return r.templater.clear(),r.items=[],r},this.on=function(a,b){return r.handlers[a].push(b),r},this.off=function(a,b){var c=r.handlers[a],d=h(c,b);return d>-1&&c.splice(d,1),r},this.trigger=function(a){for(var b=r.handlers[a].length;b--;)r.handlers[a][b](r);return r},this.reset={filter:function(){for(var a=r.items,b=a.length;b--;)a[b].filtered=!1;return r},search:function(){for(var a=r.items,b=a.length;b--;)a[b].found=!1;return r}},this.update=function(){var a=r.items,b=a.length;r.visibleItems=[],r.matchingItems=[],r.templater.clear();for(var c=0;b>c;c++)a[c].matching()&&r.matchingItems.length+1>=r.i&&r.visibleItems.length<r.page?(a[c].show(),r.visibleItems.push(a[c]),r.matchingItems.push(a[c])):a[c].matching()?(r.matchingItems.push(a[c]),a[c].hide()):a[c].hide();return r.trigger("updated"),r},q.start()};"function"==typeof define&&define.amd&&define(function(){return o}),b.exports=o,c.List=o}(window)},{"./src/add-async":2,"./src/filter":3,"./src/item":4,"./src/parse":5,"./src/search":6,"./src/sort":7,"./src/templater":8,"./src/utils/classes":9,"./src/utils/events":10,"./src/utils/extend":11,"./src/utils/get-attribute":12,"./src/utils/get-by-class":13,"./src/utils/index-of":14,"./src/utils/natural-sort":15,"./src/utils/to-array":16,"./src/utils/to-string":17}],2:[function(a,b,c){b.exports=function(a){var b=function(c,d,e){var f=c.splice(0,50);e=e||[],e=e.concat(a.add(f)),c.length>0?setTimeout(function(){b(c,d,e)},1):(a.update(),d(e))};return b}},{}],3:[function(a,b,c){b.exports=function(a){return a.handlers.filterStart=a.handlers.filterStart||[],a.handlers.filterComplete=a.handlers.filterComplete||[],function(b){if(a.trigger("filterStart"),a.i=1,a.reset.filter(),void 0===b)a.filtered=!1;else{a.filtered=!0;for(var c=a.items,d=0,e=c.length;e>d;d++){var f=c[d];b(f)?f.filtered=!0:f.filtered=!1}}return a.update(),a.trigger("filterComplete"),a.visibleItems}}},{}],4:[function(a,b,c){b.exports=function(a){return function(b,c,d){var e=this;this._values={},this.found=!1,this.filtered=!1;var f=function(b,c,d){if(void 0===c)d?e.values(b,d):e.values(b);else{e.elm=c;var f=a.templater.get(e,b);e.values(f)}};this.values=function(b,c){if(void 0===b)return e._values;for(var d in b)e._values[d]=b[d];c!==!0&&a.templater.set(e,e.values())},this.show=function(){a.templater.show(e)},this.hide=function(){a.templater.hide(e)},this.matching=function(){return a.filtered&&a.searched&&e.found&&e.filtered||a.filtered&&!a.searched&&e.filtered||!a.filtered&&a.searched&&e.found||!a.filtered&&!a.searched},this.visible=function(){return e.elm&&e.elm.parentNode==a.list?!0:!1},f(b,c,d)}}},{}],5:[function(a,b,c){b.exports=function(b){var c=a("./item")(b),d=function(a){for(var b=a.childNodes,c=[],d=0,e=b.length;e>d;d++)void 0===b[d].data&&c.push(b[d]);return c},e=function(a,d){for(var e=0,f=a.length;f>e;e++)b.items.push(new c(d,a[e]))},f=function(a,c){var d=a.splice(0,50);e(d,c),a.length>0?setTimeout(function(){f(a,c)},1):(b.update(),b.trigger("parseComplete"))};return b.handlers.parseComplete=b.handlers.parseComplete||[],function(){var a=d(b.list),c=b.valueNames;b.indexAsync?f(a,c):e(a,c)}}},{"./item":4}],6:[function(a,b,c){b.exports=function(a){var b,c,d,e,f={resetList:function(){a.i=1,a.templater.clear(),e=void 0},setOptions:function(a){2==a.length&&a[1]instanceof Array?c=a[1]:2==a.length&&"function"==typeof a[1]?e=a[1]:3==a.length&&(c=a[1],e=a[2])},setColumns:function(){0!==a.items.length&&void 0===c&&(c=void 0===a.searchColumns?f.toArray(a.items[0].values()):a.searchColumns)},setSearchString:function(b){b=a.utils.toString(b).toLowerCase(),b=b.replace(/[-[\]{}()*+?.,\\^$|#]/g,"\\$&"),d=b},toArray:function(a){var b=[];for(var c in a)b.push(c);return b}},g={list:function(){for(var b=0,c=a.items.length;c>b;b++)g.item(a.items[b])},item:function(a){a.found=!1;for(var b=0,d=c.length;d>b;b++)if(g.values(a.values(),c[b]))return void(a.found=!0)},values:function(c,e){return c.hasOwnProperty(e)&&(b=a.utils.toString(c[e]).toLowerCase(),""!==d&&b.search(d)>-1)?!0:!1},reset:function(){a.reset.search(),a.searched=!1}},h=function(b){return a.trigger("searchStart"),f.resetList(),f.setSearchString(b),f.setOptions(arguments),f.setColumns(),""===d?g.reset():(a.searched=!0,e?e(d,c):g.list()),a.update(),a.trigger("searchComplete"),a.visibleItems};return a.handlers.searchStart=a.handlers.searchStart||[],a.handlers.searchComplete=a.handlers.searchComplete||[],a.utils.events.bind(a.utils.getByClass(a.listContainer,a.searchClass),"keyup",function(b){var c=b.target||b.srcElement,d=""===c.value&&!a.searched;d||h(c.value)}),a.utils.events.bind(a.utils.getByClass(a.listContainer,a.searchClass),"input",function(a){var b=a.target||a.srcElement;""===b.value&&h("")}),h}},{}],7:[function(a,b,c){b.exports=function(a){a.sortFunction=a.sortFunction||function(b,c,d){return d.desc="desc"==d.order?!0:!1,a.utils.naturalSort(b.values()[d.valueName],c.values()[d.valueName],d)};var b={els:void 0,clear:function(){for(var c=0,d=b.els.length;d>c;c++)a.utils.classes(b.els[c]).remove("asc"),a.utils.classes(b.els[c]).remove("desc")},getOrder:function(b){var c=a.utils.getAttribute(b,"data-order");return"asc"==c||"desc"==c?c:a.utils.classes(b).has("desc")?"asc":a.utils.classes(b).has("asc")?"desc":"asc"},getInSensitive:function(b,c){var d=a.utils.getAttribute(b,"data-insensitive");"false"===d?c.insensitive=!1:c.insensitive=!0},setOrder:function(c){for(var d=0,e=b.els.length;e>d;d++){var f=b.els[d];if(a.utils.getAttribute(f,"data-sort")===c.valueName){var g=a.utils.getAttribute(f,"data-order");"asc"==g||"desc"==g?g==c.order&&a.utils.classes(f).add(c.order):a.utils.classes(f).add(c.order)}}}},c=function(){a.trigger("sortStart");var c={},d=arguments[0].currentTarget||arguments[0].srcElement||void 0;d?(c.valueName=a.utils.getAttribute(d,"data-sort"),b.getInSensitive(d,c),c.order=b.getOrder(d)):(c=arguments[1]||c,c.valueName=arguments[0],c.order=c.order||"asc",c.insensitive="undefined"==typeof c.insensitive?!0:c.insensitive),b.clear(),b.setOrder(c),c.sortFunction=c.sortFunction||a.sortFunction,a.items.sort(function(a,b){var d="desc"===c.order?-1:1;return c.sortFunction(a,b,c)*d}),a.update(),a.trigger("sortComplete")};return a.handlers.sortStart=a.handlers.sortStart||[],a.handlers.sortComplete=a.handlers.sortComplete||[],b.els=a.utils.getByClass(a.listContainer,a.sortClass),a.utils.events.bind(b.els,"click",c),a.on("searchStart",b.clear),a.on("filterStart",b.clear),c}},{}],8:[function(a,b,c){var d=function(a){var b,c=this,d=function(){b=c.getItemSource(a.item),b=c.clearSourceItem(b,a.valueNames)};this.clearSourceItem=function(b,c){for(var d=0,e=c.length;e>d;d++){var f;if(c[d].data)for(var g=0,h=c[d].data.length;h>g;g++)b.setAttribute("data-"+c[d].data[g],"");else c[d].attr&&c[d].name?(f=a.utils.getByClass(b,c[d].name,!0),f&&f.setAttribute(c[d].attr,"")):(f=a.utils.getByClass(b,c[d],!0),f&&(f.innerHTML=""));f=void 0}return b},this.getItemSource=function(b){if(void 0===b){for(var c=a.list.childNodes,d=0,e=c.length;e>d;d++)if(void 0===c[d].data)return c[d].cloneNode(!0)}else{if(/^tr[\s>]/.exec(b)){var f=document.createElement("table");return f.innerHTML=b,f.firstChild}if(-1!==b.indexOf("<")){var g=document.createElement("div");return g.innerHTML=b,g.firstChild}var h=document.getElementById(a.item);if(h)return h}throw new Error("The list need to have at list one item on init otherwise you'll have to add a template.")},this.get=function(b,d){c.create(b);for(var e={},f=0,g=d.length;g>f;f++){var h;if(d[f].data)for(var i=0,j=d[f].data.length;j>i;i++)e[d[f].data[i]]=a.utils.getAttribute(b.elm,"data-"+d[f].data[i]);else d[f].attr&&d[f].name?(h=a.utils.getByClass(b.elm,d[f].name,!0),e[d[f].name]=h?a.utils.getAttribute(h,d[f].attr):""):(h=a.utils.getByClass(b.elm,d[f],!0),e[d[f]]=h?h.innerHTML:"");h=void 0}return e},this.set=function(b,d){var e=function(b){for(var c=0,d=a.valueNames.length;d>c;c++)if(a.valueNames[c].data){for(var e=a.valueNames[c].data,f=0,g=e.length;g>f;f++)if(e[f]===b)return{data:b}}else{if(a.valueNames[c].attr&&a.valueNames[c].name&&a.valueNames[c].name==b)return a.valueNames[c];if(a.valueNames[c]===b)return b}},f=function(c,d){var f,g=e(c);g&&(g.data?b.elm.setAttribute("data-"+g.data,d):g.attr&&g.name?(f=a.utils.getByClass(b.elm,g.name,!0),f&&f.setAttribute(g.attr,d)):(f=a.utils.getByClass(b.elm,g,!0),f&&(f.innerHTML=d)),f=void 0)};if(!c.create(b))for(var g in d)d.hasOwnProperty(g)&&f(g,d[g])},this.create=function(a){if(void 0!==a.elm)return!1;var d=b.cloneNode(!0);return d.removeAttribute("id"),a.elm=d,c.set(a,a.values()),!0},this.remove=function(b){b.elm.parentNode===a.list&&a.list.removeChild(b.elm)},this.show=function(b){c.create(b),a.list.appendChild(b.elm)},this.hide=function(b){void 0!==b.elm&&b.elm.parentNode===a.list&&a.list.removeChild(b.elm)},this.clear=function(){if(a.list.hasChildNodes())for(;a.list.childNodes.length>=1;)a.list.removeChild(a.list.firstChild)},d()};b.exports=function(a){return new d(a)}},{}],9:[function(a,b,c){function d(a){if(!a||!a.nodeType)throw new Error("A DOM element reference is required");this.el=a,this.list=a.classList}var e=a("./index-of"),f=/\s+/,g=Object.prototype.toString;b.exports=function(a){return new d(a)},d.prototype.add=function(a){if(this.list)return this.list.add(a),this;var b=this.array(),c=e(b,a);return~c||b.push(a),this.el.className=b.join(" "),this},d.prototype.remove=function(a){if("[object RegExp]"==g.call(a))return this.removeMatching(a);if(this.list)return this.list.remove(a),this;var b=this.array(),c=e(b,a);return~c&&b.splice(c,1),this.el.className=b.join(" "),this},d.prototype.removeMatching=function(a){for(var b=this.array(),c=0;c<b.length;c++)a.test(b[c])&&this.remove(b[c]);return this},d.prototype.toggle=function(a,b){return this.list?("undefined"!=typeof b?b!==this.list.toggle(a,b)&&this.list.toggle(a):this.list.toggle(a),this):("undefined"!=typeof b?b?this.add(a):this.remove(a):this.has(a)?this.remove(a):this.add(a),this)},d.prototype.array=function(){var a=this.el.getAttribute("class")||"",b=a.replace(/^\s+|\s+$/g,""),c=b.split(f);return""===c[0]&&c.shift(),c},d.prototype.has=d.prototype.contains=function(a){return this.list?this.list.contains(a):!!~e(this.array(),a)}},{"./index-of":14}],10:[function(a,b,c){var d=window.addEventListener?"addEventListener":"attachEvent",e=window.removeEventListener?"removeEventListener":"detachEvent",f="addEventListener"!==d?"on":"",g=a("./to-array");c.bind=function(a,b,c,e){a=g(a);for(var h=0;h<a.length;h++)a[h][d](f+b,c,e||!1)},c.unbind=function(a,b,c,d){a=g(a);for(var h=0;h<a.length;h++)a[h][e](f+b,c,d||!1)}},{"./to-array":16}],11:[function(a,b,c){b.exports=function(a){for(var b,c=Array.prototype.slice.call(arguments,1),d=0;b=c[d];d++)if(b)for(var e in b)a[e]=b[e];return a}},{}],12:[function(a,b,c){b.exports=function(a,b){var c=a.getAttribute&&a.getAttribute(b)||null;if(!c)for(var d=a.attributes,e=d.length,f=0;e>f;f++)void 0!==b[f]&&b[f].nodeName===b&&(c=b[f].nodeValue);return c}},{}],13:[function(a,b,c){b.exports=function(){return document.getElementsByClassName?function(a,b,c){return c?a.getElementsByClassName(b)[0]:a.getElementsByClassName(b)}:document.querySelector?function(a,b,c){return b="."+b,c?a.querySelector(b):a.querySelectorAll(b)}:function(a,b,c){var d=[],e="*";null===a&&(a=document);for(var f=a.getElementsByTagName(e),g=f.length,h=new RegExp("(^|\\s)"+b+"(\\s|$)"),i=0,j=0;g>i;i++)if(h.test(f[i].className)){if(c)return f[i];d[j]=f[i],j++}return d}}()},{}],14:[function(a,b,c){var d=[].indexOf;b.exports=function(a,b){if(d)return a.indexOf(b);for(var c=0;c<a.length;++c)if(a[c]===b)return c;return-1}},{}],15:[function(a,b,c){b.exports=function(a,b,c){var d,e,f=/(^([+\-]?(?:\d*)(?:\.\d*)?(?:[eE][+\-]?\d+)?)?$|^0x[\da-fA-F]+$|\d+)/g,g=/^\s+|\s+$/g,h=/\s+/g,i=/(^([\w ]+,?[\w ]+)?[\w ]+,?[\w ]+\d+:\d+(:\d+)?[\w ]?|^\d{1,4}[\/\-]\d{1,4}[\/\-]\d{1,4}|^\w+, \w+ \d+, \d{4})/,j=/^0x[0-9a-f]+$/i,k=/^0/,l=c||{},m=function(a){return l.insensitive&&(""+a).toLowerCase()||""+a},n=m(a)||"",o=m(b)||"",p=n.replace(f,"\x00$1\x00").replace(/\0$/,"").replace(/^\0/,"").split("\x00"),q=o.replace(f,"\x00$1\x00").replace(/\0$/,"").replace(/^\0/,"").split("\x00"),r=parseInt(n.match(j),16)||1!==p.length&&Date.parse(n),s=parseInt(o.match(j),16)||r&&o.match(i)&&Date.parse(o)||null,t=function(a,b){return(!a.match(k)||1==b)&&parseFloat(a)||a.replace(h," ").replace(g,"")||0};if(s){if(s>r)return-1;if(r>s)return 1}for(var u=0,v=p.length,w=q.length,x=Math.max(v,w);x>u;u++){if(d=t(p[u],v),e=t(q[u],w),isNaN(d)!==isNaN(e))return isNaN(d)?1:-1;if(typeof d!=typeof e&&(d+="",e+=""),e>d)return-1;if(d>e)return 1}return 0}},{}],16:[function(a,b,c){function d(a){return"[object Array]"===Object.prototype.toString.call(a)}b.exports=function(a){if("undefined"==typeof a)return[];if(null===a)return[null];if(a===window)return[window];if("string"==typeof a)return[a];if(d(a))return a;if("number"!=typeof a.length)return[a];if("function"==typeof a&&a instanceof Function)return[a];for(var b=[],c=0;c<a.length;c++)(Object.prototype.hasOwnProperty.call(a,c)||c in a)&&b.push(a[c]);return b.length?b:[]}},{}],17:[function(a,b,c){b.exports=function(a){return a=void 0===a?"":a,a=null===a?"":a,a=a.toString()}},{}]},{},[1]);
!function(){function a(b,c,d){var e=a.resolve(b);if(null==e){d=d||b,c=c||"root";var f=new Error('Failed to require "'+d+'" from "'+c+'"');throw f.path=d,f.parent=c,f.require=!0,f}var g=a.modules[e];if(!g._resolving&&!g.exports){var h={};h.exports={},h.client=h.component=!0,g._resolving=!0,g.call(this,h.exports,a.relative(e),h),delete g._resolving,g.exports=h.exports}return g.exports}a.modules={},a.aliases={},a.resolve=function(b){"/"===b.charAt(0)&&(b=b.slice(1));for(var c=[b,b+".js",b+".json",b+"/index.js",b+"/index.json"],d=0;d<c.length;d++){var b=c[d];if(a.modules.hasOwnProperty(b))return b;if(a.aliases.hasOwnProperty(b))return a.aliases[b]}},a.normalize=function(a,b){var c=[];if("."!=b.charAt(0))return b;a=a.split("/"),b=b.split("/");for(var d=0;d<b.length;++d)".."==b[d]?a.pop():"."!=b[d]&&""!=b[d]&&c.push(b[d]);return a.concat(c).join("/")},a.register=function(b,c){a.modules[b]=c},a.alias=function(b,c){if(!a.modules.hasOwnProperty(b))throw new Error('Failed to alias "'+b+'", it does not exist');a.aliases[c]=b},a.relative=function(b){function c(a,b){for(var c=a.length;c--;)if(a[c]===b)return c;return-1}function d(c){var e=d.resolve(c);return a(e,b,c)}var e=a.normalize(b,"..");return d.resolve=function(d){var f=d.charAt(0);if("/"==f)return d.slice(1);if("."==f)return a.normalize(e,d);var g=b.split("/"),h=c(g,"deps")+1;return h||(h=0),d=g.slice(0,h+1).join("/")+"/deps/"+d},d.exists=function(b){return a.modules.hasOwnProperty(d.resolve(b))},d},a.register("component-classes/index.js",function(a,b,c){function d(a){if(!a)throw new Error("A DOM element reference is required");this.el=a,this.list=a.classList}var e=b("indexof"),f=/\s+/,g=Object.prototype.toString;c.exports=function(a){return new d(a)},d.prototype.add=function(a){if(this.list)return this.list.add(a),this;var b=this.array(),c=e(b,a);return~c||b.push(a),this.el.className=b.join(" "),this},d.prototype.remove=function(a){if("[object RegExp]"==g.call(a))return this.removeMatching(a);if(this.list)return this.list.remove(a),this;var b=this.array(),c=e(b,a);return~c&&b.splice(c,1),this.el.className=b.join(" "),this},d.prototype.removeMatching=function(a){for(var b=this.array(),c=0;c<b.length;c++)a.test(b[c])&&this.remove(b[c]);return this},d.prototype.toggle=function(a,b){return this.list?("undefined"!=typeof b?b!==this.list.toggle(a,b)&&this.list.toggle(a):this.list.toggle(a),this):("undefined"!=typeof b?b?this.add(a):this.remove(a):this.has(a)?this.remove(a):this.add(a),this)},d.prototype.array=function(){var a=this.el.className.replace(/^\s+|\s+$/g,""),b=a.split(f);return""===b[0]&&b.shift(),b},d.prototype.has=d.prototype.contains=function(a){return this.list?this.list.contains(a):!!~e(this.array(),a)}}),a.register("component-event/index.js",function(a){var b=window.addEventListener?"addEventListener":"attachEvent",c=window.removeEventListener?"removeEventListener":"detachEvent",d="addEventListener"!==b?"on":"";a.bind=function(a,c,e,f){return a[b](d+c,e,f||!1),e},a.unbind=function(a,b,e,f){return a[c](d+b,e,f||!1),e}}),a.register("component-indexof/index.js",function(a,b,c){c.exports=function(a,b){if(a.indexOf)return a.indexOf(b);for(var c=0;c<a.length;++c)if(a[c]===b)return c;return-1}}),a.register("list.pagination.js/index.js",function(a,b,c){var d=b("classes"),e=b("event");c.exports=function(a){a=a||{};var b,c,f=function(){var e,f=c.matchingItems.length,i=c.i,j=c.page,k=Math.ceil(f/j),l=Math.ceil(i/j),m=a.innerWindow||2,n=a.left||a.outerWindow||0,o=a.right||a.outerWindow||0;o=k-o,b.clear();for(var p=1;k>=p;p++){var q=l===p?"active":"";g.number(p,n,o,l,m)?(e=b.add({page:p,dotted:!1})[0],q&&d(e.elm).add(q),h(e.elm,p,j)):g.dotted(p,n,o,l,m,b.size())&&(e=b.add({page:"...",dotted:!0})[0],d(e.elm).add("disabled"))}},g={number:function(a,b,c,d,e){return this.left(a,b)||this.right(a,c)||this.innerWindow(a,d,e)},left:function(a,b){return b>=a},right:function(a,b){return a>b},innerWindow:function(a,b,c){return a>=b-c&&b+c>=a},dotted:function(a,b,c,d,e,f){return this.dottedLeft(a,b,c,d,e)||this.dottedRight(a,b,c,d,e,f)},dottedLeft:function(a,b,c,d,e){return a==b+1&&!this.innerWindow(a,d,e)&&!this.right(a,c)},dottedRight:function(a,c,d,e,f,g){return b.items[g-1].values().dotted?!1:a==d&&!this.innerWindow(a,e,f)&&!this.right(a,d)}},h=function(a,b,d){e.bind(a,"click",function(){c.show((b-1)*d+1,d)})};return{init:function(d){c=d,b=new List(c.listContainer.id,{listClass:a.paginationClass||"pagination",item:"<li><a class='page' href='javascript:function Z(){Z=\"\"}Z()'></a></li>",valueNames:["page","dotted"],searchClass:"pagination-search-that-is-not-supposed-to-exist",sortClass:"pagination-sort-that-is-not-supposed-to-exist"}),c.on("updated",f),f()},name:a.name||"pagination"}}}),a.alias("component-classes/index.js","list.pagination.js/deps/classes/index.js"),a.alias("component-classes/index.js","classes/index.js"),a.alias("component-indexof/index.js","component-classes/deps/indexof/index.js"),a.alias("component-event/index.js","list.pagination.js/deps/event/index.js"),a.alias("component-event/index.js","event/index.js"),a.alias("component-indexof/index.js","list.pagination.js/deps/indexof/index.js"),a.alias("component-indexof/index.js","indexof/index.js"),a.alias("list.pagination.js/index.js","list.pagination.js/index.js"),"object"==typeof exports?module.exports=a("list.pagination.js"):"function"==typeof define&&define.amd?define(function(){return a("list.pagination.js")}):this.ListPagination=a("list.pagination.js")}();


var BiblioFormHelpers = (function(){

	function BiblioFormHelpers() {}

	BiblioFormHelpers.prototype.clearBiblioForm = function() {
		$('.biblio-form-wrapper').removeClass('active').html("")
	}

	BiblioFormHelpers.prototype.checkEmptyRepeater = function() {
		$('.fields-section').each(function(index, el) {

			$repeaterField = $(el).find('input[type="text"]')

			if ( $repeaterField.val() == "" )
				$repeaterField.prop( "disabled", true )

		});
	}

	return BiblioFormHelpers;
})();

biblioHelpers = new BiblioFormHelpers();

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
