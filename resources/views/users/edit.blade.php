@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="container mt-4">
    <h4>Edit User</h4>

    <form action="{{ route('admin.users.update', $user->id) }}" method="post">
        @csrf
        @method('PUT')

        @include('users._form')
    </form>
</div>
@endsection