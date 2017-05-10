<section class="instagram-wrap">
      <div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="instagram-content">
					<div class="row photos-wrap">
						<div id="insta_container">
						
						<?php if(!empty($this->msg)) { echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">x</button><strong>Oeps! </strong>'.$this->msg.'.</div>'; } ?>
						
						<form enctype="multipart/form-data" method="post" action="">
						
							<div class="photo-box">
						<div class="top_name">
					<label class="fileUpload btn btn-default">
						<input type="file" id="file" style="display:none;" name="img" accept="image/jpg,image/png,image/jpeg,image/gif">
						<span class="upload">Upload een foto</span>
					</label>
				</div>
				<div class="image-wrap">
				
				<img id="preview" src="<?php echo SITE_URL; ?>assets/images/upload.jpg" alt="test">
				
		
				</div>
				
				<div class="description">
					

				<div class="user_name_feedbox">Voeg een beschrijving toe aan je post</div>
						<textarea name="desc" id="description" rows="4" cols="60" style="width:80%"></textarea>
						<input type="submit" name="submit" value="Plaatsen" style="float:right;right:10px;width:100px;height:74px;background:#3897f0;color:#fff;border: none;outline: none;">
		
		
				</div>
				</div>
				</form>
						
						
						
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>