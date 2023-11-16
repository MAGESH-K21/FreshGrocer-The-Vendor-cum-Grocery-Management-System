<?php
require_once('./../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `product_list` where id = '{$_GET['id']}' and delete_flag = 0 ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }else{
?>
		<center>Unknown Shop Type</center>
		<style>
			#uni_modal .modal-footer{
				display:none
			}
		</style>
		<div class="text-right">
			<button class="btn btndefault bg-gradient-dark btn-flat" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
		</div>
		<?php
		exit;
		}
}
?>

<div class="container-fluid">
	<form action="" id="product-form">
		<input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
		<input type="hidden" name ="vendor_id" value="<?= $_settings->userdata('id') ?>">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="name" class="control-label">Name</label>
					<input name="name" id="name" type="text"class="form-control form-control-sm form-control-border" value="<?php echo isset($name) ? $name : ''; ?>" required>
				</div>
				<div class="form-group">
						<label for="category_id" class="control-label">Category</label>
						<select type="text" id="category_id" name="category_id" class="form-control form-control-sm form-control-border select2" required>
							<option value="" disabled <?= !isset($category_id) ? 'selected' : "" ?>></option>
							<?php 
							$categories = $conn->query("SELECT * FROM `category_list` where delete_flag = 0 and `status` = 1 and vendor_id= '{$_settings->userdata('id')}' ".(isset($category_id) ? " or id = '{$category_id}' " : '')." order by `name` asc ");
							while($row = $categories->fetch_assoc()):
							?>
							<option value="<?= $row['id'] ?>" <?= isset($category_id) && $category_id == $row['id'] ? 'selected': '' ?>><?= $row['name'] ?></option>
							<?php endwhile; ?>
						</select>
				</div>
				<div class="form-group">
					<label for="description" class="control-label">Description</label>
					<textarea name="description" id="description" rows="4"class="form-control form-control-sm rounded-0 summernote" required><?php echo isset($description) ? html_entity_decode($description) : ''; ?></textarea>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="price" class="control-label">Cost</label>
					<input name="price" id="price" type="number" step="any" class="form-control form-control-sm form-control-border" value="<?php echo isset($price) ? $price : ''; ?>" required>
				</div>
				<div class="form-group">
					<label for="logo" class="control-label">Shop Logo</label>
					<input type="file" id="logo" name="img" class="form-control form-control-sm form-control-border" onchange="displayImg(this,$(this))" accept="image/png, image/jpeg" <?= !isset($id) ? 'required' : '' ?>>
				</div>
				<div class="form-group col-md-6 text-center">
					<img src="<?= validate_image(isset($image_path) ? $image_path : "") ?>" alt="Product Image" id="cimg" class="border border-gray img-thumbnail">
				</div>
				<div class="form-group">
					<label for="status" class="control-label">Status</label>
					<select name="status" id="status" class="custom-select selevt" required>
					<option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>Active</option>
					<option value="0" <?php echo isset($status) && $status == 0 ? 'selected' : '' ?>>Inactive</option>
					</select>
				</div>
			</div>
		</div>
		
	</form>
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
	        	$('#cimg').attr('src', '<?= validate_image(isset($image_path) ? $image_path : "") ?>');
        }
	}
	$(document).ready(function(){
		$('#uni_modal').on('shown.bs.modal',function(){
			$('#category_id').select2({
				placeholder:'Please Select Categoty Here.',
				width:"100%",
				dropdownParent:$('#uni_modal')
			})
			$('.select2-selection').addClass('form-border');
			$('.summernote').summernote({
		        height: "40vh",
		        toolbar: [
		            [ 'style', [ 'style' ] ],
		            [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
		            [ 'fontname', [ 'fontname' ] ],
		            [ 'fontsize', [ 'fontsize' ] ],
		            [ 'color', [ 'color' ] ],
		            [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
		            [ 'table', [ 'table' ] ],
		            [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
		        ]
		    })
		})
		$('#uni_modal #product-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			 if(_this[0].checkValidity() == false){
				 _this[0].reportValidity();
				 return false;
			 }
			var el = $('<div>')
				el.addClass("alert err-msg")
				el.hide()
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_product",
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