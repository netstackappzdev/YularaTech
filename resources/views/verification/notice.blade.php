@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <p class="m-0"><i class="bi bi-check-lg large-50"></i></p>
                        <h3 class="m-0">Thank You</h3>
                        <p>Lorem ipsum dolor sit amet!</p>
                        
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                A fresh verification link has been sent to your email address.
                            </div>
                        @endif

                        <p>Before proceeding, please check your email for a verification link. If you did not receive the email,</p>
                        <form action="{{ route('verification.resend') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-light">
                                Resend
                            </button>
                        </form>
                        </br>
                        </br>
                        </br>
                        </br>

                        <p>Lorem ipsum dolor sit amet!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection