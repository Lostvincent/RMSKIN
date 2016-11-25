@extends('layout.page')
@section('title', !empty($skin) ? '编辑皮肤' : '添加皮肤')

@section('content')
 <div id="content" class="animated fadeIn">
   <div class="row">

     <div class="col-md-12">
                 <!-- Input Fields -->
       <div class="panel">
         <div class="panel-heading">
           <span class="panel-title">{{ !empty($skin) ? '编辑皮肤' : '添加皮肤' }}</span>
         </div>
         <div class="panel-body">

         <form class="form-horizontal" id="upload-form" role="form" action="{{ !empty($skin) ? url('admin/skin/'.$skin->id) : '#' }}" enctype="multipart/form-data">
            @if (count($errors) > 0)
              <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </div>
            @endif

            @if(!empty($skin))
              <div class="form-group">
                  <label class="col-lg-3 control-label">ID</label>
                  <div class="col-lg-8">
                      <div class="bs-component">
                          <p class="form-control-static text-muted">{{ $skin->id }}</p>
                      </div>
                  </div>
              </div>

              @if(!empty($skin->code))
              <div class="form-group">
                  <label class="col-lg-3 control-label">下载码</label>
                  <div class="col-lg-8">
                      <div class="bs-component">
                          <p class="form-control-static text-muted">{{ $skin->code }}</p>
                      </div>
                  </div>
              </div>
              @endif

              {!! csrf_field() !!}
              <input type="hidden" name="_method" value="PUT">

              <div class="form-group">
               <label for="cover" class="col-lg-3 control-label">封面</label>
               <div class="col-lg-8">
                 <div class="bs-component">
                   <input type="file" id="cover" name="cover" class="form-control">
                 </div>
               </div>
             </div>

              <div class="form-group">
               <label for="name" class="col-lg-3 control-label">名称</label>
               <div class="col-lg-8">
                 <div class="bs-component">
                   <input type="text" id="name" name="name" class="form-control" value="{{ !empty($skin) ? $skin->name : old('name') }}">
                 </div>
               </div>
             </div>

             <div class="form-group">
               <label for="version" class="col-lg-3 control-label">版本</label>
               <div class="col-lg-8">
                 <div class="bs-component">
                   <input type="text" id="version" name="version" class="form-control" value="{{ !empty($skin) ? $skin->version : old('version') }}">
                 </div>
               </div>
             </div>

             <div class="form-group">
               <label for="description" class="col-lg-3 control-label">描述</label>
               <div class="col-lg-8">
                 <div class="bs-component">
                   <textarea id="description" name="description" class="form-control" rows="5">{{ !empty($skin) ? $skin->description : old('description') }}</textarea>
                 </div>
               </div>
             </div>

             <div class="form-group">
               <label class="col-lg-3 control-label" for="is_available">允许下载</label>
               <div class="col-lg-8">
                 <div class="bs-component">
                  <div class="switch switch-info switch-inline">
                    <input id="is_available" type="checkbox" value="1" name="is_available" {{ !empty($skin) ? $skin->is_available ? 'checked': '' : old('is_available') ? 'checked' : '' }}>
                    <label for="is_available"></label>
                  </div>
                 </div>
               </div>
             </div>

             <div class="form-group">
               <label class="col-lg-3 control-label" for="is_public">公开下载</label>
               <div class="col-lg-8">
                 <div class="bs-component">
                  <div class="switch switch-info switch-inline">
                    <input id="is_public" type="checkbox" value="1" name="is_public" {{ !empty($skin) ? empty($skin->code) ? 'checked': '' : old('is_public') ? 'checked' : '' }}>
                    <label for="is_public"></label>
                  </div>
                 </div>
               </div>
             </div>
            @endif

             @if(empty($skin))
             <form id="upload-form" class="form-horizontal" role="form" method="POST">
             <div class="form-group">
               <label for="file" class="col-lg-3 control-label">文件</label>
               <div class="col-lg-8">
                 <div class="bs-component">
                   <input type="file" id="file" name="file" class="form-control" required="required" accept=".zip,.rar,.7z,.rmskin">
                 </div>
               </div>
             </div>
             @endif

             @if(empty($skin))
             <div class="form-group">
                <label class="col-lg-3 control-label">注意</label>
                <div class="col-lg-8">
                    <div class="bs-component">
                        <p class="form-control-static text-muted">皮肤文件上传大小限制<b style="color:red">30M</b></p>
                        <p class="form-control-static text-muted">皮肤<b style="color:red">不可删除</b>，<b style="color:red">可关闭下载</b>，创建请谨慎</p>
                    </div>
                </div>
              </div>
              @endif

             <div class="text-right">
               <button type="submit" class="btn btn-default ph25">提交</button>
             </div>

           </form>

         </div>
       </div>
     </div>
   </div>
 </div>
@endsection
