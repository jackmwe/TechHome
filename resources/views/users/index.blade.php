@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float: left">Add Users</h4>
                        <a href="#" style="float: right" class="btn btn-dark" data-toggle="modal" data-target ="#addUser">
                        <i class="fa fa-plus"></i>Add New User</a></div>
                        <div class="card-body">
                            <table class="table table-bordered table-left">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <!-- <th>Phone</th> -->
                                        <th>Role</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key=>$user)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>@if ($user->is_admin == 1) Admin
                                            @else Cashier
                                            @endif</td>
                                         <td>
                                         <div class="btn-group">
                                                <a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editUser{{ $user->id }}"><i class="fa fa-edit">Edit</i></a>
                                                <div class="btn-group">

                                                <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteUser{{ $user->id }}"><i class="fa fa-trash">Delete</i></a>
                                                <div class="btn-group">
                                            </div>
                                        </td>
                                    </tr>



<!-- Modal for Editing users -->

<div class="modal right fade" id="editUser{{ $user->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="staticBackdropLabel">Edit Users</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <div class="modal-body">
        <form action="{{ route('users.update', $user->id) }}" method="post">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" name="name" id="" value="{{$user->name}}" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" id="" value="{{$user->email}}" class="form-control">
            </div>
            <!-- <div class="form-group">
                <label for="">Phone</label>
                <input type="text" name="phone" id="" class="form-control">
            </div> -->
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="password" id="" readonly value="{{$user->password}}" class="form-control">
            </div>
            <!-- <div class="form-group">
                <label for="">Confirm Password</label>
                <input type="password" name="confirm_password" id="" class="form-control">
            </div> -->
            <div class="form-group">
                <label for="">Role</label>
                <select name="is_admin" id="" class="form-control">
                    <option value="1" @if($user->is_admin==1) 
                        selected 
                        @endif >Admin</option>
                    <option value="2" @if($user->is_admin==2) 
                        selected 
                        @endif> Cashier</option>
                </select>
            </div>
            <div class="modal-footer">
                <button class="btn btn-warning btn-block">Update User</button>
            </div>
        </form>

      </div>
    </div>
  </div>
</div>

<!-- Modal for Deleting users -->
<!-- Modal -->
<div class="modal right fade" id="deleteUser{{ $user->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="staticBackdropLabel">Delete Users</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <div class="modal-body">
        <form action="{{ route('users.destroy', $user->id) }}" method="post">
            @csrf
            @method('delete')
            <p>Are sure you want to detele {{ $user->name}}?</p>
            <div class="modal-footer">
                <button class="btn btn-default " data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger ">Delete</button>
                
            </div>
        </form>

      </div>
    </div>
  </div>
</div>


                                    @endforeach
                                    {{ $users->links() }}
                                </tbody>
                                
                            </table>

                

                        </div>

                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header"> <h4>Search User </h4> </div>
                        <div class="card-body">
                            ..........
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal fo adding new user -->

    <!-- Modal -->
<div class="modal right fade" id="addUser" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="staticBackdropLabel">Add User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('users.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" name="name" id="" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" id="" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Phone</label>
                <input type="text" name="phone" id="" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="password" id="" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Confirm Password</label>
                <input type="password" name="confirm_password" id="" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Role</label>
                <select name="is_admin" id="" class="form-control">
                    <option value="1">Admin</option>
                    <option value="2" selected>Cashier</option>
                </select>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btn-block">Save User</button>
            </div>
        </form>

      </div>
    </div>
  </div>
</div>






      <style>
       .modal.right .modal-dialog{
        top: 0;
        left: 0;
        margin-right: 19vh;
    }
    .modal.fade:not(.in).right .modal-dialog {
        -webkit-transform: translate3d(25%, 0, 0);
        transform: translate3d(25%, 0, 0);
    }
      </style>
@endsection
