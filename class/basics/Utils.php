<?php


namespace basics;


class Utils
{
    static function debug_to_console($data) : void
    {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);

        echo "<script>console.log( 'PHP Debug: " . $output . "' );</script>";
    }

    static function cryptPassword($login, $password) : string
    {
        return hash('sha512', $login . $password . "8n7WF3CayidE9Jg9Nd83");
    }

    static function generateRandomString($length) : string
    {
        $chars = "azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN1234567890";
        $str = substr(str_shuffle(str_repeat($chars, 60)), 0, $length);
        return $str;
    }

    static function redirect($page) : void
    {
        header("Location: " . $page);
        die();
    }

    static function parseBBCODE($text) : string
    {
        $text = html_entity_decode($text);
        $translator = array(
            '\[b\](.*?)\[\/b\]' => '<strong>$1</strong>',
            '\[i\](.*?)\[\/i\]' => '<i>$1</i>',
            '\[u\](.*?)\[\/u\]' => '<u>$1</u>',
            '\[center\](.*?)\[\/center\]' => '<div class="center">$1</div>',
            '\[img\](.*?)\[\/img\]' => '<img src="$1" style="max-width: 50%; height: auto;" />',
            '\[video=(.*?):\/\/youtu.be\/(.*?)\]\[\/video\]' => '<object type="application/x-shockwave-flash" width="560" height="315" data="https://www.youtube.com/v/$2"> <param name="movie" value="https://www.youtube.com/v/$2" /> <param name="allowFullScreen" value="true" /> </object>',
            '\[video=(.*?):\/\/www.youtube\.com\/watch\?v=(.*?)\]\[\/video\]' => '<object type="application/x-shockwave-flash" width="560" height="315" data="https://www.youtube.com/v/$2"> <param name="movie" value="https://www.youtube.com/v/$2" /> <param name="allowFullScreen" value="true" /> </object>',
            '\[video=(.*?):\/\/youtube\.com\/watch\?v=(.*?)\]\[\/video\]' => '<object type="application/x-shockwave-flash" width="560" height="315" data="https://www.youtube.com/v/$2"> <param name="movie" value="https://www.youtube.com/v/$2" /> <param name="allowFullScreen" value="true" /> </object>',
            '\[video=(.*?):\/\/m.youtube\.com\/watch\?v=(.*?)\]\[\/video\]' => '<object type="application/x-shockwave-flash" width="560" height="315" data="https://www.youtube.com/v/$2"> <param name="movie" value="https://www.youtube.com/v/$2" /> <param name="allowFullScreen" value="true" /> </object>',
            '\[url=(.*?)\](.*?)\[\/url\]' => '<a href="$1">$2</a>',
            '\[color=(.*?)\](.*?)\[\/color\]' => '<span style="color: $1">$2</span>',
            '\[size=(.*?)\](.*?)\[\/size\]' => '<span style="font-size: $1em">$2</span>',
            '\[tab\](.*?)\[\/tab\]' => '<div class="tab">$1</div>',
            '\[line\/\]' => '<hr/>',
            '\[list=\*\](.*?)\[\/list\]' => '<ul>$1</ul>',
            '\[list\](.*?)\[\/list\]' => '<ul>$1</ul>',
            '\[\*\](.*?)\[\/\*\]' => '<li>$1</li>',
            '\[list=1\](.*?)\[\/list\]' => '<ol>$1</ol>'
        );
        foreach ($translator as $k => $v)
        {
            $text = preg_replace('/' . $k . '/s', $v, $text);
        }

        $text = nl2br($text);
        //$text = stripslashes($text);

        return $text;
    }

    public static function convertToBBCODE($content) : string
    {
        $ncontent = str_ireplace("\n", "", $content); //Enlève les \n du html
        $ncontent = str_ireplace("\r", "", $ncontent); //Enlève les \n du html
        $ncontent = preg_replace("/<span class=\"rpblock (\w*)\"[^<]+<\/span>/", "[rp=$1]", $ncontent);
        $ncontent = preg_replace("/<div(.*?)>(.*?)<\/div>/s", "$2", $ncontent);
        $ncontent = preg_replace("/<font(.*?)>(.*?)<\/font>/s", "$2", $ncontent);
        $ncontent = str_replace("<br>", "\n", $ncontent);
        $ncontent = str_replace("<br/>", "\n", $ncontent);
        $ncontent = preg_replace("/<font(.*?)>(.*?)<\/font>/s", "$2", $ncontent);
        $ncontent = preg_replace("/<span(.*?)>(.*?)<\/span>/s", "$2", $ncontent);
        $ncontent = preg_replace("/<p(.*?)>(.*?)<\/p>/s", "$2", $ncontent);
        //$ncontent = addslashes($ncontent);
        return $ncontent;
    }

    static function uploadImg($dir, $name, $img)
    {
        $upload_dir = $dir;
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = $upload_dir . $name . ".png";
        $success = file_put_contents($file, $data);
        return $success;
    }

    static function processMultipleImages($dir, $arrayinput_name)
    {
        $total = count($_FILES[$arrayinput_name]['name']);

        for( $i=0 ; $i < $total ; $i++ ) {

            //Get the temp file path
            $tmpFilePath = $_FILES[$arrayinput_name]['tmp_name'][$i];

            //Make sure we have a file path
            if ($tmpFilePath != ""){
                //Setup our new file path
                $newFilePath = $dir . $_FILES[$arrayinput_name]['name'][$i];

                //Upload the file into the temp dir
                move_uploaded_file($tmpFilePath, $newFilePath);
            }
        }
    }

    static function setObject($array, $className)
    {
        if (class_exists($className))
        {
            $object = new $className();
            if($array)
            {
                foreach ($array as $key => $value) {
                    $keyWords = explode("_", $key);
                    $funcName = "set";
                    foreach ($keyWords as $key) {
                        $funcName .= ucfirst($key);
                    }
                    $func = ($funcName);
                    if (method_exists($object, $funcName)) {
                        $object->$func($value, true);
                    }
                }
                return $object;
            }
            return null;
        }
        return null;
    }

    static function setObjects($array, $className) : ?array
    {
        if (class_exists($className))
        {
            $objs = array();

            foreach ($array as $obj)
            {
                $object = new $className();
                Utils::setObject($object, $obj);
                array_push($objs, $object);
            }
            return $objs;
        }
        return null;
    }

    static function getUserIpAddr() : string
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
        {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else
        {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
}