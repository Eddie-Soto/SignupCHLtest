<?php

namespace App\Http\Controllers;

use App;
use App\Citys;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ContractsTest;
use App\ControlciTest;
use App\UsersTest;
Use Redirect;
use \Exception;
use Illuminate\Support\Facades\Storage;
use Aws\S3\S3Client;
use Aws\S3\S3ClientInterface;
header("Content-Type: text/html;charset=utf-8");
class incorporacionController extends Controller
{
    const S3_SLIDERS_FOLDER = 'CHL';
  const S3_OPTIONS = ['disk' => 's3', 'visibility' => 'public'];

  public function Conexion(Request $request){
       $conection = \DB::connection('mysql_las');

        $abiInfo = $conection->select("SELECT * FROM nikkenla_incorporation.contracts limit 5;");

        \DB::disconnect('mysql_las');
        return $abiInfo;
        
    }

public function valida_rut(Request $request){
    $rut=$request->rut;
    $rut = preg_replace('/[^k0-9]/i', '', $rut);
    $dv  = substr($rut, -1);
    $numero = substr($rut, 0, strlen($rut)-1);
    $i = 2;
    $suma = 0;
    foreach(array_reverse(str_split($numero)) as $v)
    {
        if($i==8)
            $i = 2;

        $suma += $v * $i;
        ++$i;
    }

    $dvr = 11 - ($suma % 11);
    
    if($dvr == 11)
        $dvr = 0;
    if($dvr == 10)
        $dvr = 'K';

    if($dvr == strtoupper($dv)){
        echo "1";
        exit;
        
    }
    else{
        echo "0";
        
        exit;
    }
}

    public function KitUSD($country,$language,$sponsorid,$kit,$boleto){
       
        $language='spa';
         App::setLocale($language);

         $sponsorid=base64_decode($sponsorid);
         $kit=base64_decode($kit);
         $boleto=base64_decode($boleto);


        return view('KitUSD.profilekit',array('sponsorkit' => $sponsorid, 'kit' => $kit, 'boletokit' => $boleto));
    }

    public function profilekit(Request $request){
        
        $sponsor = $request->input('sponsorid').trim("");
        $kit_cupon = $request->input('kit').trim("");
        $code_ticket = $request->input('boleto').trim("");

        $sponsorid = $request->session()->put('sponsorid', $sponsor);

        $kit_usd = $request->session()->put('kit', $kit_cupon);

        $boleto = $request->session()->put('boleto', $code_ticket);
        $language = $request->language;
        $country = $request->country;

        App::setLocale($language);

        if ($language == 'spa' && $country == 'ch') {
            $countryN = 1;
        }

        else if ($language == 'en' && $country == 'ch') {
            $countryN = 1;
        }

        $states="estados";
        $cities="citys";

        $conection = \DB::connection('mysql_las');

        $states = $conection->select("SELECT distinct state_name FROM nikkenla_incorporation.control_states_test where pais='$country' ");

        \DB::disconnect('mysql_las');

        return view('profile', array('country' => $country,'language' => $language, 'states' => $states));
       // return view('mantenimiento');
    }

     public function update(Request $request){

        $country = $request->input('country').trim("");
        $type_incorporation = $request->input('type_inc').trim("");
        $type_per = $request->input('type_per').trim("");
        $type_sponsor = $request->input('type_sponsor').trim("");
        $birthdate = $request->input('date_born').trim("");
        $birthdate = explode('-', $birthdate);
        $birthdate = $birthdate[2].'-'.$birthdate[1].'-'.$birthdate[0];
        $titular_name = $request->input('name_titular').trim("");
        $titular_name_ape = $request->input('name_titular_ape').trim("");
        $titular_name=$titular_name.", ".$titular_name_ape;
        $titular_name = strtoupper($titular_name);
        $titular_name_jur = $request->input('name_titular_jur').trim("");
        $email = $request->input('email').trim("");
        $email=strtolower($email);
        $gender = $request->input('gender').trim("");
        $cel = $request->input('cel').trim("");
        $cel_jur = $request->input('cel_jur').trim("");
        $cp = $request->input('postal_code').trim("");
        $state = $request->input('region').trim("");
        $state= str_replace("%", " ", $state);
        $municipality = $request->input('comuna').trim("");
        $municipality = str_replace("%", " ", $municipality);
        $city = $request->input('ciudad').trim("");
        $city = str_replace("%", " ", $city);
        $address = $request->input('adress').trim("");
        $rut_nat = $request->input('rut_nat').trim("");
        $rut = $request->input('rut').trim("");
        $titular_name_two = $request->input("name_titular_two").trim("");
        $bank_name = $request->input('bank_name').trim("");
        $type_account = $request->input('type_acount').trim("");
        if ($bank_name == "" and $type_account == "") {
            $bank_name = 0;
            $type_account = 0;
        }
        $numer_account = $request->input('number_account').trim("");
        $ckeck_cotitular = $request->input('info_cotitular').trim("");
        $cotitular_name = $request->input('name_cotitular').trim("");
        $rut_cotitular = $request->input('rut_cotitular').trim("");
        $sponsor = $request->input('code-sponsor').trim("");
        $socio_econ = $request->input('socio_econ').trim("");
        $playera=$request->input('shirt-size').trim("");
        $completecode=$request->input('codigo').trim("");
        $sponsor = $request->input('sponsor').trim("");
        $contrato = $request->input('contrato').trim("");
        $idcontrolci = $request->input('idcontrolci').trim("");
        $idusers = $request->input('idusers').trim("");
        $date_update=date("Y-m-d H:i:s");
        $kit= $request->input('kit').trim("");
        $kit3= $request->input('kit-club').trim("");
        $kit2= $request->input('kitoneusd').trim("");
        if ($kit == "") {
            $kit=$kit2;
        }
        if($playera == "9708" || $playera == 9708){
            $talla="M-Hombre";
        }else if($playera == "9709" || $playera == 9709){
            $talla="L-Hombre";
        }else if($playera == "9711" || $playera == 9711){
            $talla="S-Mujer";
        }else if($playera == "9712" || $playera == 9712){ 
            $talla="M-Mujer";
        }else{
            $talla="";
        }
        $user="Incorporacion web";
        $platform="https://nikkenlatam.com/incorporacion-web/";

        /* Compara si es ABI y es persona Natural entra aqui */

        if($type_incorporation == "1" && $type_per == "1"){

            $conection = \DB::connection('mysql_las');

        $contracts_update = $conection->update("UPDATE nikkenla_incorporation.contracts set name = '$titular_name', type_incorporate = '$type_per', email = '$email', cellular = '$cel', birthday = '$birthdate', address ='$address', residency_one = '$cp', residency_two = '$state', residency_three = '$city', residency_four = '$municipality', number_document = '$rut_nat', gender ='$gender', socio_econ = '$socio_econ', name_cotitular = '$cotitular_name', number_document_cotitular = '$rut_cotitular', bank = '$bank_name', bank_type = '$type_account', number_account = '$numer_account', kit = '$kit', playera = '$playera', talla = '$talla' where id_contract='$contrato'");

        \DB::disconnect('mysql_las');

        $conection = \DB::connection('mysql_las');

        $control_ci_update = $conection->update("UPDATE nikkenla_marketing.control_ci set nombre = '$titular_name',correo = '$email', celular = '$cel',actualizacion = '$date_update' WHERE idcontrol_ci = '$idcontrolci'");

        \DB::disconnect('mysql_las');

        $conection = \DB::connection('mysql_la_users');

        $users_update = $conection->update("UPDATE mitiendanikken.users set email = '$email',name = '$titular_name', phone = '$cel',cell_phone = '$cel', state = '$state', updated_at = '$date_update' WHERE id = '$idusers'");

        \DB::disconnect('mysql_la_users');

        if($contracts_update == 1 && $control_ci_update == 1){
            $kit= $request->input('kit').trim("");
            $kit2= $request->input('kitoneusd').trim("");
         if ($kit == "") {
            $kit=$kit2;
         }
            $kit_complete=$kit.':1';
            $products_two=$kit_complete.';'.$playera.':1';

           // echo $products_two;
          //  exit;

            return $this->checkOutAbi($email,$products_two);
        }else{
             $kit= $request->input('kit').trim("");
             $kit2= $request->input('kitoneusd').trim("");
         if ($kit == "") {
            $kit=$kit2;
         }
            $kit_complete=$kit.':1';
            $products_two=$kit_complete.';'.$playera.':1';
            return $this->checkOutAbi($email,$products_two);
            echo 'ocurrio un error por favor cierra esta ventana e intentalo nuevamente';
            exit;
        }

        }

        /* Compara si es ABI y es persona Natural con intereses entra aqui */


        else if($type_incorporation == "1" && $type_per == "2"){

                    $conection = \DB::connection('mysql_las');

        $contracts_update = $conection->update("UPDATE nikkenla_incorporation.contracts set name = '$titular_name', type_incorporate = '$type_per', email = '$email', cellular = '$cel', birthday = '$birthdate', address ='$address', residency_one = '$cp', residency_two = '$state', residency_three = '$city', residency_four = '$municipality', number_document = '$rut_nat', gender ='$gender', socio_econ = '$socio_econ', name_cotitular = '$cotitular_name', number_document_cotitular = '$rut_cotitular', bank = '$bank_name', bank_type = '$type_account', number_account = '$numer_account', kit = '$kit', playera = '$playera', talla = '$talla', person_type = '1' where id_contract='$contrato'");

        \DB::disconnect('mysql_las');

        $conection = \DB::connection('mysql_las');

        $control_ci_update = $conection->update("UPDATE nikkenla_marketing.control_ci set nombre = '$titular_name',correo = '$email', celular = '$cel',actualizacion = '$date_update' WHERE idcontrol_ci = '$idcontrolci'");

        \DB::disconnect('mysql_las');

        $conection = \DB::connection('mysql_la_users');

        $users_update = $conection->update("UPDATE mitiendanikken.users set email = '$email',name = '$titular_name', phone = '$cel',cell_phone = '$cel', state = '$state', updated_at = '$date_update' WHERE id = '$idusers'");

        \DB::disconnect('mysql_la_users');

        if($contracts_update == 1 && $control_ci_update == 1){
            $kit= $request->input('kit').trim("");
            $kit2= $request->input('kitoneusd').trim("");
         if ($kit == "") {
            $kit=$kit2;
         }
            $kit_complete=$kit.':1';
            $products_two=$kit_complete.';'.$playera.':1';

           // echo $products_two;
          //  exit;

            return $this->checkOutAbi($email,$products_two);
        }else{
            $kit= $request->input('kit').trim("");
            $kit2= $request->input('kitoneusd').trim("");
         if ($kit == "") {
            $kit=$kit2;
         }
            $kit_complete=$kit.':1';
            $products_two=$kit_complete.';'.$playera.':1';
            return $this->checkOutAbi($email,$products_two);
            echo 'ocurrio un error por favor cierra esta ventana e intentalo nuevamente';
            exit;
        }

     }


     /* Compara si es ABI y es persona Juridica(EMPRESA) entra aqui */
     else if($type_incorporation == "1" && $type_per == "0"){
            $conection = \DB::connection('mysql_las');

        $contracts_update = $conection->update("UPDATE nikkenla_incorporation.contracts set name = '$titular_name_jur', type_incorporate = '$type_per', email = '$email', cellular = '$cel_jur', birthday = '$birthdate', address ='$address', residency_one = '$cp', residency_two = '$state', residency_three = '$city', residency_four = '$municipality', number_document = '$rut', gender ='$gender', socio_econ = '$socio_econ', name_cotitular = '$cotitular_name', number_document_cotitular = '$rut_cotitular', bank = '$bank_name', bank_type = '$type_account', number_account = '$numer_account', kit = '$kit', playera = '$playera', talla = '$talla' where id_contract='$contrato'");

        \DB::disconnect('mysql_las');

        $conection = \DB::connection('mysql_las');

        $control_ci_update = $conection->update("UPDATE nikkenla_marketing.control_ci set nombre = '$titular_name_jur',correo = '$email', celular = '$cel_jur',actualizacion = '$date_update' WHERE idcontrol_ci = '$idcontrolci'");

        \DB::disconnect('mysql_las');

        $conection = \DB::connection('mysql_la_users');

        $users_update = $conection->update("UPDATE mitiendanikken.users set email = '$email',name = '$titular_name_jur', phone = '$cel_jur',cell_phone = '$cel_jur', state = '$state', updated_at = '$date_update' WHERE id = '$idusers'");

        \DB::disconnect('mysql_la_users');

        if($contracts_update == 1 && $control_ci_update == 1){
            $kit= $request->input('kit').trim("");
            $kit2= $request->input('kitoneusd').trim("");
         if ($kit == "") {
            $kit=$kit2;
         }
            $kit_complete=$kit.':1';
            $products_two=$kit_complete.';'.$playera.':1';

           // echo $products_two;
          //  exit;

            return $this->checkOutAbi($email,$products_two);
        }else{
           $kit= $request->input('kit').trim("");
           $kit2= $request->input('kitoneusd').trim("");
         if ($kit == "") {
            $kit=$kit2;
         }
            $kit_complete=$kit.':1';
            $products_two=$kit_complete.';'.$playera.':1';
            return $this->checkOutAbi($email,$products_two);
            echo 'ocurrio un error por favor cierra esta ventana e intentalo nuevamente';
            exit;
        }
    }  

    /* Compara si es CB y es persona Natural entra aqui */
    else if($type_incorporation == "0" && $type_per == "1"){

        $conection = \DB::connection('mysql_las');

        $contracts_update = $conection->update("UPDATE nikkenla_incorporation.contracts set name = '$titular_name', type_incorporate = '$type_per', email = '$email', cellular = '$cel', birthday = '$birthdate', address ='$address', residency_one = '$cp', residency_two = '$state', residency_three = '$city', residency_four = '$municipality', number_document = '$rut_nat', gender ='$gender', socio_econ = '$socio_econ' where id_contract='$contrato'");

        \DB::disconnect('mysql_las');

        $conection = \DB::connection('mysql_las');

        $control_ci_update = $conection->update("UPDATE nikkenla_marketing.control_ci set nombre = '$titular_name',correo = '$email', celular = '$cel',actualizacion = '$date_update' WHERE idcontrol_ci = '$idcontrolci'");

        \DB::disconnect('mysql_las');

        $conection = \DB::connection('mysql_la_users');

        $users_update = $conection->update("UPDATE mitiendanikken.users set email = '$email',name = '$titular_name', phone = '$cel',cell_phone = '$cel', state = '$state', updated_at = '$date_update' WHERE id = '$idusers'");

        \DB::disconnect('mysql_la_users');

        if($contracts_update == 1 && $control_ci_update == 1){
             if ($kit3 == 5031) {
                return $this->checkOutClub($email);
            }elseif ($kit3 == 5032) {
                return $this->checkOutClubApartado($email);
            }
            //return $this->checkOutClub($email);
            //echo 'el tus datos se actualizaron correctamente'
        }else{
            return $this->checkOutClub($email);
            //return $this->checkOutClub($email);
            echo 'ocurrio un error por favor cierra esta ventana e intentalo nuevamente';
            exit;
        }
    }

    /* Compara si es CB y es persona Natural con intereses entra aqui */
    else if($type_incorporation == "0" && $type_per == "2"){

        $conection = \DB::connection('mysql_las');

        $contracts_update = $conection->update("UPDATE nikkenla_incorporation.contracts set name = '$titular_name', type_incorporate = '$type_per', email = '$email', cellular = '$cel', birthday = '$birthdate', address ='$address', residency_one = '$cp', residency_two = '$state', residency_three = '$city', residency_four = '$municipality', number_document = '$rut_nat', gender ='$gender', socio_econ = '$socio_econ', person_type = '1' where id_contract='$contrato'");

        \DB::disconnect('mysql_las');

        $conection = \DB::connection('mysql_las');

        $control_ci_update = $conection->update("UPDATE nikkenla_marketing.control_ci set nombre = '$titular_name',correo = '$email', celular = '$cel',actualizacion = '$date_update' WHERE idcontrol_ci = '$idcontrolci'");

        \DB::disconnect('mysql_las');

        $conection = \DB::connection('mysql_la_users');

        $users_update = $conection->update("UPDATE mitiendanikken.users set email = '$email',name = '$titular_name', phone = '$cel',cell_phone = '$cel', state = '$state', updated_at = '$date_update' WHERE id = '$idusers'");

        \DB::disconnect('mysql_la_users');

        if($contracts_update == 1 && $control_ci_update == 1){
             if ($kit3 == 5031) {
                return $this->checkOutClub($email);
            }elseif ($kit3 == 5032) {
                return $this->checkOutClubApartado($email);
            }
            //echo 'el tus datos se actualizaron correctamente'
        }else{
            return $this->checkOutClub($email);
            //return $this->checkOutClub($email);
            echo 'ocurrio un error por favor cierra esta ventana e intentalo nuevamente';
            exit;
        }
    }

    /* Compara si es CB y es persona Juridica (EMPRESA) entra aqui */
    else if($type_incorporation == "0" && $type_per == "0"){
                $conection = \DB::connection('mysql_las');

        $contracts_update = $conection->update("UPDATE nikkenla_incorporation.contracts set name = '$titular_name_jur', type_incorporate = '$type_per', email = '$email', cellular = '$cel_jur', birthday = '$birthdate', address ='$address', residency_one = '$cp', residency_two = '$state', residency_three = '$city', residency_four = '$municipality', number_document = '$rut', gender ='$gender', socio_econ = '$socio_econ', person_type = '1', name_legal_representative = '$titular_name_two' where id_contract='$contrato'");

        \DB::disconnect('mysql_las');

        $conection = \DB::connection('mysql_las');

        $control_ci_update = $conection->update("UPDATE nikkenla_marketing.control_ci set nombre = '$titular_name_jur',correo = '$email', celular = '$cel_jur',actualizacion = '$date_update' WHERE idcontrol_ci = '$idcontrolci'");

        \DB::disconnect('mysql_las');

        $conection = \DB::connection('mysql_la_users');

        $users_update = $conection->update("UPDATE mitiendanikken.users set email = '$email',name = '$titular_name_jur', phone = '$cel_jur',cell_phone = '$cel_jur', state = '$state', updated_at = '$date_update' WHERE id = '$idusers'");

        \DB::disconnect('mysql_la_users');

        if($contracts_update == 1 && $control_ci_update == 1){
             if ($kit3 == 5031) {
                return $this->checkOutClub($email);
            }elseif ($kit3 == 5032) {
                return $this->checkOutClubApartado($email);
            }
            //echo 'el tus datos se actualizaron correctamente'
        }else{
            return $this->checkOutClub($email);
            //return $this->checkOutClub($email);
            echo 'ocurrio un error por favor cierra esta ventana e intentalo nuevamente';
            exit;
        }

    }

    \DB::beginTransaction();

    try {

        $conection = \DB::connection('mysql_las');

        $valido = $conection->select("SELECT email FROM nikkenla_incorporation.contracts where email = '$email'");

        \DB::disconnect('mysql_las');


        if($valido){

        }
        else{
            $incController->save();
            $incControlci->save();
            $incUsers->save();
        }

        \DB::commit();

        if($type_incorporation == 0){
            return $this->checkOutClub($email);
        }
        else{
            $kit= $request->input('kit').trim("");
            $kit_complete=$kit.':1';
            $products_two=$kit_complete.';'.$playera.':1';

           // echo $products_two;
          //  exit;

            return $this->checkOutAbi($email,$products_two);
        }

    } catch (\Exception $e) {
//notify to the users error message and finally script

     \DB::rollback();
       //return view('data',array('correo' => $email));
     echo('Ocurrio un error'.$e->getMessage());

 }

}


public function retomar(Request $request){
        
        //$correo = $request->correo;
        $correo= $request->input('correo').trim("");
        $language = $request->language;
        $country = $request->country;

        App::setLocale($language);

        if ($language == 'spa' && $country == 'ch') {
            $countryN = 1;
        }

        else if ($language == 'en' && $country == 'ch') {
            $countryN = 1;
        }

        if($correo==""){
            return \Redirect::to('/')
                    ->with('notice', 'Por favor digita un correo')
                    ->with('alertClass', 'alert-danger');
        }
        else {
            $control_ci_test = ControlciTest::select('idcontrol_ci')
            ->where('correo','=', $correo)
            ->first();

            $contracts_test = ContractsTest::select('*')
            ->where('email','=', $correo)
            ->first();

            $users_test = UsersTest::select('*')
            ->where('email','=', $correo)
            ->first();

            if($contracts_test){
            
                $code = $contracts_test->code;
                $name = $contracts_test->name;
                $pago = $contracts_test->payment;
                $sponsor = $contracts_test->sponsor;
            
            if($pago != 0){
                return \Redirect::to('/')
                    ->with('notice', 'Ya se completo tu incorporación. ')
                    ->with('alertClass', 'alert-success');
                
            }else {
                if($sponsor == 0)
                {
                    return \Redirect::to('/')
                    ->with('notice', 'aun no se te asigna un patrocinador. ')
                    ->with('alertClass', 'alert-danger');
                }
                else
                {
                    try {
                        App::setLocale('spa');
                        
                    //return \Redirect::to('index', array('country' => $country,'language' => $language,'contracts' => $contracts_test, 'control_ci_id' => $control_ci_test, 'users' => $users_test))->with('notice', 'Event create succesfull. ')              ->with('alertClass', 'alert-success');

                       return view('retomar.retomar', array('country' => $country,'language' => $language,'contracts' => $contracts_test, 'control_ci_id' => $control_ci_test, 'users' => $users_test));


                        //return 1;

                    } catch (Exception $e) {

                        return \Redirect::to('/')
                    ->with('notice', 'hubo un error. '.$e)
                    ->with('alertClass', 'alert-danger');

                    }  
                }
            }
        }else {
            return \Redirect::to('/')
                    ->with('notice', 'el correo ingresado no existe. ')
                    ->with('alertClass', 'alert-danger');
        }


          }

      }



    public function playeras(Request $request){
        $gender = $request->gender;
        $kit = $request->kit;


        

        $conection = \DB::connection('mysql_las');

        $playeras = $conection->select("SELECT * FROM nikkenla_incorporation.cat_shirts WHERE pais = 'CHL' AND genero = '$gender' ");

        \DB::disconnect('mysql_las');

        return $playeras;
    }

    /**
    * Funcion que regresa la vista del index y recibe un parametro si viene del preregistro
    */
    public function index(Request $request){
        $email=$request->email;

       return view('index',array("email"=>$email));
       // return view('mantenimiento');
    }

    public function mantenimiento(Request $request){
        
        
        return Redirect::to('https://services.nikken.com.mx/mantenimientoTiendaKoi');
       //return view('mantenimiento');
       //  return view('mantenimiento');
    }

     /**
    * Funcion que regresa la vista del index y recibe un parametro si viene del preregistro club
    */
     public function indexClub(Request $request){
        $email=$request->email;
        return view('index-club',array("email"=>$email));
    }


    /**
    * Función que regresa la vista del club de bienestar y trae los valores que nececita la vista
    */

    public function club(Request $request){
        $language = $request->language;
        $country = $request->country;

        App::setLocale($language);

        if ($language == 'spa' && $country == 'ch') {
            $countryN = 1;
        }

        else if ($language == 'en' && $country == 'ch') {
            $countryN = 1;
        }

        $states="estados";
        $cities="citys";

        $conection = \DB::connection('mysql_las');

        $states = $conection->select("SELECT distinct state_name FROM nikkenla_incorporation.control_states_test where pais='$country' ");

        \DB::disconnect('mysql_las');

        return view('cb', array('country' => $country,'language' => $language, 'states' => $states));
    }


    /**
    * Función que regresa la vista del la incorporación completa y trae los valores que nececita la vista
    */
    public function profile(Request $request){
        
        $language = $request->language;
        $country = $request->country;

        App::setLocale($language);

        if ($language == 'spa' && $country == 'ch') {
            $countryN = 1;
        }

        else if ($language == 'en' && $country == 'ch') {
            $countryN = 1;
        }

        $states="estados";
        $cities="citys";

        $conection = \DB::connection('mysql_las');

        $states = $conection->select("SELECT distinct state_name FROM nikkenla_incorporation.control_states_test where pais='$country' ");

        \DB::disconnect('mysql_las');

        return view('profile', array('country' => $country,'language' => $language, 'states' => $states));
       //  return view('mantenimiento');
    }

    /**
    * Función que regresa la vista del retomar la incorporacion y trae los valores que nececita la vista consulta los datos de la BD SQL
    */


/**
    * Función que regresa los estados para ser mostrados en las vistas
    */
public function states(Request $request){
    $estados=$request->getstate;

    $conection = \DB::connection('mysql_las');

    $states = $conection->select("SELECT distinct state_name, abreviature_state FROM nikkenla_marketing.control_states where pais='$estados' order by state_name ASC");

    \DB::disconnect('mysql_las');

    return \json_encode($states);


}

    /**
    * Función que regresa las ciudades para ser mostradas en la vista
    */
    public function municipality(Request $request){
        $state= str_replace("%", " ", $request->reg);

        $conection = \DB::connection('mysql_las');

                //Obtenemos los datos del abi
        $cities= $conection->table('nikkenla_marketing.control_states')
        ->select('province_name as province_name')
        ->where('abreviature_state','=', $state)
        ->distinct('state_name')
        ->where('pais','=', 10)
        ->orderBy('province_name', 'ASC')
        ->get();
        




            //$cities = $conection->select("SELECT distinct province_name FROM nikkenla_incorporation.control_states_test where pais='10' and state_name = '$state'");

        \DB::disconnect('mysql_las');

        return \json_encode($cities);

    }

        /**
    * Función que regresa las ciudades para ser mostradas en la vista
    */
        public function ciudad(Request $request){
            $ciudad= str_replace("%", " ", $request->ciudad);

            $conection = \DB::connection('mysql_las');

                //Obtenemos los datos del abi
            $ciudades= $conection->table('nikkenla_marketing.control_states')
            ->select('colony_name as colony_name')
            ->where('province_name','=', $ciudad)
            ->distinct('province_name')
            ->where('pais','=', 10)
            ->orderBy('colony_name', 'ASC')
            ->get();


            //$cities = $conection->select("SELECT distinct province_name FROM nikkenla_incorporation.control_states_test where pais='10' and state_name = '$state'");

            \DB::disconnect('mysql_las');

            return \json_encode($ciudades);

        }
/*
public function searchsponsor(Request $request){
        $codigo=$request->code;

        $conection = \DB::connection('mysql_la');

        $consulta = $conection->select("SELECT  nombre,codigo  FROM nikkenla_marketing.control_ci_test where codigo like '%$codigo%' or nombre like '%$codigo%' or codigo = '$codigo' or nombre = '$codigo' and estatus = 1 and b1 = 1 LIMIT 3");
       
        \DB::disconnect('mysql_la');

        if($codigo == '' || $codigo == '24188303' || $codigo == '241883' || $codigo == '2418830' || $codigo == '0' || $codigo == '1' || $codigo == '12' || $codigo == '123' || $codigo == '1234' || $codigo == '12345' || $codigo == '123456' || $codigo == '1234567' || $codigo == '12345678' || $codigo == '123456789'){
            return 'code_no_exist';
        }

        return \json_encode($consulta);

    }
*/

    /**
    * Función que se encarga de consultar en la BD los sponsor
    */
    
    public function searchsponsor(Request $request){
        $codigo=$request->code;

        $conection = \DB::connection('mysql_las');
/*
        $consulta= $conection->table('nikkenla_marketing.control_ci_test')
            ->select('nombre as nombre','codigo AS codigo')
            ->where('codigo','LIKE',"%$codigo%")
            ->orWhere('nombre','LIKE',"%$codigo%")
            ->where('estatus','=', 1)
            ->where('b1','=', 1)
            ->toSql();

            echo($consulta);
*/
            
            $consulta = $conection->select("SELECT  nombre,codigo  FROM nikkenla_marketing.control_ci where estatus = '1' and b1 = '1' and codigo like '%$codigo%' or nombre like '%$codigo%'and estatus = '1' and b1 = '1' or codigo = '$codigo' and estatus = '1' and b1 = '1' or nombre = '$codigo' and estatus = 1 and b1 = 1 LIMIT 3");

            
            \DB::disconnect('mysql_las');



            if($codigo == '' || $codigo == '24188303' || $codigo == '241883' || $codigo == '2418830' || $codigo == '0' || $codigo == '1' || $codigo == '12' || $codigo == '123' || $codigo == '1234' || $codigo == '12345' || $codigo == '123456' || $codigo == '1234567' || $codigo == '12345678' || $codigo == '123456789'){
                return '1';
                exit;
            }

            if($consulta){
                return \json_encode($consulta);
            }
            else{
                return '2';
                exit;
            }


        }


        public function searchsponsorValid(Request $request){
            $codigo=$request->code;

            $conection = \DB::connection('mysql_las');
            
            $consulta = $conection->select("SELECT  nombre,codigo  FROM nikkenla_marketing.control_ci where codigo = '$codigo' or nombre = '$codigo' and estatus = 1 and b1 = 1 LIMIT 3");

            \DB::disconnect('mysql_las');



            if($codigo == '' || $codigo == '24188303' || $codigo == '241883' || $codigo == '2418830' || $codigo == '0' || $codigo == '1' || $codigo == '12' || $codigo == '123' || $codigo == '1234' || $codigo == '12345' || $codigo == '123456' || $codigo == '1234567' || $codigo == '12345678' || $codigo == '123456789'){
                return '1';
                exit;
            }

            if($consulta){
                return \json_encode($consulta);
            }
            else{
                return '2';
                exit;
            }


        }



    /**
    * Función que consulta el nombre de los bancos para ser mostrados en la vista
    */
    public function getbanks(Request $request){
        $pais=$request->pais;

        $conection = \DB::connection('mysql_las');

        $bank = $conection->select("SELECT id_bank, name FROM nikkenla_office.control_banks where country = '$pais' order by name ASC");

        \DB::disconnect('mysql_las');

        return \json_encode($bank);

    }

    /**
    * Función que consulta el tipo de los bancos para ser mostrados en la vista
    */
    public function gettypebankeacount(Request $request){
        $pais=$request->pais;

        $conection = \DB::connection('mysql_las');

        $banktype = $conection->select("SELECT id_bank_type, name FROM nikkenla_office.control_banks_type where country = '$pais' order by name ASC");

        \DB::disconnect('mysql_las');

        return \json_encode($banktype);

    }

        //Generar consecutivo de código
function Code_consecutive()
{
    $conection = \DB::connection('mysql_las');

        $consecutive = $conection->select("SELECT code FROM nikkenla_incorporation.consecutive_codes order by code DESC limit 1");

        \DB::disconnect('mysql_las');

        $nuevocode = $consecutive[0]->code + 2;
        $last_digits="03";
        $completecode = $nuevocode.$last_digits;
        $conection = \DB::connection('mysql_las');
        $consecutive = $conection->insert("INSERT INTO nikkenla_incorporation.consecutive_codes (code) VALUES ('$nuevocode')");
        \DB::disconnect('mysql_las');
      

      return $completecode;
}
//Generar consecutivo de código

function Code_consecutive_second()
{
    $conection = \DB::connection('mysql_las');

        $consecutive = $conection->select("SELECT code FROM nikkenla_incorporation.consecutive_codes order by code DESC limit 1");

        \DB::disconnect('mysql_las');

        $nuevocode = $consecutive[0]->code + 1;
        $last_digits="03";
        $completecode = $nuevocode.$last_digits;
        $conection = \DB::connection('mysql_las');
        $consecutive = $conection->insert("INSERT INTO nikkenla_incorporation.consecutive_codes (code) VALUES ('$nuevocode')");
        \DB::disconnect('mysql_las');
      

      return $completecode;
}
//Generar consecutivo de código

    /**
        * Función que asigna un spnsor automaticamente
        */
        function Assigned_sponsor($name,$email,$phone,$country,$state,$platform,$user)
        {

            try {
                 //Asignar sponsor

                $ch = curl_init();

                //curl_setopt($ch, CURLOPT_URL,"servicios.nikkenlatam.com/panel/administracion/services/assigned-sponsor/prod.php");
                curl_setopt($ch, CURLOPT_URL,"https://nikkenlatam.com/interno/regional/panel-marketing-v1/administracion/services/assigned-sponsor/prod.php");
                curl_setopt($ch, CURLOPT_POST, TRUE);
                curl_setopt($ch, CURLOPT_POSTFIELDS, "name=$name&email=$email&phone=$phone&country=$country&state=$state&platform=$platform&user=$user");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $remote_server_output = curl_exec ($ch);

                $data = $remote_server_output;


                $codes =  substr($data, 4);
                $array = explode("|",$codes);

                $code = $array[0];

                $id = $data[0];
                
                trim($id);




                if($id == "1"){
                    return $code;
                }      
                
            } catch (Exception $e) {

                echo($e->getMessage());
                
            }
        }

 /**
    * Función que obtiene todos los datos de las vistas y guarda en las BD
    */
 public function store(Request $request){
    //return $request;
    $kit3="";
    $boleto="";
    $creacion = date("Y-m-d H:i:s");
    $country = $request->input('country').trim("");
    $type_incorporation = $request->input('type_inc').trim("");
    $type_per = $request->input('type_per').trim("");
    $type_sponsor = $request->input('type_sponsor').trim("");
    $birthdate = $request->input('date_born').trim("");
    $birthdate = explode('-', $birthdate);
    $birthdate = $birthdate[2].'-'.$birthdate[1].'-'.$birthdate[0];
    $titular_name = $request->input('name_titular').trim("");
    $titular_name_ape = $request->input('name_titular_ape').trim("");
    $titular_name=$titular_name.", ".$titular_name_ape;
    $titular_name = strtoupper($titular_name);
    $titular_name_jur = $request->input('name_titular_jur').trim("");
    $email = $request->input('email').trim("");
    $email=strtolower($email);
    $gender = $request->input('gender').trim("");
    $cel = $request->input('cel').trim("");
    $cel_jur = $request->input('cel_jur').trim("");
    $cp = $request->input('postal_code').trim("");

    /*CHILE CHANGUE CIUDAD*/
    $state = $request->input('region').trim("");
    $state= str_replace("%", " ", $state);
    $municipality = $request->input('comuna').trim("");
    $municipality = str_replace("%", " ", $municipality);
    $city = $request->input('ciudad').trim("");
    $city = str_replace("%", " ", $city);
    /*CHILE CHANGUE CIUDAD*/

    //$address = $request->input('adress').trim("");
    $calle = $request->input('street').trim("");
    $numero = $request->input('number').trim("");
    $address=$calle."|".$numero;

    if ($calle == '') {
        echo "error en dirección";
        exit;
    }
    
    $rut_nat = $request->input('rut_nat').trim("");
    $rut = $request->input('rut').trim("");
    $titular_name_two = $request->input("name_titular_two").trim("");
    $bank_name = $request->input('bank_name').trim("");
    $type_account = $request->input('type_acount').trim("");
    if ($bank_name == "" and $type_account == "") {
        $bank_name = 0;
        $type_account = 0;
    }
    $numer_account = $request->input('number_account').trim("");
    $ckeck_cotitular = $request->input('info_cotitular').trim("");
    $cotitular_name = $request->input('name_cotitular').trim("");
    $rut_cotitular = $request->input('rut_cotitular').trim("");
    $sponsor = $request->input('code-sponsor').trim("");
    //$codigopre = $request->input('idsponsor').trim("");
    $socio_econ = $request->input('socio_econ').trim("");
    $playera=$request->input('shirt-size').trim("");
    $talla="";
    $kit= $request->input('kit').trim("");
    $kit3= $request->input('kit-cb').trim("");
    $boleto=$request->input('boleto').trim("");

        
    //return "terminando las variables";

        $user="Incorporacion web";
        $platform="https://nikkenlatam.com/incorporacion-web/";

        if($titular_name != ""){
            if($type_sponsor == "3"){
                 $sponsor = $this->Assigned_sponsor('Ciudadano Chile',$email,$cel,$country,$state,$platform,$user);
                 if($sponsor == 0){  
                    $sponsor = 0;
                }
                //$sponsor = Assigned_sponsor($titular_name,$email,$cel,$country,$state,$platform,$user);
            }
            else{
                $sponsor = $request->input('code-sponsor').trim("");
                if($sponsor == 0){  
                    $sponsor = 0;
                }
            }
        }else{
            if($type_sponsor == "3"){
                $sponsor = $this->Assigned_sponsor('Ciudadano Chile',$email,$cel,$country,$state,$platform,$user);
                if($sponsor == 0){  
                    $sponsor = 0;
                }
                //$sponsor = Assigned_sponsor($titular_name_jur,$email,$cel,$country,$state,$platform,$user);
            }else{
                $sponsor = $request->input('code-sponsor').trim("");
                if($sponsor == 0){  
                    $sponsor = 0;
                }
            }
        }
        /**
        * Función que genera el id de contrato
        */
        $id = date("ymd") . date("His") . rand(1, 99);

        $conection = \DB::connection('mysql_las');

        $consecutive = $conection->select("SELECT code FROM nikkenla_incorporation.consecutive_codes_test order by code DESC limit 1");

        \DB::disconnect('mysql_las');

        $nuevocode = $consecutive[0]->code + 2;
        $last_digits="03";
        $completecode = $nuevocode.$last_digits;
        $conection = \DB::connection('mysql_las');
        $consecutive = $conection->insert("INSERT INTO nikkenla_incorporation.consecutive_codes_test (code) VALUES ('$nuevocode')");
        \DB::disconnect('mysql_las');
        $ip = $_SERVER["REMOTE_ADDR"];
        $browser = $_SERVER['HTTP_USER_AGENT'];
        $type_letter = "";
        if($type_incorporation == "1"){
            $type_letter = "CI";
        }
        else{
            $type_letter = "CLUB";
        }

        

        if ($kit == 5002 || $kit=="5002" and $boleto != '') {

            $conection = \DB::connection('mysql_las');
                $user_promotion_exist = $conection->select("SELECT code_ticket FROM nikkenla_incorporation.user_promotion_kit_test where code_ticket = '$boleto'");
            \DB::disconnect('mysql_las');

            if ($user_promotion_exist) {
                echo "El boleto".$boleto."ya fue utilizado";
                exit;
            }

            $conection = \DB::connection('mysql_las');
                $user_promotion = $conection->insert("INSERT INTO nikkenla_incorporation.user_promotion_kit_test (code_sponsor, code_redeem, kit, status, country_id, code_ticket, created_at) VALUES ('$sponsor','$completecode','$kit','2','10','$boleto','$creacion')");
            \DB::disconnect('mysql_las');
        }

$fileone = $request->file('fileone');
$filetwo = $request->file('filetwo');
$filetrhee = $request->file('filetrhee');


      $urlscompletes='';

      if ($request->hasFile('fileone') && $request->fileone) {

       $disk = \Storage::disk('gcs');
         
       $name1 = $request->file('fileone')->getClientOriginalName();
       $disk->put('CHL/' . $name1,file_get_contents($request->file('fileone')->getPathName()));
       $full_pathone = $disk->url('CHL/' .$name1);


      $urlscompletes=$full_pathone;
      
      
    }


    if ($request->hasFile('filetwo') && $request->filetwo) {


         $disk = \Storage::disk('gcs');
         
       $name2 = $request->file('filetwo')->getClientOriginalName();
       $disk->put('CHL/' . $name2,file_get_contents($request->file('filetwo')->getPathName()));
       $full_pathtwo = $disk->url('CHL/' .$name2);
      $urlscompletes=$full_pathone.";".$full_pathtwo;
     
      
      
    }

    if ($request->hasFile('filetrhee') && $request->filetrhee) {

        $disk = \Storage::disk('gcs');
         
       $name3 = $request->file('filetrhee')->getClientOriginalName();
       $disk->put('CHL/' . $name3,file_get_contents($request->file('filetrhee')->getPathName()));
       $full_paththree = $disk->url('CHL/' .$name3);
      $urlscompletes=$full_paththree;
      

      
      
    }


/*
       
       if ($request->hasFile('fileone') && $request->fileone) {

        $name1 = $fileone->getClientOriginalName();

      $path = $request->file('fileone')->store(
        incorporacionController::S3_SLIDERS_FOLDER,
        incorporacionController::S3_OPTIONS
      );



                //asi obtienes la url donde se guardo
      $full_pathone = Storage::disk('s3')->url($path);


      $urlscompletes=$full_pathone;
      
      
    }

    if ($request->hasFile('filetwo') && $request->filetwo) {

        $name2 = $filetwo->getClientOriginalName();

      $path2 = $request->file('filetwo')->store(
        incorporacionController::S3_SLIDERS_FOLDER,
        incorporacionController::S3_OPTIONS
      );

                //asi obtienes la url donde se guardo
      $full_pathtwo = Storage::disk('s3')->url($path2);
      $urlscompletes=$full_pathone.";".$full_pathtwo;
     
      
      
    }

    if ($request->hasFile('filetrhee') && $request->filetrhee) {

        $name3 = $filetrhee->getClientOriginalName();

      $path3 = $request->file('filetrhee')->store(
        incorporacionController::S3_SLIDERS_FOLDER,
        incorporacionController::S3_OPTIONS
      );

                //asi obtienes la url donde se guardo
      $full_paththree = Storage::disk('s3')->url($path3);
      $urlscompletes=$full_paththree;
      

      
      
    }
*/
    

    $conection = \DB::connection('mysql_las');

        $signupfiles = $conection->select("INSERT INTO  nikkenla_incorporation.signupfiles (sap_code,name,filepath,country_id,created_at) VALUES ('$completecode','$titular_name','$urlscompletes','10','$creacion')");

    \DB::disconnect('mysql_las');

    

       



        /**
        * Función que genera el registro si es abi y persona natural y viene del preregistro
        */
        //Init transaction store
        /*
        if($type_incorporation == "1" && $type_per == "1" && $codigopre != ""){
         
         $incController = new ContractsTest();
         $incController->id_contract = $id;
         $incController->country = $country;
         $incController->code = $codigopre;
         $incController->name = $titular_name;
         $incController->type = $type_incorporation;
         $incController->type_incorporate = $type_per;
         $incController->type_sponsor = $type_sponsor;
         $incController->sponsor = $sponsor;
         $incController->email = $email;
         $incController->cellular = $cel;
         $incController->birthday = $birthdate;
         $incController->address = $address;
         $incController->residency_one = $cp;
         $incController->residency_two = $state;
         $incController->residency_three = $municipality;
         $incController->type_document = 10;
         $incController->number_document = $rut_nat;
         $incController->name_cotitular = $cotitular_name;
         $incController->type_document_cotitular = 10;
         $incController->number_document_cotitular = $rut_cotitular;
         $incController->bank = $bank_name;
         $incController->bank_type = $type_account;
         $incController->number_account = $numer_account;
         $incController->ip = $ip;
         $incController->browser = $browser;
         $incController->gender = $gender;
         if($socio_econ == ""){
            $socio_econ="Sin inicio de actividades";
        }
        $incController->socio_econ = $socio_econ;
        
        $incControlci = new ControlciTest();
        $incControlci->pais = $country;
        $incControlci->tipo = $type_letter;
        $incControlci->codigo = $codigopre;
        $incControlci->nombre = $titular_name;
        $incControlci->codigop = $sponsor;
        $incControlci->correo = $email;
        $incControlci->celular = $cel;
        $incControlci->b1 = 1;
        $incControlci->b2 = 1;
        $incControlci->actualizacion = date("Y-m-d H:i:s");
        

        $incUsers = new UsersTest();
        $incUsers->country_id = $country;
        $incUsers->email = $email;
        $incUsers->sap_code = $codigopre;
        $incUsers->sap_code_sponsor = $sponsor;
        $incUsers->password = '0';
        $incUsers->secret_nikken = '6cl4nHQECtM=';
        $incUsers->client_type = $type_letter;
        $incUsers->rank = 'Directo';
        $incUsers->name = $titular_name;
        $incUsers->last_name = '';
        $incUsers->identification_number = '0';
        $incUsers->phone = $cel;
        $incUsers->cell_phone = $cel;
        $incUsers->state = $state;
        $incUsers->status = '1';
        $incUsers->created_at = date("Y-m-d H:i:s");
        $incUsers->updated_at = date("Y-m-d H:i:s");
        $incUsers->last_password_update = date("Y-m-d H:i:s");
        
        
    }
*/


            /**
            * Función que genera el registro si es abi y persona natural con intereses y viene del preregistro
            */
            /*
            else if($type_incorporation == "1" && $type_per == "2" && $codigopre != ""){
             
                $incController = new ContractsTest();
                $incController->id_contract = $id;
                $incController->country = $country;
                $incController->code = $codigopre;
                $incController->name = $titular_name;
                $incController->type = $type_incorporation;
                $incController->type_incorporate = 1;
                $incController->type_sponsor = $type_sponsor;
                $incController->sponsor = $sponsor;
                $incController->email = $email;
                $incController->cellular = $cel;
                $incController->birthday = $birthdate;
                $incController->address = $address;
                $incController->residency_one = $cp;
                $incController->residency_two = $state;
                $incController->residency_three = $municipality;
                $incController->type_document = 10;
                $incController->number_document = $rut_nat;
                $incController->name_cotitular = $cotitular_name;
                $incController->type_document_cotitular = 10;
                $incController->number_document_cotitular = $rut_cotitular;
                $incController->bank = $bank_name;
                $incController->bank_type = $type_account;
                $incController->number_account = $numer_account;
                $incController->ip = $ip;
                $incController->browser = $browser;
                $incController->gender = $gender;
                $incController->socio_econ = $socio_econ;
                $incController->person_type = 1;
                

                $incControlci = new ControlciTest();
                $incControlci->pais = $country;
                $incControlci->tipo = $type_letter;
                $incControlci->codigo = $codigopre;
                $incControlci->nombre = $titular_name;
                $incControlci->codigop = $sponsor;
                $incControlci->correo = $email;
                $incControlci->celular = $cel;
                $incControlci->b1 = 1;
                $incControlci->b2 = 1;
                $incControlci->actualizacion = date("Y-m-d H:i:s");
                

                $incUsers = new UsersTest();
                $incUsers->country_id = $country;
                $incUsers->email = $email;
                $incUsers->sap_code = $codigopre;
                $incUsers->sap_code_sponsor = $sponsor;
                $incUsers->password = '0';
                $incUsers->secret_nikken = '6cl4nHQECtM=';
                $incUsers->client_type = $type_letter;
                $incUsers->rank = 'Directo';
                $incUsers->name = $titular_name;
                $incUsers->last_name = '';
                $incUsers->identification_number = '0';
                $incUsers->phone = $cel;
                $incUsers->cell_phone = $cel;
                $incUsers->state = $state;
                $incUsers->status = '1';
                $incUsers->created_at = date("Y-m-d H:i:s");
                $incUsers->updated_at = date("Y-m-d H:i:s");
                $incUsers->last_password_update = date("Y-m-d H:i:s");
                
                
            }
                */

             /* Función que genera el registro si es abi y persona juridica y viene del preregistro
            */

             /*
             else if($type_incorporation == "1" && $type_per == "0" && $codigopre != ""){
                 
                $incController = new ContractsTest();
                $incController->id_contract = $id;
                $incController->country = $country;
                $incController->code = $codigopre;
                $incController->name = $titular_name_jur;
                $incController->type = $type_incorporation;
                $incController->type_incorporate = $type_per;
                $incController->type_sponsor = $type_sponsor;
                $incController->sponsor = $sponsor;
                $incController->email = $email;
                $incController->cellular = $cel_jur;
                $incController->birthday = $birthdate;
                $incController->address = $address;
                $incController->residency_one = $cp;
                $incController->residency_two = $state;
                $incController->residency_three = $municipality;
                $incController->name_legal_representative = $titular_name_two;
                $incController->type_document = 10;
                $incController->number_document = $rut;
                $incController->name_cotitular = $cotitular_name;
                $incController->type_document_cotitular = 10;
                $incController->number_document_cotitular = $rut_cotitular;
                $incController->bank = $bank_name;
                $incController->bank_type = $type_account;
                $incController->number_account = $numer_account;
                $incController->ip = $ip;
                $incController->browser = $browser;
                $incController->gender = $gender;
                $incController->socio_econ = $socio_econ;
                

                $incControlci = new ControlciTest();
                $incControlci->pais = $country;
                $incControlci->tipo = $type_letter;
                $incControlci->codigo = $codigopre;
                $incControlci->nombre = $titular_name_jur;
                $incControlci->codigop = $sponsor;
                $incControlci->correo = $email;
                $incControlci->celular = $cel_jur;
                $incControlci->b1 = 1;
                $incControlci->b2 = 1;
                $incControlci->actualizacion = date("Y-m-d H:i:s");
                

                $incUsers = new UsersTest();
                $incUsers->country_id = $country;
                $incUsers->email = $email;
                $incUsers->sap_code = $codigopre;
                $incUsers->sap_code_sponsor = $sponsor;
                $incUsers->password = '0';
                $incUsers->secret_nikken = '6cl4nHQECtM=';
                $incUsers->client_type = $type_letter;
                $incUsers->rank = 'Directo';
                $incUsers->name = $titular_name_jur;
                $incUsers->last_name = '';
                $incUsers->identification_number = '0';
                $incUsers->phone = $cel_jur;
                $incUsers->cell_phone = $cel_jur;
                $incUsers->state = $state;
                $incUsers->status = '1';
                $incUsers->created_at = date("Y-m-d H:i:s");
                $incUsers->updated_at = date("Y-m-d H:i:s");
                $incUsers->last_password_update = date("Y-m-d H:i:s");
                
                
            }
            */

            /* Compara si es ABI y es persona Natural entra aqui */

            if($playera == "9708"){
        $talla="M-Hombre";
      }if($playera == "9709"){
            $talla="L-Hombre";
      }if($playera == "9711"){
        $talla="S-Mujer";

      }if($playera == "9712"){ 
        $talla="M-Mujer";
      }

            if($type_incorporation == "1" && $type_per == "1"){
                if($playera == "9708"){
        $talla="M-Hombre";
      }if($playera == "9709"){
            $talla="L-Hombre";
      }if($playera == "9711"){
        $talla="S-Mujer";

      }if($playera == "9712"){ 
        $talla="M-Mujer";
      }

               $incController = new ContractsTest();
               $incController->id_contract = $id;
               $incController->country = $country;
        $conection = \DB::connection('mysql_las');
        $consecutive = $conection->select("SELECT code FROM nikkenla_incorporation.contracts_test where code='$completecode'");
        \DB::disconnect('mysql_las');
        if ($consecutive) {
        $incController->code = $this->Code_consecutive_second();
        }else{
        $incController->code = $completecode;
        }
               $incController->name = $titular_name;
               $incController->type = $type_incorporation;
               $incController->type_incorporate = $type_per;
               $incController->type_sponsor = $type_sponsor;
               $incController->sponsor = $sponsor;
               $incController->email = $email;
               $incController->cellular = $cel;
               $incController->birthday = $birthdate;
               $incController->address = $address;

               /*CHILE CHANGUE CIUDAD*/
               $incController->residency_one = $cp;
               $incController->residency_two = $state;
               $incController->residency_three = $city;
               $incController->residency_four = $municipality;
               /*CHILE CHANGUE CIUDAD*/

               $incController->type_document = 10;
               $incController->number_document = $rut_nat;
               $incController->name_cotitular = $cotitular_name;
               $incController->type_document_cotitular = 10;
               $incController->number_document_cotitular = $rut_cotitular;
               $incController->bank = $bank_name;
               $incController->bank_type = $type_account;
               $incController->number_account = $numer_account;
               $incController->ip = $ip;
               $incController->browser = $browser;
               $incController->gender = $gender;
               if($socio_econ == ""){
                $socio_econ="Sin inicio de actividades";
            }
            $incController->socio_econ = $socio_econ;
            $incController->kit = $kit;
            if($kit!="5006" || $kit != 5006 || $kit!="5002" || $kit != 5002){
        
        $incController->playera = $playera;
        $incController->talla = $talla;
        }
            

            $incControlci = new ControlciTest();
            $incControlci->pais = $country;
            $incControlci->tipo = $type_letter;
            $conection = \DB::connection('mysql_las');
            $consecutive_ci = $conection->select("SELECT codigo FROM nikkenla_marketing.control_ci_test where codigo='$completecode'");
            \DB::disconnect('mysql_las');
            if ($consecutive_ci) {
                $incControlci->codigo = $this->Code_consecutive_second();
            }else{
                $incControlci->codigo = $completecode;
            }
            $incControlci->nombre = $titular_name;
            $incControlci->codigop = $sponsor;
            $incControlci->correo = $email;
            $incControlci->celular = $cel;
            $incControlci->b1 = 1;
            $incControlci->b2 = 1;
            $incControlci->actualizacion = date("Y-m-d H:i:s");
            

            $incUsers = new UsersTest();

            $incUsers->country_id = $country;
            $incUsers->email = $email;
            $incUsers->sap_code = $completecode;
            $incUsers->sap_code_sponsor = $sponsor;
            $incUsers->password = '0';
            $incUsers->secret_nikken = '6cl4nHQECtM=';
            $incUsers->client_type = $type_letter;
            $incUsers->rank = 'Directo';
            $incUsers->name = $titular_name;
            $incUsers->last_name = '';
            $incUsers->identification_number = '0';
            $incUsers->phone = $cel;
            $incUsers->cell_phone = $cel;
            $incUsers->state = $state;
            $incUsers->status = '1';
            $incUsers->created_at = date("Y-m-d H:i:s");
            $incUsers->updated_at = date("Y-m-d H:i:s");
            $incUsers->last_password_update = date("Y-m-d H:i:s");
            
            
        }

        /* Compara si es ABI y es persona Natural con intereses entra aqui */

        
        else if($type_incorporation == "1" && $type_per == "2"){
            if($playera == "9708"){
        $talla="M-Hombre";
      }if($playera == "9709"){
            $talla="L-Hombre";
      }if($playera == "9711"){
        $talla="S-Mujer";

      }if($playera == "9712"){ 
        $talla="M-Mujer";
      }

           $incController = new ContractsTest();
           $incController->id_contract = $id;
           $incController->country = $country;
           $conection = \DB::connection('mysql_las');
        $consecutive = $conection->select("SELECT code FROM nikkenla_incorporation.contracts_test where code='$completecode'");
        \DB::disconnect('mysql_las');
        if ($consecutive) {
        $incController->code = $this->Code_consecutive_second();
        }else{
        $incController->code = $completecode;
        }
           $incController->name = $titular_name;
           $incController->type = $type_incorporation;
           $incController->type_incorporate = 1;
           $incController->type_sponsor = $type_sponsor;
           $incController->sponsor = $sponsor;
           $incController->email = $email;
           $incController->cellular = $cel;
           $incController->birthday = $birthdate;
           $incController->address = $address;

           /*CHILE CHANGUE CIUDAD*/
           $incController->residency_one = $cp;
           $incController->residency_two = $state;
           $incController->residency_three = $city;
           $incController->residency_four = $municipality;
           /*CHILE CHANGUE CIUDAD*/

           $incController->type_document = 10;
           $incController->number_document = $rut_nat;
           $incController->name_cotitular = $cotitular_name;
           $incController->type_document_cotitular = 10;
           $incController->number_document_cotitular = $rut_cotitular;
           $incController->bank = $bank_name;
           $incController->bank_type = $type_account;
           $incController->number_account = $numer_account;
           $incController->ip = $ip;
           $incController->browser = $browser;
           $incController->gender = $gender;
           $incController->socio_econ = $socio_econ;
           $incController->person_type = 1;
           $incController->kit = $kit;
           if($kit!="5006" || $kit != 5006 || $kit!="5002" || $kit != 5002){
        
        $incController->playera = $playera;
        $incController->talla = $talla;
        }


           $incControlci = new ControlciTest();
           $incControlci->pais = $country;
           $incControlci->tipo = $type_letter;
           $conection = \DB::connection('mysql_las');
            $consecutive_ci = $conection->select("SELECT codigo FROM nikkenla_marketing.control_ci_test where codigo='$completecode'");
            \DB::disconnect('mysql_las');
            if ($consecutive_ci) {
                $incControlci->codigo = $this->Code_consecutive_second();
            }else{
                $incControlci->codigo = $completecode;
            }
           $incControlci->nombre = $titular_name;
           $incControlci->codigop = $sponsor;
           $incControlci->correo = $email;
           $incControlci->celular = $cel;
           $incControlci->b1 = 1;
           $incControlci->b2 = 1;
           $incControlci->actualizacion = date("Y-m-d H:i:s");


           $incUsers = new UsersTest();

           $incUsers->country_id = $country;
           $incUsers->email = $email;
           $incUsers->sap_code = $completecode;
           $incUsers->sap_code_sponsor = $sponsor;
           $incUsers->password = '0';
           $incUsers->secret_nikken = '6cl4nHQECtM=';
           $incUsers->client_type = $type_letter;
           $incUsers->rank = 'Directo';
           $incUsers->name = $titular_name;
           $incUsers->last_name = '';
           $incUsers->identification_number = '0';
           $incUsers->phone = $cel;
           $incUsers->cell_phone = $cel;
           $incUsers->state = $state;
           $incUsers->status = '1';
           $incUsers->created_at = date("Y-m-d H:i:s");
           $incUsers->updated_at = date("Y-m-d H:i:s");
           $incUsers->last_password_update = date("Y-m-d H:i:s");


       }





       /* Compara si es ABI y es persona Juridica(EMPRESA) entra aqui */
       else if($type_incorporation == "1" && $type_per == "0"){

if($playera == "9708"){
        $talla="M-Hombre";
      }if($playera == "9709"){
            $talla="L-Hombre";
      }if($playera == "9711"){
        $talla="S-Mujer";

      }if($playera == "9712"){ 
        $talla="M-Mujer";
      }

        $incController = new ContractsTest();
        $incController->id_contract = $id;
        $incController->country = $country;
        $conection = \DB::connection('mysql_las');
        $consecutive = $conection->select("SELECT code FROM nikkenla_incorporation.contracts_test where code='$completecode'");
        \DB::disconnect('mysql_las');
        if ($consecutive) {
        $incController->code = $this->Code_consecutive_second();
        }else{
        $incController->code = $completecode;
        }
        $incController->name = $titular_name_jur;
        $incController->type = $type_incorporation;
        $incController->type_incorporate = $type_per;
        $incController->type_sponsor = $type_sponsor;
        $incController->sponsor = $sponsor;
        $incController->email = $email;
        $incController->cellular = $cel_jur;
        $incController->birthday = $birthdate;
        $incController->address = $address;

        /*CHILE CHANGUE CIUDAD*/
        $incController->residency_one = $cp;
        $incController->residency_two = $state;
        $incController->residency_three = $city;
        $incController->residency_four = $municipality;
        /*CHILE CHANGUE CIUDAD*/

        $incController->name_legal_representative = $titular_name_two;
        $incController->type_document = 10;
        $incController->number_document = $rut;
        $incController->name_cotitular = $cotitular_name;
        $incController->type_document_cotitular = 10;
        $incController->number_document_cotitular = $rut_cotitular;
        $incController->bank = $bank_name;
        $incController->bank_type = $type_account;
        $incController->number_account = $numer_account;
        $incController->ip = $ip;
        $incController->browser = $browser;
        $incController->gender = $gender;
        $incController->socio_econ = $socio_econ;
        if($kit!="5006" || $kit != 5006 || $kit!="5002" || $kit != 5002){
        $incController->kit = $kit;
        $incController->playera = $playera;
        $incController->talla = $talla;
        }
        

        
        $incControlci = new ControlciTest();
        $incControlci->pais = $country;
        $incControlci->tipo = $type_letter;
        $conection = \DB::connection('mysql_las');
            $consecutive_ci = $conection->select("SELECT codigo FROM nikkenla_marketing.control_ci_test where codigo='$completecode'");
            \DB::disconnect('mysql_las');
            if ($consecutive_ci) {
                $incControlci->codigo = $this->Code_consecutive_second();
            }else{
                $incControlci->codigo = $completecode;
            }
        $incControlci->nombre = $titular_name_jur;
        $incControlci->codigop = $sponsor;
        $incControlci->correo = $email;
        $incControlci->celular = $cel_jur;
        $incControlci->b1 = 1;
        $incControlci->b2 = 1;
        $incControlci->actualizacion = date("Y-m-d H:i:s");
        
        

        
        $incUsers = new UsersTest();

        $incUsers->country_id = $country;
        $incUsers->email = $email;
        $incUsers->sap_code = $completecode;
        $incUsers->sap_code_sponsor = $sponsor;
        $incUsers->password = '0';
        $incUsers->secret_nikken = '6cl4nHQECtM=';
        $incUsers->client_type = $type_letter;
        $incUsers->rank = 'Directo';
        $incUsers->name = $titular_name_jur;
        $incUsers->last_name = '';
        $incUsers->identification_number = '0';
        $incUsers->phone = $cel_jur;
        $incUsers->cell_phone = $cel_jur;
        $incUsers->state = $state;
        $incUsers->status = '1';
        $incUsers->created_at = date("Y-m-d H:i:s");
        $incUsers->updated_at = date("Y-m-d H:i:s");
        $incUsers->last_password_update = date("Y-m-d H:i:s");
        
        
    }  


    /* Compara si es CB y es persona Natural entra aqui */
    else if($type_incorporation == "0" && $type_per == "1"){

        $incController = new ContractsTest();
        $incController->id_contract = $id;
        $incController->country = $country;
        $conection = \DB::connection('mysql_las');
        $consecutive = $conection->select("SELECT code FROM nikkenla_incorporation.contracts_test where code='$completecode'");
        \DB::disconnect('mysql_las');
        if ($consecutive) {
        $incController->code = $this->Code_consecutive_second();
        }else{
        $incController->code = $completecode;
        }
        $incController->name = $titular_name;
        $incController->type = $type_incorporation;
        $incController->type_incorporate = $type_per;
        $incController->type_sponsor = $type_sponsor;
        $incController->sponsor = $sponsor;
        $incController->email = $email;
        $incController->cellular = $cel;
        $incController->birthday = $birthdate;
        $incController->address = $address;

        /*CHILE CHANGUE CIUDAD*/
        $incController->residency_one = $cp;
        $incController->residency_two = $state;
        $incController->residency_three = $city;
        $incController->residency_four = $municipality;
        /*CHILE CHANGUE CIUDAD*/

               // $incController->name_legal_representative = $titular_name_two;
        $incController->type_document = 10;
        $incController->number_document = $rut_nat;
               // $incController->name_cotitular = $cotitular_name;
               // $incController->type_document_cotitular = 10;
                //$incController->number_document_cotitular = $rut_cotitular;
               // $incController->bank = $bank_name;
                //$incController->bank_type = $type_account;
                //$incController->number_account = $numer_account;
        $incController->ip = $ip;
        $incController->browser = $browser;
        $incController->gender = $gender;
        if($socio_econ == ""){
            $socio_econ="Sin inicio de actividades";
        }
        $incController->socio_econ = $socio_econ;
        if ($kit3!="") {
            $incController->kit = $kit3;
        }else{
            $incController->kit = $kit;
        }
        
        $incControlci = new ControlciTest();
        $incControlci->pais = $country;
        $incControlci->tipo = $type_letter;
        $conection = \DB::connection('mysql_las');
            $consecutive_ci = $conection->select("SELECT codigo FROM nikkenla_marketing.control_ci_test where codigo='$completecode'");
            \DB::disconnect('mysql_las');
            if ($consecutive_ci) {
                $incControlci->codigo = $this->Code_consecutive_second();
            }else{
                $incControlci->codigo = $completecode;
            }
        $incControlci->nombre = $titular_name;
        $incControlci->codigop = $sponsor;
        $incControlci->correo = $email;
        $incControlci->celular = $cel;
        $incControlci->b1 = 1;
        $incControlci->b2 = 1;
        $incControlci->estatus = 0;
        $incControlci->actualizacion = date("Y-m-d H:i:s");
        
        
        $incUsers = new UsersTest();

        $incUsers->country_id = $country;
        $incUsers->email = $email;
        $incUsers->sap_code = $completecode;
        $incUsers->sap_code_sponsor = $sponsor;
        $incUsers->password = '0';
        $incUsers->secret_nikken = '6cl4nHQECtM=';
        $incUsers->client_type = $type_letter;
        $incUsers->rank = 'Directo';
        $incUsers->name = $titular_name;
        $incUsers->last_name = '';
        $incUsers->identification_number = '0';
        $incUsers->phone = $cel;
        $incUsers->cell_phone = $cel;
        $incUsers->state = $state;
        $incUsers->status = '1';
        $incUsers->created_at = date("Y-m-d H:i:s");
        $incUsers->updated_at = date("Y-m-d H:i:s");
        $incUsers->last_password_update = date("Y-m-d H:i:s");


        
    }

    /* Compara si es CB y es persona Natural con intereses entra aqui */
    else if($type_incorporation == "0" && $type_per == "2"){

        $incController = new ContractsTest();
        $incController->id_contract = $id;
        $incController->country = $country;
        $conection = \DB::connection('mysql_las');
        $consecutive = $conection->select("SELECT code FROM nikkenla_incorporation.contracts_test where code='$completecode'");
        \DB::disconnect('mysql_las');
        if ($consecutive) {
        $incController->code = $this->Code_consecutive_second();
        }else{
        $incController->code = $completecode;
        }
        $incController->name = $titular_name;
        $incController->type = $type_incorporation;
        $incController->type_incorporate = 1;
        $incController->type_sponsor = $type_sponsor;
        $incController->sponsor = $sponsor;
        $incController->email = $email;
        $incController->cellular = $cel;
        $incController->birthday = $birthdate;
        $incController->address = $address;

        /*CHILE CHANGUE CIUDAD*/
        $incController->residency_one = $cp;
        $incController->residency_two = $state;
        $incController->residency_three = $city;
        $incController->residency_four = $municipality;
        /*CHILE CHANGUE CIUDAD*/


        $incController->type_document = 10;
        $incController->number_document = $rut_nat;
        $incController->ip = $ip;
        $incController->browser = $browser;
        $incController->gender = $gender;
        $incController->socio_econ = $socio_econ;
        if ($kit3!="") {
            $incController->kit = $kit3;
        }else{
            $incController->kit = $kit;
        }
        $incController->person_type = 1;

        
        $incControlci = new ControlciTest();
        $incControlci->pais = $country;
        $incControlci->tipo = $type_letter;
        $conection = \DB::connection('mysql_las');
            $consecutive_ci = $conection->select("SELECT codigo FROM nikkenla_marketing.control_ci_test where codigo='$completecode'");
            \DB::disconnect('mysql_las');
            if ($consecutive_ci) {
                $incControlci->codigo = $this->Code_consecutive_second();
            }else{
                $incControlci->codigo = $completecode;
            }
        $incControlci->nombre = $titular_name;
        $incControlci->codigop = $sponsor;
        $incControlci->correo = $email;
        $incControlci->celular = $cel;
        $incControlci->b1 = 1;
        $incControlci->b2 = 1;
        $incControlci->estatus = 0;
        $incControlci->actualizacion = date("Y-m-d H:i:s");

        
        $incUsers = new UsersTest();
        $incUsers->country_id = $country;
        $incUsers->email = $email;
        $incUsers->sap_code = $completecode;
        $incUsers->sap_code_sponsor = $sponsor;
        $incUsers->password = '0';
        $incUsers->secret_nikken = '6cl4nHQECtM=';
        $incUsers->client_type = $type_letter;
        $incUsers->rank = 'Directo';
        $incUsers->name = $titular_name;
        $incUsers->last_name = '';
        $incUsers->identification_number = '0';
        $incUsers->phone = $cel;
        $incUsers->cell_phone = $cel;
        $incUsers->state = $state;
        $incUsers->status = '1';
        $incUsers->created_at = date("Y-m-d H:i:s");
        $incUsers->updated_at = date("Y-m-d H:i:s");
        $incUsers->last_password_update = date("Y-m-d H:i:s");
        
        
    }

    /* Compara si es CB y es persona Juridica (EMPRESA) entra aqui */
    else if($type_incorporation == "0" && $type_per == "0"){


        $incController = new ContractsTest();
        $incController->id_contract = $id;
        $incController->country = $country;
        $conection = \DB::connection('mysql_las');
        $consecutive = $conection->select("SELECT code FROM nikkenla_incorporation.contracts_test where code='$completecode'");
        \DB::disconnect('mysql_las');
        if ($consecutive) {
        $incController->code = $this->Code_consecutive_second();
        }else{
        $incController->code = $completecode;
        }
        $incController->name = $titular_name_jur;
        $incController->type = $type_incorporation;
        $incController->type_incorporate = $type_per;
        $incController->type_sponsor = $type_sponsor;
        $incController->sponsor = $sponsor;
        $incController->email = $email;
        $incController->cellular = $cel_jur;
        $incController->birthday = $birthdate;
        $incController->address = $address;

        /*CHILE CHANGUE CIUDAD*/
        $incController->residency_one = $cp;
        $incController->residency_two = $state;
        $incController->residency_three = $city;
        $incController->residency_four = $municipality;
        /*CHILE CHANGUE CIUDAD*/

        $incController->name_legal_representative = $titular_name_two;
        $incController->type_document = 10;
        $incController->number_document = $rut;
        $incController->ip = $ip;
        $incController->browser = $browser;
        $incController->gender = $gender;
        $incController->socio_econ = $socio_econ;
        if ($kit3!="") {
            $incController->kit = $kit3;
        }else{
            $incController->kit = $kit;
        }
        
        
        $incControlci = new ControlciTest();
        $incControlci->pais = $country;
        $incControlci->tipo = $type_letter;
        $conection = \DB::connection('mysql_las');
            $consecutive_ci = $conection->select("SELECT codigo FROM nikkenla_marketing.control_ci_test where codigo='$completecode'");
            \DB::disconnect('mysql_las');
            if ($consecutive_ci) {
                $incControlci->codigo = $this->Code_consecutive_second();
            }else{
                $incControlci->codigo = $completecode;
            }
        $incControlci->nombre = $titular_name_jur;
        $incControlci->codigop = $sponsor;
        $incControlci->correo = $email;
        $incControlci->celular = $cel_jur;
        $incControlci->b1 = 1;
        $incControlci->b2 = 1;
        $incControlci->estatus = 0;
        $incControlci->actualizacion = date("Y-m-d H:i:s");
        
        
        $incUsers = new UsersTest();

        $incUsers->country_id = $country;
        $incUsers->email = $email;
        $incUsers->sap_code = $completecode;
        $incUsers->sap_code_sponsor = $sponsor;
        $incUsers->password = '0';
        $incUsers->secret_nikken = '6cl4nHQECtM=';
        $incUsers->client_type = $type_letter;
        $incUsers->rank = 'Directo';
        $incUsers->name = $titular_name_jur;
        $incUsers->last_name = '';
        $incUsers->identification_number = '0';
        $incUsers->phone = $cel_jur;
        $incUsers->cell_phone = $cel_jur;
        $incUsers->state = $state;
        $incUsers->status = '1';
        $incUsers->created_at = date("Y-m-d H:i:s");
        $incUsers->updated_at = date("Y-m-d H:i:s");
        $incUsers->last_password_update = date("Y-m-d H:i:s");
        
    }
   return "antes de la transaccion";
    \DB::beginTransaction();

    try {

        $conection = \DB::connection('mysql_las');

        $valido = $conection->select("SELECT email FROM nikkenla_incorporation.contracts_test where email = '$email'");

        \DB::disconnect('mysql_las');


        if($valido){

        }
        else{
            $incController->save();
            $incControlci->save();
            $incUsers->save();
        }

        \DB::commit();

        if($type_incorporation == 0 && $kit3 == 5031){
            // return $this->checkOutClub($email);
            $url = 'https://test.mitiendanikken.com/mitiendanikken/auto/login/' . base64_encode($email)."?force_change=".base64_encode('1441:14412');
            header("Location:" . $url, TRUE, 301);
            exit();
        }
        else{
            // $kit= $request->input('kit').trim("");
            // $kit_complete=$kit.':1';
            // $products_two=$kit_complete.';'.$playera.':1';
            // return $this->checkOutAbi($email,$products_two);
            $url = 'http://shopingcarttest.nikkenlatam.com/login-integration-incorporate.php?email=' . base64_encode($email) . '&item=' . $kit;
                header("Location:" . $url, TRUE, 301);
                exit();
        }
        
    } catch (\Exception $e) {
//notify to the users error message and finally script

       \DB::rollback();
      // return view('data',array('correo' => $email));
        echo('Ocurrio un error '.$e->getMessage());
        exit;

   }



}


public function Codegood(Request $request){
    $codigo=$request->code;

    $conection = \DB::connection('mysql_las');
    
    $consulta1 = $conection->select("SELECT  codigo  FROM nikkenla_marketing.control_ci where codigo = '$codigo' and estatus = 1 and b1 = 1");

    \DB::disconnect('mysql_las');

    if($consulta1){
        echo '0';
    }
    else{
        echo '1';
    }
}

    /**
    * Función que valida que el email digitado no se enceuntre en la BD
    */
    public function validateEmail(Request $request){
        $email = $request->email;

        $conection = \DB::connection('mysql_las');

       // $response = $conection->select("SELECT email FROM nikkenla_incorporation.contracts where email = '$email' and type=0");
        $response = $conection->select("SELECT correo FROM nikkenla_marketing.control_ci where correo = '$email'");

        \DB::disconnect('mysql_las');

        if ($response) {
         echo '0';

     }else{
        $conection = \DB::connection('mysql_las');

               // $response = $conection->select("SELECT email FROM nikkenla_incorporation.contracts where email = '$email' and type=0");
        $response_contratcs = $conection->select("SELECT email FROM nikkenla_incorporation.contracts where email = '$email'");

        \DB::disconnect('mysql_las');
                if ($response_contratcs) {

                   echo '0';
                }else{
                        $conection = \DB::connection('mysql_la_users');

                       // $response = $conection->select("SELECT email FROM nikkenla_incorporation.contracts where email = '$email' and type=0");
                        $response_users = $conection->select("SELECT email FROM mitiendanikken.users where email = '$email'");

                        \DB::disconnect('mysql_la_users');
                        if ($response_users) {
                            echo '2';
                        }else{
                           echo '1';  
                        }
                   
                }
        }

 }

     /**
    * Función que valida que el email digitado no se enceuntre en la BD
    */
     public function validateEmailSql(Request $request){
        $email = $request->email;

        $conection = \DB::connection('sqlpreregi');

        $existe=$conection->select("SELECT [E_Mail] FROM [RETOS_ESPECIALES].[dbo].[Associates_CHL] WHERE [E_Mail] = '$email'");

        \DB::disconnect('sqlpreregi');


        if ($existe) {
            echo '0';
        //return $this->ViewPassword();
        }else{
         echo '1';
     }

 }

   /**
    * Método que realizar el checkout independiente APARTADO CAMBIO
    */

  public function checkOutClubApartado($email){


        /*Obtenemos los datos del aseror*/

        

        /*Concatenamos los tres valores y los encriptamos en base 64*/
        $data = base64_encode($email);

        /*Generamos la url del checkourt referenciado a wootbit*/
         //$url = "http://test.mitiendanikken.com/mitiendanikken/auto/login/$data";
         $url= "https://shopingcart.nikkenlatam.com/login-integration-incorporate-apartado.php?email=" . base64_encode($email)."&item=5032";

         

        return Redirect::to($url);

    }
  /**
    * Método que realizar el checkout independiente
    */
    public function checkOutClub($email){


        /*Obtenemos los datos del aseror*/

        

        /*Concatenamos los tres valores y los encriptamos en base 64*/
        $data = base64_encode($email);

        /*Generamos la url del checkourt referenciado a wootbit*/
        $url = "https://mitiendanikken.com/mitiendanikken/auto/login/". base64_encode($email)."?force_change=".base64_encode('1441:14412');


        return Redirect::to($url);

    }

    /**
    * Método que realizar el checkout independiente
    */
    public function checkOutAbi($email,$products_checkout){


        /*Obtenemos los datos del aseror*/

        /*$email = "servicio.chl@nikkenlatam.com";
        $products_checkout = "5006:2";
        $discount_abi = "S";*/
        $discount_abi = "S";


        /*Concatenamos los tres valores y los encriptamos en base 64*/
        $data = base64_encode($email . "&" . $products_checkout . "&" . $discount_abi);

        /*Generamos la url del checkourt referenciado a wootbit*/
        $url = "https://nikkenlatam.com/services/checkout/redirect.php?app=incorporacion&data=$data";


        return Redirect::to($url);

    }

      /**
    * Método que realizar el checkout independiente
    */
      public function checkOutRe(Request $request){


        /*Obtenemos los datos del aseror*/

        $email = $request->email;
        $products_checkout = $request->item.":".$request->amount;
        $discount_abi = "S";


        /*Concatenamos los tres valores y los encriptamos en base 64*/
        $data = base64_encode($email . "&" . $products_checkout . "&" . $discount_abi);

        /*Generamos la url del checkourt referenciado a wootbit*/
        $url = "https://nikkenlatam.com/services/checkout/redirect.php?app=incorporacion&data=$data";


        return Redirect::to($url);

    }




    public function checkOutW(Request $request){


        /*Obtenemos los datos del aseror*/

        $email = $request->email;
        $products_checkout = $request->item.":".$request->amount;
        $discount_abi = "S";


        /*Concatenamos los tres valores y los encriptamos en base 64*/
        $data = base64_encode($email . "&" . $products_checkout . "&" . $discount_abi);

        /*Generamos la url del checkourt referenciado a wootbit*/
        //$url = "https://nikkenlatam.com/services/checkout/redirect.php?app=pruebas&data=$data";
        $url = "https://nikkenlatam.com/services/checkout/redirect.php?app=pruebas&data=$data";


        return Redirect::to($url);

    }

}
