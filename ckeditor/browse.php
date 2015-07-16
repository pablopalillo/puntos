<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Browse test</title>

<script type="text/javascript">
function select_image() {

var imagen =  document.getElementById("upload");

var CKEditorFuncNum = <?php echo $_GET['CKEditorFuncNum']; ?>;
window.parent.opener.CKEDITOR.tools.callFunction( CKEditorFuncNum, '/3.jpg', '' );
self.close();
}
</script>

</head>
<body>
	<div>
		<input id="upload" type="file" name="upload"  >
	</div>

	<a href="javascript:select_image();">
	Insertar Imagen	
	</a>

</body>
</html>