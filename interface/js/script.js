document.getElementById("ajouterRapport").style.display="none";

function afficherAjouterRapport()
{
    if(document.getElementById("ajouterRapport").style.display == "block")
    {
        document.getElementById("ajouterRapport").style.display="none";
    }
    else
    {
        document.getElementById("ajouterRapport").style.display = "block";
    }
}