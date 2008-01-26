<ul id="user-setting-panel-nav" class="g-tab-panel-nav">
  	<li class="g-tab-panel-button selected">
  		<a href="#avator-form-panel">头像</a>
	</li>
	<li class="g-tab-panel-button">
		<a href="#basic-info-panel">基本信息</a>
	</li>
	<li class="g-tab-panel-button">
		<a href="#detail-info-panel">详细信息</a>
	</li>
	<li class="g-tab-panel-button">
		<a href="#im-bind-panel">帐户绑定</a>
	</li>
</ul>
<div class="g-tab-panel-content">
	<div id="avator-form-panel" class="g-tab-content">
		<div id="avator-preview" class="avator-preview">
			<?php include_once "template/GetLoginUserInfo.php"; ?>
			<img id="avator-preview-img" src="<?php echo $user->getAvatorUrl(); ?>"></img>
		</div>

		<form id="avator-form" class="avator-form" enctype="multipart/form-data" action="user.php?avator" method="post">
			<div class="form-field">
				<input id="avator" name="avator" type="file"></input>
				<p>请选择你的头像的图片文件, 类型(.gif, .jpeg, .jpg, .bmp, .png)</p>
			</div>
						
			<div class="form-field">
				<input id="avator-form-submit" type="submit" value="上传" class="button"></input>
			</div>
		</form>
	</div>	
	
	<div id="basic-info-panel" class="g-tab-content">
		<form id="basic-info-form" action="">
			<h3>帐户信息</h3>
			<div class="form-field">
				<label>用户名</label>
				<input type="text" class="text readonly" readonly="readonly" value="<?php echo $user->getUsername(); ?>" />
			</div>
			<div class="form-field">
				<label>电子邮件</label>
				<input type="text" class="text readonly" readonly="readonly" value="<?php echo $user->getEmail(); ?>" />
			</div>
			<div class="form-field">
				<label>加入时间</label>
				<input type="text" class="text readonly" readonly="readonly" value="<?php echo $user->getGmtCreate(); ?>" />
			</div>
				
			<h3>修改密码</h3>
			<div class="form-field">
				<label>旧密码</label>
				<input type="password" class="text" value="" />
			</div>
			<div class="form-field">
				<label>新密码</label>
				<input type="password" class="password" value="" />
			</div>
			<div class="form-field">
				<label>确认新密码</label>
				<input type="password" class="password" value="" />
			</div>
				
			<div class="form-field action">
				<input id="basic-info-form-submit" type="submit" value="保存" class="button"></input>
			</div>
		</form>
	</div>
	
	<div id="detail-info-panel" class="g-tab-content">
		<form id="detail-info-form" action="">
			<div class="form-field">
				<label for="gender">性别</label>
				<select name="gender" id="gender">
					<option value="Unknow"></option>
					<option value="Male" selected="selected">男</option>
					<option value="Female">女</option>
				</select>
			</div>
			<div class="form-field">
				<label for="birth-year">生日</label>
				<input name="birth-year" type="text" class="text tiny" value="" maxlength="4" />
				年
				<select name="birth-month" id="birth-month">
					<option value=""></option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
				</select>
				月
				<select name="birth-day" id="birth-day">
					<option value=""></option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
					<option value="23">23</option>
					<option value="24">24</option>
					<option value="25">25</option>
					<option value="26">26</option>
					<option value="27">27</option>
					<option value="28">28</option>
					<option value="29">29</option>
					<option value="30">30</option>
					<option value="31">31</option>
				</select>
				日
			</div>
			<div class="form-field">
				<label for="province">所在地</label>
				<select name="province" id="province">
					<option value="0"></option>
					<option value="1">北京</option>
					<option value="2">上海</option>
					<option value="3">天津</option>
					<option value="4">重庆</option>
					<option value="5">河北</option>
					<option value="6">山西</option>
					<option value="7">内蒙古</option>
					<option value="8">辽宁</option>
					<option value="9">吉林</option>
					<option value="10">江苏</option>
					<option value="11">浙江</option>
					<option value="12">安徽</option>
					<option value="13">福建</option>
					<option value="14">江西</option>
					<option value="15">山东</option>
					<option value="16">河南</option>
					<option value="17">湖北</option>
					<option value="18">湖南</option>
					<option value="19">海南</option>
					<option value="20">广东</option>
					<option value="21">广西</option>
					<option value="22">四川</option>
					<option value="23">贵州</option>
					<option value="24">云南</option>
					<option value="25">西藏</option>
					<option value="26">陕西</option>
					<option value="27">甘肃</option>
					<option value="28">青海</option>
					<option value="29">宁夏</option>
					<option value="30">新疆</option>
					<option value="31">黑龙江</option>
					<option value="32">香港</option>
					<option value="33">澳门</option>
					<option value="34">台湾</option>
					<option value="35">海外</option>
				</select>
				<!-- <select name="city" id="city"> -->
				<input type="text" value="" name="city" class="text tiny"></input>
			</div>
	
			<div class="form-field">
				<label for="homeprovince">家乡</label>
				<select name="home-province" id="home-province">
					<option value="0"></option>
					<option value="1">北京</option>
					<option value="2">上海</option>
					<option value="3">天津</option>
					<option value="4">重庆</option>
					<option value="5">河北</option>
					<option value="6">山西</option>
					<option value="7">内蒙古</option>
					<option value="8">辽宁</option>
					<option value="9">吉林</option>
					<option value="10">江苏</option>
					<option value="11">浙江</option>
					<option value="12">安徽</option>
					<option value="13">福建</option>
					<option value="14">江西</option>
					<option value="15">山东</option>
					<option value="16">河南</option>
					<option value="17">湖北</option>
					<option value="18">湖南</option>
					<option value="19">海南</option>
					<option value="20">广东</option>
					<option value="21">广西</option>
					<option value="22">四川</option>
					<option value="23">贵州</option>
					<option value="24">云南</option>
					<option value="25">西藏</option>
					<option value="26">陕西</option>
					<option value="27">甘肃</option>
					<option value="28">青海</option>
					<option value="29">宁夏</option>
					<option value="30">新疆</option>
					<option value="31">黑龙江</option>
					<option value="32">香港</option>
					<option value="33">澳门</option>
					<option value="34">台湾</option>
					<option value="35">海外</option>
				</select>
				<!-- <select name="home-city" id="home-city"> -->
				<input type="text" value="" name="home-city" class="text tiny"></input>
			</div>
			<div class="form-field">
				<label class="label_input" for="pro_bas_website">个人网址</label>
				<input name="website" type="text" class="text large" id="pro_bas_website" value="http://bbiao.spaces.live.com" />
			</div>
			<div class="form-field">
				<label class="label_input" for="pro_bas_detail">自述</label>
				<textarea name="detail" id="pro_bas_detail" rows="6" cols="50"></textarea>
			</div>
			<div class="form-field action">
				<input id="detail-info-form-submit" type="submit" value="保存" class="button"></input>
			</div>
		</form>
	</div>
	
	<div id="im-bind-panel" class="g-tab-content">
		<form id="im-bind-form" action="">				
			<h3>绑定饭否帐号</h3>
			<div class="form-field">
				<label>用户名</label>
				<input type="text" class="text" value="" />
			</div>
			<div class="form-field">
				<label>密码</label>
				<input type="password" class="password" value="" />
			</div>				
			<div class="form-field action">
				<input id="im-bind-form-submit" type="submit" value="绑定" class="button"></input>
			</div>
		</form>
	</div>
</div>