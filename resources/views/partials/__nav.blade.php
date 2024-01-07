<nav class="navbar navbar-expand-sm navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">Grade Logic</a>
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId"
            aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <div class="navbar-nav me-auto mt-2 mt-lg-0"></div>
            <div class="d-flex justify-content-center my-2 my-lg-0">
                <ul class="navbar-nav text-center">
                    @if (auth()->check())
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">User</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                            {{-- <a class="dropdown-item" href="#">User Profile</a> --}}
                            <a class="dropdown-item" href="{{ url('logout') }}">Logout</a>
                        </div>
                      </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</nav>
