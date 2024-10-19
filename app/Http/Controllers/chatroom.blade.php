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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    // Add click event listener for group items
    $('.group-item').on('click', function() {
        
        var groupId = $(this).data('group-id'); // Get the group ID from data attribute
        loadChat(groupId); // Call the loadChat function
    });
});

function loadChat(groupId) {
    $.ajax({
        url: '/chat-support/groups/' + groupId + '/load-chat',  // Your dynamic route to load the chat
        type: 'GET',
        success: function(response) {
            console.log(response)
            $('.chat-section').html(response);  // Load the chat Blade into the chat messages section
        },
        error: function() {
            alert('Failed to load chat. Please try again.');
        }
    });
}
</script>
@endsection
