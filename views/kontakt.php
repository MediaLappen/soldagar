
<div class="container">
	<form id="contactForm" novalidate="true" >
  <div class="form-group">
    <label for="exampleFormControlInput1">Namn</label>
    <input type="text" name="namn" class="form-control" id="namn" placeholder="Namn" required="required" data-error="Namn Saknas">
    <div class="help-block with-errors"></div>
  </div>

  <div class="form-group">
    <label for="exampleFormControlInput1">Email address</label>
    <input type="email" name="epost" class="form-control" id="epost" placeholder="namn@exempel.se" required="required" data-error="Epost Saknas">
    <div class="help-block with-errors"></div>
  </div>
  
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Meddelande</label>
    <textarea class="form-control" name="meddelande" id="meddelande" rows="3" required="required"></textarea>
  </div>
  <div class="submit-button text-center">
  <button class="btn btn-success" id="submit" type="submit">Skicka Meddelande</button>
  <div id="msgSubmit" class="h3 text-center hidden"></div>
</div>
</form>
</div><!-- end of container-->

