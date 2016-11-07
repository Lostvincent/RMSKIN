@extends('layout.page')
@section('title', '编辑个人资料')

@section('content')
 <div id="content" class="animated fadeIn">
   <div class="row">

     <div class="col-md-12">
                 <!-- Input Fields -->
       <div class="panel">
         <div class="panel-heading">
           <span class="panel-title">编辑个人资料</span>
         </div>
         <div class="panel-body">

         <form class="form-horizontal" role="form" action="{{ url('admin/my') }}" method="POST">
            {!! csrf_field() !!}
            @if (count($errors) > 0)
              <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </div>
            @endif
            <input type="hidden" name="_method" value="PUT">

             <div class="form-group">
               <label for="name" class="col-lg-3 control-label">名称</label>
               <div class="col-lg-8">
                 <div class="bs-component">
                   <input type="text" id="name" name="name" class="form-control" value="{{ Auth::user()->name }}">
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
               <label for="password_confirmation" class="col-lg-3 control-label">确认密码</label>
               <div class="col-lg-8">
                 <div class="bs-component">
                   <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
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
