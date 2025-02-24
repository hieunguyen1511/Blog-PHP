@extends('layouts.adminLayout')
@section('content')

<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">Dashboard</h1>
    
    <!-- Tổng quan -->
    <div class="grid grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-lg font-medium">Tổng số bài viết</h2>
            <p class="text-2xl font-bold">{{ $totalPosts }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-lg font-medium">Tổng số bài thảo luận</h2>
            <p class="text-2xl font-bold">{{ $totalDiscussions }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-lg font-medium">Tổng số bình luận</h2>
            <p class="text-2xl font-bold">{{ $totalComments }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-lg font-medium">Tổng số người dùng</h2>
            <p class="text-2xl font-bold">{{ $totalUsers }}</p>
        </div>
    </div>

    <!-- Thống kê & Báo cáo -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">Thống kê & Báo cáo</h2>
        <canvas id="postsChart"></canvas>
    </div>
</div>