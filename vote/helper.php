<?php
/**
 * curl抓取网页方法
 *
 * @param string $url  目标网址
 * @param array  $data 传输数据
 * @param string $urlype 请求类型
 * @param int    $ssl  是否是https网关
 * @param bool   $raw  是否输出原生内容
 *
 * @param bool   $is_mobile 是否是手机ua
 *
 * @return array $output 返回内容  [body]页面内容 [http_code]是响应码
 */
function curlHttp($url, $data=[], $urlype='get', $ssl=1, $raw=false, $is_mobile = false)
{
    $output = [];
    $data = is_array($data) ? http_build_query($data) : $data;
    if ($urlype == 'get') {
        $url = $url . '?' . $data;
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    if ($urlype == 'post') {
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $data);
    }
    if ($ssl) {
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch,CURLOPT_BINARYTRANSFER,1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);
    curl_setopt($ch,CURLOPT_MAXREDIRS,8);
//    curl_setopt($ch, CURLOPT_COOKIESESSION, true);
    curl_setopt($ch, CURLOPT_REFERER, true);
//    curl_setopt($ch, CURLOPT_COOKIEJAR, true);
//    curl_setopt($ch, CURLOPT_COOKIEFILE, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    $ua = $is_mobile
        ? 'Mozilla/5.0 (iPad; U; CPU OS 3_2_2 like Mac OS X; en-us) AppleWebKit/531.21.10 (KHTML, like Gecko) Version/4.0.4 Mobile/7B500 Safari/531.21.10'
//        ? 'Dalvik/1.6.0 (Linux; U; Android 4.1.2; DROID RAZR HD Build/9.8.1Q-62_VQW_MR-2)'
        : 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36';
    curl_setopt($ch,CURLOPT_USERAGENT, $ua);
    $res = curl_exec($ch);
    if ($raw) {
        return curl_getinfo($ch);
    }
    $res = convertToUTF8($res);
    $output['body'] = $res === false ? 'CURL RETURN ERROR:' . curl_error($ch) : $res;
    $output['http_code'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $output;
}

function convertToUTF8($words) {
    $charset = mb_detect_encoding($words, array('ASCII','GB2312','GBK','UTF-8'));
    if ($charset != "UTF-8") {
        $words = iconv($charset, "UTF-8//IGNORE", $words);
    }
    return $words;
}

function getAccessToken($cfg)
{
    $code = $_GET['code'];
    $access_url = 'https://zjuam.zju.edu.cn/cas/oauth2.0/accessToken';
    $params = [
        'client_id' => $cfg['app_key'],
        'client_secret' => $cfg['app_secret'],
        'redirect_uri' => $cfg['redirect_uri'],
        'code' => $code
    ];
    $res = curlHttp($access_url, $params, 'get');
    $response = filterResponse($res);
    $response += ['store_at' => time()];
//    file_put_contents($cfg['access_file'], json_encode($response));
    return $response;
}

function getAuthToken($cfg)
{
//    if (file_exists($cfg['access_file'])) {
//        $access = json_decode(file_get_contents($cfg['access_file']), true);
//        if (($access['store_at'] + $access['expires_in']) < time()) {
//            $access_token = $access['access_token'];
//        } else {
//            //请求新的
//            $access_token = getAccessToken($cfg)['access_token'];
//        }
//    } else {
//        //请求新的
//        $access_token = getAccessToken($cfg)['access_token'];
//    }
    $access_token = getAccessToken($cfg)['access_token'];
    return $access_token;
}

function getAuthInfo($cfg)
{
    $info = getSessionUser();
    if ($info == null) {
        $info_url = 'https://zjuam.zju.edu.cn/cas/oauth2.0/profile';
        $access_token = getAuthToken($cfg);
        $res = curlHttp($info_url, ['access_token' =>$access_token], 'get');
        $info = filterResponse($res);
        setSessionUser($info);
    }
    return $info;
}


function getSessionUser()
{
    return isset($_SESSION['info']) ? json_decode($_SESSION['info'], true) : null;
}

function setSessionUser($info)
{
    $_SESSION['info'] = json_encode($info);
}

/**
 * @param $res
 *
 * @return mixed
 * @throws \Exception
 */
function filterResponse($res)
{
    if ($res['http_code'] == 200) {
        $response = json_decode($res['body'], true);
        if (array_key_exists('errorcode', $response)) {
            throw new Exception('接口返回错误----> [errorcode]:'. $response['errorcode']."\t {$response['errormsg']}");
        }
        return $response;
    }
    throw new Exception('curl请求错误---->[http_code]:'.$res['http_code'] . "\t[body]:".$res['body']);

}

function getAuthorizenUrl($cfg)
{
    $auth_url = "https://zjuam.zju.edu.cn/cas/oauth2.0/authorize";
    $auth_url .= "?response_type=code&client_id={$cfg['app_key']}&redirect_uri={$cfg['redirect_uri']}";
    return $auth_url;
}