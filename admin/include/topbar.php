<div class="air__layout--fixedHeader">
    <div class="air__utils__header">
        <div class="air__topbar">
            <div class="air__topbar__searchDropdown dropdown mr-md-4 mr-auto">
                <div class="air__topbar__search dropdown-toggle" data-toggle="dropdown" data-offset="5,15">
                </div>
                <div class="dropdown-menu" role="menu">
                    <div class="air__customScroll">
                    </div>
                </div>
            </div>
            <div class="dropdown mr-auto d-none d-md-block">
            </div>
            <p class="mb-0 mr-4 d-xl-block d-none">
            </p>
            <div class="dropdown mr-4 d-none d-sm-block">
            </div>
            <div class="air__topbar__actionsDropdown dropdown mr-4 d-none d-sm-block">
            </div>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle text-nowrap" data-toggle="dropdown" aria-expanded="false" data-offset="5,15">
                    <img class="dropdown-toggle-avatar" src="../components/core/img/avatars/avatar.png" height="38px" alt="User avatar" />
                </a>
                <div class="dropdown-menu dropdown-menu-right" role="menu">
                   <?php if ($username == 0) { ?>
                    <a class="dropdown-item" href="profile.php">
                        <i class="dropdown-icon fe fe-user"></i>
                        Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="setting.php">
                        <i class="dropdown-icon fa fa-gears"></i>
                        Setting
                    </a>
                    <div class="dropdown-divider"></div>
                    <?php } ?>
                    <a class="dropdown-item" href="logout.php">
                        <i class="dropdown-icon fe fe-log-out"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>