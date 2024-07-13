<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Person Data Tables</title>

  <!-- CSS -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">

  <!-- JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
  <script src="../../dist/js/adminlte.min.js"></script>
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    @include('admin.nav')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('admin.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="mb-2 row">
            <div class="col-sm-6">
              <h1>Person Data Tables</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/redirects') }}">Home</a></li>
                <li class="breadcrumb-item active">Person DataTables</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  @if (session('message'))
                      <div class="alert alert-success alert-dismissible">
                          {{ session('message') }}
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                  @endif

                  @if (session('success'))
                      <div class="alert alert-success alert-dismissible">
                          {{ session('success') }}
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                  @endif

                  <!-- Add Person Button -->
                  <button type="button" class="mb-3 btn btn-primary" data-toggle="modal" data-target="#addPersonModal">
                    Add Person
                  </button>
                  
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Date of Birth</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>Occupation</th>
                        <th>Education</th>
                        <th>Result</th>
                        <th>Image</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($data as $person)
                      <tr>
                        <td>{{ $person->name }}</td>
                        <td>{{ $person->dob }}</td>
                        <td>{{ $person->district->name }}</td>
                        <td>{{ $person->phone }}</td>
                        <td>{{ $person->gender }}</td>
                        <td>{{ $person->occupation }}</td>
                        <td>{{ $person->education }}</td>
                        <td>{{ $person->result }}</td>
                        <td>{{ $person->image }}</td>
                        <td>
                          <!-- Button trigger modal -->
                          <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#editModal{{ $person->id }}">
                            Edit
                          </button>
                          <a href="{{ route('delete', ['id' => $person->id]) }}" onclick="return confirm('Are you sure you want to delete this person?')" class="btn btn-sm btn-danger">
                            Delete
                          </a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('admin.footer')
  </div>
  <!-- ./wrapper -->

  <!-- Modals for Edit -->
  @foreach($data as $person)
<div class="modal fade" id="editModal{{ $person->id }}" aria-labelledby="editModal{{ $person->id }}Label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModal{{ $person->id }}Label">Edit Person: {{ $person->name }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('admin.person.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <input type="hidden" name="id" value="{{ $person->id }}">
          <div class="form-group">
            <label for="edit-name">Name</label>
            <input type="text" class="form-control" id="edit-name" name="name" value="{{ $person->name }}" required>
          </div>
          <div class="form-group">
            <label for="edit-dob">Date of Birth</label>
            <input type="date" class="form-control" id="edit-dob" name="dob" value="{{ $person->dob }}" required>
          </div>
          <div class="form-group">
            <label for="edit-district">District</label>
            <select class="form-control" id="edit-district" name="district_id" required>
              @foreach($districts as $district)
                <option value="{{ $district->id }}" {{ $district->id == $person->district_id ? 'selected' : '' }}>{{ $district->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="edit-phone">Phone</label>
            <input type="text" class="form-control" id="edit-phone" name="phone" value="{{ $person->phone }}" required>
          </div>
          <div class="form-group">
            <label for="edit-gender">Gender</label>
            <select class="form-control" id="edit-gender" name="gender" required>
              <option value="Male" {{ $person->gender == 'Male' ? 'selected' : '' }}>Male</option>
              <option value="Female" {{ $person->gender == 'Female' ? 'selected' : '' }}>Female</option>
              <option value="Others" {{ $person->gender == 'Others' ? 'selected' : '' }}>Others</option>
            </select>
          </div>
          <div class="form-group">
            <label for="edit-occupation">Occupation</label>
            <input type="text" class="form-control" id="edit-occupation" name="occupation" value="{{ $person->occupation }}" required>
          </div>
          <div class="form-group">
            <label for="edit-education">Education</label>
            <input type="text" class="form-control" id="edit-education" name="education" value="{{ $person->education }}" required>
          </div>
          <div class="form-group">
            <label for="edit-result">Result</label>
            <input type="text" class="form-control" id="edit-result" name="result" value="{{ $person->result }}" required>
          </div>
          <div class="form-group">
            <label for="edit-image">Upload New Image</label>
            <input type="file" class="form-control" id="edit-image" name="image">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach
  <!-- End Modals for Edit -->

  <!-- Modal for Add Person -->
  <div class="modal fade" id="addPersonModal" tabindex="-1" role="dialog" aria-labelledby="addPersonModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addPersonModalLabel">Add New Person</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ url('/person/add') }}" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="add-name">Name</label>
              <input type="text" class="form-control" id="add-name" name="name" placeholder="Enter name" required>
            </div>
            <div class="form-group">
              <label for="add-dob">Date of Birth</label>
              <input type="date" class="form-control" id="add-dob" name="dob" placeholder="Enter date of birth" required>
            </div>
            <div class="form-group">
              <label for="add-district">District</label>
              <select class="form-control" id="add-district" name="district_id" required>
                <option value="">Select District</option>
                @foreach($districts as $district)
                  <option value="{{ $district->id }}">{{ $district->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="add-phone">Phone</label>
              <input type="number" class="form-control" id="add-phone" name="phone" placeholder="Enter phone" required>
            </div>
            <div class="form-group">
              <label for="add-gender">Gender</label>
              <select class="form-control" id="add-gender" name="gender" required>
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Others">Others</option>
              </select>
            </div>
            <div class="form-group">
              <label for="add-occupation">Occupation</label>
              <input type="text" class="form-control" id="add-occupation" name="occupation" placeholder="Enter occupation" required>
            </div>
            <div class="form-group">
              <label for="add-education">Education</label>
              <input type="text" class="form-control" id="add-education" name="education" placeholder="Enter education" required>
            </div>
            <div class="form-group">
              <label for="add-result">Result</label>
              <input type="text" class="form-control" id="add-result" name="result" placeholder="Enter result" required>
            </div>
            <div class="form-group">
              <label for="add-image">Upload Image</label>
              <input type="file" class="form-control" id="add-image" name="image" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add Person</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Modal for Add Person -->

  <!-- DataTables Initialization -->
  <script>
    $(document).ready(function() {
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true
      });

      // Set the max date for Date of Birth input to today
      var today = new Date().toISOString().split('T')[0];
      $('input[type="date"]').attr('max', today);
    });
  </script>
</body>
</html>
