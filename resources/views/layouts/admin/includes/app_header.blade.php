<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		</li>
    </ul>
    <form class="form-inline ml-3">
		<div class="input-group input-group-sm">
			<input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
			<div class="input-group-append">
				<button class="btn btn-navbar" type="submit">
					<i class="fas fa-search"></i>
				</button>
			</div>
		</div>
    </form>
    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
		<li class="nav-item dropdown">
			<a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
				{{ auth()->user()->name }}
			</a>
			<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
				<span class="dropdown-item dropdown-header">Manage Account</span>
				<div class="dropdown-divider"></div>
				<a href="{{ route('profile.show') }}" class="dropdown-item">
					<i class="fas fa-user mr-2"></i> Profile
				</a>
				<div class="dropdown-divider"></div>
				<form method="POST" action="{{ route('logout') }}">
					@csrf
					<a href="{{ route('logout') }}"
						onclick="event.preventDefault();
									this.closest('form').submit();" class="dropdown-item">
						<i class="fas fa-sign-out-alt mr-2"></i> Log Out
					</a>
                </form>
			</div>
		</li>
		@if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
			<div class="flex-shrink-0 mr-3">
				<img class="h-10 w-10 rounded-full object-cover" style="width: 45px;" src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}" />
			</div>
		@endif
    </ul>
</nav>