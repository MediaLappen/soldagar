	
	<div class="container footer mt-5">
		<hr>
  	<div class="row justify-content-md-center">

  		<div class='col-lg-8  mt-3'>

  			<p class="text-center"> <a class="author-link" title ="https://medialappen.se" rel="nofollow" href="https://medialappen.se">Skapad av medialappen.se</a></p>
  		</div>
  	</div>
  </div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <?php
      if (isset($this->js)){
        foreach ($this->js as $js){
          echo '<script type="text/javascript" src="public/'.$js.'"></script>';
        }
      }
    ?>

    
    
  </body>
</html>