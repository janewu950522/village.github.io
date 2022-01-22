<?php
    require('Connections/connect.php');
    session_start();
    date_default_timezone_set("Asia/Taipei");
    if(@$_GET['do']=="test"){
        $_SESSION['home']="red";
        $date=(date("m/d H:i:s"));
    }
    if(@$_GET['do']=="test2"){
        $_SESSION['home']="yellow";
        $date=(date("m/d H:i:s"));
    }
    if(@$_GET['do']=="default"){
        unset($_SESSION['home']);
        $date=(date("m/d H:i:s"));
    }
    if(@$_POST['home']=="Home Get"){
        $_SESSION['home']="green";
        $date=(date("m/d H:i:s"));
        header('index.php');
    }
    if(@$_POST['home']=="Home Get2"){
        $_SESSION['home']="green";
        $date=(date("m/d H:i:s"));
        header('index.php');
    }
    // echo @$_SESSION['home'];
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://bit.webduino.io/blockly/components/jquery/dist/jquery.min.js"></script>
  <script src="https://bit.webduino.io/blockly/dist/lib/webduino-all.min.js"></script>
  <script src="https://bit.webduino.io/blockly/dist/MessageTransport.min.js"></script>
  <script src="https://bit.webduino.io/blockly/dist/webduino-blockly.min.js"></script>
  <script src="https://bit.webduino.io/blockly/dist/lib/firebase.min.js"></script>
  <script src="https://bit.webduino.io/blockly/dist/lib/runtime.min.js"></script>
  <script src="https://bit.webduino.io/blockly/components/webduino-bit-module-led-matrix/BitLedMatrix-blockly.js"></script>
  <script src="https://bit.webduino.io/blockly/components/webduino-bit-module-led-matrix/BitLedMatrix.js"></script>
<title>無標題文件</title>
</head>

<script>
(async function() {

var at_home_now;
var alert_level;

function get_date(t) {
  var varDay = new Date(),
    varYear = varDay.getFullYear(),
    varMonth = varDay.getMonth() + 1,
    varDate = varDay.getDate();
  var varNow;
  if (t == "ymd") {
    varNow = varYear + "/" + varMonth + "/" + varDate;
  } else if (t == "mdy") {
    varNow = varMonth + "/" + varDate + "/" + varYear;
  } else if (t == "dmy") {
    varNow = varDate + "/" + varMonth + "/" + varYear;
  } else if (t == "y") {
    varNow = varYear;
  } else if (t == "m") {
    varNow = varMonth;
  } else if (t == "d") {
    varNow = varDate;
  }
  return varNow;
}

function get_time(t) {
  var varTime = new Date(),
    varHours = varTime.getHours(),
    varMinutes = varTime.getMinutes(),
    varSeconds = varTime.getSeconds();
  var varNow;
  if (varHours < 10) {
    varHours = '0' + varHours;
  }
  if (varMinutes < 10) {
    varMinutes = '0' + varMinutes;
  }
  if (varSeconds < 10) {
    varSeconds = '0' + varSeconds;
  }
  if (t == "hms") {
    varNow = varHours + ":" + varMinutes + ":" + varSeconds;
  } else if (t == "h") {
    varNow = varHours * 1;
  } else if (t == "m") {
    varNow = varMinutes * 1;
  } else if (t == "s") {
    varNow = varSeconds * 1;
  }
  return varNow;
}


boardReady({
  board: 'Bit',
  device: 'bit0d8368,
  multi: true,
  transport: 'message',
  window: window.top.frames[0]
}, async function(board) {
  window._board_ = await boardInit_(board, 100, 0);
  await buzzerPlay_(_board_, [('E6')], [(2)]);
  sheetInit('https://docs.google.com/spreadsheets/d/1oeX7MrwRU2TqVNlM-R3gocKDfLA0g22ppW0MN14nFLs/edit?usp=sharing', '村民紀錄');
  await sheetReadData();
  await sheetWriteData('auto', '尚未撤離', 'a2');
  await sheetWriteData('auto', '尚未撤離', 'b2');
  at_home_now = true;
  (async function() {
    let $bhgde302 = _startLoop_();
    while (_loop_[$bhgde302]) {
      sheetInit('https://docs.google.com/spreadsheets/d/1oeX7MrwRU2TqVNlM-R3gocKDfLA0g22ppW0MN14nFLs/edit?usp=sharing', '發佈警報');
      await sheetReadData();
      alert_level = _mySheet_.data.data;
      if (at_home_now == true && (alert_level.slice(-1)[0]) == '真的危險') {
        (async function() {
          let $dfiak566 = _startLoop_();
          while (_loop_[$dfiak566]) {
            $demoMonster01.talk('i\'m in danger!');
            _board_._bit_matrix_.setColor('#ff0000');
            await buzzerPlay_(_board_, [('A5')], [(10)]);
            _board_._bit_matrix_.off();
            await buzzerPlay_(_board_, ['0'], [(10)]);
            btnEvent_(_board_._bit_btnA_, 'released',
              async function() {
                sheetInit('https://docs.google.com/spreadsheets/d/1oeX7MrwRU2TqVNlM-R3gocKDfLA0g22ppW0MN14nFLs/edit?usp=sharing', '村民紀錄');
                await sheetWriteData('auto', '撤離完畢', 'a2');
                await sheetWriteData('auto', ([get_date("ymd"), ' ', get_time("hms")].join('')), 'b2');
                at_home_now = at_home_now + false;
                _stopAllLoop_();
              }, [_board_._bit_btnA_, _board_._bit_btnB_]
            );
            await delay(0.005, true);
          }
        })();

      } else if ((alert_level.slice(-1)[0]) == '預演') {} else if ((alert_level.slice(-1)[0]) == '安全') {}
      await delay(0.005, true);
    }
  })();


});

}());
</script>

<style>
    #alert{
        width: 100px;
        height: 50px;
        float: left;
        margin:15px;
        border-radius:5px;
    }
    .red{        
        background-color:red;
    }
    .yellow{
        background-color:yellow;
    }
    .green{
        background-color:green;
    }
    .red-s{        
        border:1px red solid;
    }
    .yellow-s{
        border:1px yellow solid;
    }
    .green-s{
        border:1px green solid;
    }
</style>

</body>
    <h1 align="center">警報系統</h1>
    <hr>
    <a href="?do=test"><h3 align="center">警報測試</h3></a>
    <hr>
    <a href="?do=test2"><h3 align="center">次級警報測試</h3></a>
    <hr>
    <a href="?do=default"><h3 align="center">回復預設值</h3></a>
    <hr>
    <table width="800" border="1" cellpadding="0" cellspacing="0" bordercolor="#9999FF" align="center"> 
        <tr bgcolor="#9999FF">   
        <td width="25%"><div align="center"><font color="#FFFFFF">住戶</font></div></td>  
        <td width="50%"><div align="center"><font color="#FFFFFF"></font></div></td> 
        <td width="25%"><div align="center"><font color="#FFFFFF">更新時間</font></div></td>  
        </tr> 
        <tr class="alert-block"> 
        <td height="120" colspan="1" align="center" valign="middle"><div><a href="home.php">Home</a></div></td> 
        <td height="120" colspan="1">
        <?php
            switch(@$_SESSION['home']){
                default:
                    echo '<div class="red-s" id="alert"></div>
                    <div class="yellow-s" id="alert"></div>
                    <div class="green" id="alert"></div>';
                break;
                case "red":
                    echo '<div class="red" id="alert"></div>
                    <div class="yellow-s" id="alert"></div>
                    <div class="green-s" id="alert"></div>';
                break;
                case "yellow":
                    echo '<div class="red-s" id="alert"></div>
                    <div class="yellow" id="alert"></div>
                    <div class="green-s" id="alert"></div>';
                break;
            }
        ?>
        </td> 
        <td height="120" colspan="1"><div align="center"><?php echo @$date; ?></div></td> 
        </tr> 
        <tr> 
        <td colspan=1><div align="center"><font color="#black"></font></div></td> 
        <td colspan=1><div align="center"><font color="#black"></font></div></td> 
        <td colspan=1><div align="center"><font color="#black"></font></div></td> 
        </tr> 
    </table> 
<?php
    //require('home.php');
?>
</body>
</html>

