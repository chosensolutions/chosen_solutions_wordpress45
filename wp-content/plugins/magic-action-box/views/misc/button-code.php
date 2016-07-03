<?php 
	$MabBase = MAB();
	$button = $data['button'];
	$key = $data['key'];
	
	if( !isset( $key ) || $key === '' ){ 
		$class = 'mab-css3button';	
	} else { 
		$class = "mab-button-{$key}"; 
	}
?>

body .<?php echo $class; ?>, body div.magic-action-box .<?php echo $class; ?>, body div.magic-action-box .mab-content .<?php echo $class; ?>, body div.magic-action-box .mab-content form .<?php echo $class; ?>, .magic-action-box.use-<?php echo $class; ?> .mab-content form input[type="submit"], .magic-action-box.use-<?php echo $class; ?> .mab-content form button, .magic-action-box.use-<?php echo $class; ?> .mab-content form .button{
	display: inline-block;
	text-decoration: none !important;

	<?php ### BACKGROUND ?>
	<span class="property">background</span>: <span class="c background-color-start"><?php echo $button['background-color-start']; ?></span> !important;

	<?php if( !empty( $button['background-color-start'] ) && !empty( $button['background-color-end'] ) ): ?>
	<?php //Mozilla ?>
	<span class="property">background</span>: <span class="property">-moz-linear-gradient</span>( top,
		<span class="c background-color-start"><?php echo $button['background-color-start']; ?></span> 0%,
		<span class="c background-color-end"><?php echo $button['background-color-end']; ?></span> 100% )  !important;
	<?php //Webkit Chrome, Safari4+ ?>
	<span class="property">background</span>: <span class="property">-webkit-gradient</span>( 
		linear, left top, left bottom,
		from(<span class="c background-color-start"><?php echo $button['background-color-start']; ?></span>),
		to(<span class="c background-color-end"><?php echo $button['background-color-end']; ?></span>) )  !important;
	<?php //Webkit Chrosm10+, Safari5.1+ ?>
	<span class="property">background</span>: <span class="property">-webkit-linear-gradient</span>( top,
		<span class="c background-color-start"><?php echo $button['background-color-start']; ?></span> 0%,
		<span class="c background-color-end"><?php echo $button['background-color-end']; ?></span> 100% ) !important;
	<?php //IE 10+ ?>
	<span class="property">background</span>: <span class="property">-ms-linear-gradient</span>( top,
		<span class="c background-color-start"><?php echo $button['background-color-start']; ?></span> 0%,
		<span class="c background-color-end"><?php echo $button['background-color-end']; ?></span> 100% ) !important;
	<?php //W3C ?>
	<span class="property">background</span>: <span class="property">linear-gradient</span>( to bottom,
		<span class="c background-color-start"><?php echo $button['background-color-start']; ?></span> 0%,
		<span class="c background-color-end"><?php echo $button['background-color-end']; ?></span> 100% ) !important;
	<?php endif; ?>

	<?php ### BORDERS AND PADDING ?>
	<span class="property">border</span>: <span class="s border-width"><?php echo $button['border-width']; ?></span>px solid <span class="c border-color"><?php echo $button['border-color']; ?></span> !important;
	<span class="property">-moz-border-radius</span>: <span class="s border-radius"><?php echo $button['border-radius']; ?></span>px !important;
	<span class="property">-webkit-border-radius</span>: <span class="s border-radius"><?php echo $button['border-radius']; ?></span>px !important;
	<span class="property">border-radius</span>: <span class="s border-radius"><?php echo $button['border-radius']; ?></span>px !important;
	<span class="property">padding</span>: <span class="s padding-tb"><?php echo $button['padding-tb']; ?></span>px <span class="s padding-lr"><?php echo $button['padding-lr']; ?></span>px !important;

	<?php ### DROP SHADOW ?>
	<span class="property">-moz-box-shadow</span>: 
		<span class="s box-shadow-x"><?php echo $button['box-shadow-x']; ?></span>px <span class="s box-shadow-y"><?php echo $button['box-shadow-y']; ?></span>px <span class="s box-shadow-size"><?php echo $button['box-shadow-size']; ?></span>px rgba( <span class="rgb box-shadow-color"><?php echo $MabBase->RGB2hex($button['box-shadow-color']); ?></span>, <span class="a box-shadow-opacity"><?php echo $button['box-shadow-opacity']; ?></span>),
		inset <span class="s inset-shadow-x"><?php echo $button['inset-shadow-x']; ?></span>px <span class="s inset-shadow-y"><?php echo $button['inset-shadow-y']; ?></span>px <span class="s inset-shadow-size"><?php echo $button['inset-shadow-size']; ?></span>px rgba( <span class="rgb inset-shadow-color"><?php echo $MabBase->RGB2hex($button['inset-shadow-color']); ?></span>, <span class="a inset-shadow-opacity"><?php echo $button['inset-shadow-opacity']; ?></span>) !important;

	<span class="property">-webkit-box-shadow</span>: 
		<span class="s box-shadow-x"><?php echo $button['box-shadow-x']; ?></span>px <span class="s box-shadow-y"><?php echo $button['box-shadow-y']; ?></span>px <span class="s box-shadow-size"><?php echo $button['box-shadow-size']; ?></span>px rgba(<span class="rgb box-shadow-color"><?php echo $MabBase->RGB2hex($button['box-shadow-color']); ?></span>, <span class="a box-shadow-opacity"><?php echo $button['box-shadow-opacity']; ?></span>),
		inset <span class="s inset-shadow-x"><?php echo $button['inset-shadow-x']; ?></span>px <span class="s inset-shadow-y"><?php echo $button['inset-shadow-y']; ?></span>px <span class="s inset-shadow-size"><?php echo $button['inset-shadow-size']; ?></span>px rgba(<span class="rgb inset-shadow-color"><?php echo $MabBase->RGB2hex($button['inset-shadow-color']); ?></span>, <span class="a inset-shadow-opacity"><?php echo $button['inset-shadow-opacity']; ?></span>) !important;
		
	<span class="property">box-shadow</span>: 
		<span class="s box-shadow-x"><?php echo $button['box-shadow-x']; ?></span>px <span class="s box-shadow-y"><?php echo $button['box-shadow-y']; ?></span>px <span class="s box-shadow-size"><?php echo $button['box-shadow-size']; ?></span>px rgba(<span class="rgb box-shadow-color"><?php echo $MabBase->RGB2hex($button['box-shadow-color']); ?></span>, <span class="a box-shadow-opacity"><?php echo $button['box-shadow-opacity']; ?></span>),
		inset <span class="s inset-shadow-x"><?php echo $button['inset-shadow-x']; ?></span>px <span class="s inset-shadow-y"><?php echo $button['inset-shadow-y']; ?></span>px <span class="s inset-shadow-size"><?php echo $button['inset-shadow-size']; ?></span>px rgba(<span class="rgb inset-shadow-color"><?php echo $MabBase->RGB2hex($button['inset-shadow-color']); ?></span>, <span class="a inset-shadow-opacity"><?php echo $button['inset-shadow-opacity']; ?></span>) !important;
	
	<?php ### TEXT SHADOW ?>
	<span class="property">text-shadow</span>: 
		<span class="s text-shadow-1-x"><?php echo $button['text-shadow-1-x']; ?></span>px <span class="s text-shadow-1-y"><?php echo $button['text-shadow-1-y']; ?></span>px <span class="s text-shadow-1-size"><?php echo $button['text-shadow-1-size']; ?></span>px rgb(<span class="rgb text-shadow-1-color"><?php echo $MabBase->RGB2hex($button['text-shadow-1-color']); ?></span>) !important;
		
	<span class="property">text-shadow</span>: 
		<span class="s text-shadow-1-x"><?php echo $button['text-shadow-1-x']; ?></span>px <span class="s text-shadow-1-y"><?php echo $button['text-shadow-1-y']; ?></span>px <span class="s text-shadow-1-size"><?php echo $button['text-shadow-1-size']; ?></span>px rgba(<span class="rgb text-shadow-1-color"><?php echo $MabBase->RGB2hex($button['text-shadow-1-color']); ?></span>, <span class="a text-shadow-1-opacity"><?php echo $button['text-shadow-1-opacity']; ?></span>) !important;
		
	<?php ### FONTS ?>
	<span class="property">color</span>: <span class="c font-color"><?php echo $button['font-color']; ?></span> !important;
	<span class="property">font-family</span>: <span class="c font-family"><?php echo $button['font-family']; ?></span> !important;
	<span class="property">font-size</span>: <span class="c font-size"><?php echo $button['font-size']; ?></span>px !important;
	<span class="property">font-weight</span>: <span class="c font-weight"><?php echo $button['font-weight']; ?></span> !important;
	<span class="property">text-transform</span>: <span class="c font-transform"><?php echo $button['font-transform']; ?></span> !important;
}

body .<?php echo $class; ?>:hover, body div.magic-action-box .<?php echo $class; ?>:hover, body div.magic-action-box .mab-content .<?php echo $class; ?>:hover, body div.magic-action-box .mab-content form .<?php echo $class; ?>:hover, .magic-action-box.use-<?php echo $class; ?> .mab-content form input[type="submit"]:hover, .magic-action-box.use-<?php echo $class; ?> .mab-content form button:hover, .magic-action-box.use-<?php echo $class; ?> .mab-content form .button:hover{
	text-decoration: none !important;
	<span class="property">background</span>: <span class="c background-color-hover-start"><?php echo $button['background-color-hover-start']; ?></span> !important;
	
	<?php if( !empty( $button['background-color-hover-start'] ) && !empty( $button['background-color-hover-end'] ) ): ?>
	<?php //Mozilla ?>
	<span class="property">background</span>: <span class="property">-moz-linear-gradient</span>( top,
		<span class="c background-color-hover-start"><?php echo $button['background-color-hover-start']; ?></span> 0%,
		<span class="c background-color-hover-end"><?php echo $button['background-color-hover-end']; ?></span> 100% ) !important;
	<?php //Webkit Chrome, Safari4+ ?>
	<span class="property">background</span>: <span class="property">-webkit-gradient</span>( 
		linear, left top, left bottom,
		from(<span class="c background-color-hover-start"><?php echo $button['background-color-hover-start']; ?></span>),
		to(<span class="c background-color-hover-end"><?php echo $button['background-color-hover-end']; ?></span>) ) !important;
	<?php //Webkit Chrosm10+, Safari5.1+ ?>
	<span class="property">background</span>: <span class="property">-webkit-linear-gradient</span>( top,
		<span class="c background-color-hover-start"><?php echo $button['background-color-hover-start']; ?></span> 0%,
		<span class="c background-color-hover-end"><?php echo $button['background-color-hover-end']; ?></span> 100% ) !important;
	<?php //IE 10+ ?>
	<span class="property">background</span>: <span class="property">-ms-linear-gradient</span>( top,
		<span class="c background-color-hover-start"><?php echo $button['background-color-hover-start']; ?></span> 0%,
		<span class="c background-color-hover-end"><?php echo $button['background-color-hover-end']; ?></span> 100% ) !important;
	<?php //W3C ?>
	<span class="property">background</span>: <span class="property">linear-gradient</span>( to bottom,
		<span class="c background-color-hover-start"><?php echo $button['background-color-hover-start']; ?></span> 0%,
		<span class="c background-color-hover-end"><?php echo $button['background-color-hover-end']; ?></span> 100% ) !important;
	<?php endif; ?>

	<span class="property">border-color</span>: <span class="c border-color-hover"><?php echo $button['border-color-hover']; ?></span> !important;
	
	<span class="property">color</span>: <span class="c font-color"><?php echo $button['font-color']; ?></span> !important;
}

body .<?php echo $class; ?>:focus, body div.magic-action-box .<?php echo $class; ?>:focus, body div.magic-action-box .mab-content .<?php echo $class; ?>:focus, .magic-action-box.use-<?php echo $class; ?> .mab-content form input[type="submit"]:focus, .magic-action-box.use-<?php echo $class; ?> .mab-content form button:focus, .magic-action-box.use-<?php echo $class; ?> .mab-content form .button:focus{
	<span class="property">color</span>: <span class="c font-color"><?php echo $button['font-color']; ?></span> !important;
}
