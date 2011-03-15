<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="True" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" pasteActions="pasteActions" needGeneration="0" accessDeniedPage="index.ccp" wizardSortingType="Extended">
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
		<Grid id="5" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" connection="SMART" dataSource="smart_ticket" name="smart_ticket" pageSizeLimit="100" wizardCaption="List of Smart Ticket " wizardGridType="Tabular" wizardSortingType="Extended" wizardAllowInsert="False" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="True" wizardNoRecords="No records" activeCollection="TableParameters" orderBy="tckt_r_date desc" wizardAllowSorting="True">
			<Components>
				<Label id="12" fieldSourceType="DBColumn" dataType="Text" html="False" name="smart_ticket_TotalRecords" wizardUseTemplateBlock="False" PathID="smart_ticketsmart_ticket_TotalRecords">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="13" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="18" visible="True" name="Sorter_tckt_refnumber" column="tckt_refnumber" wizardCaption="Tckt Refnumber" wizardSortingType="Extended" wizardControl="tckt_refnumber" wizardAddNbsp="False" PathID="smart_ticketSorter_tckt_refnumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="19" visible="True" name="Sorter_tckt_status" column="tckt_status" wizardCaption="Tckt Status" wizardSortingType="Extended" wizardControl="tckt_status" wizardAddNbsp="False" PathID="smart_ticketSorter_tckt_status">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="20" visible="True" name="Sorter_tckt_date" column="tckt_r_date" wizardCaption="Tckt Date" wizardSortingType="Extended" wizardControl="tckt_date" wizardAddNbsp="False" PathID="smart_ticketSorter_tckt_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="21" visible="True" name="Sorter_tckt_branch" column="tckt_site" wizardCaption="Tckt Branch" wizardSortingType="Extended" wizardControl="tckt_branch" wizardAddNbsp="False" PathID="smart_ticketSorter_tckt_branch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="22" visible="True" name="Sorter_tckt_severity" column="tckt_severity" wizardCaption="Tckt Severity" wizardSortingType="Extended" wizardControl="tckt_severity" wizardAddNbsp="False" PathID="smart_ticketSorter_tckt_severity">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="23" visible="True" name="Sorter_tckt_adukomn" column="tckt_adukomn" wizardCaption="Tckt Adukomn" wizardSortingType="Extended" wizardControl="tckt_adukomn" wizardAddNbsp="False" PathID="smart_ticketSorter_tckt_adukomn">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="24" visible="True" name="Sorter_tckt_toppanid" column="tckt_toppanid" wizardCaption="Tckt Toppanid" wizardSortingType="Extended" wizardControl="tckt_toppanid" wizardAddNbsp="False" PathID="smart_ticketSorter_tckt_toppanid">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="25" visible="True" name="Sorter_tckt_esc" column="tckt_escalate" wizardCaption="Tckt Esc" wizardSortingType="Extended" wizardControl="tckt_esc" wizardAddNbsp="False" PathID="smart_ticketSorter_tckt_esc" connection="SMART">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Hidden id="28" fieldSourceType="DBColumn" dataType="Integer" html="False" name="id" fieldSource="id" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="smart_ticketid">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Link id="29" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_refnumber" fieldSource="tckt_refnumber" wizardCaption="Tckt Refnumber" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="smart_tickettckt_refnumber" visible="Yes" hrefType="Page" urlType="Relative" preserveParameters="GET" hrefSource="ticketdetails.ccp">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<LinkParameters>
						<LinkParameter id="51" sourceType="DataField" name="id" source="id"/>
					</LinkParameters>
				</Link>
				<Label id="30" fieldSourceType="DBColumn" dataType="Integer" html="True" name="tckt_status" fieldSource="tckt_status" wizardCaption="Tckt Status" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="smart_tickettckt_status">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="31" fieldSourceType="DBColumn" dataType="Date" html="False" name="tckt_date" fieldSource="tckt_r_date" wizardCaption="Tckt Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="smart_tickettckt_date" format="GeneralDate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="32" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_branch" fieldSource="tckt_site" wizardCaption="Tckt Branch" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="smart_tickettckt_branch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="33" fieldSourceType="DBColumn" dataType="Integer" html="False" name="tckt_severity" fieldSource="tckt_severity" wizardCaption="Tckt Severity" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="smart_tickettckt_severity">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="34" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_adukomn" fieldSource="tckt_adukomn" wizardCaption="Tckt Adukomn" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="smart_tickettckt_adukomn">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="35" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_toppanid" fieldSource="tckt_toppanid" wizardCaption="Tckt Toppanid" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="smart_tickettckt_toppanid">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="36" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_esc" fieldSource="tckt_escalate" wizardCaption="Tckt Esc" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="smart_tickettckt_esc">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="38" fieldSourceType="DBColumn" dataType="Memo" html="False" name="tckt_description" fieldSource="tckt_description" wizardCaption="Tckt Description" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="smart_tickettckt_description">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="39" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Simple" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardImagesScheme="{ccs_style}">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="48" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblNumber" PathID="smart_ticketlblNumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="54" fieldSourceType="DBColumn" dataType="Text" name="tckt_state" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_tickettckt_state" fieldSource="tckt_state">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="59" fieldSourceType="DBColumn" dataType="Integer" html="True" name="tckt_age" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_tickettckt_age">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="60" fieldSourceType="DBColumn" dataType="Text" html="False" name="tcktEng" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_tickettcktEng" fieldSource="tckt_engineer">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="61" fieldSourceType="DBColumn" dataType="Date" name="tckt_c_date" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_tickettckt_c_date" fieldSource="tckt_c_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Sorter id="82" visible="True" name="Sorter_Eng" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardSortingType="Extended" PathID="smart_ticketSorter_Eng" wizardCaption="Sorter1" column="tckt_engineer" connection="SMART">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Label id="83" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_spart" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_tickettckt_spart">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="84" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_equipment" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_tickettckt_equipment">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="100" fieldSourceType="DBColumn" dataType="Text" html="False" name="tckt_followup" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_tickettckt_followup" fieldSource="tckt_followup">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="27" styles="Row;AltRow" name="rowStyle" eventType="Server"/>
						<Action actionName="Custom Code" actionCategory="General" id="50" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="49" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeBuildSelect" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="103"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="14" conditionType="Parameter" useIsNull="False" field="tckt_site" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="1" parameterSource="s_branch" leftBrackets="0" rightBrackets="0"/>
				<TableParameter id="15" conditionType="Parameter" useIsNull="False" field="tckt_refnumber" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="2" parameterSource="s_ref" leftBrackets="0" rightBrackets="0"/>
				<TableParameter id="57" conditionType="Parameter" useIsNull="False" field="tckt_status" dataType="Integer" searchConditionType="LessThan" parameterType="URL" logicOperator="And" parameterSource="mode" leftBrackets="0" rightBrackets="0"/>
				<TableParameter id="58" conditionType="Parameter" useIsNull="False" field="tckt_severity" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="s_svr" leftBrackets="0" rightBrackets="0"/>
				<TableParameter id="75" conditionType="Parameter" useIsNull="False" field="tckt_status" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="s_status" leftBrackets="0" rightBrackets="0"/>
				<TableParameter id="96" conditionType="Parameter" useIsNull="False" field="tckt_escalate" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="s_esc"/>
				<TableParameter id="97" conditionType="Parameter" useIsNull="False" field="tckt_category" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="s_cat"/>
				<TableParameter id="98" conditionType="Parameter" useIsNull="False" field="tckt_subcategory" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="s_scat"/>
				<TableParameter id="101" conditionType="Parameter" useIsNull="False" field="tckt_state" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="s_state"/>
				<TableParameter id="102" conditionType="Parameter" useIsNull="False" field="tckt_adukomn" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="s_ad"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="52" tableName="smart_ticket" posLeft="249" posTop="24" posWidth="160" posHeight="180"/>
			</JoinTables>
			<JoinLinks>
			</JoinLinks>
			<Fields>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="6" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="smart_ticketSearch" wizardCaption="Search Smart Ticket " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="ticketlistsum.ccp" PathID="smart_ticketSearch" pasteActions="pasteActions">
			<Components>
				<Button id="7" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonSearchOn" PathID="smart_ticketSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="9" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_ref" wizardCaption="Tckt Refnumber" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" PathID="smart_ticketSearchs_ref">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="10" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="s_sdate" wizardCaption="Tckt Date" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" PathID="smart_ticketSearchs_sdate" format="yyyy-mm-dd">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="11" name="DatePicker_s_sdate" control="s_sdate" wizardSatellite="True" wizardControl="s_tckt_date" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="smart_ticketSearchDatePicker_s_sdate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<TextBox id="40" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="s_edate" PathID="smart_ticketSearchs_edate" format="yyyy-mm-dd">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="41" name="DatePicker_s_edate" PathID="smart_ticketSearchDatePicker_s_edate" control="s_edate" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<Button id="68" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Reset" operation="Cancel" wizardCaption="Search" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonSearchOn" PathID="smart_ticketSearchButton_Reset" removeParameters="s_state;s_branch;s_ref;s_sdate;s_edate;s_svr">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<ListBox id="70" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="s_svr" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="smart_ticketSearchs_svr" connection="SMART" dataSource="smart_referencecode" activeCollection="TableParameters" boundColumn="ref_value" textColumn="ref_description">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="74" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="tcktseverity"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="73" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="117" posHeight="152"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<ListBox id="85" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="s_cat" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="smart_ticketSearchs_cat" connection="SMART" dataSource="smart_referencecode" activeCollection="TableParameters" boundColumn="ref_value" textColumn="ref_description">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="89" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="probcat"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="88" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="117" posHeight="152"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<ListBox id="86" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="s_scat" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="smart_ticketSearchs_scat" connection="SMART" dataSource="smart_referencecode" boundColumn="ref_value" textColumn="ref_description" features="(assigned)">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="90" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="117" posHeight="152"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features>
						<PTDependentListBox id="95" enabled="True" name="PTDependentListBox2" servicePage="services/ticketlist_smart_ticketSearch_s_scat_PTDependentListBox1.ccp" masterListbox="s_cat" category="Prototype">
							<Components/>
							<Events/>
							<Features/>
						</PTDependentListBox>
					</Features>
				</ListBox>
				<ListBox id="87" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="s_esc" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="smart_ticketSearchs_esc" connection="SMART" dataSource="smart_referencecode" activeCollection="TableParameters" boundColumn="ref_value" textColumn="ref_description">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="92" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="esc"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="91" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="117" posHeight="152"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<TextBox id="93" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_ad" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_ticketSearchs_ad">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="104" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="type" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="smart_ticketSearchtype" connection="SMART" _valueOfList="3" _nameOfList="Yearly" dataSource="1;Current;2;Monthly;3;Yearly">
<Components/>
<Events/>
<TableParameters/>
<SPParameters/>
<SQLParameters/>
<JoinTables/>
<JoinLinks/>
<Fields/>
<Attributes/>
<Features/>
</ListBox>
</Components>
			<Events/>
			<TableParameters/>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="ticketlistsum_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="ticketlistsum.php" forShow="True" url="ticketlistsum.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups>
		<Group id="63" groupID="1"/>
		<Group id="64" groupID="2"/>
		<Group id="65" groupID="3"/>
		<Group id="66" groupID="5"/>
		<Group id="67" groupID="4"/>
	</SecurityGroups>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="62"/>
			</Actions>
		</Event>
	</Events>
</Page>
