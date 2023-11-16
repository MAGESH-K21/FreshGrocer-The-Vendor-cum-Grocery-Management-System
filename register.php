<?php require_once('./config.php') ?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
 <?php require_once('inc/header.php') ?>
<body class="hold-transition">
  <script>
    start_loader()
  </script>
  <style>
      html,body{
          height: calc(100%);
          width: calc(100%);
      }
      body{
          width:calc(100%);
          height:calc(100%);
          background-image:url('<?= validate_image($_settings->info('cover')) ?>');
          background-repeat: no-repeat;
          background-size:cover;
      }
      #logo-img{
          width:15em;
          height:15em;
          object-fit:scale-down;
          object-position:center center;
      }
      #system_name{
        color:#fff;
        text-shadow: 3px 3px 3px #000;
      }
      #cimg{
          width:200px;
          height:200px;
          object-fit:scale-down;
          object-position:center center
      }
  </style>
  <script>
  </script>
  <div class="d-flex justify-content-center align-items-center flex-row h-100">
        <div class="col-5">
            <center><img src="<?= validate_image($_settings->info('logo')) ?>" alt="System Logo" class="img-thumbnail rounded-circle" id="logo-img"></center>
            <h1 class="text-center" id="system_name"><?= $_settings->info('name') ?></h1>
        </div>
        <div class="col-7 h-100 bg-gradient-light px-4">
            <div class="d-flex justify-content-center align-items-center w-100 h-100">
                <div class="card card-outline card-primary col-12 rounded-0 shadow">
                    <div class="card-header text-center">
                    <a href="./register.php" class="h1"><b>Create an Account</b></a>
                    </div>
                    <div class="card-body">
                    <p class="login-box-msg">Sign in to start your session</p>

                    <form id="cregister-frm" action="" method="post">
                        <input type="hidden" name="id">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="firstname" class="control-label">First Name</label>
                                <input type="text" id="firstname" autofocus name="firstname" class="form-control form-control-sm form-control-border" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="middlename" class="control-label">Middle Name</label>
                                <input type="text" id="middlename" name="middlename" class="form-control form-control-sm form-control-border" placeholder="optional">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="lastname" class="control-label">Last Name</label>
                                <input type="text" id="lastname" name="lastname" class="form-control form-control-sm form-control-border" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="gender" class="control-label">Gender</label>
                                <select type="text" id="gender" name="gender" class="form-control form-control-sm form-control-border select2" required>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="contact" class="control-label">Contact #</label>
                                <input type="text" id="contact" name="contact" class="form-control form-control-sm form-control-border" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="address" class="control-label">Address</label>
                                <textarea rows="3" id="address" name="address" class="form-control form-control-sm rounded-0" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="email" class="control-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control form-control-sm form-control-border" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="password" class="control-label">Password</label>
                                <div class="input-group input-group-sm">
                                    <input type="password" id="password" name="password" class="form-control form-control-sm form-control-border" required>
                                    <div class="input-group-append bg-transparent border-top-0 border-left-0 border-right-0 rounded-0">
                                        <span class="input-group-text bg-transparent border-top-0 border-left-0 border-right-0 rounded-0">
                                            <a href="javascript:void(0)" class="text-reset text-decoration-none pass_view"> <i class="fa fa-eye-slash"></i></a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="cpassword" class="control-label">Confirm Password</label>
                                <div class="input-group input-group-sm">
                                    <input type="password" id="cpassword" class="form-control form-control-sm form-control-border" required>
                                    <div class="input-group-append bg-transparent border-top-0 border-left-0 border-right-0 rounded-0">
                                        <span class="input-group-text bg-transparent border-top-0 border-left-0 border-right-0 rounded-0">
                                            <a href="javascript:void(0)" class="text-reset text-decoration-none pass_view"> <i class="fa fa-eye-slash"></i></a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="logo" class="control-label">Image</label>
                                <input type="file" id="logo" name="img" class="form-control form-control-sm form-control-border" onchange="displayImg(this,$(this))" accept="image/png, image/jpeg" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 text-center">
                                <img src="<?= validate_image('') ?>" alt="Shop Logo" id="cimg" class="border border-gray img-thumbnail">
                            </div>
                        </div>
                        <div class="row align-item-end">
                            <div class="col-8">
                                <a href="<?= base_url ?>">Back to Site</a>
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">Create Account</button>
                            </div>
                            <div class="col-12 text-center">
                            <a href="<?= base_url.'./login.php' ?>">Already have an Account</a>
                            </div>
                        <!-- /.col -->
                        </div>
                    </form>
                    <!-- /.social-auth-links -->

                    <!-- <p class="mb-1">
                        <a href="forgot-password.html">I forgot my password</a>
                    </p> -->
                    
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            
        </div>
  </div>


<!-- jQuery -->
<script src="<?php echo base_url ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<!-- <script src="<?php echo base_url ?>dist/js/adminlte.min.js"></script> -->
<!-- Select2 -->
<script src="<?php echo base_url ?>plugins/select2/js/select2.full.min.js"></script>

<script>
    function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }else{
	        	$('#cimg').attr('src', '<?= validate_image('') ?>');
        }
	}
  $(function(){
    end_loader();
    $('body').height($(window).height())
    $('.select2').select2({
        placeholder:"Please Select Here",
        width:'100%'
    })
    $('.select2-selection').addClass("form-border")
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

    $('#cregister-frm').submit(function(e){
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
            url:_base_url_+"classes/Users.php?f=save_client",
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
                    location.href= './login.php';
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
</body>
</html>