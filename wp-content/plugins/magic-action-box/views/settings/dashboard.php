<div class="wrap">
<div class="about-wrap mab-page" id="mab-dashboard">
	<h1><?php _e('Magic Action Box', 'mab'); ?> <span class="version"><?php echo MAB_VERSION; ?></span></h1>

	<!--div class="about-text"><?php _e('Thanks for installing Magic Action Box.', 'mab'); ?></div-->

	<h2 class="nav-tab-wrapper">
		<a href="#start" class="nav-tab nav-tab-active">
			<?php _e( 'Start', 'mab' ); ?>
		</a>
		<a href="#support" class="nav-tab">
			<?php _e( 'Support &amp; Documentation', 'mab' ); ?>
		</a>
		<a href="#changelog" class="nav-tab">
			<?php _e( 'Change log', 'mab' ); ?>
		</a>
		<a href="#debug" class="nav-tab">
			<?php _e('Debug', 'mab'); ?>
		</a>
	</h2>

	<div id="start" class="changelog group">

		<div class="feature-section">
			<h3><?php _e( 'Getting started with Magic Action Box', 'mab' ); ?></h3>
			<ul class="bullet">
				<li><a href="http://www.magicactionbox.com/user-guide/integration/using-magic-action-box-with-built-in-integration/" target="_blank"><?php _e('Create your first opt-in form action box with built-in integration', 'mab'); ?></a></li>
				<li><a href="http://www.magicactionbox.com/user-guide/integration/using-magic-action-box-with-any-custom-html-form/" target="_blank"><?php _e('Create your first opt-in form action box from a provided HTML code', 'mab'); ?></a></li>
				<li><a href="http://www.magicactionbox
				.com/user-guide/getting-started/add-an-action-box-to-a-blog-post-or-page/"
				       target="_blank"><?php _e('How to add an action box to a blog post or page', 'mab'); ?></a></li>
			</ul>
			<h3><?php _e('Shortcuts', 'mab'); ?></h3>
			<ul class="bullet">
				<li><a href="<?php echo admin_url('post-new.php?post_type=action-box'); ?>"><?php _e('Create a new action box', 'mab'); ?></a></li>
				<li><a href="<?php echo admin_url('edit.php?post_type=action-box'); ?>"><?php _e('View all action boxes', 'mab'); ?></a></li>
				<li><a href="<?php echo admin_url('admin.php?page=mab-settings'); ?>"><?php _e('Configure settings and accounts', 'mab'); ?></a></li>
				<li><a href="<?php echo admin_url('admin.php?page=mab-design'); ?>"><?php _e('Configure custom styles, fonts and buttons', 'mab'); ?></a></li>
			</ul>
		</div>

		<div class="feature-section">

			<h3><?php _e('Built-in integration', 'mab'); ?></h3>
			<h4><?php _e('Aweber, Constant Contact, MailChimp, SendReach', 'mab'); ?></h4>
			<p><?php printf(__('To connect Aweber, Constant Contact, MailChimp or SendReach with Magic Action Box, go to <a href="%s">Main
Settings</a>
and click on the Accounts &amp; Integration tab. Follow the instructions for connecting your chosen email list service
provider.', 'mab'), admin_url('admin.php?page=mab-settings')); ?></p>
			<img class="screenshot" src="<?php echo MAB_ASSETS_URL; ?>images/screenshot-accounts.jpg" alt="">
			<h4><?php _e('MailPoet, Contact Form 7 and Gravity Forms', 'mab'); ?></h4>
			<p><?php _e('Magic Action Box automatically connects with MailPoet, Contact Form 7 and Gravity Forms when you install their respective plugins.', 'mab'); ?></p>
			<p><?php printf(__('See the <strong>full guide</strong> to <a href="%s" target="_blank">using Magic Action Box with built-in
integration</a>.', 'mab'), 'http://www.magicactionbox.com/user-guide/integration/using-magic-action-box-with-built-in-integration/'); ?></p>
		</div>
	</div><!-- #start -->

	<div id="support" class="changelog group">
		<div class="feature-section">
			<h3><?php _e('Need help?', 'mab'); ?></h3>
			<p><?php printf(__('You can check out our <a href="%s" target="_blank">documentation</a>, go through our <a
			href="%s" target="_blank">forums</a> or <a href="%s" target="_blank">submit a ticket</a>. We should get back to you within 24 hours.', 'mab'), 'http://www.magicactionbox
			.com/documentation/', 'https://prosulum.zendesk
			.com/forums', 'https://prosulum.zendesk.com'); ?></p>
		</div>
	</div><!-- #support -->

	<div id="changelog" class="changelog group">
		<div class="feature-section">
			<ul class="bullet">
				<li>Remove non-working implementation of style preview</li>
				<li>Add curl option to disable verify ssl peers on mailchimp api</li>
			</ul>
		</div>
	</div><!-- #changelog -->

	<div id="debug" class="changelog group">
		<div class="feature-section">
			<a class="button button-primary" href="<?php echo add_query_arg(array('mab_debug' => 1)); ?>"><?php _e('Show debug info', 'mab'); ?></a>
			<?php if(!empty($_GET['mab_debug'])): ?>
				<table class="form-table">
					<tbody>
					<tr>
						<th><strong><?php _e('Version', 'mab'); ?></strong></th>
						<td><?php echo MAB_VERSION; ?></td>
					</tr>
					<tr>
						<th><strong><?php _e('PHP Version', 'mab'); ?></strong></th>
						<td><?php echo phpversion(); ?></td>
					</tr>
					<?php $css_dir = mab_get_stylesheet_location('path'); ?>
					<tr>
						<th><strong><?php _e('CSS directory', 'mab'); ?></strong></th>
						<td>
							<pre><?php print_r($css_dir); ?></pre>
							<?php if(!mab_make_stylesheet_path_writable()){
								if( !is_dir($css_dir)) {
									$dir_text = '<p class="error-text">' . __('CSS directory does not exist. ', 'mab') . '</p>';
								} elseif ( !is_writable(mab_get_stylesheet_location('path')) ) {
									$dir_text = '<p class="error-text">' . __('Directory exists but is not writable.', 'mab') . '</p>';
								}
							} else {
								$dir_text = '<p class="success-text">' . __('Directory exists.', 'mab') . '</p>';
							} ?>
							<?php echo $dir_text; ?>
						</td>
					</tr>

					<?php if(is_dir($css_dir)): ?>
					<tr>
						<th><strong>CSS directory contents</strong></th>
						<td><pre><textarea class="large-text" rows="20" readonly style="background: #fff;"><?php print_r(@scandir($css_dir)); ?></textarea></pre></td>
					</tr>
					<?php endif; ?>

					<tr>
						<th><strong>_mab_settings</strong></th>
						<td><pre><textarea class="large-text" rows="30" readonly style="background: #fff;"><?php print_r(MAB('settings')->getAll(false)); ?></textarea></pre></td>
					</tr>
					</tbody>
				</table>
			<?php endif; ?>
		</div>
	</div>

</div><!-- #mab-dashboard -->
</div><!-- .wrap -->