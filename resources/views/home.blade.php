@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Consulta de Repositórios no Github') }}</h1>

    @if (session('success'))
    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="row"></div>
        <div class="col-md-12">
            <div class="container-fluid d-flex justify-content-center">
                <div class="card d-flex justify-content-center" style="width: 15%;">
                    <div>
                        <img src="{{ url($response_user->avatar_url) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{$response_user->name}}</h5>
                            <p class="card-text">{{$response_user->bio}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid">
                        <table  id="table" class="table display nowrap" style="width: 100%;"> 
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Linguagem</th>
                                    <th scope="col">Data Últ. Commit</th>
                                    <th scope="col">Link</th>
                                </tr>
                            </thead>
                            <tfoot style="display: table-header-group !important;">
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Linguagem</th>
                                    <th>Data Últ. Commit</th>
                                    <th>Link</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($response as $value)
                                    <tr>
                                        <td>{{$value->id}}</td>
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->language}}</td>
                                        <td>{{$value->updated_at}}</td>
                                        <td class="td-action" style="width: 320px;">
                                            <a href="{{ url($value->html_url); }}" target="_blank" class="deleteconfirm btn btn-primary btn-sm">{{$value->html_url}}</a>
                                            <div class="clearfix"></div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            
        </div>
    </div>
@endsection

