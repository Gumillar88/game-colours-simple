$(document).ready(function(){    
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
			    var chars = div.text().split('');
			    div.html('');     
			    for(var i=0; i<chars.length; i++) {
			        idx = Math.floor(Math.random() * colours.length);
			        var span = $('<span>' + chars[i] + '</span>').css("color", colours[idx]);
			        div.append(span);
			    }
        
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
                        count=count;
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
                        alert('you wrong click its Game over');
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