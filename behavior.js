setTimeout(function() {
	var status_blocks = document.querySelectorAll('.status');
	
	for(var i=0,l=status_blocks.length;l>i;i++) {
		var status_block = status_blocks[i];
		status_block.parentNode.removeChild(status_block);
	}
},7000);