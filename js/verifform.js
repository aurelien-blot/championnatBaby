function surligne(champ, erreur) {
	if (erreur == true) {
		champ.style.backgroundColor = "#fba";
	} else {
		champ.style.backgroundColor = "";
	}
}

function verifPseudo(champ) {
	if (champ.value.length < 2 || champ.value.length > 25) {
		surligne(champ, true);
		return false;
	} else {
		surligne(champ, false);
		return true;
	}
}

function verifMail(champ)
{
   var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
   if(!regex.test(champ.value))
   {
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }
}

function validation(f) {
  if (f.mdp1.value == '' || f.mdp2.value == '') {
    alert('Tous les champs ne sont pas remplis');
    f.mdp1.focus();
    return false;
    }
  else if (f.mdp1.value != f.mdp2.value) {
    alert('Ce ne sont pas les mêmes mots de passe!');
    f.mdp1.focus();
    return false;
    }
  else if (f.mdp1.value == f.mdp2.value) {
    return true;
    }
  else {
    f.mdp1.focus();
    return false;
    }
  }

function verifForm(f)
{
   var pseudoOk = verifPseudo(f.pseudo);
   //var mailOk = verifMail(f.email);
   //var ageOk = verifAge(f.age);

   if(pseudoOk)
      return true;
   else
   {
      alert("Veuillez remplir correctement tous les champs");
      return false;
   }
}

function verifAll(f){

	var vf = verifForm(f);
	var val = validation(f);

	if (vf == false ||val == false){
		return false;
	}else{
		return true;
	}


}
