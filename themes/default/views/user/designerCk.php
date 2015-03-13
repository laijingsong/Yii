<body class="J_scroll_fixed">
<div class="wrap jj">
	<ul class="nav nav-tabs">
     	<li><a href="index.php?r=user/index">所有vip</a></li>
	    <li class="active"><a href="index.php?r=user/designer">设计师</a></li>
	    <li><a href="index.php?r=user/dianzhu">店主</a></li>
  </ul>
  <div class="common-form">
    <form method="post" class="form-horizontal J_ajaxForm" action="">
      <div class="table_list">
        <table cellpadding="2" cellspacing="2" width="100%">
          <tbody>
            <tr>
              <td width="180">用户名:</td>
              <td><input type="text" class="input" name="name" value="<?php echo $result['tname']?>" readonly="readonly"></td>
            </tr>
             <tr>
	          <td>审核</td>
	          <td>
	          	<label class="radio inline" for="active_true">
	            		<input type="radio" name="status" value="1" 
	            		<?php if ($result['status']==1){?>
	            		 checked <?php }?> id="active_true"/>通过
	            </label>
	            <label class="radio inline" for="active_false">
	            		<input type="radio" name="status" value="0" 
	            		<?php if ($result['status']==0){?>
	            		 checked <?php }?>
	            		 id="active_false">不通过
	            </label>
	            <input name="bh" type="hidden" value="<?php echo $bh?>">
	          </td>
       	 </tr>
           
          </tbody>
        </table>
      </div>
       <div class="form-actions">
       		<input type="hidden" name="bh" value="<?php echo $bh?>"/>
            <button type="submit" class="btn btn-primary btn_submit J_ajax_submit_btn">审核</button>
            <a class="btn" href="index.php?r=user/index">返回</a>
      </div>
    </form>
  </div>
</div>