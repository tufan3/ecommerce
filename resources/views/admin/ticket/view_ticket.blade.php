@extends('layouts.admin')

@section('admin_content')
    {{-- dropify ccs link --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">

    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Toggle CSS -->
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    </head>

    <style>
        .custom-control-label {
            font-weight: bold;
            transition: color 0.3s;
        }

        .custom-control-input:checked~.custom-control-label::before {
            background-color: #28a745;
        }

        .custom-control-input:not(:checked)~.custom-control-label::before {
            background-color: #dc3545;
        }

        .bootstrap-tagsinput .tag {
            background: #428bca;
            border: 1px solid white;
            padding: 2 6px;
            padding-left: 2px;
            margin-right: 2px;
            color: #fff;
            border-radius: 4px;

        }

        .bootstrap-toggle .toggle-on {
            color: white;
            background-color: green;
        }

        .bootstrap-toggle .toggle-off {
            color: white;
            background-color: red;
        }
    </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>New Product</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Ticket Reply</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Ticket details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <strong>User Name: </strong>{{ $ticket->name }}<br>
                                <strong>Subject: </strong>{{ $ticket->subject }}<br>
                                <strong>Service: </strong>{{ $ticket->service }}<br>
                                <strong>Priority: </strong>{{ $ticket->priority }}<br>
                                <strong>Message: </strong>{{ $ticket->message }}<br>
                            </div>
                            <div class="col-3">
                                <a href="{{ asset($ticket->image) }}" target="_blank"><img src="{{ asset($ticket->image) }}"
                                        height="120px" width="120px" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card mb-5">
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6 col-sm-12">
                            <form action="{{ route('admin.store.reply') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card">
                                    <div class="card-header bg-primary text-white">
                                        <h3 class="card-title">Reply Ticket Message</h3>
                                    </div>
                                    <div class="card-body">
                                        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                        <div class="form-group">
                                            <label>Message <span class="text-danger"></span></label>
                                            <textarea name="message" class="form-control" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="file" name="image" class="form-control-file">
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href="{{ route('admin.close.ticket', $ticket->id) }}" type="submit" class="btn btn-danger" style="float: right;">Close Ticket</a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        @php
                            // $replies = DB::table('replies')->join->where('ticket_id', $ticket->id)->orderBy('id', 'ASC')->get();
                            $replies = DB::table('replies')->leftJoin('users', 'replies.user_id','users.id')->select('replies.*','users.name')->where('ticket_id', $ticket->id)->orderBy('id', 'ASC')->get();
                        @endphp

                        <!-- Right Column -->
                        <div class="col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h3 class="card-title">All Replies</h3>
                                </div>
                                <div class="card-body" style="height: 400px; overflow-y: scroll;">
                                    @isset($replies)
                                        @foreach ($replies as $row)
                                            <div class="card mt-1 @if($row->user_id == 0) ml-5 @else mr-5  @endif">
                                                <div class="card-header @if($row->user_id == 0) bg-info @else bg-danger @endif">
                                                    <span style="@if($row->user_id == 0) float: right @else  @endif"><i class="fa fa-user"></i>@if($row->user_id == 0) {{ Auth::user()->name }} @else {{ $row->name }} @endif</span>
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
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection


{{-- dropify --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Bootstrap Toggle JS -->
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>


<script>
    $(document).ready(function() {
        $('#toggle-switch').change(function() {
            $(this).val(this.checked ? 1 : 0);
        });
    });
</script>

<script>
    $('.dropify').dropify({
        messages: {
            'default': 'Click Here',
            'replace': 'Drag and drop or click to replace',
            'remove': 'Remove',
            'error': 'Ooops, something wrong happended.'
        }
    });
</script>


<script>
    $(document).ready(function() {
        // Add image field
        $(document).on('click', '.add-image-btn', function() {
            $('#image-container').append(`
            <div class="input-group mb-2">
                <input type="file" name="product_image[]" class="form-control">
                <button type="button" class="btn btn-danger remove-image-btn">X</button>
            </div>
        `);
        });

        // Remove image field
        $(document).on('click', '.remove-image-btn', function() {
            $(this).closest('.input-group').remove();
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('#subcategory_id').change(function() {
            var subcategory_id = $(this).val();
            // alert(subcategory_id)
            if (subcategory_id) {
                $.ajax({
                    url: '{{ route('getChildCategories', ':subcategory_id') }}'.replace(
                        ':subcategory_id', subcategory_id),
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#childcategory_id').empty();
                        $('#childcategory_id').append(
                            '<option value="">----SELECT----</option>');
                        $.each(data, function(key, value) {
                            $('#childcategory_id').append('<option value="' + value
                                .id + '">' + value.childcategory_name +
                                '</option>');
                        });
                    }
                });
            } else {
                $('#childcategory_id').empty();
            }
        });
    });
</script>
