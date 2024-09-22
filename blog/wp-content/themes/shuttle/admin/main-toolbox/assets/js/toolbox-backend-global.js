jQuery(window).load(function() {

	// Select external links
	var externalLink = jQuery('#toplevel_page_shuttle-setup').find('a[href*="shuttlethemes.com"]');

	// Open external links in new tab
	externalLink.attr('target', '_blank');

	// Select upgrade link
	var upgradeLink   = jQuery('#toplevel_page_shuttle-setup').find('a[href*="shuttlethemes.com/themes/"]');
	var upgradeParent = upgradeLink.closest('li');

	// Highlight upgrade link
	upgradeParent.addClass('shuttle-sidebar-upgrade-pro');
});
