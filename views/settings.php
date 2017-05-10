<section class="profile-wrap">
<div class="user_profile_information">	
      <div class="container">	
<div class="profile_settings_box">
<?php if(!empty($this->messages)) { echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">x</button><strong>Oeps! </strong>'.$this->messages.'.</div>'; } ?>
	
	<div class="image_upload_box">
		<img src="<?php echo SITE_URL . "assets/images/profile/".$this->userData['profile_image']; ?>" id="preview" class="user_profile_image">
			<form enctype="multipart/form-data" method="post" action="">

					<label class="profileUpload btn btn-default">
						<input type="file"  id="file" style="display:none;" class="upload" name="img" accept="image/jpg,image/png,image/jpeg,image/gif">
						<span class="upload">Upload een profielfoto</span>
					</label>
		</div>
<div class="bio_box">
<label>Wijzig bio</label>
<textarea id="bio" name="bio" rows="4" cols="40" placeholder="Voeg een bio toe aan je profiel">
<?php echo $this->userData['profile_bio']; ?>
</textarea>
</div>


	<input type="submit" name="submit" class="edit_settings save" value="Opslaan">
	<input type="submit" name="terug" class="edit_settings terug" value="Terug">
	</form>
</div>
</div>
</section>
<?php //include("includes/footer.php"); ?>
</body>
</html>