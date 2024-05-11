<script>
    setInterval(function() {
        fetch('/check-notification')
            .then(response => response.json())
            .then(data => {
                if (data.hasUnprocessedData) {
                    document.getElementById('notificationSound').play();
                }
            })
            .catch(error => console.error('Error:', error));
    }, 10000); // Check every 60 seconds

    var page = "{{ route('permohonan.index') }}"; // Ganti route_name dengan nama rute Anda
    var sec = 10;

    setTimeout(function() {
        window.location.href = page;
    }, sec * 1500);
</script>