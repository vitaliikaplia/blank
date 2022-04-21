/**
 * Variables
 */
var isMobile = navigator.userAgent.match(/Mobile/i) == "Mobile",
	ajaxUrl = "/wp-admin/admin-ajax.php",
	siteCookieDomain = "."+document.location.hostname.replace("www.","");
