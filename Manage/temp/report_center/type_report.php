<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 14-1-18
 * Time: 下午5:30
 */
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"] . '/');

include_once ROOT_PATH . 'Class/User_formater.php';
include_once ROOT_PATH . 'Class/ReportFactory.php';
include_once ROOT_PATH . 'Class/UserModel.php';
include_once ROOT_PATH . 'Class/DB.php';
include_once ROOT_PATH . 'Class/zhudan.php';
include_once ROOT_PATH . 'Class/ReportTypeTree.php';
include_once ROOT_PATH . 'Class/ReportTree.php';

global $Users;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $start_date = $_POST['startDate'];
    $end_date = $_POST['endDate'];

    $user_model = new UserModel();

    $type = $_POST['s_type'];//彩票类型
    switch ($type) {
        case 0:
            $type_name = '全部';
            break;
        case 1:
            $type_name = '广东快乐十分';
            break;
        case 2:
            $type_name = '重庆时时彩';
            break;
        case 6:
            $type_name = '北京赛车';
            break;
        case 5:
            $type_name = '幸运农场';
            break;
        case 9:
            $type_name = '江苏骰宝';
            break;
    }
    if ($type!=0  && $start_date==$end_date) {//只有在同一天并且写明彩票类型的情况下才会有期数这一说
        $number = $_POST['s_number'];//期数
    }
    $status = $_POST['Balance'];//结算状态 1为已结算，0为未结算

    $current_user_account_id = $Users[0]['g_name'];
    $current_login_id = $Users[0]['g_login_id'];
    switch ($current_login_id) {
        case $user_model->cop_id:
            $current_cid = 1;
            break;
        case $user_model->stock_id:
            $current_cid = 2;
            break;
        case $user_model->maina_id:
            $current_cid = 3;
            break;
        case $user_model->agent_id:
            $current_cid = 4;
            break;
        default:
            exit(alert('用户登录权限有误，请联系管理员'));
    }

    $tmp = zhudan::getZhudan('','','1','','','67552ea64c6dce1646a263bae714e788cd970d0d6f7899df9d58efd38d068693c4415e6e5f6d9d802711f3cbdea8d08358e703c3ba2f17faca3c2a2a681345de1373f21b19b0e01c677cb6ebc5e0b5f');
    $tree= new ReportTypeTree('total','total');
    $tree->buildTree($tmp);
    //print_r($tree->children[0]->children[0]->children[0]->parent);

/*    $current_user = ReportFactory::CreateUser($current_user_account_id,$current_cid);
    $current_type = ReportFactory::CreateType('all',$current_user);
    $current_view = ReportFactory::CreateTypeView($current_type);*/
    //()

} else {

}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="/wjl_tmp/steal.css"/>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script>
        $(document).ready(function(){

            $('.hc').click(function(){
                var id = $(this).attr('id');

                $('.'+id).toggle();
            });


        });

        function abc(){
            var obj = JSON.parse('<?php echo json_encode((object)$tree)?>');
            console.log('123');
            console.log(obj);
        }
    </script>
</head>
<body>
<div dom="main" class="main-content1" style="display: block;">
    <div id="reportForm_con">
        <div id="bet-type">
            <p class="bet-type">
                [全部]
                <span class="bluer">日期范围: </span><span name="date">2014-01-18~2014-01-18</span>
                <span class="bluer">报表分类:</span> 分类账-&gt; 后台 <a onclick="abc()" id="getBack">返回</a></p>
        </div>
        <?php $current_view->show();?>
        <!--  分类账   公司  表格 -->
        <div id="fcompany-reportForm" class="reportForm-table">

            <table class="bet-table z3-table">
                <colgroup>
                    <col class="">
                    <col class="">
                    <col class="">
                </colgroup>
                <thead>
                <tr>
                    <th>序号</th>
                    <th>玩法</th>
                    <th>注数</th>
                    <th>下注金额</th>
                    <th>会员盈亏</th>
                    <th>占成上缴</th>
                    <th class="sh1">分公司金额</th>
                    <th class="sh1">分公司佣金</th>
                    <th class="hc" id="sh1">分公司上缴</th>
                    <th>本级占成</th>
                    <th>补货奖金</th>
                    <th>补货佣金</th>
                    <th>后台盈亏</th>
                </tr>
                </thead>
                <tbody>
                <tr class="">
                    <td>1</td>
                    <td><a href="javascript:void(0)"
                           nav="cpClass=allClass&amp;type=class&amp;beforeDate=2014-01-18&amp;laterDate=2014-01-18&amp;categoryId=00&amp;settlement=1&amp;curr_cpClass=klcClass">[广东快乐十分]第一球</a>
                    </td>
                    <td><span>2</span></td>
                    <td><span>20</span></td>
                    <td><span>-19</span></td>
                    <td><span>16</span></td>
                    <td class="sh1"><span>-16</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>-15</span></td>
                    <td><span>16</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">15</span></td>
                </tr>
                <tr class="" bg="1"
                    style="background-color: rgb(202, 217, 255); background-position: initial initial; background-repeat: initial initial;">
                    <td>2</td>
                    <td>[广东快乐十分]第二球</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="" bg="1"
                    style="background-color: rgb(202, 217, 255); background-position: initial initial; background-repeat: initial initial;">
                    <td>3</td>
                    <td>[广东快乐十分]第三球</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>4</td>
                    <td>[广东快乐十分]第四球</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>5</td>
                    <td>[广东快乐十分]第五球</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>6</td>
                    <td>[广东快乐十分]第六球</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>7</td>
                    <td>[广东快乐十分]第七球</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>8</td>
                    <td>[广东快乐十分]第八球</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>9</td>
                    <td>[广东快乐十分]1~8 单双</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>10</td>
                    <td>[广东快乐十分]1~8 大小</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>11</td>
                    <td>[广东快乐十分]1~8 尾大尾小</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>12</td>
                    <td>[广东快乐十分]1~8 合数单双</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>13</td>
                    <td><a href="javascript:void(0)"
                           nav="cpClass=allClass&amp;type=class&amp;beforeDate=2014-01-18&amp;laterDate=2014-01-18&amp;categoryId=12&amp;settlement=1&amp;curr_cpClass=klcClass">[广东快乐十分]总和单双</a>
                    </td>
                    <td><span>4</span></td>
                    <td><span>400</span></td>
                    <td><span>-1</span></td>
                    <td><span>200</span></td>
                    <td class="sh1"><span>-1</span></td>
                    <td class="sh1"><span>1</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>200</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>14</td>
                    <td><a href="javascript:void(0)"
                           nav="cpClass=allClass&amp;type=class&amp;beforeDate=2014-01-18&amp;laterDate=2014-01-18&amp;categoryId=13&amp;settlement=1&amp;curr_cpClass=klcClass">[广东快乐十分]总和大小</a>
                    </td>
                    <td><span>4</span></td>
                    <td><span>400</span></td>
                    <td><span>-1</span></td>
                    <td><span>200</span></td>
                    <td class="sh1"><span>-1</span></td>
                    <td class="sh1"><span>1</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>200</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>15</td>
                    <td><a href="javascript:void(0)"
                           nav="cpClass=allClass&amp;type=class&amp;beforeDate=2014-01-18&amp;laterDate=2014-01-18&amp;categoryId=14&amp;settlement=1&amp;curr_cpClass=klcClass">[广东快乐十分]总和尾大尾小</a>
                    </td>
                    <td><span>4</span></td>
                    <td><span>400</span></td>
                    <td><span>-3</span></td>
                    <td><span>200</span></td>
                    <td class="sh1"><span>-3</span></td>
                    <td class="sh1"><span>1</span></td>
                    <td class="col1"><span>-2</span></td>
                    <td><span>200</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">2</span></td>
                </tr>
                <tr class="">
                    <td>16</td>
                    <td>[广东快乐十分]1~8 中发白</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>17</td>
                    <td>[广东快乐十分]1~8 方位</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>18</td>
                    <td>[广东快乐十分]1~4 龙虎</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>19</td>
                    <td>[广东快乐十分]任选二</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>20</td>
                    <td>[广东快乐十分]选二连组</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>21</td>
                    <td>[广东快乐十分]任选三</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>22</td>
                    <td>[广东快乐十分]选三前组</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>23</td>
                    <td>[广东快乐十分]任选四</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>24</td>
                    <td>[广东快乐十分]任选五</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>25</td>
                    <td>[广东快乐十分]正码</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>26</td>
                    <td>[幸运农场]第一球</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>27</td>
                    <td>[幸运农场]第二球</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>28</td>
                    <td>[幸运农场]第三球</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>29</td>
                    <td>[幸运农场]第四球</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>30</td>
                    <td>[幸运农场]第五球</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>31</td>
                    <td>[幸运农场]第六球</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>32</td>
                    <td>[幸运农场]第七球</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>33</td>
                    <td>[幸运农场]第八球</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>34</td>
                    <td>[幸运农场]1~8 单双</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>35</td>
                    <td>[幸运农场]1~8 大小</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>36</td>
                    <td>[幸运农场]1~8 尾大尾小</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>37</td>
                    <td>[幸运农场]1~8 合数单双</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>38</td>
                    <td>[幸运农场]总和单双</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>39</td>
                    <td>[幸运农场]总和大小</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>40</td>
                    <td>[幸运农场]总和尾大尾小</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>41</td>
                    <td>[幸运农场]1~8 中发白</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr>
                    <td>42</td>
                    <td>[幸运农场]1~8 东南西北</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>43</td>
                    <td>[幸运农场]1~4 龙虎</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>44</td>
                    <td>[幸运农场]任选二</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>45</td>
                    <td>[幸运农场]选二连组</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>46</td>
                    <td>[幸运农场]选二连直</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr>
                    <td>47</td>
                    <td>[幸运农场]任选三</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>48</td>
                    <td>[幸运农场]任选四</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>49</td>
                    <td>[幸运农场]任选五</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>50</td>
                    <td>[幸运农场]正码</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>51</td>
                    <td>[幸运农场]选三前组</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>52</td>
                    <td>[北京赛车]冠军</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>53</td>
                    <td>[北京赛车]亚军</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>54</td>
                    <td>[北京赛车]第三名</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>55</td>
                    <td>[北京赛车]第四名</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>56</td>
                    <td>[北京赛车]第五名</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>57</td>
                    <td>[北京赛车]第六名</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>58</td>
                    <td>[北京赛车]第七名</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>59</td>
                    <td>[北京赛车]第八名</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>60</td>
                    <td>[北京赛车]第九名</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>61</td>
                    <td>[北京赛车]第十名</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr>
                    <td>62</td>
                    <td>[北京赛车]大小</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>63</td>
                    <td>[北京赛车]单双</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr>
                    <td>64</td>
                    <td>[北京赛车]龙虎</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>65</td>
                    <td>[北京赛车]冠亚大小</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr>
                    <td>66</td>
                    <td>[北京赛车]冠亚单双</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>67</td>
                    <td>[北京赛车]冠亚和</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>68</td>
                    <td>[重庆时时彩]单码</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr>
                    <td>69</td>
                    <td>[重庆时时彩]两面</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr>
                    <td>70</td>
                    <td>[重庆时时彩]龙虎</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>71</td>
                    <td>[重庆时时彩]和</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>72</td>
                    <td>[重庆时时彩]豹子</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>73</td>
                    <td>[重庆时时彩]顺子</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>74</td>
                    <td>[重庆时时彩]对子</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>75</td>
                    <td>[重庆时时彩]半顺</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr class="">
                    <td>76</td>
                    <td>[重庆时时彩]杂六</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr>
                    <td>77</td>
                    <td>[江苏骰宝]大小</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr>
                    <td>78</td>
                    <td>[江苏骰宝]三军</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr>
                    <td>79</td>
                    <td>[江苏骰宝]围骰</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr>
                    <td>80</td>
                    <td>[江苏骰宝]全骰</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr>
                    <td>81</td>
                    <td>[江苏骰宝]点数</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr>
                    <td>82</td>
                    <td>[江苏骰宝]长牌</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                <tr>
                    <td>83</td>
                    <td>[江苏骰宝]短牌</td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="sh1"><span>0</span></td>
                    <td class="col1"><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">0</span></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td><span class="bluer">总计</span></td>
                    <td><span>14</span></td>
                    <td><span>1,220</span></td>
                    <td><span>-26</span></td>
                    <td><span>616</span></td>
                    <td class="sh1"><span>-22</span></td>
                    <td class="sh1"><span>3</span></td>
                    <td class="col1"><span>-19</span></td>
                    <td><span>616</span></td>
                    <td><span>0</span></td>
                    <td><span>0</span></td>
                    <td><span class="win">19</span></td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

</body>

