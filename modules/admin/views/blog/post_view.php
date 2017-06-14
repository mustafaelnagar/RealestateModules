<?php
// print_r($page);
 ?>
<div class="row">
  <div class="col-md-12">
	<form class="form-horizontal" action="<?php echo site_url('admin/blog/add');?>" method="post" >
    <div class="box">
      
	  <div class="box-title">
        <h3><i class="fa fa-bars"></i> <?php echo $title;?></h3>
        <div class="box-tool">
          <a href="#" data-action="collapse"><i class="fa fa-chevron-up"></i></a>
        </div>
      </div>
	  
      <div class="box-content">
		<input type="hidden" id="action" name="action" value="1">
		<input type="hidden" name="action_type" value="<?php echo (isset($action_type))?$action_type:'insert';?>">
		<?php if(isset($page) && isset($page->id)){ ?>
		<input type="hidden" name="id" value="<?php echo $page->id;?>">
		<?php }?>
		<?php echo $this->session->flashdata('msg');?>
		<div class="form-group">
			<div class="col-sm-12 col-md-12 col-lg-12">
				<input type="submit" value="Draft" class="btn btn-primary submit" action="2">
				<input type="submit" value="Publish" class="btn btn-success submit" action="1">
				<input type="submit" value="Delete" class="btn btn-danger submit" action="0">
			</div>
		</div>	
		<div style="margin-bottom:20px;"></div>

		<?php 
			$title = '';
			if(set_value('title')!='')
				$title = set_value('title');
			else if(isset($page) && isset($page->title))
				$title = $page->title;
		?>
		
		<?php 
            $CI = get_instance();
            $CI->load->model('admin/system_model');
            $query = $CI->system_model->get_all_langs();
            $active_languages = $query->result();
            ?>
            <div class="tabbable">
                <ul class="nav nav-tabs" id="myTab1">
                    <?php $flag=1; foreach ($active_languages as $lang){ ?>
                    <li class="<?php echo (default_lang()==$lang->short_name)?'active':'';?>"><a data-toggle="tab" href="#<?php echo $lang->short_name;?>"><i class="fa fa-home"></i> <?php echo $lang->short_name;?></a></li>
                    <?php $flag++; }?>
                </ul>
                <div class="tab-content" id="myTabContent1">
                     <?php $flag=1; foreach ($active_languages as $lang){ ?>
                     <div id="<?php echo $lang->short_name;?>" class="tab-pane fade in <?php echo (default_lang()==$lang->short_name)?'active':'';?>">

						<!-- Blog title -->
					 <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('title');?>:</label>
                      <div class="col-sm-4 col-lg-5 controls">
                        <input type="text" name="title<?php echo $lang->short_name;?>" 
						value="<?php 
						if($lang->short_name=='en') echo $page->title;
						else echo $page->titlear;
						// echo(set_value('title'.$lang->short_name)!='')?set_value('title'.$lang->short_name):'';
						
						?>" 
						placeholder="<?php echo lang_key('title');?>" class="form-control input-sm" >
                        <span class="help-inline">&nbsp;</span>
                        <?php echo form_error('title'.$lang->short_name); ?>
                      </div>
                    </div>

					<!-- Blog description -->
                    <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label"><?php echo lang_key('description');?>:</label>
                      <div class="col-sm-7 col-lg-7 controls">
                        <textarea  style="min-height:200px" class="rich"
						name="description<?php echo $lang->short_name;?>">
						<?php 
						
						if($lang->short_name=='en') echo $page->description;
						else echo $page->descriptionar;
						// echo(set_value('description'.$lang->short_name)!='')?set_value('description'.$lang->short_name):'';
						
						?>
						</textarea>
                        <span class="help-inline">&nbsp;</span>
                        <?php echo form_error('description'.$lang->short_name); ?>
                      </div>
                    </div>

                    </div>
                    <?php $flag++; }?>
                </div>
            </div>

		<!-- milestone 1 title -->
<!--
		<div class="form-group">
			<label class="col-sm3 col-lg-3 control-label">Post Title</label>
			<div class="col-sm-8 col-lg-8 controls">
				<input type="text" class="form-control" name="title" id="title" value="<?php echo $title;?>" placeholder="Type somethin" />
				<span class="help-inline">&nbsp;</span>
				<?php echo form_error('title'); ?>
			</div>
		</div>
		
		<div style="clear:both"></div>
		-->
		<!-- old desc -->
		<!--
		<div class="form-group">
			<label class="col-sm-3 col-lg-3 control-label">Content</label>
			<div class="col-sm-8 col-lg-8 controls">
				<?php 
					// $description = '';
					// if(set_value('description')!='')
						// $description = set_value('description');
					// else if(isset($page) && isset($page->description))
						// $description = $page->description;
				?>		
				<textarea name="description" class="rich" style="height:434px"><?php //echo $description;?></textarea>
				<span class="help-inline">&nbsp;</span>
				<?php //echo form_error('description'); ?>
			</div>
		</div>
		<div style="clear:both"></div>	
		
		-->
        <div class="form-group">
            <label class="col-sm-3 col-lg-2 control-label">&nbsp;</label>
            <div class="col-sm-4 col-lg-5 controls">
                <img class="thumbnail" id="featured_photo" src="<?php echo get_featured_photo_by_id('');?>" style="width:256px;">
            </div>
            <div class="clearfix"></div>                   
            <span id="featured-photo-error"></span> 
        </div>
        <div class="form-group">
            <label class="col-sm-3 col-lg-2 control-label">Featured Image:</label>
            <div class="col-sm-4 col-lg-5 controls">                    
            	<?php $v = (set_value('featured_img')!='')?set_value('featured_img'):$page->featured_img;?>
                <input type="hidden" name="featured_img" id="featured_photo_input" value="<?php echo $v;?>">                    
                <iframe src="<?php echo site_url('admin/blog/featuredimguploader');?>" style="border:0;margin:0;padding:0;height:130px;"></iframe>
                <span class="help-inline">&nbsp;</span>
            </div>          
        </div>
        <div class="clearfix"></div>
	 </div>
    </div>
	</form>
  </div>
</div>
<script type="text/javascript" src="<?php echo base_url('assets/tinymce/tinymce.min.js');?>"></script>
<script type="text/javascript">
tinymce.init({
    selector: ".rich",
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save code table contextmenu directionality emoticons template paste textcolor"
   ]
 });
var base_url = '<?php echo base_url();?>';
jQuery(document).ready(function(){
	jQuery('#featured_photo_input').change(function(){
        var val = jQuery(this).val();
        if(val!='')
        {
          var src = base_url+'uploads/thumbs/'+val;            
        }
        else
        {
          var src = base_url+'assets/admin/img/preview.jpg'
        }
        jQuery('#featured_photo').attr('src',src);
    }).change();
	jQuery('#layout').trigger('change');
	jQuery('.submit').click(function(e){
		jQuery('#action').val(jQuery(this).attr('action'));
	});
	jQuery('#content_from').change(function(){
		var content_from = jQuery(this).val();
		if(content_from=='Manual')
		{
			jQuery('.manual').show();
			jQuery('.url').hide();
		}
		else
		{
			jQuery('.manual').hide();
			jQuery('.url').show();			
		}
	}).change();
	jQuery('#title').keyup(function(e){
		makealias(jQuery(this).val());
	});
	jQuery('#title').change(function(e){
		makealias(jQuery(this).val());
	}).change();
});
function makealias(val)
{
	val = val.toLowerCase();
	val = val.replace(/\s/g, '');
	val = val.replace('[', '');
	val = val.replace(']', '');
	jQuery('#alias').val(val);
}
jQuery('#layout').change(function(){
	var val = jQuery(this).val();
	if(val==2)
	{
		jQuery('.left-bar').hide();
		jQuery('.right-bar').hide();
		jQuery('.main-content').css('width','100%');
	}
	else if(val==0)
	{
		jQuery('.left-bar').show();
		jQuery('.right-bar').hide();
		jQuery('.main-content').css('width','75%');
	}
	else if(val==1)
	{
		jQuery('.left-bar').hide();
		jQuery('.right-bar').show();
		jQuery('.main-content').css('width','75%');		
	}		
});
</script>