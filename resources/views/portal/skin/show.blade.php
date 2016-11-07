@extends('portal.page')
@section('title', '皮肤')

@section('content')
<div id="content" class="animated fadeIn">
 <div class="row">
   <div class="col-md-12">
     <div class="panel">
       <div class="panel-heading">
         <span class="panel-title">皮肤详情</span>
       </div>
       <div class="panel-body">

       <form class="form-horizontal" role="form" action="{{ url('skin/'.$skin->id) }}" method="POST">
          {!! csrf_field() !!}
          @if (count($errors) > 0)
            <div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </div>
          @endif

            <div class="form-group">
              <label class="col-lg-3 control-label">ID</label>
              <div class="col-lg-7">
                <div class="bs-component">
                  <p class="form-control-static text-muted">{{ $skin->id }}</p>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-3 control-label">名称</label>
              <div class="col-lg-7">
                <div class="bs-component">
                  <p class="form-control-static text-muted">{{ $skin->name }}</p>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-3 control-label">描述</label>
              <div class="col-lg-7">
                <div class="bs-component">
                  <p class="form-control-static text-muted">{{ $skin->description }}</p>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-lg-3 control-label">版本</label>
              <div class="col-lg-7">
                <div class="bs-component">
                  <p class="form-control-static text-muted">{{ $skin->version }}</p>
                </div>
              </div>
            </div>

            @if($skin->is_available)
              <div class="form-group">
               <label for="code" class="col-lg-3 control-label">下载码</label>
               <div class="col-lg-7">
                 <div class="bs-component">
                   <input type="text" id="code" name="code" class="form-control" placeholder="选填" value="{{ old('code') }}">
                 </div>
               </div>
             </div>

             <div class="text-right">
               <button type="submit" class="btn btn-default ph25">下载</button>
             </div>
            @endif

         </form>
         
       </div>
     </div>
   </div>
 </div>
</div>
@endsection