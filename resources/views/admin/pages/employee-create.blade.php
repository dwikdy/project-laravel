@extends('admin.home')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
</head>
<body>
        <div class="col-lg-6 container">
            <div class="card shadow">
                <div class="card-header ml-0 mr-0 row">
                    <h4 class="m-0 mt-1 font-weight-bold text-primary">Add Employee</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('employee.store') }}">
                        @csrf
                        <div class="form-group">
                            <label>Name Employee</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name) }}" required>
                                <br>
                                <label>Employee Company</label>
                                <select name="companyId" class="form-control" id="">
                                    @foreach($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                </select>
                                <br>
                                <label>Email Employee</label>
                                <input type="Email" name="email" class="form-control" required>
                                <br>
                            <button type="submit" class="btn btn-primary">Submit</button>&nbsp; &nbsp;
                            <a href="{{ route('employee.index') }}" class="btn btn-danger">cancel</a>
                        </div>
                    </form>
    <!-- <form class="user">
    <input type="email" name="email" class="form-control form-control-user">
    </form> -->
                </div>
            </div>
        </div>
    </body>
</html>
@endsection