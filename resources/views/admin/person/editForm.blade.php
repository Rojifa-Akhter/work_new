<!-- Modals for Edit -->
@foreach($data as $person)
<div class="modal fade" id="editModal{{ $person->id }}" tabindex="-1" role="dialog" aria-labelledby="editModal{{ $person->id }}Label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModal{{ $person->id }}Label">Edit Person: {{ $person->name }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('admin.person.update') }}">
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
