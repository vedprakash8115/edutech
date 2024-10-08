<div class="chat-header bg-white shadow-sm rounded-lg p-3">
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <h5 class="mb-0 fw-bold text-primary">{{ $group->name }}</h5>
            <span class="badge bg-success ms-2 py-1 px-2">Active</span>
        </div>
        
        <div class="d-flex align-items-center">
            <div class="dropdown me-3">
                <button class="btn btn-outline-primary btn-sm dropdown-toggle d-flex align-items-center" type="button" id="teacherDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-chalkboard-teacher me-2"></i>
                    {{($group->teacher_id)? 'Change Teacher': 'Assign Teacher'}}
                </button>
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
        {{$message->user->name}} 
        <div class="message {{ $message->is_sent ? 'message-sent' : 'message-received' }}">
           {{ $message->content }}
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

.badge {
    font-weight: 500;
    letter-spacing: 0.5px;
}
</style>
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