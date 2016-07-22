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
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/styles.css" rel="stylesheet">

        <script type="text/javascript" src="./js/jquery-1.8.2.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        
        <script>
            (function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.5&appId=620471018092087";
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
                    $('.containers').addClass('hide');
                    $('.containers-play').removeClass('hide');
                    
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
                $('#myButton02').removeClass('hide');
                clearInterval(counter); 

                
            }


            function timeout(){
                console.log('timeout');
                alert('time is over');
                $('#myButton03').removeClass('hide');
                $('.div-img-pizza').addClass('hide');
            }

            $(document).ready(function(){
                resetEverything();
                $('#myButton02').click(function(){

                    //reset score
                    console.log("refresh click");
                    currentScore = 0;
                    $('#current-score-value').html(currentScore);
                    
                    $('#myButton02').addClass('hide');
                    $('#myButton03').show();
                    $('#counter').animate({width: 'toggle'});
                    $('.div-img-pizza').removeClass('hide');
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
                    resetEverything();
                    // reset score
                    // console.log("refresh click");
                    // currentScore = 0;
                    // $('#current-score-value').html(currentScore);
                    // $('#myButton03').animate({
                    //     transform: "rotate(-360deg)"
                    // }, 500);

                    $('#myButton02').removeClass('hide');
                });
            });

            <!-- //ends -->
              
        </script>
    </head>
    <style type="text/css">
       .hide{
            display: none;
       }
        #header {
            transition: all 1500ms;
        }

        .containers{
            border: 0px solid rgba(0,0,0,.5);
            width: 100%;
            height: 200px;
            position: fixed;
            top: 200px;
            left: 0;
            margin-left: 0px;
            text-align: center;
            padding: 0px;
            /*background-color: blue;*/
        }
        .box{   
            text-align: center;
            vertical-align: middle;
            border: 0px solid #6A080C;
        }

       
        /*containers play and box*/

        .containers-play{
            /*background-color: blue;*/
            border:0px solid rgba(0,0,0,.5);
            width: 500px;
            height: 200px;
            position: fixed;
            top: 100px;
            left: 50%;
            margin-left: -240px;
            text-align: center;
            padding:40px;
            display: table;
        }

        .box-play{   
            /*background-color: #fff;*/
            display: table-cell;
            text-align: center;
            vertical-align: middle;
            border:0px solid #6A080C;
        }

        .container-img{
            padding: 15px;
        }
        .div-img-pizza{
            float: left;
            margin:2px;
        }

        .img-play-pizza{
            width: 180px;
            
        }

        .countdown{
            color: #E33225;
            font-size: 20px;
        }
        /* this is button start*/
        .btn-start {
            -moz-box-shadow:inset 0px 1px 0px 0px #f5978e;
            -webkit-box-shadow:inset 0px 1px 0px 0px #f5978e;
            box-shadow:inset 0px 1px 0px 0px #f5978e;
            background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #f24537), color-stop(1, #c62d1f) );
            background:-moz-linear-gradient( center top, #f24537 5%, #c62d1f 100% );
            filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#f24537', endColorstr='#c62d1f');
            background-color:#f24537;
            -webkit-border-top-left-radius:20px;
            -moz-border-radius-topleft:20px;
            border-top-left-radius:20px;
            -webkit-border-top-right-radius:20px;
            -moz-border-radius-topright:20px;
            border-top-right-radius:20px;
            -webkit-border-bottom-right-radius:20px;
            -moz-border-radius-bottomright:20px;
            border-bottom-right-radius:20px;
            -webkit-border-bottom-left-radius:20px;
            -moz-border-radius-bottomleft:20px;
            border-bottom-left-radius:20px;
            text-indent:0;
            border:1px solid #d02718;
            display:inline-block;
            color:#ffffff;
            font-family:Arial Black;
            font-size:15px;
            font-weight:bold;
            font-style:normal;
            height:50px;
            line-height:50px;
            width:100px;
            text-decoration:none;
            text-align:center;
            text-shadow:4px 1px 0px #810e05;
        }
        .btn-start:hover {
            background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #c62d1f), color-stop(1, #f24537) );
            background:-moz-linear-gradient( center top, #c62d1f 5%, #f24537 100% );
            filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#c62d1f', endColorstr='#f24537');
            background-color:#c62d1f;
        }.btn-start:active {
            position:relative;
            top:1px;
        }
        /* ---------------- */
        .span {
            font-size: 20px;
            color: #fff;
            
        }

        .p {
            font-size: 25px;
            color: #E33225;
            font-family:Arial Black;
            font-weight:bold;
            font-style:normal;
        }

        /*this is media query*/

        @media Screen and (min-width: 442px) and (max-width: 480px){
            .containers-play{
                width: 100%;
                top:0px;
                left: 0%;
                margin-left: 0px;
            }
            .head-content{
                padding: 10px;
                /*background-color: blue;*/
            }

            .container-img{
                padding: 25px;
            }
            .div-img-pizza{
                margin: 0px;
            }

            .img-play-pizza{
                width: 150px;
            }
        }

        @media Screen and (max-width: 441px){
            .containers-play{
                width: 100%;
                top:0px;
            }

            .box-play{
                border: 10px solid #6A080C;
            }

            .head-content{
                margin: auto;
                padding: 11px;
                /*background-color: blue;*/
            }

            .container-img{
                padding: 0px;
            }
            .img-play-pizza{
                width: 130px;
            }
        }   

    </style>
    
    <body style="background-color:#6A080C;"> <!--background-image:url('./images/pizza-amore.svg');background-size:cover;-->
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

    <div class="containers-play hide">
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
                    <div class="div-img-pizza box_1 hide"></div>
                    <div class="div-img-pizza box_2 hide"></div>
                    <div class="div-img-pizza box_3 hide"></div>
                    <div class="div-img-pizza box_4 hide"></div>
                </div>
                <div class="score hide">
                   
                </div>
            </div>
        </div>
    </div>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script src="js/jquery.event.move.js"></script>
        <script src="js/jquery.twentytwenty.js"></script>
        <script type="text/javascript">
        
 
    </body>
</html>
