@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumbs')
            @slot('title') List of users @endslot
            @slot('parent') Home @endslot
            @slot('active') Users control @endslot
        @endcomponent

        <hr>

        <div class="form-group">
            <a href="{{route('admin.user_management.user.create')}}" class="btn btn-primary pull-right"><i
                        class="fa fa-plus-square-o"></i> Add new user</a>
        </div>
        <form action='{{route('admin.user_management.user.index')}}' method='get'>
            <div class="input-group mb-3">
                <input class="form-control"
                       type="text" name="search_users"
                       id="search_users"
                       placeholder="Search by users"
                       value="@if(Request()->input('search_users')){{Request()->input('search_users')}}@else{{''}}@endif">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Roles</th>
                <th class="text-right">Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->roles->pluck('name')->implode(', ') }}</td>
                    <td class="text-right">
                        <form onsubmit="if(confirm('Delete?')){return true}else{return false}"
                              action="{{route('admin.user_management.user.destroy', $user)}}" method="post">
                            {{method_field('DELETE')}}
                            {{csrf_field()}}

                            <button type="button" class="btn btn-secondary">Assign test</button>
                            <a href="{{route('admin.user_management.user.edit', $user)}}"
                               class="btn btn-success">Edit</a>

                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center"><h2>No users</h2></td>
                </tr>
            @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">
                        <nav>
                            <ul class="pagination justify-content-end">
                                {{$users->links()}}
                            </ul>
                        </nav>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

@endsection
