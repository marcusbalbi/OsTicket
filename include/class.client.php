<?php
/*********************************************************************
    class.client.php

    Handles everything about client

    The class will undergo major changes one client's accounts are used. 
    At the moment we will play off the email + ticket ID authentication.

    Peter Rotich <peter@osticket.com>
    Copyright (c)  2006-2010 osTicket
    http://www.osticket.com

    Released under the GNU General Public License WITHOUT ANY WARRANTY.
    See LICENSE.TXT for details.

    vim: expandtab sw=4 ts=4 sts=4:
    $Id: class.client.php,v 1.1.2.1 2009/08/17 18:35:47 carlos.delfino Exp $
**********************************************************************/

class Client {


    var $id;
    var $fullname;
    var $username;
    var $passwd;
    var $email;

    
    var $udata;
    
    function __construct($email,$id = 0) {
        return ($this->lookup($id,$email));
    }

    function Client($email,$id = 0){
        return ($this->lookup($id,$email));
    }

    function isClient(){
        return TRUE;
    }

    function lookup($id,$email=''){
      
        if($id !== 0)
        {
            $sql='SELECT id,fullname,email FROM '.CLIENT_TABLE.' WHERE id='.db_input($id);
        }
        else
        {
            $sql='SELECT id,fullname,email FROM '.CLIENT_TABLE.' WHERE email='.db_input($email);
        }
        $res=db_query($sql);
        if(!$res || !db_num_rows($res))
            return NULL;

        /* Faking most of the stuff for now till we start using accounts.*/
        $row=db_fetch_array($res);
        $this->udata=$row;
        $this->id         = $row['id']; 
        $this->fullname   = ucfirst($row['fullname']);
        $this->username   = $row['email'];
        $this->email      = $row['email'];
      
        return($this->id);
    }
    
    function exists()
    {
        if(empty($this->udata))
        {
            return false;
        }
        else
            return true;
    }
    
    function isValidUser($pass)
    {
        if(!$this->exists() || is_null($pass))
            return false;
        
        $sql = "select count(*) from ".CLIENT_TABLE." where email = '{$this->getEmail()}' and passwd = '".md5(db_input($pass))."'";
       
         $res=db_query($sql);
        if(!$res || !db_num_rows($res))
            return false; 
        
        
        return true;
        
    }


    function getId(){
        return $this->id;
    }

    function getEmail(){
        return($this->email);
    }

    function getUserName(){
        return($this->username);
    }

    function getName(){
        return($this->fullname);
    }
}

?>
