
<h3>Club</h3>
<div class="row">


	<div class="col-md-12">
		<label for="type_per"><span style="color: red !important;">*</span> <b>{{ __('auth.type_per') }}</b></label>
		<select id="type_per" name="type_per" class="form-control" onchange="type_person(this.value)">
            <option></option>
			<option value="Persona Natural">Persona Natural</option>
			<option value="Persona Juridica">Persona Juridica</option>
		</select>
	</div>
</div>

<div class="row">
<section id="jur" class="col-lg-6">
	<!--div class="col-md-6"-->
		<label for="name_titular"><span style="color: red !important;">*</span> <b>{{ __('auth.name_titular') }}</b></label>
		<input type="text" id="name_titular" name="name_titular" class="form-control">
	<!--/div-->
</section>
<section hidden="true" class="col-lg-6" id="r_soc">
        <!--div class="col-md-6"-->
            <label for="name_titular"><span style="color: red !important;">*</span> <b>{{ __('auth.razon') }}</b></label>
            <input type="text" id="name_titular" name="name_titular" class="form-control">
        <!--/div-->
</section>

	<div class="col-md-6">
        <label for="date_born"><span style="color: red !important;">*</span> <b>{{ __('auth.birthDate') }}</b></label>
		<input type="text" id="date_born"  name="date_born"  data-min="1909-01-01"
        data-max="2019-11-01" class="form-control wbn-datepicker">
	</div>
</div>

<div class="row">
	<div class="col-md-6" id="email">
		<label for="email"><span style="color: red !important;">*</span> <b>{{ __('auth.email') }}</b></label>
		<input type="text" id="email" name="email" class="form-control">
	</div>

    <div class="col-md-6" id="gender">
		<label for="gender"><span style="color: red !important;">*</span> <b>{{ __('auth.gender') }}</b></label>
		<select id="gender" name="gender" class="form-control">
			<option>Masculino</option>
			<option>Femenino</option>
			<option>Indefinido</option>
		</select>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<label for="tel"><span style="color: red !important;">*</span> <b>{{ __('auth.phone') }}</b></label>
		<input type="text" id="tel" name="tel" class="form-control">
	</div>

    <section id="cel_natural" class="col-lg-6">
            <label for="cel"><b>{{ __('auth.celPhone') }}</b></label>
            <input type="text" id="cel" name="cel" class="form-control">
    </section>
    <section id="cel_juridica" class="col-lg-6" hidden="true">
            <label for="cel"><b>{{ __('auth.celPhoneJur') }}</b></label>
            <input type="text" id="cel" name="cel" class="form-control">
    </section>

</div>

<div class="row">
	<div class="col-md-4">
		<label for="postal_code"><span style="color: red !important;">*</span> <b>{{ __('auth.cp') }}</b></label>
		<input type="text" id="postal_code" name="postal_code" class="form-control">
	</div>
	<div class="col-md-4">
		<label for="region"><span style="color: red !important;">*</span> <b>{{ __('auth.reg') }}</b></label>
		<select id="region"  name="region" class="form-control" onchange="getData()">
            @foreach ($states as $item)
                <option value="{{ $item->state_name}}">
                    {{ $item->state_name}}
                </option>
            @endforeach
		</select>
	</div>

	<div class="col-md-4">
		<label for="comuna"><span style="color: red !important;">*</span> <b>{{ __('auth.com') }}</b></label>
		<select id="comuna" name="comuna" class="form-control">

		</select>
    </div>


</div>

<div class="row">
	<div class="col-md-12">
		<label for="adress"><span style="color: red !important;">*</span> <b>{{ __('auth.adress') }}</b></label>
		<input type="text" id="adress" name="adress" class="form-control">
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<label for="cni"><span style="color: red !important;">*</span> <b>{{ __('auth.cni') }}</b></label>
		<input type="text" id="cni" name="cni" class="form-control">
	</div>

<section class="col-md-6" id="rut_natural">
        <label for="rut"><span style="color: red !important;">*</span> <b>{{ __('auth.rut') }}</b></label>
		<input type="text" id="rut" name="rut" class="form-control">
</section>
<section class="col-md-6" id="rut_juridica" hidden="true">
        <label for="rut"><span style="color: red !important;">*</span> <b>{{ __('auth.rutJur') }}</b></label>
		<input type="text" id="rut" name="rut" class="form-control">
</section>
	<!--div class="col-md-6">
		<label for="rut"><span style="color: red !important;">*</span> <b>{{ __('auth.rut') }}</b></label>
		<input type="text" id="rut" name="rut" class="form-control">
	</div-->
</div>
<div class="row">
	<div class="col-md-12" id="name_titular_two">
		<label for="name_titular_two"><span style="color: red !important;">*</span> <b>{{ __('auth.name_titular') }}</b></label>
		<input type="text" id="name_titular_two" name="name_titular_two" class="form-control">
	</div>
</div>

<br>

<!--***Modificar esta parte es solo una prueba para el front *** -->
<div class="row">
	<div class="col-sm-12">
		<label id="option-sponsor-one"><input type="radio" value="1" name="type_sponsor" >&nbsp;<strong>{{ __('auth.type_sponsor_one') }}</strong><br/><small>{{ __('auth.type_sponsor_ones') }}</small></label>
		<div class="row">
			<div class="col-sm-5">
				<div class="form-group">
					<input type="text"  class="form-control input-sponsor" id="code-sponsor" maxlength="12" placeholder="Ingresa aquí el código aquí" onkeyup="Search_sponsor(this.value)" >
					<input type="hidden" class="form-control required input-validator-sponsor" id="code-sponsor-validate">
				</div>
			</div>
			<div class="col-sm-7">
				<div class="form-group">
					<div id="view-name-sponsor" class="margin-sponsor"></div>
				</div>
			</div>
		</div>

	<div class="row">
		<div class="col-sm-12" >
			<label id="option-sponsor-two"><input type="radio" value="2" name="type_sponsor" id="option-sponsor-1" >&nbsp;<strong>{{ __('auth.type_sponsor_two') }}</strong><br/><small>{{ __('auth.type_sponsor_twos') }}</small></label>
			<br/><br/>
		</div>
		<div class="col-sm-12">
			<label id="option-sponsor-three"><input type="radio" value="3" name="type_sponsor" id="option-sponsor-2" >&nbsp;<strong>{{ __('auth.type_sponsor_three') }}</strong><br/><small>{{ __('auth.type_sponsor_threes') }}</small></label>
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
                                            <input type="checkbox" name="terms" id="terms">
                                            <span class="slider round"></span>
                                        </label>
                                        <br>
                                        <label>{{ __('auth.terms') }}</label>
                                    </div>
                                </strong>
                            </div>
                            </div>
                            <div class="col-lg-6">
    <div class="alert alert-dismissible fade show" role="alert" style="color: #fff; background-color: #A2DADA !important;border-color: #A2DADA !important;">
                                <strong>
                                    <div class="custom-control custom-checkbox mr-3">
                                        <label for="privacy_policy" class="switch s-icons s-outline s-outline-info" style="margin-left: 20px !important;">
                                            <input type="checkbox" name="privacy_policy" id="privacy_policy" >
                                            <span class="slider round"></span>
                                        </label>
                                        <br>
                                        <label>{{ __('auth.privacy_policy') }}</label>

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

<script src="{{ asset('regchileasset/js/singup/singup.js') }} "></script>



