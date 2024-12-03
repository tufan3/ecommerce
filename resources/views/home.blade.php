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
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card-counter">
                                    <h6>My Total Order</h6>
                                    <p>15</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card-counter">
                                    <h6>My Total Order</h6>
                                    <p>15</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card-counter">
                                    <h6>My Total Order</h6>
                                    <p>15</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card-counter">
                                    <h6>My Total Order</h6>
                                    <p>15</p>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <h5>Recent Order</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>First</th>
                                        <th>Last</th>
                                        <th>Handle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Larry</td>
                                        <td>the Bird</td>
                                        <td>@twitter</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
