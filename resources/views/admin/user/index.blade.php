@extends('admin.layouts.header')

@extends('admin.menu')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                User
                <small>User panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">User</li>
            </ol>
            <br>
            <a href="{{ url('administration/users/economic/import') }}" class="btn btn-success">Import from E-conomics</a>
        </section>

        <section class="content">
            <div class="row">
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">

                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">User Table</h3>
                                </div>
                                <div class="box-body">
                                    <table id="example1" class="table table-bordered table-striped users-table">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Add to Economic</th>
                                            <th>Created At</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $user)
                                            <tr data-number="{{ $user->id }}">
                                                <td><a href="{{ url('administration/users/'. $user->id ) }}">{{ $user->name }}</a></td>
                                                <td>{{ $user->email }}</td>
                                                <td style="cursor: pointer">
                                                    @if($user->customer_number)
                                                        <a style="color:darkred;font-weight: 800" href="{{ url('administration/users/economic/delete/'. $user->id ) }}">Delete from E-conomic</a>
                                                    @else
                                                        <a style="color:darkgreen;font-weight: 800" href="{{ url('administration/users/economic/'. $user->id ) }}">Add to E-conomic</a>
                                                    @endif

                                                </td>
                                                <td>{{ $user->created_at->format('d-m-Y') }}</td>
                                                <td>
                                                    <a href="{{ url("/administration/users/$user->id/edit") }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                </td>
                                                <td class="delete-user-item" data-id="{{ $user->id }}">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Add to Economic</th>
                                            <th>Created At</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </div>


@endsection

