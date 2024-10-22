@extends('layout.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-indigo-700 mb-6">Manage Notifications</h1>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="bg-indigo-600 text-white px-6 py-4">
            <h2 class="text-xl font-semibold text-white">Existing Notifications</h2>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table id="notificationsTable" class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Message</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Link</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($notifications as $notification)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $notification->title }}</td>
                                <td class="px-6 py-4">{{ Str::limit($notification->message, 50) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($notification->link_url)
                                        <a href="{{ $notification->link_url }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">View</a>
                                    @else
                                        <span class="text-gray-500">N/A</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($notification->image)
                                        <img src="{{ asset('storage/' . $notification->image) }}" alt="Notification Image" class="h-10 w-10 rounded-full">
                                    @else
                                        <span class="text-gray-500">No image</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded mr-2 send-notification-btn" data-id="{{ $notification->id }}">
                                        Send
                                    </button>
                                    <a href="{{ route('notification.edit', $notification->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                                        Edit
                                    </a>
                                    <form action="{{ route('notification.destroy', $notification->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this notification?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Custom Modal -->
<div id="sendNotificationModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Send Notification</h3>
            <div class="mt-2 px-7 py-3">
                <form id="sendNotificationForm" action="{{route('users.all')}}" method="POST">
                    @csrf
                    <input type="hidden" name="notification_id" id="notificationId">
                    <div class="mb-4">
                        <label for="roles" class="block text-gray-700 text-sm font-bold mb-2">Select Users by Role</label>
                        <select id="roles" name="roles[]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" multiple required>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="items-center px-4 py-3">
                        <button id="closeModal" type="button" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-300">
                            Cancel
                        </button>
                        <button type="submit" class="mt-3 px-4 py-2 bg-indigo-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-300">
                            Send Notification
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.24/css/dataTables.tailwindcss.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<style>
    /* Custom styles for Select2 */
    .select2-container .select2-selection--multiple {
        min-height: 38px;
        border: 1px solid #d2d6dc;
        border-radius: 0.375rem;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #4f46e5;
        border-color: #4338ca;
        color: #ffffff;
        padding: 2px 6px;
        margin-top: 4px;
    }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.tailwindcss.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#notificationsTable').DataTable({
            "pageLength": 10,
            "language": {
                "lengthMenu": "Show _MENU_ notifications per page",
                "zeroRecords": "No notifications found",
                "info": "Showing page _PAGE_ of _PAGES_",
                "infoEmpty": "No notifications available",
                "infoFiltered": "(filtered from _MAX_ total notifications)"
            },
            "columnDefs": [
                { "orderable": false, "targets": [3, 4] }
            ]
        });

        $('#roles').select2({
            placeholder: 'Select roles',
            allowClear: true,
            width: '100%'
        });

        // Custom modal functionality
        $('.send-notification-btn').on('click', function() {
            var notificationId = $(this).data('id');
            $('#notificationId').val(notificationId);
            $('#sendNotificationModal').removeClass('hidden');
        });

        $('#closeModal').on('click', function() {
            $('#sendNotificationModal').addClass('hidden');
        });

        

        // Close modal if clicked outside
        $(window).on('click', function(event) {
            if (event.target.id === 'sendNotificationModal') {
                $('#sendNotificationModal').addClass('hidden');
            }
        });
    });
</script>
@endpush