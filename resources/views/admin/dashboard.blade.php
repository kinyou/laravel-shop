@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">控制台</div>

                    <div class="card-body">
                        欢迎来到 电力系统时间同步管理后台
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
