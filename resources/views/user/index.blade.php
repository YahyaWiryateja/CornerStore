@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body text-end">
                    <div class="table-responsive">
                    <table class="table table-striped  table-hover text-start">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>E-mail</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->username}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->role->role_id}}</td>
                            <td class="d-flex justify-content-around">
                                <a class="btn btn-outline-secondary" href="{{url('profile/'.$user->id)}}">{{__('Show')}}</a>
                                <a class="btn btn-outline-secondary" href="{{url('user/edit/'.$user->id)}}">{{__('Edit')}}</a>
                                <form class="d-flex" action="{{url('/user/delete/'.$user->id)}}" method="POST"><input type="hidden" name="_method" value="DELETE">
                                    @csrf
                                            <button class="btn btn-outline-secondary"> {{__('Delete')}} </button>
                                            </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                    <a class="btn btn-outline-secondary" href="{{url('User/create')}}">{{__('Tambah User')}}</a>
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection