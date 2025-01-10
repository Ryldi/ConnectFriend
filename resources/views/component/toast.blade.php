@if (session('sent'))
    <div class="alert alert-success mt-3" id="liveToast">{{ session('sent') }}</div>
@elseif (session('fail'))
    <div class="alert alert-danger mt-3" id="liveToast">{{ session('fail') }}</div>
@endif

<script>
    setTimeout(() => {
        const toast = document.getElementById('liveToast');
        if (toast) {
            toast.remove();
        }
    }, 3000);
</script>