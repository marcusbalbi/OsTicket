<?php
if(!defined('OSTSCPINC') || !is_object($thisuser) || !$thisuser->isStaff()) die($trl->translate("TEXT_ACCESS_DENIED"));
$info=($_POST && $errors)?Format::input($_POST):array(); //on error...use the post data
?>
<div width="100%">
    <?php if($errors['err']) {?>
        <p align="center" id="errormessage"><?php echo $errors['err']?></p>
    <?php }elseif($warn) {?>
        <p class="warnmessage"><?php echo $warn?></p>
    <?php }?>
</div>
<form action="client.php" method="post">
<input type='hidden' name='t' value='new'>
<table width="80%" border="0" cellspacing="1" cellpadding="2">
    <tr><td align="left" colspan=2>Preencha todos os campos para criar o cliente</td></tr>
    <tr>
        <td align="left" nowrap width="20%"><b><?php  $trl->_('LABEL_EMAIL_ADDRESS')?>:</b></td>
        <td>
            <input type="text" name="email" id="email" size="25" value="<?php echo $info['email']?>" >
              &nbsp;<font class="error"><b>*</b>&nbsp;<?php echo $errors['email']?></font>
        </td>
    </tr>
     <tr>
        <td align="left" ><b><?php $trl->_('LABEL_FULL_NAME');?>:</b></td>
        <td>
            <input type="text" id="name" name="name" size="25" value="<?php echo $info['name']?>">
            &nbsp;<font class="error"><b>*</b>&nbsp;<?php echo $errors['name']?></font>
        </td>
    </tr>
        <tr>
        <td align="left" nowrap width="20%"><b>Senha:</b></td>
        <td>
            <input type="password" name="passwd" id="passwd" size="25" value="" >
              &nbsp;<font class="error"><b>*</b>&nbsp;<?php echo $errors['passwd']?></font>
        </td>
    </tr>
    <tr height=2px><td align="left" colspan=2 >&nbsp;</td></tr>
    <tr>
        <td></td>
        <td>
            <input class="button" type="submit" name="submit_x" value="Cadastrar Cliente">
            <input class="button" type="reset" value="Reset">
            <input class="button" type="button" name="cancel" value="Back" onClick='window.location.href="client.php"'>    
        </td>
    </tr>
</table>
  </form>
