# http-class
http post/get方式提交数据


安装 composer require hahadu/http-class
使用：
$http = new \Hahadu\HttpClass\HttpClient();

```puml
use Hahadu\HttpClass\HttpClient;
HttpClient::post('http://url',array());’

HttpClient::get('http://url',array());’

```
