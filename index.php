<?php

error_reporting(E_ALL);
ini_set("display_erros", 1);
require_once(dirname(__FILE__) . '/SharedLibraries/KooappsUtils.php');
require_once(dirname(__FILE__) . '/SharedLibraries/kaCurlWrapper.php');
require_once(dirname(__FILE__) . '/applicationlib/utils.php');

try
{
	$request = array(
		'appName' => 'marketing.kooappswebsite',
		'flight' => 'live',
		'version' => '1.0',
		'udid' => 'kooappswebsite',
	);
	
	$request['hash'] = generateHash($request, $request['udid']);
	$url = generateRequestUrl('http://www.kooappsservers.com/kooappsFlights/getData.php', $request);
	$response = kaCurlGet($url, 30, 'Content-Type: application/plain');

	$response = str_replace(';;;;', ';;;', $response);
	$keyvalue = array_map('trim', explode(";;;", $response));
	
	// Verify response
	($keyvalue[0] === 'status=ok') || die('invalid response from flights');
	(strpos($keyvalue[1], 'flight=') === 0) || die('invalid response from flights');
	($keyvalue[1] === $keyvalue[count($keyvalue) - 1]) 
		|| ($keyvalue[1] === $keyvalue[count($keyvalue) - 2]) 
		|| die('invalid response from flights');
	
	// Data to objects
	$websiteData = convertResponseKVToStructuredObject($keyvalue);
} catch (Exception $e) {
	// Email error to admin : )
	echo $e;
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title> Kooapps Website Kooapps | Make games we wanna show our friends</title>
    <meta name="description" content="Kooapps Website">
    <meta name="author" content="Ian Buena">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="icon" type="image/png" href="assets/favicon/faviconKooapps_x2.png" />

    <!-- jQuery import -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- handlebars import -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/handlebars.js/2.0.0-alpha.4/handlebars.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

    <!-- temporary javascrip code -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.2/fastclick.js"></script>

    <!-- Optional theme -->
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="flexslider.css">
    <script src="scripts/scrollPlugin.js"></script>
    <script src="scripts/hiringScript.js"></script>
    <script src="scripts/faqsScript.js"></script>
    <script src="scripts/contactus.js"></script>
    <script src="scripts/floatingnav.js"></script>

    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

<body>
    <div id="main-wrapper" class="wrapper">
        <div id="home" class="row">
            <div class="relativeWrapper">
                <div id="homeBackground1" class="absoluteWrapper">
                </div>
                <div id="homeBackground2" class="absoluteWrapper">
                </div>
                <div id="homeBackground3" class="absoluteWrapper">
                </div>
                <div id="homeBackground4" class="absoluteWrapper">
                </div>
                <div id="weblogo" class="absoluteWrapper">
                    <img src="assets/home/kooappsLogo.png" />
                </div>
                <div id="hiringButtonContainer" class="absoluteWrapper">
                    <a href="#hiring"><img src="assets/home/hiringButton.png" onmousedown="this.src='assets/home/hiringButton_p.png'" onmouseup="this.src='assets/home/hiringButton.png'" onmouseout="this.src='assets/home/hiringButton.png'"/></a>
                </div>
                <div id="contactUsButtonContainer" class="absoluteWrapper">
                    <a href="#contactus"><img src="assets/home/contactUsButton.png" onmousedown="this.src='assets/home/contactUsButton_p.png'" onmouseup="this.src='assets/home/contactUsButton.png'" onmouseout="this.src='assets/home/contactUsButton.png'" /></a>
                </div>
                <div id="gamesButtonContainer" class="absoluteWrapper">
                    <a href="#games"><img src="assets/home/gamesButton.png" onmousedown="this.src='assets/home/gamesButton_p.png'" onmouseup="this.src='assets/home/gamesButton.png'" onmouseout="this.src='assets/home/gamesButton.png'; "/></a> 
                </div>
                <div id="faqsButtonContainer" class="absoluteWrapper">
                    <a href="#faqs"><img src="assets/home/faqsButton.png" onmousedown="this.src='assets/home/faqsButton_p.png'" onmouseup="this.src='assets/home/faqsButton.png'" onmouseout="this.src='assets/home/faqsButton.png'" /></a>
                </div>
                <div id="aboutButtonContainer" class="absoluteWrapper">
                    <a href="#about"><img src="assets/home/aboutButton.png" onmousedown="this.src='assets/home/aboutButton_p.png'" onmouseup="this.src='assets/home/aboutButton.png'" onmouseout="this.src='assets/home/aboutButton.png'" /></a>
                </div>
                <div id="tileMidBg" class="absoluteWrapper">
                    <img src="assets/home/tileMidBG-home.png" />
                </div> 
                <div id="bannerContainer" class="absoluteWrapper">
                    <div class="flexslider">
                        <ul class="slides">
                            <?php
                                foreach ($websiteData['banners'] as $banner)
                                {
                                    echo '<li>';
                                    echo '<a href="' . urldecode($banner['clickurl']) . '" target="_blank">';
                                    echo '<img src="' . urldecode($banner['asseturl']) . '" class="bannerImage" />';
                                    echo '</a>';
                                    echo '</li>';
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div><!-- End of nav bar -->
        <div id="games" class="row">
            <div id="gamesContainer" class="relativeWrapper">
                <div id="gamesBackground1" class="absoluteWrapper">
                </div>
                <div id="gamesBackground2" class="absoluteWrapper">
                </div>
                <div id="gamesTitle" class="absoluteWrapper title">
                    <img src="assets/games/gamesTitle.png" />
                </div>
                <div id="gamesChickNeck" class="absoluteWrapper">
                    <img src="assets/games/tileMidBG2-games.png" />
                </div>
                <div id="ipad" class="absoluteWrapper centeredAsset">
                    <img src="assets/games/ipad.png" />
                </div>
                <div id="birdDecor" class="absoluteWrapper">
                    <img src="assets/games/birdDecor.png" />
                </div>
                <div id="appContainerWrapper" class="absoluteWrapper">
                    <div id="appsContainer" class="container">

                    <?php
                    $array_games = array();
                    foreach ($websiteData['games'] as $games)
                    {
                        array_push($array_games, $games);
                    }

                    foreach (array_chunk($array_games, 3) as $row_games) {
                        echo '<div class="row">';
                        foreach ($row_games as $app) {
                            echo '<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">';
                            echo '<a href="' . urldecode($app['clickurl']) . '" target="_blank">';
                            echo '<img src="http://' . urldecode($app['icon']) . '" class="gamesIcon" />';
                            echo '<img src="assets/games/appstore2.png" class="appStoreImage" />';
                            echo '</a>';
                            echo '</div>';
                        }
                        echo '</div>';
                    }

                    ?>
                    </div>
                </div>
                <div id="floatingnav" class="absoluteWrapper">
                    <a href="#home"><img src="assets/floatingnav/homeSectionButton.png" /></a>
                    <a href="#games"><img src="assets/floatingnav/gamesSectionButton.png" /></a>
                    <a href="#faqs"><img src="assets/floatingnav/faqsSectionButton.png" /></a>
                    <a href="#contactus"><img src="assets/floatingnav/contactUsSectionButton.png" /></a>
                    <a href="#hiring"><img src="assets/floatingnav/hiringSectionButton.png" /></a>
                    <a href="#about"><img src="assets/floatingnav/aboutSectionButton.png" /></a>
                </div>
                <div id="tileMidBgGames" class="absoluteWrapper">
                    <div class="relativeWrapper">
                        <img src="assets/games/tileMidBG-games2.png" />
                    </div>
                </div>
            </div>
        </div><!-- End of games row -->
        <div id="faqs" class="row">
            <div id="faqsContainer" class="relativeWrapper">
                <div id="faqsBackground1" class="absoluteWrapper">
                </div>
                <div id="faqsBackground2" class="absoluteWrapper">
                </div>
                <div id="faqsTitle" class="absoluteWrapper title">
                    <img src="assets/faqs/faqsTitle.png" />
                </div>
                <div id="faqsBirdDecor" class="absoluteWrapper">
                    <img src="assets/faqs/birdDecor-faqs.png" />
                </div>
                <div id="faqsContainer2" class="absoluteWrapper">
                    <?php
                        $tempArray = array();
                        foreach ($websiteData['faqs'] as $faqs) {
                            if(!in_array($faqs['appkey'], $tempArray, true)) {
                                array_push($tempArray, $faqs['appkey']);
                            }
                        }
                    ?>
                    <div id="appIcons">
                        <?php
                            foreach ($tempArray as $appKey) {
                                echo '<div id="' . str_replace('.','',$appKey) . 'Tab" class="appTab inactiveFaq">';
                                echo '<img src="' . getLinkIcon($websiteData['games'], $appKey). '" style="width: 63px; height: 62px;" />';
                                echo '</div>';
                            }
                        ?>
                    </div>
                    <div id="faqsTextContainer">
                        <?php
                            foreach ($tempArray as $appKey) {
                                echo '<div id="' . str_replace('.','', $appKey) . 'Content" class="faqsScrollContainer">';
                                if ($appKey == "general") {
                                    echo '<h3>Privacy</h3>';
                                    foreach ($websiteData['faqs'] as $faqs) {
                                        if (($faqs['appkey'] == $appKey) && ($faqs['section'] == "Privacy")) {
                                            echo '<h4>' . $faqs['question'] . "</h4>";
                                            echo '<p>' . $faqs['answer'] . '</p><br />';
                                        }
                                    }
                                }
                                echo '<h3>Frequently Asked Questions</h3>';
                                foreach ($websiteData['faqs'] as $faqs) {
                                    if (($faqs['appkey'] == $appKey) && ($faqs['section'] == "Frequently Asked Questions")) {
                                        echo '<h4>' . $faqs['question'] . "</h4/>";
                                        echo "<p>" . $faqs['answer'] . "</p><br />";
                                    }
                                }
                                echo '</div>';
                            }
                        ?>
                    </div>
                </div>
                <div id="floatingnav" class="absoluteWrapper">
                    <a href="#home"><img src="assets/floatingnav/homeSectionButton.png" /></a>
                    <a href="#games"><img src="assets/floatingnav/gamesSectionButton.png" /></a>
                    <a href="#faqs"><img src="assets/floatingnav/faqsSectionButton.png" /></a>
                    <a href="#contactus"><img src="assets/floatingnav/contactUsSectionButton.png" /></a>
                    <a href="#hiring"><img src="assets/floatingnav/hiringSectionButton.png" /></a>
                    <a href="#about"><img src="assets/floatingnav/aboutSectionButton.png" /></a>
                </div>
                <div id="tileMidBgFAQs" class="absoluteWrapper tileMidBg">
                    <div class="relativeWrapper">
                        <img src="assets/faqs/tileMidBG-faqs2.png" />
                    </div>
                </div>
            </div>
        </div> <!-- end of faqs -->
        <div id="contactus" class="row">
            <div id="contactusContainer" class="relativeWrapper">
                <div id="contactusBackground1" class="absoluteWrapper">
                </div>
                <div id="extraImage" class="absoluteWrapper">
                    <img src="assets/contact us/tileEndRightBG-contactUs4.png" />
                </div>
                <div id="contactusTitle" class="absoluteWrapper title">
                    <img src="assets/contact us/contactUsTitle.png" />
                </div>
                <div id="contactusMonitor" class="absoluteWrapper">
                    <img src="assets/contact us/monitor.png" />
                </div>
                <div id="tileMidBgContactus" class="absoluteWrapper tileMidBg">
                    <div class="relativeWrapper">
                        <img src="assets/contact us/tileMidBG-contactUs2.png" />
                    </div>
                </div>
                <div id="contactusFormContainer" class="absoluteWrapper">
                    <div class="relativeWrapper">
                        <div id="emailTitleContainer" class="absoluteWrapper">
                            <img src="assets/contact us/emailTitle.png" />
                        </div>
                        <div id="formContainer" class="absoluteWrapper">
                            <form class="form-horizontal" action="">
                                <div class="form-group">
                                    <label for="inputName" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 control-label">NAME</label>
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                        <input type="text" class="form-control" id="inputName">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 control-label">EMAIL</label>
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                        <input type="email" class="form-control" id="inputEmail">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputSubject" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 control-label">SUBJECT</label>
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                        <input type="text" class="form-control" id="inputSubject">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputComment" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 control-label">Comment</label>
                                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                        <textarea id="inputComment" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-offset-9 col-sm-offset-9 col-md-offset-9 col-lg-offset-9 col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <input id="formSubmitButton" type="image" class="form-control" src="assets/contact us/sendButton.png" alt="Send" onmousedown="this.src='assets/contact us/sendButton_p.png'" onmouseup="this.src='assets/contact us/sendButton.png'" onmouseout="this.src='assets/contact us/sendButton.png'" value="Submit"/>
                                    </div>
                                </div>
                            </form>
                        </div><!-- end of contact form -->
                        <div id="twitterFacebook" class="absoluteWrapper">
                            <div id="twitterFacebookContainer" class="relativeWrapper">
                                <div id="youCanAlsoText" class="absoluteWrapper"><p>YOU CAN ALSO REACH US HERE</p></div>
                                <div id="twitterButton" class="absoluteWrapper"><a href="https://twitter.com/kooapps" target="_blank"><img src="assets/contact us/twitterButton.png" onmousedown="this.src='assets/contact us/twitterButton_p.png'" onmouseup="this.src='assets/contact us/twitterButton.png'" onmouseout="this.src='assets/contact us/twitterButton.png'" /></a></div>
                                <div id="facebookButton" class="absoluteWrapper"><a href="https://facebook.com/Kooapps" target="_blank"><img src="assets/contact us/fbButton.png" onmousedown="this.src='assets/contact us/fbButton_p.png'" onmouseup="this.src='assets/contact us/fbButton.png'" onmouseout="this.src='assets/contact us/fbButton.png'" /></a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="floatingnav" class="absoluteWrapper">
                    <a href="#home"><img src="assets/floatingnav/homeSectionButton.png" /></a>
                    <a href="#games"><img src="assets/floatingnav/gamesSectionButton.png" /></a>
                    <a href="#faqs"><img src="assets/floatingnav/faqsSectionButton.png" /></a>
                    <a href="#contactus"><img src="assets/floatingnav/contactUsSectionButton.png" /></a>
                    <a href="#hiring"><img src="assets/floatingnav/hiringSectionButton.png" /></a>
                    <a href="#about"><img src="assets/floatingnav/aboutSectionButton.png" /></a>
                </div>
            </div>
        </div> <!-- end of contact us -->
        <div id="hiring" class="row">
            <div id="hiringContainer" class="relativeWrapper">
                <div id="hiringTitle" class="absoluteWrapper title">
                    <img src="assets/hiring/hiringTitle.png" />
                </div>
                <div id="tabContainer" class="absoluteWrapper">
                    <img src="assets/hiring/weAreHiringTab.png" />
                </div>
                <div id="hiringTabs" class="relativeWrapper">
                    <a><div id="homeHiring" class="absoluteWrapper hiringTab"></div></a>
                    <a><div id="phHiring" class="absoluteWrapper hiringTab"></div></a>
                    <a><div id="twHiring" class="absoluteWrapper hiringTab"></div></a>
                </div>
                <div id="tabContentContainer" class="absoluteWrapper">
                    <div class="relativeWrapper">
                        <div id="homeTabContent" class="absoluteWrapper" >
                            <p>Make games we want to show our friends.<br /><br />
                            Build a new software brand name.<br /><br />
                            Explore unlimited posibilities.<br /><br />
                            Join the team!
                            </p>
                        </div>
                        <div id="phTabContent" class="absoluteWrapper hide">
                            <div class="relativeWrapper">
                                <div id="mobileGameDeveloperImage" class="absoluteWrapper">
                                    <img src="assets/hiring/mobileGameDevPHSticker.png" />
                                </div>
                                <div id="graphicDesignerImage" class="absoluteWrapper">
                                    <img src="assets/hiring/graphicDesignerPHSticker.png" />
                                </div>
                                <div id="p1" class="absoluteWrapper paragraph1">
                                    <p>Send your resume to</p>
                                </div>
                                <div id="p2" class="absoluteWrapper paragraph2">
                                    <p>jobs@kooapps.com</p>
                                </div>
                            </div>
                        </div>
                        <div id="twTabContent" class="absoluteWrapper hide">
                            <div class="relativeWrapper">
                                <div id="twMobileGameDeveloperImage" class="absoluteWrapper">
                                    <img src="assets/hiring/mobileGameDevTWSticker.png" />
                                </div>
                                <div id="twP1" class="absoluteWrapper paragraph1">
                                    <p>Send your resume to</p>
                                </div>
                                <div id="twP2" class="absoluteWrapper paragraph2">
                                    <p>jobs-tw@kooapps.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="floatingnav" class="absoluteWrapper">
                    <a href="#home"><img src="assets/floatingnav/homeSectionButton.png" /></a>
                    <a href="#games"><img src="assets/floatingnav/gamesSectionButton.png" /></a>
                    <a href="#faqs"><img src="assets/floatingnav/faqsSectionButton.png" /></a>
                    <a href="#contactus"><img src="assets/floatingnav/contactUsSectionButton.png" /></a>
                    <a href="#hiring"><img src="assets/floatingnav/hiringSectionButton.png" /></a>
                    <a href="#about"><img src="assets/floatingnav/aboutSectionButton.png" /></a>
                </div>
            </div>
        </div><!-- end of hiring -->
        <div id="about" class="row">
            <div id="aboutContainer" class="relativeWrapper">
                <div id="aboutTitle" class="absoluteWrapper title">
                    <img src="assets/about/aboutTitle.png" />
                </div>
                <div id="worldMap" class="absoluteWrapper centeredAsset">
                    <img src="assets/about/worldMap.png" />
                </div>
                <div id="kooappsUS" class="absoluteWrapper">
                    <img src="assets/about/kooappsIconUS.png" />
                </div>
                <div id="kooappsTW" class="absoluteWrapper">
                    <img src="assets/about/kooappsIconTW.png" />
                </div>
                <div id="kooappsPH" class="absoluteWrapper">
                    <img src="assets/about/kooappsIconPH.png" />
                </div>
                <div id="kooappsUSTextBubble" class="absoluteWrapper textBubble">
                    <div id="USFacebook" class="row"><a href="https://facebook.com/Kooapps" target="_blank"><img src="assets/about/fbIcon.png" />facebook.com/Kooapps</a></div>
                    <div id="USTwitter" class="row"><a href="https://twitter.com/kooapps" target="_blank"><img src="assets/about/twitterIcon.png" />twitter.com/kooapps</a></div>
                </div>
                <div id="kooappsTWTextBubble" class="absoluteWrapper textBubble">
                </div>
                <div id="kooappsPHTextBubble" class="absoluteWrapper textBubble">
                    <div id="PHFacebook" class="row"><a href="https://facebook.com/KooappsPhilippines" target="_blank"><img src="assets/about/fbIcon.png" />facebook.com/KooappsPhilippines</a></div>
                    <div id="PHTwitter" class="row"><a href="https://twitter.com/kooapps" target="_blank"><img src="assets/about/twitterIcon.png" />twitter.com/kooapps</a></div>
                </div>
                <div id="kooappsDescription" class="absoluteWrapper">
                    <!--<p><span class="descriptionBold">KOOAPPS</span> is a mobile gaming company with over 20 million downloads. Founded in 2008, Kooapps has released more than 20 games with several titles in iTunes Top 10. Its co-founders went to school at Standford University and have worked at top software and entertainment companies such as Microsoft, Dreamworks and PlayFirst. We are really focused on making the best games in the world and our dream is to be the first globally successful gaming brand in Asia. Join us on this Journey!</p>-->
                    <p><span class="decriptionBold">KOOAPPS</span> is a mobile gaming company with millions of downloads. Founded in 2008, Kooapps has released more than 30 games with several top selling titles. We are here to make games we want to show our friends and our dream is to be the first globally successful gaming brand in Asia. Join us on this journey!"</p>
                </div>
                <div id="floatingnav" class="absoluteWrapper">
                    <a href="#home"><img src="assets/floatingnav/homeSectionButton.png" /></a>
                    <a href="#games"><img src="assets/floatingnav/gamesSectionButton.png" /></a>
                    <a href="#faqs"><img src="assets/floatingnav/faqsSectionButton.png" /></a>
                    <a href="#contactus"><img src="assets/floatingnav/contactUsSectionButton.png" /></a>
                    <a href="#hiring"><img src="assets/floatingnav/hiringSectionButton.png" /></a>
                    <a href="#about"><img src="assets/floatingnav/aboutSectionButton.png" /></a>
                </div>
                <div id="leftFooter" class="absoluteWrapper">
                    <p>Help us improve our website? Email <a href="mailto:info@kooapps.com" target="_top">info@kooapps.com</a> with your feedback</p>
                </div>
                <div id="rightFooter" class="absoluteWrapper">
                    <p>Copyright &copy; 2008-2014</p>
                </div>
            </div>
        </div><!-- end of about -->
    </div>
    <pre>
        <?php var_dump($websiteData); ?>
    </pre>

    <!-- flexslider script -->
    <script defer src="scripts/jquery.flexslider-min.js"></script>
    <script type="text/javascript">
        $(window).load(function() {
            $('.flexslider').flexslider({
                animation: "slide",
            });
        });
    </script>
</body>
</html>
