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
              <button class="nav-link" id="teacher-tab" data-bs-toggle="tab" data-bs-target="#teachertab"
                type="button" role="tab" aria-controls="teachertab" aria-selected="false">
                List of Teacher
              </button>
            </li>
          </ul>
          
        </div>
        <div class="card-body table-responsive">
            <!-- Tab panes -->
          <div class="tab-content">
            <div class="tab-pane active" id="studenttab" role="tabpanel" aria-labelledby="student-tab">
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
                  ></button>
                  <strong>Success</strong> {{ session('success') }}
                </div>
              @endif
              
              <button data-bs-toggle="modal" 
                data-bs-target="#addStudentModal" 
                class="btn btn-success btn-sm mb-3">
                Add Student
              </button>
              <div class="table-responsive">
                <table class="table w-100" id="studentTable">
                    <thead>
                      <tr>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Teacher(s)</th>
                        <th>Action</th>
                        {{-- <th class="exclude">Action</th> --}}
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($allStudent as $item)
                      <tr>
                        <td>{{ $item->studentID }}</td>
                        <td>{{ $item->studentName }}</td>
                        <td>{{ $item->teacherNames }}</td>
                        <td>
                          <button 
                            onclick="
                              setTeacher({
                                'id': `{{ $item->studentID }}`,
                                'name': `{{ $item->studentName }}`,
                              })
                            "
                            data-bs-toggle="modal"
                            data-bs-target="#setTeacherModal"
                            class="btn btn-primary btn-sm">
                            Set Teacher
                          </button>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                </table>
              </div>
            </div>
            <div class="tab-pane" id="teachertab" role="tabpanel" aria-labelledby="teacher-tab">
              <button data-bs-toggle="modal" 
                data-bs-target="#addTeacherModal" 
                class="btn btn-success btn-sm mb-3">
                Add Teacher
              </button>
              <div class="table-responsive">
                <table class="table w-100" id="teacherTable">
                  <thead>
                    <tr>
                      <th>Teacher ID</th>
                      <th>Name</th>
                      {{-- <th class="exclude"></th> --}}
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($allTeacher as $item)
                      <tr>
                        <td>{{ $item->userID }}</td>
                        <td>
                          {{ $item->name }} <br> 
                          {{-- <small>{{ $item->email }}</small> --}}
                        </td>
                        {{-- <td>
                          <button class="btn btn-danger btn-sm">Delete</button>
                        </td> --}}
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

{{-- Add Teacher Modal --}}
<form action="{{ url('adduser') }}" method="POST" class="modal fade" id="addTeacherModal" tabindex="-1" role="dialog"
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
          <div class="mb-3">
            <label for="bday">Teacher Birthday</label>
            <input type="date" class="form-control" name="birthday" id="bday"
                placeholder="Enter Teacher's birthday" required />
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
</form>

{{-- Add Student Modal --}}
<form action="{{ url('addstudent') }}" method="POST" class="modal fade" id="addStudentModal" tabindex="-1" role="dialog"
    aria-labelledby="addStudentModalTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="addStudentModalTitle">
          Add Student
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          @csrf
          <div class="mb-3">
            <label for="studentID">Student ID</label>
            <div class="input-group">
              <label for="studentID" class="input-group-text">Student-</label>
              <input type="text" class="form-control" name="userID" id="studentID"
                  placeholder="0000" required />
            </div>
          </div>
          <div class="mb-3">
            <label for="name">Student Name</label>
            <input type="text" class="form-control" name="name" id="name"
                placeholder="Enter Student Name" required />
          </div>
          
          {{-- <div class="mb-3">
            <label for="sbday">Student Birthday</label>
            <input type="date" class="form-control" name="birthday" id="sbday"
                placeholder="Enter Student birthday" required />
          </div> --}}
          
          <label for="searchTeacher">Teacher</label>
          <select data-placeholder="Begin typing a name to filter..." multiple
            class="chosen-select form-select w-100" name="teacher[]" required>
            <option value=""></option>
            @foreach ($allTeacher as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
          </select>
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
</form>

{{-- Set Teacher --}}
<form
  action="{{ url('/setTeacher') }}"
  method="POST"
  class="modal fade"
  id="setTeacherModal"
  tabindex="-1"
  data-bs-backdrop="static"
  data-bs-keyboard="false"
  
  role="dialog"
  aria-labelledby="setTeacherModalTitle"
  aria-hidden="true"
>
  <div
    class="modal-dialog modal-dialog-centered"
    role="document"
  >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="setTeacherModalTitle">
         Set Teacher
        </h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          @csrf
          <div class="mb-3">
            <label for="selectedStudentID">Student ID</label>
            <input type="text" class="form-control" name="id" value="" id="selectedStudentID" readonly>
          </div>
          <div class="mb-3">
            <label for="selectedStudent">Student Name</label>
            <input type="text" class="form-control" name="name" value="" id="selectedStudent" readonly>
          </div>
          <div class="mb-3">
            <label for="searchTeacher">Teacher</label>
            <select data-placeholder="Begin typing a name to filter..." multiple
              class="chosen-select form-select w-100" name="teacher[]" required>
              <option value=""></option>
              @foreach ($allTeacher as $item)
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button
          type="button"
          class="btn btn-secondary"
          data-bs-dismiss="modal"
        >
          Close
        </button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</form>



@include('partials.__foot')
