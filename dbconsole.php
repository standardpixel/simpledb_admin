<?
require_once '/var/www_libs/aws-sdk-for-php/sdk.class.php';
// Instantiate
$sdb = new AmazonSDB();

$status = '';

#
# Create a domain
#
if($_POST['domain_name']) {
	$checkdomain_response = $sdb->domain_metadata($_POST['domain_name']);
	if($checkdomain_response->isOK()) {
		$status = $status . '<div class="status failure">There is already a domain named \''.$_POST['domain_name'].'\'</div>';
	} else {
		// Instantiate
		$create_response = $sdb->create_domain($_POST['domain_name']);
		if($create_response->isOK()) {
			$status = $status . '<div class="status success">\''.$_POST['domain_name'].'\' has been created</div>';
		} else {
			$status = $status . '<div class="status failure">Failed to create \''.$_POST['domain_name'] .'\'</div>';
		}
	}
}

#
# Delete a domain
#

if($_POST['domain_to_delete']) {
	$delete_response = $sdb->delete_domain($_POST['domain_to_delete']);
	
	if($delete_response->isOK()) {
		$status = $status . '<div class="status success">\''.$_POST['domain_to_delete'].'\' has been deleted</div>';
	} else {
		$status = $status . '<div class="status failure">Failed to delete \''.$_POST['domain_to_delete'] .'\'</div>';
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=1036">
	<title>StandardPixel SimpleDB Console</title>
	
	<style>
		.status {
			padding:3px;
			font-weight:bolder;
			border:solid 1px white;
		}
		.status.failure {
			background-color:red;color:white;
		}
		.status.success {
			background-color:green;color:white;
		}
	</style>
</head>
<body>
	<header>
		<?=$status?>
		<h1>StandardPixel AWS SimpleDB Console</h1>
	</header>
	<div>
		<h2>Add a domain</h2>
		<div>
			<form name="create" method="post">
				<input name="domain_name">
				<button>Create</button>
			</form>
		</div>
		
		<h2>Existing domains</h2>
		<div>
			<form name="list" method="post">
			<table>
			<?
				$list_response = $sdb->get_domain_list();

				foreach($list_response as $domain) {
					echo '<tr><td>' . $domain . '</td><td><button name="domain_to_delete" value="'.$domain.'">Delete</button></td></tr>';
				}

			?>
			</table>
		</div>
		
		<script>
			setTimeout(function() {
				var status_blocks = document.querySelectorAll('.status');
				
				for(var i=0,l=status_blocks.length;l>i;i++) {
					var status_block = status_blocks[i];
					status_block.parentNode.removeChild(status_block);
				}
			},7000);
		</script>
	</div>
</body>
</html>