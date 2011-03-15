<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\Admin" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0" pasteActions="pasteActions" needGeneration="0">
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
		<Grid id="5" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="50" connection="SMART" dataSource="smart_logactivity" name="GLog" pageSizeLimit="100" wizardCaption="List of Smart Logactivity " wizardGridType="Tabular" wizardSortingType="Extended" wizardAllowInsert="True" wizardAltRecord="True" wizardAltRecordType="Style" wizardRecordSeparator="False" wizardNoRecords="No records" activeCollection="TableParameters">
			<Components>
				<Link id="12" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="smart_logactivity_Insert" hrefSource="AdmLogMngmt.ccp" removeParameters="id" wizardThemeItem="FooterA" wizardDefaultValue="Add New" wizardUseTemplateBlock="False" PathID="GLogsmart_logactivity_Insert">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</Link>
				<Sorter id="17" visible="True" name="Sorter_log_userid" column="log_userid" wizardCaption="Log Userid" wizardSortingType="Extended" wizardControl="log_userid" wizardAddNbsp="False" PathID="GLogSorter_log_userid">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="18" visible="True" name="Sorter_log_action" column="log_action" wizardCaption="Log Action" wizardSortingType="Extended" wizardControl="log_action" wizardAddNbsp="False" PathID="GLogSorter_log_action">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="19" visible="True" name="Sorter_log_ticket" column="log_ticket" wizardCaption="Log Ticket" wizardSortingType="Extended" wizardControl="log_ticket" wizardAddNbsp="False" PathID="GLogSorter_log_ticket">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="20" visible="True" name="Sorter_log_date" column="log_date" wizardCaption="Log Date" wizardSortingType="Extended" wizardControl="log_date" wizardAddNbsp="False" PathID="GLogSorter_log_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Hidden id="22" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="id" fieldSource="id" wizardCaption="Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAlign="right" wizardAddNbsp="True" hrefSource="AdmLogMngmt.ccp" wizardThemeItem="GridA" PathID="GLogid">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="23" sourceType="DataField" format="yyyy-mm-dd" name="id" source="id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="25" fieldSourceType="DBColumn" dataType="Text" html="False" name="log_userid" fieldSource="log_userid" wizardCaption="Log Userid" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GLoglog_userid">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="27" fieldSourceType="DBColumn" dataType="Text" html="False" name="log_action" fieldSource="log_action" wizardCaption="Log Action" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GLoglog_action">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="29" fieldSourceType="DBColumn" dataType="Text" html="False" name="log_ticket" fieldSource="log_ticket" wizardCaption="Log Ticket" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GLoglog_ticket">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="31" fieldSourceType="DBColumn" dataType="Memo" html="False" name="log_description" fieldSource="log_description" wizardCaption="Log Description" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GLoglog_description">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="33" fieldSourceType="DBColumn" dataType="Date" html="False" name="log_date" fieldSource="log_date" wizardCaption="Log Date" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardAddNbsp="True" PathID="GLoglog_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="34" size="10" type="Simple" pageSizes="1;5;10;25;50" name="Navigator" wizardPagingType="Simple" wizardFirst="True" wizardFirstText="First" wizardPrev="True" wizardPrevText="Prev" wizardNext="True" wizardNextText="Next" wizardLast="True" wizardLastText="Last" wizardImages="Images" wizardPageNumbers="Simple" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="of" wizardPageSize="False" wizardImagesScheme="{ccs_style}">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<ImageLink id="46" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ImageLink1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GLogImageLink1" hrefSource="AdmLogMngmt.ccp">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="47" sourceType="Expression" format="yyyy-mm-dd" name="type" source="det"/>
						<LinkParameter id="48" sourceType="DataField" format="yyyy-mm-dd" name="id" source="id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<ImageLink id="49" visible="Yes" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" name="ImageLink2" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GLogImageLink2" hrefSource="AdmLogMngmt.ccp">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="50" sourceType="Expression" format="yyyy-mm-dd" name="type" source="del"/>
						<LinkParameter id="51" sourceType="DataField" format="yyyy-mm-dd" name="id" source="id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<Label id="52" fieldSourceType="DBColumn" dataType="Text" html="False" name="lblNumber" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="GLoglblNumber">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events>
				<Event name="BeforeShowRow" type="Server">
					<Actions>
						<Action actionName="Set Row Style" actionCategory="General" id="21" styles="Row;AltRow" name="rowStyle"/>
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
				<TableParameter id="13" conditionType="Parameter" useIsNull="False" field="log_userid" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="1" parameterSource="s_log_userid"/>
				<TableParameter id="14" conditionType="Parameter" useIsNull="False" field="log_action" dataType="Text" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="2" parameterSource="s_log_action"/>
				<TableParameter id="15" conditionType="Parameter" useIsNull="False" field="log_ticket" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="3" parameterSource="s_log_ticket"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="55" tableName="smart_logactivity" posLeft="10" posTop="10" posWidth="120" posHeight="152"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="11" tableName="smart_logactivity" fieldName="id"/>
				<Field id="24" tableName="smart_logactivity" fieldName="log_userid"/>
				<Field id="26" tableName="smart_logactivity" fieldName="log_action"/>
				<Field id="28" tableName="smart_logactivity" fieldName="log_ticket"/>
				<Field id="30" tableName="smart_logactivity" fieldName="log_description"/>
				<Field id="32" tableName="smart_logactivity" fieldName="log_date"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Grid>
		<Record id="6" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="SLog" wizardCaption="Search Smart Logactivity " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="AdmLogMngmt.ccp" PathID="SLog" pasteActions="pasteActions">
			<Components>
				<Button id="7" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonSearchOn" PathID="SLogButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<ListBox id="8" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_log_userid" wizardCaption="Log Userid" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" PathID="SLogs_log_userid" sourceType="Table" connection="SMART" dataSource="smart_user" boundColumn="usr_username" textColumn="usr_username">
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
				</ListBox>
				<CheckBoxList id="9" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_log_action" wizardCaption="Log Action" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" PathID="SLogs_log_action" sourceType="ListOfValues" html="True" dataSource="LOGIN;LOGIN;LOG OUT;LOG OUT;ADD;ADD;UPDATE;UPDATE;DELETE;DELETE;PRINT;PRINT;VIEW;VIEW;ACCEPT;ACCEPT;REJECT;REJECT;SUSPICIOUS;SUSPICIOUS">
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
				</CheckBoxList>
				<TextBox id="10" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_log_ticket" wizardCaption="Log Ticket" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" PathID="SLogs_log_ticket">
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
		<Record id="35" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="True" allowDelete="True" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="RLog" dataSource="smart_logactivity" errorSummator="Error" wizardCaption="Add/Edit Smart Logactivity " wizardFormMethod="post" PathID="RLog" pasteActions="pasteActions">
			<Components>
				<Button id="36" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonInsertOn" PathID="RLogButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="37" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Update" operation="Update" wizardCaption="Submit" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonUpdateOn" PathID="RLogButton_Update">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="38" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="RLogButton_Cancel">
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
				<ListBox id="40" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="log_userid" fieldSource="log_userid" required="True" caption="Log Userid" wizardCaption="Log Userid" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RLoglog_userid" sourceType="Table" connection="SMART" dataSource="smart_user" boundColumn="usr_username" textColumn="usr_username">
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
				</ListBox>
				<ListBox id="41" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="log_action" fieldSource="log_action" required="True" caption="Log Action" wizardCaption="Log Action" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RLoglog_action" sourceType="ListOfValues" connection="SMART" _valueOfList="UPDATE" _nameOfList="UPDATE" dataSource="LOGIN;LOGIN;LOG OUT;LOG OUT;ADD;ADD;UPDATE;UPDATE;DELETE;DELETE;PRINT;PRINT;VIEW;VIEW;ACCEPT;ACCEPT;REJECT;REJECT;SUSPICIOUS;SUSPICIOUS">
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
				</ListBox>
				<TextBox id="42" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="log_ticket" fieldSource="log_ticket" required="False" caption="Log Ticket" wizardCaption="Log Ticket" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RLoglog_ticket">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextArea id="43" visible="Yes" fieldSourceType="DBColumn" dataType="Memo" name="log_description" fieldSource="log_description" required="True" caption="Log Description" wizardCaption="Log Description" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False" wizardRows="3" PathID="RLoglog_description">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<TextBox id="44" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="log_date" fieldSource="log_date" required="False" caption="Log Date" wizardCaption="Log Date" wizardSize="29" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="RLoglog_date" format="GeneralDate" defaultValue="CurrentDateTime">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<DatePicker id="45" name="DatePicker_log_date" control="log_date" wizardSatellite="True" wizardControl="log_date" wizardDatePickerType="Image" wizardPicture="../Styles/{CCS_Style}/Images/DatePicker.gif" style="../Styles/{CCS_Style}/Style.css" PathID="RLogDatePicker_log_date">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</DatePicker>
				<Button id="59" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Delete" operation="Delete" wizardCaption="Delete" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonDeleteOn" PathID="RLogButton_Delete">
					<Components/>
					<Events>
						<Event name="OnClick" type="Client">
							<Actions>
								<Action actionName="Confirmation Message" actionCategory="General" id="60" message="Delete record?" eventType="Client"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
</Components>
			<Events>
<Event name="AfterDelete" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="61"/>
</Actions>
</Event>
</Events>
			<TableParameters>
				<TableParameter id="39" conditionType="Parameter" useIsNull="False" field="id" parameterSource="id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="53" tableName="smart_logactivity" posLeft="10" posTop="10" posWidth="120" posHeight="152"/>
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
		<CodeFile id="Code" language="PHPTemplates" name="AdmLogMngmt.php" forShow="True" url="AdmLogMngmt.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="AdmLogMngmt_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="54"/>
			</Actions>
		</Event>
	</Events>
</Page>
