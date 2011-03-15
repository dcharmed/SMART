<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Panel id="24" visible="True" name="MenuHelpdesk" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="menunavbarMenuHelpdesk" pasteActions="pasteActions">
			<Components>
				<Menu id="25" secured="False" sourceType="Table" returnValueType="Number" name="MenuListHelpdesk" menuType="Horizontal" menuSourceType="Static" PathID="menunavbarMenuHelpdeskMenuListHelpdesk">
					<Components>
						<Link id="26" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ItemLink" PathID="menunavbarMenuHelpdeskMenuListHelpdeskItemLink">
							<Components/>
							<Events/>
							<LinkParameters/>
							<Attributes/>
							<Features/>
						</Link>
					</Components>
					<Events/>
					<TableParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<SPParameters/>
					<SQLParameters/>
					<SecurityGroups/>
					<Attributes/>
					<MenuItems>
						<MenuItem id="27" name="MenuItem1" caption="HOME" url="index.ccp" title="Home"/>
<MenuItem id="28" name="MenuItem7" caption="Ticket List" url="ticketlist.ccp" target="_self" title="Ticket List"/>
<MenuItem id="29" name="MenuItem7Item1" parent="MenuItem7" caption="New Ticket" url="ticketdetails.ccp" target="_self" title="Register New Ticket"/>
<MenuItem id="30" name="MenuItem7Item2" parent="MenuItem7" caption="Ticket List" url="ticketlist.ccp" target="_self" title="Ticket List"/>
<MenuItem id="31" name="MenuItem2" caption="Preventive Maintenance" url="pmlist.ccp" target="_self" title="Preventive Maintenance"/>
<MenuItem id="32" name="MenuItem5" caption="Assignments &amp; Activities" url="#"/>
<MenuItem id="33" name="MenuItem5Item1" parent="MenuItem5" caption="Calendar" url="calactivity.ccp" target="_self" title="Calendar Activities"/>
<MenuItem id="34" name="MenuItem5Item2" parent="MenuItem5" caption="Task Assignments" url="taskactivity.ccp" target="_self" title="Task Assignments"/>
<MenuItem id="35" name="MenuItem3" caption="Spare Part" url="#" title="Spare Part"/>
<MenuItem id="36" name="MenuItem4" caption="Workshop" url="#" title="Workshop"/>
</MenuItems>
					<Features/>
				</Menu>
			</Components>
			<Events/>
			<Attributes/>
			<Features/>
		</Panel>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="menunavbar.php" forShow="True" url="menunavbar.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
	</Events>
</Page>
