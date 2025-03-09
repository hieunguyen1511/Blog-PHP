<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Pagination Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the paginator library to build
    | the simple pagination links. You are free to change them to anything
    | you want to customize your views to better match your application.
    |
    */

    // page Register
    'title_register' => 'Đăng ký tài khoản Blog',
    'placeholder_fullname' => 'Họ và tên',
    'placeholder_username' => 'Tên người dùng',
    'placeholder_email' => 'Email',
    'placeholder_password' => 'Mật khẩu',
    'placeholder_repassword' => 'Xác nhận mật khẩu',
    'btn_register' => 'Đăng ký',
    'error_wrong_format_password' => 'Mật khẩu phải có ít nhất 8 ký tự',
    'error_not_match_repassword' => 'Mật khẩu không khớp',
    'title_register_with' => 'Hoặc đăng ký với',

    'have_account' => 'Đã có tài khoản?',
    'login' => 'Đăng nhập',

    'error_user_email' => 'Tên người dùng hoặc email đã tồn tại',
    'success_register' => 'Đăng ký tài khoản thành công',

    //page Login
    'title_login' => 'Đăng nhập tài khoản Blog',
    'placeholder_username_email' => 'Tên người dùng hoặc email',
    'placeholder_password' => 'Mật khẩu',
    'btn_login' => 'Đăng nhập',
    'title_login_with' => 'Hoặc đăng nhập với',
    'forgot_password' => 'Quên mật khẩu?',
    'create_account' => 'Tạo tài khoản',


    // Content home
    'home_pagination_show' => 'Hiển thị',
    'home_pagination_to' => 'đến',
    'home_pagination_of' => 'của',
    'home_pagination_result' => 'kết quả',
    'home_popular_categories' => 'Danh mục phổ biến',
    'home_suggested_post' => 'Bài viết gợi ý',
    'home_recommend_user' => 'Người dùng được đề xuất',
    'home_following' => 'Đang theo dõi',

    // User Profile
    'profile_posts' => 'Bài viết',
    'profile_views' => 'Lượt xem',
    'profile_likes' => 'Lượt thích',
    'profile_allPosts' => 'Tất cả bài viết',

    // Detail Post
    'detail_post_about_author' => 'Về tác giả',
    'detail_post_view_profile' => 'Xem hồ sơ',
    'detail_post_posts' => 'Bài viết',
    'detail_post_like' => 'Lượt thích',
    'detail_post_comment' => 'Bình luận',
    'detail_post_view' => 'Lượt xem',
    'detail_post_related_post' => 'Bài viết liên quan',
    'detail_post_load_more' => 'Tải thêm bình luận',
    'detail_post_submit_comment' => 'Gửi bình luận',
    'detail_post_comment_placeholder' => 'Viết bình luận...',
    'detail_post_alert_like' => 'Vui lòng đăng nhập để thích bài viết này',
    'detail_post_alert_comment' => 'Vui lòng đăng nhập để bình luận bài viết này',

    // setting
    'setting_user_management_label' => 'Quản lý người dùng',
    'setting_settings' => 'Cài đặt',
    'setting_edit_profile' => 'Chỉnh sửa hồ sơ',
    'setting_change_password' => 'Đổi mật khẩu',
    'setting_post_management_label' => 'Quản lý bài viết',
    'setting_my_post' => 'Bài viết của tôi',
    'setting_create_post' => 'Tạo bài viết',
    'setting_favorite_post' => 'Bài viết yêu thích',
    'setting_media_resource_label' => 'Tài nguyên đa phương tiện',

    // setting edit profile
    'setting_edit_profile_change_photo' => 'Thay đổi ảnh',
    'setting_edit_profile_change_cover' => 'Thay đổi ảnh bìa',
    'setting_edit_profile_fullname' => 'Họ và tên',
    'setting_edit_profile_bio' => 'Tiểu sử',
    'setting_edit_profile_phone' => 'Số điện thoại',
    'setting_edit_profile_date' => 'Ngày sinh',
    'setting_edit_profile_save' => 'Lưu thay đổi',
    'setting_edit_profile_success_noti' => 'Cập nhật hồ sơ thành công',

    // setting change password
    'setting_change_password_current' => 'Mật khẩu hiện tại',
    'setting_change_password_new' => 'Mật khẩu mới',
    'setting_change_password_confirm' => 'Xác nhận mật khẩu',
    'setting_change_password_save' => 'Lưu thay đổi',
    'setting_change_password_alert_current_password' => 'Mật khẩu hiện tại không đúng',
    'setting_change_password_alert_new_password' => 'Mật khẩu mới phải có ít nhất 8 ký tự',
    'setting_change_password_alert_confirm_password' => 'Mật khẩu không khớp',
    'setting_change_password_success_noti' => 'Đổi mật khẩu thành công, vui lòng đăng nhập lại',

    // setting media resource
    'setting_media_resource' => 'Tài nguyên đa phương tiện',

    // setting post notification
    'setting_post_notification' => 'Thông báo bài viết',
    'setting_post_notification_load' => 'Tải thêm thông báo',

    // setting my post
    'setting_my_post_empty' => 'Chưa có bài viết nào',
    'setting_my_post_create' => 'Tạo bài viết',
    'setting_my_post_filter' => 'Lọc',
    'setting_my_post_filter_apply' => 'Áp dụng bộ lọc',
    'setting_my_post_filter_all' => 'Tất cả',
    'setting_my_post_sort_by' => 'Sắp xếp theo',
    'setting_my_post_title' => 'Tiêu đề',
    'setting_my_post_category' => 'Danh mục',
    'setting_my_post_date' => 'Ngày',
    'setting_my_post_update' => 'Cập nhật',
    'setting_my_post_action' => 'Hành động',
    'setting_my_post_views' => 'Lượt xem',
    'setting_my_post_like' => 'Lượt thích',
    'setting_my_post_total_posts' => 'Tổng số bài viết',
    'setting_my_post_total_views' => 'Tổng số lượt xem',
    'setting_my_post_total_likes' => 'Tổng số lượt thích',
    'setting_my_post_alert_delete' => 'Bạn có chắc chắn muốn xóa bài viết này không?',
    'setting_my_post_alert_delete_title' => 'Xóa bài viết',
    'setting_my_post_alert_delete_confirm' => 'Xác nhận',
    'setting_my_post_alert_delete_cancel' => 'Hủy',
    'setting_my_post_alert_delete_success' => 'Xóa bài viết thành công',
    'setting_my_post_filter_all' => 'Chọn tất cả',

    // setting edit post
    'setting_edit_post_save_changes' => 'Lưu thay đổi',
    'setting_edit_post_alert_success' => 'Cập nhật bài viết thành công',
    
    // create post
    'create_post_title' => 'Tiêu đề',
    'create_post_title_placeholder' => 'Nhập tiêu đề của bạn...',
    'create_post_category' => 'Danh mục',
    'create_post_description' => 'Mô tả',
    'create_post_description_placeholder' => 'Nhập mô tả...',
    'create_post_content' => 'Nội dung',
    'create_post_button' => 'Tạo bài viết',

    // Detail Post 
    'detail_post_about_author' => 'About Author',
    'detail_post_view_profile' => 'View Profile',
    'detail_post_posts' => 'Posts',
    'detail_post_like' => 'lượt thích',
    'detail_post_comment' => 'bình luận',
    'detail_post_view' => 'lượt xem',
    'detail_post_related_post' => 'Related Post',
    'detail_post_load_more' => 'Load more comments',
    'detail_post_submit_comment' => 'Submit Comment',
    'detail_post_comment_placeholder' => 'Write a comment...',
    'detail_post_alert_like' => 'Please login to like this post',
    'detail_post_alert_comment' => 'Please login to comment this post',

    // page Category index
    'title_category_index' => 'Danh sách danh mục',
    'btn_add_category' => 'Thêm danh mục',
    'title_add_category' => 'Thêm mới danh mục',
    'title_edit_category' => 'Cập nhật danh mục',
    'title_name_category' => 'Tên danh mục',
    'placeholder_name_category' => 'Điền tên danh mục',
    'error_category_name' => 'Vui lòng điền tên danh mục',


    // page Post index
    'title_post_index' => 'Danh sách bài đăng',
    'title_post' => 'Tiêu đề',
    'title_description_post' => 'Mô tả',
    'title_content_post' => 'Nội dung',
    'title_edit_post' => 'Cập nhật bài đăng',
    
    //page user index
    'title_user_index' => 'Danh sách người dùng',
    'title_username_user' => 'Tên đăng nhập',
    'title_new_password_user' => 'Mật khẩu mới',
    'title_email_user' => 'Email',
    'title_date_user' => 'Ngày sinh',
    'title_phone_user' => 'SĐT',
    'title_bio_user' => 'Tiểu sử',
    'title_profile_picture_user' => 'Ảnh đại diện',
    'title_cover_photo_user' => 'Ảnh nền',
    'title_full_name_user' => 'Họ tên',
    'placeholder_username_user' => 'Điền tên đăng nhập người dùng',
    'placeholder_new_password_user' => 'Điền mật khẩu mới cho người dùng',
    'placeholder_date_user' => 'Điền ngày sinh người dùng',
    'placeholder_phone_user' => 'Điền SĐT người dùng',
    'placeholder_bio_user' => 'Điền tiểu sử người dùng',
    'placeholder_fullname_user' => 'Điền họ tên người dùng',
    'title_edit_user' => 'Chỉnh sửa thông tin người dùng',

    //page setting admin
    'email_alert' => 'Email không đúng định dạng',
    'fail_save_setting' => 'Lưu cài đặt thất bại',
    'success_save_setting' => 'Lưu cài đặt thành công',
    'title_password' => 'Mật khẩu',
    'title_authentication_user_setting' => 'Email để xác thực người dùng',
    'btn_update' => 'Cập nhật',
    'placeholder_new_password' => 'Điền mật khẩu mới',

    //page dashboard
    'published_a_new_post' => 'Đã đăng một bài viết mới',
    'commented_on' => 'Đã bình luận trong bài viết',
    'updated_their_profile_information' => 'Đã cập nhật trang cá nhân của họ',
    'total_users' => 'Số lượng người dùng',
    'from_last_month' => 'so với tháng trước',
    'total_posts' => 'Số lượng bài đăng',
    'total_views' => 'Tổng lượt xem',
    'total_comments' => 'Số lượng bình luận',
    'published_posts_statistics' => 'Thống kê các bài viết',
    'week' => 'Tuần',
    'month' => 'Tháng',
    'Mon' => 'T2',
    'Tue' => 'T3',
    'Wed' => 'T4',
    'Thu' => 'T5',
    'Fri' => 'T6',
    'Sat' => 'T7',
    'Sun' => 'CN',
    'published_posts' => 'Các bài đăng',
    'count_published_posts' => 'Số bài đăng',
    'latest_posts' => 'Bài đăng mới nhất',

    'title_create_at' => 'Ngày tạo',

    'error_change_language' => 'Lỗi khi thay đổi ngôn ngữ',

    'title_user' => 'User',
    'change_picture' => 'Thay đổi ảnh',
    'created_item_success' => 'Thêm mới item thành công',
    'create_item_fail' => 'Thêm mới item thất bại! Vui lòng thử lại.',
    'error_no_item_selected' => 'Chưa check vào item nào cả',
    'updated_item_success' => 'Cập nhật item thành công',
    'update_item_fail' => 'Cập nhật item thất bại! Vui lòng thử lại.',
    'deleted_item_success' => 'Đã xóa item thành công',
    'delete_item_fail' => 'Xóa item thất bại! Vui lòng thử lại.',
    'deleted_items_success' => 'Các items đã được xóa thành công',
    'delete_items_fail' => 'Xóa các items thất bại! Vui lòng thử lại.',
    'title_confirm_delete' => 'Xác nhận xóa',
    'confirm_delete_item' => 'Bạn có chắc muốn xóa item này không?',
    'confirm_delete_items' => 'Bạn có chắc muốn xóa các items này không?',
    'confirm_yes' => 'Có',
    'confirm_no' => 'Không',
    'btn_delete_items' => 'Xóa các items',
    'title_action' => 'Hành dộng',
    'btn_edit' => 'Sửa',
    'btn_delete' => 'Xóa',
    'btn_create' => 'Thêm',
    'btn_cancel' => 'Hủy',
    'btn_detail' => 'Chi tiết',
    'unknown_error' => 'Có lỗi xảy ra! Vui lòng thử lại.',
    'message_success' => 'Thành công!',
    'message_fail' => 'Thất bại!',
    'message_warning' => 'Cảnh báo!',
    'message_info' => 'Thông báo!',
    'error_fetching_data' => 'Lỗi fetch dữ liệu.',
    'error_unknow' => 'Không rõ',
    
    //Profile
    'title_profile' => 'Hồ sơ cá nhân',
    'title_re_new_password' => 'Mật khẩu nhập lại',
    'success_save_profile' => 'Lưu hồ sơ thành công',
    'fail_save_profile' => 'Lưu hồ sơ thất bại',
    'title_old_password' => 'Mật khẩu cũ',
    'error_wrong_password' => 'Sai mật khẩu',

    //Sidebar
    'sidebar_dashboard' => 'Bảng điều khiển',
    'sidebar_posts' => 'Bài post',
    'sidebar_categories' => 'Danh mục',
    'sidebar_users' => 'Người dùng',
    'sidebar_notifications' => 'Thông báo',
    'sidebar_notification_types' => 'Loại thông báo',
    'sidebar_settings' => 'Cài đặt',

    'admin_panel' => 'Bảng quản trị',
    'title_admin_page' => 'Hệ thống quản lý Blog',
    'view_more' => 'Xem thêm',
];
