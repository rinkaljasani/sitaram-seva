  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="index.html"><img src="/frontend/images/logo1.png" height="80" class=""></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto mx-auto" id="navMenus">
          <li class="nav-item"><a href="{{ route('index') }}" class="nav-link">Home</a></li>
          <li class="nav-item"><a href="{{ route('about') }}" class="nav-link">About</a></li>
          <li class="nav-item"><a href="{{ route('contact') }}" class="nav-link">Contact</a></li>
          <li class="nav-item"><a href="{{ route('category.index') }}" class="nav-link">Case Study</a></li>
          <li class="nav-item"><a href="{{ route('event.index') }}" class="nav-link">Event</a></li>
          <li class="nav-item"><a href="{{ route('team.index') }}" class="nav-link">Our Team</a></li>
          <li class="dropdown nav-item">
            <a class="nav-link dropdown-toggle"  id="dropdownMenuButton" data-toggle="dropdown">
              Gallery
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a href="{{ route('gallery.image') }}" class="dropdown-item">Image</a>
              <a href="{{ route('gallery.video') }}" class="dropdown-item">Video</a>
            </div>
          </li>
          <li class="nav-item"><a href="{{ route('donates.index') }}" class="nav-button btn donate-button">Donate Now</a></li>
          
        </ul>
      </div>
    </div>
  </nav>
  <!-- END nav -->
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
$(document).on('click', 'ul li', function(){
  console.log('hi');
  $(this).addClass('active').siblings(removeClass('active'));
})
</script>