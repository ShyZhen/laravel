
<div style="width: 50%">
    @include('flash::message')
</div>

{{--自动消失--}}
<script>
    $('div.alert').delay(1000).fadeOut(500);
</script>