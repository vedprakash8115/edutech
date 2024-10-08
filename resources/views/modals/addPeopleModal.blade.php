<div class="modal" id="addPeopleModal" tabindex="-1" aria-labelledby="addPeopleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('groups.addPeople',$group->id) }}" method="POST" id="addPeopleForm">
                @csrf
                <input type="hidden" name="group_id" id="addPeopleGroupId">
                <div class="modal-header">
                    <h5 class="modal-title text-white" id="addPeopleModalLabel">Add People to Group</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <select id="people" name="students[]" class="form-control cursor-pointer" multiple>
                    
                </select>
            </div>

                <input type="hidden" value="{{$videoCourseId}}" name = "video_course_id">

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Add People</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    // Ensure event listener is only bound once
    $('#addPeopleModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var groupId = button.data('group-id'); // Extract info from data-* attributes

        // Set the hidden input for the group ID
        $('#addPeopleGroupId').val(groupId);

        // Refresh available students for this group
        refreshAvailableStudents(groupId);
    });

    function refreshAvailableStudents(groupId) {
        $.ajax({
            url: '/chat-support/groups/' + groupId + '/available-students',
            type: 'GET',
            success: function(response) {
                $('#people').empty(); // Clear current options
                Object.values(response.data).forEach(function(student) {
                    $('#people').append('<option value="'+student.id+'">'+student.name+'</option>');
                });

            },
            error: function() {
                alert('Failed to refresh available students.');
            }
        });
    }

    // Use 'off' to avoid multiple form submissions
    $(document).off('submit', '#addPeopleForm').on('submit', '#addPeopleForm', function(e) {
        e.preventDefault(); // Prevent the default form submission

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(), // Serialize form data
            success: function(response) {
                console.log(response);
                alert('People added successfully!');
                $('#addPeopleModal').modal('hide'); // Hide the modal after success
            },
            error: function(xhr) {
                console.log(xhr); // Log the entire response for debugging
                alert('Failed to add people: ' + (xhr.responseJSON ? xhr.responseJSON.error : 'Unknown error'));
            }
        });
    });
});

</script>