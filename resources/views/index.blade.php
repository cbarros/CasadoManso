<!DOCTYPE HTML>
<html>
	<head>
		<title>Presentes da Casa do Manso</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
		<link rel="stylesheet" href="{{ asset('css/main.css') }}" />
		<noscript><link rel="stylesheet" href="{{ asset('css/noscript.css') }}" /></noscript>
	</head>
	<body class="is-preload">
        <div class="row">
            <div class="col-12">
                <center>
                @if ( Session::has('success') )
                    <div class="alert alert-success">
                        {!! Session::get('success') !!}
                    </div>
                @endif
                @if ( Session::has('error') )
                    <div class="alert alert-danger">
                        {!! Session::get('error') !!}
                    </div>
                @endif
                </center>
            </div>
        </div>
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
                        <h1>Casa do Manso</h1>

						<nav>
							<ul>
								<li><a href="#footer" class="icon solid fa-info-circle">Saiba Mais</a></li>
							</ul>
						</nav>
					</header>

				<!-- Main -->
					<div id="main">
                        @foreach ($produtos as $item)
                            <article class="thumb">
                                <a href="{{ $item->url }}" class="image">
                                    <img src="{{ $item->url }}" alt="" />
                                </a>
                                <h2>{{ $item->name }}</h2>


                                @if(isset($item->user_id))

                                    <button type="submit" class="btn primary @if(Auth::user()->id != $item->user_id) disabled @endif" onclick="Cancelar({{ $item->id }})">Cancelar Reserva</button>
                                    <p>Presente já reservado em {{ date('d/m/Y', strtotime($item->confirmado)) }} por {{ $item->usuario }}.</p>
                                @else
                                    <button type="submit" class="btn primary" onclick="Salvar({{ $item->id }})">Reservar</button>
                                    <p>Click no botão para reservar o presente!</p>
                                @endif
                            </article>
                        @endforeach

					</div>

				<!-- Footer -->
					<footer id="footer" class="panel">
						<div class="inner split">
							<div>
								<section>
									<h2>Regras e Informações</h2>
									<p>Site desenvolvido para mostrar quais serão os presentes </p>
								</section>
								<section>
									<h2>Follow me on ...</h2>
									<ul class="icons">
										<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
										<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
										<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
										<li><a href="#" class="icon brands fa-github"><span class="label">GitHub</span></a></li>
										<li><a href="#" class="icon brands fa-dribbble"><span class="label">Dribbble</span></a></li>
										<li><a href="#" class="icon brands fa-linkedin-in"><span class="label">LinkedIn</span></a></li>
									</ul>
								</section>
								<p class="copyright">
									&copy; Desenvolvido por: <a href="http://databuilderti.com.br">Data Builder Tecnologia da Informação</a>.
								</p>
							</div>
							<div>
								<section>
									<h2>Envie uma mensagem</h2>
									<form method="post" action="{{ action('App\Http\Controllers\ProdutosController@email') }}">
                                        {{  csrf_field() }}
										<div class="fields">
											<div class="field half">
												<input type="text" name="nome" id="nome" placeholder="Informe o seu nome" required/>
											</div>
											<div class="field half">
												<input type="text" name="email" id="email" placeholder="E-Mail" required/>
											</div>
											<div class="field">
												<textarea name="mensagem" id="mensagem" rows="4" placeholder="Mensagem" required></textarea>
											</div>
										</div>
										<ul class="actions">
											<li><input type="submit" value="Enviar" class="primary" /></li>
											<li><input type="reset" value="Cancelar" /></li>
										</ul>
									</form>
								</section>
							</div>
						</div>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="{{ asset('js/jquery.min.js') }}"></script>
			<script src="{{ asset('js/jquery.poptrox.min.js') }}"></script>
			<script src="{{ asset('js/browser.min.js') }}"></script>
			<script src="{{ asset('js/breakpoints.min.js') }}"></script>
			<script src="{{ asset('js/util.js') }}"></script>
			<script src="{{ asset('js/main.js') }}"></script>
            <script type='text/javascript'>
                function Salvar(id)
                {
                    var url = "{{ URL::to('/') }}";
                    console.log(url);
                    console.log('estou aqui! ' + id);
                    window.location.href = "reserva/" + id;
                }
                function Cancelar(id)
                {
                    var url = "{{ URL::to('/') }}";
                    window.location.href = "cancela/" + id;
                }
            </script>
	</body>
</html>
