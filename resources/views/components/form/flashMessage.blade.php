@if (session()->has('flash_message'))
    <div id="flash-message" class="alert alert-{{ session()->has('flash_type') ? session('flash_type') : 'success' }}">
        {{ session('flash_message') }}
    </div>
    @push('scripts')
    <script language="javascript">
        $('#flash-message').delay(3000).slideUp(300);
    </script>
    @endpush
@endif