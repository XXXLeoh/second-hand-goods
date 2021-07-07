# 管理员界面详解
<!-- 商品种类：0——书籍 1——电子产品 2——学习工具 3——生活用品 4——其他-->

## 前端设计

由于时间不够充足，再加上我们对JavaScript都不是很了解，因此为了降低实现难度我选择牺牲展示效果。等到其他功能实现后，我会再考虑完善。

### 申请审核界面（主页）

> 以下的表格内容可自行更改

1. 主要内容：三个信息展示栏
2. 具体需求：
   * 操作记录信息：*simple table*
     * 列：
       * 操作类型
       * 执行者姓名
       * 操作对象（用户ID/商品ID/管理员ID）
       * 操作结果
       * 操作时间  
     * 行：10行最新消息
     * 链接——全部操作记录：
       * 位置：表格的左下角
       * 链接到一个展示全部操作记录的新页面
   * 密码修改信息：*Tricket Table*
     * 列（可自行添加内容）：
       * 用户ID
       * 原密码
       * 修改后密码
       * 通过/拒绝：两个按钮
     * 行：全部待处理信息
     * 链接——全部修改信息：
       * 位置：左下角
       * 链接到一个展示全部申请信息的页面
   * 商品发布申请信息：*Tricket Table*
     * 列（可自行添加内容）：
       * 商品ID
       * 商品发布者
       * 发布时长
     * 行：展示全部待审核信息
     * 链接——全部发布申请
       * 位置：左下角
       * 链接到一个展示全部申请信息的页面

> 展示全部信息的页面只需要一个表格和一个返回主页的按钮

### 系统管理界面

1. 主要内容：操作记录信息（后续会再添加一些图表）
2. 具体需求：
   * 操作记录信息展示：可以复用之前的表
   * 图表绘制：如果有时间学的话

### 商品管理界面

1. 主要内容：下架商品、添加商品分类、商品目录
2. 具体需求：
   * 下架商品（表单）：
     * 一个**text**输入框：输入商品ID
     * 一个**text**输入框：输入反馈信息
     * 一个按钮：下架
   * 添加商品分类（表单）：
     * 一个**text**输入框：输入商品ID
     * 一个**select**选择：选择商品分类
     * 一个按钮：添加
   * 商品目录：
     * 表格：*simple table*
     * 主要内容：
       * 商品类型
       * 商品名称
       * 商品发布者
       * 商品发布时间
       * 商品状态

### 账户管理界面

1. 主要内容：用户目录，冻结账户，管理员密码重置
2. 具体实现：
   * 用户目录
     * 表格：*simple table*
     * 主要内容：
       * 用户ID
       * 用户账号
       * 用户联系方式
   * 冻结账户
     * 一个**text**输入框：输入商品ID
     * 一个**text**输入框：输入反馈信息
     * 一个**select**选择：冻结时长
     * 一个按钮：冻结
   * 管理员密码重置
     * 一个**text**输入框：输入商品ID
     * 一个**text**输入框：输入反馈信息
     * 一个**select**选择：冻结时长
     * 一个按钮：冻结

<!-- 3. 管理员界面主页：
    * 操作记录信息
    * 商品发布申请信息
    * 密码修改申请信息
1. 左侧功能栏：三个分区
    * 系统管理
      * 展示全部记录信息
    * 商品管理
      * 商品目录（分类用表格显示）
        * 书写工具
        * 二手书籍
        * 饰品器件
        * 电子器件
        * 其他（可自己添加决定需要的，最终版暂时不确定）
      * 展示全部待审核商品信息
      * 下架商品（一张表单）
        * 一个**text**输入框：输入商品ID
        * 一个**text**输入框：输入反馈信息
        * 两个按钮：同意/拒绝
      * 添加商品分类（一张表单）
        * 一个**text**输入框：输入商品ID
        * 一个**select**选择：选择商品分类
        * 一个按钮：添加
    * 账户管理
      * 展示全部待审核密码修改申请
      * 管理员密码重置界面（一张表单）
        * 一个**text**输入框：输入管理员ID
        * 一个**text**输入框：输入原密码
        * 一个**text**输入框：重复密码
        * 一个按钮：重置
      * 冻结用户界面（一张表单）
        * 一个**text**输入框：输入商品ID
        * 一个**text**输入框：输入反馈信息
        * 一个**select**选择：冻结时长
        * 一个按钮：冻结
 -->
---

## 后端实现

### 系统记录

1. 功能：每次管理操作都会在这里留下记录
2. 实现：创建一个记录信息库，每次进行操作之后都把公告信息展示在此。按时间顺序展示
3. 形式：作为管理员界面主页，每一条消息不会太长，需要一个位置将这些讯息放好。

### 商品管理

#### 审核商品 

> 可以先不考虑

1. 功能：审核来自商家的商品发布申请信息，点击同意之后可以即可通过
2. 流程：创建一个**管理信息库**，将需要处理的商品ID发送到这个库里，处理完毕时发送一条反馈信息给商家，之后即可删除该条信息

#### 下架商品

1. 功能：输入商品ID，即可下架商品。下架后可向商家发送一条信息。
2. 实现：更新Goods库中的信息，将相应的

#### 为商品添加分类

1. 功能：输入商品ID，为其选择类型，点击确定即可添加
2. 实现：与Style库连接，插入一条新的分类信息

### 账户管理

#### 修改用户密码

1. 功能：由用户提交申请，有三天时间进行审核。三天内未审核默认修改密码成功。
2. 流程：同样将信息发送到**管理信息库**，将用户ID发送到该库里，处理完毕时发送反馈，之后即可删除该信息。

#### 重置用户密码

> 对管理员账号，管理员可随意重置自己的密码

1. 功能：输入自己的ID，以及原密码和修改后的密码，即可重置密码
2. 实现：修改Users数据库中的信息即可

#### 冻结用户

1. 功能：输入用户的ID，并选择冻结时长，即可冻结。
2. 实现：更新USers数据库中相应用户的user_time,同时将该ID对应的全部商品下架。将该user_time设置到冻结结束的那一天。