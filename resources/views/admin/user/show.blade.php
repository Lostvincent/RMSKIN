@extends('layout.page')
@section('title', !empty($user) ? '编辑用户' : '添加用户')

@section('content')
<div id="content" class="animated fadeIn">
 <div class="row">
   <div class="col-md-12">
     <div class="panel">
       <div class="panel-heading">
         <span class="panel-title">{{ !empty($user) ? '编辑用户' : '添加用户' }}</span>
       </div>
       <div class="panel-body">

       <form class="form-horizontal" role="form" action="{{ !empty($user) ? url('admin/user/'.$user->id) : url('admin/user') }}" method="POST">
          {!! csrf_field() !!}
          @if (count($errors) > 0)
              <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
              </div>
          @endif
          @if(!empty($user))
            <div class="form-group">
                <label class="col-lg-3 control-label">ID</label>
                <div class="col-lg-8">
                    <div class="bs-component">
                        <p class="form-control-static text-muted">{{ $user->id }}</p>
                    </div>
                </div>
            </div>
            <input type="hidden" name="_method" value="PUT">
          @endif

           <div class="form-group">
             <label for="username" class="col-lg-3 control-label">名称</label>
             <div class="col-lg-8">
               <div class="bs-component">
                 <input type="text" id="username" name="name" class="form-control" value="{{ !empty($user) ? $user->name : old('name') }}">
               </div>
             </div>
           </div>

           <div class="form-group">
             <label for="Email" class="col-lg-3 control-label">邮箱</label>
             <div class="col-lg-8">
               <div class="bs-component">
                 <input type="text" id="Email" name="email" class="form-control" value="{{ !empty($user) ? $user->email : old('email') }}">
               </div>
             </div>
           </div>

           <div class="form-group">
             <label for="password" class="col-lg-3 control-label">密码</label>
             <div class="col-lg-8">
               <div class="bs-component">
                 <input type="password" id="password" name="password" class="form-control">
               </div>
             </div>
           </div>

           <div class="form-group">
             <label for="slug" class="col-lg-3 control-label">角色</label>
             <div class="col-lg-8">
               <div class="bs-component">
                 <select class="form-control" name="slug">
                     @foreach ($roles as $role)
                       <option value="{{$role->id}}" @if(isset($user->id) && $user->isRole($role->slug)) selected="selected" @endif>{{ $role->name }}</option>
                     @endforeach
                 </select>
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
