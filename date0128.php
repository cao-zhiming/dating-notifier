<?php


    if(!file_exists("./status.jan28")){
        die("<br />状态文件不存在 - 你或许将它删除了。<br />");
    }
    $jan_28_file_handle = fopen("./status.jan28","r");
    $jan_28_status_num = fgets($jan_28_file_handle);
    switch ($jan_28_status_num) {
        case '200':
            $jan_28_status_html = "primary";
            $jan_28_msg = "一切正常，欢迎来访！👏";
            $jan_28_can_go = 1;
            $jan_28_status_extra_msg = "200意味着，一切正常。一切按照之前约定的时间和方式进行。你需要保持一定的谨慎。";
            break;
        case '403':
            $jan_28_status_html = "danger";
            $jan_28_msg = "很抱歉，出现问题，你可能不能前来了……😭";
            $jan_28_can_go = 0;
            $jan_28_status_extra_msg = "403意味着，出现事故。我非常抱歉，但是你不能按照之前的约定而来了。我可能会在WAN提供更详细的信息以及如何处理，以及计划如何改变。";
            break;
        case '301':
            $jan_28_status_html = "warning";
            $jan_28_msg = "不确定。欢迎你来，但请小心谨慎行事。";
            $jan_28_can_go = 1;
            $jan_28_status_extra_msg = "301意味着，当前的状态并不确定。你可以来，但是必须保持高度的谨慎，这比200状态下更有可能被发现。";
            break;
        case '520':
            $jan_28_status_html = "success";
            $jan_28_msg = "一切正常，而且有好消息！欢迎！😊";
            $jan_28_can_go = 1;
            $jan_28_status_extra_msg = "520意味着，一切正常，你不需要执行任何额外的操作，而且有好消息，这比200状态下更没有可能被发现。但这不意味着你可以放下警惕。";
            break;
        default:
            die("<br /> ERROR. Bad status code: <br />". $jan_28_status_num);
            $jan_28_can_go = 0;
            break;
    }

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="//ltx1102.com/wan/wan-includes/node_modules/bootstrap/dist/css/bootstrap.min.css" />
        
        <script src="//ltx1102.com/wan/wan-includes/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <title>20230128 - 状态监控</title>
        </head>
    <body>
        <div class="p-5 my-5 rounded border rounded-3 shadow-lg">
            <div class="alert alert-<?php echo $jan_28_status_html; ?>">
                <span class="spinner-grow text-<?php echo  $jan_28_status_html; ?>"></span>&nbsp;&nbsp;&nbsp;
                 <big><?php echo $jan_28_msg;?></big>
            </div>
            <div class="accordion accordion-flush" id="accordionFlushExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingOne">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
        都有哪些可能出现的状态？
      </button>
    </h2>
    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">我们提供的状态有：<ol><li>200 - 一切正常</li><li>403 - 不能前来</li><li>301 - 不确定，需要谨慎</li><li>520 - 一切正常，而且有好消息</li></ol><hr><p>当前的状态为：<?php echo $jan_28_status_num;?></p></div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
        请详细解释当前的状态（<?php echo $jan_28_status_num;?>）是什么意思。
      </button>
    </h2>
    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
          <?php echo $jan_28_status_extra_msg;?>
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
        说直白点，就是我现在能不能去？？
      </button>
    </h2>
    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">根据我们的计算，答案是<b><?php echo (($jan_28_can_go) ? "可以" : "不可以");?>！</b></div>
    </div>
  </div>
</div>
<center>
<p class="lead"><span id="countdown"></span></p></center>

<script>
    function $(element){
        return document.getElementById(element);
    }
    function jan_28_countdown(){
    var now = new Date();
    var jan_28 = new Date(2023,0,28,15); // month is not real month, must -1...
    var leftTime = jan_28.getTime()-now.getTime(); //剩余毫秒
            var leftsecond = parseInt(leftTime/1000); 
              
            var day1 = Math.floor(leftsecond/(60*60*24)); //剩余天
            var hour = Math.floor((leftsecond-day1*24*60*60)/3600); //剩余时
            var minute = Math.floor((leftsecond-day1*24*60*60-hour*3600)/60); //剩余分
            var second = Math.floor(leftsecond-day1*24*60*60-hour*3600-minute*60); //剩余秒
    // dont want to write the f**king ugly countdown scripts again... so copying them directly from the MARTY website.. emmm...
    var element_countdown = $("countdown");
    element_countdown.innerHTML = "还有"+day1+"天"+hour+"小时"+minute+"分"+second+"秒！<br>";
    }
    window.setInterval(jan_28_countdown,1);
</script>
            
        </div>
    </body>
