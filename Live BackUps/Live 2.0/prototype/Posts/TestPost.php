<?php
$target = "http://tidepool.co/assessment/prototype/Posts/PostSpaceStage.php";
$data = "<space><picturePreference><set><selected>b11</selected><cycles>0</cycles><time>691</time></set><set><selected>a17</selected><cycles>0</cycles><time>192</time></set><set><selected>b3</selected><cycles>0</cycles><time>183</time></set><set><selected>a12</selected><cycles>0</cycles><time>174</time></set><set><selected>b20</selected><cycles>0</cycles><time>138</time></set><set><selected>a1</selected><cycles>5</cycles><time>305</time></set><set><selected>b18</selected><cycles>0</cycles><time>175</time></set><set><selected>b9</selected><cycles>0</cycles><time>153</time></set><set><selected>a13</selected><cycles>0</cycles><time>328</time></set><set><selected>b2</selected><cycles>0</cycles><time>304</time></set><set><selected>b19</selected><cycles>0</cycles><time>176</time></set><set><selected>b21</selected><cycles>0</cycles><time>175</time></set><set><selected>b15</selected><cycles>0</cycles><time>572</time></set><set><selected>a16</selected><cycles>0</cycles><time>158</time></set><set><selected>a4</selected><cycles>0</cycles><time>710</time></set><set><selected>b14</selected><cycles>0</cycles><time>153</time></set><set><selected>b6</selected><cycles>0</cycles><time>682</time></set><set><selected>b23</selected><cycles>0</cycles><time>577</time></set><set><selected>b24</selected><cycles>0</cycles><time>888</time></set><set><selected>a22</selected><cycles>0</cycles><time>839</time></set><set><selected>a7</selected><cycles>0</cycles><time>858</time></set><set><selected>a5</selected><cycles>1</cycles><time>6128</time></set><set><selected>b8</selected><cycles>2</cycles><time>10578</time></set><set><selected>a10</selected><cycles>4</cycles><time>21610</time></set></picturePreference><pictureGroup><set><selected>b9</selected><time>21366</time></set><set><selected>b2</selected><time>21710</time></set><set><selected>b19</selected><time>22700</time></set><set><selected>a4</selected><time>23536</time></set><set><selected>a13</selected><time>23900</time></set><set><selected>a22</selected><time>24303</time></set><set><selected>b15</selected><time>24767</time></set><set><selected>a16</selected><time>24903</time></set></pictureGroup><changes>b9-b2-b19-a4-a13-a22-b15-a16 | b2-b19-a4-a13-b9-a22-b15-a16-*1283* | b2-b19-a4-a16-a13-b9-a22-b15-*883* | b19-a4-a16-a13-b9-b2-a22-b15-*933* | b19-a4-b15-a16-a13-b9-b2-a22-*933* | a4-b15-a16-a13-b19-b9-b2-a22-*878* | a4-b15-a16-a13-a22-b19-b9-b2-*1106* | a4-a16-a13-a22-b19-b15-b9-b2-*902*</changes><ordering><preference1>a4</preference1><preference2>a16</preference2><preference3>a13</preference3><preference4>a22</preference4><preference5>b19</preference5><preference6>b15</preference6><preference7>b9</preference7><preference8>b2</preference8></ordering></space>";
?>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>
<body onload="pageInit();">  <script language="JavaScript">
    document.body.innerHTML += '<form id="form" action="<? echo $target ?>" method="post"><input type="hidden" name="data" value="<? echo $data; ?>">';
    //alert(value);
    document.getElementById("form").submit();
</script>
</body>
</html>