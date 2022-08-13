@extends('frontend.app')
  <div class="block-31" style="position: relative;">
    <div class="owl-carousel loop-block-31 ">
      <div class="block-30 block-30-sm item" style="background-image: url({{ url('frontend/images/bg_1.jpg') }})" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center justify-content-center text-center">
            <div class="col-md-7">
              <h2 class="heading mb-5">Case Study</h2>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
  
  
  <div class="site-section bg-light">
    <div class="container">
      

      <div class="row">
        @forelse($categories as $category)
        <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0">
          <div class="post-entry">
            <a href="blog-single.html" class="mb-3 img-wrap">
              <img src={{ Storage::url($category->image) }} alt="Image placeholder" class="img-fluid h-50 w-100" width="auto">
            </a>
            <h3><a href="{{ route('category.show', $category->custom_id) }}">{{ $category->name }}</a></h3>
            <p>{{ $category->description }}</p>
            {{-- <p><a href="#" class="link-underline">Read More</a></p> --}}
          </div>
        </div>
        @empty
         <img src="{{ asset('frontend/images/no-data.png')}}" class="img-fluid">
        @endforelse
      </div>
    </div>
  </div> <!-- .section -->
