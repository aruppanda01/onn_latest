@extends('admin.layouts.master')

@section('content')
    <div class="dashboard-body" id="content">
        <div class="dashboard-content">
            <div class="row m-0 dashboard-content-header">
                <div class="col-lg-6 d-flex">
                    <a id="sidebarCollapse" href="javascript:void(0);">
                        <i class="fas fa-bars"></i>
                    </a>
                    <ul class="breadcrumb p-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="text-white"><i class="fa fa-chevron-right"></i></li>
                        <li><a href="#" class="active">All Event List</a></li>

                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="dashboard-body-content">
                {{-- <div class="d-flex justify-content-between align-items-center">
                    <h5>Event List</h5>
                    <a href="{{ route('admin.events.create') }}" class="actionbutton btn btn-sm">ADD EVENT</a>
                </div>
                <hr> --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="table-responsive edit-table">
                    <table class="table table-sm table-hover" id="teacher_table">
                        <thead>
                            <tr class="text-center">
                                <th>Serial No</th>
                                <th>Class</th>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Time</th>
                                {{-- <th>Fees</th> --}}
                                <th style="width:100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $key => $event)
                                <tr class="text-center">
                                    <td>{{ $key + 1 }}</td>
                                    <td>@php
                                        $class = App\Models\Classes::where('id',$event->class_id)->first();
                                        echo $class->name;
                                     @endphp</td>
                                    <td>{{ \Illuminate\Support\Str::limit($event->title, 15) }}</td>
                                    <td>{{ $event->start_date }} <span class="text-success">
                                        @if ($event->end_date)
                                            to </span> {{ $event->end_date }}</td>
                                        @endif
                                    <td>{{ date('h:i A', strtotime($event->start_time)) }} <span class="text-success"> to </span> {{ date('h:i A', strtotime($event->end_time)) }}</td>
                                    {{-- <td>{{ $event->fees }}</td> --}}
                                    <td>
                                        <a href="{{ route('admin.events.show', $event->id) }}"><i
                                                class="far fa-eye"></i></a>
                                        {{-- <a href="{{ route('admin.events.edit', $event->id) }}" class="ml-2"><i
                                                class="far fa-edit"></i></a> --}}
                                        <a href="javascript:void(0);" class="ml-2" data-toggle="modal"
                                            data-target="#exampleModal" onclick="deleteForm({{ $event->id }})"><i
                                                class="far fa-trash-alt text-danger"></i></a>
                                        <form id="delete_form_{{ $event->id }}"
                                            action="{{ route('admin.events.destroy', $event->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#teacher_table').DataTable();
        });

        function deleteForm(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    event.preventDefault();
                    document.getElementById('delete_form_' + id).submit();
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your data  is safe :)',
                        'error'
                    )
                }
            })
        }

        setTimeout(function() {
            $(".alert-success").hide();
        }, 5000);
    </script>
@endsection
