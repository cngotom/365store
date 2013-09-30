﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>完善资料</title>
<link rel="stylesheet" href="http://s.zbjimg.com/css/auntion.css" type="text/css"/>
<script src="http://s.zbjimg.com/js/jquery.js" language="JavaScript" type="text/javascript"></script>
<script type="text/javascript" src="http://s.zbjimg.com/js/jquery.cookie.js"></script>
<script src="http://s.zbjimg.com/js/auntion.js" language="JavaScript" type="text/javascript"></script>
<script src="http://s.zbjimg.com/p/login/js/register-hez.js?t=2" language="JavaScript" type="text/javascript"></script>
<link rel="stylesheet" href="http://s.zbjimg.com/p/login/css/login.css" type="text/css"/>
<link rel="stylesheet" href="http://s.zbjimg.com/p/login/css/login-hez.css" type="text/css"/>
</head>
<body>
<div class="login_page">
	<div class="l_tmenu">
		<span id="syn_div">
			<a href="/register/index">免费注册</a> | 
			<a href="http://u.zhubajie.com/login/index">登录</a>
		</span> | 
			<a href="http://www.zhubajie.com" target="_blank">猪八戒网首页</a> | 
			<a href="http://help.zhubajie.com" target="_blank">帮助</a>
	</div>
    <h1 class="at_cis"><a href="http://www.zhubajie.com/" class="at_gohome" title="返回猪八戒网首页"></a></h1>
    <div class="clearfix mb10">
        <p class="crumb gray3"></p>
    </div>
    <div class="reg_box">
            <style type="text/css">
            	.reg_form{width:600px;}
                .tit-tab span{padding:4px 8px; display:inline-block; margin-bottom:-1px;}
                .tit-tab a{text-decoration:underline; color:#ff6600;}
                .tit-tab-act{border-width:1px; border-style:solid; border-color:#e5e5e5 #e5e5e5 #fff; font-weight:bold; color:#000;}
            	.tit-tips{padding:3px 10px; background-color:#FFF8BE; border:1px solid #FFC045; margin-bottom:24px; color:#666; width:610px;}

				.reg_box div.tit-tab{padding-bottom:0px; border-bottom: 1px solid #E5E5E5; margin-bottom:10px;}
            	.zbj_suggest{ background-color:White; border:solid 1px #C7C7C7;}
				.zbj_suggest div{ cursor:default; padding-left:5px;}
				.zbj_suggest div.select,.zbj_suggest div:hover{ background-color:#DAF1FF; letter-spacing:1px;}
				.reg_form .at_text em{ top:0;}
				.reg_form dd .sugNameCon{ clear:both;width:226px; margin-left:73px; background-color:#DAF1FF; border:solid 1px #84D2FF;}
				.reg_form dd .sugNameCon label{ cursor:pointer;}
				.at_text em.on{ z-index:1;}
            </style>
            <div class="tit gray3 tit-tab">
                <span class="tit-tab-act">完善个人资料</span>
                <span class="tit-tab-unAct"><a href="/login/bindding_id.php">已有帐号？绑定我的帐号</a></span>
            </div>
            <p class="tit-tips"><b class="orange1">提示：</b><span class="fc6">您正在完善在猪八戒网的个人资料，完善后即可进行下一步操作！</span></p>
        	<div class="reg_form">
        	<form action="/oauthapi/createuser" method="post" id="reg_box">
        	<input type="hidden" id="strong" name="strong" />
        	<input type="hidden"  name="wlid" value="278091" />
            <dl>
            <dd class="clearfix" style="height:auto"><em class="lab">用 户 名:</em><span class="at_text t_1_d"><input type="text" value="流星飞雨" name="uname" id="u_name"  onblur="add_ucookie()" tabindex="1"/></span><div class="clear"></div></dd>
			<dd class="clearfix"><em class="lab">邮箱地址:</em><span class="at_text t_1_d"><input type="text" value="" id="e_name" name="mail" onblur="add_ecookie()" tabindex="2"></span></dd>
			<dd class="clearfix"><em class="lab">设置密码:</em><span class="at_text t_1_d"><input type="password" value="" id="u_pas" name="pass" tabindex="3"/></span></dd>
            <dd class="clearfix"><em class="lab">确认密码:</em><span class="at_text t_1_d"><input type="password" value="" id="u_pas1" name="repass" tabindex="4" /></span></dd>
            <dd class="clearfix" style="height:auto"><em class="lab"></em><label for="auto_login"><input type="checkbox" checked="chcked" class="auto_login" id="auto_login" value="" name=""> <span class="gray2">我接受</span></label><a href="javascript:void(0)" id="need_read" title="点击查看‘猪八戒网用户服务协议’内容">猪八戒网用户服务协议</a>
            <div class="read_box" id="read_box">

			<div style="height:300px;overflow:hidden;*margin-left:50px;_margin:0;padding:10px;overflow-y:auto;border:1px solid #c7c7c7;">

			<p align="center"><strong>猪八戒网服务协议（试行）</strong></p><br />
			<p><strong>
			  猪八戒网（以下简称“本网站”）依据《猪八戒网服务协议》（以下简称“本协议”）的规定提供服务，本协议具有合同效力。注册会员时，请您认真阅读本协议，审阅并接受或不接受本协议（未成年人应在法定监护人陪同下审阅）。</strong><br /><br />
			若您已经注册为本网站会员，即表示您已充分阅读、理解并同意自己与本网站订立本协议，且您自愿受本协议的条款约束。本网站有权随时变更本协议并在本网站上予以公告。经修订的条款一经在本网站的公布后，立即自动生效。如您不同意相关变更，必须停止使用本网站。本协议内容包括协议正文及所有猪八戒网已经发布的各类规则。所有规则为本协议不可分割的一部分，与本协议正文具有同等法律效力。一旦您继续使用本网站，则表示您已接受并自愿遵守经修订后的条款。 </p>
			<br />
			<p><strong>第一条 会员资格 </strong><br />
			  一、 只有符合下列条件之一的自然人或法人才能申请成为本网站会员，可以使用本网站的服务。<br />
			    
			  （一）、年满十八岁，并具有民事权利能力和民事行为能力的自然人；<br />
			    
			  （二）、无民事行为能力人或限制民事行为能力人应经过其监护人的同意；<br />
			    
			  （三）、根据中国法律、法规、行政规章成立并合法存在的机关、企事业单位、社团组织和其他组织。无法人资格的单位或组织不当注册为本网站会员的，其与本网站之间的协议自始无效，本网站一经发现，有权立即注销该会员，并追究其使用本网站服务的一切法律责任。　　 <br />
			  二、 会员需要提供明确的联系地址和联系电话，并提供真实姓名或名称。</p>
			<br />
			<p><strong>第二条 会员的权利和义务</strong> 　　<br />
			  一、会员有权根据本协议及本网站发布的相关规则，利用本网站发布任务信息、查询会员信息、参加任务，在本网站社区及相关产品发布信息，参加本网站的有关活动及有权享受本网站提供的其他有关资讯及信息服务。<br />
			  二、会员须自行负责自己的会员账号和密码，且须对在会员账号密码下发生的所有活动（包括但不限于发布任务信息、网上点击同意各类协议、规则、参加竞标等）承担责任。会员有权根据需要更改登录和账户提现密码。　<br />
			  三、会员应当向本网站提供真实准确的注册信息，包括但不限于真实姓名、身份证号、联系电话、地址、邮政编码等。保证本网站可以通过上述联系方式与自己进行联系。同时，会员也应当在相关资料实际变更时及时更新有关注册资料。　<br />
			  四、会员不得以任何形式擅自转让或授权他人使用自己在本网站的会员帐号。<br />
			  五、会员有义务确保在本网站上发布的任务信息真实、准确，无误导性。<br />
			  六、会员在本网站网上发布平台，不得发布国家法律、法规、行政规章规定禁止的信息、侵犯他人知识产权或其他合法权益的信息、违背社会公共利益或公共道德的信息。　<br />
			  七、会员在本网站交易中应当遵守诚实信用原则，不得以干预或操纵发布任务等不正当竞争方式扰乱网上交易秩序，不得从事与网上交易无关的不当行为，不得在交易平台上发布任何违法信息。<br />
			  八、会员不应采取不正当手段（包括但不限于虚假任务、互换好评等方式）提高自身或他人信用度，或采用不正当手段恶意评价其他会员，降低其他会员信用度。　　<br />
			  九、会员承诺自己在使用本网站实施的所有行为遵守法律、法规、行政规章和本网站的相关规定以及各种社会公共利益或公共道德。如有违反导致任何法律后果的发生，会员将以自己的名义独立承担相应的法律责任。<br />
			  十、会员在本网站网上交易过程中如与其他会员因交易产生纠纷，可以请求本网站从中予以协调处理。会员如发现其他会员有违法或违反本协议的行为，可以向本网站举报。<br />
			  十一、会员应当自行承担因交易产生或取得的相关费用，并依法纳税。　　<br />
			  十二、未经本网站书面允许，会员不得将本网站的任何资料以及在交易平台上所展示的任何信息作商业性利用（包括但不限于以复制、修改、翻译等形式制作衍生作品、分发或公开展示）。　　<br />
			  十三、会员不得使用以下方式登录网站或破坏网站所提供的服务：<br />
			    
			  （一）、以任何机器人软件、蜘蛛软件、爬虫软件、刷屏软件或其它自动方式访问或登录本网站；<br />
			    
			  （二）、通过任何方式对本公司内部结构造成或可能造成不合理或不合比例的重大负荷的行为；<br />
			    
			  （三）、通过任何方式干扰或试图干扰网站的正常工作或网站上进行的任何活动；<br />
			  十四、会员有权在同意本网站相关规则的前提下享受交易保障服务（包括但不限于原创作品、保证完成、按时交稿、满意修改）。<br />
			  十五、会员同意接收来自本网站的信息，包括但不限于活动信息、交易信息、促销信息等。</p>
			<br />
			<p><strong style="color:#f00">第三条 猪八戒网的权利和义务　</strong>　<br />
			  一、本网站仅为会员提供一个信息交流平台，是买家发布任务需求和卖家提供解决方案的一个交易市场，本网站对交易双方均不加以监视或控制，亦不介入交易的过程。<br />
			  二、本网站有义务在现有技术水平的基础上努力确保整个网上交流平台的正常运行，尽力避免服务中断或将中断时间限制在最短时间内，保证会员网上交流活动的顺利进行。<br />
			  三、本网站有义务对会员在注册使用本网站信息平台中所遇到的与交易或注册有关的问题及反映的情况及时作出回复。　 　<br />
			  四、本网站有权对会员的注册资料进行审查，对存在任何问题或怀疑的注册资料，本网站有权发出通知询问会员并要求会员做出解释、改正。<br />
			  五、会员因在本网站网上交易与其他会员产生纠纷的，会员将纠纷告知本网站，或本网站知悉纠纷情况的，经审核后，本网站有权通过电子邮件及电话联系向纠纷双方了解纠纷情况，并将所了解的情况通过电子邮件互相通知对方；会员通过司法机关依照法定程序要求本网站提供相关资料，本网站将积极配合并提供有关资料。　　<br />
			  六、因网上信息平台的特殊性，本网站没有义务对所有会员的交易行为以及与交易有关的其他事项进行事先审查，但如发生以下情形，<strong>本网站有权无需征得会员的同意限制会员的活动、向会员核实有关资料、发出警告通知、暂时中止、无限期中止及拒绝向该会员提供服务：</strong><br />
			    
			  （一）、会员违反本协议或因被提及而纳入本协议的相关规则；<br />
			    
			  （二）、存在会员或其他第三方通知本网站，认为某个会员或具体交易事项存在违法或不当行为，并提供相关证据，而本网站无法联系到该会员核证或验证该会员向本网站提供的任何资料；<br />
			    
			  （三）、存在会员或其他第三方通知本网站，认为某个会员或具体交易事项存在违法或不当行为，并提供相关证据。本网站以普通非专业交易者的知识水平标准对相关内容进行判别，可以明显认为这些内容或行为可能对本网站会员或本网站造成财务损失或法律责任。<br />
			  七、根据国家法律、法规、行政规章规定、本协议的内容和本网站所掌握的事实依据，可以认定该会员存在违法或违反本协议行为以及在本网站交易平台上的其他不当行为，本网站有权无需征得会员的同意在本网站交易平台及所在网站上以网络发布形式公布该会员的违法行为，并有权随时作出删除相关信息、终止服务提供等处理。<br />
			  <strong>八、本网站依据本协议及相关规则，可以冻结、使用、先行赔付、处置会员缴存并冻结在本网站账户内的资金。</strong><br />
			  <strong>九、本网站有权在不通知会员的前提下，删除或采取其他限制性措施处理下列信息：</strong>包括但不限于以规避费用为目的；以炒作信用为目的；存在欺诈等恶意或虚假内容；与网上交易无关或不是以交易为目的；存在恶意竞价或其他试图扰乱正常交易秩序因素；该信息违反公共利益或可能严重损害本网站和其他会员合法利益的。<br />
			  <br />
			  <strong style="color:#f00">第四条 服务的中断和终止　</strong><br />
			  一、本网站可自行全权决定以任何理由 (包括但不限于本网站认为会员已违反本协议及相关规则的字面意义和精神，或会员在超过180日内未登录本网站等) 终止对会员的服务，并有权在两年内保存会员在本网站的全部资料（包括但不限于会员信息、产品信息、交易信息等）。同时本网站可自行全权决定，在发出通知或不发出通知的情况下，随时停止提供全部或部分服务。服务终止后，本网站没有义务为会员保留原账户中或与之相关的任何信息，或转发任何未曾阅读或发送的信息给会员或第三方。<br />
			  二、若会员向本网站提出注销本网站注册会员身份，需经本网站审核同意，由本网站注销该注册会员，会员即解除与本网站的协议关系，但本网站仍保留下列权利：<br />
			    
			  （一）、会员注销后，本网站有权在法律、法规、行政规章规定的时间内保留该会员的资料,包括但不限于以前的会员资料、交易记录等。 　　 <br />
			    
			  （二）、会员注销后，若会员注销前在本网站交易平台上存在违法行为或违反本协议的行为，本网站仍可行使本协议所规定的权利。<br />
			  三、会员存在下列情况，本网站可以通过注销会员的方式终止服务： 　　<br />
			    
			  （一）、在会员违反本协议及相关规则规定时，本网站有权终止向该会员提供服务。本网站将在中断服务时通知会员。但该会员在被本网站终止提供服务后，再一次直接或间接或以他人名义注册为本网站会员的，本网站有权再次单方面终止为该会员提供服务；　　<br />
			    
			  （二）、本网站发现会员注册资料中主要内容是虚假的，本网站有权随时终止为该会员提供服务； <br />
			    
			  （三）、本协议终止或更新时，会员未确认新的协议的。 　　<br />
			    
			  （四）、其它本网站认为需终止服务的情况。 <br />
			  <strong style="color:#f00">第五条 本网站的责任范围　</strong>　　<br />
			  <strong>当会员接受该协议时，会员应当明确了解并同意∶<br />
			    一、本网站不能随时预见到任何技术上的问题或其他困难。该等困难可能会导致数据损失或其他服务中断。本网站是在现有技术基础上提供的服务。本网站不保证以下事项∶<br />
			      
			    （一）、本网站将符合所有会员的要求。<br />
			      
			    （二）、本网站不受干扰、能够及时提供、安全可靠或免于出错。<br />
			      
			    （三）、本服务使用权的取得结果是正确或可靠的。　 　<br />
			    二、是否经由本网站下载或取得任何资料，由会员自行考虑、衡量并且自负风险，因下载任何资料而导致会员电脑系统的任何损坏或资料流失，会员应负完全责任。希望会员在使用本网站时，小心谨慎并运用常识。　 　<br />
			    三、会员经由本网站取得的建议和资讯，无论其形式或表现，绝不构成本协议未明示规定的任何保证。　　<br />
			    四、基于以下原因而造成的利润、商誉、使用、资料损失或其它无形损失，本网站不承担任何直接、间接、附带、特别、衍生性或惩罚性赔偿（即使本网站已被告知前款赔偿的可能性）：<br />
			      
			    （一）、本网站的使用或无法使用。<br />
			      
			    （二）、会员的传输或资料遭到未获授权的存取或变更。<br />
			      
			    （三）、本网站中任何第三方之声明或行为。　　 <br />
			      
			    （四）、本网站其它相关事宜。　 　<br />
			    五、本网站只是为会员提供一个服务交易的平台，对于会员所发布的任务的合法性、真实性及其品质，以及会员履行交易的能力等，本网站一律不负任何担保责任。 <br />
			    六、本网站提供与其它互联网上的网站或资源的链接，会员可能会因此连结至其它运营商经营的网站，但不表示本网站与这些运营商有任何关系。其它运营商经营的网站均由各经营者自行负责，不属于本网站控制及负责范围之内。对于存在或来源于此类网站或资源的任何内容、广告、物品或其它资料，本网站亦不予保证或负责。因使用或依赖任何此类网站或资源发布的或经由此类网站或资源获得的任何内容、物品或服务所产生的任何损害或损失，本网站不负任何直接或间接的责任。<br />
			    </strong><br />
			  <strong>第六条 知识产权</strong>　　<br />
			  一、本网站及本网站所使用的任何相关软件、程序、内容，包括但不限于作品、图片、档案、资料、网站构架、网站版面的安排、网页设计、经由本网站或广告商向会员呈现的广告或资讯，均由本网站或其它权利人依法享有相应的知识产权，包括但不限于著作权、商标权、专利权或其它专属权利等，受到相关法律的保护。未经本网站或权利人明示授权，会员保证不修改、出租、出借、出售、散布本网站及本网站所使用的上述任何资料和资源，或根据上述资料和资源制作成任何种类产品。<br />
			  二、本网站授予会员不可转移及非专属的使用权，使会员可以通过单机计算机使用本网站的目标代码（以下简称&quot;软件&quot;），但会员不得且不得允许任何第三方复制、修改、创作衍生作品、进行还原工程、反向组译，或以其它方式破译或试图破译源代码，或出售、转让&quot;软件&quot;或对&quot;软件 &quot;进行再授权，或以其它方式移转&quot;软件&quot;之任何权利。会员同意不以任何方式修改&quot;软件&quot;，或使用修改后的&quot;软件&quot;。<br />
			  三、会员不得经由非本网站所提供的界面使用本网站。<br />
			  <br />
			  <strong>第七条 隐私权</strong>　　<br />
			  一、信息使用：<br />
			    
			  （一）、本网站不会向任何人出售或出借会员的个人或法人信息，除非事先得到会员得许可。<br />
			    
			  （二）、本网站亦不允许任何第三方以任何手段收集、编辑、出售或者无偿传播会员的个人或法人信息。任何会员如从事上述活动，一经发现，本网站有权立即终止与该会员的服务协议，查封其账号。<br />
			  二、信息披露：会员的个人或法人信息将在下述情况下部分或全部被披露：<br />
			    
			  （一）、经会员同意，向第三方披露；<br />
			    
			  （二）、若会员是合法的知识产权使用权人并提起投诉，应被投诉人要求，向被投诉人披露，以便双方处理可能的权利纠纷；<br />
			    
			  （三）、根据法律的有关规定，或者行政、司法机关的要求，向第三方或者行政、司法机关披露；<br />
			    
			  （四）、若会员出现违反中国有关法律或者网站规定的情况，需要向第三方披露；<br />
			    
			  （五）、为提供你所要求的产品和服务，而必须和第三方分享会员的个人或法人信息<br />
			    
			  （六）、其它本网站根据法律或者网站规定认为合适的披露；<br />
			  三、信息安全：<br />
			    
			  （一）、在使用本网站服务进行网上交易时，请会员妥善保护自己的个人或法人信息，仅在必要的情形下向他人提供；<br />
			    
			  （二）、如果会员发现自己的个人或法人信息泄密，尤其是账户或诚付宝账户及密码发生泄露，请会员立即联络本网站客服，以便我们采取相应措施。<br />
			  <br />
			  <strong>第八条 不可抗力</strong>　　<br />
			  因不可抗力或者其他意外事件，使得本协议的履行不可能、不必要或者无意义的，双方均不承担责任。本合同所称之不可抗力意指不能预见、不能避免并不能克服的客观情况，包括但不限于战争、台风、水灾、火灾、雷击或地震、罢工、暴动、法定疾病、黑客攻击、网络病毒、电信部门技术管制、政府行为或任何其它自然或人为造成的灾难等客观情况。<br />
			  <br />
			  <strong>第九条 保密</strong>　　<br />
			  双方保证在对讨论、签订、执行本协议中所获悉的属于对方的且无法自公开渠道获得的文件及资料（包括但不限于商业秘密、公司计划、运营活动、财务信息、技术信息、经营信息及其他商业秘密）予以保密。未经该资料和文件的原提供方同意，另一方不得向第三方泄露该商业秘密的全部或者部分内容。但法律、法规、行政规章另有规定或者双方另有约定的除外。<br />
			  <br />
			  <strong style="color:#f00">第十条 争议解决方式</strong>　　<br />
			  <strong>一、本协议及其规则的有效性、履行和与本协议及其规则效力有关的所有事宜，将受中华人民共和国法律管辖，任何争议仅适用中华人民共和国法律。<br />
			    二、本网站有权受理并调处您与其他会员因交易服务产生的争议，同时有权单方面独立判断其他会员对您的投诉及索偿是否成立，若本网站判断索偿成立，则您应当及时使用自有资金进行偿付，否则本网站有权使用您交纳的任务赏金或保证金进行相应偿付。本网站没有使用自用资金进行偿付的义务，但若进行了该等支付，您应及时赔偿本网站的全部损失，否则本网站有权通过前述方式抵减相应资金或权益，如仍无法弥补损失，则本网站保留继续追偿的权利。因本网站非司法机关，您完全理解并承认，本网站对证据的鉴别能力及对纠纷的处理能力有限，受理交易争议完全是基于您之委托，不保证争议处理结果符合您的期望，本网站有权决定是否参与争议的调处。<br />
			    三、凡因本协议及其规则发生的所有争议，争议双方可协商解决，若协商不成的，争议双方同意提交重庆仲裁委员会按其仲裁规则进行仲裁。<br />
			    </strong><br />
			  <strong>第十一条 附则</strong>　　<br />
			  在本协议中所使用的下列词语，除非另有定义，应具有以下含义：<br />
			  &quot;本网站&quot;在无特别说明的情况下，均指&quot;猪八戒网&quot;（www.zhubajie.com）。<br />
			  “用户”： 指具有完全民事行为能力的猪八戒网各项服务的使用者。<br />
			  “会员”： 指与猪八戒网签订《猪八戒网服务协议》并完成注册流程的用户。<br />
			  “买家”：是指在本网站上进行发布任务或购买增值服务等“买”操作的会员。<br />
			  “卖家”：是指在本网站上参加竞标、销售服务、出售技能等“卖”操作的会员。<br />
			  “任务赏金”:买家在猪八戒网上发起交易，确认卖家身份和交易信息后，所要支付的任务费用。</p>

		</div>

            </div>
            </dd>
            <dd class="clearfix"><em class="lab"></em><a href="javascript:void(0)" class="at_but b_1_y" id="reg_sub" ><u></u>完成，继续浏览</a></dd>
            </dl>
            </form>
        </div><!--reg_form-->
		<div class="clear"></div>
    </div><!--reg_box-->
    <div class="new_idea gray3">我对系统有意见或建议，<a href="">跟猪八戒说说。</a></div>
    <div class="footer">
        <p>
        <a href="#" target="_blank">关于我们</a>|
        <a href="#" target="_blank">媒体中心</a>|
        <a href="#" target="_blank">支付方式</a>|
        <a href="#" target="_blank">联系方式</a>|
        <a href="#" target="_blank">友情链接</a>|
        <a href="#" target="_blank">客服中心</a>|
        <a href="#" target="_blank">网站地图</a>|
        <a href="#" target="_blank">友情链接</a>|
        <a href="#" target="_blank">客服中心</a>|
        <a href="#" target="_blank">网站地图</a>
        </p>
        <p>Copyright 2005-2010 Zhubajie.com 版权所有</p>
    </div>
</div><!--login_page-->
<script type="text/javascript">
new reg(1);
(function(){
	var read_box = $("#read_box");
	$("#need_read").click(function(){
		if(read_box.is(":hidden")) read_box.slideDown(100);
		else read_box.slideUp(100);
	})
})()

</script>
<script type="text/javascript">
	var options = {path:'/'};
	add_ucookie();
	var cookie_uname = $.cookie("w_uname");
	var cookie_ename = $.cookie("w_ename");
	$(function(){
	if(cookie_uname){
		$('#u_name').attr('value', cookie_uname);
	}
	if(cookie_ename){
		$('#e_name').attr('value', cookie_ename);
	}

	});
	function add_ucookie(){
	$.cookie("w_uname",$("#u_name").val(),options);
	}
	function add_ecookie(){
	$.cookie("w_ename",$("#e_name").val(),options);
	}
</script>
</body>
</html>

