# 商品发布功能详解

<!-- ## Types 类

### 成员变量

1. type_id：类型编号
2. type_name：类型名称
3. good_id：商品编号
4. $conn：连接变量，与数据库的接口

### 成员函数

1. 构造函数(**function __construct()**):
   * 与数据库进行连接 $**conn**
2. get/set函数：提供对变量的接口 -->

## Goods 类

### 成员变量

1. good_id: 主键，商品编号
2. type_id: 外键，类型编号
3. good_name: 商品名称
4. good_describe: 商品介绍
5. good_image: 商品图片
6. good_price: 商品价格
7. start_time: 商品发布时间
8. end_time：结束时间
9. old_new: 新旧程度
10. good_state: 在售/停售
11. click_times：点击次数
12. good_owner：卖家用户名
13. good_contact：卖家联系方式
14. $conn：连接变量，与数据库的接口

### 成员函数

1. 构造函数(**function __construct()**)：
   * 与数据库进行链接  
   * 与服务器端保存图片的文件夹进行链接
2. 析构函数，关闭数据库
3. get与set函数(**get/set_variable_name(/s)**)：提供对变量的接口
4. 查询函数(**find_good_by_id()**)：获取商品信息，如果商品不存在，发挥False

---

## 商品发布功能 (**good_post(argu)**)

### 前端设计

1. 表单信息(*以下信息可自由排版*)：
    * 图片：支持上传图片和预览。
      * 建议：可设置为一个图片展示框，还未上传图片的时候就显示出一个**上传按钮**，上传成功后显示出刚刚上传的**图片**
      * 具体实现：前端把**上传按钮**和**展示图片**的代码的两端先写好，由后端进行实现

    * 商品名称：
    * 商品价格：
    * 商家地址：
    * 商品分类：
      * 实现方式：可从多个分区选项中选取一个
      * 建议：可用**select**标签实现
    * 商品描述：限制字数
    * 商品新旧程度：限制字数，50字节以内（如果觉得不需要也可以别加这个）
    * 商品发布时长(三个选择)：
      * 7天
      * 14天
      * 一个月
      * 其他（如果能够加上的话）
    * 联系方式：限制字数50个字节以内

### 后端设计

   1. 创建一个新的Goods类
   2. 判断是否读取全部数据，如果已读取跳转到完成界面；未读取则打印出适合的表单（**$_session**）
   3. 根据商家身份信息($_SESSION['user_id'])，获取商家用户名，保存进成员变量*good_owner*中
   4. 读取表单的文字信息，并插入Goods类的成员变量中
   5. 读取表单上传的图片，生成本地名称并保存到服务器端相应地址中。(**save_image()**)
   6. 检查商品发布时长，一个月以内的时间直接设置成员变量**good_state**为true，即在售。否则设置为false(**set_good_state()**)
   7. 获取当前时间，保存进成员变量*start_time*中，并根据商家填写的发布时长计算出结束时间，保存进成员变量*end_time*中(**set_good_time()**)
   8. 成员变量中的信息插入数据库**Goods**中(**good_insert()**)
   9. 根据类型编号*type_id*将商品ID*good_id*插入到数据库**Types**中(**type_insert()**);

---

## 商品展示功能(show())

### 前端设计

完成简单的排版即可，注意流出足够的空间容纳信息

1. 商品展示框
   * 展示信息：
     * 商品名称
     * 商品图片
     * 商品价格
     * 商品介绍(按实际情况决定是否加入)
   * 作用：
     * 作为检索结果展现给用户
     * 展示在主页(**index**)的下半部分
     * 点击该框(或者在左下角设置一个按钮)即可跳转到详细信息界面
2. 商品详细信息页面
   * 展示信息：
     * 商品ID
     * 商品名称
     * 商品介绍
     * 商品图片
     * 商品价格
     * 商品发布时间
     * 商品新旧
     * 卖家用户名
     * 卖家联系方式
   * 作用：
     * 用户在此处获取卖家的联系方式

### 后端设计

把信息打印到详细信息界面或展示框上

1. 创建一个Goods变量
2. 根据*good_id*从数据库中获取需要的信息
3. 将信息按照前端的设计打印到相应的位置

找到展示框的位置坐标

1. 根据需要打印的展示框数量，计算出坐标参数

# 数据库创建

~~~ Goods库
CREATE TABLE Goods (
   good_id INT PRIMARY KEY AUTO_INCREMENT,
   type_id INT,
   good_name VARCHAR(50) not null,
   good_describe text,
   good_address varchar(50),
   good_image VARCHAR(50),
   good_price INT NOT NULL,
   start_time ,
   end_time DATE,
   old_new VARCHAR(50),
   good_state INT,
   click_time INT DEFAULT 0,
   good_owner VARCHAR(50),
   good_contact VARCHAR(50)
)character set = utf8;
~~~