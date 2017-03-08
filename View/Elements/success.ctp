<?php
if (!isset($close)) {
	$close = true;
}
?>
<div class="alert alert-success">
<?php if ($close): ?>
	<a class="close" data-dismiss="alert" href="#">×</a>
<?php endif; ?>
	<?php echo $message; ?>
</div>