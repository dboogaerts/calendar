<?php
//require_once './Foo.php';
function popol($args){
    echo "popol<br/>";
    if(is_file($args.".php")){
        
        require_once $args.".php";
    }
}
function jacky($args){
    echo "jacky<br/>
            -".$args."<br/>
";
    $path = str_replace("\\","/",$args).".php";
    
    if(is_file($path)){
        require_once $path;
    }
}
spl_autoload_register("popol");
spl_autoload_register("jacky");
$f = new Foo();
$b = new \M\Utils\Bar();
