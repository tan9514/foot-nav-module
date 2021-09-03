@extends('admin.public.header')
@section('title',$title)
@section('listcontent')
    <style>
        .layui-form-label{
            min-width: 120px;
        }
        #showNav .layui-form-label{
            min-width: auto;
        }
        .input, .showHeadHtml{
            float: left;
        }
        .showHeadHtml{
            margin-left: 200px;
            box-shadow: 0 1px 1px 1px rgb(0 0 0 / 15%);
        }
        .showHeadHtml .headHtml{
            padding: 10px;
        }
        .showHeadHtml .headHtml span{
            padding: 0 8px;
        }
        .footNavList{
            float: left;
        }
        .imgInfo, .addFootNav{
            border-radius: 3px;
            display: inline-block;
            padding: 6px;
            width: 80px;
            height: 80px;
            overflow: hidden;
            position: relative;
            vertical-align: middle;
        }
        .imgInfo{
            border: 1px solid #eee;
            margin: 0 5px 5px 0;
        }
        .imgInfo img{
            display: block;
            width: 35px;
            height: 35px;
            margin: 0 auto 10px auto;
        }
        .imgInfo a{
            position: absolute;
            bottom: 0;
            color: #fff !important;
            font-size: .75rem;
            width: 50%;
            text-align: center;
            display: block;
            padding: 2px 0;
            visibility: hidden;
            opacity: 0;
            transition: 200ms;
            background: rgba(0, 102, 212, 0.73);
            border-radius: 0 0 0 2px;
            left: 0;
        }
        .imgInfo .imgDel{
            right: 0;
            left: auto;
            background: rgba(255, 69, 68, 0.73);
            border-radius: 0 2px 0 0;
        }
        .imgInfo:hover a{
            visibility: visible;
            opacity: 1;
        }
        .imgInfo span{
            display: block;
            text-align: center;
            font-size: .75rem;
            white-space: nowrap;
            text-overflow: ellipsis;
            color: rgb(136, 136, 136);
        }
        .addFootNav{
            float: left;
            cursor: pointer;
            border: 1px dashed #ccc;
        }
        .addFootNav i{
            display: block;
            font-size: 46px;
            color: #aaa;
            text-align: center;
            line-height: 80px;
        }
        .imgDiv{
            margin-top: 10px;
            position: relative;
            width: 150px;
            text-align: center;
            height: 150px;
            line-height: 150px;
            border: 1px solid #e3e3e3;
            border-radius: 2px;
        }
        .imgDiv .delImag{
            position: absolute;
            top: 0;
            right: 0;
            border: 1px solid #ee4140;
            font-size: 16px;
            display: inline;
            width: 16px;
            height: 16px;
            background: #ff4544;
            color: #fff;
            text-align: center;
            z-index: 2;
            line-height: 16px;
            cursor: pointer;
            opacity: .25;
        }
        .imgDiv .delImag:hover{
            opacity: 1
        }
    </style>
    <div id="showNav" style="display: none">
        <div class="layui-form layuimini-form">
            <div class="layui-form-item">
                <label class="layui-form-label required">图标</label>
                <div class="layui-input-block">
                    <div class="layui-upload">
                        <button type="button" class="layui-btn" id="test1">上传图片</button>
                        <div class="imgDiv imgDiv1">
                            <img src="" style="max-width: 100%; max-height: 100%;" />
                            <input class="layui-input" type="hidden" lay-verify="required" lay-reqtext="图标不能为空" id="pic" value="" />
                            <span class="delImag">x</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label required">选择状态图标</label>
                <div class="layui-input-block">
                    <div class="layui-upload">
                        <button type="button" class="layui-btn" id="test2">上传图片</button>
                        <div class="imgDiv imgDiv2">
                            <img src="" style="max-width: 100%; max-height: 100%;" />
                            <input class="layui-input" type="hidden" lay-verify="required" lay-reqtext="选择状态图标不能为空" id="is_pic" value="" />
                            <span class="delImag">x</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label required">名称</label>
                <div class="layui-input-block">
                    <input class="layui-input showNav-name" type="text" lay-verify="required" lay-reqtext="名称不能为空" id="name" value="" />
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label required">文字选中颜色</label>
                <div class="layui-input-block">
                    <input class="layui-input showNav-color" type="color" lay-verify="required" lay-reqtext="文字选中颜色不能为空" id="is_color" value="#ff4544" style="max-width: 80px; padding-right: 10px;" />
                </div>
            </div>

            <div class="appletInfo"></div>
            <div class="appletParams"></div>

            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn layui-btn-normal" id="appletBtn" lay-submit lay-filter="appletBtn">确认</button>
                </div>
            </div>
        </div>
    </div>
    <div class="layui-form layuimini-form">
        <div class="layui-form-item">
            <label class="layui-form-label required">顶部导航文字颜色</label>
            <div class="layui-input-block">
                <div class="input">
                    <input lay-filter="fontcolor" type="radio" name="head[fontcolor]" value="0" title="黑色" @if((isset($info['head']['fontcolor']) && $info['head']['fontcolor'] == 0) || !isset($info['head']['fontcolor'])) checked @endif >
                    <input lay-filter="fontcolor" type="radio" name="head[fontcolor]" value="1" title="白色" @if(isset($info['head']['fontcolor']) && $info['head']['fontcolor'] == 1) checked @endif >
                </div>
                <div class="showHeadHtml">
                    <div class="headHtml">
                        <span>顶部导航栏效果</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label required">顶部导航背景颜色</label>
            <div class="layui-input-block">
                <input class="layui-input backcolor" type="color" lay-verify="required" lay-reqtext="顶部导航背景颜色不能为空" name="head[backcolor]" value="{{$info['head']['backcolor'] ?? '#ffffff'}}" style="max-width: 80px; padding-right: 10px;" />
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label required">底部导航图标</label>
            <div class="layui-input-block">
                <div class="footNavList"></div>
                <div class="addFootNav"><i class="layui-icon layui-icon-addition"></i></div>
            </div>
        </div>

        <div class="hr-line"></div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn layui-btn-normal" id="saveBtn" lay-submit lay-filter="saveBtn">保存</button>
            </div>
        </div>

    </div>
@endsection

@section('listscript')
    <script type="text/javascript">
        layui.use(['iconPickerFa', 'form', 'layer', 'upload'], function () {
            var iconPickerFa = layui.iconPickerFa,
                form = layui.form,
                layer = layui.layer,
                upload = layui.upload,
                $ = layui.$;
            var appletObj = eval('<?php echo json_encode($applet);?>');
            var footObj = eval('<?php echo json_encode($foot);?>');

            setFontcolor($("[name='head[fontcolor]']:checked").val());
            setBackcolor($(".backcolor").val());
            setImgInfoList();

            function s4(){
                return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
            }
            function guid() {
                return (s4()+s4()+"-"+s4()+"-"+s4()+"-"+s4()+"-"+s4()+s4()+s4());
            }

            // 动态选择头部导航文字颜色
            form.on('radio(fontcolor)', function(data){
                setFontcolor(data.value)
            });
            function setFontcolor(value) {
                if(value == 1){
                    $(".headHtml span").css("color", '#ffffff');
                }else{
                    $(".headHtml span").css("color", '#000000');
                }
            }

            // 动态修改头部导航背景颜色
            $(document).on("change", ".backcolor", function () {
                setBackcolor($(this).val());
            })
            function setBackcolor(value) {
                if(value.length > 0){
                    $(".headHtml").css("background", value);
                }
            }

            // 动态设置底部导航图标列表
            function setImgInfoList() {
                let divList = "";
                let domain = window.location.host;
                for (let i in footObj){
                    divList += '<div class="imgInfo">';
                    divList += '<img src="http://' + domain + "/" + footObj[i].pic + '" alt="" />';
                    divList += '<span>' + footObj[i].name + '</span>';
                    divList += '<a class="imgEdit" href="javascript:void(0)">编辑</a>';
                    divList += '<a class="imgDel" href="javascript:void(0)">删除</a>';
                    divList += '<div class="imgInfoInputs">';
                    divList += '<input class="imgInfoInputs-index" type="hidden" value="' + i + '" />';
                    divList += '<input class="imgInfoInputs-id" type="hidden" name="foot['+i+'][id]" value="' + footObj[i].id + '" />';
                    divList += '<input class="imgInfoInputs-is_color" type="hidden" name="foot['+i+'][is_color]" value="' + footObj[i].is_color + '" />';
                    divList += '<input class="imgInfoInputs-is_pic" type="hidden" name="foot['+i+'][is_pic]" value="' + footObj[i].is_pic + '" />';
                    divList += '<input class="imgInfoInputs-name" type="hidden" name="foot['+i+'][name]" value="' + footObj[i].name + '" />';
                    divList += '<input class="imgInfoInputs-params" type="hidden" name="foot['+i+'][params]" value="' + footObj[i].params + '" />';
                    divList += '<input class="imgInfoInputs-pic" type="hidden" name="foot['+i+'][pic]" value="' + footObj[i].pic + '" />';
                    divList += '<input class="imgInfoInputs-route" type="hidden" name="foot['+i+'][route]" value="' + footObj[i].route + '" />';
                    divList += '</div>';
                    divList += '</div>';
                }
                $(".footNavList").html(divList);
            }

            var layerIndex;
            var editObj = {};
            // 动态添加底部导航
            $(document).on("click", ".addFootNav i", function () {
                editObj = {
                    index: "",
                    pic: "",
                    is_pic: "",
                    name: "",
                    is_color: "#ff4544",
                    route: "",
                    id: 0,
                    params: "",
                    paramsArr: {},
                };
                $("#showNav .showNav-name").val(editObj.name);
                $("#showNav .showNav-color").val(editObj.is_color);
                $("#showNav .imgDiv1").find("img").attr("src", '');
                $("#showNav .imgDiv1").find("input").val('');
                $("#showNav .imgDiv2").find("img").attr("src", '');
                $("#showNav .imgDiv2").find("input").val('');

                setShowNavHtml(editObj.paramsArr);
            })

            // 动态编辑底部导航
            $(document).on("click", ".imgEdit", function () {
                let imgInfoInputs = $(this).nextAll(".imgInfoInputs");
                editObj = {
                    index: imgInfoInputs.find(".imgInfoInputs-index").val(),
                    pic: imgInfoInputs.find(".imgInfoInputs-pic").val(),
                    is_pic: imgInfoInputs.find(".imgInfoInputs-is_pic").val(),
                    name: imgInfoInputs.find(".imgInfoInputs-name").val(),
                    is_color: imgInfoInputs.find(".imgInfoInputs-is_color").val(),
                    route: imgInfoInputs.find(".imgInfoInputs-route").val(),
                    id: imgInfoInputs.find(".imgInfoInputs-id").val(),
                    params: imgInfoInputs.find(".imgInfoInputs-params").val(),
                    paramsArr: {},
                };
                if(editObj.params.length > 0){
                    if(editObj.params.indexOf("&") >= 0){
                        let arr = editObj.params.split('&');
                        for (let i in arr){
                            let arri = arr[i].params.split('=');
                            editObj.paramsArr[arri[0]] = arri[1];
                        }
                    }else if(editObj.params.indexOf("=") >= 0){
                        let arr = editObj.params.split('=');
                        editObj.paramsArr[arr[0]] = arr[1];
                    }
                }
                $("#showNav .showNav-name").val(editObj.name);
                $("#showNav .showNav-color").val(editObj.is_color);
                var domain = window.location.host;
                $("#showNav .imgDiv1").find("img").attr("src", 'http://' + domain + "/" + editObj.pic);
                $("#showNav .imgDiv1").find("input").val(editObj.pic);
                $("#showNav .imgDiv2").find("img").attr("src", 'http://' + domain + "/" + editObj.is_pic);
                $("#showNav .imgDiv2").find("input").val(editObj.is_pic);

                setShowNavHtml(editObj.paramsArr);
            })

            // 动态编辑弹框内容
            function setShowNavHtml(paramsArr) {
                let id = 0;
                let appletSelectDiv = '<div class="layui-form-item">';
                appletSelectDiv += '<label class="layui-form-label">可选链接</label>';
                appletSelectDiv += '<div class="layui-input-block">';
                appletSelectDiv += '<select lay-filter="appletSelect">';
                appletSelectDiv += '<option value="0">请选择链接</option>';
                for(let k in appletObj){
                    if(editObj.id == appletObj[k].id){
                        id = appletObj[k].id;
                        appletSelectDiv += '<option value="' + appletObj[k].id + '" selected >' + appletObj[k].name + '</option>';
                    } else {
                        appletSelectDiv += '<option value="' + appletObj[k].id + '">' + appletObj[k].name + '</option>';
                    }
                }
                appletSelectDiv += '</select>';
                appletSelectDiv += '</div>';
                appletSelectDiv += '</div>';
                $("#showNav .layui-form .appletInfo").html(appletSelectDiv);
                $("#showNav .layui-form .appletParams").html("");
                form.render();
                setAppletParams(id, paramsArr, true);

                layerIndex = layer.open({
                    title: '导航菜单编辑',
                    type: 1,
                    shade: 0.2,
                    maxmin:true,
                    skin:'layui-layer-lan',
                    shadeClose: true,
                    area: ['90%', '80%'],
                    content: $("#showNav"),
                });
            }

            // 动态获取下拉框
            form.on("select(appletSelect)", function (data) {
                let params;
                let id = data.value;
                $("#showNav .layui-form .appletParams").html("");
                form.render();
                setAppletParams(id);
            })

            // 动态生成跳转页面参数
            function setAppletParams(id, paramsArr = {}, status = false) {
                for (let i in appletObj){
                    if(id == appletObj[i].id){
                        let info = "";
                        info += '<div class="layui-form-item">';
                        info += '<label class="layui-form-label">跳转地址</label>';
                        info += '<div class="layui-input-block">';
                        info += '<input type="text" name="route" value="'+appletObj[i].route+'" class="layui-input layui-disabled" disabled />';
                        info += '</div>';
                        info += '</div>';

                        for(let k in appletObj[i].params){
                            info += '<div class="layui-form-item">';
                            info += '<label class="layui-form-label">'+appletObj[i].params[k].name+'</label>';
                            info += '<div class="layui-input-block">';
                            if(appletObj[i].params[k].is_value == 1){
                                let pvalue = appletObj[i].params[k].value;
                                if(status && paramsArr.hasOwnProperty(appletObj[i].params[k].name)){
                                    pvalue = paramsArr[appletObj[i].params[k].name];
                                }
                                info += '<input type="text" name="'+appletObj[i].params[k].name+'" value="'+pvalue+'" class="layui-input" />';
                            }else{
                                info += '<input type="text" name="'+appletObj[i].params[k].name+'" value="'+appletObj[i].params[k].value+'" class="layui-input layui-disabled" disabled />';
                            }
                            if(appletObj[i].params[k].desc.length > 0) {
                                info += '<div style="font-size: 10px; color: #636c72;">' + appletObj[i].params[k].desc + '</div>';
                            }
                            info += '</div>';
                            info += '</div>';
                        }

                        $("#showNav .layui-form .appletParams").html(info);
                        form.render();
                        break;
                    }
                }
            }

            // 动态删除底部导航
            $(document).on("click", ".imgDel", function () {
                let index = $(this).nextAll(".imgInfoInputs").find(".imgInfoInputs-index").val();
                footObj.splice(index,1);
                setImgInfoList();
            })

            // 动态删除图片
            $(document).on("click", ".delImag", function () {
                $(this).prevAll("img").attr("src", "");
                $(this).prevAll("input").val("");
            })

            //普通图片上传
            upload.render({
                elem: '#test1'
                ,url: '/admin/upload/upload' //改成您自己的上传接口
                ,accept: 'images'
                ,acceptMime: 'image/*'
                ,size: 400 //限制文件大小，单位 KB
                ,headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                ,done: function(res){
                    if(res.code==0){
                        var domain = window.location.host;
                        $('.imgDiv1').find("img").attr("src", 'http://' + domain + "/" + res.data[0]);
                        $('.imgDiv1').find("input").val(res.data[0]);
                    }else{
                        layer.msg(res.message,{icon: 2});
                    }
                }
            });
            upload.render({
                elem: '#test2'
                ,url: '/admin/upload/upload' //改成您自己的上传接口
                ,accept: 'images'
                ,acceptMime: 'image/*'
                ,size: 400 //限制文件大小，单位 KB
                ,headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                ,done: function(res){
                    if(res.code==0){
                        var domain = window.location.host;
                        $('.imgDiv2').find("img").attr("src", 'http://' + domain + "/" + res.data[0]);
                        $('.imgDiv2').find("input").val(res.data[0]);
                    }else{
                        layer.msg(res.message,{icon: 2});
                    }
                }
            });

            // 监听生成菜单
            form.on('submit(appletBtn)', function (data){
                $("#appletBtn").addClass("layui-btn-disabled");
                $("#appletBtn").attr('disabled', 'disabled');
                var pic = $("#pic").val();
                var is_pic = $("#is_pic").val();
                var name = $("#name").val();
                var is_color = $("#is_color").val();
                var id = $(".appletInfo select").find("option:selected").val();
                var field = data.field;
                let route = "";
                if(field.hasOwnProperty("route")) route = "/" + field.route;
                let params = "";
                $.each(field, function (i, v){
                    if(i != "route" && i != "file"){
                        if(route.indexOf("?")!=-1){
                            route += "&" + i + "=" + v;
                            params += "&" + i + "=" + v;
                        }else{
                            route += "?" + i + "=" + v;
                            params += i + "=" + v;
                        }
                    }
                })
                if(editObj.index == ""){
                    // 新增
                    let footInfo = {
                        pic: pic,
                        is_pic: is_pic,
                        name: name,
                        is_color: is_color,
                        route: route,
                        id: id,
                        params: params,
                    };
                    footObj.push(footInfo);
                }else{
                    // 编辑
                    footObj[editObj.index] = {
                        pic: pic,
                        is_pic: is_pic,
                        name: name,
                        is_color: is_color,
                        route: route,
                        id: id,
                        params: params,
                    };
                }
                setImgInfoList();
                $("#appletBtn").removeClass("layui-btn-disabled");
                $("#appletBtn").removeAttr('disabled');
                layer.close(layerIndex);
            })

            //监听提交
            form.on('submit(saveBtn)', function(data){
                $("#saveBtn").addClass("layui-btn-disabled");
                $("#saveBtn").attr('disabled', 'disabled');
                $.ajax({
                    url:'/admin/footnav/setting',
                    type:'post',
                    data:data.field,
                    dataType:'JSON',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success:function(res){
                        if(res.code==0){
                            layer.msg(res.message,{icon: 1},function (){
                                location.reload();
                            });
                        }else{
                            layer.msg(res.message,{icon: 2});
                            $("#saveBtn").removeClass("layui-btn-disabled");
                            $("#saveBtn").removeAttr('disabled');
                        }
                    },
                    error:function (data) {
                        layer.msg(res.message,{icon: 2});
                        $("#saveBtn").removeClass("layui-btn-disabled");
                        $("#saveBtn").removeAttr('disabled');
                    }
                });
            });
        });
    </script>
@endsection