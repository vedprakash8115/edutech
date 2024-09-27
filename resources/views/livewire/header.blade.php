<div>
    <div class="card my-4">
        <div class="card-body">
            <div class="card-title">Flow Chart for mock test creation</div>
            <div class="card-text">
                <a href="{{route('mock_test')}}"  class="text-white"><button class="btn btn-primary">Create Test</button></a>
                <i class="fas fa-arrow-right"></i>

                <a href="{{route('mock_subjects')}}"  class="text-white"><button class="btn btn-primary">Manage Subjects</button></a>
                <i class="fas fa-arrow-right"></i>

                <a href="{{route('mock_questions')}}"  class="text-white"><button class="btn btn-primary">Manage Questions</button></a>
{{-- <i class="fas fa-arrow-right"></i> --}}

{{-- <sssbutton class="btn btn-success">Create Options</sssbutton> --}}

            </div>
        </div>
        <div class="card-body">
            <div class="card-title">Hints</div>
            <ul class="list-group">
                <li class="list-item">Create the test section firstly</li>
                <li class="list-item">Create the subjects section for the test </li>
                <li class="list-item">Create questions for the test</li>
                <li class="list-item">Create options for the test (only in mcq)</li>
              </ul>
              
        </div>
    </div>
</div>
