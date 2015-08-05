<section id="formular">
   <div class="wrap-920">
       <h1 class="page-dark">Tilmeld dig Klar til film</h1>
            <form id="contact-form" method="post" action="<?php echo get_template_directory_uri() ?>/ajax-form.php">
                <div class="split">
                   <div>
                        <input type="text" name="navn"/>
                        <label for="navn">Fornavn</label>
                    </div>
                    <div>

                        <input type="text" name="efternavn"/>
                        <label for="efternavn">Efternavn(e)</label>
                    </div>
                </div>
                
                <div class="split">
                   <div>
                        <input type="text" name="telefon"/>
                        <label for="telefon">Telefonnummer</label>
                    </div>
                    <div>

                        <input type="email" name="email"/>
                        <label for="email">Email</label>
                    </div>
                </div>
                
                <div>
                    <input type="text" name="adresse">
                    <label for="adresse">Din adresse</label>
                </div>
                <div class="split">
                    <div class="small">
                        <input type="text" name="postnummer">
                        <label for="postnummer">Postnummer</label>
                    </div>
                    <div class="large">
                        <input type="text" name="by">
                        <label for="by">By</label>
                    </div>
                </div>
                
                <div>
                    <input type="text" name="skole"/>
                    <label for="email">Hvor går du i skole?</label>
                </div>
                <div>
                    <textarea name="evt" rows="2"></textarea>
                    <label for="evt">Eventuelle bemærkninger</label>
                </div>
                <div>
                    <a href="#" class="form-button submit">Indsend</a>
                    <a href="mailto:mail@klartilfilm.dk" class="form-button other">Send en email i stedet</a>
                </div>
            </form>
    </div>
</section>