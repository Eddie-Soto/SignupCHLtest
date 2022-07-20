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
  <h4>Hemos detectado que te preregistraste y este formulario es para personas que no hicieron preregistro. Esto lo detectamos porque tu correo existe como preregistro. Te invitamos a que uses la página de preregistro </h4><a href="http://chile.nikkenlatam.com/profile/ch/spa" class="btn btn-info">AQUI</a><h4> Si no recuerdas tus datos de usuario o contraseña en la página de preregistro podrás solicitar tus datos de nuevo con tu correo registrado</h4>
  </center>
</div>


    </div>
</div>
@endsection
<script src="{{asset('regchileasset/js/singup/singup.js')}}"></script>
