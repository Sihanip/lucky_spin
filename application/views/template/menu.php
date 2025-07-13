			<!-- Heading -->
		

			<!-- Nav Item - Pages Collapse Menu -->
			<li class="nav-item active">
				
				<!--<a class="nav-link" href="<?= base_url("/add_customer"); ?>">-->
				<!--<i class="fas fa-fw fa-users"></i>-->
				<!--	<span>Tambah Customer</span> </a>-->
				<a class="nav-link" href="<?= base_url("/customer_grand"); ?>">
				<i class="fas fa-fw fa-user"></i>
					<span>Customer Grand</span> </a>
				<a class="nav-link" href="<?= base_url("/list_voucher"); ?>">
				<i class="fas fa-fw fa-qrcode"></i>
					<span>List Voucher</span> </a>
				<!-- <a class="nav-link" href="<?= base_url("/list_penerima"); ?>">
				<i class="fas fa-fw fa-gift"></i>
					<span>List Penerima Hadiah</span> </a> -->
				<!-- <a class="nav-link" href="<?= base_url("/setting_spinner"); ?>">
				<i class="fas fa-fw fa-spinner"></i>
					<span>Setting Spinner</span> </a> -->
				<?php if($this->session->userdata('role_id') == 2){ ?>
					
				<a class="nav-link" href="<?= base_url("/detail_toko"); ?>">
				<i class="fas fa-fw fa-shopping-basket"></i>
					<span>Detail Toko</span> </a>
				<a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
					<i class="fas fa-fw fa-folder"></i>
					<span>Master</span>
				</a>
				<div id="collapsePages" class="collapse show" aria-labelledby="headingPages" data-parent="#accordionSidebar">
					<div class="bg-white py-2 collapse-inner rounded">
						<a class="collapse-item" href="<?= base_url("/mst_toko"); ?>">Master Toko </a>
						<a class="collapse-item" href="<?= base_url("/mst_hadiah"); ?>">Master Hadiah </a>
					</div>
				</div>
				<?php } ?>
			</li>

