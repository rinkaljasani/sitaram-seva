@extends('frontend.app')
  <div class="block-31" style="position: relative;">
    <div class="owl-carousel loop-block-31 ">
      <div class="block-30 block-30-sm item" style="background-image: url({{ url('frontend/images/bg_8.jpg') }})" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center justify-content-center text-center">
            <div class="col-md-7">
              <h2 class="heading">Don't delay. Give today!</h2>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
  {{-- <div class="site-section fund-raisers"> --}}
  <div class="featured-section " style="background-image: url('images/bg_2.jpg');">
    <h2 class="text-dark text-center mb-5">Be A Donare Today</h2>
    <div class="container">
      <div class="row">
        
        <div class="col-md-6 my-4">
          <img src="{{ asset('frontend/images/img_7.jpg') }}" alt="Image placeholder" class="img-fluid">
          
        </div>

        <div class="col-md-6 pl-md-5">
            <form action="{{ route('donates.store') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <!-- <label for="name">Name</label> -->
                <input type="text" class="form-control py-2" name="donar_name" id="name" placeholder="Enter your name">
              </div>
              <div class="form-group">
                <!-- <label for="email">Email</label> -->
                <input type="email" class="form-control py-2" name="donar_email" id="email" placeholder="Enter your email">
              </div>
              <div class="form-group">
                <!-- <label for="email">Email</label> -->
                <input type="number" class="form-control py-2" name="amount" id="amount" placeholder="Enter your amount">
              </div>
              <div class="form-group">
                <!-- <label for="name">Name</label> -->
                <input type="file" class="form-control py-2" name="donar_image" id="donar_image" placeholder="Enter your donar_image">
              </div>
              <div class="form-group">
                <select class="form-control" name="category_id" id="category_id" >
                    <option value="">Select Category</option>
                  @forelse($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @empty
                    <p><option value="daily-category">Daily Event</option>
                  @endforelse
                </select>
              </div>
              <div class="form-group">
                <!-- <label for="v_message">Email</label> -->
                <textarea name="message" id="" cols="30" rows="2" maxlength="15" class="form-control py-2" placeholder="Write your message"></textarea>
                <!-- <input type="text" class="form-control py-2" id="email"> -->
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-white px-5 py-2" value="Send">
              </div>
            </form>
        </div>
        
      </div>
    </div>
  {{-- </div> --}}
  </div> <!-- .featured-donate -->

  <div class="site-section fund-raisers">
    <div class="container">
      <div class="row mb-3 justify-content-center">
        <div class="col-md-8 text-center">
          <h2>Latest Donations</h2>
          <p class="lead">We are thankful to all our donors.</p>
          {{-- <p class="mb-5"><a href="#" class="link-underline">View All Donations</a></p> --}}
        </div>
      </div>

      <div class="row">
        @forelse($donations as $donation)
        <div class="col-md-6 col-lg-3 mb-5">
          <div class="person-donate text-center">
            <img src="{{ Storage::url($donation->donar_image) }}" alt="Image placeholder" class="img-fluid">
            <div class="donate-info">
              <h2>{{ $donation->donar_name }}</h2>
              <span class="time d-block mb-3">Donated At : {{ $donation->created_at }}</span>
              <p>Donated <span class="text-success">Rs. {{ $donation->amount }}</span> <br> <em>for</em> <a href="#" class="link-underline fundraise-item">{{ $donation->category->name }}</a></p>
            </div>
          </div>    
        </div>
        @empty
          <p>No Donation Found</p>
        @endforelse
      </div>
    </div>
  </div> <!-- .section -->

 