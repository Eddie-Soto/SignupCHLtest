@extends('layoutretomar')

@section('title', 'Retomar')

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
    <form action="/update" method="get" id="formProfile" class="form-control" border="none" onKeypress="if(event.keyCode == 13) event.returnValue = false;">
        <div class="row">
            <div class="col-md-12">

              <input type="hidden" id="idusers" name="idusers" value="{{ $users->id }}">
              <input type="hidden" id="idcontrolci" name="idcontrolci" value="{{ $control_ci_id->idcontrol_ci }}">
              <input type="hidden" id="contrato" name="contrato" value="{{ $contracts->id_contract }}">
              <input type="hidden" id="codigo" name="codigo" value="{{ $contracts->code }}">
              <input type="hidden" id="sponsor" name="sponsor" value="{{ $contracts->sponsor }}">

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
        
        <div class="row" align="center">
            <div class="col-md-6 form-group" align="center">

                <label for="type_inc" align="center"><span style="color: red !important;">*</span> <b>{{ __('auth.abi') }}</b></label>
                <input type="radio" name="type_inc" id="type_inc1" value="1" onclick="cl_or_abi(this.value)" @if ($contracts->type == 1)
  checked="true" 
@endif
@if ($contracts->type == 0)
  disabled="true" 
@endif>




            </div>
            <!-- Se comento este div y se modifico el col de arriba solo durante el cambio hasta el 15 de diciebre -->
            <div class="col-md-6 form-group" align="center">

             <label for="type_inc" align="center"><span style="color: red !important;">*</span> <b>{{ __('auth.cb') }}</b></label>
             <input type="radio" name="type_inc" id="type_inc2" value="0" @if ($contracts->type == 0)
                  checked="true"
@endif onclick="cl_or_abi(this.value)"@if ($contracts->type == 1)
  disabled="true" 
@endif>

         </div>


     </div>
     <div class="row" >
         <div class="col-md-12" id="kits-cb" @if ($contracts->type == 1)
                        hidden="true" 
                        @endif>
             <label for="kit"><span style="color: red !important;">*</span> <b>Selecciona Tu Kit de Inicio</b></label>
                <select class="form-control" name="kit-cb" id="kit-cb" onchange="Ocultar_playeras()" disabled="true">
                    <option value="">Selecciona un Kit de inicio</option>
                    <option value="5031" @if ($contracts->kit == 5031)
                        selected="true" @endif >5031 KIT MIEMBRO DE LA COMUNIDAD $0.00</option>
                    <option value="5032" @if ($contracts->kit == 5032)
                        selected="true" @endif >5032 Inscripción con Alcancía Electrónica $800.00</option>
                    @if ($contracts->kit == 5032 || $contracts->kit == 5031)
                <input type="hidden" name="kit-club" id="kit-club" value="{{ $contracts->kit }}">
                @endif
                </select>

         </div>
     </div>


     
     <div class="row" @if ($contracts->type == 0)
                        hidden="true" 
                        @endif>
         <div class="col-md-12" id="kits">
             <label for="kit"><span style="color: red !important;">*</span> <b>Selecciona Tu Kit de Inicio</b></label>
                <select class="form-control" name="kit" id="kit" onchange="Ocultar_playeras()" @if ($contracts->kit == 5002)
                        disabled="true"
                        @endif>
                    {{ $contracts->kit }}
                    <option value="">Selecciona un Kit de inicio</option>
                    <option value="5006" @if ($contracts->kit == 5006)
                        selected="true" 
                        @endif >5006 KIT CLÁSICO $81,044.00
                    </option>
                    <option value="5023" @if ($contracts->kit == 5023)
                        selected="true" 
                        @endif>5023 KIT INFLUENCER  PI WATER $176,200.00</option>
                    <option value="5024" @if ($contracts->kit == 5024)
                        selected="true" 
                        @endif>5024 KIT INFLUENCER  WATERFALL $382,300.00</option>
                    <option value="5025" @if ($contracts->kit == 5025)
                        selected="true" 
                        @endif>5025 KIT INFLUENCER  PAQUETE PI WATER+ OPTIMIZER $465,500.00</option>
                    <option value="5026" @if ($contracts->kit == 5026)
                        selected="true" 
                        @endif>5026 KIT INFLUENCER  PAQUETE WATERFALL + OPTIMIZER $645,800.00</option> 
                    <option value="5027" @if ($contracts->kit == 5027)
                        selected="true" 
                        @endif>5027 KIT INFLUENCER  + PIMAG OPTIMIZER $310,600.00</option> 
                    <option value="5028" @if ($contracts->kit == 5028)
                        selected="true" 
                        @endif>5028 KIT INFLUENCER AQUA POUR DELUXE $296,200.00</option>

                    <option value="5002" @if ($contracts->kit == 5002)
                        selected="true"
                        @endif>5002 KIT ONE USD $1.00</option>  
                </select>
                @if ($contracts->kit == 5002)
                <input type="hidden" name="kitoneusd" id="kitoneusd" value="{{ $contracts->kit }}">
                @endif
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
        <option value="1" @if ($contracts->type_incorporate == 1)
                        selected="true" 
                        @endif>{{ __('auth.pernat') }}</option>
        <option value="2" @if ($contracts->type_incorporate == 2)
                        selected="true" 
                        @endif>{{ __('auth.pernatint') }}</option>
        <option value="0" @if ($contracts->type_incorporate == 0)
                        selected="true" 
                        @endif>{{ __('auth.perjur') }}</option>
    </select>
</div>
        @php

         
            if($contracts->bank != 0 && $contracts->bank_type != 0){
              $banco=$contracts->bank;
              $tarjet_type=$contracts->bank_type;
              
                if ($tarjet_type == 20 || $tarjet_type == '20') {
                    $tipo_tarjeta="Ahorros";
                }elseif ($tarjet_type == 18 || $tarjet_type == '18') {
                    $tipo_tarjeta="Corriente";
                }elseif ($tarjet_type == 19 || $tarjet_type == '19') {
                    $tipo_tarjeta="Vista";
                }else{
                    $tipo_tarjeta="";
                }
              
              if ($banco==276) {
                $bank_name="ABN AMRO Bank (Chile)";
              }elseif ($banco==277) {
                $bank_name="American Express Bank";
              }elseif ($banco==278) {
                $bank_name="Banco BBVA";
              }elseif ($banco==279) {
                $bank_name="Banco Bice";
              }elseif ($banco==280) {
                $bank_name="Banco Conosur";
              }elseif ($banco==281) {
                $bank_name="Banco Crédito e Inversiones";
              }elseif ($banco==282) {
                $bank_name="Banco de Chile";
              }elseif ($banco==283) {
                $bank_name="Banco de la Nación Argentina";
              }elseif ($banco==284) {
                $bank_name="Banco del Desarrollo";
              }elseif ($banco==285) {
                $bank_name="Banco del Estado de Chile";
              }elseif ($banco==286) {
                $bank_name="Banco Do Brasil S.A.";
              }elseif ($banco==287) {
                $bank_name="Banco Falabella";
              }elseif ($banco==288) {
                $bank_name="Banco Internacional";
              }elseif ($banco==289) {
                $bank_name="Banco Monex";
              }elseif ($banco==290) {
                $bank_name="Banco Ripley";
              }elseif ($banco==291) {
                $bank_name="Banco Santander-Chile";
              }elseif ($banco==292) {
                $bank_name="Banco ScotiaBank";
              }elseif ($banco==293) {
                $bank_name="Banco Security";
              }elseif ($banco==294) {
                $bank_name="BankBoston N.A.";
              }elseif ($banco==295) {
                $bank_name="Citibank N.A.";
              }elseif ($banco==296) {
                $bank_name="Corpbanca";
              }elseif ($banco==297) {
                $bank_name="Deutsche Bank (Chile)";
              }elseif ($banco==298) {
                $bank_name="Dresdner Bank Lateinamerika";
              }elseif ($banco==299) {
                $bank_name="HNS Banco";
              }elseif ($banco==300) {
                $bank_name="HSBC Bank Chile";
              }elseif ($banco==301) {
                $bank_name="JP Morgan Chase Bank";
              }elseif ($banco==302) {
                $bank_name="The Bank Of Tokyo – Mitsubishi";
              }elseif ($banco==303) {
                $bank_name="Banco Itaú";
              }
            }else{
              $bank_name="";
            }

            $nombre = $contracts->name.trim("");
            $first_name = explode(',',$nombre);

            $birthdate = $contracts->birthday.trim("");
            $birthdate = explode('-', $birthdate);
            $seconds=$birthdate[2];
            $birthdateDay=explode(" ", $seconds);
            $birthdate = $birthdateDay[0].'-'.$birthdate[1].'-'.$birthdate[0];
        @endphp

<div class="col-md-6">
    <label for="date_born"><span style="color: red !important;">*</span> <b>{{ __('auth.birthDate') }}</b></label>
    <input type="text" id="date_born" value="{{ $birthdate }}"  name="date_born"  data-min="1909-01-01" data-max="2019-11-01" onblur="validate_birthdate(this.value)" class="form-control">
</div>
</div>

<div class="row">
    <div class="col-md-12" id="jur" @if ($contracts->type_incorporate == 0)
                         hidden="true"
                        @endif>
        <label for="name_titular"><span style="color: red !important;">*</span> <b>{{ __('auth.name_titular') }}</b></label>
        <input type="text" id="name_titular" value="@if ($contracts->type_incorporate == 0)@elseif($contracts->type_incorporate == 1){{ $first_name[0] }}@endif" name="name_titular" class="form-control">
    </div>
    
    <div class="col-md-12" id="jur1" @if ($contracts->type_incorporate == 0)
                         hidden="true"
                        @endif>
        <label for="name_titular_ape"><span style="color: red !important;">*</span> <b>{{ __('auth.name_titular_ape') }}</b></label>
        <input type="text" id="name_titular_ape" value= '@if ($contracts->type_incorporate == 0){{ $contracts->name }}@elseif($contracts->type_incorporate == 1){{ $first_name[1] }}@endif' name="name_titular_ape" class="form-control">
    </div>

    <div class="col-md-12" @if ($contracts->type_incorporate != 0)
                         hidden="true"
                        @endif  id="r_soc">
        <label for="name_titular_jur"><span style="color: red !important;">*</span> <b>{{ __('auth.razon') }}</b></label>
        <input type="text" id="name_titular_jur" value="{{ $contracts->name }}" name="name_titular_jur" class="form-control">
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <label for="socio_econ"><span style="color: red !important;">*</span> <b>{{ __('auth.socio_econ') }}</b></label>
        <input type="text" id="socio_econ" value="{{ $contracts->socio_econ }}" name="socio_econ" class="form-control">
    </div>
</div>

<div class="row">
    <div class="col-md-6" id="mail">
        <label for="email"><span style="color: red !important;">*</span> <b>{{ __('auth.email') }}</b></label>
        <input type="text" id="email" value="{{ $contracts->email }}" name="email" onblur="validateMail()" class="form-control">
    </div>
    <!--div class="col-md-6" id="mail">
      <label for="email"><span style="color: red !important;">*</span> <b>{{ __('auth.email') }}</b></label>
      <input type="text" id="email" name="email" onblur="validateMailSql()" class="form-control">
  </div-->
  <div class="col-md-6" id="gender">
      <label for="gender"><span style="color: red !important;">*</span> <b>{{ __('auth.gender') }}</b></label>
      <select id="gender1" name="gender" class="form-control" onchange="getDataShirt()">
        <option value="" @if ($contracts->gender == '')
                        selected="true" 
                        @endif>{{ __('auth.selreg') }}</option>
         <option value="M" @if ($contracts->gender == 'M')
                        selected="true" 
                        @endif>{{ __('auth.gender_opc_one') }}</option>
         <option value="F" @if ($contracts->gender == 'F')
                        selected="true" 
                        @endif>{{ __('auth.gender_opc_two') }}</option>
     </select>
 </div>
</div>

<div class="row">
    <div id="cel_natural" class="col-lg-12">
        <label for="cel"><b>{{ __('auth.celPhone') }}</b></label>
        <input type="text" id="cel" name="cel" value="{{ $contracts->cellular }}" class="form-control">
    </div>
    <div id="cel_juridica" class="col-lg-12" hidden="true">
        <label for="cel_jur"><b>{{ __('auth.celPhoneJur') }}</b></label>
        <input type="text" id="cel_jur" value="{{ $contracts->cellular }}" name="cel_jur" class="form-control">
    </div>
</div>

<!--CHILE CHANGUE CIUDAD-->
<div class="row"> 

 <div class="col-md-4">
        <label for="changue_direction"> <b>Deseo Cambiar mi Dirección</b></label>
        <input type="checkbox" id="changue_direction" value="1" name="changue_direction" onchange="changue_address(this);" class="form-control">
  </div>
  <div class="col-md-8"> 
  </div>
  </div>
<div class="row">
    <div class="col-md-3">
        <label for="postal_code"> <b>{{ __('auth.cp') }}</b></label>
        <input type="text" id="postal_code" value="{{ $contracts->residency_one }}" name="postal_code" class="form-control">
    </div>
    <div class="col-md-3">
        <label for="region"><span style="color: red !important;">*</span> <b>{{ __('auth.reg') }}</b></label>
        <select id="region"  name="region"  class="form-control"  onchange="getCities()">
           <option value="{{ $contracts->residency_two }}" selected="">{{ $contracts->residency_two }}</option>
           {{--
                      
                         @foreach($estados as $regions) 
                        
                            
                            <option value="" >{{ $regions }}</option>
                        @endforeach

          <option value="{{ $contracts->residency_two }}" selected="">{{ $contracts->residency_two }}</option>
            <option value="" selected>{{ __('auth.selreg') }}</option>--}}
       </select>
   </div>

   <div class="col-md-3">
      <label for="ciudad"><span style="color: red !important;">*</span> <b>{{ __('auth.ciu') }}</b></label>
      <select id="ciudad" name="ciudad"   class="form-control" onchange="getCiudades()">
        <option value="{{ $contracts->residency_three }}">{{ $contracts->residency_three }}</option>
       {{-- <option value="" selected>{{ __('auth.selreg') }}</option>--}}
   </select>
</div>
<div class="col-md-3">
    <label for="comuna"><span style="color: red !important;">*</span> <b>{{ __('auth.com') }}</b> </label>
    <select id="comuna" name="comuna" class="form-control">
      <option value="{{ $contracts->residency_four }}">{{ $contracts->residency_four }}</option>
        {{--<option value="" selected="">{{ __('auth.selreg') }}</option>--}}
    </select>
</div>

</div>
<!--CHILE CHANGUE CIUDAD-->

<div class="row">
	<div class="col-md-12">
		<label for="adress"><span style="color: red !important;">*</span> <b>{{ __('auth.adress') }}</b></label>
		<input type="text" id="adress" name="adress" value="{{ $contracts->address }}"  class="form-control">
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
        <input type="text" id="rut_nat" value="{{ $contracts->number_document }}"  name="rut_nat" onblur="isValidRUT()" class="form-control">
    </div>
    <div class="col-md-12" id="rut_juridica" hidden="true">
        <label for="rut"><span style="color: red !important;">*</span> <b>{{ __('auth.rutJur') }}</b></label>
        <input type="text" id="rut" name="rut" value="{{ $contracts->number_document }}" class="form-control" onblur="isValidRUTn()">
    </div>
</div>


<div class="row">
	<div class="col-md-12" id="name_titular_two_div" @if ($contracts->type_incorporate != 0)
                         hidden="true"
                        @endif>
		<label for="name_titular_two"><span style="color: red !important;">*</span> <b>{{ __('auth.name_titular') }}</b></label>
		<input type="text" id="name_titular_two" value="{{ $contracts->name_cotitular }}" name="name_titular_two" class="form-control">
	</div>
</div>




<div class="row" >
   <!--div class="col-md-4">
        <label for="changue_shirt"> <b>Deseo Cambiar Mi Playera</b></label>
        <input type="checkbox" id="changue_shirt" value="1" name="changue_shirt" onchange="changue_shirts(this);" class="form-control">
  </div-->
  <!--div class="col-md-6" id="show-playeras" onclick="getDataShirt()"  class="form-control" @if ($contracts->type == 0 || $contracts->kit == 5006)
                        hidden="true" 
                        @endif-->
  <div class="col-md-6" id="show-playeras"   class="form-control" @if ($contracts->type == 0 || $contracts->kit == 5006 || $contracts->kit == 5002)
                        hidden="true" 
                        @endif>
                        <label for="changue_shirt"> <b>Deseo Cambiar Mi Playera</b></label>
        <input type="checkbox" id="changue_shirt" value="1" name="changue_shirt" onchange="changue_shirts(this);" class="form-control">

    <label for=""><span style="color: red !important;">*</span> <b>Elige la talla de tu camiseta</b></label>
              
                <select class="form-control"  name="shirt-size" id="shirt-size" onchange="showShirtSample()">
                    <option value="{{ $contracts->playera }}" @if ($contracts->playera == 9709) selected="true">
                        CAMISETA/PLAYERA KIT INFLUENCER TALLA L / HOMBRE
                        @endif</option>
                         <option value="{{ $contracts->playera }}" @if ($contracts->playera == 9708) selected="true">
                        CAMISETA/PLAYERA KIT INFLUENCER TALLA M / HOMBRE
                        @endif</option>
                         <option value="{{ $contracts->playera }}" @if ($contracts->playera == 9711) selected="true">
                        CAMISETA/PLAYERA KIT INFLUENCER TALLA M / MUJER
                        @endif</option>
                         <option value="{{ $contracts->playera }}" @if ($contracts->playera == 9712) selected="true">
                        CAMISETA/PLAYERA KIT INFLUENCER TALLA S / MUJER
                        @endif</option>
                </select>
           
        </div>
    
    <!--div class="col-md-6" class="form-control" id="shirt-sample">
        
    </div-->

   
    

</div>


<br>

<section id="abi" @if ($contracts->type == 0)
                        hidden="true" 
                        @endif>
    @include('retomar.asesorretomar')
</section>

<div class="row" >
	<div class="col-sm-12">
		<label id="option-sponsor-one"><input type="radio"  id="opc1" value="1" disabled name="type_sponsor" checked="" onclick="Opacity_type_sponsor(this.value);" >&nbsp;<strong>{{ __('auth.type_sponsor_one') }}</strong><br/><small>{{ __('auth.type_sponsor_ones') }}</small></label>
		<div class="row">
           
                <div class="col-sm-5">
                     <div class="form-group">
                    <input type="text"  class="form-control input-sponsor" disabled name="code-sponsor" id="code-sponsor" placeholder="Ingresa aquí el código aquí" onblur="CodeBien()" onkeyup="Search_sponsor(this.value)" onchange ="Validate_sponsor_exist()" value="{{ $contracts->sponsor }}" onclick="SponsorRadio()">
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
             <label id="option-sponsor-three"><input type="radio" value="3" disabled  name="type_sponsor" id="option-sponsor-2" onclick="Opacity_type_sponsor(this.value);">&nbsp;<strong>{{ __('auth.type_sponsor_three') }}</strong><br/><small>{{ __('auth.type_sponsor_threes') }}</small></label>
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
document.getElementById('kits-cb').setAttribute('hidden',true);
        div_texto_club_or_abi.innerHTML = "<div class='alert alert-info' role='alert'>Si has seleccionado Asesor de Bienestar, y desarrollarás el Negocio, elige algunas de estas opciones de tipo de persona según sea tu caso!</div>";

    }else if(value == "0"){
        document.getElementById('abi').removeAttribute('hidden',true);
        document.getElementById('abi').setAttribute('hidden',true);
document.getElementById('kits-cb').removeAttribute('hidden',true);
        div_texto_club_or_abi =  document.getElementById('cborabitxt');

    div_texto_club_or_abi.innerHTML = "<div class='alert alert-info' role='alert'>Si eres Empresa y no desarrollarás  Negocio, debes registrarte como Club de Bienestar ( Recibes factura).</div>";
    
    }
}

function changue_address(checkboxElem) {
  if (checkboxElem.checked) {
    //alert(URLactual);
    //https://signuptesting.nikkenlatam.com:8282/retomar?correo=serviciochl%40nikkenlatam.com/states?getStates=10
    var country = $('#country').val();
  $.ajax({
    type: "GET",
    url: URLactual + '/states',
    dataType: "json",
    data: {
      getstate: country
    },
    success: function(data){
      $("#region").find('option').remove();
      $("#region").append('<option value="" selected>'+selreg+'</option>');
      $("#ciudad").append('<option value="" selected>'+selreg+'</option>');
      $("#comuna").append('<option value="" selected>'+selreg+'</option>');
      $.each(data,function(key, registro) {
        $("#region").append('<option value='+registro.state_name.replace(/ /g, "%")+'>'+registro.state_name+'</option>');
      });
    },
    error: function(data) {
      alert("error estados");
    }
  });
//alert("checked")
  } else {
    //alert("notchecked")
  }
}

function test(){
    alert("click");  
}

function changue_shirts(checkboxshirt) {
  var divplayeras = document.getElementById('show-playeras');
    var div_image=document.getElementById('shirt-sample');
    var valor_size = document.getElementById('shirt-size').value;
    var kit = document.getElementById('kit').value;
    var gender = document.getElementById('gender1').value;
  if (checkboxshirt.checked) {
   if (kit!=5006 && gender !="") {
    if(gender == 'M'){
      gender = "Hombre";
    }
    else{
      gender = "Mujer";
    }

    $.ajax({
      type: 'GET',
      url: URLactual + '/playeras',
      dataType: "json",
      data:{ gender: gender, kit: kit},
      success: function(respuesta){
        $("#shirt-size").find('option').remove();
        $("#shirt-size").append('<option value="" selected>Seleccionar Playera</option>');
        $.each(respuesta,function(key, registro) {
         $("#shirt-size").append('<option value='+registro.item+'>'+registro.descripcion+'</option>');
       });
      }
    });

}

  } else {

  
}
}

</script>


@endsection

 

