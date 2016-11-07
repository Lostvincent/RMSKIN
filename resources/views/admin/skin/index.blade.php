@extends('layout.page')
@section('title', '皮肤列表')

@section('content')
<div id="content">
  <div class="panel" id="spy3">
      <div class="panel-heading">
        <span class="panel-title">
          <span class="fa fa-table"></span>皮肤列表</span>
      </div>
      <div class="panel-body pn">
        <div class="bs-component">
          <table class="table table-hover text-center">
            <thead>
              <tr>
                <th class="text-center">#</th>
                <th class="text-center">名称</th>
                <th class="text-center">介绍</th>
                <th class="text-center">版本</th>
                <th class="text-center">可下载</th>
                <th class="text-center">操作</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($skins as $skin)
              <tr>
                <td>{{ $skin->id }}</td>
                <td>{{ $skin->name }}</td>
                <td>{{ !empty($skin->description) ? str_limit($skin->description, 50) : '-' }}</td>
                <td>{{ $skin->version }}</td>
                <td>{!! $skin->is_available ? '<span class="fa fa-check"></span>' : '<span class="fa fa-times"></span>' !!}</td>
                <td>
                  <a href="{{ url('skin/'.$skin->id.'/edit') }}">编辑</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
      </div>
  </div>
</div>
</div>
@endsection