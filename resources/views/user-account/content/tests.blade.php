@extends ('user-account.layout.app')
@section('content')

 <div class="container">
        <div class="my-tests-section">
            <h2 class="section-title">My Tests</h2>
            <ul class="nav nav-pills mb-4" id="myTestsTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="all-tests-tab" data-bs-toggle="pill" data-bs-target="#all-tests" type="button" role="tab" aria-controls="all-tests" aria-selected="true">All Tests</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="mock-tests-tab" data-bs-toggle="pill" data-bs-target="#mock-tests" type="button" role="tab" aria-controls="mock-tests" aria-selected="false">Mock Tests</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="practice-tests-tab" data-bs-toggle="pill" data-bs-target="#practice-tests" type="button" role="tab" aria-controls="practice-tests" aria-selected="false">Practice Tests</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="quizzes-tab" data-bs-toggle="pill" data-bs-target="#quizzes" type="button" role="tab" aria-controls="quizzes" aria-selected="false">Quizzes</button>
                </li>
            </ul>
            <div class="tab-content" id="myTestsTabContent">
                <div class="tab-pane fade show active" id="all-tests" role="tabpanel" aria-labelledby="all-tests-tab">
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="test-card">
                                <div class="test-card-header d-flex justify-content-between align-items-center">
                                    <span class="badge bg-primary">Mock Test</span>
                                    <span class="score-badge">Score: 85%</span>
                                </div>
                                <div class="test-card-body">
                                    <h5 class="test-title">Web Development Fundamentals</h5>
                                    <p class="test-info">
                                        <i class="fas fa-calendar-alt me-2"></i>Attempted on: May 15, 2023<br>
                                        <i class="fas fa-clock me-2"></i>Duration: 60 minutes<br>
                                        <i class="fas fa-list-ol me-2"></i>Questions: 50
                                    </p>
                                    <div class="d-flex justify-content-between mt-3">
                                        <button class="btn btn-view-result">View Result</button>
                                        <button class="btn btn-retake">Retake Test</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="test-card">
                                <div class="test-card-header d-flex justify-content-between align-items-center">
                                    <span class="badge bg-success">Practice Test</span>
                                    <span class="score-badge">Score: 92%</span>
                                </div>
                                <div class="test-card-body">
                                    <h5 class="test-title">JavaScript Advanced Concepts</h5>
                                    <p class="test-info">
                                        <i class="fas fa-calendar-alt me-2"></i>Attempted on: May 20, 2023<br>
                                        <i class="fas fa-clock me-2"></i>Duration: 45 minutes<br>
                                        <i class="fas fa-list-ol me-2"></i>Questions: 30
                                    </p>
                                    <div class="d-flex justify-content-between mt-3">
                                        <button class="btn btn-view-result">View Result</button>
                                        <button class="btn btn-retake">Retake Test</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="test-card">
                                <div class="test-card-header d-flex justify-content-between align-items-center">
                                    <span class="badge bg-info">Quiz</span>
                                    <span class="score-badge">Score: 78%</span>
                                </div>
                                <div class="test-card-body">
                                    <h5 class="test-title">CSS Flexbox and Grid</h5>
                                    <p class="test-info">
                                        <i class="fas fa-calendar-alt me-2"></i>Attempted on: May 25, 2023<br>
                                        <i class="fas fa-clock me-2"></i>Duration: 15 minutes<br>
                                        <i class="fas fa-list-ol me-2"></i>Questions: 15
                                    </p>
                                    <div class="d-flex justify-content-between mt-3">
                                        <button class="btn btn-view-result">View Result</button>
                                        <button class="btn btn-retake">Retake Quiz</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <nav aria-label="Test results pagination">
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true"><i class="fas fa-chevron-left"></i></a>
                            </li>
                            <li class="page-item active" aria-current="page">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="tab-pane fade" id="mock-tests" role="tabpanel" aria-labelledby="mock-tests-tab">
                    <!-- Content for Mock Tests tab -->
                    <p>Mock Tests content goes here.</p>
                </div>
                <div class="tab-pane fade" id="practice-tests" role="tabpanel" aria-labelledby="practice-tests-tab">
                    <!-- Content for Practice Tests tab -->
                    <p>Practice Tests content goes here.</p>
                </div>
                <div class="tab-pane fade" id="quizzes" role="tabpanel" aria-labelledby="quizzes-tab">
                    <!-- Content for Quizzes tab -->
                    <p>Quizzes content goes here.</p>
                </div>
            </div>
        </div>
    </div>
