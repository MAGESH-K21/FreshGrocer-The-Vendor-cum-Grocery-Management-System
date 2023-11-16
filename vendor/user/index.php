<?php 
$user = $conn->query("SELECT * FROM vendor_list where id ='".$_settings->userdata('id')."'");
foreach($user->fetch_array() as $k =>$v){
	$$k = $v;
}
?>
<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>

<style>
	#cimg{
          width:200px;
          height:200px;
          object-fit:scale-down;
          object-position:center center
      }
</style>
<div class="content py-3"></div>
	<div class="card card-outline rounded-0 card-primary shadow">
		<div class="card-body">
			<div class="container-fluid">
				<div id="msg"></div>
				<form action="" id="manage-user">	
					<input type="hidden" name="id" value="<?php echo $_settings->userdata('id') ?>">
					<div class="row">
						<div class="form-group col-md-6">
							<label for="shop_name" class="control-label">Shop Name</label>
							<input type="text" id="shop_name" autofocus name="shop_name" class="form-control form-control-sm form-control-border" value="<?= isset($shop_name) ? $shop_name : "" ?>" required>
						</div>
						<div class="form-group col-md-6">
							<label for="shop_owner" class="control-label">Shop Owner Fullname</label>
							<input type="text" id="shop_owner" name="shop_owner" class="form-control form-control-sm form-control-border" value="<?= isset($shop_owner) ? $shop_owner : "" ?>" required>
						</div>
						<div class="form-group col-md-6">
							<label for="contact" class="control-label">Contact #</label>
							<input type="text" id="contact" name="contact" class="form-control form-control-sm form-control-border" value="<?= isset($contact) ? $contact : "" ?>" required>
						</div>
						<div class="form-group col-md-6">
							<label for="shop_type_id" class="control-label">Shop Type</label>
							<select type="text" id="shop_type_id" name="shop_type_id" class="form-control form-control-sm form-control-border select2" required>
								<option value="" disabled selected></option>
								<?php 
								$types = $conn->query("SELECT * FROM `shop_type_list` where delete_flag = 0 and `status` = 1 ".(isset($shop_type_id) ? " or id = '{$shop_type_id}' " : "")." order by `name` asc ");
								while($row = $types->fetch_assoc()):
								?>
								<option value="<?= $row['id'] ?>" <?= isset($shop_type_id) && $shop_type_id == $row['id'] ? 'selected' : '' ?>><?= $row['name'] ?></option>
								<?php endwhile; ?>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="username" class="control-label">Username</label>
							<input type="text" id="username" name="username" class="form-control form-control-sm form-control-border" value="<?= isset($username) ? $username : "" ?>" required>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="password" class="control-label">New Password</label>
							<div class="input-group input-group-sm">
								<input type="password" id="password" name="password" class="form-control form-control-sm form-control-border">
								<div class="input-group-append bg-transparent border-top-0 border-left-0 border-right-0 rounded-0">
									<span class="input-group-text bg-transparent border-top-0 border-left-0 border-right-0 rounded-0">
										<a href="javascript:void(0)" class="text-reset text-decoration-none pass_view"> <i class="fa fa-eye-slash"></i></a>
									</span>
								</div>
							</div>
						</div>
						<div class="form-group col-md-6">
							<label for="cpassword" class="control-label">Confirm New Password</label>
							<div class="input-group input-group-sm">
								<input type="password" id="cpassword" class="form-control form-control-sm form-control-border">
								<div class="input-group-append bg-transparent border-top-0 border-left-0 border-right-0 rounded-0">
									<span class="input-group-text bg-transparent border-top-0 border-left-0 border-right-0 rounded-0">
										<a href="javascript:void(0)" class="text-reset text-decoration-none pass_view"> <i class="fa fa-eye-slash"></i></a>
									</span>
								</div>
							</div>
						</div>
						<small class="text-muted">Leave the New Password Field Blank if you don't wish to update it.</small>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="logo" class="control-label">Shop Logo</label>
							<input type="file" id="logo" name="img" class="form-control form-control-sm form-control-border" onchange="displayImg(this,$(this))" accept="image/png, image/jpeg">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6 text-center">
							<img src="<?= validate_image(isset($avatar) ? $avatar : "") ?>" alt="Shop Logo" id="cimg" class="border border-gray img-thumbnail">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="oldpassword" class="control-label">Enter Current Password</label>
							<div class="input-group input-group-sm">
								<input type="password" id="oldpassword" name="oldpassword" class="form-control form-control-sm form-control-border" reqiured>
								<div class="input-group-append bg-transparent border-top-0 border-left-0 border-right-0 rounded-0">
									<span class="input-group-text bg-transparent border-top-0 border-left-0 border-right-0 rounded-0">
										<a href="javascript:void(0)" class="text-reset text-decoration-none pass_view"> <i class="fa fa-eye-slash"></i></a>
									</span>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="card-footer">
			<div class="col-md-12">
				<div class="row">
					<button class="btn btn-sm btn-primary" form="manage-user">Update</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }else{
			$('#cimg').attr('src', "<?= validate_image(isset($avatar) ? $avatar : "") ?>");
		}
	}
	
	$(function(){
		$('.pass_view').click(function(){
			var _el = $(this).closest('.input-group')
			var type = _el.find('input').attr('type')
			if(type == 'password'){
				_el.find('input').attr('type','text').focus()
				$(this).find('i.fa').removeClass('fa-eye-slash').addClass('fa-eye')
			}else{
				_el.find('input').attr('type','password').focus()
				$(this).find('i.fa').addClass('fa-eye-slash').removeClass('fa-eye')

			}
		})
		$('#manage-user').submit(function(e){
			e.preventDefault();
			var _this = $(this)
				$('.err-msg').remove();
			var el = $('<div>')
				el.addClass("alert err-msg")
				el.hide()
			if(_this[0].checkValidity() == false){
				_this[0].reportValidity();
				return false;
				}
			if($('#password').val() != $('#cpassword').val()){
				el.addClass('alert-danger').text('Password does not match.')
				_this.append(el)
				el.show('slow')
				$('html,body').scrollTop(0)
				return false;
			}
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Users.php?f=save_vendor",
				data: new FormData($(this)[0]),
				cache: false,
				contentType: false,
				processData: false,
				method: 'POST',
				type: 'POST',
				dataType: 'json',
				error:err=>{
					console.error(err)
					el.addClass('alert-danger').text("An error occured");
					_this.prepend(el)
					el.show('.modal')
					end_loader();
				},
				success:function(resp){
					if(typeof resp =='object' && resp.status == 'success'){
						location.reload();
					}else if(resp.status == 'failed' && !!resp.msg){
						el.addClass('alert-danger').text(resp.msg);
						_this.prepend(el)
						el.show('.modal')
					}else{
						el.text("An error occured");
						console.error(resp)
					}
					$("html, body").scrollTop(0);
					end_loader()

				}
			})
		})
	})

</script>