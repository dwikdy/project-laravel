@extends('admin.home')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Company</title>
</head>
<body>
        <div class="col-lg-6 container">
            <div class="card shadow">
                <div class="card-header ml-0 mr-0 row">
                    <h4 class="m-0 mt-1 font-weight-bold text-primary">Edit Company</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('companies.update', $company->id) }}" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <label>name company</label>
                                <input type="text" name="name" value="{{ $company->name }}" class="form-control" required>
                                <br>
                                <label>email company</label>
                                <input type="email" name="email" value="{{ $company->email }}" class="form-control" required>
                                <br>
                                <label>Logo Company</label>
                                <input type="file" name="image[]" value="{{ $company->logo }}" class="form-control"  accept="image/*">
                                    <img class="w-100" src="{{ $company->logo }}" alt="">
                                <br>
                                <label>Website Company</label>
                                <input type="text" name="website" value="{{ $company->website }}" class="form-control" required>
                                <br>
                                <br>
                            <button type="submit" class="btn btn-primary">Submit</button>&nbsp; &nbsp;
                            <a href="{{ route('companies.index') }}" class="btn btn-danger">cancel</a>
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