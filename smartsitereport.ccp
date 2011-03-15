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
		<Grid id="5" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="50" connection="SMART" dataSource="smart_sitereport" name="GSiteReport" pageSizeLimit="100" wizardCaption="List of Smart Sitereport " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records">
			<Components>
				<Link id="21" visible="Yes" fieldSourceType="DBColumn" dataType="Date" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="sr_datereport" fieldSource="sr_datereport" wizardCaption="Sr Datereport" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" hrefSource="smartsitereport.ccp" wizardThemeItem="GridA" PathID="GSiteReportsr_datereport">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="22" sourceType="DataField" format="yyyy-mm-dd" name="id" source="id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="24" fieldSourceType="DBColumn" dataType="Text" html="False" name="sr_status" fieldSource="sr_status" wizardCaption="Sr Status" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GSiteReportsr_status">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="26" fieldSourceType="DBColumn" dataType="Text" html="False" name="sr_reportedby" fieldSource="sr_reportedby" wizardCaption="Sr Reportedby" wizardSize="50" wizardMaxLength="150" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GSiteReportsr_reportedby">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="28" fieldSourceType="DBColumn" dataType="Text" html="False" name="sr_takenby" fieldSource="sr_takenby" wizardCaption="Sr Takenby" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GSiteReportsr_takenby">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="29" fieldSourceType="DBColumn" dataType="Integer" html="False" name="lblNumber" fieldSource="id" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="GSiteReportlblNumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="31" fieldSourceType="DBColumn" dataType="Text" html="False" name="sr_sitecode" fieldSource="sr_sitecode" wizardCaption="Sr Sitecode" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GSiteReportsr_sitecode">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="33" fieldSourceType="DBColumn" dataType="Text" html="False" name="sr_type" fieldSource="sr_type" wizardCaption="Sr Type" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GSiteReportsr_type">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="35" fieldSourceType="DBColumn" dataType="Memo" html="False" name="sr_report" fieldSource="sr_report" wizardCaption="Sr Report" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GSiteReportsr_report">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="36" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Simple" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardImagesScheme="{ccs_style}">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="19" styles="Row;AltRow" name="rowStyle"/>
						<Action actionName="Custom Code" actionCategory="General" id="57"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="56"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="15" conditionType="Parameter" useIsNull="False" field="sr_status" parameterSource="s_sr_status" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="1"/>
				<TableParameter id="16" conditionType="Parameter" useIsNull="False" field="sr_sitecode" parameterSource="s_sr_sitecode" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="2"/>
				<TableParameter id="17" conditionType="Parameter" useIsNull="False" field="sr_type" parameterSource="s_sr_type" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="3"/>
				<TableParameter id="18" conditionType="Parameter" useIsNull="False" field="sr_datereport" parameterSource="s_sr_datereport" dataType="Date" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="4"/>
			</TableParameters>
			<JoinTables/>
			<JoinLinks/>
			<Fields>
				<Field id="13" tableName="smart_sitereport" fieldName="id"/>
				<Field id="20" tableName="smart_sitereport" fieldName="sr_datereport"/>
				<Field id="23" tableName="smart_sitereport" fieldName="sr_status"/>
				<Field id="25" tableName="smart_sitereport" fieldName="sr_reportedby"/>
				<Field id="27" tableName="smart_sitereport" fieldName="sr_takenby"/>
				<Field id="30" tableName="smart_sitereport" fieldName="sr_sitecode"/>
				<Field id="32" tableName="smart_sitereport" fieldName="sr_type"/>
				<Field id="34" tableName="smart_sitereport" fieldName="sr_report"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="6" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="SSiteReport" wizardCaption="Search Smart Sitereport " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="smartsitereport.ccp" PathID="SSiteReport" pasteActions="pasteActions">
			<Components>
				<Button id="7" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonSearchOn" PathID="SSiteReportButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<ListBox id="8" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="stat" wizardCaption="Sr Status" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardEmptyCaption="Select Value" PathID="SSiteReportstat" connection="SMART" dataSource="smart_referencecode" activeCollection="TableParameters" orderBy="ref_rank" boundColumn="ref_value" textColumn="ref_description">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="90" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="statsrpt"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="89" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="117" posHeight="152"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<ListBox id="9" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="code" wizardCaption="Sr Sitecode" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardEmptyCaption="Select Value" PathID="SSiteReportcode">
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
				<TextBox id="11" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="df" wizardCaption="Sr Datereport" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" PathID="SSiteReportdf">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="12" name="DatePicker_df" control="df" wizardSatellite="True" wizardControl="s_sr_datereport" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="SSiteReportDatePicker_df">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<TextBox id="50" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="dt" wizardCaption="Sr Datereport" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" PathID="SSiteReportdt">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="51" name="DatePicker_dt" control="dt" wizardSatellite="True" wizardControl="s_sr_datereport" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="SSiteReportDatePicker_dt">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<RadioButton id="10" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" html="True" returnValueType="Number" name="type" wizardCaption="Sr Type" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" PathID="SSiteReporttype" connection="SMART" dataSource="smart_referencecode" activeCollection="TableParameters" orderBy="ref_rank" boundColumn="ref_value" textColumn="ref_description">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="53" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="srtype"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="52" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="117" posHeight="152"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</RadioButton>
				<ImageLink id="62" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="None" name="btnNew" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="SSiteReportbtnNew" hrefSource="smartsitereport.ccp">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="63" sourceType="Expression" format="yyyy-mm-dd" name="new" source="1"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
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
		<Panel id="72" visible="Dynamic" name="Panel2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel2" features="(assigned)">
			<Components>
				<Record id="66" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="SUpdStatus" dataSource="smart_logstatussrpt" errorSummator="Error" wizardCaption="Add/Edit Smart Sitereport " wizardFormMethod="post" PathID="Panel2SUpdStatus">
					<Components>
						<Button id="67" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="Panel2SUpdStatusButton_Insert" returnPage="smartsitereport.ccp">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
						<Button id="68" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="Panel2SUpdStatusButton_Cancel" returnPage="smartsitereport.ccp">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
						<ListBox id="70" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="Status" fieldSource="logsrpt_status" required="True" caption="Status" wizardCaption="Sr Status" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="Panel2SUpdStatusStatus" connection="SMART" dataSource="smart_referencecode" activeCollection="TableParameters" boundColumn="ref_value" textColumn="ref_description">
							<Components/>
							<Events/>
							<TableParameters>
								<TableParameter id="96" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="statsrpt"/>
							</TableParameters>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables>
								<JoinTable id="95" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="117" posHeight="152"/>
							</JoinTables>
							<JoinLinks/>
							<Fields/>
							<Attributes/>
							<Features/>
						</ListBox>
						<TextArea id="71" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="Remark" fieldSource="logsrpt_desc" required="False" caption="Remark" wizardCaption="Sr Datereport" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Panel2SUpdStatusRemark">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextArea>
						<Hidden id="97" fieldSourceType="DBColumn" dataType="Text" name="logsrpt_id" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel2SUpdStatuslogsrpt_id" fieldSource="logsrpt_id">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<Hidden id="98" fieldSourceType="DBColumn" dataType="Text" name="logsrpt_action" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel2SUpdStatuslogsrpt_action" fieldSource="logsrpt_action" defaultValue="&quot;UPDATE&quot;">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<Hidden id="99" fieldSourceType="DBColumn" dataType="Text" name="logsrpt_staff" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel2SUpdStatuslogsrpt_staff" fieldSource="logsrpt_staff">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
					</Components>
					<Events>
						<Event name="OnLoad" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="88"/>
							</Actions>
						</Event>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="100"/>
							</Actions>
						</Event>
						<Event name="AfterUpdate" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="101"/>
							</Actions>
						</Event>
						<Event name="AfterInsert" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="103"/>
							</Actions>
						</Event>
					</Events>
					<TableParameters>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="102" tableName="smart_logstatussrpt" posLeft="10" posTop="10" posWidth="115" posHeight="168"/>
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
			<Events/>
			<Attributes/>
			<Features>
				<UpdatePanel id="73" enabled="True" childrenAsTriggers="True" name="UpdatePanel" category="Ajax" featureNameChanged="No">
					<Components/>
					<Events/>
					<ControlPoints/>
					<Features/>
				</UpdatePanel>
				<ShowModal id="75" enabled="True" name="ShowModal1" category="Ajax" featureNameChanged="No">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables/>
					<JoinLinks/>
					<Fields/>
					<ControlPoints/>
					<Features/>
				</ShowModal>
				<ClientCustomCode id="76" enabled="True" name="ClientCustomCode1" category="Ajax" featureNameChanged="No" ccsIdsOnly="False" start="Panel2UpdatePanel.onrefresh;">
					<Components/>
					<Events/>
					<ControlPoints>
						<ControlPoint id="105">
							<Items>
								<ControlPointItem id="106" name="smartsitereport" ccpId="1" type="Page" isFeature="False"/>
								<ControlPointItem id="107" name="Panel2" ccpId="72" type="Panel" isFeature="False" PathID="Panel2"/>
								<ControlPointItem id="108" name="UpdatePanel" ccpId="73" type="UpdatePanel" isFeature="True" PathID="Panel2UpdatePanel"/>
							</Items>
						</ControlPoint>
					</ControlPoints>
					<Features/>
				</ClientCustomCode>
				<ClientCustomCode id="109" enabled="True" name="ClientCustomCode2" category="Ajax" featureNameChanged="No" ccsIdsOnly="False" start="Panel2SUpdStatus.onsubmit;">
					<Components/>
					<Events/>
					<ControlPoints>
						<ControlPoint id="110" name="Panel2SUpdStatus.onsubmit" relProperty="start">
							<Items>
								<ControlPointItem id="111" name="smartsitereport" ccpId="1" type="Page" isFeature="False"/>
								<ControlPointItem id="112" name="Panel2" ccpId="72" type="Panel" isFeature="False" PathID="Panel2"/>
								<ControlPointItem id="113" name="SUpdStatus" ccpId="66" type="Record" isFeature="False" PathID="Panel2SUpdStatus"/>
							</Items>
						</ControlPoint>
					</ControlPoints>
					<Features/>
				</ClientCustomCode>
			</Features>
		</Panel>
		<Panel id="114" visible="Dynamic" name="Panel1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel1" features="(assigned)" pasteActions="pasteActions">
			<Components>
				<Record id="37" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="RSiteReport" dataSource="smart_sitereport" errorSummator="Error" wizardCaption="Add/Edit Smart Sitereport " wizardFormMethod="post" PathID="Panel1RSiteReport" pasteActions="pasteActions" visible="Dynamic">
					<Components>
						<Button id="38" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonInsertOn" PathID="Panel1RSiteReportButton_Insert">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
						<Button id="39" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="Panel1RSiteReportButton_Update">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Button>
						<Button id="40" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="Panel1RSiteReportButton_Cancel" removeParameters="id;new;view;" returnPage="smartsitereport.ccp">
							<Components/>
							<Events>
								<Event name="OnClick" type="Server">
									<Actions>
										<Action actionName="Custom Code" actionCategory="General" id="58" eventType="Server"/>
									</Actions>
								</Event>
							</Events>
							<Attributes/>
							<Features/>
						</Button>
						<ListBox id="42" visible="Dynamic" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="sr_status" fieldSource="sr_status" required="False" caption="Sr Status" wizardCaption="Sr Status" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="Panel1RSiteReportsr_status" connection="SMART" dataSource="smart_referencecode" activeCollection="TableParameters" boundColumn="ref_value" textColumn="ref_description" html="False">
							<Components/>
							<Events/>
							<TableParameters>
								<TableParameter id="94" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="statsrpt"/>
							</TableParameters>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables>
								<JoinTable id="93" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="117" posHeight="152"/>
							</JoinTables>
							<JoinLinks/>
							<Fields/>
							<Attributes/>
							<Features/>
						</ListBox>
						<TextBox id="43" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="sr_reportedby" fieldSource="sr_reportedby" required="False" caption="Reported By" wizardCaption="Sr Reportedby" wizardSize="50" wizardMaxLength="150" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Panel1RSiteReportsr_reportedby">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextBox id="44" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="sr_takenbyv" required="False" wizardCaption="Sr Takenby" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Panel1RSiteReportsr_takenbyv">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<TextBox id="45" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="sr_datereport" fieldSource="sr_datereport" required="False" caption="Sr Datereport" wizardCaption="Sr Datereport" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Panel1RSiteReportsr_datereport" format="GeneralDate" defaultValue="CurrentDateTime">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextBox>
						<DatePicker id="46" name="DatePicker_sr_datereport" control="sr_datereport" wizardSatellite="True" wizardControl="sr_datereport" wizardDatePickerType="Image" wizardPicture="Styles/{CCS_Style}/Images/DatePicker.gif" style="Styles/{CCS_Style}/Style.css" PathID="Panel1RSiteReportDatePicker_sr_datereport">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</DatePicker>
						<ListBox id="47" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="sr_sitecode" fieldSource="sr_sitecode" required="True" caption="Site Code" wizardCaption="Sr Sitecode" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="Panel1RSiteReportsr_sitecode" connection="SMART" dataSource="smart_site" boundColumn="site_code" textColumn="site_code">
							<Components/>
							<Events/>
							<TableParameters/>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables>
								<JoinTable id="91" tableName="smart_site" posLeft="10" posTop="10" posWidth="121" posHeight="180"/>
							</JoinTables>
							<JoinLinks/>
							<Fields/>
							<Attributes/>
							<Features/>
						</ListBox>
						<RadioButton id="48" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" html="True" returnValueType="Number" name="sr_type" fieldSource="sr_type" required="True" caption="Type" wizardCaption="Sr Type" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="Panel1RSiteReportsr_type" connection="SMART" dataSource="smart_referencecode" activeCollection="TableParameters" orderBy="ref_rank" boundColumn="ref_value" textColumn="ref_description">
							<Components/>
							<Events/>
							<TableParameters>
								<TableParameter id="55" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="srtype"/>
							</TableParameters>
							<SPParameters/>
							<SQLParameters/>
							<JoinTables>
								<JoinTable id="54" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="117" posHeight="152"/>
							</JoinTables>
							<JoinLinks/>
							<Fields/>
							<Attributes/>
							<Features/>
						</RadioButton>
						<TextArea id="49" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="sr_report" fieldSource="sr_report" required="True" caption="Report" wizardCaption="Sr Report" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="Panel1RSiteReportsr_report">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</TextArea>
						<Hidden id="60" fieldSourceType="DBColumn" dataType="Text" name="sr_takenby" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel1RSiteReportsr_takenby" caption="sr_takenby" fieldSource="sr_takenby">
							<Components/>
							<Events/>
							<Attributes/>
							<Features/>
						</Hidden>
						<Panel id="64" visible="True" name="EditStatus" PathID="Panel1RSiteReportEditStatus">
							<Components>
								<Link id="65" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="linkStatus" hrefSource="#" PathID="Panel1RSiteReportEditStatuslinkStatus">
									<Components/>
									<Events/>
									<LinkParameters/>
									<Attributes/>
									<Features/>
								</Link>
							</Components>
							<Events/>
							<Attributes/>
							<Features/>
						</Panel>
						<Label id="129" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblStatus" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="Panel1RSiteReportlblStatus" defaultValue="&quot;NEW!&quot;">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
					<Events>
						<Event name="AfterInsert" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="59" eventType="Server"/>
							</Actions>
						</Event>
						<Event name="OnLoad" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="74" eventType="Client"/>
							</Actions>
						</Event>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="92" eventType="Server"/>
							</Actions>
						</Event>
						<Event name="AfterUpdate" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="104" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<TableParameters>
						<TableParameter id="41" conditionType="Parameter" useIsNull="False" field="id" parameterSource="id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
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
					<Features>
					</Features>
				</Record>
			</Components>
			<Events/>
			<Attributes/>
			<Features>
				<UpdatePanel id="115" enabled="True" childrenAsTriggers="True" name="UpdatePanel" category="Ajax">
					<Components/>
					<Events/>
					<ControlPoints/>
					<Features/>
				</UpdatePanel>
				<ClientCustomCode id="116" enabled="True" name="ClientCustomCode3" category="Ajax" featureNameChanged="No" ccsIdsOnly="False" start="Panel1RSiteReportEditStatuslinkStatus.onclick;">
					<Components/>
					<Events/>
					<ControlPoints>
						<ControlPoint id="117" name="Panel1RSiteReportEditStatuslinkStatus.onclick" relProperty="start">
							<Items>
								<ControlPointItem id="118" name="smartsitereport" ccpId="1" type="Page" isFeature="False"/>
								<ControlPointItem id="119" name="Panel1" ccpId="114" type="Panel" isFeature="False" PathID="Panel1"/>
								<ControlPointItem id="120" name="RSiteReport" ccpId="37" type="Record" isFeature="False" PathID="Panel1RSiteReport"/>
								<ControlPointItem id="121" name="EditStatus" ccpId="64" type="Panel" isFeature="False" PathID="Panel1RSiteReportEditStatus"/>
								<ControlPointItem id="122" name="linkStatus" ccpId="65" type="Link" isFeature="False" PathID="Panel1RSiteReportEditStatuslinkStatus"/>
							</Items>
						</ControlPoint>
					</ControlPoints>
					<Features/>
				</ClientCustomCode>
				<ClientCustomCode id="123" enabled="True" name="ClientCustomCode4" category="Ajax" featureNameChanged="No" ccsIdsOnly="False" start="Panel1RSiteReportButton_Cancel.onclick;">
<Components/>
<Events/>
<ControlPoints>
<ControlPoint id="124" name="Panel1RSiteReportButton_Cancel.onclick" relProperty="start">
<Items>
<ControlPointItem id="125" name="smartsitereport" ccpId="1" type="Page" isFeature="False"/>
<ControlPointItem id="126" name="Panel1" ccpId="114" type="Panel" isFeature="False" PathID="Panel1"/>
<ControlPointItem id="127" name="RSiteReport" ccpId="37" type="Record" isFeature="False" PathID="Panel1RSiteReport"/>
<ControlPointItem id="128" name="Button_Cancel" ccpId="40" type="Button" isFeature="False" PathID="Panel1RSiteReportButton_Cancel"/>
</Items>
</ControlPoint>
</ControlPoints>
<Features/>
</ClientCustomCode>
</Features>
		</Panel>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="smartsitereport.php" forShow="True" url="smartsitereport.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="smartsitereport_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="modal" language="PHPTemplates" name="smartsitereport_style.css" forShow="False" comment="/*" commentEnd="*/" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="61"/>
			</Actions>
		</Event>
	</Events>
</Page>
