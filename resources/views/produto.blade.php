@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <center>
                @if (Session::has('success'))
                    <div class="alert alert-success">{!! session::get('success') !!}</div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger">{!! session::get('error') !!}</div>
                @endif
            </center>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Produtos
                </div>
                <div class="card-body">
                    <form action="{{ action('App\Http\Controllers\ProdutosController@store') }}" method="POST" enctype="multipart/form-data">
                        {{  csrf_field() }}
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="nproduto">Produto</label>
                                    <input type="text" id="nproduto" name="name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="nurl">Imagem</label>
                                    <input type="file" id="nurl" name="url" class="btn btn-info" accept="image/jpeg, image/jpg, image/png" style="width: 100%;" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Produtos
                </div>
                <div class="card-body">
                    <table class="table table-sm table-striped table-hover table-hover-cursor">
                        <thead>
                            <tr>
                                <th style="width: 50px;">ID</th>
                                <th>Produto</th>
                                <th>User</th>
                                <th style="width: 120px;">Data</th>
                                <th>Img</th>
                                <th style="width: 50px;">OP</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produtos as $item)
                                <tr>
                                    <td class="text-truncate">{{ $item->id }}</td>
                                    <td class="text-truncate">{{ $item->name }}</td>
                                    <td class="text-truncate">{{ $item->usuario }}</td>
                                    <td>{{ $item->confirmado }}</td>
                                    <td><img src="{{ $item->url }}" alt="{{ $item->name }}" width="50px;"></td>
                                    <td>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            {!! $produtos->appends(Request::except('page'))->links() !!}
        </div>

    </div>


</div>
@endsection
