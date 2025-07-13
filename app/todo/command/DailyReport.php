<?php
namespace app\todo\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\facade\Db;
use PHPMailer\PHPMailer\PHPMailer;

class DailyReport extends Command
{
    protected function configure()
    {
        $this->setName('todo:daily')->setDescription('每日发送待办邮件');
    }

    protected function execute(Input $input, Output $output)
    {
        $list = Db::name('todo_task')
            ->where('status',0)
            ->whereTime('plan_at','<=',date('Y-m-d'))
            ->select();
        if (!$list) return;

        $body = '今日待办：<br>';
        foreach ($list as $t) $body .= "· {$t['title']}<br>";

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.qq.com';
        $mail->SMTPAuth = true;
        $mail->Username = '你的邮箱@qq.com';
        $mail->Password = '授权码';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('你的邮箱@qq.com', 'TodoRobot');
        $mail->addAddress('目标邮箱@qq.com');
        $mail->isHTML(true);
        $mail->Subject = '今日待办提醒';
        $mail->Body    = $body;
        $mail->send();
        $output->writeln('mail sent');
    }
}