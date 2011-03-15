<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" pasteActions="pasteActions" needGeneration="0">
	<Components>
		<IncludePage id="2" name="header" PathID="header" page="smartheader.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<IncludePage id="4" name="footer" PathID="footer" page="footer.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<IncludePage id="3" name="rightbar" PathID="rightbar" page="rightbar.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Grid id="10" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" connection="SMART" dataSource="smart_ticket" activeCollection="TableParameters" orderBy="tckt_refnumber desc" name="smart_ticket" pageSizeLimit="100" wizardCaption="List of Smart Ticket " wizardGridType="Tabular" wizardSortingType="Extended" wizardAllowInsert="False" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="True" wizardNoRecords="No records" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions">
			<Components>
				<Sorter id="13" visible="True" name="Sorter_tckt_refnumber" column="tckt_refnumber" wizardCaption="Tckt Refnumber" wizardSortingType="Extended" wizardControl="tckt_refnumber" wizardAddNbsp="False" PathID="smart_ticketSorter_tckt_refnumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="15" visible="True" name="Sorter_tckt_r_date" column="tckt_r_date" wizardCaption="Tckt R Date" wizardSortingType="Extended" wizardControl="tckt_r_date" wizardAddNbsp="False" PathID="smart_ticketSorter_tckt_r_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="16" visible="True" name="Sorter_tckt_r_helpdesk" column="tckt_r_helpdesk" wizardCaption="Tckt R Helpdesk" wizardSortingType="Extended" wizardControl="tckt_r_helpdesk" wizardAddNbsp="False" PathID="smart_ticketSorter_tckt_r_helpdesk">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="18" visible="True" name="Sorter_tckt_site" column="tckt_site" wizardCaption="Tckt Site" wizardSortingType="Extended" wizardControl="tckt_site" wizardAddNbsp="False" PathID="smart_ticketSorter_tckt_site">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Link id="22" fieldSourceType="DBColumn" dataType="Text" html="True" name="tckt_refnumber" fieldSource="tckt_refnumber" wizardCaption="Tckt Refnumber" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="smart_tickettckt_refnumber" visible="Yes" hrefType="Page" urlType="Relative" preserveParameters="GET">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<LinkParameters/>
				</Link>
				<Label id="23" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_status" fieldSource="tckt_status" wizardCaption="Tckt Status" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="smart_tickettckt_status">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="24" fieldSourceType="DBColumn" dataType="Date" html="False" name="tckt_r_date" fieldSource="tckt_r_date" wizardCaption="Tckt R Date" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="smart_tickettckt_r_date" format="GeneralDate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="25" fieldSourceType="DBColumn" dataType="Integer" html="False" name="tckt_r_helpdesk" fieldSource="tckt_r_helpdesk" wizardCaption="Tckt R Helpdesk" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="smart_tickettckt_r_helpdesk">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="26" fieldSourceType="DBColumn" dataType="Text" html="True" name="tckt_description" fieldSource="tckt_description" wizardCaption="Tckt State" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="smart_tickettckt_description">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="27" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_site" fieldSource="tckt_site" wizardCaption="Tckt Site" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="smart_tickettckt_site">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="28" fieldSourceType="DBColumn" dataType="Integer" html="True" name="tckt_age" wizardCaption="Tckt Severity" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="smart_tickettckt_age">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="30" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Simple" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardImagesScheme="{ccs_style}">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="31" fieldSourceType="DBColumn" dataType="Integer" html="False" name="lblNumber" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_ticketlblNumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="35" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_severity" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_tickettckt_severity" fieldSource="tckt_severity">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="36" fieldSourceType="DBColumn" dataType="Text" html="False" name="smart_ticket_TotalRecords" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_ticketsmart_ticket_TotalRecords">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="37"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="39" fieldSourceType="DBColumn" dataType="Text" name="tckt_state" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_tickettckt_state" fieldSource="tckt_state">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="34" fieldSourceType="DBColumn" dataType="Integer" name="id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_ticketid" fieldSource="id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="21" styles="Row;AltRow" name="rowStyle"/>
						<Action actionName="Custom Code" actionCategory="General" id="33"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="32"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="12" conditionType="Parameter" useIsNull="False" field="tckt_status" dataType="Integer" searchConditionType="LessThanOrEqual" parameterType="Expression" logicOperator="And" parameterSource="1"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="11" tableName="smart_ticket" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<IncludePage id="40" name="smartmap" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smartmap" page="smartmap.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="mainpage.php" forShow="True" url="mainpage.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="mainpage_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
