<div class="topbar">
                    <nav class="navbar navbar-expand-lg navbar-light msa_blue">
                        <div class="full">
                            <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i
                                    class="fa fa-bars"></i></button>
                            <div class="logo_section">
                                <h2 style="color: #fff; padding:20px; font-size:18px; font-weight: normal;">Southern Electronics Pvt Ltd.</h2>
                                <!-- <a href="index.php"><img class="img-responsive" src="images/logo/logo.png"
                                        alt="#" /></a> -->
                            </div>
                            <div class="right_topbar">
                                <div class="icon_info">                                    
                                    <ul class="user_profile_dd">
                                        <li>
                                            <a href="administrator"><img
                                                    class="img-responsive rounded-circle"
                                                    src="images/layout_img/user_img.jpg" alt="#" /><span
                                                    class="name_user">Admin</span></a>
                                                    <div class="dropdown-menu">
                                                <!-- <a class="dropdown-item" href="profile.html">My Profile</a>
                                                <a class="dropdown-item" href="settings.html">Settings</a>
                                                <a class="dropdown-item" href="help.html">Help</a> -->
                                                <?php if(!isset($_SESSION["user"])){ ?>
                                                    <a class="dropdown-item" href="logout.php"><span>Log Out</span> <i
                                                        class="fa fa-sign-out"></i></a>
                                                        <?php } ?>
                                            </div>
                                            
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>