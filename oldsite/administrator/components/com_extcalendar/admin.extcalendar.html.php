<?php
/**
* @version $Id: admin.banners.html.php,v 1.10 2005/02/15 14:49:39 kochp Exp $
* @package Mambo
* @subpackage Banners
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

class mosCommonHTMLLegacy {

// This class defines functions for things which are not included in Mambo versions prior to 4.5.2
// so they can be called and used. It was inspired by "thede" on the Mambo forums, and much of the
// code was taken directly from code he suggested. Thank you thede!

    function loadOverlib() {
        global  $mosConfig_live_site;
        if (is_callable(array('mosCommonHTML', 'loadOverlib'))) {
            mosCommonHTML::loadOverlib();
        } else {
            ?>
            <script language="Javascript" src="<?php echo $mosConfig_live_site;?>/includes/js/overlib_mini.js"></script>
            <div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
            <?php
        }
    }

    function checkedOut( &$row, $overlib=1 ) {
        if (is_callable(array('mosCommonHTML', 'checkedOut'))) {
            return mosCommonHTML::checkedOut($row, $overlib);
        } else {
            $hover = '';
            if ( $overlib ) {
                $date                 = mosFormatDate( $row->checked_out_time, '%A, %d %B %Y' );
                $time                = mosFormatDate( $row->checked_out_time, '%H:%M' );
                $checked_out_text     = '<table>';
                $checked_out_text     .= '<tr><td>'. $row->editor .'</td></tr>';
                $checked_out_text     .= '<tr><td>'. $date .'</td></tr>';
                $checked_out_text     .= '<tr><td>'. $time .'</td></tr>';
                $checked_out_text     .= '</table>';
                $hover = 'onMouseOver="return overlib(\''. $checked_out_text .'\', CAPTION, \'Checked Out\', BELOW, RIGHT);" onMouseOut="return nd();"';
            }
            $checked             = '<img src="images/disabled.png" '. $hover .'/>';
    
            return $checked;
        }
    }
    
    function CheckedOutProcessing( &$row, $i ) {
        global $my;
        if (is_callable(array('mosCommonHTML', 'CheckedOutProcessing'))) {
            return mosCommonHTML::CheckedOutProcessing($row, $i);
        } else {
            if ( $row->checked_out ) {
                $checked = mosCommonHTMLLegacy::checkedOut( $row );
            } else {
                $checked = mosHTML::idBox( $i, $row->id, ($row->checked_out && $row->checked_out != $my->id ) );
            }
            return $checked;
        }
    }

    function PublishedProcessing( &$row, $i ) {
        global $my;
        if (is_callable(array('mosCommonHTML', 'PublishedProcessing'))) {
            return mosCommonHTML::PublishedProcessing( $row, $i );
        } else {
			$img 	= $row->published ? 'publish_g.png' : 'publish_x.png';
			$task 	= $row->published ? 'unpublish' : 'publish';
			$alt 	= $row->published ? 'Published' : 'Unpublished';
			$action	= $row->published ? 'Unpublish Item' : 'Publish item';
	
			$href = '
			<a href="javascript: void(0);" onclick="return listItemTask(\'cb'. $i .'\',\''. $task .'\')" title="'. $action .'">
			<img src="images/'. $img .'" border="0" alt="'. $alt .'" />
			</a>'
			;
	
			return $href;
        }
    }

} 

/**
* @package Mambo
* @subpackage Banners
*/
class HTML_extcalendar {

	function showSettings( &$rows, $option ) {
		global $my;

		mosCommonHTMLLegacy::loadOverlib();
		?>


		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th>
			ExtCal Settings
			</th>
		</tr>
		</table>

		<table class="adminlist" width="75%" align="center" cellpadding="30">
		<tr>
			<th align="center">NOTE</th>
		</tr>
		<tr>
			<td align="center"><table width="550" align="center" cellpadding="0">
			  <tr>
			  <td><p><strong>To edit the settings for ExtCalendar,</strong> click that "Edit" button you see in the upper right.</p>
			    <p>Despite working very well most of the time (and for many people all of the time) <strong><span style="color: #990000">this is beta software and there are going to be bugs</span>.</strong> If you have problems with it, first scroll down to &quot;Known Issues.&quot; Then read all the <a href="http://mamboforge.net/frs/?group_id=1168" target="newwin">Release Notes</a>, <a href="http://mamboforge.net/docman/?group_id=1168" target="newwin">Docs</a>, and <a href="http://mamboforge.net/forum/?group_id=1168" target="newwin">Forums</a>. If these don't answer your question, please post in the Forums and lodge a <a href="http://mamboforge.net/tracker/?atid=3764&group_id=1168&func=browse" target="newwin">Bug Report</a>. </p>
			    <p>If you like this component, visit my page at <a href="http://www.whatismoving.com" target="_blank">www.whatismoving.com</a> and buy a copy of my award-winning independent film!</p></td>
			</tr></table></td>
		</tr>
		<tr>
			<td align="center"><table width="550" align="center" cellpadding="0">
			  <tr>
			  <td><strong>Mini-Calendar Settings and Latest Events Settings:</strong> The MiniCalendar and Latest Events are <em>Modules</em>, and as such, their settings are available under the Modules menu above, under Site Modules (if you have installed them). These modules have a <em>wide variety</em> of parameters, so check them out. On the menu, pick &quot;Modules&nbsp;&gt; Site Modules&quot; and then find the ExtCal modules in the list and click them to edit their parameters.</td>
			</tr></table></td>
		</tr>
		<tr>
          <th align="center" nowrap>PERMISSIONS AND EVENT APPROVAL</th>
		  </tr>
		<tr>
          <td align="center"><table width="550" align="center" cellpadding="0">
              <tr>
                <td><p><strong>YES, there are permission levels for adding/editing/deleting events.</strong> It is not an extremely complicated system, but should work for most people.</p>
                    <p> <em><strong>1) Add/Edit/Delete Permissions: </strong></em>If you click the &quot;Edit&quot; button in the upper right, you will see three main options to provide <strong>universal</strong> control over who has access to add/edit/delete buttons on the calendar. </p>
                    <ul>
                      <li>&quot;Anyone&quot; -- that means <em>anyone</em>, whether logged in or not, can access that function.</li>
                      <li> &quot;Registered&quot; -- any users with a <em>Front-End </em>login account on your Mambo site will be able to access that function.</li>
                      <li> &quot;Administrators&quot; --only people who are actual Mambo Administrators or Super-Administrators can access that function. </li>
                    </ul>
                    <p>People who do not have access to a function will have all the buttons for doing it <em>removed</em> from the calendar. Not only that, but if they attempt to manually access the prohibited function by typing stuff into the address bar, they will still be blocked. <strong>NOTE: These permissions only determine who is allowed to SUBMIT new events and SUBMIT edits to events.</strong> The events may still have to be approved by an Administrator.</p>
                    <p><em><strong>2) Administrator Approval:</strong></em> There is a system in place for requiring <em>Administrator Approval</em> for adding/editing events. This is selected at the <strong>Category</strong> level! Either go to the menu and select &quot;Components&nbsp;&gt; ExtCal Calendar&nbsp;&gt; Manage Event Categories&quot; or click the &quot;Manage Categories&quot; button in the upper right. When you add or edit a category, you will see 2 checkboxes. The first one it's hard to imagine you wanting to uncheck. The second one, though, is &quot;Auto approve user submissions,&quot; and if you uncheck it, then any time a user submits or edits an event, it will NOT appear on the calendar until an administrator approves it. This means if they edit an existing event, the event will disappear until you approve the change. Each category can have a different setting. What's cool is that if you have a correct email address in the ExtCal Settings and have &quot;Email Me When Events Need Approval&quot; set to &quot;Yes&quot; then you will be emailed whenever something needs approval. </p>
                    <p>Please note that there is <strong>no facility for approving deletions.</strong> If the universal permission allows a user to delete an item, and he does so, it's GONE.  <strong>Approval only applies to adding and editing</strong>. That's why the default value for &quot;Who Can Delete Events&quot; is &quot;Administrators Only.&quot; It's the safest setting. </p></td>
              </tr>
          </table></td>
		  </tr>
		<tr>
          <th align="center" nowrap>HOW TO  APPROVE EVENTS</th>
		  </tr>
		<tr>
          <td align="center"><table width="550" align="center" cellpadding="0">
              <tr>
                <td><p>I know people want to be able to approve events here on the back-end, but since this is a port of a standalone program, and so much work was already done, it would have been a nightmare to implement. So, for now, you do your event approval on the <em>Front-End</em>. How? By logging in to the Front End using your back-end Administrator username and password. You will now be logged into the front-end as an Admin and when you go to the full calendar, you will see a new bar with a big button on it to click whenever events require approval. The rest will be obvious. <strong>If you have the kind of site that does not have a login</strong>, then consider setting up a hidden page that DOES have the login box, or just temporarily activate the login module when you need to administer events. </p>
                </td>
            </tr>
          </table></td>
		  </tr>
		<tr>
			<th align="center" nowrap>ABOUT EXTCALENDAR</th>
		</tr>
		<tr>
			<td align="center"><p>This component was cobbled together out of the Version 2, Beta 1 release (and CVS files as of Feb. 23, 2005) of the excellent ExtCalendar 2 app, by Mohamed Moujami (SimoAmi), at <a href="http://extcal.sourceforge.net" target="_blank">http://extcal.sourceforge.net</a>. <strong>Please do not</strong> contact him about this Mambo version, which was ported by Matt Friedman. Visit <a href="http://extcalendar.sourceforge.net" target="_blank">extcalendar.sourceforge.net</a> to report bugs or discuss the component and modules. Thank you!</p>
              <p>As much as possible, the original functionality and PHP code of the original script was preserved, so there is a lot of code that is not compliant with Mambo coding standards and its built-in functions. Nonetheless, a lot of care was taken to try and prevent conflicts and ensure compatibility.</p>
            <p>It is based on a STOCK installation of the calendar, with obvious modifications to elements like login and session management and database calls in order to use Mambo's existing structure for this. So you may be able to look at future ExtCal versions and upgrade this Mambo component by doing careful comparisons.</p>
			<p>If you allow image uploading with your events, you may need to use an FTP client or shell access and change the permissions of the &quot;com_extcalendar/upload&quot; directory to 777.</p>
			<p>If you wish to make donations to support the author, then please either visit <a href="http://extcal.sourceforge.net" target="_blank">http://extcal.sourceforge.net</a> and find out more about contributing to SimoAmi instead. Or visit my own page at <a href="http://www.whatismoving.com" target="_blank">www.whatismoving.com</a> and buy a copy of my movie!</p></td>
		</tr>
		</table>
		<input type="hidden" name="option" value="<?php echo $option; ?>">
		<input type="hidden" name="task" value="">
		<input type="hidden" name="boxchecked" value="editAll">
		<input type="hidden" name="hidemainmenu" value="0">
		</form>
		<?php
	}

	function editSettings( $option ) {
		?>
		<script language="javascript">
		<!--
		function submitbutton(pressbutton) {
		document.adminForm.task.value = pressbutton;
			var form = document.adminForm;
			if (pressbutton == 'cancelEditSettings') {
				submitform( pressbutton );
				return;
			}
			// do field validation
			if (0 == 1) {
				alert( "Do form validation here." );
				return;
			} else {
				submitform( pressbutton );
			}
		}
		//-->
		</script>
		<?php
	}
	
	function showCategories( &$rows, &$pageNav, $option ) {
		global $my, $database;

		mosCommonHTML::loadOverlib();
		?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th>
			ExtCal Categories
			</th>
		</tr>
		</table>

		<table class="adminlist">
		<tr>
			<th width="20">
			#
			</th>
			<th width="20">
			<input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count( $rows ); ?>);" />
			</th>
			<th align="left" nowrap>
			Category Name
			</th>
			<th width="10%" nowrap>
			Published (Active)
			</th>
			<th width="11%" nowrap>
			Category Color
			</th>
			<th width="16%">
			Events
			</th>
		</tr>
		<?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row = &$rows[$i];

			$row->id	= $row->cat_id;
			$link 		= 'index2.php?option=com_extcalendar&task=editCategory&hidemainmenu=1&cat_id='. $row->cat_id;

			$eventsQuery = "SELECT * FROM #__extcal_events WHERE cat = '{$row->cat_id}'";
			$database->setQuery( $eventsQuery );
			$number_query = $database->query();
			$number_of_events = $database->getNumRows( $number_query );

			$task 	= $row->published ? 'unpublish' : 'publish';
			$img 	= $row->published ? 'publish_g.png' : 'publish_x.png';
			$alt 	= $row->published ? 'Published' : 'Unpublished';

			$checked 	= mosCommonHTMLLegacy::CheckedOutProcessing( $row, $i );
			$published 	= mosCommonHTMLLegacy::PublishedProcessing( $row, $i );
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td align="center">
				<?php echo $pageNav->rowNumber( $i ); ?>
				</td>
				<td align="center">
				<?php echo $checked; ?>
				</td>
				<td align="left">
				<?php
				if ( $row->checked_out && ( $row->checked_out != $my->id ) ) {
					echo $row->name;
				} else {
					?>
					<a href="<?php echo $link; ?>" title="Edit Category">
					<?php echo $row->cat_name; ?>
					</a>
					<?php
				}
				?>
				</td>
				<td align="center">
				<?php echo $published;?>
				</td>
				<td align="center"><table bgcolor="<?php echo $row->color;?>" style="border:1px solid black"><tr><td style="border: none;padding:0px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table></td>
				<td align="center">
				<?php echo $number_of_events;?>
				</td>
			</tr>
			<?php
			$k = 1 - $k;
		}
		?>
		</table>
		<?php echo $pageNav->getListFooter(); ?>

		<input type="hidden" name="option" value="<?php echo $option; ?>">
		<input type="hidden" name="task" value="showCategories">
		<input type="hidden" name="boxchecked" value="0">
		<input type="hidden" name="hidemainmenu" value="0">
		</form>
		<?php
	}

	function editCategory( $option ) {
		?>
		<script language="javascript">
		<!--
		function submitbutton(pressbutton) {
		document.adminForm.task.value = pressbutton;
			var form = document.adminForm;
			if (pressbutton == 'cancelEditCategory') {
				submitform( pressbutton );
				return;
			}
			// do field validation
			if (form.cat_name.value == "") {
				alert( "You must specify a category name." );
				return;
			} else if (form.color.value == "") {
				alert( "You must specify a category color." );
				return;
			} else {
				submitform( pressbutton );
			}
		}
		//-->
		</script>
		<?php
	}

}
?>