<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="/js/login.js"></script>
    <link rel="stylesheet" href="/css/login.css">

    <title>.: Casa Nova do Manso :.</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="pr-wrap">
                    <div class="pass-reset">
                        <label>Entre com o e-mail cadastrado</label>
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <input id="email" placeholder="Email" type="email" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input type="submit" value="Submit" class="pass-reset-submit btn btn-success btn-sm" />
                            x
                        </form>
                    </div>
                </div>
                <div class="wrap">
                    <p class="form-title">
                        Faça seu Login</p>
                    <form class="login" method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type="email" id="email" name="email" @error('email') is-invalid @enderror" placeholder="E-Mail" value="{{ old('email') }}" style="width: 100%" required autocomplete="email" autofocus/>
                        @error('email')
                            <div class="alert alert-danger" role="alert">
                                <small>{{ $message }}</small>
                            </div>
                        @enderror
                        <input id="password" type="password" @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"/>
                        @error('password')
                            <div class="alert alert-danger" role="alert">
                                <small>{{ $message }}</small>
                            </span>
                        @enderror
                        <input type="submit" value="Sign In" class="btn btn-success btn-sm" />
                        <div class="remember-forgot">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" />
                                            Lembrar-me
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 forgot-pass-content">
                                    <a href="javascript:void(0)" class="forgot-pass">Esqueci minha senha</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="posted-by">Cadastre-se: <a href="{{ route('register') }}">click aqui</a></div>
    </div>
</body>
</html>
