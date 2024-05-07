<div class="app d-flex">
    <div class="login-content d-flex">  
        <div class="background my-auto py-5">
            <form class="px-3 p-3" action="<?php echo base_url() ?>auth/login"  method="post">

                <div class="text-center">
                    <h1 class="text-purple">Jobseeker</h1>
                    <h4 class="text-purple">Login</h4>
                </div>

                <?php if(isset($error)) { ?>
                <div id="authfail" class="alert alert-danger my-3 p-3 rounded alert-dismissible fade show" role="alert">
                    <strong class="pr-3">
                        <?php echo $error; ?>
                    </strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php } ?>

                <label>Email</label>
                <div class="box" >
                    <i class="fa-solid fa-user mr-3 text-purple"></i>
                    <input id="email" type="email" name="email" >
                </div>
                <label>Password </label>
                <div class="box d-flex align-items-center justify-content-between" id="box">
                    <i class="fa-solid fa-key mr-2 text-purple"></i>
                    <input type="password" name="password" id="password" >
                    <a class="showOrHide show"> <i class="fa-regular fa-eye-slash text-purple" style="font-size: 15px !important; cursor: pointer"></i></a>
                </div>
                
                <button type="submit" name="Login" value="Login" class="btn btn-purple masuk">LOGIN </button>

		        <div class="mt-3 text-center text-secondary"><i>email: test@mail.com and password: test123 </i></div>

            </form>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.showOrHide').on('click', function(){
            if ($(this).hasClass('show')) {
                $(this).removeClass('show').addClass('hide')
                $(this).prev('input').attr('type','text')
                $(this).html('<i class="far fa-eye text-purple" style="font-size: 16px !important; cursor: pointer"></i>');
            }else{
                $(this).removeClass('hide').addClass('show')
                $(this).prev('input').attr('type','password')
                $(this).html('<i class="far fa-eye-slash text-purple" style="font-size: 16px !important; cursor: pointer"></i>');
            }
        });

        // prefent form resubmission
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    });
</script>
