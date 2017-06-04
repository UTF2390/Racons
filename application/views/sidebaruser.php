<div class="full-box dashboard-sideBar-UserInfo">
    <figure class="full-box">
        <i class="zmdi zmdi-account-circle zmdi-hc-5x" style="margin-left: 95px"></i>
            <!--<img src="<?php //echo base_url();  ?>/assets/img/avatar.jpg" alt="UserIcon">-->
        <figcaption class="text-center text-titles"><?php echo $this->session->userdata('nick'); ?></figcaption>
    </figure>
    <ul class="full-box list-unstyled text-center">
        <li>
            <a href="#!">
                <i class="zmdi zmdi-settings"></i>
            </a>
        </li>
        <li>
            <a href="#!" class="btn-exit-system">
                <i class="zmdi zmdi-power"></i>
            </a>
        </li>
    </ul>
</div>
