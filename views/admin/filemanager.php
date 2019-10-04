<?php
 if (!defined("_VALID_PHP")){
	 die('Acesso direto negado');
 }
?>
<div class="row page-titles">
    <div class="col-md-12 align-self-center">
        <h3 class="text-themecolor">Gerenciador de Arquivos</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <iframe src="<?php echo BASE; ?>/libs/filemanager/dialog.php" frameborder="0" width="100%" height="550px">Esse navegador não permite uso de iframe.</iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="right-sidebar">
    <div class="slimscrollright">
        <div class="rpanel-title"> Ajuda <span><i class="mdi mdi-close right-side-toggle"></i></span> </div>
        <div class="r-panel-body geek-help">
            <ul id="themecolors" class="m-t-20">
                <li><b>With Light sidebar</b></li>
                <li><a href="javascript:void(0)" data-theme="default" class="default-theme">1</a></li>
                <li><a href="javascript:void(0)" data-theme="green" class="green-theme">2</a></li>
                <li><a href="javascript:void(0)" data-theme="red" class="red-theme">3</a></li>
                <li><a href="javascript:void(0)" data-theme="blue" class="blue-theme">4</a></li>
                <li><a href="javascript:void(0)" data-theme="purple" class="purple-theme">5</a></li>
                <li><a href="javascript:void(0)" data-theme="megna" class="megna-theme">6</a></li>
                <li class="d-block m-t-30"><b>With Dark sidebar</b></li>
                <li><a href="javascript:void(0)" data-theme="default-dark" class="default-dark-theme working">7</a></li>
                <li><a href="javascript:void(0)" data-theme="green-dark" class="green-dark-theme">8</a></li>
                <li><a href="javascript:void(0)" data-theme="red-dark" class="red-dark-theme">9</a></li>
                <li><a href="javascript:void(0)" data-theme="blue-dark" class="blue-dark-theme">10</a></li>
                <li><a href="javascript:void(0)" data-theme="purple-dark" class="purple-dark-theme">11</a></li>
                <li><a href="javascript:void(0)" data-theme="megna-dark" class="megna-dark-theme ">12</a></li>
            </ul>
        </div>
    </div>
</div>