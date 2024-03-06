@extends('layouts.app')
@section('content')
    <div class="d-flex conteiner justify-content-around py-5">
        <div class="card text-bg-secondary border col-8">
            <div class="card-header border-bottom">
                <label>{{__('Detail User')}}</label>
            </div>
            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between border-0 text-bg-secondary"><b>Nama Anda</b>
                    <span class="badge-pill">{{$user->name}}</span>    
                </li>
                <li class="list-group-item d-flex justify-content-between border-0 text-bg-secondary"><b>No Hp</b>
                    <span class="badge-pill">{{$user->nohp}}</span>    
                </li>
                <li class="list-group-item d-flex justify-content-between border-0 text-bg-secondary"><b>Alamat</b>
                    <span class="badge-pill">{{$user->alamat}}</span>    
                </li>
                <li class="list-group-item d-flex justify-content-between border-0 text-bg-secondary"><b>E-mail</b>
                    <span class="badge-pill">{{$user->email}}</span>    
                </li>
                <li class="list-group-item d-flex justify-content-between border-0 text-bg-secondary"><b>Role</b>
                    <span class="badge-pill">{{$user->role->role}}</span>    
                </li>
            </ul>
            <hr>
            </ul>
            </div>
        </div>
    </div>
@endsection