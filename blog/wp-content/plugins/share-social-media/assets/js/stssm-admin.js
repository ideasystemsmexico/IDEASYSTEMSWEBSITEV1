(function($) {
	'use strict';
	$(document).ready(function() {

		$(document).on('click', '.st-alert-box-dismiss', function() {
			$(this).parent().fadeOut(300, function() {
				$(this).remove();
			});
		});

		var loadingContainer = $('<span/>', {
			'class': 'st-loading-container'
		});
		var loadingImage = $('<img/>', {
			'src': stssmadminurl + 'images/spinner.gif',
			'class': 'st-loading-image'
		});

		function stssmBeforeSubmit(formBtn) {
			$('.st-text-danger').remove();
			$('.st-is-invalid').removeClass("st-is-invalid");
			$('.st-alert-box').remove();
			formBtn.prop('disabled', true);
			loadingContainer.insertAfter(formBtn);
			loadingImage.appendTo(loadingContainer);
			return true;
		}

		function stssmSuccessMessage(message, formId) {
			var alertBox = '' +
			'<div class="st-alert-box notice notice-success is-dismissible">' +
				'<p>' +
					'<strong>' + message + '</strong>' +
				'</p>' +
				'<button type="button" class="st-alert-box-dismiss notice-dismiss"></button>' +
			'</div>';
			$(alertBox).insertBefore(formId);
		}

		function stssmErrorMessage(message, formId, statusText = '') {
			if(statusText) {
				var statusText = ' ' + statusText;
			}
			var errorSpan = '' +
			'<div class="st-alert-box notice notice-error is-dismissible">' +
				'<p>' +
					'<strong>' + message + '</strong>' + statusText +
				'</p>' +
				'<button type="button" class="st-alert-box-dismiss notice-dismiss"></button>' +
			'</div>';
			$(errorSpan).insertBefore(formId);
		}

		function stssmFormErrors(formId, response) {
			$(formId + ' :input').each(function() {
				var input = this;
				$(input).removeClass('st-is-invalid');
				if(response.data[input.name]) {
					var errorSpan = '<div class="st-text-danger">' + response.data[input.name] + '</div>';
					$(input).addClass('st-is-invalid');
					$(errorSpan).insertAfter(input);
				}
			});
		}

		// Save social share icons.
		var saveSocialShareIconsFormId = '#stssm-save-social-share-icons-form';
		var saveSocialShareIconsForm = $(saveSocialShareIconsFormId);
		var saveSocialShareIconsBtn = $('#stssm-save-social-share-icons-btn');
		saveSocialShareIconsForm.ajaxForm({
			beforeSubmit: function(arr, $form, options) {
				return stssmBeforeSubmit(saveSocialShareIconsBtn);
			},
			success: function(response) {
				if(response.success) {
					stssmSuccessMessage(response.data.message, saveSocialShareIconsFormId);
				} else {
					if(response.data && $.isPlainObject(response.data)) {
						stssmFormErrors(saveSocialShareIconsFormId, response);
					} else {
						stssmErrorMessage(response.data, saveSocialShareIconsFormId);
					}
				}
			},
			error: function(response) {
				saveSocialShareIconsBtn.prop('disabled', false);
				stssmErrorMessage(response.status, saveSocialShareIconsFormId, response.statusText);
			},
			complete: function(event, xhr, settings) {
				saveSocialShareIconsBtn.prop('disabled', false);
				loadingContainer.remove();
			}
		});

		// Save social share icons design.
		var saveIconsDesignFormId = '#stssm-save-icons-design-form';
		var saveIconsDesignForm = $(saveIconsDesignFormId);
		var saveIconsDesignBtn = $('#stssm-save-icons-design-btn');
		saveIconsDesignForm.ajaxForm({
			beforeSubmit: function(arr, $form, options) {
				return stssmBeforeSubmit(saveIconsDesignBtn);
			},
			success: function(response) {
				if(response.success) {
					stssmSuccessMessage(response.data.message, saveIconsDesignFormId);
				} else {
					if(response.data && $.isPlainObject(response.data)) {
						stssmFormErrors(saveIconsDesignFormId, response);
					} else {
						stssmErrorMessage(response.data, saveIconsDesignFormId);
					}
				}
			},
			error: function(response) {
				saveIconsDesignBtn.prop('disabled', false);
				stssmErrorMessage(response.status, saveIconsDesignFormId, response.statusText);
			},
			complete: function(event, xhr, settings) {
				saveIconsDesignBtn.prop('disabled', false);
				loadingContainer.remove();
			}
		});

		// Reset plugin.
		var resetPluginFormId = '#stssm-reset-plugin-form';
		var resetPluginForm = $(resetPluginFormId);
		var resetPluginBtn = $('#stssm-reset-plugin-btn');
		$(document).on('click', '#stssm-reset-plugin-btn', function(e) {
			e.preventDefault();
			if(confirm(resetPluginBtn.data('message'))) {
				resetPluginForm.ajaxSubmit({
					beforeSubmit: function(arr, $form, options) {
						return stssmBeforeSubmit(resetPluginBtn);
					},
					success: function(response) {
						if(response.success) {
							stssmSuccessMessage(response.data.message, resetPluginFormId);
						} else {
							if(response.data && $.isPlainObject(response.data)) {
								stssmFormErrors(resetPluginFormId, response);
							} else {
								stssmErrorMessage(response.data, resetPluginFormId);
							}
						}
					},
					error: function(response) {
						resetPluginBtn.prop('disabled', false);
						stssmErrorMessage(response.status, resetPluginFormId, response.statusText);
					},
					complete: function(event, xhr, settings) {
						resetPluginBtn.prop('disabled', false);
						loadingContainer.remove();
					}
				});
			}
		});

	});
})(jQuery);
