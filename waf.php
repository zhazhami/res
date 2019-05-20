<?php
    date_default_timezone_set('PRC');

    // 过滤
    function level3($strFiltKey, $strFiltValue){
        $filter = "\\<.+javascript:window\\[.{1}\\\\x|<.*=(&#\\d+?;?)+?>|<.*(data|src)=data:text\\/html.*>|\\b(alert\\(|confirm\\(|expression\\(|prompt\\(|benchmark\s*?\\(\d+?|sleep\s*?\\([\d\.]+?\\)|load_file\s*?\\()|<[a-z]+?\\b[^>]*?\\bon([a-z]{4,})\s*?=|^\\+\\/v(8|9)|\\b(and|or)\\b\\s*?([\\(\\)'\"\\d]+?=[\\(\\)'\"\\d]+?|[\\(\\)'\"a-zA-Z]+?=[\\(\\)'\"a-zA-Z]+?|>|<|\s+?[\\w]+?\\s+?\\bin\\b\\s*?\(|\\blike\\b\\s+?[\"'])|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT(\\(.+\\)|\\s+?.+?)|UPDATE(\\(.+\\)|\\s+?.+?)SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE)(\\(.+\\)|\\s+?.+?\\s+?)FROM(\\(.+\\)|\\s+?.+?)|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)|register_shutdown_function\\(.+\\)|array_walk\\(.+\\)|syslog\\(.+\\)|CallbackFilterIterator\\(.+\\)|filter_var\\(.+\\)|proc_get_status\\(.+\\)|chroot\\(.+\\)|mb_ereg_replace_callback\\(.+\\)|preg_filter\\(.+\\)|openlog\\(.+\\)|phpinfo\\(.+\\)|pfsockopen\\(.+\\)|system\\(.+\\)|chgrp\\(.+\\)|call_user_func\\(.+\\)|chr\(\\(.+\\)|options\\(.+\\)|register_tick_function\\(.+\\)|uasort\\(.+\\)|preg_replace_callback\\(.+\\)|array_filter\\(.+\\)|dl\\(.+\\)|ini_alter\\(.+\\)|exec\\(.+\\)|mb_ereg_replace\\(.+\\)|symlink\\(.+\\)|assert\\(.+\\)|readlink\\(.+\\)|fsocket\\(.+\\)|eval\\(.+\\)|uksort\\(.+\\)|array_udiff\\(.+\\)|ini_restore\\(.+\\)|fsockopen\\(.+\\)|passthru\\(.+\\)|array_reduce\\(.+\\)|proc_open\\(.+\\)|pcntl_exec\\(.+\\)|preg_replace\\(.+\\)|array_walk_recursive\\(.+\\)|chown\\(.+\\)|shell_exec\\(.+\\)|stream_socket_server\\(.+\\)|create_function\\(.+\\)|popepassthru\\(.+\\)|scandir\\(.+\\)";
        if(is_array($strFiltValue)){
            $strFiltValue = implode($strFiltValue);
        }
        if(preg_match('/'.$filter.'/is', $strFiltValue) == 1){
            die('hacker, go out!');
        }
    }
    
    function level2($strFiltKey,$strFiltValue){
        $filter = "<.*=(&#\\d+?;?)+?>|<.*(data|src)=data:text\\/html.*>|sleep\s*?\\([\d\.]+?\\)|UNION.+?SELECT(\\(.+\\)|\\s+?.+?)|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE)(\\(.+\\)|\\s+?.+?\\s+?)FROM(\\(.+\\)|\\s+?.+?)";
    
    if(is_array($strFiltValue)){
            $strFiltValue = implode($strFiltValue);
        }
    if(preg_match('/'.$filter.'/is', $strFiltValue) == 1){
        die('hacker, go out!');
        }

    }

    function level1($strFiltKey,$strFiltValue){
        $filter = "UNION.+?SELECT(\\(.+\\)|\\s+?.+?)|<.*=(&#\\d+?;?)+?>";

    if(is_array($strFiltValue)){
            $strFiltValue = implode($strFiltValue);
        }
    if(preg_match('/'.$filter.'/is', $strFiltValue) == 1){
        die('hacker, go out!');
        }

    }

    //ban掉扫描器ua
    function ua_kill(){
        $header = getallheaders();
        $filter = "^WVS|sqlmap|nessus|nikto";
        $header = implode($header);
        if(preg_match('/'.$filter.'/is', $header)){
            die("hacker,go out!");
        }
    }

    ua_kill();//kill some scan
    $allData = array($_GET, $_POST); //maybe add _cookie
    foreach($allData as $data){
        foreach($data as $key=>$value){
            level3($key, $value);
        }
    }

