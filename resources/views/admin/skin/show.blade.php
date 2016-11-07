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

         <form class="form-horizontal" role="form" action="{{ !empty($skin) ? url('admin/skin/'.$skin->id) : url('admin/skin') }}" method="POST" enctype="multipart/form-data">
            {!! csrf_field() !!}
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

              <div class="form-group">
                  <label class="col-lg-3 control-label">版本</label>
                  <div class="col-lg-8">
                      <div class="bs-component">
                          <p class="form-control-static text-muted">{{ $skin->version }}</p>
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
              
              <input type="hidden" name="_method" value="PUT">
            @endif

             <div class="form-group">
               <label for="name" class="col-lg-3 control-label">名称</label>
               <div class="col-lg-8">
                 <div class="bs-component">
                   <input type="text" id="name" name="name" class="form-control" value="{{ !empty($skin) ? $skin->name : old('name') }}">
                 </div>
               </div>
             </div>

             @if(empty($skin))
             <div class="form-group">
               <label for="skin" class="col-lg-3 control-label">文件</label>
               <div class="col-lg-8">
                 <div class="bs-component">
                   <input type="file" id="skin" name="skin" class="form-control">
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
             @endif

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
                    <input id="is_public" type="checkbox" value="1" name="is_public" {{ !empty($skin) ? $skin->is_public ? 'checked': '' : old('is_public') ? 'checked' : '' }}>
                    <label for="is_public"></label>
                  </div>
                 </div>
               </div>
             </div>

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
