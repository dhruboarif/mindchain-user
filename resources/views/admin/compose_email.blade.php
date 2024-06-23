@extends('admin.layouts.master')


@section('admin_content')

<h1>Compose Email</h1>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<form action="{{ route('admin.send.email') }}" method="post">
    @csrf
    <label for="subject">Subject:</label>
    <input type="text" name="subject" required>
    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

    <div class="form-group">
        <textarea class="ckeditor form-control" name="wysiwyg-editor"></textarea>
    </div>
    
    <label for="status">Status:</label>
    <select id="status" name="status" required>
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
        <option value="ambassador">Ambassador</option>
        <option value="consultant">Consultant</option>

        <option value="individual">Individual</option>
    </select>
    
    <div id="email-container" style="display: none;">
        <label for="email">Email:</label>
        <input type="email" name="email">
    </div>

    <button type="submit">Send Email</button>
</form>
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script> --}}

<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>

<script type="text/javascript">
    CKEDITOR.replace('wysiwyg-editor', {
        filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const statusSelect = document.getElementById('status');
        const emailContainer = document.getElementById('email-container');
        const emailInput = document.querySelector('input[name="email"]');
        
        statusSelect.addEventListener('change', function () {
            if (this.value === 'individual') {
                emailContainer.style.display = 'block';
                emailInput.setAttribute('required', 'required');
            } else {
                emailContainer.style.display = 'none';
                emailInput.removeAttribute('required');
            }
        });
    });
</script>

@endsection
