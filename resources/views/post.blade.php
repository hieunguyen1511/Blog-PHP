@extends('layouts.userLayout')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Blog posts -->
        <div class="lg:col-span-7">
            <div class="bg-white shadow rounded-lg overflow-hidden">
                @if($post != null)
                <h1 class="text-3xl font-bold mb-8">{{$post->title}}</h1>

                <div class="p-6">
                    <?php echo htmlspecialchars_decode(stripslashes($post->content));  ?>
                    
                </div>
                @endif
                
            </div>
        </div>
    </div>
</div>
@endsection