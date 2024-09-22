(function($) {
	'use strict';
	$(document).ready(function() {

		var loadingContainer = $('<span/>', {
			'class': 'st-loading-container'
		});
		var loadingImage = $('<img/>', {
			'src': stcfqadminurl + 'images/spinner.gif',
			'class': 'st-loading-image'
		});

		// Save contact message.
		$(document).on('submit', '.stcfq-save-contact-form', function(event) {
			event.preventDefault();
			var contactForm = this;
			var saveContactForm = $(this);
			var saveContactBtn = saveContactForm.find(':submit');
			var captcha = saveContactBtn.data('cpt');

			function submitForm(callback) {
				saveContactForm.ajaxSubmit({
					beforeSubmit: function(arr, $form, options) {
						$('.st-text-danger').remove();
						$('.st-is-invalid').removeClass("st-is-invalid");
						$('.st-alert-message').remove();
						saveContactBtn.prop('disabled', true);
						loadingContainer.insertAfter(saveContactBtn);
						loadingImage.appendTo(loadingContainer);
						return true;
					},
					success: function(response) {
						if(response.success) {
							var alertBox = '' +
							'<div class="st-alert-message st-alert-success" role="alert" tabindex="-1">' +
								'<strong>' + response.data.message + '</strong>' +
							'</div>';
							$(alertBox).insertBefore(contactForm).focus();
							saveContactForm[0].reset();
						} else {
							if(response.data && $.isPlainObject(response.data)) {
								saveContactForm.find(':input').each(function() {
									var input = this;
									$(input).removeClass('st-is-invalid');
									if(response.data[input.name]) {
										var errorSpan = '<div class="st-text-danger">' + response.data[input.name] + '</div>';
										if($(input).is(':checkbox')) {
											$(input).parent().parent().prepend(errorSpan);
										} else {
											$(input).addClass('st-is-invalid');
											$(errorSpan).insertAfter(input);
										}
									}
								});
							} else {
								var errorSpan = '' +
								'<div class="st-alert-message st-alert-error" role="alert" tabindex="-1">' +
									'<strong>' + response.data + '</strong>' +
								'</div>';
								$(errorSpan).insertBefore(contactForm).focus();
							}
						}
					},
					error: function(response) {
						saveContactBtn.prop('disabled', false);
						var errorSpan = '' +
						'<div class="st-alert-message st-alert-error" role="alert" tabindex="-1">' +
							'<strong>' + response.status + '</strong> ' + response.statusText +
						'</div>';
						$(errorSpan).insertBefore(contactForm).focus();
					},
					complete: function(event, xhr, settings) {
						if('function' === typeof callback) {
							callback();
						}
						saveContactBtn.prop('disabled', false);
						loadingContainer.remove();
					}
				});
			}

			if('cf_turnstile' === captcha) {
				var siteKey = saveContactBtn.data('site-key');
				var theme = saveContactBtn.data('cpt-theme');
				var widgetId = '#stcfq-cf-turnstile';
				turnstile.render(widgetId, {
					sitekey: siteKey,
					action: 'contact-form-query',
					theme: theme,
					callback: function(token) {
						submitForm(function() {
							turnstile.remove(widgetId);
						});
					},
				});
			} else {
				submitForm();
			}
		});

	});
})(jQuery);
