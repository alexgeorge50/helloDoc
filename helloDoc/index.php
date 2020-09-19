<?php
//must appear BEFORE the <html> tag
session_start();
include_once('include/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="js/nav.js"></script>
    <script src="js/read_more.js"></script>
    <link rel="stylesheet" href="css/styles.css">
    <title>helloDoc</title>
</head>
<body onLoad="run_first()">
	<?php include("include/banner.inc") ?>
    <?php include("include/nav.inc") ?>
    <div class="container">
    	<div class="row">
        	<div class="col">
        		<div class="bg-light mt-3 px-2" style="border-radius: 5px; border: #0000ff solid thick">
                        <h1>Sodales Pretium</h1>

                        <p><em>Class</em> convallis phasellus neque pulvinar id taciti duis mi ullamcorper.
                             Nonummy platea senectus. Pulvinar magnis lobortis porttitor.
                             Urna interdum pede vitae, suspendisse magna.</p>

                        <h2>Urna Cras</h2>
                        <p>Integer ipsum praesent ultrices nullam molestie tortor pellentesque sociis.
                            Placerat Laoreet, aptent dictumst magnis. Per sapien Sollicitudin.
                            Mus auctor ut. Lectus penatibus tellus augue lorem. Aenean, sociosqu
                            etiam etiam tellus suscipit vitae commodo Quisque auctor volutpat a ut
                            felis maecenas feugiat posuere, class parturient porta. Ultricies a. Convallis.</p>

                        <h2>Commodo Vestibulum</h2>
                        <p>Mauris. Tortor cras. Rhoncus congue ultricies nunc. Integer habitasse.
                            Leo malesuada morbi pharetra ultricies metus mi, est. Sagittis quis
                            facilisi porttitor bibendum, suspendisse penatibus posuere rutrum tellus tortor nibh.</p>
            	</div>
        	</div>
            <div class="col">
            	<div class="bg-light mt-3 px-2" style="border-radius: 5px; border: #0000ff solid thick">
                        <h1>Venenatis Velit Sagittis Inceptos</h1>

                        <p>Ipsum vitae sit enim a sagittis dictum elit aenean porta senectus nullam pede
                            enim mauris eu urna per neque <em>diam</em> lobortis eget aliquet. Sagittis
                            turpis dis natoque hendrerit nec pellentesque. Dolor dictumst mauris dui
                            hymenaeos, varius mauris conubia nisi ullamcorper malesuada porta, amet dis.</p>

                        <h2>Posuere At Torquent Faucibus</h2>
                        <p>Accumsan Enim <strong>metus</strong> hac. Eleifend, nisi. Aenean Rutrum,
                            semper dapibus <strong>magnis</strong> eu dapibus risus, senectus Elit
                            dapibus consequat bibendum conubia libero arcu non magnis aliquet accumsan
                            eu lacus est auctor. Mollis.</p>

                        <p style="display: none;" id="expand-p">Mollis pharetra lacus interdum convallis mollis, facilisi convallis nisl
                            porta nisi nisl accumsan vel nisl ligula a etiam ridiculus pulvinar.
                            Justo pellentesque <em>fames</em> class <em>auctor</em> id tempor mus
                            rutrum ad nulla. Ridiculus ornare ac, donec fusce sem felis lacus.
                            Ut cras scelerisque varius feugiat ut quam dui feugiat rutrum.
                            Ultrices lorem cum id hendrerit molestie volutpat montes pede nascetur
                            magna habitasse. Inceptos placerat posuere. Nisl felis penatibus auctor nam nullam.</p>
                        <a id="expand-p-click" href="javascript:;" style="text-decoration: none;"
                           onClick="show_text('expand-p-click', 'expand-p', 'block')">Read more ...</a>

                        <h2>Maecenas Gravida Amet Praesent</h2>
                        <p>Pretium accumsan nec in bibendum ante. Pretium auctor adipiscing
                            nullam amet <span style="display: none;" id="expand-text">
                            pede velit <em>dui</em> <strong>mattis</strong> ullamcorper
                            suspendisse <strong>iaculis</strong> habitasse nisi urna tellus hymenaeos
                            dui placerat netus hendrerit natoque posuere sagittis aptent urna
                            Fringilla platea adipiscing dapibus congue duis mi faucibus integer
                            suspendisse hendrerit sem inceptos tempus ultrices rhoncus habitant
                                neque orci <strong>vehicula</strong> <em>tortor</em> torquent lectus.</span>
                            <a id="expand-click" href="javascript:;" style="text-decoration: none;"
                               onClick="show_text('expand-click', 'expand-text', 'inline')">Read more ...</a>
                        </p>
            	</div>
            </div>
        </div>
    </div>
	
	<?php include("include/footer.inc") ?>
</body>
</html>