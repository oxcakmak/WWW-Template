<?php

if(isset($_SESSION['session'])){
	header("location: " . $config['url']);
}

include __DIR__ . '/partial.php';

$config['partialBody'] = '<title>'.$lang['home'].'</title>
<div class="auth-form-light text-left py-5 px-4 px-sm-5">
  <h4 class="text-center">'.$lang['sign_in'].'</h4>
  
  <form class="pt-3">
	<div class="form-group">
	  <input type="text" class="form-control form-control-lg" id="user" placeholder="'.$lang['member_id_or_email_address'].'">
	</div>
	<div class="form-group">
	  <input type="password" class="form-control form-control-lg" id="password" placeholder="'.$lang['password'].'">
	</div>
	<div class="mt-3">
	  <a class="btn btn-block w-100 btn-primary btn-lg font-weight-medium auth-form-btn" id="btnSignIn" href="javascript:void(0);">'.$lang['sign_in'].'</a>
	</div>
  </form>
</div>';
$config['partialScript'] = '<script>
$("#btnSignIn").click((e) => {
	e.preventDefault();
	$.ajax({
		url: "'.$config['api'].'account",
		type: "POST",
		dataType: "json",
		data: { 
			user: $("#user").val(),
			password: $("#password").val(),
			action: "signIn"
		},
		success: function(res){
			alert(res.message);
			if(res.status){ 
				$("input").val("");
				setTimeout(()=> { location.reload(); }, 2500);
			}
		}
	});
});
</script>';

$config['partial'] .= $config['partialHeader'];
$config['partial'] .= '</head><body>';
$config['partial'] .= '<div class="container-scroller"><div class="container-fluid page-body-wrapper full-page-wrapper"><div class="content-wrapper d-flex align-items-center auth px-0"><div class="row w-100 mx-0"><div class="col-lg-4 mx-auto">';
$config['partial'] .= $config['partialBody'];
$config['partial'] .= '</div></div></div></div></div>';
$config['partial'] .= $config['partialScriptDefault'].$config['partialScript'];
$config['partial'] .= '</body></html>';

$cachedValue = $cache->get('pageLogin');

if ($cachedValue) {
    echo base64_decode($cachedValue);
} else {
    $cache->set('pageLogin', base64_encode($config['partial']), 600);
	echo $config['partial'];
}

?>