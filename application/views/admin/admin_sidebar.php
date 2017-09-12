<!-- Left side column. contains the logo and sidebar -->
<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url();?>webroot/admin/img/avatar3.png" class="img-circle" alt="User Image" />
            </div>
			<div class="pull-left info">
				<p>Hello, 
					<?php echo $this->user;?>
				</p>
			</div>
            </div>
          
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <!--********************	Show Dashboard Tab First ********************-->
                <?php if($session[0]->user_role_id == 1){ ?>
                <li class="treeview <?php echo ($this->uri->segment(2)== 'homeSetting')?'active':''?>">
                   <a href="#"><i class="fa fa-th"></i><span>Home Setting</span>
                   <i class="fa pull-right fa-angle-left"></i>
                   </a>
                   <ul class="treeview-menu">
                      <li class="<?php echo ($this->uri->segment(3)== 'homeBanner')?'active':''?>">
                         <a href="<?php echo base_url();?>admin/homeSetting/homeBanner" style="margin-left: 10px;">
                         <i class="fa fa-tag"></i>
                         <span>Banner Slider</span>
                         </a>
                      </li>
                     <li class="<?php echo ($this->uri->segment(3)== 'discountBanner')?'active':''?>">
                         <a href="<?php echo base_url();?>admin/homeSetting/discountBanner" style="margin-left: 10px;">
                         <i class="fa fa-tag"></i>
                         <span>Discount Image</span>
                         </a>
                      </li>
                     <li class="<?php echo ($this->uri->segment(3)== '')?'active':''?>">
                         <a href="<?php echo base_url();?>admin/homeSetting/dealsBanner" style="margin-left: 10px;">
                         <i class="fa fa-tag"></i>
                         <span>Deals Image</span>
                         </a>
                      </li>
                     <li class="<?php echo ($this->uri->segment(3)== '')?'active':''?>">
                         <a href="<?php echo base_url();?>admin/homeSetting/specialDealsBanner" style="margin-left: 10px;">
                         <i class="fa fa-tag"></i>
                         <span>Spaicial Deals</span>
                         </a>
                      </li>
                     <li class="<?php echo ($this->uri->segment(3)== '')?'active':''?>">
                         <a href="<?php echo base_url();?>admin/homeSetting/homeBanner" style="margin-left: 10px;">
                         <i class="fa fa-tag"></i>
                         <span>Testimonials</span>
                         </a>
                      </li>
                   </ul>
                </li>

                <?php
                } 
                    foreach ($getAllTabAsPerRole as $value) {
                        if($value->userView == '1')
                        {
                         ?>
                           <li class="<?php echo ($this->uri->segment(2)== $value->controller_name)?'active':''?>">
                               <a href="<?php echo base_url(); ?>admin/<?php echo $value->controller_name; ?>">
                                   <i class="fa fa-dashboard"></i>
                                   <span><?php echo $value->tabname; ?></span>
                               </a>
                           </li>
                           <?php
                       }
                    }
                ?> 
          
            <br/><br/><br/><br/>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>