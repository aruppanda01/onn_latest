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
                        <li><a href="#" class="active">All Invoice List</a></li>

                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="dashboard-body-content">
                <div class="d-flex justify-content-between align-items-center">
                    <h5>Invoice List</h5>
                    <a href="{{ route('admin.invoice.create') }}" class="actionbutton btn btn-sm">ADD INVOICE</a>
                </div>
                <hr>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="table-responsive edit-table">
                    <table class="table table-sm table-hover" id="product_table">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>AMount(INR)</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_invoice_list as $index => $invoice)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $invoice->lat }}</td>
                                <td>{{ $invoice->lon }}</td>
                                <td>{{ $invoice->amount }}</td>
                                <td>
                                    @if ($invoice->is_verified == 0)
                                        <span class="badge badge-primary">Not Verified</span>
                                    @else
                                        <span class="badge badge-primary">Verified</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.invoice.show', $invoice->id) }}"><i
                                            class="far fa-eye"></i></a>
                                    <a href="{{ route('admin.invoice.edit', $invoice->id) }}"
                                        class="ml-2"><i class="far fa-edit"></i></a>
                                    {{-- <a href="javascript:void(0);" class="ml-2" data-toggle="modal"
                                        data-target="#exampleModal" onclick="deleteForm({{ $category->id }})"><i
                                            class="far fa-trash-alt text-danger"></i></a>
                                    <form id="delete_form_{{ $category->id }}"
                                        action="{{ route('admin.category.destroy', $category->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form> --}}
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
            $('#product_table').DataTable();
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
