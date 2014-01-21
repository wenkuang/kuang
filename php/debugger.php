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
        background-color: rgb(10, 10, 10);
        color:white;
    }
    .debugger-content{
        width:100%;
        height:400px;
        overflow: scroll;
        padding-left:30px;
    }
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
                <pre class='debugger-content'><?php
                    if (!empty(self::$data)) {
                        foreach (self::$data as $key => $value) {
                            if ($value[2]) {
                                echo "<b>";
                                print_r($value[0]);
                                echo "</b>";
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
                    ?>
                                        
                </pre>
            </div>
            <?php
        }
    }

}
?>
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
<script type='text/javascript'>

        function show_debugger() {
            if ($(".debugger").height() == 400) {
                $(".debugger").height(35);
            } else {
                $(".debugger").height(400);
            }

        }
</script>
