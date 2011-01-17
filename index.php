<?
require_once 'lib_base.php';
require_once 'lib_aws.php';

#
# Create a domain
#

$domain_name = filter_var($_POST['domain_name'],FILTER_SANITIZE_STRING);

if($_POST['domain_name']) {
	
	$checkdomain_response = $nc['extensions']['simpledb']->domain_metadata($domain_name);
	if($checkdomain_response->isOK()) {
	
		$nc['status'] = $nc['status'] . '<div class="status failure">There is already a domain named \''.$domain_name.'\'</div>';
	
	} else {
		
		$create_response = $nc['extensions']['simpledb']->create_domain($domain_name);
		if($create_response->isOK()) {
			$nc['status'] = $nc['status'] . '<div class="status success">\''.$domain_name.'\' has been created</div>';
		} else {
			$nc['status'] = $nc['status'] . '<div class="status failure">Failed to create \''.$domain_name .'\'</div>';
		}
	
	}
}

#
# Delete a domain
#

if($_POST['domain_to_delete']) {
	
	$domain_to_delete = filter_var($_POST['domain_to_delete'],FILTER_SANITIZE_STRING);
	
	$delete_response = $nc['extensions']['simpledb']->delete_domain($domain_to_delete);
	
	if($delete_response->isOK()) {
		$nc['status'] = $nc['status'] . '<div class="status success">\''.$domain_to_delete.'\' has been deleted</div>';
	} else {
		$nc['status'] = $nc['status'] . '<div class="status failure">Failed to delete \''.$domain_to_delete .'\'</div>';
	}
	
}

#
# Get domain list
#

$list_response = $nc['extensions']['simpledb']->get_domain_list();

include 'view_index.php';
?>