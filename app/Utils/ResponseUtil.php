<?php

namespace App\Utils;

class ResponseUtil
{
    /**
     * @param string $message
     * @param mixed  $data
     *
     * @return array
     */
    public static function makeResponse($data ,$message, $primaryKey ,$type,$paging)
    {
        $totalRows=0;
        if($type=='xml'){
            return [
                'status' => 2,
                'massages' => array("msg" => $message),
                'TotalRows' => $totalRows,
                'js_msg' => 'no',
                'redirect' => 'yes',
                'where' =>$data[$primaryKey],
            ];
        }
 
        
        if ($paging){
           $data=$data['data']; 
           $totalRows=$data['total']; 
        } 
        return [
            'success' => true,
            'data'    => $data,
            'message' => $message,
            'TotalRows' => $totalRows
        ];

    }

    /**
     * @param string $message
     * @param array  $data
     *
     * @return array
     */
    public static function makeError($message, array $data = [],$type)
    {
        if($type=='xml'){
            return [
                'status' => 1,
                'massages' => array("msg" => $message),
                'js_msg' => 'no',
                'redirect' => 'yes',
                'where' => '',
            ];
        }
        $res = [
            'success' => false,
            'message' => $message,
        ];

        if (!empty($data)) {
            $res['data'] = $data;
        }

        return $res;
    }
}