@extends('frontend.app')
  <div class="block-31" style="position: relative;">
    <div class="owl-carousel loop-block-31 ">
      <div class="block-30 block-30-sm item" style="background-image: url({{ url('frontend/images/bg_1.jpg') }})" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center justify-content-center text-center">
            <div class="col-md-7">
              <h2 class="heading mb-5">Event Detail</h2>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
  
    
  <div id="blog" class="site-section">
    <div class="container">
            
            <div class="row">

              <div class="col-md-12">

                <p class="mb-4"><img src="images/bg_1.jpg" alt="" class="img-fluid"></p>
                <h2 class="mb-3 mt-5">{{ $event->name }}</h2>
               
                <p>
                  <img src="{{ Storage::url($event->image) }}" alt="" class="img-fluid w-25">
                </p>
                <p>{{ $event->description }}</p>
                <p>This event organization at <b>{{ date('d-m-Y', strtotime($event->event_at)); }}</b></p>
               
                <p>Total benificial:  <b>{{ $event->benifical}}</b></p>
                
                More images about event
               
                  <div class="row">
                    @forelse ($event->images as $gallery )
                      <div class="col-md-1">
                        <a href="{{ Storage::url($gallery->image) }}" class="img-hover" data-fancybox="gallery">
                          <span class="icon icon-search"></span>
                          @if($gallery->type == 'image')
                          <img src="{{ Storage::url($gallery->image) }}" alt="Image placeholder" class="img-fluid">
                          @else
                          <video src="{{ Storage::url($gallery->image) }}" alt="Image placeholder " class="img-fluid" controlsece>
                          @endif
                        </a>
                      </div> 
                    @empty 
                      <p><strong>No Image Found</strong></p>   
                    @endforelse
                  </div>
               
              </div> <!-- .col-md-8 -->
            </div>

            
          </div>
  </div>
