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
		<Grid id="5" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="50" connection="SMART" dataSource="smart_site" name="GSite" pageSizeLimit="100" wizardCaption="List of Smart Site " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records" activeCollection="TableParameters" pasteActions="pasteActions">
			<Components>
				<Link id="12" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="smart_site_Insert" hrefSource="smartsite.ccp" removeParameters="id" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="GSitesmart_site_Insert">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="18" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="site_name" fieldSource="site_name" wizardCaption="Site Name" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" hrefSource="smartsite.ccp" wizardThemeItem="GridA" PathID="GSitesite_name" removeParameters="s_state;s_name;s_code">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="19" sourceType="DataField" format="yyyy-mm-dd" name="sid" source="id"/>
						<LinkParameter id="63" sourceType="Expression" name="view" source="1"/>
						<LinkParameter id="112" sourceType="DataField" name="scode" source="site_code"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="20" fieldSourceType="DBColumn" dataType="Integer" html="False" name="lblNumber" fieldSource="id" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="GSitelblNumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="22" fieldSourceType="DBColumn" dataType="Text" html="False" name="site_code" fieldSource="site_code" wizardCaption="Site Code" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GSitesite_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="24" fieldSourceType="DBColumn" dataType="Text" html="False" name="site_state" fieldSource="site_state" wizardCaption="Site State" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GSitesite_state">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="26" fieldSourceType="DBColumn" dataType="Text" html="False" name="site_region" fieldSource="site_region" wizardCaption="Site Region" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GSitesite_region">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="28" fieldSourceType="DBColumn" dataType="Text" html="False" name="site_offnumber" fieldSource="site_offnumber" wizardCaption="Site Offnumber" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GSitesite_offnumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="30" fieldSourceType="DBColumn" dataType="Text" html="False" name="site_faxnumber" fieldSource="site_faxnumber" wizardCaption="Site Faxnumber" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GSitesite_faxnumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="32" fieldSourceType="DBColumn" dataType="Text" html="False" name="site_offhours" fieldSource="site_offhours" wizardCaption="Site Offhours" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GSitesite_offhours">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="33" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Simple" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardImagesScheme="{ccs_style}">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="16" styles="Row;AltRow" name="rowStyle"/>
						<Action actionName="Custom Code" actionCategory="General" id="52"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="51"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="13" conditionType="Parameter" useIsNull="False" field="site_state" dataType="Text" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1" parameterSource="s_state"/>
				<TableParameter id="14" conditionType="Parameter" useIsNull="False" field="site_name" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="2" parameterSource="s_name"/>
				<TableParameter id="15" conditionType="Parameter" useIsNull="False" field="site_code" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="3" parameterSource="s_code"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="55" tableName="smart_site" posLeft="10" posTop="10" posWidth="121" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="11" tableName="smart_site" fieldName="id"/>
				<Field id="17" tableName="smart_site" fieldName="site_name"/>
				<Field id="21" tableName="smart_site" fieldName="site_code"/>
				<Field id="23" tableName="smart_site" fieldName="site_state"/>
				<Field id="25" tableName="smart_site" fieldName="site_region"/>
				<Field id="27" tableName="smart_site" fieldName="site_offnumber"/>
				<Field id="29" tableName="smart_site" fieldName="site_faxnumber"/>
				<Field id="31" tableName="smart_site" fieldName="site_offhours"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="6" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="SSite" wizardCaption="Search Smart Site " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="smartsite.ccp" PathID="SSite">
			<Components>
				<Button id="7" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonSearchOn" PathID="SSiteButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<ListBox id="8" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="s_state" wizardCaption="Site State" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardEmptyCaption="Select Value" PathID="SSites_state" connection="SMART" dataSource="smart_site" activeCollection="TableParameters" boundColumn="site_state" textColumn="site_state" groupBy="site_state">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="56" tableName="smart_site" posLeft="10" posTop="10" posWidth="121" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<TextBox id="9" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_name" wizardCaption="Site Name" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" PathID="SSites_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="10" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_code" wizardCaption="Site Code" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" PathID="SSites_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ImageLink id="67" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ImageLink1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="SSiteImageLink1" hrefSource="smartsite.ccp">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="68" sourceType="Expression" format="yyyy-mm-dd" name="new" source="1"/>
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
		<Record id="34" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="RSite" dataSource="smart_site" errorSummator="Error" wizardCaption="Add/Edit Smart Site " wizardFormMethod="post" PathID="RSite" activeCollection="TableParameters" pasteActions="pasteActions">
			<Components>
				<Button id="35" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonInsertOn" PathID="RSiteButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="36" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="RSiteButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="37" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="RSiteButton_Cancel">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="64" eventType="Server"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="39" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="site_code" fieldSource="site_code" required="True" caption="Site Code" wizardCaption="Site Code" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RSitesite_code">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="40" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="site_name" fieldSource="site_name" required="True" caption="Site Name" wizardCaption="Site Name" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RSitesite_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="43" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="site_lat" fieldSource="site_lat" required="False" caption="Site Lat" wizardCaption="Site Lat" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RSitesite_lat">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="47" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="site_offnumber" fieldSource="site_offnumber" required="False" caption="Site Offnumber" wizardCaption="Site Offnumber" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RSitesite_offnumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="44" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="site_long" fieldSource="site_long" required="False" caption="Site Long" wizardCaption="Site Long" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RSitesite_long">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="41" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="site_state" fieldSource="site_state" required="True" caption="Site State" wizardCaption="Site State" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="RSitesite_state" connection="SMART" dataSource="smart_site" activeCollection="TableParameters" boundColumn="site_state" textColumn="site_state" groupBy="site_state">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="69" tableName="smart_site" posLeft="10" posTop="10" posWidth="121" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<ListBox id="42" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="site_region" fieldSource="site_region" required="True" caption="Site Region" wizardCaption="Site Region" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="RSitesite_region" connection="SMART" dataSource="smart_site" activeCollection="TableParameters" boundColumn="site_region" textColumn="site_region" groupBy="site_region">
					<Components/>
					<Events/>
					<TableParameters/>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="70" tableName="smart_site" posLeft="148" posTop="10" posWidth="121" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<TextBox id="48" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="site_faxnumber" fieldSource="site_faxnumber" required="False" caption="Site Faxnumber" wizardCaption="Site Faxnumber" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RSitesite_faxnumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextArea id="46" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="site_address" fieldSource="site_address" required="True" caption="Site Address" wizardCaption="Site Address" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="RSitesite_address">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<TextBox id="45" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="site_sla" fieldSource="site_sla" required="False" caption="Site Sla" wizardCaption="Site Sla" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RSitesite_sla">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="49" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="site_offhours" fieldSource="site_offhours" required="False" caption="Site Offhours" wizardCaption="Site Offhours" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RSitesite_offhours">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Label id="108" fieldSourceType="DBColumn" dataType="Text" html="True" name="lblNotes" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="RSitelblNotes">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="AfterInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="65"/>
					</Actions>
				</Event>
				<Event name="AfterUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="66"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="109"/>
					</Actions>
				</Event>
				<Event name="BeforeBuildUpdate" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="116"/>
</Actions>
</Event>
</Events>
			<TableParameters>
				<TableParameter id="38" conditionType="Parameter" useIsNull="False" field="id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1" parameterSource="sid"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="57" tableName="smart_site" posLeft="10" posTop="10" posWidth="121" posHeight="180"/>
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
		<EditableGrid id="73" urlType="Relative" secured="False" emptyRows="1" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" sourceType="Table" defaultPageSize="20" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" dataSource="smart_sitecontact" name="GSiteContact" pageSizeLimit="100" wizardCaption="List of Smart Sitecontact " wizardGridType="Tabular" wizardAltRecord="False" wizardRecordSeparator="False" wizardNoRecords="No records" PathID="GSiteContact" deleteControl="CheckBox_Delete" activeCollection="TableParameters" customInsertType="Table" customInsert="smart_sitecontact" customUpdateType="Table" customUpdate="smart_sitecontact" activeTableType="customDelete" customDeleteType="Table" customDelete="smart_sitecontact" pasteActions="pasteActions">
			<Components>
				<Label id="75" fieldSourceType="DBColumn" dataType="Integer" html="False" name="lblNumber" fieldSource="id" required="False" caption="Id" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GSiteContactlblNumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<TextBox id="77" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="sc_name" fieldSource="sc_name" required="True" caption="Name" wizardCaption="Sc Name" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="GSiteContactsc_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="78" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="sc_position" fieldSource="sc_position" required="False" caption="Position" wizardCaption="Sc Position" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="GSiteContactsc_position">
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
				<ListBox id="79" visible="Yes" fieldSourceType="DBColumn" sourceType="Table" dataType="Text" returnValueType="Number" name="sc_department" fieldSource="sc_department" required="True" caption="Department" wizardCaption="Sc Department" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardEmptyCaption="Select Value" PathID="GSiteContactsc_department" connection="SMART" dataSource="smart_referencecode" activeCollection="TableParameters" boundColumn="ref_value" textColumn="ref_description">
					<Components/>
					<Events/>
					<TableParameters>
						<TableParameter id="111" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="sitedept"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="110" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="117" posHeight="152"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
					<Attributes/>
					<Features/>
				</ListBox>
				<TextBox id="80" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="sc_mobile" fieldSource="sc_mobile" required="False" caption="Mobile" wizardCaption="Sc Mobile" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="GSiteContactsc_mobile">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="81" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="sc_email" fieldSource="sc_email" required="True" caption="Email" wizardCaption="Sc Email" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="GSiteContactsc_email" inputMask="^[\w\.-]{1,}\@([\da-zA-Z-]{1,}\.){1,}[\da-zA-Z-]+$" unique="True">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="82" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="sc_facebook" fieldSource="sc_facebook" required="False" caption="Sc Facebook" wizardCaption="Sc Facebook" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="GSiteContactsc_facebook">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Panel id="83" visible="True" name="CheckBox_Delete_Panel">
					<Components>
						<CheckBox id="84" visible="Dynamic" fieldSourceType="CodeExpression" dataType="Boolean" name="CheckBox_Delete" checkedValue="true" uncheckedValue="false" wizardCaption="Delete" wizardAddNbsp="True" PathID="GSiteContactCheckBox_Delete_PanelCheckBox_Delete">
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
				<Navigator id="85" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Simple" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardPageSize="False" wizardImagesScheme="{ccs_style}">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Button id="86" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Submit" operation="Submit" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="GSiteContactButton_Submit">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="76" fieldSourceType="DBColumn" dataType="Text" name="sc_sitecode" fieldSource="sc_sitecode" required="False" caption="Sitecode" wizardCaption="Sc Sitecode" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="GSiteContactsc_sitecode">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeBuildInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="107"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="113"/>
					</Actions>
				</Event>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="114"/>
					</Actions>
				</Event>
				<Event name="AfterExecuteInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="115"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="88" conditionType="Parameter" useIsNull="False" field="sc_sitecode" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="scode"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="87" tableName="smart_sitecontact" posLeft="10" posTop="10" posWidth="116" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<PKFields>
				<PKField id="74" tableName="smart_sitecontact" fieldName="id" dataType="Integer"/>
			</PKFields>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements>
				<CustomParameter id="89" field="sc_sitecode" dataType="Text" parameterType="Control" parameterSource="sc_sitecode"/>
				<CustomParameter id="90" field="sc_name" dataType="Text" parameterType="Control" parameterSource="sc_name"/>
				<CustomParameter id="91" field="sc_position" dataType="Text" parameterType="Control" parameterSource="sc_position"/>
				<CustomParameter id="92" field="sc_department" dataType="Text" parameterType="Control" parameterSource="sc_department"/>
				<CustomParameter id="93" field="sc_mobile" dataType="Text" parameterType="Control" parameterSource="sc_mobile"/>
				<CustomParameter id="94" field="sc_email" dataType="Text" parameterType="Control" parameterSource="sc_email"/>
				<CustomParameter id="95" field="sc_facebook" dataType="Text" parameterType="Control" parameterSource="sc_facebook"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters/>
			<UConditions>
				<TableParameter id="96" conditionType="Parameter" useIsNull="False" field="id" dataType="Integer" parameterType="DataSourceColumn" searchConditionType="Equal" logicOperator="And" parameterSource="id"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="98" field="sc_sitecode" dataType="Text" parameterType="Control" parameterSource="sc_sitecode"/>
				<CustomParameter id="99" field="sc_name" dataType="Text" parameterType="Control" parameterSource="sc_name"/>
				<CustomParameter id="100" field="sc_position" dataType="Text" parameterType="Control" parameterSource="sc_position"/>
				<CustomParameter id="101" field="sc_department" dataType="Text" parameterType="Control" parameterSource="sc_department"/>
				<CustomParameter id="102" field="sc_mobile" dataType="Text" parameterType="Control" parameterSource="sc_mobile"/>
				<CustomParameter id="103" field="sc_email" dataType="Text" parameterType="Control" parameterSource="sc_email"/>
				<CustomParameter id="104" field="sc_facebook" dataType="Text" parameterType="Control" parameterSource="sc_facebook"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions>
				<TableParameter id="105" conditionType="Parameter" useIsNull="False" field="id" dataType="Integer" parameterType="DataSourceColumn" searchConditionType="Equal" logicOperator="And" parameterSource="id"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</EditableGrid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="smartsite.php" forShow="True" url="smartsite.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="smartsite_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="58"/>
			</Actions>
		</Event>
	</Events>
</Page>
