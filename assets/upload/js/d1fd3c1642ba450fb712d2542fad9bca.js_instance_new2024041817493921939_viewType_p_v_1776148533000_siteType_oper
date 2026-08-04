$(function () {
    // 事件
    $(".zx_btm_o").click(function () {
        $(this).prev().toggleClass("zx_right");
    });

    // 返回顶部
    $('.p_backtop').removeClass("zx_hi");
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.p_backtop').addClass("zx_hi");
        } else {
            $('.p_backtop').removeClass("zx_hi");
        }
    });
    let llhei = $(document.body).height();
    $('.p_backtop').click(function () {
        $('html ,body').animate({ scrollTop: 0 }, {
        	duration:1200,
            easing:"easeInOutCubic"
        });
        return false;
    });
    $('.p_backbottom').click(function () {
        $('html ,body').animate({ scrollTop: llhei }, {
        	duration:1200,
            easing:"easeInOutCubic"
        });
        return false;
    });

    // 添加类名
    $(".zx_type").each(function () {
        var ttt = $(this).text();
        $(this).parent().addClass("zx_" + ttt)
    });
  
  	// 获取客户名称并补充到弹出信息
	$(".zx_haoname").each(function(){
    	let nametr = $(this).find("span").text();
      	$(this).next().next(".zx_xjie").find(".zx_zh").prepend("<p class='zx_ts'>" + nametr + "</p>")
    });
  
    // 微信补充信息
    $(".zx_6").find(".zx_zh").prepend("<span class='zx_ts'></span>")
    $(".zx_6").find(".s_img").prepend("<span class='zx_bts'>微信公众号</span>")
});