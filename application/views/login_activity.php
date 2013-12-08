<div class="CSSTable" >
	<table>
        	<tr>
                <th>Welcome <?php echo $this->session->userdata('name');?>, your last five logins | <a href="logout">Logout</a></th>
            </tr>
        
        	<?php foreach ($log_in_data as $item): ?>
        	<tr>
            	<td align="center"> <?php echo $item['logged_in_time'] ?></td>
            </tr>
            <?php endforeach ?>

        
	</table>
</div>



