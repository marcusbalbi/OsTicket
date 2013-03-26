<?php
/*********************************************************************
    index.php

    Helpdesk landing page. Please customize it to fit your needs.

    Peter Rotich <peter@osticket.com>
    Copyright (c)  2006-2010 osTicket
    http://www.osticket.com

    Released under the GNU General Public License WITHOUT ANY WARRANTY.
    See LICENSE.TXT for details.

    vim: expandtab sw=4 ts=4 sts=4:
    $Id: $
**********************************************************************/
require('client.inc.php');
//We are only showing landing page to users who are not logged in.
if($thisclient && is_object($thisclient) && $thisclient->isValid()) {
    require('tickets.php');
    exit;
}


require(CLIENTINC_DIR.'header.inc.php');
?>
<div id="index">
<h1 dir="<?php echo $trl->dir() ?>"><?php te('TEXT_WELCOME_TITLE'); ?></h1>
<p class="big" dir="<?php echo $trl->dir() ?>"><?php te('TEXT_WELCOME_MSG'); ?></p>
<div class="lcol">
  <form class="status_form" action="login.php" method="post">
    <fieldset>
      <label>Email:</label>
      <input type="text" name="lemail">
    </fieldset>
    <fieldset>
     <label>Senha:</label>
     <input type="password" name="pass">
    </fieldset>
    <fieldset>
        <label>&nbsp;</label>
         <input type="submit" class="button2" value="Efetuar login">
    </fieldset>
  </form>
</div>
<div class="clear"></div>
<br />
</div>
<br />
<?php require(CLIENTINC_DIR.'footer.inc.php'); ?>
