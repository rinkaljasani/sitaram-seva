@extends('frontend.app')

<div class="block-31" style="position: relative;">
    <div class="owl-carousel loop-block-31 ">
      <div class="block-30 block-30-sm item" style="background-image: url({{ url('frontend/images/bg_1.jpg') }})" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center justify-content-center text-center">
            <div class="col-md-7">
              <h4 class="heading mb-5">Together we can change many lives, Be a part of changes.</h4>
              <p style="display: inline-block;"><a href="https://vimeo.com/channels/staffpicks/93951774"  data-fancybox class="ftco-play-video d-flex"><span class="play-icon-wrap align-self-center mr-4"><span class="ion-ios-play"></span></span> <span class="align-self-center">Watch Video</span></a></p>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
  
  <div class="site-section section-counter">
    <div class="container">
      <div class="row">
        <div class="col-md-6 pr-5">
          <div class="block-48">
              <span class="block-48-text-1">Beneficial</span>
              <div class="block-48-counter ftco-number" data-number={{ $benifical }}>0</div><span>
              <span class="block-48-text-1 mb-4 d-block">Your help will give us a chance to serve more people.</span>
              <p class="mb-0"><a href="#" class="btn btn-white px-3 py-2">Donate Now</a></p>
            </div>
        </div>
        <div class="col-md-6 welcome-text">
          <h2 class="display-4 mb-3">Who Are We?</h2>
          <p class="text-capitalize ">sitaram seva educational and charitable trust was started in the year 2013, main service under this 
            trust is food donation and help to helpless and poor women/girls to give education, job.
             and also this trust help to get married to that helpless women. In these  years of service, 
             the Trust has helped thousands of poor to give food and hundreds of girls/ women to give better life that they can't imagine.
            </p>
            <p class="text-capitalize ">With activities with volunteers and donar, the Trust is reaching the poor and destitute all over jamnagar, rajkot and extending possible supports to them.</p>
              </p>
          
          {{-- <p class="mb-0"><a href="#" class="btn btn-primary px-3 py-2">Learn More</a></p> --}}
        </div>
      </div>
    </div>
  </div>

  <div class="site-section border-top">
    <div class="container">
      <div class="row">

        <div class="col-md-4">
          <div class="media block-6">
            <div class="icon"><span class="ion-ios-bulb"></span></div>
            <div class="media-body">
              <h3 class="heading">Our Vision</h3>
              <p>We aim to provide complete support, protection, and care to needy people in society; and our aim is to bring a change in their lives.</p>
              {{-- <p><a href="#" class="link-underline">Learn More</a></p> --}}
            </div>
          </div>     
        </div>

        <div class="col-md-4">
          <div class="media block-6">
            <div class="icon"><span class="ion-ios-cash"></span></div>
            <div class="media-body">
              <h3 class="heading">Make Donations</h3>
              <p>Giving a little is better than not giving at all. so be doner today and do donation and give happiness to needly.</p>
              {{-- <p><a href="#" class="link-underline">Learn More</a></p> --}}
            </div>
          </div>  
        </div>

        <div class="col-md-4">
          <div class="media block-6">
            <div class="icon"><span class="ion-ios-contacts"></span></div>
            <div class="media-body">
              <h3 class="heading">We Need Volunteers</h3>
              <p>Money is not the only commodity that is fun to give. We can give time, we can give our expertise, we can give our love, or simply give a smile. so be volunteers today</p>
              {{-- <p><a href="#" class="link-underline">Learn More</a></p> --}}
            </div>
          </div> 
        </div>

      </div>
    </div>
  </div> <!-- .site-section -->



  

  <div class="site-section fund-raisers bg-light">
    <div class="container">
      <div class="row mb-3 justify-content-center">
        <div class="col-md-8 text-center">
          <h2>Latest Event</h2>
          <p class="lead">Have a quick look at our latest events</p>
          <p><a href="{{ route('event.index') }}" class="link-underline">View All Event</a></p>
        </div>
      </div>
    </div>

    <div class="container-fluid">

      <!-- <div class="row"> -->
        
        <div class="col-md-12 block-11">
          <div class="nonloop-block-11 owl-carousel">
            @forelse($events as $event)
            <div class="card fundraise-item">
              <a href="#"><img class="card-img-top" src="{{ Storage::url($event->image) }}" alt="Image placeholder" width="auto" height="300"></a>
              <div class="card-body">
                <h3 class="card-title"><a href="#">{{ $event->name }}</a></h3>
                <p class="card-text">{{Str::limit($event->description, 100)}}</p>
                <span class="donation-time mb-3 d-block">Event at {{ \Carbon\Carbon::parse($event->event_at)->format('d/m/Y')}}</span>
                <div class="progress custom-progress-success">
                  <div class="progress-bar bg-primary" role="progressbar" style="width: 28%" aria-valuenow="28" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <span class="fund-raised d-block">Beneficial peoples : {{ $event->benifical }}</span>
              </div>
            </div>
            
            @empty
              <img src="{{ asset('frontend/images/no-data.png')}}" class="img-fluid">
            @endforelse
          </div>
        </div>
      <!-- </div> -->
    </div>
  </div> <!-- .section -->

  <div class="container mt-5">
    <div class="row my-3 justify-content-center">
      <div class="col-md-8 text-center">
        <h2>Latest Donations</h2>
        <p class="lead">We are thankful to all our donors.</p>
        <p class="mb-5"><a href="{{ route('donates.index') }}" class="link-underline">View All Donations</a></p>
      </div>
    </div>
  <div class="site-section fund-raisers container-fluid">
      <div class="row">
        <div class="col-md-12 block-11">
          <div class="nonloop-block-11 owl-carousel">
        

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
          {{-- <p>No Donation Found</p> --}}
          <img src="{{ asset('frontend/images/no-data.png')}}" class="img-fluid">
        @endforelse
        </div>
      </div>
      </div>
    </div>
  </div> <!-- .section -->

  {{-- <div class="featured-section overlay-color-2" style="background-image: {{ asset('frontend/images/bg_3.jpg') }};">
    
    <div class="container">
      <div class="row">

        <div class="col-md-6">
          <img src="{{  asset('frontend/images/bg_3.jpg') }}" alt="Image placeholder" class="img-fluid">
        </div>

        <div class="col-md-6 pl-md-5">
          <span class="featured-text d-block mb-3">Success Stories</span>
          <h2>Water Is Life. We Successfuly Provide Clean Water in South East Asia</h2>
          <p class="mb-3">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
          <span class="fund-raised d-block mb-5">We have raised $100,000</span>

          <p><a href="#" class="btn btn-success btn-hover-white py-3 px-5">Read The Full Story</a></p>
        </div>
        
      </div>
    </div>

  </div> <!-- .featured-donate --> --}}

  {{-- <div class="site-section bg-light">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md-12">
          <h2>Latest News</h2>
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0">
          <div class="post-entry">
            <a href="#" class="mb-3 img-wrap">
              <img src="{{ asset('frontend/images/img_4.jpg') }}" alt="Image placeholder" class="img-fluid">
            </a>
            <h3><a href="#">Be A Volunteer Today</a></h3>
            <span class="date mb-4 d-block text-muted">July 26, 2018</span>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
            <p><a href="#" class="link-underline">Read More</a></p>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0">
          <div class="post-entry">
            <a href="#" class="mb-3 img-wrap">
              <img src="{{ asset('frontend/images/img_5.jpg') }}" alt="Image placeholder" class="img-fluid">
            </a>
            <h3><a href="#">You May Save The Life of A Child</a></h3>
            <span class="date mb-4 d-block text-muted">July 26, 2018</span>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
            <p><a href="#" class="link-underline">Read More</a></p>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0">
          <div class="post-entry">
            <a href="#" class="mb-3 img-wrap">
              <img src="{{ asset('frontend/images/img_6.jpg') }}" alt="Image placeholder" class="img-fluid">
            </a>
            <h3><a href="#">Children That Needs Care</a></h3>
            <span class="date mb-4 d-block text-muted">July 26, 2018</span>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
            <p><a href="#" class="link-underline">Read More</a></p>
          </div>
        </div>
      </div>
    </div>
  </div> <!-- .section --> --}}

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
                <input name="contact_no" type="text" class="form-control py-1.5" id="contact_no" placeholder="Enter your contact number">
              </div>
              <div class="form-group">
                <!-- <label for="email">Email</label> -->
                <input name="email" type="email" class="form-control py-1.5" id="email" placeholder="Enter your email">
              </div>
              
              <div class="form-group">
                <!-- <label for="name">Name</label> -->
                <div class="upload-btn-wrapper">
                  <i><button class="form-control text-left text-capitalize btn btn-block py-1.5 font-italic" style="letter-spacing:0.02em">Upload Your Profile image</button></i>
                  <input type="file" name="image" />
                </div>
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
