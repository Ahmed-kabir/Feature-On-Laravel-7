<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>{{$title}}</title>
        <link href="{{asset('admin/dist/css/styles.css')}}" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}" />

    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                                    <div class="card-body">

                                             <div class="alert alert-success" role=”alert”>
                                                    <strong>{{Session::get('success_message')}} </strong>
                                                    </div>  

                                                   

                                        <form method="post" action="{{url('/save/userinfo')}}">
                                           <!--  {{ Form::open(array('url' => '/save/userinfo', 'method' => 'post')) }} -->
                                            @csrf

                                            


                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputFirstName">First Name</label><input class="form-control py-4" id="inputFirstName" name="fname" type="text" placeholder="Enter first name" />
                                                    </div>

                                                    @error('fname')
                                                   <div class="alert alert-danger" role=”alert”>
                                                    <strong>{{ $message }}</strong>
                                                    </div>
                                                    @enderror
                                                    
                                            <!-- {{Session::get('password')}} -->
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputLastName">Last Name</label><input class="form-control py-4" id="inputLastName" name="lname" type="text" placeholder="Enter last name" /></div>

                                                    @error('lname')
                                                   <div class="alert alert-danger" role=”alert”>
                                                    <strong>{{ $message }}</strong>
                                                    </div>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="form-group"><label class="small mb-1" for="inputEmailAddress">Email</label><input class="form-control py-4" id="inputEmailAddress" name="email" type="email" aria-describedby="emailHelp" placeholder="Enter email address" /></div>

                                                    @error('email')
                                                   <div class="alert alert-danger" role=”alert”>
                                                    <strong>{{ $message }}</strong>
                                                    </div>
                                                    @enderror

                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputPassword">Password</label><input class="form-control py-4" id="inputPassword" name="password" type="password" onblur="savePassword();" placeholder="Enter password" /></div>
                                                </div>
                                               
                                                <div class="col-md-6">
                                                    <div class="form-group"><label class="small mb-1" for="inputConfirmPassword">Confirm Password</label><input class="form-control py-4" id="inputConfirmPassword" value="" name="confirm_password" type="password" onkeyup="confirmPassword();" placeholder="Confirm password" /></div>
                                                   
                                                </div>
                                            </div>
                                        

                                            <div class="form-group mt-4 mb-0"><button type="submit" class="btn btn-primary btn-block" id="register">Submit</button></div>
                                            <!-- {{ Form::close() }} -->
                                        </form>

                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="{{url('/login')}}">Have an account? Go to login</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2019</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('admin/dist/js/scripts.js')}}"></script>
    </body>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
 document.getElementById("register").disabled = true;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function savePassword() {
        var password = $('#inputPassword').val();
        console.log(password);

        var url = '{{url('/setPasswordForsession') }}'
        // alert(password);
        $.ajax({
            type:'POST',
            url:url,
            dataType:'html',
            data:{password : password},
            success:function(response) {
               
                // $("#msg").html(data.msg);
            },
            error:function (error) {
          
            }
        });
       
        };

        function confirmPassword()
        {
             var confirm_password = $('#inputConfirmPassword').val();
             console.log(confirm_password);
             var url = '{{url('/checkPasswordForsession') }}'
        // alert(password);
        $.ajax({
            type:'POST',
            url:url,
            dataType:'html',
            data:{confirm_password : confirm_password},
            success:function(data) {
              
                if(data == 'success')
                {
                     document.getElementById("register").disabled = false;
                }
                else
                {
                    inputConfirmPassword
                   document.getElementById("register").disabled = true;
                }
            },
            error:function (error) {
          
            }
        });

        }
    

    
</script>

</html>
