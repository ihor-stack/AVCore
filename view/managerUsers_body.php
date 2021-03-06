<div class="panel panel-default">
    <div class="panel-heading tabbable-line">
        <div class="btn-group pull-right" >
            <button type="button" class="btn btn-default" id="addUserBtn">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> <?php echo __("New User"); ?>
            </button>
            <a href="<?php echo $global['webSiteRootURL']; ?>usersGroups" class="btn btn-warning">
                <span class="fa fa-users"></span> <?php echo __("User Groups"); ?>
            </a>
            <a href="<?php echo $global['webSiteRootURL']; ?>mvideos" class="btn btn-success">
                <span class="fa fa-film"></span> <?php echo __("Videos"); ?>
            </a>
            <a href="<?php echo $global['webSiteRootURL']; ?>objects/getAllEmails.csv.php" class="btn btn-primary">
                <i class="fas fa-file-csv"></i> <?php echo __("CSV File"); ?>
            </a>
            <a href="#" class="btn btn-primary">
                <i class="fas fa-users"></i> <span class="totalDevicesOnline">0</span>
            </a>
        </div>

        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#usersTab"><?php echo __('Active Users'); ?></a></li>
            <li><a data-toggle="tab" href="#inactiveUsersTab" onclick="startUserGrid('#gridInactive', '?status=i');"><?php echo __('Inactive Users'); ?></a></li>
            <?php
            foreach ($userGroups as $value) {
                echo '<li><a data-toggle="tab" href="#userGroupTab' . $value['id'] . '" onclick="startUserGrid(\'#userGroupGrid' . $value['id'] . '\', \'?status=a&user_groups_id=' . $value['id'] . '\');">' . $value['group_name'] . '</a></li>';
            }
            ?>
        </ul>
    </div>
    <div class="panel-body">
        <div class="tab-content">
            <div id="usersTab" class="tab-pane fade in active">
                <table id="grid" class="table table-condensed table-hover table-striped">
                    <thead>
                        <tr>
                            <th data-column-id="user" data-formatter="user"><?php echo __("User"); ?></th>
                            <th data-column-id="name" data-order="desc"><?php echo __("Name"); ?></th>
                            <th data-column-id="email" ><?php echo __("E-mail"); ?></th>
                            <th data-column-id="created" ><?php echo __("Created"); ?></th>
                            <th data-column-id="modified" ><?php echo __("Modified"); ?></th>
                            <th data-column-id="tags" data-formatter="tags"  data-sortable="false" ><?php echo __("Tags"); ?></th>
                            <th data-column-id="commands" data-formatter="commands" data-sortable="false" data-width="100px"></th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div id="inactiveUsersTab" class="tab-pane fade">
                <table id="gridInactive" class="table table-condensed table-hover table-striped">
                    <thead>
                        <tr>
                            <th data-column-id="user" data-formatter="user"><?php echo __("User"); ?></th>
                            <th data-column-id="name" data-order="desc"><?php echo __("Name"); ?></th>
                            <th data-column-id="email" ><?php echo __("E-mail"); ?></th>
                            <th data-column-id="created" ><?php echo __("Created"); ?></th>
                            <th data-column-id="modified" ><?php echo __("Modified"); ?></th>
                            <th data-column-id="tags" data-formatter="tags"  data-sortable="false" ><?php echo __("Tags"); ?></th>
                            <th data-column-id="commands" data-formatter="commands" data-sortable="false" data-width="100px"></th>
                        </tr>
                    </thead>
                </table>
            </div>
            <?php
            foreach ($userGroups as $value) {
                ?>
                <div id="userGroupTab<?php echo $value['id']; ?>" class="tab-pane fade">
                    <table id="userGroupGrid<?php echo $value['id']; ?>" class="table table-condensed table-hover table-striped">
                        <thead>
                            <tr>
                                <th data-column-id="user" data-formatter="user"><?php echo __("User"); ?></th>
                                <th data-column-id="name" data-order="desc"><?php echo __("Name"); ?></th>
                                <th data-column-id="email" ><?php echo __("E-mail"); ?></th>
                                <th data-column-id="created" ><?php echo __("Created"); ?></th>
                                <th data-column-id="modified" ><?php echo __("Modified"); ?></th>
                                <th data-column-id="tags" data-formatter="tags"  data-sortable="false" ><?php echo __("Tags"); ?></th>
                                <th data-column-id="commands" data-formatter="commands" data-sortable="false" data-width="100px"></th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>


<div id="userFormModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo __("User Form"); ?></h4>
            </div>
            <div class="modal-body">
                <form class="form-compact"  id="updateUserForm" onsubmit="">
                    <input type="hidden" id="inputUserId"  >
                    <label for="inputUser" class="sr-only"><?php echo __("User"); ?></label>
                    <input type="text" id="inputUser" class="form-control first" placeholder="<?php echo __("User"); ?>" autofocus required="required">
                    <?php
                    getInputPassword("inputPassword", 'class="form-control" required="required"  autocomplete="off"', __("Password"));
                    ?>
                    <label for="inputEmail" class="sr-only"><?php echo __("E-mail"); ?></label>
                    <input type="email" id="inputEmail" class="form-control" placeholder="<?php echo __("E-mail"); ?>" >
                    <label for="inputName" class="sr-only"><?php echo __("Name"); ?></label>
                    <input type="text" id="inputName" class="form-control " placeholder="<?php echo __("Name"); ?>" >
                    <label for="inputChannelName" class="sr-only nhidden"><?php echo __("Channel Name"); ?></label>
                    <input type="text" id="inputChannelName" class="form-control nhidden" placeholder="<?php echo __("Channel Name"); ?>" >

                    <label for="inputAnalyticsCode" class="sr-only nhidden"><?php echo __("Channel Tier: 2.5, 5, 7.5, 10"); ?></label>
                    <select id="inputAnalyticsCode" class="form-control nhidden">
                        <option value="">Choose Tier:</option>
                        <option value="10">Silver Stage Monthly ❤ 10.00 HEART</option>
                        <option value="20">Gold Stage Monthly ❤ 20.00 HEART</option>
                        <option value="30">Platinum Stage Monthly ❤ 30.00 HEART</option>
                    </select>
                    <label for="inputStudioId" class="sr-only nhidden"><?php echo __("Studio"); ?></label>
                    <select id="inputStudioId" class="form-control nhidden">
                        <option value="">Choose A Studio:</option>
                        <?php require_once $global['systemRootPath'] . 'objects/Studio.php'; ?>
                        <?php echo join(Studio::getOptions()); ?>
                    </select>

                    <ul class="list-group">
                        <?php
                        print AVideoPlugin::getUserOptions();
                        ?>
                    </ul>

                    <ul class="list-group">
                        <li class="list-group-item <?php echo User::isAdmin() ? "" : "hidden"; ?>">
                            <?php echo __("is Admin"); ?>
                            <div class="material-switch pull-right">
                                <input type="checkbox" value="isAdmin" id="isAdmin"/>
                                <label for="isAdmin" class="label-success"></label>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <?php echo __("E-mail Verified"); ?>
                            <div class="material-switch pull-right">
                                <input type="checkbox" value="isEmailVerified" id="isEmailVerified"/>
                                <label for="isEmailVerified" class="label-success"></label>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <?php echo __("is Active"); ?>
                            <div class="material-switch pull-right">
                                <input type="checkbox" value="status" id="status"/>
                                <label for="status" class="label-success"></label>
                            </div>
                        </li>
                    </ul>
                    <ul class="list-group">
                        <li class="list-group-item active">
                            <?php echo __("User Groups"); ?>
                            <a href="#" class="btn btn-info btn-xs pull-right" data-toggle="popover" title="<?php echo __("What is User Groups"); ?>" data-placement="bottom"  data-content="<?php echo __("By associating groups with this user, they will be able to see all the videos that are related to this group"); ?>"><span class="fa fa-question-circle" aria-hidden="true"></span> <?php echo __("Help"); ?></a>
                        </li>
                        <?php
                        foreach ($userGroups as $value) {
                            ?>
                            <li class="list-group-item">
                                <span class="fa fa-unlock"></span>
                                <?php echo $value['group_name']; ?>
                                <span class="label label-info"><?php echo $value['total_videos']; ?> <?php echo __("Videos linked"); ?></span>
                                <div class="material-switch pull-right">
                                    <input id="userGroup<?php echo $value['id']; ?>" type="checkbox" value="<?php echo $value['id']; ?>" class="userGroups"/>
                                    <label for="userGroup<?php echo $value['id']; ?>" class="label-warning"></label>
                                </div>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo __("Close"); ?></button>
                <button type="button" class="btn btn-primary" id="saveUserBtn"><?php echo __("Save changes"); ?></button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div id="userInfoModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo __("User Info"); ?></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <label class="col-md-4 control-label"><?php echo __("First Name"); ?></label>
                    <div class="col-md-8 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input  id="first_name" class="form-control"  type="text" readonly >
                        </div>
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 control-label"><?php echo __("Last Name"); ?></label>
                    <div class="col-md-8 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input  id="last_name" class="form-control" readonly >
                        </div>
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 control-label"><?php echo __("Address"); ?></label>
                    <div class="col-md-8 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input  id="address" class="form-control"  readonly >
                        </div>
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 control-label"><?php echo __("Zip Code"); ?></label>
                    <div class="col-md-8 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input  id="zip_code" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 control-label"><?php echo __("Country"); ?></label>
                    <div class="col-md-8 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input  id="country" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-4 control-label"><?php echo __("Region"); ?></label>
                    <div class="col-md-8 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input  id="region" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-4 control-label"><?php echo __("City"); ?></label>
                    <div class="col-md-8 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input  id="city" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4 control-label"><?php echo __("Document"); ?></label>
                    <div class="col-md-8 inputGroupContainer">
                        <div class="input-group">
                            <img src="" class="img img-responsive img-thumbnail" id="documentImage"/>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
    function isAnalytics() {
        str = $('#inputAnalyticsCode').val();
        return true;
        //return str === '' || (/^ua-\d{4,9}-\d{1,4}$/i).test(str.toString());
    }
    function isStudioChosen() {
        return $('#inputStudioId').val() != '';
    }
    $(document).ready(function () {

        startUserGrid("#grid", "?status=a");
        $('#addUserBtn').click(function (evt) {
            $('#inputUserId').val('');
            $('#inputUser').val('');
            $('#inputPassword').val('');
            $('#inputEmail').val('');
            $('#inputName').val('');
            $('#inputChannelName').val('');
            $('#inputAnalyticsCode').val('');
            $('#inputStudioId').val('');
            $('#isAdmin').prop('checked', false);
            $('.userGroups').prop('checked', false);
            $('#status').prop('checked', true);
            $('#isEmailVerified').prop('checked', false);
<?php
print AVideoPlugin::addUserBtnJS();
?>
            $('#userFormModal').modal();
        });
        $('#checkmark1').change(function() { // Performer
            $('#inputStudioId, label[for=inputStudioId]').toggle(this.checked);
        });
        $('#checkmark3').change(function() { // Studio
            $('#inputAnalyticsCode, label[for=inputAnalyticsCode], #inputChannelName, label[for=inputChannelName]').toggle(this.checked);
        });

        $('#saveUserBtn').click(function (evt) {
            $('#updateUserForm').submit();
        });
        $('#updateUserForm').submit(function (evt) {
        evt.preventDefault();
        if (!isAnalytics()){
            avideoAlert("<?php echo __("Sorry!"); ?>", "<?php echo __("Your analytics code is wrong"); ?>", "error");
            $('#inputAnalyticsCode').focus();
            return false;
        }
        if (!isStudioChosen() && $('#checkmark1').is(':checked')){
            avideoAlert("<?php echo __("Sorry!"); ?>", "<?php echo __("You need to choose a Studio for a Performer kind of user."); ?>", "error");
            $('#inputStudioId').focus();
            return false;
        }

        modal.showPleaseWait();
                var selectedUserGroups = [];
                $('.userGroups:checked').each(function () {
        selectedUserGroups.push($(this).val());
        });
                $.ajax({
                url: '<?php echo $global['webSiteRootURL']; ?>objects/userAddNew.json.php',
                        data: {
<?php
print AVideoPlugin::updateUserFormJS();
?>
                        "id": $('#inputUserId').val(),
                                "user": $('#inputUser').val(),
                                "pass": $('#inputPassword').val(),
                                "email": $('#inputEmail').val(),
                                "name": $('#inputName').val(),
                                "channelName": $('#inputChannelName').val(),
                                "analyticsCode": $('#inputAnalyticsCode').val(),
                                "studioId": $('#inputStudioId').val(),
                                "isAdmin": $('#isAdmin').is(':checked'),
                                "status": $('#status').is(':checked') ? 'a' : 'i',
                                "isEmailVerified": $('#isEmailVerified').is(':checked'),
                                "userGroups": selectedUserGroups,
                                "do_not_login": 1
                        },
                        type: 'post',
                        success: function (response) {
                        if (response.status > "0") {
                        $('#userFormModal').modal('hide');
                                $('.bootgrid-table').bootgrid("reload");
                                avideoToast("<?php echo __("Your user has been saved!"); ?>");
                        } else if (response.error){
                        avideoAlert("<?php echo __("Sorry!"); ?>", response.error, "error");
                        } else {
                        avideoAlert("<?php echo __("Sorry!"); ?>", "<?php echo __("Your user has NOT been updated!"); ?>", "error");
                        }
                        modal.hidePleaseWait();
                        }
                });
                return false;
        }
        );
    });
    function startUserGrid(selector, queryString) {
        if ($(selector).hasClass('.bootgrid-table')) {
            return false;
        }
        var grid = $(selector).bootgrid({
            labels: {
                noResults: "<?php echo __("No results found!"); ?>",
                all: "<?php echo __("All"); ?>",
                infos: "<?php echo __("Showing {{ctx.start}} to {{ctx.end}} of {{ctx.total}} entries"); ?>",
                loading: "<?php echo __("Loading..."); ?>",
                refresh: "<?php echo __("Refresh"); ?>",
                search: "<?php echo __("Search"); ?>",
            },
            ajax: true,
            url: "<?php echo $global['webSiteRootURL']; ?>objects/users.json.php" + queryString,
            formatters: {
                "commands": function (column, row) {
                    var editBtn = '<button type="button" class="btn btn-xs btn-default command-edit" data-row-id="' + row.id + '" data-toggle="tooltip" data-placement="left" title="<?php echo __('Edit'); ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button>'
                    var infoBtn = '<button type="button" class="btn btn-xs btn-default command-info" data-row-id="' + row.id + '" data-toggle="tooltip" data-placement="left" title="<?php echo __('Info'); ?>"><i class="fas fa-info-circle"></i></button>'
                    var deleteBtn = '<button type="button" class="btn btn-default btn-xs command-delete"  data-row-id="' + row.id + '  data-toggle="tooltip" data-placement="left" title="Delete""><span class="glyphicon glyphicon-erase" aria-hidden="true"></span></button>';
                    var pluginsButtons = '<br><?php echo AVideoPlugin::getUsersManagerListButton(); ?>';
                    return editBtn + infoBtn + deleteBtn + pluginsButtons;
                },
                "tags": function (column, row) {
                    var tags = "";
                    for (var i in row.tags) {
                        if (typeof row.tags[i].type == "undefined") {
                            continue;
                        }
                        tags += "<span class=\"label label-" + row.tags[i].type + " fix-width\">" + row.tags[i].text + "</span><br>";
                    }
                    return tags;
                },
                "user": function (column, row) {
                    var photo = "";
                    if (row.photoURL) {
                        photo = "<br><img src='" + row.photo + "' class='img img-responsive img-rounded img-thumbnail' style='max-width:50px;'/>";
                    }
                    return row.user + photo;
                }
            }
        }).on("loaded.rs.jquery.bootgrid", function ()
        {
            /* Executes after data is loaded and rendered */
            grid.find(".command-edit").on("click", function (e) {
                var row_index = $(this).closest('tr').index();
                var row = $(selector).bootgrid("getCurrentRows")[row_index];
                console.log(row);
                $('#inputUserId').val(row.id);
                $('#inputUser').val(row.user);
                $('#inputPassword').val('');
                $('#inputEmail').val(row.email);
                $('#inputName').val(row.name);
                $('#inputChannelName').val(row.channelName);
                $('#inputAnalyticsCode').val(row.analyticsCode);
                $('#inputStudioId').val(row.studioId);
                $('.userGroups').prop('checked', false);
                for (var index in row.groups) {
                    $('#userGroup' + row.groups[index].id).prop('checked', true);
                }
                $('#isAdmin').prop('checked', (row.isAdmin == "1" ? true : false));
                $('#status').prop('checked', (row.status === "a" ? true : false));
                $('#isEmailVerified').prop('checked', (row.isEmailVerified == "1" ? true : false));
<?php
print AVideoPlugin::loadUsersFormJS();
?>

                $('#userFormModal').modal();
            }).end().find(".command-info").on("click", function (e) {

                var row_index = $(this).closest('tr').index();
                var row = $(selector).bootgrid("getCurrentRows")[row_index];
                console.log(row);
                modal.showPleaseWait();
                $('#first_name').val(row.first_name);
                $('#last_name').val(row.last_name);
                $('#address').val(row.address);
                $('#zip_code').val(row.zip_code);
                $('#country').val(row.country);
                $('#region').val(row.region);
                $('#city').val(row.city);
                $('#documentImage').attr('src', '<?php echo $global['webSiteRootURL']; ?>objects/userDocument.png.php?users_id=' + row.id);
                $('#userInfoModal').modal();
                modal.hidePleaseWait();
            }).end().find(".command-delete").on("click", function (e) {

                var row_index = $(this).closest('tr').index();
                var row = $(selector).bootgrid("getCurrentRows")[row_index];
                console.log(row);
                if (confirm('Are you sure to delete user ' + row.user)) {
                    $.ajax({
                    url: '<?php echo $global['webSiteRootURL']; ?>objects/userDelete.json.php',
                            data: {"id": row.id},
                            type: 'post',
                            success: function (response) {
                            if (response.status > "0") {
                                $('#userFormModal').modal('hide');
                                $('.bootgrid-table').bootgrid("reload");
                                avideoToast("<?php echo __("Your user has been deleted!"); ?>");
                            } else if (response.error){
                                avideoAlert("<?php echo __("Sorry!"); ?>", response.error, "error");
                            } else {
                                avideoAlert("<?php echo __("Sorry!"); ?>", "<?php echo __("Your user has NOT been deleted!"); ?>", "error");
                            }
                            modal.hidePleaseWait();
                        }
                    });
                }
            });
        });
    }

</script>
