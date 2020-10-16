<?php
// +----------------------------------------------------------------------
// | hahadu 
// +----------------------------------------------------------------------
// | Copyright (c) 2020 hahadu All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | jobs: 接各种定制
// +----------------------------------------------------------------------
// | Author: hahadu <582167246@qq.com>
// +----------------------------------------------------------------------

namespace Hahadu\HttpClass;
class Http{
    /**
     *http curl post提交数据
     *@param string $url
     *@param array $post_data
     */
    public function post($url = '', $post_data = array()) {
        if (empty($url) || empty($post_data)) {
            return false;
        }

        $o = "";
        foreach ( $post_data as $k => $v ) 
        { 
            $o.= "$k=" . urlencode( $v ). "&" ;
        }
        $post_data = substr($o,0,-1);

        $postUrl = $url;
        $curlPost = $post_data;
        $ch = curl_init();//初始化curl
        if(stripos($url, 'https://') !== FALSE) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($ch, CURLOPT_SSLVERSION, 1);
        }
        curl_setopt($ch, CURLOPT_URL,$postUrl);//抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        $content = curl_exec($ch);//运行curl
		$status = curl_getinfo($ch);
        curl_close($ch);
        if (isset($status['http_code']) && $status['http_code'] == 200) {
            return $content;
        } else {
            return FALSE;
        }
    }      

    /**
     * http curl get
     * @param string $url
     * @param string $data_arr
     * @return mixed|boolean
     */
    public function get($url='', $data_arr=array()) {
        if (empty($url) || empty($data_arr)) {
            return false;
        }
        $o = "";
        foreach ( $data_arr as $k => $v )
        { 
            $o.= "$k=" . urlencode( $v ). "&" ;
        }
        $data_arr = substr($o,0,-1);
        $dataUrl = $url.'?'.$data_arr;

        $ch = curl_init();
        if(stripos($url, 'https://') !== FALSE) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($ch, CURLOPT_SSLVERSION, 1);
        }
        curl_setopt($ch, CURLOPT_URL, $dataUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
        $content = curl_exec($ch);
        $status = curl_getinfo($ch);
        curl_close($ch);
        if (isset($status['http_code']) && $status['http_code'] == 200) {
            return $content;
        } else {
            return FALSE;
        }
    }
}