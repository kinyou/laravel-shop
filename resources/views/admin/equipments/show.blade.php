@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">{{$equipment->name}}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/equipments') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> 返回列表</button></a>
                        <a href="{{ url('/admin/equipments/' . $equipment->id . '/edit') }}" title="编辑设备"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 编辑</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['admin/equipments', $equipment->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> 删除', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => '删除设备',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th> 设备名称 </th><td> {{ $equipment->name }} </td>
                                    </tr>
                                    <tr>
                                        <th> 生产厂家 </th><td> {{ $equipment->oem }} </td>
                                    </tr>
                                    <tr>
                                        <th> 状态 </th><td> {{ $equipment->status }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
