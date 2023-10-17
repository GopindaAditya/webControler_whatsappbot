@extends('layout.navbar')

@section('container')
<div class="vh-75 d-flex justify-content-center align-items-center ">
    <div class="col-md-4 p-5 shadow-sm border rounded-3">
        <h2 class="text-center mb-4 text-dark">Login Form</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control border border-primary" id="email" aria-describedby="emailHelp" name="email">
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control border border-primary" id="password" name="password" required>
            </div>            
            <div class="d-grid mt-3">
                <button class="btn btn-primary" type="submit">Login</button>
            </div>
        </form>        
    </div>
</div>
@endsection
