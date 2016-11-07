@extends('layout.page')
@section('title', '用户列表')

@section('content')
<div id="content">
  <div class="panel" id="spy3">
      <div class="panel-heading">
        <span class="panel-title">
          <span class="fa fa-table"></span>用户列表</span>
        <div class="pull-right hidden-xs">
          <ul class="nav panel-tabs-border panel-tabs">
            <li>
              <a href="{{ url('admin/user/create') }}">添加用户</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="panel-body pn">
        <div class="bs-component">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>用户名</th>
                <th>邮箱</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
              <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                  <a href="{{ url('admin/user/'.$user->id.'/edit') }}">编辑</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
      </div>
  </div>
</div>
<div class="text-right">{!! $users->render() !!}</div>
</div>
@endsection