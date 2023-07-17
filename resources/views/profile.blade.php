@extends('layout')

@section('title', 'Registro')

@section('content')

    <div class="row" class="tooltip-section">
        <div class="col-md-12 text-center mb-4">
            <img alt="logo" src="https://nikkenlatam.com/oficina-virtual/assets/images/general/logo-header-black.png"
                class="theme-logo">
            <img alt="logo" src="{{ asset('regchileasset/img/chile.png') }}" width="5%">
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
        <form action="/save" method="post" id="formProfile" accept-charset="UTF-8" enctype="multipart/form-data"
            class="form-control" border="none" onKeypress="if(event.keyCode == 13) event.returnValue = false;">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row">
                <div class="col-md-12">


                    <label for="country"><span style="color: red !important;">*</span>
                        <b>{{ __('auth.country') }}</b></label>
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
                    <div class='alert alert-info' role='alert'>Si has seleccionado Asesor de Bienestar, y desarrollarás el
                        Negocio, elige algunas de estas opciones de tipo de persona según sea tu caso!</div>
                </div>
            </div>

            <div class="row" align="center">
                <div class="col-md-6 form-group" align="center">

                    <label for="type_inc" align="center"><span style="color: red !important;">*</span>
                        <b>{{ __('auth.abi') }}</b></label>
                    <input type="radio" name="type_inc" id="type_inc1" value="1" onclick="cl_or_abi(this.value)"
                        checked="true">






                </div>
                <!-- Se comento este div y se modifico el col de arriba solo durante el cambio hasta el 15 de diciebre -->
                <div class="col-md-6 form-group" align="center">

                    <label for="type_inc" align="center"><span style="color: red !important;">*</span>
                        <b>{{ __('auth.cb') }}</b></label>
                    <input type="radio" name="type_inc" id="type_inc2" value="0" onclick="cl_or_abi(this.value)">

                </div>


            </div>
            <div class="row">
                <div class="col-md-12" id="kits-cb" hidden="true">
                    <label for="kit"><span style="color: red !important;">*</span> <b>Selecciona Tu Kit de
                            Inicio</b></label>
                    <select class="form-control" name="kit-cb" id="kit-cb" onchange="Ocultar_playeras()">
                        <option value="">Selecciona un Kit de inicio</option>
                        <option value="5031">5031 KIT MIEMBRO DE LA COMUNIDAD $0.00</option>
                        <!--option value="5032" >5032 Inscripción con Alcancía Electrónica $800.00</option-->

                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12" id="kits">
                    <label for="kit"><span style="color: red !important;">*</span> <b>Selecciona Tu Kit de
                            Inicio</b></label>
                    <select class="form-control" name="kit" id="kit" onchange="Ocultar_playeras()">
                        <option value="">Selecciona un Kit de inicio</option>
                        <option value="5006">5006 KIT CLÁSICO $81,044.00</option>


                        <!--option value="5025">5025 KIT INFLUENCER  PAQUETE PI WATER+ OPTIMIZER $465,500.00</option>
                        <option value="5026">5026 KIT INFLUENCER  PAQUETE WATERFALL + OPTIMIZER $645,800.00</option-->
                        <!--option value="5027">5027 KIT INFLUENCER  + PIMAG OPTIMIZER $310,600.00</option-->
                        <!--option value="5028">5028 KIT INFLUENCER AQUA POUR DELUXE $296,200.00</option-->
                    </select>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger" role="alert">
                        <center><strong>
                                <p>{{ __('auth.tabs') }}</p>
                            </strong></center>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="type_per"><span style="color: red !important;">*</span>
                        <b>{{ __('auth.type_per') }}</b></label>
                    <select id="type_per" name="type_per" class="form-control" onchange="type_person(this.value)">
                        <option value=""></option>
                        <option value="1">{{ __('auth.pernat') }}</option>
                        <option value="2">{{ __('auth.pernatint') }}</option>
                        <option value="0">{{ __('auth.perjur') }}</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="date_born"><span style="color: red !important;">*</span>
                        <b>{{ __('auth.birthDate') }}</b></label>
                    <input type="text" id="date_born" name="date_born" data-min="1909-01-01" data-max="2019-11-01"
                        onblur="validate_birthdate(this.value)" class="form-control">
                </div>
            </div>

            <br>
            <!--subir archivos-->
            <div class="row" id="personanatural">
                <div class="col-lg-6 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Cedula de Identidad</h4>
                                    <p style="font-size: 12px; color: red !important;"><span
                                            style="color: red !important;" class="flaticon-warning"></span>Solo se admiten
                                        archivos con extención JPG,JPEG,PNG y PDF.</p>
                                    <p style="font-size: 12px; color: red !important;"><span
                                            style="color: red !important;" class="flaticon-warning"></span>El tamaño
                                        maximo del archivo es de 5MB</p>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <div class="custom-file-container" data-upload-id="myFirstImage1">
                                <label>Anverso <a href="javascript:void(0)" class="custom-file-container__image-clear"
                                        title="Clear Image">X</a></label>
                                <label class="custom-file-container__custom-file">
                                    <input type="file" class="custom-file-container__custom-file__custom-file-input"
                                        onchange="ValidateExtensionone(this.value);" accept="image/*,application/pdf"
                                        id="fileone" name="fileone" value="">
                                    <input type="hidden" name="MAX_FILE_SIZE" value="300000" id="MAX_FILE_SIZE" />
                                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                                </label>
                                <div class="custom-file-container__image-preview"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Cedula de Identidad</h4>
                                    <p style="font-size: 12px; color: red !important;"><span
                                            style="color: red !important;" class="flaticon-warning"></span>Solo se admiten
                                        archivos con extención JPG,JPEG,PNG y PDF.</p>
                                    <p style="font-size: 12px; color: red !important;"><span
                                            style="color: red !important;" class="flaticon-warning"></span>El tamaño
                                        maximo del archivo es de 5MB</p>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <div class="custom-file-container" data-upload-id="myFirstImage2">
                                <label>Reverso <a href="javascript:void(0)" class="custom-file-container__image-clear"
                                        title="Clear Image">x</a></label>
                                <label class="custom-file-container__custom-file">
                                    <input type="file" class="custom-file-container__custom-file__custom-file-input"
                                        onchange="ValidateExtensiontwo(this.value);" accept="image/*,application/pdf"
                                        id="filetwo" name="filetwo" value="">
                                    <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
                                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                                </label>
                                <div class="custom-file-container__image-preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12" id="jur">
                    <label for="name_titular"><span style="color: red !important;">*</span>
                        <b>{{ __('auth.name_titular') }}</b></label>
                    <input type="text" id="name_titular" name="name_titular" class="form-control">
                </div>
                <div class="col-md-12" id="jur1">
                    <label for="name_titular_ape"><span style="color: red !important;">*</span>
                        <b>{{ __('auth.name_titular_ape') }}</b></label>
                    <input type="text" id="name_titular_ape" name="name_titular_ape" class="form-control">
                </div>

                <div class="col-md-12" hidden="true" id="r_soc">
                    <label for="name_titular_jur"><span style="color: red !important;">*</span>
                        <b>{{ __('auth.razon') }}</b></label>
                    <input type="text" id="name_titular_jur" name="name_titular_jur" class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <label for="socio_econ"><span style="color: red !important;">*</span>
                        <b>{{ __('auth.socio_econ') }}</b></label>
                    <input type="text" id="socio_econ" name="socio_econ" class="form-control">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6" id="mail">
                    <label for="email"><span style="color: red !important;">*</span>
                        <b>{{ __('auth.email') }}</b></label>
                    <input type="text" id="email" name="email" onblur="validateMail()" class="form-control">
                </div>
                <!--div class="col-md-6" id="mail">
          <label for="email"><span style="color: red !important;">*</span> <b>{{ __('auth.email') }}</b></label>
          <input type="text" id="email" name="email" onblur="validateMailSql()" class="form-control">
      </div-->
                <div class="col-md-6" id="gender">
                    <label for="gender"><span style="color: red !important;">*</span>
                        <b>{{ __('auth.gender') }}</b></label>
                    <select id="gender1" name="gender" class="form-control" onchange="getDataShirt()">
                        <option value="">Selecciona Tu Genero</option>
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
                    <label for="region"><span style="color: red !important;">*</span>
                        <b>{{ __('auth.reg') }}</b></label>
                    <select id="region" name="region" class="form-control" onchange="getCities()">
                        {{-- <option value="" selected>{{ __('auth.selreg') }}</option> --}}
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="ciudad"><span style="color: red !important;">*</span>
                        <b>{{ __('auth.ciu') }}</b></label>
                    <select id="ciudad" name="ciudad" class="form-control" onchange="getCiudades()">
                        {{-- <option value="" selected>{{ __('auth.selreg') }}</option> --}}
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="comuna"><span style="color: red !important;">*</span> <b>{{ __('auth.com') }}</b>
                    </label>
                    <select id="comuna" name="comuna" class="form-control">
                        {{-- <option value="" selected="">{{ __('auth.selreg') }}</option> --}}
                    </select>
                </div>

            </div>
            <!--CHILE CHANGUE CIUDAD-->

            <!--div class="row">
        <div class="col-md-12">
            <label for="adress"><span style="color: red !important;">*</span> <b>{{ __('auth.adress') }}</b></label>
            <input type="text" id="adress" name="adress" class="form-control">
        </div>
    </div-->

            <div class="row">
                <div class="col-md-8">
                    <label for="street"><span style="color: red !important;">*</span>
                        <b>{{ __('auth.street') }}</b></label>
                    <input type="text" id="street" name="street" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="number"><span style="color: red !important;">*</span>
                        <b>{{ __('auth.number') }}</b></label>
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
                    <label for="rut_nat"><span style="color: red !important;">*</span>
                        <b>{{ __('auth.rut') }}</b></label>
                    <input type="text" id="rut_nat" name="rut_nat" onblur="isValidRUT(this.value)"
                        class="form-control">
                </div>
                <div class="col-md-12" id="rut_juridica" hidden="true">
                    <label for="rut"><span style="color: red !important;">*</span>
                        <b>{{ __('auth.rutJur') }}</b></label>
                    <input type="text" id="rut" name="rut" class="form-control"
                        onblur="isValidRUTn(this.value)">
                </div>
            </div>

            <br>
            <!--subir archivos-->
            <div class="row" id="personajuridica">
                <div class="col-lg-6 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Rol Único Tributario</h4>
                                    <p style="font-size: 12px; color: red !important;"><span
                                            style="color: red !important;" class="flaticon-warning"></span>Solo se admiten
                                        archivos con extención JPG,JPEG,PNG y PDF.</p>
                                    <p style="font-size: 12px; color: red !important;"><span
                                            style="color: red !important;" class="flaticon-warning"></span>El tamaño
                                        maximo del archivo es de 5MB</p>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <div class="custom-file-container" data-upload-id="myFirstImage3">
                                <label>Anverso <a href="javascript:void(0)" class="custom-file-container__image-clear"
                                        title="Clear Image">X</a></label>
                                <label class="custom-file-container__custom-file">
                                    <input type="file" class="custom-file-container__custom-file__custom-file-input"
                                        onchange="ValidateExtensionthree(this.value);" accept="image/*,application/pdf"
                                        id="filetrhee" name="filetrhee" value="">
                                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                                </label>
                                <div class="custom-file-container__image-preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12" id="name_titular_two_div" hidden="">
                    <label for="name_titular_two"><span style="color: red !important;">*</span>
                        <b>{{ __('auth.name_titular') }}</b></label>
                    <input type="text" id="name_titular_two" name="name_titular_two" class="form-control">
                </div>
            </div>


            <div class="row">
                <div class="col-md-6" id="show-playeras" class="form-control" hidden="">

                    <label for=""><span style="color: red !important;">*</span> <b>Elige la talla de tu
                            camiseta</b></label>

                    <select class="form-control" name="shirt-size" id="shirt-size" onchange="showShirtSample()">

                    </select>

                </div>

                <div class="col-md-6" class="form-control" id="shirt-sample">

                </div>




            </div>

            <br>
            <section id="abi" hidden="true">
                @include('asesor')
            </section>

            <div class="row">
                <div class="col-sm-12">
                    <label id="option-sponsor-one"><input type="radio" id="opc1" value="1"
                            name="type_sponsor"
                            onclick="Opacity_type_sponsor(this.value);">&nbsp;<strong>{{ __('auth.type_sponsor_one') }}</strong><br /><small>{{ __('auth.type_sponsor_ones') }}</small></label>
                    <div class="row">

                        <div class="col-sm-5">
                            <div class="form-group">
                                @if (isset($sponsor_code))
                                        <input type="text" class="form-control input-sponsor" name="code-sponsor"
                                        id="code-sponsor" placeholder="Ingresa aquí el código aquí" onblur="CodeBien()"
                                        onkeyup="Search_sponsor(this.value)" onchange="Validate_sponsor_exist()"
                                        onclick="SponsorRadio()" value="{{$sponsor_code}}" disabled>
                                    <div id="demo"></div>

                                    <input type="hidden" class="form-control required input-validator-sponsor"
                                        id="code-sponsor-validate" value="1">
                                @else
                                        <input type="text" class="form-control input-sponsor" name="code-sponsor"
                                        id="code-sponsor" placeholder="Ingresa aquí el código aquí" onblur="CodeBien()"
                                        onkeyup="Search_sponsor(this.value)" onchange="Validate_sponsor_exist()"
                                        onclick="SponsorRadio()">
                                    <div id="demo"></div>

                                    <input type="hidden" class="form-control required input-validator-sponsor"
                                        id="code-sponsor-validate">
                                @endif
                                
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
                            <label id="option-sponsor-three"><input type="radio" value="3" name="type_sponsor"
                                @if (isset($sponsor_code))
                                    disabled
                                @endif
                                    id="option-sponsor-2"
                                    onclick="Opacity_type_sponsor(this.value);">&nbsp;<strong>{{ __('auth.type_sponsor_three') }}</strong><br /><small>{{ __('auth.type_sponsor_threes') }}</small></label>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Encuesta - Segmentacion --}}

            <div class="encuesta mt-4 mb-5">
                <div class="row">
                    <div class="col-12">
                        <p
                            style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; font-size:medium; font-weight:bold; color:#6cbb2d">
                            Queremos conocerte mejor y saber qué es lo que más
                            te interesa en NIKKEN. Por favor, responde las
                            siguientes preguntas:
                            ¿Quién está llenando la incorporación? :</p>
                    </div>

                </div>
                <div class="row">
                    <div class="col-12">
                        <label id="segmentacion"><input type="radio" id="segmentacion_opc_1" value="1"
                                name="segmentacion" checked>&nbsp;Soy
                            influencer (patrocinador) y estoy incorporando
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label id="option-sponsor-one"><input type="radio" id="segmentacion_opc_2" value="0"
                                name="segmentacion">&nbsp;Soy la
                            persona interesada en ingresar a la comunidad NIKKEN
                            como influencer</label>
                    </div>
                </div>
                <div class="segmentacion-respuestas">
                    <div class="row">
                        <div class="col-12">
                            <p><strong>A Continuación selecciona la razón por la
                                    cual te estás incorporando a NIKKEN</strong>
                            </p>

                        </div>
                    </div>
                    <div class="respuestas d-flex justify-content-center aling-items-center flex-column"
                        id="opciones_segmentacion">
                        <label for="segmentacion_res_1"><input type="radio" id="segmentacion_res_1" value="10"
                                name="segmentacion_answer" required>&nbsp;1.
                            Consumo</label>
                        <label for="segmentacion_res_2"><input type="radio" id="segmentacion_res_2" value="20"
                                name="segmentacion_answer">&nbsp;2. Recuperar
                            tu inversión</label>
                        <label for="segmentacion_res_3"><input type="radio" id="segmentacion_res_3" value="30"
                                name="segmentacion_answer">&nbsp;3.
                            Emprender.</label>
                        <div id="label4_1">
                            <label for="segmentacion_res_4_2" id="label4"><input type="radio"
                                    id="segmentacion_res_4_2" value="40" name="segmentacion_answer">&nbsp;4. Estoy
                                trabajando una estrategia como
                                patrocinador.</label>
                        </div>
                        <div id="label4_2">
                            <label for="segmentacion_res_4" id="label4"><input type="radio" id="segmentacion_res_4"
                                    value="40" name="segmentacion_answer">&nbsp;4.
                                Otro.</label>
                        </div>
                        <div id="label5">
                            <label for="segmentacion_res_5"><input type="radio" id="segmentacion_res_5" value="50"
                                    name="segmentacion_answer">&nbsp;5.
                                Otro.</label>
                        </div>
                        <input class="form-control" type="text" name="segmentacion_comments"
                            id="segmentacion_res_5_text" placeholder="Por favor déjenos saber su razón." maxlength="250">

                    </div>
                </div>

            </div>






            <div class="row" align="center">
                <div class="col-lg-6">
                    <div class="alert alert-dismissible fade show" role="alert"
                        style="color: #fff; background-color: #A2DADA !important;border-color: #A2DADA !important;">
                        <strong>
                            <div class="custom-control custom-checkbox mr-3">
                                <label for="terms" class="switch s-icons s-outline s-outline-info"
                                    style="margin-left: 20px !important;">
                                    <input type="checkbox" name="terms" id="terms">
                                    <span class="slider round"></span>
                                </label>
                                <br>
                                <a href="https://storage.googleapis.com/vivenikken/pdf/others/Regional/Terms%20and%20conditions.pdf"
                                    target="_blank">
                                    <label><u
                                            style="text-decoration: none; border-bottom: 1px solid black;">{{ __('auth.terms') }}</u></label></a>
                            </div>
                        </strong>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="alert alert-dismissible fade show" role="alert"
                        style="color: #fff; background-color: #A2DADA !important;border-color: #A2DADA !important;">
                        <strong>
                            <div class="custom-control custom-checkbox mr-3">
                                <label for="privacy_policy" class="switch s-icons s-outline s-outline-info"
                                    style="margin-left: 20px !important;">
                                    <input type="checkbox" name="privacy_policy" id="privacy_policy">
                                    <span class="slider round"></span>
                                </label>
                                <br>
                                <a href="https://storage.googleapis.com/vivenikken/pdf/others/Chile/Politica-de-privacidad.pdf"
                                    target="_blank">
                                    <label><u
                                            style="text-decoration: none; border-bottom: 1px solid black;">{{ __('auth.privacy_policy') }}</u></label></a>
                            </div>
                        </strong>
                    </div>
                </div>

            </div>
            <div class="row" align="center">
                <div class="col-lg-12">
                    <div class="alert alert-dismissible fade show" role="alert"
                        style="color: #fff; background-color: #A2DADA !important;border-color: #A2DADA !important;">
                        <strong>
                            <div class="custom-control custom-checkbox mr-3">
                                <label for="declare" class="switch s-icons s-outline s-outline-info"
                                    style="margin-left: 20px !important;">
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

                <button type="submit" class="btn btn-info" onclick="validations()"
                    id="btnProfile">{{ __('auth.next') }}</button>
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
        <label id="cargando" name="cargando" style="display: none"> {{ __('auth.labelLoad') }}
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>

    </div>
    </form>

    <script type="text/javascript">
        /**
         * Función que muestra los campos dependiendo el tipo de incorporación
         */
        function cl_or_abi(value) {
            if (value == "1") {
                document.getElementById('abi').setAttribute('hidden', true);
                document.getElementById('abi').removeAttribute('hidden', true);
                div_texto_club_or_abi = document.getElementById('cborabitxt');
                document.getElementById('kits-cb').setAttribute('hidden', true);
                div_texto_club_or_abi.innerHTML =
                    "<div class='alert alert-info' role='alert'>Si has seleccionado Asesor de Bienestar, y desarrollarás el Negocio, elige algunas de estas opciones de tipo de persona según sea tu caso!</div>";

            } else if (value == "0") {
                document.getElementById('abi').removeAttribute('hidden', true);
                document.getElementById('abi').setAttribute('hidden', true);
                div_texto_club_or_abi = document.getElementById('cborabitxt');
                document.getElementById('kits-cb').removeAttribute('hidden', true);
                div_texto_club_or_abi.innerHTML =
                    "<div class='alert alert-info' role='alert'>Si eres Empresa y no desarrollarás  Negocio, debes registrarte como Club de Bienestar ( Recibes factura).</div>";
            }
        }
        cl_or_abi(1);
    </script>

    <script type="text/javascript">
        function ValidateExtensionone(file) {
            var ext = file.split('.').pop();
            var tamano = document.getElementById("fileone").files[0].size;

            if (file != '') {
                if (ext == "pdf" || ext == "png" || ext == "jpg" || ext == "jpeg" || ext == "heic" || ext == "PNG" || ext ==
                    "JPG" || ext == "JPEG" || ext == "HEIC" || ext == "PDF") {
                    //alert("La extensión es: " + ext);
                    if (tamano > 5000000) {
                        swal({
                            title: 'Error',
                            text: 'El archivo exede el tamaño permitido',
                            type: 'error',
                            padding: '2em'
                        })
                        document.getElementById("fileone").value = "";
                        /*$('#modal-title').text('¡Precaución!');
                        $('#modal-msg').html("Se solicita un archivo no mayor a 1MB. Por favor verifica.");
                        $("#modal-gral").modal();    */
                        $file.val('');
                    } else {

                    }

                } else {
                    //file.val('');
                    swal({
                        title: 'Error',
                        text: 'La extencion de tu archivo no esta permitida',
                        type: 'error',
                        padding: '2em'
                    })
                    document.getElementById("fileone").value = "";


                }
            }
        }

        function ValidateExtensiontwo(file) {
            var ext = file.split('.').pop();
            var tamano = document.getElementById("filetwo").files[0].size;
            if (file != '') {
                if (ext == "pdf" || ext == "png" || ext == "jpg" || ext == "jpeg" || ext == "heic" || ext == "PNG" || ext ==
                    "JPG" || ext == "JPEG" || ext == "HEIC" || ext == "PDF") {
                    //alert("La extensión es: " + ext);
                    if (tamano > 5000000) {
                        swal({
                            title: 'Error',
                            text: 'El archivo exede el tamaño permitido',
                            type: 'error',
                            padding: '2em'
                        })
                        document.getElementById("filetwo").value = "";
                        /*$('#modal-title').text('¡Precaución!');
                        $('#modal-msg').html("Se solicita un archivo no mayor a 1MB. Por favor verifica.");
                        $("#modal-gral").modal();    */

                    } else {
                        //$("#modal-gral").hide();
                    }
                } else {
                    //file.val('');
                    swal({
                        title: 'Error',
                        text: 'La extencion de tu archivo no esta permitida',
                        type: 'error',
                        padding: '2em'
                    })
                    document.getElementById("filetwo").value = "";


                }
            }
        }

        function ValidateExtensionthree(file) {
            var ext = file.split('.').pop();
            var tamano = document.getElementById("filetrhee").files[0].size;
            if (file != '') {
                if (ext == "pdf" || ext == "png" || ext == "jpg" || ext == "jpeg" || ext == "heic" || ext == "PNG" || ext ==
                    "JPG" || ext == "JPEG" || ext == "HEIC" || ext == "PDF") {
                    //alert("La extensión es: " + ext);
                    if (tamano > 5000000) {
                        swal({
                            title: 'Error',
                            text: 'El archivo exede el tamaño permitido',
                            type: 'error',
                            padding: '2em'
                        })
                        document.getElementById("filetrhee").value = "";


                    } else {
                        //$("#modal-gral").hide();
                    }
                } else {
                    //file.val('');
                    swal({
                        title: 'Error',
                        text: 'La extencion de tu archivo no esta permitida',
                        type: 'error',
                        padding: '2em'
                    })
                    document.getElementById("filetrhee").value = "";


                }
            }
        }
    </script>
@endsection
