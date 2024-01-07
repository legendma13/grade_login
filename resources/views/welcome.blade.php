@include('partials.__head')
@include('partials.__nav')
<main class="min-vh-100 d-flex justify-content-center align-items-center bg-dark">
  <div class="container d-flex justify-content-center">
    <div class="card rounded rounded-5 shadow" style="width: 68dvh">
      <div class="card-header text-center">
        <h4 class="card-title fw-bold">LOGIN NOW</h4>      
      </div>
      <form action="{{ url('/login/process') }}" method="POST" class="card-body">
      
        @if(session('error'))
          <div
            class="alert alert-danger alert-dismissible fade show"
            role="alert"
          >
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="alert"
              aria-label="Close"
            ></button>
            <strong>Failed</strong> {{ session('error') }}
          </div>
        @endif
        @if(session('success'))
          <div
            class="alert alert-success alert-dismissible fade show"
            role="alert"
          >
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="alert"
              aria-label="Close"
            >
            </button>
            <strong>Success</strong> {{ session('success') }}
          </div>
        @endif
        @csrf
        <div class="form-floating mb-3">
          <input
            type="email"
            class="form-control"
            name="email"
            id="email"
            placeholder=""
            required
          />
          <label for="email">Enter your Email Address</label>
        </div>
        <div class="form-floating mb-3">
          <input
            type="password"
            class="form-control"
            name="password"
            id="password"
            placeholder=""
            required
          />
          <label for="password">Enter your Password</label>
        </div>
        
        <div class="text-center">
          <button
            type="submit"
            class="btn btn-primary w-100 rounded-pill text-uppercase fw-bold"
          >
            LOGIN
          </button>
          <h4 class="my-3">Or</h4>
          <a
            href="{{ url('login/google') }}"
            type="submit"
            class="btn btn-danger w-100 rounded-pill text-uppercase fw-bold"
          >
            Login with Google
          </a>
        </div>
      </form>
    </div>
  </div>
</main>
@include('partials.__foot')

