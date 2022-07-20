/**
* Función que obtiene la URL actual
*/
var URLactual = window.location;

var alertDuplicateMail = $('#alertDuplicateMail').val();
var terminos = $('#terminos').val();
var privacy_policy_acept = $('#privacy_policy_acept').val();
var alertHeigtAge = $('#alertHeigtAge').val();
var declare_acept = $('#declare_acept').val();

var rquired = $('#rquired').val();
var code_no_exist = $('#code_no_exist').val();
var loginErrortext = $('#loginError').val();
var alertSponsorIdtext = $('#alertSponsorId').val();
var alertMailInvalid = $('#alertMailInvalid').val();
var completeDate = $('#completeDate').val();
/*CHILE CHANGUE CIUDAD*/
var selreg = $('#selreg').val();
/*CHILE CHANGUE CIUDAD*/

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
function ActivityEcon(){
  var activity=$('#socio_econ').val().trim() == '';
  if(activity == ""){
    document.getElementById('socio_econ').setAttribute('required',true);
    document.getElementById('socio_econ').value="";
  }else{
   document.getElementById('socio_econ').removeAttribute('required',false);
 }
}

function SponsorRadio(){
  document.getElementById("opc1").checked=true;
}

function playeras(gender, kit){
  var divplayeras = document.getElementById('show-playeras');
  var div_image=document.getElementById('shirt-sample');
  var valor_size = document.getElementById('shirt-size').value;

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
        $("#shirt-size").append('<option value="" selected>'+selreg+'</option>');
        $.each(respuesta,function(key, registro) {
         $("#shirt-size").append('<option value='+registro.item+'>'+registro.descripcion+'</option>');


       });

      }
    });
  }
}

function Ocultar_playeras(){
  var kit = document.getElementById('kit').value;
  var div_opciones=document.getElementById('show-playeras');
  var div_image=document.getElementById('shirt-sample');
  if(kit==5006 || kit=="" || kit==5002 || kit==5031 || kit == 5032){
    div_opciones.setAttribute('hidden',true);
    div_image.setAttribute('hidden',true);
  }else{
    div_opciones.removeAttribute('hidden',true);
    div_image.removeAttribute('hidden',true);
  }
}

function showShirtSample(){
 var item = document.getElementById('shirt-size').value;
 var divSample = document.getElementById('shirt-sample');
 var imgSample = "";
 if(item == ""){
  divSample.innerHTML="";
}else{
 divSample.innerHTML = "<br><img class='img-thumbnail' src='../../regchileasset/img/playera.png' width='100%' name='shirt-sample'>";
}
}

function getDataShirt(){
    //  var country = document.getElementById('country').value;
    var kit = document.getElementById('kit').value;
    var gender = document.getElementById('gender1').value;
    playeras(gender, kit);
  }

/**
* Función que valida que el email digitado no se enceuntre en la BD y que no este vacio
*/
function validateMail(){
  var email = $('#email').val().trim();
  if(email == ""){

  }else{
    $.ajax({
      type: 'GET',
      url: URLactual + '/email',
      dataType: "json",
      data:{ email: email},
      success: function(respuesta){
        if (respuesta==1) {
                 // document.getElementById("btnProfile").disabled= false;
               }else{
                swal({
                  title: 'Error',
                  text: alertDuplicateMail,
                  type: 'error',
                  padding: '2em'
                })
                document.getElementById("email").value="";
              }
            }
          });
  }
}


function CodeBien(){
 var codigo = document.getElementById("code-sponsor").value;
 $.ajax({
  type: "GET",
  url: URLactual + '/codegood',
  dataType: "json",
  data: {
    code: codigo
  },
  success: function(data){
    if(data==1){
      document.getElementById('demo').removeAttribute('hidden',true);
      document.getElementById("demo").innerHTML = "Por favor seleccionar una de las opciones";

    }else{
     document.getElementById('demo').removeAttribute('hidden',true);
     document.getElementById('demo').setAttribute('hidden',true);
   }
 }

});

}

    /**
* Función que valida que el email digitado no se enceuntre en la BD SQL y que no este vacio
*/
function validateMailSql(){
  var email = $('#email').val().trim();
  if(email == ""){

  }else{
    $.ajax({
      type: 'GET',
      url: URLactual + '/emailsql',
      dataType: "json",
      data:{ email: email},

      success: function(respuesta){
        if (respuesta==1) {

        }else{
                /*
                        swal({
                        title: 'Error',
                        text: alertDuplicateMail,
                        type: 'error',
                        padding: '2em'
                      })*/
                      location.href=URLactual+"/Asesorespre";

                    }
                  }
                });
  }
}



function onlyOne(){

}



/**
* Función que busca el sponsor
*/
function Search_sponsor(value){
  var codigo = value;
  $.ajax({
    type: "GET",
    url: URLactual + '/searchsponsor',
    dataType: "json",
    data: {
      code: codigo
    },
    beforeSend: function(){
      $("#view-name-sponsor").find('a').remove();
      $("#view-name-sponsor").find('p').remove();
      $("#view-name-sponsor").append('<p>Cargando...</p>');
    },
    success: function(data){
      $("#view-name-sponsor").find('a').remove();

      if (data == '3') {
       $("#view-name-sponsor").find('p').remove();
       $("#view-name-sponsor").append('<p>El codigo no existe <p>');
       document.getElementById("code-sponsor-validate").value = "";
     }else if(data == '2'){
       $("#view-name-sponsor").find('p').remove();
       $("#view-name-sponsor").append('<p>El codigo no existe <p>');
       document.getElementById("code-sponsor-validate").value = "";
     }else if(data == '1'){
       $("#view-name-sponsor").find('p').remove();
       $("#view-name-sponsor").append('<p>El codigo no existe <p>');
       document.getElementById("code-sponsor-validate").value = "";
     }else{
      $("#view-name-sponsor").find('p').remove();
      document.getElementById("code-sponsor-validate").value = "1";

      $.each(data,function(key, registro) {

        if (registro.codigo==0) {

          $("#view-name-sponsor").append('<p>El codigo no existe <p>');
          document.getElementById("code-sponsor-validate").value = "";
          document.getElementById('view-name-sponsor').innerHTML='';
        }else{

          $("#view-name-sponsor").append('<p ><input type="text" class="btn btn-info" value='+registro.codigo+' onclick="funciontomarcodigo(this.value)">'+registro.nombre+'</p>');
          document.getElementById('demo').removeAttribute('hidden',true);
          document.getElementById("demo").innerHTML = "Por favor seleccionar una de las opciones";

        }
      });
    }
  },
  error: function(data) {
    $("#view-name-sponsor").find('p').remove();
    $("#view-name-sponsor").append('<p>Cargando...</p>');
    $("#view-name-sponsor").find('p').remove();
    $("#view-name-sponsor").append('<p>'+code_no_exist+'</p>');
  }
});
}


      /**
* Función que comprueba el sponsor
*/
function Search_sponsor_Valid(){
  var codigo = document.getElementById("code-sponsor").value;
        //alert(codigo);
        $.ajax({
          type: "GET",
          url: URLactual + '/searchsponsorValid',
          dataType: "json",
          data: {
            code: codigo
          },
          beforeSend: function(){
            $("#view-name-sponsor").find('a').remove();
            $("#view-name-sponsor").find('p').remove();
            $("#view-name-sponsor").append('<p>Cargando...</p>');
          },
          success: function(data){
            $("#view-name-sponsor").find('a').remove();

            if (data == '3') {
             $("#view-name-sponsor").find('p').remove();
             $("#view-name-sponsor").append('<p>El codigo no existe <p>');
             document.getElementById("code-sponsor-validate").value = "";
           }else if(data == '2'){
             $("#view-name-sponsor").find('p').remove();
             $("#view-name-sponsor").append('<p>El codigo no existe <p>');
             document.getElementById("code-sponsor-validate").value = "";
           }else if(data == '1'){
             $("#view-name-sponsor").find('p').remove();
             $("#view-name-sponsor").append('<p>El codigo no existe <p>');
             document.getElementById("code-sponsor-validate").value = "";
           }else{
            $("#view-name-sponsor").find('p').remove();
            document.getElementById("code-sponsor-validate").value = "1";

            $.each(data,function(key, registro) {

              if (registro.codigo==0) {

                $("#view-name-sponsor").append('<p>El codigo no existe <p>');
                document.getElementById("code-sponsor-validate").value = "";
                document.getElementById('view-name-sponsor').innerHTML='';
              }else{
                $("#view-name-sponsor").append('<p ><input type="text" class="btn btn-info" value='+registro.codigo+' onclick="funciontomarcodigo(this.value)">'+registro.nombre+'</p>');
                document.getElementById('demo').removeAttribute('hidden',true);
                document.getElementById('demo').setAttribute('hidden',true);
              }
            });
          }
        },
        error: function(data) {
          $("#view-name-sponsor").find('p').remove();
          $("#view-name-sponsor").append('<p>Cargando...</p>');
          $("#view-name-sponsor").find('p').remove();
          $("#view-name-sponsor").append('<p>'+code_no_exist+'</p>');
          document.getElementById("code-sponsor-validate").value = "";
        }
      });
      }

/**
* Función que obtiene los estados 
*/
/*CHILE CHANGUE CIUDAD*/
function getStates(){
  alert(URLactual);
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

    }
  });

}
/*CHILE CHANGUE CIUDAD*/

function funciontomarcodigo(value){
  document.getElementById("code-sponsor").value=value;
  document.getElementById('view-name-sponsor').innerHTML='';
  Search_sponsor_Valid(value);
  }

/**
* Función que obtiene las ciudades
*/

/*CHILE CHANGUE CIUDAD*/
function getCities(){
  var regi = $('#region').val();
  var country = $('#country').val();
  $.ajax({
    type: "GET",
    url: URLactual + '/municipality',
    dataType: "json",
    contentType: "text/json; charset=UTF-8",
    data: {
      reg: regi,
      country: country
    },
    success: function(data){
      $("#ciudad").find('option').remove();
      $("#ciudad").append('<option value="" selected>'+selreg+'</option>');
      $("#comuna").append('<option value="" selected>'+selreg+'</option>');
      $.each(data,function(key, registro) {
        $("#ciudad").append('<option value='+registro.province_name.replace(/ /g, "%")+'>'+registro.province_name+'</option>');
      });
    },
    error: function(data) {

    }
  });
}
/*CHILE CHANGUE CIUDAD*/

/*CHILE CHANGUE CIUDAD*/
function getCiudades(){
  var country = $('#country').val();
  var ciudades = $('#ciudad').val();
  $.ajax({
    type: "GET",
    url: URLactual + '/ciudad',
    dataType: "json",
    contentType: "text/json; charset=UTF-8",
    data: {
      ciudad: ciudades,
      country: country
    },
    success: function(data){
      $("#comuna").find('option').remove();
      $("#comuna").append('<option value="" selected>'+selreg+'</option>');
      $.each(data,function(key, registro) {
        $("#comuna").append('<option value='+registro.colony_name.replace(/ /g, "%")+'>'+registro.colony_name+'</option>');
      });
    },
    error: function(data) {
    }
  });
}
/*CHILE CHANGUE CIUDAD*/

/**
* Función que obtiene los bancos 
*/
function getBanks(){
  var country = $('#country').val();
  $.ajax({
    type: "GET",
    url: URLactual + '/banks',
    dataType: "json",
    data: {
      pais: country
    },
    success: function(data){
      $.each(data,function(key, registro) {
        $("#bank_name").append('<option value='+registro.id_bank+'>'+registro.name+'</option>');
      });
    },
    error: function(data) {
    }
  });

}

$( document ).ready(function() {
  getBanks();
  getTypeBanks();
 // getStates();
  });

/* Funcion que valida  que halla digitado un sponsor valido */
function validate_save(){
  var $form = $('#formProfile');
        var type_sponsor = $('input[name=type-sponsor]:checked').val(); // Tipo de seleccion de patrocinador
        if(type_sponsor == 1)
        {
          if(document.getElementById('code-sponsor-validate').val() == 0)
          {
            swal({
              title: 'Error',
              text: 'debes ingresar el codigo con el que te vas a incorporar',
              type: 'error',
              padding: '2em'
            })
            return false;
          }
        }

        if(!$("input[id='terms']").is(':checked') || !$("input[id='privacy_policy']").is(':checked') || !$("input[id='declare']").is(':checked')){
          $("#btnProfile").disabled = true;
          document.getElementById("btnProfile").disabled = true;
        }else{
          $("#btnProfile").disabled = false;
          document.getElementById("btnProfile").disabled = false;
        }
      }

/**
* Función que obtiene el tipo del banco
*/
function getTypeBanks(){
  var country = $('#country').val();
  $.ajax({
    type: "GET",
    url: URLactual + '/gettypebankeacount',
    dataType: "json",
    data: {
      pais: country
    },
    success: function(data){
      $.each(data,function(key, registro) {
        $("#type_acount").append('<option value='+registro.id_bank_type+'>'+registro.name+'</option>');
      });
    },
    error: function(data) {

    }
  });
}

/**
* Función que muestra los campos dependiendo el tipo de incorporación
*/
function cl_or_abi(value){
  if(value == "1"){
    document.getElementById('abi').setAttribute('hidden',true);
    document.getElementById('abi').removeAttribute('hidden',true);
    document.getElementById('kits').removeAttribute('hidden',true);
    document.getElementById('kits-cb').setAttribute('hidden',true);
    div_texto_club_or_abi =  document.getElementById('cborabitxt');

    div_texto_club_or_abi.innerHTML = "<div class='alert alert-info' role='alert'>Si has seleccionado Asesor de Bienestar, y desarrollarás el Negocio, elige algunas de estas opciones de tipo de persona según sea tu caso!</div>";


  }else if(value == "0"){
    document.getElementById('abi').removeAttribute('hidden',true);
    document.getElementById('abi').setAttribute('hidden',true);
    document.getElementById('kits').setAttribute('hidden',true);
    document.getElementById('kits-cb').removeAttribute('hidden',true);
    div_texto_club_or_abi =  document.getElementById('cborabitxt');

    div_texto_club_or_abi.innerHTML = "<div class='alert alert-info' role='alert'>Si eres Empresa y no desarrollarás  Negocio, debes registrarte como Club de Bienestar (Recibes factura).</div>";
    
  }
}

/**
* Función que muestra los campos del cotitular si lo desea
*/
function check_cotitular(){
  if($("input[id='info_cotitular']").is(':checked')){
    document.getElementById('check_coti').setAttribute('hidden',true);
    document.getElementById('check_coti').removeAttribute('hidden',true);
  }
  else if(!$("input[id='info_cotitular']").is(':checked')){
    document.getElementById('check_coti').setAttribute('hidden',true);
    document.getElementById('name_cotitular').value="";
    document.getElementById('rut_cotitular').value="";

  }

}

/**
* Función que muestra los campos del banco si lo desea
*/
function check_bank(){
  if($("input[id='info_bank']").is(':checked')){
    document.getElementById('check_bank').setAttribute('hidden',true);
    document.getElementById('check_bank').removeAttribute('hidden',true);
  }
  else if(!$("input[id='info_bank']").is(':checked')){
    document.getElementById('check_bank').setAttribute('hidden',true);
    document.getElementById('bank_name').value="";
    document.getElementById('type_acount').value="";
    document.getElementById('number_account').value="";
  }

}

/**
* Función que cambia el nombre a los campos dependiendo el tipo de persona
*/
function type_person(value){
  if(value == "1"){
    document.getElementById('socio_econ').value="Sin inicio de actividades";
     // document.getElementById('socio_econ').setAttribute('disabled',true); 
     /* Cambia el texto de el campo nombre titular si selecciona persona natural */
     document.getElementById('r_soc').removeAttribute('hidden',true);
     document.getElementById('r_soc').setAttribute('hidden',true);
     document.getElementById('jur').removeAttribute('hidden',true);
     document.getElementById('jur1').removeAttribute('hidden',true);

     /* Cambia el texto de el campo cel titular si selecciona persona natural */
     document.getElementById('cel_juridica').removeAttribute('hidden',true);
     document.getElementById('cel_juridica').setAttribute('hidden',true);
     document.getElementById('cel_natural').removeAttribute('hidden',true);

     /* Cambia el texto de el rut  si selecciona persona natural */
     document.getElementById('rut_juridica').removeAttribute('hidden',true);
     document.getElementById('rut_juridica').setAttribute('hidden',true);
     document.getElementById('rut_natural').removeAttribute('hidden',true);

     /* Muestra el campo gender si selecciona persona juridica */
    // document.getElementById('gender').removeAttribute('hidden',true);
    // div_Cambiar_size_input = document.getElementById('mail');
     //div_Cambiar_size_input.classList.remove('col-md-12');
     //div_Cambiar_size_input.className += " col-md-6";

     document.getElementById('name_titular_two_div').removeAttribute('hidden',true);
     document.getElementById('name_titular_two_div').setAttribute('hidden',true);
   }else if(value=="2"){
     // document.getElementById('socio_econ').removeAttribute('disabled',true); 
     document.getElementById('socio_econ').value="";
     /* Cambia el texto de el campo nombre titular si selecciona persona natural */
     document.getElementById('r_soc').removeAttribute('hidden',true);
     document.getElementById('r_soc').setAttribute('hidden',true);
     document.getElementById('jur').removeAttribute('hidden',true);
     document.getElementById('jur1').removeAttribute('hidden',true);

     /* Cambia el texto de el campo cel titular si selecciona persona natural */
     document.getElementById('cel_juridica').removeAttribute('hidden',true);
     document.getElementById('cel_juridica').setAttribute('hidden',true);
     document.getElementById('cel_natural').removeAttribute('hidden',true);

     /* Cambia el texto de el rut  si selecciona persona natural */
     document.getElementById('rut_juridica').removeAttribute('hidden',true);
     document.getElementById('rut_juridica').setAttribute('hidden',true);
     document.getElementById('rut_natural').removeAttribute('hidden',true);

     /* Muestra el campo gender si selecciona persona juridica */
    // document.getElementById('gender').removeAttribute('hidden',true);
    // div_Cambiar_size_input = document.getElementById('mail');
    // div_Cambiar_size_input.classList.remove('col-md-12');
    // div_Cambiar_size_input.className += " col-md-6";

     document.getElementById('name_titular_two_div').removeAttribute('hidden',true);
     document.getElementById('name_titular_two_div').setAttribute('hidden',true);
   }else if(value == "0"){
    document.getElementById('socio_econ').removeAttribute('disabled',true); 
    document.getElementById('socio_econ').value="";
    /* Cambia el texto de el campo nombre titular si selecciona persona juridica */
    document.getElementById('jur').removeAttribute('hidden',true);
    document.getElementById('jur').setAttribute('hidden',true);
    document.getElementById('jur1').removeAttribute('hidden',true);
    document.getElementById('jur1').setAttribute('hidden',true);
    document.getElementById('r_soc').removeAttribute('hidden',true);

    /* Cambia el texto de el campo cel titular si selecciona persona juridica */
    document.getElementById('cel_natural').removeAttribute('hidden',true);
    document.getElementById('cel_natural').setAttribute('hidden',true);
    document.getElementById('cel_juridica').removeAttribute('hidden',true);

    /* Cambia el texto de el rut  si selecciona persona juridica */
    document.getElementById('rut_natural').removeAttribute('hidden',true);
    document.getElementById('rut_natural').setAttribute('hidden',true);
    document.getElementById('rut_juridica').removeAttribute('hidden',true);

    /* Oculta el campo gender si selecciona persona juridica */
    //document.getElementById('gender').removeAttribute('hidden',true);
   // document.getElementById('gender').setAttribute('hidden',true);

    /*Si oculta el campo genero hace mas grande el campo email */
    //div_Cambiar_size_input = document.getElementById('mail');
    //div_Cambiar_size_input.classList.remove('col-md-12');
    //div_Cambiar_size_input.className += " col-md-12";

    /* Oculta el campo gender si selecciona persona juridica */
    document.getElementById('name_titular_two_div').removeAttribute('hidden',true);
  }
}


/**
* Función que hace una opacidad en los tipos de sponsor
*/
function Opacity_type_sponsor(value)
{
  var type = value;
  if(type == 1)
  {
    document.getElementById("option-sponsor-one").style.opacity = "1";
        //document.getElementById("option-sponsor-two").style.opacity = "0.6";
        document.getElementById("option-sponsor-three").style.opacity = "0.6";

        document.getElementById("code-sponsor").disabled = false;
        document.getElementById('code-sponsor').setAttribute('required',true);
        document.getElementById("code-sponsor-validate").value = "";

      }
      else if(type == 3)
      {
        document.getElementById("option-sponsor-one").style.opacity = "0.6";
        //document.getElementById("option-sponsor-two").style.opacity = "0.6";
        document.getElementById("option-sponsor-three").style.opacity = "1";
        $("#view-name-sponsor").html("");
        document.getElementById("code-sponsor").value = "";
        document.getElementById("code-sponsor").disabled = true;
        document.getElementById('code-sponsor').removeAttribute('required',true);
        var err = document.getElementById('code-sponsor-error')
        if(err!=null){
          err.remove();
        }
        document.getElementById("code-sponsor-validate").value = "0";

      }
    }

    function isValidRUT() {
      var rut= $("#rut_nat").val();
      if (!rut | typeof rut !== 'string') return false;

      var regexp = /^\d{7,8}-[k|K|\d]{1}$/;
      var rutvalid=regexp.test(rut);
      if(rutvalid){

      }else{
        swal({
          title: 'Error',
          text: 'debes ingresar un RUT valido',
          type: 'error',
          padding: '2em'
        })
      }

    }

    function isValidRUTn() {
      var rut2= $("#rut").val();
      if (!rut2 | typeof rut2 !== 'string') return false;

      var regexp = /^\d{7,8}-[k|K|\d]{1}$/;
      var rutvalid=regexp.test(rut2);
      if(rutvalid){

      }else{
        swal({
          title: 'Error',
          text: 'debes ingresar un RUT valido',
          type: 'error',
          padding: '2em'
        })
      }

    }

    /*
 var Base64 = {

  // private property
  _keyStr : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",

  // public method for encoding
  encode : function (input) {
    var output = "";
    var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
    var i = 0;

    input = Base64._utf8_encode(input);

    while (i < input.length) {

      chr1 = input.charCodeAt(i++);
      chr2 = input.charCodeAt(i++);
      chr3 = input.charCodeAt(i++);

      enc1 = chr1 >> 2;
      enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
      enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
      enc4 = chr3 & 63;

      if (isNaN(chr2)) {
        enc3 = enc4 = 64;
      } else if (isNaN(chr3)) {
        enc4 = 64;
      }

      output = output +
      this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
      this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);

    }

    return output;
  },

  // public method for decoding
  decode : function (input) {
    var output = "";
    var chr1, chr2, chr3;
    var enc1, enc2, enc3, enc4;
    var i = 0;

    input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

    while (i < input.length) {

      enc1 = this._keyStr.indexOf(input.charAt(i++));
      enc2 = this._keyStr.indexOf(input.charAt(i++));
      enc3 = this._keyStr.indexOf(input.charAt(i++));
      enc4 = this._keyStr.indexOf(input.charAt(i++));

      chr1 = (enc1 << 2) | (enc2 >> 4);
      chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
      chr3 = ((enc3 & 3) << 6) | enc4;

      output = output + String.fromCharCode(chr1);

      if (enc3 != 64) {
        output = output + String.fromCharCode(chr2);
      }
      if (enc4 != 64) {
        output = output + String.fromCharCode(chr3);
      }

    }

    output = Base64._utf8_decode(output);

    return output;

  },

  // private method for UTF-8 encoding
  _utf8_encode : function (string) {
    string = string.replace(/\r\n/g,"\n");
    var utftext = "";

    for (var n = 0; n < string.length; n++) {

      var c = string.charCodeAt(n);

      if (c < 128) {
        utftext += String.fromCharCode(c);
      }
      else if((c > 127) && (c < 2048)) {
        utftext += String.fromCharCode((c >> 6) | 192);
        utftext += String.fromCharCode((c & 63) | 128);
      }
      else {
        utftext += String.fromCharCode((c >> 12) | 224);
        utftext += String.fromCharCode(((c >> 6) & 63) | 128);
        utftext += String.fromCharCode((c & 63) | 128);
      }

    }

    return utftext;
  },

  // private method for UTF-8 decoding
  _utf8_decode : function (utftext) {
    var string = "";
    var i = 0;
    var c = c1 = c2 = 0;

    while ( i < utftext.length ) {

      c = utftext.charCodeAt(i);

      if (c < 128) {
        string += String.fromCharCode(c);
        i++;
      }
      else if((c > 191) && (c < 224)) {
        c2 = utftext.charCodeAt(i+1);
        string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
        i += 2;
      }
      else {
        c2 = utftext.charCodeAt(i+1);
        c3 = utftext.charCodeAt(i+2);
        string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
        i += 3;
      }

    }

    return string;
  }

}
                  //alert("LLEGO");
                  var correo=Base64.encode(email);
                  //alert(correo);
                  //location.href=URLactual+"Asesorespre";
                  
                    //document.getElementById('email').value="";
                    //"http://test.mitiendanikken.com/mitiendanikken/auto/login/$data";
                    location.href="http://mitiendanikken.com/mitiendanikken/auto/login/"+correo+"";


                    */