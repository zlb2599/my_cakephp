项目说明
=======

## 如何安装？

### 1.获取源码

进入项目安装目录  

执行 `git clone https://git.xiaohe.com/BackEnd/PHP/Cls/crontab_1.0.git`

### 2. 项目配置

2.1. 复制 app/Config/core.default.php 到当前目录，文件命名为 core.php；  
2.2. 复制 app/Config/database.default.php 到当前目录，文件命名为 database.php；   
2.3. 根据实际环境配置修改`database.php` 和 `core.php`  
2.4. 确保目录`app/tmp/` 具有可写权限
2.5. 复制 app/Config/RedisConfig.default.php 到当前目录，文件命名为 RedisConfig.php；   

## 3. 定时任务

| 序号 | 状态 | 时间 | 功能 | 任务计划 |
| --- | --- | --- | --- | --- | 
| 1 | `已下线` | 每天凌晨5点执行 | 会员提现定时任务 | `Console/cake TimedTaskWithdraw member` |
| 2 | `已下线` | 每天凌晨5点执行 | 校长（会员）提现定时任务 | `Console/cake TimedTaskWithdraw headmaster` |
| 3 | `已下线` | 每天凌晨2点执行 | 更新课程排序脚本 | `Console/cake TimedTaskCourseSort comprehensive` |
| 4 | `运行中` | 每天凌晨执行 | 处理教师教龄 | `Console/cake DataHandleTeacher seniorityAutoIncrement` |
| 5 | `运行中` | 每5分钟执行一次 | 发票邮件推送 | `Console/cake DataHandleFinanceInvoices getFinanceInvoices` |
| 6 | `运行中` | 每3分钟执行一次 | 活动课程处理 | `Console/cake TimedTaskActivityGoods updateGoodsActivityData` |
| 7 | `运行中` | 每4分钟执行一次 | 招生管家老师上课定时推送提醒 | `Console/cake TimedTaskPushTheClassRegularly classNotice` |
| 8 | `运行中` | 每4分钟执行一次 | 家长端课程推送通知腾飞 | `Console/cake TimedTaskParentCoursePush ParentPushTengFei` |
| 9 | `运行中` | 每4分钟执行一次 | 家长端课程推送通知益学堂 | `Console/cake TimedTaskParentCoursePush ParentPushYixuetang` |
| 10 | `运行中` | 每4分钟执行一次 | 家长端课程推送通知学生汇 | `Console/cake TimedTaskParentCoursePush ParentPushXueshenghui` |
| 11 | `运行中` | 每4分钟执行一次 | 家长端课程推送通知佳一 | `Console/cake TimedTaskParentCoursePush ParentPushJiayi` |
| 12 | `运行中` | 每4分钟执行一次 | 家长端课程推送通知杰睿 | `Console/cake TimedTaskParentCoursePush ParentPushJierui` |
| 13 | `运行中` | 每4分钟执行一次 | 机构端推送通知 | `Console/cake TimedTaskMerchantAttendancesPush getmerchantAttendancePush` |
| 14 | `运行中` | 每4分钟执行一次 | 推送通知 | `Console/cake DataHandleParentCoursePush ParentPushJiayi` |
| 15 | `运行中` | 每天5点执行 | 处理健康 KPI 指标数据 | `Console/cake DataHandleKpiStatistics updateWholeKpiStatistic` |
| 16 | `运行中` | 每天5点执行 | 处理整体 KPI 指标数据 | `Console/cake DataHandleKpiStatistics updateHealthyKpiStatistic` |
| 17 | `已下线` | 每15分钟执行一次 | 处理校区排序值 | `Console/cake DataHandleCampus updateCampusStatistic` |
| 18 | `运行中` | 每30分钟执行一次 | 更新gc_district_goods_numbers中校区课程数量 | `Console/cake TimedTaskDistrictGoodsNumbers run` |


### 3. 目前生产环境正在执行的定时处理程序(待整理)

```
这些任务在DB01上
#取消订单
*/1 * * * * root /usr/sbin/shell/course_cancel_order.sh

#确认上课考勤分销提成
#*/1 * * * * root /usr/sbin/shell/course_confirm_course.sh
#*/1 * * * * root /usr/sbin/shell/course_attendance_balance.sh

#班级结课
59 23 * * * root /usr/sbin/shell/course_over_class.sh

#更新课程火爆度
0 1 * * * root /usr/sbin/shell/course_hot.sh

#更新课程综合排序值
* 2 * * * root /usr/sbin/shell/course_comprehensive.sh

#更新课程评价排序值
0 3 * * * root /usr/sbin/shell/course_evaluate.sh

#更新商家评星排序值
0 4 * * * root /usr/sbin/shell/institution_star.sh

#更新商家综合排序值
0 5 * * * root /usr/sbin/shell/institution_comprehensive.sh

#环信IM消息
#*/1  * * * * root /usr/sbin/shell/im_message.sh

#导入家长学员
###* */1 * * * root /usr/sbin/shell/import_parent.sh

#导入学员报名
*/5 * * * * root /usr/sbin/shell/import_sign_up.sh

#refresh_lesson
*/1 * * * * root /usr/sbin/shell/refresh_lesson.sh

#更新项目KPI
0 1 * * * root /usr/sbin/shell/project_kpi.sh
```
```
other上
#00 02 * * * source /etc/profile &&  cd /home/xiaohe/www/console/crontab_1.0/app && /home/xiaohe//www/console/crontab_1.0/lib/Cake/Console/cake TimedTaskCourseSort comprehensive
#00 05 * * * source /etc/profile &&  cd /home/xiaohe/www/console/crontab_1.0/app && /home/xiaohe//www/console/crontab_1.0/lib/Cake/Console/cake TimedTaskWithdraw member
#00 05 * * * source /etc/profile &&  cd /home/xiaohe/www/console/crontab_1.0/app && /home/xiaohe//www/console/crontab_1.0/lib/Cake/Console/cake TimedTaskWithdraw headmaster
00 00 * * * source /etc/profile &&  cd /home/xiaohe/www/console/crontab_1.0/app && /home/xiaohe//www/console/crontab_1.0/lib/Cake/Console/cake TimedTaskMemberOrderStatistics memberOrderStatistics
00 00 * * * source /etc/profile &&  cd /home/xiaohe/www/console/crontab_1.0/app && /home/xiaohe//www/console/crontab_1.0/lib/Cake/Console/cake  TimedTaskMemberOrderStatistics memberOrderVirtuaStatistics

```