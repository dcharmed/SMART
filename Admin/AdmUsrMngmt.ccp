<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\Admin" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<IncludePage id="2" name="header" PathID="header" page="adminheader.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<IncludePage id="4" name="footer" PathID="footer" page="../footer.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Grid id="5" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="20" connection="SMART" dataSource="smart_user" name="GUser" pageSizeLimit="100" wizardCaption="List of Smart User " wizardGridType="Tabular" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="True" wizardNoRecords="No records" activeCollection="TableParameters">
			<Components>
				<ImageLink id="11" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="smart_user_Insert" hrefSource="AdmUsrMngmt.ccp" removeParameters="id" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="GUsersmart_user_Insert">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="59" sourceType="Expression" name="new" source="1"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<Link id="16" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="usr_username" fieldSource="usr_username" wizardCaption="Usr Username" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" hrefSource="AdmUsrMngmt.ccp" wizardThemeItem="GridA" PathID="GUserusr_username">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="17" sourceType="DataField" format="yyyy-mm-dd" name="id" source="id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="19" fieldSourceType="DBColumn" dataType="Integer" html="False" name="usr_status" fieldSource="usr_status" wizardCaption="Usr Status" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="GUserusr_status">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="20" fieldSourceType="DBColumn" dataType="Integer" html="False" name="id" fieldSource="id" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="GUserid">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="22" fieldSourceType="DBColumn" dataType="Integer" html="False" name="usr_group" fieldSource="usr_group" wizardCaption="Usr Group" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" PathID="GUserusr_group">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="24" fieldSourceType="DBColumn" dataType="Text" html="False" name="usr_email" fieldSource="usr_email" wizardCaption="Usr Email" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GUserusr_email">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="26" fieldSourceType="DBColumn" dataType="Text" html="False" name="usr_fullname" fieldSource="usr_fullname" wizardCaption="Usr Fullname" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GUserusr_fullname">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="27" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Simple" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardImagesScheme="{ccs_style}">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<Label id="58" fieldSourceType="DBColumn" dataType="Integer" html="False" name="lblNumber" PathID="GUserlblNumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="14" styles="Row;AltRow" name="rowStyle"/>
						<Action actionName="Custom Code" actionCategory="General" id="49"/>
					</Actions>
				</Event>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="48"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="12" conditionType="Parameter" useIsNull="False" field="usr_username" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="1" parameterSource="s_username"/>
				<TableParameter id="13" conditionType="Parameter" useIsNull="False" field="usr_group" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="2" parameterSource="s_usergroup"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="64" tableName="smart_user" posLeft="10" posTop="10" posWidth="118" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="10" tableName="smart_user" fieldName="id"/>
				<Field id="15" tableName="smart_user" fieldName="usr_username"/>
				<Field id="18" tableName="smart_user" fieldName="usr_status"/>
				<Field id="21" tableName="smart_user" fieldName="usr_group"/>
				<Field id="23" tableName="smart_user" fieldName="usr_email"/>
				<Field id="25" tableName="smart_user" fieldName="usr_fullname"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="6" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="SFUser" wizardCaption="Search Smart User " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="AdmUsrMngmt.ccp" PathID="SFUser" pasteActions="pasteActions">
			<Components>
				<Button id="7" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonSearchOn" PathID="SFUserButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="8" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_username" wizardCaption="Usr Username" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" PathID="SFUsers_username">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="9" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="s_usergroup" wizardCaption="Usr Group" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" PathID="SFUsers_usergroup" sourceType="Table" connection="SMART" dataSource="smart_referencecode" activeCollection="TableParameters" boundColumn="ref_value" textColumn="ref_description">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters>
						<TableParameter id="52" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="usrgroup"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="51" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="97" posHeight="136"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
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
		<Record id="28" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="RUser" dataSource="smart_user" errorSummator="Error" wizardCaption="Add/Edit Smart User " wizardFormMethod="post" PathID="RUser" pasteActions="pasteActions">
			<Components>
				<Button id="29" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonInsertOn" PathID="RUserButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="30" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="RUserButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="31" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonDeleteOn" PathID="RUserButton_Delete">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="32" message="Delete record?"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="33" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="RUserButton_Cancel" removeParameters="s_username;s_usergroup;">
					<Components/>
					<Events>
<Event name="OnClick" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="66"/>
</Actions>
</Event>
</Events>
					<Attributes/>
					<Features/>
				</Button>
				<RadioButton id="35" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="usr_status" fieldSource="usr_status" required="True" caption="Account Status" wizardCaption="Usr Status" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RUserusr_status" sourceType="ListOfValues" html="True" connection="SMART" _valueOfList="2" _nameOfList="Blocked" dataSource="0;Not Active;1;Active;2;Blocked" defaultValue="1">
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
				</RadioButton>
				<TextBox id="36" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="usr_username" fieldSource="usr_username" required="True" caption="Username" wizardCaption="Usr Username" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RUserusr_username">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="37" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="usr_password" fieldSource="usr_password" required="False" caption="Password" wizardCaption="Usr Password" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RUserusr_password">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="38" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="usr_group" fieldSource="usr_group" required="True" caption="Group" wizardCaption="Usr Group" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RUserusr_group" sourceType="Table" connection="SMART" dataSource="smart_referencecode" activeCollection="TableParameters" boundColumn="ref_value" textColumn="ref_description">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters>
						<TableParameter id="54" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="usrgroup"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="53" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="97" posHeight="136"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<TextBox id="39" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="usr_email" fieldSource="usr_email" required="True" caption="Email" wizardCaption="Usr Email" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RUserusr_email" inputMask="^[\w\.-]{1,}\@([\da-zA-Z-]{1,}\.){1,}[\da-zA-Z-]+$">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="40" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="usr_fullname" fieldSource="usr_fullname" required="True" caption="Fullname" wizardCaption="Usr Fullname" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RUserusr_fullname">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="41" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="usr_staffid" fieldSource="usr_staffid" required="False" caption="Staff ID" wizardCaption="Usr Staffid" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RUserusr_staffid">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<ListBox id="42" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="usr_post" fieldSource="usr_post" required="False" caption="Post" wizardCaption="Usr Post" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RUserusr_post" sourceType="Table" connection="SMART" dataSource="smart_referencecode" activeCollection="TableParameters" boundColumn="ref_value" textColumn="ref_description">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters>
						<TableParameter id="57" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="usrpost"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="56" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="97" posHeight="136"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<TextArea id="43" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="usr_address" fieldSource="usr_address" required="False" caption="Address" wizardCaption="Usr Address" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="RUserusr_address">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<RadioButton id="44" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="usr_gender" fieldSource="usr_gender" required="False" caption="Gender" wizardCaption="Usr Gender" wizardSize="2" wizardMaxLength="2" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RUserusr_gender" sourceType="ListOfValues" html="True" connection="SMART" _valueOfList="F" _nameOfList="Female" dataSource="M;Male;F;Female">
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
				</RadioButton>
				<TextBox id="45" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="usr_dateofbirth" fieldSource="usr_dateofbirth" required="False" caption="Date Of Birth" wizardCaption="Usr Dateofbirth" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RUserusr_dateofbirth">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="46" name="DatePicker_usr_dateofbirth" control="usr_dateofbirth" wizardSatellite="True" wizardControl="usr_dateofbirth" wizardDatePickerType="Image" wizardPicture="../Styles/{CCS_Style}/Images/DatePicker.gif" style="../Styles/{CCS_Style}/Style.css" PathID="RUserDatePicker_usr_dateofbirth">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<TextBox id="55" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="usr_vpassword" required="False" caption="Password Verification" wizardCaption="Usr Password" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RUserusr_vpassword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="47" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="datemodified" fieldSource="datemodified" required="False" caption="Datemodified" wizardCaption="Datemodified" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RUserdatemodified">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Hidden id="61" fieldSourceType="DBColumn" dataType="Text" name="usr_oripassword" PathID="RUserusr_oripassword" fieldSource="usr_password">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="OnValidate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="60"/>
					</Actions>
				</Event>
				<Event name="BeforeBuildUpdate" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="62"/>
					</Actions>
				</Event>
				<Event name="BeforeBuildInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="63"/>
					</Actions>
				</Event>
				<Event name="AfterInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="65"/>
					</Actions>
				</Event>
				<Event name="AfterUpdate" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="67"/>
</Actions>
</Event>
</Events>
			<TableParameters>
				<TableParameter id="34" conditionType="Parameter" useIsNull="False" field="id" parameterSource="id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
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
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="AdmUsrMngmt.php" forShow="True" url="AdmUsrMngmt.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="AdmUsrMngmt_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="50"/>
			</Actions>
		</Event>
	</Events>
</Page>
