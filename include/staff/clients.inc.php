<table width="100%" border="0" cellspacing="0" cellpadding="2" class="dtable" align="center">
    <tbody>
        <tr >
            <th width="300" style="text-align: center">Fullname</th>
            <th width="300" style="text-align: center">email</th>
            <th width="120" colspan="2" style="text-align: center"><a href="client.php?t=new">New</a></th>
        </tr>
        <tr>
            <?php $clients = db_query('SELECT id,fullname,email FROM ' . CLIENT_TABLE . ' ORDER BY fullname');
            while (list($id, $fullname, $email) = db_fetch_row($clients)) {
                ?>
            <td align="center" nowrap=""><?php echo $fullname; ?></td>
            <td align="center" nowrap=""><?php echo $email; ?></td>
                <td align="center" nowrap=""><a href="client.php?t=edit&id=<?php echo $id; ?>">edit</a></td>
                <td align="center" nowrap=""><a href="client.php?t=delete&id=<?php echo $id; ?>">delete</a></td>
            </tr>
<?php } ?>
    </tbody>
</table>