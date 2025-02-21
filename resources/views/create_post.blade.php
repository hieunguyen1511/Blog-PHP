@extends('layouts.userLayout')
@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Blog posts -->
        <div class="lg:col-span-7">
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="p-6">
                    <h1 class="text-3xl font-bold mb-8">Create Post</h1>
                </div>
                <div class="p-6">
                    <form action="{{route('create_post_submit')}}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <input type="text" id="title" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Type your title" required />
                        </div>
                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                            <textarea id="editor" name="content" class="w-full h-full"></textarea>
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.tiny.cloud/1/{{ config('services.tinymce.key') }}/tinymce/7/tinymce.min.js" referrerpolicy="origin">
</script>
<script>
    tinymce.init({
        path_absolute: "/",
        relative_urls: false,
        height: 800,
        selector: 'textarea#editor', // Replace this CSS selector to match the placeholder element for TinyMCE
        license_key: 'gpl',
        plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking save table directionality emoticons template paste textpattern',

        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media',
      
        
        file_picker_callback: function(callback, value, meta) {
            let x = window.innerWidth || document.documentElement.clientWidth || document
                .getElementsByTagName('body')[0].clientWidth;
            let y = window.innerHeight || document.documentElement.clientHeight || document
                .getElementsByTagName('body')[0].clientHeight;

            let type = 'image' === meta.filetype ? 'Images' : 'Files',
                cmsurl = '/laravel-filemanager?editor=tinymce5&type=' + type;

            tinymce.activeEditor.windowManager.openUrl({
                url: cmsurl,
                title: 'Filemanager',
                width: x * 0.8,
                height: y * 0.8,
                onMessage: (api, message) => {
                    callback(message.content);
                }
            });
        }



    });
    
</script>
@endsection