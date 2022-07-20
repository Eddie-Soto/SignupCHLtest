@extends('layout')

@section('title', 'Chile')



@section('content')
<div class="row">
	<div class="col-md-12 text-center mb-4">
		<img alt="logo" src="https://nikkenlatam.com/oficina-virtual/assets/images/general/logo-header-black.png" class="theme-logo">
	</div>
	<div class="menu-reg" style="width: 100%;">
		<div class="alert alert-danger" role="alert">
			<center>
				<h3>Estimado Influencer, hemos detectado que ya te has registrado anteriormente</h3>
			</center>

		</div>
<div class="alert alert-danger" role="alert">
		<center>
				<h3>En caso de no haber realizado el pago, puedes proceder a pagar</h3>
			

		<button type="button" class="btn btn-success" onclick="checkOut()">Finalizar pago</button></center>
</div>


	</div>
	<div class="alert alert-warning" role="alert"><center>
		<h5>Otra posibilidad es que tu pago se encuentre pendiente o en proceso de aprobación,
			Si tienes dudas envia un correo a <strong>servicio.chl@nikkenlatam.com</strong></h5>
			<input type="hidden" name="emailredirect" id="emailredirect" value="{{ $correo }}">
			<button type="button" class="btn btn-danger" onclick="cambia_de_pagina()">Salir</button></center>
		</div>
		<center>

		
		</div>
		@endsection
		<script src="{{asset('regchileasset/js/singup/singup.js')}}"></script>


		<script type="text/javascript">

			function cambia_de_pagina(){

				location.href="http://signup.nikkenlatam.com/";
			}

			function checkOut(){
				var email = $("#emailredirect").val();
				location.href="http://signup.nikkenlatam.com/incorporation/checkoutre?email=" + email + "&item=5006&amount=1";
			}
		</script>
