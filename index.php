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
        <title>Game-colours</title>
        <link rel="icon" type="image/png" href="http://havasww.id/beta/assets/icon/favicon.png">
        <link href="css/foundation.css" rel="stylesheet" type="text/css" />
        <link href="css/style.css" rel="stylesheet">

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!--script src="js/tests.js"></script-->
        <!--script src="./js/all_js.js"></script-->
        <script src="./js/randomColor.js"></script>
        <script src="./js/ion.sound.js"></script>
        

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

            // Constant value
            
            var COLOR_FORMAT = [];
            var COLOR_LEAD_POS;
            var CURRENTSCORE = 0;
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

            var currentScore = 0; //this is variabel score
            
            
            function getRandomInt(min, max) {
                return Math.floor(Math.random() * (max - min + 1)) + min;
            }
            
            $(function(){
                
                $('#scorEnd').html(currentScore);

                //this is random span colours
                var colours = ['#000000', '#FF0000', '#990066', '#FF9966', '#996666', '#00FF00', '#CC9933'],idx;
                var div = $('#rand'); 
                // var div = $('#gameOver');
                var chars = div.text().split('');
                div.html('');     
                for(var i=0; i<chars.length; i++) {
                    idx = Math.floor(Math.random() * colours.length);
                    var span = $('<span>' + chars[i] + '</span>').css("color", colours[idx]);
                    div.append(span);
                }
                
            console.log(div);
            });

            // time countdown and play

            var count;
            var counter;

            function resetEverything()
            {
                $('.score-end').addClass('hidden-btn');
                $('#scorEnd').addClass('hidden-btn');
 
                $('#counter, #myButton03').hide();
                $('#gameOver').addClass('hidden-btn');
                $('#myButton02').removeClass('hidden-btn');
                clearInterval(counter); 

                
            }


            function timeout(){
                console.log('timeout');
                ion.sound.play("WrongClick");
                alert('game over');
                $('.containers').addClass('hidden-btn');
                $('.containers-play').removeClass('hidden-btn');
                $('.lead-box').addClass('hidden-btn');
                $('.boxes').addClass('hidden-btn');
                $('#counter').addClass('hidden-btn');
                $('.score-start').addClass('hidden-btn');
                $('.time').addClass('hidden-btn');
                $('#secs').addClass('hidden-btn');

                $('#gameOver').removeClass('hidden-btn');
                $('#myButton02').removeClass('hidden-btn');
                $('.score-end').removeClass('hidden-btn');
                $('#scorEnd').removeClass('hidden-btn');
                // this is score
                $('#scorEnd').html(currentScore);

            }

            function showToPlay(){
                console.log('testing aja yah');
                console.log('login success');
                ion.sound.play('beep');
                $('.containers').addClass('hidden-btn');
                $('.containers-play').removeClass('hidden-btn');
                $('.score-end').addClass('hidden-btn');
                $('#scorEnd').addClass('hidden-btn');
                $('.lead-box').addClass('hidden-btn');
                $('.boxes').addClass('hidden-btn');
            }

            $(document).ready(function(){
                
                $('#letsPlay').on('click', showToPlay);


                resetEverything();
                
                $('#myButton02').on('click',function(){
                    resetEverything();

                    ion.sound.play("beer_opening");
                    $('.time').removeClass('hidden-btn');
                    $('#secs').removeClass('hidden-btn');
                    $('.score-start').removeClass('hidden-btn');
                    $('.lead-box').removeClass('hidden-btn');
                    $('.boxes').removeClass('hidden-btn');
                    //reset score
                    console.log("refresh click");
                    currentScore = 0;
                    $('#current-score-value').html(currentScore);
                    
                    $('#myButton02').addClass('hidden-btn');
                    $('#counter').animate({width: 'toggle'});
                   
                    
                    count=10;
                    counter=setInterval(timer, 1000);
                    
                    function timer(){
                        count=count-1;
                        if (count <= 0){
                            clearInterval(counter);
                            return;  
                        }
                        document.getElementById("secs").innerHTML=count;

                    }
                    
                    // Generate 4 random colors
                    var colors = randomColor({count: 4});
                    
                    for (var a = 0; a < colors.length; a++) {
                        COLOR_FORMAT.push({position: a, value: colors[a]});
                        $($('.box-item')[a]).css('background', colors[a]);
                    }
                    
                    COLOR_LEAD_POS = getRandomInt(0, 3);
                    $('.lead-box').css('background', colors[COLOR_LEAD_POS]);
                    
                    console.log(COLOR_LEAD_POS);
                    console.log('COLOR_LEAD_POS');


                });
                $('#current-score-value').append(CURRENTSCORE);
                // this is item click random
                $('.box-item').on('click', function() {
                    
                    var pos = parseInt($(this).data('pos'));
                    
                    if (pos === COLOR_LEAD_POS) {
                        console.log('true');
                        ion.sound.play("beep");
                        var colors = randomColor({count: 4});
                    
                        for (var a = 0; a < colors.length; a++) {
                            COLOR_FORMAT.push({position: a, value: colors[a]});
                            $($('.box-item')[a]).css('background', colors[a]);
                        }

                        COLOR_LEAD_POS = getRandomInt(0, 3);
                        $('.lead-box').css('background', colors[COLOR_LEAD_POS]);

                        currentScore++;
                        $('#current-score-value').html(currentScore);
                        console.log(currentScore);
                        console.log('this is test colors');
                        console.log(COLOR_LEAD_POS);
                        console.log(colors);
                    } else {
                        console.log('false');
                        ion.sound.play("WrongClick");
                        
                        $('.containers').addClass('hidden-btn');
                        $('.containers-play').removeClass('hidden-btn');
                        $('.lead-box').addClass('hidden-btn');
                        $('.boxes').addClass('hidden-btn');
                        $('#counter').addClass('hidden-btn');
                        $('.score-start').addClass('hidden-btn');
                        $('.time').addClass('hidden-btn');
                        $('#secs').addClass('hidden-btn');

                        $('#gameOver').removeClass('hidden-btn');
                        $('#myButton02').removeClass('hidden-btn');
                        $('.score-end').removeClass('hidden-btn');
                        $('#scorEnd').removeClass('hidden-btn');
                        // this is score
                        $('#scorEnd').html(currentScore);
                        
                    }
                    
                });

                $('#reload').click(function(){
                    ion.sound.play("beep");
                });


            });
        </script>
    </head>
    <body>
        <!-- <audio id="audio" src="./sounds/backsound.mp3" autoplay="autoplay" hidden="hidden"></audio> -->
        <div id="con" class="containers">
            <div class="box">
                <div id="rand">Colours</div>
                <span class="span-colours">
                    
                    <!-- <p class="p">Co<span style="color:#2C3E50;">lou</span style="color:#3498DB;">r<span style="color:#2980B9;">s</span></p> -->
                    <p class="p-instruction">
                        follow the instructions and adjust colors below
                        press one of the colors and match color according to choice
                    </p>
                    <button id="letsPlay" class="btn-play">let&#x00027;s play</button>

                </span>

            </div>
        </div>

        <div class="containers-play hidden-btn">
            <div class="box-play">
                
                <div id="counter" class="countdown"></div><!--time's only 15 seconds-->
                <div>
                    <div id="gameOver" class="game-over hidden-btn">
                        GAME OVER
                        <span  class="score-end">you'r score:</span>
                    </div>
                    <div class="timeAndScore">
                        <!-- start score -->
                        <span class="score-start" style="">score: <span id="current-score-value"></span></span>
                        <div class="score hidden-btn"></div>
                        <span class="time" style="">time : </span><span id="secs"></span>
                    </div>
                </div>
                <div>
                <div>
                    <!-- this is score end -->
                    
                    <span id="scorEnd" style=""></span>
                    <div class="head-content">
                        <button id="myButton02" class="btn-start" onclick="setTimeout(timeout, 15000);" style="text-align:center;">play</button>
                    </div>
                    
                    <div class="lead-box"></div>    
                    <div class="container-img">
                        
                        <div class="boxes level-satu">
                            <div class="box-item" data-pos="0"></div>
                            <div class="box-item" data-pos="1"></div>
                            <div class="box-item" data-pos="2"></div>
                            <div class="box-item" data-pos="3"></div>
                        </div>

                    </div>
                    
                </div>
            </div>
        </div>        
    </body>
</html>
