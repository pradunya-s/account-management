@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="welcomeMessage" class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="fw-bold">🎉 Welcome, {{ Auth::user()->name }}! 🎉</h3>
                </div>
                <div class="card-body text-center">
                    <p class="lead">You have successfully logged in.</p>
                    <p class="text-muted">Enjoy your experience with our application.</p>
                    <p>Welcome! Use the navigation bar above to explore the application.</p>

                    <div class="mt-4">
                        <button class="btn btn-secondary" onclick="document.getElementById('welcomeMessage').style.display='none';">
                            <i class="bi bi-x-circle"></i> Close
                        </button>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
