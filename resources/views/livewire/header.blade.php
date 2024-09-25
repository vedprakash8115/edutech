<div class="mock-test-flowchart">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Mock Test Creation Flow</h3>
                <div class="flow-steps">
                    <a href="{{ route('mock_test') }}" class="flow-step">
                        <div class="step-icon"><i class="fas fa-file-alt"></i></div>
                        <div class="step-text">Create Test</div>
                    </a>
                    <div class="flow-arrow"><i class="fas fa-chevron-right"></i></div>
                    <a href="{{ route('mock_subjects') }}" class="flow-step">
                        <div class="step-icon"><i class="fas fa-book"></i></div>
                        <div class="step-text">Manage Subjects</div>
                    </a>
                    <div class="flow-arrow"><i class="fas fa-chevron-right"></i></div>
                    <a href="{{ route('mock_questions') }}" class="flow-step">
                        <div class="step-icon"><i class="fas fa-question-circle"></i></div>
                        <div class="step-text">Manage Questions</div>
                    </a>
                </div>
                <div class="text-center mt-4">
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#instructionsModal">
                        Read Instructions
                    </button>
                </div>
            </div>
        </div>

    <!-- Instructions Modal -->
        <div class="modal fade" id="instructionsModal" tabindex="-1" aria-labelledby="instructionsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="instructionsModalLabel">Mock Test Creation Instructions</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h4>Step-by-Step Guide</h4>
                        <ol>
                            <li>
                                <strong>Create the Test Section</strong>
                                <p>Start by creating the overall structure of your mock test. This includes setting the test name, duration, and any specific instructions for test-takers.</p>
                            </li>
                            <li>
                                <strong>Create the Subjects Section</strong>
                                <p>Define the subjects or topics that will be covered in your mock test. This helps in organizing questions and ensures a balanced test structure.</p>
                            </li>
                            <li>
                                <strong>Create Questions for the Test</strong>
                                <p>Develop a variety of questions for each subject. Ensure that the questions align with the test objectives and cover the necessary topics.</p>
                            </li>
                            <li>
                                <strong>Create Options for MCQs</strong>
                                <p>If your test includes multiple-choice questions (MCQs), create options for each question. Make sure to include the correct answer and plausible distractors.</p>
                            </li>
                        </ol>
                        <h4>Additional Tips</h4>
                        <ul>
                            <li>Review and proofread all questions and answers to avoid errors.</li>
                            <li>Upload images in question later if questions are uploaded via CSV </li>
                            <li>Make sure if you proper negative marking and optional questions to avoid any conflicts.</li>
                            <li>Provide clear instructions for each question type (e.g., MCQ, short answer, essay).</li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <style>
        .mock-test-flowchart {
            font-family: 'Arial', sans-serif;
            max-width: 800px;
            margin: 0 auto;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }

        .flow-steps {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .flow-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: #777;
            transition: all 0.3s ease;
        }

        .flow-step:hover {
            transform: scale(1.05);
        }

        .step-icon {
            width: 60px;
            height: 60px;
            background: #007bff;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 10px;
        }

        .step-icon i {
            font-size: 24px;
            color: #fff;
        }

        .step-text {
            font-size: 0.9rem;
            font-weight: bold;
            text-align: center;
        }

        .flow-arrow {
            font-size: 24px;
            color: #007bff;
        }

        @media (max-width: 768px) {
            .flow-steps {
                flex-direction: column;
            }
            
            .flow-arrow {
                transform: rotate(90deg);
                margin: 15px 0;
            }
        }
        </style>
        <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const flowSteps = document.querySelectorAll('.flow-step');
            
            flowSteps.forEach((step, index) => {
                step.style.animationDelay = `${index * 0.2}s`;
                step.classList.add('animate-in');
            });
        });
        </script>
        

</div>

