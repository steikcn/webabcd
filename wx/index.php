<?php
define("TOKEN", "zxd_xinsheng");
//define("WELCOME","感谢您关注【新生】\n\n新起点，新征程，新生活！\n\n【0/?/h】主菜单\n【1/k】考勤查询\n【...】规划中\n\n欢迎光临微信开发内部测试帐号：请多提宝贵建议！");
define("WELCOME","感谢您关注【新生】\n\n新起点，新征程，新生活！\n\n欢迎光临微信开发内部测试帐号：请多提宝贵建议！");
define("BYEBYE","再见！\n\n【新生】新起点，新征程，新生活！");

$wechatObj = new wechatCallbackapiTest();

if (isset($_GET["echostr"])){
    $wechatObj->valid();
}
    
if ($wechatObj->checkSignature()){
  $wechatObj->responseMsg();
}else{
    echo "hehehe";
}


class wechatCallbackapiTest
{
  public function responseMsg()
    {
    //$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
    $postStr = file_get_contents("php://input"); //接收POST数据

    if (!empty($postStr)){
      //$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
      $postObj = simplexml_load_string($postStr);

      $msgType = trim($postObj->MsgType);
      switch($msgType)
      {
        case "text":
                    $resultStr = $this->handleText($postObj);
                    break;
        case "event":
                    $resultStr = $this->handleEvent($postObj);
                    break;
        case "image":
                  $contentStr = "我还不会看图说话 /流汗";
          $resultStr = $this->responseText($postObj, $contentStr);
          break;
        case "voice":
                    if (null !== $postObj->Recognition && !empty($postObj->Recognition)){
                        $contentStr = $this->handleRecognition($postObj);
                    }else{
                        $str = array("/得意","/咖啡","别吵啦。。。","你说什么？","听不懂你说什么！","/拥抱","乖！");
                        $contentStr = $str[mt_rand(0,count($str))];
                    }
          $resultStr = $this->responseText($postObj, $contentStr);
          break;
        case "video":
        case "location":
        case "link":
        default:
          $resultStr = $this->responseText($postObj, $msgType);
        break;
      }
      echo $resultStr;
    }else{
      $html=<<<ML
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1; maximum-scale=1.0; user-scalable=no;" />
<meta name="apple-mobile-web-app-status-bar-style" content="black"  />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="format-detection" content="telephone=no" />
<link href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<title>昆山汇美</title>
</head>
<body>
<div class="container">
  <div class="row clearfix">
    <div class="col-md-12 column">
       <button type="button" class="btn btn-default btn-block btn-primary" onclick="alert('你不是通过微信公众号访问！')">昆山汇美ERP查询系统</button> 
       <button type="button" class="btn btn-default btn-block btn-primary" onclick="alert('你不是通过微信公众号访问！')">昆山汇美考勤查询系统</button> 
    </div>
  </div>
</div>
<br>
<p style="text-align:center">webabcd.top</p>
<p style="text-align:center">皖ICP备17011985</p>
</body>
</html>
ML;
    echo $html;
    }
        exit;
    }
  
    private function handleRecognition($postObj){
        $recognition = $postObj->Recognition;
        if (strpos($recognition,"考勤") !== false){
          $contentStr = $this->kaoqin($postObj);
        }elseif (strpos($recognition,"库存") !== false) {
          $contentStr = $this->kucun($postObj);
        }else{
            $contentStr = "未处理指令：".$recognition;
        }
        return $contentStr;
    }
    
    private function kaoqin($postObj){
        $uid = $postObj->FromUserName;
        $contentStr = '欢迎使用<a href="http://wx.webabcd.top/kq/index.php?uid='.$uid.'">考勤查询</a>！';
        return  $contentStr;
    }

    private function kucun($postObj){
        $uid = $postObj->FromUserName;
        $contentStr = '请点击-><a href="http://wx.webabcd.top/erp/index_inv.php?uid='.$uid.'">库存查询</a>';
        return  $contentStr;
    }
    
    private function handleText($postObj){
    $keyword = trim($postObj->Content);
    if(!empty( $keyword ))  {
      switch( strtolower($keyword) ){
        case "?":
          $contentStr = WELCOME;
          break;
        case "h":
          $contentStr = WELCOME;
          break;
        case "H":
          $contentStr = WELCOME;
          break;
        case "2":
          $uid = $postObj->FromUserName;
          $contentStr = '欢迎使用<a href="http://steik.applinzi.com/jssdk.sample.php">JSSDK</a>！';
          break;
        case "cz":
        case "chanzhi":
        case "产值":
        case "1":
                $uid = $postObj->ToUserName;  //测试号：gh_6367b65b948f；新生：gh_069a9e8ec1cf
                $contentStr = '点击查看<a href="http://steik.applinzi.com/echarts/showCharts.php">公司产值</a>！';
          break;
        case "kq":
        case "kaoqin":
        case "考勤":
                  $contentStr = $this->kaoqin($postObj);
          break;
        case "kc":
        case "kucun":
        case "ck":
        case "cangku":
        case "仓库":
        case "库存":
                  $contentStr = $this->kucun($postObj);
          break;

        default:
          $contentStr = "我还小，没那么聪明，不懂您说的话，但是我会转告给我主人的。如果您有什么好点子，我主人会很高兴的！";
          break;
      }
    }else{
      $contentStr = WELCOME;
    }
    $resultStr = $this->responseText($postObj, $contentStr);
    echo $resultStr;
  }

  private function handleEvent($postObj)
  {
    $contentStr = "";
    switch ($postObj->Event)
    {
      case "subscribe":
      $contentStr = WELCOME;
      break;
      case "unsubscribe":
      $contentStr = BYEBYE;
      break;
            case "SCAN":    //扫描带参数二维码事件,用户已关注时的事件推送
      $contentStr = WELCOME;
      break;
            case "LOCATION":  //上报地理位置事件
      $contentStr = WELCOME;
      break;
            case "CLICK":   //点击菜单拉取消息时的事件推送
      $contentStr = WELCOME;
      break;
            case "VIEW":    //点击菜单跳转链接时的事件推送
      $contentStr = WELCOME;
      break;
      default :
      $contentStr = "Unknow Event: ".$postObj->Event;
      break;
    }
    $resultStr = $this->responseText($postObj, $contentStr);
    return $resultStr;
  }

  private function responseText($postObj, $content, $flag=0)
  {
    $textTpl = "<xml>
          <ToUserName><![CDATA[%s]]></ToUserName>
          <FromUserName><![CDATA[%s]]></FromUserName>
          <CreateTime>%s</CreateTime>
          <MsgType><![CDATA[text]]></MsgType>
          <Content><![CDATA[%s]]></Content>
          <FuncFlag>%d</FuncFlag>
          </xml>";
        $resultStr = sprintf($textTpl, $postObj->FromUserName, $postObj->ToUserName, time(), $content, $flag);
        return $resultStr;
  }
      
  public function valid()
  {
    if($this->checkSignature()){
      echo $_GET["echostr"];
      exit;
    }
  }
    
  public function checkSignature()
  {
    return true;
        
    $signature = $_GET["signature"];
    $timestamp = $_GET["timestamp"];
    $nonce = $_GET["nonce"];

    $token = TOKEN;
    $tmpArr = array($token, $timestamp, $nonce);
    sort($tmpArr);
    $tmpStr = implode( $tmpArr );
    $tmpStr = sha1( $tmpStr );

    if( $tmpStr == $signature ){
      return true;
    }else{
      return false;
    }
  }
}
?>
