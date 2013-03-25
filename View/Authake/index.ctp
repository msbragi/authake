<div class="row-fluid">
	<div class="span6">
		<div class="row-fluid">
			<div class="span6">
				<div class="section section-small">
					<div class="section-header">
						<h5>Users</h5>
					</div>
					<div class="section-body">
						<div class="row-fluid">
							<div class="span6 ac">
								<div class="stat-block">
									<h1 class="success"><?php echo $adminCount;?></h1>
									<h6 class="stat-heading">Admins</h6>
								</div>
							</div>
							<div class="span6 ac">
								<div class="stat-block">
									<h1 class="success"><?php echo $userCount;?></h1>
									<h6 class="stat-heading">Total Users</h6>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="span6">
				<div class="section section-small">
					<div class="section-header">
						<h5>Groups & Rules</h5>
					</div>
					<div class="section-body">
						<div class="row-fluid">
							<div class="span6 ac">
								<div class="stat-block">
									<h1 class="success"><?php echo $groupCount;?></h1>
									<h6 class="stat-heading">Groups</h6>
								</div>
							</div>
							<div class="span6 ac">
								<div class="stat-block">
									<h1 class="success"><?php echo $ruleCount;?></h1>
									<h6 class="stat-heading">Rules</h6>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="span6">
		<div class="section section-small">
			<div class="section-header">
				<h5>News from the Author</h5>
			</div>
			<div class="section-body">
				<div class="row-fluid">
					<?php var_dump(Configure::read('Authake')); ?>
				</div>
			</div>
		</div>
	</div>
</div>