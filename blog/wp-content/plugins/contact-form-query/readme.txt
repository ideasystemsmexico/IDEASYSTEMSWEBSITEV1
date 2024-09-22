=== Contact Form Query ===
Contributors: scriptstown
Tags: contact form plugin, contact form, email, contact, form
Donate link: https://scriptstown.com/
Requires at least: 5.0
Tested up to: 6.6
Requires PHP: 7.0
Stable tag: 1.8.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Add a contact form and receive new message notifications directly to your WordPress admin and to your email. Search and filter messages.

== Description ==

**Contact Form Query** adds a contact form to your WordPress site and allows you to receive new message notifications to your specified email address and also to the WordPress Admin Panel. The plugin adds a dashboard widget where the site admin can quickly view details of the latest messages received in the WordPress dashboard itself. It includes a dedicated page to view all the contact form entries.

To prevent spam entries in the form submissions, this plugin allows you to block messages based on blacklisted keywords so you can input specific keywords to easily block certain types of spam messages. Also, it supports **captcha** security features like Cloudflare **Turnstile** and Google **reCAPTCHA**.

The design of the contact form and its elements can easily adapt to your website's theme design for a cohesive appearance. You can choose a compact design layout for the form. Also, it allows you to reorder the form fields, adjust field labels, and indicate which fields are required or optional.

It supports **filtering** and **searching** of messages in the WordPress admin panel. Also, you can add an extra note to a message for future reference or mark them as answered. You can search any specific messages using notes, email addresses, subjects, or message content.

### Contact Form Query Features

* [Contact Form Query Features](https://scriptstown.com/wordpress-plugins/contact-form-query/)
* Contact Form **Shortcode**
* **Search** and **Filter** Messages
* Add Extra Notes to a Message
* Customizable Form
* **AJAX** Based Contact Form
* Block Messages Based On Keywords
* Spam Prevention by **Captcha**
* Support Cloudflare Turnstile
* Support Google reCAPTCHA
* Contact Form Dashboard **Widget**
* **Notification** to Admin ia Email

== Installation ==

**Contact Form Query [Installation Guide]**

1. You can:
 * Upload the entire `contact-form-query` folder to the `/wp-content/plugins/` directory via FTP.
 * Upload the zip file of plugin via *Plugins -> Add New -> Upload* in your WordPress Admin Panel.
 * Search **Contact Form Query** in the search engine available on *Plugins -> Add New* and press *Install Now* button.
2. Activate the plugin through *Plugins* menu in WordPress Admin Panel.
3. Click on *Contact* menu to configure the plugin.
4. Ready, now you can use it.

== Frequently Asked Questions ==

= How to add contact form to a page or post? =
Use the shortcode **[contact_form_query]** in any page or post to display the contact form.

== Screenshots ==

1. Compact Design
2. Contact Form with Success Message
3. Contact Form Messages in WordPress Admin Panel
4. Message Single View - Add Notes or Mark as Answered
5. Contact Form Fields Settings
6. Contact Form Design Settings
7. Contact Form Captcha Settings
8. Contact Form Email Settings
9. Latest Messages Dashboard Widget

== Changelog ==

= 1.8.1 =
* Tested up to 6.6.

= 1.8.0 =
* Tested up to 6.5.
* Tested compatibility with PHP 8.3.
* Readme updated.

= 1.7.9 =
* Tested up to 6.4.

= 1.7.8 =
* Readme updated.

= 1.7.7 =
* Improvement: Adjusted code related to filtering of messages.

= 1.7.6 =
* Improvement: Refactor code.

= 1.7.5 =
* Updated block API version to 3.

= 1.7.4 =
* Tested up to 6.3.

= 1.7.3 =
* Improvement: CSS fixes.

= 1.7.2 =
* Improvement: CSS fixes.
* Improvement: Increased textarea rows and columns.

= 1.7.1 =
* Added: Contact form block.

= 1.7.0 =
* Improvement: Fixed deprecated warnings.

= 1.6.2 =
* Tested up to 6.2.

= 1.6.1 =
* Improvement: Settings page.

= 1.6.0 =
* New: Cloudflare turnstile captcha support added.
* Readme updated.

= 1.5.5 =
* Improvement: Fix messages layout in firefox browser.
* Added: Option to block messages based on keywords.

= 1.5.4 =
* Improvement: Compatibility with PHP 8.1.

= 1.5.3 =
* Improvement: Query optimization.

= 1.5.2 =
* Improvement: Settings page.

= 1.5.1 =
* Tested up to 6.1.

= 1.5.0 =
* Improvement: Settings page.

= 1.4.9 =
* Improvement: Better handling for form input.

= 1.4.8 =
* Readme updated.

= 1.4.7 =
* Tested up to 6.0.

= 1.4.6 =
* Improvement: Load plugin translations using the init action.

= 1.4.5 =
* Improvement: Changed date type from timestamp to datetime.

= 1.4.4 =
* Tested up to 5.9.

= 1.4.3 =
* New: Added bulk delete option.

= 1.4.2 =
* Bug fix: Search filter.

= 1.4.1 =
* Improvement: Search filter.

= 1.4.0 =
* Added reset filter button.

= 1.3.8 =
* Tested up to 5.8.

= 1.3.7 =
* Improvement: Removed version and changed handle name of reCAPTCHA API.

= 1.3.6 =
* Improvement: Upsell banner clean-up.

= 1.3.5 =
* Tested up to 5.7.

= 1.3.4 =
* Fxied minor bug.

= 1.3.3 =
* Plugin settings page UI improvements.
* Improved query performance.
* Improved code.

= 1.3.2 =
* Added minified version of CSS and JS files on the shortcode page.

= 1.3.1 =
* Compatibility with PHP 8.

= 1.3.0 =
* Tested up to 5.6.

= 1.2.1 =
* Fixed dashboard banner design conflict with admin notices.

= 1.2.0 =
* Added welcome notice on activation.

= 1.1.9 =
* Added email configuration guide.
* Updated PHPMailer code.
* Tested up to 5.5.

= 1.1.8 =
* Improved caching method.

= 1.1.7 =
* Fixed local time zone issue.
* Improved dashboard widget.
* Updated readme file.

= 1.1.6 =
* Added Plugin URI.
* Changed columns value for textarea from 40 to 50.

= 1.1.5 =
* Improved messages table design.
* Tested up to 5.4.

= 1.1.4 =
* Improved load time with caching.

= 1.1.3 =
* Fixed record's date and time as set in WordPress time zone.
* Tested up to 5.3.2.
* Updated readme file.

= 1.1.2 =
* Refactor JS code.

= 1.1.1 =
* Fixed color picker bug.

= 1.1.0 =
* Added design settings.

= 1.0.9 =
* Design improvements.

= 1.0.8 =
* Added compact design.

= 1.0.7 =
* Removed unanswered messages count from admin menu.
* Added button to copy shortcode.
* Tested up to 5.3.

= 1.0.6 =
* Fixed admin bar icon on small devices.

= 1.0.5 =
* Removed unused code.

= 1.0.4 =
* Added email settings.
* Added email to admin.

= 1.0.3 =
* Added number of unanswered messages in admin bar.

= 1.0.2 =
* Added support for Google reCAPTCHA v2.
* Added success message setting.
* Added submit button setting.

= 1.0.1 =
* Added consent checkbox.
* Added uninstall setting.

= 1.0.0 =
* New release.
