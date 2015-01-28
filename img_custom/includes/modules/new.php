<table border="0" cellpadding="0" cellspacing="0" width="<?php echo $_kol_cn; ?>">
	<tr>
		<td width="0px">&nbsp;</td>
		<td class="toppad" align="center" valign="top">
			<table>
				<tr height="5px"><TD></TD></tr>
				<tr>
					<td><?php echo tep_image(DIR_WS_IMAGES . 'zag_login.gif'); ?></td>
				</tr>
				<tr>
					<td>
						<?php echo tep_draw_form('login', tep_href_link(FILENAME_LOGIN, 'action=process', 'SSL')); ?>
						<table border="0" width="100%" height="100%" cellspacing="0" cellpadding="4">
							<tr><td height="25px">&nbsp;</td></tr>
			  			<tr>
								<td class="logintext"><b><?php echo ENTRY_EMAIL_ADDRESS; ?></b></td>
								<td class="main"><?php echo tep_draw_input_field('email_address'); ?></td>
			  			</tr>
			  			<tr>
								<td class="logintext"><b><?php echo ENTRY_PASSWORD; ?></b></td>
								<td class="main"><?php echo tep_draw_password_field('password'); ?></td>
			  			</tr>
							<tr>
								<td >&nbsp;</td><td height="35px" valign="bottom" align="right"><?php echo tep_image_submit('button_login1.gif', IMAGE_BUTTON_LOGIN, ' class="noborder"'); ?></td>
							</tr>
						</table>
						</form>
					</td>
				</tr>
				<tr><td class="logintext"><?php echo '<a href="' . tep_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '">Lost your Password? </a>'; ?></td></tr>
			</table>
		</td>
		<td width="10px">&nbsp;</td>
		<td class="toppad" align="center" valign="top">
			<table>
				<tr height="5px"><TD></TD></tr>
				<tr>
					<td><?php echo tep_image(DIR_WS_IMAGES . 'zag_search.gif'); ?></td>
				</tr>
				<tr>
					<td>
					<table border="0" cellspacing="0" cellpadding="0" align="left" style="padding-left:12px">
						<tr><TD height="25px"></TD></tr>
						<tr>
        			<td>&nbsp;<span style="font-family:arial;font-size:12px;color:#000;font-weight:bold"><?php echo BOX_HEADING_MANUFACTURERS; ?>:</span>&nbsp;&nbsp;</td>
        			<td><?php require DIR_WS_BOXES.'manufacturers.php';?></td>
						</tr>
					</table>
					</td>
     			</tr>
					<tr><TD height="25px">&nbsp;</TD></tr>
					<tr>
							<td align="right"><table border="0" cellspacing="0" cellpadding="0" ><tr><td valign="middle">
    					<?php  if ((USE_CACHE == 'true') && empty($SID)) {
    					echo tep_cache_manufacturers_box();
  						} else {
    					include(DIR_WS_BOXES . 'search.php');
   						echo $info_box_contents[0]['form'].'<table border=0 style="margin:0 0 0 0px"><tr><td valign="middle" style="font-family:arial;font-size:12px;color:#000000;font-weight:bold">'.BOX_HEADING_SEARCH.':&nbsp;&nbsp;&nbsp;';
    					echo $info_box_contents[0]['text']."</td></tr><tr><td height='40px' valign='bottom' align='right'>"; ?>
							<a style="position:relative;top:-10px;left:-10px;font-family:arial;font-size:12px;color:#BD4E2C;font-weight:bold;text-decoration:underline" title="<?php echo BOX_SEARCH_ADVANCED_SEARCH;?>" href="<?php echo tep_href_link(FILENAME_ADVANCED_SEARCH); ?>" ><?php echo BOX_SEARCH_ADVANCED_SEARCH;?></a>
							<?php echo $info_box_contents[0]['img'].'</td></tr><tr><td style="padding:0px 0 0 0;"></td><td>&nbsp;';
    					echo '</td></tr></table></form>';
  						} ?>
    					</td>
  					</tr>
						</table></td>
						
				</tr>
			</table>
		</td>
		<td width="10px">&nbsp;</td>
	</tr>
</table>