@extends('layouts.adminLayout')
@section('content')

<div class="max-w-6xl mx-auto p-4 bg-white shadow-md rounded-lg">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold">{{ __('language.title_category_index') }}</h2>
        <div class="flex space-x-2">
            <!-- Nút Thêm danh mục -->
            <button id="openAddModal" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                + {{ __('language.btn_add_category') }}
            </button>
            <!-- Nút Xóa danh mục đã chọn -->
            <button id="deleteSelected" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                {{ __('language.btn_delete_items') }}
            </button>
        </div>
    </div>

    <table id="categoryTable" class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr class="bg-gray-100 border-b">
                <th class="p-2"><input type="checkbox" id="selectAll" class="w-4 h-4"></th>
                <th class="p-2">ID</th>
                <th class="p-2">{{__('language.title_name_category')}}</th>
                <th class="p-2">{{__('language.title_action')}}</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<!-- Modal để thêm danh mục -->
<div id="addCategoryModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white rounded-lg shadow-xl p-6 w-96">
        <h2 class="text-2xl font-semibold mb-4"> {{__('language.title_add_category') }}</h2>
        <form id="addCategoryForm">
            @csrf
            <div class="mb-4">
                <label for="addCategoryName" class="block text-sm font-medium text-gray-700">{{__('language.title_name_category')}}</label>
                <input type="text" id="addCategoryName" name="addCategoryName" class="w-full mt-1 p-2 border rounded" placeholder="{{__('language.placeholder_name_category')}}">
            </div>
            <div class="flex justify-end space-x-2">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">{{__('language.btn_create')}}</button>
                <button type="button" id="closeAddModal" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">{{__('language.btn_cancel')}}</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal để sửa danh mục -->
<!-- Edit Category Modal -->
<div id="editCategoryModal" class="fixed inset-0 flex items-center justify-center hidden bg-gray-900 bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
        <h2 class="text-xl font-semibold mb-4">{{ __('language.title_edit_category') }}</h2>
        <form id="editCategoryForm">
            @csrf
            <input type="hidden" id="editCategoryId">
            
            <div class="mb-4">
                <label for="editCategoryName" class="block text-sm font-medium text-gray-700">{{ __('language.title_name_category') }}</label>
                <input type="text" id="editCategoryName" class="w-full p-2 border rounded" placeholder="{{__('language.placeholder_name_category')}}">
            </div>

            <div class="flex justify-end space-x-2">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">{{ __('language.btn_edit') }}</button>
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">{{ __('language.btn_cancel') }}</button>
            </div>
        </form>
    </div>
</div>


<script>
    var currentLocale = "{{ app()->getLocale() }}";  // Lấy locale từ Laravel
    $(document).ready(function() {
        let table = $('#categoryTable').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: "{{ route('category.getAll') }}",
                dataSrc: 'categories' // Dữ liệu từ API
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
                { data: 'name', name: 'name' },
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

        // Sự kiện chọn tất cả checkbox
        $('#selectAll').on('change', function() {
            $('.rowCheckbox').prop('checked', this.checked);
        });

        // Kiểm tra trạng thái của checkbox khi chọn từng hàng
        $(document).on('change', '.rowCheckbox', function() {
            if ($('.rowCheckbox:checked').length === $('.rowCheckbox').length) {
                $('#selectAll').prop('checked', true);
            } else {
                $('#selectAll').prop('checked', false);
            }
        });



        //Thêm category
        $('#openAddModal').on('click', function() {
            $('#addCategoryModal').removeClass('hidden');
        });
        $('#closeAddModal').on('click', function() {
            $('#addCategoryModal').addClass('hidden');
        });
        
        $('#addCategoryForm').on('submit', function(e) {
            e.preventDefault();
            let categoryName = $('#addCategoryName').val();
            
            if (categoryName === "") {
                toastr.warning("{{__('language.error_category_name')}}", "{{__('language.message_warning')}}", {
                    closeButton: true,
                    progressBar: true,
                    timeOut: 3000,  // Thời gian hiển thị thông báo (3 giây)
                    positionClass: 'toast-top-right',  // Vị trí thông báo ở góc trên bên phải
                });
                return;
            }

            $.ajax({
                url: "{{ route('category.create') }}",
                type: 'POST',
                data: {
                    name: categoryName,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.status == '200') {
                        $('#addCategoryModal').addClass('hidden');  // Đóng Modal
                        $('#addCategoryName').val('');  // Xóa dữ liệu trong form
                        table.ajax.reload(function() {
                            toastr.success(response.message, "{{__('language.message_success')}}", {
                                closeButton: true,
                                progressBar: true,
                                timeOut: 3000,  // Thời gian hiển thị thông báo (3 giây)
                                positionClass: 'toast-top-right',  // Vị trí thông báo ở góc trên bên phải
                            });
                        });
                    } else {
                        toastr.error(response.message, "{{__('language.message_fail')}}", {
                            closeButton: true,
                            progressBar: true,
                            timeOut: 3000,  // Thời gian hiển thị thông báo (3 giây)
                            positionClass: 'toast-top-right',  // Vị trí thông báo ở góc trên bên phải
                        });
                    }
                },
                error: function(xhr) {
                    toastr.error(xhr.responseJSON?.message || "{{__('language.unknown_error')}}", "{{__('language.message_fail')}}", {
                        closeButton: true,
                        progressBar: true,
                        timeOut: 3000,  // Thời gian hiển thị thông báo (3 giây)
                        positionClass: 'toast-top-right',  // Vị trí thông báo ở góc trên bên phải
                    });
                }
            });
        });

        // Xử lý submit form sửa category
        $("#editCategoryForm").submit(function(e) {
            e.preventDefault();

            let categoryId = $("#editCategoryId").val();
            let categoryName = $("#editCategoryName").val();

            $.ajax({
                
                url: `{{ route('category.update', ':id') }}`.replace(':id', categoryId),
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    name: categoryName
                },
                success: function(response) {
                    if (response.status === '200') {
                        $("#editCategoryModal").addClass("hidden");
                        table.ajax.reload(function() {
                            toastr.success(response.message, "{{__('language.message_success')}}", {
                                closeButton: true,
                                progressBar: true,
                                timeOut: 3000,  // Thời gian hiển thị thông báo (3 giây)
                                positionClass: 'toast-top-right',  // Vị trí thông báo ở góc trên bên phải
                            });
                        }); // Reload DataTable
                        
                    } else {
                        toastr.error(response.message, "{{__('language.message_fail')}}", {
                            closeButton: true,
                            progressBar: true,
                            timeOut: 3000,  // Thời gian hiển thị thông báo (3 giây)
                            positionClass: 'toast-top-right',  // Vị trí thông báo ở góc trên bên phải
                        });
                    }
                },
                error: function(xhr) {
                    toastr.error(xhr.responseJSON?.message || "{{__('language.unknown_error')}}", "{{__('language.message_fail')}}", {
                        closeButton: true,
                        progressBar: true,
                        timeOut: 3000,  // Thời gian hiển thị thông báo (3 giây)
                        positionClass: 'toast-top-right',  // Vị trí thông báo ở góc trên bên phải
                    });
                }
            });
        });
        

        function deleteCategory(categoryId) {
            Swal.fire({
                title: "{{__('language.title_confirm_delete')}}",
                text: "{{__('language.confirm_delete_item')}}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "{{__('language.confirm_yes')}}",
                cancelButtonText: "{{__('language.btn_cancel')}}",
            }).then((result) => {
                if (result.isConfirmed) {
                    // Gọi hàm xóa nếu người dùng xác nhận
                    $.ajax({
                        url: `{{ route('category.delete', ':id') }}`.replace(':id', categoryId),
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}" // Laravel CSRF token để bảo mật
                        },
                        success: function(response) {
                            if (response.status == '200') {
                                table.ajax.reload(function() {
                                    toastr.success(response.message, "{{__('language.message_success')}}", {
                                        closeButton: true,
                                        progressBar: true,
                                        timeOut: 3000,  // Thời gian hiển thị thông báo (3 giây)
                                        positionClass: 'toast-top-right',  // Vị trí thông báo ở góc trên bên phải
                                    });
                                });  // Làm mới bảng dữ liệu
                            } else {
                                toastr.error(response.message, "{{__('language.message_fail')}}", {
                                    closeButton: true,
                                    progressBar: true,
                                    timeOut: 3000,  // Thời gian hiển thị thông báo (3 giây)
                                    positionClass: 'toast-top-right',  // Vị trí thông báo ở góc trên bên phải
                                });
                            }
                            
                        },
                        error: function(xhr) {
                            toastr.error(xhr.responseJSON?.message || "{{__('language.unknown_error')}}", "{{__('language.message_fail')}}", {
                                closeButton: true,
                                progressBar: true,
                                timeOut: 3000,  // Thời gian hiển thị thông báo (3 giây)
                                positionClass: 'toast-top-right',  // Vị trí thông báo ở góc trên bên phải
                            });
                            alert();
                        }
                    });
                }
            });
        }

        $('#categoryTable').on('click', '.delete-btn', function() {
            var categoryId = $(this).data('id'); // Lấy id từ data-id của button
            deleteCategory(categoryId);  // Gọi hàm deleteCategory với ID
        });


        // Xóa nhiều danh mục
        $('#deleteSelected').on('click', function() {
            let selectedIds = [];
            $('.rowCheckbox:checked').each(function() {
                selectedIds.push($(this).val());
            });
        
            if (selectedIds.length === 0) {
                toastr.warning("{{__('language.error_no_item_selected')}}", "{{__('language.message_warning')}}", {
                    closeButton: true,
                    progressBar: true,
                    timeOut: 3000,  // Thời gian hiển thị thông báo (3 giây)
                    positionClass: 'toast-top-right',  // Vị trí thông báo ở góc trên bên phải
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
                    // Gọi hàm xóa nếu người dùng xác nhận
                    $.ajax({
                        url: `{{ route('category.deleteItems') }}`,
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
                                        timeOut: 3000,  // Thời gian hiển thị thông báo (3 giây)
                                        positionClass: 'toast-top-right',  // Vị trí thông báo ở góc trên bên phải
                                    });
                                });
                            } else {
                                table.ajax.reload(function() {
                                    toastr.error(response.message, "{{__('language.message_fail')}}", {
                                        closeButton: true,
                                        progressBar: true,
                                        timeOut: 3000,  // Thời gian hiển thị thông báo (3 giây)
                                        positionClass: 'toast-top-right',  // Vị trí thông báo ở góc trên bên phải
                                    });
                                });
                            }
                            
                        },
                        error: function(xhr) {
                            toastr.error(xhr.responseJSON?.message || "{{__('language.unknown_error')}}", "{{__('language.message_fail')}}", {
                                closeButton: true,
                                progressBar: true,
                                timeOut: 3000,  // Thời gian hiển thị thông báo (3 giây)
                                positionClass: 'toast-top-right',  // Vị trí thông báo ở góc trên bên phải
                            });
                        }
                    });
                }
            });
        });
    });


    //Cập nhật category
    function openEditModal(categoryId) {
            // Gửi request AJAX để lấy thông tin category
        $.ajax({
            url: `{{ route('category.get', ':id') }}`.replace(':id', categoryId),
            type: "GET",
            success: function(response) {
                if (response.status === '200') {
                    $("#editCategoryId").val(response.category.id);
                    $("#editCategoryName").val(response.category.name);
                    $("#editCategoryModal").removeClass("hidden");
                } else {
                    toastr.error("{{ __('language.error_fetching_data') }}", "{{__('language.message_fail')}}", {
                        closeButton: true,
                        progressBar: true,
                        timeOut: 3000,  // Thời gian hiển thị thông báo (3 giây)
                        positionClass: 'toast-top-right',  // Vị trí thông báo ở góc trên bên phải
                    });
                }
            },
            error: function() {
                toastr.error("{{ __('language.error_fetching_data') }}", "{{__('language.message_fail')}}", {
                    closeButton: true,
                    progressBar: true,
                    timeOut: 3000,  // Thời gian hiển thị thông báo (3 giây)
                    positionClass: 'toast-top-right',  // Vị trí thông báo ở góc trên bên phải
                });
            }
        });
    }
    // Đóng modal
    function closeEditModal() {
        $("#editCategoryModal").addClass("hidden");
    }
    
</script>

@endsection