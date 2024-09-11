@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Pegawai</h2>
    <a href="{{ route('employee.create') }}" class="btn ml-4 mt-1 mb-4 min-w-auto btn-success">
        <i class="fas fa-plus"></i> Tambah Pegawai
    </a>
    <table id="employeeTable" class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#employeeTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('api.employees') }}",
                type: 'GET',
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'address', name: 'address' },
                {
                    data: null, 
                    name: 'action', 
                    orderable: false, 
                    searchable: false,
                    render: function(data, type, row) {
                        // Menambahkan tombol Edit dan Delete di kolom Action
                        return `
                            <button class="btn btn-primary btn-sm edit-btn" data-id="${row.id}">Edit</button>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="${row.id}">Delete</button>
                        `;
                    }
                }
            ],
            columnDefs: [
                { width: "20%", targets: 4 }  // Atur lebar kolom action
            ],
            responsive: true,
            lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
            pageLength: 10,
            dom: '<"top"f>rt<"bottom"lp><"clear">'
        });
    });
</script>
@endpush
