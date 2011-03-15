<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="True" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0" wizardTheme="{CCS_Style}" wizardThemeVersion="3.0">
	<Components>
		<IncludePage id="2" name="menunavbar" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="headermenunavbar" page="menunavbar.ccp">
			<Components/>
			<Events/>
			<Features/>
		</IncludePage>
		<Record id="12" sourceType="Table" urlType="Relative" secured="False" allowInsert="0" allowUpdate="0" allowDelete="0" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="smart_user" dataSource="smart_user" errorSummator="Error" wizardCaption="View Smart User " wizardFormMethod="post" PathID="headersmart_user" pasteActions="pasteActions" activeCollection="TableParameters">
			<Components>
				<Link id="3" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Logout" hrefSource="index.ccp" wizardDefaultValue="Logout" PathID="headersmart_userLogout" removeParameters="s_state;s_branch;s_ref;s_sdate;s_edate;s_svr;mode;new;view;edit;id;tcktid;rid;eqid">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="4" sourceType="Expression" format="yyyy-mm-dd" name="Logout" source="&quot;True&quot;"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="8" visible="Yes" fieldSourceType="DBColumn" dataType="Text" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="Link1" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="headersmart_userLink1" hrefSource="#" wizardUseTemplateBlock="False" removeParameters="s_state;s_branch;s_ref;s_sdate;s_edate;s_svr;mode;new;view;edit;id;tcktid;rid;eqid">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="9" sourceType="Session" format="yyyy-mm-dd" name="UserID" source="uid"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Label id="18" fieldSourceType="DBColumn" dataType="Text" html="False" name="usr_fullname" fieldSource="usr_fullname" required="True" caption="Usr Fullname" wizardCaption="Usr Fullname" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="headersmart_userusr_fullname">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="20" fieldSourceType="DBColumn" dataType="Integer" html="False" name="usr_group" fieldSource="usr_group" required="True" caption="Usr Group" wizardCaption="Usr Group" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="headersmart_userusr_group">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="22" fieldSourceType="DBColumn" dataType="Date" html="False" name="usr_lastlogged" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="headersmart_userusr_lastlogged" fieldSource="usr_lastlogged" format="GeneralDate">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="13" conditionType="Parameter" useIsNull="False" field="id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="Session" orderNumber="1" parameterSource="UserID"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="21" tableName="smart_user" posLeft="10" posTop="10" posWidth="118" posHeight="180"/>
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
		<Record id="23" sourceType="Table" urlType="Relative" secured="False" allowInsert="0" allowUpdate="0" allowDelete="0" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="SMART" name="smart_ticket" dataSource="smart_ticket" errorSummator="Error" wizardCaption="View Smart Ticket " wizardFormMethod="post" PathID="headersmart_ticket" pasteActions="pasteActions">
			<Components>
				<Link id="25" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="lblInfo" fieldSource="tcktInfo" required="True" caption="Tckt Status" wizardCaption="Tckt Status" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="headersmart_ticketlblInfo" hrefSource="mainpage.ccp" defaultValue="0" removeParameters="s_state;s_branch;s_ref;s_sdate;s_edate;s_svr;mode;new;view;edit;id;tcktid;rid;eqid">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="41" sourceType="Expression" name="s_svr" source="4"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="29" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="lblNotClose" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="headersmart_ticketlblNotClose" hrefSource="mainpage.ccp" wizardUseTemplateBlock="False" fieldSource="tcktNotClosed" defaultValue="0" removeParameters="s_state;s_branch;s_ref;s_sdate;s_edate;s_svr;mode;new;view;edit;id;tcktid;rid;eqid">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="30" sourceType="Expression" format="yyyy-mm-dd" name="mode" source="7"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="31" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="lblCritical" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="headersmart_ticketlblCritical" hrefSource="mainpage.ccp" wizardUseTemplateBlock="False" fieldSource="tcktCritical" defaultValue="0" removeParameters="s_state;s_branch;s_ref;s_sdate;s_edate;s_svr;mode;new;view;edit;id;tcktid;rid;eqid">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="32" sourceType="Expression" format="yyyy-mm-dd" name="s_svr" source="1"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="33" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="lblMajor" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="headersmart_ticketlblMajor" hrefSource="mainpage.ccp" wizardUseTemplateBlock="False" fieldSource="tcktMajor" defaultValue="0" removeParameters="s_state;s_branch;s_ref;s_sdate;s_edate;s_svr;mode;new;view;edit;id;tcktid;rid;eqid">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="34" sourceType="Expression" format="yyyy-mm-dd" name="s_svr" source="2"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
				<Link id="35" visible="Yes" fieldSourceType="DBColumn" dataType="Integer" html="False" hrefType="Page" urlType="Relative" preserveParameters="GET" name="lblMinor" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="headersmart_ticketlblMinor" hrefSource="mainpage.ccp" wizardUseTemplateBlock="False" fieldSource="tcktMinor" defaultValue="0" removeParameters="s_state;s_branch;s_ref;s_sdate;s_edate;s_svr;mode;new;view;edit;id;tcktid;rid;eqid">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="36" sourceType="Expression" format="yyyy-mm-dd" name="s_svr" source="3"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</Link>
			</Components>
			<Events/>
			<TableParameters/>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="27" tableName="smart_ticket" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields>
				<Field id="28" fieldName="SUM(IF(tckt_status&lt;7,1,0))" isExpression="True" alias="tcktNotClosed"/>
				<Field id="37" fieldName="SUM(IF(tckt_severity=1,1,0))" isExpression="True" alias="tcktCritical"/>
				<Field id="38" fieldName="SUM(IF(tckt_severity=2,1,0))" isExpression="True" alias="tcktMajor"/>
				<Field id="39" fieldName="SUM(IF(tckt_severity=3,1,0))" isExpression="True" alias="tcktMinor"/>
				<Field id="40" fieldName="SUM(IF(tckt_severity=4,1,0))" isExpression="True" alias="tcktInfo"/>
			</Fields>
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
		<CodeFile id="Code" language="PHPTemplates" name="header.php" forShow="True" url="header.php" comment="//" codePage="windows-1252"/>
		<CodeFile id="Events" language="PHPTemplates" name="header_events.php" forShow="False" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="AfterInitialize" type="Server">
			<Actions>
				<Action actionName="Logout" actionCategory="Security" id="5" pageRedirects="True" parameterName="Logout" returnPage="header.ccp"/>
			</Actions>
		</Event>
	</Events>
</Page>
