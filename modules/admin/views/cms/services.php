<!-- 
getting the 3 services from the db 
-->
<?php 

	// print_r($service_1);
	// print_r($service_2);
	// print_r($service_3);
	// print_r($service_4);
?>

<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-title">
        <h3><i class="fa fa-bars"></i> <?php echo $title;?> services</h3>
        <div class="box-tool">
          <a href="#" data-action="collapse"><i class="fa fa-chevron-up"></i></a>
        </div>
      </div>
      <div class="box-content">
	  
<!-- the first 4 sections -->
<?php header('Content-Type: text/html; charset=utf-8'); ?>

<form action="<?php echo site_url('admin/cms/service'); ?>" method="post">



		<!--<input type="hidden" id="action" name="action" value="1">-->
 <div class="row" style="overflow:hidden">
 
 <!-- $service_1  -->

 <div class="col-md-3">
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label">&nbsp;</label>
                        <div class="col-sm-9 col-lg-10 controls">
                            
							<img class="thumbnail" id="service_path" 
							src="<?php echo base_url('uploads/cmsuploads/thumb')."/".$service_1->img; //echo get_profile_photo_by_id($profile->id,'thumb'); ?>"  style="width:100px;" />
                            <span id="profile_photo_error"><?php echo form_error('service_path'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <!--<label class="col-sm-3 col-lg-2 control-label"><?php // echo lang_key('profile_picture'); ?></label> -->
                        <div class="col-sm-9 col-lg-10 controls">
                            <input type="hidden" name="service_photo" id="service_photo" 
							value="<?php echo $service_1->img;//echo get_profile_photo_name_by_username($profile->user_name);?>">
                            <iframe src="<?php echo site_url('admin/cms/service_1_img');?>" style="border:0;margin:0;padding:0;height:130px;"></iframe>
                            <span class="help-inline">&nbsp;</span>                            
                        </div>
                    </div>
   <div class="form-group">
     <label class="col-sm-3 col-lg-2 control-label"><?php //echo lang_key('Service1'); ?></label>
                        <div class="col-sm-9 col-lg-10 controls">
                            <input type="text" name="title_1" id="service1" 
							value="<?php echo $service_1->title; //echo get_profile_photo_name_by_username($profile->user_name);?>"
							placeholder="service_name">
							</div>
   </div>
   <!-- desc -->
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label"><?php //echo lang_key('service_desc');//echo lang_key('service_desc'); ?></label>
                        <div class="col-sm-9 col-lg-10 controls">
                            <input type="text" name="subtitle1" value="<?php  echo $service_1->subtitle; //echo $profile->user_name; ?>"
                                   placeholder="desc " class="form-control">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('desc1'); ?>
                        </div>
                    </div>
					 <div class="form-group">
     <label class="col-sm-3 col-lg-2 control-label"><?php //echo lang_key('Service1'); ?></label>
                        <div class="col-sm-9 col-lg-10 controls">
                            <input type="text" name="title_ar1" id="service_ar1" 
							value="<?php  echo $service_1->title_ar; //echo get_profile_photo_name_by_username($profile->user_name);?>"
							placeholder="إسم الخدمة">
							</div>
   </div>
   <!-- desc -->
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label"><?php //echo lang_key('service_desc'); ?></label>
                        <div class="col-sm-9 col-lg-10 controls">
                            <input type="text" name="subtitle_ar1" value="<?php echo $service_1->subtitle_ar; //echo $profile->user_name; ?>"
                                   placeholder="الوصف  " class="form-control">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('desc1'); ?>
                        </div>
                    </div>
					<!-- URL -->
					   <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label"><?php //echo lang_key('service_url'); ?></label>
                        <div class="col-sm-9 col-lg-10 controls">
                            <input type="text" name="url1" value="<?php  echo $service_1->url;//echo $profile->user_name; ?>"
                                   placeholder="desc url" class="form-control">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('desc1'); ?>
                        </div>
                    </div>
 </div>
 
 
 
 <!-- service edit  -->

 <div class="col-md-3">
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label">&nbsp;</label>
                        <div class="col-sm-9 col-lg-10 controls">
                            
							<img class="thumbnail" id="service_path_2" 
							src="<?php echo base_url('uploads/cmsuploads/thumb')."/".$service_2->img;//get_profile_photo_by_id($profile->id,'thumb');?>"  style="width:100px;" />
                            <span id="profile_photo_error"><?php echo form_error('service_path'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <!--<label class="col-sm-3 col-lg-2 control-label"><?php // echo lang_key('profile_picture'); ?></label> -->
                        <div class="col-sm-9 col-lg-10 controls">
                            <input type="hidden" name="service_photo_2" id="service_photo_2" 
							value="<?php echo $service_2->img; //echo get_profile_photo_name_by_username($profile->user_name);?>">
                            <iframe src="<?php echo site_url('admin/cms/service_2_img');?>" style="border:0;margin:0;padding:0;height:130px;"></iframe>
                            <span class="help-inline">&nbsp;</span>                            
                        </div>
                    </div>
   <div class="form-group">
     <label class="col-sm-3 col-lg-2 control-label"><?php //echo lang_key('Service1'); ?></label>
                        <div class="col-sm-9 col-lg-10 controls">
                            <input type="text" name="title_2" id="title_2" 
							value="<?php echo $service_2->title;//echo get_profile_photo_name_by_username($profile->user_name);?>"
							placeholder="service_name">
							</div>
   </div>
   <!-- desc -->
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label"><?php //echo lang_key('service_desc');//echo lang_key('service_desc'); ?></label>
                        <div class="col-sm-9 col-lg-10 controls">
                            <input type="text" name="subtitle_2" value="<?php  echo $service_2->subtitle;//echo $profile->user_name; ?>"
                                   placeholder="desc " class="form-control">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('desc1'); ?>
                        </div>
                    </div>
					 <div class="form-group">
     <label class="col-sm-3 col-lg-2 control-label"><?php //echo lang_key('Service1'); ?></label>
                        <div class="col-sm-9 col-lg-10 controls">
                            <input type="text" name="title_ar2" id="title_ar2" 
							value="<?php echo $service_2->title_ar; //echo get_profile_photo_name_by_username($profile->user_name);?>"
							placeholder="إسم الخدمة">
							</div>
   </div>
   <!-- desc -->
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label"><?php //echo lang_key('service_desc'); ?></label>
                        <div class="col-sm-9 col-lg-10 controls">
                            <input type="text" name="subtitle_ar2" 
							value="<?php  echo $service_2->subtitle_ar;  ?>"
                                   placeholder="الوصف  " class="form-control">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('desc1'); ?>
                        </div>
                    </div>
					<!-- URL -->
					   <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label"><?php //echo lang_key('service_url'); ?></label>
                        <div class="col-sm-9 col-lg-10 controls">
                            <input type="text" name="url2" value="<?php echo $service_2->url;//echo $profile->user_name; ?>"
                                   placeholder="desc url" class="form-control">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('desc1'); ?>
                        </div>
                    </div>
 </div>
 
 
 
 
 <!-- service edit  3 -->

 <div class="col-md-3">
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label">&nbsp;</label>
                        <div class="col-sm-9 col-lg-10 controls">
                            
							<img class="thumbnail" id="service_path_3" 
							src="<?php echo base_url('uploads/cmsuploads/thumb')."/".$service_3->img;?>"  style="width:100px;" />
                            <span id="profile_photo_error"><?php echo form_error('service_path'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <!--<label class="col-sm-3 col-lg-2 control-label"><?php // echo lang_key('profile_picture'); ?></label> -->
                        <div class="col-sm-9 col-lg-10 controls">
                            <input type="hidden" name="service_photo_3" id="service_photo_3" 
							value="<?php echo $service_3->img;?>">
                            <iframe src="<?php echo site_url('admin/cms/service_3_img');?>" style="border:0;margin:0;padding:0;height:130px;"></iframe>
                            <span class="help-inline">&nbsp;</span>                            
                        </div>
                    </div>
					
   <div class="form-group">
     <label class="col-sm-3 col-lg-2 control-label"><?php //echo lang_key('Service1'); ?></label>
                        <div class="col-sm-9 col-lg-10 controls">
                            <input type="text" name="title_3" id="title3" 
							value="<?php echo $service_3->title;//echo get_profile_photo_name_by_username($profile->user_name);?>"
							placeholder="service_name">
							</div>
   </div>
   <!-- desc -->
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label"><?php //echo lang_key('service_desc');//echo lang_key('service_desc'); ?></label>
                        <div class="col-sm-9 col-lg-10 controls">
                            <input type="text" name="subtitle3" value="<?php  echo $service_3->subtitle;//echo $profile->user_name; ?>"
                                   placeholder="desc " class="form-control">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('desc1'); ?>
                        </div>
                    </div>
					 <div class="form-group">
     <label class="col-sm-3 col-lg-2 control-label"><?php //echo lang_key('Service1'); ?></label>
                        <div class="col-sm-9 col-lg-10 controls">
                            <input type="text" name="title_ar3" id="title_ar3" 
							value="<?php echo $service_3->title_ar;//echo get_profile_photo_name_by_username($profile->user_name);?>"
							placeholder="إسم الخدمة">
							</div>
   </div>
   <!-- desc -->
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label"><?php //echo lang_key('service_desc'); ?></label>
                        <div class="col-sm-9 col-lg-10 controls">
                            <input type="text" name="subtitle_ar3" value="<?php echo $service_3->subtitle_ar//echo $profile->user_name; ?>"
                                   placeholder="الوصف  " class="form-control">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('desc1'); ?>
                        </div>
                    </div>
					<!-- URL -->
					   <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label"><?php //echo lang_key('service_url'); ?></label>
                        <div class="col-sm-9 col-lg-10 controls">
                            <input type="text" name="url3" value="<?php echo $service_3->url;//echo $profile->user_name; ?>"
                                   placeholder="url service3" class="form-control">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('desc1'); ?>
                        </div>
                    </div>
 </div>
 
 
 
 
 <!-- service edit  4-->

 <div class="col-md-3">
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label">&nbsp;</label>
                        <div class="col-sm-9 col-lg-10 controls">
                            
							<img class="thumbnail" id="service_path_4" 
							src="<?php echo base_url('uploads/cmsuploads/thumb')."/".$service_4->img;?>"  style="width:100px;" />
                            <span id="profile_photo_error"><?php echo form_error('service_path'); ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <!--<label class="col-sm-3 col-lg-2 control-label"><?php // echo lang_key('profile_picture'); ?></label> -->
                        <div class="col-sm-9 col-lg-10 controls">
                            <input type="hidden" name="service_photo_4" id="service_photo_4" 
							value="<?php echo $service_4->img;  ?>">
                            <iframe src="<?php echo site_url('admin/cms/service_4_img');?>" style="border:0;margin:0;padding:0;height:130px;"></iframe>
                            <span class="help-inline">&nbsp;</span>                            
                        </div>
                    </div>
   <div class="form-group">
     <label class="col-sm-3 col-lg-2 control-label"><?php //echo lang_key('Service1'); ?></label>
                        <div class="col-sm-9 col-lg-10 controls">
                            <input type="text" name="title_4" id="title_4" 
							value="<?php echo $service_4->title; //echo get_profile_photo_name_by_username($profile->user_name);?>"
							placeholder="service_name">
							</div>
   </div>
   <!-- desc -->
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label"><?php //echo lang_key('service_desc');//echo lang_key('service_desc'); ?></label>
                        <div class="col-sm-9 col-lg-10 controls">
                            <input type="text" name="subtitle_4" value="<?php echo $service_4->subtitle; //echo $profile->user_name; ?>"
                                   placeholder="desc " class="form-control">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('desc1'); ?>
                        </div>
                    </div>
					 <div class="form-group">
     <label class="col-sm-3 col-lg-2 control-label"><?php //echo lang_key('Service1'); ?></label>
                        <div class="col-sm-9 col-lg-10 controls">
                            <input type="text" name="title_ar4" id="title_ar4" 
							value="<?php echo $service_4->title_ar; ?>"
							placeholder="إسم الخدمة">
							</div>
   </div>
   <!-- desc -->
                    <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label"><?php //echo lang_key('service_desc'); ?></label>
                        <div class="col-sm-9 col-lg-10 controls">
                            <input type="text" name="subtitle_ar4" value="<?php echo $service_4->subtitle_ar;//echo $profile->user_name; ?>"
                                   placeholder="الوصف  " class="form-control">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('desc1'); ?>
                        </div>
                    </div>
					<!-- URL -->
					   <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label"><?php //echo lang_key('service_url'); ?></label>
                        <div class="col-sm-9 col-lg-10 controls">
                            <input type="text" name="url4" value="<?php echo $service_4->url; //echo $profile->user_name; ?>"
                                   placeholder="desc url" class="form-control">
                            <span class="help-inline">&nbsp;</span>
                            <?php echo form_error('desc1'); ?>
                        </div>
                    </div>
 </div>
 
 
 </div> <!-- end of the row-->
		 <div class="md-col-12">
 <div class="form-group">
		<input type="submit" value="Save Services" class="btn btn-success submit" action="1">
</div>
</div>
</form>
		 </div>
		 </div>
		 </div>
		 </div>