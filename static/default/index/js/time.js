  function lxfEndtime(){
          $(".lxftime").each(function(){
                var lxfday=$(this).attr("lxfday");//用来判断是否显示天数的变量
                var endtime = new Date($(this).attr("endtime")).getTime();//取结束日期(毫秒值)
                var nowtime = new Date().getTime();        //今天的日期(毫秒值)
                var youtime = endtime-nowtime;//还有多久(毫秒值)
                var seconds = youtime/1000;
                var minutes = Math.floor(seconds/60);
                var hours = Math.floor(minutes/60);
                var days = Math.floor(hours/24);
                var CDay= days ;
                var CHour= hours % 24;
                var CMinute= minutes % 60;
                var CSecond= Math.floor(seconds%60);//"%"是取余运算，可以理解为60进一后取余数，然后只要余数。
                if(endtime<=nowtime){
                        $(this).html("已经结束")//如果结束日期小于当前日期就提示过期啦
                        }else{
                                if($(this).attr("lxfday")=="no"){
                                        $(this).html("剩余：<span>"+CHour+"</span>时<span>"+CMinute+"</span>分<span>"+CSecond+"</span>秒");          //输出没有天数的数据
                                        }else{
                        $(this).html("<i>剩余：</i><span>"+days+"</span>天<span>"+CHour+"</span>时<span>"+CMinute+"</span>分<span>"+CSecond+"</span> 秒");          //输出有天数的数据
                                }
                        }
          });
   setTimeout("lxfEndtime()",1000);
  };
$(function(){
      lxfEndtime();
   });

$(document).ready(function() {
	$("#spaceused1").progressBar();
	$("#spaceused2").progressBar();
	$("#spaceused3").progressBar();
	$("#spaceused4").progressBar();
	$("#spaceused5").progressBar();
	$("#spaceused6").progressBar();
	$("#spaceused7").progressBar();
	$("#spaceused8").progressBar();
	$("#spaceused9").progressBar();
	$("#spaceused10").progressBar();
	$("#spaceused11").progressBar();
	$("#spaceused12").progressBar();
	$("#spaceused13").progressBar();
	$("#spaceused14").progressBar();
	$("#spaceused15").progressBar();
	$("#spaceused16").progressBar();
	$("#spaceused17").progressBar();
	$("#spaceused18").progressBar();
	$("#spaceused19").progressBar();
	$("#spaceused20").progressBar();
});


//$(document).ready(function() {
//$(".progressBar").each(function(){
//var p=$(this).attr('data-p');
//$(this).progressBar(p);
//});
//});