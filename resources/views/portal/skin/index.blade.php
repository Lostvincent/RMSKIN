@extends('portal.page')
@section('title', '皮肤列表')

@section('content')
<div id="content" class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-lg-6 col-lg-offset-3">
  <div class="panel">
      <div class="panel-heading text-center">
        <span class="panel-title">
          <span class="fa fa-table"></span>皮肤列表</span>
      </div>
      <div class="panel-body pn">
        <div class="bs-component col-md-8 col-md-offset-2">
          <table class="table">
            <tbody>
              @foreach ($skins as $skin)
              <tr>
                <td><img src="{{ !empty($skin->cover) ? url($skin->cover) : (file_exists(public_path('covers/'.$skin->id.'.jpg')) ? url('covers/'.$skin->id.'.jpg') : url('timg.jpeg')) }}" width="100" height="100"></td>
                <td>
                  <div><a href="{{ url('skin/'.$skin->id) }}">{{ $skin->name }}</a></div>
                  <div>版本: {{ !empty($skin->version) ? $skin->version : '-' }}</div>
                  <br>
                  <div>浏览数：{{ $skin->views }} &nbsp; 下载数：{{ $skin->downloads }}</div>
                </td>
                <td><a href="{{ url('skin/'.$skin->id) }}">查看</a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
      </div>
  </div>
</div>
<div class="text-right">{!! $skins->render() !!}</div>
</div>
@endsection