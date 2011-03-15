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
		<Grid id="5" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="50" connection="SMART" dataSource="smart_partsrequisition" name="GPreq" pageSizeLimit="100" wizardCaption="List of Smart Partsrequisition " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records" activeCollection="TableParameters">
			<Components>
				<Link id="19" visible="Yes" fieldSourceType="DBColumn" dataType="Date" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="preq_dateapplied" fieldSource="preq_dateapplied" wizardCaption="Preq Dateapplied" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" hrefSource="smartpreq.ccp" wizardThemeItem="GridA" PathID="GPreqpreq_dateapplied">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="20" sourceType="DataField" format="yyyy-mm-dd" name="id" source="id"/>
						<LinkParameter id="145" sourceType="Expression" name="view" source="1"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="22" fieldSourceType="DBColumn" dataType="Text" html="False" name="preq_formno" fieldSource="preq_formno" wizardCaption="Preq Formno" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GPreqpreq_formno">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="24" fieldSourceType="DBColumn" dataType="Text" html="False" name="preq_engineer" fieldSource="preq_engineer" wizardCaption="Preq Engineer" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GPreqpreq_engineer">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="26" fieldSourceType="DBColumn" dataType="Text" html="False" name="preq_approvedby" fieldSource="preq_approvedby" wizardCaption="Preq Approvedby" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GPreqpreq_approvedby">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="28" fieldSourceType="DBColumn" dataType="Date" html="False" name="preq_approveddate" fieldSource="preq_approveddate" wizardCaption="Preq Approveddate" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GPreqpreq_approveddate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="30" fieldSourceType="DBColumn" dataType="Text" html="False" name="preq_processedby" fieldSource="preq_processedby" wizardCaption="Preq Processedby" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GPreqpreq_processedby">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="32" fieldSourceType="DBColumn" dataType="Date" html="False" name="preq_processeddate" fieldSource="preq_processeddate" wizardCaption="Preq Processeddate" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GPreqpreq_processeddate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="34" fieldSourceType="DBColumn" dataType="Text" html="False" name="preq_takenby" fieldSource="preq_takenby" wizardCaption="Preq Takenby" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GPreqpreq_takenby">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="36" fieldSourceType="DBColumn" dataType="Date" html="False" name="preq_takendate" fieldSource="preq_takendate" wizardCaption="Preq Takendate" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GPreqpreq_takendate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="38" fieldSourceType="DBColumn" dataType="Text" html="False" name="preq_partsreceived" fieldSource="preq_partsreceived" wizardCaption="Preq Partsreceived" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GPreqpreq_partsreceived">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="40" fieldSourceType="DBColumn" dataType="Text" html="False" name="preq_receivedby" fieldSource="preq_receivedby" wizardCaption="Preq Receivedby" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GPreqpreq_receivedby">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="42" fieldSourceType="DBColumn" dataType="Date" html="False" name="preq_receiveddate" fieldSource="preq_receiveddate" wizardCaption="Preq Receiveddate" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GPreqpreq_receiveddate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="43" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Simple" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardImagesScheme="{ccs_style}">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<ImageLink id="128" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="btnNew" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GPreqbtnNew" hrefSource="smartpreq.ccp">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="129" sourceType="Expression" format="yyyy-mm-dd" name="new" source="1"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<Label id="146" fieldSourceType="DBColumn" dataType="Integer" html="False" name="lblNumber" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GPreqlblNumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="314" fieldSourceType="DBColumn" dataType="Text" html="False" name="preq_status" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GPreqpreq_status" fieldSource="preq_status">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="17" styles="Row;AltRow" name="rowStyle"/>
						<Action actionName="Custom Code" actionCategory="General" id="245"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="244"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="14" conditionType="Parameter" useIsNull="False" field="preq_formno" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="1" parameterSource="fn"/>
				<TableParameter id="15" conditionType="Parameter" useIsNull="False" field="preq_dateapplied" dataType="Date" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="2" parameterSource="da"/>
				<TableParameter id="16" conditionType="Parameter" useIsNull="False" field="preq_engineer" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="3" parameterSource="eng"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="246" tableName="smart_partsrequisition" posLeft="10" posTop="10" posWidth="153" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="12" tableName="smart_partsrequisition" fieldName="id"/>
				<Field id="18" tableName="smart_partsrequisition" fieldName="preq_dateapplied"/>
				<Field id="21" tableName="smart_partsrequisition" fieldName="preq_formno"/>
				<Field id="23" tableName="smart_partsrequisition" fieldName="preq_engineer"/>
				<Field id="25" tableName="smart_partsrequisition" fieldName="preq_approvedby"/>
				<Field id="27" tableName="smart_partsrequisition" fieldName="preq_approveddate"/>
				<Field id="29" tableName="smart_partsrequisition" fieldName="preq_processedby"/>
				<Field id="31" tableName="smart_partsrequisition" fieldName="preq_processeddate"/>
				<Field id="33" tableName="smart_partsrequisition" fieldName="preq_takenby"/>
				<Field id="35" tableName="smart_partsrequisition" fieldName="preq_takendate"/>
				<Field id="37" tableName="smart_partsrequisition" fieldName="preq_partsreceived"/>
				<Field id="39" tableName="smart_partsrequisition" fieldName="preq_receivedby"/>
				<Field id="41" tableName="smart_partsrequisition" fieldName="preq_receiveddate"/>
				<Field id="315" tableName="smart_partsrequisition" fieldName="preq_status"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="6" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="SPreq" wizardCaption="Search Smart Partsrequisition " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="smartpreq.ccp" PathID="SPreq">
			<Components>
				<Button id="7" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonSearchOn" PathID="SPreqButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="8" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="fn" wizardCaption="Preq Formno" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" PathID="SPreqfn">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="9" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="da" wizardCaption="Preq Dateapplied" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" PathID="SPreqda">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="10" name="DatePicker_da" control="da" wizardSatellite="True" wizardControl="s_preq_dateapplied" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="SPreqDatePicker_da">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<ListBox id="11" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="eng" wizardCaption="Preq Engineer" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardEmptyCaption="Select Value" PathID="SPreqeng" connection="SMART" dataSource="smart_user" boundColumn="usr_username" textColumn="usr_fullname">
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
		<Record id="44" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="RPreq" dataSource="smart_partsrequisition" errorSummator="Error" wizardCaption="Add/Edit Smart Partsrequisition " wizardFormMethod="post" PathID="RPreq" pasteActions="pasteActions">
			<Components>
				<Button id="45" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonInsertOn" PathID="RPreqButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="46" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="RPreqButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="47" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="RPreqButton_Cancel">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="125"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="49" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="preq_formno" fieldSource="preq_formno" required="True" caption="Form No." wizardCaption="Preq Formno" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RPreqpreq_formno" unique="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="50" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="preq_dateapplied" fieldSource="preq_dateapplied" required="True" caption="Date Applied" wizardCaption="Preq Dateapplied" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RPreqpreq_dateapplied">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="51" name="DatePicker_preq_dateapplied" control="preq_dateapplied" wizardSatellite="True" wizardControl="preq_dateapplied" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="RPreqDatePicker_preq_dateapplied">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<ListBox id="52" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="preq_engineer" fieldSource="preq_engineer" required="True" caption="Engineer" wizardCaption="Preq Engineer" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="RPreqpreq_engineer" connection="SMART" dataSource="smart_user" activeCollection="TableParameters" boundColumn="usr_username" textColumn="usr_fullname">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="107" conditionType="Parameter" useIsNull="False" field="usr_group" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="3"/>
						<TableParameter id="108" conditionType="Parameter" useIsNull="False" field="usr_flag" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="0"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="106" tableName="smart_user" posLeft="10" posTop="10" posWidth="121" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<Hidden id="130" fieldSourceType="DBColumn" dataType="Text" name="preq_status" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RPreqpreq_status" fieldSource="preq_status" defaultValue="1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="AfterInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="109" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="48" conditionType="Parameter" useIsNull="False" field="id" parameterSource="id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
			</TableParameters>
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
		<EditableGrid id="68" urlType="Relative" secured="False" emptyRows="1" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" sourceType="Table" defaultPageSize="50" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" dataSource="smart_partsorders" name="GPreqOrders" pageSizeLimit="100" wizardCaption="List of Smart Partsorders " wizardGridType="Tabular" wizardAltRecord="False" wizardRecordSeparator="False" wizardNoRecords="No records" PathID="GPreqOrders" deleteControl="CheckBox_Delete" pasteActions="pasteActions" activeCollection="TableParameters">
			<Components>
				<Label id="70" fieldSourceType="DBColumn" dataType="Integer" html="False" name="lblNumber" fieldSource="id" required="False" caption="Id" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GPreqOrderslblNumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<TextBox id="72" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" name="podr_itemcode" fieldSource="podr_itemcode" required="True" caption="Podr Itemcode" wizardCaption="Podr Itemcode" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="GPreqOrderspodr_itemcode" features="(assigned)">
					<Components/>
					<Events/>
					<Attributes/>
					<Features>
						<PTAutoFill id="153" enabled="True" valueField="value" sourceType="Table" name="PTAutoFill1" servicePage="services/smartpreq_GPreqOrders_podr_itemcode_PTAutoFill1.ccp" searchField="spart_code" connection="SMART" featureNameChanged="No" dataSource="smart_sparepart" category="Prototype">
							<Components/>
							<Events/>
							<TableParameters/>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables/>
							<JoinLinks/>
							<Fields/>
							<Controls>
								<Control id="154" name="podr_itemname" source="spart_name" propertyValue="value" sourceId="73"/>
							</Controls>
							<ControlPoints/>
							<Features/>
						</PTAutoFill>
						<PTAutocomplete id="151" enabled="True" sourceType="Table" name="PTAutocomplete1" servicePage="services/smartpreq_GPreqOrders_podr_itemcode_PTAutocomplete1.ccp" category="Prototype" searchField="spart_code" connection="SMART" featureNameChanged="No" dataSource="smart_sparepart">
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
				</TextBox>
				<TextBox id="73" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="podr_itemname" fieldSource="podr_itemname" required="True" caption="Podr Itemname" wizardCaption="Podr Itemname" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="GPreqOrderspodr_itemname">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="74" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="podr_qty" fieldSource="podr_qty" required="True" caption="Podr Qty" wizardCaption="Podr Qty" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="GPreqOrderspodr_qty">
					<Components/>
					<Events>
						<Event name="OnChange" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="319"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="75" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="podr_site" fieldSource="podr_site" required="True" caption="Podr Site" wizardCaption="Podr Site" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="GPreqOrderspodr_site" sourceType="Table" connection="SMART" dataSource="smart_site" orderBy="site_code" boundColumn="site_code" textColumn="site_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="131" tableName="smart_site" posLeft="10" posTop="10" posWidth="121" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<TextBox id="76" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="podr_toppan" fieldSource="podr_toppan" required="True" caption="Podr Toppan" wizardCaption="Podr Toppan" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="GPreqOrderspodr_toppan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextArea id="77" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="podr_remarks" fieldSource="podr_remarks" required="False" caption="Podr Remarks" wizardCaption="Podr Remarks" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="GPreqOrderspodr_remarks">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<Panel id="78" visible="True" name="CheckBox_Delete_Panel">
					<Components>
						<CheckBox id="79" visible="Dynamic" fieldSourceType="CodeExpression" dataType="Boolean" name="CheckBox_Delete" checkedValue="true" uncheckedValue="false" wizardCaption="Delete" wizardAddNbsp="True" PathID="GPreqOrdersCheckBox_Delete_PanelCheckBox_Delete">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</CheckBox>
					</Components>
					<Events/>
					<Attributes/>
					<Features/>
				</Panel>
				<Button id="80" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="GPreqOrdersButton_Submit">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="81" urlType="Relative" enableValidation="False" isDefault="False" name="Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="GPreqOrdersCancel">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="317"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="71" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="podr_preqid" fieldSource="podr_preqid" required="False" caption="Podr Preqid" wizardCaption="Podr Preqid" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="GPreqOrderspodr_preqid">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Button id="147" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit1" operation="Submit" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="GPreqOrdersButton_Submit1">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="148" message="Are You Sure To Submit For Approval?" eventType="Client"/>
							</Actions>
						</Event>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="155" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Label id="318" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblQty" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GPreqOrderslblQty">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeBuildInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="149" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="156" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="247" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="139" conditionType="Parameter" useIsNull="False" field="podr_preqid" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="137" tableName="smart_partsorders" posLeft="10" posTop="10" posWidth="141" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<PKFields>
				<PKField id="138" tableName="smart_partsorders" fieldName="id" dataType="Integer"/>
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
		<Record id="82" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="RPreqSignAprv" dataSource="smart_partsrequisition" errorSummator="Error" wizardCaption="Add/Edit Smart Partsrequisition " wizardFormMethod="post" PathID="RPreqSignAprv" pasteActions="pasteActions">
			<Components>
				<Button id="83" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonInsertOn" PathID="RPreqSignAprvButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="84" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="RPreqSignAprvButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="85" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="RPreqSignAprvButton_Cancel">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="126" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<ListBox id="90" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="preq_approvedby" fieldSource="preq_approvedby" required="True" caption="Approved By" wizardCaption="Preq Approvedby" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="RPreqSignAprvpreq_approvedby" connection="SMART" dataSource="smart_user" activeCollection="TableParameters" boundColumn="usr_username" textColumn="usr_fullname">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="159" conditionType="Parameter" useIsNull="False" field="usr_group" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="Or" parameterSource="5"/>
						<TableParameter id="302" conditionType="Parameter" useIsNull="False" field="usr_group" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="7"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="158" tableName="smart_user" posLeft="10" posTop="10" posWidth="121" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<TextBox id="91" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="preq_approveddate" fieldSource="preq_approveddate" required="True" caption="Approved Date" wizardCaption="Preq Approveddate" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RPreqSignAprvpreq_approveddate" defaultValue="CurrentDateTime" format="GeneralDate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="92" name="DatePicker_preq_approveddate" control="preq_approveddate" wizardSatellite="True" wizardControl="preq_approveddate" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="RPreqSignAprvDatePicker_preq_approveddate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<ListBox id="93" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="preq_receivedby" fieldSource="preq_receivedby" required="False" caption="Preq Receivedby" wizardCaption="Preq Receivedby" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="RPreqSignAprvpreq_receivedby">
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
				<TextBox id="94" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="preq_receiveddate" fieldSource="preq_receiveddate" required="False" caption="Preq Receiveddate" wizardCaption="Preq Receiveddate" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RPreqSignAprvpreq_receiveddate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="98" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="preq_processedby" fieldSource="preq_processedby" required="False" caption="Preq Processedby" wizardCaption="Preq Processedby" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="RPreqSignAprvpreq_processedby">
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
				<TextBox id="99" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="preq_processeddate" fieldSource="preq_processeddate" required="False" caption="Preq Processeddate" wizardCaption="Preq Processeddate" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RPreqSignAprvpreq_processeddate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="101" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="preq_takenby" fieldSource="preq_takenby" required="False" caption="Preq Takenby" wizardCaption="Preq Takenby" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="RPreqSignAprvpreq_takenby">
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
				<TextBox id="102" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="preq_takendate" fieldSource="preq_takendate" required="False" caption="Preq Takendate" wizardCaption="Preq Takendate" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RPreqSignAprvpreq_takendate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<RadioButton id="157" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" html="True" returnValueType="Number" name="preq_status" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RPreqSignAprvpreq_status" fieldSource="preq_approval" connection="SMART" dataSource="smart_referencecode" activeCollection="TableParameters" boundColumn="ref_value" textColumn="ref_description" required="True" caption="Status Approval">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="203" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="stataprv"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="202" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="117" posHeight="152"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</RadioButton>
				<ListBox id="248" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" html="True" returnValueType="Number" name="preq_process" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RPreqSignAprvpreq_process" fieldSource="preq_process" connection="SMART" dataSource="smart_referencecode" activeCollection="TableParameters" boundColumn="ref_value" textColumn="ref_description">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="249" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="stataprv"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="250" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="117" posHeight="152"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<Hidden id="251" fieldSourceType="DBColumn" dataType="Text" name="status" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RPreqSignAprvstatus" fieldSource="preq_status">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="204"/>
					</Actions>
				</Event>
				<Event name="AfterUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="207"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="105" conditionType="Parameter" useIsNull="False" field="id" parameterSource="id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="127" tableName="smart_partsrequisition" posLeft="10" posTop="10" posWidth="153" posHeight="180"/>
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
				<CheckBox id="252" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" name="status" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RPreqViewstatus" fieldSource="preq_status" checkedValue="6">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</CheckBox>
				<Button id="253" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="RPreqViewButton_Update" removeParameters="view">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="254" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Label id="255" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblRtn" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RPreqViewlblRtn" fieldSource="preq_status">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Link id="286" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="linkRtn" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RPreqViewlinkRtn" hrefSource="smartpreq.ccp" wizardUseTemplateBlock="True" removeParameters="view">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="287" sourceType="Expression" format="yyyy-mm-dd" name="rtn" source="1"/>
						<LinkParameter id="288" sourceType="DataField" format="yyyy-mm-dd" name="id" source="id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
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
		<Panel id="133" visible="True" name="PanProcessCheck" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="PanProcessCheck">
			<Components>
				<Label id="135" fieldSourceType="DBColumn" dataType="Text" html="True" name="lblRequest" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="PanProcessChecklblRequest">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="140" fieldSourceType="DBColumn" dataType="Text" html="True" name="lblApproval" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="PanProcessChecklblApproval">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="141" fieldSourceType="DBColumn" dataType="Text" html="True" name="lblInProcess" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="PanProcessChecklblInProcess">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="142" fieldSourceType="DBColumn" dataType="Text" html="True" name="lblReturned" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="PanProcessChecklblReturned">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="144" fieldSourceType="DBColumn" dataType="Text" html="True" name="lblFinished" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="PanProcessChecklblFinished">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="242" fieldSourceType="DBColumn" dataType="Text" html="True" name="lblReleased" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="PanProcessChecklblReleased">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="243" fieldSourceType="DBColumn" dataType="Text" html="True" name="lblCancelled" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="PanProcessChecklblCancelled">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="136"/>
					</Actions>
				</Event>
			</Events>
			<Attributes/>
			<Features/>
		</Panel>
		<Record id="160" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="RPreqSignPrcs" dataSource="smart_partsrequisition" errorSummator="Error" wizardCaption="Add/Edit Smart Partsrequisition " wizardFormMethod="post" PathID="RPreqSignPrcs" pasteActions="pasteActions">
			<Components>
				<Button id="161" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonInsertOn" PathID="RPreqSignPrcsButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="162" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="RPreqSignPrcsButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="163" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="RPreqSignPrcsButton_Cancel">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="164" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Label id="165" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="preq_approvedby" fieldSource="preq_approvedby" required="False" caption="Preq Approvedby" wizardCaption="Preq Approvedby" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="RPreqSignPrcspreq_approvedby" connection="SMART" dataSource="smart_user" activeCollection="TableParameters" boundColumn="usr_username" textColumn="usr_fullname" html="False">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="166" conditionType="Parameter" useIsNull="False" field="usr_group" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="2"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="167" tableName="smart_user" posLeft="10" posTop="10" posWidth="121" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="168" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="preq_approveddate" fieldSource="preq_approveddate" required="True" caption="Preq Approveddate" wizardCaption="Preq Approveddate" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RPreqSignPrcspreq_approveddate" defaultValue="CurrentDateTime" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<ListBox id="170" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="preq_receivedby" fieldSource="preq_receivedby" required="False" caption="Preq Receivedby" wizardCaption="Preq Receivedby" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="RPreqSignPrcspreq_receivedby">
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
				<TextBox id="171" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="preq_receiveddate" fieldSource="preq_receiveddate" required="False" caption="Preq Receiveddate" wizardCaption="Preq Receiveddate" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RPreqSignPrcspreq_receiveddate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="172" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="preq_processedby" fieldSource="preq_processedby" required="True" caption="Processed By" wizardCaption="Preq Processedby" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="RPreqSignPrcspreq_processedby" connection="SMART" dataSource="smart_user" boundColumn="usr_username" textColumn="usr_fullname" activeCollection="TableParameters">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="304" conditionType="Parameter" useIsNull="False" field="usr_group" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="7"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="303" tableName="smart_user" posLeft="10" posTop="10" posWidth="121" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<TextBox id="173" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="preq_processeddate" fieldSource="preq_processeddate" required="True" caption="Processed Date" wizardCaption="Preq Processeddate" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RPreqSignPrcspreq_processeddate" format="GeneralDate" defaultValue="CurrentDateTime">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="174" name="DatePicker_preq_processeddate" control="preq_processeddate" wizardSatellite="True" wizardControl="preq_processeddate" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="RPreqSignPrcsDatePicker_preq_processeddate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<ListBox id="175" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="preq_takenby" fieldSource="preq_takenby" required="True" caption="Taken By" wizardCaption="Preq Takenby" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="RPreqSignPrcspreq_takenby" connection="SMART" dataSource="smart_user" boundColumn="usr_username" textColumn="usr_fullname" activeCollection="TableParameters">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="306" conditionType="Parameter" useIsNull="False" field="usr_group" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="3"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="305" tableName="smart_user" posLeft="10" posTop="10" posWidth="121" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<TextBox id="176" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="preq_takendate" fieldSource="preq_takendate" required="True" caption="Taken Date" wizardCaption="Preq Takendate" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RPreqSignPrcspreq_takendate" format="GeneralDate" defaultValue="CurrentDateTime">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="177" name="DatePicker_preq_takendate" control="preq_takendate" wizardSatellite="True" wizardControl="preq_takendate" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="RPreqSignPrcsDatePicker_preq_takendate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<Label id="178" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" html="False" returnValueType="Number" name="preq_approval" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RPreqSignPrcspreq_approval" fieldSource="preq_approval">
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
				</Label>
				<TextArea id="234" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="preq_reason" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RPreqSignPrcspreq_reason" fieldSource="preq_reason">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<ListBox id="233" visible="Yes" fieldSourceType="DBColumn" sourceType="ListOfValues" dataType="Text" returnValueType="Number" name="preq_status" fieldSource="preq_process" PathID="RPreqSignPrcspreq_status" connection="SMART" _valueOfList="5" _nameOfList="Cancelled" dataSource="4;Released;5;Cancelled" required="True" caption="Status">
					<Components/>
					<Events>
						<Event name="OnChange" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="235"/>
							</Actions>
						</Event>
					</Events>
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
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="237"/>
					</Actions>
				</Event>
				<Event name="AfterUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="240"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="179" conditionType="Parameter" useIsNull="False" field="id" parameterSource="id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="180" tableName="smart_partsrequisition" posLeft="10" posTop="10" posWidth="153" posHeight="180"/>
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
		<Record id="181" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="RPreqSignRtn" dataSource="smart_partsrequisition" errorSummator="Error" wizardCaption="Add/Edit Smart Partsrequisition " wizardFormMethod="post" PathID="RPreqSignRtn" pasteActions="pasteActions">
			<Components>
				<Button id="182" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonInsertOn" PathID="RPreqSignRtnButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="183" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="RPreqSignRtnButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="184" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="RPreqSignRtnButton_Cancel">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="185" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Label id="186" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="preq_approvedby" fieldSource="preq_approvedby" required="False" caption="Preq Approvedby" wizardCaption="Preq Approvedby" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="RPreqSignRtnpreq_approvedby" connection="SMART" dataSource="smart_user" activeCollection="TableParameters" boundColumn="usr_username" textColumn="usr_fullname" html="False">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="187" conditionType="Parameter" useIsNull="False" field="usr_group" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="2"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="188" tableName="smart_user" posLeft="10" posTop="10" posWidth="121" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="189" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="preq_approveddate" fieldSource="preq_approveddate" required="True" caption="Preq Approveddate" wizardCaption="Preq Approveddate" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RPreqSignRtnpreq_approveddate" defaultValue="CurrentDateTime" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<ListBox id="191" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="preq_receivedby" fieldSource="preq_receivedby" required="True" caption="Received By" wizardCaption="Preq Receivedby" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="RPreqSignRtnpreq_receivedby" connection="SMART" dataSource="smart_user" boundColumn="usr_username" textColumn="usr_fullname" activeCollection="TableParameters">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="308" conditionType="Parameter" useIsNull="False" field="usr_group" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="Or" parameterSource="5"/>
						<TableParameter id="309" conditionType="Parameter" useIsNull="False" field="usr_group" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="7"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="307" tableName="smart_user" posLeft="10" posTop="10" posWidth="121" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<TextBox id="192" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="preq_receiveddate" fieldSource="preq_receiveddate" required="True" caption="Received Date" wizardCaption="Preq Receiveddate" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RPreqSignRtnpreq_receiveddate" format="GeneralDate" defaultValue="CurrentDateTime">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Label id="193" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="preq_processedby" fieldSource="preq_processedby" required="False" caption="Preq Processedby" wizardCaption="Preq Processedby" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="RPreqSignRtnpreq_processedby" html="False">
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
				</Label>
				<Label id="194" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="preq_processeddate" fieldSource="preq_processeddate" required="False" caption="Preq Processeddate" wizardCaption="Preq Processeddate" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RPreqSignRtnpreq_processeddate" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="196" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="preq_takenby" fieldSource="preq_takenby" required="False" caption="Preq Takenby" wizardCaption="Preq Takenby" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="RPreqSignRtnpreq_takenby" html="False">
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
				</Label>
				<Label id="197" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="preq_takendate" fieldSource="preq_takendate" required="False" caption="Preq Takendate" wizardCaption="Preq Takendate" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RPreqSignRtnpreq_takendate" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="199" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" html="False" returnValueType="Number" name="preq_approval" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RPreqSignRtnpreq_approval" fieldSource="preq_approval">
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
				</Label>
				<Label id="232" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="ListBox1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" wizardEmptyCaption="Select Value" PathID="RPreqSignRtnListBox1" fieldSource="preq_status" html="False">
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
				</Label>
				<DatePicker id="241" name="DatePicker_preq_receiveddate" control="preq_receiveddate" wizardSatellite="True" wizardControl="preq_processeddate" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="RPreqSignRtnDatePicker_preq_receiveddate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="200" conditionType="Parameter" useIsNull="False" field="id" parameterSource="id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="201" tableName="smart_partsrequisition" posLeft="10" posTop="10" posWidth="153" posHeight="180"/>
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
		<Record id="208" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="RPreqSignView" dataSource="smart_partsrequisition" errorSummator="Error" wizardCaption="Add/Edit Smart Partsrequisition " wizardFormMethod="post" PathID="RPreqSignView" pasteActions="pasteActions">
			<Components>
				<Button id="209" urlType="Relative" enableValidation="True" isDefault="False" name="BtnProcess" wizardCaption="Add" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonInsertOn" PathID="RPreqSignViewBtnProcess">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="230"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="210" urlType="Relative" enableValidation="True" isDefault="False" name="BtnApproval" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="RPreqSignViewBtnApproval">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="231"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="211" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="RPreqSignViewButton_Cancel">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="212"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Label id="213" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="preq_approvedby" fieldSource="preq_approvedby" required="False" caption="Preq Approvedby" wizardCaption="Preq Approvedby" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="RPreqSignViewpreq_approvedby" connection="SMART" dataSource="smart_user" activeCollection="TableParameters" boundColumn="usr_username" textColumn="usr_fullname" html="False">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="214" conditionType="Parameter" useIsNull="False" field="usr_group" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="2"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="215" tableName="smart_user" posLeft="10" posTop="10" posWidth="121" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="216" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="preq_approveddate" fieldSource="preq_approveddate" required="True" caption="Preq Approveddate" wizardCaption="Preq Approveddate" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RPreqSignViewpreq_approveddate" defaultValue="CurrentDateTime" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="218" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="preq_receivedby" fieldSource="preq_receivedby" required="False" caption="Preq Receivedby" wizardCaption="Preq Receivedby" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="RPreqSignViewpreq_receivedby" html="False">
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
				</Label>
				<Label id="219" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="preq_receiveddate" fieldSource="preq_receiveddate" required="False" caption="Preq Receiveddate" wizardCaption="Preq Receiveddate" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RPreqSignViewpreq_receiveddate" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="220" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="preq_processedby" fieldSource="preq_processedby" required="False" caption="Preq Processedby" wizardCaption="Preq Processedby" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="RPreqSignViewpreq_processedby" html="False">
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
				</Label>
				<Label id="221" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="preq_processeddate" fieldSource="preq_processeddate" required="False" caption="Preq Processeddate" wizardCaption="Preq Processeddate" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RPreqSignViewpreq_processeddate" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="223" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="preq_takenby" fieldSource="preq_takenby" required="False" caption="Preq Takenby" wizardCaption="Preq Takenby" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="RPreqSignViewpreq_takenby" html="False">
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
				</Label>
				<Label id="224" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="preq_takendate" fieldSource="preq_takendate" required="False" caption="Preq Takendate" wizardCaption="Preq Takendate" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RPreqSignViewpreq_takendate" html="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="226" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" html="False" returnValueType="Number" name="preq_status" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RPreqSignViewpreq_status" fieldSource="preq_approval">
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
				</Label>
				<Label id="238" fieldSourceType="DBColumn" dataType="Text" html="False" name="preq_process" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RPreqSignViewpreq_process" fieldSource="preq_process">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="239" fieldSourceType="DBColumn" dataType="Text" html="True" name="preq_reason" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RPreqSignViewpreq_reason" fieldSource="preq_reason">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="229"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="227" conditionType="Parameter" useIsNull="False" field="id" parameterSource="id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="228" tableName="smart_partsrequisition" posLeft="10" posTop="10" posWidth="153" posHeight="180"/>
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
		<EditableGrid id="256" urlType="Relative" secured="False" emptyRows="0" allowInsert="False" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" sourceType="Table" defaultPageSize="50" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" dataSource="smart_partsorders" name="GPreqOrdersRtn" pageSizeLimit="100" wizardCaption="List of Smart Partsorders " wizardGridType="Tabular" wizardAltRecord="False" wizardRecordSeparator="False" wizardNoRecords="No records" PathID="GPreqOrdersRtn" deleteControl="CheckBox_Delete" pasteActions="pasteActions" activeCollection="TableParameters" oldID="256">
			<Components>
				<Label id="257" fieldSourceType="DBColumn" dataType="Integer" html="False" name="lblNumber" fieldSource="id" required="False" caption="Id" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GPreqOrdersRtnlblNumber" oldID="257">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="258" visible="Dynamic" fieldSourceType="DBColumn" dataType="Text" name="podr_itemcode" fieldSource="podr_itemcode" required="True" caption="Podr Itemcode" wizardCaption="Podr Itemcode" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="GPreqOrdersRtnpodr_itemcode" features="(assigned)" html="False" oldID="258">
					<Components/>
					<Events/>
					<Attributes/>
					<Features>
						<PTAutoFill id="259" enabled="True" valueField="value" sourceType="Table" name="PTAutoFill2" servicePage="services/smartpreq_GPreqOrders_podr_itemcode_PTAutoFill1.ccp" searchField="spart_code" connection="SMART" featureNameChanged="No" dataSource="smart_sparepart" category="Prototype">
							<Components/>
							<Events/>
							<TableParameters/>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables/>
							<JoinLinks/>
							<Fields/>
							<Controls>
								<Control id="260" name="podr_itemname" source="spart_name" propertyValue="value" sourceId="73"/>
							</Controls>
							<ControlPoints/>
							<Features/>
						</PTAutoFill>
						<PTAutocomplete id="261" enabled="True" sourceType="Table" name="PTAutocomplete2" servicePage="services/smartpreq_GPreqOrders_podr_itemcode_PTAutocomplete1.ccp" category="Prototype" searchField="spart_code" connection="SMART" featureNameChanged="No" dataSource="smart_sparepart">
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
				<Label id="262" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="podr_itemname" fieldSource="podr_itemname" required="True" caption="Podr Itemname" wizardCaption="Podr Itemname" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="GPreqOrdersRtnpodr_itemname" html="False" oldID="262">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="263" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="podr_qty" fieldSource="podr_qty" required="True" caption="Podr Qty" wizardCaption="Podr Qty" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="GPreqOrdersRtnpodr_qty" html="False" oldID="263">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="264" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="podr_site" fieldSource="podr_site" required="True" caption="Podr Site" wizardCaption="Podr Site" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="GPreqOrdersRtnpodr_site" sourceType="Table" connection="SMART" dataSource="smart_site" orderBy="site_code" boundColumn="site_code" textColumn="site_code" html="False" oldID="264">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="265" tableName="smart_site" posLeft="10" posTop="10" posWidth="121" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
				</Label>
				<Label id="266" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="podr_toppan" fieldSource="podr_toppan" required="True" caption="Podr Toppan" wizardCaption="Podr Toppan" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="GPreqOrdersRtnpodr_toppan" html="False" oldID="266">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="267" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="podr_remarks" fieldSource="podr_remarks" required="False" caption="Podr Remarks" wizardCaption="Podr Remarks" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="GPreqOrdersRtnpodr_remarks" html="False" oldID="267">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Button id="270" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="GPreqOrdersRtnButton_Submit" oldID="270">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="271" urlType="Relative" enableValidation="False" isDefault="False" name="Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="GPreqOrdersRtnCancel" oldID="271">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="316" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="272" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="podr_preqid" fieldSource="podr_preqid" required="False" caption="Podr Preqid" wizardCaption="Podr Preqid" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="GPreqOrdersRtnpodr_preqid" oldID="272">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="282" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="podr_datereceived" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GPreqOrdersRtnpodr_datereceived" fieldSource="podr_datereceived" oldID="282">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="283" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="podr_qtyreceived" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GPreqOrdersRtnpodr_qtyreceived" fieldSource="podr_qtyreceived" oldID="283">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="284" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="podr_remarks2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GPreqOrdersRtnpodr_remarks2" fieldSource="podr_remarks2" oldID="284">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="285" name="DatePicker_podr_datereceived1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GPreqOrdersRtnDatePicker_podr_datereceived1" control="podr_datereceived" wizardDatePickerType="Image" wizardPicture="Styles/None/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
			</Components>
			<Events>
				<Event name="BeforeBuildInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="276" eventType="Server" oldID="276"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="277" eventType="Server" oldID="277"/>
					</Actions>
				</Event>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="278" eventType="Server" oldID="278"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="279" conditionType="Parameter" useIsNull="False" field="podr_preqid" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="id"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="280" tableName="smart_partsorders" posLeft="10" posTop="10" posWidth="141" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<PKFields>
				<PKField id="281" tableName="smart_partsorders" fieldName="id" dataType="Integer"/>
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
		<Grid id="289" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="50" connection="SMART" dataSource="smart_partsorders" name="GPartsOrdersView" pageSizeLimit="100" wizardCaption="List of Smart Partsorders " wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="False" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records" pasteActions="pasteActions" activeCollection="TableParameters" orderBy="podr_itemcode">
			<Components>
				<Label id="290" fieldSourceType="DBColumn" dataType="Integer" html="False" name="lblNumber" fieldSource="id" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="GPartsOrdersViewlblNumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="293" fieldSourceType="DBColumn" dataType="Text" html="False" name="podr_itemcode" fieldSource="podr_itemcode" wizardCaption="Podr Itemcode" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GPartsOrdersViewpodr_itemcode">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="294" fieldSourceType="DBColumn" dataType="Text" html="False" name="podr_itemname" fieldSource="podr_itemname" wizardCaption="Podr Itemname" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GPartsOrdersViewpodr_itemname">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="295" fieldSourceType="DBColumn" dataType="Integer" html="False" name="podr_qty" fieldSource="podr_qty" wizardCaption="Podr Qty" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="GPartsOrdersViewpodr_qty">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="296" fieldSourceType="DBColumn" dataType="Text" html="False" name="podr_site" fieldSource="podr_site" wizardCaption="Podr Site" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GPartsOrdersViewpodr_site">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="297" fieldSourceType="DBColumn" dataType="Text" html="False" name="podr_toppan" fieldSource="podr_toppan" wizardCaption="Podr Toppan" wizardSize="50" wizardMaxLength="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GPartsOrdersViewpodr_toppan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="298" fieldSourceType="DBColumn" dataType="Memo" html="False" name="podr_remarks" fieldSource="podr_remarks" wizardCaption="Podr Remarks" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GPartsOrdersViewpodr_remarks">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="299" fieldSourceType="DBColumn" dataType="Date" html="False" name="podr_datereceived" fieldSource="podr_datereceived" wizardCaption="Podr Datereceived" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GPartsOrdersViewpodr_datereceived">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="300" fieldSourceType="DBColumn" dataType="Integer" html="False" name="podr_qtyreceived" fieldSource="podr_qtyreceived" wizardCaption="Podr Qtyreceived" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="GPartsOrdersViewpodr_qtyreceived">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="301" fieldSourceType="DBColumn" dataType="Memo" html="False" name="podr_remarks2" fieldSource="podr_remarks2" wizardCaption="Podr Remarks2" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GPartsOrdersViewpodr_remarks2">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="312"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="313"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="311" conditionType="Parameter" useIsNull="False" field="podr_preqid" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="id"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="310" tableName="smart_partsorders" posLeft="10" posTop="10" posWidth="141" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="smartpreq.php" forShow="True" url="smartpreq.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="smartpreq_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="PTAutocomplete151" language="PHPTemplates" name="smartpreqGPreqOrderspodr_itemcode_style.css" forShow="False" comment="/*" commentEnd="*/" codePage="windows-1252"/>
		<CodeFile id="PTAutocomplete261" language="PHPTemplates" name="smartpreqGPreqOrdersRtnpodr_itemcode_style.css" forShow="False" comment="/*" commentEnd="*/" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="124"/>
			</Actions>
		</Event>
	</Events>
</Page>
