<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\services" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="True" cachingEnabled="False" cachingDuration="1 minutes" needGeneration="0">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" name="smart_referencecode" connection="SMART" pageSizeLimit="100" wizardCaption="List of Smart Referencecode " dataSource="smart_eqtoppan" activeCollection="TableParameters">
			<Components>
				<Label id="215" fieldSourceType="DBColumn" dataType="Text" html="False" name="toppan_val" fieldSource="eqtop_toppan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="216" fieldSourceType="DBColumn" dataType="Text" html="False" name="eqtop_toppan" fieldSource="eqtop_toppan">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="218" conditionType="Parameter" useIsNull="False" field="eqtop_eqcode" dataType="Text" searchConditionType="Equal" parameterType="Expression" logicOperator="And" parameterSource="E2000"/>
				<TableParameter id="219" conditionType="Parameter" useIsNull="False" field="eqtop_branch" dataType="Text" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="keyword"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="217" tableName="smart_eqtoppan" posLeft="10" posTop="10" posWidth="130" posHeight="136"/>
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
		<CodeFile id="Code" language="PHPTemplates" name="pmactivity_RPreventive_prvt_toppanid_PTDependentListBox1.php" forShow="True" url="pmactivity_RPreventive_prvt_toppanid_PTDependentListBox1.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events/>
</Page>
