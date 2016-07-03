
<a id="mabdp-open" href="#design-panel" class="button-primary" ><?php _e('Open design panel', 'mab'); ?></a>

<div id="mabdp" style="display: none;">
	<a id="mabdp-close" href="#close" class="buttona">&times;</a>
	<div id="mabdppad">
	<div id="mabdpwrap">
		<div id="mabdpcontrol-panel" >

			<a href="#" class="mabdp-handle"><i class="fa fa-angle-double-left"></i></a>

			<div id="mabdp-save-wrap">
				<a class="button button-primary" href="#save"><?php _e('Save', 'mab'); ?></a>
			</div>

			<div class="panel-groups">

				<h4 class="panel-group-header"><?php _e('Basic', 'mab'); ?></h4>
				<div class="panel-group">
					<label><?php _e('Base Style', 'mab'); ?></label>
					<select id="base-style-select">
						<option value=""><?php _e('None', 'mab'); ?></option>
						<?php foreach( ProsulumMabDesign::baseStyles() as $key => $s): ?>
							<option value="<?php echo $key; ?>"><?php echo $s['name']; ?></option>
						<?php endforeach; ?>
					</select>
				</div>

				<h4 class="panel-group-header"><?php _e('Container', 'mab'); ?></h4>
				<div class="panel-group">
					Thi s tis the aciton box container
				</div>

				<h4 class="panel-group-header"><?php _e('Form', 'mab'); ?></h4>
				<div class="panel-group">
					Form stuff
				</div>

				<h4 class="panel-group-header"><?php _e('Main heading', 'mab'); ?></h4>
				<div class="panel-group">
					The main heading
				</div>

				<h4 class="panel-group-header group-last"><?php _e('Sub heading', 'mab'); ?></h4>
				<div class="panel-group group-last">
					The sub heading
				</div>

			</div>

		</div>
		<div id="mabdbpreviewboxwrap">
			<div id="mabdppreviewbox"></div>
		</div>

		</div><!-- #mabdesignwrap -->
	</div><!-- #mabdesignpad -->
</div><!-- #mabdesignpanel -->