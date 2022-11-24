@extends('admin.home')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
</head>
<body>
        <div class="col-lg-6 container">
            <div class="card shadow">
                <div class="card-header ml-0 mr-0 row">
                    <h4 class="m-0 mt-1 font-weight-bold text-primary">Add User</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('user.store') }}">
                        @csrf
                        <div class="form-group">
                            <label>Username User</label>
                                <input type="text" name="username" class="form-control" required>
                                <br>
                                <label>email User</label>
                                <input type="email" name="email" class="form-control" required>
                                <br>
                                <label>Password User</label>
                                <input type="password" name="password" class="form-control"  accept="image/*">
                                <br>
                                <label>Level User</label>
                                <select class="form-control" name="level" id="">
                                <option value="admin">admin</option>
                                <option value="User">User</option>
                                </select>
                               
                                <br>
                                <br>
                            <button type="submit" class="btn btn-primary">Submit</button>&nbsp; &nbsp;
                            <a href="{{ route('user.index') }}" class="btn btn-danger">cancel</a>
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