
<div id="buycart" range="[['1-0',<?php echo round($goods_info['lsprice']*0.88)?>]]" style="width:580px;">
       <div id="layout1" class="layout1 orderPushpage">
                <dl class="dltop">
                  <dd class="ocolor">颜色</dd>
                  <dd class="osize">尺码</dd>
                  <dd class="onum">数量</dd>
                  <?php if ($pro && $pro['isend'] == 1){?><dd class="osize">数量</dd><?php }?>
                </dl>
                <div class="layout1-body">
                  <div class="cont-auto" id="cont-auto" style="max-height: 245px;">
                  <!-- start -->
                  <?php $i=1; foreach ($data as $c=>$v){?>
                    <div class="pic-list-item bitem1 thisitem_t">
                      <ul class="add-item">
                        <li class="add-name">
                          <div class="inside">
                            <span class="number"><?php echo $i;?></span>
                            <div class="checkbox">
                              <input name="singlw-good" id="colorc_0" class="singlw-good" type="checkbox" value="0"></div>
                            <span class="colors" title="<?php echo $color[$c]?>"><?php echo $color[$c]?></span>
                          </div>
                        </li>
                        
                        <li class="date">
                        <?php foreach ($v as $s=>$stocks){?>
                          <ul style="z-index:998">
                            <li>
                              <span title="<?php echo $size[$s]?>" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; width:120px;"><?php echo $size[$s]?></span>
                            </li>
                           
                            <li>
                              <div class="ordernumcontral">
                                <div class="minus item1">
                                  <a href="javascript:void(0)" data-oper="minus"  class="item_disable"></a>
                                </div>
                                <div class="order_num_txt item1">
                                  <input  class="clear_num" colorid='<?php echo $c?>' sizeid='<?php echo $s?>' name="<?php echo $goods_info['title']?>" goodsid="<?php echo $gid?>" storeid="<?php echo $goods_info['store_id']?>" id="spec_22566890" specid="<?php echo $stocks['id']?>" value="<?php if($cartContents AND isset($cartContents[$sid][$gid][$stocks['id']]['qty'])){echo $cartContents[$sid][$gid][$stocks['id']]['qty'];}else{echo '0';}?>" type="text">
                                
                                  <img class="ku" src="#"></div>
                                <div class="add item1">
                                  <a href="javascript:void(0)" data-oper="add"  class=""></a>
                                </div>
                              </div>
                            </li>
                            <li>
                              <?php if ($pro && $pro['isend'] == 1){?><span title="<?php echo $stocks['stocks']?>" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; width:120px;"><?php echo $stocks['stocks']?></span><?php }?>
                            </li>
                          </ul>
                          <?php }?>
                          
                        </li>
                        <li style="clear:both;height:0; overflow: hidden;display: block;"></li>
                      </ul>
                    </div>
                    <?php $i++;}?>
                    <!-- end -->
                    
                    <div style="height:20px"></div>
                  </div>
                </div>
                <div class="settlement">
                  <table cellpadding="0" cellspacing="0" border="0">
                    <tbody>
                      <tr>
                        <td>
                          <p>
                            共
                            <strong><em id="g-count">0</em></strong> 
                            件
                            <span class="sign">X</span>
                          </p>
                        </td>
                        <td>
						<div class="settlementbox">
							    <table cellpadding="0" cellspacing="0" border="0" class="num-table">
							        <tbody>
							            <tr class="" id="">
							                <td class="f_orderprice">
							                    <p><span><b class="yen">
							                    	¥</b><?php echo round($goods_info['lsprice']*0.88)?></span>元/件
							                    </p>
							                </td>
							            </tr>
							        </tbody>
							    </table>
							</div>
                        </td>
                        <td>
                          <p>
                            <span class="equ">=</span>
                            <b>共计</b>
                            <strong><b class="yen">¥</b>
                              <samp id="gd_money_count">0.00</samp></strong> 
                            元
                          </p>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="order_bottom">
                  <input  id="submit_cart" name="submit_cart"  value="0" type="hidden">
                  <button type="submit" value="" id="<?php if ($pro && $pro['isend'] == 1) echo 'stocks_';?>t_buy" href="javascript:void(0);">
                    加入进货车
                    <b class="redbtn"></b>
                  </button>
                  <a href="javascript:void(0)" id="cancle-se" onclick="canceldd();">取消</a>
                  <p class="otip" id="spec_none" style="display: block;">
                    <span></span>
                    请选择商品
                  </p>
                </div>
              </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
  var o=$( "#buycart" );
  resetdd(o);
  

});
</script>