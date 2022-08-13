@extends('frontend.app')


  <div class="block-31" style="position: relative;">
    <div class="owl-carousel loop-block-31 ">
      <div class="block-30 block-30-sm item mb-5 img-fluid" style="background-image: url({{ url('frontend/images/bg_4.jpg') }});" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center justify-content-center">
            <div class="col-md-7 text-center">
              <h2 class="heading">Reach To Us</h2>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>

  <div class="site-section bg-light">
    <div class="container">
      

      <div class="row">
        @forelse ($addresses as $address)
          <div class="col-12 col-sm-4 col-md-4 col-lg-3 mb-4 mb-lg-0">
            <div class="post-entry">
              <a href="blog-single.html" class="mb-3 img-wrap">
                <img src={{ Storage::url($address->image) }} alt="Image placeholder" class="img-fluid" height="10">
              </a>
              <h4><a href="#">{{ $address->title }}</a></h4>
              {{-- <span class="date mb-4 d-block text-muted">July 26, 2018</span> --}}
              <div><b>Address : </b>{{ $address->address }} , {{ $address->city->name }} , {{ $address->city->state->name }} , {{ $address->city->state->country->name }}</div><hr>
              <div><b>Manager Name : </b>{{ $address->manager_name }}</div>
              <div><b>Contact No : </b>{{ $address->contact_no }}</div>
              <div><b>Alternative No : </b>{{ $address->alternate_contact_no ?: 'N/A' }}</div>
              {{-- <p><a href="#" class="link-underline">Read More</a></p> --}}
            </div>
          </div> 
        @empty   
           <img src="{{ asset('frontend/images/no-data.png')}}" class="img-fluid">
        @endforelse
      </div>
    </div>
  </div>
  <div class="site-section">
    <div class="container">
      <div class="row block-9">
        <div class="col-md-6 pr-md-5">
          <form action="#">
            <div class="form-group">
              <input type="text" class="form-control px-3 py-3" placeholder="Your Name">
            </div>
            <div class="form-group">
              <input type="text" class="form-control px-3 py-3" placeholder="Your Email">
            </div>
            <div class="form-group">
              <input type="text" class="form-control px-3 py-3" placeholder="Subject">
            </div>
            <div class="form-group">
              <textarea name="" id="" cols="30" rows="7" class="form-control px-3 py-3" placeholder="Message"></textarea>
            </div>
            <div class="form-group">
              <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
            </div>
          </form>
        
        </div>

        <div class="col-md-6" id="map"></div>
      </div>
    </div>
  </div>

  