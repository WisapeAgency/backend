## 接口说明 暂不理会这块

所有接口的http header加入token参数作为校验

token的计算方式为:

所有请求参数字串md5加密 如：

md5(a=b&b=c$expires=time),所有请求的参数按ascii顺序排序加密
time为当前UTC 时区的时间戳 为当前请求的请求时间

user_token 为整个平台用户识别的一个标记，不再象duorey传uid及email或其它识别参数
user_token 永久有效
除了用户注册外，其它都需要放到header头中

除了注册登陆及特殊接口外，其它http header还需要加入
token:'ccccccc'
user_token:'ccccccc'


============================================
从这里开始

## 注册/登陆
#url  v1/user/login

#email注册
1)type =1
2)user_email
3)user_pwd  md5后传过来

```javascript
{
success: 1
data: {
user_sex: "S"
user_token_id: "1364"
user_email: "abdddc@dddfadf.com"
user_pwd: "134d2faab6219d698ea5d30ab75602a8"
nick_name: "abdddc"
user_ext: "1"
user_id: "1366"
user_ext_id: null
user_ext_name: null
user_ico_n: null
user_ico_b: null
user_ico_s: null
user_back_img: null
user_token: "d7bba7e09228f3e17616fa27677e0aeeb9740e92"
token_start: 1435743147
token_end: 1435746747
}-
message: ""
}

```
#第三方用户注册
1）user_ext_id
2）user_ico 用户头象
3)nick_name 用户昵称
4)unique_str 第三方平台唯一标识

成功时返回
```javascript
{
success: 1
data: {
user_sex: "S"
user_token_id: 0
nick_name: "adfddd"
unique_str: "ffddss222"
user_ext: "2"
user_ext_name: "face_book"
user_ico_b: "xxxxx.jpg"
access_token: "12f92047590eff25db400a459164ec19"
user_id: "1369"
user_pwd: null
user_email: null
user_ico_n: null
user_ico_s: null
user_back_img: null
}-
message: ""
}
```
