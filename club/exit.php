<?php 
		require_once('../php/config.php');
		session_unset();
		session_destroy(); 
		//echo json_encode(['success' => true]);
?>
<script type="text/javascript">
	window.location = './';
</script>