<div class="modal fade" id="createGroupModal" tabindex="-1" aria-labelledby="createGroupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('groups.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title text-white" id="createGroupModalLabel">Create Group</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="groupName">Group Name</label>
                        <input type="text" name="name" class="form-control" id="groupName" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="videoCourse">Select Subject</label>
                        <select name="video_course_id" id="videoCourse" class="form-control cursor-pointer" required>
                            <option value="" disabled selected>Select subject</option>
                            @foreach ($subjects as $subject)
                                <option value="">{{$subject->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" value="{{$videoCourseId}}" name = "video_course_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create Group</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const addPeopleModal = document.getElementById('addPeopleModal');
    addPeopleModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const groupId = button.getAttribute('data-group-id');
        const input = addPeopleModal.querySelector('#addPeopleGroupId');
        input.value = groupId;
    });
});

</script>
<style>
    .modal-header {
        background-color: #075e54;
        color: white;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        padding: 1rem;
    }
</style>
