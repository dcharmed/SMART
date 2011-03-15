<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\Admin" secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" pasteActions="pasteActions" needGeneration="0">
	<Components>
		<Panel id="2" visible="True" name="MenuAdmin" PathID="menunavMenuAdmin" pasteActions="pasteActions">
			<Components>
				<Menu id="3" secured="False" sourceType="Table" returnValueType="Number" name="MenuListAdmin" menuType="Horizontal" menuSourceType="Static" PathID="menunavMenuAdminMenuListAdmin">
					<Components>
						<Link id="4" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ItemLink" PathID="menunavMenuAdminMenuListAdminItemLink">
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
						<MenuItem id="5" name="MenuItem1" caption="HOME" url="index.ccp" title="Home"/>
<MenuItem id="6" name="MenuItem2" caption="Preventive Maintenance" url="pmlist.ccp" target="_self" title="Preventive Maintenance"/>
<MenuItem id="7" name="MenuItem3" caption="Spare Part" url="#" title="Spare Part"/>
<MenuItem id="8" name="MenuItem4" caption="Workshop" url="#" title="Workshop"/>
<MenuItem id="9" name="MenuItem5" caption="Tickets" url="AdmTickets.ccp"/>
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
		<CodeFile id="Code" language="PHPTemplates" name="menunav.php" forShow="True" url="menunav.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
