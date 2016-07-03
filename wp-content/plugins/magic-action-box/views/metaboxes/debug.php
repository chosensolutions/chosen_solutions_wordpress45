<?php
if(empty($_GET['mab_debug'])){
	$debug = 1;
	$debugText = __('Show debug info', 'mab');
} else {
	$debug = 0;
	$debugText = __('Hide debug info', 'mab');
}
?>
<a class="button button-primary" href="<?php echo add_query_arg(array('mab_debug' => $debug)); ?>"><?php echo $debugText; ?></a>
<br>
<?php if(!empty($_GET['mab_debug'])): ?>
<pre><textarea class="large-text" rows="20" readonly style="background: "><?php var_dump($data); ?></textarea></pre>
<?php endif; ?>