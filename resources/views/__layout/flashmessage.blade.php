
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="http://apps.bdimg.com/libs/jquery/1.9.1/jquery.js"></script>

<div style="width: 50%">
    @include('flash::message')
</div>

{{--自动消失--}}
<script>
    $('div.alert').delay(1000).fadeOut(500);
</script>