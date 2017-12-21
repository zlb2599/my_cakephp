<?php
$app_path = str_replace('\\', '/', dirname(dirname(dirname(__FILE__))));
require_once $app_path.'/Vendor/JDPay/HttpUtils.php';
require_once $app_path.'/Vendor/JDPay/SignUtils.php';
require_once $app_path.'/Config/Contants.php';

/**
 * Class CommonComponent
 */
class JdPayComponent
{
    /**
     * 发送http请求
     * @param unknown $data 请求数据
     * @param unknown $url url
     * @param unknown $encryptType_RSA 加密类型，不加密传null
     */
    public function tradeRequest($data, $url, $encryptType_RSA)
    {
        $return_data;
        $data        = SignUtils:: enctyptData($data, $encryptType_RSA);
        $data_string = SignUtils:: paddingDataString($data);
        list ($return_code, $return_content) = HttpUtils:: http_post_data($url, $data_string);
        $return_content = str_replace("\n", '', $return_content);
        $return_content = str_replace("\r", '', $return_content);
        if ($return_content == null || "" == $return_content) {
            $return_data["response_code"]    = RETURN_PARAM_NULL;
            $return_data["response_message"] = "返回数据为空";

            return $return_data;
        }
        $return_data = json_decode($return_content, true);
        if (is_null($return_data)) {
            echo "返回非json格式".$return_content."\n";
            $return_data["response_code"] = $return_content;

            return $return_data;
        }
        $return_data1 = SignUtils::verifySing($return_data);

        return $return_data1;
    }

    /**
     * 判断返回码
     * @param unknown $objData 返回数据
     * @param unknown $isQuery 是否查询返回数据
     */
    public function rescode($objData, $isQuery)
    {
        $response_code = $objData["response_code"];
        if (Contants::SUCCESS == $response_code) {
            return $this->tradeCode($objData);
        } else if ($isQuery) {
            return array('success' => false, 'msg' => '查询异常，建议不做数据处理', 'status' => '3');
        } else if (!Contants::isContainCode($response_code)) {//返回编码不包含在配置中的
            $trade_status = $objData["trade_status"];
            if (!$trade_status || "" == $trade_status) {
                return array('success' => false, 'msg' => '返回编码不包含在配置中的,未知', 'status' => '3');
            } else {//返回编码不包含但$trade_status有状态，按状态处理
                return $this->tradeCode($objData);
            }
        } else if (Contants::SYSTEM_ERROR == $response_code || Contants::RETURN_PARAM_NULL == $response_code) {
            return array('success' => false, 'msg' => '未知', 'status' => '3');
            //TODO 未知业务逻辑或查询交易结果处理
        } else if (Contants::OUT_TRADE_NO_EXIST == $response_code) {
            return array('success' => false, 'msg' => '外部交易号已经存在', 'status' => '3');
            //TODO 需查询交易获取结果或等待通知结果
        } else {
            return array('success' => false, 'msg' => '失败', 'status' => '3');
        }
    }

    /**
     * 判断业务状态
     * @param unknown $objData 返回数据
     */
    public function tradeCode($objData)
    {
        $trade_status = $objData["trade_status"];
        if (Contants::TRADE_FINI == $trade_status) {
            return array('success' => true, 'msg' => '交易成功', 'status' => '1');
        } else if (Contants::TRADE_CLOS == $trade_status) {
            return array('success' => false, 'msg' => '尊敬的用户，您的报哪好账户提现失败，请联系400-002-1717【报哪好】', 'status' => '3');
        } else if (Contants::TRADE_WPAR == $trade_status || Contants::TRADE_BUID == $trade_status || Contants::TRADE_ACSU == $trade_status) {
            return array('success' => true, 'msg' => '等待支付结果，处理中', 'status' => '2');
        }
    }
}