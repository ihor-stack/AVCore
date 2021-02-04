<?php
global $global, $config;
if (!isset($global['systemRootPath'])) {
    require_once '../videos/configuration.php';
}
require_once $global['systemRootPath'] . 'objects/user.php';
require_once $global['systemRootPath'] . 'objects/Channel.php';
require_once $global['systemRootPath'] . 'objects/subscribe.php';
require_once $global['systemRootPath'] . 'objects/video.php';
require_once $global['systemRootPath'] . 'plugin/Gallery/functions.php';

if (isset($_SESSION['channelName'])) {
    _session_start();
    unset($_SESSION['channelName']);
}

$totalChannels = Channel::getTotalChannels();

if (!empty($_GET['page'])) {
    $_POST['current'] = intval($_GET['page']);
} else {
    $_POST['current'] = 1;
}

$users_id_array = VideoStatistic::getUsersIDFromChannelsWithMoreViews();

$current = $_POST['current'];
$_REQUEST['rowCount'] = 10;
$channels = Channel::getChannels(true, "u.id, '" . implode(",", $users_id_array) . "'");

$totalPages = ceil($totalChannels / $_REQUEST['rowCount']);
$metaDescription = __("Channels");
?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION['language']; ?>">
    <head>
        <title><?php echo __("Channels") . getSEOComplement() . $config->getPageTitleSeparator() . $config->getWebSiteTitle(); ?></title>
        <?php
        include $global['systemRootPath'] . 'view/include/head.php';
        ?>
        <style>
            #custom-search-input{
                padding: 3px;
                border: solid 1px #E4E4E4;
                border-radius: 6px;
                background-color: #fff;
            }

            #custom-search-input input{
                border: 0;
                box-shadow: none;
            }

            #custom-search-input button{
                margin: 2px 0 0 0;
                background: none;
                box-shadow: none;
                border: 0;
                color: #666666;
                padding: 0 8px 0 10px;
                border-left: solid 1px #ccc;
            }

            #custom-search-input button:hover{
                border: 0;
                box-shadow: none;
                border-left: solid 1px #ccc;
            }

            #custom-search-input .glyphicon-search{
                font-size: 23px;
            }
        </style>
    </head>

    <body class="<?php echo $global['bodyClass']; ?>">
        <?php
        include $global['systemRootPath'] . 'view/include/navbar.php';
        ?>

        <div class="container-fluid">
            <div class="panel panel-default" >
                <div class="panel-heading">
                    <form id="search-form" name="search-form" action="<?php echo $global['webSiteRootURL']; ?>channels" method="get">
                        <div id="custom-search-input">
                            <div class="input-group col-md-12">
                                <input type="search" name="searchPhrase" class="form-control input-lg" placeholder="<?php echo __("Search Channels"); ?>" value="<?php
                                echo htmlentities(@$_GET['searchPhrase']);
                                unsetSearch();
                                ?>" />
                                <span class="input-group-btn">
                                    <button class="btn btn-info btn-lg" type="submit">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="panel-body" >
                    <ul class="pages">
                    </ul>

			            <!-- For Live Videos -->
						<div class="panel panel-default" id="liveVideos" style="display: none;">
                            <div class="panel-heading">
							  <i class="fas fa-play-circle"></i> <?php echo __("Live Streams"); ?>
                            </div>
                            <div class="panel-body gallery ">
							  <div class="extraVideos"></div>
						   </div>
						</div>
                        <script>
                            function afterExtraVideos($liveLi) {
                                $liveLi.removeClass('col-lg-12 col-sm-12 col-xs-12 bottom-border');
                                $liveLi.find('.thumbsImage').removeClass('col-lg-5 col-sm-5 col-xs-5');
                                $liveLi.find('.videosDetails').removeClass('col-lg-7 col-sm-7 col-xs-7');
                                $liveLi.addClass('col-lg-2 col-md-4 col-sm-4 col-xs-6 fixPadding');
                                $('#liveVideos').slideDown();
                                return $liveLi;
                            }
                        </script>

                        <!-- For Upcoming Live Streams -->
                        <?php
                        if (($ppvlive = AVideoPlugin::getDataObjectIfEnabled("PayPerViewLive")) &&
                            ($futureLiveStreams = Ppvlive_schedule::getAll(0, true))) {
                            ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                  <i class="fas fa-play-circle"></i> <?php echo __("Upcoming Live Shows"); ?>
                                </div>
                                <div class="panel-body gallery ">
								  <div class="row galeryRowElement">
								  <?php foreach ($futureLiveStreams as $futureLiveStream) {?>
                        				<div class="liveVideo col-lg-2 col-md-4 col-sm-4 col-xs-6 fixPadding">
                                        <a href="<?php echo $global['webSiteRootURL'] . 'plugin/PayPerViewLive/View/buy.php?users_id=' . $futureLiveStream['users_id'] . '&redirectUri=' . urlencode(getSelfURI()); ?>" class="h6 videoLink">
                                            <div class="col-lg-5 col-sm-5 col-xs-5 nopadding thumbsImage" style="min-height: 70px; position:relative;" >
                                                <img src="<?php echo User::getPhoto($futureLiveStream['users_id']); ?>" class="thumbsJPG img-responsive" height="130" itemprop="thumbnailUrl" alt="Logo" />
                                                <span class="label label-danger liveNow faa-flash faa-slow animated"><?php echo __("BUY NOW"); ?></span>
                                            </div>
                                            <div class="col-lg-7 col-sm-7 col-xs-7 videosDetails">
                                                <div class="text-uppercase row"><strong itemprop="name" class="title liveTitle"><?php echo $futureLiveStream['name']; ?></strong></div>
                                                <div class="details row" itemprop="description">
                                                    <div class="liveUser"><?php echo User::getNameIdentificationById($futureLiveStream['users_id']); ?></div>
												 <div class="liveDate"><?php echo date('F j g:ia', strtotime($futureLiveStream['live_starts'])); ?></div>
												 <span class="label label-success" style="font-size: 10.5px; margin-top: 6px; display: inline-block;">Buy</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
								  <?php
								  }
                                ?>
							   </div>
		
                               </div>
                            </div>
                            <?php
                        }
                        ?>

                    <?php
                    foreach ($channels as $value) {
                        $get = array('channelName' => $value['channelName']);
                        ?>

                        <!-- VOD channels -->
                        <div class="panel panel-default">
                            <div class="panel-heading" style="position: relative;">
                                <img src="<?php echo User::getPhoto($value['id']); ?>"
                                     class="img img-thumbnail img-responsive pull-left" style="max-height: 100px; margin: 0 10px;" alt="User Photo" />
                                <a href="<?php echo User::getChannelLink($value['id']); ?>" class="btn btn-default">
                                    <i class="fas fa-play-circle"></i>
                                    <?php
                                    echo User::getNameIdentificationById($value['id']);
                                    ?>
                                </a>
                                <div style="position: absolute; right: 10px; top: 10px;">
                                    <?php
                                    echo User::getBlockUserButton($value['id']);
                                    ?>
    <?php echo Subscribe::getButton($value['id']); ?>
                                </div>
                            </div>
                            <div class="panel-body gallery ">
                                <div>
    <?php echo stripslashes(str_replace('\\\\\\\n', '<br/>', $value['about'])); ?>
                                </div>
                                
                                <div class="clearfix" style="margin-bottom: 10px;"></div>
                                <div class="row clear clearfix galeryRowElement">
                                    <?php
                                    $_POST['current'] = 1;
                                    $_REQUEST['rowCount'] = 6;
                                    $_POST['sort']['created'] = "DESC";
                                    $uploadedVideos = Video::getAllVideosAsync("viewable", $value['id'], true);
                                    
                                    createGallerySection($uploadedVideos, dechex(crc32($value['channelName'])));
                                    ?>
                                </div>
                            </div>
                            <div class="panel-footer " style="font-size: 0.8em">
                                <div class=" text-muted align-right">
    <?php echo VideoStatistic::getChannelsTotalViews($value['id']), " ", __("Views in the last 30 days"); ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }

                    echo getPagination($totalPages, $current, "{$global['webSiteRootURL']}channels?page={page}");
                    ?>
                </div>
            </div>
        </div>

        <?php
        include $global['systemRootPath'] . 'view/include/footer.php';
        ?>
    </body>
</html>
