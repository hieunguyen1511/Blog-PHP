@extends('layouts.adminLayout')
@section('content')

<div class="max-w-6xl mx-auto p-4 bg-white shadow-md rounded-lg">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold">{{ __('language.title_notification_index') }}</h2>
        <div class="flex space-x-2">
            <button id="deleteSelected" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                {{ __('language.btn_delete_items') }}
            </button>
        </div>
    </div>

    <table id="notificationTable" class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr class="bg-gray-100 border-b">
                <th class="p-2"><input type="checkbox" id="selectAll" class="w-4 h-4"></th>
                <th class="p-2">ID</th>
                <th class="p-2">{{__('language.title_user_notification')}}</th>
                <th class="p-2">{{__('language.title_content_notification')}}</th>
                <th class="p-2">{{__('language.title_notification_type')}}</th>
                <th class="p-2">{{__('language.title_create_at')}}</th>
                <th class="p-2">{{__('language.title_action')}}</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<div id="editNotificationModal" class="fixed inset-0 flex items-center justify-center hidden bg-gray-900 bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
        <h2 class="text-xl font-semibold mb-4">{{ __('language.title_edit_notification') }}</h2>
        <form id="editNotificationForm">
            @csrf
            <input type="hidden" id="editNotificationId">
            <div class="mb-4">
                <label for="editUser" class="block text-sm font-medium text-gray-700">
                    {{ __('language.title_user_notification') }}
                </label>
                <select id="editUser" name="editUser" class="w-full mt-1 p-2 border rounded">
                    
                </select>
            </div>
            <div class="mb-4">
                <label for="editNotificationContent" class="block text-sm font-medium text-gray-700">
                    {{ __('language.title_content_notification') }}
                </label>
                <input type="text" id="editNotificationContent" name="editNotificationContent" class="w-full mt-1 p-2 border rounded" 
                    placeholder="{{ __('language.placeholder_content_notification') }}">
            </div>
            <div class="mb-4">
                <label for="editNotificationType" class="block text-sm font-medium text-gray-700">
                    {{ __('language.title_notification_type') }}
                </label>
                <select id="editNotificationType" name="editNotificationType" class="w-full mt-1 p-2 border rounded">
                </select>
            </div>

            <div class="flex justify-end space-x-2">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">{{ __('language.btn_edit') }}</button>
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">{{ __('language.btn_cancel') }}</button>
            </div>
        </form>
    </div>
</div>


<script>
    var currentLocale = "{{ app()->getLocale() }}"; 
    $(document).ready(function() {
        let table = $('#notificationTable').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: "{{ route('notification.getAll') }}",
                dataSrc: 'notifications'
            },
            columns: [
                { 
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `<input type="checkbox" class="rowCheckbox w-4 h-4 text-blue-600 border-gray-300 rounded" value="${row.id}">`;
                    }
                },
                { data: 'id', name: 'id' },
                { 
                    data: "user", 
                    name: "user",
                    render: function(data, type, row) {
                        return `
                            <div class="flex items-center">
                                <img class="h-8 w-8 rounded-full mr-2" src="${data.profile_picture}" alt="${data.full_name}">
                                <span>${data.full_name}</span>
                            </div>
                        `;
                    }
                },
                { data: 'content', name: 'content', render: function(data) {
                    return truncateText(data, 10);
                }  },
                { data: 'noti_type_name', name: 'noti_type_name', render: function(data) {
                    return truncateText(data, 10);
                }  },
                { data: "created_at", name: "created_at" },
                { 
                    data: null,
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `<div class="flex space-x-2">
                            <button onclick="openEditModal(${row.id})" class="px-3 py-1 text-sm text-white bg-blue-500 rounded hover:bg-blue-600">{{ __('language.btn_edit') }}</button>
                            <button class="delete-btn px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600" data-id="${row.id}">
                                {{ __('language.btn_delete') }}
                            </button>
                        </div>`;
                    }
                }
            ],
            language: {
                url: `//cdn.datatables.net/plug-ins/1.13.6/i18n/${currentLocale}.json`
            }
        });

        $('#selectAll').on('change', function() {
            $('.rowCheckbox').prop('checked', this.checked);
        });

        $(document).on('change', '.rowCheckbox', function() {
            if ($('.rowCheckbox:checked').length === $('.rowCheckbox').length) {
                $('#selectAll').prop('checked', true);
            } else {
                $('#selectAll').prop('checked', false);
            }
        });
        

        $.ajax({

            url: "{{ route('notification.getData') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
            },
            success: function(response) {
                if (response.status === '200') {
                    let userSelect = $('#editUser');
                    let notificationSelectTypes = $('#editNotificationType');
                    response.users.forEach(element => {
                        userSelect.append(`<option value="${element.id}">${element.full_name}</option>`);
                    });
                    response.notificationTypes.forEach(element => {
                        notificationSelectTypes.append(`<option value="${element.id}">${element.name}</option>`);
                    });
                } else {
                    toastr.error(response.message, "{{__('language.message_fail')}}", {
                        closeButton: true,
                        progressBar: true,
                        timeOut: 3000,
                        positionClass: 'toast-top-right', 
                    });
                }
            },
            error: function(xhr) {
                toastr.error(xhr.responseJSON?.message || "{{__('language.unknown_error')}}", "{{__('language.message_fail')}}", {
                    closeButton: true,
                    progressBar: true,
                    timeOut: 3000, 
                    positionClass: 'toast-top-right', 
                });
            }
        });

        $("#editNotificationForm").submit(function(e) {
            e.preventDefault();

            let notificationId = $("#editNotificationId").val();
            let user_id = $('#editUser').val();
            let content = $('#editNotificationContent').val();
            let noti_type = $('#editNotificationType').val();
            if (content === "") {
                toastr.warning("{{__('language.error_content_notification')}}", "{{__('language.message_warning')}}", {
                    closeButton: true,
                    progressBar: true,
                    timeOut: 3000, 
                    positionClass: 'toast-top-right',
                });
                return;
            }

            $.ajax({
                
                url: `{{ route('notification.update', ':id') }}`.replace(':id', notificationId),
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    user_id: user_id,
                    content: content,
                    noti_type: noti_type,
                },
                success: function(response) {
                    if (response.status === '200') {
                        $("#editNotificationModal").addClass("hidden");
                        table.ajax.reload(function() {
                            toastr.success(response.message, "{{__('language.message_success')}}", {
                                closeButton: true,
                                progressBar: true,
                                timeOut: 3000,
                                positionClass: 'toast-top-right', 
                            });
                        });
                        
                    } else {
                        toastr.error(response.message, "{{__('language.message_fail')}}", {
                            closeButton: true,
                            progressBar: true,
                            timeOut: 3000, 
                            positionClass: 'toast-top-right', 
                        });
                    }
                },
                error: function(xhr) {
                    toastr.error(xhr.responseJSON?.message || "{{__('language.unknown_error')}}", "{{__('language.message_fail')}}", {
                        closeButton: true,
                        progressBar: true,
                        timeOut: 3000, 
                        positionClass: 'toast-top-right', 
                    });
                }
            });
        });
        

        function deleteNotification(notificationId) {
            Swal.fire({
                title: "{{__('language.title_confirm_delete')}}",
                text: "{{__('language.confirm_delete_item')}}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "{{__('language.confirm_yes')}}",
                cancelButtonText: "{{__('language.btn_cancel')}}",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `{{ route('notification.delete', ':id') }}`.replace(':id', notificationId),
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.status == '200') {
                                table.ajax.reload(function() {
                                    toastr.success(response.message, "{{__('language.message_success')}}", {
                                        closeButton: true,
                                        progressBar: true,
                                        timeOut: 3000,
                                        positionClass: 'toast-top-right',
                                    });
                                }); 
                            } else {
                                toastr.error(response.message, "{{__('language.message_fail')}}", {
                                    closeButton: true,
                                    progressBar: true,
                                    timeOut: 3000,
                                    positionClass: 'toast-top-right',
                                });
                            }
                            
                        },
                        error: function(xhr) {
                            toastr.error(xhr.responseJSON?.message || "{{__('language.unknown_error')}}", "{{__('language.message_fail')}}", {
                                closeButton: true,
                                progressBar: true,
                                timeOut: 3000,
                                positionClass: 'toast-top-right',
                            });
                            alert();
                        }
                    });
                }
            });
        }

        $('#notificationTable').on('click', '.delete-btn', function() {
            var notificationId = $(this).data('id');
            deleteNotification(notificationId);  
        });


        $('#deleteSelected').on('click', function() {
            let selectedIds = [];
            $('.rowCheckbox:checked').each(function() {
                selectedIds.push($(this).val());
            });
        
            if (selectedIds.length === 0) {
                toastr.warning("{{__('language.error_no_item_selected')}}", "{{__('language.message_warning')}}", {
                    closeButton: true,
                    progressBar: true,
                    timeOut: 3000, 
                    positionClass: 'toast-top-right',
                });
                return;
            }

            Swal.fire({
                title: "{{__('language.title_confirm_delete')}}",
                text: "{{__('language.confirm_delete_items')}}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "{{__('language.confirm_yes')}}",
                cancelButtonText: "{{__('language.btn_cancel')}}",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `{{ route('notification.deleteItems') }}`,
                        type: "POST",
                        data: {
                            ids: selectedIds,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.status == '200') {
                                table.ajax.reload(function() {
                                    toastr.success(response.message, "{{__('language.message_success')}}", {
                                        closeButton: true,
                                        progressBar: true,
                                        timeOut: 3000,
                                        positionClass: 'toast-top-right',
                                    });
                                });
                            } else {
                                table.ajax.reload(function() {
                                    toastr.error(response.message, "{{__('language.message_fail')}}", {
                                        closeButton: true,
                                        progressBar: true,
                                        timeOut: 3000, 
                                        positionClass: 'toast-top-right',
                                    });
                                });
                            }
                            
                        },
                        error: function(xhr) {
                            toastr.error(xhr.responseJSON?.message || "{{__('language.unknown_error')}}", "{{__('language.message_fail')}}", {
                                closeButton: true,
                                progressBar: true,
                                timeOut: 3000, 
                                positionClass: 'toast-top-right',
                            });
                        }
                    });
                }
            });
        });
    });


    function openEditModal(notificationId) {
        $.ajax({
            url: `{{ route('notification.get', ':id') }}`.replace(':id', notificationId),
            type: "GET",
            success: function(response) {
                if (response.status === '200') {
                    $("#editNotificationId").val(response.notification.id);
                    $("#editUser").val(response.notification.user_id);
                    $("#editNotificationContent").val(response.notification.content);
                    $("#editNotificationType").val(response.notification.noti_type);
                    $("#editNotificationModal").removeClass("hidden");
                } else {
                    toastr.error("{{ __('language.error_fetching_data') }}", "{{__('language.message_fail')}}", {
                        closeButton: true,
                        progressBar: true,
                        timeOut: 3000, 
                        positionClass: 'toast-top-right', 
                    });
                }
            },
            error: function() {
                toastr.error("{{ __('language.error_fetching_data') }}", "{{__('language.message_fail')}}", {
                    closeButton: true,
                    progressBar: true,
                    timeOut: 3000,
                    positionClass: 'toast-top-right', 
                });
            }
        });
    }
    function closeEditModal() {
        $("#editNotificationModal").addClass("hidden");
    }
    
</script>

@endsection