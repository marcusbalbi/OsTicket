<?php
if(!defined('OSTCLIENTINC')) die('Kwaheri');

$e=Format::input($_POST['lemail']?$_POST['lemail']:$_GET['e']);
$t=Format::input($_POST['lticket']?$_POST['lticket']:$_GET['t']);
?>
<div>
    <?php if($errors['err']) {?>
        <p align="center" id="errormessage"><?php echo $errors['err']?></p>
    <?php }elseif($warn) {?>
        <p class="warnmessage"><?php echo $warn?></p>
    <?php }?>
</div>
<div style="margin:5px 0px 100px 0;text-align:center; width:100%;">
    <span class="error"><?php echo Format::htmlchars($loginmsg)?></span>
    <form action="login.php" method="post">
    <table cellspacing="1" cellpadding="5" border="0" bgcolor="#000000" align="center">
        <tr bgcolor="#EEEEEE"> 
            <td><?php echo $trl->translate('LABEL_EMAIL'); ?>:</td><td><input type="text" name="lemail" size="25" value="<?php echo $e?>"></td>
            <td>Senha:</td><td><input type="password" name="pass" size="10" value=""></td>
            <td><input class="button" type="submit" value="Efetuar Login"></td>
        </tr>
    </table>
    </form>
</div>
