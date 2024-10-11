@extends(Auth::user()->hasRole('admin|teacher') ? 'layout.app' : 'user-account.layout.app')

@section('content')


<div class="chat-container">
        <div class="row g-0">
            <!-- Groups Section -->
            <div class="col-md-4 groups-section">
                <div class="group-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Your Groups</h5>
                    <button class="btn-create-group" data-bs-toggle="modal" data-bs-target="#createGroupModal">
                        <i class="fas fa-plus"></i> Create Group
                    </button>
                </div>
                <div class="group-search">
                    <input type="text" class="form-control" placeholder="Search or start new chat">
                </div>
                <div class="group-list">
                    @foreach($groups as $group)
                        <div class="group-item" data-group-id="{{ $group->id }}">
                            <div class="group-avatar">
                                {{ strtoupper(substr($group->name, 0, 2)) }}
                            </div>
                            <div class="group-info">
                                <div class="group-name">{{ $group->name }}</div>
                                <div class="group-last-message">Last message in the group...</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Chat Section -->
            <div class="col-md-8 chat-section" id="chat-section">
                <p class="text-center">Select a group to start chatting</p>
            </div>
        </div>
    </div>

@include('modals.createGroupModal')
<style>
    .chat-container {
            max-width: 1200px;
            height: 80vh;
            margin: 2.5vh auto;
            background-color: #fff;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            overflow: hidden;
        }
        .groups-section, .chat-section {
            height: 95vh;
        }
        .groups-section {
            background-color: #fff;
            border-right: 1px solid #e0e0e0;
        }
        .group-header, .chat-header {
            background-color: #f0f2f5;
            padding: 10px 15px;
            border-bottom: 1px solid #e0e0e0;
        }
        .group-search {
            background-color: #f0f2f5;
            padding: 10px 15px;
            border-bottom: 1px solid #e0e0e0;
        }
        .group-list {
            overflow-y: auto;
            height: calc(95vh - 120px);
        }
        .group-item {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            border-bottom: 1px solid #f0f2f5;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .group-item:hover, .group-item.active {
            background-color: #f5f5f5;
        }
        .group-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 15px;
            background-color: #128C7E;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        .group-info {
            flex-grow: 1;
        }
        .group-name {
            font-weight: bold;
            margin-bottom: 2px;
        }
        .group-last-message {
            font-size: 0.9em;
            color: #667781;
        }
        
        .btn-create-group {
            background-color: #128C7E;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
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
