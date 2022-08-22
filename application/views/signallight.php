<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<title>Signal</title>
    <link rel="stylesheet" type="text/css"  href="<?=base_url()?>css/style.css">
    <script type="text/javascript" src="<?=base_url()?>js/jquery.min.js" ></script>
</head>
<body>
    <form action="#" method="POST" name="singalform" id="singalform">

        <div id="current_timer"></div>
        <div class="signal_block">
            <div id="signal1" class="signal"></div>
            <input type="text" id="singalinput1" class="input" name="signal[]" maxlength="1"/>
        </div>
        <div class="signal_block">
            <div id="signal2" class="signal"></div>
            <input type="text" id="singalinput2" class="input" name="signal[]" maxlength="1"/>
        </div>
        <div class="signal_block">
            <div id="signal3" class="signal"></div>
            <input type="text" id="singalinput3" class="input" name="signal[]" maxlength="1"/>
        </div>
        <div class="signal_block">
            <div id="signal4" class="signal"></div>
            <input type="text" id="singalinput4" class="input" name="signal[]" maxlength="1"/>
        </div>

        <div class="signal_input_block">
            <div class="span ">
                Green Light Interval:
                <input type="text" id="greenlight" class="greenlight" name="greenlight" maxlength="5"/>
            </div>
            <div class="span">
                Yellow Light Interval:
                <input type="text" id="yellowlight" class="yellowlight" name="yellowlight" maxlength="5"/>
            </div>
        </div>
        <div class="error" id="error"></div>
        <div class="signal_input_button">
            <button id="start">Start</button>
            <button id="stop">Stop</button>
        </div>
    </form>    
</body>
</html>
<script type="text/javascript">
var base_url = "<?= base_url('index.php/signallight/update') ?>";
</script>
<script type="text/javascript" src="<?=base_url()?>js/custom.js" ></script>
