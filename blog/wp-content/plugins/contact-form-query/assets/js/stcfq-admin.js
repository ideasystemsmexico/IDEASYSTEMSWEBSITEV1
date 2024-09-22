(function($) {
	'use strict';
	$(document).ready(function() {

		// Initialize color picker.
		$('.color-picker').wpColorPicker();

		$(document).on('click', '#stcfq-copy-contact-form-shortcode', function () {
			var message = $(this).data('message');
			var value = $('#stcfq-contact-form-shortcode').text();
			var temp = $('<input>');
			$('body').append(temp);
			temp.val(value).select();
			document.execCommand('copy');
			temp.remove();
			window.alert(message);
		});

		$(document).on('click', '.stcfq-filter-add-item', function() {
			$('.stcfq-filter-item').first().clone().find('input').val('').end().find('select').val('subject').end().appendTo('.stcfq-filter-items');
		});

		$(document).on('click', '.stcfq-filter-remove-item', function() {
			var searchItemsLength = $('.stcfq-filter-items .stcfq-filter-item').length;
			if(searchItemsLength > 1) {
				$(this).parent().remove();
			}
		});

		$(document).on('click', '.stcfq-reset-filter', function() {
			var appplyFilterForm = $('#stcfq-apply-filter-form');
			appplyFilterForm.find('input[name="apply-filter"]').remove();
			appplyFilterForm.submit();
		});

		var googleRecaptchaV2 = $('.stcfq_google_recaptcha_v2');
		var cfTurnstile = $('.stcfq_cf_turnstile');
		var captcha = $('.stcfq input[name="captcha"]:checked').val();
		if('google_recaptcha_v2' === captcha) {
			googleRecaptchaV2.show();
		} else if('cf_turnstile' === captcha) {
			cfTurnstile.show();
		}

		$(document).on('change', '.stcfq input[name="captcha"]', function() {
			var captcha = this.value;
			var stcfqCaptcha = $('.stcfq_captcha');
			stcfqCaptcha.hide();
			if('google_recaptcha_v2' === captcha) {
				googleRecaptchaV2.fadeIn();
			} else if('cf_turnstile' === captcha) {
				cfTurnstile.fadeIn();
			}
		});

		var wpMail = $('.stcfq_wp_mail');
		var smtp = $('.stcfq_smtp');
		var emailCarrier = $('.stcfq input[name="email_carrier"]:checked').val();
		if('wp_mail' === emailCarrier) {
			wpMail.show();
		} else if('smtp' === emailCarrier) {
			smtp.show();
		}

		$(document).on('change', '.stcfq input[name="email_carrier"]', function() {
			var emailCarrier = this.value;
			var stcfqEmail = $('.stcfq_email');
			stcfqEmail.hide();
			if('wp_mail' === emailCarrier) {
				wpMail.fadeIn();
			} else if('smtp' === emailCarrier) {
				smtp.fadeIn();
			}
		});

		$('.stcfq-accordion').each(function() {
			$(this).on('click', function(event) {
				event.preventDefault();
				this.classList.toggle('stcfq-accordion-active');
				var panel = this.nextElementSibling;
				if (panel.style.maxHeight){
					panel.style.maxHeight = null;
				} else {
					panel.style.maxHeight = panel.scrollHeight + "px";
				}
			});
		});

		try {
			$('#stcfq-form-field-settings').sortable({
				placeholder: '',
				revert: true
			});
		} catch(e) {}

		$(document).on('click', '.st-alert-box-dismiss', function() {
			$(this).parent().fadeOut(200, function() {
				$(this).remove();
			});
		});

		var loadingContainer = $('<span/>', {
			'class': 'st-loading-container'
		});
		var loadingImage = $('<img/>', {
			'src': stcfqadminurl + 'images/spinner.gif',
			'class': 'st-loading-image'
		});

		function stcfqBeforeSubmit(formBtn) {
			$('.st-text-danger').remove();
			$('.st-is-invalid').removeClass("st-is-invalid");
			$('.st-alert-box').remove();
			formBtn.prop('disabled', true);
			loadingContainer.insertAfter(formBtn);
			loadingImage.appendTo(loadingContainer);
			return true;
		}

		function stcfqSuccessMessage(message, formId) {
			var alertBox = '' +
			'<div class="st-alert-box notice notice-success is-dismissible">' +
				'<p>' +
					'<strong>' + message + '</strong>' +
				'</p>' +
				'<button type="button" class="st-alert-box-dismiss notice-dismiss"></button>' +
			'</div>';
			$(alertBox).insertBefore(formId);
		}

		function stcfqErrorMessage(message, formId, statusText = '', focus = false) {
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
			if(focus) {
				$(errorSpan).insertBefore(formId).focus();
			} else {
				$(errorSpan).insertBefore(formId);
			}
		}

		function stcfqFormErrors(formId, response) {
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

		// Delete message.
		$(document).on('click', '.stcfq-delete-message', function(event) {
			event.preventDefault();
			var button = this;
			var header = '.stcfq-table';
			var messageId = $(this).data('message');
			var nonce = $(this).data('nonce');
			var confirmMessage = $(this).data('message-confirm');

			if(confirm(confirmMessage)) {
				$.ajax({
					data: 'id=' + messageId + '&' + 'delete-message-' + messageId + '=' + nonce + '&action=stcfq-delete-message',
					url: ajaxurl,
					type: 'POST',
					beforeSend: function(xhr) {
						$('.st-alert-box').remove();
					},
					success: function(response) {
						if(response.success) {
							stcfqSuccessMessage(response.data.message, header);
							$(button).parent().parent().remove();
							$('#wp-admin-bar-stcfq-messages-count').load(location.href + " " + '#wp-admin-bar-stcfq-messages-count .ab-item', function () {});
						} else {
							stcfqErrorMessage(response.data, header, '', true);
						}
					},
					error: function(response) {
						stcfqErrorMessage(response.status, header, response.statusText, true);
					}
				});
			}
		});

		// Bulk messages selection.
		$(document).on('change', '#stcfq-select-all', function() {
			if($(this).is(':checked')) {
				$('.stcfq-select-single').prop('checked', true);
			} else {
				$('.stcfq-select-single').prop('checked', false);
			}
		});

		// Bulk action.
		$(document).on('click', '.stcfq-bulk-apply', function(event) {
			event.preventDefault();
			var header = '.stcfq-table';
			var bulkSelect = $('.stcfq-bulk-select');
			var bulkAction = bulkSelect.val();
			var nonce = $(this).data('nonce');
			if('' !== bulkAction) {
				var rowsChecked = $(".stcfq-select-single:checked");
				var selectedOption = bulkSelect.find(':selected');
				var confirmMessage = selectedOption.data('message-confirm');
				if(rowsChecked && rowsChecked.length) {
					var ids = rowsChecked.map(function() {
						return $(this).val();
					}).get();
					var confirmMessage = selectedOption.data('message-confirm');
					if(confirm(confirmMessage)) {
						$.ajax({
							data: {
								'action': 'stcfq-bulk-action',
								'bulk_action': bulkAction,
								'ids': JSON.stringify(ids),
								'bulk-action': nonce
							},
							url: ajaxurl,
							type: 'POST',
							beforeSend: function(xhr) {
								$('.st-alert-box').remove();
							},
							success: function(response) {
								if(response.success) {
									stcfqSuccessMessage(response.data.message, header);
									$('#wp-admin-bar-stcfq-messages-count').load(location.href + " " + '#wp-admin-bar-stcfq-messages-count .ab-item', function () {
										window.location.reload();
									});
								} else {
									stcfqErrorMessage(response.data, header, '', true);
								}
							},
							error: function(response) {
								stcfqErrorMessage(response.status, header, response.statusText, true);
							}
						});
					}
				} else {
					alert(selectedOption.data('message-select'));
				}
			} else {
				alert($(this).data('action-select'));
			}
		});

		// Save note.
		var saveNoteFormId = '#stcfq-save-note-form';
		var saveNoteForm = $(saveNoteFormId);
		var saveNoteBtn = $('#stcfq-save-note-btn');
		saveNoteForm.ajaxForm({
			beforeSubmit: function(arr, $form, options) {
				return stcfqBeforeSubmit(saveNoteBtn);
			},
			success: function(response) {
				if(response.success) {
					stcfqSuccessMessage(response.data.message, saveNoteFormId);
					$('#wp-admin-bar-stcfq-messages-count').load(location.href + " " + '#wp-admin-bar-stcfq-messages-count .ab-item', function () {});
				} else {
					if(response.data && $.isPlainObject(response.data)) {
						stcfqFormErrors(saveNoteFormId, response);
					} else {
						stcfqErrorMessage(response.data, saveNoteFormId);
					}
				}
			},
			error: function(response) {
				stcfqErrorMessage(response.status, saveNoteFormId, response.statusText);
			},
			complete: function(event, xhr, settings) {
				saveNoteBtn.prop('disabled', false);
				loadingContainer.remove();
			}
		});

		// Save form fields.
		var saveFormFieldsFormId = '#stcfq-save-form-fields-form';
		var saveFormFieldsForm = $(saveFormFieldsFormId);
		var saveFormFieldsBtn = $('#stcfq-save-form-fields-btn');
		saveFormFieldsForm.ajaxForm({
			beforeSubmit: function(arr, $form, options) {
				return stcfqBeforeSubmit(saveFormFieldsBtn);
			},
			success: function(response) {
				if(response.success) {
					stcfqSuccessMessage(response.data.message, saveFormFieldsFormId);
				} else {
					if(response.data && $.isPlainObject(response.data)) {
						stcfqFormErrors(saveFormFieldsFormId, response);
					} else {
						stcfqErrorMessage(response.data, saveFormFieldsFormId);
					}
				}
			},
			error: function(response) {
				stcfqErrorMessage(response.status, saveFormFieldsFormId, response.statusText);
			},
			complete: function(event, xhr, settings) {
				saveFormFieldsBtn.prop('disabled', false);
				loadingContainer.remove();
			}
		});

		// Save layout.
		var saveLayoutFormId = '#stcfq-save-layout-form';
		var saveLayoutForm = $(saveLayoutFormId);
		var saveLayoutBtn = $('#stcfq-save-layout-btn');
		saveLayoutForm.ajaxForm({
			beforeSubmit: function(arr, $form, options) {
				return stcfqBeforeSubmit(saveLayoutBtn);
			},
			success: function(response) {
				if(response.success) {
					stcfqSuccessMessage(response.data.message, saveLayoutFormId);
				} else {
					if(response.data && $.isPlainObject(response.data)) {
						stcfqFormErrors(saveLayoutFormId, response);
					} else {
						stcfqErrorMessage(response.data, saveLayoutFormId);
					}
				}
			},
			error: function(response) {
				stcfqErrorMessage(response.status, saveLayoutFormId, response.statusText);
			},
			complete: function(event, xhr, settings) {
				saveLayoutBtn.prop('disabled', false);
				loadingContainer.remove();
			}
		});

		// Save captcha.
		var saveCaptchaFormId = '#stcfq-save-captcha-form';
		var saveCaptchaForm = $(saveCaptchaFormId);
		var saveCaptchaBtn = $('#stcfq-save-captcha-btn');
		saveCaptchaForm.ajaxForm({
			beforeSubmit: function(arr, $form, options) {
				return stcfqBeforeSubmit(saveCaptchaBtn);
			},
			success: function(response) {
				if(response.success) {
					stcfqSuccessMessage(response.data.message, saveCaptchaFormId);
				} else {
					if(response.data && $.isPlainObject(response.data)) {
						stcfqFormErrors(saveCaptchaFormId, response);
					} else {
						stcfqErrorMessage(response.data, saveCaptchaFormId);
					}
				}
			},
			error: function(response) {
				stcfqErrorMessage(response.status, saveCaptchaFormId, response.statusText);
			},
			complete: function(event, xhr, settings) {
				saveCaptchaBtn.prop('disabled', false);
				loadingContainer.remove();
			}
		});

		// Save email.
		var saveEmailFormId = '#stcfq-save-email-form';
		var saveEmailForm = $(saveEmailFormId);
		var saveEmailBtn = $('#stcfq-save-email-btn');
		saveEmailForm.ajaxForm({
			beforeSubmit: function(arr, $form, options) {
				return stcfqBeforeSubmit(saveEmailBtn);
			},
			success: function(response) {
				if(response.success) {
					stcfqSuccessMessage(response.data.message, saveEmailFormId);
				} else {
					if(response.data && $.isPlainObject(response.data)) {
						stcfqFormErrors(saveEmailFormId, response);
					} else {
						stcfqErrorMessage(response.data, saveEmailFormId);
					}
				}
			},
			error: function(response) {
				stcfqErrorMessage(response.status, saveEmailFormId, response.statusText);
			},
			complete: function(event, xhr, settings) {
				saveEmailBtn.prop('disabled', false);
				loadingContainer.remove();
			}
		});

		// Save uninstall setting.
		var saveUninstallSettingFormId = '#stcfq-save-uninstall-setting-form';
		var saveUninstallSettingForm = $(saveUninstallSettingFormId);
		var saveUninstallSettingBtn = $('#stcfq-save-uninstall-setting-btn');
		saveUninstallSettingForm.ajaxForm({
			beforeSubmit: function(arr, $form, options) {
				return stcfqBeforeSubmit(saveUninstallSettingBtn);
			},
			success: function(response) {
				if(response.success) {
					stcfqSuccessMessage(response.data.message, saveUninstallSettingFormId);
				} else {
					if(response.data && $.isPlainObject(response.data)) {
						stcfqFormErrors(saveUninstallSettingFormId, response);
					} else {
						stcfqErrorMessage(response.data, saveUninstallSettingFormId);
					}
				}
			},
			error: function(response) {
				stcfqErrorMessage(response.status, saveUninstallSettingFormId, response.statusText);
			},
			complete: function(event, xhr, settings) {
				saveUninstallSettingBtn.prop('disabled', false);
				loadingContainer.remove();
			}
		});

	});
})(jQuery);
