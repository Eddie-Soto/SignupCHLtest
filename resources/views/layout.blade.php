<!doctype html>
<html lang="en">
<head>
    <title>@yield('title') NIKKEN - Sign Up</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <title>Nikken - Sign Up</title>
    <link rel="shortcut icon" type="image/x-icon" href="https://www.nikken.com/themes_wordpress_/images/icons/nikken_logo.ico">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    <link href="{{asset('regchileasset/css/fontawesome.css')}}" rel="stylesheet">
    <link href="{{asset('regchileasset/css/bootstrap.css ')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('regchileasset/css/regular.css')}}" rel="stylesheet">
    <link href="{{asset('regchileasset/css/solid.css')}}" rel="stylesheet">
    <link href="{{asset('regchileasset/css/brands.css')}}" rel="stylesheet">
    <link href="{{asset('regchileasset/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('regchileasset/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('regchileasset/css/register.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('regchileasset/plugins/sweetalerts/sweetalert.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('regchileasset/css/ui-kit/custom-sweetalert.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('regchileasset/css/jquery-ui.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('regchileasset/css/wbn-datepicker.css')}}" rel="stylesheet" type="text/css" />

    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ asset('regchileasset/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('regchileasset/dropzone/basic.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('regchileasset/file-upload/file-upload-with-preview.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->


    <style>
        .flotante {
            display:scroll;
            /* position:absolute;*/
            bottom:320px;
            right:0px;
        }

        .img-fluid {
          max-width: 100%;
          height: auto;
      }
      .img-responsive {
          display: block;
          max-width: 100%;
          height: auto;
      }
      label[class='error']{
        color: red;
    }
    .dates{
        background-color: #3bafda;
        color: white;
    }

    #days, #hours, #minutes, #seconds{
        font-size: 90px
    }
    .row [class*="col-"] .widget .widget-header h4 { color: green; }
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] { -moz-appearance:textfield; }

    .switch-s.s-outline[class*="s-outline-"] .slider::before {
        bottom: 1px;
        left: 1px;
        border: 2px solid #dfe2ea;
        background-color:#000;
        color: #f7f8fa;
        box-shadow: 0 1px 15px 1px
        rgba(52, 40, 104, 0.25);
    }

    .switch.s-outline .slider {
        border: 2px solid #000;
        background-color: transparent;
    }
    </style>
</head>

<body class="body-country" >
    @if(Session::has('notice'))
                            <div class="alert {{ Session::get('alertClass') }} alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>{{ Session::get('alertType') }}</strong> {{ Session::get('notice') }}
                            </div>
                    @endif

    <div class="row" align="center">

        <div class="col-md-12 alert alert-info" role="alert">

           <b> <p class="format-margin-bottom"><strong>Si ya has iniciado el proceso de incorporación utiliza</strong></p><b>

            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-return-incorporate" data-keyboard="false">Retomar incorporación  <i class="pe-7s-info"></i></button>
        </div>
        
        
    </div>
       <!-- Modal retomar incorporación -->

    <div class="modal fade" id="modal-return-incorporate" tabindex="-1" role="dialog" aria-labelledby="termsLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">
              <form class="retomar" action="/retomar" method="post">
                @csrf
                <div class="modal-header">

                    <h4 class="modal-title text-center" id="termsLabel">Retomar incorporación</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                </div>

                <div class="modal-body">

                    <p>A continuación <strong>ingresa tu correo electrónico</strong> para retomar la incorporación</p>

                    <div class="form-group">

                        <input type="email" name="correo" class="form-control form-control-retomar input-email" placeholder="Correo Electrónico">

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

                    <button type="Submit" class="btn btn-success process-button" id="btn-return-incorporate">Retomar</button>

                </div>
              </form>
            </div>

        </div>

    </div>

    <!-- Modal retomar incorporación -->
    <div class="form-register" style="opacity: 0.97" >
        @yield('content')
        <div class="row">
            <div class="col-md-3">

            </div>
            <div class="col-md-5">
                <center>
                <a class='img-responsive flotante' target="_blank" href='https://wa.me/51989079782' ><img src="{{ asset('regchileasset/img/whatsapp1.jpg') }}"  border="0"/></a></center>
            </div>
            <div class="col-md-4">

            </div>
        </div>
    </div>
    <br>
</body>
<script src="{{asset('regchileasset/js/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('regchileasset/js/popper.min.js')}}"></script>
<script src="{{asset('regchileasset/js/bootstrap.min.js')}}"></script>

<script src="{{asset('regchileasset/plugins/sweetalerts/sweetalert2.min.js')}}"></script>
<script src="{{asset('regchileasset/plugins/sweetalerts/custom-sweetalert.js')}}"></script>
<script src="{{asset('regchileasset/js/jquery-ui.js')}}"></script>
<script src="{{asset('regchileasset/js/validations.js?v=2.0.60')}}"></script>

<script src="{{asset('regchileasset/js/jquery.validate.js')}}"></script>

<script src="{{ asset('regchileasset/js/wbn-datepicker.js') }} "></script>
<script src="{{ asset('regchileasset/js/wbn-datepicker.min.js') }} "></script>
<script src="{{asset('regchileasset/plugins/input-mask/input-mask.js?v=1.8')}}"></script> 
<script src="{{asset('regchileasset/plugins/input-mask/jquery.inputmask.bundle.min.js?v=1.8')}}"></script>  
<!--script src="http://signup.nikkenlatam.com/regchileasset/plugins/input-mask/jquery.inputmask.bundle.min.js"></script>
    <script src="http://signup.nikkenlatam.com/regchileasset/plugins/input-mask/input-mask.js"></script-->
        <script src="{{ asset('regchileasset/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ asset('regchileasset/js/jquery.blockUI.min.js') }}"></script>


        <script src="{{ asset('regchileasset/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('regchileasset/dropzone/custom-dropzone.js') }}"></script>
    <script src="{{ asset('regchileasset/file-upload/file-upload-with-preview.js') }}"></script>
<script type="text/javascript">
    var firstUpload = new FileUploadWithPreview('myFirstImage1');
    var secondUpload = new FileUploadWithPreview('myFirstImage2');
    var trheeUpload = new FileUploadWithPreview('myFirstImage3');
         //Inicializamos el tooltip
         $('[data-toggle="tooltip"]').tooltip();
         $('.menu-reg').css('display', 'block');
         $('.count-down').css('display', 'none');
     </script>
     <script src="{{ asset('regchileasset/js/singup/singup.js?v=3.1.2') }} "></script>
     <!--script>
        $('.wbn-datepicker').datepicker()
    </script-->
    </html>
