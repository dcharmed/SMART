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
		<Record id="5" sourceType="Table" urlType="Relative" secured="False" allowInsert="True" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="smart_task" dataSource="smart_task" errorSummator="Error" wizardCaption="Add/Edit Smart Task " wizardFormMethod="post" PathID="smart_task" pasteActions="pasteActions">
			<Components>
				<Button id="6" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Insert" operation="Insert" wizardCaption="Add" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonInsertOn" PathID="smart_taskButton_Insert">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Button id="7" urlType="Relative" enableValidation="False" isDefault="False" name="Button_Cancel" operation="Cancel" wizardCaption="Cancel" wizardThemeItem="FooterIMG" wizardButtonImage="ButtonCancelOn" PathID="smart_taskButton_Cancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<Hidden id="9" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="ticket_id" fieldSource="ticket_id" required="True" caption="Ticket Id" wizardCaption="Ticket Id" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_taskticket_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<ListBox id="11" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="task_newstatus" fieldSource="task_newstatus" required="True" caption="Task Newstatus" wizardCaption="Task Newstatus" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_tasktask_newstatus" sourceType="Table" connection="SMART" dataSource="smart_referencecode" activeCollection="TableParameters" orderBy="ref_rank" boundColumn="ref_value" textColumn="ref_description">
					<Components/>
					<Events>
						<Event name="OnChange" type="Client">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="30" eventType="Client"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
					<TableParameters>
						<TableParameter id="20" conditionType="Parameter" useIsNull="False" field="ref_type" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="tcktstatus"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="19" tableName="smart_referencecode" posLeft="10" posTop="10" posWidth="97" posHeight="136"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<ListBox id="12" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="task_personincharge" fieldSource="task_personincharge" required="False" caption="Task Personincharge" wizardCaption="Task Personincharge" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_tasktask_personincharge" sourceType="Table" connection="SMART" dataSource="smart_user" activeCollection="TableParameters" boundColumn="id" textColumn="usr_fullname">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters>
						<TableParameter id="22" conditionType="Parameter" useIsNull="False" field="usr_group" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="3"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="21" tableName="smart_user" posLeft="10" posTop="10" posWidth="118" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<ListBox id="14" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="task_secpersonincharge" fieldSource="task_secpersonincharge" required="False" caption="Task Secpersonincharge" wizardCaption="Task Secpersonincharge" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_tasktask_secpersonincharge" sourceType="Table" connection="SMART" dataSource="smart_user" activeCollection="TableParameters" boundColumn="id" textColumn="usr_fullname">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters>
						<TableParameter id="24" conditionType="Parameter" useIsNull="False" field="usr_group" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="3"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="23" tableName="smart_user" posLeft="10" posTop="10" posWidth="118" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<TextBox id="16" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="task_adukomid" fieldSource="task_adukomid" required="False" caption="Task Adukomid" wizardCaption="Task Adukomid" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_tasktask_adukomid">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<TextBox id="18" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="currentstatus" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_taskcurrentstatus">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="10" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="task_currentstatus" fieldSource="task_currentstatus" required="False" caption="Task Currentstatus" wizardCaption="Task Currentstatus" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_tasktask_currentstatus">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextArea id="25" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="Reason" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="smart_taskReason" fieldSource="task_secpersoninchargenote">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextArea>
				<ListBox id="26" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" name="closedby" fieldSource="task_closedby" required="False" caption="Task Personincharge" wizardCaption="Task Personincharge" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_taskclosedby" sourceType="Table" connection="SMART" dataSource="smart_user" activeCollection="TableParameters" boundColumn="id" textColumn="usr_fullname">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
					<TableParameters>
						<TableParameter id="27" conditionType="Parameter" useIsNull="False" field="usr_group" dataType="Integer" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="3"/>
					</TableParameters>
					<SPParameters/>
					<SQLParameters/>
					<JoinTables>
						<JoinTable id="28" tableName="smart_user" posLeft="10" posTop="10" posWidth="118" posHeight="180"/>
					</JoinTables>
					<JoinLinks/>
					<Fields/>
				</ListBox>
				<Hidden id="17" visible="Yes" fieldSourceType="DBColumn" dataType="Date" name="datemodified" fieldSource="datemodified" required="False" caption="Datemodified" wizardCaption="Datemodified" wizardSize="8" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="smart_taskdatemodified" defaultValue="CurrentDateTime">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="29" eventType="Server"/>
					</Actions>
				</Event>
				<Event name="AfterInsert" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="31" eventType="Server"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="8" conditionType="Parameter" useIsNull="False" field="id" parameterSource="id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="1"/>
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
		<CodeFile id="Code" language="PHPTemplates" name="popstatus.php" forShow="True" url="popstatus.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="popstatus_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
