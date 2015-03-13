			<script src="<?php echo Yii::app()->request->baseUrl; ?>/static/default/js/comment.js" type="text/javascript"></script>
            <div class="sub-message clearfix">
		    	<p class="title-p">最新评论<a href="javascript:void(0);" class="float-right red comment">发表评论</a></p>
		        <div class="commentform">
		            <div class="commenttext">
		            	<textarea id="commenttexts" placeholder="发表评论……"></textarea>
		            </div>
		            <div class="btn commentsub clearfix">
		            	<a href="javascript:void(0);" class="postsubmit" onClick="comment(<?php echo 'this,1,'.$id; ?>)">评论</a>
		            	<a href="javascript:void(0);" class="logoutsubmit">取消</a>                   
		            </div>
		        </div>
                  <ul class="feed-list">
                  	  <?php
                  	  if($data){
                  	  	foreach ($data as $val){
                  	  ?>
                      <li>
                          <div class="user-pic"><img src="<?php echo $u[$val->uid]['pic']?Yii::app()->params['ddcurl'].$u[$val->uid]['pic']:Yii::app()->params['ddcurl'].$u[$val->uid]['pic'].'/skin/201410/img/head.jpg' ?>"></div>
                          <div class="feed-content">
                              <p class="feed-main"><a id="name" ><?php echo $u[$val->uid]['name']?></a><span class="time"><?php echo date('m月d日',$val->dateline)?></span><a class="reply" fun="replysubmit(this,<?php echo $val->id?>)" href="javascript:;"> [回复]</a></p>
                              <p class="feed-info"><?php echo $val->content?></p>
                              <div class="reply-box" id="divOne_<?php echo $val->id?>">
                                  <textarea id="postKeywords" class="text-input" placeholder="对于这家店铺，你有啥想说的，赶紧发布下吧~"></textarea>
                                  <div class="tijiao"><a href="javascript:;" onClick="replysubmit(this,<?php echo $val->id?>)">提交</a></div>
                              </div>
                              <div class=replybox_<?php echo $val->id ?>>
                              <?php if($val->commentreply){
                              	foreach ($val->commentreply as $v){
                              ?>
                              <div class="forward-box">
                                  <p class="feed-main"><a id="name" ><?php echo $u[$v->uid]['name']?></a></p>
                                  <p><?php echo $v->content?></p>
                              </div>
                              <?php }}?>
                              </div>
                          </div>                          
                      </li>
                      <?php }}?>
                  </ul>
              </div>