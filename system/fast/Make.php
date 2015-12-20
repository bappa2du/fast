<?php

class Make
{
    private $controller_path = FCPATH.'applicaion/controllers';
    private $model_path = FCPATH.'applicaion/models';
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
        $namespace = 'App\controllers';
        $file = $class . '.php';
        if(file_exists($file)){
            echo "File Already Exists";
            exit;
        }
        fopen($file, 'w+');
        $template = __DIR__ . '/'.$type.'.php';
        $template_date = fopen($template, 'r');
        $content = fread($template_date, filesize($template));
        $org_data = ["CLASS_NAME", "NAME_SPACE"];
        $up_data = [$class, $namespace];
        $content = str_replace($org_data, $up_data, $content);
        str_replace('_class_name_', $class, $content);
        file_put_contents($file, $content);
        return $class;
    }

    public function make_tree_file($file_name,$type)
    {
        $namespace = 'App\controllers';
        $trees = explode('/', $file_name);
        $class = end($trees);
        array_pop($trees);
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
        $file = $class . '.php';
        if(file_exists($file)){
            echo "File Already Exists\n\n";
            exit;
        }
        fopen($file, 'w+');
        $template = __DIR__ . '/'.$type.'.php';
        $template_data = fopen($template, 'r');
        $content = fread($template_data, filesize($template));
        $org_data = ["CLASS_NAME", "NAME_SPACE"];
        $up_data = [$class, $namespace];
        $content = str_replace($org_data, $up_data, $content);
        file_put_contents($file, $content);
        return $class;
    }
}