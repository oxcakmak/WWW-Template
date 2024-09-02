<?php

if(empty($_SESSION['session'])){
    include 'login.php';
    exit;
}

include __DIR__ . '/partial.php';

$config['partialBody'] = '<div class="col-md-12 grid-margin"><div class="d-flex justify-content-between align-items-center"><div><h4 class="font-weight-bold mb-0">'.$lang['settings'].'</h4></div></div></div>

<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="passwordOld">'.$lang['old_password'].'</label>
                        <input type="password" class="form-control" id="passwordOld" placeholder="'.$lang['old_password'].'">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="passwordNew">'.$lang['new_password'].'</label>
                        <input type="password" class="form-control" id="passwordNew" placeholder="'.$lang['new_password'].'">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="passwordNewAgain">'.$lang['new_password_again'].'</label>
                        <input type="password" class="form-control" id="passwordNewAgain" placeholder="'.$lang['new_password_again'].'">
                    </div>
                </div>
                <div class="col-md-6"><button type="submit" class="btn btn-primary w-100" id="btnUpdatePassword">'.$lang['sumbit'].'</button></div>
                <div class="col-md-6"><button class="btn btn-secondary w-100">'.$lang['cancel'].'</button></div>
            </div>
        </div>
    </div>
</div>
';
$config['partialScript'] = '<script>
$("#btnUpdatePassword").click((e) => {
	e.preventDefault();
	$.ajax({
		url: "'.$config['api'].'account",
		type: "POST",
		dataType: "json",
		data: { 
			passwordOld: $("#passwordOld").val(),
			passwordNew: $("#passwordNew").val(),
            passwordNewAgain: $("#passwordNewAgain").val(),
			action: "updatePassword"
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
$config['partial'] .= '</head><body><div class="container-scroller">';
$config['partial'] .= $config['partialNavbar'];
$config['partial'] .= '<div class="container-fluid page-body-wrapper">';
$config['partial'] .= $config['partialNavbar'].$config['partialSidebar'];
$config['partial'] .= '<div class="main-panel"><div class="content-wrapper"><div class="row">';
$config['partial'] .= $config['partialBody'];
$config['partial'] .= '</div></div></div>';
$config['partial'] .= '</div></div>';
$config['partial'] .= $config['partialScriptDefault'].$config['partialScript'];
$config['partial'] .= '</body></html>';

echo $config['partial'];

?>