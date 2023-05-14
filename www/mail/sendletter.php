<?php 

require_once ('config_mail.php'); 

// если нажата кнопка "отправить сообщение"
if (isset ($_POST['send']))
{
    $sender = $_POST['sender'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $text = $_POST['text'];
    
    // если хотя бы одно из обязательных полей не заполнено
    if ((empty ($_POST['sender'])) OR (empty ($_POST['email'])) OR (empty ($_POST['text'])))
    {
        // выводим сообщение о том, что не все поля заполнены
        echo $warning;              
    }
    
    // если все поля заполнены
    else
    {   
        $sender = stripslashes (htmlspecialchars($sender));
        $email = stripslashes (htmlspecialchars($email));
		$tel = stripslashes (htmlspecialchars($tel));
        $text = stripslashes (htmlspecialchars($text));
        
        // если введенный email-адрес не подходит по формату
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {   
            // выводим предупреждающее сообщение и останавливаем скрипт
            echo $email_warning;
            exit();
        }
        
        $message = "Пишет: $sender\nТема: $subject\nE-mail: $email\Телефон: $tel\nСообщение: $text";
        
        // если сообщение было отправлено успешно
        if (mail ($mymail,$topic,$message,"Content-type:text/plain;charset = UTF-8\r\n"))
        {   
            // перенаправляем на задааную в настройках страницу
            echo "<meta http-equiv='Refresh' content='4; url=$url'>";
            
            // Выводим сообщение об успешной отправке и останавливаем скрипт
            echo $success;
            exit();                     
        }
        
        // если сообщение не было отправлено
        else
        {
            // выводим сообщение об ошибке и останавливаем скрипт
            echo $fail;
            exit();
        }        
    }     
}

// если не нажата кнопка "отправить сообщение"
else
{
    // выводим предупреждающее сообщение о попытке прямого доступа к обработчику
    echo $direct_access;    
}
?>