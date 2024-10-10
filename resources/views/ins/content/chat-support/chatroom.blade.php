<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Timeline</title>
    <link rel="stylesheet" href="https://cdn.knightlab.com/libs/timeline3/latest/css/timeline.css">
    <script src="https://cdn.knightlab.com/libs/timeline3/latest/js/timeline.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        #event-panel {
            margin-top: 20px;
            display: none;
        }
    </style>
</head>
<body>

<div id="timeline"></div>

<div id="event-panel">
    <h3>Event Details</h3>
    <input type="text" id="event-name" placeholder="Event Name" required>
    <textarea id="event-content" placeholder="Content" rows="3" required></textarea>
    <input type="datetime-local" id="event-start" required>
    <input type="datetime-local" id="event-end" placeholder="End Date (optional)">
    <button id="save-event">Save Event</button>
    <button id="delete-event">Delete Event</button>
</div>

<script>
    const events = [
        {
            start_date: { year: 2024, month: 1, day: 1 },
            text: { headline: "Event 1", text: "Details of event 1" }
        },
        {
            start_date: { year: 2024, month: 2, day: 1 },
            text: { headline: "Event 2", text: "Details of event 2" }
        },
    ];

    function renderTimeline() {
        new TL.Timeline('timeline', { events });
    }

    renderTimeline(); // Initial render

    document.getElementById('save-event').addEventListener('click', () => {
        const newEvent = {
            start_date: {
                year: new Date(document.getElementById('event-start').value).getFullYear(),
                month: new Date(document.getElementById('event-start').value).getMonth() + 1,
                day: new Date(document.getElementById('event-start').value).getDate()
            },
            text: {
                headline: document.getElementById('event-name').value,
                text: document.getElementById('event-content').value
            }
        };
        events.push(newEvent);
        renderTimeline(); // Re-render timeline with new event
        document.getElementById('event-panel').style.display = 'none'; // Hide event panel
    });

    document.getElementById('delete-event').addEventListener('click', () => {
        // Implement deletion logic
    });

    // Example for adding new event on double click
    document.getElementById('timeline').addEventListener('dblclick', () => {
        const clickedTime = new Date(); // Get current time for simplicity
        document.getElementById('event-start').value = clickedTime.toISOString().slice(0, 16);
        document.getElementById('event-panel').style.display = 'block';
    });
</script>

</body>
</html>
