<div id="kt_header" class="header header-fixed">
	<div class="container-fluid d-flex align-items-stretch justify-content-between">
		<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">

		</div>
		<div class="topbar">
			<div class="dropdown">
				<div class="dropdown">
					<div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
						<div class="btn btn-icon btn-clean btn-dropdown w-auto align-items-center btn-lg mr-1 px-2">
							<span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
							<span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{ Auth::user()->full_name }}</span>
							<span class="symbol symbol-35 symbol-light-success">
								@if(Auth::user()->profile === null)
								<span class="symbol-label font-size-h5 font-weight-bold">
									{{ implode('', array_map(function($v) { return $v[0]; }, explode(' ', Auth::user()->full_name))) }}
								</span>
								@else
								<img class="img-fluid" style="max-width: 240px; max-height: 60px;" src="{{ Storage::url(Auth::user()->profile ?? '') }}" alt="{{ env('APP_NAME') }}" />
								@endif
							</span>
						</div>
					</div>

					<div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-md dropdown-menu-right">
						<ul class="navi navi-hover py-4">
							<li class="navi-item">
							<a href="{{ route('admin.profile-view')}}" class="navi-link">
									<span class="symbol symbol-20 mr-3">
									<i class="far fa-user"></i>
									</span>
									<span class="navi-text">Manage Account</span>
								</a>
							</li>

							<li class="navi-item">
								{{-- <a href="{{ route('admin.quickLink')}}" class="navi-link">
									<span class="symbol symbol-20 mr-3">
										<i class="fas fa-link"></i>
									</span>
									<span class="navi-text">Manage Quick Links</span>
								</a> --}}
							</li>

							<li class="navi-item">
								<a href="{{ route('admin.logout')}}" class="navi-link">
									<span class="symbol symbol-20 mr-3">
										<i class="fas fa-stroopwafel"></i>
									</span>
									<span class="navi-text">Logout</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>