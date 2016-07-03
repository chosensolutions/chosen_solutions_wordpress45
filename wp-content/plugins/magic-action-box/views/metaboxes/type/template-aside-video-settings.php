<div class="mab-notice">
	<p><?php _e('<a href="http://www.magicactionbox.com/features/?pk_campaign=LITE&pk_kwd=asideVideo">Upgrade to Pro</a> to be able to show videos with your action boxes.', MAB_DOMAIN); ?></p>
</div>
<div class="mab-option-box mab-embed-code-creator-wrap mab-disabled">
	<h4>Youtube Embed Code Creator</h4>
	<p>The Youtube Embed Code Creator helps you create your Video Embed Code if your video is hosted on youtube. You may also enter your Video Embed Code directly below this section if you are not using a Youtube video.<p>
	<h4><label for="mab-aside-yt-url">Youtube Video URL</label></h4>
	<p>Enter URL to your Youtube video. Example: <code>http://www.youtube.com/watch?v=6tN0-qtSV64</code></p>

	<input type="text" class="large-text code" id="mab-aside-yt-url" name="" value="" disabled/>
	<br /><br />

	<h4>Youtube Video Size</h4>
	<select class="mab-aside-yt-size-select" name="" disabled>
		<option value="default" data-width="120" data-height="90" >120 x 90</option>
		<option value="medium" data-width="180" data-height="135" >180 x 135</option>
		<option value="large" data-width="260" data-height="195" >260 x 195</option>
		<option value="custom" >Custom Size</option>
	</select>

	<span class="mab-aside-yt-size-fields"><input type="text" class="small-text code" id="mab-aside-yt-width" name="" value="" disabled /> x <input type="text" class="small-text code" id="mab-aside-yt-height" name="" value="" disabled /></span>
	<br /><br />

	<a href="#" class="button-secondary mab-disabled">Create Embed Code</a>
	<p class="mab-notice" style="display: none;">You need to specify <strong>Youtube Video URL</strong> and <strong>Youtube Video Size</strong> to use the Youtube Embed Code Creator</p>
</div>

<div class="mab-option-box mab-disabled">
	<h4><label for="mab-aside-video-embed-code">Video Embed Code</label></h4>
	<p>Enter your video embed code here. You may also use the Youtube Embed Code Creator above if you are using Youtube video.</p>

	<textarea id="mab-aside-video-embed-code" class="large-text code" rows="5" name="" disabled></textarea>
</div>