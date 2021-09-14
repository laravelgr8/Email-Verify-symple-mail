<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    <script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>
    <title>User</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                @if (session('regMsg'))
                    {{session('regMsg')}}
                @endif
                <form action="{{route('user.signup')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Name : </label>
                        <input type="text" name="name" id="name" class="form-control">
                        @error('{name}')
                            {{$message}}
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Email : </label>
                        <input type="text" name="email" id="email" class="form-control">
                        @error('{email}')
                            {{$message}}
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Password : </label>
                        <input type="text" name="password" id="password" class="form-control">
                        @error('{password}')
                            {{$message}}
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Mobile : </label>
                        <input type="text" name="mobile" id="mobile" class="form-control">
                        @error('{mobile}')
                            {{$message}}
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Gender : </label>
                        <input type="radio" name="gender" id="" value="Male"> Male
                        <input type="radio" name="gender" id="" value="Female"> Female
                        @error('{gender}')
                            {{$message}}
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Qualification : </label>
                        <input type="checkbox" name="qualification[]" id="" value="MCA"> MCA
                        <input type="checkbox" name="qualification[]" id="" value="BCA"> BCA
                        <input type="checkbox" name="qualification[]" id="" value="B.Tech"> B.Tech
                    </div>

                    <div class="form-group">
                        <label for="">Image : </label>
                        <input type="file" name="pic" id="pic" class="form-control">
                    </div>
                    <input type="submit" value="signup" class="btn btn-success">
                </form>
            </div> <!--end user create -->

            {{-- for login --}}
            <div class="col-xl-6">
                @if (session('loginMsg'))
                    {{session('loginMsg')}}
                @endif
                <form action="{{route('user.login')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Email : </label>
                        <input type="text" name="email" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Password : </label>
                        <input type="text" name="password" id="" class="form-control">
                    </div>
                    <input type="submit" value="login" class="btn btn-info">
                </form>
            </div>
        </div>
    </div>
</body>
</html>