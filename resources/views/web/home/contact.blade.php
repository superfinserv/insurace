 @extends('web.layout.app')
    @section('content')
<main role="main" >
	<section class="section" style="padding-top: 140px;">
	    
		<div class="container" style=" text-align: center;">
            <img class="img-fluid lazy loaded" width="90%" height="50px" 
                 src="{{asset('site_assets/img/contact.PNG')}}" 
                 data-src="{{asset('site_assets/img/contact.PNG')}}" 
                 alt="Super Finserv" data-was-processed="true"
				 style=" margin-bottom: 5% ;"/>
		</div>
		<style>
		    .js-contact-form-message.error-msg{
		            padding: 5px 5px;
                    border: 1px solid #d11111;
                    margin: 12px;
                    border-radius: 10px;
                    color: red;
                    background: #e7606059;

		    }
		     .js-contact-form-message.success-msg{
		                padding: 5px 5px;
                        border: 1px solid #295b09;
                        margin: 12px;
                        border-radius: 10px;
                        color: #042805;
                        background: #84d788;

		    }
		</style>

		<div class="row justify-content-xl-between">
			<div class="col-12 col-lg-6">
				<h3 style=" color:#AC0F0B;">Inquiry <span>form</span> </h3>
				<div class="js-contact-form-message"></div>
				<form class="js-contact-form" action="#" method="POST">
				    @csrf
					<div class="input-wrp">
						<input class="textfield textfield--grey" placeholder="Full name" name="name" type="text" />
					</div>

					<div class="row">
						<div class="col-12 col-md-6">
							<div class="input-wrp">
								<input class="textfield textfield--grey" placeholder="Phone" name="phone" type="text" inputmode="tel" x-inputmode="tel" />
							</div>
						</div>

						<div class="col-12 col-md-6">
							<div class="input-wrp">
								<input class="textfield textfield--grey" placeholder="Email" name="email" type="text" inputmode="email" x-inputmode="email" />
							</div>
						</div>
					</div>

					<label class="input-wrp">
						<textarea class="textfield textfield--grey txtArea" placeholder="Message" name="message"></textarea>
					</label>

					<button class="custom-btn custom-btn--medium custom-btn--style-1" type="submit" role="button">Send</button>

					<div class="form__note"></div>
				</form>
			</div>

			<div class="spacer py-4 d-lg-none"></div>

			<div class="col-12 col-lg-6 col-xl-5">
				<h3 style=" color:#AC0F0B;">Contact <span>Information</span></h3>

				<div class="spacer py-2"></div>
				<div class="company-contacts company-contacts--s1">
					<div class="__inner">
						<div class="__item">
							<h4 class="__name">Location</h4>

							<p>{{config('custom.contact_address')}}</p>
						</div>

						<div class="row">
							<div class="col-12 col-md-6">
								<div class="__item">
									<h4 class="__name">Phone</h4>

									<p><a href="tel:{{config('custom.contact_phone')}}">{{config('custom.contact_phone')}}</a></p>
								</div>
							</div>

							<div class="col-12 col-md-6">
								<div class="__item">
									<h4 class="__name">Email</h4>

									<p><a href="mailto:{{config('custom.contact_email')}}">{{config('custom.contact_email')}}</a></p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="company-contacts company-contacts--s1"></div>
			</div>
		</div>
						
	</section>
</main>
@endsection