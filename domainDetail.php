<?
require_once 'lib_base.php';
require_once 'lib_aws.php';

#
# Seperate the men from the boys
#

if($_GET['domain']) {
	
	#
	# Get domain details
	#
	$details_response = $nc['extensions']['simpledb']->domain_metadata(filter_var($_GET['domain'],FILTER_SANITIZE_STRING));
	
	if($details_response->isOK()) {
		
		include 'view_domainDetail.php';
		
	} else {
		
		$nc['view_error'] = 'There is no domain named \''.filter_var($_GET['domain'],FILTER_SANITIZE_STRING).'\'. Try coming back after clicking on a domain from the <a href="index.php">domain list</a>';
		include 'view_error.php';
		
	}
	
} else {
	
	$nc['view_error'] = 'I\'m not sure what you are trying to do. Try coming back after clicking on a domain from the <a href="index.php">domain list</a>';
	include 'view_error.php';

}
?>