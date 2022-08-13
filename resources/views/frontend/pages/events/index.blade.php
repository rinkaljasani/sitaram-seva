@extends('frontend.app')
  <div class="block-31" style="position: relative;">
    <div class="owl-carousel loop-block-31 ">
      <div class="block-30 block-30-sm item" style="background-image: url({{ url('frontend/images/bg_5.jpg') }})" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center justify-content-center text-center">
            <div class="col-md-7">
              <h2 class="heading mb-5">Have a quick look at our latest events</h2>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
  
  
  <div class="site-section bg-light">
    <div class="container">
      

      <div class="row">
        @forelse($events as $event)
        <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0">
          <div class="post-entry">
            <a href="{{ route('event.show',$event->custom_id) }}" class="mb-3 img-wrap ">
              <img src="{{ Storage::url($event->image) }}" alt="Image placeholder" class="img-fluid pr-5">
            </a>
            <h3><a href="#">{{ $event->name }}</a></h3>
            <span class="date mb-4 d-block text-muted">{{ date('d-m-Y', strtotime($event->event_at));  }}</span>
            <p>{{ $event->description }}</p>
            <p><a href="{{ route('event.show',$event->custom_id) }}" class="link-underline">Read More</a></p>
          </div>
        </div>
        @empty
        <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0">
           <img src="{{ asset('frontend/images/no-data.png')}}" class="img-fluid">
        </div>
        @endforelse
        
      </div>
      <div class="d-flex justify-content-center">
        {!! $events->links('pagination::bootstrap-4') !!}
      </div>
    </div>
     {{-- Pagination --}}
     
  </div> <!-- .section -->
  