@extends('layouts.app')

@section('content')

<style>
    .profile-card {
        text-align: center;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
    }
    .sidebar {
        font-size: 18px;
    }
    .card-counter {
        text-align: center;
        padding: 10px;
        margin: 10px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #f8f9fa;
    }
</style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                @include('user.sidebar')
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}
                        <a href="{{ route('write.review') }}" class="" style="float: right;"><i class="fas fa-pencil-alt"></i> Write a review</a>
                    </div>
                    <div class="card-body">
                        <h4>Write your valuable review based on our product and services</h4>
                        <div>
                            <form action="" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="product_id">Customer Name</label>
                                    <input type="text" class="form-control text-dark" value="{{ Auth::user()->name }}" readonly>
                                </div>
                                </div>
                                <div class="form-group">
                                    <label for="review">Write Review</label>
                                    <textarea name="review" id="review" class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="rating">Rating</label>
                                    <select name="rating" id="rating" class="form-control" style="min-width: 100%; margin-left: 0px;color: black;" required>
                                        <option value="1">1 Star</option>
                                        <option value="2">2 Star</option>
                                        <option value="3">3 Star</option>
                                        <option value="4">4 Star</option>
                                        <option value="5" selected>5 Star</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
