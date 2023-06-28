<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>
    <h2>Մուտք Գործել</h2>
    <div class="login_container">
        <form method="post">
            <input type="email" name="email" class="email" placeholder="Enter email">
            <input type="password" name="password" class="password" placeholder="Enter password">
        </form>
        <button name="action" class="login" value="submit">log In</button>
    </div>

    <div class="alert alert-success" role="alert" style="display:none;"></div>
    <div class="alert alert-danger" role="alert" style="display:none;" ></div>

   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
   <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

        <script type="text/javascript">
            $(function(){
                $('.login').click(function(){
                    let email = $('.email').val();
                    let password = $('.password').val();
                    $.ajax({
                        url:'../controller/loginController.php',
                        method:'post',
                        // type:'post',
                        dataType:'json',
                        data:{
                            email,
                            password,
                            action:'login'
                        },
                        success:function(data){
                            if(data['Action'] == '1'){
                                $('.alert-success').html(data['message']);
                                $('.alert-success').fadeIn();
                                $('.alert-success').fadeOut(2500);
                                setTimeout(function(){
                                    location.href='../index.php';
                                },3000);
                            }else{
                                $('.alert-danger').html(data['message']);
                                $('.alert-danger').fadeIn();
                                $('.alert-danger').fadeOut(2500);
                                 setTimeout(function(){
                                    location.reload();
                                },3000);
                            }
                        }
                    })
                })
            })
        </script>
  
</body>
</html>