<?php require_once('app-system/initialize.php'); ?>
<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7 ]> <html class="ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="lt-ie10" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> 
<html lang="en"> <!--<![endif]-->
    <head>
        <meta name="generator" content="Bootply" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Game-choose</title>
        <link rel="icon" type="image/png" href="http://havasww.id/beta/assets/icon/favicon.png">
        <link href="css/foundation.css" rel="stylesheet" type="text/css" />
        <link href="css/twentytwenty.css" rel="stylesheet" type="text/css" />
        <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
        <link href="css/style.css" rel="stylesheet">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="js/ion.sound.js"></script>
        <script src="js/jquery.event.move.js"></script>
        <!--script src="js/jquery.twentytwenty.js"></script-->
        

        <script type="text/javascript" src="./js/jquery-1.8.2.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <?php
			if ($_SERVER['HTTP_HOST'] == "localhost")
			{
				$appId = '1663655567234397';
			}
			else
			{
				$appId = '620471018092087';
			}
		?>
        <script>
            (function(d, s, id) {
            // this is sound play
                ion.sound({
                    sounds: [
                        {name: "backsound"},
                        {name: "beer_opening"},
                        {name: "beep"},
                        {name: "WrongClick"}
                    ],
                    path: "sounds/",
                    preload: true,
                    volume: 1.0
                });
            // ----
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.5&appId=<?php echo $appId;?>";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));

            var currentScore = 0; //this is variabel score
            // ----
            function statusChangeCallback(response) {
                
                console.log('statusChangeCallback');
                console.log(response);
                
                // The response object is returned with a status field that lets the
                // app know the current login status of the person.
                // Full docs on the response object can be found in the documentation
                // for FB.getLoginStatus().
                if (response.status === 'connected') {
                  // Logged into your app and Facebook.
                    console.log('test');
                  // testAPI();
                    
                         FB.api('/me', {fields: 'gender,email,age_range'}, function(response) {
                             console.log(response);
                             console.log({fields: 'gender,email,age_range'});

                         });
                    
                } else if (response.status === 'not_authorized') {
                  // The person is logged into Facebook, but not your app.
                  document.getElementById('status').innerHTML = 'Please log ' +
                    'into this app.';
                    console.log('test cancel');
                } else {
                    
                  // The person is not logged into Facebook, so we're not sure if
                  // they are logged into this app or not.
                    FB.login(function(response) {
                        if (response.authResponse) {
                         FB.api('/me', {fields: 'gender,email,age_range'}, function(response) {
                             console.log(response);
                         });
                        } else {
                         console.log('User cancelled login or did not fully authorize.');
                        }
                    }, { scope: 'email,gender,public_profile' }); console.log({ scope: 'email,gender,public_profile' });
                }
            }

            function checkLoginState() {
                
                FB.getLoginStatus(function(response) {
                    statusChangeCallback(response);

                    console.log('login success');
                    $('.containers').addClass('hidden-btn');
                    $('.containers-play').removeClass('hidden-btn');
                    //scope: 'public_profile,email,user_friends' // Need user_friends permission to use taggable_friends later
                    //console.log(scope);
                });

                FB.logout(function(response) {
                    // Person is now logged out
                    console.log('this is logout');
                });
            }

        <!-- //ends -->

            
            $(function(){
                var heightScore = 0;
				var pointFormat = [];
				var temparray   = [];
				var i,j,arrayCut  = 4;
				var currentValue  = [0,1,2,3];
				var currentLength = currentValue.length;
				var currentLimit  = 20;
				var randomValue   = 20;
				
				while(0 !== currentLimit)
				{
					var ImageSort = currentLength, currentTmp, currentRand;
					while(0 !== ImageSort)
					{
						currentRand = Math.floor(Math.random() * ImageSort);
						ImageSort -= 1;
						currentTmp = currentValue[ImageSort];
						currentValue[ImageSort] = currentValue[currentRand];
						currentValue[currentRand] = currentTmp;		
						temparray.unshift(currentValue[ImageSort]);
					}
					currentLimit -= 1;
				}

				for (i=0,j=temparray.length; i<j; i+=arrayCut) 
				{
					pointFormat.push(temparray.slice(i,i+arrayCut));
				}
				
				
				
                $('#current-score-value').append(currentScore);
                
				console.log(pointFormat);
				var randLimit = pointFormat.length-1;
				
                $(document).on("click", "#satu", function(){
                    console.log('sound');
                    ion.sound.play("beep");
                    // --
                    console.log(currentScore);
                    currentScore++;
					
					console.log(randLimit);
					var level = parseInt(randomValue) - parseInt(randLimit);
					console.log(level);
					console.log(pointFormat[randLimit]);
					sortImage(pointFormat[randLimit]);
					randLimit -= 1;
					
                    $('#current-score-value').html(currentScore);
                    
                });

                // ------------------
                //if wrong click to images
                
                $(document).on("click", ".wrong-click", function(){
                    console.log('sound');
                    ion.sound.play("WrongClick");
                    alert('wrong click');
                });

                // this is random images

                console.log(pointFormat[randLimit]);
                sortImage(pointFormat[randLimit]);
				
                function sortImage(formasiImage)
				{
                    var r = ['<img id="satu" class="img-play-pizza" src="./images/img-play-pizza1.jpg">','<img  class="img-play-pizza wrong-click" src="./images/img-play-pizza2.jpg">','<img class="img-play-pizza wrong-click" src="./images/img-play-pizza3.jpg">','<img class="img-play-pizza wrong-click" src="./images/img-play-pizza4.jpg">'];
                    $(".box_1").html(r[formasiImage[0]]);
                    $(".box_2").html(r[formasiImage[1]]);
                    $(".box_3").html(r[formasiImage[2]]);
                    $(".box_4").html(r[formasiImage[3]]);
                }
                
                function shuffle(array) {
                    var currentIndex = array.length, temporaryValue, randomIndex ;
                    while (0 !== currentIndex) {
                    randomIndex = Math.floor(Math.random() * currentIndex);
                    currentIndex -= 1;
                    temporaryValue = array[currentIndex];
                    array[currentIndex] = array[randomIndex];
                    array[randomIndex] = temporaryValue;
                    }

                    return array;
                }

            });

            // time countdown and play

            var count;
            var counter;

            function resetEverything()
            {
                $('#counter, #myButton03').hide();
                $('#myButton02').removeClass('hidden-btn');
                clearInterval(counter); 

                
            }


            function timeout(){
                console.log('timeout');
                ion.sound.play("WrongClick");
                alert('time is over');
                $('#myButton03').show();
                $('.div-img-pizza').addClass('hidden-btn');
            }

            $(document).ready(function(){
                

                resetEverything();
                $('#myButton02').click(function(){
                    console.log('test stop');
                    ion.sound.play("beer_opening");
                    //reset score
                    console.log("refresh click");
                    currentScore = 0;
                    $('#current-score-value').html(currentScore);
                    
                    $('#myButton02').addClass('hidden-btn');
                    // $('#myButton03').show();
                    $('#counter').animate({width: 'toggle'});
                    $('.div-img-pizza').removeClass('hidden-btn');
                    count=10;
                    counter=setInterval(timer, 1000);
                    function timer(){
                        count=count-1;
                        if (count <= 0){
                            clearInterval(counter);
                            return;  
                        }
                    document.getElementById("secs").innerHTML=count + " secs.";
                    }

                });


                $('#myButton03').click(function(){
                    ion.sound.play("beer_opening");
                    resetEverything();
                   
                    $('#myButton02').removeClass('hidden-btn');
                });
            });

            <!-- //ends -->
           
        </script>
    </head>
    
    
    <body style="background-color:#6A080C;">
    <audio id="audio" src="./sounds/backsound.mp3" autoplay="autoplay" hidden="hidden"></audio>
    <div id="con" class="containers">
        <div class="box">
            <span class="span">
                <p class="p">choose to play the game</p>
                <p>Please to..</p>
            </span>
            <!-- <button class="fb-login-button" data-max-rows="5" data-size="medium" data-show-faces="false" data-auto-logout-link="true">Login</button> -->
            <!-- <div class="fb-login-button btnlogin" data-max-rows="10" data-size="xlarge" data-show-faces="false" data-auto-logout-link="true">sign in with facebook</div> -->
            <fb:login-button scope="public_profile,email" onlogin="checkLoginState();"  data-max-rows="10" data-size="xlarge" data-show-faces="false" data-auto-logout-link="true">sign in with facebook</fb:login-button>

            <!-- <div id="fb-root"></div> -->
            
        </div>
    </div>

    <div class="containers-play hidden-btn">
        <div class="box-play">
            <div>
                <div class="head-content">
                    <button id="myButton02" class="btn-start" onclick="setTimeout(timeout, 10000);">play</button>
                    <button id="myButton03" class="btn-start">stop</button>
                    <div id="counter" class="countdown">your time is only 10 seconds..<span id="secs" /></div>
                    <div><span style="color:#fff;">score: <span id="current-score-value" style="font-size:20px;color:#E33225;font-weight:bold;"></span></span></div>
                </div>
                <!-- /// -->
                <div class="container-img">
                    <div class="div-img-pizza box_1 hidden-btn"></div>
                    <div class="div-img-pizza box_2 hidden-btn"></div>
                    <div class="div-img-pizza box_3 hidden-btn"></div>
                    <div class="div-img-pizza box_4 hidden-btn"></div>
                </div>
                <div class="score hidden-btn">
                   
                </div>
            </div>
        </div>
    </div>
</body>
</html>
