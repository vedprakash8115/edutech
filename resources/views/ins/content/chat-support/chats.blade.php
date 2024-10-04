@extends('layout.app')

@section('content')
<div class="chat-container">
        <div class="row g-0">
            <!-- Groups Section -->
            <div class="col-md-4 groups-section">
                <div class="p-3">
                    <h5 class="mb-3">Groups</h5>
                    <div class="group-item d-flex align-items-center p-2 mb-2 rounded active">
                        <img src="{{asset('image/avatar.jpg')}}" alt="Group 1" class="avatar me-3">
                        <div>
                            <h6 class="mb-0">Family Group</h6>
                            <small class="text-muted">You: See you all soon!</small>
                        </div>
                    </div>
                    <div class="group-item d-flex align-items-center p-2 mb-2 rounded">
                        <img src="{{asset('image/avatar.jpg')}}" alt="Group 2" class="avatar me-3">
                        <div>
                            <h6 class="mb-0">Work Team</h6>
                            <small class="text-muted">John: Meeting at 3 PM</small>
                        </div>
                    </div>
                    <div class="group-item d-flex align-items-center p-2 mb-2 rounded">
                        <img src="{{asset('image/avatar.jpg')}}" alt="Group 3" class="avatar me-3">
                        <div>
                            <h6 class="mb-0">Book Club</h6>
                            <small class="text-muted">Sarah: What's next on our list?</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chats Section -->
            <div class="col-md-8 chats-section">
                <div class="chat-header p-3 d-flex align-items-center">
                    <img src="{{asset('image/avatar.jpg')}}" alt="Family Group" class="avatar me-3">
                    <div>
                        <h5 class="mb-0">Family Group</h5>
                        <small class="text-muted">5 members</small>
                    </div>
                </div>
                <div class="chat-messages">
                    <div class="message message-received">
                        <p class="mb-0">Hey everyone! Are we still on for dinner tonight?</p>
                        <small class="text-muted">Mom, 2:30 PM</small>
                    </div>
                    <div class="message message-sent">
                        <p class="mb-0">Yes, I'll be there! Can't wait to see you all.</p>
                        <small class="text-muted">You, 2:35 PM</small>
                    </div>
                    <div class="message message-received">
                        <p class="mb-0">Great! I'm making your favorite lasagna.</p>
                        <small class="text-muted">Mom, 2:37 PM</small>
                    </div>
                    <div class="message message-sent">
                        <p class="mb-0">Awesome! See you all soon!</p>
                        <small class="text-muted">You, 2:40 PM</small>
                    </div>
                </div>
                <div class="chat-input">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-smile"></i></span>
                        <input type="text" class="form-control" placeholder="Type a message...">
                        <span class="input-group-text"><i class="fas fa-paper-plane"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .chat-container {
            height: 100vh;
            max-width: 1400px;
            margin: 0 auto;
            background-color: #fff;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
        }
        .groups-section, .chats-section {
            height: 100vh;
            overflow-y: auto;
        }
        .groups-section {
            background-color: #f0f2f5;
            border-right: 1px solid #e0e0e0;
        }
        .group-item, .chat-item {
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .group-item:hover, .chat-item:hover {
            background-color: #f5f5f5;
        }
        .group-item.active, .chat-item.active {
            background-color: #e6f7ff;
        }
        .avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
        .chat-header {
            background-color: #f0f2f5;
            border-bottom: 1px solid #e0e0e0;
        }
        .chat-messages {
            height: calc(100vh - 130px);
            overflow-y: auto;
            padding: 20px;
        }
        .message {
            max-width: 70%;
            margin-bottom: 20px;
            padding: 10px 15px;
            border-radius: 15px;
        }
        .message-received {
            background-color: #f0f0f0;
            align-self: flex-start;
        }
        .message-sent {
            background-color: #dcf8c6;
            align-self: flex-end;
        }
        .chat-input {
            background-color: #f0f2f5;
            border-top: 1px solid #e0e0e0;
            padding: 10px;
        }
        .input-group-text {
            background-color: #128C7E;
            border: none;
            color: white;
        }
    </style>

@endsection