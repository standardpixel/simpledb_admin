<? include 'view_part_header.php' ?>

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
			<? foreach($list_response as $domain) { ?>
				<tr><td><?= $domain ?></td><td><button name="domain_to_delete" value="<?= $domain ?>">Delete</button></td></tr>
			<?}?>
		</table>
	</div>
	
<? include 'view_part_footer.php' ?>