@extends('layout')

@section('title', 'Registro')

@section('content')

<div class="row" class="tooltip-section">
    <div class="col-md-12 text-center mb-4">
        <img alt="logo" src="https://nikkenlatam.com/oficina-virtual/assets/images/general/logo-header-black.png" class="theme-logo">
        <img alt="logo" src="{{asset('regchileasset/img/chile.png')}}" width="5%">
    </div>
    <br>
    <div class="row layout-spacing col-md-12">
        <div class="container">
            <ol class="breadcrumb breadcrumb-arrow">
                <li><a href="../../../">{{ __('auth.get_started') }}</a></li>
                <li><a href="javascript:void(0)">{{ __('auth.profile') }}</a></li>
                <li class="confirmation"><span>{{ __('auth.confirmation') }}</span></li>
            </ol>
        </div>
    </div>

    <div class="alert alert-info col-md-12 text-justify" role="alert" id="profileAltert">
        {{ __('auth.alert') }}
    </div>
    <div class="alert alert-info col-md-12 text-justify" role="alert" id="profileAltert">
        {{ __('auth.rquired') }}
    </div>
    <div class="alert alert-info col-md-12 text-justify" role="alert" id="confirmationAltert" style="display: none">
        {{ __('auth.alertConfirmation') }} <br><br> {{ __('auth.alertConfirmation2') }}
    </div>


    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
    <div class="col-lg-12">
        <div class="statbox widget box box-shadow">
            <div class="widget-header widget-heading">
                <br>
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12 text-center">
                        <h4>{{ __('auth.applicant') }}</h4>
                    </div>
                    <hr>
                </div>
                <br>
            </div>
        </div>
    </div>
    <form action="/savekit" method="get" id="formProfile" class="form-control" border="none" onKeypress="if(event.keyCode == 13) event.returnValue = false;">
        <div class="row">
            <div class="col-md-12">


                <label for="country"><span style="color: red !important;">*</span> <b>{{ __('auth.country') }}</b></label>
                <select class="form-control" name="country" id="country" readonly="readonly">
                    <option></option>
                    <option value="10" selected readonly="readonly">Chile</option>
                </select>
            </div>
        </div>
        <br>

        <!--CAMBIO MENSAJE CHILE-->
        <div class="row">
            <div class="col-md-12" id="cborabitxt">
                <div class='alert alert-info' role='alert'>Si has seleccionado Asesor de Bienestar, y desarrollarás el Negocio, elige algunas de estas opciones de tipo de persona según sea tu caso!</div>
            </div>
        </div>
        
        <div class="row" align="center" >
            <div class="col-md-6 form-group" align="center">

                <label for="type_inc" align="center"><span style="color: red !important;">*</span> <b>{{ __('auth.abi') }}</b></label>
                <input type="radio" name="type_inc" id="type_inc1" value="1" onclick="cl_or_abi(this.value)" checked="true" >




            </div>
            <!-- Se comento este div y se modifico el col de arriba solo durante el cambio hasta el 15 de diciebre -->
            <div class="col-md-6 form-group" align="center" hidden="true">

             <label for="type_inc" align="center"><span style="color: red !important;">*</span> <b>{{ __('auth.cb') }}</b></label>
             <input type="radio" name="type_inc" id="type_inc2" value="0" onclick="cl_or_abi(this.value)" disabled="true">

         </div>


     </div>

     <div class="row" >
         <div class="col-md-12" id="kits" >
             <label for="kit"><span style="color: red !important;">*</span> <b>Selecciona Tu Kit de Inicio</b></label>
                <select class="form-control" name="kit" id="kit" onchange="Ocultar_playeras()"  >
                    <option value="">Selecciona un Kit de inicio</option>
                     <option value="5002" selected="true">5002 KIT 1 USD</option> 
                </select>
         </div>
     </div>
<br>
     <div class="row">
         <div class="col-md-12">
          <div class="alert alert-danger" role="alert">
            <center><strong><p>{{ __('auth.tabs') }}</p></strong></center>
        </div>
    </div>
</div>

<div class="row">
   <div class="col-md-6">
      <label for="type_per"><span style="color: red !important;">*</span> <b>{{ __('auth.type_per') }}</b></label>
      <select id="type_per" name="type_per" class="form-control" onchange="type_person(this.value)">
        <option value=""></option>
        <option value="1">{{ __('auth.pernat') }}</option>
        <option value="2">{{ __('auth.pernatint') }}</option>
        <option value="0">{{ __('auth.perjur') }}</option>
    </select>
</div>
<div class="col-md-6">
    <label for="date_born"><span style="color: red !important;">*</span> <b>{{ __('auth.birthDate') }}</b></label>
    <input type="text" id="date_born"  name="date_born"  data-min="1909-01-01" data-max="2019-11-01" onblur="validate_birthdate(this.value)" class="form-control">
</div>
</div>

<div class="row">
    <div class="col-md-12" id="jur">
        <label for="name_titular"><span style="color: red !important;">*</span> <b>{{ __('auth.name_titular') }}</b></label>
        <input type="text" id="name_titular" name="name_titular" class="form-control">
    </div>
    <div class="col-md-12" id="jur1">
        <label for="name_titular_ape"><span style="color: red !important;">*</span> <b>{{ __('auth.name_titular_ape') }}</b></label>
        <input type="text" id="name_titular_ape" name="name_titular_ape" class="form-control">
    </div>

    <div class="col-md-12" hidden="true" id="r_soc">
        <label for="name_titular_jur"><span style="color: red !important;">*</span> <b>{{ __('auth.razon') }}</b></label>
        <input type="text" id="name_titular_jur" name="name_titular_jur" class="form-control">
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <label for="socio_econ"><span style="color: red !important;">*</span> <b>{{ __('auth.socio_econ') }}</b></label>
        <input type="text" id="socio_econ" name="socio_econ" class="form-control">
    </div>
</div>

<div class="row">
    <div class="col-md-6" id="mail">
        <label for="email"><span style="color: red !important;">*</span> <b>{{ __('auth.email') }}</b></label>
        <input type="text" id="email" name="email" onblur="validateMail()" class="form-control">
    </div>
    <!--div class="col-md-6" id="mail">
      <label for="email"><span style="color: red !important;">*</span> <b>{{ __('auth.email') }}</b></label>
      <input type="text" id="email" name="email" onblur="validateMailSql()" class="form-control">
  </div-->
  <div class="col-md-6" id="gender">
      <label for="gender"><span style="color: red !important;">*</span> <b>{{ __('auth.gender') }}</b></label>
      <select id="gender1" name="gender" class="form-control" onchange="getDataShirt()">
        <option value="">{{ __('auth.selreg') }}</option>
         <option value="M">{{ __('auth.gender_opc_one') }}</option>
         <option value="F">{{ __('auth.gender_opc_two') }}</option>
     </select>
 </div>
</div>

<div class="row">
    <div id="cel_natural" class="col-lg-12">
        <label for="cel"><b>{{ __('auth.celPhone') }}</b></label>
        <input type="text" id="cel" name="cel" class="form-control">
    </div>
    <div id="cel_juridica" class="col-lg-12" hidden="true">
        <label for="cel_jur"><b>{{ __('auth.celPhoneJur') }}</b></label>
        <input type="text" id="cel_jur" name="cel_jur" class="form-control">
    </div>
</div>

<!--CHILE CHANGUE CIUDAD-->
<div class="row">
    <div class="col-md-3">
        <label for="postal_code"> <b>{{ __('auth.cp') }}</b></label>
        <input type="text" id="postal_code" name="postal_code" class="form-control">
    </div>
    <div class="col-md-3">
        <label for="region"><span style="color: red !important;">*</span> <b>{{ __('auth.reg') }}</b></label>
        <select id="region"  name="region" class="form-control" onchange="getCities()">
           {{-- <option value="" selected>{{ __('auth.selreg') }}</option>--}}
       </select>
   </div>

   <div class="col-md-3">
      <label for="ciudad"><span style="color: red !important;">*</span> <b>{{ __('auth.ciu') }}</b></label>
      <select id="ciudad" name="ciudad" class="form-control" onchange="getCiudades()">
       {{-- <option value="" selected>{{ __('auth.selreg') }}</option>--}}
   </select>
</div>
<div class="col-md-3">
    <label for="comuna"><span style="color: red !important;">*</span> <b>{{ __('auth.com') }}</b> </label>
    <select id="comuna" name="comuna" class="form-control">
        {{--<option value="" selected="">{{ __('auth.selreg') }}</option>--}}
    </select>
</div>

</div>
<!--CHILE CHANGUE CIUDAD-->

<div class="row">
    <div class="col-md-8">
        <label for="street"><span style="color: red !important;">*</span> <b>{{ __('auth.street') }}</b></label>
        <input type="text" id="street" name="street" class="form-control">
    </div>
    <div class="col-md-4">
        <label for="number"><span style="color: red !important;">*</span> <b>{{ __('auth.number') }}</b></label>
        <input type="text" id="number" name="number" class="form-control">
    </div>
</div>


<!--div class="row">
    <div class="col-md-12" id="rut_natural">
        <label for="rut_nat"><span style="color: red !important;">*</span> <b>{{ __('auth.rut') }}</b></label>
        <input type="text" id="rut_nat" name="rut_nat" class="form-control">
    </div>
    <div class="col-md-12" id="rut_juridica" hidden="true">
        <label for="rut"><span style="color: red !important;">*</span> <b>{{ __('auth.rutJur') }}</b></label>
        <input type="text" id="rut" name="rut" class="form-control">
    </div>
</div-->

<div class="row">
    <div class="col-md-12" id="rut_natural">
        <label for="rut_nat"><span style="color: red !important;">*</span> <b>{{ __('auth.rut') }}</b></label>
        <input type="text" id="rut_nat" name="rut_nat" onblur="isValidRUT()" class="form-control">
    </div>
    <div class="col-md-12" id="rut_juridica" hidden="true">
        <label for="rut"><span style="color: red !important;">*</span> <b>{{ __('auth.rutJur') }}</b></label>
        <input type="text" id="rut" name="rut" class="form-control" onblur="isValidRUTn()">
    </div>
</div>


<div class="row">
	<div class="col-md-12" id="name_titular_two_div" hidden="">
		<label for="name_titular_two"><span style="color: red !important;">*</span> <b>{{ __('auth.name_titular') }}</b></label>
		<input type="text" id="name_titular_two" name="name_titular_two" class="form-control">
	</div>
</div>



    
    <div class="col-md-6" class="form-control" id="shirt-sample">
        <input type="hidden" name="boleto" id="boleto" value="{{ $boletokit }}">
    </div>

   
    




<br>

<section id="abi" hidden="true">
    @include('KitUSD.asesorkit')
</section>

<div class="row">
	<div class="col-sm-12">
		<label id="option-sponsor-one"><input type="radio" id="opc1" value="1" name="type_sponsor" onclick="Opacity_type_sponsor(this.value);"   checked="true">&nbsp;<strong>{{ __('auth.type_sponsor_one') }}</strong><br/><small>{{ __('auth.type_sponsor_ones') }}</small></label>
		<div class="row">
           
                <div class="col-sm-5">
                     <div class="form-group">
                      <input type="text" class="form-control input-sponsor" name="sposortwo" placeholder="Ingresa aquí el código aquí" value="{{ $sponsorkit }}" disabled="true">
                    <input type="hidden"  class="form-control input-sponsor" name="code-sponsor" id="code-sponsor" placeholder="Ingresa aquí el código aquí" onblur="CodeBien()" onkeyup="Search_sponsor(this.value)" onchange ="Validate_sponsor_exist()" onclick="SponsorRadio()" value="{{ $sponsorkit }}" >
                    <div id="demo"></div>

                    <input type="hidden" class="form-control required input-validator-sponsor" id="code-sponsor-validate">
                </div>
                    <!--div class="form-group">
                       <input type="text"  class="form-control input-sponsor" name="code-sponsor" id="code-sponsor" placeholder="Ingresa aquí el código aquí" onkeyup="Search_sponsor(this.value)" onchange ="Validate_sponsor_exist()">

                       <input type="hidden" class="form-control required input-validator-sponsor" id="code-sponsor-validate">
                   </div-->
               </div>
               <div class="col-sm-7">
                <div class="form-group">
                   <div id="view-name-sponsor" class="margin-sponsor"></div>
               </div>
           </div>
       </div>


       <div class="row">
          <div class="col-sm-12">
             <label id="option-sponsor-three"><input type="radio" value="3"  name="type_sponsor" id="option-sponsor-2" onclick="Opacity_type_sponsor(this.value);" disabled="true" >&nbsp;<strong>{{ __('auth.type_sponsor_three') }}</strong><br/><small>{{ __('auth.type_sponsor_threes') }}</small></label>
         </div>
     </div>
 </div>
</div>
<div class="row" align="center">
	<div class="col-lg-6">
       <div class="alert alert-dismissible fade show" role="alert" style="color: #fff; background-color: #A2DADA !important;border-color: #A2DADA !important;">
        <strong>
            <div class="custom-control custom-checkbox mr-3">
                <label for="terms" class="switch s-icons s-outline s-outline-info" style="margin-left: 20px !important;">
                    <input type="checkbox" name="terms" id="terms" onclick="CodeBien()">
                    <span class="slider round"></span>
                </label>
                <br>
                <a href="https://storage.googleapis.com/vivenikken/pdf/others/Regional/Terms%20and%20conditions.pdf" target="_blank">
                    <label><u style="text-decoration: none; border-bottom: 1px solid black;">{{ __('auth.terms') }}</u></label></a>
                </div>
            </strong>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="alert alert-dismissible fade show" role="alert" style="color: #fff; background-color: #A2DADA !important;border-color: #A2DADA !important;">
            <strong>
                <div class="custom-control custom-checkbox mr-3">
                    <label for="privacy_policy" class="switch s-icons s-outline s-outline-info" style="margin-left: 20px !important;">
                        <input type="checkbox" name="privacy_policy" id="privacy_policy">
                        <span class="slider round"></span>
                    </label>
                    <br>
                    <a href="{{ asset('regchileasset/Politicas_Chile.pdf') }}"  target="_blank">
                        <label><u style="text-decoration: none; border-bottom: 1px solid black;">{{ __('auth.privacy_policy') }}</u></label></a>
                    </div>
                </strong>
            </div>
        </div>

    </div>
    <div class="row" align="center">
       <div class="col-lg-12">
        <div class="alert alert-dismissible fade show" role="alert" style="color: #fff; background-color: #A2DADA !important;border-color: #A2DADA !important;">
            <strong>
                <div class="custom-control custom-checkbox mr-3">
                    <label for="declare" class="switch s-icons s-outline s-outline-info" style="margin-left: 20px !important;">
                        <input type="checkbox" name="declare" id="declare">
                        <span class="slider round"></span>
                    </label>
                    <br>
                    <label>{{ __('auth.declare') }}</label>
                </div>
            </strong>
        </div>
    </div>
</div>
<div style="text-align: center !important;" class=" form-group col-md-12">
    <br>
    
    <button type="submit" class="btn btn-info" onclick="validations()" id="btnProfile">{{ __('auth.next') }}</button>
</div>
</div>
<div style="text-align: right !important;" class=" form-group col-md-12">
    <input type="hidden" id="alertDuplicateMail" value="{{ __('auth.alertDuplicateMail') }}" readonly>
    <input type="hidden" id="terminos" value="{{ __('auth.terminos') }}" readonly>
    <input type="hidden" id="privacy_policy_acept" value="{{ __('auth.privacy_policy_acept') }}" readonly>
    <input type="hidden" id="alertHeigtAge" value="{{ __('auth.alertHeigtAge') }}" readonly>
    <input type="hidden" id="declare_acept" value="{{ __('auth.declare_acept') }}" readonly>
    <input type="hidden" id="rquired" value="{{ __('auth.rquired') }}" readonly>
    <input type="hidden" id="code_no_exist" value="{{ __('auth.code_no_exist') }}" readonly>
    <input type="hidden" id="loginError" value="{{ __('auth.loginError') }}" readonly>
    <input type="hidden" id="alertSponsorId" value="{{ __('auth.alertSponsorId') }}" readonly>
    <input type="hidden" id="alertMailInvalid" value="{{ __('auth.alertMailInvalid') }}" readonly>
        <!--CHILE CHANGUE CIUDAD-->
    <input type="hidden" id="selreg" value="{{ __('auth.selreg') }}" readonly>
    <!--CHILE CHANGUE CIUDAD-->
    <input type="hidden" id="completeDate" value="{{ __('auth.completeDate') }}" readonly>
    <label id="cargando" name="cargando" style="display: none"> {{ __('auth.labelLoad') }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>

</div>
</form>

<script type="text/javascript">

/**
* Función que muestra los campos dependiendo el tipo de incorporación
*/
function cl_or_abi(value){
    if(value == "1"){
        document.getElementById('abi').setAttribute('hidden',true);
        document.getElementById('abi').removeAttribute('hidden',true);
        div_texto_club_or_abi =  document.getElementById('cborabitxt');

        div_texto_club_or_abi.innerHTML = "<div class='alert alert-info' role='alert'>Si has seleccionado Asesor de Bienestar, y desarrollarás el Negocio, elige algunas de estas opciones de tipo de persona según sea tu caso!</div>";

    }else if(value == "0"){
        document.getElementById('abi').removeAttribute('hidden',true);
        document.getElementById('abi').setAttribute('hidden',true);

        div_texto_club_or_abi =  document.getElementById('cborabitxt');

    div_texto_club_or_abi.innerHTML = "<div class='alert alert-info' role='alert'>Si eres Empresa y no desarrollarás  Negocio, debes registrarte como Club de Bienestar ( Recibes factura).</div>";
    
    }
}
cl_or_abi(1);


</script>


@endsection

