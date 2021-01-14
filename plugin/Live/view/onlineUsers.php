
<?php
require_once $global['systemRootPath'] . 'plugin/AVideoPlugin.php';
// the live users plugin
$lu = AVideoPlugin::getObjectDataIfEnabled("LiveUsers");
if (empty($lu) || $lu->doNotDisplayCounter) {
    return false;
}

if (empty($lu->doNotDisplayLiveCounter)) {
    ?>
    <span class="label label-primary"   data-toggle="tooltip" title="<?php echo __("Watching Now"); ?>" data-placement="bottom" ><i class="fa fa-eye"></i> <b class="liveUsersOnline_<?php echo $streamName; ?>">0</b></span>
    <?php
}
if (empty($lu->doNotDisplayTotal)) {
    ?>
    <span class="label label-default"   data-toggle="tooltip" title="<?php echo __("Total Views"); ?>" data-placement="bottom" ><i class="fa fa-user"></i> <b class="liveUsersViews_<?php echo $streamName; ?>">0</b></span>
    <?php
}
?>