<?
require_once 'lib_base.php';
require_once 'lib_aws.php';

#
# Create a domain
#
if($_POST['domain_name']) {
	$checkdomain_response = $nc['extensions']['simpledb']->domain_metadata($_POST['domain_name']);
	if($checkdomain_response->isOK()) {
		$nc['status'] = $nc['status'] . '<div class="status failure">There is already a domain named \''.$_POST['domain_name'].'\'</div>';
	} else {
		// Instantiate
		$create_response = $nc['extensions']['simpledb']->create_domain($_POST['domain_name']);
		if($create_response->isOK()) {
			$nc['status'] = $nc['status'] . '<div class="status success">\''.$_POST['domain_name'].'\' has been created</div>';
		} else {
			$nc['status'] = $nc['status'] . '<div class="status failure">Failed to create \''.$_POST['domain_name'] .'\'</div>';
		}
	}
}

#
# Delete a domain
#

if($_POST['domain_to_delete']) {
	$delete_response = $nc['extensions']['simpledb']->delete_domain($_POST['domain_to_delete']);
	
	if($delete_response->isOK()) {
		$nc['status'] = $nc['status'] . '<div class="status success">\''.$_POST['domain_to_delete'].'\' has been deleted</div>';
	} else {
		$nc['status'] = $nc['status'] . '<div class="status failure">Failed to delete \''.$_POST['domain_to_delete'] .'\'</div>';
	}
}

#
# Get domain list
#

$list_response = $nc['extensions']['simpledb']->get_domain_list();

include 'view_index.php';
?>