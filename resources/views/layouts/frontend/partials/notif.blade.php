@if (Session::get('status'))
<script>
    var action = "{{ Session::get('action') }}";
    var title = "{{ Session::get('title') }}";
    var message = "{{ Session::get('message') }}";
    notifToast(action, title, message);
</script>
@endif