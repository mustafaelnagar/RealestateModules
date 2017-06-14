<div class="row">

  <div class="col-md-12">

    <div class="box">

      <div class="box-title">

        <h3><i class="fa fa-bars"></i> All posts</h3>

        <div class="box-tool">

          <a href="#" data-action="collapse"><i class="fa fa-chevron-up"></i></a>


        </div>

      </div>

      <div class="box-content">

        <?php $this->load->helper('text');?>

        <?php echo $this->session->flashdata('msg');?>

        <?php if($posts->num_rows()<=0){?>

        <div class="alert alert-info">No Posts</div>

        <?php }else{?>

        <div id="no-more-tables">

        <table class="table table-hover">

           <thead>

               <tr>

                  <th class="numeric">#</th>

                  <th class="numeric">Title</th>

                  <th class="numeric">Description</th>

<!--                  <th class="numeric">Status</th> -->

                  <th class="numeric">Actions</th>

               </tr>

           </thead>

           <tbody>

        	<?php $i=1;foreach($posts->result() as $row):?>

               <tr>

                  <td data-title="#" class="numeric"><?php echo $i;?></td>

                  <td data-title="Title" class="numeric"><a href="<?php echo site_url('admin/blog/manage/'.$row->id);?>"><?php echo $row->title;?></a></td>

                  <td data-title="Description" class="numeric"><?php echo truncate(encode_html($row->description),30,'...',false);?></td>

				  <!-- 
                  <td data-title="Status" class="numeric">

                    <?php
					// if($row->status==1)

                          // $status = '<span class="label label-success">Published</span>';

                          // else if($row->status==2)

                          // $status = '<span class="label label-warning">Drafted</span>';

                        // echo $status;

                    ?>

                  </td>
-->
                  <td data-title="Action" class="numeric">

                      <a href="<?php echo site_url('admin/blog/manage/'.$row->id);?>"><i class="fa fa-edit"></i> Edit</a>&nbsp;|&nbsp;
                      
                      <?php $curr_page = ($this->uri->segment(5)!='')?$this->uri->segment(5):0;?>
                      
                      <a style="color:red" href="<?php echo site_url('admin/blog/delete/'.$curr_page.'/'.$row->id);?>"><i class="fa fa-trash-o"></i> Delete</a>

                  </td>

               </tr>

            <?php $i++;endforeach;?>   

           </tbody>

        </table>

        </div>

        <div class="pagination"><ul class="pagination pagination-colory"><?php echo $pages;?></ul></div>

        <?php }?>

        </div>

    </div>

  </div>

</div>