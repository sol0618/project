<?php
class Test_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    public function gets(){
        //echo $_SERVER['DOCUMENT_ROOT'];
        $file = fopen($_SERVER['DOCUMENT_ROOT']."/list.txt", "r");
        $readData = array();
        while(!feof($file)){
            $buffer = fgets($file);
//            echo $buffer.'<br>';
            if(!feof($file)){
                array_push($readData, $buffer);
            }
        }
        fclose($file);
        return $readData;
    }

    public function insert($number, $title, $count, $date) {
        $file = fopen($_SERVER['DOCUMENT_ROOT']."/list.txt", "a");

        fwrite($file, $number.';');
        fwrite($file, $title.';');
        fwrite($file, $count.';');
//        fwrite($file, $date);
        fwrite($file, $date."\n");

        fclose($file);
    }

    public function select($keyword){
        $file = fopen($_SERVER['DOCUMENT_ROOT']."/list.txt", "r");
        $readData = array();

        while(!feof($file)){
            $buffer = fgets($file);

            $str =  explode(';', $buffer);

            for ($i = 0; $i < sizeof($str); $i++) {
                if ($i == 1) {
                    if(strpos($str[$i], $keyword) !== false){
                        array_push($readData, $buffer);
                    }
                }
            }
        }

        fclose($file);
        return $readData;
    }

    public function update($number, $title){
        $file = fopen($_SERVER['DOCUMENT_ROOT']."/list.txt", "a+");
        $readData = array();

        while(!feof($file)){
            $buffer = fgets($file);
            $str =  explode(';', $buffer);

            if($str[0] == $number){
                $buffer = substr_replace($buffer, $str[0].';'.$title.';'.$str[2].';'.$str[3], 0);
                array_push($readData, $buffer);
//                $point = ftell($str[0]);
//                fseek($file, $point, 0);
            } else {
                array_push($readData, $buffer);
            }
        }
        fclose($file);

        $file2 = fopen($_SERVER['DOCUMENT_ROOT']."/list.txt", "w");
        foreach($readData as $data){
            fwrite($file2, $data);
        }
        fclose($file2);
    }

    public function delete($date){
        $file = fopen($_SERVER['DOCUMENT_ROOT']."/list.txt", "r");
        $readData = array();

        while(!feof($file)){
            $buffer = fgets($file);
            if(strpos($buffer, $date) == false){
                array_push($readData, $buffer);
            }
        };
        fclose($file);

        $file2 = fopen($_SERVER['DOCUMENT_ROOT']."/list.txt", "w");
        foreach($readData as $data){
            fwrite($file2, $data);
        }
        //file_put_contents($file2, $readData);
        //fwrite($file2, $readData);

        fclose($file2);
    }

    public function check($number){
        $file = fopen($_SERVER['DOCUMENT_ROOT']."/list.txt", "r");
        $msg = "";

        while(!feof($file)){
            $buffer = fgets($file);
            $str =  explode(';', $buffer);

            for ($i = 0; $i < sizeof($str); $i++) {
                if ($i == 0) {
                    if(strcmp($str[$i], $number)){
                        //다르다
                        $msg = "true";
                    } else {
                        //같다
                        $msg = "false";
                        fclose($file);
                        return $msg;
                    }
                }
            }
        }
        fclose($file);
        return $msg;
    }
}
