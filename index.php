<?php 

function register_xdays_task($today, $freq, $offset, $level, $task) {
    global $tasks;
    if ( (($today+$offset) % $freq) === 0 ) {
        array_push($tasks[$level], $task);
        return true;
    }
    return false;
}

date_default_timezone_set('Asia/Tokyo');

define('MONDAY',    1);
define('TUESDAY',   2);
define('WEDNESDAY', 3);
define('THURSDAY',  4);
define('FRIDAY',    5);
define('SATURDAY',  6);
define('SUNDAY',    7);

$tasks = array(
    'level_1' => array(),
    'level_2' => array(),
    'level_3' => array()
);

$currentTime = time() + (isset($_GET['offset']) ? ((int) $_GET['offset'])*60*60*24 : 0);
$dateTime = new DateTime();
$dateTime->setTimestamp($currentTime);
$currentDayRaw = $dateTime->diff(new DateTime('0001-01-01'))->format('%a');
$date = date('m/d/Y h:i:s a', $currentTime);

$dayOfWeek = date('N', $currentTime);
$dayOfWeekInstanceForMonth = (int) (date('j', $currentTime) / 7) + 1;




if ( $dayOfWeek == SUNDAY ) {
    array_push($tasks['level_1'], 'Rest!');
}


register_xdays_task($currentDayRaw, 1, 0, 'level_1', 'Motivational video' );
register_xdays_task($currentDayRaw, 1, 0, 'level_1', 'Workout' );
register_xdays_task($currentDayRaw, 1, 0, 'level_1', 'Get dressed' );
register_xdays_task($currentDayRaw, 2, 0, 'level_1', 'Laundry' );
register_xdays_task($currentDayRaw, 15, 3, 'level_1', 'Change sheets' );
register_xdays_task($currentDayRaw, 21, 0, 'level_1', 'Clean shower' );
register_xdays_task($currentDayRaw, 21, 10, 'level_1', 'Clean bathroom' );

register_xdays_task($currentDayRaw, 1, 0, 'level_2', 'Anki' );
register_xdays_task($currentDayRaw, 1, 1, 'level_2', 'Read Japanese' );
// register_xdays_task($currentDayRaw, 2, 0, 'level_2', 'Read French' );
register_xdays_task($currentDayRaw, 1, 0, 'level_2', 'Read' );
register_xdays_task($currentDayRaw, 2, 0, 'level_2', 'Art of Manliness Podcast' );
register_xdays_task($currentDayRaw, 1, 0, 'level_2', 'Learn' );

register_xdays_task($currentDayRaw, 1, 0, 'level_3', 'Stacked Silver' );


if ( $dayOfWeek != SATURDAY ) {
    if (!register_xdays_task($currentDayRaw, 14, 4, 'level_1', 'Clean kitchen' )) {
        register_xdays_task($currentDayRaw, 2, 1, 'level_1', 'Do dishes' );
    }
}




if ( $dayOfWeek == SUNDAY ) {
    array_push($tasks['level_1'], 'Burnable (Red)');
}

if ( $dayOfWeek == WEDNESDAY ) {
    array_push($tasks['level_1'], 'Burnable (Red)');
}

if ( $dayOfWeek == FRIDAY ) {

    if ( $dayOfWeekInstanceForMonth == 2 )
        array_push($tasks['level_1'], 'Burnable (Yellow)');

    if ( $dayOfWeekInstanceForMonth == 3 )
        array_push($tasks['level_1'], 'Burnable (Blue)');

}

if ( $dayOfWeek == SATURDAY ) {
    array_push($tasks['level_1'], 'Clean room');
}




?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>

    <title>Quik</title>

    <!-- additional styles for plugins -->
        <!-- weather icons -->
        <link rel="stylesheet" href="bower_components/weather-icons/css/weather-icons.min.css" media="all">
        <!-- metrics graphics (charts) -->
        <link rel="stylesheet" href="bower_components/metrics-graphics/dist/metricsgraphics.css">
        <!-- chartist -->
        <link rel="stylesheet" href="bower_components/chartist/dist/chartist.min.css">
    
    <!-- uikit -->
    <link rel="stylesheet" href="bower_components/uikit/css/uikit.almost-flat.min.css" media="all">

    <!-- flag icons -->
    <link rel="stylesheet" href="assets/icons/flags/flags.min.css" media="all">

    <!-- style switcher -->
    <link rel="stylesheet" href="assets/css/style_switcher.min.css" media="all">
    
    <!-- altair admin -->
    <link rel="stylesheet" href="assets/css/main.min.css" media="all">

    <!-- themes -->
    <link rel="stylesheet" href="assets/css/themes/themes_combined.min.css" media="all">

    <style>
        .no-quik,
        #sidebar_main,
        #sidebar_secondary_toggle,
        #sidebar_main_toggle {display: none!important;}
        /*.sidebar_main_open #sidebar_main_toggle {visibility: hidden;}*/
        #header_main,
        #page_content {
            margin-left: 0!important;
        }
        .quik-title {
            margin: 0;
            display: block;
            padding: 0;
            line-height: 48px;
            /*text-align: center;*/
            font-size: 22px;
            color: #5f6368;
        }
        #header_main {
            background: #fff;
            box-shadow: none;
            border-bottom: 1px solid #dadce0;
        }
        .stuffs i {
            font-size: 24px;
        }
    </style>

</head>
<body class="disable_transitions sidebar_main_open sidebar_main_swipe">
    <!-- main header -->
    <header id="header_main">
        <div class="header_main_content">
            <nav class="uk-navbar">
                <?php //if ( $dayOfWeek == SUNDAY ) { echo '<h1 class="quik-title">Rest on Sunday</h1>'; exit(); } ?>
                <h1 class="quik-title">Quik</h1>
                
            </nav>
        </div>
    </header><!-- main header end -->
    <!-- main sidebar -->

    <div id="page_content">
        <div id="page_content_inner">

            <div class="uk-grid uk-grid-width-large-1-4 uk-grid-width-medium-1-2 uk-grid-medium stuffs">
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"><i class="md-list-addon-icon clndr_today material-icons wi uk-text-primary">&#xE8DF;</i></div>
                            <span class="uk-text-muted uk-text-small"><?php echo date('F j, Y', $currentTime) ?></span>
                            <h2 class="uk-margin-remove"><?php echo date('l', $currentTime); ?></h2>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-float-right uk-margin-top uk-margin-small-right"><i class="md-list-addon-icon wi wi-day-sunny uk-text-warning"></i></div>
                            <span class="uk-text-muted uk-text-small">Fukuoka</span>
                            <h2 class="uk-margin-remove">24° Sunny</h2>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="md-card">
                        <div>
                            <div class="uk-cover uk-height-1-1" id="video_player">
                                <iframe width="100%" height="82" src="https://www.youtube.com/embed/6ChuyRIit-0" data-uk-cover frameborder="0" allowfullscreen style="max-height:82px;top:0;left: 0;transform: none;display: block;"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <span class="uk-text-muted uk-text-small">Motto</span>
                            <h2 class="uk-margin-remove">Should to Must</h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- large chart -->
            <div class="uk-grid uk-grid-width-1-1 uk-grid-width-medium-1-3 uk-grid-medium">
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-overflow-container">
                                <table class="uk-table uk-table-middle">
                                    <thead>
                                        <tr>
                                            <th class="uk-text-nowrap">Level 1</th>
                                        </tr>
                                    </thead>
                                    <tbody class="uk-text-small">
                                        <?php foreach ($tasks['level_1'] as $task) {
                                            echo "<tr><td>${task}</td></tr>";
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-overflow-container">
                                <table class="uk-table uk-table-middle">
                                    <thead>
                                        <tr>
                                            <th class="uk-text-nowrap">Level 2</th>
                                        </tr>
                                    </thead>
                                    <tbody class="uk-text-small">
                                        <?php foreach ($tasks['level_2'] as $task) {
                                            echo "<tr><td>${task}</td></tr>";
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-overflow-container">
                                <table class="uk-table uk-table-middle">
                                    <thead>
                                        <tr>
                                            <th class="uk-text-nowrap">Level 3</th>
                                        </tr>
                                    </thead>
                                    <tbody class="uk-text-small">
                                        <?php foreach ($tasks['level_3'] as $task) {
                                            echo "<tr><td>${task}</td></tr>";
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="uk-grid uk-grid-width-1-1 uk-grid-width-medium-1-4 uk-grid-medium">
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-overflow-container">
                                <table class="uk-table uk-table-middle">
                                    <thead>
                                        <tr>
                                            <th class="uk-text-nowrap">Mechanical Engineering</th>
                                        </tr>
                                    </thead>
                                    <tbody class="uk-text-small">
                                        <tr><td>1. Khan Academy</td></tr>
                                        <tr><td>2. ASVAB</td></tr>
                                        <tr><td>3. edX</td></tr>
                                        <tr><td>4. Michel van Biezen</td></tr>
                                        <tr><td>5. UTK Textbooks (Library Genesis)</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-overflow-container">
                                <table class="uk-table uk-table-middle">
                                    <thead>
                                        <tr>
                                            <th class="uk-text-nowrap">To Read</th>
                                        </tr>
                                    </thead>
                                    <tbody class="uk-text-small">
                                    <tr>
                                        <td title="Lynn F. Gunlicks">The Machiavellian Manager's Handbook for Success</td>
                                    </tr>
                                    <tr>
                                        <td>How to win friends and influence people</td>
                                    </tr>
                                    <tr>
                                        <td>The rich kid in babalon</td>
                                    </tr>
                                    <tr>
                                        <td>Autobiography of Benjamin Franklin</td>
                                    </tr>
                                    <tr>
                                        <td>The Optomist</td>
                                    </tr>
                                    <tr>
                                        <td>Instant Millionare</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-overflow-container">
                                <table class="uk-table uk-table-middle">
                                    <thead>
                                        <tr>
                                            <th class="uk-text-nowrap">Resources</th>
                                        </tr>
                                    </thead>
                                    <tbody class="uk-text-small">
                                    <tr>
                                        <td><a href="https://www.reddit.com/r/AskEngineers/" target="RedditAskEngineers">https://www.reddit.com/r/AskEngineers/</a></td>
                                    </tr>
                                    <tr>
                                        <td><a href="https://www.reddit.com/r/engineering/" target="Redditengineering">https://www.reddit.com/r/engineering/</a></td>
                                    </tr>
                                    <tr>
                                        <td><a href="https://www.reddit.com/r/EngineeringStudents/" target="RedditEngineeringStudents">https://www.reddit.com/r/EngineeringStudents/</a></td>
                                    </tr>
                                    <tr>
                                        <td><a href="https://www.reddit.com/r/malefashionadvice/" target="RedditMFA">https://www.reddit.com/r/malefashionadvice/</a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="md-card">
                        <div class="md-card-content">
                            <div class="uk-overflow-container">
                                <table class="uk-table uk-table-middle">
                                    <thead>
                                        <tr>
                                            <th class="uk-text-nowrap">Random</th>
                                        </tr>
                                    </thead>
                                    <tbody class="uk-text-small">
                                    <tr>
                                        <td>Laundry detergent</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- secondary sidebar -->
    <aside id="sidebar_secondary" class="tabbed_sidebar">
        <ul class="uk-tab uk-tab-icons uk-tab-grid" data-uk-tab="{connect:'#dashboard_sidebar_tabs', animation:'slide-horizontal'}">
            <li class="uk-active uk-width-1-3"><a href="#"><i class="material-icons">&#xE422;</i></a></li>
            <li class="uk-width-1-3 chat_sidebar_tab"><a href="#"><i class="material-icons">&#xE0B7;</i></a></li>
            <li class="uk-width-1-3"><a href="#"><i class="material-icons">&#xE8B9;</i></a></li>
        </ul>

        <div class="scrollbar-inner">
            <ul id="dashboard_sidebar_tabs" class="uk-switcher">
                <li>
                    <div class="timeline timeline_small uk-margin-bottom">
                        <div class="timeline_item">
                            <div class="timeline_icon timeline_icon_success"><i class="material-icons">&#xE85D;</i></div>
                            <div class="timeline_date">
                                09<span>Mar</span>
                            </div>
                            <div class="timeline_content">Created ticket <a href="#"><strong>#3289</strong></a></div>
                        </div>
                        <div class="timeline_item">
                            <div class="timeline_icon timeline_icon_danger"><i class="material-icons">&#xE5CD;</i></div>
                            <div class="timeline_date">
                                15<span>Mar</span>
                            </div>
                            <div class="timeline_content">Deleted post <a href="#"><strong>Eos explicabo consectetur quibusdam enim nisi ratione ut molestiae.</strong></a></div>
                        </div>
                        <div class="timeline_item">
                            <div class="timeline_icon"><i class="material-icons">&#xE410;</i></div>
                            <div class="timeline_date">
                                19<span>Mar</span>
                            </div>
                            <div class="timeline_content">
                                Added photo
                                <div class="timeline_content_addon">
                                    <img src="assets/img/gallery/Image16.jpg" alt=""/>
                                </div>
                            </div>
                        </div>
                        <div class="timeline_item">
                            <div class="timeline_icon timeline_icon_primary"><i class="material-icons">&#xE0B9;</i></div>
                            <div class="timeline_date">
                                21<span>Mar</span>
                            </div>
                            <div class="timeline_content">
                                New comment on post <a href="#"><strong>Laboriosam vitae aut modi.</strong></a>
                                <div class="timeline_content_addon">
                                    <blockquote>
                                        Vitae architecto occaecati expedita exercitationem perferendis beatae est dolor molestiae.&hellip;
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                        <div class="timeline_item">
                            <div class="timeline_icon timeline_icon_warning"><i class="material-icons">&#xE7FE;</i></div>
                            <div class="timeline_date">
                                29<span>Mar</span>
                            </div>
                            <div class="timeline_content">
                                Added to Friends
                                <div class="timeline_content_addon">
                                    <ul class="md-list md-list-addon">
                                        <li>
                                            <div class="md-list-addon-element">
                                                <img class="md-user-image md-list-addon-avatar" src="assets/img/avatars/avatar_02_tn.png" alt=""/>
                                            </div>
                                            <div class="md-list-content">
                                                <span class="md-list-heading">Bert Wintheiser</span>
                                                <span class="uk-text-small uk-text-muted">Esse fugit occaecati possimus doloribus.</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <ul class="md-list md-list-addon chat_users">
                        <li>
                            <div class="md-list-addon-element">
                                <span class="element-status element-status-success"></span>
                                <img class="md-user-image md-list-addon-avatar" src="assets/img/avatars/avatar_02_tn.png" alt=""/>
                            </div>
                            <div class="md-list-content">
                                <div class="md-list-action-placeholder"></div>
                                <span class="md-list-heading">Daniella Jacobson</span>
                                <span class="uk-text-small uk-text-muted uk-text-truncate">Et similique in.</span>
                            </div>
                        </li>
                        <li>
                            <div class="md-list-addon-element">
                                <span class="element-status element-status-success"></span>
                                <img class="md-user-image md-list-addon-avatar" src="assets/img/avatars/avatar_09_tn.png" alt=""/>
                            </div>
                            <div class="md-list-content">
                                <div class="md-list-action-placeholder"></div>
                                <span class="md-list-heading">Clementine Hand</span>
                                <span class="uk-text-small uk-text-muted uk-text-truncate">Occaecati cupiditate et.</span>
                            </div>
                        </li>
                        <li>
                            <div class="md-list-addon-element">
                                <span class="element-status element-status-danger"></span>
                                <img class="md-user-image md-list-addon-avatar" src="assets/img/avatars/avatar_04_tn.png" alt=""/>
                            </div>
                            <div class="md-list-content">
                                <div class="md-list-action-placeholder"></div>
                                <span class="md-list-heading">Yasmine Nitzsche</span>
                                <span class="uk-text-small uk-text-muted uk-text-truncate">Quas et provident.</span>
                            </div>
                        </li>
                        <li>
                            <div class="md-list-addon-element">
                                <span class="element-status element-status-warning"></span>
                                <img class="md-user-image md-list-addon-avatar" src="assets/img/avatars/avatar_07_tn.png" alt=""/>
                            </div>
                            <div class="md-list-content">
                                <div class="md-list-action-placeholder"></div>
                                <span class="md-list-heading">Malinda McClure</span>
                                <span class="uk-text-small uk-text-muted uk-text-truncate">Quis soluta.</span>
                            </div>
                        </li>
                    </ul>
                    <div class="chat_box_wrapper chat_box_small" id="chat">
                        <div class="chat_box chat_box_colors_a">
                            <div class="chat_message_wrapper">
                                <div class="chat_user_avatar">
                                    <img class="md-user-image" src="assets/img/avatars/avatar_11_tn.png" alt=""/>
                                </div>
                                <ul class="chat_message">
                                    <li>
                                        <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio, eum? </p>
                                    </li>
                                    <li>
                                        <p> Lorem ipsum dolor sit amet.<span class="chat_message_time">13:38</span> </p>
                                    </li>
                                </ul>
                            </div>
                            <div class="chat_message_wrapper chat_message_right">
                                <div class="chat_user_avatar">
                                    <img class="md-user-image" src="assets/img/avatars/avatar_03_tn.png" alt=""/>
                                </div>
                                <ul class="chat_message">
                                    <li>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem delectus distinctio dolor earum est hic id impedit ipsum minima mollitia natus nulla perspiciatis quae quasi, quis recusandae, saepe, sunt totam.
                                            <span class="chat_message_time">13:34</span>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                            <div class="chat_message_wrapper">
                                <div class="chat_user_avatar">
                                    <img class="md-user-image" src="assets/img/avatars/avatar_11_tn.png" alt=""/>
                                </div>
                                <ul class="chat_message">
                                    <li>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque ea mollitia pariatur porro quae sed sequi sint tenetur ut veritatis.
                                            <span class="chat_message_time">23 Jun 1:10am</span>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                            <div class="chat_message_wrapper chat_message_right">
                                <div class="chat_user_avatar">
                                    <img class="md-user-image" src="assets/img/avatars/avatar_03_tn.png" alt=""/>
                                </div>
                                <ul class="chat_message">
                                    <li>
                                        <p> Lorem ipsum dolor sit amet, consectetur. </p>
                                    </li>
                                    <li>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                            <span class="chat_message_time">Friday 13:34</span>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <h4 class="heading_c uk-margin-small-bottom uk-margin-top">General Settings</h4>
                    <ul class="md-list">
                        <li>
                            <div class="md-list-content">
                                <div class="uk-float-right">
                                    <input type="checkbox" data-switchery data-switchery-size="small" checked id="settings_site_online" name="settings_site_online" />
                                </div>
                                <span class="md-list-heading">Site Online</span>
                                <span class="uk-text-muted uk-text-small">Lorem ipsum dolor sit amet&hellip;</span>
                            </div>
                        </li>
                        <li>
                            <div class="md-list-content">
                                <div class="uk-float-right">
                                    <input type="checkbox" data-switchery data-switchery-size="small" id="settings_seo" name="settings_seo" />
                                </div>
                                <span class="md-list-heading">Search Engine Friendly URLs</span>
                                <span class="uk-text-muted uk-text-small">Lorem ipsum dolor sit amet&hellip;</span>
                            </div>
                        </li>
                        <li>
                            <div class="md-list-content">
                                <div class="uk-float-right">
                                    <input type="checkbox" data-switchery data-switchery-size="small" id="settings_url_rewrite" name="settings_url_rewrite" />
                                </div>
                                <span class="md-list-heading">Use URL rewriting</span>
                                <span class="uk-text-muted uk-text-small">Lorem ipsum dolor sit amet&hellip;</span>
                            </div>
                        </li>
                    </ul>
                    <hr class="md-hr">
                    <h4 class="heading_c uk-margin-small-bottom uk-margin-top">Other Settings</h4>
                    <ul class="md-list">
                        <li>
                            <div class="md-list-content">
                                <div class="uk-float-right">
                                    <input type="checkbox" data-switchery data-switchery-size="small" data-switchery-color="#7cb342" checked id="settings_top_bar" name="settings_top_bar" />
                                </div>
                                <span class="md-list-heading">Top Bar Enabled</span>
                                <span class="uk-text-muted uk-text-small">Lorem ipsum dolor sit amet&hellip;</span>
                            </div>
                        </li>
                        <li>
                            <div class="md-list-content">
                                <div class="uk-float-right">
                                    <input type="checkbox" data-switchery data-switchery-size="small" data-switchery-color="#7cb342" id="settings_api" name="settings_api" />
                                </div>
                                <span class="md-list-heading">Api Enabled</span>
                                <span class="uk-text-muted uk-text-small">Lorem ipsum dolor sit amet&hellip;</span>
                            </div>
                        </li>
                        <li>
                            <div class="md-list-content">
                                <div class="uk-float-right">
                                    <input type="checkbox" data-switchery data-switchery-size="small" data-switchery-color="#d32f2f" id="settings_minify_static" checked name="settings_minify_static" />
                                </div>
                                <span class="md-list-heading">Minify JS files automatically</span>
                                <span class="uk-text-muted uk-text-small">Lorem ipsum dolor sit amet&hellip;</span>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        <button type="button" class="chat_sidebar_close uk-close"></button>
        <div class="chat_submit_box">
            <div class="uk-input-group">
                <input type="text" class="md-input" name="submit_message" id="submit_message" placeholder="Send message">
                <span class="uk-input-group-addon">
                    <a href="#"><i class="material-icons md-24">&#xE163;</i></a>
                </span>
            </div>
        </div>

    </aside>
    <!-- secondary sidebar end -->

    <!-- google web fonts -->
    <script>
        WebFontConfig = {
            google: {
                families: [
                    'Source+Code+Pro:400,700:latin',
                    'Roboto:400,300,500,700,400italic:latin'
                ]
            }
        };
        (function() {
            var wf = document.createElement('script');
            wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
            '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
            wf.type = 'text/javascript';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
        })();
    </script>

    <!-- common functions -->
    <script src="assets/js/common.min.js"></script>
    <!-- uikit functions -->
    <script src="assets/js/uikit_custom.min.js"></script>
    <!-- altair common functions/helpers -->
    <script src="assets/js/altair_admin_common.min.js"></script>

    <!-- page specific plugins -->
        <!-- d3 -->
        <script src="bower_components/d3/d3.min.js"></script>
        <!-- metrics graphics (charts) -->
        <script src="bower_components/metrics-graphics/dist/metricsgraphics.min.js"></script>
        <!-- chartist (charts) -->
        <script src="bower_components/chartist/dist/chartist.min.js"></script>
        <!-- maplace (google maps) -->
        <script src="https://maps.google.com/maps/api/js?key=AIzaSyC2FodI8g-iCz1KHRFE7_4r8MFLA7Zbyhk"></script>
        <script src="bower_components/maplace-js/dist/maplace.min.js"></script>
        <!-- peity (small charts) -->
        <script src="bower_components/peity/jquery.peity.min.js"></script>
        <!-- easy-pie-chart (circular statistics) -->
        <script src="bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
        <!-- countUp -->
        <script src="bower_components/countUp.js/dist/countUp.min.js"></script>
        <!-- handlebars.js -->
        <script src="bower_components/handlebars/handlebars.min.js"></script>
        <script src="assets/js/custom/handlebars_helpers.min.js"></script>
        <!-- CLNDR -->
        <script src="bower_components/clndr/clndr.min.js"></script>

        <!--  dashbord functions -->
        <script src="assets/js/pages/dashboard.min.js"></script>
</body>
</html>