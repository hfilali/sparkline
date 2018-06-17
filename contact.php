<!DOCTYPE html>
<html lang="en">
<head>
<title>Sparkline | Contact</title>
<?php include("includes/header.php"); ?>
</head>        
<body>

<div id="boxed">
<section>	
<?php include("includes/menu.php"); ?>
    
<!-- BAR TITRE -->
<div class="title-bar"><!-- style t-shadow/ t-gray/ -->
	<div class="container ">
		<div class="page-root">
			<a href="index.php">Accueil</a>/
			<a href="#">Contact</a>			
		</div> <!-- /.page-root -->
	</div> <!-- /.container -->
</div><!-- /.title-bar -->
<!-- FIN BAR TITRE -->


<div class="col-wrap "><!-- style col-shadow/ col-gray/ testimonial/-->
    <div class="container ">
        <!-- Three columns of text below the carousel -->
        <div class="row-fluid">
            <div class="span8 themeapt_animated_text themeapt_text  themeapt_animate_when_almost_visible left-to-right">
                <h1>Pour nous contacter ...</h1>
                <!--   hr-Start-->
                <div class="hr hr-left hr-short"> <!--   hr-center/ hr-left/ hr-right/  hr-short/ hr-light/-->
                    <span class="hr-inner">
                        <span class="hr-inner-style"></span>
                    </span>
                </div>
				<!--   hr-Close-->
                
                <!-- FORMULAIRE CONTACT -->
                <div class="contactform">
                    <form action="" method="post" onsubmit="return send_contact_message();">
                        <p>Votre Nom <span>*</span>
                            <input type="text" value="Votre Nom" name="contact_name" id="contact_name" class="contact_form_box " onblur="if (this.value == ''){this.value = 'Votre Nom';}" onfocus="if (this.value == 'Votre Nom'){this.value = '';}"   />
                        </p>
                        <p>Votre Email <span>*</span>
						<input type="text" value="Votre Email" name="contact_email" id="contact_email" class="contact_form_box " onblur="if (this.value == ''){this.value = 'Votre Email';}" onfocus="if (this.value == 'Votre Email'){this.value = '';}"   />
                        </p>
					   <p>Objet <span>*</span>
                           <input type="text" value="Objet de votre demande" name="contact_subject" id="contact_subject" class="contact_form_box " onblur="if (this.value == ''){this.value = 'Objet de votre demande';}" onfocus="if (this.value == 'Objet  de votre demande'){this.value = '';}"   />
                        </p>
                        <p>Votre Message <span>*</span>
                            <textarea onblur="if(this.value=='')this.value=this.defaultValue;" class="contact_form_box " onfocus="if(this.value==this.defaultValue)this.value='';" name="contact_message" id="contact_message">Tapez votre message</textarea>
                        </p>
                        <div>
                            <input type="submit" value="Envoyer votre message" class="submit button purchase btn-sent " /> 
                            <div id="contact_form_message_box"></div>
						</div>
                    </form>				
                </div>
                <!-- FIN DU FORMULAIRE CONTACT -->
            </div><!-- /.span8 -->
        </div><!-- /.row -->
    </div>
</div><!-- /.col -->
<?php include("includes/footer.php"); ?>		
</section>
</div>
<?php include("includes/jsfiles.php"); ?>		
<!-- 12/03/17 : DASHBOARD ANALYTICS by Florent Defontis -->
<script type="text/javascript" src="https://cdn.air360tracker.net/air360.min.js"></script>
<script type="text/javascript">
     Air360.init("paa3v08emtjbn59o");
</script>		
</body>
</html>