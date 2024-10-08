<div class="chat-header bg-white shadow-sm rounded-lg p-3">
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <h5 class="mb-0 fw-bold text-primary">{{ $group->name }}</h5>
            <span class="badge bg-success ms-2 py-1 px-2">Active</span>
        </div>

        
        <div class="d-flex align-items-center">
            <button class="btn btn-info btn-sm me-1" id="openGroupInfoBtn">
                <i class="fas fa-info-circle"></i>
            </button>
            <div class="dropdown me-3">
            @role('admin') <!-- Check if the user is an admin -->
                <button class="btn btn-outline-primary btn-sm dropdown-toggle d-flex align-items-center" 
                    type="button" id="teacherDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-chalkboard-teacher me-2"></i>
                    {{ ($group->teacher_id) ? 'Change Teacher' : 'Assign Teacher' }}
                </button>
            @endrole

                <ul class="dropdown-menu shadow-lg border-0" aria-labelledby="teacherDropdown" id="teacherDropdownMenu">
                    <!-- Teachers will be dynamically loaded here -->
                </ul>
            </div>
            
            <button class="btn btn-primary btn-sm d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addPeopleModal" data-group-id="{{ $group->id }}">
                <i class="fas fa-user-plus me-2"></i> Add People
            </button>
        </div>
    </div>
    <div class="mt-2 text-muted">
    <div class="mt-2 text-muted">
        <small><i class="fas fa-user-tie me-1"></i> Teacher: <span id="teacherNameDisplay">{{ $teacherName }}</span></small>
    </div>
    </div>
    
</div>
<div class="chat-messages">
    @foreach($messages as $message)
        <div class="message-wrapper {{ $message->user_id === auth()->id() ? '' : 'wrapper-received' }}">
            <div class="user {{ $message->user_id === auth()->id() ? 'current-user' : '' }}">
                {{$message->user->name}} 
            </div>
            <div class="message {{ $message->user_id === auth()->id() ? 'message-sent' : 'message-received' }}">
                {{ $message->content }}
            </div>

        </div>
    @endforeach
</div>
<div class="chat-input">
    <div class="input-group">
        <input type="text" class="form-control" id="messageContent" placeholder="Type a message" required>
        <input type="hidden" id="groupId" value="{{ $group->id }}"> <!-- Hidden input to store group ID -->
        <button class="btn btn-send" id="sendMessage">
            <i class="fas fa-paper-plane"></i>
        </button>
    </div>
</div>
<div id="groupInfoModal" class="custom-modal d-none">
    <div class="custom-modal-content">
        <div class="modal-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-white">Group Information</h5>
            <button class="btn-close" id="closeGroupInfoBtn"></button>
        </div>
        <div class="modal-body">
            <h6><i class="fas fa-info-circle me-2"></i>Description:</h6>
            <p class="text-muted">{{ $group->description }}</p>
            <h6><i class="fas fa-users me-2"></i>Students in this group:</h6>
            <ul class="list-group">
                @foreach($group->users as $user)
                <li class="list-group-item">
                    <i class="fas fa-user-circle me-2"></i>{{ $user->name }}
                </li>
                @endforeach
            </ul>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" id="closeGroupInfoFooterBtn">Close</button>
        </div>
    </div>
</div>

@include('modals.addPeopleModal')
<style>
.chat-header {
    transition: all 0.3s ease;
}

.chat-header:hover {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}

.dropdown-menu {
    border-radius: 0.5rem;
}

.btn-outline-primary {
    border-width: 2px;
}

.btn-outline-primary:hover, .btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
}
.btn-info{
    height: 1.9rem;
    border-radius: 5px;
}

.chat-messages {
    height: 27rem;
    overflow-y: auto;
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 1rem;
    background-color: #e5ded8;
}
.message-wrapper{
    width: 100%;
    display: flex;
    justify-content: end;
}
.message {
    display: inline-block;
    max-width: 30%;
    margin-bottom: 10px;
    padding: 8px 12px;
    border-radius: 7.5px;
    position: relative;
}
.message-received {
    background-color: #fff;
    justify-content: start;
    border-top-left-radius: 0;
}
.user{
    background-color: #ffffff5c;
    text-align: center;
    height: 1.2rem;
    border-radius: 5px;
    margin-right: 3px;
    font-size: 0.8rem;
    width: 3rem;
}
.current-user{

}
.wrapper-received{
    justify-content: start;
}
.message-sent {
    background-color: #dcf8c6;
    align-self: flex-end;
    border-top-right-radius: 0;
}
.chat-input {
    background-color: #f0f2f5;
    border-top: 1px solid #e0e0e0;
    padding: 10px 15px;
}
.chat-input input {
    border-radius: 20px;
    border: none;
    padding: 10px 15px;
}
.btn-send {
    background-color: #128C7E;
    color: white;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Modal Styling */
.custom-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1050;
    }
    .custom-modal-content {
        background-color: #fff;
        border-radius: 15px;
        width: 90%;
        max-width: 500px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }
    .modal-header {
        background-color: #075e54;
        color: white;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        padding: 1rem;
    }
    .modal-body {
        padding: 1.5rem;
    }
    .modal-footer {
        border-top: 1px solid #e9ecef;
        padding: 1rem;
        background-color: #f8f9fa;
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
    }
    .btn-close {
        color: white;
        opacity: 0.8;
        font-size: 1.5rem;
        padding: 0;
        margin: 0;
    }
    .btn-close:hover {
        color: #dcf8c6;
        opacity: 1;
    }
    .list-group-item {
        border: none;
        padding: 0.5rem 0;
        font-size: 0.9rem;
    }
    .list-group-item i {
        color: #075e54;
    }
    h6 {
        color: #075e54;
        font-weight: 600;
        margin-top: 1rem;
        margin-bottom: 0.5rem;
    }
    #closeGroupInfoFooterBtn {
        background-color: #075e54;
        border: none;
    }
    #closeGroupInfoFooterBtn:hover {
        background-color: #128C7E;
    }
</style>
<script>
$(document).ready(function() {
    // Open the modal
    $('#openGroupInfoBtn').on('click', function() {
        $('#groupInfoModal').removeClass('d-none');
    });

    // Close the modal (from header close button)
    $('#closeGroupInfoBtn').on('click', function() {
        $('#groupInfoModal').addClass('d-none');
    });

    // Close the modal (from footer close button)
    $('#closeGroupInfoFooterBtn').on('click', function() {
        $('#groupInfoModal').addClass('d-none');
    });

    // Optional: Close the modal by clicking outside the modal-content
    $(window).on('click', function(e) {
        if ($(e.target).hasClass('custom-modal')) {
            $('#groupInfoModal').addClass('d-none');
        }
    });
});

</script>
<script>
$(document).ready(function() {
    $('#sendMessage').on('click', function() {
        var content = $('#messageContent').val();
        var groupId = $('#groupId').val();

        // Send AJAX request to store the message
        $.ajax({
            url: '/chat-support/messages/store',
            type: 'POST',
            data: {
                content: content,
                group_id: groupId,
                _token: '{{ csrf_token() }}' // Include CSRF token
            },
            success: function(response) {
                // Clear input field
                $('#messageContent').val('');

                // Optionally, you could refresh the messages or append the new message directly
                loadChat(groupId); // Reload chat messages
            },
            error: function(xhr) {
                alert('Error sending message: ' + xhr.responseJSON.message);
            }
        });
    });
});
</script>
<script>
    $(document).ready(function() {
    // Fetch and populate the teacher dropdown when the page loads
    loadTeachers();

    function loadTeachers() {
        $.ajax({
            url: '/chat-support/groups/teachers', // Define the route to get teachers
            type: 'GET',
            success: function(response) {
                $('#teacherDropdownMenu').empty(); // Clear existing options
                console.log(response)
                response.teachers.forEach(function(teacher) {
                    $('#teacherDropdownMenu').append(
                        '<li><a class="dropdown-item" href="#" data-teacher-id="' + teacher.id + '">' + teacher.name + '</a></li>'
                    );
                });
            },
            error: function() {
                alert('Failed to load teachers.');
            }
        });
    }

    // Handle the teacher selection
    $(document).on('click', '#teacherDropdownMenu .dropdown-item', function(e) {
        e.preventDefault();
        var teacherId = $(this).data('teacher-id');
        var groupId = $('#groupId').val(); // Get the current group ID

        // Assign the selected teacher to the group
        assignTeacher(groupId, teacherId);
    });

    function assignTeacher(groupId, teacherId) {
    $.ajax({
        url: '/chat-support/groups/' + groupId + '/assign-teacher', // Adjust this to your route
        type: 'POST',
        data: { teacher_id: teacherId, _token: '{{ csrf_token() }}' }, // Include CSRF token
        success: function(response) {
            // Assuming response contains the updated teacher's name
            const teacherName = response[0].teacher_name;
            console.log(teacherName)

            // Update the displayed teacher name in the DOM
            $('#teacherNameDisplay').text(teacherName); // Update the teacher name dynamically
        },
        error: function(xhr) {
            alert('Failed to assign teacher: ' + (xhr.responseJSON ? xhr.responseJSON.error : 'Unknown error'));
        }
    });
}
});

</script>