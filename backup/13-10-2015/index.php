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

            $('.btnlogin').click(function(){

                FB.login(function(response){
                    if (response.status === 'connected'){
                        console.log('test login');
                        $('.containers').addClass('hide');
                        $('.container').removeClass('hide');
                    }else{
                        
                    }
                },{
                    scope: 'public_profile,email,user_friends' // Need user_friends permission to use taggable_friends later
                });
            });


        function statusChangeCallback(response) {
            
            console.log('statusChangeCallback');
            console.log(response);
            // The response object is returned with a status field that lets the
            // app know the current login status of the person.
            // Full docs on the response object can be found in the documentation
            // for FB.getLoginStatus().
            if (response.status === 'connected') {
              // Logged into your app and Facebook.
              testAPI();
            } else if (response.status === 'not_authorized') {
              // The person is logged into Facebook, but not your app.
              document.getElementById('status').innerHTML = 'Please log ' +
                'into this app.';
            } else {
              // The person is not logged into Facebook, so we're not sure if
              // they are logged into this app or not.
              document.getElementById('status').innerHTML = 'Please log ' +
                'into Facebook.';
            }
          }

          // This function is called when someone finishes with the Login
          // Button.  See the onlogin handler attached to it in the sample
          // code below.
          function checkLoginState() {
            FB.getLoginStatus(function(response) {
              statusChangeCallback(response);
              console.log('test check login state');
            });
          }

          window.fbAsyncInit = function() {
          FB.init({
            appId      : '{620471018092087}',
            cookie     : true,  // enable cookies to allow the server to access 
                                // the session
            xfbml      : true,  // parse social plugins on this page
            version    : 'v2.2' // use version 2.2
          });

          // Now that we've initialized the JavaScript SDK, we call 
          // FB.getLoginStatus().  This function gets the state of the
          // person visiting this page and can return one of three states to
          // the callback you provide.  They can be:
          //
          // 1. Logged into your app ('connected')
          // 2. Logged into Facebook, but not your app ('not_authorized')
          // 3. Not logged into Facebook and can't tell if they are logged into
          //    your app or not.
          //
          // These three cases are handled in the callback function.

          FB.getLoginStatus(function(response) {
            statusChangeCallback(response);
            console.log('this is login');
          });

          };

          // Load the SDK asynchronously
          (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
          }(document, 'script', 'facebook-jssdk'));

          // Here we run a very simple test of the Graph API after login is
          // successful.  See statusChangeCallback() for when this call is made.
          function testAPI() {
            console.log('Welcome!  Fetching your information.... ');
            FB.api('/me', function(response) {
              console.log('Successful login for: ' + response.name);
              
              document.getElementById('status').innerHTML =
                'Thanks for logging in, ' + response.name + '!';
            });
             // This is called with the results from from FB.getLoginStatus().
          
          }
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
            border:0px solid rgba(0,0,0,.5);
            width: 500px;
            height: 200px;
            position: fixed;
            top: 400px;
            left: 50%;
            margin-top: -140px;
            margin-left: -240px;
            text-align: center;
            padding:40px;
            display: table;
        }
        .box{   
            display: table-cell;
            text-align: center;
            vertical-align: middle;
            border:0px solid #6A080C;
        }

        /* this is button login*/
        .btn-login {
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
        .btn-login:hover {
            background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #c62d1f), color-stop(1, #f24537) );
            background:-moz-linear-gradient( center top, #c62d1f 5%, #f24537 100% );
            filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#c62d1f', endColorstr='#f24537');
            background-color:#c62d1f;
        }.btn-login:active {
            position:relative;
            top:1px;
        }
        /* This button was generated using CSSButtonGenerator.com */
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
    </style>
    
    <body style="background-color:#6A080C; background-image:url('./images/pizza-amore.svg');background-size:cover;">
    <div class="containers">
        <div class="box">
            <span class="span">
                <p class="p">choose to play the game</p>
                <p>Please login to..</p>
            </span>
            <!-- <button class="fb-login-button" data-max-rows="5" data-size="medium" data-show-faces="false" data-auto-logout-link="true">Login</button> -->
            <div class="fb-login-button btnlogin" data-max-rows="5" data-size="medium" data-show-faces="false" data-auto-logout-link="true">sign in with facebook</div>
            <!-- <div id="fb-root"></div> -->
            
        </div>
    </div>

    <div class="container hide">
        <div class="box">
            <div>testing</div>
            
        </div>
    </div>
        

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script src="js/jquery.event.move.js"></script>
        <script src="js/jquery.twentytwenty.js"></script>
        
        <script>

            // $(window).load(function(){
            //     $(".twentytwenty-container").twentytwenty();

            //     var height = $(window).height();


            //     $(".btn-login").on('click', function(){
            //         $('#header').css('margin-top' , '-'+height+'px');
            //         $('#body-container').addClass('relative');
            //         $('#pizza').removeClass('hide');
            //     });

            //     $(".btn-burger").on('click', function(){
            //         $('#header').css('margin-top' , '-'+height+'px');
            //         $('#body-container').addClass('relative');
            //         $('#burger').removeClass('hide');
            //     });

            //     // back to top

            //     $(".BacktoTop-pizza").on('click', function(){
            //         $('#header').css('margin-top' , '0px');
            //         window.setTimeout(function(){
            //             $('#pizza').addClass('hide');    
            //         }, 1500);
                    
            //         console.log("pizza test");
            //     });

            //     $(".BacktoTop-burger").on('click', function(){
            //         $('#header').css('margin-top' , '0px');
            //         window.setTimeout(function(){
            //             $('#burger').addClass('hide');    
            //         }, 1500);

            //         console.log("burger test");
            //     });
                
            // });
            
            // function checkRatio(width, height, ratioWidth, ratioHeight, status) {
            //     var finalRatioWidth, finalRatioHeight;
                
            //     if (status === 'portrait') {
            //         finalRatioHeight = ratioWidth;
            //         finalRatioWidth = ratioHeight;
            //     } else {
            //         finalRatioWidth = ratioWidth;
            //         finalRatioHeight = ratioHeight;
            //     }
                
            //     return (width / finalRatioWidth) * finalRatioHeight === height;
            // }
            
            // function closestRatio(width, height, status) {
                
            //     var ratios = [
            //         [16, 10],
            //         [16, 9],
            //         [5, 3],
            //         [4, 3],
            //         [3, 2]
            //     ];
                
            //     var widthPoint = 0;
            //     var heightPoint = 1;
                
            //     if (status === 'portrait') {
            //         widthPoint = 1;
            //         heightPoint = 0;
            //     }
                
            //     var closestRatioValue = 0;
            //     var closestRatioLabel = '';
                
            //     for (var a = 0; a < ratios.length; a++) {
                    
            //         var ratio = ratios[a];
                    
            //         var value = height - ((width / ratio[widthPoint]) * ratio[heightPoint]);
                    
            //         if (value < 0) {
            //             value *= -1;
            //         }
                    
            //         if (value < closestRatioValue || closestRatioValue === 0) {
            //             closestRatioValue = value;
            //             closestRatioLabel = ratio[widthPoint]+':'+ratio[heightPoint];
            //         }
                    
            //     }
                
            //     return closestRatioLabel;
            // }
            
            // function analyzeRatio() {
                
            //     var width = $(window).width();
            //     var height = $(window).height();
            //     var status = 'landscape';
                
            //     if (height > width) {
            //         status = 'portrait';
            //     }
                
            //     console.log(status);

            //     // Check ratio desktop
            //     if (checkRatio(width, height, 16, 10, status)) { // 16:10
            //         console.log('16:10');   
            //     } else if (checkRatio(width, height, 16, 9, status)) { // 16:9
            //         console.log('16:9');
            //     } else if (checkRatio(width, height, 5, 3, status)) { // 5:3
            //         console.log('5:3');
            //     } else if (checkRatio(width, height, 4, 3, status)) { // 4:3
            //         console.log('4:3');
            //     } else if (checkRatio(width, height, 3, 2, status)) { // 3:2
            //         console.log('3:2');
            //     } else  { // nope
            //         console.log(closestRatio(width, height, status));
            //     }
            // }
            
            // analyzeRatio();
            // $(window).on('resize', analyzeRatio);
            
        </script>
    </body>
</html>
