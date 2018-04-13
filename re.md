# 用户登录

# 添加验证码

# 资源路由和资源控制器

# 隐性路由模型绑定

# 表单请求类验证用户数据

# 图片上传

# 图片裁剪

# 授权策略控制用户访问

# 删除表并重新填充数据
    php artisan migrate:refresh --seed

# 代码生成器

# debugbar

# 使用预加载修复 N+1 问题

# 使用拓展包实现连接选中的状态

# Laravel 本地作用域

# 模型观察器监控 Eloquent 模型事件

# 集成 WYSIWYG 编辑器

# 编辑器上传图片

# XSS 机制， 使用 HTML Purifier 防范

# 使用 Guzzle 调用外部 API

# 路由参数可选的使用

# 队列系统的使用，新建任务类，命令行监听

# Horizon 使用

# blade 语法 includeWhen

# 使用模型监控器实现计数器

# laravel 消息通知 database email

# 重写 Trait -- Notifiable notify()

# 使用队列发送邮件

# 使用监控器 实现连带删除

# 多角色用户权限

# 使用 laravel-permission 构建多用户权限管理系统

# 使用授权类的过滤器来全局授权用户

# 使用 sudo-su 切换用户

# 管理界面 Administrator 的使用

# Eloquen 修改器的使用

# Traits 的使用

# 使用缓存系统

# 自定义 Artisan 命令

# 使用任务调度功能

# 两种数据损坏的解决方案 
    代码监听器 -- 利用 Eloquent 监控器实现连带删除
    MySql 的外键约束 -- 保持数据的一致性

# 自定义中间件来统计用户最后的访问时间

# 使用 Redis 哈希表来缓解数据库压力

# RESTful

# DingoApi

# PostMan

# 手机 APP 注册

# 短信运营商

# 图片验证码接口 短信验证码接口 注册用户接口

# api.throttle 限制接口调用频率

# Socialite OAuth 2.0

# JWT and jwt-auth

# 第三方登录、用户登录等接口

# 使用 Fractal 转换模型数据

# 获取用户信息接口

# 编辑用户信息接口

# 使用接口上传图片

# 实现 category 列表接口

# 实现话题，列表，发布，修改，删除接口，

# 了解资源与资源的嵌套，引入，及 N+1 问题

# 实现回复列表，发布，删除接口

# 了解资源的嵌套

# 消息通知接口
https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx6de951435fc487da&redirect_uri=http://larabbs.test&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect

https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx6de951435fc487da&secret=2a2f19fc5b141e1a1ef712f77e953972&code=081poI2T00AuaX1aoz3T0ZMQ2T0poI2I&grant_type=authorization_code

https://api.weixin.qq.com/sns/userinfo?access_token=8_rKK1S6vLRXg96-f3FE0RYviTkqonchYbC5UeL-kmuZZH2XViaGrOHKJI6nxqKXp5WZsFlGWl858BGCJ-JGjIPQ&openid=opmZ91kc_HIsyZaaPwQyE8A2dxn8&lang=zh_CN