@extends('layout.page')
@section('title', '测试页')

@section('content')
<div id="content" class="animated fadeIn">
 <div class="row">
   <div class="col-md-12">
     <div class="panel">
       <div class="panel-heading">
         <span class="panel-title">测试上传</span>
       </div>
       <div class="panel-body">

       <form id="upload-form" class="form-horizontal" role="form" method="POST">
         <div class="form-group">
           <label for="file" class="col-lg-3 control-label">文件</label>
           <div class="col-lg-8">
             <div class="bs-component">
               <input type="file" id="file" name="file" class="form-control" required="required" accept=".zip,.rar,.7z,.rmskin">
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