<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2>
                用户
                <a  href="<?= base_url('admin/users') ?>" class="btn btn-warning">返回</a>
            </h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    创建新的用户
                </div>
                <div class="panel-body">
                    <div class="row">

                        <form role="form" method="POST" action="<?=base_url('admin/users/create')?>" id="user_mng_frm" enctype="multipart/form-data">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>上级用户</label>
                                    <select class="form-control" id="parent_id" name="parent_id">
                                        <option value="0">请选择上级用户</option>
                                        <?php foreach ($users as $user): ?>
                                            <option value="<?=$user->id?>"><?=$user->nickname."(".$user->phone.")"?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>电话号码</label>
                                    <input type="number" class="form-control" placeholder="输入姓电话号码" id="phone" name="phone" required>
                                </div>

                                <div class="form-group">
                                    <label>昵称</label>
                                    <input class="form-control" placeholder="输入姓昵称" id="nickname" name="nickname" required>
                                </div>

                                <div class="form-group">
                                    <label>用户名</label>
                                    <input class="form-control"  placeholder="输入用户名" id="username" name="username" >
                                </div>
                                <div class="form-group">
                                    <label>电子邮件</label>
                                    <input class="form-control" placeholder="输入电子邮件" id="email" name="email" >
                                </div>
                                <div class="form-group">
                                    <label>密码</label>
                                    <input type="password" class="form-control" placeholder="输入密码" id="password" name="password"  required>
                                </div>
                                <div class="form-group">
                                    <label>用户组</label>
                                    <select class="form-control" id="group_id" name="group_id">
                                        <?php foreach ($groups as $group): ?>
                                        <option value="<?=$group->id?>"><?=$group->description?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>名字</label>
                                    <input class="form-control" placeholder="输入名字" id="first_name" name="first_name"  >
                                </div>
                                <div class="form-group">
                                    <label>姓</label>
                                    <input class="form-control" placeholder="输入姓" id="last_name" name="last_name"  >
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="col-xs-2 control-label">头像</label>
                                    <div class="col-xs-10">
                                        <img src="../../assets/admin/images/users/default_avatar.png" width="200" id="avatar_preview" style="border:1px solid #d2d6de"/>
                                        <br><br><br>
                                        <input type="file" class="form-control user_avatar" id="avatar" name="avatar" size="20">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-11 text-center">
                                <button type="submit" class="btn btn-primary">创建</button>
                                <button type="reset" class="btn btn-default">重置</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
