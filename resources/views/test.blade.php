<!DOCTYPE html>
<head>
  <title>Pusher Test</title>
  <script src="https://js.pusher.com/8.0.1/pusher.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.16.1/echo.iife.min.js" integrity="sha512-XYamWfde8fVJB0ruVwoA+rwH39JBVzBhQzQi22mV6aXMow3uCBWzN1ISCEkaJ2mZl2ktBZuteMoPKlMCGDwoPA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  
      <script>
     window.Pusher = Pusher;
    
    // Initialize Echo with Pusher
    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: "2ca60163325399dec913", // Your Pusher App Key
        cluster: "ap2", // Your Pusher App Cluster
        forceTLS: true, // Enable secure connection (wss)
        encrypted: true // This is for TLS/SSL encryption
    });

    window.Echo.channel('my-channel')
        .listen('.my-event', (data) => {
            alert('Received data: ' + JSON.stringify(data));
        });
  </script>


  
</head>
<body>
  <h1>Pusher Test</h1>
  <p>
    Try publishing an event to channel <code>my-channel</code>
    with event name <code>my-event</code>.
  </p>
</body>


