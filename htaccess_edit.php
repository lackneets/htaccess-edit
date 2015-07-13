<html>
<head>
  <title>Edit .htaccess</title>
</head>
<body>
  <?php

  ini_set('display_errors', true);

  if(@$_POST['delete_htaccess']){
    @unlink('.htaccess');
    header("Refresh: 0; url={$_SERVER['PHP_SELF']}");
    exit;
  }

  $htaccess = "";
  if(file_exists(".htaccess")){
    $htaccess = @file_get_contents(".htaccess");
  }else if(file_exists("htaccess.sample")){
    $htaccess = @file_get_contents("htaccess.sample");
  }

  if(@$_POST['htaccess']){
    $htaccess = $_POST['htaccess'];
    file_put_contents('__htaccess.swap', $_POST['htaccess']);
    @unlink('.htaccess');
    copy('__htaccess.swap', '.htaccess');
    @unlink('__htaccess.swap');
  }


  ?>

  <form method="POST" style="width:800px; margin:auto;">
    <h1>Edit .htaccess</h1>
    <textarea name="htaccess" style="height:600px; width:100%;"><?php echo $htaccess ?></textarea>
    <input type="hidden" name="delete_htaccess">
    <div style="padding:20px; text-align:center">
      <button type="submit">Save</button>
      <button type="button" onclick="window.open('./')">Test</button>
      <button type="button" onclick="this.form.delete_htaccess.value=true; this.form.submit()">Delete</button>
    </div>
  </form>

</body>
</html>
