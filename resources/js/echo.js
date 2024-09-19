  // Enable pusher logging - don't include this in production
  Pusher.logToConsole = true;

  var pusher = new Pusher('4978da231a8c29d19438', {
      cluster: 'ap2'
  });

  var channel = pusher.subscribe('my-channel');
  channel.bind('loan-products', function (data) {
    //   alert(JSON.stringify(data));
    Swal.fire({
        title: 'Heyy Softechian',
        text: data.message,
        icon: 'info',
        position: 'top-start',
        showConfirmButton: false, // Hide the confirm button
        timer: 5000, // Set a timeout
        timerProgressBar: true, // Show a progress bar
        toast: true, // Display as a toast notification
        customClass: {
            popup: 'swal2-toast' // Add a custom class for styling
        }
    });
  });
