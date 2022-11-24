@extends('admin.home')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Companies Management</title>
</head>
<body>
    <div class="col-lg-8 container mt-5">
        <div class="card shadow">
        <div class="card-header ml-0 mr-0 row">
            <h4 class="m-0 mt-1 font-weight-bold text-primary">List Companies</h4>
            <a href="{{ route('companies.create') }}" class="btn btn-primary ml-auto"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add Company Produk</a>
        </div>
        <div class="card-body">
        <table class="table table-hover text-center">
            <thead class="table-borderless">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Logo</th>
                <th scope="col">Website</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($companies as $company)
                <tr>
                <td>{{ ($companies->currentPage()  - 1) * $companies->perPage() + $loop->iteration}}</td>
                <td>{{ $company->name }}</td>
                <td>{{ $company->email }}</td>
                <td class="col-md-3">
                    <img class="w-100" src="{{ $company->logo }}" alt="">
                </td>
                <td>{{ $company->website }}</td>
                <td class="d-flex justify-content-center">
                    
                    <a href="{{ route('companies.edit', $company->id )}}" class="btn btn-warning btn-circle btn-sm"><i class="far fa-edit"></i></a>&nbsp; &nbsp; | &nbsp; &nbsp;
                    <form action="{{ route('companies.destroy', $company->id) }}" method="post">
                        @method('delete')
                        @csrf
                    <button onclick="return confirm('anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
        {{ $companies->links() }}
    <!-- <form class="user">
    <input type="email" name="email" class="form-control form-control-user">
    </form> -->
    </div>
</div>
</div>
</body>
</html>
@endsection