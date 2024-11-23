@extends("layouts.app2")
@section('title','Gestion de Moderadores')
@section('content')
<header class="py-2 bg-light border-bottom mb-4">
    <div class="container">
        <div class="text-center my-1">
            <h1>Gestión de Moderadores</h1>

        </div>
    </div>
</header>
@if (session('status'))
<div class="alert alert-info alert-dismissible fade show col-lg-4" role="alert">
    {{ session('status') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (session('error'))
    <div class="alert alert-danger col-lg-4" role="alert">{{ session('error') }}</div>
@endif
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Usuario</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Cambiar Rol</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ ucfirst($user->user_rol) }}</td>
            <td>
                <form action="{{ route('superAdmin.updateRole', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <select name="user_rol" class="form-control w-60" onchange="this.form.submit()"
                    {{ Auth::user()->id == $user->id ? 'disabled' : '' }}>
                        <option value="user" {{ $user->user_rol == 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ $user->user_rol == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="superAdmin" {{ $user->user_rol == 'superAdmin' ? 'selected' : '' }}>Super Admin</option>
                    </select>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@include('components.back-button')

@endsection
