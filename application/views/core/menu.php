<nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?php echo base_url('core/home'); ?>" class="nav-link">
            <ion-icon size="medium" name="home-sharp"></ion-icon> 
              <p>
                Home
              </p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
            <ion-icon size="medium" name="construct-sharp"></ion-icon> 
              <p>
                System Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('core/location'); ?>" class="nav-link">
                <ion-icon size="medium" name="location-sharp"></ion-icon>
                  <p>Pengaturan Lokasi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('core/category'); ?>" class="nav-link">
                <ion-icon size="medium" name="copy-sharp"></ion-icon>
                  <p>Pengaturan Kategori</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('core/division'); ?>" class="nav-link">
                <ion-icon size="medium" name="briefcase-sharp"></ion-icon>
                  <p>Pengaturan Seksi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('core/department'); ?>" class="nav-link">
                <ion-icon size="medium" name="business-sharp"></ion-icon>
                  <p>Pengaturan Bidang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('core/user'); ?>" class="nav-link">
                <ion-icon size="medium" name="person-sharp"></ion-icon>
                  <p>Manajemen Pengguna</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('core/client'); ?>" class="nav-link">
                <ion-icon size="medium" name="person-sharp"></ion-icon>
                  <p>Manajemen Client</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="<?php echo base_url('core/email'); ?>" class="nav-link">
                <ion-icon size="medium" name="mail-sharp"></ion-icon>
                  <p>Pengaturan Email</p>
                </a>
              </li> -->
              <!-- <li class="nav-item menu-open">
                <a href="#" class="nav-link">
                  <ion-icon size="medium" name="chatbox-sharp"></ion-icon> 
                    <p>
                      Pengaturan Telegram
                      <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo base_url('core/bot_telegram'); ?>" class="nav-link">
                    <ion-icon size="medium" name="build-sharp"></ion-icon>
                      <p>Pengaturan Bot Telegram</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url('core/group_telegram'); ?>" class="nav-link">
                    <ion-icon size="medium" name="people-sharp"></ion-icon>
                      <p>Pengaturan Group Telegram</p>
                    </a>
                  </li>
                </ul>
              </li> -->
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('core/ticket'); ?>" class="nav-link">
            <ion-icon size="medium" name="ticket-sharp"></ion-icon>
              <p>
                Helpdesk Ticket
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('core/report'); ?>" class="nav-link">
            <ion-icon size="medium" name="file-tray-stacked-sharp"></ion-icon>
              <p>
                Laporan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('core/password'); ?>" class="nav-link">
            <ion-icon size="medium" name="create-sharp"></ion-icon>
              <p>
                Ubah Password
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('core/logout'); ?>" class="nav-link">
            <ion-icon size="medium" name="log-out-sharp"></ion-icon>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>