	@extends('client_layout.client')

	@section('title')
		Home 
	@endsection

	@section('content')
		<!-- start content -->

		<section id="home-section" class="hero" style="background:green">
			{{-- <div class="home-slider owl-carousel">
			@foreach ($sliders as $slider)
				<div class="slider-item" style="background-image: url(storage/slider_images/{{$slider->slider_image}});">
					<div class="overlay"></div>
				<div class="container">
					<div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">
	
					<div class="col-md-12 ftco-animate text-center">
						<h1 class="mb-2">{{$slider->description1}}</h1>
						<h2 class="subheading mb-4">{{$slider->description2}}</h2>
						<p><a href="#" class="btn btn-primary">View Details</a></p>
					</div>
	
					</div>
				</div>
				</div>
			@endforeach
		  </div> --}}
	  </section>
  
	  <section class="ftco-section">
			  <div class="container">
				  <div class="row no-gutters ftco-services">
			<div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
			  <div class="media block-6 services mb-md-0 mb-4">
				<div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
					  <span class="flaticon-shipped"></span>
				</div>
				<div class="media-body">
				  <h3 class="heading">Free Shipping</h3>
				  <span>On order over $100</span>
				</div>
			  </div>      
			</div>
			<div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
			  <div class="media block-6 services mb-md-0 mb-4">
				<div class="icon bg-color-2 d-flex justify-content-center align-items-center mb-2">
					  <span class="flaticon-diet"></span>
				</div>
				<div class="media-body">
				  <h3 class="heading">Always Fresh</h3>
				  <span>Product well package</span>
				</div>
			  </div>    
			</div>
			<div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
			  <div class="media block-6 services mb-md-0 mb-4">
				<div class="icon bg-color-3 d-flex justify-content-center align-items-center mb-2">
					  <span class="flaticon-award"></span>
				</div>
				<div class="media-body">
				  <h3 class="heading">Superior Quality</h3>
				  <span>Quality Products</span>
				</div>
			  </div>      
			</div>
			<div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
			  <div class="media block-6 services mb-md-0 mb-4">
				<div class="icon bg-color-4 d-flex justify-content-center align-items-center mb-2">
					  <span class="flaticon-customer-service"></span>
				</div>
				<div class="media-body">
				  <h3 class="heading">Support</h3>
				  <span>24/7 Support</span>
				</div>
			  </div>      
			</div>
		  </div>
			  </div>
		  </section>
		  <section>
			<div class="container">
				<div class="row">
					<h2>@ Mountain Eats</h2>
					<p>Nestled at the foot of rolling hills, Mountain Eats is your hometown haven for fresh, local goodness. 
						Founded by a family of adventurers who believed that great food fuels great journeys, we specialize in farm-to-basket
						 produce, artisan goods, and hearty essentials perfect for mountain living. Whether you’re prepping for a 
						 weekend hike or stocking up for cozy cabin nights, Mountain Eats brings the best of the land right to your table.
						  Here, every aisle is an adventure — and every bite tells a story.</p>
				</div>
			</div>
		  </section>
  
		  <section class="ftco-section ftco-category ftco-no-pt">
			  <div class="container">
				  <div class="row">
					  <div class="col-md-8">
						  <div class="row">
							  <div class="col-md-6 order-md-last align-items-stretch d-flex">
								  <div class="category-wrap-2 ftco-animate img align-self-stretch d-flex" style="background-image: url(frontend/images/category.jpg);">
									  <div class="text text-center">
										  <h2>Vegetables</h2>
										  <p>Protect the health of every home</p>
										  <p><a href="#" class="btn btn-primary">Shop now</a></p>
									  </div>
								  </div>
							  </div>
							  <div class="col-md-6">
								  <div class="category-wrap ftco-animate img mb-4 d-flex align-items-end" style="background-image: url(frontend/images/category-1.jpg);">
									  <div class="text px-3 py-1">
										  <h2 class="mb-0"><a href="#">Fruits</a></h2>
									  </div>
								  </div>
								  <div class="category-wrap ftco-animate img d-flex align-items-end" style="background-image: url(frontend/images/category-2.jpg);">
									  <div class="text px-3 py-1">
										  <h2 class="mb-0"><a href="#">Vegetables</a></h2>
									  </div>
								  </div>
							  </div>
						  </div>
					  </div>
  
					  <div class="col-md-4">
						  <div class="category-wrap ftco-animate img mb-4 d-flex align-items-end" style="background-image: url(frontend/images/category-3.jpg);">
							  <div class="text px-3 py-1">
								  <h2 class="mb-0"><a href="#">Juices</a></h2>
							  </div>		
						  </div>
						  <div class="category-wrap ftco-animate img d-flex align-items-end" style="background-image: url(frontend/images/category-4.jpg);">
							  <div class="text px-3 py-1">
								  <h2 class="mb-0"><a href="#">Dried</a></h2>
							  </div>
						  </div>
					  </div>
				  </div>
			  </div>
		  </section>
  
  

  
	  <hr>
  
		  <section class="ftco-section ftco-partner">
		  <div class="container">
			  <div class="row">
				  <div class="col-sm ftco-animate">
					  <a href="#" class="partner"><img src="frontend/images/partner-1.png" class="img-fluid" alt="Colorlib Template"></a>
				  </div>
				  <div class="col-sm ftco-animate">
					  <a href="#" class="partner"><img src="frontend/images/partner-2.png" class="img-fluid" alt="Colorlib Template"></a>
				  </div>
				  <div class="col-sm ftco-animate">
					  <a href="#" class="partner"><img src="frontend/images/partner-3.png" class="img-fluid" alt="Colorlib Template"></a>
				  </div>
				  <div class="col-sm ftco-animate">
					  <a href="#" class="partner"><img src="frontend/images/partner-4.png" class="img-fluid" alt="Colorlib Template"></a>
				  </div>
				  <div class="col-sm ftco-animate">
					  <a href="#" class="partner"><img src="frontend/images/partner-5.png" class="img-fluid" alt="Colorlib Template"></a>
				  </div>
			  </div>
		  </div>
	  </section>	  
	  <!-- end content -->
	@endsection
	