<?php

class Pager {

    private $page = 1;
    private $page_size;
    private $page_count;
    private $page_start;
    private $page_num;
    public $page_data;
    private $url;

    public function __construct($data, $url) {
        $this->page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $this->page_size = C("PAGE_SIZE");
        $this->page_data = $data;
        $this->url = $url;
        $this->page_count = count($this->page_data);
        $this->page_start = ($this->page - 1) * $this->page_size;
        $this->page_num = ceil($this->page_count / $this->page_size);
    }

    public function getPageData() {
        return array_slice($this->page_data, $this->page_start, $this->page_size);
    }

    function show_page() {
        $page_list_str = '<ul class="pagination">';
        $url = $_SERVER['REQUEST_URI'];
        if (strpos($url, "?s") === FALSE) {
            $url = $_SERVER['PHP_SELF'] . "?s=/Index/index/";
        }
        $pattern = '/page\/\d+/i';
        $url = preg_replace($pattern, "", $url);
        $pattern2 = "/\/\//";
        $url = preg_replace($pattern2, "/", $url);
        $pre_page = max($this->page - 1, 1);
        if ($this->page_count > $this->page_size) {
            $page_list_str .="<li><a href='" . $url . "/page/" . $pre_page . "'>&laquo;</a></li>";
        }
        if ($this->page_num > 1) {
            for ($i = 1; $i <= $this->page_num; $i++) {
                $active = "";
                if ($_GET['page'] == $i) {
                    $active = "class='active'";
                }
                if ($i <= 10) {
                    $page_list_str .= "<li $active><a href='" . $url . "/page/$i'>" . $i . "</a></li>";
                }
            }
        }
        if ($this->page_count > $this->page_size) {
            $next_page = min($this->page + 1, $this->page_num);
            $page_list_str .="<li><a href='" . $url . "/page/" . $next_page . "'>&raquo;</a></li>";
            if ($this->page_count > 10) {
                $p = $this->page;
                $page_list_str .= '<li><div class="col-xs-2" ><input type="text" class="form-control page_num" value="' . $p . '" placeholder="' . $p . '"></div></li>';
                $page_list_str .= "<li ><a class='page_go' url='" . $url . "'>Go</a></li>";
            }
        }
        $page_list_str .= '</ul>';
        $page_list_str .="<script type='text/javascript'>$('.page_go').click(function(){var u = $('.page_go').attr('url') + '/page/' + $('.page_num').val();location.href=u;});</script>";
        return $page_list_str;
    }

}
