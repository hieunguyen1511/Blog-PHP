@extends('layouts.adminLayout')
@section('content')

<div class="max-w-6xl mx-auto p-4 bg-white shadow-md rounded-lg">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold">{{ __('language.title_notification_type_index') }}</h2>
        <div class="flex space-x-2">
            <button id="openAddModal" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                + {{ __('language.btn_add_notification_type') }}
            </button>
            <button id="deleteSelected" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                {{ __('language.btn_delete_items') }}
            </button>
        </div>
    </div>

    <table id="notificationTypeTable" class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr class="bg-gray-100 border-b">
                <th class="p-2"><input type="checkbox" id="selectAll" class="w-4 h-4"></th>
                <th class="p-2">ID</th>
                <th class="p-2">{{__('language.title_tag_notification_type')}}</th>
                <th class="p-2">{{__('language.title_message_notification_type')}}</th>
                <th class="p-2">{{__('language.title_action')}}</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<div id="addNotificationTypeModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white rounded-lg shadow-xl p-6 w-96">
        <h2 class="text-2xl font-semibold mb-4"> {{__('language.title_add_notification_type') }}</h2>
        <form id="addNotificationTypeForm">
            @csrf
            <div class="mb-4">
                <label for="addTagNotificationType" class="block text-sm font-medium text-gray-700">
                    {{ __('language.title_tag_notification_type') }}
                </label>
                <input type="text" id="addTagNotificationType" name="addTagNotificationType" class="w-full mt-1 p-2 border rounded" 
                    placeholder="{{ __('language.placeholder_tag_notification_type') }}">
            </div>
            
            <div class="mb-4">
                <label for="addMessageNotificationType" class="block text-sm font-medium text-gray-700">
                    {{ __('language.title_message_notification_type') }}
                </label>
                <input type="text" id="addMessageNotificationType" name="addMessageNotificationType" class="w-full mt-1 p-2 border rounded" 
                    placeholder="{{ __('language.placeholder_message_notification_type') }}">
            </div>

            <div class="flex justify-end space-x-2">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">{{__('language.btn_create')}}</button>
                <button type="button" id="closeAddModal" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">{{__('language.btn_cancel')}}</button>
            </div>
        </form>
    </div>
</div>

<div id="editNotificationTypeModal" class="fixed inset-0 flex items-center justify-center hidden bg-gray-900 bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
        <h2 class="text-xl font-semibold mb-4">{{ __('language.title_edit_notification_type') }}</h2>
        <form id="editNotificationTypeForm">
            @csrf
            <input type="hidden" id="editNotificationTypeId">
            <div class="mb-4">
                <label for="editTagNotificationType" class="block text-sm font-medium text-gray-700">
                    {{ __('language.title_tag_notification_type') }}
                </label>
                <input type="text" id="editTagNotificationType" name="editTagNotificationType" class="w-full mt-1 p-2 border rounded" 
                    placeholder="{{ __('language.placeholder_tag_notification_type') }}">
            </div>
            
            <div class="mb-4">
                <label for="editMessageNotificationType" class="block text-sm font-medium text-gray-700">
                    {{ __('language.title_message_notification_type') }}
                </label>
                <input type="text" id="editMessageNotificationType" name="editMessageNotificationType" class="w-full mt-1 p-2 border rounded" 
                    placeholder="{{ __('language.placeholder_message_notification_type') }}">
            </div>

            <div class="flex justify-end space-x-2">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">{{ __('language.btn_edit') }}</button>
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">{{ __('language.btn_cancel') }}</button>
            </div>
        </form>
    </div>
</div>


<script>
    let language = @json(__('language'));
    var currentLocale = "{{ app()->getLocale() }}"; 
    $(document).ready(function() {
        let table = $('#notificationTypeTable').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: "{{ route('notificationType.getAll') }}",
                dataSrc: 'notificationTypes',
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
                { data: 'tag', name: 'tag'},
                { data: 'message', name: 'message'},
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

        $('#openAddModal').on('click', function() {
            $('#addNotificationTypeModal').removeClass('hidden');
        });
        $('#closeAddModal').on('click', function() {
            $('#addNotificationTypeModal').addClass('hidden');
        });
        
        $('#addNotificationTypeForm').on('submit', function(e) {
            e.preventDefault();
            let tag = $('#addTagNotificationType').val();
            let message = $('#addMessageNotificationType').val();
            
            if (tag === "") {
                toastr.warning("{{__('language.error_tag_notification_type')}}", "{{__('language.message_warning')}}", {
                    closeButton: true,
                    progressBar: true,
                    timeOut: 3000, 
                    positionClass: 'toast-top-right', 
                });
                return;
            }
            if (message === "") {
                toastr.warning("{{__('language.error_message_notification_type')}}", "{{__('language.message_warning')}}", {
                    closeButton: true,
                    progressBar: true,
                    timeOut: 3000, 
                    positionClass: 'toast-top-right', 
                });
                return;
            }

            $.ajax({
                url: "{{ route('notificationType.create') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    tag: tag,
                    message: message,
                },
                success: function(response) {
                    if (response.status == '200') {
                        $('#addNotificationTypeModal').addClass('hidden');
                        $('#addTagNotificationType').val(''); 
                        $('#addMessageNotificationType').val(''); 
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


        $("#editNotificationTypeForm").submit(function(e) {
            e.preventDefault();

            let notificationTypeId = $("#editNotificationTypeId").val();
            let tag = $('#editTagNotificationType').val();
            let message = $('#editMessageNotificationType').val();
            if (tag === "") {
                toastr.warning("{{__('language.error_tag_notification_type')}}", "{{__('language.message_warning')}}", {
                    closeButton: true,
                    progressBar: true,
                    timeOut: 3000, 
                    positionClass: 'toast-top-right',
                });
                return;
            }
            if (message === "") {
                toastr.warning("{{__('language.error_message_notification_type')}}", "{{__('language.message_warning')}}", {
                    closeButton: true,
                    progressBar: true,
                    timeOut: 3000, 
                    positionClass: 'toast-top-right',
                });
                return;
            }
            $.ajax({
                
                url: `{{ route('notificationType.update', ':id') }}`.replace(':id', notificationTypeId),
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    tag: tag,
                    message: message,
                },
                success: function(response) {
                    if (response.status === '200') {
                        $("#editNotificationTypeModal").addClass("hidden");
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
        

        function deleteNotificationType(notificationTypeId) {
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
                        url: `{{ route('notificationType.delete', ':id') }}`.replace(':id', notificationTypeId),
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

        $('#notificationTypeTable').on('click', '.delete-btn', function() {
            var notificationTypeId = $(this).data('id');
            deleteNotificationType(notificationTypeId);  
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
                        url: `{{ route('notificationType.deleteItems') }}`,
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


    function openEditModal(notificationTypeId) {
        $.ajax({
            url: `{{ route('notificationType.get', ':id') }}`.replace(':id', notificationTypeId),
            type: "GET",
            success: function(response) {
                if (response.status === '200') {
                    $("#editNotificationTypeId").val(response.notificationType.id);
                    $("#editTagNotificationType").val(response.notificationType.tag);
                    $("#editMessageNotificationType").val(response.notificationType.message);
                    $("#editNotificationTypeModal").removeClass("hidden");
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
    // Đóng modal
    function closeEditModal() {
        $("#editNotificationTypeModal").addClass("hidden");
    }
    
</script>

@endsection