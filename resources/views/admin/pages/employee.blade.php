@extends('admin.home')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
</head>
<body>
    <div class="col-lg-8 container mt-5">
        <div class="card shadow">
        <div class="card-header ml-0 mr-0 row">
            <h4 class="m-0 mt-1 font-weight-bold text-primary">List Employee</h4>
            <a href="{{ route('employee.create') }}" class="btn btn-primary ml-auto"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add Employee</a>
        </div>
        <div class="card-body">
        <table class="table table-hover text-center">
            <thead class="table-borderless">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Company</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($employees as $employee)
                <tr>
                <td>{{ $loop->iteration}}</td>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->names}}</td>
                <td>{{ $employee->email }}</td>
                <td class="d-flex justify-content-center">
                    
                    <a href="{{ route('employee.edit', $employee->id )}}" class="btn btn-warning btn-circle btn-sm"><i class="far fa-edit"></i></a>&nbsp; &nbsp; | &nbsp; &nbsp;
                    <form action="{{ route('employee.destroy', $employee->id) }}" method="post">
                        @method('delete')
                        @csrf
                    <button onclick="return confirm('anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
    <!-- <form class="user">
    <input type="email" name="email" class="form-control form-control-user">
    </form> -->
    </div>
</div>
</div>
</body>
</html>
@endsection