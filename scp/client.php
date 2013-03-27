<?php
/*********************************************************************
    profile.php

    Staff's profile handle

    Peter Rotich <peter@osticket.com>
    Copyright (c)  2006-2010 osTicket
    http://www.osticket.com

    Released under the GNU General Public License WITHOUT ANY WARRANTY.
    See LICENSE.TXT for details.

    vim: expandtab sw=4 ts=4 sts=4:
    $Id: profile.php,v 1.1.2.2 2009/11/28 18:54:53 carlos.delfino Exp $
**********************************************************************/

require_once('staff.inc.php');
$msg='';
//Tab and Nav options.
$nav->setTabActive('clients');

if(!$errors && $_POST)
{
        switch(strtolower($_REQUEST['t'])):
    case 'edit':
        if(!isset($_REQUEST['id']))
        {
            $errors['err'] = "id not setted";  
          
        }
            if(!$errors)
            {
                $sql = "update ".CLIENT_TABLE." set fullname = "
                .db_input($_POST['name']).",email = "
                .db_input($_POST['email']);
              
                if(isset($_POST['passwd']) && strlen(trim($_POST['passwd'])) != 0)
                {
                    $sql .= " , passwd = ".db_input(md5($_POST['passwd']));
                }
                
                $sql .= " where id = ".$_REQUEST['id'];
                
                 if(db_query($sql) && db_affected_rows()){
                     $msg = "Client updated";
                 }
                 else
                 {
                    $errors['err']= "error trying to update the client.";
                 }
            }
        
        break;
    case 'new':
           $sql = "insert into ".CLIENT_TABLE."(fullname,email,passwd) values("
            .db_input($_POST["name"]).","
            .db_input($_POST['email']).","
            .db_input(md5($_POST['passwd'])).")"; 
           
        if (db_query($sql) && db_affected_rows()) {
                $msg = "Client created";
            } else {
                $errors['err'] = "error trying to create the client.";
            }
        break;
    default:
        $errors['err']='Uknown action';
    endswitch;
}



switch(strtolower($_REQUEST['t'])) {
    case 'new':
            if(!$_POST)
               $inc='newclient.inc.php';
            else
               $inc='clients.inc.php';  
        break;
    case 'edit':
        if(isset($_GET['id'])){
        $client = new Client('', $_GET['id']);
        $inc='updateclient.inc.php';
        }
        else
        {
            if(!$_POST)
            $errors['err'] = "Client not found";
            
          $inc='clients.inc.php';  
        }
        break;
    case 'delete':
          if(!isset($_GET['id']))
        {
            $errors['err'] = "id not setted";  
        }
            if (!$errors) {
                $sql = "delete from ".CLIENT_TABLE." where id = ".$_GET['id'];
                
                if (db_query($sql) && db_affected_rows()) {
                $msg = "Client deleted";
               
            } else {
                $errors['err'] = "error trying to delete the client.";  
            }    
             $inc='clients.inc.php';
        }
        break;
    default:
        $inc='clients.inc.php';
}

//Render the page.
require_once(STAFFINC_DIR.'header.inc.php');
?>
<div>
    <?php if($errors['err']) {?>
        <p align="center" id="errormessage"><?php echo $errors['err']?></p>
    <?php }elseif($msg) {?>
        <p align="center" id="infomessage"><?php echo $msg?></p>
    <?php }elseif($warn) {?>
        <p align="center" id="warnmessage"><?php echo $warn?></p>
    <?php }?>
</div>
<div>
   <?php  require(STAFFINC_DIR.$inc);  ?>
</div>
<?php 
require_once(STAFFINC_DIR.'footer.inc.php');
?>
