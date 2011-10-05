<?php
include "connectdb.php";
$username=$_GET['username'];
$color1=$_GET['smscolor'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<!-- <script type="text/javascript" src="scripts/jquery.marquee.js"></script>-->
<script type="text/javascript">
(function ($) {
    $.fn.marquee = function (klass) {
        var newMarquee = [],
            last = this.length;

        // works out the left or right hand reset position, based on scroll
        // behavior, current direction and new direction
        function getReset(newDir, marqueeRedux, marqueeState) {
            var behavior = marqueeState.behavior, width = marqueeState.width, dir = marqueeState.dir;
            var r = 0;
            if (behavior == 'slide') {
                r = newDir == 1 ? marqueeRedux[marqueeState.widthAxis] - (width*2) : width;
            } else if (behavior == 'alternate') {
                if (newDir == -1) {
                    r = dir == -1 ? marqueeRedux[marqueeState.widthAxis] : width;
                } else {
                    r = newDir == -1 ? marqueeRedux[marqueeState.widthAxis] : 0;
                }
            } else {
                r = newDir == -1 ? marqueeRedux[marqueeState.widthAxis] : 0;
            }
            return r;
        }

        // single "thread" animation
        function animateMarquee() {
            var i = newMarquee.length,
                marqueeRedux = null,
                $marqueeRedux = null,
                marqueeState = {},
                newMarqueeList = [],
                hitedge = false;
                
            while (i--) {
                marqueeRedux = newMarquee[i];
                $marqueeRedux = $(marqueeRedux);
                marqueeState = $marqueeRedux.data('marqueeState');
                
                if ($marqueeRedux.data('paused') !== true) {
                    // TODO read scrollamount, dir, behavior, loops and last from data
                    marqueeRedux[marqueeState.axis] += (marqueeState.scrollamount * marqueeState.dir);

                    // only true if it's hit the end
                    hitedge = marqueeState.dir == -1 ? marqueeRedux[marqueeState.axis] <= getReset(marqueeState.dir * -1, marqueeRedux, marqueeState) : marqueeRedux[marqueeState.axis] >= getReset(marqueeState.dir * -1, marqueeRedux, marqueeState);
					
                    //console.log(hitedge);
					
					if(hitedge) { 
					
						$.ajax({
						type: "POST",
						url: "reduce-remaining-times.php",
						data: "username=<?=$username?>",
						success: function(){
						//location.reload(true);
							setTimeout('location.reload(true)', 13000);
							
							//$('form#submit').hide();
							//$('div.success').fadeIn();
							//alert("Data Saved");
							//$(".myipwe").html("Message Successfully Submitted. <br /> <br /> Click here to add another message. ");
						}
					})

					
					
						

					}
					
                    if ((marqueeState.behavior == 'scroll' && marqueeState.last == marqueeRedux[marqueeState.axis]) || (marqueeState.behavior == 'alternate' && hitedge && marqueeState.last != -1) || (marqueeState.behavior == 'slide' && hitedge && marqueeState.last != -1)) {                        
                        if (marqueeState.behavior == 'alternate') {
                           // marqueeState.dir *= -1; // flip
                        }
                        marqueeState.last = -1;

                        $marqueeRedux.trigger('stop');

                        marqueeState.loops--;
                        if (marqueeState.loops === 0) {
                            if (marqueeState.behavior != 'slide') {
                                marqueeRedux[marqueeState.axis] = getReset(marqueeState.dir, marqueeRedux, marqueeState);
                            } else {
                                // corrects the position
                                marqueeRedux[marqueeState.axis] = getReset(marqueeState.dir * -1, marqueeRedux, marqueeState);
                            }

                            $marqueeRedux.trigger('end');
                        } else {
                            // keep this marquee going
                            newMarqueeList.push(marqueeRedux);
                            $marqueeRedux.trigger('start');
                            marqueeRedux[marqueeState.axis] = getReset(marqueeState.dir, marqueeRedux, marqueeState);
                        }
                    } else {
                        newMarqueeList.push(marqueeRedux);
                    }
                    marqueeState.last = marqueeRedux[marqueeState.axis];

                    // store updated state only if we ran an animation
                    $marqueeRedux.data('marqueeState', marqueeState);
                } else {
                    // even though it's paused, keep it in the list
                    newMarqueeList.push(marqueeRedux);                    
                }
            }

            newMarquee = newMarqueeList;
            
            if (newMarquee.length) {
                setTimeout(animateMarquee, 25);
            }            
        }
        
        // TODO consider whether using .html() in the wrapping process could lead to loosing predefined events...
        this.each(function (i) {
            var $marquee = $(this),
                width = $marquee.attr('width') || $marquee.width(),
                height = $marquee.attr('height') || $marquee.height(),
                $marqueeRedux = $marquee.after('<div ' + (klass ? 'class="' + klass + '" ' : '') + 'style="display: block-inline; width: ' + width + 'px; height: ' + height + 'px; overflow: hidden;"><div style="float: left; white-space: nowrap;">' + $marquee.html() + '</div></div>').next(),
                marqueeRedux = $marqueeRedux.get(0),
                hitedge = 0,
                direction = ($marquee.attr('direction') || 'left').toLowerCase(),
                marqueeState = {
                    dir : /down|right/.test(direction) ? -1 : 1,
                    axis : /left|right/.test(direction) ? 'scrollLeft' : 'scrollTop',
                    widthAxis : /left|right/.test(direction) ? 'scrollWidth' : 'scrollHeight',
                    last : -1,
                    loops : $marquee.attr('loop') || -1,
                    scrollamount : $marquee.attr('scrollamount') || this.scrollAmount || 2,
                    behavior : ($marquee.attr('behavior') || 'scroll').toLowerCase(),
                    width : /left|right/.test(direction) ? width : height
                };
            
            // corrects a bug in Firefox - the default loops for slide is -1
            if ($marquee.attr('loop') == -1 && marqueeState.behavior == 'slide') {
                marqueeState.loops = 1;
            }

            $marquee.remove();
            
            // add padding
            if (/left|right/.test(direction)) {
                $marqueeRedux.find('> div').css('padding', '0 ' + width + 'px');
            } else {
                $marqueeRedux.find('> div').css('padding', height + 'px 0');
            }
            
            // events
            $marqueeRedux.bind('stop', function () {
                $marqueeRedux.data('paused', true);
            }).bind('pause', function () {
                $marqueeRedux.data('paused', true);
            }).bind('start', function () {
                $marqueeRedux.data('paused', false);
            }).bind('unpause', function () {
                $marqueeRedux.data('paused', false);
            }).data('marqueeState', marqueeState); // finally: store the state
            
            // todo - rerender event allowing us to do an ajax hit and redraw the marquee

            newMarquee.push(marqueeRedux);

            marqueeRedux[marqueeState.axis] = getReset(marqueeState.dir, marqueeRedux, marqueeState);
            $marqueeRedux.trigger('start');
            
            // on the very last marquee, trigger the animation
            if (i+1 == last) {
                animateMarquee();
            }
        });            

        return $(newMarquee);
    };
}(jQuery));

$(function () {
        // basic version is: $('div.demo marquee').marquee()
        
        $('div.demo marquee').marquee('pointer').mouseover(function () {
            $(this).trigger('stop');
        }).mouseout(function () {
            $(this).trigger('start');
        }).mousemove(function (event) {
            if ($(this).data('drag') == true) {
                this.scrollLeft = $(this).data('scrollX') + ($(this).data('x') - event.clientX);
            }
        }).mousedown(function (event) {
            $(this).data('drag', true).data('x', event.clientX).data('scrollX', this.scrollLeft);
        }).mouseup(function () {
            $(this).data('drag', false);
        });
		
		
    });
	</script>
	<style>
	img {
		vertical-align: top;
		border: none;
}

	.pointer {
		cursor: pointer;
		color: #ffffff;
		font-weight: bold;
		font-size: 18px;
		font-family:sans-serif;
}
	body { background-color: <?php echo $color1 ?>; }
	</style>
</head>
<body>
<div class="demo">
  <marquee behavior="scroll" direction="<?=$_GET[direction]?>" scrollamount="2" style="direction:<?=$_GET[textdirection]?>">
  <?php 
  
  
  $rip = $_SERVER['REMOTE_ADDR'];
$sd  = time();
$count = 1;

$file1 = "ip.txt";
$lines = file($file1);
$line2 = "";

foreach ($lines as $line_num => $line)
	{
		//echo $line."<br>";
		$fp = strpos($line,'****');
		$nam = substr($line,0,$fp);
		$sp = strpos($line,'++++');
		$val = substr($line,$fp+4,$sp-($fp+4));
		$diff = $sd-$val;
		if($diff < 5 && $nam != $rip)
			{
			 $count = $count+1;
			 $line2 = $line2.$line;
			 //echo $line2; 
			}
	}

$my = $rip."****".$sd."++++\n";
$open1 = fopen($file1, "w");
fwrite($open1,"$line2");
fwrite($open1,"$my");
fclose($open1);

//echo "$count";

  
  
  
//$firstname = $_POST['firstname'];
//$lastname = $_POST['lastname'];
//$age = $_POST['age'];
//$ip = $_SERVER['REMOTE_ADDR'];

//$result = mysql_num_rows(mysql_query("SELECT * FROM tbl_user WHERE user_name='$username'"));
//if($result == 1)
  //  {
  //  echo '<h1>ERROR!</h1>The username you have chosen already exists!';
  //  }
//else
 //   {
	$sql = "update users set online = '$count' where username = '$username'";
	mysql_query($sql);
  
  
  
  
  
  
  
  
  
  
  
  
  
  
//require_once "simplexml.class.php";
include('emoticon.php');

//$file = "data/data.xml";
//$sxml = new simplexml;
//$data = $sxml->xml_load_file($file);

 $em = new Emoticon();
 $em->add(':)','images/1.gif');
 $em->add(':(','images/2.gif');
 $em->add(';)','images/3.gif');
 $em->add(':D','images/4.gif');
 $em->add(';;)','images/5.gif');
 $em->add('>:D<','images/6.gif');
 $em->add(':-/','images/7.gif');
 $em->add(':x','images/8.gif');
 $em->add(':">','images/9.gif');
 $em->add(':P','images/10.gif');
 $em->add(':-*','images/11.gif');
 $em->add('=((','images/12.gif');
 $em->add(':-O','images/13.gif');
 $em->add('X(','images/14.gif');
 $em->add(':>','images/15.gif');
 $em->add('B-)','images/16.gif');
 $em->add(':-S','images/17.gif');
 $em->add('#:-S','images/18.gif');
 $em->add('>:)','images/19.gif');
 $em->add(':((','images/20.gif');
 $em->add(':))','images/21.gif');
 $em->add(':|','images/22.gif');
 $em->add('/:)','images/23.gif');
 $em->add('=))','images/24.gif');
 $em->add('O:-)','images/25.gif');
 $em->add(':-B','images/26.gif');
 $em->add('=;','images/27.gif');
 $em->add(':-c','images/101.gif');
 $em->add(':)]','images/100.gif');
 $em->add('~X(','images/102.gif');
 $em->add(':-h','images/103.gif');
 $em->add(':-t','images/104.gif');
 $em->add('8->','images/105.gif');
 $em->add('I-)','images/28.gif');
 $em->add('8-|','images/29.gif');
 $em->add('L-)','images/30.gif');
 $em->add(':-&','images/31.gif');
 $em->add(':-$','images/32.gif');
 $em->add('[-(','images/33.gif');
 $em->add(':O)','images/34.gif');
 $em->add('8-}','images/35.gif');
 $em->add('<:-P','images/36.gif');
 $em->add('(:|','images/37.gif');
 $em->add('=P~','images/38.gif');
 $em->add(':-?','images/39.gif');
 $em->add('#-o','images/40.gif');
 $em->add('=D>','images/41.gif');
 $em->add(':-SS','images/42.gif');
 $em->add('@-)','images/43.gif');
 $em->add(':^o','images/44.gif');
 $em->add(':-w','images/45.gif');
 $em->add(':-<','images/46.gif');
 $em->add('>:P','images/47.gif');
 $em->add('<):)','images/48.gif');
 $em->add('X_X','images/109.gif');
 $em->add(':!!','images/110.gif');
 $em->add('\m/','images/111.gif');
 $em->add(':-q','images/112.gif');
 $em->add(':-bd','images/113.gif');
 $em->add('^#(^','images/114.gif');
 $em->add(':ar!','images/pirate_2.gif');
 
 //$i=0;
 //foreach ( $data as $key => $value)
// {
//	$data_key[$i] = $key;
//	$data_value[$i] = $value;
//	$i++;
 //}
 
 /* for ($i=0; $i<2; $i++) {
 echo "To : ".$data->to[$i];
 echo "&nbsp;&nbsp;&nbsp;&nbsp;";
 echo "From : ".$data->from[$i];
 echo "&nbsp;&nbsp;&nbsp;&nbsp;";
 echo "Heading : ".$em->apply($data->heading[$i]);
 echo "&nbsp;&nbsp;&nbsp;&nbsp;";
 echo "Message : ".$em->apply($data->body[$i]);
 echo "&nbsp;&nbsp;&nbsp;&nbsp;"; 
 echo '<img src="'.$_GET[seperator].'" width="20px" height="20px" />';
 echo "&nbsp;&nbsp;&nbsp;&nbsp;"; 
 //echo "&nbsp;&nbsp;&nbsp;&nbsp;"; 

 }*/
 
 //print_r($data);
//$data_imploded = implode("&nbsp;&nbsp;&nbsp;&nbsp;",$data_value);
// echo $em->apply($data_imploded);


   // error_reporting(E_STRICT);
   
   $sql1 = "SELECT message FROM `smsmessages` where username = '$username' and duration > 0 ORDER BY `id` DESC LIMIT 0, 3 ";
   
   $result = mysql_query($sql1) or die('Query failed: ' . mysql_error());

while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
    foreach ($line as $col_value) {
        echo $em->apply($col_value);
		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="'.$_GET[seperator].'" width="20px" height="19px" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    }
}

   // $text = 'hi all :) have a nice day';
	
	//$seperator = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="'.$_GET[seperator].'" width="20px" height="19px" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    //include('arabic.php');
	
    //$Arabic = new Arabic('ArCharsetC');
    
    //$Arabic->setInputCharset('utf-8');
	
    //if (isset($_GET['charset'])){
    //    $Arabic->setOutputCharset($_GET['charset']);
    //}
    
   // $charset = $Arabic->getOutputCharset();
	
	//$text = $Arabic->convert($text);
	//echo $count;
//	echo $seperator;
   //echo $em->apply($text);
	//echo $seperator;
   // echo $em->apply($text);
	//echo $seperator;
	
?>
  </marquee>
</div>
</body>
</html>
