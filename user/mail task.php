<?php


$select="SELECT tasks.*  ,users.* , mt.user_id , mt.user_email AS MM , mt.user_name AS NN FROM tasks
    JOIN users ON tasks.reporter = users.user_id
     JOIN users AS mt  ON tasks.assignee = mt.user_id where `tasks`.`task_id`=$taskid";
      $run=mysqli_query($connect,$select);
 
$fetch=mysqli_fetch_assoc($run);
$task_name=$fetch['task_name'];
$assignee_name=$fetch['NN'];
$assignee_email=$fetch['MM'];
$reporter_name=$fetch['user_name'];
$reporter_email=$fetch['user_email'];
$msg="Dear $assignee_name, <br>
You've been assigned $task_name as a Task from $reporter_name
on ToDoHive. <br>
for any further questions don't hesitate to contact us <br> <br>
Best Regards, <br>
$reporter_name";

$mail->setFrom('mn.magdy455@gmail.com', 'website_name');          //sender mail address , website name
$mail->addAddress($assignee_email);      //reciever mail address
$mail->isHTML(true);                               
$mail->Subject = 'New task';             //mail subject
$mail->Body=($msg);                  //mail content
$mail->send(); 

