@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">用户管理</div>

                <div class="panel-body">
                    <form method="get" action="{{ url('/owner/user/search') }}" role="search">
                        <div class="form-group">
                            <div class="input-group">
                                <input name="text" type="text" class="form-control" placeholder="Search User"  autocomplete="off">
                                <span class="input-group-btn">
                                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                            </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-default">未审核</button>
                        </div>

                    </form>
                </div>
            </div>
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Create-post</th>
                    <th>Admin</th>
                    <th>Delete</th>
                </tr>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td><img src="{{ asset('storage/'.$user->avatar) }}" style="width: 28px;height: 28px"></td>
                        <td><a href="{{ url('user/'.$user->id) }}" target="_blank">{{ $user->name }}</a></td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <form class="form-inline" action="{{ url('/owner/user/toggle') }}">
                                <input title="id" name="id" style="display: none" value="{{  $user->id }}">
                                    @if(!$user->hasRole('owner'))
                                        <button class="btn btn-sm btn-default" type="submit">
                                            @if($user->hasRole('member'))
                                                <span class="glyphicon glyphicon-check"></span>
                                            @else
                                                <span class="glyphicon glyphicon-unchecked"></span>
                                            @endif
                                        </button>
                                    @else
                                        <span class="glyphicon glyphicon-check"></span>
                                    @endif

                            </form>
                        </td>
                        <td>
                            <form class="form-inline" action="{{ url('/owner/user/adminToggle') }}">
                                <input title="id" name="id" style="display: none" value="{{  $user->id }}">
                                @if(!$user->hasRole('owner'))
                                    <button class="btn btn-sm btn-default" type="submit">
                                        @if($user->hasRole('admin'))
                                            <span class="glyphicon glyphicon-check"></span>
                                        @else
                                            <span class="glyphicon glyphicon-unchecked"></span>
                                        @endif
                                    </button>
                                @else
                                    <span class="glyphicon glyphicon-check"></span>
                                @endif

                            </form>
                        </td>
                        <td>
                            @if(!$user->hasRole('owner'))
                            <button class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></button>
                            @endif
                        </td>
                    </tr>

                @endforeach
            </table>
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
