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
		<Grid id="5" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="50" connection="SMART" name="GRtn" pageSizeLimit="100" wizardCaption="List of Smart Partsorders " wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records" activeCollection="TableParameters" dataSource="smart_partsrequisition" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions">
			<Components>
				<Label id="12" fieldSourceType="DBColumn" dataType="Date" html="False" name="preq_dateapplied" fieldSource="preq_dateapplied" wizardCaption="Podr Rtndate" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GRtnpreq_dateapplied">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="13" fieldSourceType="DBColumn" dataType="Text" html="False" name="preq_status" fieldSource="preq_status" wizardCaption="Podr Rtnstatus" wizardSize="5" wizardMaxLength="5" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GRtnpreq_status">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="14" fieldSourceType="DBColumn" dataType="Text" html="False" name="preq_processedby" fieldSource="preq_processedby" wizardCaption="Podr Rtncounter" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GRtnpreq_processedby">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="preq_engineer" wizardCaption="Podr Status" wizardSize="5" wizardMaxLength="5" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GRtnpreq_engineer" fieldSource="preq_engineer">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="16" fieldSourceType="DBColumn" dataType="Text" html="False" name="preq_formno" fieldSource="preq_formno" wizardCaption="Podr Preqid" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="GRtnpreq_formno" visible="Yes" hrefType="Page" urlType="Relative" preserveParameters="GET" hrefSource="smartprtn.ccp" removeParameters="fn;">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<LinkParameters>
						<LinkParameter id="39" sourceType="Expression" name="rtn" source="1"/>
						<LinkParameter id="40" sourceType="DataField" name="id" source="id"/>
					</LinkParameters>
				</Link>
				<Navigator id="21" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Simple" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardImagesScheme="{ccs_style}">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="22" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblNumber" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GRtnlblNumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="23" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblGTitle" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GRtnlblGTitle">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="38" fieldSourceType="DBColumn" dataType="Date" html="False" name="preq_processeddate" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GRtnpreq_processeddate" fieldSource="preq_processeddate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="72" fieldSourceType="DBColumn" dataType="Text" name="id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GRtnid" fieldSource="id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="11" styles="Row;AltRow" name="rowStyle"/>
						<Action actionName="Custom Code" actionCategory="General" id="26"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="27"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="36" conditionType="Parameter" useIsNull="False" field="preq_status" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="6"/>
				<TableParameter id="37" conditionType="Parameter" useIsNull="False" field="preq_formno" dataType="Text" searchConditionType="Contains" parameterType="URL" logicOperator="And" parameterSource="fn"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="29" tableName="smart_partsrequisition" posLeft="10" posTop="10" posWidth="153" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="30" tableName="smart_partsrequisition" fieldName="preq_status"/>
				<Field id="31" tableName="smart_partsrequisition" fieldName="preq_formno"/>
				<Field id="32" tableName="smart_partsrequisition" fieldName="preq_dateapplied"/>
				<Field id="33" tableName="smart_partsrequisition" fieldName="preq_engineer"/>
				<Field id="34" tableName="smart_partsrequisition" fieldName="preq_processeddate"/>
				<Field id="35" tableName="smart_partsrequisition" fieldName="preq_processedby"/>
				<Field id="73" tableName="smart_partsrequisition" fieldName="id"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="6" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="SRtn" wizardCaption="Search Smart Partsorders " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="smartprtn.ccp" PathID="SRtn" pasteActions="pasteActions">
			<Components>
				<Button id="7" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonSearchOn" PathID="SRtnButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="28" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="fn" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="SRtnfn">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
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
		<EditableGrid id="256" urlType="Relative" secured="False" emptyRows="0" allowInsert="False" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" sourceType="Table" defaultPageSize="50" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" dataSource="smart_partsorders" name="GCheckList" pageSizeLimit="100" wizardCaption="List of Smart Partsorders " wizardGridType="Tabular" wizardAltRecord="False" wizardRecordSeparator="False" wizardNoRecords="No records" PathID="GCheckList" deleteControl="CheckBox_Delete" pasteActions="pasteActions" activeCollection="TableParameters">
			<Components>
				<Label id="257" fieldSourceType="DBColumn" dataType="Integer" html="False" name="lblNumber" fieldSource="id" required="False" caption="Id" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GCheckListlblNumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="258" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" name="podr_itemcode" fieldSource="podr_itemcode" required="True" caption="Podr Itemcode" wizardCaption="Podr Itemcode" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="GCheckListpodr_itemcode" features="(assigned)" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features>
						<PTAutoFill id="77" enabled="True" valueField="value" sourceType="Table" name="PTAutoFill1" servicePage="services/smartpreq_GPreqOrders_podr_itemcode_PTAutoFill1.ccp" searchField="spart_code" connection="SMART" featureNameChanged="No" dataSource="smart_sparepart" category="Prototype">
							<Components/>
							<Events/>
							<TableParameters/>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables/>
							<JoinLinks/>
							<Fields/>
							<Controls>
								<Control id="78" name="podr_itemname" source="spart_name" propertyValue="value" sourceId="73"/>
							</Controls>
							<ControlPoints/>
							<Features/>
						</PTAutoFill>
						<PTAutocomplete id="79" enabled="True" sourceType="Table" name="PTAutocomplete1" servicePage="services/smartpreq_GPreqOrders_podr_itemcode_PTAutocomplete1.ccp" category="Prototype" searchField="spart_code" connection="SMART" featureNameChanged="No" dataSource="smart_sparepart">
							<Components/>
							<Events/>
							<TableParameters/>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables/>
							<JoinLinks/>
							<Fields/>
							<Features/>
						</PTAutocomplete>
					</Features>
				</Label>
				<Label id="262" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="podr_itemname" fieldSource="podr_itemname" required="True" caption="Podr Itemname" wizardCaption="Podr Itemname" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="GCheckListpodr_itemname" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="263" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="podr_qty" fieldSource="podr_qty" required="True" caption="Podr Qty" wizardCaption="Podr Qty" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="GCheckListpodr_qty" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="264" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="podr_site" fieldSource="podr_site" required="True" caption="Podr Site" wizardCaption="Podr Site" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="GCheckListpodr_site" sourceType="Table" connection="SMART" dataSource="smart_site" orderBy="site_code" boundColumn="site_code" textColumn="site_code" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="83" tableName="smart_site" posLeft="10" posTop="10" posWidth="121" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
				</Label>
				<Label id="266" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="podr_toppan" fieldSource="podr_toppan" required="True" caption="Podr Toppan" wizardCaption="Podr Toppan" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="GCheckListpodr_toppan" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="267" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="podr_remarks" fieldSource="podr_remarks" required="False" caption="Podr Remarks" wizardCaption="Podr Remarks" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="GCheckListpodr_remarks" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Button id="270" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="GCheckListButton_Submit">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="271" urlType="Relative" enableValidation="False" isDefault="False" name="Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="GCheckListCancel">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="88"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="272" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="podr_preqid" fieldSource="podr_preqid" required="False" caption="Podr Preqid" wizardCaption="Podr Preqid" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="GCheckListpodr_preqid">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="282" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="podr_datereceived" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GCheckListpodr_datereceived" fieldSource="podr_datereceived">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="283" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="podr_qtyreceived" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GCheckListpodr_qtyreceived" fieldSource="podr_qtyreceived">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="284" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="podr_remarks2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GCheckListpodr_remarks2" fieldSource="podr_remarks2">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="93" name="DatePicker_podr_datereceived1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GCheckListDatePicker_podr_datereceived1" control="podr_datereceived" wizardDatePickerType="Image" wizardPicture="Styles/None/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<Label id="287" fieldSourceType="DBColumn" dataType="Text" html="False" name="NoteGrid" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GCheckListNoteGrid">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
			<Events>
				<Event name="BeforeBuildInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="276"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="277"/>
					</Actions>
				</Event>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="278"/>
					</Actions>
				</Event>
				<Event name="AfterExecuteUpdate" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="286"/>
</Actions>
</Event>
</Events>
			<TableParameters>
				<TableParameter id="97" conditionType="Parameter" useIsNull="False" field="podr_preqid" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="98" tableName="smart_partsorders" posLeft="10" posTop="10" posWidth="141" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<PKFields>
				<PKField id="99" tableName="smart_partsorders" fieldName="id" dataType="Integer"/>
			</PKFields>
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
		</EditableGrid>
<Record id="110" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="RPreqView" dataSource="smart_partsrequisition" errorSummator="Error" wizardCaption="Add/Edit Smart Partsrequisition " wizardFormMethod="post" PathID="RPreqView" pasteActions="pasteActions">
			<Components>
				<Label id="114" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="preq_formno" fieldSource="preq_formno" required="False" caption="Preq Formno" wizardCaption="Preq Formno" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RPreqViewpreq_formno" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="115" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="preq_dateapplied" fieldSource="preq_dateapplied" required="True" caption="Preq Dateapplied" wizardCaption="Preq Dateapplied" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RPreqViewpreq_dateapplied" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="117" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="preq_engineer" fieldSource="preq_engineer" required="True" caption="Preq Engineer" wizardCaption="Preq Engineer" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="RPreqViewpreq_engineer" connection="SMART" dataSource="smart_user" activeCollection="TableParameters" boundColumn="usr_username" textColumn="usr_fullname" html="False">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="118" conditionType="Parameter" useIsNull="False" field="usr_group" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="3"/>
						<TableParameter id="119" conditionType="Parameter" useIsNull="False" field="usr_flag" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="1"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="120" tableName="smart_user" posLeft="10" posTop="10" posWidth="121" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="121" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="preq_partsreceived" fieldSource="preq_partsreceived" required="False" caption="Preq Partsreceived" wizardCaption="Preq Partsreceived" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RPreqViewpreq_partsreceived" sourceType="Table" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
				</Label>
				<Label id="132" fieldSourceType="DBColumn" dataType="Text" html="False" name="preq_status" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RPreqViewpreq_status" fieldSource="preq_status">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="206" fieldSourceType="DBColumn" dataType="Text" html="True" name="preq_approval" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RPreqViewpreq_approval" fieldSource="preq_approval">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="255" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblRtn" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RPreqViewlblRtn" fieldSource="preq_status">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="205" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="123" conditionType="Parameter" useIsNull="False" field="id" parameterSource="id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
<JoinTable id="285" tableName="smart_partsrequisition" posLeft="10" posTop="10" posWidth="153" posHeight="180"/>
</JoinTables>
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
		<CodeFile id="Code" language="PHPTemplates" name="smartprtn.php" forShow="True" url="smartprtn.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="smartprtn_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="PTAutocomplete79" language="PHPTemplates" name="smartprtnGCheckListpodr_itemcode_style.css" forShow="False" comment="/*" commentEnd="*/" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="41"/>
			</Actions>
		</Event>
	</Events>
</Page>
