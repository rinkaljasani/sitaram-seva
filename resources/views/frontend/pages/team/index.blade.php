@extends('frontend.app')
  <div class="block-31" style="position: relative;">
    <div class="owl-carousel loop-block-31 ">
      <div class="block-30 block-30-sm item" style="background-image: url({{ url('frontend/images/bg_6.jpg') }})" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center justify-content-center text-center">
            <div class="col-md-7">
              <h2 class="heading">Our Team</h2>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>

  
  <div class="site-section fund-raisers">
    <div class="container">
      <div class="row mb-3 justify-content-center">
        <div class="col-md-8 text-center">
          <h2>Latest Donations</h2>
          <p class="lead">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          <p class="mb-5"><a href="#" class="link-underline">View All Donations</a></p>
        </div>
      </div>

      <div class="row">
        @forelse($teams as $team)
        <div class="col-md-6 col-lg-3 mb-5">
          <div class="person-donate text-center">
            <img src="{{ Storage::url($team->image) }}" alt="Image placeholder" class="img-fluid">
            <div class="donate-info">
              <h2>{{ $team->name }}</h2>
              <span class="time d-block mb-3">Join From : {{ $team->created_at }}</span>
              <p>Contact : {{ $team->contact_no }}<br><span class="text-success">{{ $team->type }}</span><a href="#" class="link-underline fundraise-item"></a></p>
            </div>
          </div>    
        </div>
        @empty
           <img src="{{ asset('frontend/images/no-data.png')}}" class="img-fluid">
        @endforelse
      </div>
    </div>
  </div> <!-- .section -->

  <div class="featured-section overlay-color-2" style="background-image: url('images/bg_2.jpg');">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mb-5 text-center"><h2>Be A Volunteer Today</h2></div>
        <div class="col-md-6 mb-md-0">
          <img src="{{ asset('frontend/images/bg_2.jpg') }}" alt="Image placeholder" class="img-fluid">
        </div>

        <div class="col-md-6 pl-md-5">

          <div class="form-volunteer">
            
            
            <form action="{{ route('team.store') }}" method="post" enctype="multipart/form-data">
                @csrf
              <div class="form-group">
                <!-- <label for="name">Name</label> -->
                <input name="name" type="text" class="form-control py-1.5" id="name" placeholder="Enter your name">
              </div>
              <div class="form-group">
                <!-- <label for="name">Name</label> -->
                <input name="contact_no" type="text" class="form-control py-1.5" id="contact_no" placeholder="Enter your contact">
              </div>
              <div class="form-group">
                <!-- <label for="email">Email</label> -->
                <input name="email" type="email" class="form-control py-1.5" id="email" placeholder="Enter your email">
              </div>
              <div class="form-group">
                <!-- <label for="name">Name</label> -->
                <input name="image" type="file" class="form-control py-1.5" id="image" placeholder="Select image">
              </div>
              
              <div class="form-group">
                <!-- <label for="v_message">Email</label> -->
                <textarea name="address" id="" cols="30" rows="3" class="form-control py-1.5" placeholder="Write your message"></textarea>
                <!-- <input type="text" class="form-control py-1.5" id="email"> -->
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-white px-5 py-1.5" value="Send">
              </div>
            </form>
          </div>
        </div>
        
      </div>
    </div>

  </div> <!-- .featured-donate -->
