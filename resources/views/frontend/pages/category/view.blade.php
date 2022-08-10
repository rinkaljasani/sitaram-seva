@extends('frontend.app')
  <div class="block-31" style="position: relative;">
    <div class="owl-carousel loop-block-31 ">
      <div class="block-30 block-30-sm item" style="background-image: url({{ url('frontend/images/bg_1.jpg') }})" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center justify-content-center text-center">
            <div class="col-md-7">
              <h2 class="heading mb-5">Category Detail</h2>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
  
  
  <div class="site-section bg-light">
    
        <div id="blog" class="site-section">
          <div class="container">
                  
                  <div class="row">
      
                    <div class="col-md-12">

                      <p class="mb-4"><img src="images/bg_1.jpg" alt="" class="img-fluid"></p>
                      <h2 class="mb-3 mt-5">{{ $category->name }}</h2>
                      <p>{{ $category->description }}</p>
                      
                    </div> <!-- .col-md-8 -->
                  </div>
      
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link" id="upcoming-tab" data-toggle="tab" href="#upcoming" role="tab" aria-controls="upcoming" aria-selected="false">Upcoming Event</a>
                    </li>
                    
                    <li class="nav-item">
                      <a class="nav-link active" id="currewnt-tab" data-toggle="tab" href="#currewnt" role="tab" aria-controls="currewnt" aria-selected="true">Today Event</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link " id="past-tab" data-toggle="tab" href="#past" role="tab" aria-controls="past" aria-selected="true">Past Event</a>
                    </li>
                  </ul>

                  <div class="tab-content">
                    <div class="tab-pane " id="upcoming" role="tabpanel" aria-labelledby="upcoming-tab">
                      <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            @if(isset($upcomings))
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Event Name</th>
                              <th scope="col">Image</th>
                              <th scope="col">Detail</th>
                              <th scope="col">Location</th>
                              <th scope="col">Benifical Person</th>
                              <th scope="col">Event Date</th>
                            </tr>
                            @endif
                          </thead>
                          <tbody>
                            @forelse($upcomings as $upcoming)
                            <tr>
                              <th scope="row">#</th>
                              <td>{{ $upcoming->name }}</td>
                              <td><img src={{ Storage::url($upcoming->image) }} alt="Image placeholder" class="img-fluid" height="10" width="50"></td>
                              <td>{{Str::limit($upcoming->description, 75)}}</td>
                              <td>{{ $upcoming->location }}</td>
                              <td>{{ $upcoming->benifical }}</td>
                              <td>{{ $upcoming->event_at }}</td>
                              
                            </tr>
                            @empty
                              <tr><td colspan="7" class="text-center">No Today Events</td></tr>
                            @endforelse
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="tab-pane active" id="currewnt" role="tabpanel" aria-labelledby="currewnt-tab">
                      <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          @if(isset($currents))
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Event Name</th>
                            <th scope="col">Image</th>
                            <th scope="col">Detail</th>
                            <th scope="col">Location</th>
                            <th scope="col">Benifical Person</th>
                            <th scope="col">Event Date</th>
                          </tr>
                          @endif
                        </thead>
                        <tbody>
                          @forelse($currents as $current)
                          <tr>
                            <th scope="row">#</th>
                            <td>{{ $current->name }}</td>
                            <td><img src={{ Storage::url($current->image) }} alt="Image placeholder" class="img-fluid" height="10" width="50"></td>
                            <td>{{Str::limit($current->description, 75)}}</td>
                            <td>{{ Str::limit($current->location,75) }}</td>
                            <td>{{ $current->benifical }}</td>
                            <td>{{ $current->event_at }}</td>
                          </tr>
                          <tr>
                            <th class="d-flex justify-content-center">
                              {{-- {!! $current->links() !!} --}}
                            </th>
                          </tr>
                          @empty
                            <tr><td colspan="7" class="text-center">No Today Events</td></tr>
                          @endforelse
                        </tbody>
                      </table>
                      </div>
                    </div>
                    <div class="tab-pane" id="past" role="tabpanel" aria-labelledby="past-tab">
                      <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          @if(isset($pasts))
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Event Name</th>
                            <th scope="col">Image</th>
                            <th scope="col">Detail</th>
                            <th scope="col">Location</th>
                            <th scope="col">Benifical Person</th>
                            <th scope="col">Event Date</th>
                          </tr>
                          @endif
                        </thead>
                        <tbody>
                          @forelse($pasts as $past)
                          <tr>
                            <th scope="row">#</th>
                            <td>{{ $past->name }}</td>
                            <td><img src={{ Storage::url($past->image) }} alt="Image placeholder" class="img-fluid" height="10" width="50"></td>
                            <td>{{Str::limit($past->description, 75)}}</td>
                            <td>{{ Str::limit($past->location,75) }}</td>
                            <td>{{ $past->benifical }}</td>
                            <td>{{ $past->event_at }}</td>
                            
                          </tr>
                          @empty
                            <tr><td colspan="7" class="text-center">No Today Events</td></tr>
                          @endforelse
                          {{-- <tr>
                            <th class="d-flex justify-content-center">
                              {!! $pasts->links('pagination::bootstrap-4') !!}
                            </th>
                          </tr> --}}
                        </tbody>
                      </table>
                      </div>
                    </div>

                  </div>
                  
                  {{-- <script>
                    $(function () {
                      $('#myTab li:last-child a').tab('show')
                    })
                  </script> --}}
                </div>
        </div>
    
  </div> <!-- .section -->
