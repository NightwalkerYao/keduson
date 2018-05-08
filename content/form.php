<section class="readme">
<div id="add_single" style="text-align: center;">
    <h2> Ajouter des singles ou des albums </h2>
    <form method="post" enctype="multipart/form-data" id="F1p">
        <div id="singles_field" style="width:100%; min-height:50px; text-align: center;"> 
            <noscript>
                <em style="color: red">Vous ne pouvez pas envoyer de fichier car JavaScript n'est pas actif.</em>
            </noscript>
            <label class="label-upload" for="upfield">Choisir un fichier</label><input type="file" id="upfield" class="champ-upload phantom" name="upfile"><div id="Flogger"></div>
        </div>
        <button disabled style="background: url(<?=ROOT_SANS;?>/css/images/navbar.png) center top repeat; border: 1px solid grey; width: auto; height: 26px; cursor: pointer; color: #CCC;" type="submit" class="button-normal" id="sendSingles">Soumettre</button> &nbsp; <a href="#needHelp">Besoin d'aide ? </a>
    </form>
</div>
<section id="workin" class="inform"></section>
    <div id="les_albums" style="display:none;">
<fieldset><legend><h2>Les albums</h2></legend>
</fieldset>
</div>
<br> 
<br>
<div class="addHelp" align="justify" id="needHelp">
    <h1 data-sous_div="1"> <!-- <img src="<?=ROOT_SANS;?>/img/icones/icons8-Help.png" alt="Aide upload"> --> Besoin d'aide pour commencer? </h1>
    Voici en quelques lignes les instructions de base pour commencer à uploader vos musiques sur <a href="<?=ROOT_SANS;?>"><?=$_SERVER['HTTP_HOST'];?></a>
    <br><br>
    <div id="sous_div1">
        <button class="accordion" data-next_div="1"><h2> &nbsp; Comment uploader un single?</h2></button>
        <div class="panel1" id="next_div1">
        <p>
            Pour uploader un single (audio unique), 
            <ol>
                <li>Cliquez sur le bouton "Choisir" ci-dessus.</li>
                <li>Choisissez le fichier audio que vous voulez envoyer. Les extensions prises en charge pour les singles sont <strong> mp3 , m4a, aac, ogg, flac, wav </strong>et<strong> mid</strong>.</li>
                <li> Cliquez sur le bouton "Soumettre" et attendez que votre fichier soit envoyé (upload à 100%).</li>
                <li> Un formulaire s'ouvre en dessous de l'indicateur d'upload, vous invitant à completer les détails sur votre fichier audio en cours d'envoi. Le serveur va d'abord tenter de lire les tags ID3 contenus dans le fichier. S'il en trouve, le formulaire est completé d'avance. Sinon, vous devrez tout remplir par vous-même.</li>
                <li> Une fois les détails remplis, Cliquez sur le bouton 'Soumettre' (en dessous) pour envoyer votre formulaire. Celui-ci sera analysé et si valide, votre upload sera mis en modération (attente d'être revu par un administrateur du site.</li>
                <li> Si tout est correct et validé par l'équipe de modération, votre upload sera disponible dans les listes de téléchargements.</li>
                <li>Et vous avez terminé votre envoi (upload) !</li>
            </ol>
        </p>
        </div>

        <button data-next_div="2" class="accordion"><h2> &nbsp;Comment uploader un album complet? </h2></button>
        <div class="panel1" id="next_div2">
        <p>
            Pour uploader un album complet, voici les différentes étapes:
            <ol>
                <li>Rassemblez tous les fichiers audio de l'album dans un même dossier, Vous pouvez créer un nouveau dossier "upload" sur le Bureau et y copier tous les morceaux (fichiers audio). </li>
                <li> Ajoutez une pochette au dossier où sont les fichiers audio. La pochette (ou cover) doit être une image de type PNG ou JPG (ou JPEG) ou GIF, et de résolution minimale 250X250. Elle ne doit pas non plus être trop lourde (maximum 2Mo)</li>
                <li> Créez une archive zip avec le dossier où vous avez placé tous les fichiers (audios et image). Pour cela, mettez vous à un dossier plus haut du dossier courant (dans le cas de "upload", ce serait sur le Bureau). Faites clic droit sur le nom du dossier qui contient les fichiers et choisissez "Compresser en archive zip" ou "Ajouter à l'archive &lt;upload.zip&gt;" ou "Créer un zip"; tout dépend de votre SE(Système d'Exploitation) et de votre application gestionnaire d'archive.<br> <b>PS:</b> l'archive doit obligatoirement être de type zip.</li>
                <li>Attendez la fin du proccessus de compression </li>
                <li>Cliquez sur le bouton "Choisir" ci-dessus et sélectionnez votre archive .zip nouvellement créée </li>
                <li> Cliquez sur "Soumettre" et patientez pendant l'envoi (upload) de votre zip</li>
                <li> Une fois l'archive bien envoyée, elle va être décompressée et un formulaire s'ouvrira en dessous de l'indicateur d'upload, vous invitant à completer les détails concernant l'album et ses pistes.</li>
                <li> Utilisez le bouton "Soumettre" en dessous du formulaire pour envoyer votre formulaire rempli.</li>
                <li>Votre upload passera alors en modération et sera disponible dès qu'un administrateur l'aura approuvé. </li>
                <li> Et vous venez de terminé avec succès votre premier envoi!</li>
            </ol>
        </p>
        </div>

        <button data-next_div="3" class="accordion"><h2> &nbsp;Vous avez rien compris à tout ça?</h2></button>
        <div class="panel1" id="next_div3">
        <p> Et bien dans ce cas, il vous reste moins d'options. Commencez par cliquer sur "LE CLUB" et écrivez quelque chose à la Shoutbox.</p>
        </div>
    </div>
        <script>
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var nu = this.getAttribute('data-next_div'), panel = document.getElementById('next_div'+nu);
            if (panel.style.maxHeight){
            panel.style.maxHeight = null;
            } else {
            panel.style.maxHeight = panel.scrollHeight + "px";
            } 
        });
        }
        </script>
</div>
<style>
div.addHelp{
padding: 1px; margin:0; font-size: 14px;
}
div.addHelp button{
background:rgba(10,20,30,0.65); font-size: large; font-weight: bold; display: block; width: 100%;  cursor:pointer; padding:0 0 0 1px; color: gray;
}
div.addHelp button h2{
font-size: x-large; font-weight: bold; padding: 0;
}
/*div.addHelp button h2:before{
content: '+ '; float: left;
}*/
div.addHelp h1{
font-size: xx-large; cursor:pointer;
}
div.addHelp h1 img{
position: relative; top: 12px; width: 8%;
}
div.panel1{
max-height: 0; overflow: hidden; transition: max-height 0.8s ease-out;
}
.active, .accordion:hover{
background:rgba(10,20,30,0.45);
}
.active h2:before{
content: '- '; float: left;
}
.accordion {
text-align: left; border: none; outline: none; transition: 0.4s;
}
.champ-upload{
    width: 1px; height: 1px;
}
.phantom{
    visibility: hidden;
}
.label-upload{
    /*background-color: #1b72ca;
    height: 65px;
    border-radius: 1px;
    color: #2e2e2e;
    font-size: 16px;
    padding: 3px 18px;
    box-sizing: border-box;
    cursor: pointer;*/
    background-color: #18385B;
    padding: 4px 6px;
    width: 40%;
    cursor: pointer;
    float: none;
    color: #ddd;
    font-size: 12pt;
    text-transform: uppercase;
    letter-spacing: 1px;
    text-shadow: 0 1px 0 #000;
    text-indent: 10px;
    font-weight: 700;
    cursor: pointer;
}
</style>
</section>
<script type="text/javascript"><?=@file_get_contents('js/upload.js');?></script>
