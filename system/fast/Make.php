<?php

class Make
{
    public function request($file_name, $type)
    {
        if (strpos($file_name, '/')) {
            $this->make_tree_file($file_name,$type);
        } else {
            $this->make_file($file_name,$type);
        }
        return ucfirst($type) . " created successfully\n\n";

    }

    public function make_file($class,$type)
    {
        $namespace = 'App\\'.$type.'s';
        chdir(__DIR__."/../../application/".$type."s");
        $file = ucfirst($class) . '.php';
        if(file_exists($file)){
            echo "File Already Exists";
            exit;
        }
        fopen($file, 'w+');
        $template = __DIR__ . '/'.$type.'.tpl';
        $template_date = fopen($template, 'r');
        $content = fread($template_date, filesize($template));
        $org_data = ["CLASS_NAME", "NAME_SPACE"];
        $up_data = [ucfirst($class), $namespace];
        $content = str_replace($org_data, $up_data, $content);
        str_replace('_class_name_', $class, $content);
        file_put_contents($file, $content);
        return $class;
    }

    public function make_tree_file($file_name,$type)
    {
        $namespace = 'App\\'.$type.'s';
        $trees = explode('/', $file_name);
        $class = end($trees);
        array_pop($trees);
        chdir(__DIR__."/../../application/".$type."s");
        foreach ($trees as $tree) {
            if (!file_exists($tree)) {
                mkdir($tree, 07000);
                chdir($tree);
                $namespace .= "\\$tree";
            }else{
                chdir($tree);
                $namespace .= "\\$tree";
            }
        }
        
        $file = ucfirst($class) . '.tpl';
        if(file_exists($file)){
            echo "File Already Exists\n\n";
            exit;
        }
        fopen($file, 'w+');
        $template = __DIR__ . '/'.$type.'.tpl';
        $template_data = fopen($template, 'r');
        $content = fread($template_data, filesize($template));
        $org_data = ["CLASS_NAME", "NAME_SPACE"];
        $up_data = [ucfirst($class), $namespace];
        $content = str_replace($org_data, $up_data, $content);
        file_put_contents($file, $content);
        return $class;
    }
}