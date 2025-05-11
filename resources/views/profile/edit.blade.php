@extends('layouts.app') {{-- Assuming you're extending a base layout --}}

@section('content')
<div class="max-w-6xl px-4 py-10 mx-auto space-y-10">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Profile Settings</h1>
        <p class="mt-1 text-sm text-gray-600">Manage your personal information, password, and account.</p>
    </div>

    {{-- Update Profile Info --}}
    <div class="p-6 bg-white border shadow-sm rounded-2xl">
        <h2 class="mb-4 text-lg font-semibold text-gray-800">Profile Information</h2>
        <div class="max-w-xl">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    {{-- Update Password --}}
    <div class="p-6 bg-white border shadow-sm rounded-2xl">
        <h2 class="mb-4 text-lg font-semibold text-gray-800">Update Password</h2>
        <div class="max-w-xl">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    {{-- Delete Account --}}
    <div class="p-6 bg-white border shadow-sm rounded-2xl">
        <h2 class="mb-4 text-lg font-semibold text-red-600">Delete Account</h2>
        <p class="mb-4 text-sm text-gray-500">Once your account is deleted, all its resources and data will be permanently deleted. Please be certain.</p>
        <div class="max-w-xl">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection
