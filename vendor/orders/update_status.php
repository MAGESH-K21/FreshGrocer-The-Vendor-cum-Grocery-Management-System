<?php
require_once('./../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `order_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }else{
?>
		<center>Unknown order</center>
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
    <form action="" id="update_status">
        <input type="hidden" name="id" value="<?= isset($id) ? $id : '' ?>">
        <div class="form-group">
            <label for="status" class="control-label">Status</label>
            <select name="status" id="status" class="form-control rounded-0" required>
                <option <?= isset($status) && $status == 0 ? 'selected' : '' ?> value="0">Pending</option>
                <option <?= isset($status) && $status == 1 ? 'selected' : '' ?> value="1">Confirmed</option>
                <option <?= isset($status) && $status == 2 ? 'selected' : '' ?> value="2">Packed</option>
                <option <?= isset($status) && $status == 3 ? 'selected' : '' ?> value="3">Out for Delivery</option>
                <option <?= isset($status) && $status == 4 ? 'selected' : '' ?> value="4">Delivered</option>
                <option <?= isset($status) && $status == 5 ? 'selected' : '' ?> value="5">Cancelled</option>
            </select>
        </div>
    </form>
</div>
<script>
    $(function(){
        $('#uni_modal_second #update_status').submit(function(e){
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
				url:_base_url_+"classes/Master.php?f=update_status",
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
