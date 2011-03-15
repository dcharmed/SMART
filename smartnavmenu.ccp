<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" pasteActions="pasteActions" needGeneration="0" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0">
	<Components>
		<Menu id="4" secured="True" sourceType="Table" returnValueType="Number" name="MenuListHelpdesk" menuType="Horizontal" menuSourceType="Static" PathID="smartnavmenuMenuListHelpdesk">
			<Components>
				<Link id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ItemLink" PathID="smartnavmenuMenuListHelpdeskItemLink">
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
			<SecurityGroups>
				<Group id="56" groupID="5" read="True"/>
			</SecurityGroups>
			<Attributes/>
			<MenuItems>
				<MenuItem id="80" name="MenuItem1" caption="HOME" url="index.ccp" title="Home"/>
				<MenuItem id="81" name="MenuItem7" caption="Ticket List" url="ticketlist.ccp" target="_self" title="Ticket List"/>
				<MenuItem id="82" name="MenuItem7Item1" parent="MenuItem7" caption="New Ticket" url="ticketdetails.ccp" target="_self" title="Register New Ticket"/>
				<MenuItem id="83" name="MenuItem7Item2" parent="MenuItem7" caption="Ticket List" url="ticketlist.ccp" target="_self" title="Ticket List"/>
				<MenuItem id="84" name="MenuItem2" caption="Preventive Maintenance" url="pmlist.ccp" target="_self" title="Preventive Maintenance"/>
				<MenuItem id="85" name="MenuItem8" caption="Report" url="smartreports.ccp"/>
				<MenuItem id="86" name="MenuItem5" caption="Assignments &amp; Activities" url="#"/>
				<MenuItem id="87" name="MenuItem5Item1" parent="MenuItem5" caption="Calendar" url="calactivity.ccp" target="_self" title="Calendar Activities"/>
				<MenuItem id="88" name="MenuItem5Item2" parent="MenuItem5" caption="Task Assignments" url="taskactivity.ccp" target="_self" title="Task Assignments"/>
				<MenuItem id="89" name="MenuItem3" caption="Spare Part" url="#" title="Spare Part"/>
				<MenuItem id="90" name="MenuItem4" caption="Workshop" url="#" title="Workshop"/>
				<MenuItem id="91" name="MenuItem9" caption="Damaged Passport" url="smartdp.ccp" title="Damaged Passport"/>
			</MenuItems>
			<Features/>
		</Menu>
		<Menu id="16" secured="True" sourceType="Table" returnValueType="Number" name="MenuListEngineer" menuType="Horizontal" menuSourceType="Static" PathID="smartnavmenuMenuListEngineer">
			<Components>
				<Link id="17" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ItemLink" PathID="smartnavmenuMenuListEngineerItemLink">
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
			<SecurityGroups>
				<Group id="125" groupID="2" read="True"/>
<Group id="126" groupID="3" read="True"/>
</SecurityGroups>
			<Attributes/>
			<MenuItems>
				<MenuItem id="42" name="MenuItem7" caption="Home" url="mainpage.ccp"/>
				<MenuItem id="43" name="MenuItem1" caption="Ticket List" url="ticketlist.ccp" target="_self"/>
				<MenuItem id="44" name="MenuItem2" caption="Preventive Maintenance" url="#"/>
				<MenuItem id="45" name="MenuItem2Item2" parent="MenuItem2" caption="New PM" url="pmactivity.ccp"/>
				<MenuItem id="46" name="MenuItem2Item1" parent="MenuItem2" caption="PM List" url="pmlist.ccp"/>
				<MenuItem id="47" name="MenuItem6" caption="Reports" url="smartreports.ccp"/>
				<MenuItem id="48" name="MenuItem3" caption="Assignment &amp; Activity" url="#"/>
				<MenuItem id="49" name="MenuItem3Item1" parent="MenuItem3" caption="Calendar" url="calactivity.ccp"/>
				<MenuItem id="50" name="MenuItem3Item2" parent="MenuItem3" caption="Task Assignments" url="taskactivity.ccp"/>
				<MenuItem id="51" name="MenuItem4" caption="Spare Part" url="#"/>
				<MenuItem id="52" name="MenuItem5" caption="Workshop" url="#"/>
			</MenuItems>
			<Features/>
		</Menu>
		<Menu id="3" secured="True" sourceType="Table" returnValueType="Number" name="MenuListAdmin" menuType="Horizontal" menuSourceType="Static" PathID="smartnavmenuMenuListAdmin">
			<Components>
				<Link id="60" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ItemLink" PathID="smartnavmenuMenuListAdminItemLink">
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
			<SecurityGroups>
				<Group id="62" groupID="1" read="True"/>
			</SecurityGroups>
			<Attributes/>
			<MenuItems>
				<MenuItem id="63" name="MenuItem1" caption="HOME" url="Admin/index.ccp" title="Home"/>
				<MenuItem id="64" name="MenuItem5" caption="Tickets" url="Admin/AdmTicMngmt.ccp"/>
				<MenuItem id="65" name="MenuItem2" caption="Preventive Maintenance" url="pmlist.ccp" target="_self" title="Preventive Maintenance"/>
				<MenuItem id="66" name="MenuItem3" caption="Spare Part" url="Admin/AdmEqMngmt.ccp" title="Spare Part"/>
				<MenuItem id="67" name="MenuItem4" caption="Workshop" url="#" title="Workshop"/>
			</MenuItems>
			<Features/>
		</Menu>
		<Menu id="68" secured="True" sourceType="Table" returnValueType="Number" name="MenuListManager" menuType="Horizontal" menuSourceType="Static" PathID="smartnavmenuMenuListManager">
			<Components>
				<Link id="69" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ItemLink" PathID="smartnavmenuMenuListManagerItemLink">
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
			<SecurityGroups>
				<Group id="74" groupID="2" read="True"/>
			</SecurityGroups>
			<Attributes/>
			<MenuItems>
				<MenuItem id="75" name="MenuItem1" caption="HOME" url="mainpage.ccp" title="Home"/>
				<MenuItem id="76" name="MenuItem2" caption="Tickets" url="ticketlist.ccp" title="Tickets List"/>
				<MenuItem id="77" name="MenuItem5" caption="Reports" url="reports.ccp"/>
				<MenuItem id="78" name="MenuItem3" caption="Preventive Maintenance" url="pmlist.ccp" title="PM List"/>
				<MenuItem id="79" name="MenuItem4" caption="Task History" url="taskhistory.ccp" title="Task History"/>
			</MenuItems>
			<Features/>
		</Menu>
		<Menu id="92" secured="True" sourceType="Table" returnValueType="Number" name="MenuListInHouseEng" menuType="Horizontal" menuSourceType="Static" PathID="smartnavmenuMenuListInHouseEng">
			<Components>
				<Link id="93" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ItemLink" PathID="smartnavmenuMenuListInHouseEngItemLink">
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
			<SecurityGroups>
				<Group id="127" groupID="7" read="True"/>
</SecurityGroups>
			<Attributes/>
			<MenuItems>
				<MenuItem id="95" name="MenuItem1" caption="HOME" url="index.ccp" title="Home"/>
				<MenuItem id="96" name="MenuItem7" caption="Ticket List" url="ticketlist.ccp" target="_self" title="Ticket List"/>
				<MenuItem id="97" name="MenuItem7Item1" parent="MenuItem7" caption="New Ticket" url="ticketdetails.ccp" target="_self" title="Register New Ticket"/>
				<MenuItem id="98" name="MenuItem7Item2" parent="MenuItem7" caption="Ticket List" url="ticketlist.ccp" target="_self" title="Ticket List"/>
				<MenuItem id="99" name="MenuItem2" caption="Preventive Maintenance" url="pmlist.ccp" target="_self" title="Preventive Maintenance"/>
				<MenuItem id="100" name="MenuItem8" caption="Report" url="smartreports.ccp"/>
				<MenuItem id="101" name="MenuItem5" caption="Assignments &amp; Activities" url="#"/>
				<MenuItem id="102" name="MenuItem5Item1" parent="MenuItem5" caption="Calendar" url="calactivity.ccp" target="_self" title="Calendar Activities"/>
				<MenuItem id="103" name="MenuItem5Item2" parent="MenuItem5" caption="Task Assignments" url="taskactivity.ccp" target="_self" title="Task Assignments"/>
				<MenuItem id="104" name="MenuItem3" caption="Spare Part" url="#" title="Spare Part"/>
				<MenuItem id="105" name="MenuItem4" caption="Workshop" url="#" title="Workshop"/>
				<MenuItem id="106" name="MenuItem9" caption="Damaged Passport" url="smartdp.ccp" title="Damaged Passport"/>
			</MenuItems>
			<Features/>
		</Menu>
		<Menu id="108" secured="True" sourceType="Table" returnValueType="Number" name="MenuListSenior" menuType="Horizontal" menuSourceType="Static" PathID="smartnavmenuMenuListSenior">
			<Components>
				<Link id="109" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ItemLink" PathID="smartnavmenuMenuListSeniorItemLink">
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
			<SecurityGroups>
				<Group id="124" groupID="4" read="True"/>
</SecurityGroups>
			<Attributes/>
			<MenuItems>
				<MenuItem id="113" name="MenuItem7" caption="Home" url="mainpage.ccp"/>
				<MenuItem id="114" name="MenuItem1" caption="Ticket List" url="ticketlist.ccp" target="_self"/>
				<MenuItem id="115" name="MenuItem2" caption="Preventive Maintenance" url="#"/>
				<MenuItem id="116" name="MenuItem2Item2" parent="MenuItem2" caption="New PM" url="pmactivity.ccp"/>
				<MenuItem id="117" name="MenuItem2Item1" parent="MenuItem2" caption="PM List" url="pmlist.ccp"/>
				<MenuItem id="118" name="MenuItem6" caption="Reports" url="smartreports.ccp"/>
				<MenuItem id="119" name="MenuItem3" caption="Assignment &amp; Activity" url="#"/>
				<MenuItem id="120" name="MenuItem3Item1" parent="MenuItem3" caption="Calendar" url="calactivity.ccp"/>
				<MenuItem id="121" name="MenuItem3Item2" parent="MenuItem3" caption="Task Assignments" url="taskactivity.ccp"/>
				<MenuItem id="122" name="MenuItem4" caption="Spare Part" url="#"/>
				<MenuItem id="123" name="MenuItem5" caption="Workshop" url="#"/>
			</MenuItems>
			<Features/>
		</Menu>
</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="smartnavmenu_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="smartnavmenu.php" forShow="True" url="smartnavmenu.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="29"/>
			</Actions>
		</Event>
	</Events>
</Page>
