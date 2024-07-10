<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Person Form Edit</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
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
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 style="margin-left:50% ">Person Form Edit</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="d-flex justify-content-center">
          <div class="col-md-6">
            <!-- form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('admin.person.update') }}">
                @csrf
                <div class="card-body">
                    <input type="hidden" class="form-control" id="id" name="id" value="{{ $data->id }}">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" autocomplete="off" class="form-control" id="name" name="name"
                            placeholder="Enter Name" value="{{ $data->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="dob">DOB</label>
                        <input type="date" autocomplete="off" class="form-control" id="dob" name="dob"
                           value="{{ $data->dob }}" required>
                    </div>
                    <div class="form-group">
                        <label for="district_id" class="form-label">District</label>
                        <select name="district_id" id="district_id" class="form-control" required>
                            <option value="">Select District</option>
                            @foreach($districts as $district)
                            <option value="{{ $district->id }}" {{ $district->id == $data->district_id ? 'selected' : '' }}>{{ $district->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="number" autocomplete="off" class="form-control" id="phone" name="phone"
                           value="{{ $data->phone }}" required>
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="">Select Gender</option>
                            <option value="Male" {{ $data->gender == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ $data->gender == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Others" {{ $data->gender == 'Others' ? 'selected' : '' }}>Others</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="occupation">Occupation</label>
                        <input type="text" autocomplete="off" class="form-control" id="occupation" name="occupation"
                           value="{{ $data->occupation }}" required>
                    </div>
                    <div class="form-group">
                        <label for="education">Educational Qualification</label>
                        <input type="text" autocomplete="off" class="form-control" id="education" name="education"
                           value="{{ $data->education }}" required>
                    </div>
                    <div class="form-group">
                        <label for="result">Result</label>
                        <input type="text" autocomplete="off" class="form-control" id="result" name="result"
                           value="{{ $data->result }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="/person" class="btn btn-secondary">Go Back</a>
            </form>
            
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('admin.footer')
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();

  // Set the max date for Date of Birth input
  var today = new Date().toISOString().split('T')[0];
  document.getElementById('dob').setAttribute('max', today);
});
</script>
</body>
</html>
