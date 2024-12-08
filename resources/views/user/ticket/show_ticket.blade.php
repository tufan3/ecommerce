@extends('layouts.app')

@section('content')

@include('layouts.front_partial.collaps_nav')
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/product_styles.css">
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

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-3">
                @include('user.sidebar')
            </div>
            <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            {{ __('Your Ticket Details') }}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    <strong>Subject: </strong>{{ $ticket->subject }}<br>
                                    <strong>Service: </strong>{{ $ticket->service }}<br>
                                    <strong>Priority: </strong>{{ $ticket->priority }}<br>
                                    <strong>Message: </strong>{{ $ticket->message }}<br>
                                </div>
                                <div class="col-3">
                                    <a href="{{ asset($ticket->image) }}" target="_blank"><img src="{{ asset($ticket->image) }}" height="120px" width="120px" alt=""></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    @php
                        $replies = DB::table('replies')->where('ticket_id', $ticket->id)->orderBy('id', 'ASC')->get();
                    @endphp

                <div class="card mt-2">
                    <div class="card-header">
                        {{ __('All Reply Message') }}
                    </div>
                    <div class="card-body" style="height: 350px; overflow-y: scroll;">
                        @isset($replies)
                            @foreach ($replies as $row)
                                <div class="card mt-1 @if($row->user_id == 0) ml-5 @else mr-5  @endif">
                                    <div class="card-header @if($row->user_id == 0) bg-info @else bg-danger @endif">
                                        <span style="@if($row->user_id == 0) float: right @else  @endif"><i class="fa fa-user"></i>@if($row->user_id == 0) Admin @else {{ Auth::user()->name }} @endif</span>
                                    </div>
                                    <div class="card-body">
                                        <blockquote class="blockquote mb-0">
                                            <p>{{ $row->message }}</p>
                                            <footer class="blockquote-footer">
                                                {{ date('d, F Y', strtotime($row->date)) }}
                                            </footer>
                                        </blockquote>
                                    </div>
                                </div>
                            @endforeach
                        @endisset

                    </div>
                </div>
                @if ($ticket->status != 2)
                <div class="card mt-2">
                    <div class="card-header">
                        {{ __('Reply Message') }}

                    </div>
                    <form action="{{ route('reply.ticket') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="card-body">
                        <div class="modal-body">
                            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                            <div class="form-group">
                                <label for="message" class="form-label">Message</label>
                                <textarea name="message" id="message" class="form-control" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" name="image">
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
