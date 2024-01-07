@include('partials.__head')
@include('partials.__nav')

<main class="d-flex justify-content-between align-items-center">
  <div class="container mt-5">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="student-tab" data-bs-toggle="tab"
                  data-bs-target="#studenttab" type="button" role="tab" aria-controls="studenttab"
                  aria-selected="true">
                  <div class="table-responsive">
                      List of Student
                  </div>
              </button>
              
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="report-tab" data-bs-toggle="tab"
                data-bs-target="#reporttab" type="button" role="tab" aria-controls="reporttab"
                aria-selected="true">
                <div class="table-responsive">
                    Report
                </div>
            </button>
            </li>
          </ul>
          {{-- <button data-bs-toggle="modal" 
              data-bs-target="#addStudentModal" 
              class="btn btn-success mb-3">
              Add Student
            </button> --}}
        </div>
        <div class="card-body table-responsive">
            <!-- Tab panes -->
          <div class="tab-content">
            <div class="tab-pane active" id="studenttab" role="tabpanel" aria-labelledby="student-tab">
              @if ($errors->any())
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
                  <strong>Failed</strong> {{ $errors->first() }}
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
                  ></button>
                  <strong>Success</strong> {{ session('success') }}
                </div>
              @endif
              <form action="{{ route('import') }}"
                    method="POST" 
                    class="mb-1"
                    enctype="multipart/form-data">
                  @csrf
                  <input type="file" name="file"
                         class="form-control mb-1">
                  <button class="btn btn-success btn-sm">
                        Import Class Grade Data
                     </button>
                  {{-- <a class="btn btn-warning btn-sm"
                     href="{{ route('export-classlist') }}">
                        Export Class List Data
                    </a> --}}
              </form>
              <div class="table-responsive">
                <table class="table w-100" id="studentTableTeacherAccount">
                    <thead>
                      <tr>
                        <th>Student</th>
                        <th>Name</th>
                        <th>Grade</th>
                        <th class="exclude">Result</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($allStudent as $item)
                      <tr>
                        <td>{{ $item->userID }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->grade }}</td>
                        <td>
                          @if ($item->grade < 5)
                            FAILED
                          @elseif ($item->grade == 5)
                            PASANG AWA
                          @elseif ($item->grade > 5 )
                            PASS
                          @endif
                          
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                </table>
              </div>
            </div>
            <div class="tab-pane" id="reporttab" role="tabpanel" aria-labelledby="report-tab">
              <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4"><canvas id="myChart" style="width: 400px;height:400px"></canvas></div>
                <div class="col-lg-4"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

nav
{{-- <form action="{{ url('adduser') }}" method="POST" class="modal fade" id="addTeacherModal" tabindex="-1" role="dialog"
    aria-labelledby="addTeacherModalTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="addTeacherModalTitle">
          Add Teacher
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          @csrf
          <div class="mb-3">
            <label for="teacherID">Teacher ID</label>
            <div class="input-group">
              <label for="teacherID" class="input-group-text">Teacher-</label>
              <input type="text" class="form-control" name="userID" id="teacherID"
                  placeholder="0000" required />
            </div>
          </div>
          <div class="mb-3">
            <label for="email">Teacher Email</label>
            <input type="text" class="form-control" name="email" id="email"
                placeholder="Enter Teacher email" required />
          </div>
          <div class="mb-3">
            <label for="name">Teacher Name</label>
            <input type="text" class="form-control" name="name" id="name"
                placeholder="Enter Teacher Name" required />
          </div>
        </div>
      </div>
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          CLOSE
        </button>
        <button type="submit" class="btn btn-primary">ADD</button>
      </div>
    </div>
  </div>
</form> --}}
@include('partials.__foot')
