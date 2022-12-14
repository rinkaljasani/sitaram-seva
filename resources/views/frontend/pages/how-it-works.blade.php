@extends('frontend.app')
  
  <div class="block-31" style="position: relative;">
    <div class="owl-carousel loop-block-31 ">
      <div class="block-30 block-30-sm item" style="background-image: url({{  url('frontend/images/bg_1.jpg') }})" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center justify-content-center text-center">
            <div class="col-md-7">
              <h2 class="heading mb-5">How It Works</h2>
              <p style="display: inline-block;"><a href="https://vimeo.com/channels/staffpicks/93951774"  data-fancybox class="ftco-play-video d-flex"><span class="play-icon-wrap align-self-center mr-4"><span class="ion-ios-play"></span></span> <span class="align-self-center">How It Works</span></a></
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
  
  <div class="site-section">
    <div class="container">
      <div class="row align-items-center mb-5">

        <div class="col-md-7 order-md-2 mb-5 mb-md-0">
          <img src="{{ asset('frontend/images/bg_1.jpg') }}" alt="" class="img-fluid">
        </div>

        <div class="col-md-5 pr-md-5 mb-5 order-md-1">
          <div class="block-41">
            <div class="block-41-subheading d-flex">
              <div class="block-41-number">Step 01</div>
            </div>
            <h2 class="block-41-heading mb-3">Create Your Fundraising Campaign</h2>
            <div class="block-41-text">
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
            </div>
          </div>
        </div>
        
      </div> <!-- .row -->

      <div class="row align-items-center mb-5">
        <div class="col-md-7 mb-5 mb-md-0">
          <img src="{{ asset('frontend/images/bg_2.jpg') }}" alt="" class="img-fluid">
        </div>

        <div class="col-md-5 pl-md-5 mb-5">
          <div class="block-41">
            <div class="block-41-subheading d-flex">
              <div class="block-41-number">Step 02</div>
            </div>
            <h2 class="block-41-heading mb-3">Share with Family and Friends</h2>
            <div class="block-41-text">
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
            </div>
          </div>
        </div>
        
      </div> <!-- .row -->

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
        <div class="col-md-6 col-lg-3 mb-5">
          <div class="person-donate text-center">
            <img src="{{ asset('frontend/images/person_1.jpg') }}" alt="Image placeholder" class="img-fluid">
            <div class="donate-info">
              <h2>Jorge Smith</h2>
              <span class="time d-block mb-3">Donated Just now</span>
              <p>Donated <span class="text-success">$252</span> <br> <em>for</em> <a href="#" class="link-underline fundraise-item">Water Is Life. Clean Water In Urban Area</a></p>
            </div>
          </div>    
        </div>

        <div class="col-md-6 col-lg-3 mb-5">
          <div class="person-donate text-center">
            <img src="{{ asset('frontend/images/person_2.jpg') }}" alt="Image placeholder" class="img-fluid">
            <div class="donate-info">
              <h2>Christine Charles</h2>
              <span class="time d-block mb-3">Donated 1 hour ago</span>
              <p>Donated <span class="text-success">$400</span> <br> <em>for</em> <a href="#" class="link-underline fundraise-item">Children Needs Education</a></p>
            </div>
          </div>    
        </div>

        <div class="col-md-6 col-lg-3 mb-5">
          <div class="person-donate text-center">
            <img src="{{ asset('frontend/images/person_3.jpg') }}" alt="Image placeholder" class="img-fluid">
            <div class="donate-info">
              <h2>Albert Sluyter</h2>
              <span class="time d-block mb-3">Donated 4 hours ago</span>
              <p>Donated <span class="text-success">$1,200</span> <br> <em>for</em> <a href="#" class="link-underline fundraise-item">Need Shelter for Children in Africa</a></p>
            </div>
          </div>    
        </div>

        <div class="col-md-6 col-lg-3 mb-5">
          <div class="person-donate text-center">
            <img src="{{ asset('frontend/images/person_4.jpg') }}" alt="Image placeholder" class="img-fluid">
            <div class="donate-info">
              <h2>Andrew Holloway</h2>
              <span class="time d-block mb-3">Donated 9 hours ago</span>
              <p>Donated <span class="text-success">$100</span> <br> <em>for</em> <a href="#" class="link-underline fundraise-item">Water Is Life. Clean Water In Urban Area</a></p>
            </div>
          </div>    
        </div>
      </div>
    </div>
  </div> <!-- .section -->

  <div class="featured-section overlay-color-2" style="background-image: url('images/bg_2.jpg');">
    
    <div class="container">
      <div class="row">

        <div class="col-md-6 mb-5 mb-md-0">
          <img src="{{ asset('frontend/images/bg_2.jpg') }}" alt="Image placeholder" class="img-fluid">
        </div>

        <div class="col-md-6 pl-md-5">

          <div class="form-volunteer">
            
            <h2>Be A Volunteer Today</h2>
            <form action="#" method="post">
              <div class="form-group">
                <!-- <label for="name">Name</label> -->
                <input type="text" class="form-control py-2" id="name" placeholder="Enter your name">
              </div>
              <div class="form-group">
                <!-- <label for="email">Email</label> -->
                <input type="text" class="form-control py-2" id="email" placeholder="Enter your email">
              </div>
              <div class="form-group">
                <!-- <label for="v_message">Email</label> -->
                <textarea name="v_message" id="" cols="30" rows="3" class="form-control py-2" placeholder="Write your message"></textarea>
                <!-- <input type="text" class="form-control py-2" id="email"> -->
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-white px-5 py-2" value="Send">
              </div>
            </form>
          </div>
        </div>
        
      </div>
    </div>

  </div> <!-- .featured-donate -->