<style type='text/css'>
    pre{margin:0;padding:0;}
    .debugger{
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 35px;
        z-index: 9999;
        background-color: rgb(255, 255, 255,0.8);
    }
    a{cursor:pointer;}
    .debugger ul{list-style-type: none;margin:0;padding:0;overflow-y: scroll;font-size:14px;line-height: 22px;}
    .debugger li{padding:6px 0;}
    .debugger-title{
        width:100%;
        height:35px;
        line-height: 35px;
        border:1px solid #ccc;
        background-color:white;
        padding-left:30px;
        font-weight:bold;
        padding-bottom:0;
        margin-bottom: 0;
        cursor: pointer;
        background-color: rgb(26,81,120);
        color:white;
    }
    .debugger-content{
        width:100%;
        height:400px;
        overflow: scroll;
        padding-left:30px;
        background-color:white;
    }
    .debugger-sidebar{float:left;width:30%;}
    .debugger-right{float:left;width:69%;}
</style>
<?php

class debugger {

    private static $debugger_switch = 1;
    private static $data = array();

    public static function push($title, $value, $is_bold = 0) {
        array_push(self::$data, array($title, $value, $is_bold));
    }

    public static function show() {
        if (isset($_GET['is_debug']) || self::$debugger_switch) {
            ?>
            <div class='debugger' >
                <p class='debugger-title' onclick='show_debugger();'>Debugger: </p>
                <div class='debugger-content'><div class="debugger-sidebar"><ul><p><b>流程 ： </b></p><?php 
                if (!empty(self::$data)) {
                    foreach (self::$data as $key => $value) {
                ?>
                            <li><a  href="#_a<?php echo $key+1; ?>"><?php echo $key+1 . " : " .$value[0]; ?></a></li>
                    
                    <?php } } ?></ul></div><pre class="debugger-right"><?php
                    if (!empty(self::$data)) {
                        foreach (self::$data as $key => $value) {
                            if ($value[2]) {
                                echo "<b><a name='_a".($key+1)."'>";
                                print_r($value[0]);
                                echo "</a></b>";
                            } else {
                                print_r($value[0]);
                            }
                            echo "<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                            if ($value[1] !== "") {
                                var_dump($value[1]);
                            }
                            echo "<br/>";
                        }
                    }
                    ?></pre>
                                        
                </div>
            </div>
            <?php
        }
    }

} 
?>
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
<script type='text/javascript'>

        function show_debugger() {
            if ($(".debugger").height() == "643") {
                $(".debugger").height(35);
                $(".debugger-content").height(400);
            } else {
                $(".debugger").height("643");
                $(".debugger-content").height(605);
            }

        }
</script>
