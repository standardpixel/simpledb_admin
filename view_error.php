<? include 'view_part_header.php' ?>

	<? if($nc['view_error']) { ?>
		<div class="message failure"><?=$nc['view_error']?></div>
	<?} else {?>
		<div class="message failure">Something went wrong. I recommend trying again.</div>
	<?}?>
	
<? include 'view_part_footer.php' ?>