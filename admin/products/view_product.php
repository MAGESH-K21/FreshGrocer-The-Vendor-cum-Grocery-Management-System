<?php
require_once('./../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT p.*, c.name as `category`,v.code, v.shop_name as `vendor` from `product_list` p inner join category_list c on p.category_id = c.id inner join vendor_list v on p.vendor_id = v.id where p.id = '{$_GET['id']}' and p.delete_flag = 0 ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }else{
?>
		<center>Unknown Category</center>
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
<style>
	#uni_modal .modal-footer{
		display:none
	}
	#prod-img-view{
		width:15em;
		max-height:20;
		object-fit:scale-down;
		object-position: center center;
	}
</style>
<div class="container-fluid">
	<center><img src="<?= validate_image(isset($image_path) ? $image_path : "") ?>" alt="Product Image" class="img-thubmnail p-0 bg-gradient-gray" id="prod-img-view"></center>
	<dl>
		<dt class="text-muted">Vendor</dt>
        <dd class="pl-3"><?= isset($name) ? $code."-".$name : "" ?></dd>
        <dt class="text-muted">Product</dt>
        <dd class="pl-3"><?= isset($name) ? $name : "" ?></dd>
        <dt class="text-muted">Category</dt>
        <dd class="pl-3"><?= isset($category) ? $category : "" ?></dd>
		<dt class="text-muted">Price</dt>
        <dd class="pl-3"><?= isset($price) ? format_num($price) : "" ?></dd>
        <dt class="text-muted">Description</dt>
        <dd class="pl-3"><?= isset($description) ? html_entity_decode($description) : "" ?></dd>
        <dt class="text-muted">Status</dt>
        <dd class="pl-3">
            <?php if($status == 1): ?>
                <span class="badge badge-success bg-gradient-success px-3 rounded-pill">Active</span>
            <?php else: ?>
                <span class="badge badge-danger bg-gradient-danger px-3 rounded-pill">Inactive</span>
            <?php endif; ?>
        </dd>
    </dl>
	<div class="clear-fix mb-3"></div>
	<div class="text-right">
		<button class="btn btn-default bg-gradient-dark btn-sm btn-flat" type="button" data-dismiss="modal"><i class="fa f-times"></i> Close</button>
	</div>
</div>
