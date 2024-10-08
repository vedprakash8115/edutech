@push('styles')
<style>
    /* WhatsApp Button Styles */
    .whatsapp-button {
        position: fixed;
        bottom: 20px; /* Adjust the distance from the bottom */
        right: 40px; /* Adjust the distance from the right */
        background-color: #25D366; /* WhatsApp green color */
        color: white; /* Icon color */
        border-radius: 50%; /* Make it circular */
        width: 50px; /* Button width */
        height: 50px; /* Button height */
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        text-decoration: none; /* Remove underline */
        z-index: 1000; /* Ensure it is on top */
    }

    .whatsapp-button i {
        font-size: 30px; /* Icon size */
    }

    .whatsapp-button:hover {
        background-color: #128C7E; /* Darker green on hover */
    }
</style>

@endpush
<a href="https://wa.me/your_number" class="whatsapp-button" target="_blank">
    <i class="fab fa-whatsapp" style="font-size: 30px"></i> 
</a>