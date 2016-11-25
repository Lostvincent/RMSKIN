'use strict';
//  Author: AdminDesigns.com
// 
//  This file is reserved for changes made by the use. 
//  Always seperate your work from the theme. It makes
//  modifications, and future theme updates much easier 
// 

var Custom = function() {

    var runGlobal = function() {
        //
    };

    var runUEditor = function() {
        if ($("#ueditor_container").length) {
            UE.delEditor('ueditor_container');
            var ue = UE.getEditor('ueditor_container');
            ue.ready(function() {
                ue.execCommand('serverparam', '_token', csrf_token);//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.    
            });
        }
    };

    var runUpload = function() {
        $('#upload-form').on('submit', function () {
            $.ajax({
                url: '/upload/token',
                type: 'GET',
                cache: false,
                dataType: 'json',
                success: function(data) {
                    if (data.code == 200) {
                        var formData = new FormData();
                        formData.append('token', data.up_token);
                        formData.append('file', $('#file')[0].files[0]);
                        $.ajax({
                            url: 'http://upload.qiniu.com/',
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            type: 'POST',
                            success: function(ret){
                                if(ret.code == 200) {
                                    window.location.href = '/skin/'+ret.skin_id;
                                }
                            }
                        });
                    }
                },
            });
            return false;
        });
    };

    return {
        init: function() {
            var route = window.location.pathname.substr(1);
            runGlobal();
            if (route == 'upload') {
                runUpload();
            } else if (/^admin\/wechat\/menu$/.test(route)) {
                runFancyTreeMenu();
            }
        }

    }
}();