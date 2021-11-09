<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Cloud Compiler</title>

<!-- Stylesheet files-->

<link href="css/style.css?version=1" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<script src="jquery/jquery-1.20.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</head>
<body class="main-body">
<!-- Bootstrap div Start -->
<div class="col-lg-12 col-md-12 col-sm-12">
<div>
<?php include('include/nav-header.php');  ?>
<!-- Search START -->
<div class="search col-lg-12 col-md-11 col-sm-11">
  <form method="get" action="#">
    <div class="col-lg-1 col-md-1 col-sm-1">&nbsp;</div>
    <div class="input-group col-lg-10 col-md-9 col-sm-9"><span class="input-group-addon small-border-search-right" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
      <input list="searches" class="form-control small-border" placeholder="Search" name="CCSearch" id="CCSearch" aria-describedby="basic-addon1" />
      <div id="suggestions">
     
      </div>
    </div>
    <div class="col-lg-12 col-md-11 col-sm-11"><br/>
      <input type="submit" class="btn btn-success form-control" value="Search" />
    </div>
  </form>
</div>
<!-- Search END -->


<div class="tabs text-center">
  <div class="nav-center">
    <ul class="nav nav-tabs centered">
      <li class="active tabSize"><a data-toggle="tab" href="#home">Compiler Interfaces</a></li>
      
         </ul>
  </div>
</div>

<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
    <div class="languages">
      <!-- first Row Start -->
      <div class="row"><a href="#">
        <div class="col-md-3 col-sm-3">
          <div class="thumbnail "><img src="images/PHP.png" class="rotate-360" alt="PHP">
            <div>
              
              <p><a href="#" class="btn btn-primary  btn-go" role="button">Go</a></p>
            </div>
          </div>
        </div>
        </a><a href="#">
        <div class="col-md-3 col-sm-3">
          <div class="thumbnail"><img src="images/sql.png" class="rotate-360" alt="SQL">
            <div>
              
              <p><a href="#" class="btn btn-primary  btn-go" role="button">Go</a></p>
            </div>
          </div>
        </div>
        </a>
        </a>
        <a href="#">
          <div class="col-md-3 col-sm-3">
            <div class="thumbnail"><img src="images/html.png" class="rotate-360" alt="HTML">
              <div>
                
                <p><a href="#" class="btn btn-primary btn-go" role="button">Go</a></p>
              </div>
            </div>
          </div>
        </a></div>
      
      <!-- First Row END -->
      <!-- Second Row Start -->
      
      <div class="row">
      <a href="#">
        <div class="col-md-3 col-sm-3">
          <div class="thumbnail"><img src="images/javascript.png" class="rotate-360" alt="javascript">
            <div>
              
              <p><a href="#" class="btn btn-primary btn-go" role="button">Go</a></p>
            </div>
          </div>
        </div>
        </a>
        
        <a href="#">
        <div class="col-md-3 col-sm-3">
          <div class="thumbnail"><img src="images/c++.png" class="rotate-360" alt="C++">
            <div>
              
              <p><a href="#" class="btn btn-primary btn-go" role="button">Go</a></p>
            </div>
          </div>
        </div>
        </a>
      	<a href="#">
        <div class="col-md-3 col-sm-3">
          <div class="thumbnail"><img src="images/java.png" class="rotate-360" alt="Java PROGRAMMING">
            <div>
              
              <p><a href="#" class="btn btn-primary btn-go" role="button">Go</a></p>
            </div>
          </div>
        </div>
      </div>
      </a>
      <!-- Second Row END -->
      
      </div>
 
</div>
<!-- Container Div END -->
</div>
<!-- Bootstrap div END -->
<div>
<?php include('include/footer.php');  ?>
  <div>

<!-- End of .container -->
</div>
</body>

</html>