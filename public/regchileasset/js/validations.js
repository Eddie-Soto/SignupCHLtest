$( document ).ready(function() {

    if (/spa/.test(window.location.href)){
        validate_esp();
      //  verify_privacy_policy();
        //verify_declare();
   // alert("contiene spa");
    }else{
        validate_en();
        //verify_privacy_policy();
        //verify_declare();
    //alert("contiene en");
    }

});


function RememberBuy(){
    swal({
        title: 'Recuerda:',
        text: "Para completar tu inscripción adquiere un producto en la tienda virtual, al terminar tu compra recibirás un correo con tu carta de bienvenida.",
        type: 'success',
        padding: '2em'
    })

}

function Validate_sponsor_exist(){
    var sponsorexist = document.getElementById("code-sponsor-validate").value;
    //alert(sponsorexist);
    if(sponsorexist == ""){
       // alert('Digita un sponsor valido');
        document.getElementById("code-sponsor").value="";
    }
}

function validations(){


    if (/spa/.test(window.location.href)){
        validate_esp();
        var terms = verify_terms();
        var privacy = verify_privacy_policy();
        var declare = verify_declare();
       /* if(terms == true && privacy == true && declare == true){
            $("#formProfile").submit();
        }*/
        
        if(terms == true && privacy == true && declare == true){
            if($("#type_inc2").is(':checked')) {  
              RememberBuy();
            }
            $("#formProfile").submit();
        }

       // console.log(terms);
   // alert("contiene spa");
    }else{
        validate_en();
        var terms = verify_terms();
        var privacy = verify_privacy_policy();
        var declare = verify_declare();
      /*  if(terms == true && privacy == true && declare == true){
            $("#formProfile").submit();
        }*/
        
        if(terms == true && privacy == true && declare == true){
            if($("#type_inc2").is(':checked')) {  
              RememberBuy();
            }
            $("#formProfile").submit();
        }
        
       // console.log(terms);
   // alert("contiene en");
    }
}


function validate_birthdate(value){
    
    var res = value.split("-");
    if( res[0]=="undefinied" || res[1]=="undefinied" || res[2]=="undefinied" || /_/.test(res[0]) || /_/.test(res[1]) || /_/.test(res[2]) )
    {
        swal({
            title: 'Error',
            text: completeDate,
            type: 'error',
            padding: '2em'
        })
    }
    res[0];
    res[1];
    res[2];
    var day = res[0];
var month = res[1];
var year = res[2]
var age =  18;

var mydate = new Date();
mydate.setFullYear(year, month-1, day);

var currdate = new Date();
currdate.setFullYear(currdate.getFullYear() - age);

if(currdate < mydate)
{
    swal({
        title: 'Error',
        text: alertHeigtAge,
        type: 'error',
        padding: '2em'
    })
}
}


function verify_terms(){
    if(!$("input[id='terms']").is(':checked')){
        swal({
            title: 'Error',
            text: terminos,
            type: 'error',
            padding: '2em'
        })
        return false;
     }
     else{
        return true;
     }

}
function verify_privacy_policy(){
    if(!$("input[id='privacy_policy']").is(':checked')){
        swal({
            title: 'Error',
            text: privacy_policy_acept,
            type: 'error',
            padding: '2em'
        })
      return false;
     }
     else{
        return true;
     }
}
function verify_declare(){
    if(!$("input[id='declare']").is(':checked')){
        swal({
            title: 'Error',
            text: declare_acept,
            type: 'error',
            padding: '2em'
        })
      return false;
     }
     else{
        return true;
     }
}



function validate_en(){
        $.validator.addMethod("caract_special_address_en", function(value, element) {
            return /^[a-zA-Z0-9\-áéíóúüñÁÉÍÓÚÜÑ., ]*$/i.test(value);
        }, "No special characters allowed.");

    $.validator.addMethod("caract_special_en", function(value, element) {
        return /^[a-zA-Z0-9\-áéíóúüñÁÉÍÓÚÜÑ, ]*$/i.test(value);
    }, "No special characters allowed");

    $.validator.addMethod("caract_special_cni_en", function(value, element) {
        return /^[a-zA-Z0-9\-áéíóúüñÁÉÍÓÚÜÑ, ]*$/i.test(value);
    }, "No special characters allowed");



    $("#formProfile").validate({
        rules: {
            'shirt-size':{
                required: true
            },
            kit: {
                required: true
            },
            bank_name: {
                required: true
            },
            country: {
                required: true
            },
            type_inc: {
                required: true
            },
            type_per: {
                required: true
            },
            name_titular: {
                required: true,
                maxlength: 100,
                caract_special_en: true
            },
            name_titular_ape: {
                required: true,
                maxlength: 100,
                caract_special_en: true
            },
            name_titular_jur: {
                required: true,
                maxlength: 100,
                caract_special_en: true
            },
            socio_econ: {
                required: true,
                maxlength: 40,
                caract_special_en: true
            },
            date_born: {
                required: true,
                caract_special_en: true

            },
            email: {
                required: true,
                email: true,
                maxlength: 50
            },
            gender: {
                required: true
            },
            tel: {
                number: true,
                maxlength: 20
            },
            cel: {
                number: true,
                maxlength: 20
            },
            postal_code: {
                number: true,
                maxlength: 7
            },
            region: {
                required: true
            },
            comuna: {
                required: true
            },
            adress: {
                required: true,
               // caract_special_address_en: true,
                maxlength: 100
            },
            cni: {
                required: true,
                maxlength: 10,
                caract_special_cni_en: true
            },
            rut: {
                required: true,
                minlength: 8,
                maxlength: 10,
                caract_special_cni_en: true
            },
            rut_nat: {
                required: true,
                minlength: 8,
                maxlength: 10,
                caract_special_cni_en: true
            },
            name_titular_two: {
                required: true,
                maxlength: 100,
                caract_special_en: true
            },
            type_sponsor: {
                required: true
            },
            terms: {
                required: true
            },
            privacy_policy: {
                required: true
            },
            declare: {
                required: true
            },
            type_acount: {
                required: true
            },
            number_account: {
                required: true,
                maxlength: 20,
                number: true,
                caract_special_en: true
            },
            name_cotitular: {
                required: true,
                maxlength: 100,
                caract_special_en: true
            },
            cni_cotitular: {
                required: true,
                maxlength: 10,
                caract_special_cni_en: true
            },
            rut_cotitular: {
                required: true,
                maxlength: 10,
                minlength: 8,
                caract_special_cni_en: true
            },
            date_born: {
                required: true
            },
            'code-sponsor': {
                required: true
            },
            street: {
                required: true
            },
            number: {
                required: true
            },
            
        }
    });
}

    function validate_esp(){

        $.validator.addMethod("caract_special_address", function(value, element) {
            return /^[a-zA-Z0-9\-áéíóúüñÁÉÍÓÚÜÑ., ]*$/i.test(value);
        }, "Ingrese sólo letras, números o espacios.");

        $.validator.addMethod("caract_special_es", function(value, element) {
            return /^[a-zA-Z0-9\-áéíóúüñÁÉÍÓÚÜÑ, ]*$/i.test(value);
        }, "Ingrese sólo letras, números o espacios.");

        $.validator.addMethod("caract_special_cni_es", function(value, element) {
            return /^[a-zA-Z0-9\-áéíóúüñÁÉÍÓÚÜÑ, ]*$/i.test(value);
        }, "Ingrese sólo letras, números o espacios.");

        $("#formProfile").validate({
            rules: {
                'shirt-size':{
                    required: true
                },
                kit: {
                    required: true
                },
                bank_name: {
                    required: true
                },
                country: {
                    required: true
                },
                type_inc: {
                    required: true
                },
                type_per: {
                    required: true
                },
                name_titular: {
                    required: true,
                    maxlength: 100,
                    caract_special_es: true
                },
                name_titular_ape: {
                    required: true,
                    maxlength: 100,
                    caract_special_es: true
                },
                name_titular_jur: {
                    required: true,
                    maxlength: 100,
                    caract_special_es: true
                },
                socio_econ: {
                    required: true,
                    maxlength: 40,
                    caract_special_es: true
                },
                date_born: {
                    required: true,
                    caract_special_es: true
                },
                email: {
                    required: true,
                    email: true,
                    maxlength: 50
                },
                gender: {
                    required: true
                },
                tel: {
                    number: true,
                    maxlength: 20
                },
                cel: {
                    number: true,
                    maxlength: 20
                },
                postal_code: {
                    number: true,
                    maxlength: 7
                },
                region: {
                    required: true
                },
                comuna: {
                    required: true
                },
                adress: {
                    required: true,
                    //caract_special_address: true,
                    maxlength: 100
                },
                cni: {
                    required: true,
                    maxlength: 10,
                    caract_special_cni_es: true
                },
                rut: {
                    required: true,
                    maxlength: 10,
                    minlength: 8,
                    caract_special_cni_es: true
                },
                rut_nat: {
                    required: true,
                    minlength: 8,
                    maxlength: 10,
                    caract_special_cni_es: true
                },
                name_titular_two: {
                    required: true,
                    maxlength: 100,
                    caract_special_es: true
                },
                type_sponsor: {
                    required: true
                },
                terms: {
                    required: true
                },
                privacy_policy: {
                    required: true
                },
                declare: {
                    required: true
                },
                type_acount: {
                    required: true
                },
                number_account: {
                    required: true,
                    maxlength: 20,
                    number: true,
                    caract_special_es: true
                },
                name_cotitular: {
                    required: true,
                    maxlength: 100,
                    caract_special_es: true
                },
                cni_cotitular: {
                    required: true,
                    maxlength: 10,
                    caract_special_cni_es: true
                },
                rut_cotitular: {
                    required: true,
                    maxlength: 10,
                    minlength: 8,
                    caract_special_cni_es: true
                },
                date_born: {
                    required: true
                },
                'code-sponsor': {
                    required: true
                },
                street: {
                    required: true
                },
                number: {
                    required: true
                },
                
            },
            messages: {
                'shirt-size':{
                    required: "Este campo es obligatorio"
                },
                kit: {
                    required: "Este campo es obligatorio"
                },
                bank_name: {
                    required: "Este campo es obligatorio"
                },
                country: {
                    required: "Este campo es obligatorio"
                },
                type_inc: {
                    required: "Este campo es obligatorio"
                },
                type_per: {
                    
                    required: "Este campo es obligatorio"
                },
                name_titular: {
                    required: "Este campo es obligatorio",
                    maxlength: "Solo puede colocar hasta 100 caracteres en este campo",
                    caract_special_es: "No se permiten caracteres especiales"
                },
                name_titular_ape: {
                    required: "Este campo es obligatorio",
                    maxlength: "Solo puede colocar hasta 100 caracteres en este campo",
                    caract_special_es: "No se permiten caracteres especiales"
                },
                name_titular_jur: {
                    required: "Este campo es obligatorio",
                    maxlength: "Solo puede colocar hasta 100 caracteres en este campo",
                    caract_special_es: "No se permiten caracteres especiales"
                },
                socio_econ: {
                    required: "Este campo es obligatorio",
                    maxlength: "Solo puede colocar hasta 40 caracteres en este campo",
                    caract_special_es: "No se permiten caracteres especiales"
                },
                date_born: {
                    required: "Este campo es obligatorio",
                    caract_special_es: "No se permiten caracteres especiales"
                },
                email: {
                    required: "Este campo es obligatorio",
                    email: "Por favor verifica tu email",
                    maxlength: "Solo puede colocar hasta 50 caracteres en este campo"
                },
                gender: {
                    required: "Este campo es obligatorio"
                },
                tel: {
                    required: "Este campo es obligatorio",
                    number: "Este campo es numerico",
                    maxlength: "Solo puede colocar hasta 20 caracteres en este campo"
                },
                cel: {
                    number: "Este campo es numerico",
                    maxlength: "Solo puede colocar hasta 20 caracteres en este campo"
                },
                postal_code: {
                    number: "Este campo es numerico",
                    maxlength: "Solo puede colocar hasta 20 caracteres en este campo"
                },
                region: {
                    required: "Este campo es obligatorio"
                },
                comuna: {
                    required: "Este campo es obligatorio"
                },
                adress: {
                    required: "Este campo es obligatorio",
                    //caract_special_address: "No se permiten caracteres especiales",
                    maxlength: "Solo puede colocar hasta 100 caracteres en este campo"
                },
                cni: {
                    required: "Este campo es obligatorio",
                    maxlength: "Solo puede colocar hasta 10 caracteres en este campo",
                    caract_special_cni_es: "No se permiten caracteres especiales"
                },
                rut: {
                    required: "Este campo es obligatorio",
                    maxlength: "Solo puede colocar hasta 10 caracteres en este campo",
                    minlength: "Se deben colocar por lo menos 8 caracteres en este campo",
                    caract_special_cni_es: "No se permiten caracteres especiales"
                },
                rut_nat: {
                    required: "Este campo es obligatorio",
                    maxlength: "Solo puede colocar hasta 10 caracteres en este campo",
                    minlength: "Se deben colocar por lo menos 8 caracteres en este campo",
                    caract_special_cni_es: "No se permiten caracteres especiales"
                },
                name_titular_two: {
                    required: "Este campo es obligatorio",
                    maxlength: "Solo puede colocar hasta 100 caracteres en este campo",
                    caract_special_es: "No se permiten caracteres especiales"
                },
                type_sponsor: {
                    required: "Este campo es obligatorio"
                },
                terms: {
                    required: "Este campo es obligatorio"
                },
                privacy_policy: {
                    required: "Este campo es obligatorio"
                },
                declare: {
                    required: "Este campo es obligatorio"
                },
                type_acount: {
                    required: "Este campo es obligatorio"
                },
                number_account: {
                    required: "Este campo es obligatorio",
                    maxlength: "Solo puede colocar hasta 20 caracteres en este campo",
                    number: "Este campo es numerico",
                    caract_special_es: "No se permiten caracteres especiales"
                },
                name_cotitular: {
                    required: "Este campo es obligatorio",
                    maxlength: "Solo puede colocar hasta 100 caracteres en este campo",
                    caract_special_es: "No se permiten caracteres especiales"
                },
                cni_cotitular: {
                    required: "Este campo es obligatorio",
                    maxlength: "Solo puede colocar hasta 10 caracteres en este campo",
                    caract_special_cni_es: "No se permiten caracteres especiales"
                },
                rut_cotitular: {
                    required: "Este campo es obligatorio",
                    maxlength: "Solo puede colocar hasta 10 caracteres en este campo",
                    minlength: "Se deben colocar por lo menos 8 caracteres en este campo",
                    caract_special_cni_es: "No se permiten caracteres especiales"
                },
                date_born: {
                    required: "Este campo es obligatorio"
                },
                'code-sponsor': {
                    required: "Este campo es obligatorio"
                },
                street: {
                    required: "Este campo es obligatorio"
                },
                number: {
                    required: "Este campo es obligatorio"
                },
                

            }
        });
}
